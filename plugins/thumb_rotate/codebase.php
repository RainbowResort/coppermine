<?php
/**************************************************
  Coppermine 1.5.x Plugin - Thumb Rotate $VERSION$=0.4
  *************************************************
  Copyright (c) 2009 Timos-Welt (www.timos-welt.de)
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
$thisplugin->add_action('plugin_configure','thumb_rotate_configure');
$thisplugin->add_filter('theme_display_thumbnails_params','thumb_rotate_thumb_display');

function thumb_rotate_thumb_display($params) {
    global $CONFIG;
    // Create the super cage	$superCage = Inspekt::makeSuperCage();
    // Extract the needed information from the thumbnail params array
    $link_target_array = parse_url(str_replace('&amp;', '&', $params['{LINK_TGT}']));
    parse_str($link_target_array['query'], $link_target_param_array);
    unset($link_target_array);
    $pid = $link_target_param_array['pid'];
    $pos = $link_target_param_array['pos'];
    $album = $link_target_param_array['album'];
    //unset($link_target_param_array);
    if (!$album) {
    	// Try to extract the album from the URL param
    	if ($superCage->get->keyExists('album') == TRUE) {
    		$album = $superCage->get->getAlnum('album');
    	}
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
    if ($rotate_image_create_file == 1) {
    	$created_image_path = thumb_rotate_image_create($CURRENT_PIC_DATA);
    	// todo: perform some more checks on the file type first before actually trying to create a rotated thumb
    }
    if ($rotate_image_create_dbrecord == 1) {
    	$result = cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_PREFIX']}plugin_thumb_rotate ( `pid` , `filepath` ) VALUES ('{$pid}', '{$created_image_path}');");
    }
    
    // Finally, let's manipulate the thumbnail HTML
    if (file_exists($CONFIG['fullpath'] . $CURRENT_PIC_DATA['filepath'] . $CONFIG['plugin_thumb_rotate_thumb_pfx'] . $CURRENT_PIC_DATA['filename_without_extension'] . '.png')){
    	$params['{THUMB}'] = str_replace($CURRENT_PIC_DATA['filepath'] . $CONFIG['thumb_pfx'] . $CURRENT_PIC_DATA['filename'], $CURRENT_PIC_DATA['filepath'] . $CONFIG['plugin_thumb_rotate_thumb_pfx'] . $CURRENT_PIC_DATA['filename_without_extension'] . '.png', $params['{THUMB}']);
    } 
    return $params;
}

function thumb_rotate_install() {
    global $CONFIG, $thumb_rotate_installation, $thisplugin;
	// Create the super cage
	$superCage = Inspekt::makeSuperCage();
	$thumb_rotate_installation = 1;
	require 'include/sql_parse.php';
	$CONFIG['plugin_thumb_rotate_maxrotation'] = 15;
	$CONFIG['plugin_thumb_rotate_bgcolor'] = '#EFEFEF';
	$CONFIG['plugin_thumb_rotate_borderwidth'] = 10;
	$CONFIG['plugin_thumb_rotate_bordercolor'] = '#FFFFFF';
	$CONFIG['plugin_thumb_rotate_thumb_pfx'] = 'rotate_';
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
	thumb_rotate_empty_cache();
	// Drop the database records
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_thumb_rotate_maxrotation'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_thumb_rotate_bgcolor'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_thumb_rotate_borderwidth'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_thumb_rotate_bordercolor'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_thumb_rotate_thumb_pfx'");
	cpg_db_query("DROP TABLE IF EXISTS {$CONFIG['TABLE_PREFIX']}plugin_thumb_rotate");
	
	return true;
}

function thumb_rotate_empty_cache($action = 'delete'){
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
    global $CONFIG, $thisplugin, $lang_plugin_thumb_rotate, $lang_common, $thumb_rotate_icon_array, $lang_errors, $thumb_rotate_installation;
    $superCage = Inspekt::makeSuperCage();
    if (!GALLERY_ADMIN_MODE) {
    	cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
    }
    // Populate the form fields and run the queries for the submit form
    $config_changes_counter = 0;
    // maxrotation
    if ($superCage->post->keyExists('plugin_thumb_rotate_maxrotation') == TRUE) {
        if ($superCage->post->getInt('plugin_thumb_rotate_maxrotation') >= 0 && $superCage->post->getInt('plugin_thumb_rotate_maxrotation') <= 20 && $CONFIG['plugin_thumb_rotate_maxrotation'] != $superCage->post->getInt('plugin_thumb_rotate_maxrotation')) {
            $CONFIG['plugin_thumb_rotate_maxrotation'] = $superCage->post->getInt('plugin_thumb_rotate_maxrotation');
            $query = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_thumb_rotate_maxrotation']}' WHERE name='plugin_thumb_rotate_maxrotation'";
            cpg_db_query($query);
            $config_changes_counter++;
        }
    }
    $option_output['plugin_thumb_rotate_maxrotation'] = '';
    for ($i = 0; $i <= 20; $i++) {
    	$option_output['plugin_thumb_rotate_maxrotation'] .= '                            	<option value="' . $i . '"';
    	if (trim($CONFIG['plugin_thumb_rotate_maxrotation']) == trim($i)) {
    		$option_output['plugin_thumb_rotate_maxrotation'] .= ' selected="selected"';
    	}
    	$option_output['plugin_thumb_rotate_maxrotation'] .= '>' . $i . '</option>'."\r\n";
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
	        }
        }
    }
    
    if ($superCage->post->keyExists('submit') == TRUE) {
    	if ($config_changes_counter > 0) {
    		$additional_submit_information = '<div class="cpg_message_success">' . $lang_plugin_thumb_rotate['changes_saved'] . '</div>';
			// a config change has been submit, so let's delete the cache
			thumb_rotate_empty_cache();
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
                        <td valign="top" class="tableb" colspan="2">
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
					if (!function_exists('imagerotate')) {
						$install_section .= '<div class="cpg_message_validation">' . $lang_plugin_thumb_rotate['minimum_requirements_imagerotate'] . '</div>';
						$imagerotate_missing = 1;
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

		if ($gd_ok == 1 && $php_ok == 1 && $imagerotate_missing != 1) {
			$install_section .= <<< EOT
				<input type="hidden" name="thumb_rotate_continue_anyway" id="thumb_rotate_continue_anyway" value="1" />
EOT;
		} else {
			$install_section .= <<< EOT
				<input type="checkbox" name="thumb_rotate_continue_anyway" id="thumb_rotate_continue_anyway" class="checkbox" value="1" />
				{$lang_plugin_thumb_rotate['continue_anyway']}?
EOT;
		}
		$install_section .= <<< EOT
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
				});
    		</script>
            <form action="{$_SERVER['REQUEST_URI']}" method="post" name="thumb_rotate_config" id="thumb_rotate_config">
EOT;

    starttable('100%', $thumb_rotate_icon_array['config'] . $lang_plugin_thumb_rotate['config'], 3);
    echo <<< EOT
                    <tr>
                        <td valign="top" class="tableb">
                            {$lang_plugin_thumb_rotate['option_maxrotation']}
                        </td>
                        <td valign="top" class="tableb" colspan="2">
                        	<select name="plugin_thumb_rotate_maxrotation" id="plugin_thumb_rotate_maxrotation" size="1" class="listbox">
{$option_output['plugin_thumb_rotate_maxrotation']}
                        	</select> &deg;
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" class="tableb tableb_alternate">
                            {$lang_plugin_thumb_rotate['option_bgcolor']}
                        </td>
                        <td valign="top" class="tableb tableb_alternate">
                        	<input type="text" name="plugin_thumb_rotate_bgcolor" id="plugin_thumb_rotate_bgcolor" class="textinput" size="7" maxlength="7" value="{$CONFIG['plugin_thumb_rotate_bgcolor']}" style="text-transform:uppercase;" />
                        </td>
                        <td valign="top" class="tableb tableb_alternate">
                        	<div id="colorpicker_bgcolor"></div>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" class="tableb">
                            {$lang_plugin_thumb_rotate['option_borderwidth']}
                        </td>
                        <td valign="top" class="tableb" colspan="2">
                        	<input type="text" name="plugin_thumb_rotate_borderwidth" id="plugin_thumb_rotate_borderwidth" class="textinput" size="2" maxlength="2" value="{$CONFIG['plugin_thumb_rotate_borderwidth']}" /> ({$lang_plugin_thumb_rotate['in_pixels']})
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" class="tableb tableb_alternate">
                            {$lang_plugin_thumb_rotate['option_bordercolor']}
                        </td>
                        <td valign="top" class="tableb tableb_alternate">
                        	<input type="text" name="plugin_thumb_rotate_bordercolor" id="plugin_thumb_rotate_bordercolor" class="textinput" size="7" maxlength="7" value="{$CONFIG['plugin_thumb_rotate_bordercolor']}" style="text-transform:uppercase;" />
                        </td>
                        <td valign="top" class="tableb tableb_alternate">
                        	<div id="colorpicker_bordercolor"></div>
                        </td>
                    </tr>
                    {$install_section}
                    <tr>
                        <td valign="middle" class="tablef">
                        	
                        </td>
                        <td valign="middle" class="tablef" colspan="2">
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
	function imagerotate($src_img, $angle, $bgcolor) {
	    global $CONFIG;
	    // convert degrees to radians
	    $angle = $angle + 180;
	    $angle = deg2rad($angle);
	  
	    $src_x = imagesx($src_img);
	    $src_y = imagesy($src_img);
	  
	    $center_x = floor($src_x/2);
	    $center_y = floor($src_y/2);
	  
	    $rotate = imagecreatetruecolor($src_x, $src_y);
	    imagealphablending($rotate, false);
	    imagesavealpha($rotate, true);
	
	    $cosangle = cos($angle);
	    $sinangle = sin($angle);
	  
	    for ($y = 0; $y < $src_y; $y++) {
	      for ($x = 0; $x < $src_x; $x++) {
	    // rotate...
	    $old_x = (($center_x-$x) * $cosangle + ($center_y-$y) * $sinangle)
	      + $center_x;
	    $old_y = (($center_y-$y) * $cosangle - ($center_x-$x) * $sinangle)
	      + $center_y;
	  
	    if ( $old_x >= 0 && $old_x < $src_x
	         && $old_y >= 0 && $old_y < $src_y ) {
	      if ($bicubic == true) {
	        $sY  = $old_y + 1;
	        $siY  = $old_y;
	        $siY2 = $old_y - 1;
	        $sX  = $old_x + 1;
	        $siX  = $old_x;
	        $siX2 = $old_x - 1;
	      
	        $c1 = imagecolorsforindex($src_img, imagecolorat($src_img, $siX, $siY2));
	        $c2 = imagecolorsforindex($src_img, imagecolorat($src_img, $siX, $siY));
	        $c3 = imagecolorsforindex($src_img, imagecolorat($src_img, $siX2, $siY2));
	        $c4 = imagecolorsforindex($src_img, imagecolorat($src_img, $siX2, $siY));
	      
	        $r = ($c1['red']  + $c2['red']  + $c3['red']  + $c4['red']  ) << 14;
	        $g = ($c1['green'] + $c2['green'] + $c3['green'] + $c4['green']) << 6;
	        $b = ($c1['blue']  + $c2['blue']  + $c3['blue']  + $c4['blue'] ) >> 2;
	        $a = ($c1['alpha']  + $c2['alpha']  + $c3['alpha']  + $c4['alpha'] ) >> 2;
	        $color = imagecolorallocatealpha($src_img, $r,$g,$b,$a);
	      } else {
	        $color = imagecolorat($src_img, $old_x, $old_y);
	      }
	    } else {
	          // this line sets the background colour
	      $bgcolor_array = thumb_rotate_html2rgb($bgcolor);
	      $color = imagecolorallocatealpha($src_img, $bgcolor_array[0], $bgcolor_array[1], $bgcolor_array[2]);
	    }
	    imagesetpixel($rotate, $x, $y, $color);
	      }
	    }
	    return $rotate;
	}
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
	global $CONFIG;
	$bg_array = thumb_rotate_html2rgb($CONFIG['plugin_thumb_rotate_bgcolor']);// split background color
	$bc_array = thumb_rotate_html2rgb($CONFIG['plugin_thumb_rotate_bordercolor']);// split background color
	
	// create source image from existing thumb file
	$image = $CONFIG['fullpath'] . $CURRENT_PIC_DATA['filepath'] . $CONFIG['thumb_pfx'] . $CURRENT_PIC_DATA['filename'];
	if (substr($image,-4) == '.png'){
	  $source = imagecreatefrompng($image);
	} elseif(substr($image,-4) == '.gif') {
	} else {
	  $source = imagecreatefromjpeg($image);
	}
	
	// get width / height of source image
	$sourcex = imagesx($source);
	$sourcey = imagesy($source);
	
	// create destination image 6px bigger than source+brd*2 to make anti aliasing work
	$finalimg = imagecreatetruecolor($sourcex+$CONFIG['plugin_thumb_rotate_borderwidth']*2+6,$sourcey+$CONFIG['plugin_thumb_rotate_borderwidth']*2+6);
	
	// make image transparent
	//imagealphablending($finalimg,true);
	$fin_bg = imagecolorallocate($finalimg, $bg_array[0], $bg_array[1], $bg_array[2]);
	imagefilledrectangle($finalimg,0,0,$sourcex+$CONFIG['plugin_thumb_rotate_borderwidth']*2+6,$sourcey+$CONFIG['plugin_thumb_rotate_borderwidth']*2+6,$fin_bg);
	
	// create border
	if ($CONFIG['plugin_thumb_rotate_borderwidth']) {
	  $bordercolor = imagecolorallocate($finalimg, $bc_array[0], $bc_array[1], $bc_array[2]);
	  imagefilledrectangle($finalimg,3,3,$sourcex+$CONFIG['plugin_thumb_rotate_borderwidth']*2+3,$sourcey+$CONFIG['plugin_thumb_rotate_borderwidth']*2+3,$bordercolor);
	}
	
	// copy source into finalimg
	imagecopy($finalimg,$source,$CONFIG['plugin_thumb_rotate_borderwidth']+3,$CONFIG['plugin_thumb_rotate_borderwidth']+3,0,0,$sourcex,$sourcey);
	
	// Determine the level of rotation

    $degrees = rand(0,$CONFIG['plugin_thumb_rotate_maxrotation']*2);
    if ($degrees > $CONFIG['plugin_thumb_rotate_maxrotation']) {
    	$degrees = $degrees + 359 - $CONFIG['plugin_thumb_rotate_maxrotation']*2;
    }
	
	// rotate image
	$rotate = imagerotate($finalimg, $degrees, $fin_bg);
	

	// set transparency
	imagecolortransparent($rotate, $fin_bg);
	
	// deliver png and save to cache
	$result = imagepng($rotate, $CONFIG['fullpath'] . $CURRENT_PIC_DATA['filepath'] . $CONFIG['plugin_thumb_rotate_thumb_pfx'] . $CURRENT_PIC_DATA['filename_without_extension'] . '.png');
	if ($result) {
		$return = $CURRENT_PIC_DATA['filepath'] . $CONFIG['plugin_thumb_rotate_thumb_pfx'] . $CURRENT_PIC_DATA['filename_without_extension'] . '.png';
	} else {
		$return = '';
	}
	
	// clean up
	imagedestroy($rotate);
	imagedestroy($source);
	imagedestroy($finalimg);
	return $return;
}
?>