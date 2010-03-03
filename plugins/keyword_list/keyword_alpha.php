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

//display alphabetic search menu
starttable('100%', $lang_plugin_keyword_list['alpha_search'], 26);
		echo '<tr>';
		foreach (range('A', 'Z') as $letter){
			$Sletter=$letter;
			echo '<td width="'.(100/26).'%" align="center"><b><a href="index.php?file=keyword_list/keyword_alpha&letter='.$letter.'">'.$letter.'</a></b></td>';
		}
		echo '</tr>';
endtable();
//Display keywords with selected initial
if (!$_GET['letter']){	
	$Sletter="A";
} 
else{
	$Sletter=$_GET['letter'];
}
starttable('100%',$lang_plugin_keyword_list['initial'].$Sletter,$pic_rownumber);
//begin of displaying keyword list
$nb=0;
$initial=utf_strtolower($Sletter);	
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

$n=0;
for ($i=0;$i< $count;$i++){
	if (substr($keywords_array[$i],0,1)==$initial){	
		echo "<tr><td class=\"tableh2\" colspan={$pic_rownumber}><b>$keywords_array[$i]</b><i>$lang_plugin_keyword_list[click_image]</i></td></tr>";
		$n++;
		//display pic title
		$nb=0;
		$pics = cpg_db_query("SELECT a.pid, a.aid, a.title, a.caption, a.keywords, a.filepath, a.filename, b.title atitle from {$CONFIG['TABLE_PICTURES']} a, {$CONFIG['TABLE_ALBUMS']} b where a.aid = b.aid $album_filter  order by  a.pid desc");
		while ($row = mysql_fetch_array($pics)){
			$keysearch_array = array();
			$searcharray = explode(" ",$row['keywords']);
			foreach($searcharray as $word)
      				{
       				if (!in_array($word = utf_strtolower($word),$keysearch_array)) $keysearch_array[] = $word;
      				}//end foreach($searcharray as $word)
  		
  			sort($keysearch_array);
			$searchcount = count($keysearch_array);
			for ($j=0;$j< $searchcount;$j++){
				if ($keysearch_array[$j]==$keywords_array[$i]){
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
				
				}//end if ($keysearch_array[$j]==$keywords_array[$i])
			}//end for ($j=0;$j< $searchcount;$j++)
		}//end while ($row = mysql_fetch_array($pics))
	}//end (substr($keywords_array[$i],0,1)==$initial)	
}//end for ($i=0;$i< $count;$i++)
if ($n==0){
	echo "<tr><td><b>".$lang_plugin_keyword_list['no_word']."</td></tr>";
}
endtable();


pagefooter();
mysql_free_result($result);
mysql_free_result($pics);

ob_end_flush();
?>