<?php
class cards 
{

	public function edit() {


		if (isset($_POST['nonce'])) $this->save();

		if (!isset($_POST['id_card'])) {
			return $this->getList();
		}


		$template = get_template('navbar', array('active_menu' => 'cards'));
		$template .= get_template('cards_mdf');

		return render($template);
	}

	public function save() {

		$CustomerCardApi = new \SquareConnect\Api\CustomerCardApi();

		$request_body = array (
			'card_nonce' => $_POST['nonce'],
			'cardholder_name' => $_POST['cardholder_name'],
			'billing_address' => array('postal_code' => $_POST['postal-code'])
		);

		try {
			$CustomerResponse = $CustomerCardApi->createCustomerCard(square_access_token, $_SESSION['player']['square_customer_id'], $request_body);

			$_SESSION['message'] = array(
				'type' => 'success',
				'body' => '<strong>Enregistré !</strong> La nouvelle carte a été ajoutée.'
			);

		} catch (\SquareConnect\ApiException $e) {
			/*
			echo "Caught exception!<br/>";
			print_r("<strong>Response body:</strong><br/>");
			echo "<pre>"; var_dump($e->getResponseBody()); echo "</pre>";
			echo "<br/><strong>Response headers:</strong><br/>";
			echo "<pre>"; var_dump($e->getResponseHeaders()); echo "</pre>";
			*/

			$_SESSION['message'] = array(
				'type' => 'danger',
				'body' => '<strong>Désolé !</strong> La carte de crédit n\'a pas peu être créé. <br>' . var_export($e->getResponseBody(), true)
			);

			return 'Error';
		}


		$_SESSION['message'] = array(
			'type' => 'success',
			'body' => '<strong>Enregistré !</strong> La nouvelle carte de crédit a été enregistrée.'
		);


		unset($_POST['id_card']);
	}


	public function erase() {

		$CustomerCardApi = new \SquareConnect\Api\CustomerCardApi();

		try {
			$CustomerResponse = $CustomerCardApi->deleteCustomerCard(square_access_token, $_SESSION['player']['square_customer_id'], $_POST['id_card']);

		} catch (\SquareConnect\ApiException $e) {
			/*
			echo "Caught exception!<br/>";
			print_r("<strong>Response body:</strong><br/>");
			echo "<pre>"; var_dump($e->getResponseBody()); echo "</pre>";
			echo "<br/><strong>Response headers:</strong><br/>";
			echo "<pre>"; var_dump($e->getResponseHeaders()); echo "</pre>";
			*/

			$_SESSION['message'] = array(
				'type' => 'danger',
				'body' => '<strong>Désolé !</strong> La carte de crédit n\'a pas peu être supprimé. <br>' . var_export($e->getResponseBody(), true)
			);

			return 'Error';
		}
	

		$_SESSION['message'] = array(
			'type' => 'success',
			'body' => '<strong>Supprimer !</strong> La carte de crédit a été supprimé.'
		);

		return 'Ok';

	}

	public function getAll() {
		return $this->getPlayerList( $_SESSION['player']['square_customer_id'] );
	}

	public function getPlayerList($square_customer_id) {
		$customer_api = new \SquareConnect\Api\CustomerApi();

		try {
			$CustomerResponse = $customer_api->retrieveCustomer(square_access_token, $square_customer_id);
		} catch (\SquareConnect\ApiException $e) {

			$_SESSION['message'] = array(
				'type' => 'danger',
				'body' => '<strong>Désolé !</strong> Nous avons été incapable de récupérer la liste des cartes de crédit. <br>' . var_export($e->getResponseBody(), true)
			);

			return array();
		}

		return $CustomerResponse->getCustomer()->getCards();
	}

	public function count() {
		return count($this->getAll());
	}

	public function getList() {
	
		$template = get_template('navbar', array('active_menu' => 'cards'));
		$template .= get_template('cards_lst', array('cardsList' => $this->getAll()));

		return render($template);

	}


}