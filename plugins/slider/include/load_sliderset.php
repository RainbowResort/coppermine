<?php
/**************************************************
  Coppermine 1.5.x Plugin - Slider $VERSION$=0.3
  *************************************************
  Copyright (c) 2009 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  ***************************************************/



// Check if PlugIn is installed
$slider_isinstalled = 0;

$sliderchk_result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PREFIX']}plugins");
while ($sliderchk_row = mysql_fetch_array($sliderchk_result)) {
		if ($sliderchk_row['name'] == "Slider") $slider_isinstalled = 1;
}
mysql_free_result($sliderchk_result);


// When installed, load $SLIDERSET settings
if ($slider_isinstalled) {



$sliderresult = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PREFIX']}plugin_slider");
while ($sliderrow = mysql_fetch_array($sliderresult)) {
    $SLIDERSET=$sliderrow;
  }
mysql_free_result($sliderresult);
}
?>