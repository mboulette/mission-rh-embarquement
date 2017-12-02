<?php
class events extends dataObject 
{

	function __construct() {

		parent::__construct('events');

	}


	public function register() {
		if (isset($_POST['save'])) $this->save();

		if (!isset($_POST['id_event'])) {
			return $this->getList();
		}

		$current_event = $this->getOne($_POST['id_event']);
		$current_event['isRegistered'] = $this->isRegistered($_POST['id_event']);
        $current_event['credits'] = json_decode($current_event['credits'], true);

		$characters_factory = new characters();
		$characters_lst = $characters_factory->getPlayerList($_SESSION['player']['id']);

        $credits = 0;
        $lastKilled = $characters_factory->lastKilled($_SESSION['player']['id']);
        if (count($lastKilled) > 0) {
            if ($lastKilled[0]['dead'] == 1) $credits = 15;
            if ($lastKilled[0]['dead'] > 1) $credits = 10;
        }

		$options_factory = new eventOptions();
		$options_lst = $options_factory->getAll('name');
        $options_cat = $options_factory->getOptionsCategories();

		$cards_factory = new cards();
		$cards_lst = $cards_factory->getAll();

        $ressources_factory = new ressources();
        $ressources_lst = $ressources_factory->getOrderedList('name');

		$template = get_template('navbar', array('active_menu' => 'events'));

		if (is_null($cards_lst) || empty($characters_lst)) {

	        $inscriptions_factory = new inscriptions();

	        $step_template = get_template('step', array(
	        	'profile_completed' => ($_SESSION['player']['completed'] != 0),
				'character_completed' => ($characters_factory->count($_SESSION['player']['id']) > 0),
				'creditcard_completed' => (count($cards_lst) > 0),
				'player_has_registrations' => ($inscriptions_factory->playerHasRegistrations($_SESSION['player']['id']) > 0),
	        ));


			$template .= get_template('event_lock', array(
				'current' => $current_event,
				'step' => $step_template,
			));

		} else {

			$template .= get_template('event_reg', array(
				'current' => $current_event,
				'characters_lst' => $characters_lst,
				'options_lst' => $options_lst,
				'cards_lst' => $cards_lst,
                'categories' => $options_cat,
                'ressources_lst' => $ressources_lst,
                'levels' => $ressources_factory->getLevels(),
                'credits' => $credits,
			));
		}

		return render($template);

	}

	public function getList() {

		$events_list = $this->getAll('inscription_begin');
		foreach ($events_list as &$event) {
			$event['nbInscription'] = $this->nbInscription($event['id']);
			$event['isActive'] = $this->isActive($event);
			$event['isRegistered'] = $this->isRegistered($event['id']);
            $event['nbInscriptionCorpo'] = $this->nbInscriptionCorpo($event['id']);
		}
		
		$template = get_template('navbar', array('active_menu' => 'events'));
		$template .= get_template('events_lst', array('eventsList' => $events_list));

		return render($template);

	}

	public function isActive($event) {
		$date_now = new DateTime('now');
		$inscription_begin = new DateTime($event['inscription_begin']);
		$inscription_end = new DateTime($event['inscription_end']);
		$date_event = new DateTime($event['date_event']);

		if ($date_now < $inscription_begin) return 'Bientôt'; //trop tôt
		if ($event['max_places'] <= $this->nbInscription($event['id'])) return 'Complet'; // Complet
		if ($date_now > $inscription_end) return 'Trop tard'; //trop tard
		if ($date_now > $date_event) return 'Terminé'; //terminé

		return 'Ouvert';

	}

	public function currentlyOpen() {
        $sql = '
        SELECT *
        FROM '.$this->objectName.'
        WHERE "'.date("Y-m-d H:i:s").'" > inscription_begin AND "'.date("Y-m-d H:i:s").'" < inscription_end	
        ORDER BY inscription_begin DESC
        LIMIT 1
        ';

        $stmt = $this->db->prepare($sql);

        $stmt->execute();
        $result = $stmt->get_result();
        $array = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();

        return $array[0];

	}

    public function nbInscriptionCorpo($id) {

        $inscription_factory = new inscriptions();

        return $inscription_factory->countByCorpo($id);
    }

	public function nbInscription($id) {

		$inscription_factory = new inscriptions();

		return $inscription_factory->count($id);
	}

	public function isRegistered($id_event) {

		$inscription_factory = new inscriptions();
		return $inscription_factory->playerIsRegistered($id_event, $_SESSION['player']['id']);

	}

	public function save() {
		$current_event = $this->getOne($_POST['id_event']);
        $amount = 0;

		$options = array();
        $options_factory = new eventOptions();
        $options_lst = $options_factory->getAll();

        $ressources = array();
        $ressources_factory = new ressources();
        $ressources_lst = $ressources_factory->getAll();
		
		foreach ($options_lst as $option) {

			$key = $option['id'];
			
			if (isset($_POST['qty'][$key]) && $_POST['qty'][$key] > 0) {

				$options[$key] = array(
					'qty' => (integer)$_POST['qty'][$key],
					'price' => $option['price'],
					'name' => $option['name'],
				);

				$options[$key]['total'] = $options[$key]['qty'] * $options[$key]['price'];
				$amount += $options[$key]['total'];

				foreach ($_POST['options'] as $name => $precision) {
					if (isset($precision[$key]) && $precision[$key] != '') {
						$options[$key][$name] = $precision[$key];
					}
				}
			}
		}

        foreach ($ressources_lst as $ressource) {

            $key = $ressource['id'];
            
            if (isset($_POST['qty_ressource'][$key]) && $_POST['qty_ressource'][$key] > 0) {

                $ressources[$key] = array(
                    'qty' => (integer)$_POST['qty_ressource'][$key],
                    'name' => $ressource['name'],
                );
            }
        }


		$inscription_factory = new inscriptions();
		$inscription = array(
			'id' => 0,
			'id_event' => $_POST['id_event'],
			'id_player' => $_SESSION['player']['id'],
			'id_character' => $_POST['id_character'], 
			'options' => json_encode($options),
			'ressources' => json_encode($ressources),
			'amount' => $amount,
            'credits' => $_POST['credits'],
		);


		$transaction_api = new \SquareConnect\Api\TransactionApi();
		$request_body = array (
			"customer_id" => $_SESSION['player']['square_customer_id'],
			"customer_card_id" => $_POST['id_card'],
			"amount_money" => array (
				"amount" => $amount*100,
				"currency" => "CAD"
			),
			"idempotency_key" => uniqid()
		);

		try {
			$result = $transaction_api->charge(square_access_token, square_location_id, $request_body);

			$_SESSION['message'] = array(
				'type' => 'success',
				'body' => '<strong>Réussi !</strong> Vous êtes inscrit à l`évènement «'.$current_event['name'].'».<br />Vous allez recevoir bientôt, par courriel, les détails de votre inscription.'
			);

		} catch (\SquareConnect\ApiException $e) {

			$_SESSION['message'] = array(
				'type' => 'danger',
				'body' => '<strong>Désolé !</strong> Impossible d`exécuter la transaction par carte de crédit. <br>' . var_export($e->getResponseBody(), true)
			);

			return false;
		}

		$inscription['id_transaction'] = $result->getTransaction()->getId();


		$id = $inscription_factory->insert($inscription);

		$character_factory = new characters();
        $character = $character_factory->getOne($_POST['id_character']);
        if ($character['rank'] == 0) {
            $character_factory->update(array('id' => $_POST['id_character'], 'rank' => 1));
        }
        
        $player_factory = new players();
        if (isset($_POST['qty']['6']) && $_POST['qty']['6'] > 0) {
           $player_factory->update(array('id' => $_SESSION['player']['id'], 'combinaison' => 1));
           $_SESSION['player']['combinaison'] = 1; 
        }

        $this->sendInscriptionEmail($id, $current_event);

		unset($_POST['id_event']);
		return true;
	}


	public function sendInscriptionEmail($id_inscription, $event) {

		$inscription_factory = new inscriptions();
		$inscription = $inscription_factory->getOne($id_inscription);

		$characters_factory = new characters();
		$character = $characters_factory->getOne($inscription['id_character']);


		$email_template = get_template('mail-inscription', array('inscription' => $inscription, 'event' => $event, 'character' => $character));

        $mail = new PHPMailer;

        $mail->Charset = 'UTF-8';
        $mail->setFrom($GLOBALS['app_email'], $GLOBALS['app_name']);
        $mail->addAddress($_SESSION['player']['email'], $_SESSION['player']['firstname'].' '. $_SESSION['player']['lastname']);
        $mail->addAddress($GLOBALS['app_email'], $GLOBALS['app_name']);
        $mail->isHTML(true);

        $mail->Subject = 'Détails de votre inscription - '. $_SESSION['player']['firstname'].' '. $_SESSION['player']['lastname'];
        $mail->Body    = $email_template;

        if(!$mail->send()) {
			$_SESSION['message'] = array(
				'type' => 'warning',
				'body' => '<strong>Attention!</strong> Vous êtes inscrit à l`évènement «'.$current_event['name'].'».<br /> Mais le courriel n`a pas été acheminé, contactez les administrateurs.<br />'.$mail->ErrorInfo
			);
        }


	}




//****************************************************************************************************
    //** ADMIN
    //****************************************************************************************************

    public function getAdminList() {
        
        if (isset($_POST['submitaction']) && $_POST['submitaction'] == 'save') {
            $this->adminSave();
        }

        $list = $this->getAll();

		foreach ($list as &$event) {
			$event['nbInscription'] = $this->nbInscription($event['id']);
			$event['isActive'] = $this->isActive($event);
		}

        $columns = array(
            'Date' => 'date_event',
            'Nom' => 'name',
            'Synopsis' => 'synopsis',
            'État' => 'isActive',
            'Places' => 'max_places',
            'Inscription' => 'inscription_begin',
        );

        $orderby = 'date_event';
        $orderdir = 'asc';
        if (isset($_POST['orderby'])) $orderby = $_POST['orderby'];
        if (isset($_POST['orderdir'])) $orderdir = ($_POST['orderdir'] == 'desc' ? 'asc' : 'desc');

        usort($list, function($a, $b) use ($orderby, $orderdir) {
            return ($orderdir == 'desc') ? ($b[$orderby] < $a[$orderby]) : ($a[$orderby] < $b[$orderby]);
        });


        $template = get_template('navbar', array('active_menu' => 'admin-events'));
        $template .= get_template('events_lst', array(
            'list' => $list,
            'columns' => $columns,
            'orderby' => $orderby,
            'orderdir' => $orderdir
        ), 'admin/');

        return render($template);

    }

    public function edit() {

        if (!isset($_POST['submitaction'])) {
            return $this->getAdminList();
        }

        $events = $this->getOne($_POST['id']);

        if (!is_numeric($events['id'])) {

        	$date_event = new DateTime();
			$inscription_begin = new DateTime();
			$inscription_end = new DateTime();

        	$date_event->add(new DateInterval('P1M'));
        	$inscription_begin->add(new DateInterval('P1W'));
        	$inscription_end->add(new DateInterval('P3W'));

        	$events['date_event'] = $date_event->format('Y-m-d 12:00');
        	$events['inscription_begin'] = $inscription_begin->format('Y-m-d 12:00');
        	$events['inscription_end'] = $inscription_end->format('Y-m-d 12:00');

        } 

        if ($events['credits'] == '') $events['credits'] = '{}';
        $events['credits'] = json_decode($events['credits'], true);

        $corporations = new corporations();
        $corporations = $corporations->getOrderedList('name');

        $template = get_template('navbar', array('active_menu' => 'admin-events'));
        $template .= get_template('events_mdf', array(
            'events' => $events,
            'corporations' => $corporations
        ), 'admin/');

        return render($template);

    }

    public function erase() {

        $this->deleteOne($_POST['id']);
        return 'Ok';
    }

    public function adminSave() {


        $events = array(
            'id' => $_POST['id_events'],
            'name' => $_POST['name'],
            'synopsis' => $_POST['synopsis'],
            'link' => $_POST['link'],
            'max_places' => $_POST['max_places'],
            'inscription_begin' => $_POST['inscription_begin'],
            'inscription_end' => $_POST['inscription_end'],
            'credits' => json_encode($_POST['credits']),
            'date_event' => $_POST['date_event'],
        );

        if (is_numeric($events['id'])) {
            $this->update($events);

            $_SESSION['message'] = array(
                'type' => 'success',
                'body' => '<strong>Enregistré !</strong> Les modifications de l`évènement ont été enregistrés.'
            );

        } else {
            $id = $this->insert($events);

            $_SESSION['message'] = array(
                'type' => 'success',
                'body' => '<strong>Enregistré !</strong> Le nouvel évènement a été enregistré.'
            );

        }

        return;

    }

    public function search_array($array, $colomn, $value) {

		$results = array_search($value, array_column($array, $colomn));
        return $array[$results];
    }

    public function downloadListExcel() {

		$event = $this->getOne($_POST['id']);

		$inscription_factory = new inscriptions();
		$list = $inscription_factory->eventRegistrations($event['id']);

        $columns = array(
            'Évènement' => 'event_name',
            'Date-évènement' => 'event_date',
            'Code' => 'code',
            'Date-inscription' => 'inscription_date',
            'Total' => 'total',
            'Nom' => 'lastname',
            'Prénom' => 'firstname',
            'Age' => 'age',
            'Sexe' => 'gender',
            'Courriel' => 'email',
            'Personnage' => 'character_name',
            'Grade' => 'rank',
            'Corporation' => 'corporation_name',
            'Race' => 'race_name',
            'Profession' => 'profession_name',
        );

        $template .= get_template('array_xls', array(
            'columns' => $columns,
            'list' => $list,
        ), 'admin/');


		header('Content-type: application/vnd.ms-excel');
    	header('Content-disposition: attachment; filename='.$event['id'].'-inscription-'.date('Ymd').'.xls');
        return $template;

    }


    public function getAttendeesList() {

		$inscription_factory = new inscriptions();
		$list = $inscription_factory->getAllEventRegistrations();

        $columns = array(
            'Évènement' => 'event_name',
            'Date-évènement' => 'event_date',
            'Date-inscription' => 'inscription_date',
            'Joueur' => 'player_name',
            'Personnage' => 'character_name',
            'Total' => 'total',
        );


        $orderby = 'player_name';
        $orderdir = 'asc';
        if (isset($_POST['orderby'])) $orderby = $_POST['orderby'];
        if (isset($_POST['orderdir'])) $orderdir = ($_POST['orderdir'] == 'desc' ? 'asc' : 'desc');

        usort($list, function($a, $b) use ($orderby, $orderdir) {
            return ($orderdir == 'desc') ? ($b[$orderby] < $a[$orderby]) : ($a[$orderby] < $b[$orderby]);
        });


        $template = get_template('navbar', array('active_menu' => 'admin-attendees'));
        $template .= get_template('attendees_lst', array(
            'list' => $list,
            'columns' => $columns,
            'orderby' => $orderby,
            'orderdir' => $orderdir
        ), 'admin/');

        return render($template);

    }

    public function showRegistrations() {

		$event = $this->getOne($_POST['id']);

		$inscription_factory = new inscriptions();
		$list = $inscription_factory->eventRegistrations($_POST['id']);

        $columns = array(
            'Code' => 'code',
            'Date d\'inscription' => 'inscription_date',
            'Joueur' => 'player_name',
            'Personnage' => 'character_name',
            'Total' => 'total',
            'Bilan' => 'health_points',
        );

        $orderby = 'player_name';
        $orderdir = 'asc';
        if (isset($_POST['orderby'])) $orderby = $_POST['orderby'];
        if (isset($_POST['orderdir'])) $orderdir = ($_POST['orderdir'] == 'desc' ? 'asc' : 'desc');

        usort($list, function($a, $b) use ($orderby, $orderdir) {
            return ($orderdir == 'desc') ? ($b[$orderby] < $a[$orderby]) : ($a[$orderby] < $b[$orderby]);
        });


        $template = get_template('navbar', array('active_menu' => 'admin-attendees'));
        $template .= get_template('events_reg_lst', array(
            'event' => $event,
            'list' => $list,
            'columns' => $columns,
            'orderby' => $orderby,
            'orderdir' => $orderdir
        ), 'admin/');

        return render($template);

    }

    public function displayAttendees() {

        if (!isset($_POST['id'])) {
            return $this->getAttendeesList();
        }

        $inscription_factory = new inscriptions();
        $inscription = $inscription_factory->getOne($_POST['id']);

        $event = $this->getOne($inscription['id_event']);

        $player_factory = new players();
        $player = $player_factory->getOne($inscription['id_player']);

        $character_factory = new characters();
        $character = $character_factory->getOne($inscription['id_character']);

        $inscriptions = $inscription_factory->getList(array(
            'id_character' => $inscription['id_character'],
            'id_event' => $inscription['id_event'],
        ));

        $skills_factory = new skills();
        $character['skill'] = $skills_factory->getOne($character['id_skill']);

        $feats_factory = new feats();
        $feats_lst = $feats_factory->getAll();

        $tmp_feats = json_decode($character['feats'], true);
        $character['feats'] = [];
        foreach ($feats_lst as $feat) {
            if ( in_array($feat['id'], $tmp_feats) ) {
                $character['feats'][] = $feat;
            }
        }

        $template = get_template('navbar', array('active_menu' => 'admin-attendees'));
        $template .= get_template('attendees_see', array(
            'event' => $event,
            'inscription' => $inscription,
            'player' => $player,
            'character' => $character,
            'inscriptions' => $inscriptions,
        ), 'admin/');

        return render($template);

    }

    public function printAttendees() {

        if (!isset($_POST['id'])) {
            return $this->getAttendeesList();
        }

        $event = $this->getOne($_POST['id']);
        $inscription_factory = new inscriptions();
        $inscriptions = $inscription_factory->eventRegistrations($_POST['id']);

        $player_factory = new players();
        $character_factory = new characters();

        foreach ($inscriptions as &$inscription) {

            $inscription['inscription'] = $inscription_factory->getOne($inscription['id']);
            $inscription['player'] = $player_factory->getOne($inscription['inscription']['id_player']);
            $inscription['character'] = $character_factory->getOne($inscription['inscription']['id_character']);
            $inscription['details'] = $inscription_factory->getList(array(
                'id_character' => $inscription['inscription']['id_character'],
                'id_event' => $event['id'],
            ));
        }


        $template .= get_template('attendees_prnt', array(
            'event' => $event,
            'inscriptions' => $inscriptions,
        ), 'admin/');

        return $template;

    }

}