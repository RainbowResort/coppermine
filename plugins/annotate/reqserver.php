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
  Coppermine Plugin - Picture Annotation
  ********************************************
  Created by Nibbler for cpg1.4.x - ported to cpg1.5.x by eenemeenemuu 
**********************************************/

if (!defined('IN_COPPERMINE')) die("0");

if (!USER_ID) die('Access denied');

$superCage = Inspekt::makeSuperCage();

if ($superCage->post->keyExists('add')){

    $pid = $superCage->post->getInt('add');
    $nid = $superCage->post->getInt('nid');
    $posx = $superCage->post->getInt('posx');
    $posy = $superCage->post->getInt('posy');
    $width = $superCage->post->getInt('width');
    $height = $superCage->post->getInt('height');
    $note = addslashes(urldecode($superCage->post->getRaw('note')));

    if ($nid){
    
        $sql = "UPDATE {$CONFIG['TABLE_PREFIX']}notes SET posx = $posx, posy = $posy, width = $width, height = $height, note = '$note' WHERE nid = $nid";
        if (!GALLERY_ADMIN_MODE) $sql .= " AND user_id = " . USER_ID . " LIMIT 1";
        cpg_db_query($sql);
        die("$nid");

    } else {
        $sql = "INSERT INTO {$CONFIG['TABLE_PREFIX']}notes (pid, posx, posy, width, height, note, user_id) VALUES ($pid, $posx, $posy, $width, $height, '$note', " . USER_ID . ")";
        cpg_db_query($sql);
        $nid = mysql_insert_id($CONFIG['LINK_ID']);
        die("$nid");
    }

} elseif ($superCage->post->keyExists('remove')){

    $nid = $superCage->post->getInt('remove');

    $sql = "DELETE FROM {$CONFIG['TABLE_PREFIX']}notes WHERE nid = $nid";
    if (!GALLERY_ADMIN_MODE) $sql .= " AND user_id = " . USER_ID . " LIMIT 1";
    
    cpg_db_query($sql);
    die("$nid");
}

die("0");