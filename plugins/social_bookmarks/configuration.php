<?php
/********************************************
  social_bookmarks plugin for cpg1.5.x
  *******************************************
  Copyright (c) 2003-2009 Coppermine Dev Team

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

if (!defined('IN_COPPERMINE')) {
    die('Not in Coppermine...');
}

require_once './plugins/social_bookmarks/include/init.inc.php';
$social_bookmarks_init_array = social_bookmarks_initialize();
$lang_plugin_social_bookmarks = $social_bookmarks_init_array['language']; 
$social_bookmarks_icon_array = $social_bookmarks_init_array['icon'];

$name = $lang_plugin_social_bookmarks['name'];
$description = $lang_plugin_social_bookmarks['description'];
$author = '<a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=2">Joachim Müller</a>';
$version = '1.5';

$install_info = <<<EOT
    <a href="http://forum.coppermine-gallery.net/index.php/topic,61671.0.html" class="admin_menu">{$social_bookmarks_icon_array['announcement']}{$lang_plugin_social_bookmarks['announcement_thread']}</a>&nbsp;
    
EOT;
$extra_info .= <<<EOT
    <a href="index.php?file=social_bookmarks/admin" class="admin_menu">{$social_bookmarks_icon_array['configure']}{$lang_plugin_social_bookmarks['config']}</a>&nbsp;
    <a href="http://forum.coppermine-gallery.net/index.php/topic,61671.0.html" class="admin_menu">{$social_bookmarks_icon_array['announcement']}{$lang_plugin_social_bookmarks['announcement_thread']}</a>

EOT;
?>