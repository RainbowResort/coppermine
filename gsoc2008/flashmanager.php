
<?php


//	define('SHOWTHUMB_PHP', true);


	//BYPASS Inspekt to make upload work
	if($_GET['upload']==1){

	//if (isset($superCage->server->getRAW('HTTP_RAW_POST_DATA'))
	print "image id ".$_GET['fileid'];
	$img_id = $_GET['fileid'];
	$img_savetype = $_GET['savetype'];
	$jpg = $GLOBALS["HTTP_RAW_POST_DATA"]; ;
	$size_x = $_GET['size_x'];
	$size_y = $_GET['size_y'];
// add headers for download dialog-box
//	header('Content-Type: image/jpeg');
//	header('Content-Disposition: attachment; filename='.$superCage->get->getRAW('filename'));
//	echo $jpg;
	
// save image to a temporary location
	$f = fopen("./albums/snapshot.jpg", 'wb');
	fwrite($f, $jpg);
	fclose($f);

	if ($img_savetype == 3)
	print "DONE 1";

	if ($img_savetype == 1 || $img_savetype == 2){
	print "\n inside IF ... savetype =1 or 2? ";
	//connect to the database get the filepath

	define('IN_COPPERMINE', true);	
	require('include/init.inc.php');

//	require('include/picmgmt.inc.php');

	global $CONFIG;
	cpg_db_connect();
	$query = "SELECT * FROM {$CONFIG['TABLE_PICTURES']} where pid=".$img_id ;
	$image = cpg_db_fetch_rowset(cpg_db_query($query));
	$image = $image[0];
	// REPLACE OPTION --- OVERWRITE FILE
	if ($img_savetype  == 1 ){
	print "\n inside IF ... savetype =1 or 2? ";
	copy('./albums/snapshot.jpg', './albums/'.$image[2].$image[3]); 
	print "DONE 2 " . './albums/'.$image[2].$image[3];
	}
	else if($img_savetype  == 2){
	//save it with a new name in the album Directory with currentdate prefix
	//require('include/functions.inc.php');
	$siz_e = cpg_getimagesize('./albums/snapshot.jpg', true);
	echo "\n".$siz_e ; 
	$file_name = date("Ymdgi").$image[3];
	rename('./albums/snapshot.jpg', './albums/'.$image[2].$file_name); 
	print "\n file name : ".$file_name;
	//copy entires into the database
	// All fields are duplicated except the id field, which
	// is auto-incremented to the next available value.
	//cpg_db_connect();	
	$sql = 	"SELECT * FROM {$CONFIG['TABLE_PICTURES']} where pid=".$img_id ;
	print "\n".$sql ;

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
	print "SQL QUERY LOOKS LIKE :\n".$sql."\n\n";
	
	$image_path = "./" . $image['filepath'] . $file_name;
    $thumb = "./".$image['filepath'] . $CONFIG['thumb_pfx'] . $file_name;
	print "\nIMG URL ".$image_path;
	print "\n THUMB URL ".$thumb ;
	define('UTIL_PHP', true);
	require('include/picmgmt.inc.php');
	$bool = resize_image($image, $thumb, $CONFIG['thumb_width'], $CONFIG['thumb_method'], $CONFIG['thumb_use'], "false", 1);
    print "\nRESIZED ? : ". $bool. " ?";
	print "DONE";

	$result = cpg_db_query($sql);
	}
}
}	

}
else {

define('IN_COPPERMINE', true);
require('include/init.inc.php');
$input = Inspekt::makeSuperCage();  
//require('include/functions.inc.php');
//echo "we will have xml here shortly :) with images and stuff .. wow :) ";

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
varFormat("&AlbumArray",$albumStr);

}

function varFormat($id,$data){
print "$id=$data" ;
}

function albumList(){
global $CONFIG;
cpg_db_connect();
$query = "SELECT title FROM {$CONFIG['TABLE_ALBUMS']}" ;
$albums = cpg_db_fetch_rowset(cpg_db_query($query));
$albumStr = "";
foreach ($albums as $album)
$albumStr = $albumStr . "," . $album[0] ;

$albumStr = substr($albumStr,1,$albumStr.length-1);
varFormat("AlbumArray",$albumStr);


}


function getImagepath($image_id){
cpg_db_connect();
$query = "SELECT cid, name, thumb FROM {$CONFIG['TABLE_CATEGORIES']} WHERE parent=0";

}


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
	//	echo "<b>http://rgkdev.net/cpg/".get_pic_url($image)."</b>\n";
	//	echo "<s>http://rgkdev.net/cpg/".get_pic_url($image,thumb)."</s>\n";
		echo "</image>\n";
}
echo "</images>\n";
}






$get = Inspekt::makeGetCage();
if($superCage->get->getRAW('getalb')==1)  // Pictures from a particular album
getImages($superCage->get->getRAW('alb'));  
else if ($superCage->get->getRAW('getroot')==1) // get all root categories
getroot();
else if ($superCage->get->getRAW('getcat')==1) // get a particular category
getAlbums($superCage->get->getRAW('cat'));
else if ($superCage->get->getRAW('albumlisting')==1)
treeBuilder();
else if ($superCage->get->getRAW('getimg')==1)
getimg($superCage->get->getRAW('img'));
else if ($superCage->get->getRAW('photoinfo')==1)
getPhotoInfo($superCage->get->getRAW('photo'));
else if ($superCage->get->getRAW('albumList')==1)
albumList();


else 
{
?>
<html>
<body bgcolor="#000000">
<center>
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="1024" height="600" id="player" align="middle">
	<param name="allowScriptAccess" value="sameDomain" />
	<param name="allowFullScreen" value="false" />
	<param name="movie" value="player.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#000000" />	<embed src="player.swf" quality="high" bgcolor="#0000000" width="1024" height="600" name="player" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
	</object>
    </center>
</body>
</html>


<?php
}
}

?>