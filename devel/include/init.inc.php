<?php
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.3.0                                            //
// ------------------------------------------------------------------------- //
// Copyright (C) 2002,2003 Gregory DEMAR                                     //
// http://www.chezgreg.net/coppermine/                                       //
// ------------------------------------------------------------------------- //
// Updated by the Coppermine Dev Team                                        //
// (http://coppermine.sf.net/team/)                                          //
// see /docs/credits.html for details                                        //
// ------------------------------------------------------------------------- //
// This program is free software; you can redistribute it and/or modify      //
// it under the terms of the GNU General Public License as published by      //
// the Free Software Foundation; either version 2 of the License, or         //
// (at your option) any later version.                                       //
// ------------------------------------------------------------------------- //
// $Id$
// ------------------------------------------------------------------------- //

define('COPPERMINE_VERSION', '1.3.0 - devel');
// User database integration
// Uncomment the applicable line if you want to use it
// define('UDB_INTEGRATION', 'phpbb');
// define('UDB_INTEGRATION', 'invisionboard');
// define('UDB_INTEGRATION', 'vbulletin23');
// define('UDB_INTEGRATION', 'vbulletin30');
// define('UDB_INTEGRATION', 'yabbse');
// define('UDB_INTEGRATION', 'smf');
// define('UDB_INTEGRATION', 'wbb21');
if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');
// Start output buffering
ob_start();
// Report all errors except E_NOTICE
// This is the default value set in php.ini
// error_reporting (E_ALL ^ E_NOTICE);
error_reporting(E_ALL);

set_magic_quotes_runtime(0);
// used for timing purpose
$query_stats = array();
$queries = array();
function cpgGetMicroTime()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}
$time_start = cpgGetMicroTime();
// Do some cleanup in GET, POST and cookie data and un-register global vars
$HTML_SUBST = array('"' => '&quot;', '<' => '&lt;', '>' => '&gt;');
if (get_magic_quotes_gpc()) {
    if (is_array($HTTP_POST_VARS)) {
        foreach ($HTTP_POST_VARS as $key => $value) {
            if (!is_array($value))
                $HTTP_POST_VARS[$key] = strtr(stripslashes($value), $HTML_SUBST);
            if (isset($$key)) unset($$key);
        }
    }

    if (is_array($HTTP_GET_VARS)) {
        foreach ($HTTP_GET_VARS as $key => $value) {
            $HTTP_GET_VARS[$key] = strtr(stripslashes($value), $HTML_SUBST);
            if (isset($$key)) unset($$key);
        }
    }

    if (is_array($HTTP_COOKIE_VARS)) {
        foreach ($HTTP_COOKIE_VARS as $key => $value) {
            if (!is_array($value))
                $HTTP_COOKIE_VARS[$key] = stripslashes($value);
            if (isset($$key)) unset($$key);
        }
    }
} else {
    if (is_array($HTTP_POST_VARS)) {
        foreach ($HTTP_POST_VARS as $key => $value) {
            if (!is_array($value))
                $HTTP_POST_VARS[$key] = strtr($value, $HTML_SUBST);
            if (isset($$key)) unset($$key);
        }
    }

    if (is_array($HTTP_GET_VARS)) {
        foreach ($HTTP_GET_VARS as $key => $value) {
            $HTTP_GET_VARS[$key] = strtr($value, $HTML_SUBST);
            if (isset($$key)) unset($$key);
        }
    }

    if (is_array($HTTP_COOKIE_VARS)) {
        foreach ($HTTP_COOKIE_VARS as $key => $value) {
            if (isset($$key)) unset($$key);
        }
    }
}
// Initialise the $CONFIG array and some other variables
$CONFIG = array();
$PHP_SELF = isset($HTTP_SERVER_VARS['REDIRECT_URL']) ? $HTTP_SERVER_VARS['REDIRECT_URL'] : $HTTP_SERVER_VARS['SCRIPT_NAME'];
$REFERER = urlencode($PHP_SELF . (isset($HTTP_SERVER_VARS['QUERY_STRING']) && $HTTP_SERVER_VARS['QUERY_STRING'] ? '?' . $HTTP_SERVER_VARS['QUERY_STRING'] : ''));
$ALBUM_SET = '';
$FORBIDDEN_SET = '';
$CURRENT_CAT_NAME = '';
$CAT_LIST = '';
// Record User's IP address
$raw_ip = stripslashes($HTTP_SERVER_VARS['REMOTE_ADDR']);

if (isset($HTTP_SERVER_VARS['HTTP_CLIENT_IP'])) {
    $hdr_ip = stripslashes($HTTP_SERVER_VARS['HTTP_CLIENT_IP']);
} else {
    if (isset($HTTP_SERVER_VARS['HTTP_X_FORWARDED_FOR'])) {
        $hdr_ip = stripslashes($HTTP_SERVER_VARS['HTTP_X_FORWARDED_FOR']);
    } else {
        $hdr_ip = $raw_ip;
    }
}
// Define some constants
define('USER_GAL_CAT', 1);
define('FIRST_USER_CAT', 10000);
define('RANDPOS_MAX_PIC', 200);
define('TEMPLATE_FILE', 'template.html');
// Constants used by the cpg_die function
define('INFORMATION', 1);
define('ERROR', 2);
define('CRITICAL_ERROR', 3);

// Include config and functions files
if(file_exists('include/config.inc.php')){
  require 'include/config.inc.php';
} else {
  // error handling: if the config file doesn't exist go to install
  print <<< EOT
<html>
    <head>
      <title>Coppermine not installed yet</title>
      <meta http-equiv="refresh" content="100;url=install.php">
      <style type="text/css">
      <!--
      body { font-size: 12px; background: #FFFFFF; margin: 20%; color: black; font-family: verdana, arial, helvetica, sans-serif;}
      -->
      </style>
    </head>
    <body>
      <img src="images/coppermine_logo.png" alt="Coppermine Photo Gallery - Your Online Photo Gallery" /><br />
      Coppermine Photo Gallery seems not to be installed correctly, or you're running coppermine for the first time. You'll be redirected to the installer. If your browser doesn't support redirect, click <a href="install.php">here</a>.
    </body>
</html>
EOT;
  die();
}
require 'include/functions.inc.php';

$CONFIG['TABLE_PICTURES']        = $CONFIG['TABLE_PREFIX']."pictures";
$CONFIG['TABLE_ALBUMS']                = $CONFIG['TABLE_PREFIX']."albums";
$CONFIG['TABLE_COMMENTS']        = $CONFIG['TABLE_PREFIX']."comments";
$CONFIG['TABLE_CATEGORIES']        = $CONFIG['TABLE_PREFIX']."categories";
$CONFIG['TABLE_CONFIG']                = $CONFIG['TABLE_PREFIX']."config";
$CONFIG['TABLE_USERGROUPS']        = $CONFIG['TABLE_PREFIX']."usergroups";
$CONFIG['TABLE_VOTES']                = $CONFIG['TABLE_PREFIX']."votes";
$CONFIG['TABLE_USERS']                = $CONFIG['TABLE_PREFIX']."users";
$CONFIG['TABLE_BANNED']                = $CONFIG['TABLE_PREFIX']."banned";
$CONFIG['TABLE_EXIF']                = $CONFIG['TABLE_PREFIX']."exif";
$CONFIG['TABLE_FILETYPES']          = $CONFIG['TABLE_PREFIX']."filetypes";
$CONFIG['TABLE_ECARDS']          = $CONFIG['TABLE_PREFIX']."ecards";
$CONFIG['TABLE_TEMPDATA']        = $CONFIG['TABLE_PREFIX']."temp_data";

// User DB system
if (defined('UDB_INTEGRATION')) require 'bridge/' . UDB_INTEGRATION . '.inc.php';
// Connect to database
cpg_db_connect() || die("<b>Coppermine critical error</b>:<br />Unable to connect to database !<br /><br />MySQL said: <b>" . mysql_error() . "</b>");
// Retrieve DB stored configuration
$results = db_query("SELECT * FROM {$CONFIG['TABLE_CONFIG']}");
while ($row = mysql_fetch_array($results)) {
    $CONFIG[$row['name']] = $row['value'];
} // while
mysql_free_result($results);

require 'include/media.functions.inc.php';

// Parse cookie stored user profile
user_get_profile();
// Authenticate
if (defined('UDB_INTEGRATION')) {
    udb_authenticate();
} else {
    if (!isset($HTTP_COOKIE_VARS[$CONFIG['cookie_name'] . '_uid']) || !isset($HTTP_COOKIE_VARS[$CONFIG['cookie_name'] . '_pass'])) {
        $cookie_uid = 0;
        $cookie_pass = '*';
    } else {
        $cookie_uid = (int)$HTTP_COOKIE_VARS[$CONFIG['cookie_name'] . '_uid'];
        $cookie_pass = substr(addslashes($HTTP_COOKIE_VARS[$CONFIG['cookie_name'] . '_pass']), 0, 32);
    }

    $sql = "SELECT * " . "FROM {$CONFIG['TABLE_USERS']}, {$CONFIG['TABLE_USERGROUPS']} " . "WHERE user_group = group_id " . "AND user_id='$cookie_uid'" . "AND user_active = 'YES' " . "AND user_password != '' " . "AND BINARY MD5(user_password) = '$cookie_pass'";
    $results = db_query($sql);

    if (mysql_num_rows($results)) {
        $USER_DATA = mysql_fetch_array($results);
        //unset($USER_DATA['user_password']);
        $USER_DATA['user_password'] = '********';

        define('USER_ID', (int)$USER_DATA['user_id']);
        define('USER_NAME', $USER_DATA['user_name']);
        define('USER_GROUP', $USER_DATA['group_name']);
        define('USER_GROUP_SET', '(' . $USER_DATA['group_id'] . ($USER_DATA['user_lang'] != '' ? ',' . $USER_DATA['user_lang'] : '') . ')');
        define('USER_IS_ADMIN', (int)$USER_DATA['has_admin_access']);
        define('USER_CAN_SEND_ECARDS', (int)$USER_DATA['can_send_ecards']);
        define('USER_CAN_RATE_PICTURES', (int)$USER_DATA['can_rate_pictures']);
        define('USER_CAN_POST_COMMENTS', (int)$USER_DATA['can_post_comments']);
        define('USER_CAN_UPLOAD_PICTURES', (int)$USER_DATA['can_upload_pictures']);
        define('USER_CAN_CREATE_ALBUMS', (int)$USER_DATA['can_create_albums']);
        define('USER_UPLOAD_FORM', (int)$USER_DATA['upload_form_config']);
        define('CUSTOMIZE_UPLOAD_FORM', (int)$USER_DATA['custom_user_upload']);
        define('NUM_FILE_BOXES', (int)$USER_DATA['num_file_upload']);
        define('NUM_URI_BOXES', (int)$USER_DATA['num_URI_upload']);
        mysql_free_result($results);
    } else {
        $results = db_query("SELECT * FROM {$CONFIG['TABLE_USERGROUPS']} WHERE group_id = 3");
        if (!mysql_num_rows($results)) die('<b>Coppermine critical error</b>:<br />The group table does not contain the Anonymous group !');
        $USER_DATA = mysql_fetch_array($results);
        define('USER_ID', 0);
        define('USER_NAME', 'Anonymous');
        define('USER_GROUP', $USER_DATA['group_name']);
        define('USER_GROUP_SET', '(' . $USER_DATA['group_id'] . ')');
        define('USER_IS_ADMIN', 0);
        define('USER_CAN_SEND_ECARDS', (int)$USER_DATA['can_send_ecards']);
        define('USER_CAN_RATE_PICTURES', (int)$USER_DATA['can_rate_pictures']);
        define('USER_CAN_POST_COMMENTS', (int)$USER_DATA['can_post_comments']);
        define('USER_CAN_UPLOAD_PICTURES', (int)$USER_DATA['can_upload_pictures']);
        define('USER_CAN_CREATE_ALBUMS', 0);
        define('USER_UPLOAD_FORM', (int)$USER_DATA['upload_form_config']);
        define('CUSTOMIZE_UPLOAD_FORM', (int)$USER_DATA['custom_user_upload']);
        define('NUM_FILE_BOXES', (int)$USER_DATA['num_file_upload']);
        define('NUM_URI_BOXES', (int)$USER_DATA['num_URI_upload']);
        mysql_free_result($results);
    }
}
// Test if admin mode
$USER['am'] = isset($USER['am']) ? (int)$USER['am'] : 0;
define('GALLERY_ADMIN_MODE', USER_IS_ADMIN && $USER['am']);
define('USER_ADMIN_MODE', USER_ID && USER_CAN_CREATE_ALBUMS && $USER['am'] && !GALLERY_ADMIN_MODE);
// Set error logging level
if ($CONFIG['debug_notice']==1 && ($CONFIG['debug_mode']==1 || ($CONFIG['debug_mode']==2 && GALLERY_ADMIN_MODE ))) {
    error_reporting (E_ALL);
} else {
    error_reporting (E_ALL ^ E_NOTICE);
}


// Process theme selection if present in URI or in user profile
if (!empty($HTTP_GET_VARS['theme'])) {
    $USER['theme'] = $HTTP_GET_VARS['theme'];
}
// Load theme file
if (isset($USER['theme']) && !strstr($USER['theme'], '/') && is_dir('themes/' . $USER['theme'])) {
    $CONFIG['theme'] = strtr($USER['theme'], '$/\\:*?"\'<>|`', '____________');
} else {
    unset($USER['theme']);
}

if (!file_exists("themes/{$CONFIG['theme']}/theme.php")) $CONFIG['theme'] = 'default';
require "themes/{$CONFIG['theme']}/theme.php";
$THEME_DIR = "themes/{$CONFIG['theme']}/";
// Process language selection if present in URI or in user profile or try
// autodetection if default charset is utf-8
if (!empty($HTTP_GET_VARS['lang'])) {
    $USER['lang'] = $HTTP_GET_VARS['lang'];
}

if (isset($USER['lang']) && !strstr($USER['lang'], '/') && file_exists('lang/' . $USER['lang'] . '.php')) {
    $CONFIG['lang'] = strtr($USER['lang'], '$/\\:*?"\'<>|`', '____________');
} elseif ($CONFIG['charset'] == 'utf-8') {
    include('include/select_lang.inc.php');
    if (file_exists('lang/' . $USER['lang'] . '.php')) $CONFIG['lang'] = $USER['lang'];
} else {
    unset($USER['lang']);
}

if (!file_exists("lang/{$CONFIG['lang']}.php")) $CONFIG['lang'] = 'english';
require "lang/{$CONFIG['lang']}.php";
// See if the fav cookie is set else set it
if (isset($HTTP_COOKIE_VARS[$CONFIG['cookie_name'] . '_fav'])) {
    $FAVPICS = @unserialize(@base64_decode($HTTP_COOKIE_VARS[$CONFIG['cookie_name'] . '_fav']));
} else {
    $FAVPICS = array();
}
// load the main template
load_template();
// Remove expired bans
$now = time();
db_query("DELETE FROM {$CONFIG['TABLE_BANNED']} WHERE expiry < $now");
// Check if the user is banned
$user_id = USER_ID;
$result = db_query("SELECT * FROM {$CONFIG['TABLE_BANNED']} WHERE ip_addr='$raw_ip' OR ip_addr='$hdr_ip' OR user_id=$user_id");
if (mysql_num_rows($result)) {
    pageheader($lang_error);
    msg_box($lang_info, $lang_errors['banned']);
    pagefooter();
    exit;
}
mysql_free_result($result);
// Retrieve the "private" album set
if (!GALLERY_ADMIN_MODE && $CONFIG['allow_private_albums']) get_private_album_set();

if (!GALLERY_ADMIN_MODE && $CONFIG['offline'] && !strstr($_SERVER["SCRIPT_NAME"],'login')) {
pageheader($lang_errors['offline_title']);
msg_box($lang_errors['offline_title'], $lang_errors['offline_text']);
pagefooter();
exit;
}


?>