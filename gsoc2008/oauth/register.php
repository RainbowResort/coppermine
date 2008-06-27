<?php
// Register an application to "consume" the Coppermine API via OAuth

define('IN_COPPERMINE', TRUE);
require 'cpgOAuth.php';

$superCage = Inspekt::makeSuperCage();

// Get the consumer's information from POST - is the "/[\w ]+/" regex friendly to non-English languages?
$name = $superCage->post->getMatched('requester_name', '/[\w ]+/');
$email = $superCage->post->getMatched('requester_email', '/\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b/i'); // regex from install.php
$application = $superCage->post->getMatched('application_title', '/[\w ]+/');

$consumer = array(
	'requester_name' => $name[0],
	'requester_email' => $email[0],
	'application_title' => $application[0]
);

foreach ($consumer as $key => $value) {
	if ($value == '') {
		throw new OAuthException($key . ' is undefined in HTTP POST');
	}
}

$store = OAuthStore::instance();
// Register the consumer in the database and print out the resulting consumer key
$consumer_id = $store->updateConsumer($consumer, USER_ID, true);

// Print registration information
print xml_encoding() .
'<consumer_key>' . $consumer_id . '</consumer_key>' .
"\n<name>$name[0]</name>" .
"\n<email>$email[0]</email>" .
"\n<application>$application[0]</application>";

?>