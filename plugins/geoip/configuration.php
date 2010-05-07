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
$geoip_icon_array['configure'] = cpg_fetch_icon('config', 1);
$geoip_icon_array['ok'] = cpg_fetch_icon('ok', 1);
$geoip_icon_array['download'] = cpg_fetch_icon('download', 1);

$name = $lang_plugin_geoip['plugin_name'];
$description = $lang_plugin_geoip['plugin_description'];
$author = $lang_plugin_geoip['plugin_code'] . ': <a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=2" rel="external" class="external">Joachim Müller</a>';
$author .= '<br />' . $lang_plugin_geoip['api_and_database'] . ': <a href="http://www.maxmind.com/app/php" rel="external" class="external">Maxmind</a> (' . $lang_plugin_geoip['released_under_gnu_gpl'] . ')';
$version = '1.2';
$plugin_cpg_version = array('min' => '1.5.1');
$explain = $lang_plugin_geoip['plugin_details'];
$link .= '<br />&nbsp;<br /><a href="http://forum.coppermine-gallery.net/index.php/topic,64820.0.html" rel="external" class="admin_menu">' . $geoip_icon_array['announcement'] . $lang_plugin_geoip['announcement_thread'] . '</a>'; 
if (!file_exists("./plugins/geoip/GeoLiteCity.dat")) {
    $city_lookup = '<div class="cpg_message_info">' . sprintf($lang_plugin_geoip['city_lookup'], '<a href="http://geolite.maxmind.com/download/geoip/database/GeoLiteCity.dat.gz" rel="external" class="external">' . $lang_plugin_geoip['additional_file'] . '</a>', '<em>' . $CONFIG['site_url'] . 'plugins/geoip/</em>') . '</div>';
    $city_download_link = ' <a href="http://geolite.maxmind.com/download/geoip/database/GeoLiteCity.dat.gz" class="admin_menu">' . $geoip_icon_array['download'] . $lang_plugin_geoip['download_city_database'] . '</a>';
} else {
    $city_lookup = '';
    $city_download_link = '';
}
$install_info = $explain . $city_lookup . $link . $city_download_link;
$extra_info = $explain . $city_lookup . $link . ' <a href="index.php?file=geoip/admin" class="admin_menu">' . $geoip_icon_array['configure'] . sprintf($lang_plugin_geoip['configure_plugin'], $lang_plugin_geoip['plugin_name']) . '</a>' . $city_download_link;




?>