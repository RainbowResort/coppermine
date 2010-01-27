<?php
/**************************************************
  Coppermine Plugin - Display Fields
  *************************************************
  Copyright (c) 2006 Paul Van Rompay
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  *************************************************/

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...'); }

$lang_plugin_displayfields = array(
  'display_name'  => 'Display Fields Plugin',			// Display Name
  'config_title'  => 'Configure Display Fields',		// Title of the button on the gallery config menu
  'config_button' => 'Display Fields',				// Label of the button on the gallery config menu
  'page_success'  => 'Configuration Settings Updated.',		// Page success message
  'page_failure'  => 'Unable to update settings.',		// Page failure message
  'install_done'  => 'Installation Complete.',			// Message after complete installation
  'install_note'  => 'Configure plugin using button on Admin toolbar.',	// Note about configuring plugin
);

$lang_plugin_displayfields_config = array(
  'select_fields' => 'Choose which fields to display',		// Label for fields selection
  'admin_showall' => 'Show all fields for admin',		// Label for admin show all setting
  'button_done'   => 'Done',					// Submit button on configuration page
);

?>
