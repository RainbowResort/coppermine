<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2005 Coppermine Dev Team
  v1.1 originaly written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  ********************************************
  Coppermine version: 1.4.8
  $Source: /cvsroot/cpg-contrib/master_template/codebase.php,v $
  $Revision: 1.3 $
  $Author: donnoman $
  $Date: 2005/12/08 05:46:49 $
**********************************************/
/*************************
fotofreek's mod addapted by Frantz for Coppermine photo_summary plugin
adding image preview with wirefolf css popup window
**************************/
require('include/init.inc.php');
require ('./plugins/keyword_list/include/init.inc.php');
//require('./plugins/keyword_list/include/keyword_function.inc.php');
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"plugins/keyword_list/keyword_css.php\">\n";
/***************************
$rownumber will set the number of keywords to display in a line
$pic_rownumber set the number of pic title to dispaly in a line
change this values according your theme or your wishes 
***************************/
$rownumber=8;
$pic_rownumber=4;
/**************************/

pageheader($lang_plugin_keyword_list['name']);
$album_filter = '';
if($FORBIDDEN_SET){
	$album_filter = ' and ' . str_replace('p.', 'a.', $FORBIDDEN_SET);
}
//begin of displaying keyword list
$nb=0;	
//extract keywords
$result = cpg_db_query("SELECT keywords FROM {$CONFIG['TABLE_PICTURES']} WHERE keywords <> '' $ALBUM_SET");
if (mysql_num_rows($result)) {
  	// Find unique keywords
  	$keywords_array = array();
	while (list($keywords) = mysql_fetch_row($result)) {
      		$array = explode(" ",$keywords);
		foreach($array as $word)
      		{
       			if (!in_array($word = utf_strtolower($word),$keywords_array)) $keywords_array[] = $word;
      			}
  		} 	
  	
	}
// Sort selected keywords
sort($keywords_array);
$count = count($keywords_array);
//display keywords begenning with choosen initial
starttable('100%',$lang_plugin_keyword_list['name'],$rownumber);
echo "<tr><td class=\"tableh2\" align=\"center\" colspan={$rownumber}>".$lang_plugin_keyword_list['choice']."</td></tr>";
for ($i=0;$i< $count;$i++){
	if ($nb==0){	
		echo "<tr>";
		echo "<td ><a href=\"index.php?file=keyword_list/keyword_list&keyword={$keywords_array[$i]}\">{$keywords_array[$i]}</a></td>";
		$nb++;
	}
	else{
		echo"<td ><a href=\"index.php?file=keyword_list/keyword_list&keyword={$keywords_array[$i]}\">{$keywords_array[$i]}</a></td>";
		$nb++;
	}
	if ($nb==$rownumber){
		echo "</tr>";
		$nb=0;
	}	
}
endtable();
//end of displaying keyword list 
//begin display pic title
$keyword=$_GET['keyword'];
if ($keyword<>""){
	starttable('100%',$lang_plugin_keyword_list['pic_list']."<b>".$keyword."</b><i>".$lang_plugin_keyword_list['click_image']."</i>",$pic_rownumber);
	$nb=0;
	$pics = cpg_db_query("SELECT a.pid, a.aid, a.title, a.caption, a.keywords, a.filepath, a.filename, b.title atitle from {$CONFIG['TABLE_PICTURES']} a, {$CONFIG['TABLE_ALBUMS']} b where a.aid = b.aid $album_filter order by a.aid, a.pid desc");
	while ($row = mysql_fetch_array($pics)){
	$keywords_array = array();
	$array = explode(" ",$row['keywords']);
	foreach($array as $word)
      		{
       			if (!in_array($word = utf_strtolower($word),$keywords_array)) $keywords_array[] = $word;
      			}
  		
  	sort($keywords_array);
	$count = count($keywords_array);
	for ($i=0;$i< $count;$i++){
		if ($keywords_array[$i]==$keyword){
			if ($nb==0){
				echo "<tr>";
				echo "<td><a href=\"displayimage.php?pos=-$row[pid]\" title=\"$row[title]\"class=\"summary\">$row[title]";//display file title
            			//css popup contain
            			echo "<span><img border=\"1\" src=\"albums/$row[filepath]thumb_$row[filename]\" alt=\"$row[title]\" title=\"$row[title]{$lang_plugin_keyword_list['click_view']}\"  />";
            			echo "<br /><b>{$lang_plugin_keyword_list[pic_caption]}</b>: {$row[caption]}<br />";
            			echo "<b>{$lang_plugin_keyword_list[keywords]}</b>: {$row[keywords]}</span></a></td>";
				$nb++;
			}else{
				echo  "<td><a href=\"displayimage.php?pos=-$row[pid]\" title=\"$row[title]\"class=\"summary\">$row[title]";//display file title
            			//css popup contain
            			echo "<span><img border=\"1\" src=\"albums/$row[filepath]thumb_$row[filename]\" alt=\"$row[title]\" title=\"$row[title]{$lang_plugin_keyword_list['click_view']}\"  />";
            			echo "<br /><b>{$lang_plugin_keyword_list[pic_caption]}</b>: {$row[caption]}<br />";
            			echo "<b>{$lang_plugin_keyword_list[keywords]}</b>: {$row[keywords]}</span></a></td>";
				$nb++;
			}
			if ($nb==$pic_rownumber){
				echo "</tr>";
				$nb=0;
			}
				
		}
	}	
	}//end while
	endtable;
}
pagefooter(); 
mysql_free_result($result);
mysql_free_result($pics);

ob_end_flush();
?>