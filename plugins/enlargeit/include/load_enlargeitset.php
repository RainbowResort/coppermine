<?php
/**************************************************
  Coppermine 1.5.x Plugin - EnlargeIt! $VERSION$=0.4
  *************************************************
  Copyright (c) 2009 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  Coppermine version: 1.5.2
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
  **************************************************/

if (!defined('IN_COPPERMINE')) { 
    die('Not in Coppermine...');
}

// Check if PlugIn is installed
$enlargeit_isinstalled = 0;

$enlargeitchk_result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PREFIX']}plugins");
while ($enlargeitchk_row = mysql_fetch_array($enlargeitchk_result)) {
		if ($enlargeitchk_row['name'] == "EnlargeIt!") $enlargeit_isinstalled = 1;
}
mysql_free_result($enlargeitchk_result);


// When installed, load $ENLARGEITSET settings
if ($enlargeit_isinstalled) {

$enlargeitlang_result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PREFIX']}plugin_enlargeit");
while ($enlargeitlang_row = mysql_fetch_array($enlargeitlang_result)) {
    $ENLARGEITSET=$enlargeitlang_row;
  }
}
mysql_free_result($enlargeitlang_result);
?>