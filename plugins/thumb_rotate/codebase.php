<?php
/**************************************************
  Coppermine 1.5.x Plugin - Thumb Rotate
  *************************************************
  Copyright (c) 2010 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  **************************************************/
  
if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

$thisplugin->add_action('page_start','thumb_rotate_initialize');
$thisplugin->add_action('plugin_install','thumb_rotate_install');
$thisplugin->add_action('plugin_uninstall','thumb_rotate_uninstall');
$thisplugin->add_action('plugin_cleanup','thumb_rotate_cleanup');
$thisplugin->add_action('plugin_configure','thumb_rotate_configure');
$thisplugin->add_filter('theme_display_thumbnails_params','thumb_rotate_thumb_display');

function thumb_rotate_thumb_display($params) {
    global $CONFIG;
    if ($CONFIG['plugin_thumb_rotate_admin_only'] == 1 && !GALLERY_ADMIN_MODE) {
    	return $params;
    }
    $gd_extension_array = array('jpg', 'jpeg', 'gif', 'png');
    // Create the super cage
	$superCage = Inspekt::makeSuperCage();
    // Extract the needed information from the thumbnail params array
    $link_target_array = parse_url(str_replace('&amp;', '&', $params['{LINK_TGT}']));
    parse_str($link_target_array['query'], $link_target_param_array);
    unset($link_target_array);
    $pid = $link_target_param_array['pid'];
    $pos = $link_target_param_array['pos'];
    $album = $link_target_param_array['album'];
    unset($link_target_param_array);
    if (!$album) {
    	// Try to extract the album from the URL param
    	if ($superCage->get->keyExists('album') == TRUE) {
    		$album = $superCage->get->getAlnum('album');
    	}
    }

	if (is_int($album) != TRUE) {
		unset($album);
	}
    // Extract the needed information about the individual pic using the built-in methods of coppermine (code taken from displayimage.php)
	if ($pos < 0 && !$pid) {
		$pid = -$pos;
	}
    if (!$album) {
        $result = cpg_db_query("SELECT aid FROM {$CONFIG['TABLE_PICTURES']} AS p WHERE pid='$pid' $FORBIDDEN_SET LIMIT 1");
        if (mysql_num_rows($result) == 0) {
            cpg_die(ERROR, $lang_errors['non_exist_ap'], __FILE__, __LINE__);
        }
        $row = mysql_fetch_assoc($result);
        mysql_free_result($result);
        $album = $row['aid'];
    }

    if (!$pos) {
    	$pos = get_pic_pos($album, $pid);
    }
	$pic_data = get_pic_data($album, $pic_count, $album_name, $pos, 1, false);
	$CURRENT_PIC_DATA = $pic_data[0];
	$CURRENT_PIC_DATA['extension'] = ltrim(substr($CURRENT_PIC_DATA['filename'], strrpos($CURRENT_PIC_DATA['filename'], '.')), '.');
	$CURRENT_PIC_DATA['filename_without_extension'] = str_replace('.' . $CURRENT_PIC_DATA['extension'], '', $CURRENT_PIC_DATA['filename']);
	if ($CONFIG['thumb_use'] == 'any' || $CONFIG['thumb_use'] == 'ex') {
		$CURRENT_PIC_DATA['maxthumb'] = max($CONFIG['thumb_width'], $CONFIG['thumb_height']);
	} elseif ($CONFIG['thumb_use'] == 'ht') {
		$CURRENT_PIC_DATA['maxthumb'] = $CONFIG['thumb_height'];
	} else {
		$CURRENT_PIC_DATA['maxthumb'] = $CONFIG['thumb_width'];
	}
	$thumb_size = compute_img_size($CURRENT_PIC_DATA['pwidth'], $CURRENT_PIC_DATA['pheight'], $CURRENT_PIC_DATA['maxthumb']);
	$CURRENT_PIC_DATA['twidth'] = $thumb_size['width'];
	$CURRENT_PIC_DATA['theight'] = $thumb_size['height'];
	// End Extract - we now have all needed data concerning the individual pic

	// Let's determine if the file is cached already
	$rotate_image_create_file = 0;
    $rotate_image_create_dbrecord = 0;
	$result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PREFIX']}plugin_thumb_rotate WHERE pid = '$pid'");
    if (!mysql_num_rows($result)) {
    	// There is NO cached record in the database --- start
    	mysql_free_result($result);
    	$rotate_image_create_file = 1;
    	$rotate_image_create_dbrecord = 1;
    	// There is NO cached record in the database --- end
    } else {
    	// There IS a cached record in the database --- start
    	$row = mysql_fetch_array($result);
    	$rotate_image_create_dbrecord = 0;
    	if (file_exists($CONFIG['fullpath'] . $row['filepath'])){
    		$rotate_image_create_file = 0;
    	} else {
			$rotate_image_create_file = 1;    	
    	}
    	mysql_free_result($result);
    	// There IS a cached record in the database --- end
    }
	// Apply the delay --- start
	if ($CONFIG['plugin_thumb_rotate_timelimit'] > 0) {
		if ((time() - $CONFIG['plugin_thumb_rotate_timestamp']) > $CONFIG['plugin_thumb_rotate_timelimit']) {
			// The time stamp difference is greater than the set config parameter, so we can proceed with thumbnail creation
		} else {
			// The time stamp difference is smaller - don't process the thumb to save resources
			$rotate_image_create_file = 0;
			$rotate_image_create_dbrecord = 0;
		}
	}
	// Apply the delay --- end
    if ($rotate_image_create_file == 1) {
    	$created_image_array = thumb_rotate_image_create($CURRENT_PIC_DATA);
    	if ($CONFIG['plugin_thumb_rotate_timelimit'] > 0) {
    		// Write the current time stamp to the db
    		$time = time();
    		cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$time}' WHERE name='plugin_thumb_rotate_timestamp'");
    	}
    }
    if ($rotate_image_create_dbrecord == 1 && $created_image_array['path'] != '') {
    	$result = cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_PREFIX']}plugin_thumb_rotate ( `pid` , `filepath`, `width`, `height` ) VALUES ('{$pid}', '{$created_image_array['path']}', '{$created_image_array['width']}', '{$created_image_array['height']}');");
    }
    if (!isset($created_image_array)) {
    	$created_image_array['width'] = $row['width'];
    	$created_image_array['height'] = $row['height'];
    }
    
    // Finally, let's manipulate the thumbnail HTML
    if (file_exists($CONFIG['fullpath'] . $CURRENT_PIC_DATA['filepath'] . $CONFIG['plugin_thumb_rotate_thumb_pfx'] . $CURRENT_PIC_DATA['filename_without_extension'] . '.'.$CONFIG['plugin_thumb_rotate_filetype'])){
    	if (in_array(strtolower($CURRENT_PIC_DATA['extension']), $gd_extension_array)) {
    		$params['{THUMB}'] = str_replace($CURRENT_PIC_DATA['filepath'] . $CONFIG['thumb_pfx'] . $CURRENT_PIC_DATA['filename'], $CURRENT_PIC_DATA['filepath'] . $CONFIG['plugin_thumb_rotate_thumb_pfx'] . $CURRENT_PIC_DATA['filename_without_extension'] . '.'.$CONFIG['plugin_thumb_rotate_filetype'], $params['{THUMB}']);
    		$params['{THUMB}'] = str_replace('width="'.$thumb_size['width'].'"', 'width="'.$created_image_array['width'].'"', $params['{THUMB}']); // Replace the existing width attributes
    		$params['{THUMB}'] = str_replace('height="'.$thumb_size['height'].'"', 'height="'.$created_image_array['height'].'"', $params['{THUMB}']); // Replace the existing height attributes
    	} else {
    		$params['{THUMB}'] = str_replace($THEME_DIR . 'images/thumbs/thumb_'.$CURRENT_PIC_DATA['extension'].'.png', $CONFIG['fullpath'] . $CURRENT_PIC_DATA['filepath'] . $CONFIG['plugin_thumb_rotate_thumb_pfx'] . $CURRENT_PIC_DATA['filename_without_extension'] . '.'.$CONFIG['plugin_thumb_rotate_filetype'], $params['{THUMB}']);
    		$params['{THUMB}'] = str_replace('images/thumbs/thumb_'.$CURRENT_PIC_DATA['extension'].'.png', $CONFIG['fullpath'] . $CURRENT_PIC_DATA['filepath'] . $CONFIG['plugin_thumb_rotate_thumb_pfx'] . $CURRENT_PIC_DATA['filename_without_extension'] . '.'.$CONFIG['plugin_thumb_rotate_filetype'], $params['{THUMB}']);
    	}
		$params['{THUMB}'] = str_replace('class="image"', 'class="image" style="border:none;"', $params['{THUMB}']); // Remove border CSS
    }
    //$params['{THUMB}'] .= $created_image_array['height'];
    return $params;
}

function thumb_rotate_install() {
    global $CONFIG, $thumb_rotate_installation, $thisplugin;
	// Create the super cage
	$superCage = Inspekt::makeSuperCage();
	$thumb_rotate_installation = 1;
	require 'include/sql_parse.php';
	if (!$CONFIG['plugin_thumb_rotate_radius']) {
		$CONFIG['plugin_thumb_rotate_radius'] = '20';
	}
	if (!$CONFIG['plugin_thumb_rotate_maxrotation']) {
		$CONFIG['plugin_thumb_rotate_maxrotation'] = 15;
	}
	if (!$CONFIG['plugin_thumb_rotate_bgcolor']) {
		$CONFIG['plugin_thumb_rotate_bgcolor'] = '#EFEFEF';
	}
	if (!$CONFIG['plugin_thumb_rotate_borderwidth']) {
		$CONFIG['plugin_thumb_rotate_borderwidth'] = 10;
	}
	if (!$CONFIG['plugin_thumb_rotate_bordercolor']) {
		$CONFIG['plugin_thumb_rotate_bordercolor'] = '#FFFFFF';
	}
	if (!$CONFIG['plugin_thumb_rotate_thumb_pfx']) {
		$CONFIG['plugin_thumb_rotate_thumb_pfx'] = 'rotate_';
	}
	if (!$CONFIG['plugin_thumb_rotate_timestamp']) {
		$CONFIG['plugin_thumb_rotate_timestamp'] = time();
	}
	if (!$CONFIG['plugin_thumb_rotate_timelimit']) {
		$CONFIG['plugin_thumb_rotate_timelimit'] = '0';
	}
	if (!$CONFIG['plugin_thumb_rotate_admin_only']) {
		$CONFIG['plugin_thumb_rotate_admin_only'] = '0';
	}
	if (!$CONFIG['plugin_thumb_rotate_filetype']) {
		$CONFIG['plugin_thumb_rotate_filetype'] = 'png';
	}
	if (!$CONFIG['plugin_thumb_rotate_rotation_method']) {
		$CONFIG['plugin_thumb_rotate_rotation_method'] = 'random';
	}
    // Perform the database changes
    $db_schema = $thisplugin->fullpath . '/schema.sql';
    $sql_query = fread(fopen($db_schema, 'r'), filesize($db_schema));
    $sql_query = preg_replace('/CPG_/', $CONFIG['TABLE_PREFIX'], $sql_query);
    $sql_query = remove_remarks($sql_query);
    $sql_query = split_sql_file($sql_query, ';');
    foreach($sql_query as $q) {
    	cpg_db_query($q);
    }	
    if ($superCage->post->keyExists('thumb_rotate_continue_anyway') == TRUE && $superCage->post->getInt('thumb_rotate_continue_anyway') == 1) {
        $thumb_rotate_installation = 0;
        return true;
    // Loop again
    } else {
        return 1;
    }
    //return true;
}

function thumb_rotate_uninstall() {
	global $CONFIG;
	$superCage = Inspekt::makeSuperCage();
	if (!$superCage->post->keyExists('submit')) {
		return 1;
	}
	if ($superCage->post->keyExists('cache') && $superCage->post->getInt('cache') == 1) {
		thumb_rotate_empty_cache();
		cpg_db_query("DROP TABLE IF EXISTS {$CONFIG['TABLE_PREFIX']}plugin_thumb_rotate");
	}
	// Drop the database records
	if ($superCage->post->keyExists('drop') && $superCage->post->getInt('drop') == 1) {
		cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_thumb_rotate_radius'");
		cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_thumb_rotate_maxrotation'");
		cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_thumb_rotate_bgcolor'");
		cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_thumb_rotate_borderwidth'");
		cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_thumb_rotate_bordercolor'");
		cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_thumb_rotate_thumb_pfx'");
		cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_thumb_rotate_timestamp'");
		cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_thumb_rotate_timelimit'");
		cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_thumb_rotate_admin_only'");
		cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_thumb_rotate_filetype'");
		cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_thumb_rotate_rotation_method'");
	}
	return true;
}

// Ask if we want to drop the table
function thumb_rotate_cleanup($action) {
    global $CONFIG, $lang_plugin_thumb_rotate, $lang_common, $thumb_rotate_icon_array;
	// Initialize language and icons
	require_once './plugins/thumb_rotate/init.inc.php';
	$thumb_rotate_init_array = thumb_rotate_initialize();
	$lang_plugin_thumb_rotate = $thumb_rotate_init_array['language']; 
	$thumb_rotate_icon_array = $thumb_rotate_init_array['icon'];
    $superCage = Inspekt::makeSuperCage();
    $cleanup = $superCage->server->getEscaped('REQUEST_URI');
    if ($action===1) {
    echo <<< EOT
    <form action="{$cleanup}" method="post">
EOT;
    starttable('100%', '', 2);
    echo <<< EOT
            <tr>
                <td class="tableb">
                    {$lang_plugin_thumb_rotate['config']}
                </td>
                <td class="tableb">
                    <input type="checkbox" class="checkbox" name="drop" id="drop_yes" value="1" />
                    <label for="drop_yes" class="clickable_option">{$lang_plugin_thumb_rotate['remove_settings']}</label>
                </td>
            </tr>
			<tr>
                <td class="tableb tableb_alternate">
                    {$lang_plugin_thumb_rotate['cache']}
                </td>
                <td class="tableb tableb_alternate">
                    <input type="checkbox" name="cache" id="cache" class="checkbox" value="1" checked="checked" />
					<label for="cache" class="clickable_option">{$lang_plugin_thumb_rotate['empty_cache']}</label>
                </td>
            </tr>
            <tr>
                <td class="tablef">
				</td>
				<td class="tablef">
                    <button type="submit" class="button" name="submit" value="{$lang_common['go']}">{$thumb_rotate_icon_array['ok']}{$lang_common['go']}</button>
                </td>
            </tr>
EOT;
	endtable();
    echo <<< EOT
    </form>
EOT;
    }
}

function thumb_rotate_empty_cache(){
	global $CONFIG;
	$loopCounter = 0;
	$result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PREFIX']}plugin_thumb_rotate");
	while ($row = mysql_fetch_assoc($result)) {
		cpg_folder_file_delete($CONFIG['fullpath'] . $row['filepath']);
		$loopCounter++;
	}
	cpg_db_query("TRUNCATE TABLE `{$CONFIG['TABLE_PREFIX']}plugin_thumb_rotate`");
	return $loopCounter;
}

// Configure function: displays the configuration form
function thumb_rotate_configure() {
    global $CONFIG, $thisplugin, $lang_plugin_thumb_rotate, $lang_common, $thumb_rotate_icon_array, $lang_errors, $thumb_rotate_installation, $imagerotate_exist;
    $superCage = Inspekt::makeSuperCage();
    if (!GALLERY_ADMIN_MODE) {
    	cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
    }
	if ($CONFIG['thumb_use'] == 'any' || $CONFIG['thumb_use'] == 'ex') {
		$max_radius = floor( max($CONFIG['thumb_width'], $CONFIG['thumb_height']) /2);
	} elseif ($CONFIG['thumb_use'] == 'ht') {
		$max_radius = floor($CONFIG['thumb_height'] / 2);
	} else {
		$max_radius = floor($CONFIG['thumb_width'] / 2);
	}
    // Populate the form fields and run the queries for the submit form
    $config_changes_counter = 0;
	$dump_cache = 0;
	
    // Radius
	if ($superCage->post->keyExists('plugin_thumb_rotate_radius') == TRUE) {
        if ($superCage->post->getInt('plugin_thumb_rotate_radius') >= 0 && $superCage->post->getInt('plugin_thumb_rotate_radius') <= $max_radius && $CONFIG['plugin_thumb_rotate_radius'] != $superCage->post->getInt('plugin_thumb_rotate_radius')) {
            $CONFIG['plugin_thumb_rotate_radius'] = $superCage->post->getInt('plugin_thumb_rotate_radius');
            $query = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_thumb_rotate_radius']}' WHERE name='plugin_thumb_rotate_radius'";
            cpg_db_query($query);
            $config_changes_counter++;
			$dump_cache++;
        }
    }

    
    // maxrotation
    if ($superCage->post->keyExists('plugin_thumb_rotate_maxrotation') == TRUE) {
        if ($superCage->post->getInt('plugin_thumb_rotate_maxrotation') >= 0 && $superCage->post->getInt('plugin_thumb_rotate_maxrotation') < 360 && $CONFIG['plugin_thumb_rotate_maxrotation'] != $superCage->post->getInt('plugin_thumb_rotate_maxrotation')) {
            $CONFIG['plugin_thumb_rotate_maxrotation'] = $superCage->post->getInt('plugin_thumb_rotate_maxrotation');
            $query = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_thumb_rotate_maxrotation']}' WHERE name='plugin_thumb_rotate_maxrotation'";
            cpg_db_query($query);
            $config_changes_counter++;
			$dump_cache++;
        }
    }

    // bgcolor
    if ($superCage->post->keyExists('plugin_thumb_rotate_bgcolor') == TRUE) {
        $temp = $superCage->post->getRaw('plugin_thumb_rotate_bgcolor'); // Usually, we would not use that method, but we'll sanitize later.
        $temp = '#' . strtoupper(ltrim($temp, '#'));
		if (preg_match('/^#(?:(?:[a-f\d]{3}){1,2})$/i', $temp)) {
	        if ($CONFIG['plugin_thumb_rotate_bgcolor'] != $temp) {
	            $CONFIG['plugin_thumb_rotate_bgcolor'] = $temp;
	            $query = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_thumb_rotate_bgcolor']}' WHERE name='plugin_thumb_rotate_bgcolor'";
	            cpg_db_query($query);
	            $config_changes_counter++;
				$dump_cache++;
	        }
        }
    }
    
    // borderwidth
    if ($superCage->post->keyExists('plugin_thumb_rotate_borderwidth') == TRUE) {
        if ($superCage->post->getInt('plugin_thumb_rotate_borderwidth') >= 0 && $superCage->post->getInt('plugin_thumb_rotate_borderwidth') <= 99 && $CONFIG['plugin_thumb_rotate_borderwidth'] != $superCage->post->getInt('plugin_thumb_rotate_borderwidth')) {
            $CONFIG['plugin_thumb_rotate_borderwidth'] = $superCage->post->getInt('plugin_thumb_rotate_borderwidth');
            $query = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_thumb_rotate_borderwidth']}' WHERE name='plugin_thumb_rotate_borderwidth'";
            cpg_db_query($query);
            $config_changes_counter++;
			$dump_cache++;
        }
    }
    
    // bordercolor
    if ($superCage->post->keyExists('plugin_thumb_rotate_bordercolor') == TRUE) {
        $temp = $superCage->post->getRaw('plugin_thumb_rotate_bordercolor'); // Usually, we would not use that method, but we'll sanitize later.
        $temp = '#' . strtoupper(ltrim($temp, '#'));
		if (preg_match('/^#(?:(?:[a-f\d]{3}){1,2})$/i', $temp)) {
	        if ($CONFIG['plugin_thumb_rotate_bordercolor'] != $temp) {
	            $CONFIG['plugin_thumb_rotate_bordercolor'] = $temp;
	            $query = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_thumb_rotate_bordercolor']}' WHERE name='plugin_thumb_rotate_bordercolor'";
	            cpg_db_query($query);
	            $config_changes_counter++;
				$dump_cache++;
	        }
        }
    }
    
    // admin-only toggle
     if ($superCage->post->keyExists('plugin_thumb_rotate_admin_only') == TRUE && $superCage->post->getInt('plugin_thumb_rotate_admin_only') == 1) {
     	$temp = 1;
     } elseif($superCage->post->keyExists('submit') == TRUE) {
     	$temp = 0;
     } else {
     	$temp = $CONFIG['plugin_thumb_rotate_admin_only'];
     }
    if ($CONFIG['plugin_thumb_rotate_admin_only'] != $temp) {
        $CONFIG['plugin_thumb_rotate_admin_only'] = $temp;
        $query = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_thumb_rotate_admin_only']}' WHERE name='plugin_thumb_rotate_admin_only'";
        cpg_db_query($query);
        $config_changes_counter++;
    }
    if ($CONFIG['plugin_thumb_rotate_admin_only'] == 1) {
    	$option_output['plugin_thumb_rotate_admin_only'] = 'checked="checked"';
    } else {
    	$option_output['plugin_thumb_rotate_admin_only'] = '';
    }
    
    // delay (timelimit)
    if ($superCage->post->keyExists('plugin_thumb_rotate_timelimit') == TRUE) {
        if ($superCage->post->getInt('plugin_thumb_rotate_timelimit') >= 0 && $superCage->post->getInt('plugin_thumb_rotate_timelimit') <= 9 && $CONFIG['plugin_thumb_rotate_timelimit'] != $superCage->post->getInt('plugin_thumb_rotate_timelimit')) {
            $CONFIG['plugin_thumb_rotate_timelimit'] = $superCage->post->getInt('plugin_thumb_rotate_timelimit');
            $query = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_thumb_rotate_timelimit']}' WHERE name='plugin_thumb_rotate_timelimit'";
            cpg_db_query($query);
            $config_changes_counter++;
        }
    }
    
    // File type
    $thumb_rotate_extension_allowed = array('png', 'jpg'); // Only what is specified in this array will be allowed to be submit
    if ($superCage->post->keyExists('plugin_thumb_rotate_filetype') == TRUE && in_array($superCage->post->getAlpha('plugin_thumb_rotate_filetype'), $thumb_rotate_extension_allowed) == TRUE && $superCage->post->getAlpha('plugin_thumb_rotate_filetype') != $CONFIG['plugin_thumb_rotate_filetype']) {
    	$CONFIG['plugin_thumb_rotate_filetype'] = $superCage->post->getAlpha('plugin_thumb_rotate_filetype');
    	$query = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_thumb_rotate_filetype']}' WHERE name='plugin_thumb_rotate_filetype'";
    	cpg_db_query($query);
    	$config_changes_counter++;
    	$dump_cache++;
    }
    if ($CONFIG['plugin_thumb_rotate_filetype'] == 'jpg') {
    	$option_output['plugin_thumb_rotate_filetype_png'] = '';
    	$option_output['plugin_thumb_rotate_filetype_jpg'] = 'checked="checked"';
    } else { // default is "png"
    	$option_output['plugin_thumb_rotate_filetype_png'] = 'checked="checked"';
    	$option_output['plugin_thumb_rotate_filetype_jpg'] = '';
    }
	
	// Rotation method
    $thumb_rotate_rotation_method_allowed = array('random', 'fixed'); // Only what is specified in this array will be allowed to be submit
    if ($superCage->post->keyExists('plugin_thumb_rotate_rotation_method') == TRUE && in_array($superCage->post->getAlpha('plugin_thumb_rotate_rotation_method'), $thumb_rotate_rotation_method_allowed) == TRUE && $superCage->post->getAlpha('plugin_thumb_rotate_rotation_method') != $CONFIG['plugin_thumb_rotate_rotation_method']) {
    	$CONFIG['plugin_thumb_rotate_rotation_method'] = $superCage->post->getAlpha('plugin_thumb_rotate_rotation_method');
    	$query = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_thumb_rotate_rotation_method']}' WHERE name='plugin_thumb_rotate_rotation_method'";
    	cpg_db_query($query);
    	$config_changes_counter++;
    	$dump_cache++;
    }
    if ($CONFIG['plugin_thumb_rotate_rotation_method'] == 'fixed') {
    	$option_output['plugin_thumb_rotate_rotation_method_random'] = '';
    	$option_output['plugin_thumb_rotate_rotation_method_fixed'] = 'checked="checked"';
    } else { // default is "random"
    	$option_output['plugin_thumb_rotate_rotation_method_random'] = 'checked="checked"';
    	$option_output['plugin_thumb_rotate_rotation_method_fixed'] = '';
    }
    
    // Form submit?
    if ($superCage->post->keyExists('submit') == TRUE) {
    	if ($config_changes_counter > 0) {
    		$additional_submit_information = '<div class="cpg_message_success">' . $lang_plugin_thumb_rotate['changes_saved'] . '</div>';
			// a config change has been submit, so let's delete the cache
			if ($dump_cache > 0) {
				thumb_rotate_empty_cache();
			}
    	} else {
    		$additional_submit_information = '<div class="cpg_message_validation">' . $lang_plugin_thumb_rotate['no_changes'] . '</div>';
    	}
    }



	// Create the table row that is displayed during initial install
	if ($thumb_rotate_installation == 1) {
		$additional_submit_information = '<div class="cpg_message_info">' . $lang_plugin_thumb_rotate['submit_to_install'] . '</div>';
		$install_section = <<< EOT
                    <tr>
                        <td valign="top" class="tableb">
                        	{$lang_plugin_thumb_rotate['minimum_requirements']}
                        </td>
                        <td valign="top" class="tableb">
EOT;
		$my_php_version = substr(phpversion(),0,strpos(phpversion(), '-'));
		if ($my_php_version == '') {
			$my_php_version = PHP_VERSION;
		}
		if (version_compare($my_php_version, '4.3.2', '>')) {
			$install_section .= '<div class="cpg_message_success">' . sprintf($lang_plugin_thumb_rotate['minimum_requirements_ok'], 'PHP', '<strong>'.$my_php_version.'</strong>') . '</div>';
			$php_ok = 1;
		} else {
			$install_section .= '<div class="cpg_message_error">' . sprintf($lang_plugin_thumb_rotate['minimum_requirements_low'], 'PHP', '<strong>'.$my_php_version.'</strong>') . '</div>';
			$php_ok = 0;
		}
		if (function_exists('gd_info') == true) {
            $gd_array = gd_info();
            if (array_key_exists('GD Version' , $gd_array) == TRUE) {
             	$my_gd_version = ereg_replace('[[:alpha:][:space:]()]+', '', $gd_array['GD Version']);
             	if (version_compare($my_gd_version, '2', '>=')) {
             		$install_section .= '<div class="cpg_message_success">' . sprintf($lang_plugin_thumb_rotate['minimum_requirements_ok'], 'GD', '<strong>'.$my_gd_version.'</strong>') . '</div>';
             		$gd_ok = 1;
					// Check the needed image manipulation function imagerotate that doesn't exist in all flavors of PHP
					if ($imagerotate_exist != 1) {
						$install_section .= '<div class="cpg_message_validation">' . $lang_plugin_thumb_rotate['minimum_requirements_imagerotate'] . '</div>';
					}
             	} else {
             		$install_section .= '<div class="cpg_message_error">' . sprintf($lang_plugin_thumb_rotate['minimum_requirements_low'], 'GD', '<strong>'.$my_gd_version.'</strong>') . '</div>';
             		$gd_ok = 0;
             	}
            } else {
            	$install_section .= '<div class="cpg_message_validation">' . $lang_plugin_thumb_rotate['minimum_requirements_unavailabl'] . '</div>';
            	$gd_ok = 0;
            }
		} else {
			$install_section .= '<div class="cpg_message_validation">' . $lang_plugin_thumb_rotate['minimum_requirements_unavailable'] . '</div>';
			$gd_ok = 0;
		}

		if ($gd_ok == 1 && $php_ok == 1 && $imagerotate_exist == 1) {
			$install_section .= <<< EOT
				<input type="hidden" name="thumb_rotate_continue_anyway" id="thumb_rotate_continue_anyway" value="1" />
EOT;
		} else {
			$install_section .= <<< EOT
				<input type="checkbox" name="thumb_rotate_continue_anyway" id="thumb_rotate_continue_anyway" class="checkbox" value="1" />
				<label for="thumb_rotate_continue_anyway">{$lang_plugin_thumb_rotate['continue_anyway']}</label>
EOT;
		}
		$install_section .= <<< EOT
                        </td>
                    </tr>
EOT;
	} else {
		// Stuff that should not be displayed during initial install, but only after the plugin is already running
		// Populate the cache stats
		$result = cpg_db_query("SELECT COUNT(*) FROM {$CONFIG['TABLE_PREFIX']}plugin_thumb_rotate");
		list($cached_files) = mysql_fetch_row($result);
		mysql_free_result($result);
		$result = cpg_db_query("SELECT COUNT(*) FROM {$CONFIG['TABLE_PICTURES']}");
		list($image_files_total) = mysql_fetch_row($result);
		mysql_free_result($result);
		$result = cpg_db_query("SELECT filepath FROM {$CONFIG['TABLE_PREFIX']}plugin_thumb_rotate ORDER BY RAND() LIMIT 0,1");
		$row = mysql_fetch_assoc($result);
		if ($row['filepath'] != '') {
			$preview = '<img src="' . $CONFIG['fullpath'] . $row['filepath'] . '" border="0" class="image" style="border:none;" alt="" />';
		} else {
			$preview = $lang_plugin_thumb_rotate['no_preview_available'];
		}
		mysql_free_result($result);
		$cached_files_output = sprintf($lang_plugin_thumb_rotate['cache_size'], '<strong>'.$cached_files.'</strong>', $image_files_total). '<br />&nbsp;<br />';
		if ($cached_files != 0) {
			$cached_files_output .= ' <a href="index.php?file=thumb_rotate/empty_cache" class="admin_menu">' . $thumb_rotate_icon_array['cancel'] . $lang_plugin_thumb_rotate['empty_cache'] . '</a>';
		} 
		if ($cached_files < $image_files_total) {
			$cached_files_output .= ' <a href="index.php?file=thumb_rotate/batch_fill" class="admin_menu">' . $thumb_rotate_icon_array['batch'] . $lang_plugin_thumb_rotate['batch_fill'] . '</a>';
		} 
		
		$install_section = <<< EOT
                    <tr>
                        <td valign="top" class="tableb">
                        	{$lang_plugin_thumb_rotate['cache']}
                        </td>
                        <td valign="top" class="tableb">
							{$cached_files_output}
                        </td>
                    </tr>
					<tr>
                        <td valign="top" class="tableb tableb_alternate">
                        	{$lang_plugin_thumb_rotate['preview']}
                        </td>
                        <td valign="top" class="tableb tableb_alternate">
							{$preview}
                        </td>
                    </tr>
EOT;
	}
	
	// Start the actual output
    echo <<< EOT
    		<style type="text/css" media="screen">
				.farbtastic {
				  position: relative;
				}
				.farbtastic * {
				  position: absolute;
				  cursor: crosshair;
				}
				.farbtastic, .farbtastic .wheel {
				  width: 195px;
				  height: 195px;
				}
				.farbtastic .color, .farbtastic .overlay {
				  top: 47px;
				  left: 47px;
				  width: 101px;
				  height: 101px;
				}
				.farbtastic .wheel {
				  background: url(plugins/thumb_rotate/images/wheel.png) no-repeat;
				  width: 195px;
				  height: 195px;
				}
				.farbtastic .overlay {
				  background: url(plugins/thumb_rotate/images/mask.png) no-repeat;
				}
				.farbtastic .marker {
				  width: 17px;
				  height: 17px;
				  margin: -8px 0 0 -8px;
				  overflow: hidden; 
				  background: url(plugins/thumb_rotate/images/marker.png) no-repeat;
				}
    		</style>
    		<script type="text/javascript">
				$(document).ready(function() {
				    $('#colorpicker_bgcolor').farbtastic('#plugin_thumb_rotate_bgcolor');
				    $('#colorpicker_bordercolor').farbtastic('#plugin_thumb_rotate_bordercolor');
					$("#plugin_thumb_rotate_radius").SpinButton({min: 0,max: {$max_radius}});
				    $("#plugin_thumb_rotate_maxrotation").SpinButton({min: 0,max: 359});
				    $("#plugin_thumb_rotate_borderwidth").SpinButton({min: 0,max: 99});
				    $("#plugin_thumb_rotate_timelimit").SpinButton({min: 0,max: 9});
				});
    		</script>
            <form action="" method="post" name="thumb_rotate_config" id="thumb_rotate_config">
EOT;

    starttable('100%', $thumb_rotate_icon_array['config'] . $lang_plugin_thumb_rotate['config'], 2);
    echo <<< EOT
                    <tr>
                        <td valign="top" class="tableb tableb_alternate">
                            {$lang_plugin_thumb_rotate['option_bgcolor']}
                        </td>
                        <td valign="top" class="tableb tableb_alternate">
								<input type="text" name="plugin_thumb_rotate_bgcolor" id="plugin_thumb_rotate_bgcolor" class="textinput" size="8" maxlength="7" value="{$CONFIG['plugin_thumb_rotate_bgcolor']}" style="text-transform:uppercase;" />
							<span class="detail_head_collapsed">{$lang_plugin_thumb_rotate['toggle_color_picker']}</span>
							<div id="colorpicker_bgcolor" class="detail_body"></div>
                        </td>
                    </tr>
					<tr>
                        <td valign="top" class="tableb">
                            {$lang_plugin_thumb_rotate['option_border']}
                        </td>
                        <td valign="top" class="tableb">
                        	{$lang_plugin_thumb_rotate['option_borderwidth']}: <input type="text" name="plugin_thumb_rotate_borderwidth" id="plugin_thumb_rotate_borderwidth" class="textinput spin-button" size="2" maxlength="2" value="{$CONFIG['plugin_thumb_rotate_borderwidth']}" /> {$lang_plugin_thumb_rotate['pixels']} ({$lang_plugin_thumb_rotate['zero_to_disable']})
							<br />&nbsp;<br />
							{$lang_plugin_thumb_rotate['option_bordercolor']}
							<input type="text" name="plugin_thumb_rotate_bordercolor" id="plugin_thumb_rotate_bordercolor" class="textinput" size="8" maxlength="7" value="{$CONFIG['plugin_thumb_rotate_bordercolor']}" style="text-transform:uppercase;" />
							<span class="detail_head_collapsed">{$lang_plugin_thumb_rotate['toggle_color_picker']}</span>
							<div id="colorpicker_bordercolor" class="detail_body"></div>
                        </td>
                    </tr>
					<tr>
                        <td valign="top" class="tableb tableb_alternate">
                            {$lang_plugin_thumb_rotate['option_rounded_corners']}
                        </td>
                        <td valign="top" class="tableb tableb_alternate">
							{$lang_plugin_thumb_rotate['option_rounded_corners_radius']}:
							<input type="text" name="plugin_thumb_rotate_radius" id="plugin_thumb_rotate_radius" size="2" maxlength="2" class="textinput spin-button" value="{$CONFIG['plugin_thumb_rotate_radius']}"  />
							{$lang_plugin_thumb_rotate['pixels']}
							({$lang_plugin_thumb_rotate['zero_to_disable']})
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" class="tableb">
                            {$lang_plugin_thumb_rotate['option_rotation']}
                        </td>
                        <td valign="top" class="tableb">
                        	{$lang_plugin_thumb_rotate['option_rotation_method']}:
							<input type="radio" name="plugin_thumb_rotate_rotation_method" id="plugin_thumb_rotate_rotation_method_random" class="checkbox" value="random" {$option_output['plugin_thumb_rotate_rotation_method_random']} /> 
                        	<label for="plugin_thumb_rotate_rotation_method_random">{$lang_plugin_thumb_rotate['option_rotation_method_random']}</label>
                        	&nbsp;
                        	<input type="radio" name="plugin_thumb_rotate_rotation_method" id="plugin_thumb_rotate_rotation_method_fixed" class="checkbox" value="fixed" {$option_output['plugin_thumb_rotate_rotation_method_fixed']} /> 
                        	<label for="plugin_thumb_rotate_rotation_method_fixed">{$lang_plugin_thumb_rotate['option_rotation_method_fixed']}</label>
							<br />&nbsp;<br />
							{$lang_plugin_thumb_rotate['option_maxrotation']}: <input type="text" name="plugin_thumb_rotate_maxrotation" id="plugin_thumb_rotate_maxrotation" class="textinput spin-button" size="3" maxlength="3" value="{$CONFIG['plugin_thumb_rotate_maxrotation']}" /> &deg;
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" class="tableb tableb_alternate">
                            {$lang_plugin_thumb_rotate['option_admin_only']}
                        </td>
                        <td valign="top" class="tableb tableb_alternate">
                        	<input type="checkbox" name="plugin_thumb_rotate_admin_only" id="plugin_thumb_rotate_admin_only" class="checkbox" value="1" {$option_output['plugin_thumb_rotate_admin_only']} /> 
                        	<label for="plugin_thumb_rotate_admin_only">({$lang_plugin_thumb_rotate['option_admin_only_explain']})</label>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" class="tableb">
                            {$lang_plugin_thumb_rotate['option_timelimit']}
                        </td>
                        <td valign="top" class="tableb">
                        	<input type="text" name="plugin_thumb_rotate_timelimit" id="plugin_thumb_rotate_timelimit" class="textinput spin-button" size="1" maxlength="1" value="{$CONFIG['plugin_thumb_rotate_timelimit']}" /> {$lang_plugin_thumb_rotate['seconds']} ({$lang_plugin_thumb_rotate['zero_to_disable']})
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" class="tableb tableb_alternate">
                            {$lang_plugin_thumb_rotate['option_filetype']}
                        </td>
                        <td valign="top" class="tableb tableb_alternate">
                        	<input type="radio" name="plugin_thumb_rotate_filetype" id="plugin_thumb_rotate_filetype_png" class="checkbox" value="png" {$option_output['plugin_thumb_rotate_filetype_png']} /> 
                        	<label for="plugin_thumb_rotate_filetype_png">PNG ({$lang_plugin_thumb_rotate['option_filetype_png_explain']})</label>
                        	<br />
                        	<input type="radio" name="plugin_thumb_rotate_filetype" id="plugin_thumb_rotate_filetype_jpg" class="checkbox" value="jpg" {$option_output['plugin_thumb_rotate_filetype_jpg']} /> 
                        	<label for="plugin_thumb_rotate_filetype_jpg">JPG ({$lang_plugin_thumb_rotate['option_filetype_jpg_explain']})</label>
                        </td>
                    </tr>
                    {$install_section}
                    <tr>
                        <td valign="middle" class="tablef">
                        </td>
                        <td valign="middle" class="tablef">
                            <button type="submit" class="button" name="submit" value="{$lang_common['ok']}">{$thumb_rotate_icon_array['ok']}{$lang_common['ok']}</button>
                        </td>
                    </tr>
EOT;
    endtable();
    echo <<< EOT
            {$additional_submit_information}
            </form>

EOT;

}

if (!function_exists('imagerotate')) {
	// The function imagerotate doesn't exist in all flavors of PHP (it doesn't exist in regular Ubuntu packages for example), so we'll provide an alternative.
	// Details can be found on the documentation page for imagerotate.
	$imagerotate_exist = 0;
	function imagerotate(&$srcImg, $angle, $transparentColor = null) {
		global $CONFIG;
		// Try to determine the path to ImageMagick
		foreach ( array( $CONFIG['impath'], '/usr/bin', '/usr/local/bin', '/opt/local/bin', '/sw/bin' ) as $path ) {
			if ( file_exists( $path . '/convert' ) ) {
				$imagick = $path . '/convert';
				if ( $path == '/opt/local/bin' ) {
					$imagick = 'DYLD_LIBRARY_PATH="" ' . $imagick; // some kind of conflict with MacPorts and MAMP
				}
				break;
			}
		}
		if ( isset( $imagick ) ) {
			// ImageMagick appears to exist, so let's use that
			$angle_im = 360-$angle; // GD rotates CCW, imagick rotates CW
			$file1 = '/tmp/imagick_' . rand( 10000,99999 ) . '.png';
			$file2 = '/tmp/imagick_' . rand( 10000,99999 ) . '.png';
			if ( @imagepng( $source_image, $file1 ) ) {
				exec( $imagick . ' -rotate ' . $angle_im . ' ' . $file1 . ' ' . $file2 );
				if ( file_exists( $file2 ) ) {
					$new_image = imagecreatefrompng( $file2 );
					unlink( $file1 );
					unlink( $file2 );
					return $new_image;
				} 
			}
		} // End ImageMagick Workaround
		$srcw = imagesx($srcImg);
		$srch = imagesy($srcImg);
	   
		if($angle == 0) return $srcImg;
	   
		// Convert the angle to radians
		$pi = 3.141592654;
		$theta = $angle * $pi / 180;
	   
		// Get the origin (center) of the image
		$originx = $srcw / 2;
		$originy = $srch / 2;
	   
		// The pixels array for the new image
		$pixels = array();
		$minx = 0;
		$maxx = 0;
		$miny = 0;
		$maxy = 0;
		$dstw = 0;
		$dsth = 0;
	   
		// Loop through every pixel and transform it
		for($x=0;$x<$srcw;$x++) {
			for($y=0;$y<$srch;$y++) {
				list($x1, $y1) = translateCoordinate($originx, $originy, $x, $y, false);
			   
				$theta1 = 0;
				$noTranslate = false;
			   
				// Determine the angle of original point
				if($x1 > 0 && $y1 > 0) {
					// Quadrant 1
					$theta1 = atan($y1/$x1);
				} elseif($x1 < 0 && $y1 > 0) {
					// Quadrant 2
					$theta1 = $pi - atan($y1/abs($x1));
				} elseif($x1 < 0 && $y1 < 0) {
					// Quadrant 3
					$theta1 = $pi + atan($y1/$x1);
				} elseif($x1 > 0 && $y1 < 0) {
					// Quadrant 4
					$theta1 = 2 * $pi - atan(abs($y1)/$x1);
				} elseif($x1 == 0 && $y1 > 0) {
					$theta1 = $pi / 2;
				} elseif($x1 == 0 && $y1 < 0) {
					$theta1 = 3 * $pi / 2;
				} elseif($x1 > 0 && $y1 == 0) {
					$theta1 = 0;
				} elseif($x1 < 0 && $y1 == 0) {
					$theta1 = $pi;
				} else {
					// Only case left should be $x1 == 0 && $y1 == 0
					$noTranslate = true;
				}
			   
				// Translate the position
				if(!$noTranslate) {
					// Calculate the new angle
					$theta2 = $theta1 + $theta;
				   
					// Make sure theta2 is in between 0 - 2pi
					while($theta2 < 0) $theta2 += 2 * $pi;
					while($theta2 > (2 * $pi)) $theta2 -= 2 * $pi;
				   
					$radius = sqrt($x1*$x1 + $y1*$y1);
				   
					$x2 = ($radius * cos($theta2));
					$y2 = ($radius * sin($theta2));
				} else {
					$x2 = $x1;
					$y2 = $y1;
				}
			   
				// Store the pixel color
				$pixels[] = array($x2, $y2, imagecolorat($srcImg, $x, $y));
			   
				// Check our boundaries
				if($x2 > $maxx) $maxx = $x2;
				if($x2 < $minx) $minx = $x2;
				if($y2 > $maxy) $maxy = $y2;
				if($y2 < $miny) $miny = $y2;
			}
		}
	   
		// Determine the new image size
		$dstw = $maxx - $minx + 1;
		$dsth = $maxy - $miny + 1;
	   
		// Create our new image
		$dstImg = imagecreatetruecolor($dstw, $dsth);
	   
		// Fill the background with our transparent color
		if($transparentColor == null) $transparentColor = imagecolorallocate($dstImg, 1, 2, 3);
		imagecolortransparent($dstImg, $transparentColor);
		imagefilledrectangle($dstImg, 0, 0, $dstw + 1, $dsth + 1, $transparentColor);
	   
		// Get the new origin
		$neworiginx = -$minx;
		$neworiginy = -$miny;
	   
		// Fill in the pixels
		foreach($pixels as $data) {
			list($x, $y, $color) = $data;
			list($newx, $newy) = translateCoordinate($neworiginx, $neworiginy, $x, $y);
			imagesetpixel($dstImg, $newx, $newy, $color);
		}
	   
		return $dstImg;
	}
   
	/**
	 * Translates from mathematical coordinate system to computer coordinate system using
	 * origin coordinates from the computer system or visa versa
	 *
	 * @param int $originx
	 * @param int $originy
	 * @param int $x
	 * @param int $y
	 * @param bool $toComp
	 * @return array(int $x, int $y)
	 */
	function translateCoordinate($originx, $originy, $x, $y, $toComp=true) {
		if($toComp) {
			$newx = $originx + $x;
			$newy = $originy - $y;
		} else {
			$newx = $x - $originx;
			$newy = $originy - $y;
		}
	   
		return array($newx, $newy);
	}
} else {
	$imagerotate_exist = 1;
}

function thumb_rotate_html2rgb($color) {
    if ($color[0] == '#') {
        $color = substr($color, 1);
	}
    if (strlen($color) == 6) {
        list($r, $g, $b) = array($color[0].$color[1],$color[2].$color[3],$color[4].$color[5]);
    } elseif (strlen($color) == 3) {
        list($r, $g, $b) = array($color[0].$color[0], $color[1].$color[1], $color[2].$color[2]);
    } else {
        return false;
	}
    $r = hexdec($r); $g = hexdec($g); $b = hexdec($b);
    return array($r, $g, $b);
}

function thumb_rotate_image_create($CURRENT_PIC_DATA) {
	global $CONFIG, $gd_extension_array, $THEME_DIR;
	// Initialize some variables
	$background_color_array = thumb_rotate_html2rgb($CONFIG['plugin_thumb_rotate_bgcolor']);// split background color
	$border_color_array = thumb_rotate_html2rgb($CONFIG['plugin_thumb_rotate_bordercolor']);// split border color
	$transparent_border_width = 3;
	
	// create source image from existing thumb file
	if (in_array(strtolower($CURRENT_PIC_DATA['extension']), $gd_extension_array)) {
		$image = $CONFIG['fullpath'] . $CURRENT_PIC_DATA['filepath'] . $CONFIG['thumb_pfx'] . $CURRENT_PIC_DATA['filename'];
	} else { // None of the regular image file types
		if (is_readable($CONFIG['fullpath'] . $CURRENT_PIC_DATA['filepath'] . $CONFIG['thumb_pfx'] . $CURRENT_PIC_DATA['filename_without_extension'] . '.jpg') == TRUE) { // Is there a custom thumbnail available?
		$image = $CONFIG['fullpath'] . $CURRENT_PIC_DATA['filepath'] . $CONFIG['thumb_pfx'] . $CURRENT_PIC_DATA['filename_without_extension'] . '.jpg';
		} else { // use one of the generic thumbnails
			if (file_exists($THEME_DIR . 'images/thumbs/thumb_'.$CURRENT_PIC_DATA['extension'].'.png')) {
				$image = $THEME_DIR . 'images/thumbs/thumb_'.$CURRENT_PIC_DATA['extension'].'.png';
			} elseif ('images/thumbs/thumb_'.$CURRENT_PIC_DATA['extension'].'.png') {
				$image = 'images/thumbs/thumb_'.$CURRENT_PIC_DATA['extension'].'.png';
			}
		}
	}
	
	$extension = ltrim(substr($image, strrpos($image, '.')), '.');
	if (strtolower($extension) == 'png'){
		$source = imagecreatefrompng($image);
	} elseif (strtolower($extension) == 'gif') {
		$source = imagecreatefromgif($image);
	} elseif(strtolower($extension) == 'jpg' || strtolower($extension) == 'jpeg') {
		$source = imagecreatefromjpeg($image);
	} else {
		return;
	}
	// get width / height of source image
	$source_array['width'] = imagesx($source);
	$source_array['height'] = imagesy($source);
	
	// Find a color that doesn't exist in the source
	$palette = imagecreatetruecolor($source_array['width'], $source_array['height']); 
	$bordercolor = imagecolorallocate($palette, $border_color_array[0], $border_color_array[1], $border_color_array[2]);
	$found = FALSE;
	// Try the background color first first
	$r = $background_color_array[0];
	$g = $background_color_array[1];
	$b = $background_color_array[2];
	while($found == FALSE) {
		if(imagecolorexact($source, $r, $g, $b) != (-1) && ($r != $border_color_array[0] && $g != $border_color_array[1] && $b != $border_color_array[2])) {
			$transparent_color = imagecolorallocate($palette, $r, $g, $b);
			$found = TRUE; 
		}
		$r = rand(0, 255);
		$g = rand(0, 255);
		$b = rand(0, 255);
	}
	if ($CONFIG['plugin_thumb_rotate_radius'] > 0) { // Process rounded corners for inner image --- start
		// Enable antialias for this image
		if (function_exists('imageantialias')) {
			imageantialias($source, TRUE);
		}
		if ($CONFIG['plugin_thumb_rotate_borderwidth'] > 0) {
			$fill_color = $bordercolor;
		} else {
			$fill_color = $transparent_color;
		}
		// Top left
		imagearc($source, $CONFIG['plugin_thumb_rotate_radius'] - 1, $CONFIG['plugin_thumb_rotate_radius']-1, $CONFIG['plugin_thumb_rotate_radius']*2, $CONFIG['plugin_thumb_rotate_radius']*2, 180, 270, $fill_color);
		imagefilltoborder($source, 0, 0, $fill_color, $fill_color);
		// Top right
		imagearc($source, $source_array['width']-$CONFIG['plugin_thumb_rotate_radius'], $CONFIG['plugin_thumb_rotate_radius']-1, $CONFIG['plugin_thumb_rotate_radius']*2, $CONFIG['plugin_thumb_rotate_radius']*2, 270, 0, $fill_color);
		// Problem appears to lie in the line below
		imagefilltoborder($source, $source_array['width'], 0, $fill_color, $fill_color);
		// Bottom left
		imagearc($source, $CONFIG['plugin_thumb_rotate_radius']-1, $source_array['height']-$CONFIG['plugin_thumb_rotate_radius'], $CONFIG['plugin_thumb_rotate_radius']*2, $CONFIG['plugin_thumb_rotate_radius']*2, 90, 180, $fill_color);
		imagefilltoborder($source, 0, $source_array['height'], $fill_color, $fill_color);
		// Bottom right
		imagearc($source, $source_array['width']-$CONFIG['plugin_thumb_rotate_radius'], $source_array['height']-$CONFIG['plugin_thumb_rotate_radius'], $CONFIG['plugin_thumb_rotate_radius']*2, $CONFIG['plugin_thumb_rotate_radius']*2, 0, 90, $fill_color);
		imagefilltoborder($source, $source_array['width'], $source_array['height'], $fill_color, $fill_color);
	} // Process rounded corners for inner image --- end
	
	if ($CONFIG['plugin_thumb_rotate_borderwidth'] > 0) { // Apply the border --- start
		$processed_image = imagecreatetruecolor($source_array['width'] + ($CONFIG['plugin_thumb_rotate_borderwidth'] * 2), $source_array['height'] + ($CONFIG['plugin_thumb_rotate_borderwidth']  * 2) );
		imagefilledrectangle($processed_image,
							 0,
							 0,
							 $source_array['width'] + ($CONFIG['plugin_thumb_rotate_borderwidth']  * 2),
							 $source_array['height'] + ($CONFIG['plugin_thumb_rotate_borderwidth']  * 2) ,
							 $bordercolor
							 );
		
		// copy source into finalimg
		imagecopy($processed_image,
				  $source,
				  $CONFIG['plugin_thumb_rotate_borderwidth'],
				  $CONFIG['plugin_thumb_rotate_borderwidth'],
				  0,
				  0,
				  $source_array['width'],
				  $source_array['height']
				  );
				  
		$processed_array['width'] = imagesx($processed_image);
		$processed_array['height'] = imagesy($processed_image);
		if ($CONFIG['plugin_thumb_rotate_radius'] > 0) { // Process rounded corners for outer image --- start
			// Enable antialias for this image
			if (function_exists('imageantialias')) {
				imageantialias($processed_image, TRUE);
			}
			// Top left
			imagearc($processed_image, $CONFIG['plugin_thumb_rotate_radius'] - 1, $CONFIG['plugin_thumb_rotate_radius']-1, $CONFIG['plugin_thumb_rotate_radius']*2, $CONFIG['plugin_thumb_rotate_radius']*2, 180, 270, $transparent_color);
			imagefilltoborder($processed_image, 0, 0, $transparent_color, $transparent_color);
			// Top right
			imagearc($processed_image, $processed_array['width']-$CONFIG['plugin_thumb_rotate_radius'], $CONFIG['plugin_thumb_rotate_radius']-1, $CONFIG['plugin_thumb_rotate_radius']*2, $CONFIG['plugin_thumb_rotate_radius']*2, 270, 0, $transparent_color);
			imagefilltoborder($processed_image, $processed_array['width'], 0, $transparent_color, $transparent_color);
			// Bottom left
			imagearc($processed_image, $CONFIG['plugin_thumb_rotate_radius']-1, $processed_array['height']-$CONFIG['plugin_thumb_rotate_radius'], $CONFIG['plugin_thumb_rotate_radius']*2, $CONFIG['plugin_thumb_rotate_radius']*2, 90, 180, $transparent_color);
			imagefilltoborder($processed_image, 0, $processed_array['height'], $transparent_color, $transparent_color);
			// Bottom right
			imagearc($processed_image, $processed_array['width']-$CONFIG['plugin_thumb_rotate_radius'], $processed_array['height']-$CONFIG['plugin_thumb_rotate_radius'], $CONFIG['plugin_thumb_rotate_radius']*2, $CONFIG['plugin_thumb_rotate_radius']*2, 0, 90, $transparent_color);
			imagefilltoborder($processed_image, $processed_array['width'], $processed_array['height'], $transparent_color, $transparent_color);
		} // Process rounded corners for outer image --- end
	} else { // Apply the border --- end
		$processed_image = $source;
		$processed_array['width'] = imagesx($processed_image);
		$processed_array['height'] = imagesy($processed_image);
	}
	
	// Determine the level of rotation
    if ($CONFIG['plugin_thumb_rotate_rotation_method'] == 'random') {
	$degrees = rand(0, $CONFIG['plugin_thumb_rotate_maxrotation'] * 2);
    if ($degrees > $CONFIG['plugin_thumb_rotate_maxrotation']) {
    	$degrees = $degrees + 359 - $CONFIG['plugin_thumb_rotate_maxrotation']*2;
    }
	} else {
		$degrees = 360 - $CONFIG['plugin_thumb_rotate_maxrotation'];
	}
	
	// rotate image
	if ($CONFIG['plugin_thumb_rotate_maxrotation'] > 0) {
		$rotate = imagerotate($processed_image, $degrees, $transparent_color);
	} else {
		$rotate = $processed_image;
	}
	$rotate_array['width'] = imagesx($rotate);
	$rotate_array['height'] = imagesy($rotate);	

	// set transparency
	imagecolortransparent($rotate, $transparent_color);
	
	// deliver rotated file and save to cache
	if ($CONFIG['plugin_thumb_rotate_filetype'] == 'jpg') {
		$result = imagejpeg($rotate, $CONFIG['fullpath'] . $CURRENT_PIC_DATA['filepath'] . $CONFIG['plugin_thumb_rotate_thumb_pfx'] . $CURRENT_PIC_DATA['filename_without_extension'] . '.jpg', $CONFIG['jpeg_qual']);
	} else {
		$result = imagepng($rotate, $CONFIG['fullpath'] . $CURRENT_PIC_DATA['filepath'] . $CONFIG['plugin_thumb_rotate_thumb_pfx'] . $CURRENT_PIC_DATA['filename_without_extension'] . '.png');
	}
	if ($result) {
		$return = array(
		                'path' => $CURRENT_PIC_DATA['filepath'] . $CONFIG['plugin_thumb_rotate_thumb_pfx'] . $CURRENT_PIC_DATA['filename_without_extension'] . '.'.$CONFIG['plugin_thumb_rotate_filetype'], 
		                'width' => $rotate_array['width'], 
		                'height' => $rotate_array['height']
		                );
	} else {
		$return = '';
	}
	
	// clean up
	imagedestroy($source);
	imagedestroy($rotate);
	imagedestroy($processed_image);
	return $return;
}
?>
