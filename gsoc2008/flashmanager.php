<?php
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
/* echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n"; */
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
/* echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n"; */
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
if($superCage->get->getRAW('getalb')==1)
getImages($superCage->get->getRAW('alb'));
else if ($superCage->get->getRAW('getroot')==1)
getroot();
else if ($superCage->get->getRAW('getcat')==1)
getAlbums($superCage->get->getRAW('cat'));
else
{
?>
<html>
<body bgcolor="#000000">
<center>
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="1024" height="600" id="player" align="middle">
	<param name="allowScriptAccess" value="sameDomain" />
	<param name="allowFullScreen" value="false" />
	<param name="movie" value="player.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" />	<embed src="player.swf" quality="high" bgcolor="#0000000" width="1024" height="600" name="player" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
	</object>
    </center>
</body>
</html>


<?php
}

?>