<?php
/**************************************************
  Coppermine 1.5.x Plugin - EnlargeIt!
  *************************************************
  Copyright (c) 2009 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  Coppermine version: 1.5.2
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
  **************************************************/

$pid    = $superCage->get->getInt('pid');
$pos    = $superCage->get->getInt('pos');
$cat    = $superCage->get->getInt('cat');
$album  = $superCage->get->getInt('album');
$action = $superCage->get->getAlpha('action');

if ($action == 'image') {

    if (!USER_ID && $CONFIG['allow_unlogged_access'] == 0) {
        cpg_die(ERROR, $lang_errors['access_none'], __FILE__, __LINE__);
    }
	
	function enlargeit_hex2rgb($color){
		$color = ltrim($color, '#');
		$color_array = array();
		$hex_color = strtoupper($color);
		for($i = 0; $i < 6; $i++){
			$hex = substr($hex_color,$i,1);
			switch($hex){
				case "A": $num = 10; break;
				case "B": $num = 11; break;
				case "C": $num = 12; break;
				case "D": $num = 13; break;
				case "E": $num = 14; break;
				case "F": $num = 15; break;
				default: $num = $hex; break;
			}
			array_push($color_array,$num);
		}
		$R = (($color_array[0] * 16) + $color_array[1]);
		$G = (($color_array[2] * 16) + $color_array[3]);
		$B = (($color_array[4] * 16) + $color_array[5]);
		return array($R,$G,$B);
		unset($color_array,$hex,$R,$G,$B);
	} 

    //get_meta_album_set in functions.inc.php will populate the $ALBUM_SET instead; matches $META_ALBUM_SET.
    get_meta_album_set($cat,$ALBUM_SET);
    $META_ALBUM_SET = $ALBUM_SET; //displayimage uses $ALBUM_SET but get_pic_data in functions now uses $META_ALBUM_SET
    
    // Retrieve data for the current picture
    $pid = ($pos < 0) ? -$pos : $pid;
    $result = cpg_db_query("SELECT aid from {$CONFIG['TABLE_PICTURES']} WHERE pid='$pid' $ALBUM_SET LIMIT 1");
    if (mysql_num_rows($result) == 0) cpg_die(ERROR, $lang_errors['non_exist_ap'], __FILE__, __LINE__);
    $row = mysql_fetch_array($result);
    $album = $row['aid'];
    $pic_data = get_pic_data($album, $pic_count, $album_name, -1, -1, false);
    for($pos = 0; $pic_data[$pos]['pid'] != $pid && $pos < $pic_count; $pos++);
    $pic_data = get_pic_data($album, $pic_count, $album_name, $pos, 1, false);
    $CURRENT_PIC_DATA = $pic_data[0];
    
    
    //      Histogram creation
    //      Created by Anton Sparrius (Spaz) 6/9/05  anton_spaz@yahoo.com
    //      Free to use and change, provided you keep these lines :)
    //
    $enl_histpath = $CONFIG['fullpath'].$CURRENT_PIC_DATA['filepath'];
    $enl_histimage = (is_file($enl_histpath.$CONFIG['normal_pfx'].$CURRENT_PIC_DATA['filename'])) ? $CONFIG['normal_pfx'].$CURRENT_PIC_DATA['filename'] : $CURRENT_PIC_DATA['filename']; // Which image to process? The full-sized one or the intermediate
	$extension = ltrim(substr($CURRENT_PIC_DATA['filename'], strrpos($CURRENT_PIC_DATA['filename'], '.')), '.');
	if (in_array($extension, explode('/', $CONFIG['allowed_img_types'])) != TRUE) {
		printf($lang_plugin_enlargeit['not_a_valid_extension'], $extension);
		die;
	}
	$filenameWithoutExtension = str_replace('.' . ltrim(substr($CURRENT_PIC_DATA['filename'], strrpos($CURRENT_PIC_DATA['filename'], '.')), '.'), '', $CURRENT_PIC_DATA['filename']);
    $enl_histfile = "histogram_".$filenameWithoutExtension . '.png'; // The file name for the histogram file (target file)

    if (file_exists($enl_histpath.$enl_histfile)) {
    header('Content-type: image/png');
    readfile ($enl_histpath.$enl_histfile);
    } else {
    $im = imagecreatefromjpeg($enl_histpath.$enl_histimage);
    for($i=0;$i<imagesx($im);$i+=2) {
		for($j=0;$j<imagesy($im);$j++) {
			$rrggbb=imagecolorsforindex ($im, imagecolorat($im,$i,$j));
			$r[$rrggbb['red']]+=1;
			$g[$rrggbb['green']]+=1;
			$b[$rrggbb['blue']]+=1;
		}
    }
    for ($i=0;$i<256;$i++) {
		$max[$i]=($r[$i]+$g[$i]+$b[$i])/3;
    }
    $max_value = max($max)/150;
    $m[0] = max($r);
    $m[1] = max($b);
    $m[2] = max($g);
    $max_rgb = max($m)/150;
	
	
    
    $im_out = imagecreate (284, 164);
    //$background = imagecolorallocate($im_out,100,100,110);
	$boxfill_color_array = enlargeit_hex2rgb($CONFIG['plugin_enlargeit_ajaxcolor']);
	$background = imagecolorallocate($im_out, $boxfill_color_array[0], $boxfill_color_array[1], $boxfill_color_array[2]);
	$box_fill   = imagecolorallocate($im_out, $boxfill_color_array[0], $boxfill_color_array[1], $boxfill_color_array[2]);
    $white = imagecolorallocate($im_out,240,240,240);
    $black = imagecolorallocate($im_out,20,20,20);
    $grey = imagecolorallocate($im_out,200,200,200);
    $red = imagecolorallocate($im_out,255,0,0);
    $green = imagecolorallocate($im_out,0,200,0);
    $blue = imagecolorallocate($im_out,0,0,255);
    $ry=107;
    $gy=107;
    $by=107;
    
    imagefilledrectangle($im_out,13,6,270,158,$box_fill);
    
    for($i=0;$i<256;$i++) {
		imageline($im_out, $i+14, 157, $i+14, 157-($max[$i]/$max_value),$white);
		imageline($im_out, $i+13, $ry, $i+14, 157-($r[$i]/$max_rgb), $red);
		imageline($im_out, $i+13, $gy, $i+14, 157-($g[$i]/$max_rgb), $green);
		imageline($im_out, $i+13, $by, $i+14, 157-($b[$i]/$max_rgb), $blue);
		$ry = 157-($r[$i]/$max_rgb);
		$gy = 157-($g[$i]/$max_rgb);
		$by = 157-($b[$i]/$max_rgb);
    }
    imagepng($im_out,$enl_histpath.$enl_histfile);
    imagedestroy($im);
    imagedestroy($im_out);
    $im=imagecreatefrompng($enl_histpath.$enl_histfile);
    imagedestroy($im);
    header('Content-type: image/png');
    readfile ($enl_histpath.$enl_histfile);
    }
} elseif ($action == 'file') {
    require('./plugins/enlargeit/init.inc.php');
    echo <<< EOT
<table align="center" cellspacing="1" style="width:100%;height:100%">
    <tr>
        <td width="100%" align="center" class="enl_infotablehead">
            <h1>{$lang_plugin_enlargeit['histogram']}</h1>
        </td>
    </tr>
    <tr>
        <td width="100%" align="center" style="background-color:{$CONFIG['plugin_enlargeit_ajaxcolor']}">
            <img border="0" src="index.php?file=enlargeit/histogram&amp;pid={$pid}&amp;action=image" width="284" height="164" alt="" />
        </td>
    </tr>
</table>
EOT;

}
?>