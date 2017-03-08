<?php



$players_factory = new players();
$date = new DateTime('now');

function createCustomerInSquare($email) {

    $customer_api = new \SquareConnect\Api\CustomerApi();
    $request_body = array (
        'email_address' => strtolower($email)
    );

    # The SDK throws an exception if a Connect endpoint responds with anything besides
    # a 200-level HTTP code. This block catches any exceptions that occur from the request.
    try {
        $result = $customer_api->createCustomer(square_access_token, $request_body);

    } catch (\SquareConnect\ApiException $e) {
        echo "Caught exception!<br/>";
        print_r("<strong>Response body:</strong><br/>");
        echo "<pre>"; var_dump($e->getResponseBody()); echo "</pre>";
        echo "<br/><strong>Response headers:</strong><br/>";
        echo "<pre>"; var_dump($e->getResponseHeaders()); echo "</pre>";
        die();
    }

    return $result->getCustomer()->getId();

}



/* PAGES NON-SÉCURISÉES */
switch ($_REQUEST['action']) {

    case 'signin' :

        $player = $players_factory->login($_POST['signin_email'], $_POST['signin_password']);
        $_SESSION['player'] = $player;
        echo json_encode($player);

        die();
    break;


    case 'signup' :

        if (!$players_factory->emailExist($_POST['signin_email']) && $_POST['signin_password'] != '') {
            
            $CustomerId = createCustomerInSquare($_POST['signin_email']);

            $player = array(
                'email' => strtolower($_POST['signin_email']),
                'password' => password_hash($_POST['signin_password'], PASSWORD_DEFAULT),
                'date_lastlogin' => $date->format('Y-m-d H:i:s'),
                'birthday' => '1998-01-01 00:00:00',
                'gender' => 'M',
                'picture_url' => $GLOBALS['app_url'].'/img/blank_profile_pic.jpg',
                'square_customer_id' => $CustomerId
            );


            $id = $players_factory->insert($player);
            $player['id'] = $id ;

            $_SESSION['player'] = $player;
            echo json_encode($player);

        } else {
            echo json_encode(false);
        }

        die();
    break;


    case 'password' :

        $player = $players_factory->emailExist($_POST['signin_email']);

        if (!$player) {
            echo 'Désolé, nous n’avons pas pu retrouver votre adresse courriel dans notre liste d’utilisateurs actifs. Veuillez utiliser une autre adresse courriel, ou inscrivez-vous à nouveau.';
        } else {

            $email_template = get_template('mail-reset', array(
                'email' => $player['email'],
                'token' => MD5($player['email'].$player['password'])
            ));


            $mail = new PHPMailer;

            $mail->Charset = 'UTF-8';
            $mail->setFrom($GLOBALS['app_email'], $GLOBALS['app_name']);
            $mail->addAddress($player['email'], $player['firstname']);
            $mail->isHTML(true);

            $mail->Subject = 'Réinitialisation de votre mot de passe';
            $mail->Body    = $email_template;

            if(!$mail->send()) {
                echo 'Le message n`a pas pu être envoyé. Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo '
                <p>Merci, un courriel vous a été envoyé. Si vous ne l’avez pas encore, attendez quelques minutes et assurez-vous de vérifier votre dossier de courrier indésirable. Vous pouvez aussi ajouter l’adresse info@verslesetoiles.org dans votre liste de contact.<p>
                <p>Lorsque vous aurez reçu le courriel, vous pourrez ensuite suivre le lien dans le message afin de réinitialiser votre mot de passe.</p>
                ';
            }

        }

        die();
    break;


    case 'reset' :
        $player = $players_factory->emailExist($_POST['email']);

        $token = MD5($player['email'].$player['password']);

        if ($token == $_POST['token']) {

            $player = array(
                'id' => $player['id'],
                'password' => password_hash($_POST['reset_password'], PASSWORD_DEFAULT)
            );

            $players_factory->update($player);


            $_SESSION['message'] = array(
                'type' => 'success',
                'body' => 'Votre nouveau mot de passe a été enregistré, vous pouvez vous connecter!'
            );

            echo json_encode(true);

        } else {
            
            echo json_encode(false);
        }

        die();


    break;


    case 'google' :

            $client = new Google_Client();
            $client->setApplicationName($GLOBALS['app_name']);
            $client->setClientId(GOOGLE_CLIENT_ID);
            $client->setClientSecret(GOOGLE_CLIENT_SECRET);
            $client->setRedirectUri(GOOGLE_REDIRECT_URI);
            $client->setApprovalPrompt(GOOGLE_APPROVAL_PROMPT);
            $client->setAccessType(GOOGLE_ACCESS_TYPE);
            $oauth2 = new Google_Oauth2Service($client);

            if (isset($_GET['code'])) {
                $client->authenticate($_GET['code']);
                $_SESSION['token'] = $client->getAccessToken();
            }
            if (isset($_SESSION['token'])) {
                $client->setAccessToken($_SESSION['token']);
            }
            if (isset($_REQUEST['error'])) {
                var_dump($_REQUEST['error']);
                die();
            }
            if (!$client->getAccessToken()) {
                $authUrl = $client->createAuthUrl();
                header('Location: '.$authUrl);

            } else {

                $google_user = $oauth2->userinfo->get();

                if (!$players_factory->emailExist($google_user['email'])) {
                    //L'Email n'existe pas, je doit créer un player

                    $CustomerId = createCustomerInSquare($google_user['email']);

                    $player = array(
                        'email' => strtolower($google_user['email']),
                        'password' => password_hash(MD5(uniqid()), PASSWORD_DEFAULT),
                        'uid' => 'google-'.$google_user['id'],
                        'firstname' => $google_user['given_name'],
                        'lastname' => $google_user['family_name'],
                        'picture_url' => $google_user['picture'],
                        'date_lastlogin' => $date->format('Y-m-d H:i:s'),
                        'birthday' => '1998-01-01 00:00:00',
                        'gender' => strtoupper($google_user['gender'][0]),
                        'square_customer_id' => $CustomerId
                    );

                    $id = $players_factory->insert($player);
                    $player['id'] = $id;

                } else {
                    //Le email existe, alors je load le player
                    $player = $players_factory->emailExist($google_user['email']);
                }

                if ($player['locked'] == '1'){
    
                    $_SESSION['message'] = array(
                        'type' => 'danger',
                        'body' => 'Désolé, votre compte a été verrouillé, contactez un administrateur.'
                    );

                    header('Location: /inscriptions/home#');
                    die();
                }

                $players_factory->update(array(
                    'id' => $player['id'],
                    'date_lastlogin' => $date->format('Y-m-d H:i:s')
                ));

                $_SESSION['player'] = $player;
                header('Location: /inscriptions/home#');
                die();

            
            }


    break;


    case 'facebook' :

        $fb = new Facebook\Facebook([
            'app_id' => facebook_app_id,
            'app_secret' => facebook_app_secret,
            'default_graph_version' => facebook_default_graph_version,
        ]);

        $helper = $fb->getRedirectLoginHelper();

        try {
            $accessToken = $helper->getAccessToken();
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        if (! isset($accessToken)) {
            if ($helper->getError()) {
                header('HTTP/1.0 401 Unauthorized');
                echo "Error: " . $helper->getError() . "\n";
                echo "Error Code: " . $helper->getErrorCode() . "\n";
                echo "Error Reason: " . $helper->getErrorReason() . "\n";
                echo "Error Description: " . $helper->getErrorDescription() . "\n";
            } else {
                header('HTTP/1.0 400 Bad Request');
                echo 'Bad request';
            }
            exit;
        }

        // The OAuth 2.0 client handler helps us manage access tokens
        $oAuth2Client = $fb->getOAuth2Client();

        // Get the access token metadata from /debug_token
        $tokenMetadata = $oAuth2Client->debugToken($accessToken);

        // Validation (these will throw FacebookSDKException's when they fail)
        $tokenMetadata->validateAppId(facebook_app_id); 
        
        // If you know the user ID this access token belongs to, you can validate it here
        //$tokenMetadata->validateUserId('123');
        $tokenMetadata->validateExpiration();

        if (!$accessToken->isLongLived()) {
            // Exchanges a short-lived access token for a long-lived one
            try {
            $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
            echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
            //exit;
            }

            echo '<h3>Long-lived</h3>';
            var_dump($accessToken->getValue());
        }


        try {
            // Returns a `Facebook\FacebookResponse` object
            $response = $fb->get('/me?fields=id,name,first_name,last_name,email', $accessToken->getValue());
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        $facebook_user = $response->getGraphUser();


        if (!$players_factory->emailExist($facebook_user['email'])) {
            //L'Email n'existe pas, je doit créer un player

            $CustomerId = createCustomerInSquare($facebook_user['email']);

            $player = array(
                'email' => strtolower($facebook_user['email']),
                'password' => password_hash(MD5(uniqid()), PASSWORD_DEFAULT),
                'uid' => 'facebook-'.$facebook_user['id'],
                'firstname' => $facebook_user['first_name'],
                'lastname' => $facebook_user['last_name'],
                'picture_url' => 'https://graph.facebook.com/'.$facebook_user['id'].'/picture?type=large',
                'date_lastlogin' => $date->format('Y-m-d H:i:s'),
                'birthday' => '1998-01-01 00:00:00',
                'gender' => 'M',
                'square_customer_id' => $CustomerId
            );

            $id = $players_factory->insert($player);
            $player['id'] = $id;

        } else {
            //Le email existe, alors je load le player
            $player = $players_factory->emailExist($facebook_user['email']);
        }


        if ($player['locked'] == '1'){

            $_SESSION['message'] = array(
                'type' => 'danger',
                'body' => 'Désolé, votre compte a été verrouillé, contactez un administrateur.'
            );

            header('Location: /inscriptions/home#');
            die();
        }

        $players_factory->update(array(
            'id' => $player['id'],
            'date_lastlogin' => $date->format('Y-m-d H:i:s')
        ));

        $_SESSION['player'] = $player;
        header('Location: /inscriptions/home#');
        die();


    break;

}