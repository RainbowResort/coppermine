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
  $Revision$
  $LastChangedBy$
  $Date$
**********************************************/

class imageObject{

         // image resource
         var $imgRes;
         // px
         var $height=0;
         var $width=0;
         // for img height/width tags
         var $string;
         // output report or error message
         var $message;
         // file + dir
         var $directory;
         var $filename;
         // output quality, 0 - 100
         var $quality;
         // truecolor available, boolean
         var $truecolor;
		 //preview image
		 var $preview;

         //constructor
         function imageObject($directory,$filename,$previous=null)
        {
        $this->directory = $directory;
        $this->filename = $filename;
        $this->previous = $previous;
        $this->imgRes = $previous->imgRes;
        if (file_exists($directory.$filename)){
                        $this->filesize = round(filesize($directory.$filename)/1000);
                        if($this->filesize>0){
                                $size = @GetImageSize($directory.$filename);
                                if ($size && !$this->imgRes) {
                                        $this->imgRes = $this->getimgRes($directory.$filename,$size[2]);
                                }
                                if (function_exists("imagecreatetruecolor")){
                                        $this->truecolor = true;
                                }
                                $this->width = $size[0];
                                $this->height = $size[1];
                                $this->string = $size[3];
                                }
                        }// if
        }// constructor

         // private methods
         function getimgRes($name,&$type)
         {
           switch ($type){
              case 1:
              $im = imagecreatefromgif($name);
              break;
              case 2:
              $im = imagecreatefromjpeg($name);
              break;
              case 3:
              $im = imagecreatefrompng($name);
              break;
                      }
           return $im;
         }


         function createUnique(&$imgnew)
         {
           srand((double)microtime()*100000);
           $unique_str = "temp_".md5(rand(0,999999)).".jpg";
           @imagejpeg($imgnew,$this->directory.$unique_str,$this->quality);
           @imagedestroy($this->imgRes);
           //Don't clutter with old images
           @unlink($this->directory.$this->filename);
           //Create a new ImageObject
           return new imageObject($this->directory,$unique_str,$imgnew);
         }

         function createImage($new_w,$new_h)
         {
           if (function_exists("imagecreatetruecolor")){
             $retval = @imagecreatetruecolor($new_w,$new_h);
           }
           if (!$retval) $retval = imagecreate($new_w,$new_h);
           return $retval;
         }

         function cropImage(&$clipval)
         {
             $cliparray = split(",",$clipval);
             $clip_top = $cliparray[0];
             $clip_right = $cliparray[1];
             $clip_bottom = $cliparray[2];
             $clip_left = $cliparray[3];

             $new_w = $clip_right - $clip_left;
             $new_h = $clip_bottom - $clip_top;

             $dst_img = $this->createImage($new_w,$new_h);

             $result = @imagecopyresampled($dst_img, $this->imgRes, 0,0,$clip_left, $clip_top,$new_w, $new_h, $new_w, $new_h);
             if (!$result) $result = @imagecopyresized($dst_img, $this->imgRes, 0,0,$clip_left, $clip_top,$new_w, $new_h, $new_w, $new_h);

             return $this->createUnique($dst_img);

         }

         function rotateImage(&$angle){

          if ($angle == 180){
              $dst_img = @imagerotate($this->imgRes, $angle, 0);
          }else{
                  $width = imagesx($this->imgRes);
                  $height = imagesy($this->imgRes);
                  if ($width > $height){
                      $size = $width;
                      }else{
                      $size = $height;
                  }

                  $dst_img = $this->createImage($size, $size);
                  imagecopy($dst_img, $this->imgRes, 0, 0, 0, 0, $width, $height);
                  $dst_img = @imagerotate($dst_img, $angle, 0);
                  $this->imgRes = $dst_img;
                  $dst_img = $this->createImage($height, $width);

                  if ((($angle == 90) && ($width > $height)) || (($angle == 270) && ($width < $height))){
                          imagecopy($dst_img, $this->imgRes, 0, 0, 0, 0, $size, $size);

                  }

                  if ((($angle == 270) && ($width > $height)) || (($angle == 90) && ($width < $height))){
                          imagecopy($dst_img, $this->imgRes, 0, 0, $size - $height, $size - $width, $size, $size);
                  }
          }

           return $this->createUnique($dst_img);
         }



         function resizeImage($new_w=0,$new_h=0){

             $dst_img = $this->createImage($new_w,$new_h);

             $result = @imagecopyresampled($dst_img, $this->imgRes, 0, 0, 0, 0, $new_w, $new_h, $this->width,$this->height);
             if (!$result) $result = @imagecopyresized($dst_img, $this->imgRes, 0, 0, 0, 0, $new_w, $new_h, $this->width,$this->height);
             return $this->createUnique($dst_img);

         }
		 
		 function watermarkText($text, $font, $color, $size, $left, $top, $rotation, $transparency=100){

			$font = $font . '.ttf';
			$front_color = imagecolorallocate($this->imgRes, hexdec(substr($color,0,2)), hexdec(substr($color,2,2)), hexdec(substr($color,4,2)));
			
			//creates a bottom layer for readability
			//$bottom_color = imagecolorallocate($image, 0x66, 0x66, 0x66);
			//imagettftext($image, $fontSize, $font_rotation, $left - 1, $top - 1, $bottom_color, $font, $text);

			//creates the front layer
			imagettftext($this->imgRes, $size, $rotation, $left, $top, $front_color, $font, $text);
			//header("Content-Type: image/PNG");
			//imagejpeg($this->imgRes);
			
			//temp solution of my pc not working correctly
			foreach (glob("watermarker/tempimg/*.jpg") as $filename) {
			   unlink($filename);
			}
			$rand = rand(10, 99999);
			imagejpeg($this->imgRes, 'watermarker/tempimg/'.$rand.'.jpg');
			$this->preview = "<img src='watermarker/tempimg/".$rand.".jpg'/>";
		 }
		 
		 function watermarkImage($image, $left, $top, $rot, $transparency=100){
		 	//check file type
			$ext = end(explode('.',$image));
			$watermark = "";
			switch ($ext){
				case "jpg":
					$watermark = imagecreatefromjpeg($image);
					break;
				case "png":
					$watermark = imagecreatefrompng($image);
					break;
				case "gif":
					$watermark = imagecreatefromgif($image);
					break;
			}
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
			
			imagecopymerge($this->imgRes, $watermark, $dest_x, $dest_y, 0, 0, $watermark_width, $watermark_height, 100);
			
			//header("Content-Type: image/PNG");
			//imagejpeg($this->imgRes);
			
			//temp solution of my pc not working correctly
			foreach (glob("watermarker/tempimg/*.jpg") as $filename) {
			   unlink($filename);
			}
			$rand = rand(10, 99999);
			imagejpeg($this->imgRes, 'watermarker/tempimg/'.$rand.'.jpg');
			$this->preview = "<img src='watermarker/tempimg/".$rand.".jpg'/>";
		 }


         function saveImage(){

         }

   }
 ?>
