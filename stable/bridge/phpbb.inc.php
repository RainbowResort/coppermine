<?php
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.3.1                                            //
// ------------------------------------------------------------------------- //
// Copyright (C) 2002-2004 Gregory DEMAR                                     //
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
// CVS version: $Id$
// ------------------------------------------------------------------------- //
// phpBB2 Integration for Coppermine                                         //
// ------------------------------------------------------------------------- //
// Modify the values below according to your Board installation              //
// ------------------------------------------------------------------------- //

// database configuration
define('PHPBB_DB_NAME', 'phpBB'); // The name of the database used by the board
define('PHPBB_BD_HOST', 'localhost'); // The name of the database server
define('PHPBB_DB_USERNAME', 'root'); // The username to use to connect to the database
define('PHPBB_DB_PASSWORD', ''); // The password to use to connect to the database

// The web path to your phpBB directory
// If your URL to your board is for example 'http://yoursite_name.com/phpBB2/',
// you'll have to set the below var to '/phpBB2/'.
define('PHPBB_WEB_PATH', '/phpBB2/');
// Logout Flag
// the value of this boolean constant depends on your phpBB version:
// If your version of phpBB is 2.0.4 or lower - change the value to FALSE;
// if your version of phpBB is 2.0.5 or newer - leave it as TRUE
define('PHPBB_LOGOUT_GET', TRUE);
// ------------------------------------------------------------------------- //
// You can keep the default values below if your instalation is standard
// ------------------------------------------------------------------------- //
// The prefix for the phpBB cookies
define('PHPBB_COOKIE_PREFIX', 'phpbb2mysql'); // The prefix used for board cookies

// Prefix and names for the database tables
define('PHPBB_TABLE_PREFIX', 'phpbb_'); // The prefix used for the DB tables
define('PHPBB_USER_TABLE', 'users'); // The members table
define('PHPBB_SESSION_TABLE', 'sessions'); // The session table
define('PHPBB_GROUP_TABLE', 'groups'); // The groups table
define('PHPBB_UGROUP_TABLE', 'user_group'); // The group/user table

// ------------------------------------------------------------------------- //
// Nothing to edit below this line
// ------------------------------------------------------------------------- //
// Group definitions
define('PHPBB_ADMIN_GROUP', 1);
define('PHPBB_MEMBERS_GROUP', 2);
define('PHPBB_GUEST_GROUP', 3);
define('PHPBB_BANNED_GROUP', 4);
// Authenticate a user using cookies
function udb_authenticate()
{
    global $HTTP_COOKIE_VARS, $USER_DATA, $UDB_DB_LINK_ID, $UDB_DB_NAME_PREFIX, $CONFIG;
    // For error checking
    $CONFIG['TABLE_USERS'] = '**ERROR**';

    $default_group = array('group_id' => PHPBB_GUEST_GROUP,
        'group_name' => 'Unknown',
        'has_admin_access' => 0,
        'can_send_ecards' => 0,
        'can_rate_pictures' => 0,
        'can_post_comments' => 0,
        'can_upload_pictures' => 0,
        'can_create_albums' => 0,
        'pub_upl_need_approval' => 1,
        'priv_upl_need_approval' => 1,
        'upload_form_config' => 0,
        'custom_user_upload' => 0,
        'num_file_upload' => 0,
        'num_URI_upload' => 0,
        'has_admin_access' => 0,
        'can_see_all_albums' => 0,
        'groups' => array (PHPBB_GUEST_GROUP)
        );
    // Retrieve cookie stored login information
    if (!isset($HTTP_COOKIE_VARS[PHPBB_COOKIE_PREFIX . '_data'])) {
        $cookie_uid = 0;
        $cookie_pass = '*';
    } else {
        $sessiondata = unserialize($HTTP_COOKIE_VARS[PHPBB_COOKIE_PREFIX . '_data']);
        if (is_array($sessiondata)) {
            $cookie_uid = (isset($sessiondata['userid'])) ? intval($sessiondata['userid']) : 0;
            $cookie_pass = (isset($sessiondata['autologinid'])) ? addslashes($sessiondata['autologinid']) : '*';
        } else {
            $cookie_uid = 0;
            $cookie_pass = '*';
        }
    }
    // If autologin was not selected, we need to use the sessions table
    if ($cookie_uid && !$cookie_pass && isset($HTTP_COOKIE_VARS[PHPBB_COOKIE_PREFIX . '_sid'])) {
        $session_id = addslashes($HTTP_COOKIE_VARS[PHPBB_COOKIE_PREFIX . '_sid']);

        $sql = "SELECT user_id, username as user_name, user_level " . "FROM " . $UDB_DB_NAME_PREFIX . PHPBB_TABLE_PREFIX . PHPBB_SESSION_TABLE . " " . "INNER JOIN " . $UDB_DB_NAME_PREFIX . PHPBB_TABLE_PREFIX . PHPBB_USER_TABLE . " ON session_user_id = user_id " . "WHERE session_id='$session_id' AND session_user_id ='$cookie_uid' AND user_active='1'";
    } else {
        $sql = "SELECT user_id, username as user_name, user_level " . "FROM " . $UDB_DB_NAME_PREFIX . PHPBB_TABLE_PREFIX . PHPBB_USER_TABLE . " " . "WHERE user_id='$cookie_uid' AND user_password='$cookie_pass' AND user_active='1'";
    }
    $result = db_query($sql, $UDB_DB_LINK_ID);

    if (mysql_num_rows($result)) {
        $USER_DATA = mysql_fetch_array($result);
        mysql_free_result($result);

        $USER_DATA['groups'] = array();

        if($USER_DATA['user_id'] == "-1") {
            define('USER_ID', 0);
        } else {
            define('USER_ID', (int)$USER_DATA['user_id']);
        }

        define('USER_NAME', $USER_DATA['user_name']);

        // Define the basic groups
        if ($USER_DATA['user_id'] == "-1") {

            array_push($USER_DATA['groups'], PHPBB_GUEST_GROUP);

        } else {

            if ($USER_DATA['user_level'] == 1) {
                array_push($USER_DATA['groups'], PHPBB_ADMIN_GROUP);
            }
            array_push($USER_DATA['groups'], PHPBB_MEMBERS_GROUP);

        }

        // Retrieve the groups the user is a member of
        $sql = "SELECT (ug.group_id + 5) as group_id " . "FROM " . $UDB_DB_NAME_PREFIX . PHPBB_TABLE_PREFIX . PHPBB_UGROUP_TABLE . " as ug " . "LEFT JOIN " . $UDB_DB_NAME_PREFIX . PHPBB_TABLE_PREFIX . PHPBB_GROUP_TABLE . " as g ON ug.group_id = g.group_id " . "WHERE user_id = " . USER_ID . " AND user_pending = 0 AND group_single_user = 0";
        $result = db_query($sql, $UDB_DB_LINK_ID);
        while ($row = mysql_fetch_array($result)) {
                array_push($USER_DATA['groups'], $row['group_id']);
        }
        mysql_free_result($result);

        $user_group_set = '(' . implode(',', $USER_DATA['groups']) . ')';
        // Default group data
        $USER_DATA['group_quota'] = 1;
        $USER_DATA['can_rate_pictures'] = 0;
        $USER_DATA['can_send_ecards'] = 0;
        $USER_DATA['can_post_comments'] = 0;
        $USER_DATA['can_upload_pictures'] = 0;
        $USER_DATA['can_create_albums'] = 0;
        $USER_DATA['pub_upl_need_approval'] = 1;
        $USER_DATA['priv_upl_need_approval'] = 1;
        $USER_DATA['upload_form_config'] = 0;
        $USER_DATA['num_file_upload'] = 0;
        $USER_DATA['num_URI_upload'] = 0;
        $USER_DATA['custom_user_upload'] = 0;

        $USER_DATA = array_merge($USER_DATA, cpgGetUserData($USER_DATA['groups'][0], $USER_DATA['groups'], PHPBB_GUEST_GROUP));

        define('USER_GROUP', '');
        define('USER_GROUP_SET', $user_group_set);
        define('USER_IS_ADMIN', ($USER_DATA['user_level'] == 1));
        define('USER_CAN_SEND_ECARDS', (int)$USER_DATA['can_send_ecards']);
        define('USER_CAN_RATE_PICTURES', (int)$USER_DATA['can_rate_pictures']);
        define('USER_CAN_POST_COMMENTS', (int)$USER_DATA['can_post_comments']);
        define('USER_CAN_UPLOAD_PICTURES', (int)$USER_DATA['can_upload_pictures']);
        define('USER_CAN_CREATE_ALBUMS', (int)$USER_DATA['can_create_albums']);
        define('USER_UPLOAD_FORM', (int)$USER_DATA['upload_form_config']);
        define('CUSTOMIZE_UPLOAD_FORM', (int)$USER_DATA['custom_user_upload']);
        define('NUM_FILE_BOXES', (int)$USER_DATA['num_file_upload']);
        define('NUM_URI_BOXES', (int)$USER_DATA['num_URI_upload']);
    } else {
        $USER_DATA = cpgGetUserData(PHPBB_GUEST_GROUP, array(), PHPBB_GUEST_GROUP);
        define('USER_ID', 0);
        define('USER_NAME', 'Anonymous');
        define('USER_GROUP_SET', '(' . PHPBB_GUEST_GROUP . ')');
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
        mysql_free_result($result);
    }
}
// Retrieve the name of a user
function udb_get_user_name($uid)
{
    global $UDB_DB_LINK_ID, $UDB_DB_NAME_PREFIX, $CONFIG;

    $sql = "SELECT username as user_name " . "FROM " . $UDB_DB_NAME_PREFIX . PHPBB_TABLE_PREFIX . PHPBB_USER_TABLE . " " . "WHERE user_id = '$uid'";

    $result = db_query($sql, $UDB_DB_LINK_ID);

    if (mysql_num_rows($result)) {
        $row = mysql_fetch_array($result);
        mysql_free_result($result);
        return $row['user_name'];
    } else {
        return '';
    }
}
// Retrieve the name of a user (Added to fix banning w/ bb integration - Nibbler)
function udb_get_user_id($username)
{
    global $UDB_DB_LINK_ID, $UDB_DB_NAME_PREFIX, $CONFIG;

    $username = addslashes($username);

    $sql = "SELECT user_id " . "FROM " . $UDB_DB_NAME_PREFIX . PHPBB_TABLE_PREFIX . PHPBB_USER_TABLE . " " . "WHERE username = '$username'";

    $result = db_query($sql, $UDB_DB_LINK_ID);

    if (mysql_num_rows($result)) {
        $row = mysql_fetch_array($result);
        mysql_free_result($result);
        return $row['user_id'];
    } else {
        return '';
    }
}

// Redirect
function udb_redirect($target)
{
    header('Location: http://' . $_SERVER['HTTP_HOST'] . PHPBB_WEB_PATH . $target);
    exit;
}

// Register
function udb_register_page()
{
    $target = 'profile.php?mode=register';
    udb_redirect($target);
}
// HTML code for login/logout redirection
DEFINE("REDIR1",'<html><body onload="document.redir.submit();"><form name="redir" method="post" action="');
DEFINE("REDIR2",'"><input type="hidden" name="redirect" value="cpg_redir.php" /></form></body></html>');
DEFINE('LOGIN_REDIR', 'login.php?redirect=cpg_redir.php');
DEFINE('LOGOUT_FLAG', '&logout=true');
// Login
function udb_login_page()
{
    udb_redirect(LOGIN_REDIR);
}
// Logout
function udb_logout_page()
{
   if (PHPBB_LOGOUT_GET) {

       udb_redirect(LOGIN_REDIR.LOGOUT_FLAG);
   } else {
       echo(REDIR1.PHPBB_WEB_PATH.LOGIN_REDIR.LOGOUT_FLAG.REDIR2);
      exit();
   }
}
// Edit users
function udb_edit_users()
{
    $target = 'admin/index.php';
    udb_redirect($target);
}
// Get user information
function udb_get_user_infos($uid)
{
    global $UDB_DB_NAME_PREFIX, $UDB_DB_LINK_ID;
    global $lang_register_php;

    $sql = "SELECT username as user_name, user_email, user_regdate, " . "user_from as user_location, user_interests, user_website, user_occ as user_occupation " . "FROM " . $UDB_DB_NAME_PREFIX . PHPBB_TABLE_PREFIX . PHPBB_USER_TABLE . " " . "WHERE user_id = '$uid'";
    $result = db_query($sql, $UDB_DB_LINK_ID);
    if (!mysql_num_rows($result)) cpg_die(ERROR, $lang_register_php['err_unk_user'], __FILE__, __LINE__);

    $user_data = mysql_fetch_array($result);
    $user_data['group_name'] = '';
    mysql_free_result($result);

    return $user_data;
}
// Edit user profile
function udb_edit_profile($uid)
{
    $target = 'profile.php?mode=editprofile';
    udb_redirect($target);
}
// Query used to list users
function udb_list_users_query(&$user_count)
{
    global $CONFIG, $FORBIDDEN_SET;

    if ($FORBIDDEN_SET != "") $forbidden = "AND $FORBIDDEN_SET";
    $sql = "SELECT (category - " . FIRST_USER_CAT . ") as user_id," . "        '???' as user_name," . "        COUNT(DISTINCT a.aid) as alb_count," . "        COUNT(DISTINCT pid) as pic_count," . "        MAX(pid) as thumb_pid " . "FROM {$CONFIG['TABLE_ALBUMS']} AS a " . "INNER JOIN {$CONFIG['TABLE_PICTURES']} AS p ON p.aid = a.aid " . "WHERE approved = 'YES' AND category > " . FIRST_USER_CAT . " $forbidden GROUP BY category " . "ORDER BY category ";
    $result = db_query($sql);

    $user_count = mysql_num_rows($result);

    return $result;
}

function udb_list_users_retrieve_data($result, $lower_limit, $count)
{
    global $CONFIG, $UDB_DB_NAME_PREFIX, $UDB_DB_LINK_ID;

    mysql_data_seek($result, $lower_limit);

    $rowset = array();
    $i = 0;
    $user_id_set = '';

    while (($row = mysql_fetch_array($result)) && ($i++ < $count)) {
        $user_id_set .= $row['user_id'] . ',';
        $rowset[] = $row;
    }
    mysql_free_result($result);

    $user_id_set = '(' . substr($user_id_set, 0, -1) . ')';
    $sql = "SELECT user_id, username as user_name " . "FROM " . $UDB_DB_NAME_PREFIX . PHPBB_TABLE_PREFIX . PHPBB_USER_TABLE . " " . "WHERE user_id IN $user_id_set";
    $result = db_query($sql, $UDB_DB_LINK_ID);
    while ($row = mysql_fetch_array($result)) {
        $name[$row['user_id']] = $row['user_name'];
    }
    for($i = 0; $i < count($rowset); $i++) {
        $rowset[$i]['user_name'] = empty($name[$rowset[$i]['user_id']]) ? '???' : $name[$rowset[$i]['user_id']];
    }

    return $rowset;
}
// Group table synchronisation
function udb_synchronize_groups()
{
    global $CONFIG, $UDB_DB_NAME_PREFIX, $UDB_DB_LINK_ID;

    $PHPBB_groups = array(
        PHPBB_ADMIN_GROUP => 'Admin',
        PHPBB_MEMBERS_GROUP => 'Members',
        PHPBB_GUEST_GROUP => 'Guests',
        PHPBB_BANNED_GROUP => 'Banned',
        );

    $sql = "SELECT (ug.group_id + 5) as group_id, group_name " . "FROM " . $UDB_DB_NAME_PREFIX . PHPBB_TABLE_PREFIX . PHPBB_UGROUP_TABLE . " as ug " . "LEFT JOIN " . $UDB_DB_NAME_PREFIX . PHPBB_TABLE_PREFIX . PHPBB_GROUP_TABLE . " as g ON ug.group_id = g.group_id " . "WHERE user_pending=0 AND group_single_user=0";
    $result = db_query($sql, $UDB_DB_LINK_ID);
    while ($row = mysql_fetch_array($result)) {
        $PHPBB_groups[$row['group_id']] = $row['group_name'];
    }
    mysql_free_result($result);

    $result = db_query("SELECT group_id, group_name FROM {$CONFIG['TABLE_USERGROUPS']} WHERE 1");
    while ($row = mysql_fetch_array($result)) {
        $cpg_groups[$row['group_id']] = $row['group_name'];
    }
    mysql_free_result($result);
    // Scan Coppermine groups that need to be deleted
    foreach($cpg_groups as $c_group_id => $c_group_name) {
        if ((!isset($PHPBB_groups[$c_group_id]))) {
            db_query("DELETE FROM {$CONFIG['TABLE_USERGROUPS']} WHERE group_id = '" . $c_group_id . "' LIMIT 1");
            unset($cpg_groups[$c_group_id]);
        }
    }
    // Scan phpBB groups that need to be created inside Coppermine table
    foreach($PHPBB_groups as $i_group_id => $i_group_name) {
        if ((!isset($cpg_groups[$i_group_id]))) {
            db_query("INSERT INTO {$CONFIG['TABLE_USERGROUPS']} (group_id, group_name) VALUES ('$i_group_id', '" . addslashes($i_group_name) . "')");
            $cpg_groups[$i_group_id] = $i_group_name;
        }
    }
    // Update Group names
    foreach($PHPBB_groups as $i_group_id => $i_group_name) {
        if ($cpg_groups[$i_group_id] != $i_group_name) {
            db_query("UPDATE {$CONFIG['TABLE_USERGROUPS']} SET group_name = '" . addslashes($i_group_name) . "' WHERE group_id = '$i_group_id' LIMIT 1");
        }
    }
}
// Retrieve the album list used in gallery admin mode
function udb_get_admin_album_list()
{
    global $CONFIG, $UDB_DB_NAME_PREFIX, $UDB_DB_LINK_ID, $FORBIDDEN_SET;

    if (UDB_CAN_JOIN_TABLES) {
        $sql = "SELECT aid, CONCAT('(', username, ') ', title) AS title " . "FROM {$CONFIG['TABLE_ALBUMS']} AS a " . "INNER JOIN " . $UDB_DB_NAME_PREFIX . PHPBB_TABLE_PREFIX . PHPBB_USER_TABLE . " AS u ON category = (" . FIRST_USER_CAT . " + user_id) " . "ORDER BY title";
        return $sql;
    } else {
        $sql = "SELECT aid, IF(category > " . FIRST_USER_CAT . ", CONCAT('* ', title), CONCAT(' ', title)) AS title " . "FROM {$CONFIG['TABLE_ALBUMS']} " . "ORDER BY title";
        return $sql;
    }
}

function udb_util_filloptions()
{
    global $albumtbl, $picturetbl, $categorytbl, $lang_util_php, $CONFIG, $UDB_DB_NAME_PREFIX, $UDB_DB_LINK_ID;

    $usertbl = $UDB_DB_NAME_PREFIX.PHPBB_TABLE_PREFIX.PHPBB_USER_TABLE;

    if (UDB_CAN_JOIN_TABLES) {

        $query = "SELECT aid, category, IF(username IS NOT NULL, CONCAT('(', username, ') ', a.title), CONCAT(' - ', a.title)) AS title " . "FROM $albumtbl AS a " . "LEFT JOIN $usertbl AS u ON category = (" . FIRST_USER_CAT . " + user_id) " . "ORDER BY category, title";
        $result = db_query($query, $UDB_DB_LINK_ID);
        // $num=mysql_numrows($result);
        echo '<select size="1" name="albumid">';

        while ($row = mysql_fetch_array($result)) {
            $sql = "SELECT name FROM $categorytbl WHERE cid = " . $row["category"];
            $result2 = db_query($sql);
            $row2 = mysql_fetch_array($result2);

            print "<option value=\"" . $row["aid"] . "\">" . $row2["name"] . $row["title"] . "</option>\n";
        }

        print '</select> (3)';
        print '&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="'.$lang_util_php['submit_form'].'" class="submit" /> (4)';
        print '</form>';

    } else {

        // Query for list of public albums

        $public_albums = db_query("SELECT aid, title, category FROM {$CONFIG['TABLE_ALBUMS']} WHERE category < " . FIRST_USER_CAT . " ORDER BY title");

        if (mysql_num_rows($public_albums)) {
            $public_result = db_fetch_rowset($public_albums);
        } else {
            $public_result = array();
        }

        // Initialize $merged_array
        $merged_array = array();

        // Count the number of albums returned.
        $end = count($public_result);

        // Cylce through the User albums.
        for($i=0;$i<$end;$i++) {

            //Create a new array sow we may sort the final results.
            $merged_array[$i]['id'] = $public_result[$i]['aid'];
            $merged_array[$i]['album_name'] = $public_result[$i]['title'];

            // Query the database to get the category name.
            $vQuery = "SELECT name, parent FROM " . $CONFIG['TABLE_CATEGORIES'] . " WHERE cid='" . $public_result[$i]['category'] . "'";
            $vRes = mysql_query($vQuery);
            $vRes = mysql_fetch_array($vRes);
            if (isset($merged_array[$i]['username_category'])) {
                $merged_array[$i]['username_category'] = (($vRes['name']) ? '(' . $vRes['name'] . ') ' : '').$merged_array[$i]['username_category'];
            } else {
                $merged_array[$i]['username_category'] = (($vRes['name']) ? '(' . $vRes['name'] . ') ' : '');
            }

        }

        // We transpose and divide the matrix into columns to prepare it for use in array_multisort().
        foreach ($merged_array as $key => $row) {
           $aid[$key] = $row['id'];
           $title[$key] = $row['album_name'];
           $album_lineage[$key] = $row['username_category'];
        }

        // We sort all columns in descending order and plug in $album_menu at the end so it is sorted by the common key.
        array_multisort($album_lineage, SORT_ASC, $title, SORT_ASC, $aid, SORT_ASC, $merged_array);

        // Query for list of user albums

        $user_albums = db_query("SELECT aid, title, category FROM {$CONFIG['TABLE_ALBUMS']} WHERE category >= " . FIRST_USER_CAT . " ORDER BY aid");
        if (mysql_num_rows($user_albums)) {
            $user_albums_list = db_fetch_rowset($user_albums);
        } else {
            $user_albums_list = array();
        }

        // Query for list of user IDs and names

        $user_album_ids_and_names = db_query("SELECT (user_id + ".FIRST_USER_CAT.") as id, CONCAT('(', username, ') ') as name FROM $usertbl ORDER BY name ASC",$UDB_DB_LINK_ID);

        if (mysql_num_rows($user_album_ids_and_names)) {
            $user_album_ids_and_names_list = db_fetch_rowset($user_album_ids_and_names);
        } else {
            $user_album_ids_and_names_list = array();
        }

        // Glue what we've got together.

        // Initialize $udb_i as a counter.
        if (count($merged_array)) {
            $udb_i = count($merged_array);
        } else {
            $udb_i = 0;
        }

        //Begin a set of nested loops to merge the various query results.
        foreach ($user_albums_list as $aq) {
            foreach ($user_album_ids_and_names_list as $uq) {
                if ($aq['category'] == $uq['id']) {
                    $merged_array[$udb_i]['id']= $aq['category'];
                    $merged_array[$udb_i]['album_name']= $aq['title'];
                    $merged_array[$udb_i]['username_category']= $uq['name'];
                    $udb_i++;
                }
            }
        }

        // The user albums and public albums have been merged into one list. Print the dropdown.
        echo '<select size="1" name="albumid">';

        foreach ($merged_array as $menu_item) {

            echo "<option value=\"" . $menu_item['id'] . "\">" . (isset($menu_item['username_category']) ? $menu_item['username_category'] : '') . $menu_item['album_name'] . "</option>\n";

        }

        // Close list, etc.
        print '</select> (3)';
        print '&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="'.$lang_util_php['submit_form'].'" class="submit" /> (4)';
        print '</form>';

    }

}

// ------------------------------------------------------------------------- //
// Define wheter we can join tables or not in SQL queries (same host & same db or user)
define('UDB_CAN_JOIN_TABLES', (PHPBB_BD_HOST == $CONFIG['dbserver'] && (PHPBB_DB_NAME == $CONFIG['dbname'] || PHPBB_DB_USERNAME == $CONFIG['dbuser'])));
// define('UDB_CAN_JOIN_TABLES', false);
// Connect to phpBB database if necessary
$UDB_DB_LINK_ID = 0;
$UDB_DB_NAME_PREFIX = PHPBB_DB_NAME ? '`' . PHPBB_DB_NAME . '`.' : '';
if (!UDB_CAN_JOIN_TABLES) {
    $UDB_DB_LINK_ID = @mysql_connect(PHPBB_BD_HOST, PHPBB_DB_USERNAME, PHPBB_DB_PASSWORD);
    if (!$UDB_DB_LINK_ID) die("<b>Coppermine critical error</b>:<br />Unable to connect to phpBB Board database !<br /><br />MySQL said: <b>" . mysql_error() . "</b>");
}

?>