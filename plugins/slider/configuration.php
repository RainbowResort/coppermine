<?php
/**************************************************
  Coppermine 1.5.x Plugin - Slider
  *************************************************
  Copyright (c) 2010 Timos-Welt (www.timos-welt.de)
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

$name='Slider';
$description='Shows a Javascript slider on album list page with EnlargeIt! integration';
$author='<a href="http://www.timos-welt.de" rel="external" class="external">Timos-Welt</a>';
$version='0.5';
$install_info = "You may configure the plugin after installation, use the button on plugin manager page.";
$extra_info = '<a class="admin_menu" href="index.php?file=slider/plugin_config" title="Configure Slider">Slider Configuration</a> '
    . '<a class="admin_menu" href="http://forum.coppermine-gallery.net/index.php/topic,57388.0.html" rel="external" title="Slider Support">Announcement thread</a>'
    . '<br />To enable this plugin (make it actually display the slider animation), the string "slider" (separated with a slash) has to be added to "the content of the main page" in Coppermine\'s config in the section "Album list view". The setting should now look like "breadcrumb/catlist/alblist/slider" or similar. To change the position of the block, move the string "slider" around inside that config field.';
?>