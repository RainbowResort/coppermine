<?php
/**************************************************
  Coppermine 1.4.x Plugin - EnlargeIt! $VERSION$=2.15
  *************************************************
  Copyright (c) 2008 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ***************************************************/

define('IN_COPPERMINE', true);
require('include/init.inc.php');
global $lang_enlargeit;
require('./plugins/enlargeit/include/init.inc.php');


$pic = (int)$_GET['pid'];



echo "<table align=\"center\" cellspacing=\"1\" style=\"width:100%;height:100%\">";
echo "<tr><td width=\"100%\" align=\"center\" class=\"enl_infotablehead\"><b>".$lang_enlargeit['enl_tooltiphist']."</b></td></tr>";
echo "<tr><td width=\"100%\" align=\"center\" class=\"enl_infotable\">";
echo "<img border=\"0\" src=\"index.php?file=enlargeit/enl_hst&pid=".$pic."\" width=\"284\" height=\"164\"/>";
echo "</td></tr></table>";
ob_end_flush();

?>