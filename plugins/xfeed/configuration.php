<?php
/**************************************************
  Coppermine 1.5.x Plugin - xfeed
  *************************************************
  Copyright (c) 2008 lee (www.mininoteuser.com)
  Plugin for CPG 1.4 created by Lee
  Ported to CPG 1.5.x by Aditya Mooley <adityamooley@sanisoft.com>
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

$name = 'XFeeds';
$description = 'XFeeds - RSS for Coppermine 1.5';
$author = '<a href="http://www.adityamooley.net">Aditya Mooley</a>';
$version = '1.11';
$plugin_cpg_version = array('min' => '1.5');
$extra_info = <<<EOT
<table border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td class="admin_menu">
          <a href="index.php?file=xfeed/plugin_config" title="Configure your feed setting">Configure Plugin</a>
        </td>
    </tr>
</table>
EOT;
?>