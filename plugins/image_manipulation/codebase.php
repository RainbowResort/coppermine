<?php
/**************************************************
  Coppermine 1.5.x Plugin - Image manipulation
  *************************************************
  Copyright (c) 2009 Timos-Welt (www.timos-welt.de)
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

// Add js files
$thisplugin->add_action('page_start','include_js_maniplug');

// Add plugin_install action
$thisplugin->add_action('plugin_install','im_install');

// Add plugin_uninstall action
$thisplugin->add_action('plugin_uninstall','im_uninstall');


function include_js_maniplug() 
{
    global $JS, $CONFIG, $lang_plugin_im, $CPG_PHP_SELF;
    require('./plugins/image_manipulation/init.inc.php');

	$im_pages_array = array('displayimage.php');
	if (in_array($CPG_PHP_SELF, $im_pages_array) == TRUE)
    {  
        set_js_var('im_strlightness', $lang_plugin_im['im_strlightness']);
        set_js_var('im_strreset', $lang_plugin_im['im_strreset']);
        set_js_var('im_strbw', $lang_plugin_im['im_strbw']);
        set_js_var('im_strsepia', $lang_plugin_im['im_strsepia']);
        set_js_var('im_strflipv', $lang_plugin_im['im_strflipv']);
        set_js_var('im_strfliph', $lang_plugin_im['im_strfliph']);
        set_js_var('im_strinvert', $lang_plugin_im['im_strinvert']);
        set_js_var('im_stremboss', $lang_plugin_im['im_stremboss']);
        set_js_var('im_strblur', $lang_plugin_im['im_strblur']);
        set_js_var('im_strcontrast', $lang_plugin_im['im_strcontrast']);
        set_js_var('im_strsatur', $lang_plugin_im['im_strsatur']);
        set_js_var('im_strsharpen', $lang_plugin_im['im_strsharpen']);
        set_js_var('im_useurlvalues', $CONFIG['plugin_im_urlvalues']);
        set_js_var('im_usecookies', $CONFIG['plugin_im_cookies']);

        if ($CONFIG['plugin_im_compatible'] == '1')
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
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_im_compatible', '1')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_im_cookies', '1')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_im_urlvalues', '1')");
    return true;
}


// uninstall and drop settings table
function im_uninstall() {
    global $CONFIG;
    // Delete the plugin config records
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_im_compatible'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_im_cookies'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_im_urlvalues'");
    return true;
}


?>