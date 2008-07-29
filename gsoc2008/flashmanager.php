<?php
if($_GET['filename']=='snapshot.jpg'){

//if (isset($superCage->server->getRAW('HTTP_RAW_POST_DATA'))
{

echo $GLOBALS["HTTP_RAW_POST_DATA"];
echo  $HTTP_RAW_POST_DATA;
echo "CALLED " ;
	// get bytearray
	$jpg = $GLOBALS["HTTP_RAW_POST_DATA"]; ;//$superCage->server->getRAW('HTTP_RAW_POST_DATA') ;//$GLOBALS["HTTP_RAW_POST_DATA"];

	// add headers for download dialog-box
//	header('Content-Type: image/jpeg');
//	header('Content-Disposition: attachment; filename='.$superCage->get->getRAW('filename'));
//	echo $jpg;
	
		// save image
	$f = fopen("./albums/snapshot.jpg"/*$_GET['filename']*/, 'wb');
	fwrite($f, $jpg);
	fclose($f);
	
	echo "Written";

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





//echo "SELECT cid, name, thumb FROM {$CONFIG['TABLE_CATEGORIES']} WHERE parent = 0";
//echo $CONFIG['TABLE_CATEGORIES'];
//getRootCategory();

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