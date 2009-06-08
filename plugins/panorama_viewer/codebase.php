<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2008 Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  Coppermine version: 1.5.0
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**********************************************/
/*********************************************
  Coppermine Plugin - Panorama Viewer
  ********************************************
  Copyright (c) 2009 eenemeenemuu
**********************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

if (defined('DISPLAYIMAGE_PHP')) {
	$thisplugin->add_filter('html_image_reduced_overlay','panorama_viewer_image');
	$thisplugin->add_filter('html_image_reduced','panorama_viewer_image');
	$thisplugin->add_filter('html_image_overlay','panorama_viewer_image');
	$thisplugin->add_filter('html_image','panorama_viewer_image');
	
	function panorama_viewer_image($pic_html) {
		$pic_html = "<div style=\"width:100%; overflow:auto;\">".$pic_html."</div>";
		$pic_html = "<table width=\"100%\" style=\"table-layout:fixed;\"><tr><td width=\"100%\" align=\"center\">".$pic_html."</td></tr></table>";
		return $pic_html;
	}	
} else {
	$thisplugin->add_filter('page_html','panorama_viewer_page_html');
	
	function panorama_viewer_page_html($html) {
		global $CONFIG;
		$fullpath = str_replace("/", "\/", $CONFIG['fullpath']);
		$panorama_start = "<table width=\"100%\" style=\"table-layout:fixed;\"><tr><td width=\"100%\" align=\"center\"><div style=\"width:100%; overflow:hidden;\">";
		$panorama_end = "</div></td></tr></table>";
		$pattern = "/(<a href=\"displayimage.*<img src=\"{$fullpath}.*\/{$CONFIG['thumb_pfx']}.*<\/a>)/Uis";
		$html = preg_replace($pattern, $panorama_start."\\1".$panorama_end, $html);
		return $html;
	}
}

?>
