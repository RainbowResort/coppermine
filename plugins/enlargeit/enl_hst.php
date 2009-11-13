<?php
/**************************************************
  Coppermine 1.5.x Plugin - EnlargeIt! $VERSION$=0.4
  *************************************************
  Copyright (c) 2009 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  **************************************************/

define('IN_COPPERMINE', true);
define('DISPLAYIMAGE_PHP', true);
define('INDEX_PHP', true);
define('UPLOAD_PHP', true);

require_once('include/init.inc.php');

if (!USER_ID && $CONFIG['allow_unlogged_access'] == 0) {
    $redirect = $redirect . "login.php";
    header("Location: $redirect");
    exit();
}


$pid = $superCage->get->getInt('pid');
$pos = $superCage->get->getInt('pos');
$cat = $superCage->get->getInt('cat');
$album = $superCage->get->getInt('album');





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


                        
                        $enl_histpath = 'albums/'.$CURRENT_PIC_DATA['filepath'];
                        $enl_histimage = (is_file($enl_histpath.'normal_'.$CURRENT_PIC_DATA['filename'])) ? 'normal_'.$CURRENT_PIC_DATA['filename'] : $CURRENT_PIC_DATA['filename'];
                        $enl_histfile="hist_".substr($enl_histimage,0,strlen($enl_histimage)-4).".png";
                        //echo "path: ".$enl_histpath." image: ".$enl_histimage." hist_file: ".$enl_histfile;
                        if (file_exists('plugins/enlargeit/histcache/'.$pid.$enl_histfile)) {
                        header('Content-type: image/png');
                        readfile ('plugins/enlargeit/histcache/'.$pid.$enl_histfile);
                        } else {
                        $im=imagecreatefromjpeg($enl_histpath.$enl_histimage);
                        for($i=0;$i<imagesx($im);$i+=2)
                        {
                                for($j=0;$j<imagesy($im);$j++)
                                {
                                        $rrggbb=imagecolorsforindex ($im, imagecolorat($im,$i,$j));
                                        $r[$rrggbb['red']]+=1;
                                        $g[$rrggbb['green']]+=1;
                                        $b[$rrggbb['blue']]+=1;
                                }
                        }
                        for ($i=0;$i<256;$i++)
                        {
                                $max[$i]=($r[$i]+$g[$i]+$b[$i])/3;
                        }
                        $max_value=max($max)/150;
                        $m[0]=max($r);
                        $m[1]=max($b);
                        $m[2]=max($g);
                        $max_rgb=max($m)/150;

                        $im_out = imageCreate (284, 164);
                        $background = imageColorAllocate($im_out,100,100,110);
                        $box_fill   = imageColorAllocate($im_out,130,130,140);
                        $white=ImageColorAllocate($im_out,240,240,240);
                        $black=ImageColorAllocate($im_out,20,20,20);
                        $grey=ImageColorAllocate($im_out,200,200,200);
                        $red=ImageColorAllocate($im_out,255,0,0);
                        $green=ImageColorAllocate($im_out,0,200,0);
                        $blue=ImageColorAllocate($im_out,0,0,255);
                        $ry=107;
                        $gy=107;
                        $by=107;

                        imageFilledRectangle($im_out,13,6,270,158,$box_fill);

                        for($i=0;$i<256;$i++)
                        {
                                imageLine($im_out, $i+14, 157, $i+14, 157-($max[$i]/$max_value),$white);
                                imageLine($im_out, $i+13, $ry, $i+14, 157-($r[$i]/$max_rgb), $red);
                                imageLine($im_out, $i+13, $gy, $i+14, 157-($g[$i]/$max_rgb), $green);
                                imageLine($im_out, $i+13, $by, $i+14, 157-($b[$i]/$max_rgb), $blue);
                                $ry=157-($r[$i]/$max_rgb);
                                $gy=157-($g[$i]/$max_rgb);
                                $by=157-($b[$i]/$max_rgb);
                        }
                        imagePNG($im_out,'plugins/enlargeit/histcache/'.$pid.$enl_histfile);
                        imageDestroy($im);
                        imagedestroy($im_out);
                        $im=imagecreatefromPNG('plugins/enlargeit/histcache/'.$pid.$enl_histfile);
                        imagedestroy($im);
                        header('Content-type: image/png');
                        readfile ('plugins/enlargeit/histcache/'.$pid.$enl_histfile);
                        }

?>