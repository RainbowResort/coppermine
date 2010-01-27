<?php
/**************************************************
  Coppermine 1.4.x Plugin - Slider $VERSION$=2.15
  *************************************************
  Copyright (c) 2008 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  ***************************************************
  Based on a mod by pbasmo, you can find it in this thread:
  http://coppermine-gallery.net/forum/index.php?topic=41197.0
  ***************************************************/



// Check if PlugIn is installed
$slider_isinstalled = 0;

$sliderchk_result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PREFIX']}plugins");
while ($sliderchk_row = mysql_fetch_array($sliderchk_result)) {
		if ($sliderchk_row['name'] == "Slider") $slider_isinstalled = 1;
}
mysql_free_result($sliderchk_result);


// When installed, load $IMAGEFLOWSET settings
if ($slider_isinstalled) {



$sliderresult = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PREFIX']}mod_slider");
while ($sliderrow = mysql_fetch_array($sliderresult)) {
    $SLIDERSET=$sliderrow;
  }
mysql_free_result($sliderresult);
}
?>