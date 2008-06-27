<?php
// Users "authorize" a request token here.  This first involves logging in to a Coppermine account.  An application "consuming" the API should direct users here once they have received a request token.

define('IN_COPPERMINE', true);
require_once 'cpgOAuth.php';

$token = $superCage->get->getAlnum('oauth_token');
$authorized = $superCage->get->getAlnum('authorized');

if (!USER_ID) {
	echo 'Please <a href="../login.php?referer=oauth/authorize.php?oauth_token=' . $token . '">login</a> to your user account.';
	exit();
}

if ($token == '') {
	throw new OAuthException('No "oauth_token" provided via HTTP GET.');
}

$server = new OAuthServer();
$server->setParam('oauth_token', $token, true);
$rs = $server->authorizeVerify();

if ($authorized == 'yes') {
	$server->authorizeFinish(true, USER_ID);
	api_message('Token "' . $rs['token'] . '" authorized.');
}

else if ($authorized == 'no') {
	$server->authorizeFinish(false, USER_ID);
	api_message('Token "' . $rs['token'] . '" deleted.');
}

else {
	$store = OAuthStore::instance();
	$consumer = $store->getConsumerInfo($rs['consumer_id']);
	print 'Would you like to allow "' . $consumer[0]['application_title'] . '" to access your photos from this site?  This permission will only be granted for 24 hours.';
	print '<br /><br />';

	print '<form method="get" action="authorize.php">';
	print '<input type="hidden" name="oauth_token" id="oauth_token" value="' . $token . '" />';
	print '<input type="radio" name="authorized" id="yes" value="yes" /><label for="yes">Yes</label>';
	print '<input type="radio" name="authorized" id="no" value="no" checked="checked" /><label for="no">No</label>';
	print '<br /><br /><button type="submit">Submit</button>';
	print '</form>';
}

?>