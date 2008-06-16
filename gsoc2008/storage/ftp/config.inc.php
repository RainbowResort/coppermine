<?php

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...');}

$CONFIG['storage_module_dir'] = "ftp";

define("MIRROR_TO_ALL", 1); // mirror to all servers
define("MIRROR_TO_SOME", 2);
define("MIRROR_USER_SHARDING", 3);

define("PIC_URL_SOURCE_LOCAL", 1); // show the image from the local machine
define("PIC_URL_SOURCE_RANDOM_SERVER", 2); // show the image from a random server
// from the ones that have a copy of the image we're showing
define("PIC_URL_SOURCE_FIRST_SERVER", 3); // show the image from the first server
// from the list of all servers which have this image, keep the others for backup

$CONFIG['storage_rule'] = MIRROR_TO_SOME;
$CONFIG['storage_copies_per_image'] = 3; // default is 3 // this is used only if storage_rule is not equal to MIRROR_TO_ALL
// TODO: this must exist and must be smaller than.. - make checks

$CONFIG['storage_keep_local_copy'] = false; // if set to true, copies of all images are stored
// on the local server also

$CONFIG['storage_pic_url_source'] = PIC_URL_SOURCE_RANDOM_SERVER; // where to show the images from

$CONFIG['timeout_check_http_servers'] = 6; // timeout in seconds

//$CONFIG['minimum_free_buffer_per_server'] = 20971520; // 20 megabytes

/********************************************************************************************************
 *                                   DO NOT EDIT PAST THIS LINE                                         *
 *******************************************************************************************************/

// TODO: make some basic checks for incompatible configurations .. like you can't show images from local when you delete them at upload

// sets the tables used by the storage modules
$CONFIG['TABLE_FTP_SERVERS'] = $CONFIG['TABLE_PREFIX'].'ftp_servers';
$CONFIG['TABLE_FTP_PIC2SERVER'] = $CONFIG['TABLE_PREFIX'].'ftp_pic2server';
$CONFIG['TABLE_FTP_USER2SERVER'] = $CONFIG['TABLE_PREFIX'].'ftp_user2server';

require($CONFIG['storage_modules_dir']."/".$CONFIG['storage_module_dir']."/http_servers_down.php"); // change to include
// to be removed require($CONFIG['storage_modules_dir']."/".$CONFIG['storage_module_dir']."/ftp_servers_down.php"); // change to include

?>