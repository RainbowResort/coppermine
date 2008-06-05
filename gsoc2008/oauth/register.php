<?php
// Confirm we are in Coppermine
define('IN_COPPERMINE', true);

require_once 'cpgOAuth.php';

global $superCage;
$store = OAuthStore::instance();
$consumer['requester_name'] = $superCage->post->getRaw('requester_name');
$consumer['requester_email'] = $superCage->post->getRaw('requester_email');
$consumer['application_title'] = $superCage->post->getRaw('application_title');

// Register the consumer in the database and print out the resulting consumer key
echo '<?xml version="1.0" encoding="ISO-8859-1"?><consumer_key>' . $store->updateConsumer($consumer, USER_ID, true) . '</consumer_key>';
?>