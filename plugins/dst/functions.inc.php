<?php
/**************************************************
  Coppermine 1.5.x Plugin - Daylight saving time
  *************************************************
  Copyright (c) 2010 eenemeenemuu
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

function plugin_dst_xml_read() {
    // Perform the repository lookup and xml creation --- start
    $localFile = 'plugins/dst/countries.xml';
    $result = array('body' => file_get_contents($localFile));
    unset($result['headers']); // we should take a look the header data and error messages before dropping them. Well, later maybe ;-)
    unset($result['error']);
    $result = array_shift($result);
    if (function_exists('simplexml_load_string')) {
        $xml = simplexml_load_string($result);
        unset($result);
        $dst_array = array();
        foreach ($xml as $file) {
           $dst_array[] = (array) $file;
        }
    } else {
        include_once('include/lib.xml.php');
        $xml = new Xml;
        $dst_array = $xml->parse($result);
        $dst_array = array_shift($dst_array);
    }
    // Perform the repository lookup and xml creation --- end
    return $dst_array;
}

function plugin_dst_datetime_update($dst_array) {
	global $CONFIG;
	foreach ($dst_array as $value) {
		if ($CONFIG['plugin_dst_country'] == $value['country']) {
			$datetime = date('Y-m-d H:i:s');
			$previoustime = '';
			foreach ($value['data'] as $selected_array) {
				$starttime = current($selected_array);
				$endtime = next($selected_array);
				if ($datetime >= $starttime && $datetime <= $endtime) {
					// We have a winner - it's currently DST and we have a time zone difference
					$CONFIG['plugin_dst_datetime'] = $endtime;
					$CONFIG['plugin_dst_on'] = '1';
				} elseif ($datetime > $previoustime && $datetime < $starttime) { // We're out of the DST time range, i.e. in winter on the norther hemisphere
					$CONFIG['plugin_dst_datetime'] = $starttime;
					$CONFIG['plugin_dst_on'] = '0';
				}
				$previoustime = $endtime;
			}
			cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_dst_datetime']}' WHERE name='plugin_dst_datetime'");
			cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_dst_on']}' WHERE name='plugin_dst_on'");
		}
	}
}
?>