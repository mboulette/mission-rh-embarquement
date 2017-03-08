<?php

class profile
{

	public function edit() {
		
		if (isset($_POST['firstname'])) $this->save();

		$dir = $GLOBALS['attachments_path_players'].$_SESSION['player']['id'];
        $files = array();
        if (is_dir($dir)) {

            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    if ($file != '.' && $file != '..') {

                        $files[] = array(
                            'name' => $file,
                            'path' => '/inscriptions/'.$dir.'/'.$file,
                            'size' => human_filesize(filesize(realpath(__DIR__.'/../'.$dir.'/'.$file))),
                            'type' => mime_content_type(realpath(__DIR__.'/../'.$dir.'/'.$file)),
                        );
                    }
                }
                closedir($dh);
            }
        }

        $attachments_lst = get_template('partial/attachments_lst', array('files' => $files));

		$template = get_template('navbar', array('active_menu' => 'profile'));
		$template .= get_template('profile', array('attachments_lst' => $attachments_lst));

		return render($template);
		
	}


	public function save() {

            
            $player = array(
                'id' => $_SESSION['player']['id'],
                'firstname' => $_POST['firstname'],
                'lastname' => $_POST['lastname'],
                'birthday' => $_POST['birthday'].' 00:00:00',
                'gender' => $_POST['gender'],
                'date_terms' => $_POST['decharge'],
                'completed' => '1'
            );


			if ($_POST['avatar'] != '') {
				$base64 = explode(',', $_POST['avatar']);
				$data = base64_decode($base64[1]);

				$filename = $GLOBALS['picture_path_avatars'].uniqid().'.jpg';

				file_put_contents($filename, $data);
			
				$player['picture_url'] = $GLOBALS['app_url'].'/'.$filename;
			}


			$players_factory = new players();
			$players_factory->update($player);

			$_SESSION['player'] = array_merge($_SESSION['player'], $player);

			$this->updateSquareCustomer($_SESSION['player']);

			$_SESSION['message'] = array(
				'type' => 'success',
				'body' => '<strong>Enregistré !</strong> Les modifications de votre profil ont été enregistrés.'
			);

	}

	public function password() {

		$token = MD5($_SESSION['player']['email'].$_SESSION['player']['password']);
		$url = '/inscriptions/reset-password?email='.urlencode($_SESSION['player']['email']).'&token='.$token;

		session_unset();
        session_destroy();

        header('Location: '.$url);
        die();

	}


	public function email() {

		if (isset($_POST['email'])) $this->updateEmail();

		$template = get_template('navbar', array('active_menu' => 'update-email'));
		$template .= get_template('update-email');

		return render($template);

	}

	public function updateEmail() {

		$players_factory = new players();

		if ($players_factory->emailExist($_POST['email'])){

			$_SESSION['message'] = array(
				'type' => 'danger',
				'body' => '<strong>Erreur !</strong> Vous ne pouvez pas changer votre adresse courriel par celle-ci, elle est déjà utilisé.'
			);

			return;
		}



        $player = array(
            'id' => $_SESSION['player']['id'],
            'email' => $_POST['email']
        );
		$players_factory->update($player);

		$_SESSION['player'] = array_merge($_SESSION['player'], $player);

		$this->updateSquareCustomer($_SESSION['player']);

		$_SESSION['message'] = array(
			'type' => 'success',
			'body' => '<strong>Enregistré !</strong> Votre adresse courriel a été modifié.'
		);

	}

	public function updateSquareCustomer($customer) {

	    $customer_api = new \SquareConnect\Api\CustomerApi();
	    $request_body = array (
            'given_name' => $customer['firstname'],
            'family_name' => $customer['lastname'],
	        'email_address' => $customer['email'],
	    );

	    # The SDK throws an exception if a Connect endpoint responds with anything besides
	    # a 200-level HTTP code. This block catches any exceptions that occur from the request.
	    try {
	        $result = $customer_api->updateCustomer(square_access_token, $customer['square_customer_id'], $request_body);

	    } catch (\SquareConnect\ApiException $e) {
	        echo "Caught exception!<br/>";
	        print_r("<strong>Response body:</strong><br/>");
	        echo "<pre>"; var_dump($e->getResponseBody()); echo "</pre>";
	        echo "<br/><strong>Response headers:</strong><br/>";
	        echo "<pre>"; var_dump($e->getResponseHeaders()); echo "</pre>";
	        die();
	    }
	}

}
