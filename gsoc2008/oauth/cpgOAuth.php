<?php
// The base include file for all of the Coppermine OAuth pages
// The cpgOAuth class currently approves the request without an oauth_signature (in OAuthRequestVerifier.php, ~line 128), for ease of testing.  This will probably go away with my next check-in {daorange}
chdir('../');

// Call basic functions, etc.
require('include/init.inc.php');

// Include OAuth classes
require_once 'oauth/store/OAuthStoreMySQL.php';
require_once 'oauth/OAuthServer.php';

// Connect to the database
global $CONFIG;
$options['server'] = $CONFIG['dbserver'];
$options['username'] = $CONFIG['dbuser'];
$options['password'] = $CONFIG['dbpass'];
$options['database'] = $CONFIG['dbname'];
OAuthStore::instance('MySQL', $options);

/** 
 * Object to process OAuth requests for Coppermine
 */
class cpgOAuth extends OAuthServer {
	function __construct($consumer_key, $nonce, $timestamp, $signature_method, $token) {
	// , $signature, $token) {
		$this->setParam('oauth_consumer_key', $consumer_key, true);
		$this->setParam('oauth_nonce', $nonce, true);		
		$this->setParam('oauth_timestamp', $timestamp, true);
		$this->setParam('oauth_signature_method', $signature_method, true);		
		//$this->setParam('oauth_signature', $signature, true);
		$this->setParam('oauth_token', $token, true);

		parent::__construct();
	}

	public function accessProtectedResource() {
		try
		{
			$result = $this->verify('access');

			if ($result != null) {
				echo "Protected resource accessed!";
			}
		}
		catch (OAuthException $e)
		{
			header('HTTP/1.1 401 Access Denied');
			header('Content-Type: text/xml');

			throw new OAuthException($e->getMessage());
		}
		OAuthRequestLogger::flush();
		exit();
	}
}

function xml_encoding() {
	print "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n";
}

function api_message($message) {
	die(xml_encoding() . '<api_message>' . $message . '</api_message>');	
}

?>