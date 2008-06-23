<?php
// Get an unauthorized request token here, to be authorized by the user and then exchanged for an access token.

require_once 'cpgOAuth.php';

$matches = $superCage->post->getMatched('oauth_signature_method', '/[\w-]+/');

$oauth = new cpgOAuth($superCage->post->getAlnum('oauth_consumer_key'), $superCage->post->getAlnum('oauth_nonce'), $superCage->post->getInt('oauth_timestamp'), $matches[0], false);

$oauth->requestToken();
?>