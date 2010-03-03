<?php
/**************************************************
  Coppermine 1.4.x Plugin - Copper ad
  *************************************************
  Copyright (c) 2006 Borzoo Mossavari
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  *************************************************
  This is a simple Advertisement plugin without statistics
  or any kind of log.
  this will give you flash/picture/HTML banner
  By using FRAME technology
  ***************************************************/


$result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PREFIX']}copperad_config");
while ($row = mysql_fetch_array($result)) {
    $COPPERAD[$row[0]] = $row[1];
	}
mysql_free_result($row);
?>