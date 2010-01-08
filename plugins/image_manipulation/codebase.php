<?php
/**************************************************
  Coppermine 1.5.x Plugin - Image manipulation
  *************************************************
  Copyright (c) 2010 Timo Schewe (www.timos-welt.de)
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

  
if (!defined('IN_COPPERMINE')) {
	die('Not in Coppermine...');
}

// Add js files
$thisplugin->add_action('page_start','include_js_maniplug');

// Add plugin_install action
$thisplugin->add_action('plugin_install','im_install');

// Add plugin_uninstall action
$thisplugin->add_action('plugin_uninstall','im_uninstall');


function include_js_maniplug() 
{
    global $JS, $CONFIG, $lang_plugin_image_manipulation, $CPG_PHP_SELF;
    require('./plugins/image_manipulation/init.inc.php');

	$im_pages_array = array('displayimage.php');
	if (in_array($CPG_PHP_SELF, $im_pages_array) == TRUE)
    {  
        set_js_var('im_strlightness', $lang_plugin_image_manipulation['brightness']);
        set_js_var('im_strreset', $lang_plugin_image_manipulation['reset']);
        set_js_var('im_strbw', $lang_plugin_image_manipulation['black_and_white']);
        set_js_var('im_strsepia', $lang_plugin_image_manipulation['sepia']);
        set_js_var('im_strflipv', $lang_plugin_image_manipulation['flip_vertically']);
        set_js_var('im_strfliph', $lang_plugin_image_manipulation['flip_horizontally']);
        set_js_var('im_strinvert', $lang_plugin_image_manipulation['invert']);
        set_js_var('im_stremboss', $lang_plugin_image_manipulation['emboss']);
        set_js_var('im_strblur', $lang_plugin_image_manipulation['blur']);
        set_js_var('im_strcontrast', $lang_plugin_image_manipulation['contrast']);
        set_js_var('im_strsatur', $lang_plugin_image_manipulation['saturation']);
        set_js_var('im_strsharpen', $lang_plugin_image_manipulation['sharpness']);
        set_js_var('im_useurlvalues', $CONFIG['plugin_image_manipulation_urlvalues']);
        set_js_var('im_usecookies', $CONFIG['plugin_image_manipulation_cookies']);
		set_js_var('im_icon_reset', $image_manipulation_icon_array['reset']);
		set_js_var('im_icon_sepia', $image_manipulation_icon_array['sepia']);
		set_js_var('im_icon_fliph', $image_manipulation_icon_array['flip_horizontally']);
		set_js_var('im_icon_flipv', $image_manipulation_icon_array['flip_vertically']);
		set_js_var('im_icon_invert', $image_manipulation_icon_array['invert']);
		set_js_var('im_icon_bw', $image_manipulation_icon_array['black_and_white']);
		set_js_var('im_icon_emboss', $image_manipulation_icon_array['emboss']);
		set_js_var('im_icon_blur', $image_manipulation_icon_array['blur']);

        if ($CONFIG['plugin_image_manipulation_compatible'] == '1')
        {
        	$JS['includes'][] = "./plugins/image_manipulation/js/pixastic_compatible.js";
        }
        else
        {
        	$JS['includes'][] = "./plugins/image_manipulation/js/pixastic.js";
        }
        
        $JS['includes'][] = "./plugins/image_manipulation/js/image_manipulation.js";
    }
}


// install
function im_install() {
    global $CONFIG;
	// Add the config options for the plugin
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_image_manipulation_compatible', '1')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_image_manipulation_cookies', '1')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_image_manipulation_urlvalues', '1')");
	// The pre-install status of the transparent overlay setting is being stored inside another field and get's restored on uninstall
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_image_manipulation_overlay', {$CONFIG['transparent_overlay']})");
	// This plugin only works if image_overlay is off, so let's turn it off if it's on
	if ($CONFIG['transparent_overlay'] != '0') {
		$CONFIG['transparent_overlay'] = 0;
		cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value='0' WHERE name='transparent_overlay'");
	}
    return true;
}


// uninstall and drop settings table
function im_uninstall() {
    global $CONFIG;
    // Restore the state of the transparent overlay if needed
	if ($CONFIG['plugin_image_manipulation_overlay'] != '0') {
		cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value={$CONFIG['plugin_image_manipulation_overlay']} WHERE name='transparent_overlay'");
	}
	// Delete the plugin config records
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_image_manipulation_compatible'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_image_manipulation_cookies'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_image_manipulation_urlvalues'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_image_manipulation_overlay'");
    return true;
}


?>