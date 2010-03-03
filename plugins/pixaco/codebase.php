<?php
/****************************************************
  CPG Photo Shop Plugin for Coppermine Photo Gallery
  ***************************************************
  Copyright (c) 2007 Bettina Rose <derdip@freenet.de>
  ***************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  ***************************************************
  Pixaco plugin version: 1.0
  $Revision: 1.0 $
  $Author: dip $
*****************************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

// Add the one needed filter for that plugin
$thisplugin->add_filter('file_data','pixaco_add');

function pixaco_add($pic_data){
	global  $CONFIG;
	
	//select the langfile, if! fallback
	if (!file_exists("plugins/pixaco/lang/{$CONFIG['lang']}.php"))
	  $CONFIG['lang'] = 'english';
	require "plugins/pixaco/lang/{$CONFIG['lang']}.php";

	//get the fullsize pic URL
	$fullsize_url = get_pic_url($pic_data);
	$button_def = '';
	$link_data = '<a href="javascript:;" onclick="MM_openBrWindow(\'http://www.pixaco.de/services/httpbridge.aspx?smm=cookie&cmd=addimage&url0='.$CONFIG['ecards_more_pic_target'].$fullsize_url.'\',\'popup\',\'width=310,height=250,menubar=no,status=no,scrollbars=no,resizable=yes,left=50,top=50\');">'.$lang_plugin_pixaco['add_item'].'</a>';

	//add that generated code to the html and return
	$pic_data['html'] = $pic_data['html'].$link_data;
	return $pic_data;
} 
