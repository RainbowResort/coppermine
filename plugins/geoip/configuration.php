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

// Include the language filerequire ('./plugins/geoip/lang/english.php');
if (file_exists("./plugins/geoip/lang/{$CONFIG['lang']}.php")) {
    require ("./plugins/geoip/lang/{$CONFIG['lang']}.php");
}

$geoip_icon_array['announcement'] = cpg_fetch_icon('announcement', 1);

$name = $lang_plugin_geoip['plugin_name'];
$description = $lang_plugin_geoip['plugin_description'];
$author = 'Joachim Müller';
$version = '1.1';
$plugin_cpg_version = array('min' => '1.5.4');
$install_info = $lang_plugin_geoip['plugin_details'];
$install_info .= '<br />&nbsp;<br /><a href="http://forum.coppermine-gallery.net/index.php/topic,64820.0.html" rel="external" class="admin_menu">' . $geoip_icon_array['announcement'] . $lang_plugin_geoip['announcement_thread'] . '</a>'; 
$extra_info .= $install_info;




?>