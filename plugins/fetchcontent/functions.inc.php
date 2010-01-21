<?php
/********************************************************
  Coppermine 1.5.x plugin - FetchContent
  *******************************************************
  Copyright (c) 2010 Coppermine dev team
  *******************************************************
  This program is free software; you can redistribute 
  it and/or modify it under the terms of the GNU General
  Public License as published by the Free Software
  Foundation; either version 3 of the License, or 
  (at your option) any later version.
  *******************************************************
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
  *******************************************************/
  
if (!defined('IN_COPPERMINE')) { 
    die('Not in Coppermine...');
}

/**
 * display_thumbnails()
 *
 * Generates data to display thumbnails of pictures in an album
 *
 * @param mixed $album Either the album ID or the meta album name
 * @param integer $cat Either the category ID or album ID if negative
 * @param integer $page Page number to display
 * @param integer $thumbcols
 * @param integer $thumbrows
 * @param boolean $display_tabs
 **/
function fetchcontent_display_thumbnails($album, $cat, $page, $thumbcols, $thumbrows, $display_tabs)
{
    global $CONFIG, $USER, $LINEBREAK;
    global $lang_date, $lang_display_thumbnails, $lang_byte_units, $lang_common;

    $superCage = Inspekt::makeSuperCage();

    $thumb_per_page = $thumbcols * $thumbrows;
    $lower_limit    = ($page - 1) * $thumb_per_page;

    $pic_data = get_pic_data($album, $thumb_count, $album_name, $lower_limit, $thumb_per_page);

    $total_pages = ceil($thumb_count / $thumb_per_page);

    $i = 0;

    if (count($pic_data) > 0) {

        foreach ($pic_data as $key => $row) {

            $i++;

            $pic_title = $lang_common['filename'] . '=' . $row['filename'] . $LINEBREAK .
                $lang_common['filesize'] . '=' . ($row['filesize'] >> 10) . $lang_byte_units[1] . $LINEBREAK .
                $lang_display_thumbnails['dimensions'] . $row['pwidth'] . "x" . $row['pheight'] . $LINEBREAK .
                $lang_display_thumbnails['date_added'] . localised_date($row['ctime'], $lang_date['album']);

            $pic_url = get_pic_url($row, 'thumb');

            if (!is_image($row['filename'])) {
                $image_info     = cpg_getimagesize(urldecode($pic_url));
                $row['pwidth']  = $image_info[0];
                $row['pheight'] = $image_info[1];
            }

            // thumb cropping - if we display a system thumb we calculate the dimension by any and not ex
            if (array_key_exists('system_icon', $row) && ($row['system_icon'] == true)) {
                $image_size = compute_img_size($row['pwidth'], $row['pheight'], $CONFIG['thumb_width'], true);
            } else {
                $image_size = compute_img_size($row['pwidth'], $row['pheight'], $CONFIG['thumb_width']);
            }

            $thumb_list[$i]['pos']          = $key < 0 ? $key : $i - 1 + $lower_limit;
            $thumb_list[$i]['pid']          = $row['pid'];
            // $thumb_list[$i]['image']        = '<img src="' . $pic_url . '" class="image" ' . $image_size['geom'] . ' border="0" alt="' . $row['filename'] . '" title="' . $pic_title . '" />'; // commented out for fetchcontent
			$thumb_list[$i]['thumbpath']    = $pic_url; // Added for fetchcontent
			$thumb_list[$i]['thumbsize']    = $image_size['geom']; // Added for fetchcontent
            $thumb_list[$i]['caption']      = bb_decode($row['caption_text']);
            $thumb_list[$i]['admin_menu']   = '';
            $thumb_list[$i]['aid']          = $row['aid'];
            $thumb_list[$i]['pwidth']       = $row['pwidth'];
            $thumb_list[$i]['pheight']      = $row['pheight'];
            // cpg1.5: new thumb fields below
            $thumb_list[$i]['title']        = $row['title'];
            $thumb_list[$i]['description']  = $row['caption'];
            $thumb_list[$i]['filepath']     = $row['filepath'];
            $thumb_list[$i]['filename']     = $row['filename'];
            $thumb_list[$i]['filesize']     = $row['filesize'];
            $thumb_list[$i]['msg_id']       = isset($row['msg_id']) ? $row['msg_id'] : '';   // needed for get_pic_pos()
        }

        // Add a hit to album counter if it is a numeric album
        if (is_numeric($album)) {

            // Create an array to hold the album id for hits (if not created)
            if (!isset($USER['liv_a']) || !is_array($USER['liv_a'])) {
                $USER['liv_a'] = array();
            }

            // Add 1 to album hit counter
            if ((!USER_IS_ADMIN && $CONFIG['count_admin_hits'] == 0 || $CONFIG['count_admin_hits'] == 1) && !in_array($album, $USER['liv_a']) && $superCage->cookie->keyExists($CONFIG['cookie_name'] . '_data')) {

                add_album_hit($album);

                if (count($USER['liv_a']) > 4) {
                    array_shift($USER['liv_a']);
                }

                array_push($USER['liv_a'], $album);
                user_save_profile();
            }
        }

        //Using getRaw(). The date is sanitized in the called function.
        $date = $superCage->get->keyExists('date') ? cpgValidateDate($superCage->get->getRaw('date')) : null;
        
        // This is the difference to the original function taken from Coppermine's core: we don't process the data further, but put it into an array and return it
        $return = array(
                        'thumb_list' => $thumb_list, 
                        'thumb_count' => $thumb_count, 
                        'album_name' => $album_name, 
                        'aid' => $album, 
                        'cat' => $cat, 
                        'page' => $page, 
                        'total_pages' => $total_pages, 
                        'sort_options' => is_numeric($album), 
                        'display_tabs' => $display_tabs, 
                        'mode' => 'thumb', 
                        'date' => $date
                        );

    } elseif (is_numeric($album)) {
        $return = array(
                        'album_name' => $album_name, 
                        );
    }
    return $return;
}


?>