<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2008 Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.
  
  ********************************************
  Coppermine version: 1.5.0
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**********************************************/

// define('SKIP_AUTHENTICATION', true);
// If you don't remember the admin account data you're prompted for when running this file in your browser, umcomment the line above by removing the two slashes in front of it, upload that file to your webserver, run it in your browser. After successfully having run it, remember to restore the two slashes you removed and replace the "unsecure" version on your webserver with the "secure" version (the one that contains the double slashes).

define('IN_COPPERMINE', true);
define('UPDATE_PHP', true);

if (!defined('SKIP_AUTHENTICATION')) { // try to include init.inc.php to get the "regular" coppermine user interface
    $error_reporting = error_reporting(E_ERROR); // silence all error reports but fatal ones
    ob_start(); // turn output buffering on - if including the regular coppermine files breaks, we can make sure that the output doesn't break the subsequent code
    include_once('include/init.inc.php');
    $output = ob_get_contents();
    ob_end_flush ;
    error_reporting($error_reporting); // set error reporting level back to how it used to be
    //print $output; // For troubleshooting purposes, print $output
}
session_start();
set_magic_quotes_runtime(0);

if (!function_exists('cpgGetMicroTime')) {
function cpgGetMicroTime()
{
	list($usec, $sec) = explode(" ", microtime());
	return ((float)$usec + (float)$sec);
}
}

set_include_path(get_include_path().PATH_SEPARATOR.dirname(__FILE__).PATH_SEPARATOR.dirname(__FILE__).DIRECTORY_SEPARATOR.'include');
require_once('include/Inspekt.php');
require_once('include/sql_parse.php');
require_once('include/config.inc.php');
require_once('include/functions.inc.php');



// The defaults values
$errors = '';
$notes = '';
$DFLT = array('cfg_d' => 'include', // The config file dir
	'cfg_f' => 'include/config.inc.php', // The config file name
	'alb_d' => 'albums', // The album dir
	'upl_d' => 'userpics' // The uploaded pic dir
	);
$superCage = Inspekt::makeSuperCage();

// If including includes/init.inc.php has worked as expected, the constants should be populated, so let's check that first
if (!defined('SKIP_AUTHENTICATION') && defined('COPPERMINE_VERSION') && GALLERY_ADMIN_MODE) {
    $_SESSION['auth'] = true;
} else { // we need to populate the language array "manually"
    $lang_common['ok'] = 'OK';
    $lang_update_php = array(
	  'title' => 'Updater', // cpg1.5
	  'welcome_updater' => 'Welcome to Coppermine update', // cpg1.5
	  'could_not_authenticate' => 'Could not authenticate you', // cpg1.5
	  'provide_admin_account' => 'Please provide your coppermine admin account details or your mySQL account data', // cpg1.5
	  'try_again' => 'Try again', // cpg1.5
	  'mysql_connect_error' => 'Could not create a mySQL connection', // cpg1.5
	  'mysql_database_error' => 'mySQL could not locate a database called %s', // cpg1.5
	  'mysql_said' => 'MySQL said', // cpg1.5
	  'check_config_file' => 'Please check the SQL values in %s', // cpg1.5
	  'performing_database_updates' => 'Performing Database Updates', // cpg1.5
	  'already_done' => 'Already Done', // cpg1.5
	  'password_encryption' => 'Encryption of passwords', // cpg1.5
	  'category_tree' => 'Category tree', // cpg1.5
	  'authentication_needed' => 'Authentication needed', // cpg1.5
	  'username' => 'Username', // cpg1.5
	  'password' => 'Password', // cpg1.5
	  'update_completed' => 'Update completed', // cpg1.5
	  'check_versions' => 'It\'s recommended to %scheck your file versions%s if you just upgraded from an older version of coppermine', // cpg1.5 // Leave the %s untouched when translating - it wraps the link
	  'start_page' => 'If you didn\'t (or you don\'t want to check), you can go to %syour gallery\'s start page%s', // cpg1.5 // Leave the %s untouched when translating - it wraps the link
	  'errors_encountered' => 'The following errors were encountered and need to be corrected first', // cpg1.5
	  'delete_file' => 'Delete %s', // cpg1.5
	  'could_not_delete' => 'Could not delete due to missing permissions. Delete the file manually!', // cpg1.5
    );
}


// ---------------------------- AUTHENTICATION --------------------------- //
// SKIP_AUTHENTICATION is a constant that can be defined for users who can't retrieve any kind of password
if (!defined('SKIP_AUTHENTICATION') && !$_SESSION['auth']){
	html_header($lang_update_php['title']);
	if(!$superCage->post->keyExists('method')){
		//first try to connect to the db to see if we can authenticate the admin
		test_sql_connection();
		if($errors != ''){
			//we could not establish an sql connection, so update can't be done (and user can't be autenticated)
			html_error($errors);
		}else{
			//print a box for admin autentication
			html_auth_box('admin');
		}
	} elseif ($superCage->post->getAlpha('method') == 'admin'){
		//try to autenticate the admin
		test_sql_connection();
		$user = $superCage->post->getEscaped('user');
		$pass = $superCage->post->getEscaped('pass');
		$pass2 = md5($pass);
		$sql = "SELECT user_active FROM {$CONFIG['TABLE_PREFIX']}users WHERE user_group = 1 AND user_name = '$user' AND (user_password = '$pass' OR user_password = '$pass2')";
		$result = @mysql_query($sql);
		if(!@mysql_num_rows($result)) {
			//not authenticated, try mysql account details
			html_auth_box('MySQL');
		} else {
			//authenticated, do the update
			$_SESSION['auth'] = true;
			start_update();
		}
	} else {
		//try to autenticate via MySQL details (in configuration)
		if($superCage->post->getEscaped('user')  == $CONFIG['dbuser'] && $superCage->post->getEscaped('pass') == $CONFIG['dbpass']){
			//authenticated, do the update
			$_SESSION['auth'] = true;
			start_update();
		}else{
			//no go, try again
			html_error($lang_update_php['could_not_authenticate'] . ' -  <a href="update.php">' . $lang_update_php['try_again'] .'</a>');
		}
	}
	html_footer();
} else {
	html_header($lang_update_php['title']);
    $_SESSION['auth'] = true;
	start_update();
    html_footer();
}

// function definitions --- start
// ------------------------- HTML OUTPUT FUNCTIONS ------------------------- //

function html_header($title, $charset = 'iso8859-1')
{
    if (function_exists('pageheader') && defined('COPPERMINE_VERSION') && GALLERY_ADMIN_MODE) {
        pageheader($title);
    } else {
        echo <<< EOT
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <title>{$title}</title>
    <meta http-equiv="Content-Type" content="text/html; charset={$charset}" />
    <meta http-equiv="Pragma" content="no-cache" />
    <link type="text/css" rel="stylesheet" href="installer.css">
</head>
<body>
<img class="logo" src="images/coppermine-logo.png" border="0" alt="" />
EOT;
    }
}

function html_error($error_msg = '')
{
    global $lang_update_php;

    print <<< EOT
      <table width="100%" border="0" cellpadding="0" cellspacing="1" class="maintable">
       <tr>
        <td class="tableh1" colspan="2"><h2>{$lang_update_php['welcome_updater']}</h2>
        </td>
       </tr>
EOT;
    if ($error_msg) {
        print <<< EOT
       <tr>
        <td class="tableh2" colspan="2" align="center"><span class="error">&#149;&nbsp;&#149;&nbsp;&#149;&nbsp;ERROR&nbsp;&#149;&nbsp;&#149;&nbsp;&#149;</span>
        </td>
       </tr>
       <tr>
        <td class="tableh2" colspan="2">
            {$lang_update_php['errors_encountered']}:<br />
        </td>
       </tr>
       <tr>
        <td class="tableh2" colspan="2">
            {$error_msg}
        </td>
       </tr>
EOT;
    }

    print <<< EOT
       </tr>
      </table>
EOT;
}


function html_install_success($notes)
{
    global $DFLT, $lang_update_php;
    //Coppermine is now upgraded and ready to roll.
    print '&nbsp;<br />';
    print '<div class="maintable"><h2 class="tableh1">' . $lang_update_php['update_completed'] . '</h2>';
    print '<p class="tableh2">';
    printf($lang_update_php['check_versions'], '<a href="versioncheck.php">', '</a>');
    print '. ';
    printf($lang_update_php['start_page'], '<a href="index.php">', '</a>');
    print '.</p></div>';
}

function html_footer()
{
    if (function_exists('pagefooter') && defined('COPPERMINE_VERSION') && GALLERY_ADMIN_MODE) {
        pagefooter();
    } else {
        echo <<< EOT
</body>
</html>
EOT;
    }
}

function html_auth_box($method){
    global $lang_update_php, $lang_common;
    $superCage = Inspekt::makeSuperCage();
    $debug_mode = '';
    if ($superCage->get->keyExists('debug')) {
        $debug_mode = '?debug';
    }
    if (function_exists('cpg_fetch_icon')) {
    	$update_icon = cpg_fetch_icon('update_database', 2);
    	$ok_icon = cpg_fetch_icon('ok', 2);
    	$login_icon = cpg_fetch_icon('login', 2);
    	$username_icon = cpg_fetch_icon('my_profile', 2);
    	$password_icon = cpg_fetch_icon('key_enter', 2);
    } else {
    	$update_icon = '';
    	$ok_icon = '';
    	$login_icon = '';
    	$username_icon = '';
    	$password_icon = '';
    }
    echo <<< EOT
	    <form name="cpgform" id="cpgform" method="post" action="update.php{$debug_mode}">
	    <table border="0" cellspacing="0" cellpadding="0" class="maintable">
		    <tr>
		    	<td class="tableh1" colspan="2">
		    		<h1>{$update_icon}{$lang_update_php['welcome_updater']}</h1>
		    	</td>
		    </tr>
		    <tr>
		    	<td class="tableh2" colspan="2">
		    		<h2>{$login_icon}{$lang_update_php['authentication_needed']}</h2>
		    	</td>
		    </tr>
		    <tr>
		    	<td class="tableh2" colspan="2">
    
EOT;
		if($method=='MySQL'){
			echo $lang_update_php['could_not_authenticate']. '. <a href="update.php">' . $lang_update_php['try_again'] . '</a>';
		}else{
			echo $lang_update_php['provide_admin_account'];
		}
        echo <<< EOT
		    	</td>
		    </tr>
	        <tr>
		        <td class="tableb">
			        {$username_icon}{$lang_update_php['username']}:
		        </td>
		        <td class="tableb">
			        <input type="text" name="user" size="30" class="textinput" />
		        </td>
	        </tr>
	        <tr>
		        <td class="tableb">
			        {$password_icon}{$lang_update_php['password']}:
		        </td>
		        <td class="tableb">
			        <input type="password" name="pass" size="30" class="textinput"  />
		        </td>
	        </tr>
	        <tr>
		        <td class="tableb" colspan="2" align="center">
			        <input type="hidden" name="method" value="{$method}" />
			        <!--<input type="submit" name="submit" value="Login" class="button"  />-->
			        <button type="submit" class="button" name="submit" value="{$lang_common['ok']}">{$ok_icon}{$lang_common['ok']}</button>
		        </td>
	        </tr>
        </table>

        </form>
        <script language="javascript" type="text/javascript">
            <!--
            document.cpgform.user.focus();
            -->
        </script>
EOT;
}

// --------------------------------- MAIN CODE ----------------------------- //
function start_update(){
	global $lang_update_php;
    // The updater
	//html_header($lang_update_php['title']);
    test_sql_connection();
    if ($errors == '') {
        update_tables();
        update_system_thumbs();
    } else {
        html_error($errors);
    }
    if ($errors == '') {
        html_install_success($notes);
        session_destroy();
    } else {
        html_error($errors);
    }
	//html_footer();
}

function update_system_thumbs()
{
    global $CONFIG;

    $results = mysql_query("SELECT * FROM ".$CONFIG['TABLE_PREFIX']."config;");
    while ($row = mysql_fetch_array($results)) {
        $CONFIG[$row['name']] = $row['value'];
    } // while
    mysql_free_result($results);

    // Code to rename system thumbs in images folder (except nopic.jpg and private.jpg)
    $old_thumb_pfx = 'thumb_';

    if ($old_thumb_pfx != $CONFIG['thumb_pfx']) {
        $folders = array('images/', $THEME_DIR.'images/');
        foreach ($folders as $folder) {
            $thumbs = cpg_get_system_thumb_list($folder);
            foreach ($thumbs as $thumb) {
                @rename($folder.$thumb['filename'],
                        $folder.str_replace($old_thumb_pfx,$CONFIG['thumb_pfx'],$thumb['filename']));
            }
        }
    }


    // If old images for nopic.jpg and private.jpg exist, delete the new ones
    if (file_exists('images/nopic.jpg')) {
        @unlink('images/thumb_nopic.jpg');
    }

    if (file_exists('images/private.jpg')) {
        @unlink('images/thumb_private.jpg');
    }

    // Rename old images to new format
    @rename('images/nopic.jpg','images/'.$CONFIG['thumb_pfx'].'nopic.jpg');
    @rename('images/private.jpg','images/'.$CONFIG['thumb_pfx'].'private.jpg');
}

/**
 * Return an array containing config values specified in the array
 */
function cpg_get_config_value($config_name) {
    global $CONFIG;
    $result = mysql_query("SELECT value FROM ".$CONFIG['TABLE_PREFIX']."config WHERE name='".$config_name."' LIMIT 1");
    $row = mysql_fetch_row($result);
    return $row[0];
}

/**
 * Return an array containing the system thumbs in a directory
 */
 /*
function cpg_get_system_thumb_list($search_folder = 'images/')
{
        global $CONFIG;
        static $thumbs = array();

        $folder = 'images/';

        $thumb_pfx =& $CONFIG['thumb_pfx'];
        // If thumb array is empty get list from coppermine 'images' folder
        if ((count($thumbs) == 0) && ($folder == $search_folder)) {
                $dir = opendir($folder);
                while (($file = readdir($dir))!==false) {
                        if (is_file($folder . $file) && strpos($file,$thumb_pfx) === 0) {
                                // Store filenames in an array
                                $thumbs[] = array('filename' => $file);
                        }
                }
                closedir($dir);
                return $thumbs;
        } elseif ($folder == $search_folder) {
                // Search folder is the same as coppermine images folder; just return the array
                return $thumbs;
        } else {
                // Search folder is the different; check for files in the given folder
                $results = array();
                foreach ($thumbs as $thumb) {
                        if (is_file($search_folder.$thumb['filename'])) {
                                $results[] = array('filename' => $thumb['filename']);
                        }
                }
                return $results;
        }
}
*/
// ----------------------------- TEST FUNCTIONS ---------------------------- //
function test_sql_connection()
{
    global $errors, $CONFIG, $lang_update_php;

    if (! $connect_id = @mysql_connect($CONFIG['dbserver'], $CONFIG['dbuser'], $CONFIG['dbpass'])) {
        $errors .= '<hr />';
        $errors .= $lang_update_php['mysql_connect_error'] . '. ';
        $errors .= sprintf($lang_update_php['check_config_file'] . '. ', 'include/config.inc.php');
        $errors .= '<br />';
        $errors .= $lang_update_php['mysql_said'] . ': ' . mysql_error();
    } elseif (! mysql_select_db($CONFIG['dbname'], $connect_id)) {
        $errors .= '<hr />';
        $errors .= sprintf($lang_update_php['mysql_database_error'] . '. ', $CONFIG['dbname']);
        $errors .= sprintf($lang_update_php['check_config_file'] . '. ', 'include/config.inc.php');
    } else {
    	$CONFIG['LINK_ID'] = $connect_id;
    }
}



// ------------------------- SQL QUERIES TO CREATE TABLES ------------------ //
function update_tables()
{
    global $errors, $CONFIG, $lang_update_php, $lang_common;
	
	$lineBreak = "\n";
    $loopCounter = 0;
    $cellStyle = '';
    $superCage = Inspekt::makeSuperCage();
	$possibilities = array('REDIRECT_URL', 'PHP_SELF', 'SCRIPT_URL', 'SCRIPT_NAME','SCRIPT_FILENAME');
	foreach ($possibilities as $test){
		if ($matches = $superCage->server->getMatched($test, '/([^\/]+\.php)$/')) {
			$CPG_PHP_SELF = $matches[1];
			break;
		}
	}
    //$CPG_PHP_SELF = $_SERVER['PHP_SELF'];
    $gallery_dir = strtr(dirname($CPG_PHP_SELF), '\\', '/');
    //$gallery_url_prefix = 'http://' . $_SERVER['HTTP_HOST'] . $gallery_dir . (substr($gallery_dir, -1) == '/' ? '' : '/');
	$gallery_url_prefix = 'http://' . $superCage->server->getRaw('HTTP_HOST') . $gallery_dir . (substr($gallery_dir, -1) == '/' ? '' : '/');

    $db_update = 'sql/update.sql';
    $sql_query = fread(fopen($db_update, 'r'), filesize($db_update));
    // Update table prefix
    $sql_query = preg_replace('/CPG_/', $CONFIG['TABLE_PREFIX'], $sql_query);

    $sql_query = remove_remarks($sql_query);
    $sql_query = split_sql_file($sql_query, ';');
    if (function_exists('cpg_fetch_icon')) {
    	$update_icon = cpg_fetch_icon('update_database', 2);
    	$ok_icon = cpg_fetch_icon('ok', 2);
    	$already_done_icon = cpg_fetch_icon('info', 2);
    	$error_icon = cpg_fetch_icon('stop', 2);
        $file_system_icon = cpg_fetch_icon('hdd', 2);
    } else {
    	$update_icon = '';
    	$ok_icon = '';
    	$already_done_icon = '';
    	$error_icon = '';
        $file_system_icon = '';
    }

    print <<< EOT
        <table border="0" cellspacing="0" cellpadding="0" class="maintable">
            <tr>
                <td class="tableh1" colspan="2">
                    {$update_icon}{$lang_update_php['performing_database_updates']}
                </td>
            </tr>

EOT;

    foreach($sql_query as $q) {
        if ($loopCounter/2 == floor($loopCounter/2)) {
            $cellStyle = 'tableb';
        } else {
            $cellStyle = 'tableb tableb_alternate';
        }
        $loopCounter++;
        echo '<tr><td width="80%" class="'.$cellStyle.'">'.$q;
        /**
         * Determining if the Alter Table actually made a change
         * to properly reflect it's status on the update page.
         */
        if (strpos(strtolower($q),'alter table')!==false) {
            $query=explode(" ",$q);
            //var_dump($query);
            $result=mysql_query("DESCRIBE ".$query[2]);
            while ($row=mysql_fetch_row($result)) {
                $description[]=$row;
            }

            $result = @mysql_query($q);
            $affected = mysql_affected_rows();
            $warnings=mysql_query('SHOW WARNINGS');

            $result=mysql_query("DESCRIBE ".$query[2]);
            while ($row=mysql_fetch_row($result)) {
                $description2[]=$row;
            }

            if ($description == $description2) {
               $affected = 0;
            }
        } else {
            $result = @mysql_query($q);
            $affected = mysql_affected_rows();
            $warnings = mysql_query('SHOW WARNINGS;');
        }
		if ($superCage->get->keyExists('debug')) {
            echo '<hr />Debug output:<br />';
            if ($affected > -1) {
                echo "Rows Affected: ".$affected.". ";
            }
            if ($warnings) {
                while ($warning = mysql_fetch_row($warnings)) {
                    if ($warning[0] != '') {
                        $warning_text = 'MySQL said: ';
                    } else {
                        $warning_text = '';
                    }
                    echo $warning_text.'<tt class="code">'.$warning[0]. ' ('.$warning[1].') '.$warning[2].'</tt><br />';
                }
            }
        }
        print '</td>'.$lineBreak; // end the table cell that contains the output
        if ($result && $affected) {
            echo '<td width="20%" class="'.$cellStyle.' updatesOK">' . $ok_icon . $lang_common['ok'] . '</td>'.$lineBreak;
        } else {
            echo '<td width="20%" class="'.$cellStyle.' updatesFail">' . $already_done_icon . $lang_update_php['already_done'] . '</td>'.$lineBreak;
        }
    } // end foreach loop
    
    // Check password encryption and perform the conversion if applicable
    if ($loopCounter/2 == floor($loopCounter/2)) {
        $cellStyle = 'tableb';
    } else {
        $cellStyle = 'tableb tableb_alternate';
    }
    $loopCounter++;
        print <<< EOT
            <tr>
                <td class="{$cellStyle}">
                    {$lang_update_php['password_encryption']}:
                </td>
EOT;
    $CONFIG['enable_encrypted_passwords'] = cpg_get_config_value('enable_encrypted_passwords');
    if ($CONFIG['enable_encrypted_passwords'] != 1) {
        print <<< EOT
                <td class="{$cellStyle} updatesOK">
                    {$ok_icon}{$lang_common['ok']}
                </td>
            </tr>
EOT;
        $result = mysql_query("update {$CONFIG['TABLE_PREFIX']}users set user_password=md5(user_password);");
        if ($CONFIG['enable_encrypted_passwords'] == 0) {
            $result = mysql_query("update {$CONFIG['TABLE_PREFIX']}config set value = 1 WHERE name = 'enable_encrypted_passwords'");
        } else {
            $result = mysql_query("INSERT INTO {$CONFIG['TABLE_PREFIX']}config ( `name` , `value` ) VALUES ('enable_encrypted_passwords', '1')");
        }
    } else {
        print <<< EOT
                <td class="{$cellStyle} updatesFail">
                    {$already_done_icon}{$lang_update_php['already_done']}
                </td>
            </tr>
EOT;
    }
    
    // Check category tree modifications 
    if ($loopCounter/2 == floor($loopCounter/2)) {
        $cellStyle = 'tableb';
    } else {
        $cellStyle = 'tableb tableb_alternate';
    }
    $loopCounter++;
    print <<< EOT
            <tr>
                <td class="{$cellStyle}">
                    {$lang_update_php['category_tree']}:
                </td>
EOT;
    
    if (check_rebuild_tree()) {
    
        print <<< EOT
                <td class="{$cellStyle} updatesOK">
                    {$ok_icon}{$lang_common['ok']}
                </td>
            </tr>
EOT;
    } else {
        print <<< EOT
                <td class="{$cellStyle} updatesFail">
                    {$already_done_icon}{$lang_update_php['already_done']}
                </td>
            </tr>
EOT;
    }
    
    // Attempt to delete outdated files
    $delete_file_array = array(
    'config.php',
    'editOnePic.php',
    'faq.php',
    'picEditor.php',
    'relocate_server.php',
    'scripts.js',
    'bridge/phpbb22.inc.php',
    'docs/COPYING',
    'docs/faq.htm',
    'docs/faq_de.htm',
    'docs/faq_fr.htm',
    'docs/index_es.htm',
    'docs/index_fr.htm',
    'docs/README.html',
    'docs/showdoc.php',
    'docs/tester-README.txt',
    'docs/theme.htm',
    'docs/translation.htm',
    'docs/pics/',
    'docs/theme/',
    'include/config.tmp.php',
    'include/imageObjectGD.class.php',
    'include/imageObjectIM.class.php',
    );
    
	    print <<< EOT
            <tr>
                <td class="tableh1" colspan="2">
                    {$file_system_icon}{$lang_update_php['performing_file_updates']}
                </td>
            </tr>
EOT;
    // Check if the file exists in the first place
    foreach ($delete_file_array as $delete_file) {
	    if ($loopCounter/2 == floor($loopCounter/2)) {
	        $cellStyle = 'tableb';
	    } else {
	        $cellStyle = 'tableb tableb_alternate';
	    }
	    $delete_output = sprintf($lang_update_php['delete_file'], '&laquo;<tt>'.$delete_file.'</tt>&raquo;');
	    print <<< EOT
            <tr>
                <td class="{$cellStyle}">
                    {$delete_output}
                </td>
EOT;
	    if (file_exists($delete_file) == FALSE){
	    	$result_output = $already_done_icon . $lang_update_php['already_done'];
	    } else {
	    	$delete_result = unlink($delete_file);
	    	$delete_check = file_exists($delete_file);
	    	if ($delete_result == TRUE && $delete_check == FALSE) {
	    		$result_output = $ok_icon . $lang_common['ok'];
	    	} else {
	    		$result_output = $error_icon . $lang_update_php['could_not_delete'];
	    	}
	    }
	    print <<< EOT
                <td class="{$cellStyle}">
                    {$result_output}
                </td>
            </tr>
EOT;
	    $loopCounter++;
    }
    
    
    echo "</table>";
}
// function definitions --- end
?>