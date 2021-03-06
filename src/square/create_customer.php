<?php

require('connect-php-sdk/autoload.php');


$location_id = 'CBASEJUrj3bfWmCFo87mD33DyKkgAQ';
$access_token = 'sandbox-sq0atb-TswDh3iGpRqWZNH7WbQLZA';

$customer_api = new \SquareConnect\Api\CustomerApi();


$request_body = array (
	'given_name' => 'Miguel',
	'family_name' => 'Boulette',
	'email_address' => 'sombre_23@hotmail.com',
	'reference_id' => '1',
);

# The SDK throws an exception if a Connect endpoint responds with anything besides
# a 200-level HTTP code. This block catches any exceptions that occur from the request.
try {
  $result = $customer_api->createCustomer($access_token, $request_body);
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

