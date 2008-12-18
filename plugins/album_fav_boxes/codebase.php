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
**********************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');


/*
	Add an add_filter call for any album type you wish to enable the plugin for

	'thumb_caption_regular'
	'thumb_caption_lastcom'                
	'thumb_caption_lastcomby'
	'thumb_caption_lastup'
	'thumb_caption_lastupby'
	'thumb_caption_topn'
	'thumb_caption_toprated'
	'thumb_caption_lasthits'
	'thumb_caption_random'
	'thumb_caption_search'
	'thumb_caption_lastalb'                
	'thumb_caption_favpics'
*/

// Enable selector in regular albums
$thisplugin->add_filter('thumb_caption_regular','thumb_caption_add_to_favs');

// Enable the selector in search results
$thisplugin->add_filter('thumb_caption_search','thumb_caption_add_to_favs');

// Enable remover in favourites album
$thisplugin->add_filter('thumb_caption_favpics','thumb_caption_remove_from_favs');

// This will detect the add/remove forms being submitted and process them
$thisplugin->add_action('page_start','form_intercept');

// Iinitialise data array 
$lightbox['data'] = array();

function form_intercept(){
	global $CONFIG, $FAVPICS, $lightbox;


	$lightbox = array();

	// To change the text, alter the right hand side in this array
	$lightbox['lang'] = array(
		'Add to lightbox' => 'Add to lightbox',
		'Remove from lightbox' => 'Remove from lightbox',
		'Remove selected' => 'Remove selected',
		'Remove all' => 'Remove all',
		'Add selected' => 'Add selected',
		'Confirm' => "Clear the lightbox ?",
	);

	// Check if there is something for plugin to process
	if (isset($_POST['album_fav_boxes_data'])){
	
		// If user does not accept script's cookies, we don't accept the vote
		if (!isset($_COOKIE[$CONFIG['cookie_name'] . '_data'])) return false;

		$pids = array_map('intval', $_POST['album_fav_boxes_data']);
		$FAVPICS = array_unique(array_merge($FAVPICS, $pids));

	} elseif (isset($_POST['album_fav_boxes_remove'])){
		
		$pids = array_map('intval', $_POST['album_fav_boxes_remove']);

		if (is_array($pids)) $FAVPICS = array_diff($FAVPICS, $pids);

	} elseif (isset($_POST['clear_favs'])) {
		$FAVPICS = array();
	} else {
		return false;
	}
	
	$data = base64_encode(serialize($FAVPICS));
	setcookie($CONFIG['cookie_name'] . '_fav', $data, time() + 86400 * 30, $CONFIG['cookie_path']);
	
	// If the user is logged in then put it in the DB
	if (USER_ID > 0) {
		cpg_db_query("REPLACE INTO {$CONFIG['TABLE_FAVPICS']} ( user_id, user_favpics) VALUES (" . USER_ID . ", '$data')");
	}
}

function thumb_caption_add_to_favs($rowset){
	global $lightbox, $FAVPICS;

	$lightbox['data']['activate_favsel'] = true;

	foreach ($rowset as $id => $row){
		if (!in_array($row['pid'], $FAVPICS)) $rowset[$id]['caption_text'] .= '<span class="thumb_title">'. $lightbox['lang']['Add to lightbox'] .' <input type="checkbox" class="checkbox" value="'.$row['pid'].'" name="album_fav_boxes_data[]"/></span>';
	}

	return $rowset;
}

function thumb_caption_remove_from_favs($rowset){
	global $lightbox;
	
	$lightbox['data']['activate_favsel'] = true;
	$lightbox['data']['activate_favkill'] = true;
	
	foreach ($rowset as $id => $row){
		$rowset[$id]['caption_text'] .= '<span class="thumb_title">'.$lightbox['lang']['Remove from lightbox'].' <input type="checkbox" class="checkbox" value="'.$row['pid'].'" name="album_fav_boxes_remove[]"/></span>';
	}

	return $rowset;
}

if (!function_exists('theme_display_thumbnails')){
	
function theme_display_thumbnails(&$thumb_list, $nbThumb, $album_name, $aid, $cat, $page, $total_pages, $sort_options, $display_tabs, $mode = 'thumb')
{
    global $CONFIG;
    global $template_thumb_view_title_row,$template_fav_thumb_view_title_row, $lang_thumb_view, $template_tab_display, $template_thumbnail_view, $lang_album_list;

    // plugin addition
    global $REFERER, $lightbox;

	
    static $header = '';
    static $thumb_cell = '';
    static $empty_cell = '';
    static $row_separator = '';
    static $footer = '';
    static $tabs = '';
    static $spacer = '';

    if ($header == '') {
        $thumb_cell = template_extract_block($template_thumbnail_view, 'thumb_cell');
        $tabs = template_extract_block($template_thumbnail_view, 'tabs');
        $header = template_extract_block($template_thumbnail_view, 'header');
        $empty_cell = template_extract_block($template_thumbnail_view, 'empty_cell');
        $row_separator = template_extract_block($template_thumbnail_view, 'row_separator');
        $footer = template_extract_block($template_thumbnail_view, 'footer');
        $spacer = template_extract_block($template_thumbnail_view, 'spacer');
    }

    $cat_link = is_numeric($aid) ? '' : '&amp;cat=' . $cat;
    $uid_link = (isset($_GET['uid']) && is_numeric($_GET['uid'])) ? '&amp;uid=' . $_GET['uid'] : '';

    $theme_thumb_tab_tmpl = $template_tab_display;

    if ($mode == 'thumb') {
        $theme_thumb_tab_tmpl['left_text'] = strtr($theme_thumb_tab_tmpl['left_text'], array('{LEFT_TEXT}' => $aid == 'lastalb' ? $lang_album_list['album_on_page'] : $lang_thumb_view['pic_on_page']));
        $theme_thumb_tab_tmpl['inactive_tab'] = strtr($theme_thumb_tab_tmpl['inactive_tab'], array('{LINK}' => 'thumbnails.php?album=' . $aid . $cat_link . $uid_link . '&amp;page=%d'));
        $theme_thumb_tab_tmpl['inactive_next_tab'] = strtr($theme_thumb_tab_tmpl['inactive_next_tab'], array('{LINK}' => 'thumbnails.php?album=' . $aid . $cat_link . $uid_link . '&amp;page=%d'));
        $theme_thumb_tab_tmpl['inactive_prev_tab'] = strtr($theme_thumb_tab_tmpl['inactive_prev_tab'], array('{LINK}' => 'thumbnails.php?album=' . $aid . $cat_link . $uid_link . '&amp;page=%d'));
    } else {
        $theme_thumb_tab_tmpl['left_text'] = strtr($theme_thumb_tab_tmpl['left_text'], array('{LEFT_TEXT}' => $lang_thumb_view['user_on_page']));
        $theme_thumb_tab_tmpl['inactive_tab'] = strtr($theme_thumb_tab_tmpl['inactive_tab'], array('{LINK}' => 'index.php?cat=' . $cat . '&amp;page=%d'));
        $theme_thumb_tab_tmpl['inactive_next_tab'] = strtr($theme_thumb_tab_tmpl['inactive_next_tab'], array('{LINK}' => 'index.php?cat=' . $cat . '&amp;page=%d'));
        $theme_thumb_tab_tmpl['inactive_prev_tab'] = strtr($theme_thumb_tab_tmpl['inactive_prev_tab'], array('{LINK}' => 'index.php?cat=' . $cat . '&amp;page=%d'));
    }

    $thumbcols = $CONFIG['thumbcols'];
    $cell_width = ceil(100 / $CONFIG['thumbcols']) . '%';

    $tabs_html = $display_tabs ? create_tabs($nbThumb, $page, $total_pages, $theme_thumb_tab_tmpl) : '';
    // The sort order options are not available for meta albums
    if ($sort_options) {
        $param = array('{ALBUM_NAME}' => $album_name,
            '{AID}' => $aid,
            '{PAGE}' => $page,
            '{NAME}' => $lang_thumb_view['name'],
            '{TITLE}' => $lang_thumb_view['title'],
            '{DATE}' => $lang_thumb_view['date'],
            '{SORT_TA}' => $lang_thumb_view['sort_ta'],
            '{SORT_TD}' => $lang_thumb_view['sort_td'],
            '{SORT_NA}' => $lang_thumb_view['sort_na'],
            '{SORT_ND}' => $lang_thumb_view['sort_nd'],
            '{SORT_DA}' => $lang_thumb_view['sort_da'],
            '{SORT_DD}' => $lang_thumb_view['sort_dd'],
            '{POSITION}' => $lang_thumb_view['position'],
            '{SORT_PA}' => $lang_thumb_view['sort_pa'],
            '{SORT_PD}' => $lang_thumb_view['sort_pd'],
            );
        $title = template_eval($template_thumb_view_title_row, $param);
    } else if ($aid == 'favpics' && $CONFIG['enable_zipdownload'] == 1) { //Lots of stuff can be added here later
       $param = array('{ALBUM_NAME}' => $album_name,
                             '{DOWNLOAD_ZIP}'=>$lang_thumb_view['download_zip']
                               );
       $title = template_eval($template_fav_thumb_view_title_row, $param);
    }else{
        $title = $album_name;
    }

    // plugin addition
    $lightbox['data']['referrer'] = urldecode($REFERER);
    if (isset($_POST['search']) && !isset($_GET['album'])) $lightbox['data']['referrer'] .= "?album=search";
    if (isset($lightbox['data']['activate_favsel'])) echo '<form action="' . $lightbox['data']['referrer'] . '" method="post">';

    if ($mode == 'thumb') {
        starttable('100%', $title, $thumbcols);
    } else {
        starttable('100%');
    }

    echo $header;

    $i = 0;
    foreach($thumb_list as $thumb) {
        $i++;
        if ($mode == 'thumb') {
            if ($aid == 'lastalb') {
                $params = array('{CELL_WIDTH}' => $cell_width,
                    '{LINK_TGT}' => "thumbnails.php?album={$thumb['aid']}",
                    '{THUMB}' => $thumb['image'],
                    '{CAPTION}' => $thumb['caption'],
                    '{ADMIN_MENU}' => $thumb['admin_menu']
                    );
            } else {
                $params = array('{CELL_WIDTH}' => $cell_width,
                    '{LINK_TGT}' => "displayimage.php?album=$aid$cat_link&amp;pos={$thumb['pos']}$uid_link",
                    '{THUMB}' => $thumb['image'],
                    '{CAPTION}' => $thumb['caption'],
                    '{ADMIN_MENU}' => $thumb['admin_menu']
                    );
            }
        } else {
            $params = array('{CELL_WIDTH}' => $cell_width,
                '{LINK_TGT}' => "index.php?cat={$thumb['cat']}",
                '{THUMB}' => $thumb['image'],
                '{CAPTION}' => $thumb['caption'],
                '{ADMIN_MENU}' => ''
                );
        }
        echo template_eval($thumb_cell, $params);

        if ((($i % $thumbcols) == 0) && ($i < count($thumb_list))) {
            echo $row_separator;
        }
    }
    for (;($i % $thumbcols); $i++) {
        echo $empty_cell;
    }
    echo $footer;
	
    // plugin additon
    if (isset($lightbox['data']['activate_favkill'])) {
        echo '<tr><td class="tableb" align="center" colspan="'.$thumbcols.'"><p><input type="submit" class="button" value="' . $lightbox['lang']['Remove selected'].'" />&nbsp;&nbsp;&nbsp;<input type="submit" class="button" name="clear_favs" value="' . $lightbox['lang']['Remove all'] . '" onclick="return confirm(\'' . addslashes($lightbox['lang']['Confirm']) . ' \');" /></p></td></tr>';
    } elseif (isset($lightbox['data']['activate_favsel'])) {
        echo '<tr><td class="tableb" align="center" colspan="'.$thumbcols.'"><p><input type="submit" class="button" value="' . $lightbox['lang']['Add selected'] . '" /></p></td></tr>';
    }
	
    if ($display_tabs) {
        $params = array('{THUMB_COLS}' => $thumbcols,
            '{TABS}' => $tabs_html
            );
        echo template_eval($tabs, $params);
    }


    endtable();
	
    // plugin addition
    if (isset($lightbox['data']['activate_favsel'])) echo '</form>';
	
    echo $spacer;
}

}

?>
