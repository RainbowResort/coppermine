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
        global $CONFIG, $THEME_DIR, $USER, $CAT_LIST;
            try {
                $result = $this->verify('access');

                if ($result != null) {
                    define('API_CALL', true);
                    $superCage = Inspekt::makeSuperCage();
                    $matches = $superCage->post->getMatched('function', '/^[a-z]+$/');
                    switch ($matches[0]) {
                        case 'upload':
                            require 'db_input.php';
                            break;
                        case 'alblist': // Same functions for alblist and piclist                           
                        case 'piclist':
                            define('IN_COPPERMINE', true);
                            require 'include/init.inc.php';
                            pub_user_albums();
                            upload_form_alb_list('', '');
                            break;
                        case 'search':
                            define('IN_COPPERMINE', true);
                            require 'include/init.inc.php';
                            //echo "Testing";
                            //
                            require 'thumbnails.php';
                            break;
                        case 'catlist':
                            define('IN_COPPERMINE', true);
                            require 'include/init.inc.php';                            
                            api_cat_list();
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

function api_message($message) {
    die("<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n" . '<api_message>' . $message . '</api_message>');	
}

/**
 * function api_cat_list()
 *
 * Geta hierarchical list of categories, in XML
 *
 */
function api_cat_list() {
    global $CONFIG, $CAT_LIST;
    $superCage = Inspekt::makeSuperCage();
    $cat = 0;
    if ($superCage->post->getInt('catid')) {
        $cat = $superCage->post->getInt('catid'); 
    }
    get_subcategory_data($cat);
    echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n";
    echo "<cat_list>\n";     
    $catlevels = array();                       
    // Loop through the category list and store the parent of each one in an array
    foreach ($CAT_LIST as $category) {
        // get_subcategory_data() prints '&nbsp;' three times for each level of depth of categories
        $catlevels[] = substr_count($category['name'], 'nbsp;') / 3;
    }
                                                        
    // Loop through again, printing out the list of categories
    $count = 0; // The iteration of the loop
    $level = 0; // How many levels deep in the hierarchy a category is
    $indent2 = ''; // The spacing for closing tags
    foreach ($CAT_LIST as $category) {
        $level = $catlevels[$count];
        $indent = '';
        for ($i = 0; $i < $level; $i++) {
            $indent .= ' ';
        }

        $previous = $catlevels[$count - 1];
        $current = $catlevels[$count];                                
        if ($previous == $current && $count > 0) {
            $indent2 = substr($indent2, 1); // 1 less leading space for each closing tag in a series
            echo $indent2 . "</category>\n";
        }
                                
        else if ($previous > $current) {
            for ($j = 0; $j <= $previous - $current; $j++) {
                $indent2 = substr($indent2, 1);
                echo $indent2 . "</category>\n";
            }
        }
                                
        $name = preg_replace("/((&nbsp;){3})+/", "", $category['name']); // Clean up the name text
        echo $indent . '<category id="' . $category['cid'] . "\" name=\"" . $name . "\">\n";
        $indent2 .= ' '; // 1 more leading space for each <category> element

        $count++;
    }

    // The final (set of) closing tag(s)
    if ($count > 0) {
        for ($i = 0; $i <= $level; $i++) {
            $indent2 = substr($indent2, 1);
            echo $indent2 . "</category>\n";
        }
    }
    
    echo "</cat_list>";
}

?>