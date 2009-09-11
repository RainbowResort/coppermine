<?php
/**************************************************
  Coppermine 1.5.x Plugin - XFeeds $VERSION$=1.3
  *************************************************
  Copyright (c) 2008 lee (www.mininoteuser.com)
  Plugin for CPG 1.4 created by Lee
  Ported to CPG 1.5.x by Aditya Mooley <adityamooley@sanisoft.com>
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  **************************************************/


// Check if PlugIn is installed
$xfd_isinstalled = 0;

$xfdchk_result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PREFIX']}plugins");
while ($xfdchk_row = mysql_fetch_array($xfdchk_result)) {
    if ($xfdchk_row['name'] == "XFeeds") {
        $xfd_isinstalled = 1;
    }
}
mysql_free_result($xfdchk_result);

// When installed, load $IMAGEFLOWSET settings
if ($xfd_isinstalled) {
    $xfdlang_result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PREFIX']}plugin_xfeeds");

    while ($xfdlang_row = mysql_fetch_array($xfdlang_result)) {
        $XFDSET = $xfdlang_row;
    }
}
mysql_free_result($xfdlang_result);
?>