<?php
/**************************************************
  Coppermine 1.5.x Plugin - Vote for albums
  *************************************************
  Copyright (c) 2012 eenemeenemuu
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**************************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

$aid = $superCage->get->getInt('aid');
$type = $superCage->get->getInt('type');
$cat = $superCage->get->keyExists('cat') ? $superCage->get->getInt('cat') : false;

if (USER_ID) {
    $aid = $superCage->get->getInt('aid');
    $type = $superCage->get->getInt('type');
    $cat = $superCage->get->keyExists('cat') ? $superCage->get->getInt('cat') : false;
    if ($superCage->get->getInt('action') == 1) {
        if (!album_voting_user_voted($aid, $type)) {
            cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_PREFIX']}album_votes VALUES('$aid', '".USER_ID."', '$type', '".time()."')");
        }
    } else {
        cpg_db_query("DELETE FROM {$CONFIG['TABLE_PREFIX']}album_votes WHERE aid = $aid AND type = $type AND user_id = ".USER_ID);
    }
}

if ($cat !== false) {
    header("Location: index.php?cat=$cat");
} else {
    header("Location: thumbnails.php?album=$aid");
}

?>