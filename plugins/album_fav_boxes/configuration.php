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

function initialize_languages() {
	global $lightbox;
	require_once "./plugins/album_fav_boxes/lang/english.php";
	if ($CONFIG['lang'] != 'english' && file_exists("./plugins/album_fav_boxes/lang/{$CONFIG['lang']}.php")) {
		require_once "./plugins/album_fav_boxes/lang/{$CONFIG['lang']}.php";
	}
	return $lightbox;
} 

$lightbox = initialize_languages();
$lightbox_lang = $lightbox['lang'];

$name        = $lightbox_lang['plugin_name'];
$description = $lightbox_lang['plugin_description'];
$author      = 'Nibbler';
$version     = '2.1';
$extra_info = <<<EOT
    <a href="http://forum.coppermine-gallery.net/index.php/topic,60278.0.html" class="admin_menu">{$lightbox['lang']['Announcement thread']}</a>
EOT;

$install_info = $extra_info;
?>
