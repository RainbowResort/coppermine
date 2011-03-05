<?php
/**************************************************
  Coppermine 1.5.x Plugin - keywords_add
  *************************************************
  Copyright (c) coppermine dev team
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

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...'); }

$lang_plugin_keywords_add = array(
  'display_name'    => 'Keywords Add',			// Display Name
  'config_title'    => 'Configure Keywords Add',			// Title of the button on the gallery config menu
  'config_button'   => 'Keywords Add',				// Label of the button on the gallery config menu
  'install_note'    => 'Configure plugin using button on Admin toolbar.',	// Note about configuring plugin
  'install_click'   => 'Click button to install plugin.',	// Message to install plugin
  'version'         => 'V1.2', // Curent plugin version
  'album_name'      => 'Select the album in which you want add information',
  'add_info'        => 'Information to be added',
  'keyword'	    => 'Keywords',
  'caution'         => 'Caution: Information which had already entered the title, description and users fields will be replaced by the news.<br>Leave blank for unchanging existing content.', 
  'title'	    => 'Title',
  'description'      => 'Description',
);

$lang_plugin_keywords_add_config = array(
  'status'        => 'Status of Plugin',
  'button_install'=> 'Install',
  'button_submit' => 'Submit',
);

// Delete
$lang_plugin_keywords_add_delete= array(
  'success'       => 'Keywords Add Configured successfully',
 );
?>