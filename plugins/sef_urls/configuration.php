<?php
/**************************************************
  Coppermine 1.5.x Plugin - sef_urls
  *************************************************
  Copyright (c) 2003-2007 Coppermine Dev Team
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

$name = 'Search Engine Friendly URLs';
$description = 'Makes SEF URLs for index, thumbnails, and displayimage.php. (Apache webserver only!)<br />Warning: this plugin is still experimental, there are known issues when using it. Test thoroughly and use at your own risk.<br />When getting unexpected results, disable the plugin and remove the .htaccess file the plugin creates manually (using your FTP app).';
$author = 'Coppermine Development Team';
$version = '2.0beta4';
$plugin_cpg_version = array('min' => '1.5');
$install_info = "If anything goes wrong when installing this plugin and you cannot access your gallery at all anymore, it's a good idea to remove the .htaccess file in the root of your gallery and deleting the plugin via FTP.";
$extra_info = '<span class="admin_menu external"><a href="http://forum.coppermine-gallery.net/index.php/topic,42568.0.html" rel="external" title="SEF URLs support">SEF_URLs announcement thread</a></span>';
?>