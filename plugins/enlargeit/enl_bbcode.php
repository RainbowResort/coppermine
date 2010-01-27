<?php
/**************************************************
  Coppermine 1.4.x Plugin - EnlargeIt! $VERSION$=2.15
  *************************************************
  Copyright (c) 2008 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ***************************************************/

define('IN_COPPERMINE', true);
define('DISPLAYIMAGE_PHP', true);
define('INDEX_PHP', true);
//define('SMILIES_PHP', true);

require('include/init.inc.php');
require('./plugins/enlargeit/include/init.inc.php');

if (!USER_ID && $CONFIG['allow_unlogged_access'] == 0) {
    $redirect = $redirect . "login.php";
    header("Location: $redirect");
    exit();
}


$pos = isset($_GET['pos']) ? (int)$_GET['pos'] : 0;
$pid = isset($_GET['pid']) ? (int)$_GET['pid'] : 0;
$cat = isset($_GET['cat']) ? (int)$_GET['cat'] : 0;
$album = isset($_GET['album']) ? $_GET['album'] : '';


//get_meta_album_set in functions.inc.php will populate the $ALBUM_SET instead; matches $META_ALBUM_SET.
get_meta_album_set($cat,$ALBUM_SET);
$META_ALBUM_SET = $ALBUM_SET; //displayimage uses $ALBUM_SET but get_pic_data in functions now uses $META_ALBUM_SET


// Retrieve data for the current picture
if ($pos < 0 || $pid > 0) {
    $pid = ($pos < 0) ? -$pos : $pid;
    $result = cpg_db_query("SELECT aid from {$CONFIG['TABLE_PICTURES']} WHERE pid='$pid' $ALBUM_SET LIMIT 1");
    if (mysql_num_rows($result) == 0) cpg_die(ERROR, $lang_errors['non_exist_ap'], __FILE__, __LINE__);
    $row = mysql_fetch_array($result);
    $album = $row['aid'];
    $pic_data = get_pic_data($album, $pic_count, $album_name, -1, -1, false);
    for($pos = 0; $pic_data[$pos]['pid'] != $pid && $pos < $pic_count; $pos++);
    $pic_data = get_pic_data($album, $pic_count, $album_name, $pos, 1, false);
    $CURRENT_PIC_DATA = $pic_data[0];

} elseif (isset($_GET['pos'])) {
    $pic_data = get_pic_data($album, $pic_count, $album_name, $pos, 1, false);
    if ($pic_count == 0) {
        cpg_die(INFORMATION, $lang_errors['no_img_to_display'], __FILE__, __LINE__);
    } elseif (count($pic_data) == 0 && $pos >= $pic_count) {
        $pos = $pic_count - 1;
        $human_pos = $pos + 1;
        $pic_data = get_pic_data($album, $pic_count, $album_name, $pos, 1, false);
    }
    $CURRENT_PIC_DATA = $pic_data[0];
}

	$fullsize_url = get_pic_url($CURRENT_PIC_DATA);  //here we grab the url to the fullsized pic
	$thumb_url = get_pic_url($CURRENT_PIC_DATA, 'thumb'); //thumb url

  $CURRENT_PIC_DATA['title'] ? $name = $CURRENT_PIC_DATA['title'] : $name = 'No Title'; //chcking if the pic has a title, if not we set it to 'No title'
	$img_url = '[url='.$CONFIG['ecards_more_pic_target'].$fullsize_url.'][IMG]'.$CONFIG['ecards_more_pic_target'].$thumb_url.'[/IMG][/url]';
	$name_url = '[url='.$CONFIG['ecards_more_pic_target'].$fullsize_url.']'.$name.'[/url]';

if (eregi("MSIE",$_SERVER['HTTP_USER_AGENT'])) $isie = 1;

echo '<table cellspacing="1" style="width:100%;height:100%">';
echo '<tr>';
echo '<td colspan="2" class="enl_infotablehead" align="center"><b>BBCode</b><br /></td></tr>';
echo '<tr><td class="enl_infotable" align="center">[url][img][/url]<br /><textarea rows="6" cols="40" style="overflow:off;">'.$img_url.'</textarea>';
if ($isie) echo '<br /><input type="button" value="'.$lang_enlargeit['enl_copytoclipbrd'].'" onclick="window.clipboardData.setData(\'Text\', \''.$img_url.'\');">';
echo '</td></tr>';
echo '<tr><td class="enl_infotable" align="center">[url]title[/url]<br /><textarea rows="3" cols="40" style="overflow:off;">'.$name_url.'</textarea>';
if ($isie) echo '<br /><input type="button" value="'.$lang_enlargeit['enl_copytoclipbrd'].'" onclick="window.clipboardData.setData(\'Text\', \''.$name_url.'\');">';
echo '</td>';
echo '</tr>';
echo '</table>';

ob_end_flush();

?>