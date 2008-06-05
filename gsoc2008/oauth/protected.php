<?php
// Confirm we are in Coppermine
define('IN_COPPERMINE', true);

require_once 'cpgOAuth.php';

$oauth = new cpgOAuth($superCage->post->getAlnum('oauth_consumer_key'), $superCage->post->getAlnum('oauth_nonce'), $superCage->post->getInt('oauth_timestamp'), $superCage->post->getRaw('oauth_signature_method'), $superCage->post->getAlnum('oauth_token'));

$oauth->checkRequest('access');
$oauth->accessProtectedResource();

?>
