<?php
/**************************************************
  Coppermine 1.5.x Plugin - Geo IP Lookup (geoip)
  *************************************************
  Copyright (c) 2010 Joachim Müller
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

if (!defined('IN_COPPERMINE')) {
    die('Not in Coppermine...');
}

//Language file strings
$lang_plugin_geoip['plugin_name'] = 'Geo IP Lookup';
$lang_plugin_geoip['plugin_description'] = 'Looks up the countries to the IP addresses your visitors come from and displays a flag icon next to each IP address (admin-only feature).';
$lang_plugin_geoip['plugin_details'] = 'This plugin is using the free API and database from <a href="http://maxmind.com/" rel="external" class="external">maxmind.com</a> that has been released under GNU GPL. The lookup is not 100% accurate, but should work for most setups. The lookup will of course burn additional CPU cycles, so don\'t install this plugin it if you don\'t have the needed resources available on your server.';
$lang_plugin_geoip['announcement_thread'] = 'Announcement thread';



?>