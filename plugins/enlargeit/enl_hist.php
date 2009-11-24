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


require('./plugins/enlargeit/init.inc.php');
$pid = $superCage->get->getInt('pid');


echo <<< EOT
<table align="center" cellspacing="1" style="width:100%;height:100%">
    <tr>
        <td width="100%" align="center" class="enl_infotablehead">
            <strong>{$lang_plugin_enlargeit['histogram']} (debug_output:pid={$pid})</strong>
        </td>
    </tr>
    <tr>
        <td width="100%" align="center" class="enl_infotable">
            <img border="0" src="index.php?file=enlargeit/enl_hst&pid={$pid}" width="284" height="164" alt="" />
        </td>
    </tr>
</table>
EOT;
?>