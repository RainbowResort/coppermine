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

define('IN_COPPERMINE', true);
include_once('include/init.inc.php');


// get parameters out of URL
$thumbrot_cage = Inspekt::makeGetCage();
$pid = $thumbrot_cage->getInt('pid');
$degrees = $thumbrot_cage->getInt('deg');



//get_meta_album_set in functions.inc.php will populate the $ALBUM_SET instead; matches $META_ALBUM_SET.
get_meta_album_set($cat,$ALBUM_SET);
$META_ALBUM_SET = $ALBUM_SET;

// Retrieve data for the current picture
    $result = cpg_db_query("SELECT aid from {$CONFIG['TABLE_PICTURES']} WHERE pid='$pid' $ALBUM_SET LIMIT 1");
    if (mysql_num_rows($result) == 0) cpg_die(ERROR, $lang_errors['non_exist_ap'], __FILE__, __LINE__);
    $row = mysql_fetch_array($result);
    $album = $row['aid'];
    $pic_data = get_pic_data($album, $pic_count, $album_name, -1, -1, false);
    for($pos = 0; $pic_data[$pos]['pid'] != $pid && $pos < $pic_count; $pos++);
    $pic_data = get_pic_data($album, $pic_count, $album_name, $pos, 1, false);
    $CURRENT_PIC_DATA = $pic_data[0];
    $image = $CONFIG['fullpath'].$CURRENT_PIC_DATA['filepath'].$CONFIG['thumb_pfx'].$CURRENT_PIC_DATA['filename']; 

    // Get settings out of CONFIG table
    $backcolor = ltrim($CONFIG['plugin_thumb_rotate_bgcolor'], '#');
    $brd = $CONFIG['plugin_thumb_rotate_borderwidth'];
    $brdcol = ltrim($CONFIG['plugin_thumb_rotate_bordercolor'], '#');



    // get path to cache folder
    $fullpath = $CONFIG['fullpath'];
    $fullpath .= 'edit/thumb_rotate_cache/';

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
    
    // create destination image 6px bigger than source+brd*2 to make anti aliasing work
    $finalimg = imagecreatetruecolor($sourcex+$brd*2+6,$sourcey+$brd*2+6);
    
    // make image transparent
    //imagealphablending($finalimg,true);
    $fin_bg = imagecolorallocate($finalimg, $bg1, $bg2, $bg3);
    imagefilledrectangle($finalimg,0,0,$sourcex+$brd*2+6,$sourcey+$brd*2+6,$fin_bg);

    // create border
    if ($brd) {
      $bordercolor = imagecolorallocate($finalimg, $bc1, $bc2, $bc3);
      imagefilledrectangle($finalimg,3,3,$sourcex+$brd*2+3,$sourcey+$brd*2+3,$bordercolor);
    }

    // copy source into finalimg
    imagecopy($finalimg,$source,$brd+3,$brd+3,0,0,$sourcex,$sourcey);
    
    // rotate image
    $rotate = imagerotate($finalimg, $degrees, $fin_bg);
    
    // set transparency
    imagecolortransparent($rotate, $fin_bg);
    
    // deliver png and save to cache
    imagepng($rotate);
    imagepng($rotate, $fullpath . str_replace('/','_',$image).'.png');
    
    // clean up
    imagedestroy($rotate);
    imagedestroy($source);
    imagedestroy($finalimg);

?>