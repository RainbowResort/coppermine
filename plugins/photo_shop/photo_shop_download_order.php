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
require('include/init.inc.php');
require('include/mailer.inc.php');
require('include/archive.php');


define('PHOTOSHOP_DOWNLOAD_PHP', true);
define('PHOTOSHOP_IPN_PHP', true);

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');
if ((!USER_ID && $CONFIG['allow_unlogged_access'] == 0) || !$CONFIG['photo_shop_enabled']) cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);

$lang = isset($USER['lang']) ? $USER['lang'] : $CONFIG['lang'];
if (!file_exists("plugins/photo_shop/lang/{$lang}.php"))
  $lang = 'english';
require "plugins/photo_shop/lang/{$lang}.php";

$order = isset($_GET['order']) ? $_GET['order'] : null;
$return_lnk =  isset($_GET['return_lnk']) ? $_GET['return_lnk'] : null;

if (isset($order)) {
	//first get the order id using the hash
    $sql = "SELECT * FROM {$CONFIG['TABLE_SHOP']} WHERE order_md5_id='$order' AND cd='1'";

    $result = cpg_db_query($sql);
    $row = cpg_db_fetch_row($result);
    mysql_free_result($result);
	$oid = $row['oid'];
	$uid = $row['uid'];

	if (!$oid) {
		// if there's no matching order id die
		cpg_die(ERROR, $lang_photoshop_ipn['ipn_no_order_match'], __FILE__, __LINE__);
	}

	if(!photo_shop_ipn_download_check($uid, $oid)) {
		cpg_die(ERROR, "No items to download", __FILE__, __LINE__);
	}


    //define pathes
	$filepath = 'downloads/' . $uid . '_' . $oid;
    $dest_dir = $CONFIG['fullpath'] . $filepath;
    $dest_dir .= '/';
    $filepath .= '/';

	if (!is_dir($dest_dir)) { // download dir doesn't exist... die
		if(GALLERY_ADMIN_MODE) {
			pageheader();
			msg_box("{$dest_dir} {$lang_photoshop_ipn['ipn_no_folder']}", "{$dest_dir} {$lang_photoshop_ipn['ipn_no_folder']}", $lang_photoshop_ipn['ipn_continue'], str_replace('&amp;', '&', "index.php?file=photo_shop/photo_shop_admin&amp;box={$_REQUEST['box']}"), '100%');
			pagefooter();
			die();
		} else { //if it's a user do not display a sophisticated error message and no continue button to admin site
			pageheader("test");
			msg_box("{$lang_photoshop_ipn['ipn_no_folder_user']}", "{$lang_photoshop_ipn['ipn_no_folder_user']}", $lang_photoshop_ipn['ipn_continue'], "index.php", '100%');
			pagefooter();
			die();
		}
	}

	//now get all the items from that order
    $sql = 'SELECT s.status, s.size2, s.id, p.filepath, p.filename, p.filesize, p.pwidth, p.pheight, p.title FROM ' . $CONFIG['TABLE_PICTURES'] . ' as p LEFT JOIN ' . $CONFIG['TABLE_SHOP'] . ' as s ON p.pid=s.pid WHERE oid=' . $oid . ' AND cd<>1';

    $result = cpg_db_query($sql);
    $row = cpg_db_fetch_rowset($result);
    mysql_free_result($result);

	$return_lnk_check = false;

	pageheader();
    starttable("100%");

    echo <<<EOT
        <tr>
                <td colspan="3" class="tableh1"><h2>{$lang_photoshop_ipn['ipn_prep_down']}</h2></td>
        </tr>
        <tr>
                <td class="tableh2" valign="middle" align="center"><b>{$lang_photoshop_ipn['ipn_file']}</b></td>
                <td class="tableh2" valign="middle" align="center"><b>{$lang_photoshop_ipn['ipn_status']}</b></td>
                <td class="tableh2" valign="middle" align="center"><b>{$lang_photoshop_ipn['ipn_result']}</b></td>
        </tr>
EOT;
    foreach($row as $value) {
		//verify each item if marked paid
		if($value['status'] & 2){
			if($value['size2'] > 0){
				//OK, it's paid, now check if it already has been created and exists in the download folder... if so, then offer download link
				$display_continue_button = false;

				//if the same filename exists in different pathes, we add the pathpart to the filename to make it unique
				$filename_pfx = $value['filepath'];
				//clean up the path, remove / \ and all the special chars, remove 'userpics', the uid+10000 is sufficient
				$filename_pfx = eregi_replace($CONFIG['userpics'], '', $filename_pfx);
				$filename_pfx =  eregi_replace("[^[:alnum:]+]","",$filename_pfx);


				$filename = $value['size2'] . "_" . $filename_pfx . "_" . $value['filename'];
				$image = $CONFIG['fullpath'] . $value['filepath'] . $value['filename'];
	    		$orig = $CONFIG['fullpath'] . $value['filepath'] . $CONFIG['orig_pfx'] . $value['filename'];


				if (file_exists($dest_dir . $filename)) { // we have already created that image in the download dir -> display a download link
					echo "<tr><td>{$value['filename']} <span class=\"album_stat\">(Id: {$value['id']})</span></td><td><img src=\"images/up_ok.gif\" border=\"0\" height=\"24\" width=\"24\"/></td><td><a href=\"{$dest_dir}{$filename}\">{$lang_photoshop_ipn['ipn_download_file']}</a></td></tr>\n\n";
				} else { //file doesn't exist in download folder... then create it
					//we now need to display a continue button... page refresh, all images created, for all a download link
					$display_continue_button = true;

					//first check if we have a orig as base image
					if (file_exists($orig)) {
						//if we have a orig file (modpack original), use that instead
						$image = $orig;
					}

					echo "<tr><td>{$value['filename']} <span class=\"album_stat\">(Id: {$value['id']})</span></td><td>{$lang_photoshop_ipn['ipn_creating_image']}</td><td><img src=\"index.php?file=photo_shop/photo_shop_paypal_ipn_addpic&image=" . urlencode($image) . "&size=" . urlencode($value['size2']) . "&destination=" . ($dest_dir . $filename) . "&order=" . ($order) . "&oid=" . ($oid) . "&amp;reload=" . uniqid('') . "\" height=\"24\" width=\"24\"/></td></tr>\n\n";
					flush ();

					//the sql stuff
					//mark the item as sent, check if all items of that order have been sent

					$status = $value['status'] | 4;
					cpg_db_query("UPDATE {$CONFIG['TABLE_SHOP']} SET status=$status WHERE id ='".$value['id']."'");
					//check if all status = payed -> set main payed
					$result = cpg_db_query("SELECT status  FROM {$CONFIG['TABLE_SHOP']} WHERE oid=".$oid." AND cd=0;");
					$check=true;
						while($i=mysql_fetch_array($result))
						{
							if (($i['status'] & 4) != 4) $check=false;
						}
					mysql_free_result($result);
					if ($check) { // if all sent, mark cd=1 payed, too
						$result = cpg_db_query("SELECT status FROM {$CONFIG['TABLE_SHOP']} WHERE oid=".$oid." AND cd=1");
						$row = mysql_fetch_assoc($result);
						cpg_db_fetch_row($result);
						$stat = $row['status'] | 4;
						cpg_db_query("UPDATE {$CONFIG['TABLE_SHOP']} SET status=".$stat." WHERE cd=1 AND oid ='".$oid."'");
					//end the sql stuff
					}
				}
			} else { //if the item is not for download
			echo "<tr><td>{$value['filename']} <span class=\"album_stat\">(Id: {$value['id']})</span></td><td>{$lang_photoshop_ipn['ipn_for_print']}</td><td></td></tr>\n\n";
			$return_lnk_check = true;
			}
		} else { // that item hasn't been paid... display a note

			echo "<tr><td>{$value['filename']} <span class=\"album_stat\">(Id: {$value['id']})</span></td><td>{$lang_photoshop_ipn['ipn_not_paid']}</td><td></td></tr>\n\n";
			$return_lnk_check = true;
		}
    }

    endtable();

	if (!$display_continue_button) {//no
		if ($CONFIG['photo_shop_download_zip']=='1') {
			if(!file_exists($dest_dir."download.zip")) { //zip file doesn't exist... create it

					// Create new zip file in the directory below the current one
					$test = new zip_file($dest_dir."download.zip");
					// Do not recurse through subdirectories
					// Do not store file paths in archive
					// Overwrite existing files
					// Do not create in mem but on hd

					$test->set_options(array('overwrite' => 1, 'inmemory' => 0, 'recurse' => 0, 'storepaths' => 0));
					// Add all jpegs and gifs in the images directory to archive
					$test->add_files(array("{$dest_dir}/*.*"));
					$test->exclude_files("{$dest_dir}/*.html");
					$test->exclude_files("{$dest_dir}/*.htaccess");
					$test->exclude_files("{$dest_dir}/*.htpasswd");
					// Create archive in path
					$test->create_archive();
			}
			//display zipo download button
			msg_box($lang_photoshop_ipn['ipn_download_zip'], '', $lang_photoshop_ipn['ipn_download_zip'],  $dest_dir."download.zip", '100%');
		}
	}


	//display continue button
	if ($display_continue_button || $return_lnk != '') {

		if ($return_lnk == 'index' && $display_continue_button) {
			// we're coming here from the admin, but we need to continue further from the creation to the download... carry the admin with
			msg_box($lang_photoshop_ipn['ipn_image_create_finished'], '', $lang_photoshop_ipn['ipn_continue'],  str_replace('&amp;', '&', "index.php?file=photo_shop/photo_shop_download_order&amp;order={$order}&amp;return_lnk=index"), '100%');
		} elseif ($return_lnk == 'index' && !$display_continue_button) {
			//we came from the admin and now we're on the download page, display continue back to admin
			msg_box($lang_photoshop_ipn['ipn_image_create_finished'], '', $lang_photoshop_ipn['ipn_continue'],  str_replace('&amp;', '&', "index.php?file=photo_shop/photo_shop_admin"), '100%');
		} elseif ($display_continue_button) {
			//we're user and get displayed a continue button to the download
			msg_box($lang_photoshop_ipn['ipn_image_create_finished'], '', $lang_photoshop_ipn['ipn_continue'],  str_replace('&amp;', '&', "index.php?file=photo_shop/photo_shop_download_order&amp;order={$order}"), '100%');
		}
	}



    pagefooter();
    ob_end_flush();

} else { //no hash, someone probably tries to use this script unauthorized
	cpg_die(ERROR, $lang_photoshop_ipn['ipn_no_order_match'], __FILE__, __LINE__);
}

?>