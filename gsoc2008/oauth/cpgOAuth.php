<?php
// The base include file for all of the Coppermine OAuth pages
// The cpgOAuth class currently approves the request without an oauth_signature (in OAuthRequestVerifier.php, ~line 128), for ease of testing.  This will probably go away soon {daorange}
chdir('../');

// Include OAuth classes
require_once 'oauth/store/OAuthStoreMySQL.php';
require_once 'oauth/OAuthServer.php';

// Connect to the database
require 'include/config.inc.php';
$options['server'] = $CONFIG['dbserver'];
$options['username'] = $CONFIG['dbuser'];
$options['password'] = $CONFIG['dbpass'];
$options['database'] = $CONFIG['dbname'];
$oauth_store = OAuthStore::instance('MySQL', $options);

// Inspekt
set_include_path('include/');
require 'Inspekt.php';
$superCage = Inspekt::makeSuperCage();
set_include_path('.');

// Set USER_ID constant
$token = $superCage->post->getAlnum('oauth_token');
if (!$token) {
    $token = $superCage->get->getAlnum('oauth_token');
}

if ($token) {
    $user_id = $oauth_store->lookup_id($token);
    if ($user_id) {
        define('USER_ID', $user_id);
        define('USER_NAME', 'API');

        $group_info = $oauth_store->group_info($user_id);
        if ($group_info['can_upload']) {
            define('USER_CAN_UPLOAD_PICTURES', true);
        }
        if ($group_info['admin_access']) {
            define('GALLERY_ADMIN_MODE', true);
            define('USER_IS_ADMIN', true);
        }
    }
}
// End main code

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

    public function access_protected_resource() {
        global $CONFIG, $THEME_DIR;
            try {
                $result = $this->verify('access');

                if ($result != null) {
                    define('API_CALL', true);
                    $superCage = Inspekt::makeSuperCage();
                    $matches = $superCage->post->getMatched('function', '/^[a-z_]+$/');
                    switch ($matches[0]) {
                        case 'upload':
                            require 'db_input.php';
                            break;
                        case 'cat_list':
                            define('IN_COPPERMINE', true);
                            require 'include/init.inc.php';
                            pub_user_albums();
                            upload_form_alb_list('', '');
                            break;
                        default:
                            throw new OAuthException('No function specified via HTTP POST');
                    }
                }
            }

            catch (OAuthException $e) {
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