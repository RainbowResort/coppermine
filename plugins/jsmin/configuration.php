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
  
$name='JSMin';
$description='<p>THIS PLUGIN MUST BE THE LAST IN THE CHAIN! MOVE ALL WAY DOWNWARDS IN PLUGIN MANAGER! This plugin combines all javascript files to one and removes unneeded stuff (e. g. comments).</p>';
$author='<a href="http://www.timos-welt.de"  rel="external" class="external">Timos-Welt</a>';
$version='0.4';
$install_info = "There's nothing to configure after installation.";
$extra_info = '<span class="admin_menu external"><a href="plugins/jsmin/cache/clearcache.php" rel="external" title="Clear Cache">Clear cache</a></span> <span class="admin_menu external"><a href="http://forum.coppermine-gallery.net/index.php" rel="external" title="JSmin Support">JSmin Support</a></span>'
    . '<p>This plugin MUST be the last one in the chain! Move it all the way downwards in plugin manager. This plugin has no effect in admin mode, log off to see it working.</p>';
?>