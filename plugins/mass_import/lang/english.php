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
$lang_plugin_mass_import['sleep'] = 'Sleep';
$lang_plugin_mass_import['sleep_desc'] = 'Sleep between additions (ms)';
$lang_plugin_mass_import['hardlimit'] = 'Limit';
$lang_plugin_mass_import['hardlimit_desc'] = 'Limit additions per refresh';
$lang_plugin_mass_import['autorun'] = 'Autorun';
$lang_plugin_mass_import['autorun_desc'] = 'Run unattended';
$lang_plugin_mass_import['skipping'] = 'Skipping thumb and normal pics';
$lang_plugin_mass_import['picture'] = 'picture';
$lang_plugin_mass_import['added'] = 'added';
$lang_plugin_mass_import['already'] = 'already added';
$lang_plugin_mass_import['failed'] = 'failed';
$lang_plugin_mass_import['root_create'] = 'Created root category';
$lang_plugin_mass_import['root_exists'] = 'Root category already exists';
$lang_plugin_mass_import['root_use'] = 'Using ROOT Category';
$lang_plugin_mass_import['album_exists'] = 'Album already exists';
$lang_plugin_mass_import['album_create'] = 'Created album';
$lang_plugin_mass_import['cat_exists'] = 'Category already exists';
$lang_plugin_mass_import['cat_create'] = 'Created category';
$lang_plugin_mass_import['begin'] = 'Begin';
$lang_plugin_mass_import['pics_found'] = 'Pictures Found';
$lang_plugin_mass_import['pics_indb'] = 'Pictures in the database';
$lang_plugin_mass_import['pics_afterfilter'] = 'After filtering';
$lang_plugin_mass_import['pics_to_add'] = 'pictures will be added';
$lang_plugin_mass_import['structure_created'] = 'structure created';
$lang_plugin_mass_import['files_added'] = '%s files added';
$lang_plugin_mass_import['files_to_add'] = '%s files to add';
$lang_plugin_mass_import['path'] = 'Path';

?>