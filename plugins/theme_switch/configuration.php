<?php
/**************************************************
  Coppermine 1.5.x Plugin - Theme switch
  *************************************************
  Copyright (c) 2010-2012 eenemeenemuu
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

require "./plugins/theme_switch/lang/english.php";
if ($CONFIG['lang'] != 'english' && file_exists("./plugins/theme_switch/lang/{$CONFIG['lang']}.php")) {
    require "./plugins/theme_switch/lang/{$CONFIG['lang']}.php";
}

global $lang_gallery_admin_menu;

$name = $lang_plugin_theme_switch['theme_switch'];
$description = $lang_plugin_theme_switch['description'];
$author = '<a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=24278" rel="external" class="external">eenemeenemuu</a>';
$version = '1.0';
$plugin_cpg_version = array('min' => '1.5');
$extra_info = $install_info = '<a href="http://forum.coppermine-gallery.net/index.php/topic,74827.0.html" rel="external" class="admin_menu">'.cpg_fetch_icon('announcement', 1).$lang_plugin_theme_switch['announcement_thread'].'</a>';
$extra_info = '<a href="index.php?file=theme_switch/admin" class="admin_menu">'.cpg_fetch_icon('config', 1)."$name {$lang_gallery_admin_menu['admin_lnk']}</a>".$extra_info;

?>
