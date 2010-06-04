<?php
/**************************************************
  Coppermine 1.5.x Plugin - mass_import
  *************************************************
  Copyright (c) 2010 Nibbler
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

require_once './plugins/mass_import/init.inc.php';
$mass_import_init_array = mass_import_initialize();
$lang_plugin_mass_import = $mass_import_init_array['language']; 
$mass_import_icon_array = $mass_import_init_array['icon'];

$name = $lang_plugin_mass_import['name'];
$description = $lang_plugin_mass_import['description'];
$author = '<a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=941">Nibbler</a>, ';
$author.= '<a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=10059">Donnoman</a> (<a href="http://cpg-contrib.org">cpg-contrib.org</a>), ';
$author.= '<a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=15025">Flux</a>, ';
$author.= '<a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=23938">Paul Van Rompay</a>, ';
$author.= '<a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=2">Joachim Müller</a>';
$version = '3.4';
$plugin_cpg_version = array('min' => '1.5');
$extra_info = <<<EOT
    <a href="http://forum.coppermine-gallery.net/index.php/topic,61281.0.html" class="admin_menu">{$mass_import_icon_array['announcement']}{$lang_plugin_mass_import['announcement_thread']}</a>&nbsp;
    <a href="index.php?file=mass_import/import" class="admin_menu" title="{$lang_plugin_mass_import['description']}">{$mass_import_icon_array['menu']}{$lang_plugin_mass_import['admin_title']}</a>
EOT;
$install_info = <<<EOT
    <a href="javascript:;" onclick="MM_openBrWindow('plugins/mass_import/images/screenshot.png','','scrollbars=yes,toolbar=no,status=no,resizable=yes,width=661,height=330')"><img src="plugins/mass_import/images/thumb_screenshot.png" border="0" width="128" height="64" alt="" align="right" style="padding-left:10px;" /></a>
    {$lang_plugin_mass_import['install_info']}<br />&nbsp;<br /><a href="http://forum.coppermine-gallery.net/index.php/topic,61281.0.html" class="admin_menu">{$mass_import_icon_array['announcement']}{$lang_plugin_mass_import['announcement_thread']}</a>
EOT;
?>