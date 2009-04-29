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
$thisplugin->add_filter('page_html','thumb_rotate_main');

function thumb_rotate_main($html) 
{
  global $CONFIG;

  // build search string $expression depending on thumb_use setting
  switch ($CONFIG['thumb_use'])
  {
    case "wd":
      $expression = "#href=\"displayimage.php\?(.*)\">\s*<img\s*src=\"(.*?)\"\s*class=\"(.*)\"\s*width=\"(.*?)\"#i";
      break;
    case "ht":
      $expression = "#href=\"displayimage.php\?(.*)\">\s*<img\s*src=\"(.*?)\"\s*class=\"(.*)\"\s*height=\"(.*?)\"#i";
      break;
    default:
      $expression = "#href=\"displayimage.php\?(.*)\">\s*<img\s*src=\"(.*?)\"\s*class=\"(.*)\"\s*width=\"(.*)\"\s*height=\"(.*?)\"#i";
  }

  preg_match_all($expression, $html, $hit, PREG_SET_ORDER);

  $lastdegree = -1;    
  
  // get match for each thumb
  foreach($hit as $match) 
  {
      // degree of rotation is random at start, but later we want to have one left, one right
      if ($lastdegree == -1)
      {
        $degrees = rand(0,$CONFIG['plugin_thumb_rotate_maxrotation']*2);
        if ($degrees > $CONFIG['plugin_thumb_rotate_maxrotation']) $degrees = $degrees + 359 - $CONFIG['plugin_thumb_rotate_maxrotation']*2;
      }
      else if ($lastdegree < $CONFIG['plugin_thumb_rotate_maxrotation'])
      {
        $degrees = rand(1,$CONFIG['plugin_thumb_rotate_maxrotation']) + 360 - $CONFIG['plugin_thumb_rotate_maxrotation'];
      }
      else
      {
        $degrees = rand(1,$CONFIG['plugin_thumb_rotate_maxrotation']);
      }
      $lastdegree = $degrees;

      // build replacement string for thumb
      // first check if thumb is already in cache; if yes, use this one
      $source_image = str_replace('/','_',$match[2]).ltrim($CONFIG['plugin_thumb_rotate_bgcolor'], '#').ltrim($CONFIG['plugin_thumb_rotate_bordercolor'], '#').$CONFIG['plugin_thumb_rotate_borderwidth'].'.png';
      if (file_exists($CONFIG['fullpath'] . 'edit/thumb_rotate_cache/' . $source_image))
      {
        $replacestring = "href=\"displayimage.php?".$match[1]."\"><img src=\"".$CONFIG['fullpath'] . 'edit/thumb_rotate_cache/'.$source_image."\" class=\"".$match[3]."\" style=\"border:none;\"";
      }
      else
      {
        $replacestring = "href=\"displayimage.php?".$match[1]."\"><img src=\"plugins/thumb_rotate/thumb_rotate.php?img=".$match[2]."&amp;deg=".$degrees."&amp;bg=".ltrim($CONFIG['plugin_thumb_rotate_bgcolor'], '#')."&amp;brd=".$CONFIG['plugin_thumb_rotate_borderwidth']."&amp;path=".rtrim($CONFIG['fullpath'], '/')."&amp;brdcol=".ltrim($CONFIG['plugin_thumb_rotate_bordercolor'], '#')."\" class=\"".$match[3]."\" style=\"border:none;\"";
      }
      $html = str_replace($match[0],$replacestring,$html);
  }
  return $html;
}

function thumb_rotate_install() {
    global $CONFIG, $thumb_rotate_installation, $thisplugin;
	// Create the super cage
	$superCage = Inspekt::makeSuperCage();
	// Create the cache folder
    is_dir(dirname($CONFIG['fullpath'] . 'edit/thumb_rotate_cache/')) || mkdir_recursive(dirname($CONFIG['fullpath'] . 'edit/thumb_rotate_cache/'), $CONFIG['default_dir_mode']);
    $result = is_dir($CONFIG['fullpath'] . 'edit/thumb_rotate_cache/') || @mkdir($CONFIG['fullpath'] . 'edit/thumb_rotate_cache/', $CONFIG['default_dir_mode']);

	$thumb_rotate_installation = 1;
	require 'include/sql_parse.php';
	$CONFIG['plugin_thumb_rotate_maxrotation'] = 15;
	$CONFIG['plugin_thumb_rotate_bgcolor'] = '#EFEFEF';
	$CONFIG['plugin_thumb_rotate_borderwidth'] = 10;
	$CONFIG['plugin_thumb_rotate_bordercolor'] = '#FFFFFF';
	$CONFIG['plugin_thumb_rotate_delete_cache'] = '1';
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
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_thumb_rotate_delete_cache'");
	
	return true;
}

function thumb_rotate_empty_cache($action = 'delete'){
	global $CONFIG;
	$dir = opendir($CONFIG['fullpath'] . 'edit/thumb_rotate_cache/');
	$loopCounter = 0;
	while ($file = readdir($dir)) {
	    if ($file != "." && $file != "..") {
	    	if ($action == 'delete') {
	    		cpg_folder_file_delete($CONFIG['fullpath'] . 'edit/thumb_rotate_cache/'.$file);
	    	}
	    	$loopCounter++;
	    }
	}
	return $loopCounter;
}

// Configure function: displays the configuration form
function thumb_rotate_configure() {
    global $CONFIG, $thisplugin, $lang_plugin_thumb_rotate, $lang_common, $thumb_rotate_icon_array, $thumb_rotate_installation;
    $superCage = Inspekt::makeSuperCage();
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
    
    // delete cache
	if ($superCage->post->getInt('plugin_thumb_rotate_delete_cache') == 1 ) {
		if ($CONFIG['plugin_thumb_rotate_delete_cache'] == 0) {
			$config_changes_counter++;
		}
		$CONFIG['plugin_thumb_rotate_delete_cache'] = 1;
	} else {
		if ($CONFIG['plugin_thumb_rotate_delete_cache'] == 1) {
			$config_changes_counter++;
		}
		$CONFIG['plugin_thumb_rotate_delete_cache'] = 0;
	}
	$query = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_thumb_rotate_delete_cache']}' WHERE name='plugin_thumb_rotate_delete_cache'";
	cpg_db_query($query);
	if ($CONFIG['plugin_thumb_rotate_delete_cache'] == 1) {
		$option_output['plugin_thumb_rotate_delete_cache'] = 'checked="checked"';
	}
    
    if ($superCage->post->keyExists('submit') == TRUE) {
    	if ($config_changes_counter > 0) {
    		$additional_submit_information = '<div class="cpg_message_success">' . $lang_plugin_thumb_rotate['changes_saved'] . '</div>';
    		if ($CONFIG['plugin_thumb_rotate_delete_cache'] == 1) {
    			// a config change has been submit, so let's delete the cache
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
		// Check cache folder
		$random_file = 'testfile'.time().'.txt';
		$handle = fopen ($CONFIG['fullpath'] . 'edit/thumb_rotate_cache/'.$random_file, 'w');
		fclose($handle);
		if (file_exists($CONFIG['fullpath'] . 'edit/thumb_rotate_cache/'.$random_file)) {
			$install_section .= '<div class="cpg_message_success">' . sprintf($lang_plugin_thumb_rotate['cache_write_access_ok'], '<a href="'.rtrim($CONFIG['site_url'], '/') . '/' . $CONFIG['fullpath'] . 'edit/thumb_rotate_cache/"><tt>'.rtrim($CONFIG['site_url'], '/') . '/' . $CONFIG['fullpath'] . 'edit/thumb_rotate_cache/</tt></a>') . '</div>';
			$cache_ok = 1;
		} else {
			$install_section .= '<div class="cpg_message_validation">' . sprintf($lang_plugin_thumb_rotate['cache_write_access_failed'], '<a href="'.rtrim($CONFIG['site_url'], '/') . '/' . $CONFIG['fullpath'] . 'edit/thumb_rotate_cache/"><tt>'.rtrim($CONFIG['site_url'], '/') . '/' . $CONFIG['fullpath'] . 'edit/thumb_rotate_cache/</tt></a>') . '</div>';
			$cache_ok = 0;
		}
		cpg_folder_file_delete($CONFIG['fullpath'] . 'edit/thumb_rotate_cache/'.$random_file);
		if ($gd_ok == 1 && $php_ok == 1 && $cache_ok == 1) {
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
	} else {
		// No actual install, but "regular" config screen
		$number_of_files = sprintf($lang_plugin_thumb_rotate['files'], thumb_rotate_empty_cache('count')); 
		$install_section = <<< EOT
                    <tr>
                        <td valign="top" class="tableb">
                        	{$lang_plugin_thumb_rotate['empty_cache']}
                        </td>
                        <td valign="top" class="tableb" colspan="2">
                        	<input type="checkbox" name="plugin_thumb_rotate_delete_cache" id="plugin_thumb_rotate_delete_cache" class="checkbox" value="1" {$option_output['plugin_thumb_rotate_delete_cache']} />
                        	<label for="plugin_thumb_rotate_delete_cache" class="clickable_option">{$number_of_files}</label>
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
                        	<input type="text" name="plugin_thumb_rotate_bgcolor" id="plugin_thumb_rotate_bgcolor" class="textinput" size="7" maxlength="7" value="{$CONFIG['plugin_thumb_rotate_bgcolor']}" />
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
                        	<input type="text" name="plugin_thumb_rotate_bordercolor" id="plugin_thumb_rotate_bordercolor" class="textinput" size="7" maxlength="7" value="{$CONFIG['plugin_thumb_rotate_bordercolor']}" />
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
?>