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
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**********************************************/
/*********************************************
  Coppermine Plugin - Custom Thumbnail
  ********************************************
  Copyright (c) 2009 eenemeenemuu
**********************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

$thisplugin->add_action('page_start','custom_thumb_page_start');
$thisplugin->add_filter('file_data','custom_thumb_file_data');


function custom_thumb_page_start() {
	global $CONFIG, $lang_errors;
	$superCage = Inspekt::makeSuperCage();

	if ($superCage->get->keyExists('custom_thumb_pid')) {
		$pid = $superCage->get->getInt('custom_thumb_pid');
		$result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PICTURES']} AS p INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS a ON a.aid = p.aid WHERE p.pid = '$pid' LIMIT 1");
		$row = mysql_fetch_assoc($result);

		if (!((USER_ADMIN_MODE && $row['category'] == FIRST_USER_CAT + USER_ID) || ($CONFIG['users_can_edit_pics'] && $row['owner_id'] == USER_ID && USER_ID != 0) || GALLERY_ADMIN_MODE)) {
            load_template();
            cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
        }

		if ($superCage->files->keyExists('fileupload') && $row) {
            $fileupload = $superCage->files->getRaw('fileupload');

			if ($fileupload['error']) {
                load_template();
                cpg_die(ERROR, 'Upload error '.$fileupload['error'], __FILE__, __LINE__);
            }

            if (is_image($fileupload['name'])) {
                if (!is_image($row['filename'])) {
                    $path_parts = pathinfo($row['filename']);
                    $row['filename'] = str_replace($row['filename'], basename($row['filename'], '.'.$path_parts['extension']).'.jpg', $row['filename']);
                }
                $thumb = $CONFIG['fullpath'] . $row['filepath'] . $CONFIG['thumb_pfx'] . $row['filename'];
                if (move_uploaded_file($fileupload['tmp_name'], $thumb) == TRUE) {
                    require('include/picmgmt.inc.php');
                    resize_image($thumb, $thumb, $CONFIG['thumb_width'], $CONFIG['thumb_method'], $CONFIG['thumb_use']);
                }
            } else {
                load_template();
                cpg_die(ERROR, 'Only images', __FILE__, __LINE__);
            }

			header("Location: {$CONFIG['site_url']}displayimage.php?pid=$pid");
			die();
		} else {
			load_template();
			pageheader('Custom Thumbnail');
			echo '<form method="post" enctype="multipart/form-data">';
			starttable('60%', 'Upload custom thumbnail', 2);
			echo <<< EOT
                <tr>
                	<td class="tableb" valign="top">
                		Browse:
                	</td>
                	<td class="tableb" valign="top">
                		<input type="file" name="fileupload" size="40" class="listbox" />
                	</td>
                </tr>
                <tr>
                	<td align="center" colspan="2" class="tablef">
                		<input type="submit" name="commit" class="button" value="Upload"/>
                	</td>
                </tr>
EOT;
			endtable();
			echo '</form>';
			pagefooter();
			exit;
		}
	}
}


function custom_thumb_file_data($data) {
	global $CONFIG, $CURRENT_ALBUM_DATA;

	if ((USER_ADMIN_MODE && $CURRENT_ALBUM_DATA['category'] == FIRST_USER_CAT + USER_ID) || ($CONFIG['users_can_edit_pics'] && $data['owner_id'] == USER_ID && USER_ID != 0) || GALLERY_ADMIN_MODE) {
        $custom_thumb_menu_icon = ($CONFIG['enable_menu_icons'] > 0) ? '<img src="images/icons/file_approval.png" border="0" width="16" height="16" class="icon" /> ' : '';
		$data['menu'] .= " <a href=\"?custom_thumb_pid={$data['pid']}\" class=\"admin_menu\">{$custom_thumb_menu_icon}Custom thumbnail</a>";
	}
	return $data;
}

?>
