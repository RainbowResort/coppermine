<?php
/**************************************************
  CPG Photo Shop Plugin for Coppermine Photo Gallery
  *************************************************
  Copyright (c) 2006 Thomas Lange <stramm@gmx.net>
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  *************************************************
  Coppermine version: 1.4.19
  Photo Shop version: 1.4.0
  $Revision: 1.0 $
  $Author: stramm $
***************************************************/

define('IN_COPPERMINE', true);

define('PHOTOSHOP_DOWNLOAD_PHP', true);
define('PHOTOSHOP_IPN_PHP', true);

require('include/init.inc.php');
require('include/picmgmt.inc.php');

$order = isset($_GET['order']) ? $_GET['order'] : null;
$size = isset($_GET['size']) ? $_GET['size'] : null;

if(!GALLERY_ADMIN_MODE) {
    $sql = "SELECT * FROM {$CONFIG['TABLE_SHOP']} WHERE order_md5_id='$order' AND cd='1'";

    $result = cpg_db_query($sql);
    $row = cpg_db_fetch_row($result);
    mysql_free_result($result);
	$oid = $row['oid'];

	if (!$oid) { // if there's no matching order id die
	cpg_die(ERROR, $lang_photoshop_ipn['ipn_no_order_match'], __FILE__, __LINE__);
	}
}

if (resize_image(urldecode($_GET['image']), urldecode($_GET['destination']), $_GET['size'], $CONFIG['thumb_method'], 'any')) {

    $file_name = 'images/up_ok.gif';
} else {
    $file_name = 'images/up_pb.gif';
    echo $ERROR;
}

if (ob_get_length()) {
    ob_end_flush();
    exit;
}

header('Content-type: image/gif');
echo fread(fopen($file_name, 'rb'), filesize($file_name));
ob_end_flush()
?>