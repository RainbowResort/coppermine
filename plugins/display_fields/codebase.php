<?php
/**************************************************
  Coppermine Plugin - Display Fields
  *************************************************
  Copyright (c) 2006 Paul Van Rompay
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  *************************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

// --------------------------------------------------------------------------
// CONFIGURATION OPTIONS - BEGIN
// --------------------------------------------------------------------------

// Add the fields you want sorted to the array below, in the order you want.
// All other fields (not in the array) will be added to the end.
// Use language-independent field names in $lang_picinfo (lang/english.php)
// For example, use 'addFavPhrase', *not* 'Favorites'.
// If the field doesn't exist in $lang_picinfo, just use the field name.
// The language-specific names may work as well (in most cases).

define('USE_SORTLIST', false);	// true: use array below to sort fields
$thisplugin->sort_fieldlist = array(
	'addFavPhrase', 
	'DateTimedigitized',
);

// --------------------------------------------------------------------------
// CONFIGURATION OPTIONS - END
// --------------------------------------------------------------------------


// NOTE: You should not modify the code below unless you know what you are doing.

// ------------------------------------------------------------------------------------------------
// Add an install & configure & uninstall actions
// ------------------------------------------------------------------------------------------------
$thisplugin->add_action('plugin_install','displayfields_install');
$thisplugin->add_action('plugin_configure','displayfields_configure');
$thisplugin->add_action('plugin_uninstall','displayfields_uninstall');

// ------------------------------------------------------------------------------------------------
// Add the main filter - filter picture & album fields to display
// ------------------------------------------------------------------------------------------------
$thisplugin->add_filter('file_info','displayfields_filter');

// ------------------------------------------------------------------------------------------------
// Add actions
// ------------------------------------------------------------------------------------------------
$thisplugin->add_action('page_start','displayfields_page_start');

// ------------------------------------------------------------------------------------------------
// Install Plugin
// ------------------------------------------------------------------------------------------------
function displayfields_install() 
{
	global $CONFIG, $lang_plugin_displayfields, $lang_plugin_displayfields_config;
	require ('plugins/display_fields/include/init.inc.php');
	
	if ($_POST['submit']==$lang_plugin_displayfields_config['button_done']) {
		return true;
	} else {
		return 1;
	}
}

// ------------------------------------------------------------------------------------------------
// Configure Plugin
// ------------------------------------------------------------------------------------------------
function displayfields_configure() 
{
	global $CONFIG, $lang_picinfo, $lang_modifyalb_php;
	global $lang_plugin_displayfields, $lang_plugin_displayfields_config;
	require ('plugins/display_fields/include/init.inc.php');
	define('MODIFYALB_PHP', true);
	define('DISPLAYIMAGE_PHP', true);
	if (file_exists("lang/{$CONFIG['lang']}.php")) {
		require "lang/{$CONFIG['lang']}.php";
	} else require 'lang/english.php';

	$fieldname_list = array('Filename', 'Album name', 'Keywords', 'File Size', 'Date Added', 'Dimensions', 'Displayed', 'URL', 'addFavPhrase');
	$i = 0;
	foreach($fieldname_list as $field) {
		$field_list[$i] = $lang_picinfo[$field];
		$i++;
	}
	$field_list[$i] = $lang_modifyalb_php['alb_desc'];	

	// delete previous plugin config options if necessary (just in case)
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name REGEXP '^plugin_displayfields_'");

	// insert default parameters into configuration table
	$sql = "INSERT INTO {$CONFIG['TABLE_CONFIG']} (name, value)"
		." VALUES"
		." ('plugin_displayfields_adminshowall','1')";

	foreach($field_list as $field) {
		$field = str_replace(' ','_',$field);
		$sql .= ",('plugin_displayfields_{$field}','1')";
	}
	cpg_db_query($sql);

	echo <<< EOT
		<h2>{$lang_plugin_displayfields['install_done']}</h2>
		{$lang_plugin_displayfields['install_note']}<br />
		<br />
		<form action="{$_SERVER['REQUEST_URI']}" method="post">
		<input type="submit" value="{$lang_plugin_displayfields_config['button_done']}" name="submit"/>
		</form>
EOT;
}

// ------------------------------------------------------------------------------------------------
// Uninstall Plugin
// ------------------------------------------------------------------------------------------------
function displayfields_uninstall() 
{
	global $CONFIG;
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name REGEXP '^plugin_displayfields_'");
	return true;
}

// ------------------------------------------------------------------------------------------------
// add config button
// ------------------------------------------------------------------------------------------------
function displayfields_add_config_button($href,$title,$target,$link)
{
  global $template_gallery_admin_menu;

  $new_template = $template_gallery_admin_menu;
  $button = template_extract_block($new_template,'documentation');
  $params = array(
      '{DOCUMENTATION_HREF}' => $href,
      '{DOCUMENTATION_TITLE}' => $title,
      'target="cpg_documentation"' => $target,
      '{DOCUMENTATION_LNK}' => $link,
   );
   $new_button="<!-- BEGIN $link -->".template_eval($button,$params)."<!-- END $link -->\n";
   template_extract_block($template_gallery_admin_menu,'documentation',"<!-- BEGIN documentation -->" . $button . "<!-- END documentation -->\n" . $new_button);
}

// ------------------------------------------------------------------------------------------------
// add admin button to start of each page
// ------------------------------------------------------------------------------------------------
function displayfields_page_start()
{
	global $CONFIG, $lang_plugin_displayfields, $lang_plugin_displayfields_config;
	require ('plugins/display_fields/include/init.inc.php');

	if (GALLERY_ADMIN_MODE) {
		displayfields_add_config_button('index.php?file=display_fields/plugin_config',$lang_plugin_displayfields['config_title'],'',$lang_plugin_displayfields['config_button']);
	}
}

// ------------------------------------------------------------------------------------------------
// Validate access to full-size photos and remove link to full-size photos if not allowed 
// ------------------------------------------------------------------------------------------------
function displayfields_filter($info) 
{
	global $CONFIG, $USER, $lang_picinfo, $lang_modifyalb_php, $CURRENT_PIC_DATA, $thisplugin;
	global $plugin_displayfields_params;
	require ('plugins/display_fields/include/init.inc.php');
	define('MODIFYALB_PHP', true);
	if (file_exists("lang/{$CONFIG['lang']}.php")) {
		require "lang/{$CONFIG['lang']}.php";
	} else require 'lang/english.php';

	// Add Album Description to display fields if requested
	$alb_desc = str_replace(' ','_',$lang_modifyalb_php['alb_desc']);
	if ($plugin_displayfields_params["plugin_displayfields_$alb_desc"] == '1') {
		$result = cpg_db_query("SELECT description FROM {$CONFIG['TABLE_ALBUMS']} WHERE aid='{$CURRENT_PIC_DATA['aid']}' LIMIT 1");
		$row = mysql_fetch_array($result);
		mysql_free_result($result);

		// Adds album description at end; commented out so can add after Album Title
		// $info[str_replace('_',' ',$alb_desc)] = $row['description'];

		if ($row['description']) {
			$newinfo = array();
			foreach($info as $key => $value) {
				$newinfo[$key] = $value;
				if ($key == $lang_picinfo['Album name']) {
					$newinfo[str_replace('_',' ',$alb_desc)] = bb_decode($row['description']);
				}
			}
			$info = $newinfo;	// replace $info with new "sorted" info (only albdesc sorted now)
		}
	}

	if (!GALLERY_ADMIN_MODE || !$CONFIG['plugin_displayfields_adminshowall']) {
		foreach($plugin_displayfields_params as $name => $value) {
			if($value == '0') { 
				$name = str_replace('plugin_displayfields_','',$name);
				$name = str_replace('_',' ',$name);
				unset($info[$name]); 
			}
		}
		if (USE_SORTLIST) {
			$newinfo = array();
			foreach($thisplugin->sort_fieldlist as $name) {
				$field = ($lang_picinfo[$name] ? $lang_picinfo[$name] : $name);
				if($info[$field]) {
					$newinfo[$field] = $info[$field];
				}
			}
			$info = array_unique($newinfo + $info);
		}
	}

	return $info;
}

?>
