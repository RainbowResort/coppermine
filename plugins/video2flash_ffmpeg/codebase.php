<?php
/**************************************************
  Coppermine 1.5.x Plugin - video2flash_ffmpeg
  *************************************************
  Copyright (c) 2010 Abbas Ali
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
  **************************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

// Add an install action
$thisplugin->add_action('plugin_install', 'video2flash_ffmpeg_install');

// Add a configure action
$thisplugin->add_action('plugin_configure', 'video2flash_ffmpeg_configure');

// Add an uninstall action
$thisplugin->add_action('plugin_uninstall','video2flash_ffmpeg_uninstall');

// Add a filter for file upload. This filter is called after the file is successfully uploaded and added to db
$thisplugin->add_filter('add_file_data', 'video2flash_ffmpeg_add_file_data');

// Add a filter for displaying the flv player on display image page
$thisplugin->add_filter('file_data', 'video2flash_ffmpeg_file_data');

// Add a filter for file delete. When a file is deleted then its thumb should also be deleted
$thisplugin->add_action('after_delete_file', 'video2flash_ffmpeg_delete_file');

global $video2flash_ffmpeg_configs;
$video2flash_ffmpeg_configs = array('video2flash_ffmpeg_ffmpeg_path', 'video2flash_ffmpeg_player_width', 'video2flash_ffmpeg_player_height', 'video2flash_ffmpeg_player_autostart', 'video2flash_ffmpeg_thumb_interval');

// Install function
// Inserts the config variables in cpg_config table
function video2flash_ffmpeg_install() {
    global $CONFIG, $video2flash_ffmpeg_configs;
    $superCage   = Inspekt::makeSuperCage();
    // Install
    if ($superCage->post->keyExists('video2flash_ffmpeg_ffmpeg_path') && trim($superCage->post->getEscaped('video2flash_ffmpeg_ffmpeg_path'))) {
        foreach ($video2flash_ffmpeg_configs as $config_name) {
            $config_value = trim($superCage->post->getEscaped($config_name));
            // If this is the time interval and is a single digit then add 0 in front of it
            if ($config_name == 'video2flash_ffmpeg_thumb_interval' && strlen($config_value) == 1) {
                $config_value = '0' . $config_value;
            }
            // Run the query to put a config variable for ffmpeg path
            if ($config_value) {
                $query = "REPLACE INTO {$CONFIG['TABLE_CONFIG']} SET name = '$config_name', value = '$config_value'";
                cpg_db_query($query);
            }
        }
        return true;

    // Loop again
    } else {

        return 1;
    }
}

// Configure function
// Displays the form
function video2flash_ffmpeg_configure() {
    global $CONFIG;
    
    if (!isset($CONFIG['video2flash_ffmpeg_player_width'])) {
        $CONFIG['video2flash_ffmpeg_player_width'] = 534;
    }
    
    if (!isset($CONFIG['video2flash_ffmpeg_player_height'])) {
        $CONFIG['video2flash_ffmpeg_player_height'] = 400;
    }
    
    if (!isset($CONFIG['video2flash_ffmpeg_thumb_interval'])) {
        $CONFIG['video2flash_ffmpeg_thumb_interval'] = 3;
    }    
    $autostart_yes = '';
    $autostart_no = '';
    if (!isset($CONFIG['video2flash_ffmpeg_player_autostart']) || $CONFIG['video2flash_ffmpeg_player_autostart'] == 'no') {
        $autostart_no = ' checked="checked"';
    } else {
        $autostart_yes = ' checked="checked"';
    }
    
    echo <<< EOT
    <form name="cpgform" id="cpgform" action="{$_SERVER['REQUEST_URI']}" method="post">
            <table border="0" cellspacing="0" cellpadding="0" width="100%">
              <tr>
                <td class="tableb" align="right" width="250">
                  Absolute path to ffmpeg binary:
                </td>
                <td class="tableb">
                  <input type="text" name="video2flash_ffmpeg_ffmpeg_path" class="textinput" style="width:50%;" value="{$CONFIG['video2flash_ffmpeg_ffmpeg_path']}" />
                </td>
              </tr>
              <tr>
                <td class="tableb" align="right" width="250">
                  Width of the FLV player:
                </td>
                <td class="tableb">
                  <input type="text" name="video2flash_ffmpeg_player_width" class="textinput" size="3" value="{$CONFIG['video2flash_ffmpeg_player_width']}" />
                </td>
              </tr>
              <tr>
                <td class="tableb" align="right" width="250">
                  Height of the FLV Player:
                </td>
                <td class="tableb">
                  <input type="text" name="video2flash_ffmpeg_player_height" class="textinput" size="3" value="{$CONFIG['video2flash_ffmpeg_player_height']}" />
                </td>
              </tr>
              <tr>
                <td class="tableb" align="right" width="250">
                  Thumb extraction interval in seconds (< 60):
                </td>
                <td class="tableb">
                  <input type="text" name="video2flash_ffmpeg_thumb_interval" class="textinput" size="3" value="{$CONFIG['video2flash_ffmpeg_thumb_interval']}" />
                </td>
              </tr>
              <tr>
                <td class="tableb" align="right" width="250">
                  Automatically start the player on load :
                </td>
                <td class="tableb">
                  <input type="radio" id="autostart_yes" name="video2flash_ffmpeg_player_autostart" class="radio" {$autostart_yes} value="yes"/>
                  <label for="autostart_yes">Yes</label>
                  &nbsp;&nbsp;
                  <input type="radio" id="autostart_no" name="video2flash_ffmpeg_player_autostart" class="radio" value="no" {$autostart_no} />
                  <label for="autostart_no">No</label>
                </td>
              </tr>
              <tr>
                <td class="tablef" colspan="2">
                  <input type="submit" value="Go!" class="button" />
                </td>
              </tr>
            </table>
    </form>
EOT;
}

/**
 * Function called when the plugin is uninstalled
 * 
 * We will delete the plugin related config values from db
 */
function video2flash_ffmpeg_uninstall() {
    global $CONFIG, $video2flash_ffmpeg_configs;
    // Delete the video plugin related config values
    foreach ($video2flash_ffmpeg_configs as $name) {
        $f = cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE `name` = '$name'");
    }
    return true;
}

/**
 * This function is called after the file is successfully uploaded and added to db
 * This function will create the video thumb
 */
function video2flash_ffmpeg_add_file_data($pic_data) {
    global $CONFIG;
    $filepath = $pic_data['filepath'];
    $filename = $pic_data['filename'];
    $image = $CONFIG['fullpath'] . $filepath . $filename;
    if (is_movie($image)) {
        preg_match("/(.+)\.(.*?)\Z/", $filename, $matches);
        $thumb = $CONFIG['fullpath'] . $filepath . $CONFIG['thumb_pfx'] . $matches[1].".jpg";
        $normal = $CONFIG['fullpath'] . $filepath . $CONFIG['normal_pfx'] . $matches[1].".jpg";
        $flv = $CONFIG['fullpath'] . $filepath . $matches[1].".flv";
        $videoThumb = create_movie_thumb($image);
        $tmpFlv = convert_to_flv($image);
        // If we have the flv file
        if ($tmpFlv) {
            // move it to the final location
            rename($tmpFlv, $flv);
            // Add the fileszie of flv to total filesize
            $pic_data['total_filesize'] += filesize($flv);
        }
        $imagesize = getimagesize($videoThumb);
        if ($videoThumb) {
            if (!resize_image($videoThumb, $thumb, $CONFIG['thumb_width'], $CONFIG['thumb_method'], $CONFIG['thumb_use'])) {
                // If resize fails then we are not doing anything as the file is already uploaded and if no video thumb is created then nothing should be done.
            } else {
                // Also create a normal size image to show as a preview in flash player
                if (resize_image($videoThumb, $normal, $CONFIG['video2flash_ffmpeg_player_width'], $CONFIG['thumb_method'], $CONFIG['thumb_use'])) {
                    // Add the filesize of normal to the total filesize
                    $pic_data['total_filesize'] += filesize($normal);
                }
                $pic_data['pwidth'] = $imagesize[0];
                $pic_data['pheight'] = $imagesize[1];
                $pic_data['total_filesize'] += filesize($thumb);
            }
            @unlink($videoThumb);
        } else {
            // If video thumb is not created then proceed and don't stop here. We are not stopping as the file is already uploaded.
        }
    }

    return $pic_data;
}

/**
 * Function to delete thumb and flv of the video
 */
function video2flash_ffmpeg_delete_file($pic) {
    global $CONFIG;
    $file = $CONFIG['fullpath'] . $pic['filepath'] . $pic['filename'];
    preg_match("/(.+)\.(.*?)\Z/", $pic['filename'], $matches);
    $thumb = $CONFIG['fullpath'] . $pic['filepath'] . $CONFIG['thumb_pfx'] . $matches[1].".jpg";
    $normal = $CONFIG['fullpath'] . $pic['filepath'] . $CONFIG['normal_pfx'] . $matches[1].".jpg";
    $flv = $CONFIG['fullpath'] . $pic['filepath'] . $matches[1].".flv";
    
    @unlink($thumb);
    @unlink($normal);
    @unlink($flv);
}

/**
 * Function to return html required for displaying the flv palyer
 */
function video2flash_ffmpeg_file_data($pic_data) {
    global $CONFIG;

    $file = $CONFIG['fullpath'] . $pic_data['filepath'] . $pic_data['filename'];
    $picture_url = get_pic_url($pic_data, 'fullsize');

    preg_match("/(.+)\.(.*?)\Z/", $pic_data['filename'], $matches);
    $flv = $CONFIG['fullpath'] . $pic_data['filepath'] . $matches[1] . '.flv';

    // We will replace the file html only if it is a valid movie and we have the flv file
    if (is_movie($file) && file_exists($flv)) {
        $thumb = $CONFIG['fullpath'] . $pic_data['filepath'] . $CONFIG['thumb_pfx'] . $matches[1].".jpg";
        $flashvars = '';
        if (file_exists($thumb)) {
            $flashvars = '&image=' . $CONFIG['ecards_more_pic_target'] . $thumb;
        }
        if ($CONFIG['video2flash_ffmpeg_player_autostart'] == 'yes') {
            $flashvars = '&autostart=true';
        }
        $pic_data['html'] = <<<EOT
             <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="{$CONFIG['video2flash_ffmpeg_player_width']}" height="{$CONFIG['video2flash_ffmpeg_player_height']}">
                <param name="movie" value="plugins/video2flash_ffmpeg/player.swf?file={$CONFIG['ecards_more_pic_target']}{$flv}{$flashvars}" />
                <param name="quality" value="high" />
                <param name="wmode" value="transparent" />
                <embed src="plugins/video2flash_ffmpeg/player.swf?file={$CONFIG['ecards_more_pic_target']}{$flv}{$flashvars}" quality="high" wmode="transparent" width="{$CONFIG['video2flash_ffmpeg_player_width']}" height="{$CONFIG['video2flash_ffmpeg_player_height']}" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
            </object>
EOT;
    }
  //  print_r($pic_data);
    return $pic_data;
}

/**
 * Function to create video thumbnail using ffmpeg
 */
function create_movie_thumb($src_file) {
    global $CONFIG;

    $dest_file = $CONFIG['fullpath'] . "edit/" . md5(uniqid(time()))."%d.jpg";

    if (preg_match("#[A-Z]:|\\\\#Ai", __FILE__)) {
        // get the basedir, remove '/include'
        $cur_dir = substr(dirname(__FILE__), 0, -8);
        $src_file = '"' . $cur_dir . '\\' . strtr($src_file, '/', '\\') . '"';
        $ff_dest_file = '"' . $cur_dir . '\\' . strtr($dest_file, '/', '\\') . '"';
    } else {
        $src_file = escapeshellarg($src_file);
        $ff_dest_file = escapeshellarg($dest_file);
    }

    $output = array();

    if (eregi("win", $_ENV['OS'])) {
        // Command to create video thumb
        $cmd = "\"".str_replace("\\","/", $CONFIG['video2flash_ffmpeg_ffmpeg_path'])."\" -i ".str_replace("\\","/" ,$src_file )." -an -ss 00:00:{$CONFIG['video2flash_ffmpeg_thumb_interval']} -r 1 -vframes 1 -y ".str_replace("\\","/" ,$ff_dest_file);
        exec ("\"$cmd\"", $output, $retval);
    } else {
        // Command to create video thumb
        $cmd = "{$CONFIG['video2flash_ffmpeg_ffmpeg_path']} -i $src_file -an -ss 00:00:{$CONFIG['video2flash_ffmpeg_thumb_interval']} -r 1 -vframes 1 -y $ff_dest_file";
        exec ($cmd, $output, $retval);
    }


    if ($retval) {
        @unlink($dest_file);
        return false;
    }

    $return = str_replace("%d", "1", $dest_file);
    @chmod($return, octdec($CONFIG['default_file_mode'])); //silence the output in case chmod is disabled
    return $return;
}

/**
 * Function to convert video to flv using ffmpeg
 */
function convert_to_flv($src_file) {
    global $CONFIG;

    $dest_file = $CONFIG['fullpath'] . "edit/" . md5(uniqid(time())).".flv";

    if (preg_match("#[A-Z]:|\\\\#Ai", __FILE__)) {
        // get the basedir, remove '/include'
        $cur_dir = substr(dirname(__FILE__), 0, -8);
        $src_file = '"' . $cur_dir . '\\' . strtr($src_file, '/', '\\') . '"';
        $ff_dest_file = '"' . $cur_dir . '\\' . strtr($dest_file, '/', '\\') . '"';
    } else {
        $src_file = escapeshellarg($src_file);
        $ff_dest_file = escapeshellarg($dest_file);
    }

    $output = array();

    if (eregi("win", $_ENV['OS'])) {
        // Command to create video thumb
        $cmd = "\"".str_replace("\\","/", $CONFIG['video2flash_ffmpeg_ffmpeg_path'])."\" -y -i ".str_replace("\\","/" ,$src_file )." -acodec mp3 -ar 22050 -f flv ".str_replace("\\","/" ,$ff_dest_file);
        exec ("\"$cmd\"", $output, $retval);
    } else {
        // Command to create video thumb
        $cmd = "{$CONFIG['video2flash_ffmpeg_ffmpeg_path']} -y -i $src_file -acodec mp3 -ar 22050 -f flv $ff_dest_file";
        exec ($cmd, $output, $retval);
    }


    if ($retval) {
        @unlink($dest_file);
        return false;
    }

    $return = $dest_file;
    @chmod($return, octdec($CONFIG['default_file_mode'])); //silence the output in case chmod is disabled
    return $return;
}
?>
