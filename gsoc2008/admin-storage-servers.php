<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2008 Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  Coppermine version: 1.5.0
  $Source: /cvsroot/coppermine/devel/admin.php,v $
  $Revision: 4747 $
  $LastChangedBy: zmarty $
  $Date: 2008-07-30 20:59:52 +0300 (Wed, 30 Jul 2008) $
**********************************************/

define('IN_COPPERMINE', true);
define('ADMIN_PHP', true);
define('CONFIG_PHP', true); // added for backwards compatibility (language fallback)

require_once('include/init.inc.php');
//require_once('include/sql_parse.php');

if (!GALLERY_ADMIN_MODE) {
  cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
}

pageheader($lang_admin_php['storage_servers_configuration']);

$storage_modules = storage_folders();

$module = $superCage->get->getAlnum('module');

// checks in the storage module is set in $_GET, and if the storagem module exists
if(!isset($module) || !in_array($module, $storage_modules))
	cpg_die(ERROR, $lang_admin_php['storage_servers_not_set_doesnt_exist'], __FILE__, __LINE__);

$available_actions = array("list", "addeditdelete");

$action = $superCage->get->getAlnum('action');

// checks if the action is set and it is valid
if(!isset($action) || !in_array($action, $available_actions) )
	$action = "list";

// includes the right servers admin
include("storage/modules/".$module."/admin/servers-".$action.".php");

pagefooter();
ob_end_flush();

function storage_folders()
{
	global $CONFIG;
	$storage_modules = array();
	$dir = opendir("storage/modules/");
	while ($file = readdir($dir))
		if(is_dir("storage/modules/".$file) && $file[0]!=".")
			$storage_modules[] = $file;
	return $storage_modules;	
}

?>
