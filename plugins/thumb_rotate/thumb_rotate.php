<?php
/**************************************************
  Coppermine 1.5.x Plugin - Thumb Rotate $VERSION$=0.2
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
  It takes these parameters:
  img - path to an image
  deg - degree of rotation 0-360
        (random if not set)
  bg  - background color in hex format
        (efefef if not set)
  brd - size of border (0-10)
  brdcol - border color in hex format
           (ffffff if not set)
*************************************/


    // get image file
    if (!isset($_GET['img'])) exit();
    $image = '../../'.$_GET['img'];
    
    
    // get degrees of rotation, if not set, random (0°-9°, 350°-359°)
    if (isset($_GET['deg']))
    {
      $degrees=$_GET['deg'];
    }
    else 
    {
      $degrees = rand(0,19);
      if ($degrees > 9) $degrees += 340;
    }
    
    // get background color; if not set, use light gray
    if (isset($_GET['bg']))
    {
      $backcolor=$_GET['bg'];
    }
    else 
    {
      $backcolor='efefef';
    }

    // get border size; if not set, set to 10
    if (isset($_GET['brd']))
    {
      $brd=$_GET['brd'];
    }
    else 
    {
      $brd = 10;
    }
    
    // get border color; if not set, use white
    if (isset($_GET['brdcol']))
    {
      $brdcol=$_GET['brdcol'];
    }
    else 
    {
      $brdcol='ffffff';
    }
    
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
    if (substr($image,-4) == '.png') 
    {
      $source = imagecreatefrompng($image);
    }
    else
    {
      $source = imagecreatefromjpeg($image);
    }
    
    // get width / height of source image
    $sourcex = imagesx($source);
    $sourcey = imagesy($source);
    
    // create destination image 2px bigger than source+brd*2
    $finalimg = imagecreatetruecolor($sourcex+$brd*2+2,$sourcey+$brd*2+2);
    
    // make image transparent
    //imagealphablending($finalimg,true);
    $fin_bg = imagecolorallocate($finalimg, $bg1, $bg2, $bg3);
    imagefilledrectangle($finalimg,0,0,$sourcex+$brd*2+2,$sourcey+$brd*2+2,$fin_bg);

    // create border
    if ($brd)
    {
      $bordercolor = imagecolorallocate($finalimg, $bc1, $bc2, $bc3);
      imagefilledrectangle($finalimg,1,1,$sourcex+$brd*2,$sourcey+$brd*2,$bordercolor);
    }

    // copy source into finalimg
    imagecopy($finalimg,$source,$brd+1,$brd+1,0,0,$sourcex,$sourcey);
    
    // rotate image
    $rotate = imagerotate($finalimg, $degrees, $fin_bg);
    
    // set transparency
    imagecolortransparent($rotate, $fin_bg);
    
    // deliver png and save to cache
    imagepng($rotate);
    imagepng($rotate, './thumb_cache/'.str_replace('/','_',$_GET['img']).$backcolor.$brdcol.$brd.'.png');
    
    // room up
    imagedestroy($rotate);
    imagedestroy($source);
    imagedestroy($finalimg);

?>