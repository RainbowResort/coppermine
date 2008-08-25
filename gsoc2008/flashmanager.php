<?php

/*
flashmanager.php
Acts as an endpoint for CPG flash app.

Author : Sribabu Doddapaneni
mail: root [at] rusticgeek.net


*/

// prepares / updates Thumbnail given an Folder path and Image
function make_thumbnail($img_dir , $sourceimage){
		echo "Inside function " ;
		global $CONFIG;
		//Include the proper class for image Object
		if ($CONFIG['thumb_method']=="gd2")
		{
			require("include/imageobject_gd.class.php");
		}
		elseif ($CONFIG['thumb_method']=="im")
		{
			require("include/imageobject_im.class.php");
		}
		else
		{
			die ($lang_editpics_php['error_editor_class']);
		}
		
		
		
				$newimage = rand(1,9).$newimage ;	
				// make a copy which would later be converted into a thumbnail
				copy($CONFIG['fullpath'].$img_dir.$sourceimage,$CONFIG['fullpath'].$img_dir.$newimage);
				$imgObj = new imageObject($CONFIG['fullpath'].$img_dir,$newimage);
				$width=$imgObj->width;
				$height=$imgObj->height;
				//Calculate the thumbnail dimensions
				if ($CONFIG['thumb_use'] == 'ht') {
						$ratio = $height / $CONFIG['thumb_width'] ;
				} elseif ($CONFIG['thumb_use'] == 'wd') {
						$ratio = $width / $CONFIG['thumb_width'] ;
				} else {
						$ratio = max($width, $height) / $CONFIG['thumb_width'] ;
				}
				$ratio = max($ratio, 1.0);
				$dstWidth = (int)($width / $ratio);
				$dstHeight = (int)($height / $ratio);
				$imgObj->quality =  80; 
				$imgObj = $imgObj->resizeImage($dstWidth,$dstHeight);
				$newimage = $imgObj->filename;
				echo "\nThumbnail image path " . $thumbimage ;
				echo "\nDestination path "  . $CONFIG['fullpath'].$img_dir.$CONFIG['thumb_pfx'].$sourceimage ;
				rename($CONFIG['fullpath'].$img_dir.$newimage,$CONFIG['fullpath'].$img_dir.$CONFIG['thumb_pfx'].$sourceimage);
}

//BYPASS Inspekt to make upload work
if($_GET['upload']==1 /* && $_GET['magik']==$_SESSION["MAGIK"] */ )
{
	//get the JPG and write it to disk
	$jpg = $GLOBALS["HTTP_RAW_POST_DATA"]; ;
	// save image to a temporary location
	$f = fopen("./albums/snapshot.jpg", 'wb');
	fwrite($f, $jpg);
	fclose($f);
	
	// can use Inspekt now :)

	define('IN_COPPERMINE', true);
	require('include/init.inc.php');
	$input = Inspekt::makeSuperCage(); 
	$get = Inspekt::makeGetCage();
		
	// Pictures from a particular album
	//print "image id ".$_GET['fileid'];
	$img_id = $superCage->get->getRAW('fileid');
	$img_savetype = $superCage->get->getRAW('savetype');

	// could be done on the server .. but for now its easier to transmit	
	$size_x = $superCage->get->getRAW('size_x');
	$size_y = $superCage->get->getRAW('size_y');

	if ($img_savetype == 3)
	{
		print "200";

	}
	
	if ($img_savetype == 1 || $img_savetype == 2)
	{
			print "\n inside IF ... savetype =1 or 2? ";
			//connect to the database get the filepath
		

			define('EDITPICS_PHP', true);
			require('include/picmgmt.inc.php');
		
		//	require('include/picmgmt.inc.php');
		
			global $CONFIG;
			cpg_db_connect();
			$query = "SELECT * FROM {$CONFIG['TABLE_PICTURES']} where pid=".$img_id ;
			$image = cpg_db_fetch_rowset(cpg_db_query($query));
			$image = $image[0];
			// REPLACE OPTION --- OVERWRITE FILE
			if ($img_savetype  == 1 )
			{
						// copy the image to the require location
						copy('./albums/snapshot.jpg', './albums/'.$image[2].$image[3]); 
						// update the thumbnail
						make_thumbnail($image[2],$image[3]);
						print "200" ;
			}
			else if($img_savetype  == 2)
			{
						//save it with a new name in the album Directory with currentdate prefix
						//require('include/functions.inc.php');
						$siz_e = cpg_getimagesize('./albums/snapshot.jpg', true);
						$file_name = date("Ymdgi").$image[3];
						//copy temporary file to the final destination
						rename('./albums/snapshot.jpg', './albums/'.$image[2].$file_name); 
						
						//copy entires into the database
						// All fields are duplicated except the id field, which
						// is auto-incremented to the next available value.
						//cpg_db_connect();	
						$sql = 	"SELECT * FROM {$CONFIG['TABLE_PICTURES']} where pid=".$img_id ;
				
						$result = cpg_db_query($sql);
						//print "\n fetched results ".echoArray($result);
						
						if ($result) {
								$sql = "INSERT INTO {$CONFIG['TABLE_PICTURES']} SET ";
								$row = mysql_fetch_array($result);
								$RowKeys = array_keys($row);
								$RowValues = array_values($row);
							
								$sql .= $RowKeys[3] . " = '" . $RowValues[3] . "',";
								$sql .= $RowKeys[5] . " = '" . $RowValues[5] . "',";
								$sql .= $RowKeys[7] . " = '" . $file_name . "',";
								$sql .= $RowKeys[9] . " = '" . $RowValues[9] . "',";
								$sql .= $RowKeys[11] . " = '" . $RowValues[11] . "',";
								$sql .= $RowKeys[13] . " = '" . $size_x  . "'," ;
								$sql .= $RowKeys[15] . " = '" . $size_y  . "'," ;
								
								
										for ($i=17;$i<count($RowKeys);$i+=2) {
												if ($i!=17) { $sql .= ", "; }
												$sql .= $RowKeys[$i] . " = '" . $RowValues[$i] . "'";
										}
					
					
								make_thumbnail($image[2],$file_name);
								$result = cpg_db_query($sql);
								print "DONE";

								}
					}
		}	
}


// IF we are not uploading an edited image
else
{

			define('IN_COPPERMINE', true);
			require('include/init.inc.php');
			$input = Inspekt::makeSuperCage();  
			/* 
			1. gather album list  [ keep track of the current path ] [could be based on one element ? how is the path constructed ? ]
			2. gather images
			3. make xml 
			4. send
			
			basic stuff ..  pull the root dir .. and show all the images and folders
			making xml and push out
			*/
			
			/*
			XML response structure
			XML - represntation
					<image>
					<i></i> -id
					<l></l> -label
					<t></t>	-type
					<b></b>	- big url
					<s></s> - small url
					</image>
					
			*/		
			$CONFIG['debug_mode']==2;
			
			function echoArray($arr)
			{
			echo "<br>";
			foreach ($arr as $value)
				echo $value . "<br>";
			}
			
			/* TREE BUIDLER 
			make root
			for each category
				write category
					for each element in category
						write element
					close element
			close category
			close root
			*/
			
			function treeBuilder(){
			global $CONFIG;
			cpg_db_connect();
			echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
			echo "<node label='GALLERY'>\n";
			$query = "SELECT cid, name  FROM {$CONFIG['TABLE_CATEGORIES']}";
			$categories = cpg_db_fetch_rowset(cpg_db_query($query));
			foreach ($categories as $category)
			{
			echo "<node label='$category[1]' t='C' i='$category[0]'>\n";
			//fetch subelements
				$Albumquery = "SELECT aid, title FROM {$CONFIG['TABLE_ALBUMS']} WHERE category =".$category[0] ;
				$albums = cpg_db_fetch_rowset(cpg_db_query($Albumquery));
				foreach ($albums as $album)
					{
						echo "<node label='$album[1]' t='A' i='$album[0]'></node>\n";
					}
			echo "</node>\n";
			}
			echo "</node>\n";
			}
			
			
			/* getimg - looks up the image in the DB and redirects the image  */
			function getimg($img){
					global $CONFIG;
					cpg_db_connect();
					$query = "SELECT * FROM {$CONFIG['TABLE_PICTURES']} where pid=".$img ;
					
					$image = cpg_db_fetch_rowset(cpg_db_query($query));
					header("Location: ".get_pic_url($image[0])) ;
			}
			
			// return informaiton about a photo
			function getPhotoInfo($photo){
					global $CONFIG;
					cpg_db_connect();
					$query = "SELECT * FROM {$CONFIG['TABLE_PICTURES']} where pid=".$photo;
					$image = cpg_db_fetch_rowset(cpg_db_query($query));
					$image = $image[0];
					varFormat("info", "Resolution: " . $image[6]  . "x" . $image[7] . " Size: " . $image[4]/1000 . " KB" ) ;
					varFormat("&Filename",$image[3]);
					varFormat("&Title", $image[15]);
					varFormat("&Desc", $image[16]);
					varFormat("&keywords", $image[17]);
					varFormat("&approved",$image[18]);
					
					$query = "SELECT title FROM {$CONFIG['TABLE_ALBUMS']}" ;
					$albums = cpg_db_fetch_rowset(cpg_db_query($query));
					$albumStr = "";
					foreach ($albums as $album)
					$albumStr = $albumStr . "," . $album[0] ;
					
					$albumStr = substr($albumStr,1,$albumStr.length-1);
					varFormat("AlbumArray",$albumStr);
			
			}
			
			//actionscript URLVariables format
			function varFormat($id,$data){
					print "$id=$data" ;
			}
			
			// generate Album list for the Move panel
			function albumList(){
					global $CONFIG;
					echo "";
					cpg_db_connect();
					$query = "SELECT title FROM {$CONFIG['TABLE_ALBUMS']}" ;
					$albums = cpg_db_fetch_rowset(cpg_db_query($query));
					//$albumStr = "";
					foreach ($albums as $album)
					$albumStr = $albumStr .  $album[0] ."," ;
					
					$albumStr = substr($albumStr,0,$albumStr.length-1);
					varFormat("ids=new&AlbumArray",$albumStr);
			}
			
			
			// find all the Categories and return them
			function getroot(){
					global $CONFIG;
					cpg_db_connect();
					$query = "SELECT cid, name  FROM {$CONFIG['TABLE_CATEGORIES']}";
					$categories = cpg_db_fetch_rowset(cpg_db_query($query));
					echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
					echo "<images>\n";
					foreach ($categories as $category)
					{
							echo "<image>\n" ;
							echo "<i>".$category[0]."</i>\n" ;
							echo "<l>".$category[1]."</l>\n" ; 
							echo "<t>CAT</t>\n";
							echo "<b></b>\n";
							echo "<s></s>\n";
							echo "</image>\n";
					}
					echo "</images>\n";
			}
			
			//find all the albums in a category and produce and XML list 
			function getAlbums($catid){
					
					global $CONFIG;
					cpg_db_connect();
					$query = "SELECT * FROM {$CONFIG['TABLE_ALBUMS']} WHERE category =".$catid ;
					$albums = cpg_db_fetch_rowset(cpg_db_query($query));
					echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
					echo "<images>\n";
					foreach ($albums as $album)
					{
							echo "<image>\n" ;
							echo "<i>".$album[0]."</i>\n" ;
							echo "<l>".$album[1]."</l>\n" ; 
							echo "<t>ALB</t>\n";
							echo "<b></b>\n";
							echo "<s></s>\n";
							echo "</image>\n";
					}
					echo "</images>\n";
			}
			
			// find all the iamges belonging to a certain Album and produce an XML list out of them
			function getImages($albumID){
					global $CONFIG;
					cpg_db_connect();
					$query = "SELECT * FROM {$CONFIG['TABLE_PICTURES']} where aid=".$albumID;
					$images = cpg_db_fetch_rowset(cpg_db_query($query));
					echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
					echo "<images>\n";
					foreach ($images as $image)
					{
							echo "<image>\n";
							echo "<i>".$image[0]."</i>\n";
							echo "<l></l>\n";
							echo "<t>IMG</t>\n";
							echo "<b>".get_pic_url($image)."</b>\n";
							echo "<s>".get_pic_url($image,thumb)."</s>\n";
							//echo "<b>http://rgkdev.net/cpg/".get_pic_url($image)."</b>\n";
							//echo "<s>http://rgkdev.net/cpg/".get_pic_url($image,thumb)."</s>\n";
							echo "</image>\n";
					}
					echo "</images>\n";
			}
			
			
			
			
			// honor the move request and move elements 
			function processMove(){
					$f = fopen("./log.txt",'wb');
					global $superCage;
					$pics2move = $superCage->post->getRAW('picIDs');
					$albumName = $superCage->post->getRAW('albumID');
					
					$picsList = substr($pics2move,0,($pics2move.length-1));
					$picsList = split('p',$picsList);
					// remove the last null value
					array_splice($picsList,$picsList.length -1 ,1);		
					
					//get album ID
					global $CONFIG;
					cpg_db_connect();
					$query = "SELECT aid FROM {$CONFIG['TABLE_ALBUMS']} where  title = UCASE('".$albumName."')";
					$albumId = cpg_db_fetch_rowset(cpg_db_query($query));
					$albumId = $albumId[0][0];
					fwrite($f, "Query" . $query);
					fwrite($f, "Album ID" . $albumId);
					//now lets move the pictures
					foreach ($picsList as $image)
					{
							$query = "UPDATE {$CONFIG['TABLE_PICTURES']} SET aid=$albumId where pid=".$image;
							$result = cpg_db_query($query);
							fwrite($f, "Query" . $result);
					}
				
					fclose($f);
					
			}
			
			function securityCheck(){
					global $superCage;
					global $cpg_udb;
					define('LOGIN_PHP', true);
					if ( $USER_DATA = $cpg_udb->login( $superCage->post->getEscaped('username'), $superCage->post->getEscaped('password'), 0 ) )
					{
							session_start();
							$key = md5(time());
							createKey($key);
							echo $key;
					}
					else
					{
							echo "FAILED";
					
					}	
			}
			
			
			function createKey($key){
					// ping the database and find what the config says
					global $CONFIG;
					cpg_db_connect();
					$query = "SELECT COUNT(*) from {$CONFIG['TABLE_CONFIG']} where name='".$USERID."_flash'";
					$result = cpg_db_fetch_rowset(cpg_db_query($query));
					if($result[0][0] != 0)	
					{
							$sql = "update {$CONFIG['TABLE_CONFIG']} SET value = '". $key . "' where name='".$USERID."_flash'";
							$result = cpg_db_fetch_rowset(cpg_db_query($sql));
					}
					else
					{
							$sql = "insert into {$CONFIG['TABLE_CONFIG']} VALUES ('".$USERID."_flash', '". $key ."')";
							$result = cpg_db_query($sql);
					}
			}
			
			
			function verifyKey($key){
					global $CONFIG;
					cpg_db_connect();
					$query = "SELECT COUNT(*) from {$CONFIG['TABLE_CONFIG']} where name='".$USERID."_flash' and value='" . $key . "'";
					//echo "<br> " . $query ;
					$result = cpg_db_fetch_rowset(cpg_db_query($query));
					//echo "result " . $result[0][0];
					if($result[0][0] != 0)	
					{
						return true;
					}
					else
					{
						return false;
					}
			
			}
			
			
			
			
			$get = Inspekt::makeGetCage();
			
			if ($superCage->get->getRAW('check')==1)
					{
						securityCheck();
						
					}
			
			if(verifykey($superCage->get->getRAW('magik')))
			{
			
					if($superCage->get->getRAW('getalb')==1)  // Pictures from a particular album
					{
						getImages($superCage->get->getRAW('alb'));  
					
					}
					else if ($superCage->get->getRAW('getroot')==1) // get all root categories
					{
						getroot();
					}
					else if ($superCage->get->getRAW('getcat')==1) // get a particular category
					{
						getAlbums($superCage->get->getRAW('cat'));
					}
					else if ($superCage->get->getRAW('albumlisting')==1) // Albumlisting for a given Album
					{
						treeBuilder();
					}
					else if ($superCage->get->getRAW('getimg')==1) // redirects to a particular image
					{
						getimg($superCage->get->getRAW('img'));
					}
					else if ($superCage->get->getRAW('photoinfo')==1) // return information of a particular photograph
					{
						getPhotoInfo($superCage->get->getRAW('photo'));
					}
					else if ($superCage->get->getRAW('albumList')==1) // returns and albumlist
					{
						albumList();
					}
					else if ($superCage->get->getRAW('move')==1) // move a set of photos around albums
					{	
						processMove();
					}
	
					else 
					{
						?>
						<html>
						<body bgcolor="#000000">
						<center>
						<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="1024" height="600" id="player" align="middle">
							<param name="allowScriptAccess" value="sameDomain" />
							<param name="allowFullScreen" value="false" />
							<param name="movie" value="player.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#000000" />	<embed src="player.swf" quality="high" bgcolor="#000000" width="1024" height="600" name="player" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
							</object>
						</center>
						</body>
						</html>
						<?php
					}
			}
}
?>