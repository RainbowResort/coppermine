<?php
/**************************************************
  Coppermine 1.5.x Plugin - sef_urls
  *************************************************
  Copyright (c) 2003-2010 Coppermine Dev Team
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
  
require_once './plugins/sef_urls/lang/english.php';
if ($CONFIG['lang'] != 'english' && file_exists('./plugins/sef_urls/lang/' . $CONFIG['lang'] . '.php')) {
    require_once './plugins/sef_urls/lang/' . $CONFIG['lang'] . '.php';
}
  
$name = $lang_plugin_sef_urls['name'];
$description = <<< EOT
{$lang_plugin_sef_urls['description']}<br />
{$lang_plugin_sef_urls['known_issues_warning']}
EOT;
$author = 'Coppermine Developer Team';
$version = '2.1';
$plugin_cpg_version = array('min' => '1.5');
$announcement_thread_link = <<< EOT
<a href="http://forum.coppermine-gallery.net/index.php/topic,42568.0.html" rel="external" class="admin_menu">{$lang_plugin_sef_urls['announcement_thread']}</a>
EOT;
$configuration_link = 'a href="">' . sprintf($lang_plugin_sef_urls['configure_x'], $lang_plugin_sef_urls['name']) . '</a>';
$install_info = <<< EOT
{$lang_plugin_sef_urls['recovery_instructions']}<br />
{$announcement_thread_link}
EOT;
$extra_info = <<< EOT
{$announcement_thread_link} {$configuration_link}
EOT;
?>