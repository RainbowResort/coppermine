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
  Coppermine version: 1.5.x
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**********************************************/
/*********************************************
  Coppermine Plugin - Album Addfav
  ********************************************
  Copyright (c) 2010 eenemeenemuu
**********************************************/

define('IN_COPPERMINE', true);

$superCage = Inspekt::makeSuperCage();

if (!$superCage->get->keyExists('aid')) {
    cpg_die(CRITICAL_ERROR, $lang_errors['param_missing'], __FILE__, __LINE__);
}

$aid = $superCage->get->getInt('aid');

$result = cpg_db_query("SELECT pid FROM {$CONFIG['TABLE_PICTURES']} WHERE aid = $aid");
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
    if (!in_array($row['pid'], $FAVPICS)) {
        $FAVPICS[] = $row['pid'];
    }
}

$data = base64_encode(serialize($FAVPICS));
setcookie($CONFIG['cookie_name'] . '_fav', $data, time() + 86400 * 30, $CONFIG['cookie_path']);

if (USER_ID) {
    $sql = "SELECT COUNT(*) FROM {$CONFIG['TABLE_FAVPICS']} WHERE user_id = " . USER_ID;
    $count = mysql_result(cpg_db_query($sql), 0);

    if ($count) {
        $sql = "UPDATE {$CONFIG['TABLE_FAVPICS']} SET user_favpics = '$data' WHERE user_id = " . USER_ID;
    } else {
        $sql = "INSERT INTO {$CONFIG['TABLE_FAVPICS']} (user_id, user_favpics) VALUES (" . USER_ID . ", '$data')";
    }
    cpg_db_query($sql);
}

header("Location: thumbnails.php?album=$aid");
?>
