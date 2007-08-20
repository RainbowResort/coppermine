<?php
/*
 * PHP library for all GD functions in CPG
 * @author xnitingupta
 */

/**
 * Class for user related functions
 */
class gdfunctions {

   var $GD_ENABLED, $GD_SUPPORTED;

   function initialize() {
   	 $this->GD_ENABLED = false;
   	 if (function_exists("gd_info")) {
   	    $this->GD_SUPPORTED = true;
   	    $gd = gd_info();
   	    foreach ($gd as $k => $v) { 
           if ($k == "GD Version") {
           	  $this->GD_ENABLED = true;
           }
   	    } 
   	 }  else {
   	 	$this->GD_SUPPORTED = false;
   	 }   	 
   }
   
   function createthumb($name,$filename,$new_w,$new_h){
	  global $CF;
	  $system=explode('.',$name);
	  if (preg_match('/jpg|jpeg|JPG|JPEG/',$system[(count($system)-1)])){
		 @$src_img=imagecreatefromjpeg($name);
	  }
	  if (preg_match('/png|PNG/',$system[(count($system)-1)])){
		 @$src_img=imagecreatefrompng($name);
	  }
	  if(!$src_img) {
	  	 return false;
	  }
      $old_x=imageSX($src_img);
      $old_y=imageSY($src_img);
      if ($old_x > $old_y) {
	     $thumb_w=$new_w;
	     $thumb_h=$old_y*($new_h/$old_x);
      }
      if ($old_x < $old_y) {
	     $thumb_w=$old_x*($new_w/$old_y);
	     $thumb_h=$new_h;
      }
      if ($old_x == $old_y) {
	     $thumb_w=$new_w;
	     $thumb_h=$new_h;
      }
      $dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
	  imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y); 
      if (preg_match("/png/",$system[1])) {
	     imagepng($dst_img,$filename); 
      }  else {
	     imagejpeg($dst_img,$filename); 
      }
      imagedestroy($dst_img); 
      imagedestroy($src_img);
      return true;
   }

}

?>