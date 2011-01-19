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
Modified By Frantz for update_history plugin
**********************************************/

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...'); }
//language variables
$lang_plugin_update_history = array(
  'configure'	=>'After installation Add <strong>updatehistory</strong> to the value of :<br />config => Album list view => The content of the main page',
  'update'	=>'Recent Update',
  'new'		=>' new file added to the album ',
  'news'	=>' new files added to the album ',
  'by'		=>' by ',
  'archive'	=>'Archives',
  'admin'	=>'Plugin Config',
  'plugin_name'	=>'Update History',
  'day_nb'	=>'Number take in account in the historic: ',
  'submit'	=>'Submit',
  'history'  	=>'History for the ',
  'last_days'	=>' last days',
  'add'		=>' added in the album ',
  'archive_title'=>'Last upload archive',
  'archive_setup'=>'Search setup:',
);
//Date format 
$plugin_update_history_date_fmt = '%B %d, %Y';
$lang_plugin_update_history_config = array(
'button_install'	=> 'Install',
'install_click'		=> 'Click button to install plugin.',
'install_note'		=> 'Configure plugin using <b>"administration"</b> button on plugin block.',
'display_block'		=> 'After install, add <b>updatehistory</b> in the setting list from <i><b>The content of the main page</b></i> in the <b>Album list view</b> section from the config page.',
'cleanup_question' 	=> 'Remove the table that was used to store settings ?',
'yes'			=> 'Yes',
'no'			=> 'No',
'button_submit' 	=> 'Submit',
'button_cancel' 	=> 'Cancel',
);
$lang_plugin_update_history_admin = array(
'title'			=> 'Group to setup',
'group_name'		=> 'User group',
'param'			=> 'Plugin setup for the group ',
'text'			=> 'Change the setups for this group and click the "Backup" button ',
'bloc'			=> 'Display the bloc: ',
'archive'		=> 'Show the "Archive" button: ',
'uploader'		=> 'Display uploader name: ',
'days_last'		=> 'Parameter to take in account for the historic: ',
'days'			=> 'Last days',
'last'			=> 'Last files',
'save'			=> 'Backup',
'nb'			=> 'Number took in account for the historic according to the previous parameterization',
'succes'		=> 'The new plugin configuration saved!',
'uploaded_files'	=> ' last uploaded files:',
);
?>