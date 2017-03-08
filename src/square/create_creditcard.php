<?php

require('connect-php-sdk/autoload.php');


$location_id = 'CBASEJUrj3bfWmCFo87mD33DyKkgAQ';
$access_token = 'sandbox-sq0atb-TswDh3iGpRqWZNH7WbQLZA';


$customer_id = 'CBASENuPWYsgBBMyZYvC8dVf4IsgAQ';
$nonce = 'CBASECMY-TvqLFl1xFYtAZ5wzZQgAQ';

$CustomerCardApi = new \SquareConnect\Api\CustomerCardApi();


$request_body = array (
	'card_nonce' => $nonce,
	'cardholder_name' => 'Miguel Boulette',
	'billing_address' => array('postal_code' => '94103')
);

# The SDK throws an exception if a Connect endpoint responds with anything besides
# a 200-level HTTP code. This block catches any exceptions that occur from the request.
try {
  $result = $CustomerCardApi->createCustomerCard($access_token, $customer_id,  $request_body);
  echo "<pre>";
  print_r($result);
  echo "</pre>";
} catch (\SquareConnect\ApiException $e) {
  echo "Caught exception!<br/>";
  print_r("<strong>Response body:</strong><br/>");
  echo "<pre>"; var_dump($e->getResponseBody()); echo "</pre>";
  echo "<br/><strong>Response headers:</strong><br/>";
  echo "<pre>"; var_dump($e->getResponseHeaders()); echo "</pre>";
}