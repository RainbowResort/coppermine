<?php
/**************************************************
  Coppermine 1.5.x Plugin - GeoData
  *************************************************
  Copyright (c) 2011 Pierre BASMOREAU
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  $HeadURL: 
  $Revision: 
  $LastChangedBy: 
  $Date: 2011/08/17
  **************************************************/

// Check if PlugIn is installed
$geodata_isinstalled = 0;

$geodatachk_result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PREFIX']}plugins");
while ($geodatachk_row = mysql_fetch_array($geodatachk_result)) {
	if ($geodatachk_row['name'] == "GeoData") $geodata_isinstalled = 1;
}
mysql_free_result($geodatachk_result);


// When installed, load $GEODATASET settings
if ($geodata_isinstalled) {
	$q="SELECT * FROM {$CONFIG['TABLE_CONFIG']} where name LIKE 'plugin_geodata_%'";
	$geodataresult = cpg_db_query($q);
	while ($geodatarow = mysql_fetch_array($geodataresult)) {
		$GEODATASET[$geodatarow['name']] = $geodatarow['value'];
	  }
	mysql_free_result($geodataresult);
}

?>