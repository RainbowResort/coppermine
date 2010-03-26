<?php

// ------------------------------------------------------------------------- //
// This theme has had redundant CORE items removed                           //
// ------------------------------------------------------------------------- //
define('THEME_HAS_RATING_GRAPHICS', 1);
define('THEME_HAS_PROGRESS_GRAPHICS', 1);
define('THEME_HAS_MENU_ICONS', 16);
define('THEME_HAS_NAVBAR_GRAPHICS', 16);

// HTML template for template  sub menu buttons
$template_sys_menu_button = $template_sub_menu_button = <<<EOT
<!-- BEGIN {BLOCK_ID} -->
    <li>
        <a href="{HREF_TGT}" title="" class="firstlevel"><span class="firstlevel">{HREF_LNK}</span></a>
    </li>
<!-- END {BLOCK_ID} -->
EOT;

// HTML template for sys menu
$template_sys_menu = <<<EOT

<ul class="dropmenu">
<!-- BEGIN home -->
    <li>
        <a href="{HOME_TGT}" title="" class="firstlevel" id="sbut_left"><span class="firstlevel" id="sbut_right">{HOME_ICO}&nbsp;Start</span></a>
        <ul>
            <!-- BEGIN register -->
                <li><a href="{REGISTER_TGT}" title=""><span>{REGISTER_ICO}&nbsp;{REGISTER_LNK}</span></a></li>
            <!-- END register -->
            <!-- BEGIN login -->
                <li><a href="{LOGIN_TGT}" title=""><span>{LOGIN_ICO}&nbsp;{LOGIN_LNK}</span></a></li>
            <!-- END login -->
            <!-- BEGIN logout -->
                <li><a href="{LOGOUT_TGT}" title=""><span>{LOGOUT_ICO}&nbsp;{LOGOUT_LNK}</span></a></li>
            <!-- END logout -->
            <!-- BEGIN sidebar -->
                <li><a href="{SIDEBAR_TGT}" title=""><span>{SIDEBAR_ICO}&nbsp;{SIDEBAR_LNK}</span></a></li>
            <!-- END sidebar -->
            <!-- BEGIN contact -->
                <li><a href="{CONTACT_TGT}" title=""><span>{CONTACT_ICO}&nbsp;{CONTACT_LNK}</span></a></li>
            <!-- END contact --> 
            <!-- BEGIN allow_memberlist -->
                <li><a href="{MEMBERLIST_TGT}" title=""><span>{MEMBERLIST_ICO}&nbsp;{MEMBERLIST_LNK}</span></a></li>
            <!-- END allow_memberlist -->
            <!-- BEGIN search -->
                <li><a href="{SEARCH_TGT}" title=""><span>{SEARCH_ICO}&nbsp;{SEARCH_LNK}</span></a></li>
            <!-- END search -->
        </ul>
    </li>
<!-- END home -->

<!-- BEGIN custom_link -->
    <li>
        <a href="{CUSTOM_LNK_TGT}" title="" class="firstlevel"><span class="firstlevel">{CUSTOM_LNK_LNK}</span></a>
    </li>
<!-- END custom_link -->

<!-- BEGIN album_list -->
    <li>
        <a href="{ALB_LIST_TGT}" title="" class="firstlevel"><span class="firstlevel">{ALB_LIST_ICO}&nbsp;{ALB_LIST_LNK}</span></a>
        <ul>
            <!-- BEGIN lastup -->
                <li><a href="{LASTUP_TGT}" title="" rel="nofollow"><span>{LASTUP_ICO}&nbsp;{LASTUP_LNK}</span></a></li>
            <!-- END lastup -->
            <!-- BEGIN lastcom -->
                <li><a href="{LASTCOM_TGT}" title="" rel="nofollow" ><span>{LASTCOM_ICO}&nbsp;{LASTCOM_LNK}</span></a></li>
            <!-- END lastcom -->
            <!-- BEGIN topn -->
                <li><a href="{TOPN_TGT}" title="" rel="nofollow"><span>{TOPN_ICO}&nbsp;{TOPN_LNK}</span></a></li>
            <!-- END topn -->
            <!-- BEGIN toprated -->
                <li><a href="{TOPRATED_TGT}" title="" rel="nofollow"><span>{TOPRATED_ICO}&nbsp;{TOPRATED_LNK}</span></a></li>
            <!-- END toprated -->
            <!-- BEGIN favpics -->
                <li><a href="{FAV_TGT}" title="" rel="nofollow"><span>{FAV_ICO}&nbsp;{FAV_LNK}</span></a></li>
            <!-- END favpics -->
            <!-- BEGIN browse_by_date -->
                <li><a href="{BROWSEBYDATE_TGT}" title="" rel="nofollow" class="greybox"><span>{BROWSEBYDATE_ICO}&nbsp;{BROWSEBYDATE_LNK}</span></a></li>
            <!-- END browse_by_date -->
        </ul>
    </li>
<!-- END album_list -->

<!-- BEGIN my_gallery -->
    <li>
        <a href="{MY_GAL_TGT}" title="" class="firstlevel"><span class="firstlevel">{MY_GAL_ICO}&nbsp;{MY_GAL_LNK}</span></a>
        <ul>
            <!-- BEGIN my_profile -->
                <li><a href="{MY_PROF_TGT}" title=""><span>{MY_PROF_ICO}&nbsp;{MY_PROF_LNK}</span></a></li>
            <!-- END my_profile -->
            <!-- BEGIN allow_memberlist -->
                <li><a href="{MEMBERLIST_TGT}" title=""><span>{MEMBERLIST_ICO}&nbsp;{MEMBERLIST_LNK}</span></a></li>
            <!-- END allow_memberlist -->
            <!-- BEGIN upload_approval -->
                <li><a href="{UPL_APP_TGT}" title=""><span>{UPL_APP_ICO}&nbsp;{UPL_APP_LNK}</span></a></li>
            <!-- END upload_approval -->
            <!-- BEGIN enter_admin_mode -->
                <li><a href="{ADM_MODE_TGT}" title=""><span>{ADM_MODE_ICO}&nbsp;{ADM_MODE_LNK}</span></a></li>
            <!-- END enter_admin_mode -->
            <!-- BEGIN leave_admin_mode -->
                <li><a href="{USR_MODE_TGT}" title=""><span>{USR_MODE_ICO}&nbsp;{USR_MODE_LNK}</span></a></li>
            <!-- END leave_admin_mode -->
        </ul>
    </li>
<!-- END my_gallery -->


<!-- BEGIN upload_pic -->
    <li>
        <a href="{UPL_PIC_TGT}" title="" class="firstlevel"><span class="firstlevel">{UPL_PIC_ICO}{UPL_PIC_LNK}</span></a>
    </li>
<!-- END upload_pic -->
</ul>

EOT;

// HTML template for gallery admin menu
$template_gallery_admin_menu = <<<EOT
              <ul class="dropmenu">
                                <li>
                                    <a href="#" title="" class="firstlevel"><span class="firstlevel">{FILES_ICO}&nbsp;{FILES_LNK}</span></a>
                                    <ul>
                                    <!-- BEGIN admin_approval -->
                                        <li><a href="editpics.php?mode=upload_approval" title=""><span>{UPL_APP_ICO}&nbsp;{UPL_APP_LNK}</span></a></li>
                                    <!-- END admin_approval -->
                                    <!-- BEGIN catmgr -->
                                        <li><a href="catmgr.php" title=""><span>{CATEGORIES_ICO}&nbsp;{CATEGORIES_LNK}</span></a></li>
                                    <!-- END catmgr -->
                                    <!-- BEGIN albmgr -->
                                        <li><a href="albmgr.php{CATL}" title=""><span>{ALBUMS_ICO}&nbsp;{ALBUMS_LNK}</span></a></li>
                                    <!-- END albmgr -->
                                    <!-- BEGIN picmgr -->
                                        <li><a href="picmgr.php" title=""><span>{PICTURES_ICO}&nbsp;{PICTURES_LNK}</span></a></li>
                                    <!-- end picmgr -->
                                    <!-- BEGIN batch_add -->
                                        <li><a href="searchnew.php" title=""><span>{SEARCHNEW_ICO}&nbsp;{SEARCHNEW_LNK}</span></a></li>
                                    <!-- END batch_add -->
                                    <!-- BEGIN admin_tools -->
                                        <li><a href="util.php?t={TIME_STAMP}#admin_tools" title=""><span>{UTIL_ICO}&nbsp;{UTIL_LNK}</span></a></li>
                                    <!-- END admin_tools -->
                                    </ul>
                                </li>
                                <li>
                                    <a href="#" class="firstlevel" title=""><span class="firstlevel">{INFO_ICO}&nbsp;{INFO_LNK}</span></a>
                                    <ul>
                                    <!-- BEGIN review_comments -->
                                        <li><a href="reviewcom.php" title=""><span>{COMMENTS_ICO}&nbsp;{COMMENTS_LNK}</span></a></li>
                                    <!-- END review_comments -->
                                    <!-- BEGIN log_ecards -->
                                        <li><a href="db_ecard.php" title=""><span>{DB_ECARD_ICO}&nbsp;{DB_ECARD_LNK}</span></a></li>
                                    <!-- END log_ecards -->
                                    <!-- BEGIN view_log_files -->
                                        <li><a href="viewlog.php" title=""><span>{VIEW_LOG_FILES_ICO}&nbsp;{VIEW_LOG_FILES_LNK}</span></a></li>
                                    <!-- END view_log_files -->
                                    <!-- BEGIN overall_stats -->
                                        <li><a href="stat_details.php?type=hits&amp;sort=sdate&amp;dir=&amp;sdate=1&amp;ip=1&amp;search_phrase=0&amp;referer=0&amp;browser=1&amp;os=1&amp;mode=fullscreen&amp;page=1&amp;amount=50" title="" ><span>{OVERALL_STATS_ICO}{OVERALL_STATS_LNK}</span></a></li>
                                    <!-- END overall_stats -->
                                    <!-- BEGIN check_versions -->
                                        <li><a href="versioncheck.php" title=""><span>{CHECK_VERSIONS_ICO}&nbsp;{CHECK_VERSIONS_LNK}</span></a></li>
                                    <!-- END check_versions -->
                                    <!-- BEGIN php_info -->
                                        <li><a href="phpinfo.php" title=""><span>{PHPINFO_ICO}&nbsp;{PHPINFO_LNK}</span></a></li>
                                    <!-- END php_info -->
                                    <!-- BEGIN show_news -->
                                        <li><a href="mode.php?what=news&amp;referer=$REFERER" title=""><span>{SHOWNEWS_ICO}&nbsp;{SHOWNEWS_LNK}</span></a></li>
                                    <!-- END show_news -->
                                    <!-- BEGIN documentation -->
                                        <li><a href="{DOCUMENTATION_HREF}" title=""><span>{DOCUMENTATION_ICO}&nbsp;{DOCUMENTATION_LNK}</span></a></li>
                                    <!-- END documentation -->
                                    </ul>
                                </li>
                            <!-- BEGIN config -->
                                <li>
                                    <a href="admin.php" title="" class="firstlevel"><span class="firstlevel">{ADMIN_ICO}&nbsp;{ADMIN_LNK}</span></a>
                                    <ul>
                                    <!-- BEGIN keyword_manager -->
                                        <li><a href="keywordmgr.php" title=""><span>{KEYWORDMGR_ICO}&nbsp;{KEYWORDMGR_LNK}</span></a></li>
                                    <!-- END keyword_manager -->
                                    <!-- BEGIN exif_manager -->
                                        <li><a href="exifmgr.php" title=""><span>{EXIFMGR_ICO}&nbsp;{EXIFMGR_LNK}</span></a></li>
                                    <!-- END exif_manager -->
                                    <!-- BEGIN plugin_manager -->
                                        <li><a href="pluginmgr.php" title=""><span>{PLUGINMGR_ICO}&nbsp;{PLUGINMGR_LNK}</span></a></li>
                                    <!-- END plugin_manager -->
                                    <!-- BEGIN bridge_manager -->
                                        <li><a href="bridgemgr.php" title=""><span>{BRIDGEMGR_ICO}&nbsp;{BRIDGEMGR_LNK}</span></a></li>
                                    <!-- END bridge_manager -->
                                    <!-- BEGIN update_database -->
                                        <li><a href="update.php" title=""><span>{UPDATE_DATABASE_ICO}&nbsp;{UPDATE_DATABASE_LNK}</span></a></li>
                                    <!-- END update_database -->
                                    </ul>
                                </li>
                            <!-- BEGIN usermgr -->
                                <li>
                                    <a href="usermgr.php" title="" class="firstlevel"><span class="firstlevel">{USERS_ICO}{USERS_LNK}</span></a>
                                    <ul>
                                    <!-- BEGIN banmgr -->
                                        <li><a href="banning.php" title=""><span>{BAN_ICO}{BAN_LNK}</span></a></li>
                                    <!-- END banmgr -->
                                    <!-- BEGIN groupmgr -->
                                        <li><a href="groupmgr.php" title=""><span>{GROUPS_ICO}{GROUPS_LNK}</span></a></li>
                                    <!-- END groupmgr -->
                                    <!-- BEGIN admin_profile -->
                                        <li><a href="profile.php?op=edit_profile" title=""><span>{MY_PROF_ICO}{MY_PROF_LNK}</span></a></li>
                                    <!-- END admin_profile -->
                                    </ul>
                                </li>
                            <!-- END usermgr -->
                                    </ul>
                                </li>
                            <!-- END config -->
              </ul>
            
EOT;

// HTML template for the album list
$template_album_list = <<<EOT

<!-- BEGIN stat_row -->
        <tr>
                <td colspan="{COLUMNS}" class="tableh1" align="center"><span class="statlink">{STATISTICS}</span></td>
        </tr>
<!-- END stat_row -->
<!-- BEGIN header -->
        <tr class="tableb tableb_alternate">
<!-- END header -->
<!-- BEGIN album_cell -->
        <td width="{COL_WIDTH}%" valign="top">
        <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
                <td colspan="3" height="1" align="left" valign="top" class="tableh2">
                        <span class="alblink"><a href="{ALB_LINK_TGT}">{ALBUM_TITLE}</a></span>
                </td>
        </tr>
        <tr>
                <td colspan="3">
                        <img src="images/spacer.gif" width="1" height="1" border="0" alt="" /><br />
                </td>
        </tr>
        <tr>
                <td align="center" valign="top" class="thumbnails"  style="vertical-align:top;background-image:none;">
                        <img src="images/spacer.gif" width="{THUMB_CELL_WIDTH}" height="1" style="margin-top: 0px; margin-bottom: 0px; border: none;" alt="" /><br />
                        <a href="{ALB_LINK_TGT}" class="albums">{ALB_LINK_PIC}<br /></a>
                </td>
                <td>
                        <img src="images/spacer.gif" width="1" height="1" border="0" alt="" />
                </td>
                <td width="100%" valign="top" align="left" class="tableb tableb_alternate">
                        {ADMIN_MENU}
                        <p>{ALB_DESC}</p>
                        <p class="album_stat">{ALB_INFOS}<br />{ALB_HITS}</p>
                </td>
        </tr>
        </table>
        </td>
<!-- END album_cell -->
<!-- BEGIN empty_cell -->
        <td width="{COL_WIDTH}%" valign="top">
        <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
                <td height="1" valign="top" class="tableh2">
                        &nbsp;
                </td>
        </tr>
        <tr>
                <td style="vertical-align:top;background-image:none;">
                        <img src="images/spacer.gif" width="1" height="1" border="0" alt="" /><br />
                </td>
        </tr>
        <tr>
                <td width="100%" valign="top" class="tableb tableb_alternate">
                    <div class="thumbnails" style="background-color:transparent;background-image:none;"><img src="images/spacer.gif" width="1" height="1" border="0" style="border:0;margin-top:1px;margin-bottom:0" alt="" /></div>
                </td>
        </tr>
        </table>
        </td>
<!-- END empty_cell -->
<!-- BEGIN row_separator -->
        </tr>
        <tr class="tableb tableb_alternate">
<!-- END row_separator -->
<!-- BEGIN footer -->
        </tr>
<!-- END footer -->
<!-- BEGIN tabs -->
        <tr>
                <td colspan="{COLUMNS}" style="padding: 0px;">
                        <table width="100%" cellspacing="0" cellpadding="0">
                                <tr>
                                       {TABS}
                                </tr>
                        </table>
                </td>
        </tr>
<!-- END tabs -->
<!-- BEGIN spacer -->
        <img src="images/spacer.gif" width="1" height="7" border="" alt="" /><br />
<!-- END spacer -->

EOT;

function theme_main_menu($which)
{
    global $AUTHORIZED, $CONFIG, $album, $actual_cat, $cat, $REFERER, $CPG_PHP_SELF;
    global $lang_main_menu, $template_sys_menu, $template_sub_menu, $lang_gallery_admin_menu;

    static $sys_menu = '', $sub_menu = '';
    if ($$which != '') {
        return $$which;
    }

    //Check whether user has permission to upload file to the current album if any
    $upload_allowed = false;
    if (isset($album) && is_numeric($album)) {
        if (GALLERY_ADMIN_MODE) {
            $upload_allowed = true;
        } else {
            if (USER_ID) {
                $query = "SELECT null FROM {$CONFIG['TABLE_ALBUMS']} WHERE category='" . (FIRST_USER_CAT + USER_ID) . "' AND aid = '$album'";
                $user_albums = cpg_db_query($query);
                if (mysql_num_rows($user_albums)) {
                    $upload_allowed = true;
                } else {
                    $upload_allowed = false;
                }
            }

            if (!$upload_allowed) {
                $query = "SELECT null FROM {$CONFIG['TABLE_ALBUMS']} WHERE category < " . FIRST_USER_CAT . " AND uploads='YES' AND (visibility = '0' OR visibility IN ".USER_GROUP_SET.") AND aid = '$album'";
                $public_albums = cpg_db_query($query);

                if (mysql_num_rows($public_albums)) {
                    $upload_allowed = true;
                } else {
                    $upload_allowed = false;
                }
            }
        }
    }

    $album_l = isset($album) ? "?album=$album" : '';
    $album_12 = ($upload_allowed) ? "?album=$album" : '';
    $cat_l = (isset($actual_cat))? "?cat=$actual_cat" : (isset($cat) ? "?cat=$cat" : '?cat=0');
    $cat_l2 = isset($cat) ? "&amp;cat=$cat" : '';
    $my_gallery_id = FIRST_USER_CAT + USER_ID;

  if ($which == 'sys_menu' ) {
    if (USER_ID) { // visitor is logged in
        template_extract_block($template_sys_menu, 'login');
        if ($CONFIG['contact_form_registered_enable'] == 0) {
          template_extract_block($template_sys_menu, 'contact');
        }
        if ($CONFIG['display_sidebar_user'] != 2) {
          template_extract_block($template_sys_menu, 'sidebar');
        }
        
        list($timestamp, $form_token) = getFormToken();
        
    } else { // visitor is not logged in
        if ($CONFIG['contact_form_guest_enable'] == 0) {
          template_extract_block($template_sys_menu, 'contact');
        }
        if ($CONFIG['display_sidebar_guest'] != 2) {
          template_extract_block($template_sys_menu, 'sidebar');
        }
        template_extract_block($template_sys_menu, 'logout');
        template_extract_block($template_sys_menu, 'my_profile');
        
        $timestamp = $form_token = '';
    }

    if (!USER_IS_ADMIN) {
        template_extract_block($template_sys_menu, 'enter_admin_mode');
        template_extract_block($template_sys_menu, 'leave_admin_mode');
    } else {
        if (GALLERY_ADMIN_MODE) {
            template_extract_block($template_sys_menu, 'enter_admin_mode');
        } else {
            template_extract_block($template_sys_menu, 'leave_admin_mode');
        }
    }

    if (!USER_CAN_CREATE_ALBUMS) {
        template_extract_block($template_sys_menu, 'my_gallery');
    }

    if (USER_CAN_CREATE_ALBUMS) {
        template_extract_block($template_sys_menu, 'my_profile');
    }

    if (!USER_CAN_UPLOAD_PICTURES && !USER_CAN_CREATE_ALBUMS) {
        template_extract_block($template_sys_menu, 'upload_pic');
    }

    if (USER_ID || !$CONFIG['allow_user_registration']) {
        template_extract_block($template_sys_menu, 'register');
    }

    if (!USER_ID || !$CONFIG['allow_memberlist'] || GALLERY_ADMIN_MODE) {
        template_extract_block($template_sys_menu, 'allow_memberlist');
    }

    $param = array(
        '{HOME_TGT}' => $CONFIG['home_target'],
    '{HOME_ICO}' => cpg_fetch_icon('home', 1),
        '{HOME_LNK}' => $lang_main_menu['home_lnk'],
        '{CONTACT_TGT}' => "contact.php?referer=$REFERER",
    '{CONTACT_ICO}' => cpg_fetch_icon('contact', 1),
        '{CONTACT_LNK}' => $lang_main_menu['contact_lnk'],
        '{MY_GAL_TGT}' => "index.php?cat=$my_gallery_id",
    '{MY_GAL_ICO}' => cpg_fetch_icon('my_gallery', 1),
        '{MY_GAL_LNK}' => $lang_main_menu['my_gal_lnk'],
        '{MEMBERLIST_TGT}' => "usermgr.php",
    '{MEMBERLIST_ICO}' => cpg_fetch_icon('memberlist', 1),
        '{MEMBERLIST_LNK}' => $lang_main_menu['memberlist_lnk'],
        '{MY_PROF_TGT}' => "profile.php?op=edit_profile",
    '{MY_PROF_ICO}' => cpg_fetch_icon('my_profile', 1),
        '{MY_PROF_LNK}' => $lang_main_menu['my_prof_lnk'],
        '{ADM_MODE_TGT}' => "mode.php?admin_mode=1&amp;referer=$REFERER",
    '{ADM_MODE_ICO}' => cpg_fetch_icon('admin_mode_on', 1),
        '{ADM_MODE_LNK}' => $lang_main_menu['adm_mode_lnk'],
        '{USR_MODE_TGT}' => "mode.php?admin_mode=0&amp;referer=$REFERER",
    '{USR_MODE_ICO}' => cpg_fetch_icon('admin_mode_off', 1),
        '{USR_MODE_LNK}' => $lang_main_menu['usr_mode_lnk'],
        '{SIDEBAR_TGT}' => "sidebar.php?action=install",
        '{SIDEBAR_LNK}' => $lang_main_menu['sidebar_lnk'],
    '{SIDEBAR_ICO}' => cpg_fetch_icon('sidebar', 1),
        '{UPL_PIC_TGT}' => "upload.php$album_12",
        '{UPL_PIC_LNK}' => $lang_main_menu['upload_pic_lnk'],
    '{UPL_PIC_ICO}' => cpg_fetch_icon('upload', 1),
        '{REGISTER_TGT}' => "register.php",
        '{REGISTER_LNK}' => $lang_main_menu['register_lnk'],
    '{REGISTER_ICO}' => cpg_fetch_icon('add_user', 1),
        '{LOGIN_LNK}' => $lang_main_menu['login_lnk'],
    '{LOGIN_ICO}' => cpg_fetch_icon('login', 1),
        '{LOGOUT_TGT}' => "logout.php?form_token=$form_token&amp;timestamp=$timestamp&amp;referer=$REFERER",
        '{LOGOUT_LNK}' => $lang_main_menu['logout_lnk'] . " [" . stripslashes(USER_NAME) . "]",
    '{LOGOUT_ICO}' => cpg_fetch_icon('logout', 1),
        '{UPL_APP_LNK}' => $lang_gallery_admin_menu['upl_app_lnk'],
        '{UPL_APP_TGT}' => "editpics.php?mode=upload_approval",
    '{UPL_APP_ICO}' => cpg_fetch_icon('file_approval', 1),
    '{ALB_LIST_TGT}' => "index.php$cat_l",
        '{ALB_LIST_LNK}' => $lang_main_menu['alb_list_lnk'],
    '{ALB_LIST_ICO}' => cpg_fetch_icon('alb_mgr', 1),
        '{CUSTOM_LNK_TGT}' => $CONFIG['custom_lnk_url'],
        '{CUSTOM_LNK_LNK}' => $CONFIG['custom_lnk_name'],
    '{CUSTOM_ICO}' => cpg_fetch_icon('online', 1),
        '{LASTUP_TGT}' => "thumbnails.php?album=lastup$cat_l2",
        '{LASTUP_LNK}' => $lang_main_menu['lastup_lnk'],
    '{LASTUP_ICO}' => cpg_fetch_icon('last_uploads', 1),
        '{LASTCOM_TGT}' => "thumbnails.php?album=lastcom$cat_l2",
        '{LASTCOM_LNK}' => $lang_main_menu['lastcom_lnk'],
    '{LASTCOM_ICO}' => cpg_fetch_icon('comment', 1),
        '{TOPN_TGT}' => "thumbnails.php?album=topn$cat_l2",
        '{TOPN_LNK}' => $lang_main_menu['topn_lnk'],
    '{TOPN_ICO}' => cpg_fetch_icon('most_viewed', 1),
        '{TOPRATED_TGT}' => "thumbnails.php?album=toprated$cat_l2",
        '{TOPRATED_LNK}' => $lang_main_menu['toprated_lnk'],
    '{TOPRATED_ICO}' => cpg_fetch_icon('top_rated', 1),
        '{FAV_TGT}' => "thumbnails.php?album=favpics",
        '{FAV_LNK}' => $lang_main_menu['fav_lnk'],
    '{FAV_ICO}' => cpg_fetch_icon('favorites', 1),
        '{BROWSEBYDATE_TGT}' => 'calendar.php',
        '{BROWSEBYDATE_LNK}' => $lang_main_menu['browse_by_date_lnk'],
    '{BROWSEBYDATE_ICO}' => cpg_fetch_icon('calendar', 1),
        '{SEARCH_TGT}' => "search.php",
        '{SEARCH_LNK}' => $lang_main_menu['search_lnk'],
    '{SEARCH_ICO}' => cpg_fetch_icon('search', 1),
        '{UPL_APP_LNK}' => $lang_gallery_admin_menu['upl_app_lnk'],
        '{UPL_APP_TGT}' => "editpics.php?mode=upload_approval",
    '{UPL_APP_ICO}' => cpg_fetch_icon('file_approval', 1),
        );


        if ($CPG_PHP_SELF != 'login.php') {
            $param['{LOGIN_TGT}'] = "login.php?referer=$REFERER";
        } else {
            $param['{LOGIN_TGT}'] = "login.php";
        }

    if (!$CONFIG['custom_lnk_url']) {
        template_extract_block($template_sys_menu, 'custom_link');
    } 
    
    $sys_menu = template_eval($template_sys_menu, $param);
  }
  return $$which;
}


?>