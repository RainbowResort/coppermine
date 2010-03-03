<?php
/**************************************************
  LightBox JS Slideshow Plugin for Coppermine Photo Gallery
  *************************************************
  Copyright (c) 2009 SaWey <>
  *************************************************
  1.3 Fixed selection of random photos. Contributed by pie86
  1.2 Fixed conflict with Nibbler's Youtube Mod
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  *************************************************
  Coppermine version: 1.4.x
***************************************************/
$name='Light Box';
$description= <<< EOT
This plugin will override the default popup that embeds the fullsize picture and it will show a nice Lightbox popup instead.
It features a slideshow as well, you can navigate through the images in the selected album with the arrow keys or with your mouse.
Expect a configuration menu in future versions. For now, edit the files as described in the support thread.
EOT;
$install_info = <<<EOT
          <a href="http://forum.coppermine-gallery.net/index.php/topic,59013.0.html" class="admin_menu">Plugin announcement thread</a>
EOT;
$author='<a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=40798" rel="external" class="external">Sander Weyens</a>, pluginized by <a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=60615" rel="external" class="external">jeepguy_1980</a>';
$version='1.4';
$plugin_cpg_version = array('min' => '1.4', 'max' => '1.4.99');
?>