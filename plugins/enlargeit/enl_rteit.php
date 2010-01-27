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



$enl_img = isset($_GET['enl_img']) ? $_GET['enl_img'] : 'wurst';

echo '<table cellspacing="1" style="width:100%;height:100%">';
echo '<tr>';
echo '<td colspan="2" class="enl_infotablehead" align="center"><b>'.$lang_rate_pic['rate_this_pic'].'</b><br />';
if ($CURRENT_PIC_DATA['votes'] > 0) echo sprintf($lang_picinfo['Rating'], $CURRENT_PIC_DATA['votes']).': '.round($CURRENT_PIC_DATA['pic_rating'] / 2000,2).'/5';
echo '</td>';
echo '</tr>';
echo '<tr><td class="enl_infotable" width="50%" align="right"><a href="javascript:;" title="'.$lang_rate_pic['great'].'" rel="nofollow"><img width="65" height="14" onclick="enl_ajaxfollow(this);" name="index.php?file=enlargeit/enl_rtepic&amp;pic='.$CURRENT_PIC_DATA['pid'].'&amp;rate=5&amp;enl_img='.$enl_img.'" src="plugins/enlargeit/rating/rating5.gif" border="0" alt="'.$lang_rate_pic['great'].'" /><br /></a></td><td class="enl_infotable" width="50%" align="left">'.$lang_rate_pic['great'].'</td></tr>';
echo '<tr><td class="enl_infotable" width="50%" align="right"><a href="javascript:;" title="'.$lang_rate_pic['excellent'].'" rel="nofollow"><img width="65" height="14" onclick="enl_ajaxfollow(this);" name="index.php?file=enlargeit/enl_rtepic&amp;pic='.$CURRENT_PIC_DATA['pid'].'&amp;rate=4&amp;enl_img='.$enl_img.'" src="plugins/enlargeit/rating/rating4.gif" border="0" alt="'.$lang_rate_pic['excellent'].'" /><br /></a></td><td class="enl_infotable" width="50%" align="left">'.$lang_rate_pic['excellent'].'</td></tr>';
echo '<tr><td class="enl_infotable" width="50%" align="right"><a href="javascript:;" title="'.$lang_rate_pic['good'].'" rel="nofollow"><img width="65" height="14" onclick="enl_ajaxfollow(this);" name="index.php?file=enlargeit/enl_rtepic&amp;pic='.$CURRENT_PIC_DATA['pid'].'&amp;rate=3&amp;enl_img='.$enl_img.'" src="plugins/enlargeit/rating/rating3.gif" border="0" alt="'.$lang_rate_pic['good'].'" /><br /></a></td><td class="enl_infotable" width="50%" align="left">'.$lang_rate_pic['good'].'</td></tr>';
echo '<tr><td class="enl_infotable" width="50%" align="right"><a href="javascript:;" title="'.$lang_rate_pic['fair'].'" rel="nofollow"><img width="65" height="14" onclick="enl_ajaxfollow(this);" name="index.php?file=enlargeit/enl_rtepic&amp;pic='.$CURRENT_PIC_DATA['pid'].'&amp;rate=2&amp;enl_img='.$enl_img.'" src="plugins/enlargeit/rating/rating2.gif" border="0" alt="'.$lang_rate_pic['fair'].'" /><br /></a></td><td class="enl_infotable" width="50%" align="left">'.$lang_rate_pic['fair'].'</td></tr>';
echo '<tr><td class="enl_infotable" width="50%" align="right"><a href="javascript:;" title="'.$lang_rate_pic['poor'].'" rel="nofollow"><img width="65" height="14" onclick="enl_ajaxfollow(this);" name="index.php?file=enlargeit/enl_rtepic&amp;pic='.$CURRENT_PIC_DATA['pid'].'&amp;rate=1&amp;enl_img='.$enl_img.'" src="plugins/enlargeit/rating/rating1.gif" border="0" alt="'.$lang_rate_pic['poor'].'" /><br /></a></td><td class="enl_infotable" width="50%" align="left">'.$lang_rate_pic['poor'].'</td></tr>';
echo '<tr><td class="enl_infotable" width="50%" align="right"><a href="javascript:;" title="'.$lang_rate_pic['rubbish'].'" rel="nofollow"><img width="65" height="14" onclick="enl_ajaxfollow(this);" name="index.php?file=enlargeit/enl_rtepic&amp;pic='.$CURRENT_PIC_DATA['pid'].'&amp;rate=0&amp;enl_img='.$enl_img.'" src="plugins/enlargeit/rating/rating0.gif" border="0" alt="'.$lang_rate_pic['rubbish'].'" /><br /></a></td><td class="enl_infotable" width="50%" align="left">'.$lang_rate_pic['rubbish'].'</td></tr>';
echo '</table>';


ob_end_flush();

?>