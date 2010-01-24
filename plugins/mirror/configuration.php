<?php
/**************************************************
  Coppermine 1.5.x Plugin - Mirror
  *************************************************
  Copyright (c) 2010 Timo Schewe (www.timos-welt.de)
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


$name = 'Mirror';
$description = 'Add a mirror reflection to the image on displayimage.php';
$author = '<a href="http://www.timos-welt.de" rel="external" class="external">Timos Schewe</a>';
$version = '1.3';
$plugin_cpg_version = array('min' => '1.5');
$mirror_icon_announcement = cpg_fetch_icon('announcement', 1);
$announcement_thread = '<a href="http://forum.coppermine-gallery.net/index.php/topic,62636.0.html" rel="external" class="admin_menu">' . $mirror_icon_announcement . 'Announcement thread</a>';
$install_info = 'This plugin requires no configuration.';
if ($CONFIG['transparent_overlay'] != '0') {
    $install_info .= 'Will only work if \'Insert a transparent overlay to minimize image theft\' is deactivated.';
}
$install_info .= '<br />' . $announcement_thread;
$extra_info = $announcement_thread;
?>