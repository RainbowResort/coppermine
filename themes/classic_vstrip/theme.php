<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2009 Coppermine Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.
  
  ********************************************
  Coppermine version: 1.5.2
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/trunk/cpg1.5.x/themes/classic_vstrip/theme.php $
  $Revision: 6360 $
  $LastChangedBy: gaugau $
  $Date: 2009-07-24 08:26:16 +0200 (Fr, 24 Jul 2009) $
**********************************************/

// ------------------------------------------------------------------------- //
// This theme has all CORE items removed                                     //
// ------------------------------------------------------------------------- //

define('THEME_HAS_MENU_ICONS', 16);
define('THEME_HAS_FILM_STRIP_GRAPHIC', 1); 

// HTML template for filmstrip display
$template_film_strip = <<<EOT
<table style="background-color:#000000;"><tr><td class="filmstrip_background" style="overflow-y: hidden; background-image: url({TILE1});"><img src="{TILE1}" alt="" border="0" style="visibility:hidden;" /></td>
                   <td><table>
                     <tr>
                       <td class="prev_strip"></td>
                     </tr>
                     <tr>
                       <td valign="bottom"  style="{THUMB_TD_STYLE}" class="filmstrip_background" height="100%">
                       <div id="film"><table class="tape">{THUMB_STRIP}</table></div>
                       </td>
                     </tr>
                   <tr>
                     <td class="next_strip"></td>
                   </tr>
                  </table></td>
 
          <td class="filmstrip_background" style="background-image: url({TILE1});"><img src="{TILE1}" alt="" border="0" style="visibility:hidden;" /></td>
        </tr>        
</table>

<!-- BEGIN thumb_cell -->
                <tr><td class="thumb" style="height:{$CONFIG['thumb_width']}px;vertical-align: middle; text-align: center;">
                  <a href="{LINK_TGT}" class="thumbLink" style="{ONE_WIDTH}">{THUMB}</a>
                </td></tr>
<!-- END thumb_cell -->
<!-- BEGIN empty_cell -->
                <tr><td valign="top" align="center" >&nbsp;</td></tr>
<!-- END empty_cell -->

EOT;


// HTML template for intermediate image display
$template_display_media = <<<EOT
        <tr>
                <td align="center" class="display_media" nowrap="nowrap">
                        <table width="100%" cellspacing="0" cellpadding="0">
                                <tr>
                                        <td align="center" style="{SLIDESHOW_STYLE}">
                                                {IMAGE}
                                        </td>
                                </tr>
                        </table>
                </td>
            </tr>
            <tr>
                <td>
                        <table width="100%" cellspacing="2" cellpadding="0" class="tableb tableb_alternate">
                                        <tr>
                                                <td align="center">
                                                        {ADMIN_MENU}
                                                </td>
                                        </tr>
                        </table>


<!-- BEGIN img_desc -->
                        <table cellpadding="0" cellspacing="0" class="tableb tableb_alternate" width="100%">
<!-- BEGIN title -->
                                <tr>
                                        <td class="tableb tableb_alternate"><h1 class="pic_title">
                                                {TITLE}
                                        </h1></td>
                                </tr>
<!-- END title -->
<!-- BEGIN caption -->
                                <tr>
                                        <td class="tableb tableb_alternate"><h2 class="pic_caption">
                                                {CAPTION}
                                        </h2></td>
                                </tr>
<!-- END caption -->
                        </table>
<!-- END img_desc -->
                </td>
        </tr>

EOT;


// Function to display the film strip
function theme_display_film_strip(&$thumb_list, $nbThumb, $album_name, $aid, $cat, $pos, $sort_options, $mode = 'thumb', $date='', $filmstrip_prev_pos, $filmstrip_next_pos,$max_block_items,$thumb_width)
{
    global $CONFIG, $THEME_DIR;
    global $template_film_strip, $lang_film_strip, $lang_common, $pic_count,$mar_pic;

    $superCage = Inspekt::makeSuperCage();

    static $template = '';
    static $thumb_cell = '';
    static $empty_cell = '';
    static $spacer = '';

    if (defined('THEME_HAS_FILM_STRIP_GRAPHIC')) { set_js_var('vertstrip', 1); }

    if ((!$template)) {
        $template = $template_film_strip;
        $thumb_cell = template_extract_block($template, 'thumb_cell');
        $empty_cell = template_extract_block($template, 'empty_cell');
    }

    $cat_link = is_numeric($aid) ? '' : '&amp;cat=' . $cat;
    $date_link = $date=='' ? '' : '&amp;date=' . $date;

    if ($superCage->get->getInt('uid')) {
        $uid_link = '&amp;uid=' . $superCage->get->getInt('uid');
    } else {
        $uid_link = '';
    }

    $i = 0;
    $thumb_strip = '';
    foreach($thumb_list as $thumb) {
        $i++;
        if ($mode == 'thumb') {
            if ($thumb['pos'] == $pos && !$superCage->get->keyExists('film_strip')) {
                    $thumb['image'] = str_replace('class="image"', 'class="image middlethumb"', $thumb['image']);
            }
            // determine if thumbnail link targets should open in a pop-up
            if ($CONFIG['thumbnail_to_fullsize'] == 1) { // code for full-size pop-up
                if (!USER_ID && $CONFIG['allow_unlogged_access'] <= 2) {
                    $target = 'javascript:;" onclick="alert(\''.sprintf($lang_errors['login_needed'],'','','','').'\');';
                } elseif (USER_ID && USER_ACCESS_LEVEL <= 2) {
                    $target = 'javascript:;" onclick="alert(\''.sprintf($lang_errors['access_intermediate_only'],'','','','').'\');';
                } else {
                    $target = 'javascript:;" onclick="MM_openBrWindow(\'displayimage.php?pid=' . $thumb['pid'] . '&fullsize=1\',\'' . uniqid(rand()) . '\',\'scrollbars=yes,toolbar=no,status=no,resizable=yes,width=' . ((int)$thumb['pwidth']+(int)$CONFIG['fullsize_padding_x']) .  ',height=' .   ((int)$thumb['pheight']+(int)$CONFIG['fullsize_padding_y']). '\');';
                }
            } elseif ($aid == 'lastcom' || $aid == 'lastcomby') {
                $page = cpg_get_comment_page_number($thumb['msg_id']);
                $page = (is_numeric($page)) ? "&amp;page=$page" : '';
                $target = "displayimage.php?album=$aid$cat_link$date_link&amp;pid={$thumb['pid']}$uid_link&amp;msg_id={$thumb['msg_id']}$page#comment{$thumb['msg_id']}";
            } else {
                $target = "displayimage.php?album=$aid$cat_link$date_link&amp;pid={$thumb['pid']}$uid_link#top_display_media";
            }
            $params = array(
                '{LINK_TGT}' => $target,
                '{THUMB}' => $thumb['image'],
                '{ONE_WIDTH}'  => "width:".$thumb_width."px; float: left" ,
                );
        } else {
            $params = array(
                '{LINK_TGT}' => "index.php?cat={$thumb['cat']}",
                '{THUMB}' => $thumb['image'],
                '{ONE_WIDTH}'  => "width:".$thumb_width."px; float: left" ,
                );
        }
        $thumb_strip .= template_eval($thumb_cell, $params);
    }

    if (defined('THEME_HAS_FILM_STRIP_GRAPHICS')) {
        $tile1 = $THEME_DIR . 'images/tile1.gif';
        $tile2 = $THEME_DIR . 'images/tile2.gif';
    } elseif (defined('THEME_HAS_FILM_STRIP_GRAPHIC')) {
        $tile1=$tile2=$THEME_DIR . 'images/tile.gif';
    } else {
        $tile1=$tile2= 'images/tile.gif';
    }

    if (defined('THEME_HAS_NAVBAR_GRAPHICS')) {
        $location = $THEME_DIR;
    } else {
        $location= '';
    }
    $max_itme_width_ul = $max_block_items;
    if(($max_block_items%2)==0){
        $max_itme_width_ul = $max_block_items +1;
    }
    $set_width_to_film = "width:".($max_block_items*($thumb_width+4))."px; position:relative;";

    $params = array('{THUMB_STRIP}' => $thumb_strip,
        '{COLS}' => $i,
        '{TILE1}' => $tile1,
        '{TILE2}' => $tile2,
        '{SET_WIDTH}'  => $set_width_to_film,
        );

    ob_start();
    echo '<div id="filmstrip">';
    if (!defined('THEME_HAS_FILM_STRIP_GRAPHIC')) { starttable($CONFIG['picture_table_width']); }
    echo template_eval($template, $params);
    if (!defined('THEME_HAS_FILM_STRIP_GRAPHIC')) { endtable(); }
    echo '</div>';
    $film_strip = ob_get_contents();
    ob_end_clean();

    return $film_strip;
}


function theme_display_image($nav_menu, $picture, $votes, $pic_info, $comments, $film_strip)
{
    global $CONFIG, $LINEBREAK;

    $superCage = Inspekt::makeSuperCage();

    $width = $CONFIG['picture_table_width'];

    echo '<a name="top_display_media"></a>'; // set the navbar-anchor
    starttable();
    echo $nav_menu;
    endtable();

    starttable();

    if ($CONFIG['display_film_strip'] == 1) {
    echo "<tr><td width='200' class='tableb' valign='middle' ><!-- gb before film_strip -->";
          echo $film_strip;
    echo "</td><!-- gb after film_strip -->";
    }

    echo "<td height='100%'><table width='100%'><!-- gb before picture -->";    
    echo $picture;
    echo "</table></td></tr><!-- gb after picture -->";
    endtable();


    echo $votes;

    $picinfo = $superCage->cookie->keyExists('picinfo') ? $superCage->cookie->getAlpha('picinfo') : ($CONFIG['display_pic_info'] ? 'block' : 'none');
    echo $LINEBREAK . '<div id="picinfo" style="display: '.$picinfo.';">' . $LINEBREAK;
    starttable();
    echo $pic_info;
    endtable();
    echo '</div>' . $LINEBREAK;

    echo '<a name="comments_top"></a>';
    echo '<div id="comments">' . $LINEBREAK;
    echo $comments;
    echo '</div>' . $LINEBREAK;

}



?>