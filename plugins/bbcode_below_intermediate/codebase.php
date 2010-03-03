<?php
/**************************************************
  CPG BB Code Plugin for Coppermine Photo Gallery
  *************************************************
  Copyright (c) 2006 Thomas Lange <stramm@gmx.net>
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  *************************************************
  Coppermine version: 1.4.9
  BB Code Plugin version: 1.2
  $Revision: 1.0 $
  $Author: stramm $
***************************************************/


if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

// Add a filter
$thisplugin->add_filter('file_data','bbcode_add_data');


function bbcode_add_data($pic_data){ //$pic_data
	global $CONFIG;

//here we define a var that holds the copy to clipboard javascript 	
//unfortunately the Firefox security settings do not allow clipboard copy to work without modifying prefs... 
//therefore only a msg pops up if a user uses netscape/ firefox and presses the copy button
	$script_data = <<< EOT

<script language="javascript" type="text/javascript">
<!--
function copy_clip(bb_text)
{
 if (window.clipboardData) 
   {
   	window.clipboardData.setData("Text", bb_text);
   }
   else if (window.netscape) 
   { 
   	alert("Due to Firefox secutrity settings it is not possible to use the copy button. Please manually copy the bb code with 3 fast left clicks into the textara. Then press ctrl+c");
   }
   return false;
}
//-->
</script>
EOT;

	$fullsize_url = get_pic_url($pic_data);  //here we grab the url to the fullsized pic
	$thumb_url = get_pic_url($pic_data, 'thumb'); //thumb url
	
	$pic_data['title'] ? $name = $pic_data['title'] : $name = 'No Title'; //chcking if the pic has a title, if not we set it to 'No title'

	//here we define the actual bbcode coppermine path + the path to the pic $img_url is for the version that displays the thumb, $name_url is for a txt link with the ikmage title
	$img_url = '[url='.$CONFIG['ecards_more_pic_target'].$fullsize_url.'][IMG]'.$CONFIG['ecards_more_pic_target'].$thumb_url.'[/IMG][/url]';
	$name_url = '[url='.$CONFIG['ecards_more_pic_target'].$fullsize_url.']'.$name.'[/url]';
	
	
	//this just brings everything in form... we create a table etc.
	$bbcode_data = '<table align="center" width="'.$CONFIG['picture_width'].'">'.$script_data.'<tr>';
	$bbcode_data .= '<td>[url][img][/url]</td>';
	$bbcode_data .= '<td><textarea name="bbcode" rows="1" cols="40" style="overflow:off;">'.$img_url.'</textarea><input type="button" value="Copy" onclick=\'copy_clip("'.$img_url.'")\'></td>';
	
	$bbcode_data .= '</tr><tr>';
	
	$bbcode_data .= '<td>[url]title[/url]</td>';
	$bbcode_data .= '<td><textarea name="bbcode" rows="1" cols="40">'.$name_url.'</textarea><input type="button" value="Copy" onclick=\'copy_clip("'.$name_url.'")\'></td>';
	
	$bbcode_data .= '</tr></table>';
	
	//finally we add the created stuff to the picture data and return it to coppermine
	$pic_data['html'] = $pic_data['html'].$bbcode_data; 

	return $pic_data; 
}
?>