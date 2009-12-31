<?php
/**************************************************
  Coppermine 1.5.x Plugin - Image manipulation
  *************************************************
  Copyright (c) 2009 Timos-Welt (www.timos-welt.de)
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

require('./plugins/image_manipulation/init.inc.php');
  
$name = $lang_plugin_im['display_name'];
$description = $lang_plugin_im['description'];
$author = 'Timo Schewe (<a href="http://www.timos-welt.de/" rel="external" class="external">Timos-Welt</a>)';
$version = '1.1';
$install_info = $lang_plugin_im['install_info'];
$extra_info = $lang_plugin_im['extra_info'];
$announcement_thread = '<a href="http://forum.coppermine-gallery.net/index.php/topic,62875.0.html" rel="external" class="admin_menu">'.$lang_plugin_im['announcement_thread'].'</a>';
$configuration_link = '<a href="index.php?file=image_manipulation/admin" class="admin_menu">'.$lang_plugin_im['im_configuration'].'</a>';
$documentation_link = '<a href="plugins/image_manipulation/docs/' . $documentation_file  . '.htm" class="admin_menu">'.$lang_plugin_im['im_documentation'].'</a>';
$install_info .= '<br />' . $announcement_thread . '&nbsp;' . $documentation_link;
$extra_info .= '<br />' . $configuration_link . '&nbsp;' . $announcement_thread . '&nbsp;' . $documentation_link;
?>
