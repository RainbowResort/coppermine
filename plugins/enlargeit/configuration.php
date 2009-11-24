<?php
/**************************************************
  Coppermine 1.5.x Plugin - EnlargeIt!
  *************************************************
  Copyright (c) 2009 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  Coppermine version: 1.5.2
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
  **************************************************/
  
require('./plugins/enlargeit/init.inc.php');
  
$name = $lang_plugin_enlargeit['display_name'];
$description = $lang_plugin_enlargeit['description'];
$author = '<a href="http://www.timos-welt.de/" rel="external" class="external">Timos-Welt</a>';
$version = '1.0';
$install_info = $lang_plugin_enlargeit['install_info'];
$extra_info = $lang_plugin_enlargeit['extra_info'];
$announcement_thread = '<a href="http://forum.coppermine-gallery.net/index.php/topic,57424.0.html" rel="external" class="admin_menu external">'.$enlargeit_icon_array['announcement'].$lang_plugin_enlargeit['announcement_thread'].'</a>';
$configuration_link = '<a href="index.php?file=enlargeit/admin" class="admin_menu">'.$enlargeit_icon_array['configure'].$lang_plugin_enlargeit['enlargeit_configuration'].'</a>';
$install_info .= '<br />' . $announcement_thread;
$extra_info .= '<br />' . $configuration_link . '&nbsp;' . $announcement_thread;
?>