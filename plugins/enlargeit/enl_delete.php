<?php
/**************************************************
  Coppermine 1.4.x Plugin - EnlargeIt! $VERSION$=2.15
  *************************************************
  Copyright (c) 2008 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ***************************************************/

define('IN_COPPERMINE', true);
define('DELETE_PHP', true);

require('include/init.inc.php');

/**
 * Local functions definition
 */

$header_printed = false;
$need_caption = false;


function enl_die($enl_error)
{
	global $lang_back;
	echo '<table cellspacing="1" style="width:100%;height:100%">';
	echo '<tr>';
	echo '<td class="enl_infotablehead" align="center"><b>';
	echo $enl_error;
	echo '</b></td>';
	echo '</tr>';
	echo '</table>';
	exit();
}

function enl_message($enl_message)
{
	global $lang_back;
	echo '<table cellspacing="1" style="width:100%;height:100%">';
	echo '<tr>';
	echo '<td class="enl_infotablehead" align="center"><b>';
	echo $enl_message;
	echo '</b></td>';
	echo '</tr>';
	echo '</table>';
}


/**
 * Main code starts here
 */

if (!isset($_GET['what']) && !isset($_POST['what'])) {
    enl_die($lang_errors['param_missing']);
}

$what = isset($_GET['what']) ? $_GET['what'] : $_POST['what'];
switch ($what) {



    // Comment

    case 'comment':
        $msg_id = (int)$_GET['msg_id'];

        $result = cpg_db_query("SELECT pid FROM {$CONFIG['TABLE_COMMENTS']} WHERE msg_id='$msg_id'");
        if (!mysql_num_rows($result)) {
            enl_die($lang_errors['non_exist_comment']);
        } else {
            $comment_data = mysql_fetch_array($result);
        }

        if (GALLERY_ADMIN_MODE) {
            $query = "DELETE FROM {$CONFIG['TABLE_COMMENTS']} WHERE msg_id='$msg_id'";
        } elseif (USER_ID) {
            $query = "DELETE FROM {$CONFIG['TABLE_COMMENTS']} WHERE msg_id='$msg_id' AND author_id ='" . USER_ID . "' LIMIT 1";
        } else {
            $query = "DELETE FROM {$CONFIG['TABLE_COMMENTS']} WHERE msg_id='$msg_id' AND author_md5_id ='{$USER['ID']}' AND author_id = '0' LIMIT 1";
        }
        $result = cpg_db_query($query);

        enl_message($lang_delete_php['comment_deleted']);
        ob_end_flush();
        break;



    // Unknow command

    default:
        enl_die($lang_errors['param_missing']);
}

?>
