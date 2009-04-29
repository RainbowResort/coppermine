<?php
/**************************************************
  Coppermine 1.5.x Plugin - Thumb Rotate
  *************************************************
  Copyright (c) 2009 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  **************************************************/


/************************************
  This file generates rotated images.
  It accepts these parameters:
  img - path to an image
  deg - degree of rotation 0-360
        (random if not set)
  bg  - background color in hex format
        (efefef if not set)
  brd - size of border (0-10)
  brdcol - border color in hex format
           (ffffff if not set)
  path - coppermine config variable fullpath
  		 (usually "albums/") 
*************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');
    // get image file
    if (!isset($_GET['img'])) {
    	exit();
    }
    $image = '../../'.$_GET['img'];
    
    
    // get degrees of rotation, if not set, random (0°-9°, 350°-359°)
    if (isset($_GET['deg']) && $_GET['deg'] == (int)$_GET['deg'] && $_GET['deg'] >= 0 && $_GET['deg'] <= 20) {
      $degrees = $_GET['deg'];
    } else {
      $degrees = rand(0,19);
      if ($degrees > 9) {
      	$degrees += 340;
      }
    }
    
    // get background color; if not set, use light gray
    if (isset($_GET['bg'])) {
      $backcolor=$_GET['bg'];
    } else {
      $backcolor='EFEFEF';
    }

    // get border size; if not set, set to 10
    if (isset($_GET['brd'])) {
      $brd=$_GET['brd'];
    } else {
      $brd = 10;
    }
    
    // get border color; if not set, use white
    if (isset($_GET['brdcol'])) {
      $brdcol=$_GET['brdcol'];
    } else {
      $brdcol='FFFFFF';
    }
    
    // get path to cache folder
    if (isset($_GET['path'])) {
      $fullpath = $_GET['path'];
    } else {
      $fullpath = 'albums'; // Set to default if empty
    }
    $fullpath .= '/edit/thumb_rotate_cache/';
    
    // split background color
    $bg1 = hexdec(substr($backcolor,0,2));
    $bg2 = hexdec(substr($backcolor,2,2));
    $bg3 = hexdec(substr($backcolor,4,2));

    // split border color
    $bc1 = hexdec(substr($brdcol,0,2));
    $bc2 = hexdec(substr($brdcol,2,2));
    $bc3 = hexdec(substr($brdcol,4,2));

      
    // set the image type to .png
    header('Content-type: image/png');
    
    // create source image from existing thumb file
    if (substr($image,-4) == '.png'){
      $source = imagecreatefrompng($image);
    } else {
      $source = imagecreatefromjpeg($image);
    }
    
    // get width / height of source image
    $sourcex = imagesx($source);
    $sourcey = imagesy($source);
    
    // create destination image 8px bigger than source+brd*2
    $finalimg = imagecreatetruecolor($sourcex+$brd*2+8,$sourcey+$brd*2+8);
    
    // make image transparent
    //imagealphablending($finalimg,true);
    $fin_bg = imagecolorallocate($finalimg, $bg1, $bg2, $bg3);
    imagefilledrectangle($finalimg,0,0,$sourcex+$brd*2+8,$sourcey+$brd*2+8,$fin_bg);

    // create border
    if ($brd) {
      $bordercolor = imagecolorallocate($finalimg, $bc1, $bc2, $bc3);
      imagefilledrectangle($finalimg,4,4,$sourcex+$brd*2+4,$sourcey+$brd*2+4,$bordercolor);
    }

    // copy source into finalimg
    imagecopy($finalimg,$source,$brd+4,$brd+4,0,0,$sourcex,$sourcey);
    
    // rotate image
    $rotate = imagerotate($finalimg, $degrees, $fin_bg);
    
    // set transparency
    imagecolortransparent($rotate, $fin_bg);
    
    // deliver png and save to cache
    imagepng($rotate);
    imagepng($rotate, '../../' . $fullpath . str_replace('/','_',$_GET['img']).$backcolor.$brdcol.$brd.'.png');
    
    // clean up
    imagedestroy($rotate);
    imagedestroy($source);
    imagedestroy($finalimg);

?>