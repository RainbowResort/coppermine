<?php
// Confirm we are in Coppermine
define('IN_COPPERMINE', true);

require_once 'cpgOAuth.php';

$token = $superCage->get->getAlnum('oauth_token');
$authorized = $superCage->get->getAlnum('authorized');

$server = new OAuthServer();
$server->setParam('oauth_token', $token, true);
$rs = $server->authorizeVerify();

if ($authorized == 'yes' && $token != '') {
	$server->authorizeFinish(true, USER_ID);
	print 'Token "' . $rs['token'] . '" authorized.';
}

else if ($authorized == 'no' && $token != '') {
	$server->authorizeFinish(false, USER_ID);
	print 'Token "' . $rs['token'] . '" deleted.';
}

else if ($token == '') {
	print 'No "oauth_token" provided via HTTP GET';
}

else {
	$store = OAuthStore::instance();
	$consumer = $store->getConsumerInfo($rs['consumer_id']);
	print 'Would you like to allow "' . $consumer[0]['application_title'] . '" to access your photos from this site?  This permission will only be granted for (X) hours.'; // How long should "X" be?
	print '<br /><br />';

	print '<form method="get" action="authorize.php">';
	print '<input type="hidden" name="oauth_token" id="oauth_token" value="' . $token . '" />';
	print '<input type="radio" name="authorized" id="yes" value="yes" /><label for="yes">Yes</label>';
	print '<input type="radio" name="authorized" id="no" value="no" checked="checked" /><label for="no">No</label>';
	print '<br /><br /><button type="submit">Submit</button>';
	print '</form>';
}

?>