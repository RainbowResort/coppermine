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
  $Revision: 4245 $
  $LastChangedBy: saweyyy $
  $Date: 2008-02-04 01:49:15 +0530 (Mon, 04 Feb 2008) $
**********************************************/

/**
* Coppermine Photo Gallery 1.5.0 index.php
*
* This file is the main display for categories and album it also displays thumbnails,
* also see documentation for this file's {@relativelink ../_index.php.php Free Standing Code}
*
* @copyright 2002-2006 Gregory DEMAR, Coppermine Dev Team
* @license http://opensource.org/licenses/gpl-license.php GNU General Public License V2
* @package Coppermine
* @version $Id: index.php 4245 2008-02-03 20:19:15Z saweyyy $
*/

/**
* Unless this is true most things wont work - protection against direct execution of inc files
*/
define('IN_COPPERMINE', true);

define('INDEX_PHP', true);

require('include/init.inc.php');

/**
 * Clean up GPC and other Globals here
 */
if ($superCage->get->keyExists('page')) {
        $page = $superCage->get->getInt('page');
}

if ($superCage->get->keyExists('cat')) {
    $cat = $superCage->get->getInt('cat');
}

if ($superCage->get->keyExists('file')) {
    /**
     * There can be only alphanumerals in a plugin's folder name. There mustn't be any dots or other special
     * chars in it.
     * The only exception is the hypen (-) and underscore (_)
     * Examples for folder names: "myplugin" = OK, "my_plugin" = OK, "my plugin" = BAD, "m&uuml;_plugin" = BAD
     * Files the plugin is meant to include can only contain one single dot that separates the actual filename
     * from the php-extension
     * Same restrictions apply as for the folder name (only alphanumerals, hyphen and underscore)
     */

    if ($matched = $superCage->get->getMatched('file', "/^([a-zA-Z0-9_\-]+)(\/{0,1}?)([a-zA-Z0-9_\-]+)$/")) {
        $tmpFile = $matched[0];
    } else {
            $tmpFile = '';
    }
}

if ($tmpFile != 'codebase' && $tmpFile != 'configuration') {
    $file = $tmpFile;
} else {
    $file = '';
}

if ($file) {
    $path = './plugins/'.$file.'.php';

    // Don't include the codebase and credits files
    if (file_exists($path)) {
        // Include the code from the plugin
        include_once($path);
        $file = true;
    } else {
        $file = false;
    }
} else {
  $file = false;
}

if (!$file) {
    /**
    * Sets the flag for lang file
    */
    //define('INDEX_PHP', true);

    //require_once('include/init.inc.php');

    if (!USER_ID && $CONFIG['allow_unlogged_access'] == 0) {
        $redirect = $redirect . "login.php";
        header("Location: $redirect");
        exit();
    }

    if ($CONFIG['enable_smilies']) include("include/smilies.inc.php");
}


/**
* Local functions definition
*/

########### Added #############
/**
 * html_albummenu2()
 *
 * This function draws the links for moderator menu of Albums
 *
 * @param integer $id ID of the album for which the links are being drawn
 * @return string The evaluated template block with links
 **/
function html_albummenu2($id) {
    global $lang_album_admin_menu;

    /**
     * This template variable can be defined in theme.php of respective theme.
     * This is done here for simplicity.
     */
    $template_album_moderator_menu = <<<EOT
        <table border="0" cellpadding="0" cellspacing="1">
                <tr>
                        <td align="center" valign="middle" class="admin_menu">
                                <a href="editpics.php?album={ALBUM_ID}"  class="adm_menu">{EDIT_PICS}</a>
                        </td>
                </tr>
        </table>
EOT;


    static $template = '';

    if ($template == '') {
        $params = array(
            '{EDIT_PICS}' => $lang_album_admin_menu['edit_pics'],
            );

        $template = template_eval($template_album_moderator_menu, $params);
    }

    $params = array('{ALBUM_ID}' => $id,
        );

    return template_eval($template, $params);
}


/**
 * html_albummenu()
 *
 * This function draws the links for admin menu of Albums
 *
 * @param integer $id ID of the album for which the links are being drawn
 * @return string The evaluated template block with links
 **/
function html_albummenu($id)
{
    global $template_album_admin_menu, $lang_album_admin_menu;

    static $template = '';

    if ($template == '') {
        $params = array('{CONFIRM_DELETE}' => $lang_album_admin_menu['confirm_delete'],
            '{DELETE}' => $lang_album_admin_menu['delete'],
            '{MODIFY}' => $lang_album_admin_menu['modify'],
            '{EDIT_PICS}' => $lang_album_admin_menu['edit_pics'],
            );

        $template = template_eval($template_album_admin_menu, $params);
    }

    $params = array('{ALBUM_ID}' => $id,
        );

    return template_eval($template, $params);
}

/**
 * html_albummenu3()
 *
 * This function draws the links for admin menu of Albums when pics can't be edited
 *
 * @param integer $id ID of the album for which the links are being drawn
 * @return string The evaluated template block with links
 **/
function html_albummenu3($id)
{
    global $lang_album_admin_menu;
	
	 /**
     * This template variable can be defined in theme.php of respective theme.
     * This is done here for simplicity.
     */
    $template_album_admin_no_pic_edit_menu = <<<EOT
        <table border="0" cellpadding="0" cellspacing="1">
                <tr>
                        <td align="center" valign="middle" class="admin_menu">
                                <a href="delete.php?id={ALBUM_ID}&amp;what=album"  class="adm_menu" onclick="return confirm('{CONFIRM_DELETE}');">{DELETE}</a>
                        </td>
                        <td align="center" valign="middle" class="admin_menu">
                                <a href="modifyalb.php?album={ALBUM_ID}"  class="adm_menu">{MODIFY}</a>
                        </td>
                </tr>
        </table>
EOT;
	
    static $template = '';

    if ($template == '') {
        $params = array('{CONFIRM_DELETE}' => $lang_album_admin_menu['confirm_delete'],
            '{DELETE}' => $lang_album_admin_menu['delete'],
            '{MODIFY}' => $lang_album_admin_menu['modify'],
            );

        $template = template_eval($template_album_admin_no_pic_edit_menu, $params);
    }

    $params = array('{ALBUM_ID}' => $id,
        );

    return template_eval($template, $params);
}

/**
 * get_subcat_data()
 *
 * Get the data about the sub categories which are going to be shown on the index page, this function is called recursively
 *
 * @param integer $parent Parent Category
 * @param array $cat_data
 * @param array $album_set_array
 * @param integer $level Level being displayed
 * @param string $ident String to use as indentation for Categories
 * @return void
 **/
function get_subcat_data($parent, &$cat_data, &$album_set_array, $level, $ident = '')
{
    global $CONFIG, $HIDE_USER_CAT, $FORBIDDEN_SET, $cpg_show_private_album;
	global $cpg_db_index_php;
	####################### DB #########################	
		$cpgdb =& cpgDB::getInstance();
		$cpgdb->connect_to_existing($CONFIG['LINK_ID']);
	##################################################	

    $album_filter = '';
    $pic_filter = '';
    if (!empty($FORBIDDEN_SET) && !$cpg_show_private_album) {
        $album_filter = ' and ' . str_replace('p.', 'a.', $FORBIDDEN_SET);
        $pic_filter = ' and ' . str_replace('p.', $CONFIG['TABLE_PICTURES'] . '.', $FORBIDDEN_SET);
    }
    if ($CONFIG['categories_alpha_sort'] == 1) {$cat_sort_order = 'name';}else{$cat_sort_order = 'pos';}
    /*$result = cpg_db_query("SELECT cid, name, description, thumb FROM {$CONFIG['TABLE_CATEGORIES']} WHERE parent = '$parent'  ORDER BY $cat_sort_order");

    if (mysql_num_rows($result) > 0) {
        $rowset = cpg_db_fetch_rowset($result);*/
	#######################  DB  #########################
    $cpgdb->query($cpg_db_index_php['subcat_categories'], $parent, $cat_sort_order);
	$rowset = $cpgdb->fetchRowSet();
    if (count($rowset) > 0) {
	####################################################
        foreach ($rowset as $subcat) {
            if ($subcat['cid'] == USER_GAL_CAT) {
                /*$sql = "SELECT aid FROM {$CONFIG['TABLE_ALBUMS']} as a WHERE category>=" . FIRST_USER_CAT . $album_filter;
                $result = cpg_db_query($sql);
                $album_count = mysql_num_rows($result);
                while ($row = mysql_fetch_array($result)) {
                    $album_set_array[] = $row['aid'];
                } // while
                mysql_free_result($result);

                $result = cpg_db_query("SELECT count(*) FROM {$CONFIG['TABLE_PICTURES']} as p, {$CONFIG['TABLE_ALBUMS']} as a WHERE p.aid = a.aid AND approved='YES' AND category >= " . FIRST_USER_CAT . $album_filter);
                $nbEnr = mysql_fetch_array($result);*/
				#################################  DB  ####################################
				$cpgdb->query($cpg_db_index_php['subcat_alb_filter'], FIRST_USER_CAT, $album_filter);
				$rowset = $cpgdb->fetchRowSet();
                $album_count = count($rowset);
                foreach ($rowset as $row) {
                    $album_set_array[] = $row['aid'];
                } // foreach
                $cpgdb->free();
                $cpgdb->query($cpg_db_index_php['subcat_user_gal_cat'], FIRST_USER_CAT, $album_filter);
                $nbEnr = $cpgdb->fetchRow();				
				#########################################################################
                $pic_count = $nbEnr[0];
                $subcat['description'] = preg_replace("/<br.*?>[\r\n]*/i", '<br />' . $ident , bb_decode($subcat['description']));

                $link = $ident . "<a href=\"index.php?cat={$subcat['cid']}\">{$subcat['name']}</a>";
                if ($album_count) {
                    $cat_data[] = array($link, $ident . $subcat['description'], $album_count, $pic_count);
                    $HIDE_USER_CAT = 0;
                } else {
                    $HIDE_USER_CAT = 1;
                }
            } else {
                $unaliased_album_filter = str_replace('a.', '', $album_filter);
                
				/*$result = cpg_db_query("SELECT aid FROM {$CONFIG['TABLE_ALBUMS']} WHERE category = {$subcat['cid']}" . $unaliased_album_filter);
                $album_count = mysql_num_rows($result);
                while ($row = mysql_fetch_array($result)) {
                    $album_set_array[] = $row['aid'];
                } // while
                mysql_free_result($result);

                $result = cpg_db_query("SELECT count(*) FROM {$CONFIG['TABLE_PICTURES']} as p, {$CONFIG['TABLE_ALBUMS']} as a WHERE p.aid = a.aid AND approved='YES' AND category = {$subcat['cid']}" . $album_filter);
                $nbEnr = mysql_fetch_array($result);
                mysql_free_result($result);
                $pic_count = $nbEnr[0];
                if ($subcat['thumb'] > 0) {
                    $sql = "SELECT filepath, filename, url_prefix, pwidth, pheight " . "FROM {$CONFIG['TABLE_PICTURES']} " . "WHERE pid='{$subcat['thumb']}'" . $pic_filter;
                    $result = cpg_db_query($sql);
                    if (mysql_num_rows($result)) {
                        $picture = mysql_fetch_array($result);
                        mysql_free_result($result);*/
				##############################  DB  ###################################
				$cpgdb->query($cpg_db_index_php['subcat_unaliased_alb_filter'], $subcat['cid'], $unalised_album_filter);
                $rowset = $cpgdb->fetchRowSet();
				$album_count = count($rowset);
                foreach ($rowset as $row) {
                    $album_set_array[] = $row['aid'];
                } // foreach
                $cpgdb->free();

                $cpgdb->query($cpg_db_index_php['subcat_not_user_gal_cat'], $subcat['cid'], $album_filter);
                $nbEnr = $cpgdb->fetch_Row();
                $cpgdb->free();
                $pic_count = $nbEnr[0];
                if ($subcat['thumb'] > 0) {
                    $cpgdb->query($cpg_db_index_php['subcat_pic'], $subcat['thumb'], $pic_filter);
                    $rowset = $cpgdb->fetchRowSet();
                    if (count($rowset)) {
                        $picture = $rowset[0];
                        $cpgdb->free();				
				######################################################################
				
                        $pic_url = get_pic_url($picture, 'thumb');
                        if (!is_image($picture['filename'])) {
                            $image_info = cpg_getimagesize(urldecode($pic_url));
                            $picture['pwidth'] = $image_info[0];
                            $picture['pheight'] = $image_info[1];
                        }
                        $image_size = compute_img_size($picture['pwidth'], $picture['pheight'], $CONFIG['alb_list_thumb_size']);
                        $user_thumb = "<img src=\"" . $pic_url . "\" class=\"image\" {$image_size['geom']} border=\"0\" alt=\"\" />";
                        $user_thumb = "<a href=\"index.php?cat={$subcat['cid']}\">" . $user_thumb . "</a>";
                    }
                } else {
                    $user_thumb = "";
                }
                $subcat['name'] = $subcat['name'];
                $subcat['description'] = preg_replace("/<br.*?>[\r\n]*/i", '<br />', bb_decode($subcat['description']));
                $link = "<a href=\"index.php?cat={$subcat['cid']}\">{$subcat['name']}</a>";
                $user_thumb = $ident . $user_thumb;
                if ($pic_count == 0 && $album_count == 0) {
                                        $user_thumb = $ident;
                    $cat_data[] = array($link, $subcat['description'], 'cat_thumb' => $user_thumb);
                } else {
                    // Check if you need to show subcat_level
                    if ($level == $CONFIG['subcat_level']) {
                        $cat_albums = list_cat_albums($subcat['cid']);
                    } else {
                        $cat_albums = '';
                    }
                    $cat_data[] = array($link, $subcat['description'], $album_count, $pic_count, 'cat_albums' => $cat_albums, 'cat_thumb' => $user_thumb);
                }
            }

            if ($level > 1) {
                                get_subcat_data($subcat['cid'], $cat_data, $album_set_array, $level -1, $ident . "</td><td><img src=\"images/spacer.gif\" width=\"20\" height=\"1\" border=\"0\" alt=\"\" /></td><td>");
                        }
        }
    }
}

/**
 * get_cat_list()
 *
 *  List all categories
 *
 * @param string $breadcrumb
 * @param array $cat_data
 * @param string $statistics
 * @return void
 **/
function get_cat_list(&$breadcrumb, &$cat_data, &$statistics)
{
    global $CONFIG, $ALBUM_SET, $CURRENT_CAT_NAME, $BREADCRUMB_TEXT, $STATS_IN_ALB_LIST, $FORBIDDEN_SET;
    global $HIDE_USER_CAT, $cpg_show_private_album;
    global $cat;
    global $lang_list_categories, $lang_errors;
	global $cpg_db_index_php;
	####################### DB #########################	
		$cpgdb =& cpgDB::getInstance();
		$cpgdb->connect_to_existing($CONFIG['LINK_ID']);
	##################################################	

    // Build the breadcrumb
    breadcrumb($cat, $breadcrumb, $BREADCRUMB_TEXT);
    // Build the category list
    $cat_data = array();
    $album_set_array = array();
    get_subcat_data($cat, $cat_data, $album_set_array, $CONFIG['subcat_level']);

    $album_filter = '';
    $pic_filter = '';
    $cat = (int) $cat;
    if (!empty($FORBIDDEN_SET) && !$cpg_show_private_album) {
        $album_filter = ' and ' . str_replace('p.', 'a.', $FORBIDDEN_SET);
        $pic_filter = ' and ' . $FORBIDDEN_SET;
    }
    // Add the albums in the current category to the album set
    // if ($cat) {
    /*if ($cat == USER_GAL_CAT) {
        $sql = "SELECT aid FROM {$CONFIG['TABLE_ALBUMS']} as a WHERE category >= " . FIRST_USER_CAT . $album_filter;
        $result = cpg_db_query($sql);
    } else {
        $sql = "SELECT aid FROM {$CONFIG['TABLE_ALBUMS']} as a WHERE category = '$cat'" . $album_filter;
        $result = cpg_db_query($sql);
    } while ($row = mysql_fetch_array($result)) {
        $album_set_array[] = $row['aid'];
    } // while
    mysql_free_result($result);
    // }*/
	######################  DB  ##########################
    if ($cat == USER_GAL_CAT) {
        $cpgdb->query($cpg_db_index_php['cat_list_user_gal_cat'], FIRST_USER_CAT, $album_filter);
    } else {
        $cpgdb->query($cpg_db_index_php['cat)_list_not_user_gal_cat'], $cat, $album_filter);
    } while ($row = $cpgdb->fetchRow()) {
        $album_set_array[] = $row['aid'];
    } // while
    $cpgdb->free();
	####################################################
    if (count($album_set_array) && $cat) {
        $set = '';
        foreach ($album_set_array as $album) $set .= $album . ',';
        $set = substr($set, 0, -1);
        $current_album_set = "AND aid IN ($set) ";
        $ALBUM_SET .= $current_album_set;
    } elseif ($cat) {
        $current_album_set = "AND aid IN (-1) ";
        $ALBUM_SET .= $current_album_set;
    }
    // Gather gallery statistics - start
    if ($CONFIG['display_stats_on_index'] != 0) {
        if ($cat == 0) {
            /*$result = cpg_db_query("SELECT count(aid) FROM {$CONFIG['TABLE_ALBUMS']} as a WHERE 1" . $album_filter);
            $nbEnr = mysql_fetch_array($result);
            $album_count = $nbEnr[0];
            mysql_free_result($result);

            $sql = "SELECT count(pid) FROM {$CONFIG['TABLE_PICTURES']} as p " . 'LEFT JOIN ' . $CONFIG['TABLE_ALBUMS'] . ' as a ' . 'ON a.aid=p.aid ' . 'WHERE 1' . $pic_filter . ' AND approved=\'YES\'';
            $result = cpg_db_query($sql);
            $nbEnr = mysql_fetch_array($result);
            $picture_count = $nbEnr[0];
            mysql_free_result($result);

            $sql = "SELECT count(msg_id) FROM {$CONFIG['TABLE_COMMENTS']} as c " . 'LEFT JOIN ' . $CONFIG['TABLE_PICTURES'] . ' as p ' . 'ON c.pid=p.pid ' . 'LEFT JOIN ' . $CONFIG['TABLE_ALBUMS'] . ' as a ' . 'ON a.aid=p.aid ' . 'WHERE 1' . $pic_filter. ' AND approval=\'YES\'';
            $result = cpg_db_query($sql);
            $nbEnr = mysql_fetch_array($result);
            $comment_count = $nbEnr[0];
            mysql_free_result($result);

            $sql = "SELECT count(cid) FROM {$CONFIG['TABLE_CATEGORIES']} WHERE 1";
            $result = cpg_db_query($sql);
            $nbEnr = mysql_fetch_array($result);
            $cat_count = $nbEnr[0] - $HIDE_USER_CAT;
            mysql_free_result($result);

            $sql = "SELECT sum(hits) FROM {$CONFIG['TABLE_PICTURES']} as p " . 'LEFT JOIN ' . $CONFIG['TABLE_ALBUMS'] . ' as a ' . 'ON p.aid=a.aid ' . 'WHERE 1' . $pic_filter;
            $result = cpg_db_query($sql);
            $nbEnr = mysql_fetch_array($result);
            $hit_count = (int)$nbEnr[0];
            mysql_free_result($result);*/
			#########################  DB  ############################
            $cpgdb->query($cpg_db_index_php['cat_list_count_alb'], $album_filter);
            $nbEnr = $cpgdb->fetchRow();
            $album_count = $nbEnr[0];
            $cpgdb->free();

            $cpgdb->query($cpg_db_index_php['cat_list_count_pic_alb'], $pic_filter);
            $nbEnr = $cpgdb->fetchRow();
            $picture_count = $nbEnr[0];
            $cpgdb->free();

            $cpgdb->query($cpg_db_index_php['cat_list_count_comm_pic'], $pic_filter);
            $nbEnr = $cpgdb->fetchRow();
            $comment_count = $nbEnr[0];
            $cpgdb->free();

            $cpgdb->query($cpg_db_index_php['cat_list_count_cat']);
            $nbEnr = $cpgdb->fetchRow();
            $cat_count = $nbEnr[0] - $HIDE_USER_CAT;
            $cpgdb->free();

            $cpgdb->query($cpg_db_index_php['cat_list_sum_pic_alb'], $pic_filter);
            $nbEnr = $cpgdb->fetchRow();
            $hit_count = (int)$nbEnr[0];
            $cpgdb->free();
			#########################################################

            if (count($cat_data)) {
                $statistics = strtr($lang_list_categories['stat1'], array('[pictures]' => $picture_count,
                        '[albums]' => $album_count,
                        '[cat]' => $cat_count,
                        '[comments]' => $comment_count,
                        '[views]' => $hit_count));
            } else {
                $STATS_IN_ALB_LIST = true;
                $statistics = strtr($lang_list_categories['stat3'], array('[pictures]' => $picture_count,
                        '[albums]' => $album_count,
                        '[comments]' => $comment_count,
                        '[views]' => $hit_count));
            }
        } elseif ($cat >= FIRST_USER_CAT && $ALBUM_SET) {
            /*$result = cpg_db_query("SELECT count(aid) FROM {$CONFIG['TABLE_ALBUMS']} WHERE 1 $current_album_set");
            $nbEnr = mysql_fetch_array($result);
            $album_count = $nbEnr[0];
            mysql_free_result($result);

            $result = cpg_db_query("SELECT count(pid) FROM {$CONFIG['TABLE_PICTURES']} WHERE 1 $current_album_set");
            $nbEnr = mysql_fetch_array($result);
            $picture_count = $nbEnr[0];
            mysql_free_result($result);

            $result = cpg_db_query("SELECT sum(hits) FROM {$CONFIG['TABLE_PICTURES']} WHERE 1 $current_album_set AND approved='YES'");
            $nbEnr = mysql_fetch_array($result);
            $hit_count = (int)$nbEnr[0];
            mysql_free_result($result);*/
			########################  DB  ###########################
            $cpgdb->query($cpg_db_index_php['cat_list_current_alb_set'], $current_album_set);
            $nbEnr = $cpgdb->fetchRow();
            $album_count = $nbEnr[0];
            $cpgdb->free();

            $cpgdb->query($cpg_db_index_php['cat_list_count_pic'], $current_album_set);
			$nbEnr = $cpgdb->fetchRow();
            $album_count = $nbEnr[0];
            $cpgdb->free();

            $cpgdb->query($cpg_db_index_php['cat_list_sum_pic'], $current_album_set);$result = cpg_db_query("SELECT sum(hits) FROM {$CONFIG['TABLE_PICTURES']} WHERE 1 $current_album_set AND approved='YES'");
            $nbEnr = $cpgdb->fetchRow();
            $hit_count = (int)$nbEnr[0];
            $cpgdb->free();
			#######################################################

            $statistics = strtr($lang_list_categories['stat2'], array('[pictures]' => $picture_count,
                    '[albums]' => $album_count,
                    '[views]' => $hit_count));
        } else {
            $statistics = '';
        }
    } else { // Gather gallery statistics - end
        $statistics = '';
    }
}

/**
* list_users()
*
* Get a list of users galleries
*/
function list_users()
{
    global $CONFIG, $PAGE, $FORBIDDEN_SET;
    global $lang_list_users, $lang_errors, $template_user_list_info_box, $cpg_show_private_album, $cpg_udb;
	global $cpg_db_index_php;
	####################### DB #########################	
		$cpgdb =& cpgDB::getInstance();
		$cpgdb->connect_to_existing($CONFIG['LINK_ID']);
	##################################################	

    $rowset = $cpg_udb->list_users_query($user_count);

    if (!$rowset) {
        msg_box($lang_list_users['user_list'], $lang_list_users['no_user_gal'], '', '', '100%');
        return;
    }

    $user_per_page = $CONFIG['thumbcols'] * $CONFIG['thumbrows'];
    $totalPages = ceil($user_count / $user_per_page);

    $user_list = array();
    foreach ($rowset as $user) {
        $cpg_nopic_data = cpg_get_system_thumb('nopic.jpg', $user['user_id']);
        $user_thumb = '<img src="' . $cpg_nopic_data['thumb'] . '" ' . $cpg_nopic_data['whole'] . ' class="image" border="0" alt="" />';
        $user_pic_count = $user['pic_count'];
        $user_thumb_pid = ($user['gallery_pid']) ? $user['gallery_pid'] : $user['thumb_pid'];
        $user_album_count = $user['alb_count'];

        if ($user_pic_count) {
            /*$sql = "SELECT filepath, filename, url_prefix, pwidth, pheight " . "FROM {$CONFIG['TABLE_PICTURES']} " . "WHERE pid='$user_thumb_pid' AND approved='YES'";
            $result = cpg_db_query($sql);
            if (mysql_num_rows($result)) {
                $picture = mysql_fetch_array($result);
                mysql_free_result($result);*/
			#####################  DB  ########################
			$cpgdb->query($cpg_db_index_php['list_user_pic'], $user_thumb_pid);
            $rowset = $cpgdb->fetchRowSet();
            if (count($rowset)) {
                $picture = $rowset[0];
                $cpgdb->free();
			################################################
                $pic_url = get_pic_url($picture, 'thumb');
                if (!is_image($picture['filename'])) {
                    $image_info = cpg_getimagesize(urldecode($pic_url));
                    $picture['pwidth'] = $image_info[0];
                    $picture['pheight'] = $image_info[1];
                }
                                //thumb cropping
                //$image_size = compute_img_size($picture['pwidth'], $picture['pheight'], $CONFIG['alb_list_thumb_size']);
                                if($picture['system_icon']=='true'){
                        $image_size = compute_img_size($picture['pwidth'], $picture['pheight'], $CONFIG['alb_list_thumb_size'], true, 'cat_thumb');
                } else {
                                    $image_size = compute_img_size($picture['pwidth'], $picture['pheight'], $CONFIG['alb_list_thumb_size'], false, 'cat_thumb');
                                }


                $user_thumb = "<img src=\"" . $pic_url . "\" class=\"image\" {$image_size['geom']} border=\"0\" alt=\"\" />";
            }
        }

        $albums_txt = sprintf($lang_list_users['n_albums'], $user_album_count);
        $pictures_txt = sprintf($lang_list_users['n_pics'], $user_pic_count);

        $params = CPGPluginAPI::filter('user_caption_params', array('{USER_NAME}' => $user['user_name'],
            '{USER_ID}' => $user['user_id'],
            '{ALBUMS}' => $albums_txt,
            '{PICTURES}' => $pictures_txt,
            )
        );

        $caption = template_eval($template_user_list_info_box, $params);

        $user_list[] = array('cat' => FIRST_USER_CAT + $user['user_id'],
            'image' => $user_thumb,
            'caption' => $caption,
            );
    }
    theme_display_thumbnails($user_list, $user_count, '', '', 1, $PAGE, $totalPages, false, true, 'user');
}

/**
* list_albums()
*
* Get a list of albums
*/
function list_albums()
{
    global $CONFIG, $USER, $USER_DATA, $PAGE, $lastup_date_fmt, $FORBIDDEN_SET, $FORBIDDEN_SET_DATA;
    global $cat;
    global $lang_list_albums, $lang_errors, $cpg_show_private_album;
	global $cpg_db_index_php;
	####################### DB #########################	
		$cpgdb =& cpgDB::getInstance();
		$cpgdb->connect_to_existing($CONFIG['LINK_ID']);
	##################################################	

    $alb_per_page = $CONFIG['albums_per_page'];
    $maxTab = $CONFIG['max_tabs'];

    $album_filter = '';
    $pic_filter = '';
    $pic_subquery = '';

    if (!empty($FORBIDDEN_SET) && !$cpg_show_private_album) {
        $album_filter = ' and ' . str_replace('p.', 'a.', $FORBIDDEN_SET);
        $pic_filter = ' and ' . $FORBIDDEN_SET;
    }

    $result;
    /*    if(USER_ADMIN_MODE && $cat == (USER_ID + FIRST_USER_CAT)){
                $result = cpg_db_query("SELECT count(aid) FROM {$CONFIG['TABLE_ALBUMS']} as a WHERE owner = '" . $USER_DATA['user_id'] . "'" . $album_filter);
        }else{
                $result = cpg_db_query("SELECT count(aid) FROM {$CONFIG['TABLE_ALBUMS']} as a WHERE category = '$cat'" . $album_filter);
        }
    $nbEnr = mysql_fetch_array($result);
    $nbAlb = $nbEnr[0];
    mysql_free_result($result);*/
	#########################################
        if(USER_ADMIN_MODE && $cat == (USER_ID + FIRST_USER_CAT)){
                $cpgdb->query($cpg_db_index_php['list_albums_alb_owner'], $USER_DATA['user_id'], $album_filter);
        }else{
                $cpgdb->query($cpg_db_index_php['list_albums_alb_cats'], $cat, $album_filter);
        }
    $nbEnr = $cpgdb->fetchRow();
    $nbAlb = $nbEnr[0];
    $cpgdb->free();
	############################################
	
    if (!$nbAlb) return;

    $totalPages = ceil($nbAlb / $alb_per_page);

    if ($PAGE > $totalPages) $PAGE = 1;
    $lower_limit = ($PAGE-1) * $alb_per_page;
    $upper_limit = min($nbAlb, $PAGE * $alb_per_page);
    $limit = "LIMIT " . $lower_limit . "," . ($upper_limit - $lower_limit);
	#####################  DB  #####################
	$first_record = $lower_limit;
	$records_per_page = ($upper_limit - $lower_limit);
	#############################################

    $sql;
        if(USER_ADMIN_MODE && $cat == (USER_ID + FIRST_USER_CAT)){
            /*$sql = 'SELECT a.aid, a.title, a.description, a.thumb, category, visibility, filepath, ' . 'filename, url_prefix, pwidth, pheight ' . 'FROM ' . $CONFIG['TABLE_ALBUMS'] . ' as a ' . 'LEFT JOIN ' . $CONFIG['TABLE_PICTURES'] . ' as p ' . 'ON a.thumb=p.pid ' . 'WHERE a.owner=' . $USER_DATA['user_id'] . $album_filter . ' ORDER BY a.category DESC , a.pos ' . $limit;
                $alb_thumbs_q = cpg_db_query($sql);
                $alb_thumbs = cpg_db_fetch_rowset($alb_thumbs_q);
                mysql_free_result($alb_thumbs_q);

                //query for the category names
                $cat_name_sql = "SELECT CONCAT(a.title, '" . $lang_list_albums['from_categorie'] . "<i>', c.name, '</i>') FROM " . $CONFIG['TABLE_ALBUMS'] . " AS a LEFT JOIN " . $CONFIG['TABLE_CATEGORIES'] . " AS c ON a.category=c.cid WHERE a.owner=" . $USER_DATA['user_id'] . " ORDER BY a.category DESC , a.pos " . $limit;
                $cat_name_q = cpg_db_query($cat_name_sql);
                $cat_names = cpg_db_fetch_rowset($cat_name_q);
                mysql_free_result($cat_name_q);*/
			##########################  DB  ##############################
                $cpgdb->query($cpg_db_index_php['list_albums_alb_pic_owner'], $USER_DATA['user_id'], $album_filter, $first_record, $records_per_page);
                $alb_thumbs = $cpgdb->fetchRowSet();
                $cpgdb->free();

                //query for the category names
                $cpgdb->query($cpg_db_index_php['list_albums_concat'], $lang_list_albums['from_categorie'], $USER_DATA['user_id'], $first_record, $records_per_page);
                $cat_names = $cpgdb->fetchRowSet();
                $cpgdb->free();
			############################################################

                //replace names in $alb_thumbs array
                foreach($alb_thumbs as $key => $value){
                        if($cat_names[$key][0]!=""){
                                $alb_thumbs[$key]['title'] = $cat_names[$key][0];
                        }
                }
        }else{
            /*$sql = 'SELECT a.aid, a.title, a.description, a.thumb, category, visibility, filepath, ' . 'filename, url_prefix, pwidth, pheight ' . 'FROM ' . $CONFIG['TABLE_ALBUMS'] . ' as a ' . 'LEFT JOIN ' . $CONFIG['TABLE_PICTURES'] . ' as p ' . 'ON a.thumb=p.pid ' . 'WHERE a.category=' . $cat . $album_filter . ' ORDER BY a.pos ' . $limit;
                $alb_thumbs_q = cpg_db_query($sql);
                $alb_thumbs = cpg_db_fetch_rowset($alb_thumbs_q);
                mysql_free_result($alb_thumbs_q);*/
			##########################  DB  ##############################
                $cpgdb->query($cpg_db_index_php['list_albums_alb_pic_cat'], $cat, $album_filter, $first_record, $records_per_page);
                $alb_thumbs = $cpgdb->fetchRowSet();
                $cpgdb->free();
			############################################################
        }

    $disp_album_count = count($alb_thumbs);
    $album_set = '';
    foreach($alb_thumbs as $value) {
        $album_set .= $value['aid'] . ', ';
    }
    $album_set = '(' . substr($album_set, 0, -2) . ')';

    //This query will fetch album stats and keyword for the albums
    /*$sql = "SELECT a.aid, count( p.pid )  AS pic_count, max( p.pid )  AS last_pid, max( p.ctime )  AS last_upload, a.keyword, a.alb_hits" .
            " FROM {$CONFIG['TABLE_ALBUMS']} AS a " .
            " LEFT JOIN {$CONFIG['TABLE_PICTURES']} AS p ON a.aid = p.aid AND p.approved =  'YES' ".
            "WHERE a.aid IN $album_set" . "GROUP BY a.aid";

    $alb_stats_q = cpg_db_query($sql);
    $alb_stats = cpg_db_fetch_rowset($alb_stats_q);
    mysql_free_result($alb_stats_q);*/
	############################  DB  ################################
	$cpgdb->query($cpg_db_index_php['alb_stats_kwrd'], $album_set);
    $alb_stats = $cpgdb->fetchRowSet();
    $cpgdb->free();	
	###############################################################

    foreach($alb_stats as $key => $value) {
        $cross_ref[$value['aid']] = &$alb_stats[$key];

        if ($CONFIG['link_pic_count'] == 1) {
          if (!empty($value['keyword'])) {
            $value['keyword'] = addslashes($value['keyword']);
            /*$query = "SELECT count(pid) AS link_pic_count, max(pid) AS link_last_pid
                      FROM {$CONFIG['TABLE_PICTURES']}
                        WHERE aid != {$value['aid']} AND
                        keywords LIKE '%{$value['keyword']}%' AND
                        approved = 'YES'";
            $result = cpg_db_query($query);
            $link_stat = mysql_fetch_array ($result);
            mysql_free_result($result);*/
		###########################  DB  ##############################
            $cpgdb->query($cpg_db_index_php['list_albums_get_pic_kwrd'], $value['aid'], $value['keyword']);
            $link_stat = $cpgdb->fetchRow();
            $cpgdb->free();		
		#############################################################
            $alb_stats[$key]['link_pic_count'] = $link_stat['link_pic_count'];
            $alb_stats[$key]['last_pid'] = $alb_stats[$key]['last_pid'] ? $alb_stats[$key]['last_pid'] : $link_stat['link_last_pid'];
          }
       }
    }

    for ($alb_idx = 0; $alb_idx < $disp_album_count; $alb_idx++) {
        $alb_thumb = &$alb_thumbs[$alb_idx];
        $aid = $alb_thumb['aid'];

        if (isset($cross_ref[$aid])) {
            $alb_stat = $cross_ref[$aid];
            $count = $alb_stat['pic_count'];
            $alb_hits = $alb_stat['alb_hits'];
        } else {
            $alb_stat = array();
            $count = 0;
            $alb_hits = 0;
        }
        // Inserts a thumbnail if the album contains 1 or more images
        $visibility = $alb_thumb['visibility'];

                if (!in_array($aid,$FORBIDDEN_SET_DATA) || $CONFIG['allow_private_albums'] == 0) {
            if ($count > 0 || $alb_stats[$alb_idx]['link_pic_count'] > 0) {
                if ($alb_thumb['filename']) {
                    $picture = &$alb_thumb;
                } elseif ($alb_thumb['thumb'] < 0) {
                    /*$sql = "SELECT filepath, filename, url_prefix, pwidth, pheight " . "FROM {$CONFIG['TABLE_PICTURES']} WHERE aid = '{$alb_thumb['aid']}' ORDER BY RAND() LIMIT 0,1";
                    $result = cpg_db_query($sql);
                    $picture = mysql_fetch_array($result);
                    mysql_free_result($result);*/
					################  DB  ################
                    $cpg_db_query($cpg_db_index_php['random_pictures'], $alb_thumb['aid']);
                    $picture = $cpgdb->fetchRow();
                    $cpgdb->free();
					###################################
                } else {
                    /*$sql = "SELECT filepath, filename, url_prefix, pwidth, pheight " . "FROM {$CONFIG['TABLE_PICTURES']} " . "WHERE pid='{$alb_stat['last_pid']}'";
                    $result = cpg_db_query($sql);
                    $picture = mysql_fetch_array($result);
                    mysql_free_result($result);*/
					################  DB  #################
                    $cpgdb->query($cpg_db_index_php['get_pictures'], $alb_stat['last_pid']);
                    $picture = $cpgdb->fetchRow();
                    $cpgdb->free();
					####################################
                }
                $pic_url = get_pic_url($picture, 'thumb');
                if (!is_image($picture['filename'])) {
                    $image_info = cpg_getimagesize(urldecode($pic_url));
                    $picture['pwidth'] = $image_info[0];
                    $picture['pheight'] = $image_info[1];
                }
                                //thumb cropping
                //$image_size = compute_img_size($picture['pwidth'], $picture['pheight'], $CONFIG['alb_list_thumb_size']);
                                if($picture['system_icon']=='true'){
                        $image_size = compute_img_size($picture['pwidth'], $picture['pheight'], $CONFIG['alb_list_thumb_size'], true, 'cat_thumb');
                } else {
                                    $image_size = compute_img_size($picture['pwidth'], $picture['pheight'], $CONFIG['alb_list_thumb_size'], false, 'cat_thumb');
                                }

                                $alb_list[$alb_idx]['thumb_pic'] = "<img src=\"" . $pic_url . "\" class=\"image\" {$image_size['geom']} border=\"0\" alt=\"{$picture['filename']}\" />";
            } else { // Inserts an empty thumbnail if the album contains 0 images
                // $image_size = compute_img_size(100, 75, $CONFIG['alb_list_thumb_size']);
                $cpg_nopic_data = cpg_get_system_thumb('nopic.jpg', $alb_thumb['category']);
                $alb_list[$alb_idx]['thumb_pic'] = '<img src="' . $cpg_nopic_data['thumb'] . '" ' . $cpg_nopic_data['whole'] . ' class="image" border="0" alt="" />';
            }
        } elseif ($CONFIG['show_private']) {
            // $image_size = compute_img_size(100, 75, $CONFIG['alb_list_thumb_size']);
            $cpg_privatepic_data = cpg_get_system_thumb('private.jpg', $alb_thumb['category']);
            $alb_list[$alb_idx]['thumb_pic'] = '<img src="' . $cpg_privatepic_data['thumb'] . '" ' . $cpg_privatepic_data['whole'] . ' class="image" border="0" alt="" />';
        }
        // Prepare everything
        if (!in_array($aid,$FORBIDDEN_SET_DATA) || $CONFIG['allow_private_albums'] == 0) {
            $last_upload_date = $count ? localised_date($alb_stat['last_upload'], $lastup_date_fmt) : '';
            $link_pic_count = !empty($alb_stat['link_pic_count']) ? $alb_stat['link_pic_count'] : 0;
            $alb_list[$alb_idx]['aid'] = $alb_thumb['aid'];
            $alb_list[$alb_idx]['album_title'] = $alb_thumb['title'];
            $alb_list[$alb_idx]['album_desc'] = bb_decode($alb_thumb['description']);
            $alb_list[$alb_idx]['pic_count'] = $count;
            $alb_list[$alb_idx]['last_upl'] = $last_upload_date;
            $alb_list[$alb_idx]['link_pic_count'] = $link_pic_count;
            $alb_list[$alb_idx]['alb_hits'] = sprintf($lang_list_albums['alb_hits'], $alb_hits);
            $alb_list[$alb_idx]['album_info'] = sprintf($lang_list_albums['n_pictures'], $count) . ($count ? sprintf($lang_list_albums['last_added'], $last_upload_date) : "") . (($CONFIG['link_pic_count'] && $link_pic_count > 0 ) ? sprintf(", {$lang_list_albums['n_link_pictures']},  {$lang_list_albums['total_pictures']}", $link_pic_count, $count + $link_pic_count) : "");
            $alb_list[$alb_idx]['album_adm_menu'] = album_adm_menu($alb_thumb['aid'], $cat);
} elseif ($CONFIG['show_private']) { // uncomment this else block to show private album description
            $last_upload_date = $count ? localised_date($alb_stat['last_upload'], $lastup_date_fmt) : '';
            $link_pic_count = !empty($alb_stat['link_pic_count']) ? $alb_stat['link_pic_count'] : 0;
            $alb_list[$alb_idx]['aid'] = $alb_thumb['aid'];
            $alb_list[$alb_idx]['album_title'] = $alb_thumb['title'];
            $alb_list[$alb_idx]['album_desc'] = bb_decode($alb_thumb['description']);
            $alb_list[$alb_idx]['pic_count'] = $count;
            $alb_list[$alb_idx]['last_upl'] = $last_upload_date;
            $alb_list[$alb_idx]['link_pic_count'] = $link_pic_count;
            $alb_list[$alb_idx]['alb_hits'] = sprintf($lang_list_albums['alb_hits'], $alb_hits);
            $alb_list[$alb_idx]['album_info'] = sprintf($lang_list_albums['n_pictures'], $count) . ($count ? sprintf($lang_list_albums['last_added'], $last_upload_date) : "") . (($CONFIG['link_pic_count'] && $link_pic_count > 0 ) ? sprintf(", {$lang_list_albums['n_link_pictures']},   {$lang_list_albums['total_pictures']}", $link_pic_count, $count + $link_pic_count) : "");
            $alb_list[$alb_idx]['album_adm_menu'] = album_adm_menu($alb_thumb['aid'], $cat);
}
    }

    theme_display_album_list($alb_list, $nbAlb, $cat, $PAGE, $totalPages);
}

/**
* album_adm_menu()
*
* This has been added to keep the list_albums() function clean.
*
* @param integer $aid Album id
* @param integer $cat Category id
*
* @return html_albummenu($aid) Administration menu
*/
function album_adm_menu($aid, $cat)
{
    global $CONFIG, $USER_DATA, $lang_album_admin_menu;
	global $cpg_db_index_php;
	####################### DB #########################	
		$cpgdb =& cpgDB::getInstance();
		$cpgdb->connect_to_existing($CONFIG['LINK_ID']);
	##################################################	

        //check if user is allowed to edit album
        if(USER_ADMIN_MODE){
                //check if it is the user's gallery
                if($cat == USER_ID + FIRST_USER_CAT){
                    return html_albummenu($aid);
                }
				
                //check if the user is the owner of the album
                /*$sql = "SELECT * FROM {$CONFIG['TABLE_ALBUMS']} WHERE aid='$aid' AND owner='" . $USER_DATA['user_id'] . "'";
                $result = cpg_db_query($sql);
                $check = cpg_db_fetch_rowset($result);*/
				####################  DB  ######################
                $cpgdb->query($cpg_db_index_php['album_adm_menu_get_alb'], $aid, $USER_DATA['user_id']);
                $check = $cpgdb->fetchRowSet();
				#############################################
                if($check[0] != ''){
					//check if admin allows editing after closing category
					if($CONFIG['allow_user_edit_after_cat_close'] == 0){
						//Disallowed -> Check if albums is in such a category
						/*$result = cpg_db_query("SELECT DISTINCT alb.category FROM {$CONFIG['TABLE_ALBUMS']} AS alb INNER JOIN {$CONFIG['TABLE_CATMAP']} AS catm ON alb.category=catm.cid WHERE alb.owner = '" . $USER_DATA['user_id'] . "' AND alb.aid='$aid' AND catm.group_id='" . $USER_DATA['group_id'] . "'");
						$allowed_albums = cpg_db_fetch_rowset($result);*/
						###################  DB  #####################
						$cpgdb->query($cpg_db_index_php['album_adm_menu_dist_alb_cat'], $USER_DATA['user_id'], $aid, $USER_DATA['group_id']);
						$allowed_albums = $cpgdb->fetchRowSet();
						############################################
						if($allowed_albums[0]['category'] == ''){
							return "<b>" . $lang_album_admin_menu['cat_locked'] . "</b>";
						}
					}
					if(!$CONFIG['users_can_edit_pics']) {
						//return menu without edit pics button
						return html_albummenu3($aid);
					} else {
						//return whole menu
						return html_albummenu($aid);
					}  
                } else {
					return '';
				}
        }else if(GALLERY_ADMIN_MODE){
            return html_albummenu($aid);
        }else if(in_array($alb_thumb['aid'], $USER_DATA['allowed_albums'])){
            //check for moderator rights
            return html_albummenu2($aid);
        }else{
            return '';
        }
}


/**
* list_cat_albums()
*
* This has been added to list the albums in a category, used for showing first level albumslargely a repetition of code elsewhere
* Redone for a cleaner approach
* @param integer $cat Category id for which albums are needed
*/
function list_cat_albums($cat = 0)
{
    global $CONFIG, $USER, $lastup_date_fmt, $USER_DATA, $FORBIDDEN_SET, $FORBIDDEN_SET_DATA, $cpg_show_private_album;
    global $lang_list_albums, $lang_errors;
	global $cpg_db_index_php;
	####################### DB #########################	
		$cpgdb =& cpgDB::getInstance();
		$cpgdb->connect_to_existing($CONFIG['LINK_ID']);
	##################################################	

    $PAGE = 1;
    if ($cat == 0) {
        return '';
    }

    $cat_owner_id = ($cat > 10000)?(10000 - $cat):(10001);
    $cpg_nopic_data = cpg_get_system_thumb('nopic.jpg', $cat_owner_id);
    $cpg_privatepic_data = cpg_get_system_thumb('private.jpg', $cat_owner_id);

    $alb_per_page = $CONFIG['albums_per_page'];
    $maxTab = $CONFIG['max_tabs'];

    $album_filter = '';
    $pic_filter = '';
    if (!empty($FORBIDDEN_SET) && !$cpg_show_private_album) {
        $album_filter = ' and ' . str_replace('p.', 'a.', $FORBIDDEN_SET);
        $pic_filter = ' and ' . $FORBIDDEN_SET;
    }

    /*$sql = "SELECT count(aid) FROM {$CONFIG['TABLE_ALBUMS']} as a WHERE category = '$cat'" . $album_filter;
    $result = cpg_db_query($sql);
    $nbEnr = mysql_fetch_array($result);
    $nbAlb = $nbEnr[0];
    mysql_free_result($result);*/
	##################  DB  ####################
    $cpgdb->query($cpg_db_index_php['list_cat_alb_count_alb'], $cat, $album_filter);
    $nbEnr = $cpgdb->fetchRow();
    $nbAlb = $nbEnr[0];
    $cpgdb->free();
	###########################################

    if ($nbAlb == 0) {
        return;
    }

    $totalPages = ceil($nbAlb / $alb_per_page);

    if ($PAGE > $totalPages) $PAGE = 1;
    $lower_limit = ($PAGE-1) * $alb_per_page;
    $upper_limit = min($nbAlb, $PAGE * $alb_per_page);
    $limit = "LIMIT " . $lower_limit . "," . ($upper_limit - $lower_limit);
	#####################  DB  #####################
	$first_record = $lower_limit;
	$records_per_page = ($upper_limit - $lower_limit);
	#############################################

    /*$sql = 'SELECT a.aid, a.title, a.description, a.thumb, visibility, filepath, ' . 'filename, url_prefix, pwidth, pheight ' . 'FROM ' . $CONFIG['TABLE_ALBUMS'] . ' as a ' . 'LEFT JOIN ' . $CONFIG['TABLE_PICTURES'] . ' as p ' . 'ON a.thumb=p.pid ' . 'WHERE category=' . $cat . $album_filter . ' ORDER BY a.pos ' . $limit;

    $alb_thumbs_q = cpg_db_query($sql);
    $alb_thumbs = cpg_db_fetch_rowset($alb_thumbs_q);
    mysql_free_result($alb_thumbs_q);*/
	###################  DB  #####################
    $cpgdb->query($cpg_db_index_php['list_cat_alb_join_pic'], $cat, $album_filter, $first_record, $records_per_page);
    $alb_thumbs = $cpgdb->fetchRowSet();
    $cpgdb->free();
	############################################

    $disp_album_count = count($alb_thumbs);
    $album_set = '';
    foreach($alb_thumbs as $value) {
        $album_set .= $value['aid'] . ', ';
    }
    $album_set = '(' . substr($album_set, 0, -2) . ')';

    /*$sql = "SELECT aid, count(pid) as pic_count, max(pid) as last_pid, max(ctime) as last_upload " . "FROM {$CONFIG['TABLE_PICTURES']} " . "WHERE aid IN $album_set AND approved = 'YES' " . "GROUP BY aid";
    $alb_stats_q = cpg_db_query($sql);
    $alb_stats = cpg_db_fetch_rowset($alb_stats_q);
    mysql_free_result($alb_stats_q);*/

    //This query will fetch album stats and keyword for the albums
    /*$sql = "SELECT a.aid, count( p.pid )  AS pic_count, max( p.pid )  AS last_pid, max( p.ctime )  AS last_upload, a.keyword, a.alb_hits" .
            " FROM {$CONFIG['TABLE_ALBUMS']} AS a " .
            " LEFT JOIN {$CONFIG['TABLE_PICTURES']} AS p ON a.aid = p.aid AND p.approved =  'YES' ".
            "WHERE a.aid IN $album_set" . "GROUP BY a.aid";
    $alb_stats_q = cpg_db_query($sql);
    $alb_stats = cpg_db_fetch_rowset($alb_stats_q);
    mysql_free_result($alb_stats_q);*/
	#####################  DB  #######################
    $cpg_db_query($cpg_db_index_php['alb_stats_kwrd'], $album_set);
    $alb_stats = $cpgdb->fetchRowSet();
    $cpgdb_free();
	################################################

    foreach($alb_stats as $key => $value) {
        $cross_ref[$value['aid']] = &$alb_stats[$key];
        if ($CONFIG['link_pic_count'] == 1) {
          if (!empty($value['keyword'])) {
            /*$query = "SELECT count(pid) AS link_pic_count
                      FROM {$CONFIG['TABLE_PICTURES']}
                        WHERE aid != {$value['aid']} AND
                        keywords LIKE '%{$value['keyword']}%' AND
                        approved = 'YES'";
            $result = cpg_db_query($query);
            $link_stat = mysql_fetch_array ($result);
            mysql_free_result($result);*/
			###################  DB  #####################
            $cpgdb->query($cpg_db_index_php['list_cat_alb_kwrd_pic_srch'], $value['aid'], $value['keyword']);
            $link_stat = $cpgdb->fetchRow();
            $cpgdb->free();
			############################################
            $alb_stats[$key]['link_pic_count'] = $link_stat['link_pic_count'];
          }
       }
    }

    for ($alb_idx = 0; $alb_idx < $disp_album_count; $alb_idx++) {
        $alb_thumb = &$alb_thumbs[$alb_idx];
        $aid = $alb_thumb['aid'];

        if (isset($cross_ref[$aid])) {
            $alb_stat = $cross_ref[$aid];
            $count = $alb_stat['pic_count'];
            $alb_hits = $alb_stat['alb_hits'];
        } else {
            $alb_stat = array();
            $count = 0;
            $alb_hits = 0;
        }
        // Inserts a thumbnail if the album contains 1 or more images
        $visibility = $alb_thumb['visibility'];
                if (!in_array($aid,$FORBIDDEN_SET_DATA) || $CONFIG['allow_private_albums'] == 0) { //test for visibility
            if ($count > 0) { // Inserts a thumbnail if the album contains 1 or more images
                if ($alb_thumb['filename']) {
                    $picture = &$alb_thumb;
                } elseif ($alb_thumb['thumb'] < 0) {
                    /*$sql = "SELECT filepath, filename, url_prefix, pwidth, pheight " . "FROM {$CONFIG['TABLE_PICTURES']} WHERE aid = '{$alb_thumb['aid']}' ORDER BY RAND() LIMIT 0,1";
                    $result = cpg_db_query($sql);
                    $picture = mysql_fetch_array($result);
                    mysql_free_result($result);*/
					################  DB  ##################
                    $cpg_db_query($cpg_db_index_php['random_pictures'], $alb_thumb['aid']);
                    $picture = $cpgdb->fetchRow();
                    $cpgdb->free();
					#####################################
                } else {
                    /*$sql = "SELECT filepath, filename, url_prefix, pwidth, pheight " . "FROM {$CONFIG['TABLE_PICTURES']} " . "WHERE pid='{$alb_stat['last_pid']}'";
                    $result = cpg_db_query($sql);
                    $picture = mysql_fetch_array($result);
                    mysql_free_result($result);*/
					################  DB  ###################
                    $result = cpg_db_query($cpg_db_index_php['get_pictures'], $alb_stat['last_pid']);
                    $picture = $cpgdb->fetchRow();
                    $cpgdb->free();
					######################################
                }
                $pic_url = get_pic_url($picture, 'thumb');
                if (!is_image($picture['filename'])) {
                    $image_info = cpg_getimagesize(urldecode($pic_url));
                    $picture['pwidth'] = $image_info[0];
                    $picture['pheight'] = $image_info[1];
                }
                                //thumb cropping
                                if($picture['system_icon']=='true'){
                        $image_size = compute_img_size($picture['pwidth'], $picture['pheight'], $CONFIG['alb_list_thumb_size'], true, 'cat_thumb');
                } else {
                                    $image_size = compute_img_size($picture['pwidth'], $picture['pheight'], $CONFIG['alb_list_thumb_size'], false, 'cat_thumb');
                                }

                                $alb_list[$alb_idx]['thumb_pic'] = "<img src=\"" . $pic_url . "\" class=\"image\" {$image_size['geom']} border=\"0\" alt=\"{$picture['filename']}\" />";
            } else { // Inserts an empty thumbnail if the album contains 0 images
                // $image_size = compute_img_size(100, 75, $CONFIG['alb_list_thumb_size']);
                $alb_list[$alb_idx]['thumb_pic'] = '<img src="' . $cpg_nopic_data['thumb'] . '" ' . $cpg_nopic_data['whole'] . ' class="image" border="0" alt="" />';
            }
        } elseif ($CONFIG['show_private']) {
            // $image_size = compute_img_size(100, 75, $CONFIG['alb_list_thumb_size']);
            $alb_list[$alb_idx]['thumb_pic'] = '<img src="' . $cpg_privatepic_data['thumb'] . '" ' . $cpg_privatepic_data['whole'] . ' class="image" border="0" alt="" />';
        }
        // Prepare everything
        if (!in_array($aid,$FORBIDDEN_SET_DATA) || $CONFIG['allow_private_albums'] == 0) {
            $last_upload_date = $count ? localised_date($alb_stat['last_upload'], $lastup_date_fmt) : '';
            $link_pic_count = !empty($alb_stat['link_pic_count']) ? $alb_stat['link_pic_count'] : 0;
            $alb_list[$alb_idx]['aid'] = $alb_thumb['aid'];
            $alb_list[$alb_idx]['album_title'] = $alb_thumb['title'];
            $alb_list[$alb_idx]['album_desc'] = bb_decode($alb_thumb['description']);
            $alb_list[$alb_idx]['pic_count'] = $count;
            $alb_list[$alb_idx]['last_upl'] = $last_upload_date;
            $alb_list[$alb_idx]['alb_hits'] = sprintf($lang_list_albums['alb_hits'], $alb_hits);
            $alb_list[$alb_idx]['album_info'] = sprintf($lang_list_albums['n_pictures'], $count) . ($count ? sprintf($lang_list_albums['last_added'], $last_upload_date) : "") . (($CONFIG['link_pic_count'] && $link_pic_count > 0)  ? sprintf(", {$lang_list_albums['n_link_pictures']}, {$lang_list_albums['total_pictures']}", $link_pic_count, $count + $link_pic_count) : "");
            $alb_list[$alb_idx]['album_adm_menu'] = album_adm_menu($alb_thumb['aid'], $cat);
} elseif ($CONFIG['show_private']) { // uncomment this else block to show private album description
            $last_upload_date = $count ? localised_date($alb_stat['last_upload'], $lastup_date_fmt) : '';
            $link_pic_count = !empty($alb_stat['link_pic_count']) ? $alb_stat['link_pic_count'] : 0;
            $alb_list[$alb_idx]['aid'] = $alb_thumb['aid'];
            $alb_list[$alb_idx]['album_title'] = $alb_thumb['title'];
            $alb_list[$alb_idx]['album_desc'] = bb_decode($alb_thumb['description']);
            $alb_list[$alb_idx]['pic_count'] = $count;
            $alb_list[$alb_idx]['last_upl'] = $last_upload_date;
            $alb_list[$alb_idx]['alb_hits'] = sprintf($lang_list_albums['alb_hits'], $alb_hits);
            $alb_list[$alb_idx]['album_info'] = sprintf($lang_list_albums['n_pictures'], $count) . ($count ? sprintf($lang_list_albums['last_added'], $last_upload_date) : "") . (($CONFIG['link_pic_count'] && $link_pic_count > 0 )? sprintf(", {$lang_list_albums['n_link_pictures']}, {$lang_list_albums['total_pictures']}", $link_pic_count, $count + $link_pic_count) : "");
            $alb_list[$alb_idx]['album_adm_menu'] = album_adm_menu($alb_thumb['aid'], $cat);
}
    }
    ob_start();
    theme_display_album_list_cat($alb_list, $nbAlb, $cat, $PAGE, $totalPages);
    $cat_albums = ob_get_contents();
    ob_end_clean();
    return $cat_albums;
}

//
// Main code
//
if (!$file) {

    /**
    * See if $page has been passed in GET
    */
    if (isset($page)) {
        $PAGE = max($page, 1);
        $USER['lap'] = $PAGE;
    } elseif (isset($USER['lap'])) {
        $PAGE = max((int)$USER['lap'], 1);
    } else {
        $PAGE = 1;
    }

    // Gather data for categories
    $breadcrumb = '';
    $cat_data = array();
    $statistics = '';
    $STATS_IN_ALB_LIST = false;

    $cpg_show_private_album = ($CONFIG['allow_private_albums'])?($CONFIG['show_private']):(true);

    if (isset($cat)) {
        get_meta_album_set($cat,$META_ALBUM_SET);
    } else {
        get_meta_album_set(0,$META_ALBUM_SET);
    }

    get_cat_list($breadcrumb, $cat_data, $statistics);

    pageheader($BREADCRUMB_TEXT ? $BREADCRUMB_TEXT : $lang_index_php['welcome']);

    $elements = preg_split("|/|", $CONFIG['main_page_layout'], -1, PREG_SPLIT_NO_EMPTY);

    /**
     * Loop through the $elements array to build the page using the parameters
     * set in the config
     */
    foreach ($elements as $element) {
        if (preg_match("/(\w+),*(\d+)*/", $element, $matches)){
            if (!isset($matches[2])) { // added to fix notice about undefined index
                $matches[2] = 0;
            }

            $matches = CPGPluginAPI::filter('plugin_block', $matches);

            if (is_array($matches)) {
                switch ($matches[1]) {
                    case 'breadcrumb':
                        // Added breadcrumb as a separate listable block from config
                        if (($breadcrumb != '' || count($cat_data) > 0) && $cat != 0) theme_display_breadcrumb($breadcrumb, $cat_data);
                        break;

                    case 'catlist':
                        if ($breadcrumb != '' || count($cat_data) > 0) theme_display_cat_list($breadcrumb, $cat_data, $statistics);
                        if (isset($cat) && $cat == USER_GAL_CAT) {
                            list_users();
                        }
                        flush();
                        break;

                    case 'alblist':
                        list_albums();
                        flush();
                        break;

                    case 'random':
                        display_thumbnails('random', $cat, 1, $CONFIG['thumbcols'], max(1, $matches[2]), false);
                        flush();
                        break;

                    case 'lastup':
                        display_thumbnails('lastup', $cat, 1, $CONFIG['thumbcols'], max(1, $matches[2]), false);
                        flush();
                        break;

                    case 'lastalb':
                        display_thumbnails('lastalb', $cat, 1, $CONFIG['thumbcols'], max(1, $matches[2]), false);
                        break;

                    case 'topn':
                        display_thumbnails('topn', $cat, 1, $CONFIG['thumbcols'], max(1, $matches[2]), false);
                        flush();
                        break;

                    case 'toprated':
                        display_thumbnails('toprated', $cat, 1, $CONFIG['thumbcols'], max(1, $matches[2]), false);
                        flush();
                        break;

                    case 'lastcom':
                        display_thumbnails('lastcom', $cat, 1, $CONFIG['thumbcols'], max(1, $matches[2]), false);
                        flush();
                        break;

                    case 'lasthits':
                        display_thumbnails('lasthits', $cat, 1, $CONFIG['thumbcols'], max(1, $matches[2]), false);
                        flush();
                        break;

                    case 'anycontent':
                        if ($cat == 0) {
                            ob_start();
                            /**
                             * Any php code or HTML can be put in this file and will be displayed
                             */
                            include('anycontent.php');
                            $anycontent = CPGPluginAPI::filter('anycontent',ob_get_contents());
                            ob_end_clean();
                            echo ($anycontent);
                        }
                        flush();
                        break;
                }
            }
        }
    }

    pagefooter();
}

ob_end_flush();

/* Not used anymore, somone else removed the usage of this keying in functions.inc.php due to problems - donnoman
// Speed-up the random image query by 'keying' the image table
if (time() - $CONFIG['randpos_interval'] > 86400) {
    $result = cpg_db_query("SELECT count(*) FROM {$CONFIG['TABLE_PICTURES']} WHERE 1");
    $nbEnr = mysql_fetch_array($result);
    mysql_free_result($result);
    $pic_count = $nbEnr[0];
    $granularity = floor($pic_count / RANDPOS_MAX_PIC);
    $result = cpg_db_query("UPDATE {$CONFIG['TABLE_PICTURES']} SET randpos = ROUND(RAND()*$granularity) WHERE 1");
    $result = cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '" . time() . "' WHERE name = 'randpos_interval'");
}
*/
?>