<?php

// if we're not in coppermine, exit
if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...');}

//$CONFIG['storage_module'] = "ftp"; // delete this in production!!!!!!!!!

// the folder where all the modules are stored
$CONFIG['storage_modules_dir'] = "storage";
$CONFIG['storage_lib_dir'] = "lib";
$CONFIG['default_storage_module'] = "fs";
$CONFIG['storage_module_class_file'] = "storage.php";
$CONFIG['storage_module_config_file'] = "config.inc.php";

// if no storage module is defined in $CONFIG, load the default one, fs (filesystem)
if(!isset($CONFIG['storage_module']) || !strlen($CONFIG['storage_module']))
	$CONFIG['storage_module'] = $CONFIG['default_storage_module'];

// default module path. this variable is changed if a valid module is defined
$module_path = $CONFIG['storage_modules_dir']."/".$CONFIG['storage_module'];

// if the module path is not a folder, set it to the default one
if(!is_dir($module_path))
{
	$module_path=$CONFIG['storage_modules_dir']."/".$CONFIG['default_storage_module'];
	if(!is_dir($module_path))
		cpg_die(ERROR, 'Cannot load a storage module');
}

// the relative path of config.inc.php for this storage module
$storage_config_path = $module_path."/".$CONFIG['storage_module_config_file'];

if(!is_file($storage_config_path))
	cpg_die(ERROR, 'The storage module seems to be invalid because '.$CONFIG['storage_module_config_file'].' is missing.');

// load module config
require($storage_config_path);
	
// the relative path of the storage.php class
$storage_class_path = $module_path."/".$CONFIG['storage_module_class_file'];

if(!is_file($storage_class_path))
	cpg_die(ERROR, 'The storage module seems to be invalid because '.$CONFIG['storage_module_class_file'].' is missing.');

// load the module
require($storage_class_path);

require("FileContainer.php"); // this class represents one image, with a url and an owner

// initialize the storage class
$storage = new storage;

?>
