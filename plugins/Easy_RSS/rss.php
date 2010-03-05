<?php 
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery - RSS Feed                                      //
// ------------------------------------------------------------------------- //
// Copyright (C) Dr. Tarique Sani                                           //
// http://tariquesani.net/                                                  //
// modifications by versus7 - www.oixalia.gr - oixalia@oixalia.gr //
// further modifications by Brent Gerig
// This program is free software; you can redistribute it and/or modify     //
// it under the terms of the GNU General Public License as published by     //
// the Free Software Foundation; either version 2 of the License, or        //
// (at your option) any later version.                                      //
// ------------------------------------------------------------------------- //
// Just put into the same directory as your coppermine installation         //
// ------------------------------------------------------------------------ //

define('IN_COPPERMINE', true);
define('INDEX_PHP', true);

global $CONFIG,$ALBUM_SET,$META_ALBUM_SET,$CURRENT_CAT_NAME,$FORBIDDEN_SET_DATA,$lang_plugin_easyrss;
require('include/init.inc.php');
require('plugins/easy_rss/include/init.inc.php');

//How many items you want to show in RSS feed
$thumb_per_page = $CONFIG[plugin_easyrss_num];

$thumb_count = 0;
$lower_limit = 0;

if(count($FORBIDDEN_SET_DATA) > 0 ){
    $forbidden_set_string =" AND aid NOT IN (".implode(",", $FORBIDDEN_SET_DATA).")";
} else {
    $forbidden_set_string = '';
}

if(isset($_GET['album'])){
    $album = $_GET['album'];
}

//If it is a numeric album get the name and set variables
if ((is_numeric($album))){
     $album_name_keyword = get_album_name($album);
     $CURRENT_CAT_NAME = $album_name_keyword['title'];
     $META_ALBUM_SET = "AND aid IN (".(int)$_GET['album'].")".$ALBUM_SET;

     //Set the album to last uploaded
     $album = 'lastup';
}

//If the album is not set set it to lastup - this is the default
if(!isset($album)){
     $album = 'lastup';
}


if ((isset($_GET['cat']) && $_GET['cat'] > 0)){ 
     $cat = $_GET['cat'];
     $album_name_keyword = easyrss_get_cat_name($cat);
     $CURRENT_CAT_NAME = $album_name_keyword['name'];
     
     get_meta_album_set($cat,$META_ALBUM_SET);
}


if ((isset($_GET['cat']) && $_GET['cat'] < 0)){ 
     $cat = $_GET['cat'];
     $album_name_keyword = get_album_name(-$cat);
     $CURRENT_CAT_NAME = $album_name_keyword['title'];
     
     $META_ALBUM_SET = "AND aid IN (".-$cat.")".$ALBUM_SET;
}

//Changes these to point to your site if the following is not giving correct results.
$link_url = $CONFIG['ecards_more_pic_target']."displayimage.php?pos=-";
$image_url = $CONFIG['ecards_more_pic_target']."albums/";

$META_ALBUM_SET .= $forbidden_set_string;

$data = get_pic_data($album, $thumb_count, $album_name, $lower_limit, $thumb_per_page);

header ("content-type: text/xml");
//maybe you must change the encoding to iso-8859-1.
$rssHeader = <<<EOT
<?xml version="1.0" encoding="iso-8859-7"?>
<rss version="2.0" 
    xmlns:content="http://purl.org/rss/1.0/modules/content/"
    xmlns:wfw="http://wellformedweb.org/CommentAPI/"
>
<channel>
    <title>$CONFIG[gallery_name]: $CONFIG[gallery_description] - $album_name</title>
    <link>$CONFIG[ecards_more_pic_target]</link>
    <description>$CONFIG[gallery_description] - $album_name</description>
    <generator>$CONFIG[ecards_more_pic_target]rss.php</generator>
EOT;
echo $rssHeader;

foreach($data AS $picture) {

    $titlefield = $CONFIG[plugin_easyrss_titlefield];
    $caption_text = "<br>".$picture[hits]." ".$lang_plugin_easyrss['views'];
    $caption_text .= "<br>".date('M d, Y',$picture[ctime]);
    
    $thumb_url = "$image_url$picture[filepath]$CONFIG[thumb_pfx]$picture[filename]";
    $keywords = explode(" ",trim($picture[keywords]));
    $category_string = "";
    foreach($keywords as $keyword){
         $category_string .= "<category>$keyword</category>";
    }
    $pubDate = gmdate("D, d M Y H:i:s", $picture[ctime]);
    
    $description = '<a href="' . $link_url . $picture['pid'] . '"><img src="' . $thumb_url . '" border="1" vspace="2" hspace="2"> <align="center" ></a><br>';
    if($titlefield == "title")
    	$description .= bb_decode($picture[caption]);
    $description .= bb_decode($caption_text);    
    $description =  htmlspecialchars($description);
     
    $item = '<item>
              <title>'.($picture[$titlefield]?$picture[$titlefield]:$lang_plugin_easyrss['no'].$lang_plugin_easyrss['label_'.$titlefield]).'</title>
              <link>' . $link_url . $picture[pid] . '</link>
              <pubDate>' .$pubDate.' GMT</pubDate>                    
          '.$category_string.'
              <description>'.$description.'</description>           
             </item>';

    echo $item;
}

$rssFooter = <<<EOT
</channel>
</rss>
EOT;
echo $rssFooter;

?>
