<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2009 Coppermine Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/trunk/cpg1.5.x/albmgr.php $
  $Revision: 6131 $
  $LastChangedBy: gaugau $
  $Date: 2009-06-10 08:42:56 +0200 (Mi, 10 Jun 2009) $
**********************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

require_once "./plugins/album_fav_boxes/lang/english.php";
if ($CONFIG['lang'] != 'english' && file_exists("./plugins/album_fav_boxes/lang/{$CONFIG['lang']}.php")) {
	require_once "./plugins/album_fav_boxes/lang/{$CONFIG['lang']}.php";
}

$name        = $lightbox['lang']['plugin_name'];
$description = $lightbox['lang']['plugin_description'];
$author      = 'Nibbler';
$version     = '2.0';
?>
