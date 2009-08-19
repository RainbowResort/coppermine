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
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/branches/cpg1.5.x/plugins/mass_import/configuration.php $
  $Revision: 6490 $
  $LastChangedBy: gaugau $
  $Date: 2009-08-19 10:44:55 +0200 (Mi, 19 Aug 2009) $
**********************************************/

if (!defined('IN_COPPERMINE')) {
	die('Not in Coppermine...');
}

function mass_import_initialize() {
	global $CONFIG, $JS, $lang_plugin_mass_import, $mass_import_icon_array;
	$superCage = Inspekt::makeSuperCage();
	if (in_array('js/jquery.spinbutton.js', $JS['includes']) != TRUE) {
		$JS['includes'][] = 'js/jquery.spinbutton.js';
	}
	if (in_array('plugins/mass_import/js/script.js', $JS['includes']) != TRUE) {
		$JS['includes'][] = 'plugins/mass_import/js/script.js';
	}
	
	require_once "./plugins/mass_import/lang/english.php";
	if ($CONFIG['lang'] != 'english' && file_exists("./plugins/mass_import/lang/{$CONFIG['lang']}.php")) {
	    require_once "./plugins/mass_import/lang/{$CONFIG['lang']}.php";
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
	$return['language'] = $lang_plugin_mass_import;
	$return['icon'] = $mass_import_icon_array;
	return $return;
}
?>