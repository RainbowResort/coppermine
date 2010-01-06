<?php
/**************************************************
  Coppermine 1.5.x Plugin - Imageflow
  *************************************************
  Copyright (c) 2010 Timo Schewe (www.timos-welt.de)
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


// Check if PlugIn is installed
$imgflow_isinstalled = 0;

$imgflowchk_result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PREFIX']}plugins");
while ($imgflowchk_row = mysql_fetch_array($imgflowchk_result)) {
		if ($imgflowchk_row['name'] == "Imageflow") $imgflow_isinstalled = 1;
}
mysql_free_result($imgflowchk_result);


// When installed, load $IMAGEFLOWSET settings
if ($imgflow_isinstalled) {

$imgflowlang_result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PREFIX']}mod_imageflow");
while ($imgflowlang_row = mysql_fetch_array($imgflowlang_result)) {
    $IMAGEFLOWSET=$imgflowlang_row;
  }
}
mysql_free_result($imgflowlang_result);
?>