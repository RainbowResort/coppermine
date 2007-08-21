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
  $Revision: 3267 $
  $LastChangedBy: gaugau $
  $Date: 2006-09-01 11:38:25 +0200 (Fr, 01 Sep 2006) $
**********************************************/

//still need to fix the uploader in flash, it won't connect to a relative url

if($_SERVER['HTTP_USER_AGENT'] == "Shockwave Flash" && $_SERVER['REMOTE_ADDR'] == "127.0.0.1"){
	switch($_GET['action']){
		case "image" :
			move_uploaded_file($_FILES['Filedata']['tmp_name'], "./images/" . $_FILES['Filedata']['name']); 
			chmod("./images/" . $_FILES['Filedata']['name'], 0777); 	
			
			//check file type, if gif or png; convert copy to jpg to work with in flash
			$n = $_FILES['Filedata']['name'];
			switch(substr($n, (strlen($n)-3))){
				case "gif": 
					$tmpImage = imagecreatefromgif("./images/" . $n);
					imagealphablending($tmpImage, false);
					imagesavealpha($im,true); 
					imagejpeg($tmpImage, "./images/" .  $n . ".jpg");
					break;
				case "png": 
					$tmpImage = imagecreatefrompng("./images/" . $n);
					imagealphablending($tmpImage, false); 
					imagesavealpha($im,true);
					imagejpeg($tmpImage, "./images/" .  $n . ".jpg");
					break;
			}
			break;
		case "font" :
			move_uploaded_file($_FILES['Filedata']['tmp_name'], "./fonts/" . $_FILES['Filedata']['name']); 
			chmod("./fonts/" . $_FILES['Filedata']['name'], 0777); 
			break;
		default:
			break; 
	}
}
?>