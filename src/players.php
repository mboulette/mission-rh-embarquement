<?php
class players extends dataObject 
{


	function __construct() {

		parent::__construct('players');

	}


	public function login($email, $password) {

		$email = strtolower($email);

    	$sql = '
    	SELECT *
    	FROM '.$this->objectName.'
    	WHERE email=?
    	LIMIT 1
    	';

    	$stmt = $this->db->prepare($sql);
    	$stmt->bind_param('s', $email);

    	$stmt->execute();
		$result = $stmt->get_result();

    	$array = $result->fetch_all(MYSQLI_ASSOC);
    	$stmt->close();

		$date = new DateTime('now');

    	
        if ($array[0]['locked'] == '1'){
            echo 'lock';
            die();
        }

        if (password_verify($password, $array[0]['password'])) {

    		$this->update(array(
    			'id' => $array[0]['id'],
    			'date_lastlogin' => $date->format('Y-m-d H:i:s')
    		));
    		$array[0]['date_lastlogin'] = $date->format('Y-m-d H:i:s');

    		return $array[0];
    	} else {
    		return false;
    	}
    	

	}


	public function emailExist($email) {
		$email = strtolower($email);

    	$sql = '
    	SELECT *
    	FROM '.$this->objectName.'
    	WHERE email=?
    	LIMIT 1
    	';

    	$stmt = $this->db->prepare($sql);
    	$stmt->bind_param('s', $email);

    	$stmt->execute();
		$result = $stmt->get_result();

    	$array = $result->fetch_all(MYSQLI_ASSOC);
    	$stmt->close();

   		return $array[0];

	}


    //****************************************************************************************************
    //** ADMIN
    //****************************************************************************************************

    public function getAdminList() {

        $list = $this->getAll();

        $columns = array(
            'Nom' => 'lastname',
            'Prénom' => 'firstname',
            'courriel' => 'email',
            'Sexe' => 'gender',
            'Age' => 'birthday',
            'Enrolement' => 'date_created',
        );

        $orderby = 'lastname';
        $orderdir = 'desc';
        if (isset($_POST['orderby'])) $orderby = $_POST['orderby'];
        if (isset($_POST['orderdir'])) $orderdir = ($_POST['orderdir'] == 'desc' ? 'asc' : 'desc');

        usort($list, function($a, $b) use ($orderby, $orderdir) {
            return ($orderdir == 'desc') ? ($b[$orderby] < $a[$orderby]) : ($a[$orderby] < $b[$orderby]);
        });


        $template = get_template('navbar', array('active_menu' => 'admin-players'));
        $template .= get_template('players_lst', array(
            'list' => $list,
            'columns' => $columns,
            'orderby' => $orderby,
            'orderdir' => $orderdir
        ), 'admin/');

        return render($template);

    }

    public function display() {

        if (!isset($_POST['submitaction'])) {
            return $this->getAdminList();
        }

        $player = $this->getOne($_POST['id']);

        $characters_factory = new characters();
        $characters = $characters_factory->getPlayerList($_POST['id']);

        $inscriptions_factory = new inscriptions();
        $inscriptions = $inscriptions_factory->playerParticipations($_POST['id']);

        $creditcards_factory = new cards();
        $creditcards = $creditcards_factory->getPlayerList($player['square_customer_id']);

        $dir = $GLOBALS['attachments_path_players'].$_POST['id'];
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

        $template = get_template('navbar', array('active_menu' => 'admin-players'));
        $template .= get_template('players_see', array(
            'player' => $player,
            'characters' => $characters,
            'inscriptions' => $inscriptions,
            'creditcards' => $creditcards,
            'files' => $files
        ), 'admin/');

        return render($template);

    }


    public function back() {

        $_SESSION['player'] = $_SESSION['player-admin'];
        unset($_SESSION['player-admin']);

        $_SESSION['message'] = array(
            'type' => 'success',
            'body' => 'Vous êtes maintenant connecté comme «'.$_SESSION['player']['firstname'].' '.$_SESSION['player']['lastname'].'»'
        );

        $home = new home();
        return $home->display();
    }

    public function connectas() {

        if (!isset($_POST['submitaction']) || $_POST['submitaction'] != 'connectas') {
            return $this->getAdminList();
        }

        writelogs(array('action' => 'incarner', 'player' => $_POST['id']));
        
        $_SESSION['player-admin'] = $_SESSION['player'];
        $_SESSION['player'] = $this->getOne($_POST['id']);
        $_SESSION['player']['admin'] = $_SESSION['player-admin']['admin'];
        
        $_SESSION['message'] = array(
            'type' => 'success',
            'body' => 'Vous êtes maintenant connecté comme «'.$_SESSION['player']['firstname'].' '.$_SESSION['player']['lastname'].'»'
        );

        $home = new home();
        return $home->display();

    }

    public function lock() {

        if (!isset($_POST['submitaction'])) {
            return $this->getAdminList();
        }

        if (isset($_POST['id'])) {

            $current = $this->getOne($_POST['id']);

            $player = array('id' => $_POST['id']);
            if ($_POST['submitaction'] == "lock") {
                $player['locked'] = 1;

                $_SESSION['message'] = array(
                    'type' => 'danger',
                    'body' => 'Le compte du joueur «'.$current['firstname'].' '.$current['lastname'].'» est maintenant verrouillé!'
                );
            }
            
            if ($_POST['submitaction'] == "unlock") {
                $player['locked'] = 0;

                $_SESSION['message'] = array(
                    'type' => 'success',
                    'body' => 'Le compte du joueur «'.$current['firstname'].' '.$current['lastname'].'» est maintenant déverrouillé!'
                );
            }
            
            $this->update($player);

        }

        $_POST['submitaction'] = 'display';
        return $this->display();


    }

    public function send() {
        
        if (!isset($_POST['submitaction']) || $_POST['submitaction'] != 'send') {
            return $this->getAdminList();
        }

        if (isset($_POST['id'])) {
            $player = $this->getOne($_POST['id']);

            $email_template = get_template('mail-empty', array(
                'message' => nl2br($_POST['message']),
            ));

            $mail = new PHPMailer;

            $mail->Charset = 'UTF-8';
            $mail->setFrom($GLOBALS['app_email'], $GLOBALS['app_name']);
            $mail->addAddress($player['email'], $player['firstname']);
            $mail->isHTML(true);

            $mail->Subject = $_POST['subject'];
            $mail->Body    = $email_template;

            if(!$mail->send()) {

                $_SESSION['message'] = array(
                    'type' => 'danger',
                    'body' => 'Le message n`a pas pu être envoyé. Mailer Error: ' . $mail->ErrorInfo
                );

            } else {

                $_SESSION['message'] = array(
                    'type' => 'success',
                    'body' => 'Votre courriel a été envoyé avec succès à «'.$player['email'].'»!'
                );
            }

        }

        $_POST['submitaction'] = 'display';
        return $this->display();


    }

    public function erase() {

        if (!isset($_POST['submitaction']) || $_POST['submitaction'] != 'erase') {
            return $this->getAdminList();
        }

        $this->DeleteOne($_POST['id']);

        $_SESSION['message'] = array(
            'type' => 'success',
            'body' => 'Le client a été supprimé!'
        );

        return $this->getAdminList();
    }

}