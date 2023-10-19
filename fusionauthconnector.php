<?php
require __DIR__. '/config.php';
require __DIR__. '/common.php';
require __DIR__ . '/vendor/autoload.php';

use Ramsey\Uuid\Uuid;

$headers = getallheaders();
if (!$headers) {
  error_log("Invalid authorization header.");
  return;
}

// check auth header
$authorization_value = $headers['Authorization'];
if ($authorization_value !== $authorization_header_value) {
  error_log("Invalid authorization header value found: ".$authorization_value);
  return;
}

$input = file_get_contents('php://input');

$inputobj = json_decode($input);
if (!$inputobj) {
  error_log("Invalid JSON");
  return;
}

// for debugging the data passed to us
// error_log(var_export($input, TRUE));

if (!auth($inputobj->loginId, $inputobj->password)) {
  http_response_code(404);
  return;
}

// build the user object
// in the real world, we'd pull this from the database.
$obj = [];
$user = [];

$user['id'] = Uuid::uuid4();
$user['email'] = $inputobj->loginId;
$user['active'] = true;
$user['verified'] = true;

$data = [];
$data['favoriteColor'] = 'blue';
$data['migratedFromTheAtmDatastore'] = true;
$user['data'] = $data;

$registrations = [];
$registration = [];
$registration['applicationId'] = $client_id;
array_push($registrations, $registration);

$user['registrations'] = $registrations;

$obj['user'] = $user;

echo json_encode($obj);
?>
