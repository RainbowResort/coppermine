<?php
/*************************
  mass_import Plugin for cpg1.5.x
  ************************
  Copyright (c) 2003-2009 Coppermine Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  Coppermine version: 1.5.x
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**********************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

if (GALLERY_ADMIN_MODE) {
    $thisplugin->add_action('page_start', 'mass_import_start');
    $thisplugin->add_filter('admin_menu','mass_import_add_admin_button');
}

function mass_import_add_admin_button($admin_menu)
{
    global $lang_plugin_mass_import, $mass_import_icon_array;
    $new_button = '<div class="admin_menu admin_float"><a href="index.php?file=mass_import/import" title="' . $lang_plugin_mass_import['description'] . '">'. $mass_import_icon_array['menu'] . $lang_plugin_mass_import['admin_title'] . '</a></div>';
    $look_for = '<!-- END batch_add -->';
    $admin_menu = str_replace($look_for, $look_for . $new_button, $admin_menu);
    return $admin_menu;
}

function mass_import_start($html) {
	global $template_gallery_admin_menu, $lang_plugin_mass_import, $mass_import_icon_array, $CONFIG;
	
	if (file_exists("plugins/mass_import/lang/{$CONFIG['lang']}.php")) {
		require "plugins/mass_import/lang/{$CONFIG['lang']}.php";
	} else {
	    require 'plugins/mass_import/lang/english.php';
	}
	if ($CONFIG['enable_menu_icons'] >= 1) {
	    $mass_import_icon_array['menu'] = '<img src="./plugins/mass_import/images/icons/mass_import.png" border="0" width="16" height="16" alt="" class="icon" />';
	} else {
	    $mass_import_icon_array['menu'] = '';
	}
	if ($CONFIG['enable_menu_icons'] == 2) {
	    $mass_import_icon_array['table'] = '<img src="./plugins/mass_import/images/icons/mass_import.png" border="0" width="16" height="16" alt="" class="icon" />';
	    $mass_import_icon_array['continue'] = '<img src="./plugins/mass_import/images/icons/continue.png" border="0" width="16" height="16" alt="" class="icon" />';
	} else {
	    $mass_import_icon_array['table'] = '';
	    $mass_import_icon_array['continue'] = '';
	}
	$mass_import_icon_array['ok'] = cpg_fetch_icon('ok', 0);
	$mass_import_icon_array['cancel'] = cpg_fetch_icon('cancel', 0);
	$mass_import_icon_array['stop'] = cpg_fetch_icon('stop', 0);
}



?>