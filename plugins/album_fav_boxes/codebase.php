<?php
/**************************************************
  Coppermine 1.5.x Plugin - album_fav_boxes!
  *************************************************
  Copyright (c) 2009 Nibbler
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

if (!defined('IN_COPPERMINE')) {
    die('Not in Coppermine...');
}

// Add plugin_install action$thisplugin->add_action('plugin_install','album_fav_boxes_install');

// Add plugin_uninstall action$thisplugin->add_action('plugin_uninstall','album_fav_boxes_uninstall');

$existing_meta_albums_array = array('regular', 'lastcom', 'lastcomby', 'lastup', 'lastupby', 'topn', 'toprated', 'lasthits', 'random', 'search', 'lastalb', 'favpics');

$album_fav_boxes_pages_array = array('index.php', 'thumbnails.php'); // Determine what pages the actual plugin function should be executed

$superCage = Inspekt::makeSuperCage();

foreach ($existing_meta_albums_array as $key) {
    if (in_array($superCage->server->getEscaped('SCRIPT_FILENAME'), $album_fav_boxes_pages_array) == TRUE && $CONFIG['plugin_album_fav_boxes_' . $key] == '1') {
        $thisplugin->add_filter('thumb_caption_' . $key, 'thumb_caption_add_to_favs');
    }
}

// Enable remover in favourites album
$thisplugin->add_filter('thumb_caption_favpics','thumb_caption_remove_from_favs');

// This will detect the add/remove forms being submitted and process them
$thisplugin->add_action('page_start','form_intercept');

// Initialise data array 
$lightbox['data'] = array();

// install
function album_fav_boxes_install() {
    global $CONFIG;
	// Add the config options for the plugin	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_album_fav_boxes_regular', '1')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_album_fav_boxes_search', '1')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_album_fav_boxes_favpics', '1')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_album_fav_boxes_lastcom', '0')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_album_fav_boxes_lastcomby', '0')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_album_fav_boxes_lastup', '0')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_album_fav_boxes_lastupby', '0')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_album_fav_boxes_topn', '0')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_album_fav_boxes_toprated', '0')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_album_fav_boxes_lasthits', '0')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_album_fav_boxes_random', '0')");
	cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_album_fav_boxes_lastalb', '0')");
    return true;
}


// uninstall and drop settings table
function album_fav_boxes_uninstall() {
    global $CONFIG;
	$superCage = Inspekt::makeSuperCage();
    if (!checkFormToken()) {
        global $lang_errors;
        cpg_die(ERROR, $lang_errors['invalid_form_token'], __FILE__, __LINE__);
    }
    // Delete the plugin config records	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_album_fav_boxes_regular'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_album_fav_boxes_search'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_album_fav_boxes_favpics'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_album_fav_boxes_lastcom'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_album_fav_boxes_lastcomby'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_album_fav_boxes_lastup'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_album_fav_boxes_lastupby'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_album_fav_boxes_topn'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_album_fav_boxes_toprated'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_album_fav_boxes_lasthits'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_album_fav_boxes_random'");
	cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_album_fav_boxes_lastalb'");
    return true;
}

function form_intercept(){
	global $CONFIG, $FAVPICS, $lightbox;
	
	$superCage = Inspekt::makeSuperCage();
	
	require_once "./plugins/album_fav_boxes/lang/english.php";
	if ($CONFIG['lang'] != 'english' && file_exists("./plugins/album_fav_boxes/lang/{$CONFIG['lang']}.php")) {
	    require_once "./plugins/album_fav_boxes/lang/{$CONFIG['lang']}.php";
	}
	
	$lightbox['message'] = '';
	$lightbox['icon']['add'] = cpg_fetch_icon('add', 2);
	$lightbox['icon']['delete'] = cpg_fetch_icon('delete', 2);
	$lightbox['icon']['delete_all'] = cpg_fetch_icon('erase', 2);
	$lightbox['icon']['favorites'] = cpg_fetch_icon('favorites', 2);
	$lightbox['icon']['favorite'] = cpg_fetch_icon('favorites', 2);
	
	// Check if there is something for plugin to process
	if ($superCage->post->keyExists('album_fav_boxes_data')) {
		// If user does not accept script's cookies, we don't accept the vote
		if (!$superCage->cookie->keyExists($CONFIG['cookie_name'] . '_data')) {
			return false;
		}
		$pids = array_map('intval', $superCage->post->getInt('album_fav_boxes_data'));
		$FAVPICS = array_unique(array_merge($FAVPICS, $pids));
		if (count($pids) == 1) {
			$lightbox['message'] = $lightbox['lang']['1 file added to favorites'];
		} else {
			$lightbox['message'] = sprintf($lightbox['lang']['x files added to favorites'], count($pids));
		}
	} elseif ($superCage->post->keyExists('album_fav_boxes_remove')){
		$pids = array_map('intval', $superCage->post->getInt('album_fav_boxes_remove'));
		if (is_array($pids)) {
			$FAVPICS = array_diff($FAVPICS, $pids);
		}
		if (count($pids) == 1) {
			$lightbox['message'] = $lightbox['lang']['1 file removed from favorites'];
		} else {
			$lightbox['message'] = sprintf($lightbox['lang']['x files removed from favorites'], count($pids));
		}
	} elseif ($superCage->post->keyExists('clear_favs')) {
		$FAVPICS = array();
		cpgRedirectPage('index.php', cpg_fetch_icon('warning', 2) . $lang_common['information'], $lightbox['lang']['Favorites cleared']);
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

	$loopCounter = 0;
	foreach ($rowset as $id => $row){
		if (!in_array($row['pid'], $FAVPICS)) {
			$rowset[$id]['caption_text'] .= '<span class="thumb_title"><label for="album_fav_boxes_data_add_'.$loopCounter.'" class="clickable_option">'. $lightbox['lang']['Add to favorites'] .'</label> <input type="checkbox" class="checkbox" value="'.$row['pid'].'" name="album_fav_boxes_data[]" id="album_fav_boxes_data_add_'.$loopCounter.'" /></span>';
			$loopCounter++;
		} else {
			$rowset[$id]['caption_text'] .= '<span class="thumb_title">' . $lightbox['lang']['Belongs to favorites list'] . '</span>';
		}
	}

	return $rowset;
}

function thumb_caption_remove_from_favs($rowset){
	global $lightbox;
	
	$lightbox['data']['activate_favsel'] = true;
	$lightbox['data']['activate_favkill'] = true;
	
	$loopCounter = 0;
	foreach ($rowset as $id => $row){
		$rowset[$id]['caption_text'] .= '<span class="thumb_title"><label for="album_fav_boxes_data_remove_'.$loopCounter.'" class="clickable_option">'.$lightbox['lang']['Remove from favorites'].' <input type="checkbox" class="checkbox" value="'.$row['pid'].'" name="album_fav_boxes_remove[]" id="album_fav_boxes_data_remove_'.$loopCounter.'" /></span>';
		$loopCounter++;
	}

	return $rowset;
}

if (!function_exists('theme_display_thumbnails')){
	
function theme_display_thumbnails(&$thumb_list, $nbThumb, $album_name, $aid, $cat, $page, $total_pages, $sort_options, $display_tabs, $mode = 'thumb', $date='')
{
    global $CONFIG;
    global $template_thumb_view_title_row,$template_fav_thumb_view_title_row, $lang_thumb_view, $lang_common, $template_tab_display, $template_thumbnail_view, $lang_album_list, $lang_errors, $lang_main_menu;
    global $REFERER, $lightbox; // plugin addition

    $superCage = Inspekt::makeSuperCage();

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
    $date_link = $date=='' ? '' : '&amp;date=' . $date;
    if ($superCage->get->getInt('uid')) {
      $uid_link = '&amp;uid=' . $superCage->get->getInt('uid');
    } else {
      $uid_link = '';
    }

    $theme_thumb_tab_tmpl = $template_tab_display;

    if ($mode == 'thumb') {
        $theme_thumb_tab_tmpl['left_text'] = strtr($theme_thumb_tab_tmpl['left_text'], array('{LEFT_TEXT}' => $aid == 'lastalb' ? $lang_album_list['album_on_page'] : $lang_thumb_view['pic_on_page']));
        $theme_thumb_tab_tmpl['page_link'] = strtr($theme_thumb_tab_tmpl['page_link'], array('{LINK}' => 'thumbnails.php?album=' . $aid . $cat_link . $date_link . $uid_link . '&amp;page=%d'));
    } else {
        $theme_thumb_tab_tmpl['left_text'] = strtr($theme_thumb_tab_tmpl['left_text'], array('{LEFT_TEXT}' => $lang_thumb_view['user_on_page']));
        $theme_thumb_tab_tmpl['page_link'] = strtr($theme_thumb_tab_tmpl['page_link'], array('{LINK}' => 'index.php?cat=' . $cat . '&amp;page=%d'));
    }

    $thumbcols = $CONFIG['thumbcols'];
    $cell_width = ceil(100 / $CONFIG['thumbcols']) . '%';

    $tabs_html = $display_tabs ? create_tabs($nbThumb, $page, $total_pages, $theme_thumb_tab_tmpl) : '';

    if (!GALLERY_ADMIN_MODE && stripos($template_thumb_view_title_row, 'admin_buttons') !== false) {
        template_extract_block($template_thumb_view_title_row, 'admin_buttons');
    }
    // The sort order options are not available for meta albums
    if ($sort_options) {
        if (GALLERY_ADMIN_MODE) {
            $param = array(
                '{ALBUM_ID}'   => $aid,
                '{CAT_ID}'     => ($cat > 0 ? $cat : $cat),
                '{MODIFY}'     => cpg_fetch_icon('modifyalb', 1).$lang_common['album_properties'],
                '{PARENT_CAT}' => cpg_fetch_icon('category', 1).$lang_common['parent_category'],
                '{EDIT_PICS}'  => cpg_fetch_icon('edit', 1).$lang_common['edit_files'],
                '{ALBUM_MGR}'  => cpg_fetch_icon('alb_mgr', 1).$lang_common['album_manager'],
            );
        } else {
            $param = array();
        }
        $param['{ALBUM_NAME}'] = $album_name;
        $title = template_eval($template_thumb_view_title_row, $param);
    } elseif ($aid == 'favpics' && $CONFIG['enable_zipdownload'] > 0) { //Lots of stuff can be added here later
        $param = array(
            '{ALBUM_NAME}' => $album_name,
            '{DOWNLOAD_ZIP}' => cpg_fetch_icon ('zip', 2) . $lang_thumb_view['download_zip'],
        );
       $title = template_eval($template_fav_thumb_view_title_row, $param);
    } else {
        $title = $album_name;
    }

    // plugin addition
    $lightbox['data']['referrer'] = urldecode($REFERER);
	if ($superCage->post->keyExists('search') && !($superCage->get->keyExists('album'))) {
		$lightbox['data']['referrer'] .= "?album=search";
	}
    if (isset($lightbox['data']['activate_favsel'])) {
		echo '<form action="' . $lightbox['data']['referrer'] . '" method="post">';
	}

    if ($mode == 'thumb') {
        starttable('100%', $title, $thumbcols);
    } else {
        starttable('100%');
    }

    echo $header;

    $i = 0;
    global $thumb;  // make $thumb accessible to plugins
    foreach($thumb_list as $thumb) {
        $i++;
        if ($mode == 'thumb') {
            if ($aid == 'lastalb') {
                $params = array(
                    '{CELL_WIDTH}' => $cell_width,
                    '{LINK_TGT}'   => "thumbnails.php?album={$thumb['aid']}",
                    '{THUMB}'      => $thumb['image'],
                    '{CAPTION}'    => $thumb['caption'],
                    '{ADMIN_MENU}' => $thumb['admin_menu'],
                );
            } elseif ($aid == 'random') {
                // determine if thumbnail link targets should open in a pop-up
                if ($CONFIG['thumbnail_to_fullsize'] == 1) { // code for full-size pop-up
                    if (!USER_ID && $CONFIG['allow_unlogged_access'] <= 2) {
                       $target = 'javascript:;" onClick="alert(\''.sprintf($lang_errors['login_needed'],'','','','').'\');';
                    } elseif (USER_ID && USER_ACCESS_LEVEL <= 2) {
                        $target = 'javascript:;" onClick="alert(\''.sprintf($lang_errors['access_intermediate_only'],'','','','').'\');';
                    } else {
                      $target = 'javascript:;" onClick="MM_openBrWindow(\'displayimage.php?pid=' . $thumb['pid'] . '&fullsize=1\',\'' . uniqid(rand()) . '\',\'scrollbars=yes,toolbar=no,status=no,resizable=yes,width=' . ((int)$thumb['pwidth']+(int)$CONFIG['fullsize_padding_x']) .  ',height=' .   ((int)$thumb['pheight']+(int)$CONFIG['fullsize_padding_y']). '\');';
                    }
                } else {
                    $target = "displayimage.php?pid={$thumb['pid']}$uid_link";
                }
                $params = array(
                    '{CELL_WIDTH}' => $cell_width,
                    '{LINK_TGT}'   => $target,
                    '{THUMB}'      => $thumb['image'],
                    '{CAPTION}'    => $thumb['caption'],
                    '{ADMIN_MENU}' => $thumb['admin_menu'],
                );
            } else {
                // determine if thumbnail link targets should open in a pop-up
                if ($CONFIG['thumbnail_to_fullsize'] == 1) { // code for full-size pop-up
                    if (!USER_ID && $CONFIG['allow_unlogged_access'] <= 2) {
                       $target = 'javascript:;" onClick="alert(\''.sprintf($lang_errors['login_needed'],'','','','').'\');';
                    } elseif (USER_ID && USER_ACCESS_LEVEL <= 2) {
                        $target = 'javascript:;" onClick="alert(\''.sprintf($lang_errors['access_intermediate_only'],'','','','').'\');';
                    } else {
                       $target = 'javascript:;" onClick="MM_openBrWindow(\'displayimage.php?pid=' . $thumb['pid'] . '&fullsize=1\',\'' . uniqid(rand()) . '\',\'scrollbars=yes,toolbar=no,status=no,resizable=yes,width=' . ((int)$thumb['pwidth']+(int)$CONFIG['fullsize_padding_x']) .  ',height=' .   ((int)$thumb['pheight']+(int)$CONFIG['fullsize_padding_y']). '\');';
                    }
                } else {
                    $target = "displayimage.php?album=$aid$cat_link$date_link&amp;pid={$thumb['pid']}$uid_link";
                }
                $params = array(
                    '{CELL_WIDTH}' => $cell_width,
                    '{LINK_TGT}'   => $target,
                    '{THUMB}'      => $thumb['image'],
                    '{CAPTION}'    => $thumb['caption'],
                    '{ADMIN_MENU}' => $thumb['admin_menu'],
                );
            }

        } else {  // mode != 'thumb'

            // Used for mode = 'user' from list_users() in index.php
            $params = array(
                '{CELL_WIDTH}' => $cell_width,
                '{LINK_TGT}'   => "index.php?cat={$thumb['cat']}",
                '{THUMB}'      => $thumb['image'],
                '{CAPTION}'    => $thumb['caption'],
                '{ADMIN_MENU}' => '',
            );

        }

        // Plugin Filter: allow plugin to modify or add tags to process
        $params = CPGPluginAPI::filter('theme_display_thumbnails_params', $params);
        echo template_eval($thumb_cell, $params);

        if ((($i % $thumbcols) == 0) && ($i < count($thumb_list))) {
            echo $row_separator;
        }
    } // foreach $thumb

    unset($thumb);  // unset $thumb to avoid conflicting with global

    for (;($i % $thumbcols); $i++) {
        echo $empty_cell;
    }
    echo $footer;
	
    // plugin addition
	if ($lightbox['message'] != '') {
        echo <<< EOT
		<tr>
			<td class="tableb" colspan="{$thumbcols}">
				<div class="cpg_message_info">
					{$lightbox['message']}
				</div>
			</td>
		</tr>
EOT;
	}
    if (isset($lightbox['data']['activate_favkill'])) {
		$confirm = addslashes($lightbox['lang']['Confirm']);
        echo <<< EOT
		<tr>
			<td class="tablef" align="center" colspan="{$thumbcols}">
				<button type="submit" class="button" value="{$lightbox['lang']['Remove selected']}">{$lightbox['icon']['delete']}{$lightbox['lang']['Remove selected']}</button>&nbsp;&nbsp;&nbsp;
				<button type="submit" class="button" name="clear_favs" value="{$lightbox['lang']['Remove all']}" onclick="return confirm('{$confirm}');">{$lightbox['icon']['delete_all']}{$lightbox['lang']['Remove all']}</button>
			</td>
		</tr>
EOT;
    } elseif (isset($lightbox['data']['activate_favsel'])) {
        echo <<< EOT
		<tr>
			<td class="tablef" align="center" colspan="{$thumbcols}">
				<button type="submit" class="button" value="{$lightbox['lang']['Add selected']}" title="{$lightbox['lang']['Add selected files to favorites']}">{$lightbox['icon']['add']}{$lightbox['lang']['Add selected']}</button>&nbsp;
				<a href="thumbnails.php?album=favpics" title="{$lang_main_menu['fav_title']}" class="admin_menu">{$lightbox['icon']['favorites']}{$lang_main_menu['fav_lnk']}</a>
			</td>
		</tr>
EOT;
    }

    if ($display_tabs) {
        $params = array(
            '{THUMB_COLS}' => $thumbcols,
            '{TABS}'       => $tabs_html,
        );
        echo template_eval($tabs, $params);
    }

    endtable();
	
	// plugin addition
    if (isset($lightbox['data']['activate_favsel'])) {
		echo '</form>'; 
	}
	
    echo $spacer;
}

}

?>
