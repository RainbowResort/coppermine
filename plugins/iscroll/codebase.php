<?php
/**
 * Coppermine Photo Gallery
 *
 * Copyright (c) 2003-2009 Coppermine Dev Team
 * v1.1 originally written by Gregory DEMAR
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * Coppermine version: 1.4.26
 *
 * isroll ver 2.1 
 * Based on mod. by rphMedia  http://forum.coppermine-gallery.net/index.php?action=profile;u=9702
 * Plugin Written by JR Carver - http://gallery.josephcarver.com/natural/ - http://i-imagine.net
 * 04 February 2010
*/

	if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

	// Add plugin_install action
	$thisplugin->add_action('plugin_install','iscroller_install');

	// Add plugin_uninstall action
	$thisplugin->add_action('plugin_uninstall','iscroller_uninstall');

	// Add plugin_configure action
	$thisplugin->add_action('plugin_configure','iscroller_configure');

	// Add plugin_cleanup action
	$thisplugin->add_action('plugin_cleanup','iscroller_cleanup');

	// Add filter for page head
	$thisplugin->add_filter('page_meta','iscroller_head');

	// Add plugin display action
	$thisplugin->add_filter('plugin_block','iscroller_main');


	// Configure plugin for install

	function iscroller_configure($action) {

	global $thisplugin;

	if ($action===1) {
		echo <<< EOT
	<form action="{$_SERVER['REQUEST_URI']}" method="post">
		<p>
			You already have this plugins files in your root Coppermine folder.<br />
			Is it ok to overwrite?
		</p>
		<div style="margin:25;">
		<table border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td><input type="radio" name="create" value="1" /></td>
				<td>Yes</td>
			</tr>
			<tr>
				<td><input type="radio" name="create" checked="checked" value="0" /></td>
				<td>No</td>
			</tr>
		</table>
		</div>
		<span>
			<input type="submit" name="submit" value="Submit" /> &nbsp;&nbsp;&nbsp;
			<input type="button" name="cancel" onClick="window.location='pluginmgr.php';" value="Cancel" />
		</span>
		<p>&nbsp;</p>
	</form>
EOT;
	}
	}

	// Display cleanup options for uninstall

	function iscroller_cleanup($action) {
	if ($action===1) {
		echo <<< EOT
	<form action="{$_SERVER['REQUEST_URI']}" method="post">
		<p>
			Delete the plugin files in your Coppermine root? <br>(If the files were created by this plugin,
			It's ok to delete.) <br>
			<b> IT IS STRONGLY ADVISED TO SELECT YES </b>
		</p>
		<div style="margin:25;">
		<table border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td><input type="radio" name="delete" checked="checked" value="1" /></td>
				<td>Yes</td>
			</tr>
			<tr>
				<td><input type="radio" name="delete" value="0" /></td>
				<td>No</td>
			</tr>
		</table>
		</div>
		<span>
			<input type="submit" name="submit" value="Submit" /> &nbsp;&nbsp;&nbsp;
			<input type="button" name="cancel" onClick="window.location='pluginmgr.php';" value="Cancel" />
		</span>
	</form>
EOT;

	}
	}

	// Install the plugin

	function iscroller_install() {
    global $CONFIG, $thisplugin;
	
		$sql = "INSERT IGNORE {$CONFIG['TABLE_CONFIG']} VALUES('iscroll_cfg_meta', '1'), ('iscroll_cfg_count', '24'),('iscroll_cfg_width', '800'), ('iscroll_cfg_height', '250') ";
		cpg_db_query($sql);
	
	$create = @$_POST['create'];

	// There are no plugin files or user has clicked 'yes' on the create form

	if (!file_exists('flow_link.swf') || $create) {
		copy($thisplugin->fullpath.'/flow_link.swf','flow_link.swf');
		copy($thisplugin->fullpath.'/flow_link.php','flow_link.php');
		return true;

	// The files exist; display the configure form
	} elseif (!isset($create)) {
		return 1;

	// User has clicked 'no' on the configure form. Install plugin. Don't copy files
	} else {
		return true;
	}
	}

	// Uninstall the plugin

	function iscroller_uninstall() {
    global $CONFIG, $thisplugin;
		//remove the record from config
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'iscroll_cfg_meta'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'iscroll_cfg_count'");	
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'iscroll_cfg_width'");	
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'iscroll_cfg_height'");	
	
	$delete = @$_POST['delete'];
	// There are plugin files and user has clicked 'yes' on the cleanup form; delete the files
	if (file_exists('flow_link.swf') && file_exists('flow_link.php') && $delete) {
		unlink('flow_link.swf');
		unlink('flow_link.php');
		return true;

	// There are plugin files; display the cleanup form
	} elseif (file_exists('flow_link.swf') && file_exists('flow_link.php') && !isset($delete)) {
		return 1;

	// User has clicked 'no' on the cleanup form. Uninstall plugin. Don't delete files
	} else {
		return true;
	}
	}

	// include js reference in page header
	function iscroller_head($html)
	{
    global $CONFIG, $thisplugin, $PHP_SELF;
	if ($PHP_SELF == 'index.php') {
		$html = '<script type="text/javascript"><!--
		AC_FL_RunContent = 0;//-->
		</script>
		<script type="text/javascript" src="plugins/iscroll/AC_RunActiveContent.js"></script>'
		.$html;
		return $html;
	}	
	}	
	// end head


	// 
	function iscroller_main($matches)
	{ 
        global $CONFIG, $matches;
        if($matches[1] != 'iscroll') {
          return $matches;
        }
	$this_plug = <<< EOT
	flow_link.php
EOT;

	$this_address = $CONFIG['site_url'];

	$iscroll_width = $CONFIG['iscroll_cfg_width'];

	$iscroll_height = $CONFIG['iscroll_cfg_height'];

	echo <<< EOT
<div id= "eye" align= "center">
<script type="text/javascript">
	if (AC_FL_RunContent == 0) {
		alert("This page requires AC_RunActiveContent.js.");
	} else {
		AC_FL_RunContent(
			'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0',
			'width', '$iscroll_width',
			'height', '$iscroll_height',
			'src', 'flow_link',
			'FlashVars', 'xmlPath=$this_address$this_plug',
			'quality', 'high',
			'pluginspage', 'http://www.macromedia.com/go/getflashplayer',
			'align', 'middle',
			'play', 'true',
			'loop', 'true',
			'scale', 'showall',
			'wmode', "transparent",
			'devicefont', 'false',
			'id', 'flow_link',
			'bgcolor', '',
			'name', 'flow_link',
			'menu', 'true',
			'allowFullScreen', 'false',
			'allowScriptAccess','sameDomain',
			'movie', 'flow_link',
			'salign', ''
			); //end AC code
	}
</script>
</div>
EOT;
	}
?>