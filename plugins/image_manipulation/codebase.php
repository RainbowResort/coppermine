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
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/branches/cpg1.5.x/plugins/image_manipulation/codebase.php $
  $Revision: 6870 $
  $LastChangedBy: timoswelt $
  $Date: 2009-12-29 17:46:38 +0100 (Di, 29. Dez 2009) $
  **************************************************/

  
if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');


// Add js files
$thisplugin->add_action('page_start','include_js_maniplug');

// Add plugin_install action
$thisplugin->add_action('plugin_install','im_install');

// Add plugin_uninstall action
$thisplugin->add_action('plugin_uninstall','im_uninstall');


function include_js_maniplug() {
  global $JS, $CONFIG;
  if (defined('DISPLAYIMAGE_PHP')) 
  {  
    if ($CONFIG['plugin_im_compatible'] == '1')
    {
    	$JS['includes'][] = "./plugins/image_manipulation/pixastic_compatible.js";
    }
    else
    {
    	$JS['includes'][] = "./plugins/image_manipulation/pixastic.js";
    }
    
    
    if (file_exists("./plugins/image_manipulation/im_{$CONFIG['lang']}.js")) 
    {
      $JS['includes'][] = "./plugins/image_manipulation/im_{$CONFIG['lang']}.js";
    }
    else
    {
      $JS['includes'][] = "./plugins/image_manipulation/im_english.js";
    }
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