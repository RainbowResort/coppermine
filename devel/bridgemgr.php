<?php
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.4.0                                            //
// ------------------------------------------------------------------------- //
// Copyright (C) 2002-2004 Gregory DEMAR                                     //
// http://www.chezgreg.net/coppermine/                                       //
// ------------------------------------------------------------------------- //
// Updated by the Coppermine Dev Team                                        //
// see /docs/credits.html for details                                        //
// ------------------------------------------------------------------------- //
// This program is free software; you can redistribute it and/or modify      //
// it under the terms of the GNU General Public License as published by      //
// the Free Software Foundation; either version 2 of the License, or         //
// (at your option) any later version.                                       //
// ------------------------------------------------------------------------- //
// $Id$
// ------------------------------------------------------------------------- //

define('IN_COPPERMINE', true);
define('BRIDGEMGR_PHP', true);

require('include/init.inc.php');

///////////// function defintions start /////////////////////////////

function write_to_db($step) {
    global $BRIDGE,$CONFIG,$default_bridge_data,$lang_bridgemgr_php, $previous_step, $next_step;
    $error = 0;
    // do the check for plausibility of posted data
    foreach($_POST as $key => $value) { // loop through the posted data -- start
        // filter the post data that doesn't get written
        if (array_key_exists($key, $BRIDGE)) { // post data exists as db key -- start
            // do the lookups
            $options = explode(',', $default_bridge_data[$BRIDGE['short_name']][$key.'_used']);
            foreach($options as $key2) {
                $options[$key2] = trim($options[$key2], ','); // get rid of the delimiters
            }
            if ($options[0] != '') { // only continue with this loop if there really is an option to check --- start
                if ($options[0] == 'lookfor') { // check for the existance of a local file/folder --- start
                    if (file_exists($value.$options[1]) == false) {
                        $return[$key] = sprintf($lang_bridgemgr_php['error_folder_not_exist'], '<tt>'.$value.$options[1].'</tt>','<i>'.$lang_bridgemgr_php[$key].'</i>');
                    }
                } // check for the existance of a file/folder --- end
                if ($options[0] == 'cookie') { // check for the existance of a cookie --- start
                    foreach ($_COOKIE as $key2 => $value2) { // loop through the cookie global var --- start
                        //print '<br>cookie:'.$key2.', content:'.$value2."<br />\n";
                        if (strstr($key2,$value) == false) {
                            $return[$key] = sprintf($lang_bridgemgr_php['error_cookie_not_readible'], '&quot;<tt>'.$value.'</tt>*&quot;','<i>'.$lang_bridgemgr_php[$key].'</i>');
                        }
                    }  // loop through the cookie global var --- end
                } // check for the existance of a cookie --- end
                if ($options[1] == 'not_empty') { // check for empty mandatory fields --- start
                    if ($value == '') {
                        $return[$key] = sprintf($lang_bridgemgr_php['error_mandatory_field_empty'], '<i>'.$lang_bridgemgr_php[$key].'</i>');
                    }
                } // check for empty mandatory fields --- end
                if ($options[0] == 'no_trailing_slash' || $options[1] == 'no_trailing_slash' || $options[2] == 'no_trailing_slash') { // check for unneeded trailing slashes --- start
                    if ($value != rtrim($value, '/')) {
                        $return[$key] = sprintf($lang_bridgemgr_php['error_no_trailing_slash'], '<i>'.$lang_bridgemgr_php[$key].'</i>');
                    }
                } // check for unneeded traling slashes --- end
                if ($options[0] == 'trailing_slash' || $options[1] == 'trailing_slash' || $options[2] == 'trailing_slash') { // check for needed trailing slashes --- start
                    if ($value == rtrim($value, '/')) {
                        $return[$key] = sprintf($lang_bridgemgr_php['error_trailing_slash'], '<i>'.$lang_bridgemgr_php[$key].'</i>');
                    }
                } // check for needed traling slashes --- end
                //print "<hr />\n";
                //print $options[0].':'.$options[1].','.$options[2];
                //print "<hr />\n";
            } // only continue with this loop if there really is an option to check --- end
        } // post data exists as db key -- end
    } // loop through the posted data -- end


    // loop through the expected data
    //void


    // do some checking according to the step we're currently in
    switch ($step) {
    case "choose_bbs":
    if ($_POST['short_name'] == '') {
        $return['short_name'] = $lang_bridgemgr_php['error_specify_bbs'];
        $error++;
    }
    if ($_POST['short_name'] == 'custom_selector') {
        $_POST['short_name'] = $_POST['custom_filename'];
        if ($_POST['short_name'] == '') {
            $return['short_name'] = $lang_bridgemgr_php['error_no_blank_name'];
        }
        if (ereg('[^A-Za-z0-9_-]',$_POST['short_name'])) {
            $return['short_name'] = $lang_bridgemgr_php['error_no_special_chars'];
        }
    }
    // check if the bridge file actually exists
    if (file_exists('bridge/'.$_POST['short_name'].'.inc.php') == false) {
        $return['bridge_file_not_exist'] = sprintf($lang_bridgemgr_php['error_bridge_file_not_exist'],'<i>bridge/'.$_POST['short_name'].'.inc.php</i>');
    }
       break;

    case "settings_path":
    //if ($_POST['short_name'] == '') {
    //    $return['short_name'] = $lang_bridgemgr_php['error_specify_bbs'];
    //}

       break;

    case "db_group":
    //if ($_POST['use_standard_groups'] == '') {
    //    $_POST['use_standard_groups'] = 0 ;
    //}
       break;

    case "db_connect":
        if ($default_bridge_data[$BRIDGE['short_name']]['db_hostname_used'] != '') { // check the db connection --- start
            @mysql_close(); //temporarily disconnect from the coppermine database
            ob_start();
            $link = mysql_connect($_POST['db_hostname'], $_POST['db_username'], $_POST['db_password']);
            $mysql_error_output = ob_get_contents();
            ob_end_clean();
            if (!$link) {
                $return[$step] = $lang_bridgemgr_php['error_db_connect'].'<tt>'.$mysql_error_output.'</tt>';
            } elseif ($default_bridge_data[$BRIDGE['short_name']]['db_database_name_used'] != '') { // check the database
                ob_start();
                $db_selected = mysql_select_db($_POST['db_database_name'], $link);
                print mysql_error();
                $mysql_error_output = ob_get_contents();
                ob_end_clean();
                if (!$db_selected) {
                   $return['db_database_name'] = sprintf($lang_bridgemgr_php['error_db_name'], '<i>'.$_POST['db_database_name'].'</i>', '<i>'.$lang_bridgemgr_php['db_database_name'].'</i>'). ' <tt>'.$mysql_error_output.'</tt>';
                }
            }
            @mysql_close($link);
            cpg_db_connect(); // connect back to coppermine db
        } // check the db connection --- end
       break;

    case "db_tables":
        if ($default_bridge_data[$BRIDGE['short_name']]['table_prefix_used'] != '') {
            $prefix_and_table = sprintf($lang_bridgemgr_php['error_prefix_and_table'], '<i>'.$lang_bridgemgr_php['table_prefix'].'</i>');
        }
        @mysql_close(); //temporarily disconnect from the coppermine database
        $link = @mysql_connect($BRIDGE['db_hostname'], $BRIDGE['db_username'], $BRIDGE['db_password']);
        $db_selected = @mysql_select_db($BRIDGE['db_database_name'], $link);
        $loop_table_names = array ('user_table', 'session_table', 'group_table', 'group_table', 'group_relation_table', 'group_mapping_table');
        foreach ($loop_table_names as $key) { // loop through the possible tables --- start
            if ($default_bridge_data[$BRIDGE['short_name']][$key.'_used'] != '') { // check if table exists --- start
                if ($default_bridge_data[$BRIDGE['short_name']][$key.'_used'] != '') {
                    $temp_tablename = $_POST['table_prefix'].$_POST[$key];
                    $result = mysql_query('SELECT * FROM '.$temp_tablename);
                    if (!$result) {
                        $return['db_'.$key] = sprintf($lang_bridgemgr_php['error_db_table'], '<i>'.$temp_tablename.'</i>', $prefix_and_table.'<i>'.$lang_bridgemgr_php[$key].'</i>'). ' <tt>'.$mysql_error_output.'</tt>';
                    }
                    @mysql_free_result($result);
                }
            } // check if table exists --- end
        } // loop through the possible tables --- end
        @mysql_close($link);
        cpg_db_connect(); // connect back to coppermine db
       break;


    } // end switch

    // write the post data to the database
    //print_r($_POST);
    foreach($_POST as $key => $value) {
        // filter the post data that doesn't get written
        if (array_key_exists($key, $BRIDGE)) {
            if ($CONFIG['debug_mode'] != 0) { // print what actually get's written when in debug_mode
                print '<span class="explanation">Writing to database: ';
                print $key . '|' . $value;
                print '<br /></span>';
            }
            if ($return[$key] != '') {
                //print '|Error in this key';
            } else {
                cpg_db_query("UPDATE {$CONFIG['TABLE_BRIDGE']} SET value = '$value' WHERE name = '$key'");
            }
            //print '<br />';
        }
    }
    $value = $_POST['bridge_enable'];
    if ($value != '0' && $value != '1') {
        $value = $CONFIG['bridge_enable'];
    }
    cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$value' WHERE name = 'bridge_enable'");
    if ($_POST['clear_unused_db_fields'] == 1) {
        // clear all database entries that aren't actually used with the current bridge file
        // not implemented yet (not sure if necessary after all)
    }

    // ouput error messages, if any
    if (is_array($return)) {
        starttable('100%',$lang_bridgemgr_php['error_title']);
        print '<tr><td class="tableb" align="left"><ul>';
        foreach($return as $key) {
            print '<li>'.$key.'</li>';
        }
        print '</ul></td></tr>';
        print '<tr>'.$new_line;
        print '    <td class="tablef" align="center">'.$new_line;
        print '        <a href="javascript:history.back()" class="admin_menu" title="'.$lang_bridgemgr_php['back'].'" />&laquo;'.$lang_bridgemgr_php['back'].'</a>'.$new_line;
        print '    </td>'.$new_line;
        print '</tr>'.$new_line;
        endtable();
        $error = 1;
    }
    print '<br />';
    if ($error != '') {return 'error';}
}

function cpg_check_allowed_emergency_logon($timestamp,$failures = '') {
    //define the wait time (in seconds)
    $wait_time = array('0','5','10','20','30','60','120', '300', '1500', '6000');
    // make a real timestamp out of the date
    $timestamp = strtotime($timestamp);
    // if failed more than x times, the wait time will keep the same
    if ($failures > count($wait_time)) {$failures = count($wait_time);}
    //print 'Last logon:'.$timestamp.'|'.date('Y-m-d H:i:s', $timestamp);
    //print '<br>';
    $current_timestamp = time();
    //print 'Current time:'.$current_timestamp.'|'.date('Y-m-d H:i:s',$current_timestamp);
    //print '<br>';
    $allowed_timestamp = $timestamp+($wait_time[$failures]);
    //print 'Allowed logon:'.$allowed_timestamp.'|'.date('Y-m-d H:i:s', $allowed_timestamp).'|'.$wait_time[$failures];
    //print '<hr>';
    $difference = $allowed_timestamp - $current_timestamp;
    //print 'Difference in seconds:'.$difference;
    return $difference;
}

function cpg_bridge_prefill( $bridge = '', $key = '') {
global $BRIDGE,$default_bridge_data;
if ($BRIDGE[$key]) {
    return $BRIDGE[$key];
    } else {
    return $default_bridge_data[$bridge][$key.'_default'];
    }
}

function cpg_submit_button($step, $back = 'true', $columns = '3', $next = 'true')
{
global $lang_bridgemgr_php,$new_line;
$checked = '';

if ($_POST['hide_unused_fields'] != '' || $back != 'true') {
    $checked = 'checked="checked"';
}
$return = '    <tr>'.$new_line;
$return .= '        <td colspan="'.$columns.'" class="tablef" align="center">'.$new_line;
$return .= '            <table border="0" cellspacing="0" cellpadding="0" width="100%"><tr>'.$new_line;
$return .= '            <td align="left">'.$new_line;
$return .= '            <input type="Checkbox" name="hide_unused_fields" id="hide_unused_fields" value="1" class="checkbox" '.$checked.' onclick="toggleUnusedFields(this);" />'.$new_line;
$return .= '            <label for="hide_unused_fields" class="clickable_option">'.$new_line;
$return .= '            <span class="explanation">'.$new_line;
$return .= '                '.$lang_bridgemgr_php['hide_unused_fields'].$new_line;
$return .= '            </span>'.$new_line;
$return .= '            </label>'.$new_line;
$return .= '            <script type="text/javascript">';
$return .= '            <!--'.$new_line;
$return .= '            //function toggleUnusedFields(el_name) {'.$new_line;
$return .= '            //var elems = el_name.getElementsById("hide_row");'.$new_line;
$return .= '            '.$new_line;
$return .= '            '.$new_line;
$return .= '            }'.$new_line;
$return .= '            -->'.$new_line;
$return .= '            </script>'.$new_line;
$return .= '        </td>'.$new_line;
$return .= '        <td align="center">'.$new_line;
if ($back == 'true') {
    $return .= '            <input type="button" name="back" value="&laquo;'.$lang_bridgemgr_php['back'].'" class="button" onclick="javascript:history.back()" />'.$new_line;
}
if ($next != 'false') {
    $return .= '            <input type="submit" name="submit" value="'.$lang_bridgemgr_php['next'].'&raquo;" class="button" />'.$new_line;
}
$return .= '            <input type="hidden" name="step" value="'.$step.'" />'.$new_line;
$return .= '            </td>';
$return .= '                </tr></table>';
$return .= '        </td>'.$new_line;
$return .= '    </tr>'.$new_line;
return $return;
}

function remote_file_exists ($url)
{
// currently not used - will have to be looked into: we need a reliable way to check if an url exists, even if we can not use fopen, because it is disabled in php.ini
/*
   Return error codes:
   1 = Invalid URL host
   2 = Unable to connect to remote host
*/
   $head = "";
   $url_p = parse_url ($url);

   if (isset ($url_p["host"]))
   { $host = $url_p["host"]; }
   else
   { return 1; }

   if (isset ($url_p["path"]))
   { $path = $url_p["path"]; }
   else
   { $path = ""; }

   $fp = fsockopen ($host, 80, $errno, $errstr, 20);
   if (!$fp)
   { return 2; }
   else
   {
       $parse = parse_url($url);
       $host = $parse['host'];

       fputs($fp, "HEAD ".$url." HTTP/1.1\r\n");
       fputs($fp, "HOST: ".$host."\r\n");
       fputs($fp, "Connection: close\r\n\r\n");
       $headers = "";
       while (!feof ($fp))
       { $headers .= fgets ($fp, 128); }
   }
   fclose ($fp);
   $arr_headers = explode("\n", $headers);
   $return = false;
   if (isset ($arr_headers[0]))
   { $return = strpos ($arr_headers[0], "404") === false; }
   return $return;
}

function cpg_refresh_config_db_values() {
global $CONFIG;
// Retrieve DB stored configuration
$results = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_CONFIG']}");
while ($row = mysql_fetch_array($results)) {
    $CONFIG[$row['name']] = $row['value'];
} // while
mysql_free_result($results);
return $CONFIG;
}

///////////// function defintions end /////////////////////////////


if (GALLERY_ADMIN_MODE) { // gallery admin mode --- start

// define the var array
$default_bridge_data['invisionboard'] = array(
  'full_name' => 'Invision Power Board 1.x',
  'short_name' => 'invisionboard',
  'support_url' => 'http://invisionize.com/',
  'db_database_name_default' => 'ivboard',
  'db_database_name_used' => 'mandatory,not_empty',
  'db_hostname_default' => 'localhost',
  'db_hostname_used' => 'mandatory,not_empty',
  'db_username_default' => '',
  'db_username_used' => 'mandatory,not_empty',
  'db_password_default' => '',
  'db_password_used' => 'password',
  'relative_path_of_forum_from_webroot_default' => '/ivboard/',
  'relative_path_of_forum_from_webroot_used' => 'mandatory,not_empty',
  'cookie_prefix_default' => '',
  'cookie_prefix_used' => 'cookie,empty',
  'table_prefix_default' => 'ibf_',
  'table_prefix_used' => 'optional',
  'user_table_default' => 'members',
  'user_table_used' => 'mandatory,not_empty',
  'session_table_default' => 'sessions',
  'session_table_used' => 'mandatory,not_empty',
  'group_table_default' => 'groups',
  'group_table_used' => 'mandatory,not_empty',
  'use_standard_groups_default' => '1',
  'use_standard_groups_used' => 'mandatory,not_empty',
  'validating_group_default' => '1',
  'validating_group_used' => 'optional',
  'guest_group_default' => '2',
  'guest_group_used' => 'optional',
  'member_group_default' => '3',
  'member_group_used' => 'optional',
  'admin_group_default' => '4',
  'admin_group_used' => 'optional',
  'banned_group_default' => '5',
  'banned_group_used' => 'optional',
);

$default_bridge_data['invisionboard_2.0'] = array(
  'full_name' => 'Invision Power Board 2.x',
  'short_name' => 'invisionboard_2.0',
  'support_url' => 'http://invisionize.com/',
  'db_database_name_default' => 'ivboard',
  'db_database_name_used' => 'mandatory,not_empty',
  'db_hostname_default' => 'localhost',
  'db_hostname_used' => 'mandatory,not_empty',
  'db_username_default' => '',
  'db_username_used' => 'mandatory,not_empty',
  'db_password_default' => '',
  'db_password_used' => 'password',
  'relative_path_of_forum_from_webroot_default' => '/ivboard/',
  'relative_path_of_forum_from_webroot_used' => 'mandatory,not_empty',
  'cookie_prefix_default' => 'iv2_',
  'cookie_prefix_used' => 'cookie,empty',
  'table_prefix_default' => 'ibf_',
  'table_prefix_used' => 'optional',
  'user_table_default' => 'members',
  'user_table_used' => 'mandatory,not_empty',
  'session_table_default' => 'sessions',
  'session_table_used' => 'mandatory,not_empty',
  'group_table_default' => 'groups',
  'group_table_used' => 'mandatory,not_empty',
  'use_standard_groups_default' => '1',
  'use_standard_groups_used' => 'mandatory,not_empty',
  'validating_group_default' => '1',
  'validating_group_used' => 'optional',
  'guest_group_default' => '2',
  'guest_group_used' => 'optional',
  'member_group_default' => '3',
  'member_group_used' => 'optional',
  'admin_group_default' => '4',
  'admin_group_used' => 'optional',
  'banned_group_default' => '5',
  'banned_group_used' => 'optional',
);

$default_bridge_data['mambo'] = array(
  'full_name' => 'Mambo server',
  'short_name' => 'mambo',
  'support_url' => 'http://www.mamboserver.com/',
  'db_database_name_default' => 'database',
  'db_database_name_used' => 'mandatory,not_empty',
  'db_hostname_default' => 'localhost',
  'db_hostname_used' => 'mandatory,not_empty',
  'db_username_default' => '',
  'db_username_used' => 'mandatory,not_empty',
  'db_password_default' => '',
  'db_password_used' => 'password',
  'relative_path_of_forum_from_webroot_default' => '/mambo/',
  'relative_path_of_forum_from_webroot_used' => 'mandatory,not_empty',
  'table_prefix_default' => 'mos_',
  'table_prefix_used' => 'mandatory,not_empty',
  'user_table_default' => 'users',
  'user_table_used' => 'mandatory,not_empty',
  'session_table_default' => 'session',
  'session_table_used' => 'mandatory,not_empty',
  'group_table_default' => 'core_acl_aro_groups',
  'group_table_used' => 'mandatory,not_empty',
  'group_relation_table_default' => 'core_acl_aro',
  'group_relation_table_used' => 'mandatory,not_empty',
  'group_mapping_table_default' => 'core_acl_groups_aro_map',
  'group_mapping_table_used' => 'mandatory,not_empty',
  'use_standard_groups_default' => '1',
  'use_standard_groups_used' => 'mandatory,not_empty',
  'guest_group_default' => '3',
  'guest_group_used' => 'optional',
  'member_group_default' => '2',
  'member_group_used' => 'optional',
  'admin_group_default' => '1',
  'admin_group_used' => 'optional',
  'banned_group_default' => '4',
  'banned_group_used' => 'optional',
);

$default_bridge_data['phpbb'] = array(
  'full_name' => 'phpBB',
  'short_name' => 'phpbb',
  'support_url' => 'http://www.phpbb.com/',
  'db_database_name_default' => 'phpBB',
  'db_database_name_used' => 'mandatory,not_empty',
  'db_hostname_default' => 'localhost',
  'db_hostname_used' => 'mandatory,not_empty',
  'db_username_default' => '',
  'db_username_used' => 'mandatory,not_empty',
  'db_password_default' => '',
  'db_password_used' => 'password',
  'relative_path_of_forum_from_webroot_default' => '/phpBB2/',
  'relative_path_of_forum_from_webroot_used' => 'mandatory,not_empty,trailing_slash',
  'logout_flag_default' => '1',
  'logout_flag_used' => 'radio,1,0',
  'cookie_prefix_default' => 'phpbb2mysql',
  'cookie_prefix_used' => 'cookie,not_empty',
  'table_prefix_default' => 'phpbb_',
  'table_prefix_used' => 'mandatory,not_empty',
  'user_table_default' => 'users',
  'user_table_used' => 'mandatory,not_empty',
  'session_table_default' => 'sessions',
  'session_table_used' => 'mandatory,not_empty',
  'group_table_default' => 'groups',
  'group_table_used' => 'mandatory,not_empty',
  'group_mapping_table_default' => 'user_group',
  'group_mapping_table_used' => 'mandatory,not_empty',
  'use_standard_groups_default' => '1',
  'use_standard_groups_used' => 'mandatory,not_empty',
  'guest_group_default' => '3',
  'guest_group_used' => 'optional',
  'member_group_default' => '2',
  'member_group_used' => 'optional',
  'admin_group_default' => '1',
  'admin_group_used' => 'optional',
  'banned_group_default' => '4',
  'banned_group_used' => 'optional',
);

$default_bridge_data['punbb'] = array(
  'full_name' => 'PunBB',
  'short_name' => 'punbb',
  'support_url' => 'http://www.punbb.org/',
  'full_forum_url_default' => 'http://www.yoursite.com/punbb',
  'full_forum_url_used' => 'mandatory,not_empty,no_trailing_slash',
  'relative_path_of_forum_from_webroot_default' => '',
  'relative_path_of_forum_from_webroot_used' => '',
  'relative_path_to_config_file_default' => '../punbb/config.php',
  'relative_path_to_config_file_used' => 'lookfor',
);

$default_bridge_data['smf'] = array(
  'full_name' => 'Simple Machines (SMF)',
  'short_name' => 'smf',
  'support_url' => 'http://www.simplemachines.org/',
  'relative_path_to_config_file_default' => '../smf/',
  'relative_path_to_config_file_used' => 'lookfor,Settings.php',
  'use_post_based_groups_default' => '0',
  'use_post_based_groups_used' => 'radio,1,0',
);

$default_bridge_data['vbulletin23'] = array(
  'full_name' => 'vBulletin 2.3',
  'short_name' => 'vbulletin23',
  'support_url' => 'http://www.vbulletin.com/',
  'db_database_name_default' => 'vbulletin23',
  'db_database_name_used' => 'mandatory,not_empty',
  'db_hostname_default' => 'localhost',
  'db_hostname_used' => 'mandatory,not_empty',
  'db_username_default' => '',
  'db_username_used' => 'mandatory,not_empty',
  'db_password_default' => '',
  'db_password_used' => 'password',
  'relative_path_of_forum_from_webroot_default' => '/vbulletin23/',
  'relative_path_of_forum_from_webroot_used' => 'mandatory,not_empty',
  'user_table_default' => 'user',
  'user_table_used' => 'mandatory,not_empty',
  'session_table_default' => 'session',
  'session_table_used' => 'mandatory,not_empty',
  'group_table_default' => 'usergroup',
  'group_table_used' => 'mandatory,not_empty',
  'use_standard_groups_default' => '1',
  'use_standard_groups_used' => 'mandatory,not_empty',
  'validating_group_default' => '3',
  'validating_group_used' => 'optional',
  'guest_group_default' => '1',
  'guest_group_used' => 'optional',
  'member_group_default' => '2',
  'member_group_used' => 'optional',
  'admin_group_default' => '6',
  'admin_group_used' => 'optional',
);

$default_bridge_data['vbulletin30'] = array(
  'full_name' => 'vBulletin 3.0',
  'short_name' => 'vbulletin30',
  'support_url' => 'http://www.vbulletin.com/',
  'license_number_default' => 'xxxxxxxx',
  'license_number_used' => 'mandatory,not_empty',
  'db_database_name_default' => 'forum',
  'db_database_name_used' => 'mandatory,not_empty',
  'db_hostname_default' => 'localhost',
  'db_hostname_used' => 'mandatory,not_empty',
  'db_username_default' => '',
  'db_username_used' => 'mandatory,not_empty',
  'db_password_default' => '',
  'db_password_used' => 'password',
  'relative_path_of_forum_from_webroot_default' => '/vbulletin3/',
  'relative_path_of_forum_from_webroot_used' => 'mandatory,not_empty',
  'user_table_default' => 'user',
  'user_table_used' => 'mandatory,not_empty',
  'session_table_default' => 'session',
  'session_table_used' => 'mandatory,not_empty',
  'group_table_default' => 'usergroup',
  'group_table_used' => 'mandatory,not_empty',
  'use_standard_groups_default' => '1',
  'use_standard_groups_used' => 'mandatory,not_empty',
  'validating_group_default' => '3',
  'validating_group_used' => 'optional',
  'guest_group_default' => '1',
  'guest_group_used' => 'optional',
  'member_group_default' => '2',
  'member_group_used' => 'optional',
  'admin_group_default' => '6',
  'admin_group_used' => 'optional',
);

$default_bridge_data['woltlab21'] = array(
  'full_name' => 'Woltlab Burning Board 2.1',
  'short_name' => 'woltlab21',
  'support_url' => 'http://www.woltlab.de/',
  'relative_path_of_forum_from_webroot_default' => '/wbb2/',
  'relative_path_of_forum_from_webroot_used' => 'mandatory,not_empty',
  'relative_path_to_config_file_default' => '../wbb2/',
  'relative_path_to_config_file_used' => 'lookfor,index.php',
);

$default_bridge_data['yabbse'] = array(
  'full_name' => 'YaBB SE ',
  'short_name' => 'yabbse',
  'support_url' => 'http://www.yabbse.org/community/',
  'relative_path_of_forum_from_webroot_default' => '',
  'relative_path_of_forum_from_webroot_used' => '',
  'relative_path_to_config_file_default' => '../yabbse/Settings.php',
  'relative_path_to_config_file_used' => 'lookfor',
  'use_standard_groups_default' => '1',
  'use_standard_groups_used' => 'mandatory,not_empty',
  'guest_group_default' => '3',
  'guest_group_used' => 'optional',
  'member_group_default' => '2',
  'member_group_used' => 'optional',
  'admin_group_default' => '1',
  'admin_group_used' => 'optional',
  'banned_group_default' => '4',
  'banned_group_used' => 'optional',
  'global_moderators_group_default' => '5',
  'global_moderators_group_used' => 'optional',
);

//////////////// main code start //////////////////////

// initialize vars
$step = $_POST['step'];
if (!$step) {
    $step = 'finalize';
}
$new_line = "\n";
$next_step = array( // this defines the order of steps
  'choose_bbs' => 'settings_path',
  'settings_path' => 'db_connect',
  'db_connect' => 'db_tables',
  'db_tables' => 'db_groups',
  'db_groups' => 'special_settings',
  'special_settings' => 'finalize',
  'finalize' => 'finalize',
);

$previous_step = array_flip($next_step);


pageheader($lang_bridgemgr_php['title']);
echo <<<EOT
<style type="text/css">
.explanation {font-size: 80%;}
.important {color:red;}
</style>
EOT;

//print 'Current step:'.$step.', previous step:'.$previous_step[$step].', next step:'.$next_step[$step];  // debug ouput

// get the bridge db vars first
$BRIDGE = cpg_get_bridge_db_values();
//print_r($BRIDGE);
//print '<hr>';

switch ($step) {
case "choose_bbs":
$BRIDGE = cpg_get_bridge_db_values();
print '<form name="'.$step.'" action="'.$PHP_SELF.'" method="post">';
//print '<input type="hidden" name="hide_unused_fields" value="1" />';
starttable('100%', $lang_bridgemgr_php['title'].': '.$lang_bridgemgr_php['choose_bbs_app'],2);
$checked[$BRIDGE['short_name']] = 'checked="checked"';
foreach($default_bridge_data as $key => $value) {
    print '<tr>'.$new_line;
    print '    <td class="tableb">'.$new_line;
    print '        <input type="Radio" name="short_name" id="'.$key.'" class="radio" value="'.$key.'" '.$checked[$key].' />'.$new_line;
    print '        <label for="'.$key.'" class="clickable_option">'.$new_line;
    print '            '.$value['full_name'].$new_line;
    print '        </label>'.$new_line;
    print '    </td>'.$new_line;
    print '    <td class="tableb">'.$new_line;
    print '        <span class="explanation">'.$new_line;
    print '            <a href="'.$value['support_url'].'" title="'.$lang_bridgemgr_php['support_url'].'" rel="external">'.$value['support_url'].'</a>'.$new_line;
    print '        </span>'.$new_line;
    print '    </td>'.$new_line;
    print '</tr>'.$new_line;
} // end foreach

// loop through the pre-made bridges. If there's one in the db that doesn't exist in the bridges, that's our custom theme; prefill the form fields with it.
$prefill = '';
$checked = '';
$custom_bridge_counter_exist = 0;
foreach($default_bridge_data as $key => $value) {
    if ($BRIDGE['short_name'] == $key) {
        $custom_bridge_counter_exist++;
    }
}
if ($custom_bridge_counter_exist == 0) { // we have a custom bridge --- start
    $prefill = $BRIDGE['short_name'];
    $checked = 'checked="checked"';
} // we have a custom bridge --- end

// form field for the custom bridge
    print '<tr>'.$new_line;
    print '    <td class="tableb">'.$new_line;
    print '        <input type="Radio" name="short_name" id="custom_selector" class="radio" value="custom_selector" '.$checked.' onclick="document.'.$step.'.custom_filename.focus();" />'.$new_line;
    //print '        <label for="custom_selector" class="clickable_option">'.$new_line;
    print '            <input type="text" name="custom_filename" value="'.$prefill.'" size="30" class="textinput" onclick="document.getElementById(\'custom_selector\').checked=true;" />'.$new_line;
    //print '        </label>'.$new_line;
    print '    </td>'.$new_line;
    print '    <td class="tableb">'.$new_line;
    print '        <span class="explanation">'.$new_line;
    print '            '.$lang_bridgemgr_php['custom_bridge_file'].$new_line;
    print '        </span>'.$new_line;
    print '    </td>'.$new_line;
    print '</tr>'.$new_line;

print cpg_submit_button($next_step[$step], 'false', '2');
endtable();
print "</form>\n";
   break;

case "settings_path":
    $error = write_to_db($previous_step[$step]);
    if (!$error) {
        $BRIDGE = cpg_get_bridge_db_values();
        print '<form name="'.$step.'" action="'.$PHP_SELF.'" method="post">';
        starttable('100%',$lang_bridgemgr_php['title'].': '.$lang_bridgemgr_php['settings_path'], 3);
        $loop_array = array('full_forum_url','relative_path_of_forum_from_webroot','relative_path_to_config_file', 'cookie_prefix');
        $rows_displayed = 0;
        $section_number = 0;
        foreach($loop_array as $key) {
            $prefill = cpg_bridge_prefill($BRIDGE['short_name'],$key);
            $reset_to_default = '';
            if ($default_bridge_data[$BRIDGE['short_name']][$key.'_used'] == '') {
                $disabled = 'disabled="disabled" style="background-color:#D1D7DC"';
            } else {
                $disabled = '';
                $rows_displayed++;
                if ($default_bridge_data[$BRIDGE['short_name']][$key.'_default'] != '') {
                    $reset_to_default = '<img src="images/flags/reset.gif" width="16" height="11" border="0" alt="" title="'.$lang_bridgemgr_php['reset_to_default'].'" style="cursor:pointer" onclick="document.getElementById(\''.$key.'\').value=\''.$default_bridge_data[$BRIDGE['short_name']][$key.'_default'].'\'" />';
                }
            }
            if ($_POST['hide_unused_fields'] != 1 || $disabled == '')
            {
                /*
                $display1 = '';
                $display2 = '';
            } else {
                $display1 = '<div id="section'.$section_number.'">';
                $display2 = '</div>';
                $section_number++;
            }
            */
                print '<tr>'.$new_line;
                print '    <td class="tableb">'.$new_line;
                print '        '.$lang_bridgemgr_php[$key].':'.$new_line;
                print '    </td>'.$new_line;
                print '    <td class="tableb" style="overflow:visible">'.$new_line;
                print '        <input type="text" name="'.$key.'" id="'.$key.'" class="textinput" value="'.$prefill.'" '.$disabled.' size="50" style="width:80%" />'.$reset_to_default.$new_line;
                print '    </td>'.$new_line;
                print '    <td class="tableb">'.$new_line;
                print $display1.$new_line;
                print '        <span class="explanation">'.$lang_bridgemgr_php[$key.'_explanation'].'</span>'.$new_line;
                print $display2.$new_line;
                print '    </td>'.$new_line;
                print '</tr>'.$new_line;
            }
        }
        if ($rows_displayed == 0) {
            print '<tr>';
            print '    <td class="tableh2" colspan="3" align="center">';
            print '        <h2>'.$lang_bridgemgr_php['no_action_needed'].'</h2>';
            print '    </td>';
            print '</tr>';
        }
        print cpg_submit_button($next_step[$step]);
        endtable();
        print "</form>\n";
    } // end if not error
   break;

case "db_connect":

    $error = write_to_db($previous_step[$step]);
    if (!$error) {
        $BRIDGE = cpg_get_bridge_db_values();
        print '<form name="'.$step.'" action="'.$PHP_SELF.'" method="post">';
        starttable('100%',$lang_bridgemgr_php['title'].': '.$lang_bridgemgr_php['database_connection'], 3);
        $loop_array = array('db_database_name','db_hostname','db_username','db_password');
        $rows_displayed = 0;
        foreach($loop_array as $key) {
            $prefill = cpg_bridge_prefill($BRIDGE['short_name'],$key);
            $reset_to_default = '';
            if ($default_bridge_data[$BRIDGE['short_name']][$key.'_used'] == '') {
                $disabled = 'disabled="disabled" style="background-color:#D1D7DC"';
            } else {
                $disabled = '';
                $rows_displayed++;
                if ($default_bridge_data[$BRIDGE['short_name']][$key.'_default'] != '') {
                    $reset_to_default = '<img src="images/flags/reset.gif" width="16" height="11" border="0" alt="" title="'.$lang_bridgemgr_php['reset_to_default'].'" style="cursor:pointer" onclick="document.getElementById(\''.$key.'\').value=\''.$default_bridge_data[$BRIDGE['short_name']][$key.'_default'].'\'" />';
                }
            }
            if ($default_bridge_data[$BRIDGE['short_name']][$key.'_used'] == 'password') {$fieldtype = 'password';} else {$fieldtype = 'text';}
            if ($_POST['hide_unused_fields'] != 1 || $disabled == '')
            {
                //print $default_bridge_data[$BRIDGE['short_name']][$key.'_used'].'|<br>';
                print '<tr>';
                print '    <td class="tableb">';
                print '        '.$lang_bridgemgr_php[$key].':';
                print '    </td>';
                print '    <td class="tableb">';
                print '        <input type="'.$fieldtype.'" name="'.$key.'" id="'.$key.'" class="textinput" value="'.$prefill.'" '.$disabled.' size="30"  style="width:80%" />'.$reset_to_default;
                print '    </td>';
                print '    <td class="tableb">';
                print '        <span class="explanation">'.$lang_bridgemgr_php[$key.'_explanation'].'</span>';
                print '    </td>';
                print '</tr>';
            }
        }
        if ($rows_displayed == 0) {
            print '<tr>';
            print '    <td class="tableh2" colspan="3" align="center">';
            print '        <h2>'.$lang_bridgemgr_php['no_action_needed'].'</h2>';
            print '    </td>';
            print '</tr>';
        }


        print cpg_submit_button($next_step[$step]);
        endtable();
        print "</form>\n";
    } // end if error
    break;

case "db_tables":

    $error = write_to_db($previous_step[$step]);
    if (!$error) {
        $BRIDGE = cpg_get_bridge_db_values();
        print '<form name="'.$step.'" action="'.$PHP_SELF.'" method="post">';
        starttable('100%',$lang_bridgemgr_php['title'].': '.$lang_bridgemgr_php['database_tables'], 3);
        $loop_array = array('table_prefix', 'user_table', 'session_table', 'group_table', 'group_relation_table', 'group_mapping_table', 'license_number');
        $rows_displayed = 0;
        foreach($loop_array as $key) {
            $prefill = cpg_bridge_prefill($BRIDGE['short_name'],$key);
            $reset_to_default = '';
            if ($default_bridge_data[$BRIDGE['short_name']][$key.'_used'] == '') {
                $disabled = 'disabled="disabled" style="background-color:#D1D7DC"';
            } else {
                $disabled = '';
                $rows_displayed++;
                if ($default_bridge_data[$BRIDGE['short_name']][$key.'_default'] != '') {
                    $reset_to_default = '<img src="images/flags/reset.gif" width="16" height="11" border="0" alt="" title="'.$lang_bridgemgr_php['reset_to_default'].'" style="cursor:pointer" onclick="document.getElementById(\''.$key.'\').value=\''.$default_bridge_data[$BRIDGE['short_name']][$key.'_default'].'\'" />';
                }
            }
            if ($default_bridge_data[$BRIDGE['short_name']][$key.'_used'] == 'password') {$fieldtype = 'password';} else {$fieldtype = 'text';}
            if ($_POST['hide_unused_fields'] != 1 || $disabled == '')
            {
                //print $default_bridge_data[$BRIDGE['short_name']][$key.'_used'].'|<br>';
                print '<tr>';
                print '    <td class="tableb">';
                print '        '.$lang_bridgemgr_php[$key].':';
                print '    </td>';
                print '    <td class="tableb">';
                print '        <input type="'.$fieldtype.'" name="'.$key.'" id="'.$key.'" class="textinput" value="'.$prefill.'" '.$disabled.' size="30"  style="width:80%" />'.$reset_to_default;
                print '    </td>';
                print '    <td class="tableb">';
                print '        <span class="explanation">'.$lang_bridgemgr_php[$key.'_explanation'].'</span>';
                print '    </td>';
                print '</tr>';
            }
        }
        if ($rows_displayed == 0) {
            print '<tr>'.$new_line;
            print '    <td class="tableh2" colspan="3" align="center">'.$new_line;
            print '        <h2>'.$lang_bridgemgr_php['no_action_needed'].'</h2>'.$new_line;
            print '    </td>'.$new_line;
            print '</tr>'.$new_line;
        }


        print cpg_submit_button($next_step[$step]);
        endtable();
        print "</form>\n";
    } // end if error
    break;

case "db_groups":

    $error = write_to_db($previous_step[$step]);
    if (!$error) {
        $BRIDGE = cpg_get_bridge_db_values();
        print '<form name="'.$step.'" action="'.$PHP_SELF.'" method="post">';
        starttable('100%',$lang_bridgemgr_php['title'].': '.$lang_bridgemgr_php['bbs_groups'], 3);
        if ($default_bridge_data[$BRIDGE['short_name']]['use_standard_groups_used'] != '')
        {
            if ($BRIDGE['use_standard_groups'] != '') {
                $prefill = $BRIDGE['use_standard_groups'];
            } else {
                $prefill = $default_bridge_data[$BRIDGE['short_name']]['use_standard_groups_default'];
            }
            if ($prefill == 1) {
                $checked = 'checked="checked"';
            } else {
                $checked = '';
            }
            print '<tr>'.$new_line;
            print '    <td class="tableb" colspan="2" align="left">'.$new_line;
            print '        <input type="hidden" name="use_standard_groups" id="use_standard_groups" value="'.$prefill.'" />'.$new_line;
            print '        <input type="checkbox" name="dummy_use_standard_groups" id="dummy_use_standard_groups" class="checkbox" value="1" '.$checked.' onclick="toggleGroupFields();" />'.$new_line;
            print '        <label for="dummy_use_standard_groups" class="clickable_option">'.$lang_bridgemgr_php['use_standard_groups'].'</label>'.$new_line;
            print '    </td>'.$new_line;
            print '    <td class="tableb">'.$new_line;
            print '        <span class="explanation">'.$lang_bridgemgr_php['use_standard_groups_explanation'].'</span>'.$new_line;
            print '    </td>'.$new_line;
            print '</tr>'.$new_line;
        }
        $loop_array = array('validating_group', 'guest_group', 'member_group', 'admin_group', 'banned_group', 'global_moderators_group');
        $rows_displayed = 0;
        foreach($loop_array as $key) { // foreach loop start
            $prefill = cpg_bridge_prefill($BRIDGE['short_name'],$key);
            $reset_to_default = '';
            if ($default_bridge_data[$BRIDGE['short_name']][$key.'_used'] == '') {
                $disabled = 'disabled="disabled" style="background-color:#D1D7DC"';
            } else {
                $disabled = '';
                $rows_displayed++;
                if ($default_bridge_data[$BRIDGE['short_name']][$key.'_default'] != '') {
                    $reset_to_default = '<img src="images/flags/reset.gif" width="16" height="11" border="0" alt="" title="'.$lang_bridgemgr_php['reset_to_default'].'" style="cursor:pointer" onclick="document.getElementById(\''.$key.'\').value=\''.$default_bridge_data[$BRIDGE['short_name']][$key.'_default'].'\'" />';
                }
            }
            if ($default_bridge_data[$BRIDGE['short_name']][$key.'_used'] == 'password') {$fieldtype = 'password';} else {$fieldtype = 'text';}
            if ($_POST['hide_unused_fields'] != 1 || $disabled == '')
            {
                print '<tr>'.$new_line;
                print '    <td class="tableb">'.$new_line;
                print '        '.$lang_bridgemgr_php[$key].':'.$new_line;
                print '    </td>'.$new_line;
                print '    <td class="tableb">'.$new_line;
                print '        <input type="'.$fieldtype.'" name="'.$key.'" id="'.$key.'" class="textinput" value="'.$prefill.'" '.$disabled.' size="30"  style="width:80%" />'.$reset_to_default.$new_line;
                print '    </td>'.$new_line;
                print '    <td class="tableb">'.$new_line;
                print '        <span class="explanation">'.$lang_bridgemgr_php[$key.'_explanation'].'</span>'.$new_line;
                print '    </td>'.$new_line;
                print '</tr>'.$new_line;
                $keywords[] = $key;
            }
        } // foreach loop end
        if ($rows_displayed == 0) {
            print '<tr>'.$new_line;
            print '    <td class="tableh2" colspan="3" align="center">'.$new_line;
            print '        <h2>'.$lang_bridgemgr_php['no_action_needed'].'</h2>'.$new_line;
            print '    </td>'.$new_line;
            print '</tr>'.$new_line;
        } else {
            // dome dhtml magic to disable the input fields in case they get overridden with the option 'use_standard_groups' anyway
    print '<script type="text/javascript">'.$new_line;
    print '<!--'.$new_line;
    print 'toggleGroupFields();'.$new_line;
    print 'function toggleGroupFields() {'.$new_line;
    print '    var use_standard_groups = document.getElementById("dummy_use_standard_groups").checked;'.$new_line;
    print '    if (use_standard_groups == true) {'.$new_line;
    print '        AllGroupFieldsDisable();'.$new_line;
    print '        document.getElementById("use_standard_groups").value = 1;'.$new_line;
    print '    }'.$new_line;
    print '    if (use_standard_groups == false) {'.$new_line;
    print '        AllGroupFieldsEnable();'.$new_line;
    print '        document.getElementById("use_standard_groups").value = 0;'.$new_line;
    print '    }'.$new_line;
    print '}'.$new_line;
    print 'function AllGroupFieldsDisable() {'.$new_line;
    foreach($keywords as $key) {
    print '    document.getElementById("'.$key.'").disabled = true;'.$new_line;
    }
    print '}'.$new_line;
    print 'function AllGroupFieldsEnable() {'.$new_line;
    foreach($keywords as $key) {
    print '    document.getElementById("'.$key.'").disabled = false;'.$new_line;
    }
    print '}'.$new_line;
    print '-->'.$new_line;
    print '</script>'.$new_line;
        }
        print cpg_submit_button($next_step[$step]);
        endtable();
        print "</form>\n";
    } // end if error
    break;

case "special_settings":

    $error = write_to_db($previous_step[$step]);
    if (!$error) {
        $BRIDGE = cpg_get_bridge_db_values();
        print '<form name="'.$step.'" action="'.$PHP_SELF.'" method="post">';
        starttable('100%',$lang_bridgemgr_php['title'].': '.$lang_bridgemgr_php['special_settings'], 3);
        $loop_array = array('logout_flag', 'use_post_based_groups');
        $rows_displayed = 0;
        foreach($loop_array as $key) {
            if ($BRIDGE[$key]) {
                $prefill = $BRIDGE[$key];
            } else {
                $prefill = $default_bridge_data[$BRIDGE['short_name']][$key.'_default'];
            }
            //print 'key:'.$key.',prefill:'.$prefill.'<br>';
            //print_r($default_bridge_data[$BRIDGE['short_name']]);
            //if ($default_bridge_data['phpbb']['logout_flag_default'] == true){print '<h1>true</h1>';}else{print '<h1>not true</h1>';}
            $reset_to_default = '';
            if ($default_bridge_data[$BRIDGE['short_name']][$key.'_used'] == '') {
                $disabled = 'disabled="disabled"';
            } else {
                $disabled = '';
                $rows_displayed++;
            }
            // get the possible options for the value
            //  e.g. 'option_name_used' => 'radio,1,0',
            $option_yes = '';
            $option_no = '';
            $options = explode(',', $default_bridge_data[$BRIDGE['short_name']][$key.'_used']);
            //print_r($options);
            if ($options[0] == 'radio') {$option_yes = $options[1]; $option_no = $options[2];}
            if ($BRIDGE[$key] == $options[1]) {
                $checked_yes = 'checked="checked"';
                $checked_no = '';
            } elseif ($BRIDGE[$key] == $options[2]) {
                $checked_yes = '';
                $checked_no = 'checked="checked"';
            }
            //if ($BRIDGE[$key] == 1){print $key.'true<br>';}
            //if ($BRIDGE[$key] == 0){print $key.'false<br>';}
            //print $key.$BRIDGE[$key];
            if ($_POST['hide_unused_fields'] != 1 || $disabled == '')
            {
                //print $default_bridge_data[$BRIDGE['short_name']][$key.'_used'].'|<br>';
                print '<tr>'.$new_line;
                print '    <td class="tableb">'.$new_line;
                print '        '.$lang_bridgemgr_php[$key].':'.$new_line;
                print '    </td>'.$new_line;
                print '    <td class="tableb">'.$new_line;
                print '        <input type="Radio" name="'.$key.'" id="'.$key.'_yes" class="radio" value="'.$option_yes.'" '.$disabled.' '.$checked_yes.' />'.$new_line;
                print '        <label for="'.$key.'_yes" class="clickable_option">'.$new_line;
                print '            '.$lang_bridgemgr_php[$key.'_yes'].$new_line;
                print '        </label>&nbsp;'.$new_line;
                print '        <input type="Radio" name="'.$key.'" id="'.$key.'_no" class="radio" value="'.$option_no.'" '.$disabled.' '.$checked_no.' /><label for="'.$key.'_no" class="clickable_option">'.$lang_bridgemgr_php[$key.'_no'].'</label>'.$new_line;
                print '    </td>'.$new_line;
                print '    <td class="tableb">'.$new_line;
                print '        <span class="explanation">'.$lang_bridgemgr_php[$key.'_explanation'].'</span>'.$new_line;
                print '    </td>'.$new_line;
                print '</tr>'.$new_line;
            }
        }
        if ($rows_displayed == 0) {
            print '<tr>';
            print '    <td class="tableh2" colspan="3" align="center">';
            print '        <h2>'.$lang_bridgemgr_php['no_action_needed'].'</h2>';
            print '    </td>';
            print '</tr>';
        }
        print cpg_submit_button($next_step[$step]);
        endtable();
        print "</form>\n";
    } // end if error
    break;


case "finalize":

    $error = write_to_db($previous_step[$step]);
    if (!$error) {
        $BRIDGE = cpg_get_bridge_db_values();
        $CONFIG = cpg_refresh_config_db_values();
        print '<form name="'.$step.'" action="'.$PHP_SELF.'" method="post">';
        echo <<<EOT
    <script type="text/javascript">
    <!--
    function changeSubmitButton() {
        document.finalize.submit.value='{$lang_bridgemgr_php['finish']}';
        document.finalize.step.value='finalize';
        document.finalize.force_startpage.value='1';
    }
    -->
    </script>
EOT;
        starttable(-1,$lang_bridgemgr_php['title'].': '.$lang_bridgemgr_php['finalize'],2);
        if ($_POST['submit'] && $CONFIG['bridge_enable'] != 1) {
            print '<tr>';
            print '<td class="tableb" colspan="2">';
            print '<span class="explanation">';
            printf($lang_bridgemgr_php['finalize_explanation'],$CONFIG['ecards_more_pic_target'].'/bridgemgr.php');
            print '</span>';
            print '</td>';
            print '</tr>';
        }
        if (is_array($BRIDGE)) { // there are entries in the db already --- start
            print '<tr>';
            print '<td class="tableh2" colspan="2">';
            print $lang_bridgemgr_php['your_bridge_settings'];
            print '</td>';
            print '</tr>';
            $mandatory_fields_missing = 0;
            foreach($BRIDGE as $key => $value) {
                if ($default_bridge_data[$BRIDGE['short_name']][$key.'_used'] != '') {
                    print '<tr>';
                    print '    <td class="tableb" width="50%">';
                    print '        <span class="explanation">'.$lang_bridgemgr_php[$key].':</span>';
                    print '    </td>';
                    print '    <td class="tableb" width="50%">';
                    if ($default_bridge_data[$BRIDGE['short_name']][$key.'_used'] == 'password') {
                        $pw = '';
                        for ($i=1; $i <= strlen($value);$i++) {
                            $pw = $pw.'*';
                        }
                        $value = $pw;
                    }
                    print '        <span class="explanation">'.$value;
                    // check if we really can allow enabling bridging: are all required fields in the db?
                    if (strstr($default_bridge_data[$BRIDGE['short_name']][$key.'_used'], 'not_empty') != false && $value == '') {
                        print ' (<span class="important">'.$lang_bridgemgr_php['error_must_not_be_empty'].'</span>)';
                        $mandatory_fields_missing++;
                    }
                    $explode = explode(',', $default_bridge_data[$BRIDGE['short_name']][$key.'_used']);
                    if ($explode[0] == radio && ($value != $explode[1] && $value != $explode[2])) {
                        printf(' ('.$lang_bridgemgr_php['error_either_be'].')',$explode[1],$explode[2]);
                        $mandatory_fields_missing++;
                    }
                    //print '<br>';
                    print '</span>';
                    print '    </td>';
                    print '</tr>';
                }
            }
        }  // there are entries in the db already --- end
        if ($BRIDGE['short_name'] != '') {// display the enable/disable option only if there's at least a db entry about the file to bridge with --- start
            print '<tr>';
            print '<td class="tableh2" colspan="2">';
            printf($lang_bridgemgr_php['title_enable'], '<b>'.$default_bridge_data[$BRIDGE['short_name']]['full_name'].'</b>');
            print '</td>';
            print '</tr>';
            //print 'bridge enabled:'.$CONFIG['bridge_enable'];
            if ($CONFIG['bridge_enable'] == 1) {
                $checked_yes = 'checked="checked"';
                $checked_no = '';
                $disabled_yes = '';
                $disabled_no = '';
            } else {
                $checked_yes = '';
                $checked_no = 'checked="checked"';
                if ($mandatory_fields_missing != 0) {
                    $disabled_yes = 'disabled="disabled"';
                    $disabled_no = '';
                } else {
                    $disabled_yes = '';
                    $disabled_no = '';
                }
            }
        } // display the enable/disable option only if there's at least a db entry about the file to bridge with --- end
        if ($_POST['submit'] == '' || $_POST['wizard_finished'] != '' || $_POST['force_startpage'] == '1') {
            if ($BRIDGE['short_name'] != '') {// display the enable/disable option only if there's at least a db entry about the file to bridge with --- start
                print '<tr>';
                print '    <td class="tableb" width="50%">';
                print '        <input type="Radio" name="bridge_enable" id="bridge_enable_yes" class="radio" value="1" '.$disabled_yes.' '.$checked_yes.' onclick="changeSubmitButton();" /><label for="bridge_enable_yes" class="clickable_option">'.$lang_bridgemgr_php['bridge_enable_yes'].'</label>';
                print '    </td>';
                print '    <td class="tableb" width="50%">';
                print '        <input type="Radio" name="bridge_enable" id="bridge_enable_no" class="radio" value="0" '.$disabled_no.' '.$checked_no.' onclick="changeSubmitButton();" /><label for="bridge_enable_no" class="clickable_option">'.$lang_bridgemgr_php['bridge_enable_no'].'</label>';
                print '    </td>';
                print '</tr>';
            } // display the enable/disable option only if there's at least a db entry about the file to bridge with --- end
            print '<tr>'.$new_line;
            print '        <td colspan="2" class="tablef" align="center">'.$new_line;
            print '            <table border="0" cellspacing="0" cellpadding="0" width="100%">'.$new_line;
            print '                <tr>'.$new_line;
            print '                    <td align="left">'.$new_line;
            print '                        <!--<input type="Checkbox" name="hide_unused_fields" id="hide_unused_fields" value="1" class="checkbox"  />'.$new_line;
            print '                        <label for="hide_unused_fields" class="clickable_option"><span class="explanation">hide unused form fields (recommended)</span></label>-->'.$new_line;
            print '                   </td>'.$new_line;
            print '                   <td align="center">'.$new_line;
            print '                        <!--<input type="button" name="back" value="&laquo;back" class="button" onclick="javascript:history.back()" />-->'.$new_line;
            print '                        <input type="submit" name="submit" value="'.$lang_bridgemgr_php['start_wizard'].'" class="button" />'.$new_line;
            print '                        <input type="hidden" name="step" value="choose_bbs" />'.$new_line;
            print '                        <input type="hidden" name="force_startpage" value="0" />'.$new_line;
            print '                   </td>'.$new_line;
            print '                 </tr>'.$new_line;
            print '             </table>'.$new_line;
            print '        </td>'.$new_line;
            print '</tr>'.$new_line;
        } else {
            print '<tr>';
            print '    <td class="tableb" width="50%">';
            print '        <input type="Radio" name="bridge_enable" id="bridge_enable_yes" class="radio" value="1" '.$disabled_yes.' '.$checked_yes.' /><label for="bridge_enable_yes" class="clickable_option">'.$lang_bridgemgr_php['bridge_enable_yes'].'</label>';
            print '    </td>';
            print '    <td class="tableb" width="50%">';
            print '        <input type="Radio" name="bridge_enable" id="bridge_enable_no" class="radio" value="0" '.$disabled_no.' '.$checked_no.' /><label for="bridge_enable_no" class="clickable_option">'.$lang_bridgemgr_php['bridge_enable_no'].'</label>';
            print '    </td>';
            print '</tr>';
            print '<tr>'.$new_line;
            print '        <td colspan="2" class="tablef" align="center">'.$new_line;
            print '            <table border="0" cellspacing="0" cellpadding="0" width="100%">'.$new_line;
            print '                <tr>'.$new_line;
            print '                    <td align="left">'.$new_line;
            //print '                        <input type="Checkbox" name="clear_unused_db_fields" id="clear_unused_db_fields" value="1" class="checkbox"  checked="checked" />'.$new_line;
            //print '                        <label for="clear_unused_db_fields" class="clickable_option"><span class="explanation">'.$lang_bridgemgr_php['clear_unused_db_fields'].'</span></label>'.$new_line;
            print '                   </td>'.$new_line;
            print '                   <td align="center">'.$new_line;
            print '                        <input type="button" name="back" value="&laquo;'.$lang_bridgemgr_php['back'].'" class="button" onclick="javascript:history.back()" />'.$new_line;
            print '                        <input type="submit" name="submit" value="'.$lang_bridgemgr_php['finish'].'" class="button" />'.$new_line;
            print '                        <input type="hidden" name="step" value="finalize" />'.$new_line;
            print '                        <input type="hidden" name="wizard_finished" value="finished" />'.$new_line;
            print '                   </td>'.$new_line;
            print '                 </tr>'.$new_line;
            print '             </table>'.$new_line;
            print '        </td>'.$new_line;
            print '</tr>'.$new_line;
        }
        endtable();
        print '</form>';
    } // end if error
    break;
}


print "<br />\n";
pagefooter();
} // gallery admin mode --- end
else { // not in gallery admin mode --- start
    if ($CONFIG['bridge_enable'] != 1) { cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__); }

    // initialize vars
    $step = $_POST['step'];
    $new_line = "\n";

    pageheader($lang_bridgemgr_php['title']);
    switch ($step) {
    case "attempt_to_disable":
    // check if the wait time is over; if it isn't, send them back
    $results = cpg_db_query("SELECT value FROM {$CONFIG['TABLE_BRIDGE']} WHERE name = 'recovery_logon_timestamp'");
    if (mysql_num_rows($results)) {
        $row = mysql_fetch_array($results);
    }
    $recovery_logon_timestamp = $row['value'];
    //print $recovery_logon_timestamp;
    $results = cpg_db_query("SELECT value FROM {$CONFIG['TABLE_BRIDGE']} WHERE name = 'recovery_logon_failures'");
    if (mysql_num_rows($results)) {
        $row = mysql_fetch_array($results);
    }
    $recovery_logon_failures = $row['value'];
    $logon_allowed = cpg_check_allowed_emergency_logon($recovery_logon_timestamp,$recovery_logon_failures);
    if ($logon_allowed > 0) {
        // the user is not allowed to logon yet, the wait time has not elapsed yet
        msg_box($lang_bridgemgr_php['recovery_wait_title'], $lang_bridgemgr_php['recovery_wait_content'], $lang_bridgemgr_php['try_again'], $PHP_SELF, "-1");
    } else { // the logon wait time has passed, the user is allowed to try to logon now
        // go through the list of standalone admins and check if we have a match
        $temp_user_table = $CONFIG['TABLE_PREFIX'].'users';
        $results = cpg_db_query("SELECT user_id, user_name, user_password FROM $temp_user_table WHERE user_name = '" . addslashes($HTTP_POST_VARS['username']) . "' AND BINARY user_password = '" . addslashes($HTTP_POST_VARS['password']) . "' AND user_active = 'YES' AND user_group = '1'");
        if (mysql_num_rows($results)) {
            $retrieved_data = mysql_fetch_array($results);
        }
        if ($retrieved_data['user_name'] == $_POST['username'] && $retrieved_data['user_password'] == $_POST['password'] && $retrieved_data['user_name'] != '' ) {
            // authentification successfull
            cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '0' WHERE name = 'bridge_enable'");
            cpg_db_query("UPDATE {$CONFIG['TABLE_BRIDGE']} SET value = '0' WHERE name = 'recovery_logon_failures'");
            cpg_db_query("UPDATE {$CONFIG['TABLE_BRIDGE']} SET value = NOW() WHERE name = 'recovery_logon_timestamp'");
            if (USER_ID) { //user already logged in
                msg_box($lang_bridgemgr_php['recovery_success_title'], $lang_bridgemgr_php['recovery_success_content'], $lang_bridgemgr_php['goto_bridgemgr'], $PHP_SELF, "-1");
            } else { // user not logged in yet
                msg_box($lang_bridgemgr_php['recovery_success_title'], $lang_bridgemgr_php['recovery_success_content'].'<br />'.$lang_bridgemgr_php['recovery_success_advice_login'], $lang_bridgemgr_php['goto_login'], "login.php?referer=".$PHP_SELF, "-1");
            }
        } else {
            // authentification failed
            cpg_db_query("UPDATE {$CONFIG['TABLE_BRIDGE']} SET value = NOW() WHERE name = 'recovery_logon_timestamp'");
            $results = cpg_db_query("SELECT value FROM {$CONFIG['TABLE_BRIDGE']} WHERE name = 'recovery_logon_failures'");
            if (mysql_num_rows($results)) {
                $row = mysql_fetch_array($results);
            }
            $number_of_failed_attempts = $row['value'] + 1;
            cpg_db_query("UPDATE {$CONFIG['TABLE_BRIDGE']} SET value = '$number_of_failed_attempts' WHERE name = 'recovery_logon_failures'");
            msg_box($lang_bridgemgr_php['recovery_failure_title'], $lang_bridgemgr_php['recovery_failure_content'], $lang_bridgemgr_php['try_again'], $PHP_SELF, "-1");
        }
    }
    break;
    default:
    // check if the wait time is over; if it isn't, disable the submit button
    $results = cpg_db_query("SELECT value FROM {$CONFIG['TABLE_BRIDGE']} WHERE name = 'recovery_logon_timestamp'");
    if (mysql_num_rows($results)) {
        $row = mysql_fetch_array($results);
    }
    $recovery_logon_timestamp = $row['value'];
    //print $recovery_logon_timestamp;
    $results = cpg_db_query("SELECT value FROM {$CONFIG['TABLE_BRIDGE']} WHERE name = 'recovery_logon_failures'");
    if (mysql_num_rows($results)) {
        $row = mysql_fetch_array($results);
    }
    $recovery_logon_failures = $row['value'];
    $logon_allowed = cpg_check_allowed_emergency_logon($recovery_logon_timestamp,$recovery_logon_failures);
    if ($logon_allowed < 0) {$logon_allowed = 0;}
    starttable(-1,$lang_bridgemgr_php['recovery_title'],2);
        echo <<<EOT
        <form name="disable_integration" action="$PHP_SELF" method="post">
        <tr>
            <td class="tableb" colspan="2">
                {$lang_bridgemgr_php['recovery_explanation']}
            </td>
        </tr>
        <tr>
              <td class="tableb" width="40%">{$lang_bridgemgr_php['username']}</td>
              <td class="tableb" width="60%"><input type="text" class="textinput" name="username" style="width: 100%" /></td>
        </tr>
        <tr>
            <td class="tableb">{$lang_bridgemgr_php['password']}</td>
            <td class="tableb"><input type="password" class="textinput" name="password" style="width: 100%" /></td>
        </tr>
        <tr>
            <td class="tablef" colspan="2" align="center">
                <input type="submit" name="submit" id="submit" value="{$lang_bridgemgr_php['disable_submit']}" class="button" />
                <input type="hidden" name="step" value="attempt_to_disable" />
            </td>
        </tr>
        <script language="javascript" type="text/javascript">
        <!--
        document.disable_integration.username.focus();
        document.disable_integration.submit.disabled = true;

EOT;
print '        var countDownTime = '.$logon_allowed;
echo <<<EOT

        counter=setTimeout("countDown()", 1000);
        var aktiv = window.setInterval("countDown()",1000);
        var message = '{$lang_bridgemgr_php['wait']}';
        function countDown(){
                countDownTime--;
                if (countDownTime <=0) {
                    message = '{$lang_bridgemgr_php['disable_submit']}';
                    document.getElementById('submit').disabled = false;
                    countDownTime='';
                    clearTimeout(counter);
                    //return;
                }
                document.getElementById('submit').value = message +' '+countDownTime;
        }
        window.onload=countDown();
        -->
        </script>
EOT;
        endtable();
        print '</form>';
    break;
    }
    pagefooter();
} // not in gallery admin mode --- end



//////////////////////// main code end /////////////////////////////////

?>