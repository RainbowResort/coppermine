<?php
/**************************************************
  Coppermine 1.5.x Plugin - move_to_public
  *************************************************
  Copyright (c) 2010 eenemeenemuu
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

if (!defined('IN_COPPERMINE')) {
    die('Not in Coppermine...');
}

require_once './plugins/move_to_public/init.inc.php';
$move_to_public_init_array = move_to_public_initialize();
$lang_plugin_move_to_public = $move_to_public_init_array['language']; 
$move_to_public_icon_array = $move_to_public_init_array['icon'];

$name = $lang_plugin_move_to_public['name'];
$description = $lang_plugin_move_to_public['description'];
$author = '<a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=24278">eenemeenemuu</a>';
$version='2.2';
$plugin_cpg_version = array('min' => '1.5');
$extra_info = <<<EOT
    <a href="http://forum.coppermine-gallery.net/index.php/topic,61281.0.html" class="admin_menu">{$move_to_public_icon_array['announcement']}{$lang_plugin_move_to_public['announcement_thread']}</a>&nbsp;
    <a href="index.php?file=move_to_public/index" class="admin_menu" title="{$lang_plugin_move_to_public['description']}">{$move_to_public_icon_array['menu']}{$lang_plugin_move_to_public['admin_title']}</a>
EOT;
$install_info = <<<EOT
    
    {$lang_plugin_move_to_public['install_info']}<br />&nbsp;<br /><a href="http://forum.coppermine-gallery.net/index.php/topic,61281.0.html" class="admin_menu">{$move_to_public_icon_array['announcement']}{$lang_plugin_move_to_public['announcement_thread']}</a>
EOT;
?>
