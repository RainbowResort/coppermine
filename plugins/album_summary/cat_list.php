<?php

/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2006 Coppermine Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  **********************************************/
/*************************
album_summary plugin 1.0 for Coppermine 1.4.* by Frantz
**************************/
if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');
//require('include/init.inc.php');
$superCage = Inspekt::makeSuperCage();require ('plugins/album_summary/include/init.inc.php');
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"plugins/album_summary/album_summary_css.php\">\n";
$limit=LIMIT;
$rownb=0;
pageheader($lang_plugin_album_summary['name']);
//show the category list
starttable('100%', $lang_plugin_album_summary['cat_name'],$limit);
echo "<tr><td align=\"center\" class=\"tableh2\" colspan={$limit}><b>".$lang_plugin_album_summary['cat_explain']."</b></td></tr>";
echo "<tr>";
$catquery = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_CATEGORIES']} WHERE cid != 1 ORDER BY name ASC ");
while ($catrow = mysql_fetch_array($catquery)){
	$albquery = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_ALBUMS']} WHERE category = '$catrow[cid]' AND visibility = 0 ORDER BY title ASC ");
	$albcount = mysql_num_rows($albquery);
	//if ($albcount >= 1) { //uncomment this line for only showing categories with albums
		$catnum=$catrow['cid'];
		echo "<td align=\"left\">";
		echo "<a title=\"{$lang_plugin_album_summary['category']}$catrow[name]\" href=\"index.php?file=album_summary/cat_list&cat_id={$catnum}&cat_name={$catrow[name]}\">$catrow[name]</a>";
		echo "&nbsp;&nbsp;<span class=\"footer\">(<strong>$albcount</strong>{$lang_plugin_album_summary['albums']})</span></td>";
 		$rownb++;
	//}//uncomment this line for only showing categories with albums	
 	
 	if ($rownb==$limit){
		echo "</tr><tr>";
		$rownb=0;
	}
	mysql_free_result($albquery);	
}
echo "</td>";
echo "</tr>";
endtable();
//show the album list
//if ($_GET['cat_id']<>0){
if ($superCage->get->getInt('cat_id')<>0){
	$albrownb=0;
	$catid=$superCage->get->getInt('cat_id');
	$catname=$superCage->get->getAlnum('cat_name');
	starttable('100%', $lang_plugin_album_summary['alb_name']."<b>".$catname."</b>",$limit);
	echo "<tr><td align=\"center\" class=\"tableh2\" colspan={$limit}><b>".$lang_plugin_album_summary['alb_explain']."</b></td></tr>";
	echo "<tr>";
	$albquery = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_ALBUMS']} WHERE category = '$catid' AND visibility = 0 ORDER BY title ASC ");
	while ($albrow = mysql_fetch_array($albquery)){
		$imgquery = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PICTURES']} WHERE approved = 'yes' AND aid = '$albrow[aid]' ");
		$imagecount = mysql_num_rows($imgquery);
		$albid=$albrow['aid'];
		//if ($imagecount >= 1) {//uncoment this line for only showing albums who contain pics
			echo "<td align=\"left\">";
			echo "<a title=\"{$lang_plugin_album_summary['album']}$albrow[title]\" href=\"index.php?file=album_summary/cat_list&alb_id={$albid}&alb_name={$albrow[title]}&cat_id={$catid}&cat_name={$catname}\">";
			echo "$albrow[title]</a>";
			echo "&nbsp;&nbsp;<span class=\"footer\">(<strong>$imagecount</strong>{$lang_plugin_album_summary['images']})</span>";
			$albrownb++;
 		//}//uncoment this line for only showing albums who contain pics
 		if ($albrownb==$limit){
			echo "</tr><tr>";
			$rownb=0;
		}
	}
	endtable();
	mysql_free_result($albquery);
	mysql_free_result($imgquery);
}
//show pictures title
if ($superCage->get->getInt('alb_id')<>0){
	$picrownb=0;
	$albid=$superCage->get->getInt('alb_id');
	starttable('100%', $lang_plugin_album_summary['alb_name']."<b>".$superCage->get->getAlnum('alb_name')."</b>",$limit);	
	$picquery=cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PICTURES']} WHERE approved = 'yes' AND aid='$albid' ORDER BY title ASC");
	$piccount = mysql_num_rows($picquery);
	if ($piccount>=1){
		echo "<tr><td align=\"center\" class=\"tableh2\" colspan={$limit}><b>".$lang_plugin_album_summary['pic_explain']."</b></td></tr>";
		echo "<tr>";	
		while ($picrow = mysql_fetch_array($picquery)){
			$filesize=($picrow['filesize'] >> 10)." ".$lang_byte_units[1];		
			if ($picrownb==0){
				echo "<tr>";
				echo "<td align=\"left\"><a href=\"displayimage.php?pos=-$picrow[pid]\" title=\"$picrow[title]\"class=\"alb_preview\">$picrow[title]";//display file title
				//css popup contain
            			echo "<span><img border=\"1\" src=\"albums/$picrow[filepath]thumb_$picrow[filename]\" alt=\"$picrow[title]\" title=\"$picrow[title]{$lang_plugin_album_summary['click_view']}\"  />";
            			echo "<br /><b>{$lang_plugin_album_summary[caption]}</b>: {$picrow[caption]}<br />";
            			echo "<b>{$lang_plugin_album_summary[keywords]}</b>: {$picrow[keywords]}<br/>";
            			echo "<b>{$lang_plugin_album_summary[viewed]}</b> {$picrow[hits]}{$lang_plugin_album_summary[times]}<br/>";
            			echo "<b>{$lang_plugin_album_summary[filesize]}</b> {$filesize}<br/>";
            			echo "<b>{$lang_plugin_album_summary[dimensions]}</b> {$picrow[pwidth]}x{$picrow[pheight]}</span></a></td>";
				$picrownb++; 
			}else{
				echo "<td align=\"left\"><a href=\"displayimage.php?pos=-$picrow[pid]\" title=\"$picrow[title]\"class=\"alb_preview\">$picrow[title]";//display file title
				//css popup contain
            			echo "<span><img border=\"1\" src=\"albums/$picrow[filepath]thumb_$picrow[filename]\" alt=\"$picrow[title]\" title=\"$picrow[title]{$lang_plugin_album_summary['click_view']}\"  />";
            			echo "<br /><b>{$lang_plugin_album_summary[caption]}</b>: {$picrow[caption]}<br />";
            			echo "<b>{$lang_plugin_album_summary[keywords]}</b>: {$picrow[keywords]}<br/>";
            			echo "<b>{$lang_plugin_album_summary[viewed]}</b> {$picrow[hits]} {$lang_plugin_album_summary[times]}<br/>";
				echo "<b>{$lang_plugin_album_summary[filesize]}</b> {$filesize}<br/>";
            			echo "<b>{$lang_plugin_album_summary[dimensions]}</b> {$picrow[pwidth]}x{$picrow[pheight]}</span></a></td>";
				$picrownb++;
			}
			if ($picrownb==$limit){
				echo "</tr>";
				$picrownb=0;
			}
		}	
	}else{
		echo "<tr><td align=\"center\"><br/><b>".$lang_plugin_album_summary['nopic']."</b><br/><br/></td></tr>";
	}
	mysql_free_result($picquery);
	endtable();
}
pagefooter();
ob_end_flush();

?>