<?php
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