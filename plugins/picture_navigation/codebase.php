<?php
/**************************************************
  Coppermine 1.5.x Plugin - picture_navigation
  *************************************************
  Copyright (c) 2009-2010 eenemeenemuu
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
  **************************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

if (defined('DISPLAYIMAGE_PHP')) {
    $thisplugin->add_filter('html_image_reduced_overlay', 'picture_navigation');
    $thisplugin->add_filter('html_image_reduced', 'picture_navigation');
    $thisplugin->add_filter('html_image_overlay', 'picture_navigation');
    $thisplugin->add_filter('html_image', 'picture_navigation');
}

function picture_navigation($pic_html) {
    global $album, $cat, $pos, $CONFIG, $CURRENT_PIC_DATA, $pic_data, $CPG_PHP_SELF, $pic_count;

    $superCage = Inspekt::makeSuperCage();

    $cat_link = is_numeric($album) ? '' : '&amp;cat=' . $cat;
    //$date_link = $_GET['date']=='' ? '' : '&date=' . cpgValidateDate($_GET['date']);

    if ($superCage->get->keyExists('date')) {
      //date will be validated
      $date_link = '&date=' . cpgValidateDate($superCage->get->getRaw('date'));
    } else {
      $date_link = '';
    }

    //$uid_link = is_numeric($_GET['uid']) ? '&amp;uid=' . $_GET['uid'] : '';
    if ($superCage->get->getInt('uid')) {
        $uid_link = '&amp;uid=' . $superCage->get->getInt('uid');
    } else {
        $uid_link = '';
    }

    $page = ceil(($pos + 1) / ($CONFIG['thumbrows'] * $CONFIG['thumbcols']));
    $pid = $CURRENT_PIC_DATA['pid'];
    $msg_id = ($album == 'lastcom' || $album == 'lastcomby') ? "&amp;msg_id={$pic_data[$pos]['msg_id']}&amp;page=$page" : '';

    if ($pos > 0) {
        $prev = $pos - 1;
        //$prev_tgt = "{$_SERVER['PHP_SELF']}?album=$album$cat_link&amp;pos=$prev$uid_link";// Abbas - added pid in URL instead of pos
        if ($album == 'lastcom' || $album == 'lastcomby') {
            $page = cpg_get_comment_page_number($pic_data[$prev]['msg_id']);
            $page = (is_numeric($page)) ? "&amp;page=$page" : '';
            $prev_tgt = "$CPG_PHP_SELF?album=$album$cat_link$date_link&amp;pid={$pic_data[$prev]['pid']}$uid_link&amp;msg_id={$pic_data[$prev]['msg_id']}$page#comment{$pic_data[$prev]['msg_id']}";
        } else {
            $prev_tgt = "$CPG_PHP_SELF?album=$album$cat_link$date_link&amp;pid={$pic_data[$prev]['pid']}$uid_link#top_display_media";
        }
    } else {
        // on first image, so no previous button/link
        $prev_tgt = "javascript:;";
    }

    if ($pos < ($pic_count -1)) {
        $next = $pos + 1;
        //$next_tgt = "{$_SERVER['PHP_SELF']}?album=$album$cat_link&amp;pos=$next$uid_link";// Abbas - added pid in URL instead of pos
        if ($album == 'lastcom' || $album == 'lastcomby') {
            $page = cpg_get_comment_page_number($pic_data[$next]['msg_id']);
            $page = (is_numeric($page)) ? "&amp;page=$page" : '';
            $next_tgt = "$CPG_PHP_SELF?album=$album$cat_link$date_link&amp;pid={$pic_data[$next]['pid']}$uid_link&amp;msg_id={$pic_data[$next]['msg_id']}$page#comment{$pic_data[$next]['msg_id']}";
        } else {
            $next_tgt = "$CPG_PHP_SELF?album=$album$cat_link$date_link&amp;pid={$pic_data[$next]['pid']}$uid_link#top_display_media";
        }
    } else {
        // on last image, so no next button/link
        $next_tgt = "javascript:;";
    }

    /***************************************
      The above code has been copied from theme_html_img_nav_menu()
      Now the main plugin code begins
      ***************************************/

    $buttons = '';
    if ($prev_tgt != 'javascript:;') {
        $buttons = '<div onclick="window.location.href=\''.$prev_tgt.'\'" onmouseover="$(\'#pn_prev\').attr(\'src\',\'images/navbar/prev.png\');" onmouseout="$(\'#pn_prev\').attr(\'src\',\'images/navbar/prev_inactive.png\');" style="position: absolute; top: 0px; left: 0px; width: '.($CURRENT_PIC_DATA['pwidth'] / 2).'px; height: '.$CURRENT_PIC_DATA['pheight'].'px; text-align: left;"><div style="padding: '.($CURRENT_PIC_DATA['pheight']/2-8).'px 10px;"><img id="pn_prev" src="images/navbar/prev_inactive.png" /></div></div>';
    }
    if ($next_tgt != 'javascript:;') {
        $buttons .= '<div onclick="window.location.href=\''.$next_tgt.'\'" onmouseover="$(\'#pn_next\').attr(\'src\',\'images/navbar/next.png\');" onmouseout="$(\'#pn_next\').attr(\'src\',\'images/navbar/next_inactive.png\');" style="position: absolute; top: 0px; right: 0px; width: '.($CURRENT_PIC_DATA['pwidth'] / 2).'px; height: '.$CURRENT_PIC_DATA['pheight'].'px; text-align: right;"><div style="padding: '.($CURRENT_PIC_DATA['pheight']/2-8).'px 10px;"><img id="pn_next" src="images/navbar/next_inactive.png" /></div></div>';
    }

    $pic_html = preg_replace('/(<img.*\/>)/Usi', $buttons.'\\1', $pic_html);
    return $pic_html;
}

?>