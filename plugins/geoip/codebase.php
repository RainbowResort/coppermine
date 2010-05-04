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

if (GALLERY_ADMIN_MODE) {
	include_once('plugins/geoip/geoip.inc.php');
	$thisplugin->add_filter('ip_information','plugin_geoip_flag');
}


function plugin_geoip_flag($ip) {  
	$gi = geoip_open('plugins/geoip/GeoIP.dat',GEOIP_STANDARD);
	if ($ip == '') {
		$return = '';
	} else {
		$country_code = geoip_country_code_by_addr($gi, $ip);
		if ($country_code != '' && file_exists('images/flags/' . strtolower($country_code) . '.png') == TRUE) {
			$return = '<img src="images/flags/' . strtolower($country_code) . '.png" border="0" width="16" height="11" alt="" title="' . geoip_country_name_by_addr($gi, $ip) . ' (' . $country_code . ')" style="margin-left:1px;" />';
		} else {
			$return = '';
		}
	}
	geoip_close($gi);
	return $return;
}



?>