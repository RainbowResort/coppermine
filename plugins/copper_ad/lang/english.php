<?php
/**************************************************
  Coppermine 1.4.x Plugin - Copper ad
  *************************************************
  Copyright (c) 2006 Borzoo Mossavari
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  *************************************************
  This is a simple Advertisement plugin without statistics
  or any kind of log.
  this will give you flash/picture/HTML banner
  By using FRAME technology
  ***************************************************/

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...'); }

$lang_plugin_copperad = array(
  'display_name'  => 'Copper ad',			// Display Name
  'config_title'  => 'Configure Copper ad',			// Title of the button on the gallery config menu
  'config_button' => 'Copper Ad',				// Label of the button on the gallery config menu
  'page_success'  => 'Configuration Settings Updated.',		// Page success message
  'page_failure'  => 'Unable to update settings.',		// Page failure message
  'install_note'  => 'Configure plugin using button on Admin toolbar.',	// Note about configuring plugin
  'install_click' => 'Click button to install plugin.',	// Message to install plugin
  'create_success'=> 'Your banner created successfully', // Create success message
  'version'       => 'Ver 1.2.4<font size=1><em>Stable</em></font>' // CPA 1.2.4

);

$lang_plugin_copperad_config = array(
  'status'        => 'Status of Plugin',
  'max_show'      => 'How many times you want the banner appears',
  'button_install'=> 'Install',
  'button_submit' => 'Submit',
  'button_cancel' => 'Cancel',
  'button_done'   => 'Done',
  'cleanup_question' => 'Remove the table that was used to store settings ?',
  'text_title'    => 'Enter the title below the banner (Empty for disable)',
  'text_title_des'=> '<font size="1" color="red">Do not use html tag</font>',
  'admin_show'    => 'Do you want banner to appear on admin mode',
  'banner_bg'     => 'Enter banner background Color',
  'expand_all'    => 'Expand All',
  'permission'    => 'please CHMOD your gallery folder to 777 (only gallery folder not the files and directory in it)', // CPA 1.2.2
);
// Banner Management
$lang_plugin_copperad_manage= array(
	'display_name'=> 'Banner Setting',
	'list_name'   => 'Name',
	'list_delete' => 'Delete',
	'list_edit'   => 'Edit',
	'list_kind'   => 'Type of Advertisement',
	'list_address'=> 'URL of picture (i.e adv/pic/adv1.gif or adv/flash/adv1.swf)',
	'list_linkto' => 'Link to (enter the target URL)',
	'list_height' => 'Height (enter the height value) <em><font color="#FF0000">Max 100 px</font> </em>',
	'list_width'  => 'Width (enter the width value) <em><font color="#FF0000">Max 780 px</font></em>',
	'list_alt'    => 'Alt (set this value for search engine optimization)',
	'list_html'   => 'HTML',
	'list_html_des' => 'All HTML tag is acceptable even <em>iframe</em> but use them <font color="#FF0000">carefully</font>',
	'list_pic'    => '<font color="red">Only for picture</font>',
	'list_submit' => 'Save new configuration',
	'list_create' => 'Create New banner', // CPA 1.2.2
	'list_restore'=> 'Restore factory defaults',
	'list_status' => 'Banner status', // CPA 1.2.2
	'list_banner' => 'Banner List', // CPA 1.2.2
	'list_conf'   => 'Configuration', // CPA 1.2.2
	'list_stat'   => 'Enable', // CPA 1.2.2
	'list_chstat' => 'Change Status', // CPA 1.2.2
	'list_chkall' => 'Check All', // CPA 1.2.2
);
// Delete
$lang_plugin_copperad_delete= array(
  'display_name'  => 'Delete Banner',
  'nothing_do'    => 'There is nothing you can do!',
  'cant_delete'   => 'At least ONE banner should be available!',
  'delete_okey'   => 'Banner successfully deleted.',
 );
?>