<?php
/**************************************************
  Coppermine 1.5.x Plugin - album_fav_boxes!
  *************************************************
  Copyright (c) 2009 Nibbler
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/branches/cpg1.5.x/plugins/enlargeit/admin.php $
  $Revision: 6793 $
  $LastChangedBy: gaugau $
  $Date: 2009-11-26 18:23:33 +0100 (Do, 26. Nov 2009) $
  **************************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

function initialize_languages() {
    global $lightbox, $CONFIG;
    require_once "./plugins/album_fav_boxes/lang/english.php";
    if ($CONFIG['lang'] != 'english' && file_exists("./plugins/album_fav_boxes/lang/{$CONFIG['lang']}.php")) {
        require_once "./plugins/album_fav_boxes/lang/{$CONFIG['lang']}.php";
    }
    return $lightbox;
} 

require_once('./plugins/album_fav_boxes/icons.inc.php');

$lightbox = initialize_languages();
$lightbox_lang = $lightbox['lang'];

$name        = $lightbox_lang['plugin_name'];
$description = $lightbox_lang['plugin_description'];
$author      = 'Nibbler';
$version     = '2.4';
$plugin_cpg_version = array('min' => '1.5');
$announcement_button = <<<EOT
    <a href="http://forum.coppermine-gallery.net/index.php/topic,60278.0.html" class="admin_menu external">{$album_fav_boxes_icon_array['announcement']}{$lightbox['lang']['Announcement thread']}</a>
EOT;
$config_button = <<<EOT
    <a href="index.php?file=album_fav_boxes/admin" class="admin_menu">{$album_fav_boxes_icon_array['config']}{$lightbox['lang']['Configuration']}</a>
EOT;

$extra_info = $config_button . ' ' . $announcement_button;
$install_info = $lightbox['lang']['install_instructions'] . '<br />&nbsp;<br />' . $announcement_button;
?>
