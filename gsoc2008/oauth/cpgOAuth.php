<?php

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

// This will go away once oauth_signature is treated properly.	
	function checkRequest($token_type) {
		$store = OAuthStore::instance();
		$secrets = $store->getSecretsForVerify(urldecode($this->getParam('oauth_consumer_key')), urldecode($this->getParam('oauth_token')), $token_type);
		$this->setParam('oauth_signature', $this->calculateSignature($secrets['consumer_secret'], $secrets['token_secret'], $token_type), true);
	}

	public function accessProtectedResource() {
		try
		{
			$result = $this->verify('access');
			
			/* if ($result) {
				header('HTTP/1.1 200 OK');
				header('Content-Length: '.strlen($result));
				header('Content-Type: application/x-www-form-urlencoded');				
			}*/

			if ($result != null) {
				echo "Protected resource accessed!";
			}
		}
		catch (OAuthException $e)
		{
			header('HTTP/1.1 401 Access Denied');
			header('Content-Type: text/plain');

			echo $e->getMessage();
		}
		OAuthRequestLogger::flush();
		exit();
	}	
}

?> 
