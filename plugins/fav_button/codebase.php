<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2008 Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  Coppermine version: 1.5.0
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**********************************************/
/*********************************************
  Coppermine Plugin - Favorite Button
  ********************************************
  Copyright (c) 2009 eenemeenemuu
**********************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

if (defined('DISPLAYIMAGE_PHP')) {
    $thisplugin->add_filter('theme_img_navbar','fav_button');
}

function fav_button($template_img_navbar) {
    global $CURRENT_PIC_DATA, $FAVPICS, $REFERER, $lang_picinfo;

    $ref = $REFERER ? "&amp;referer=$REFERER" : '';
    $fav_tgt = "addfav.php?pid={$CURRENT_PIC_DATA['pid']}".$ref."#top_display_media";

    if (!in_array($CURRENT_PIC_DATA['pid'], $FAVPICS)) {
        $fav_title = $lang_picinfo['addFav'];
        $fav_icon = "icons/top_rated.png";
    } else {
        $fav_title = $lang_picinfo['remFav'];
        $fav_icon = "icons/cancel.png";
    }

    $fav_button = '
        <td align="center" valign="middle" class="navmenu" width="48">
            <a href="'.$fav_tgt.'" class="navmenu_pic" title="'.$fav_title.'"><img src="{LOCATION}images/'.$fav_icon.'" border="0" align="middle" alt="'.$fav_title.'" /></a>
        </td>
    ';

    $template_img_navbar = str_replace("<!-- BEGIN nav_prev -->", $fav_button."<!-- BEGIN nav_prev -->", $template_img_navbar);

    return $template_img_navbar;
}

?>
