<?php
/**************************************************
  Coppermine 1.5.x Plugin - GeoData
  *************************************************
  Copyright (c) 2010 Pierre BASMOREAU
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  $HeadURL: 
  $Revision: 
  $LastChangedBy: 
  $Date: 2011/08/22
  **************************************************/

$name='GeoData';
$description='Create geolocation (only admin) and show pictures on Google Maps (for all users)';
$author='<a href="http://pierre.basmoreau.free.fr" rel="external" class="external">Pierre BASMOREAU</a>';
$version='1.0';
$plugin_cpg_version = array('min' => '1.5');
$install_info = "You may configure the plugin after installation, use the button on plugin manager page.";
$extra_info = '<a class="admin_menu" href="index.php?file=geodata/plugin_config" title="Configure GeoData">GeoData Configuration</a> '
    . '<a class="admin_menu" href="#" rel="external" title="GeoData Support">Announcement thread</a>';

?>