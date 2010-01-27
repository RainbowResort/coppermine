<?php
/**************************************************
  Coppermine 1.4.x Plugin - Live Search (Ajax Base)
  *************************************************
  Copyright (c) 2006 Borzoo Mossavari
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  *************************************************
  Simple Ajax search :
  - Search Title of files
  - Search Title of Albums
  
  Licence:
  Orginal Javascript and CSS : Coded by Timothy Groves,
  a designer based in Munich, Germany
  Under Creative Commons License.
  URL:
  http://www.brandspankingnew.net/specials/ajax_autosuggest/ajax_autosuggest_autocomplete.html
  
  Moded By Borzoo Mossavari (Bmossavari(at)gmail(dot)com)
  ***************************************************/

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...'); }

$lang_plugin_as = array(
  'display_name'  => 'Active Search',			// Display Name
  'config_title'  => 'Configure Active Search',			// Title of the button on the gallery config menu
  'config_button' => 'Active Search',				// Label of the button on the gallery config menu
  'page_success'  => 'Configuration Settings Updated.',		// Page success message
  'page_failure'  => 'Unable to update settings.',		// Page failure message
  'install_note'  => 'Beta version',	// Note about configuring plugin
  'install_click' => 'Click button to install plugin.',	// Message to install plugin
  'create_success'=> 'Your banner created successfully', // Create success message
  'version'       => 'Ver 1.0.0 <font size=1><em>Beta</em></font>',
  'search' => 'Search',
);

$lang_plugin_as_config = array(
  'status'        => 'Status of Plugin',
  'button_install'=> 'Install',
  'button_submit' => 'Submit',
  'button_cancel' => 'Cancel',
  'button_done'   => 'Done',
  'cleanup_question' => 'Remove the table that was used to store settings ?',
  'text_title_des'=> '<font size="1" color="red">Do not use html tag</font>',
  'expand_all'    => 'Expand All',
);
$lang_plugin_asmgr = array(
);

?>