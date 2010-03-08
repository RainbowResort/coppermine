<?php
/**************************************************
  Coppermine 1.5.x Plugin - final_extract
  *************************************************
  Copyright (c) 2009 Donnovan Bray
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

$lang_plugin_final_extract = array(
  'display_name'    => 'Final Extract',			// Display Name
  'config_title'    => 'Configure Final Extract',			// Title of the button on the gallery config menu
  'config_button'   => 'Final Extract',				// Label of the button on the gallery config menu
  'page_success'    => 'Configuration Settings Updated.',		// Page success message
  'page_failure'    => 'Unable to update settings.',		// Page failure message
  'install_note'    => 'Configure plugin using button on Admin toolbar.',	// Note about configuring plugin
  'install_click'   => 'Click button to install plugin.',	// Message to install plugin
  'group_name'      => 'Select User Group',
  'home_block'      => 'Home',
  'login_block'     => 'Login',
  'my_galery_block' =>'My Gallery',
  'upload_pic_block'=>'Upload File',
  'album_list_block'=>'Albums',
  'lastup_block'    =>'Last Uploads',
  'lastcom_block'   =>'Last Comments',
  'topn_block'      =>'Most Viewed',
  'toprated_block'  =>'Top Rated',
  'favpics_block'   =>'My Favorites',
  'search_block'    =>'Search',
'my_profile_block'    =>'My Profile',
);

$lang_plugin_final_extract_config = array(
  'status'        => 'Status of Plugin',
  'button_install'=> 'Install',
  'button_submit' => 'Submit',
  'button_cancel' => 'Cancel',
  'button_done'   => 'Done',
  'cleanup_question' => 'Remove the table that was used to store settings ?',
  'expand_all'    => 'Expand All',
);
// Banner Management
$lang_plugin_final_extract_manage= array(
	'list_name'   => 'Name',
	'list_submit' => 'Save new configuration',
	'list_restore'=> 'Restore defaults',
	'list_stat'   => 'Remove', 
	'list_chstat' => 'Save the changes',
	'list_chkall' => 'Check All', // CPA 1.2.2
	'list_unchkall' => 'Uncheck All',
	'list_check'  => 'Select',
);
// Delete
$lang_plugin_final_extract_delete= array(
  'nothing_do'    => 'There is nothing you can do!',
  'nothing_changed' => 'All Block are active ...',
  'success'       => 'Final Extract Configured successfully',
 );
?>