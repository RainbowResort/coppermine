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
  Coppermine Plugin - BBCode Control
  ********************************************
  Copyright (c) 2008-2009 eenemeenemuu
**********************************************/

global $CONFIG, $enabled_languages_array, $lang_gallery_admin_menu;
// language detection
$lang = isset($CONFIG['lang']) ? $CONFIG['lang'] : 'english';
include('plugins/bbcode_control/lang/english.php');
if (in_array($lang, $enabled_languages_array) == TRUE && file_exists('plugins/bbcode_control/lang/'.$lang.'.php')) {
    include('plugins/bbcode_control/lang/'.$lang.'.php');
}

$name = 'BBCode Control';
$version = '1.5';
$description = <<< EOT
<ul>
    <li>{$lang_plugin_bbcode_control['description_new_codes']}</li>
    <li>{$lang_plugin_bbcode_control['description_control_codes']}</li>
    <li>{$lang_plugin_bbcode_control['description_buttons']}</li>
    <li>{$lang_plugin_bbcode_control['show_in_file_info']}</li>
</ul>
EOT;
$author = '<a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=24278" rel="external" class="external">eenemeenemuu</a>';

$announcement_icon = cpg_fetch_icon('announcement', 1);
$config_icon = cpg_fetch_icon('config', 1);

$extra_info = <<<EOT
    <a href="index.php?file=bbcode_control/admin" class="admin_menu">{$config_icon}$name {$lang_gallery_admin_menu['admin_lnk']}</a>
    <a href="http://forum.coppermine-gallery.net/index.php/topic,57432.0.html" rel="external" class="admin_menu">{$announcement_icon}{$lang_plugin_bbcode_control['announcement_thread']}</a>
EOT;

$install_info = <<<EOT
    {$lang_plugin_bbcode_control['install_info']}
    <a href="http://forum.coppermine-gallery.net/index.php/topic,57432.0.html" rel="external" class="admin_menu">{$announcement_icon}{$lang_plugin_bbcode_control['announcement_thread']}</a>
EOT;
?>