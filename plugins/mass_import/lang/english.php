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

if (!defined('IN_COPPERMINE')) { 
    die('Not in Coppermine...');
}

$lang_plugin_mass_import['name'] = 'Mass Import'; // Display Name
$lang_plugin_mass_import['admin_title'] = 'Mass Import'; // Title of the button on the gallery admin menu
$lang_plugin_mass_import['description'] = 'Mass Import gives the admin the ability to import large numbers of pictures organized by directory structure.';
$lang_plugin_mass_import['subdir_desc'] = 'SubDirectory (under albums) or blank';
$lang_plugin_mass_import['sleep_desc'] = 'Sleep between additions';
$lang_plugin_mass_import['in_milliseconds'] = 'in milliseconds';
$lang_plugin_mass_import['hardlimit_desc'] = 'Limit additions per refresh';
$lang_plugin_mass_import['autorun_desc'] = 'Run unattended';
$lang_plugin_mass_import['skipping'] = 'Skipping thumb and normal pics';
$lang_plugin_mass_import['file_already_in_database'] = 'File already exists in database';
$lang_plugin_mass_import['file_added_to_database'] = 'File added to database';
$lang_plugin_mass_import['failed_to_add_file_to_database'] = 'Failed to add file to database';
$lang_plugin_mass_import['root_create'] = 'Created root category';
$lang_plugin_mass_import['root_exists'] = 'Root category already exists';
$lang_plugin_mass_import['root_use'] = 'Using ROOT Category';
$lang_plugin_mass_import['album_exists'] = 'Album already exists';
$lang_plugin_mass_import['album_create'] = 'Created album';
$lang_plugin_mass_import['cat_exists'] = 'Category already exists';
$lang_plugin_mass_import['cat_create'] = 'Created category';
$lang_plugin_mass_import['pics_found'] = 'Files found';
$lang_plugin_mass_import['pics_indb'] = 'Files in the database';
$lang_plugin_mass_import['pics_afterfilter'] = 'Files to be added after filtering';
$lang_plugin_mass_import['structure_created'] = 'Structure created';
$lang_plugin_mass_import['files_added'] = 'Files added';
$lang_plugin_mass_import['files_to_add'] = 'Files to process';
$lang_plugin_mass_import['path'] = 'Path';

?>