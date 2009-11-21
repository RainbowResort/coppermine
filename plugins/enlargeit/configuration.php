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
  
$name = 'EnlargeIt!';
$description = 'AJAX GUI for Coppermine 1.5.x to seamlessly open the image embedded into the output on the thumbnail page, with an optional greybox feature and a detailed configuration screen.';
$author = '<a href="http://www.timos-welt.de/" rel="external" class="external">Timos-Welt</a>';
$version = '0.8';
$install_info = "You can configure the plugin after installation, use the button on the plugin manager. If you want ImageFlow or Slider plugins to use EnlargeIt!, install them together with this plugin and switch the settings on their config pages.";
$extra_info = 'This plugin is currently an alpha version. Not all features will work, especially the AJAX parts. Thanks for understanding.';
$announcement_thread = '<a href="http://forum.coppermine-gallery.net/index.php/topic,57424.0.html" rel="external" class="admin_menu external">'.$enlargeit_icon_array['announcement'].'Announcement thread</a>';
$configuration_link = '<a href="index.php?file=enlargeit/plugin_config" title="Configure EnlargeIt!" class="admin_menu">'.$enlargeit_icon_array['configure'].'EnlargeIt! Configuration</a>';
$install_info .= '<br />' . $announcement_thread;
$extra_info .= '<br />' . $configuration_link . '&nbsp;' . $announcement_thread;
?>