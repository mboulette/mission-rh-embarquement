<?php

require('connect-php-sdk/autoload.php');


$access_token = 'sandbox-sq0atb-TswDh3iGpRqWZNH7WbQLZA';

$LocationApi = new \SquareConnect\Api\LocationApi();


# The SDK throws an exception if a Connect endpoint responds with anything besides
# a 200-level HTTP code. This block catches any exceptions that occur from the request.
try {
  $result = $LocationApi->listLocations($access_token);
  echo "<pre>";
  //print_r($result->getCustomers()[0]->getId());
  print_r($result);
  echo "</pre>";
} catch (\SquareConnect\ApiException $e) {
  echo "Caught exception!<br/>";
  print_r("<strong>Response body:</strong><br/>");
  echo "<pre>"; var_dump($e->getResponseBody()); echo "</pre>";
  echo "<br/><strong>Response headers:</strong><br/>";
  echo "<pre>"; var_dump($e->getResponseHeaders()); echo "</pre>";
}
