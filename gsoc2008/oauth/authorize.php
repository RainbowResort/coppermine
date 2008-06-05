<?php
// Confirm we are in Coppermine
define('IN_COPPERMINE', true);

require_once 'cpgOAuth.php';

if ($superCage->get->keyExists('oauth_token')) {
	$token = $superCage->get->getAlnum('oauth_token');	
	$server = new OAuthServer();
	$server->setParam('oauth_token', $token, true);
	$server->authorizeVerify();
	$server->authorizeFinish(true, USER_ID);
	echo 'Token "' . $token . '" authorized.';
}

else {
	die('No "oauth_token" from HTTP GET.');
}

/*
	echo <<<EOT
	<form method="get" action="authorize.php">
	<input type="text" name="oauth_token"
	</form>
	<p>Authorize the above token?</p>
}
*/
?>