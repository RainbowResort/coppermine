<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2005 Coppermine Dev Team
  v1.1 originaly written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  ********************************************
  Coppermine version: 1.4.8
  $Source: /cvsroot/cpg-contrib/master_template/codebase.php,v $
  $Revision: 1.3 $
  $Author: donnoman $
  $Date: 2005/12/08 05:46:49 $
**********************************************/
/**********************************************
Modified by Frantz for Keywords add plugin
2006/10/08
**********************************************/

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...'); }

$lang_plugin_keywords_add = array(
  'display_name'    => 'Keywords Add',			// Display Name
  'config_title'    => 'Configure Final Extract',			// Title of the button on the gallery config menu
  'config_button'   => 'Keywords Add',				// Label of the button on the gallery config menu
  'install_note'    => 'Configure plugin using button on Admin toolbar.',	// Note about configuring plugin
  'install_click'   => 'Click button to install plugin.',	// Message to install plugin
  'version'         => 'Ver 1.0', // Curent plugin version
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