<?php
/**************************************************
  Coppermine 1.4.x Plugin - Delete Favorite 
  *************************************************
  Copyright (c) 2006 Borzoo Mossavari
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  *************************************************
  Delete all your favorite file with just one click !
  ***************************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

// Add install & uninstall actions
$thisplugin->add_action('plugin_install','delfav_install');
$thisplugin->add_action('plugin_uninstall','delfav_uninstall');


// Add a configure action
$thisplugin->add_action('page_start','delfav_temp');

// Add a filter for the page HTML
$thisplugin->add_filter('page_html','delfav_main');
// Installation Function
function delfav_install() 
{
		return true;
}

// Uninstall
function delfav_uninstall()
{
	return true;
}
function delfav_temp() {
	global $lang_plugin_delfav,$CONFIG;
	require ('plugins/del_fav/include/init.inc.php');
}

// main function to modify page html
function delfav_main($html) {
    global $thisplugin, $lang_thumb_view, $lang_plugin_delfav;
	$exper = "#".$lang_thumb_view['download_zip']."(.*\n.*)</tr>#";
	if(preg_match($exper,$html,$found)){
		$delfav_but = $lang_thumb_view['download_zip'].$found[1].'<td class="sortorder_options"><span class="statlink">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php?file=del_fav/remfav" onclick="return confirmDelFav(\''.$lang_plugin_delfav['confirm'].'\')">'.$lang_plugin_delfav['config_button'].'</a><script type="text/javascript">function confirmDelFav(text)
{
    return confirm(text);
}</script></span></td></tr>';
		$html = str_replace($found[0],$delfav_but,$html);
	}
	return $html;
}
?>