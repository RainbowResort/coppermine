<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2005 Coppermine Dev Team
  v1.1 originaly written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  *************************************************
  Coppermine version: 1.4.13
  Download Resized version: 1.2
  $Author$
**********************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

// Add a filter
$thisplugin->add_filter('file_data','download_resized_add_data');


function download_resized_add_data($pic_data)
{
	global $CONFIG, $album;
    $superCage = Inspekt::makeSuperCage();

	$lang = isset($USER['lang']) ? $USER['lang'] : $CONFIG['lang'];
	if (!file_exists("plugins/download_resized/lang/{$lang}.php"))
	  $lang = 'english';
	require "plugins/download_resized/lang/{$lang}.php";


	$sizes = array ();
	$sizes [0]['x'] = '1600';
	$sizes [1]['x'] = '1440';
	$sizes [2]['x'] = '1280';
	$sizes [3]['x'] = '1024';
	$sizes [4]['x'] = '800';
	$sizes [5]['x'] = '640';
	$sizes [6]['x'] = $CONFIG['picture_width'];

	$mime_content_image = cpg_get_type(get_pic_url($pic_data, 'fullsize'));

	if ($superCage->post->keyExists('resize_pid')){
	$pid = $superCage->post->getInt('resize_pid');
	$size = $superCage->post->getInt('resize_id');
	//sanitize data
	if(!is_numeric($size)) cpg_die(ERROR, 'Data not valid', __FILE__, __LINE__); ;
		$result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PICTURES']} WHERE pid = '$pid'");

		$row = mysql_fetch_assoc($result);

		if ($row){
			$path = $CONFIG['fullpath'] . $row['filepath'];
			if (isset($CONFIG['enable_watermark'])) { // modpack installed ? Then we check for an orig image
				if (file_exists($CONFIG['fullpath'] . $row['filepath'] . $CONFIG['orig_pfx'].$row['filename'])) {
					$row['filename'] = $CONFIG['orig_pfx'].$row['filename'];
				}
			}
			$image = $CONFIG['fullpath'] . $row['filepath'] . $row['filename'];
            $dest_dir = $CONFIG['fullpath'].'edit/';
			$filename = $row['filename'];
            $CONFIG['read_iptc_data'] = 0;
			require('include/picmgmt.inc.php');

			if (is_known_filetype($image)){
				if (is_image($image)){
        		$imagesize = getimagesize($image);
	        		if (max($imagesize[0], $imagesize[1]) < $size)	{
							$pic_data['html'] = "<img src=\"". $image ."\" class=\"image\" alt=\"". $image ."\" border=\"0\">";
					} else {
					    // Do some cleanup in the edit directory.
					    spring_cleaning('./albums/edit',900);

						// is a file with the same name already in the edit dir?
						while (file_exists($dest_dir . $filename)) {
				            $filename = ++$nr . '_' . $row['filename'];
				        }

						//resize the image into the edit dir
						if ($CONFIG['enable_watermark'] == 1) {
							resize_image($image, $dest_dir . $filename, $size, $CONFIG['thumb_method'], 'any', 'true');
						} else {
							resize_image($image, $dest_dir . $filename, $size, $CONFIG['thumb_method'], 'any');
						}
						$pic_data['html'] = "<img src=\"". $dest_dir . $filename ."\" class=\"image\" alt=\"". $dest_dir ."\" border=\"0\">";

						$image = $dest_dir . $filename;
						$row['filename'] = $filename;
					}
				}
			}
		}
	}

	if($mime_content_image['content'] == 'image'){
		$counter = null; // do we have an image > than min resize size

		$html = "<select name=\"resize_id\" class=\"listbox_lang\">";
		foreach($sizes as $key => $value) {
				if ($value['x'] <= max($pic_data['pwidth'],$pic_data['pheight'])) {
					$html.="<option value=\"{$value['x']}\">{$value['x']} {$lang_download_resized['px']}</option>";
					$counter++;
				}
		}
		$html .="</select>";

		if($counter < 1) return $pic_data; //return if we have no dropdown entry

		($album == 'search') ? $referer = "displayimage.php?pos=-{$pic_data['pid']}" : $referer = null;
		if ($row['filename']) {
			$down_link = "<a href = \"index.php?file=download_resized/download_resized&filename={$row['filename']}&image={$image}\">{$lang_download_resized['download']}</a>";
		} else $file_down_data = '';
		$download_resized_data =  <<<EOT
		<table class="tableh" width="100%">
			<tr>
				<td align="center">
				<form action="{$referer}" method="post">
				  	{$added}{$lang_download_resized[resize]}: {$html}
					<input type="hidden" value="{$pic_data['pid']}" name="resize_pid" />
	    			<input type="submit" value="{$lang_download_resized[send_data]}" class="comment_button" />
				</form>
				{$down_link}
				</td>
			</tr>
		</table>

EOT;
		$pic_data['html'] = $download_resized_data.$pic_data['html'];
	}
	return $pic_data;
}
?>