<?php
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.4.1                                            //
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

/**
* Coppermine Photo Gallery 1.3.0 addpic.php
*
* This file file gets called in the img src when you do batch add, there is nothing
* much to look here the grunt work is done by the function add_picture
*
* @copyright 2002,2003 Gregory DEMAR, Coppermine Dev Team
* @license http://opensource.org/licenses/gpl-license.php GNU General Public License V2
* @package Coppermine
* @version $Id$
*/

/**
* @ignore
*/
define('IN_COPPERMINE', true);

define('ADDPIC_PHP', true);

require('include/init.inc.php');
require('include/picmgmt.inc.php');

if (!GALLERY_ADMIN_MODE) die('Access denied');

$aid = (int)$_GET['aid'];
$pic_file = base64_decode($_GET['pic_file']);
$dir_name = dirname($pic_file) . "/";
$file_name = basename($pic_file);

// Get the forbidden characters from the Config console string, and do any necessary translation. Return the translated string.
$forbidden_chars = strtr($CONFIG['forbiden_fname_char'], array('&amp;' => '&', '&quot;' => '"', '&lt;' => '<', '&gt;' => '>'));

// Create the holder $picture_name by translating the file name. Translate any forbidden character into an underscore.
$sane_name = strtr($file_name, $forbidden_chars, str_repeat('_', strlen($CONFIG['forbiden_fname_char'])));
$source = "./" . $CONFIG['fullpath'] . $dir_name . $file_name;
rename($source, "./" . $CONFIG['fullpath'] . $dir_name . $sane_name);
$sql = "SELECT pid " . "FROM {$CONFIG['TABLE_PICTURES']} " . "WHERE filepath='" . addslashes($dir_name) . "' AND filename='" . addslashes($file_name) . "' " . "LIMIT 1";
$result = cpg_db_query($sql);

if (mysql_num_rows($result)) {
    $file_name = "images/up_dup.gif";
} elseif (add_picture($aid, $dir_name, $sane_name)) {
    $file_name = "images/up_ok.gif";
} else {
    $file_name = "images/up_pb.gif";
    echo $ERROR;
}

if (ob_get_length()) {
    ob_end_flush();
    exit;
}

header('Content-type: image/gif');
echo fread(fopen($file_name, 'rb'), filesize($file_name));
ob_end_flush()
?>
