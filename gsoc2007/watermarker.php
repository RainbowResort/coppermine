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
		//check which image-editor to use
		global $CONFIG;
		isset($_GET['what']) ? $what = $_GET['what'] : $what = $CONFIG['wm_what'];
		isset($_GET['image_url']) ? $image_url = $_GET['image_url'] : $image_url = $CONFIG['wm_image_url'];
		isset($_GET['size']) ? $fontSize = $_GET['size'] - 1 : $fontSize = $CONFIG['wm_text_size'];
		isset($_GET['top']) ? $top = $_GET['top'] : $top = $CONFIG['wm_top'];
		isset($_GET['left']) ? $left = $_GET['left'] : $left = $CONFIG['wm_left'];
		isset($_GET['text']) ? $text = $_GET['text'] : $text = $CONFIG['wm_text'];
		isset($_GET['rotation']) ? $font_rotation = $_GET['rotation'] : $font_rotation = $CONFIG['wm_rotation'];
		isset($_GET['color']) ? $c = $_GET['color'] : $c = $CONFIG['wm_color'];
		isset($_GET['font']) ? $font = $_GET['font'] : $font = $CONFIG['wm_font'];
		$font_rotation = 360 - $font_rotation ;
		switch($CONFIG['thumb_method']){
			case "im":

				break;
			case "gd1":
				
				break;
			case "gd2":
				//image or text watermark
				if($what == "text"){
					//watermarl with image
					$image = imagecreatefromjpeg("img.jpg");
					$font = $font . '.ttf';
					$front_color = imagecolorallocate($image, hexdec(substr($c,0,2)), hexdec(substr($c,2,2)), hexdec(substr($c,4,2)));
					//creates a bottom layer for readability
					//$bottom_color = imagecolorallocate($image, 0x66, 0x66, 0x66);
					//imagettftext($image, $fontSize, $font_rotation, $left, $top, $bottom_color, $font, $text);
	
					//creates the front layer
					imagettftext($image, $fontSize, $font_rotation, $left, $top, $front_color, $font, $text);
					header("Content-Type: image/PNG");
					imagejpeg($image);
					imagedestroy($image);
					break;
				}else{
					//watermark with image
					$watermark = imagecreatefromjpeg($image_url);
					$rot = $font_rotation;
					$dest_x = $left;
					$dest_y = $top;
					$watermark_width = imagesx($watermark);
					$watermark_height = imagesy($watermark);
					//check rotation (only possible to use 0, 90, 180 & 270)
					if($rot > 225 && $rot < 315){
						$watermark = imagerotate($watermark, 270, 0);
						$dest_x -= $watermark_height;
					}else if(($rot >= 180 && $rot < 225)||($rot > 495 && $rot < 540)){
						$watermark = imagerotate($watermark, 180, 0);
						$dest_x -= $watermark_width;
						$dest_y -= $watermark_height;
					}else if($rot > 405 && $rot < 495){
						$watermark = imagerotate($watermark, 90, 0);
						$dest_y -= $watermark_width;
					}

					$watermark_width = imagesx($watermark);
					$watermark_height = imagesy($watermark);
					
					$image = imagecreatefromjpeg("img.jpg");
					
					imagecopymerge($image, $watermark, $dest_x, $dest_y, 0, 0, $watermark_width, $watermark_height, 100);
					header("Content-Type: image/PNG");
					imagejpeg($image);
					imagedestroy($image);
					
					
					
					
					
					
				}
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
		$vars="fonts=";
		while (($file = readdir($dh)) !== false) {
			if($file != "." && $file != ".." && (substr($file, strlen($file) - 4) == '.ttf'  || substr($file, strlen($file) - 4) == '.TTF')) {
				$vars .= substr($file, 0, strlen($file) - 4) . "/";
			}
		}
		closedir($dh);
		echo $vars;
		break;
	case "upload_image":
		//if (!GALLERY_ADMIN_MODE) cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
		move_uploaded_file($_FILES['Filedata']['tmp_name'], "C:\\wamp\\www\\CPG\\CPG 1.5 Live\\watermarker\\images\\".$_FILES['Filedata']['name']); 
		chmod("./watermarker/images/".$_FILES['Filedata']['name'], 0777); 
		break;
		
	default :
		break;


}
















?>