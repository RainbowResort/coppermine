<?php
/**************************************************
  Coppermine 1.5.x Plugin - Check files
  *************************************************
  Copyright (c) 2012 eenemeenemuu
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


if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

$thisplugin->add_filter('admin_menu','verwischt_admin_menu');
function verwischt_admin_menu($admin_menu) {
    if (GALLERY_ADMIN_MODE) {
        $new_button = "
            <div class=\"admin_menu admin_float\"><a href=\"index.php?file=check_files/missing_files\">".cpg_fetch_icon('disk_usage', 2)."Search for missing files</a></div>
            <div class=\"admin_menu admin_float\"><a href=\"index.php?file=check_files/additional_files\">".cpg_fetch_icon('disk_usage', 2)."Search for additional files</a></div>
        ";
        $look_for = "<!-- END documentation -->";
        $admin_menu = str_replace($look_for, $look_for . $new_button, $admin_menu);
    }
    return $admin_menu;
}

?>