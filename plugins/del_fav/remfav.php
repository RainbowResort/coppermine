<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2006 Coppermine Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  ********************************************
	Delete fav plugin by B.Mossavari
**********************************************/

$ref = $CONFIG['site_url'] . (isset($_GET['ref']) ? $_GET['ref'] : "index.php");
$ref = str_replace('&amp;', '&', $ref);

// Remove all favorite from cookie
    $FAVPICS = array();

$data = base64_encode(serialize($FAVPICS));
setcookie($CONFIG['cookie_name'] . '_fav', $data, time() + 86400 * 30, $CONFIG['cookie_path']);
// If the user is logged in then put it in the DB
if (USER_ID > 0) {
    $sql = "UPDATE {$CONFIG['TABLE_FAVPICS']} SET user_favpics = '$data' WHERE user_id = " . USER_ID;
    cpg_db_query($sql);
    // User never stored a fav... so insert new row
    if (!mysql_affected_rows($CONFIG['LINK_ID'])) {
        $sql = "INSERT INTO {$CONFIG['TABLE_FAVPICS']} ( user_id, user_favpics) VALUES (" . USER_ID . ", '$data')";
        cpg_db_query($sql);
    }
}

$header_location = (@preg_match('/Microsoft|WebSTAR|Xitami/', getenv('SERVER_SOFTWARE'))) ? 'Refresh: 30; URL=' : 'Location: ';
header($header_location . $ref);
pageheader($lang_info, "<meta http-equiv=\"refresh\" content=\"1;url=$ref\">");
msg_box($lang_info, $lang_plugin_delfav['delete_msg'], $lang_continue, $ref);
pagefooter();
ob_end_flush();
?>