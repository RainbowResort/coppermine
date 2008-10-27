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

/**
 * Coppermine Photo Gallery 1.4.2 thumbnails.php
 *
 * This file generates the data of thumbnails for all the albums and metalbums,
 * the actual display is handled by the display_thumbnails and then in-turn
 * theme_display_thumbnail function
 *
 * @copyright 2002-2006 Gregory DEMAR, Coppermine Dev Team
 * @license http://opensource.org/licenses/gpl-license.php GNU General Public License V2
 * @package Coppermine
 * @version $Id$
 */

/**
 *
 * @ignore
 */
define('IN_COPPERMINE', true);

define('THUMBNAILS_PHP', true);

/**
 *
 * @ignore
 */
define('INDEX_PHP', true);

require_once ('include/init.inc.php');

if (!USER_ID && $CONFIG['allow_unlogged_access'] == 0) {
    $redirect = $redirect . "login.php";
    header("Location: $redirect");
    exit();
}

if ($CONFIG['enable_smilies']) include("include/smilies.inc.php");

/**
 * Main code
 */
if ($superCage->get->keyExists('sort')) {
	$USER['sort'] = $superCage->get->getAlpha('sort');
}
if ($superCage->get->keyExists('cat')) {
    $cat = $superCage->get->getInt('cat');
}
if ($superCage->get->keyExists('uid')) {
    $USER['uid'] = $superCage->get->getInt('uid');
}

if ($superCage->get->keyExists('album')) {
    if ($superCage->get->testAlpha('album')) {
        $album = $superCage->get->getAlpha('album');
    } else {
        $album = $superCage->get->getInt('album');
    }
}

//if (isset($_GET['search'])) {
if ($superCage->get->keyExists('search')) {
    // find out if a parameter has been submitted at all
    $allowed = array('title', 'caption', 'keywords', 'owner_name', 'filename', 'pic_raw_ip', 'pic_hdr_ip', 'user1', 'user2', 'user3', 'user4');
    foreach ($allowed as $key) {
        //if (isset($_GET[$key]) == TRUE) {
        if ($superCage->get->keyExists($key)) {
			//can't work like this, have to remove the $_GET
            //$_GET['params'][$key] = $_GET[$key];
			#####################################################################
			##We use the raw again, have to look into this a little more later.##
			#####################################################################
			$temp_GET['params'][$key] = $superCage->get->getRaw($key);
        }
    }
        //$USER['search'] = $_GET;
		$USER['search'] = $temp_GET;
		//here again the use of getRaw, but it will be sanitized in search.inc.php
        $USER['search']['search'] = utf_replace($superCage->get->getRaw('search'));
        $USER['search']['search'] = str_replace('&quot;','\'',$USER['search']['search']);
        $album = 'search';
}
//no need for this anymore
//if (isset($_GET['search'])) {
//    $USER['search'] = array('search' => $_GET['search']);
//}

//if (isset($_GET['page'])) {
if ($superCage->get->keyExists('page')) {
    $page = max($superCage->get->getInt('page'), 1);
} else {
    $page = 1;
}

$breadcrumb = '';
$breadcrumb_text = '';
$cat_data = array();
$lang_meta_album_names['lastupby'] = $lang_meta_album_names['lastup'];
$lang_meta_album_names['lastcomby'] = $lang_meta_album_names['lastcom'];

if (isset($album) && is_numeric($album)) {
    $result = cpg_db_query("SELECT category, title, aid, keyword, description, alb_password_hint FROM {$CONFIG['TABLE_ALBUMS']} WHERE aid='$album'");
    if (mysql_num_rows($result) > 0) {
        $CURRENT_ALBUM_DATA = mysql_fetch_array($result);
        $actual_cat = $CURRENT_ALBUM_DATA['category'];
        $CURRENT_ALBUM_KEYWORD = $CURRENT_ALBUM_DATA['keyword'];
        breadcrumb($actual_cat, $breadcrumb, $breadcrumb_text);
        $cat = - $album;
    }
} elseif (isset($cat)) { // Meta albums, we need to restrict the albums to the current category
    if ($cat < 0) {
        $result = cpg_db_query("SELECT category, title, aid, keyword, description, alb_password_hint FROM {$CONFIG['TABLE_ALBUMS']} WHERE aid='" . (- $cat) . "'");
        if (mysql_num_rows($result) > 0) {
            $CURRENT_ALBUM_DATA = mysql_fetch_array($result);
            $actual_cat = $CURRENT_ALBUM_DATA['category'];
            $CURRENT_ALBUM_KEYWORD = $CURRENT_ALBUM_DATA['keyword'];
        }
        
        get_meta_album_set($cat);
        
        breadcrumb($actual_cat, $breadcrumb, $breadcrumb_text);
        $CURRENT_CAT_NAME = $CURRENT_ALBUM_DATA['title'];
        $CURRENT_ALBUM_KEYWORD = $CURRENT_ALBUM_DATA['keyword'];
        
    } elseif ($cat == 0) {
    	get_meta_album_set(0);
    } else {

        if ($cat >= FIRST_USER_CAT) {
            $user_name = get_username($cat - FIRST_USER_CAT);
            $CURRENT_CAT_NAME = sprintf($lang_list_categories['xx_s_gallery'], $user_name);
        } else {
            $result = cpg_db_query("SELECT name FROM {$CONFIG['TABLE_CATEGORIES']} WHERE cid = '$cat'");
            if (mysql_num_rows($result) == 0) cpg_die(CRITICAL_ERROR, $lang_errors['non_exist_cat'], __FILE__, __LINE__);
            $row = mysql_fetch_array($result);
            $CURRENT_CAT_NAME = $row['name'];
        }

        get_meta_album_set($cat);

        breadcrumb($cat, $breadcrumb, $breadcrumb_text);
    }
} else {
	get_meta_album_set(0);
}

if (isset($CURRENT_ALBUM_DATA)) {
    $section = $CURRENT_ALBUM_DATA['title'];
} elseif (isset($album) && array_key_exists($album,$lang_meta_album_names)) {
    $section = $lang_meta_album_names[$album];
} else {
    $section = '';
}
$meta_keywords = '';
// keep the search engine spiders from indexing meta albums that are subject to constant changes
// if($_GET['album'] == 'lastup' || $_GET['album'] == 'lastcom' || $_GET['album'] == 'topn' || $_GET['album'] == 'toprated' || $_GET['album'] == 'favpics' || $_GET['album'] == 'random') {  
$meta_albums_array = array('lastup', 'lastcom', 'topn', 'toprated', 'favpics', 'random', 'datebrowse');
if(in_array($superCage->get->getAlpha('album'), $meta_albums_array)) {
    $meta_keywords .= '<meta name="robots" content="noindex, nofollow" />';
}
pageheader($section, $meta_keywords);
if ($breadcrumb) {
    if (!(strpos($CONFIG['main_page_layout'], "breadcrumb") === false)) {
        theme_display_breadcrumb($breadcrumb, $cat_data);
    }
    theme_display_cat_list($breadcrumb, $cat_data, '');
}

/**
 * Function to draw the password box if the album is password protected
 */
function form_albpw()
{
    global $lang_thumb_view, $CURRENT_ALBUM_DATA;

    $superCage = Inspekt::makeSuperCage();

    starttable('-1', $lang_thumb_view['enter_alb_pass'], 2);
    if ($superCage->post->keyExists('validate_album')) {
        $login_failed = "<tr><td class='tableh2' colspan='2' align='center'>
                               <span style='color:red'>{$lang_thumb_view['invalid_pass']}</span></td></tr>
                                         ";
    }
    if (!empty($CURRENT_ALBUM_DATA['alb_password_hint'])) {
        echo <<<EOT
                  <tr>
                    <td colspan="2" align="center" class="tableb">{$CURRENT_ALBUM_DATA['alb_password_hint']}</td>
                  </tr>
EOT;
    }
    echo <<<EOT
                        $login_failed
                        <tr>
              <form name="cpgform" id="cpgform" method="post" action="">
              <input type="hidden" name="validate_album" value="validate_album"/>
              <td class="tableb" width="40%">{$lang_thumb_view['pass']}: </td>
              <td class="tableb" width="60%"><input type="password" class="textinput" name="password" /></td>
             </tr>
             <tr>
              <td class="tablef" colspan="2" align="center"><input type="submit" class="button" name="submit" value={$lang_thumb_view['submit']} />
              </form>
            </tr>
EOT;
    endtable();
}

$valid = false; //flag to test whether the album is validated.
if ($CONFIG['allow_private_albums'] == 0 || !in_array($album, $FORBIDDEN_SET_DATA)) {
    $valid = true;
} elseif ($superCage->post->keyExists('validate_album')) {
    $password = md5($superCage->post->getEscaped('password'));
    $sql = "SELECT aid FROM " . $CONFIG['TABLE_ALBUMS'] . " WHERE alb_password='$password' AND aid='$album'";
    $result = cpg_db_query($sql);
    if (mysql_num_rows($result)) {
        $albpw = $superCage->cookie->getEscaped($CONFIG['cookie_name'] . '_albpw');
        if (!empty($albpw)) {
            $albpw = unserialize($albpw);
        }
        $albpw[$album] = $password;
        $alb_cookie_str = serialize($albpw);

        setcookie($CONFIG['cookie_name'] . "_albpw", $alb_cookie_str);
        get_private_album_set($album);
        $valid = true;
    } else {
        // Invalid password
        $valid = false;
    }
} else {
    $sql = "SELECT aid FROM " . $CONFIG['TABLE_ALBUMS'] . " WHERE aid='$album' AND alb_password != ''";
    $result = cpg_db_query($sql);
    if (mysql_num_rows($result)) {
        // This album has a password.
        // Check whether the cookie is set for the current albums password
        $albpw = $superCage->cookie->getEscaped($CONFIG['cookie_name'] . '_albpw');
        if (!empty($albpw)) {
            $alb_pw = unserialize($albpw);
            // Check whether the alubm id in the cookie is same as that of the album id send by get
            if (isset($alb_pw[$album])) {
                $sql = "SELECT aid FROM " . $CONFIG['TABLE_ALBUMS'] . " WHERE alb_password='{$alb_pw[$album]}' AND aid='{$album}'";
                $result = cpg_db_query($sql);
                if (mysql_num_rows($result)) {
                    $valid = true; //The album password is correct. Show the album details.
                    get_private_album_set();
                }
            }
        }
    } else {
        // Album with no password. Might be a private or normal album. Just set valid as true.
        $valid = true;
    }
}

CPGPluginAPI::filter('post_breadcrumb',null);

if (!$valid) {
    form_albpw();
} else {
    display_thumbnails($album, (isset($cat) ? $cat : 0), $page, $CONFIG['thumbcols'], $CONFIG['thumbrows'], true);
}

pagefooter();
ob_end_flush();

?>
