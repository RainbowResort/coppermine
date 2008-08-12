<?PHP

// TODO: Change all variable names to start with storage_ftp_ !

define("MIRROR_TO_ALL", 1); // mirror to all servers
define("MIRROR_TO_SOME", 2);
define("MIRROR_USER_SHARDING", 3);

define("PIC_URL_SOURCE_LOCAL", 1); // show the image from the local machine
define("PIC_URL_SOURCE_RANDOM_SERVER", 2); // show the image from a random server
// from the ones that have a copy of the image we're showing
define("PIC_URL_SOURCE_FIRST_SERVER", 3); // show the image from the first server
// from the list of all servers which have this image, keep the others for backup

$config_data['storage_ftp_module']['storage_rule'] = array
(
	'type' => 'select',
	'default_value' => '2',
	//'help_link' => 'f=configuration.htm&amp;as=active_storage_module&amp;ae=active_storage_module_end',
	'options' => storage_rules(),
    'end_description' => '&nbsp;&nbsp;(<a href="admin-storage-servers.php?module=ftp">'.$lang_admin_php['storage_servers_manage_ftp_servers'].'</a>)',
);

function storage_rules()
{
	$storage_rules['Mirror each image to all FTP storage servers'] = MIRROR_TO_ALL;
	$storage_rules['Mirror each image to some of the FTP storage servers (see copies per file below)'] = MIRROR_TO_SOME;
	$storage_rules['Assign each user automatically to a few FTP storage servers (see copies per file below)'] = MIRROR_USER_SHARDING;
	return $storage_rules;
}

$config_data['storage_ftp_module']['storage_copies_per_file'] = array
(
	'type' => 'textfield',
	'default_value' => '1',
	//'help_link' => 'f=configuration.htm&amp;as=admin_general_time-offset&amp;ae=admin_general_time-offset_end&amp;top=1',
	'regex' => '^[0-9]$',
	'size' => '5',
	'width' => '5',
	'maxlength' => '2',
);

$config_data['storage_ftp_module']['storage_keep_local_copy'] = array
(
      'type' => 'radio',
      'default_value' => '1',
      //'help_link' => 'f=configuration.htm&amp;as=admin_general_help&amp;ae=admin_general_help_end',
      'options' => array
					(
						$lang_common['yes'],
						$lang_common['no'],
					),
);

$config_data['storage_ftp_module']['storage_pic_url_source'] = array
(
	'type' => 'select',
	'default_value' => '2',
	//'help_link' => 'f=configuration.htm&amp;as=active_storage_module&amp;ae=active_storage_module_end',
	'options' => storage_pic_sources()
);

function storage_pic_sources()
{
	$storage_rules['Local server'] = PIC_URL_SOURCE_LOCAL;
	$storage_rules['Random FTP server that has the image'] = PIC_URL_SOURCE_RANDOM_SERVER;
	$storage_rules['First FTP server that has the image'] = PIC_URL_SOURCE_FIRST_SERVER;
	return $storage_rules;
}

?>
