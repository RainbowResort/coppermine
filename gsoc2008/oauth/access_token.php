<?php
// Request an OAuth access token from the server.  This can be used to access "protected resources", e.g., password-protected photos.

require_once 'cpgOAuth.php';

$matches = $superCage->post->getMatched('oauth_signature_method', '/^[\w-]+$/');

$oauth = new cpgOAuth($superCage->post->getAlnum('oauth_consumer_key'), $superCage->post->getAlnum('oauth_nonce'), $superCage->post->getInt('oauth_timestamp'), $matches[0], $superCage->post->getAlnum('oauth_signature'), $superCage->post->getAlnum('oauth_token'));

$oauth->accessToken();
?>