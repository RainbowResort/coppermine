<?php
/**************************************************
  Coppermine 1.5.x Plugin - Daylight saving time
  *************************************************
  Copyright (c) 2010 $lang_plugin_dst
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  $HeadURL$
  $Revision$
  $LastChangedBy$lang_plugin_dst $
  $Date$
**************************************************/

require_once "./plugins/dst/lang/english.php";
if ($CONFIG['lang'] != 'english' && file_exists("./plugins/dst/lang/{$CONFIG['lang']}.php")) {
    require_once "./plugins/dst/lang/{$CONFIG['lang']}.php";
}

// DST information from http://www.timeanddate.com/time/dst2010.html

$name = $lang_plugin_dst['dst'];
$description = $lang_plugin_dst['description'];
$author = '<a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=24278" rel="external" class="external">eenemeenemuu</a> &amp; <a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=2" rel="external" class="external">Joachim Müller</a>';
$version = '2.0';
$plugin_cpg_version = array('min' => '1.5');
$install_info = '<a href="http://forum.coppermine-gallery.net/index.php/topic,64308.0.html" rel="external" class="admin_menu">'.cpg_fetch_icon('announcement', 1).$lang_plugin_dst['announcement_thread'].'</a>';
$extra_info = '';
if ($CONFIG['plugin_dst_country'] != '') {
	$extra_info .= sprintf($lang_plugin_dst['you_have_selected_x_as_country'], '<em>' . $CONFIG['plugin_dst_country'] . '</em>') . ' ';
	if ($CONFIG['plugin_dst_on'] == '1') {
		$extra_info .= sprintf($lang_plugin_dst['dst_will_end_on'], $CONFIG['plugin_dst_datetime']) . ' ' . $lang_plugin_dst['time_will_auto_adjust'];
	} else {
		$extra_info .= sprintf($lang_plugin_dst['dst_will_start_on'], $CONFIG['plugin_dst_datetime']) . ' ' . $lang_plugin_dst['time_will_auto_adjust'];
	}
	$extra_info .= '<br />&nbsp;<br />';
}
$extra_info .= $install_info . '&nbsp;<a href="index.php?file=dst/admin" class="admin_menu">' . cpg_fetch_icon('config', 1) . $lang_plugin_dst['configuration'] . '</a>';
?>