<?php
/**************************************************
  Coppermine 1.5.x Plugin - Thumb Rotate $VERSION$=0.2
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
      $source_image = str_replace('/','_',$match[2]).$CONFIG['plugin_thumb_rotate_bgcolor'].$CONFIG['plugin_thumb_rotate_bordercolor'].$CONFIG['plugin_thumb_rotate_borderwidth'].'.png';
      if (file_exists('plugins/thumb_rotate/thumb_cache/'.$source_image))
      {
        $replacestring = "href=\"displayimage.php?".$match[1]."\"><img src=\"plugins/thumb_rotate/thumb_cache/".$source_image."\" class=\"".$match[3]."\" style=\"border:none;\"";
      }
      else
      {
        $replacestring = "href=\"displayimage.php?".$match[1]."\"><img src=\"plugins/thumb_rotate/thumb_rotate.php?img=".$match[2]."&amp;deg=".$degrees."&bg=".$CONFIG['plugin_thumb_rotate_bgcolor']."&brd=".$CONFIG['plugin_thumb_rotate_borderwidth']."&brdcol=".$CONFIG['plugin_thumb_rotate_bordercolor']."\" class=\"".$match[3]."\" style=\"border:none;\"";
      }
      $html = str_replace($match[0],$replacestring,$html);
  }
  return $html;
}

// install
function thumb_rotate_install() {
    global $CONFIG, $thumb_rotate_installation, $thisplugin;
	// Create the super cage
	$superCage = Inspekt::makeSuperCage();
	$thumb_rotate_installation = 1;
	require 'include/sql_parse.php';
	$CONFIG['plugin_thumb_rotate_maxrotation'] = 15;
	$CONFIG['plugin_thumb_rotate_bgcolor'] = 'EFEFEF';
	$CONFIG['plugin_thumb_rotate_borderwidth'] = 10;
	$CONFIG['plugin_thumb_rotate_bordercolor'] = 'FFFFFF';
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

// uninstall
function thumb_rotate_uninstall(){
        global $CONFIG;
        $superCage = Inspekt::makeSuperCage();
        // Drop the database records
        cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_thumb_rotate_maxrotation'");
        cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_thumb_rotate_bgcolor'");
        cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_thumb_rotate_borderwidth'");
        cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_thumb_rotate_bordercolor'");
        // Empty the file cache
		foreach(glob('plugins/thumb_rotate/thumb_cache/*.*') as $v){
		    unlink($v);
		}
        return true;
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
			$temp = ltrim($temp, '#');
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
			$temp = ltrim($temp, '#');
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
    		$additional_submit_information = $lang_plugin_thumb_rotate['changes_saved'];
    	} else {
    		$additional_submit_information = $lang_plugin_thumb_rotate['no_changes'];
    	}
    }



	// Create the table row that is displayed during initial install
	if ($thumb_rotate_installation == 1) {
		$additional_submit_information = $lang_plugin_thumb_rotate['submit_to_install'];
		$install_section = <<< EOT
                    <tr>
                        <td valign="top" class="tableb">
                        	{$lang_plugin_thumb_rotate['minimum_requirements']}
                        </td>
                        <td valign="top" class="tableb">
EOT;
		if (version_compare(PHP_VERSION, '4.3.2', '>')) {
			$install_section .= '<div class="cpg_message_success">' . sprintf($lang_plugin_thumb_rotate['minimum_requirements_ok'], 'PHP', '<strong>'.PHP_VERSION.'</strong>') . '</div>';
			$php_ok = 1;
		} else {
			$install_section .= '<div class="cpg_message_error">' . sprintf($lang_plugin_thumb_rotate['minimum_requirements_low'], 'PHP', PHP_VERSION) . '</div>';
			$php_ok = 0;
		}
		if (function_exists('gd_info') == true) {
            $gd_array = gd_info();
            if (array_key_exists('GD Version' , $gd_array) == TRUE) {
             	if (version_compare(substr($gd_array['GD Version'], 0, strpos($gd_array['GD Version'], ' ')), '2') >= 0) {
             		$install_section .= '<div class="cpg_message_success">' . sprintf($lang_plugin_thumb_rotate['minimum_requirements_ok'], 'GD', '<strong>'.$gd_array['GD Version'].'</strong>') . '</div>';
             		$gd_ok = 1;
             	} else {
             		$install_section .= '<div class="cpg_message_error">' . sprintf($lang_plugin_thumb_rotate['minimum_requirements_low'], 'GD', $gd_array['GD Version']) . '</div>';
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
		if ($gd_ok == 1 && $php_ok == 1) {
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
            <form action="{$_SERVER['REQUEST_URI']}" method="post" name="thumb_rotate_config" id="thumb_rotate_config">
EOT;

    starttable('100%', $thumb_rotate_icon_array['config'] . $lang_plugin_thumb_rotate['config'], 2);
    echo <<< EOT
                    <tr>
                        <td valign="top" class="tableb" width="50%">
                            {$lang_plugin_thumb_rotate['option_maxrotation']}
                        </td>
                        <td valign="top" class="tableb" width="50%">
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
                        	#<input type="text" name="plugin_thumb_rotate_bgcolor" id="plugin_thumb_rotate_bgcolor" class="textinput" size="6" maxlength="6" value="{$CONFIG['plugin_thumb_rotate_bgcolor']}" />
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" class="tableb">
                            {$lang_plugin_thumb_rotate['option_borderwidth']}
                        </td>
                        <td valign="top" class="tableb">
                        	<input type="text" name="plugin_thumb_rotate_borderwidth" id="plugin_thumb_rotate_borderwidth" class="textinput" size="2" maxlength="2" value="{$CONFIG['plugin_thumb_rotate_borderwidth']}" /> ({$lang_plugin_thumb_rotate['in_pixels']})
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" class="tableb tableb_alternate">
                            {$lang_plugin_thumb_rotate['option_bordercolor']}
                        </td>
                        <td valign="top" class="tableb tableb_alternate">
                        	#<input type="text" name="plugin_thumb_rotate_bordercolor" id="plugin_thumb_rotate_bordercolor" class="textinput" size="6" maxlength="6" value="{$CONFIG['plugin_thumb_rotate_bordercolor']}" />
                        </td>
                    </tr>
                    {$install_section}
                    <tr>
                        <td valign="top" class="tablef">
                        </td>
                        <td valign="top" class="tablef">
                            <button type="submit" class="button" name="submit" value="{$lang_common['ok']}">{$thumb_rotate_icon_array['ok']}{$lang_common['ok']}</button> {$additional_submit_information}
                        </td>
                    </tr>
EOT;
    endtable();
    echo <<< EOT
            </form>

EOT;
}
?>