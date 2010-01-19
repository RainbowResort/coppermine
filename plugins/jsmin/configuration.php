<?php
/**************************************************
  Coppermine 1.5.x Plugin - JSMin
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
  
$name='JSmin';
$description='<p>This plugin combines all javascript files of the gallery pages to two compressed ones by removing unneeded stuff (e. g. comments) and using zlib functionality where possible.</p>';
$author='<a href="http://www.timos-welt.de" rel="external" class="external">Timo Schewe</a>';
$version='1.1';
$install_info = "There's nothing to configure after installation.";
$extra_info = '<a class="admin_menu" href="plugins/jsmin/docs/english.htm" title="Documentation">JSmin Documentation</a> <a class="admin_menu" href="plugins/jsmin/cache/clearcache.php" title="Clear Cache">Clear cache</a> <a class="admin_menu" href="http://forum.coppermine-gallery.net/index.php/topic,63223.0.html" title="JSmin Support">JSmin Support</a>'
    . '<p>This plugin has no effect in admin mode, log off to see it working.</p>';
?>