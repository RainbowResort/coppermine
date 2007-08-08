<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2007 Coppermine Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  ********************************************
  Coppermine version: 1.5.0
  $HeadURL$
  $Revision: 3620 $
  $LastChangedBy: saweyyy $
  $Date: 2007-06-20 16:37:09 +0200 (wo, 20 jun 2007) $
**********************************************/

/**
* Coppermine Photo Gallery 1.5.0 watermarker.php
*
* This file is the is used for configuring the watermark function,
* also see documentation for this file {@relativelink ../_watermarker.php.php Free Standing Code}
*
* @copyright 2002-2006 Gregory DEMAR, Coppermine Dev Team
* @license http://opensource.org/licenses/gpl-license.php GNU General Public License V2
* @package Coppermine
* @version $Id: index.php 3620 2007-06-20 14:37:09Z saweyyy $
*/

/**
* Unless this is true most things wont work - protection against direct execution of inc files
*/
define('IN_COPPERMINE', true);
require('include/init.inc.php');

if (!isset($_GET['action'])) {
	return;
}

switch($_GET['action']){
	case "config":
		//show configuration page
		if (!GALLERY_ADMIN_MODE) cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
		global $CONFIG;
		global $lang_watermarker_php;
		pageheader($lang_watermarker_php['title']);
		
		//get config values
		$text = $CONFIG['wm_text'];
		$size = $CONFIG['wm_text_size'];
		$top = $CONFIG['wm_top'];
		$left = $CONFIG['wm_left'];
		$color = $CONFIG['wm_color'];
		$rotation = $CONFIG['wm_rotation'];
		$what = $CONFIG['wm_what'];
		$image_url = $CONFIG['wm_image_url'];
		$font = $CONFIG['wm_font'];
		$flashvars = "      <param name=\"flashvars\" value=\"p_text=$text&p_size=$size&p_left=$left&p_top=$top&p_rotation=$rotation&p_color=$color&p_font=$font&p_what=$what&p_image_url=$image_url\" />";
		
		//print flash-app via javascirpt
		echo "<script language=\"javascript\" type=\"text/javascript\" src=\"./watermarker/watermarker.js\"></script>";
		echo "<center><script language=\"javascript\" type=\"text/javascript\">write_watermarker('$flashvars')</script></center><br /><br />";
				
		pagefooter();
		ob_end_flush();
		break;
	case "preview":
		//show preview image
		global $CONFIG;
		isset($_GET['what']) ? $what = $_GET['what'] : $what = $CONFIG['wm_what'];
		isset($_GET['image_url']) ? $image_url = $_GET['image_url'] : $image_url = $CONFIG['wm_image_url'];
		isset($_GET['size']) ? $size = $_GET['size'] - 1 : $size = $CONFIG['wm_text_size'];
		isset($_GET['top']) ? $top = $_GET['top'] : $top = $CONFIG['wm_top'];
		isset($_GET['left']) ? $left = $_GET['left'] : $left = $CONFIG['wm_left'];
		isset($_GET['text']) ? $text = $_GET['text'] : $text = $CONFIG['wm_text'];
		isset($_GET['rotation']) ? $rotation = $_GET['rotation'] : $rotation = $CONFIG['wm_rotation'];
		isset($_GET['color']) ? $c = $_GET['color'] : $c = $CONFIG['wm_color'];
		isset($_GET['font']) ? $font = $_GET['font'] : $font = $CONFIG['wm_font'];
		$rotation = 360 - $rotation ;
		
		//check which image-editor to use
		switch($CONFIG['thumb_method']){
			case "im":
				require("include/imageObjectIM.class.php");
				break;
			case "gd1":
				require("include/imageObjectGD.class.php");
				break;
			case "gd2":
				require("include/imageObjectGD.class.php");
				break;	
		}
		
		//create the preview
		$preview = new imageObject("", "img.jpg");
		if($what == "text"){
			//watermark with text
			$preview->watermarkText($text, $font, $c, $size, $left, $top, $rotation);
			echo($preview->preview);
		}else{
			//watermark with image
			//get the actual watermark image if it was converted for use with the configurator
			if(file_exists("watermarker/images/" . substr($image_url,0, (strlen($image_url)-4) ))){
				$image_url = "watermarker/images/" . substr($image_url,0, (strlen($image_url)-4) );
			}else{
				$image_url = "watermarker/images/" . $image_url;
			}
			echo("<img src='".$image_url."'/>");
			$preview->watermarkImage($image_url, $left, $top, $rotation, $transparency=100);
			echo($preview->preview);
		}
		
		break;
	case "save":
		//save configuration to db
		if (!GALLERY_ADMIN_MODE) cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
		$wm['text_size'] = $_GET['size'];
		$wm['top'] = $_GET['top'] ;
		$wm['left'] = $_GET['left'];
		$wm['text'] = $_GET['text'] ;
		$wm['rotation'] = $_GET['rotation'] ;
		$wm['color'] = $_GET['color'];
		$wm['font'] = $_GET['font'];
		$wm['what'] = $_GET['what'];
		if($_GET['image_url'] != "" && $_GET['image_url'] != "undefined"){
			$wm['image_url'] = $_GET['image_url'];
		}
		
		global $CONFIG;
		global $lang_watermarker_php;
		pageheader($lang_watermarker_php['title']);
		foreach($wm as $key => $value){
			if(cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value='$value' WHERE name='wm_".$key."'")){
				print($key . " saved <br />" );
			}else{
				print("Something went wrong -> ". $key);
			}
		}
		pagefooter();
		ob_end_flush();
		break;
	case "get_fonts":
		//get fonts from fonts dir
		$path = "./watermarker/fonts";
		$dh = opendir($path);
		$vars="&fonts=";
		while (($file = readdir($dh)) !== false) {
			if($file != "." && $file != ".." && (substr($file, strlen($file) - 4) == '.ttf'  || substr($file, strlen($file) - 4) == '.TTF')) {
				$vars .= substr($file, 0, strlen($file) - 4) . "/";
			}
		}
		closedir($dh);
		print($vars);
		break;
	case "get_lang":
		print("&lang_upload=" . $lang_watermarker_php['upload'] . "&lang_preview=" . $lang_watermarker_php['preview'] . "&lang_save=" . $lang_watermarker_php['save'] . "&lang_text=" . $lang_watermarker_php['text'] . "&lang_image=" . $lang_watermarker_php['image'] . "&lang_upload_image=" . $lang_watermarker_php['upload_image'] . "&lang_upload_font=" . $lang_watermarker_php['upload_font'] . "&lang_loaded=loaded");
		break;
	default :
		break;


}













?>