<?php
/**************************************************
  Coppermine 1.5.x Plugin - EnlargeIt!
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

define('IN_COPPERMINE', true);
require_once('include/init.inc.php');
global $lang_plugin_enlargeit;
require('./plugins/enlargeit/include/init.inc.php');


$pic = $superCage->get->getInt('pid');



echo "<table align=\"center\" cellspacing=\"1\" style=\"width:100%;height:100%\">";
echo "<tr><td width=\"100%\" align=\"center\" class=\"enl_infotablehead\"><b>".$lang_plugin_enlargeit['enl_tooltiphist']."</b></td></tr>";
echo "<tr><td width=\"100%\" align=\"center\" class=\"enl_infotable\">";
echo "<img border=\"0\" src=\"index.php?file=enlargeit/enl_hst&pid=".$pic."\" width=\"284\" height=\"164\"/>";
echo "</td></tr></table>";
ob_end_flush();

?>