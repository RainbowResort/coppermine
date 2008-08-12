<?PHP

$storage_folders = storage_folders();

$config_data['active_storage_module'] = array
(
	'storage_module' => array
	(
      'type' => 'select',
      'help_link' => 'f=configuration.htm&amp;as=active_storage_module&amp;ae=active_storage_module_end',
      'options' => $storage_folders
    ),
);

foreach($storage_folders as $storage_folder)
	require($CONFIG['storage_modules_dir']."/".$storage_folder."/admin/admin.inc.php");

function storage_folders()
{
	global $CONFIG;
	$storage_modules = array();
	$dir = opendir($CONFIG['storage_modules_dir']);
	while ($file = readdir($dir))
		if(is_dir($CONFIG['storage_modules_dir']."/".$file) && $file[0]!=".")
			$storage_modules[] = $file;
	natcasesort($storage_modules);
	return $storage_modules;	
}

?>
