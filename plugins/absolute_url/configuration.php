<?php
/**************************************************
  Coppermine 1.5.x Plugin - absolute_url
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

$name = 'Absolute picture urls';
$description = 'Creates absolute picture urls by adding your domain name to the relative paths.';
$author = '<a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=24278" rel="external" class="external">eenemeenemuu</a>';
$version = '2.0';
$plugin_cpg_version = array('min' => '1.5');

$announcement_icon = cpg_fetch_icon('announcement', 1);
$config_icon = cpg_fetch_icon('config', 1);
$install_info = <<< EOT
    <a href="http://forum.coppermine-gallery.net/index.php/topic,67980.0.html" rel="external" class="admin_menu">{$announcement_icon}Announcement thread</a>
EOT;
$extra_info = $install_info. <<< EOT
    <a href="index.php?file=absolute_url/admin" class="admin_menu">{$config_icon}$name {$lang_gallery_admin_menu['admin_lnk']}</a>
EOT;
?>