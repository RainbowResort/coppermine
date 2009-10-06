<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2008 Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  Coppermine version: 1.5.x
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**********************************************/
/*********************************************
  Coppermine Plugin - Preload
  ********************************************
  Copyright (c) 2009 eenemeenemuu
**********************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

$urls = $superCage->get->getRaw('urls');
$urls = explode(" ", $urls);
foreach($urls as $url) {
    preg_match('/pid=([0-9]+)/', $url, $match);
    if(is_numeric($match[1]) && !in_array($match[1], $pids)) {
        $pids[] = $match[1];
    }
}
$pids_string = implode(", ", $pids);

$result = cpg_db_query("SELECT filepath, filename FROM {$CONFIG['TABLE_PICTURES']} WHERE pid IN ($pids_string)");
while($row = mysql_fetch_assoc($result)) {
    if (is_image($row['filename'])) {
        $normal_pfx = file_exists($CONFIG['fullpath'].$row['filepath'].$CONFIG['normal_pfx'].$row['filename']) ? $CONFIG['normal_pfx'] : "";
        $preload .= "<br /><img src=".$CONFIG['fullpath'].$row['filepath'].$normal_pfx.$row['filename']." />";
    }
}

echo $preload;

?>
