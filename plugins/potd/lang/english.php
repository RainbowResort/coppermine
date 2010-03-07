<?php
/**************************************************
  Coppermine Plugin - PotD/PotW
  *************************************************
  Copyright (c) 2006 Paul Van Rompay
  Plugin based on Mod by Casper, Copyright 2005
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
***************************************************/

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...'); }

global $lang_meta_album_names, $lang_editpics_php; 

$lang_plugin_potd = array(
  'display_name' => 'Picture of the Day/Week',		// Display Name
  'config_title'  => 'Configure Picture of the Day Plugin',	// Title of the button on the gallery config menu
  'config_button' => 'POTD/W',			// Label of the button on the gallery config menu
  'page_success'  => 'Configuration Settings Updated.',		// Page success message
  'page_failure'  => 'Unable to update settings.',		// Page failure message
  'install_done'  => 'Installation Complete.',		// Message after complete installation
  'install_note'  => 'Make sure to apply the hack to include/functions.inc.php noted in README.txt',
);
//   'install_note'  => 'Configure plugin using button on Admin toolbar.',	// Note about configuring plugin

$lang_plugin_potd_config = array(
  'choice_yes'   => 'yes',				// Choice: yes
  'choice_no'    => 'no',				// Choice: no

  'button_done'  => 'Done',				// Config submit button
);

$plugin_meta_album_names = array(
  'potd' => 'Photo of the Day',
  'potdarch' => 'Photo of the Day Archive',
  'potw' => 'Photo of the Week',
  'potwarch' => 'Photo of the Week Archive',
  'by' => 'by our member ',
);
$lang_meta_album_names = array_merge($lang_meta_album_names, $plugin_meta_album_names);

$plugin_editpics_php = array(
  'potdnew' => 'Set as P.o.t.Day',
  'potdold' => 'Move to POTD archive',
  'potwnew' => 'Set as P.o.t.Week',
  'potwold' => 'Move to POTW archive',
);
if (defined('EDITPICS_PHP')) $lang_editpics_php = array_merge($lang_editpics_php, $plugin_editpics_php);

?>
