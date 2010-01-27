<?php
/**************************************************
  Coppermine 1.4.x Plugin - HighSlide
  *************************************************
  Copyright (c) 2006 Borzoo Mossavari
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  *************************************************
  Skip Intermediate Page and show full page on the page
  Based on Highslide JS @ http://vikjavev.no/highslide/ 
  ***************************************************/


$result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PREFIX']}highslide_config");
while ($row = mysql_fetch_array($result)) {
    $HIGHSLIDESET=$row;
	}
mysql_free_result($result);
?>