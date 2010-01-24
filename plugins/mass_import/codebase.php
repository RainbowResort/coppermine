<?php
/**************************************************
  Coppermine 1.5.x Plugin - mass_import
  *************************************************
  Copyright (c) 2010 Nibbler
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

if (!defined('IN_COPPERMINE')) {
	die('Not in Coppermine...');
}

if (GALLERY_ADMIN_MODE) {
    $thisplugin->add_action('page_start', 'mass_import_initialize');
    $thisplugin->add_filter('admin_menu','mass_import_add_admin_button');
}

function mass_import_add_admin_button($admin_menu) {
    global $lang_plugin_mass_import, $mass_import_icon_array;
	require_once './plugins/mass_import/init.inc.php';
	$mass_import_init_array = mass_import_initialize();
	$lang_plugin_mass_import = $mass_import_init_array['language']; 
	$mass_import_icon_array = $mass_import_init_array['icon'];
    $new_button = '<div class="admin_menu admin_float"><a href="index.php?file=mass_import/import" title="' . $lang_plugin_mass_import['description'] . '">'. $mass_import_icon_array['menu'] . $lang_plugin_mass_import['admin_title'] . '</a></div>';
    $look_for = '<!-- END batch_add -->';
    $admin_menu = str_replace($look_for, $look_for . $new_button, $admin_menu);
    return $admin_menu;
}

?>