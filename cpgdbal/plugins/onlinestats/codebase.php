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
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/trunk/cpg1.5.x/plugins/onlinestats/codebase.php $
  $Revision: 5129 $
  $LastChangedBy: gaugau $
  $Date: 2008-10-18 16:03:12 +0530 (Sat, 18 Oct 2008) $
**********************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');
if (!defined('CORE_PLUGIN')) {
	define('CORE_PLUGIN', true);
}

// Add plugin_install action
$thisplugin->add_action('plugin_install','online_install');

// Add page_start action
$thisplugin->add_action('page_start','online_page_start');

// Add plugin_uninstall action
$thisplugin->add_action('plugin_uninstall','online_uninstall');

// Add plugin_cleanup action
$thisplugin->add_action('plugin_cleanup','online_cleanup');

// Add search display action
$thisplugin->add_filter('plugin_block','online_mainpage');

// Add a configure action
$thisplugin->add_action('plugin_configure','online_configure');


function online_configure() {
        global $lang_plugin_php, $CONFIG, $lang_common;
        $superCage = Inspekt::makeSuperCage();
        $action = $superCage->server->getEscaped('REQUEST_URI');
        print <<< EOT
    
    <form action="{$action}" method="post">
	    <table border="0" cellspacing="0" cellpadding="0" width="100%">
	        <tr>
		        <td class="tableb">
			        {$lang_plugin_php['onlinestats_config_text']}
		        </td>
		        <td class="tableb">
			        <input size="2" type="text" name="duration" value="10" class="textinput" />
			        {$lang_plugin_php['onlinestats_minute']}
		        </td>
		        <td class="tableb">
			        <input type="submit" name="submit" value="{$lang_common['go']}" class="button" />
		        </td>
	        </tr>
	    </table>
    </form>
EOT;
}

/*function online_page_start()
{
		global $raw_ip, $CONFIG;

		$CONFIG['TABLE_ONLINE'] = $CONFIG['TABLE_PREFIX']."mod_online";

		$user_id = USER_ID;
		$user_name = USER_NAME;

		if (defined('LOGIN_PHP')){
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_ONLINE']} WHERE user_id = 0 AND user_ip = '$raw_ip'");
				return;
		}

		if (defined('LOGOUT_PHP')){
				cpg_db_query("DELETE FROM {$CONFIG['TABLE_ONLINE']} WHERE user_id = $user_id");
				return;
		}

		cpg_db_query("DELETE FROM {$CONFIG['TABLE_ONLINE']} WHERE last_action < NOW() - INTERVAL {$CONFIG['mod_updates_duration']} MINUTE");



		if ($user_id) {
				cpg_db_query("REPLACE INTO {$CONFIG['TABLE_ONLINE']} (user_id, user_name, user_ip, last_action) VALUES ('$user_id', '$user_name', '$raw_ip', NOW())");

		} else{
				$testarray = explode('.',$raw_ip);
				$teststr = $testarray[0] . '.' . $testarray[1];
				$sel = cpg_db_query("SELECT user_ip FROM {$CONFIG['TABLE_ONLINE']} WHERE user_ip LIKE '$teststr%'");
				$res = mysql_fetch_row($sel);
				$result = $res[0];

				if (mysql_num_rows($sel)){
						cpg_db_query("UPDATE {$CONFIG['TABLE_ONLINE']} SET last_action = NOW() WHERE user_ip = '$result' LIMIT 1");
				} else {
						cpg_db_query("INSERT INTO {$CONFIG['TABLE_ONLINE']} (user_id, user_name, user_ip, last_action) VALUES ('$user_id', '$user_name', '$raw_ip', NOW())");
				}
		}
}	*/
#####################      DB      ######################	
function online_page_start()
{
		global $raw_ip, $CONFIG, $cpg_db_onlinestats;
		$cpgdb =& cpgDB::getInstance();
		$cpgdb->connect_to_existing($CONFIG['LINK_ID']);

		$CONFIG['TABLE_ONLINE'] = $CONFIG['TABLE_PREFIX']."mod_online";

		$user_id = USER_ID;
		$user_name = USER_NAME;

		if (defined('LOGIN_PHP')){
				$cpgdb->query($cpg_db_onlinestats['login_delete_online'], $raw_ip);
				return;
		}

		if (defined('LOGOUT_PHP')){
				$cpgdb->query($cpg_db_onlinestats['logout_delete_online'], $user_id);
				return;
		}

		$cpgdb->query($cpg_db_onlinestats['lastact_delete_online'], $CONFIG['mod_updates_duration']);

		if ($user_id) {	// REPLACE INTO altered
				$cpgdb->query($cpg_db_onlinestats['online_delete_values'], $user_id, $raw_ip);
				$cpgdb->query($cpg_db_onlinestats['online_insert_values'], $user_id, $user_name, $raw_ip);

		} else{
				$testarray = explode('.',$raw_ip);
				$teststr = $testarray[0] . '.' . $testarray[1];
				$sel = $cpgdb->query($cpg_db_onlinestats['get_online_user_ip'], $teststr."%");
				$rowset = $cpgdb->fetchRowSet();
				$res = $rowset[0];
				$result = $res['user_ip'];

				if (count($rowset)){
						$cpgdb->query($cpg_db_onlinestats['lastact_update_online'], $result);
				} else {
						$cpgdb->query($cpg_db_onlinestats['online_insert_values'], $user_id, $user_name, $raw_ip);
				}
		}
}
##################################################	

function online_mainpage()
{
		global $CONFIG, $cpg_udb, $matches, $lang_plugin_php, $lastcom_date_fmt, $cpg_db_onlinestats;
		###################        DB       #################
		$cpgdb =& cpgDB::getInstance();
		$cpgdb->connect_to_existing($CONFIG['LINK_ID']);
		############################################
		if($matches[1] != 'onlinestats') {
			return $matches;
		}
		
		$num_users = $cpg_udb->get_user_count();

		/*$result = cpg_db_query("SELECT COUNT(*) FROM {$CONFIG['TABLE_ONLINE']}");
		list($num_online) = mysql_fetch_row($result);

		$result = cpg_db_query("SELECT COUNT(*) FROM {$CONFIG['TABLE_ONLINE']} WHERE user_id <> 0");
		list($num_reg_online) = mysql_fetch_row($result);

		$result = cpg_db_query("SELECT {$cpg_udb->field['user_id']} AS user_id, {$cpg_udb->field['username']} AS user_name FROM {$cpg_udb->usertable} ORDER BY user_id DESC LIMIT 1", $cpg_udb->link_id);
		$newest = mysql_fetch_assoc($result);

		$result = cpg_db_query("SELECT user_id, user_name FROM {$CONFIG['TABLE_ONLINE']} WHERE user_id <> 0");

		$logged_in_array = array();

		while ($row = mysql_fetch_row($result)) {
				$logged_in_array[] = vsprintf('<a href="profile.php?uid=%d">%s</a>', $row);
		}	*/
		##################################           DB        #################################
		$result = $cpgdb->query($cpg_db_onlinestats['count_num_online']);
		list($num_online) = $cpgdb->fetchRow();

		$result = $cpgdb->query($cpg_db_onlinestats['count_num_reg_online']);
		list($num_reg_online) = $cpgdb->fetchRow();

		$result = $cpgudb->query($cpg_db_onlinestats['get_user'], $cpg_udb->field['user_id'], 
								$cpg_udb->field['username'], $cpg_udb->usertable);
		$newest = $cpgdb->fetchRow();

		$result = $cpgdb->query($cpg_db_onlinestats['online_get_user']);

		$logged_in_array = array();

		while ($row = $cpgdb->fetchRow()) {
				$logged_in_array[] = vsprintf('<a href="profile.php?uid=%d">%s</a>', $row);
		}
		############################################################################

		$logged_in_names = implode(', ', array_unique($logged_in_array));

		$num_guests = $num_online - $num_reg_online;

		// most users online - TND
		if ($num_online > $CONFIG['record_online_users'])
		{
				$CONFIG['record_online_date'] = localised_date(-1, $lang_plugin_onlinestats_date_fmt);
				$CONFIG['record_online_users'] = $num_online;

				/*$result = cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$num_online' WHERE name = 'record_online_users'");
				$result = cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = UNIX_TIMESTAMP() WHERE name = 'record_online_date'");	*/
				############################           DB          ###########################
				$result = $cpgdb->query($cpg_db_onlinestats['mainpage_record_online_users'], $num_online);
				$result = $cpgdb->query($cpg_db_onlinestats['mainpage_record_online_date']);
				##################################################################
		}

       starttable("100%", cpg_fetch_icon('online', 2) . $lang_plugin_php['onlinestats_name']);
        print '<tr><td class="tableb">';
        if ($num_users == 1) {
	        printf($lang_plugin_php['onlinestats_we_have_reg_member'], '<strong>'.$num_users.'</strong>');
        } else {
	        printf($lang_plugin_php['onlinestats_we_have_reg_members'], '<strong>'.$num_users.'</strong>');
        }
        print ".&nbsp;\r\n";
        printf($lang_plugin_php['onlinestats_most_recent'], '<a href="profile.php?uid='.$newest['user_id'].'">'.$newest['user_name'].'</a>');
        print ".&nbsp;\r\n";
        if ($num_online == 1) {
	        printf($lang_plugin_php['onlinestats_is'], '<strong>'.$num_online.'</strong>');
        } else {
	        printf($lang_plugin_php['onlinestats_are'], '<strong>'.$num_online.'</strong>');
        }
        print ': ';
        if ($num_reg_online == 1) {
	        printf($lang_plugin_php['onlinestats_reg_member'], '<strong>'.$num_reg_online.'</strong>');
        } else {
	        printf($lang_plugin_php['onlinestats_reg_members'], '<strong>'.$num_reg_online.'</strong>');
        }
        print ' '.$lang_plugin_php['onlinestats_and'].' ';
        if ($num_guests == 1) {
	        printf($lang_plugin_php['onlinestats_guest'], '<strong>'.$num_guests.'</strong>');
        } else {
	        printf($lang_plugin_php['onlinestats_guests'], '<strong>'.$num_guests.'</strong>');
        }
        print ".&nbsp;\r\n";
        printf($lang_plugin_php['onlinestats_record'], '<strong>'.$CONFIG['record_online_users'].'</strong>', localised_date($CONFIG['record_online_date'], $lastcom_date_fmt));
        print ".&nbsp;\r\n";
        printf($lang_plugin_php['onlinestats_since'], $CONFIG['mod_updates_duration'], $logged_in_names);
        print '.</td></tr>';
        endtable();
        print '<br />';
}

// Install
function online_install() {
		global $CONFIG, $thisplugin, $cpg_db_onlinestats;
		###################        DB       #################
		$cpgdb =& cpgDB::getInstance();
		$cpgdb->connect_to_existing($CONFIG['LINK_ID']);
		############################################
		$superCage = Inspekt::makeSuperCage();

		if ($superCage->post->keyExists('duration')) {
				require 'include/sql_parse.php';
				$duration = $superCage->post->getInt('duration');

				// create table
				$db_schema = $thisplugin->fullpath . '/'.$CONFIG['dbservername'].'/schema.sql';
				$sql_query = fread(fopen($db_schema, 'r'), filesize($db_schema));
				$sql_query = preg_replace('/CPG_/', $CONFIG['TABLE_PREFIX'], $sql_query);

				$sql_query = remove_remarks($sql_query);
				$sql_query = split_sql_file($sql_query, ';');
				/*$sql_query[] = "INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (name, value) VALUES ('mod_updates_duration', '{$duration}')";

				foreach($sql_query as $q) cpg_db_query($q);	*/
				##############################        DB      ###########################
				$cpgdb->query($cpg_db_onlinestats['get_mod_updates_duration']);
				if (count($cpgdb->fetchRowSet()) == 0) {
					$sql_query[] = sprintf($cpg_db_onlinestats['add_mod_updates_duration'], $duration);
					foreach ($sql_query as $q) $cpgdb->query($q);
				}
				##################################################################
				
				// Add the string "onlinestats" to "the content of the main page" if it doesn't exist
				if (strpos($CONFIG['main_page_layout'], 'onlinestats') === FALSE) {
					$contentOfTheMainpage = rtrim($CONFIG['main_page_layout'], '/').'/onlinestats';
					//cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$contentOfTheMainpage' WHERE name = 'main_page_layout'"); 
					###############################        DB       ##############################
					$cpgdb->query($cpg_db_onlinestats['set_main_page_layout'], $contentOfTheMainpage);
					#####################################################################
				}

		   return true;
		} else {
				return 1;
		}
}

// Uninstall (drop?)
function online_uninstall() {
		global $CONFIG, $cpg_db_onlinestats;
		###################        DB       #################
		$cpgdb =& cpgDB::getInstance();
		$cpgdb->connect_to_existing($CONFIG['LINK_ID']);
		############################################
		$superCage = Inspekt::makeSuperCage();

		if ($superCage->post->keyExists('drop')) {
		} else {
			return 1;
		}

		// Drop the tables
		if ($superCage->post->keyExists('drop')) {
			/*cpg_db_query("DROP TABLE IF EXISTS {$CONFIG['TABLE_ONLINE']}");
			cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'mod_updates_duration'");
			cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'record_online_users'");
			cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'record_online_date'");	*/
			###########################        DB       #########################
			$cpgdb->query($cpg_db_onlinestats['drop_online']);
			$cpgdb->query($cpg_db_onlinestats['del_mod_updates_duration']);
			$cpgdb->query($cpg_db_onlinestats['del_record_online_users']);
			$cpgdb->query($cpg_db_onlinestats['del_record_online_data']);
			############################################################
		}
        
		// Remove the string "onlinestats" from the config option "content of the main page"
		$contentOfTheMainpage = str_replace('/onlinestats', '', $CONFIG['main_page_layout']);
		$contentOfTheMainpage = str_replace('onlinestats/', '', $contentOfTheMainpage);
		$contentOfTheMainpage = str_replace('onlinestats', '', $contentOfTheMainpage);
		//cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$contentOfTheMainpage' WHERE name = 'main_page_layout'");
		#############################           DB        ############################
		$cpgdb->query($cpg_db_onlinestats['reset_main_page_layout'], $contentOfTheMainpage);
		###################################################################

		return true;
}

// Ask if we want to drop the table
function online_cleanup($action) {
	global $lang_plugin_php, $CONFIG, $lang_common;
	$superCage = Inspekt::makeSuperCage();
	$cleanup = $superCage->server->getEscaped('REQUEST_URI');
    if ($action===1) {
    print <<< EOT
    <form action="{$cleanup}" method="post">
	    <table border="0" cellspacing="0" cellpadding="0">
	        <tr>
	            <td class="tableb">
		            {$lang_plugin_php['onlinestats_remove']}
	            </td>
		        <td class="tableb">
			        <input type="radio" name="drop" id="drop_yes" value="1" />
			        <label for="drop_yes" class="clickable_option">{$lang_common['yes']}</label>
		        </td>
		        <td class="tableb">
			        <input type="radio" name="drop" id="drop_no" checked="checked" value="0" />
			        <label for="drop_no" class="clickable_option">{$lang_common['no']}</label>
		        </td>
		        <td class="tableb">
			        <input type="submit" name="submit" value="{$lang_common['go']}" class="button" />
		        </td>
	        </tr>
	    </table>
    </form>
EOT;
    }
}
?>