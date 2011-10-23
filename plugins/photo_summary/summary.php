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
Version 2.1
**************************/

//require('include/init.inc.php');
require ('plugins/photo_summary/include/init.inc.php');
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"plugins/photo_summary/summary_css.php\">\n";
/***************************
$rownumber will set the row number of picture title to display, 
change this value according your theme or yout wishes (default 3 rows)
***************************/
$rownumber=3;

/*************************/
pageheader($lang_plugin_photo_summary['name']);
$album_filter = '';
if($FORBIDDEN_SET){
	$album_filter = ' and ' . str_replace('p.', 'a.', $FORBIDDEN_SET);
}
$result = cpg_db_query("SELECT a.pid, a.aid, a.title, a.caption,a.owner_id, a.keywords, a.filepath, a.filename, b.title atitle from {$CONFIG['TABLE_PICTURES']} a, {$CONFIG['TABLE_ALBUMS']} b where a.aid = b.aid $album_filter order by b.title,a.title,a.aid, a.pid desc");

if (!mysql_num_rows($result)) cpg_die(ERROR, $lang_errors['non_exist_ap']);

$p_aid = -1 ;
$i=0;
// Result to table
starttable("100%", $lang_plugin_photo_summary['name'], $rownumber);

   while ($row = mysql_fetch_array($result)) 
        { 
                if ($row[aid] != $p_aid) {
                  // Display Album title
                  $atitle=$lang_plugin_photo_summary['pic_title']."<i>".$row['atitle']."</i>";
                  echo "<tr><td class=\"tableh2\" colspan = \"$rownumber\"><b>$atitle</b> {$lang_plugin_photo_summary[click_image]}</td></tr>" ;
            	  
            }
            //Display picture title
            if ($i==0){
            	echo "<tr>";
            echo "<td><a href=\"displayimage.php?pos=-$row[pid]\" title=\"$row[title]\"class=\"summary\">$row[title]";//display file title
            //css popup contain
           echo "<span><img border=\"1\" src=\"albums/$row[filepath]thumb_$row[filename]\" alt=\"$row[title]\" title=\"$row[title]{$lang_plugin_photo_summary['click_view']}\"  />";
            echo "<br /><b>{$lang_plugin_photo_summary[pic_caption]}</b>: {$row[caption]}<br />";
            echo "<b>{$lang_plugin_photo_summary[keywords]}</b>: {$row[keywords]}</span></a></td>";
            $i++;
            }
            else{
            echo "<td><a href=\"displayimage.php?pos=-$row[pid]\" title=\"$row[title]\"class=\"summary\">$row[title]";//display file title
            //css popup contain
            echo "<span><img border=\"1\" src=\"albums/$row[filepath]thumb_$row[filename]\" alt=\"$row[title]\" title=\"$row[title]{$lang_plugin_photo_summary['click_view']}\"  />";
            echo "<br /><b>{$lang_plugin_photo_summary[pic_caption]}</b>: {$row[caption]}<br />";
            echo "<b>{$lang_plugin_photo_summary[keywords]}</b>: {$row[keywords]}</span></a></td>";
            $i++;
            if ($i==$rownumber){
            	echo "</tr>";
            	
            	$i=0;}
            
            }
       $p_aid = $row[aid] ;
    } ; // while    
endtable();  
pagefooter();
mysql_free_result($result);

ob_end_flush();
?>