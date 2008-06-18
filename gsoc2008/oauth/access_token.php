<?php
// Confirm we are in Coppermine
define('IN_COPPERMINE', true);

require_once 'cpgOAuth.php';

$matches = $superCage->post->getMatched('oauth_signature_method', '/[\w-]+/');

$oauth = new cpgOAuth($superCage->post->getAlnum('oauth_consumer_key'), $superCage->post->getAlnum('oauth_nonce'), $superCage->post->getInt('oauth_timestamp'), $matches[0], $superCage->post->getAlnum('oauth_token'));

$oauth->checkRequest('request');

$oauth->accessToken();
?>
