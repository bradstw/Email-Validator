<?php


# Include the Autoloader (see "Libraries" for install instructions)
require 'vendor/autoload.php';
use Mailgun\Mailgun;


//email passed in
$email = $_REQUEST['email'];

if ($email == '') {
	echo 'error:001';
}

# Instantiate the client.
$mgClient = new Mailgun('pubkey-68a707a4571e0e52f2b8ab885f118182');

$validateAddress = $email;

# Issue the call to the client.
$result = $mgClient->get("address/validate", array('address' => $validateAddress));
# is_valid is 0 or 1
$isValid = $result->http_response_body->is_valid;


// Setting variable from returned array
// Variables from response_body
$rbody = $result->http_response_body;
$e_address = $rbody->address;
$c_address = $rbody->did_you_mean;
$valid = $rbody->is_valid;

// Variables from response_body->Parts
$display_name = $rbody->parts->display_name;
$domain = $rbody->parts->domain;
$local_part = $rbody->parts->local_part;

// Returned codes
$return_code = $result->http_response_code;



echo '<pre>';
print_r($result);
echo '</pre>';



?>