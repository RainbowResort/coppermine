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
  ********************************************
  Coppermine version: 1.4.1
  $Source$
  $Revision$
  $Author$
  $Date$
**********************************************/

// ----------------------------------------------------------------------------- //
// All lines that should NOT be IN themes/sample/theme.php             //{THEMES}//
// should end in "//{THEMES}" so that they can be easily stripped      //{THEMES}//
if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...');}         //{THEMES}//

// The following terms can be defined in theme.php
// ('THEME_HAS_RATING_GRAPHICS', 1) : The location for the ratings graphics will
//    be directed to the themes images folder.
//    RUBBISH   : images/rating0.gif
//    POOR      : images/rating1.gif
//    FAIR      : images/rating2.gif
//    GOOD      : images/rating3.gif
//    EXCELLENT : images/rating4.gif
//    GREAT     : images/rating5.gif
//('THEME_HAS_NAVBAR_GRAPHICS', 1); : The location for the navbar graphics will
//    be directed to the themes images folder.
//    Back to thumbnails   : images/thumbnails.gif
//    Picture Information  : images/info.gif
//    Slideshow            : images/slideshow.gif
//    Report to admin      : images/report.gif
//    Ecard                : images/ecard.gif
//    Previous             : images/prev.gif
//    Next                 : images/next.gif
// ('THEME_HAS_FILM_STRIP_GRAPHIC', 1) : The location for the film strip graphics will
//    be directed to the themes images folder.
//    tile                 : images/tile.gif
// ('THEME_HAS_FILM_STRIP_GRAPHICS', 1) : The location for the film strip graphics will
//    be directed to the themes images folder.
//    tile on the top      : images/tile1.gif
//    tile on the bottom   : images/tile2.gif
//  ('THEME_HAS_NO_SYS_MENU_BUTTONS', 1) : When present the system won't attempt to replace {BUTTONS} in the SYS_MENU template
//    The entire block needs to be present like in Coppermine 1.3 themes
//  ('THEME_HAS_NO_SUB_MENU_BUTTONS', 1) When present the system won't attempt to replace {BUTTONS} in the SUB_MENU template
//    The entire block needs to be present like in Coppermine 1.3 themes
//  ('THEME_IS_XHTML10_TRANSITIONAL',1) : If theme is defined as XHTML10_TRANSITIONAL the VANITY footer will be enabled
//    if the theme has a {VANITY} token in its template.html. Don't enable this if you have modified the code! See the
//    docs/theme.html documentation for validation methodology.

// Creates buttons from a template using an array of tokens
// this function is used in this file it needs to be declared before being called.
if (!function_exists('assemble_template_buttons')) {  //{THEMES}
function assemble_template_buttons($template_buttons,$buttons) {
    $counter=0;
    $output='';

    foreach ($buttons as $button)  {
      if (isset($button[4])) {
         $spacer=$button[4];
      } else {
      $spacer='';
      }

        $params = array(
            '{SPACER}'     => $spacer,
            '{BLOCK_ID}'   => $button[3],
            '{HREF_TGT}'   => $button[2],
            '{HREF_TITLE}' => $button[1],
            '{HREF_LNK}'   => $button[0]
            );
        $output.=template_eval($template_buttons, $params);
    }
    return $output;
}
}  //{THEMES}


// Creates an array of tokens to be used with function assemble_template_buttons
// this function is used in this file it needs to be declared before being called.
if (!function_exists('addbutton')) {  //{THEMES}
function addbutton(&$menu,$href_lnk,$href_title,$href_tgt,$block_id,$spacer) {
  $menu[]=array($href_lnk,$href_title,$href_tgt,$block_id,$spacer);
}
}  //{THEMES}


// HTML template for sys_menu
if (!isset($template_sys_menu))  //{THEMES}
$template_sys_menu = <<<EOT
          {BUTTONS}
EOT;

// HTML template for sub_menu
if (!isset($template_sub_menu))  //{THEMES}
$template_sub_menu = $template_sys_menu;

if (!defined('THEME_HAS_NO_SYS_MENU_BUTTONS')) {

  // HTML template for template sys_menu spacer
  if (!isset($template_sys_menu_spacer))  //{THEMES}
  $template_sys_menu_spacer ="::";

  // HTML template for template sys_menu buttons
  if (!isset($template_sys_menu_button))  //{THEMES}
  $template_sys_menu_button = <<<EOT
  <!-- BEGIN {BLOCK_ID} -->
        <a href="{HREF_TGT}" title="{HREF_TITLE}">{HREF_LNK}</a> {SPACER}
  <!-- END {BLOCK_ID} -->
EOT;

  // HTML template for template sys_menu buttons
  if (!isset($sys_menu_buttons)) { //{THEMES}
    // {HREF_LNK}{HREF_TITLE}{HREF_TGT}{BLOCK_ID}{SPACER}
    addbutton($sys_menu_buttons,'{HOME_LNK}','{HOME_TITLE}','{HOME_TGT}','home',$template_sys_menu_spacer);
    addbutton($sys_menu_buttons,'{MY_GAL_LNK}','{MY_GAL_TITLE}','{MY_GAL_TGT}','my_gallery',$template_sys_menu_spacer);
    addbutton($sys_menu_buttons,'{MEMBERLIST_LNK}','{MEMBERLIST_TITLE}','{MEMBERLIST_TGT}','allow_memberlist',$template_sys_menu_spacer);
    addbutton($sys_menu_buttons,'{MY_PROF_LNK}','{MY_PROF_TITLE}','{MY_PROF_TGT}','my_profile',$template_sys_menu_spacer);
    addbutton($sys_menu_buttons,'{ADM_MODE_LNK}','{ADM_MODE_TITLE}','{ADM_MODE_TGT}','enter_admin_mode',$template_sys_menu_spacer);
    addbutton($sys_menu_buttons,'{USR_MODE_LNK}','{USR_MODE_TITLE}','{USR_MODE_TGT}','leave_admin_mode',$template_sys_menu_spacer);
    addbutton($sys_menu_buttons,'{UPL_PIC_LNK}','{UPL_PIC_TITLE}','{UPL_PIC_TGT}','upload_pic',$template_sys_menu_spacer);
    addbutton($sys_menu_buttons,'{REGISTER_LNK}','{REGISTER_TITLE}','{REGISTER_TGT}','register',$template_sys_menu_spacer);
    addbutton($sys_menu_buttons,'{FAQ_LNK}','{FAQ_TITLE}','{FAQ_TGT}','faq',$template_sys_menu_spacer);
    addbutton($sys_menu_buttons,'{LOGIN_LNK}','{LOGIN_TITLE}','{LOGIN_TGT}','login','');
    addbutton($sys_menu_buttons,'{LOGOUT_LNK}','{LOGOUT_TITLE}','{LOGOUT_TGT}','logout','');
    // Login and Logout don't have a spacer as only one is shown, and either would be the last option.
  } //{THEMES}

  $params = array('{BUTTONS}' => assemble_template_buttons($template_sys_menu_button,$sys_menu_buttons));
  $template_sys_menu = template_eval($template_sys_menu,$params);
}

if (!defined('THEME_HAS_NO_SUB_MENU_BUTTONS')) {

  // HTML template for template sub_menu spacer
  if (!isset($template_sub_menu_spacer))  //{THEMES}
  $template_sub_menu_spacer = $template_sys_menu_spacer;

  // HTML template for template sub_menu buttons
  if (!isset($template_sub_menu_button))  //{THEMES}
  $template_sub_menu_button= $template_sys_menu_button;

  // HTML template for template sub_menu buttons
  if (!isset($sub_menu_buttons)) { //{THEMES}
    // {HREF_LNK}{HREF_TITLE}{HREF_TGT}{BLOCK_ID}{SPACER}
    addbutton($sub_menu_buttons,'{CUSTOM_LNK_LNK}','{CUSTOM_LNK_TITLE}','{CUSTOM_LNK_TGT}','custom_link',$template_sub_menu_spacer);
    addbutton($sub_menu_buttons,'{ALB_LIST_LNK}','{ALB_LIST_TITLE}','{ALB_LIST_TGT}','album_list',$template_sub_menu_spacer);
    addbutton($sub_menu_buttons,'{LASTUP_LNK}','{LASTUP_TITLE}','{LASTUP_TGT}','lastup',$template_sub_menu_spacer);
    addbutton($sub_menu_buttons,'{LASTCOM_LNK}','{LASTCOM_TITLE}','{LASTCOM_TGT}','lastcom',$template_sub_menu_spacer);
    addbutton($sub_menu_buttons,'{TOPN_LNK}','{TOPN_TITLE}','{TOPN_TGT}','topn',$template_sub_menu_spacer);
    addbutton($sub_menu_buttons,'{TOPRATED_LNK}','{TOPRATED_TITLE}','{TOPRATED_TGT}','toprated',$template_sub_menu_spacer);
    addbutton($sub_menu_buttons,'{FAV_LNK}','{FAV_TITLE}','{FAV_TGT}','favpics',$template_sub_menu_spacer);
    addbutton($sub_menu_buttons,'{SEARCH_LNK}','{SEARCH_TITLE}','{SEARCH_TGT}','search','');
    } //{THEMES}

  $params = array('{BUTTONS}' => assemble_template_buttons($template_sub_menu_button,$sub_menu_buttons));
  $template_sub_menu = template_eval($template_sub_menu,$params);
}

// HTML template for gallery admin menu
if (!isset($template_gallery_admin_menu))  //{THEMES}
$template_gallery_admin_menu = <<<EOT

                <div align="center">
                <table cellpadding="0" cellspacing="1">
                        <tr>
<!-- BEGIN admin_approval -->
                                <td class="admin_menu" id="admin_menu_anim"><a href="editpics.php?mode=upload_approval" title="{UPL_APP_TITLE}">{UPL_APP_LNK}</a></td>
<!-- END admin_approval -->
                                <td class="admin_menu"><a href="admin.php" title="{ADMIN_TITLE}">{ADMIN_LNK}</a></td>
                                <td class="admin_menu"><a href="catmgr.php" title="{CATEGORIES_TITLE}">{CATEGORIES_LNK}</a></td>
                                <td class="admin_menu"><a href="albmgr.php{CATL}" title="{ALBUMS_TITLE}">{ALBUMS_LNK}</a></td>
                                <td class="admin_menu"><a href="groupmgr.php" title="{GROUPS_TITLE}">{GROUPS_LNK}</a></td>
                                <td class="admin_menu"><a href="usermgr.php" title="{USERS_TITLE}">{USERS_LNK}</a></td>
                                <td class="admin_menu"><a href="banning.php" title="{BAN_TITLE}">{BAN_LNK}</a></td>
                                <td class="admin_menu"><a href="reviewcom.php" title="{COMMENTS_TITLE}">{COMMENTS_LNK}</a></td>
<!-- BEGIN log_ecards -->
                                <td class="admin_menu"><a href="db_ecard.php" title="{DB_ECARD_TITLE}">{DB_ECARD_LNK}</a></td>
<!-- END log_ecards -->
                                <td class="admin_menu"><a href="picmgr.php" title="{PICTURES_TITLE}">{PICTURES_LNK}</a></td>
                                <td class="admin_menu"><a href="searchnew.php" title="{SEARCHNEW_TITLE}">{SEARCHNEW_LNK}</a></td>
                                <td class="admin_menu"><a href="util.php" title="{UTIL_TITLE}">{UTIL_LNK}</a></td>
                                <td class="admin_menu"><a href="profile.php?op=edit_profile" title="{MY_PROF_TITLE}">{MY_PROF_LNK}</a></td>
<!-- BEGIN documentation -->
                                <td class="admin_menu"><a href="{DOCUMENTATION_HREF}" title="{DOCUMENTATION_TITLE}" target="cpg_documentation">{DOCUMENTATION_LNK}</a></td>
<!-- END documentation -->
                        </tr>
                </table>
                </div>

EOT;
// HTML template for user admin menu
if (!isset($template_user_admin_menu))  //{THEMES}
$template_user_admin_menu = <<<EOT

                <div align="center">
                <table cellpadding="0" cellspacing="1">
                        <tr>
                                <td class="admin_menu"><a href="albmgr.php" title="{ALBMGR_TITLE}">{ALBMGR_LNK}</a></td>
                                <td class="admin_menu"><a href="modifyalb.php" title="{MODIFYALB_TITLE}">{MODIFYALB_LNK}</a></td>
                                <td class="admin_menu"><a href="profile.php?op=edit_profile" title="{MY_PROF_TITLE}">{MY_PROF_LNK}</a></td>
                                <td class="admin_menu"><a href="picmgr.php" title="{PICTURES_TITLE}">{PICTURES_LNK}</a></td>
                        </tr>
                </table>
                </div>

EOT;
// HTML template for the category list
if (!isset($template_cat_list))  //{THEMES}
$template_cat_list = <<<EOT
<!-- BEGIN header -->
        <tr>
                <td class="tableh1" width="80%" align="left"><b>{CATEGORY}</b></td>
                <td class="tableh1" width="10%" align="center"><b>{ALBUMS}</b></td>
                <td class="tableh1" width="10%" align="center"><b>{PICTURES}</b></td>
        </tr>
<!-- END header -->
<!-- BEGIN catrow_noalb -->
        <tr>
                <td class="catrow_noalb" colspan="3"><table border="0"><tr><td align="left">{CAT_THUMB}</td><td align="left"><span class="catlink"><b>{CAT_TITLE}</b></span>{CAT_DESC}</td></tr></table></td>
        </tr>
<!-- END catrow_noalb -->
<!-- BEGIN catrow -->
        <tr>
                <td class="catrow" align="left"><table border="0"><tr><td>{CAT_THUMB}</td><td><span class="catlink"><b>{CAT_TITLE}</b></span>{CAT_DESC}</td></tr></table></td>
                <td class="catrow" align="center">{ALB_COUNT}</td>
                <td class="catrow" align="center">{PIC_COUNT}</td>
        </tr>
        <tr>
            <td class="tableb" colspan="3">{CAT_ALBUMS}</td>
        </tr>
<!-- END catrow -->
<!-- BEGIN footer -->
        <tr>
                <td colspan="3" class="tableh1" align="center"><span class="statlink"><b>{STATISTICS}</b></span></td>
        </tr>
<!-- END footer -->
<!-- BEGIN spacer -->
        <img src="images/spacer.gif" width="1" height="7" border="" alt="" /><br />
<!-- END spacer -->

EOT;
// HTML template for the breadcrumb
if (!isset($template_breadcrumb))  //{THEMES}
$template_breadcrumb = <<<EOT
<!-- BEGIN breadcrumb -->
        <tr>
                <td colspan="3" align="left" class="tableh1"><span class="statlink"><b>{BREADCRUMB}</b></span></td>
        </tr>
<!-- END breadcrumb -->
<!-- BEGIN breadcrumb_user_gal -->
        <tr>
                <td colspan="3" class="tableh1">
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
                        <td align="left"><span class="statlink"><b>{BREADCRUMB}</b></span></td>
                        <td align="right"><span class="statlink"><b>{STATISTICS}</b></span></td>
                </tr>
                </table>
                </td>
        </tr>
<!-- END breadcrumb_user_gal -->

EOT;
// HTML template for the album list
if (!isset($template_album_list))  //{THEMES}
$template_album_list = <<<EOT

<!-- BEGIN stat_row -->
        <tr>
                <td colspan="{COLUMNS}" class="tableh1" align="center"><span class="statlink"><b>{STATISTICS}</b></span></td>
        </tr>
<!-- END stat_row -->
<!-- BEGIN header -->
        <tr>
<!-- END header -->
<!-- BEGIN album_cell -->
        <td width="{COL_WIDTH}%" valign="top">
        <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
                <td colspan="3" height="1" align="left" valign="top" class="tableh2">
                        <span class="alblink"><a href="{ALB_LINK_TGT}"><b>{ALBUM_TITLE}</b></a></span>
                </td>
        </tr>
        <tr>
                <td colspan="3">
                        <img src="images/spacer.gif" width="1" height="1" border="0" alt="" /><br />
                </td>
        </tr>
        <tr>
                <td align="center" valign="middle" class="thumbnails">
                        <img src="images/spacer.gif" width="{THUMB_CELL_WIDTH}" height="1" class="image" style="margin-top: 0px; margin-bottom: 0px; border: none;" alt="" /><br />
                        <a href="{ALB_LINK_TGT}" class="albums">{ALB_LINK_PIC}<br /></a>
                </td>
                <td>
                        <img src="images/spacer.gif" width="1" height="1" border="0" alt="" />
                </td>
                <td width="100%" valign="top" align="left" class="tableb_compact">
                        {ADMIN_MENU}
                        <p>{ALB_DESC}</p>
                        <p class="album_stat">{ALB_INFOS}</p>
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
                        <b>&nbsp;</b>
                </td>
        </tr>
        <tr>
                <td>
                        <img src="images/spacer.gif" width="1" height="1" border="0" alt="" /><br />
                </td>
        </tr>
        <tr>
                <td width="100%" valign="top" class="tableb_compact">
                    <div class="thumbnails" style="background-color:transparent"><img src="images/spacer.gif" width="1" height="{SPACER}" border="0" class="image" style="border:0;margin-top:1px;margin-bottom:0" alt="" /></div>
                </td>
        </tr>
        </table>
        </td>
<!-- END empty_cell -->
<!-- BEGIN row_separator -->
        </tr>
        <tr>
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
// HTML template for filmstrip display
if (!isset($template_film_strip))  //{THEMES}
$template_film_strip = <<<EOT

        <tr>
         <td valign="top" style="background-image: url({TILE1});"><img src="{TILE1}" alt="" border="0" /></td>
        </tr>
        <tr>
        <td valign="bottom" class="thumbnails" align="center">
          <table width="100%" cellspacing="0" cellpadding="3" border="0">
              <tr>
                 <td width="50%"></td>
                 {THUMB_STRIP}
                 <td width="50%"></td>
              </tr>
          </table>
        </td>
        </tr>
        <tr>
         <td valign="top" style="background-image: url({TILE2});"><img src="{TILE2}" alt="" border="0" /></td>
        </tr>
<!-- BEGIN thumb_cell -->
                <td valign="top" align="center">
                                        <a href="{LINK_TGT}">{THUMB}</a>
                                        {CAPTION}
                                        {ADMIN_MENU}
                </td>
<!-- END thumb_cell -->
<!-- BEGIN empty_cell -->
                <td valign="top" align="center" >&nbsp;</td>
<!-- END empty_cell -->

EOT;
// HTML template for the album list
if (!isset($template_album_list_cat))  //{THEMES}
$template_album_list_cat = <<<EOT

<!-- BEGIN c_stat_row -->
        <tr>
                <td colspan="{COLUMNS}" class="tableh1" align="center"><span class="statlink"><b>{STATISTICS}</b></span></td>
        </tr>
<!-- END c_stat_row -->
<!-- BEGIN c_header -->
        <tr>
<!-- END c_header -->
<!-- BEGIN c_album_cell -->
        <td width="{COL_WIDTH}%" valign="top">
        <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
                <td colspan="3" height="1" valign="top" class="tableh2">
                        <span class="alblink"><a href="{ALB_LINK_TGT}"><b>{ALBUM_TITLE}</b></a></span>
                </td>
        </tr>
        <tr>
                <td colspan="3">
                        <img src="images/spacer.gif" width="1" height="1" border="0" alt="" /><br />
                </td>
        </tr>
        <tr>
                <td align="center" valign="middle" class="thumbnails">
                        <img src="images/spacer.gif" width="{THUMB_CELL_WIDTH}" height="1" class="image" style="margin-top: 0px; margin-bottom: 0px; border: none;" alt="" /><br />
                        <a href="{ALB_LINK_TGT}" class="albums">{ALB_LINK_PIC}<br /></a>
                </td>
                <td>
                        <img src="images/spacer.gif" width="1" height="1" border="0" alt="" />
                </td>
                <td width="100%" valign="top" class="tableb_compact">
                        {ADMIN_MENU}
                        <p>{ALB_DESC}</p>
                        <p class="album_stat">{ALB_INFOS}</p>
                </td>
        </tr>
        </table>
        </td>
<!-- END c_album_cell -->
<!-- BEGIN c_empty_cell -->
        <td width="{COL_WIDTH}%" valign="top">
        <table width="100%" cellspacing="0" cellpadding="0" >
        <tr>
                <td height="1" valign="top" class="tableh2">
                        <b>&nbsp;</b>
                </td>
        </tr>
        <tr>
                <td>
                        <img src="images/spacer.gif" width="1" height="1" border="0" alt="" /><br />
                </td>
        </tr>
        <tr>
                <td width="100%" valign="top" class="tableb_compact" >
                      <div class="thumbnails" style="background-color:transparent"><img src="images/spacer.gif" width="1" height="{SPACER}" border="0" class="image" style="border:0;margin-top:1px;margin-bottom:0" alt="" /></div>
                </td>
        </tr>
        </table>
        </td>
<!-- END c_empty_cell -->
<!-- BEGIN c_row_separator -->
        </tr>
        <tr>
<!-- END c_row_separator -->
<!-- BEGIN c_footer -->
        </tr>
<!-- END c_footer -->
<!-- BEGIN c_tabs -->
        <tr>
                <td colspan="{COLUMNS}" style="padding: 0px;">
                        <table width="100%" cellspacing="0" cellpadding="0">
                                <tr>
                                       {TABS}
                                </tr>
                        </table>
                </td>
        </tr>
<!-- END c_tabs -->
<!-- BEGIN c_spacer -->
        <img src="images/spacer.gif" width="1" height="7" border="" alt="" /><br />
<!-- END c_spacer -->

EOT;
// HTML template for the ALBUM admin menu displayed in the album list
if (!isset($template_album_admin_menu))  //{THEMES}
$template_album_admin_menu = <<<EOT
        <table border="0" cellpadding="0" cellspacing="1">
                <tr>
                        <td align="center" valign="middle" class="admin_menu">
                                <a href="delete.php?id={ALBUM_ID}&amp;what=album"  class="adm_menu" onclick="return confirm('{CONFIRM_DELETE}');">{DELETE}</a>
                        </td>
                        <td align="center" valign="middle" class="admin_menu">
                                <a href="modifyalb.php?album={ALBUM_ID}"  class="adm_menu">{MODIFY}</a>
                        </td>
                        <td align="center" valign="middle" class="admin_menu">
                                <a href="editpics.php?album={ALBUM_ID}"  class="adm_menu">{EDIT_PICS}</a>
                        </td>
                </tr>
        </table>

EOT;
// HTML template for title row of the thumbnail view (album title + sort options)
if (!isset($template_thumb_view_title_row))  //{THEMES}
$template_thumb_view_title_row = <<<EOT

                        <table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                                <td width="100%" class="statlink"><h2>{ALBUM_NAME}</h2></td>
                                <td><img src="images/spacer.gif" width="1" alt="" /></td>
                                <td class="sortorder_cell">
                                        <table cellpadding="0" cellspacing="0">
                                        <tr>
                                                <td class="sortorder_options">{TITLE}</td>
                                                <td class="sortorder_options"><span class="statlink"><a href="thumbnails.php?album={AID}&amp;page={PAGE}&amp;sort=ta" title="{SORT_TA}">&nbsp;+&nbsp;</a></span></td>
                                                <td class="sortorder_options"><span class="statlink"><a href="thumbnails.php?album={AID}&amp;page={PAGE}&amp;sort=td" title="{SORT_TD}">&nbsp;-&nbsp;</a></span></td>
                                        </tr>
                                        <tr>
                                                <td class="sortorder_options">{NAME}</td>
                                                <td class="sortorder_options"><span class="statlink"><a href="thumbnails.php?album={AID}&amp;page={PAGE}&amp;sort=na" title="{SORT_NA}">&nbsp;+&nbsp;</a></span></td>
                                                <td class="sortorder_options"><span class="statlink"><a href="thumbnails.php?album={AID}&amp;page={PAGE}&amp;sort=nd" title="{SORT_ND}">&nbsp;-&nbsp;</a></span></td>
                                        </tr>
                                        <tr>
                                                <td class="sortorder_options">{DATE}</td>
                                                <td class="sortorder_options"><span class="statlink"><a href="thumbnails.php?album={AID}&amp;page={PAGE}&amp;sort=da" title="{SORT_DA}">&nbsp;+&nbsp;</a></span></td>
                                                <td class="sortorder_options"><span class="statlink"><a href="thumbnails.php?album={AID}&amp;page={PAGE}&amp;sort=dd" title="{SORT_DD}">&nbsp;-&nbsp;</a></span></td>
                                        </tr>
                                        <tr>
                                                <td class="sortorder_options">{POSITION}</td>
                                                <td class="sortorder_options"><span class="statlink"><a href="thumbnails.php?album={AID}&amp;page={PAGE}&amp;sort=pa" title="{SORT_PA}">&nbsp;+&nbsp;</a></span></td>
                                                <td class="sortorder_options"><span class="statlink"><a href="thumbnails.php?album={AID}&amp;page={PAGE}&amp;sort=pd" title="{SORT_PD}">&nbsp;-&nbsp;</a></span></td>
                                        </tr>
                                        </table>
                                </td>
                        </tr>
                        </table>

EOT;


// HTML template for title row of the fav thumbnail view (album title + download)
if (!isset($template_fav_thumb_view_title_row))  //{THEMES}
$template_fav_thumb_view_title_row = <<<EOT

                        <table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                                <td width="100%" class="statlink"><h2>{ALBUM_NAME}</h2></td>
                                <td><img src="images/spacer.gif" width="1px" alt=""></td>
                                <td class="sortorder_cell">
                                        <table cellpadding="0" cellspacing="0">
                                                <tr>
                                                        <td class="sortorder_options"><span class="statlink"><a href="zipdownload.php">{DOWNLOAD_ZIP}</a></span></td>
                                                </tr>
                                                </table>
                                </td>
                        </tr>
                        </table>

EOT;


// HTML template for thumbnails display
if (!isset($template_thumbnail_view))  //{THEMES}
$template_thumbnail_view = <<<EOT

<!-- BEGIN header -->
        <tr>
<!-- END header -->
<!-- BEGIN thumb_cell -->
        <td valign="top" class="thumbnails" width ="{CELL_WIDTH}" align="center">
                <table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                                <td align="center">
                                        <a href="{LINK_TGT}">{THUMB}<br /></a>
                                        {CAPTION}
                                        {ADMIN_MENU}
                                </td>
                        </tr>
                </table>
        </td>
<!-- END thumb_cell -->
<!-- BEGIN empty_cell -->
                <td valign="top" class="thumbnails" align="center">&nbsp;</td>
<!-- END empty_cell -->
<!-- BEGIN row_separator -->
        </tr>
        <tr>
<!-- END row_separator -->
<!-- BEGIN footer -->
        </tr>
<!-- END footer -->
<!-- BEGIN tabs -->
        <tr>
                <td colspan="{THUMB_COLS}" style="padding: 0px;">
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
// HTML template for the thumbnail view when there is no picture to show
if (!isset($template_no_img_to_display))  //{THEMES}
$template_no_img_to_display = <<<EOT
        <tr>
                <td class="tableb" height="200" align="center">
                        <font size="3"><b>{TEXT}</b></font>
                </td>
        </tr>
<!-- BEGIN spacer -->
        <img src="images/spacer.gif" width="1" height="7" border="" alt="" /><br />
<!-- END spacer -->

EOT;
// HTML template for the USER info box in the user list view
if (!isset($template_user_list_info_box))  //{THEMES}
$template_user_list_info_box = <<<EOT

        <table cellspacing="1" cellpadding="0" border="0" width="100%" class="user_thumb_infobox">
                <tr>
                        <th><a href="profile.php?uid={USER_ID}">{USER_NAME}</a></th>
                </tr>
                <tr>
                        <td>{ALBUMS}</td>
                </tr>
                <tr>
                        <td>{PICTURES}</td>
                </tr>
        </table>

EOT;
// HTML template for the image navigation bar
if (!isset($template_img_navbar))  //{THEMES}
$template_img_navbar = <<<EOT

        <tr>
                <td align="center" valign="middle" class="navmenu" width="48px"><a name="top_display_media"></a>
                        <a href="{THUMB_TGT}" class="navmenu_pic" title="{THUMB_TITLE}"><img src="{LOCATION}images/thumbnails.gif" align="middle" border="0px" alt="{THUMB_TITLE}" /></a>
                </td>
                <td align="center" valign="middle" class="navmenu" width="48px">
                        <a href="javascript:;" class="navmenu_pic" onclick="blocking('picinfo','yes', 'block'); return false;" title="{PIC_INFO_TITLE}"><img src="{LOCATION}images/info.gif" border="0px" align="middle" alt="{PIC_INFO_TITLE}" /></a>
                </td>
                <td align="center" valign="middle" class="navmenu" width="48px">
                        <a href="{SLIDESHOW_TGT}" class="navmenu_pic" title="{SLIDESHOW_TITLE}"><img src="{LOCATION}images/slideshow.gif" border="0px" align="middle" alt="{SLIDESHOW_TITLE}" /></a>
                </td>
                <td align="center" valign="middle" class="navmenu" width="100%">
                        {PIC_POS}
                </td>
<!-- BEGIN report_file_button -->
                <td align="center" valign="middle" class="navmenu" width="48px">
                        <a href="{REPORT_TGT}" class="navmenu_pic" title="{REPORT_TITLE}"><img src="{LOCATION}images/report.gif" border="0" align="middle" alt="{REPORT_TITLE}" /></a>
                </td>
<!-- END report_file_button -->
<!-- BEGIN ecard_button -->
                <td align="center" valign="middle" class="navmenu" width="48px">
                        <a href="{ECARD_TGT}" class="navmenu_pic" title="{ECARD_TITLE}"><img src="{LOCATION}images/ecard.gif"  border="0px" align="middle" alt="{ECARD_TITLE}" /></a>
                </td>
<!-- END ecard_button -->
                <td align="center" valign="middle" class="navmenu" width="48px">
                        <a href="{PREV_TGT}" class="navmenu_pic" title="{PREV_TITLE}"><img src="{LOCATION}images/prev.gif"  border="0px" align="middle" alt="{PREV_TITLE}" /></a>
                </td>
                <td align="center" valign="middle" class="navmenu" width="48px">
                        <a href="{NEXT_TGT}" class="navmenu_pic" title="{NEXT_TITLE}"><img src="{LOCATION}images/next.gif"  border="0px" align="middle" alt="{NEXT_TITLE}" /></a>
                </td>
        </tr>

EOT;
// HTML template for intermediate image display
if (!isset($template_display_media))  //{THEMES}
$template_display_media = <<<EOT
        <tr>
                <td align="center" class="display_media" nowrap="nowrap">
                        <table cellspacing="2px" cellpadding="0px" class="imageborder">
                                <tr>
                                        <td align="center">
                                                {IMAGE}

                                        </td>
                                </tr>
                        </table>
                </td></tr>
                <tr><td>
                                                <table width="100%" cellspacing="2px" cellpadding="0px" class="tableb">
                                <tr>
                                        <td align="center">

                                                {ADMIN_MENU}
                                        </td>
                                </tr>
                        </table>





<!-- BEGIN img_desc -->
                        <table cellpadding="0px" cellspacing="0px" class="tableb" width="100%">
<!-- BEGIN title -->
                                <tr>
                                        <td class="tableb"><center><b>
                                                {TITLE}
                                        </b></center></td>
                                </tr>
<!-- END title -->
<!-- BEGIN caption -->
                                <tr>
                                        <td class="tableb"><center>
                                                {CAPTION}
                                        </center></td>
                                </tr>
<!-- END caption -->
                        </table>
<!-- END img_desc -->
                </td>
        </tr>

EOT;
// HTML template for the image rating box
if (!isset($template_image_rating))  //{THEMES}
$template_image_rating = <<<EOT
<table align="center" width="{WIDTH}" cellspacing="1" cellpadding="0" class="maintable">
        <tr>
                <td colspan="6" class="tableh2_compact"><b>{TITLE}</b> {VOTES}</td>
        </tr>
        <tr>
                <td class="tableb_compact" width="17%" align="center"><a href="{RATE0}" title="{RUBBISH}" rel="nofollow"><img src="{LOCATION}images/rating0.gif" border="0px" alt="{RUBBISH}" /><br /></a></td>
                <td class="tableb_compact" width="17%" align="center"><a href="{RATE1}" title="{POOR}" rel="nofollow"><img src="{LOCATION}images/rating1.gif" border="0px" alt="{POOR}" /><br /></a></td>
                <td class="tableb_compact" width="17%" align="center"><a href="{RATE2}" title="{FAIR}" rel="nofollow"><img src="{LOCATION}images/rating2.gif" border="0px" alt="{FAIR}" /><br /></a></td>
                <td class="tableb_compact" width="17%" align="center"><a href="{RATE3}" title="{GOOD}" rel="nofollow"><img src="{LOCATION}images/rating3.gif" border="0px" alt="{GOOD}" /><br /></a></td>
                <td class="tableb_compact" width="17%" align="center"><a href="{RATE4}" title="{EXCELLENT}" rel="nofollow"><img src="{LOCATION}images/rating4.gif" border="0px" alt="{EXCELLENT}" /><br /></a></td>
                <td class="tableb_compact" width="17%" align="center"><a href="{RATE5}" title="{GREAT}" rel="nofollow"><img src="{LOCATION}images/rating5.gif" border="0px" alt="{GREAT}" /><br /></a></td>
        </tr>
</table>
EOT;
// HTML template for the display of comments
if (!isset($template_image_comments))  //{THEMES}
$template_image_comments = <<<EOT
<table align="center" width="{WIDTH}" cellspacing="1" cellpadding="0" class="maintable">

        <tr>
                <td>
                        <table width="100%" cellpadding="0px" cellspacing="0px">
                           <tr>
                                <td class="tableh2_compact" nowrap="nowrap">
                                        <b>{MSG_AUTHOR}</b><a name="comment{MSG_ID}">&nbsp;</a>
<!-- BEGIN ipinfo -->
                                                                                 ({IP})
<!-- END ipinfo -->
</td>


                                <td class="tableh2_compact" align="right" width="100%">
<!-- BEGIN report_comment_button -->
     <a href="report_file.php?pid={PID}&amp;msg_id={MSG_ID}&amp;what=comment" title="{REPORT_COMMENT_TITLE}"><img src="images/report.gif" width="16px" height="16px" border="0px" align="middle" alt="{REPORT_COMMENT_TITLE}" /></a>
<!-- END report_comment_button -->


<!-- BEGIN buttons -->
                                        <a href="javascript:;" onclick="blocking('cbody{MSG_ID}','', 'block'); blocking('cedit{MSG_ID}','', 'block'); return false;" title="{EDIT_TITLE}"><img src="images/edit.gif" border="0px" align="middle" /></a>
                                        <a href="delete.php?msg_id={MSG_ID}&what=comment"  onclick="return confirm('{CONFIRM_DELETE}');"><img src="images/delete.gif" border="0px" align="middle" /></a>
<!-- END buttons -->
                                </td>
                                <td class="tableh2_compact" align="right" nowrap="nowrap">
                                        <span class="comment_date">[{MSG_DATE}]</span>
                                </td></tr>
                        </table>
                </td>
        </tr>
        <tr>
                <td class="tableb_compact">
                        <div id="cbody{MSG_ID}" style="display:block">
                                {MSG_BODY}
                        </div>
                        <div id="cedit{MSG_ID}" style="display:none">
<!-- BEGIN edit_box_smilies -->
                                <table width="100%" cellpadding="0px" cellspacing="0px">

                                                <form name="f{MSG_ID}" method="POST" action="db_input.php">
                                                <input type="hidden" name="event" value="comment_update" />
                                                <input type="hidden" name="msg_id" value="{MSG_ID}" />
                                                <tr>
                                                <td>
                                                   <input type="text" name="msg_author" value="{MSG_AUTHOR}" class="textinput" size="25" />
                                                </td><td>
                                                </tr>
                                                <tr>
                                                <td width="80%">
                                                        <textarea cols="40" rows="2" class="textinput" name="msg_body" onselect="storeCaret_f{MSG_ID}(this);" onclick="storeCaret_f{MSG_ID}(this);" onkeyup="storeCaret_f{MSG_ID}(this);" style="width: 100%;">{MSG_BODY_RAW}</textarea>
                                                </td>
                                                <td class="tableb_compact">
                                                </td>
                                                <td>
                                                        <input type="submit" class="comment_button" name="submit" value="{OK}" />
                                                </td>
                                                </form>
                                        </tr>
                                        <tr>
                                                <td colspan="3"><img src="images/spacer.gif" width="1px" height="2px" /><br /></td>
                                        </tr>
                                </table>
                                {SMILIES}
<!-- END edit_box_smilies -->
<!-- BEGIN edit_box_no_smilies -->
                                <table width="100%" cellpadding="0px" cellspacing="0px">
                                        <tr>
                                                <form name="f{MSG_ID}" method="POST" action="db_input.php">
                                                <input type="hidden" name="event" value="comment_update" />
                                                <input type="hidden" name="msg_id" value="{MSG_ID}" />
                                                <td>
                                                <input type="text" name="msg_author" value="{MSG_AUTHOR}" class="textinput" size="25" />
                                                </td>
                                        </tr>
                                        <tr>
                                                <td width="100%">
                                                        <textarea cols="40" rows="2" class="textinput" name="msg_body" style="width: 100%;">{MSG_BODY_RAW}</textarea>
                                                </td>
                                                <td class="tableb_compact">
                                                </td>
                                                <td>
                                                        <input type="submit" class="comment_button" name="submit" value="{OK}" />
                                                </td>
                                                </form>
                                        </tr>
                                        <tr>
                                                <td colspan="3"><img src="images/spacer.gif" width="1px" height="2px" /><br /></td>
                                        </tr>
                                </table>
<!-- END edit_box_no_smilies -->
                        </div>
                </td>
        </tr>
</table>
EOT;

if (!isset($template_add_your_comment))  //{THEMES}
$template_add_your_comment = <<<EOT
<table align="center" width="{WIDTH}" cellspacing="1" cellpadding="0" class="maintable">
        <tr>
                <td width="100%" class="tableh2_compact"><b>{ADD_YOUR_COMMENT}</b></td>
        </tr>
        <tr>
                <td colspan="3">
                <form method="post" name="post" action="db_input.php">
                        <table width="100%" cellpadding="0px" cellspacing="0px">

<!-- BEGIN user_name_input -->
                                <tr><td class="tableb_compact">
                                        {NAME}
                                </td>
                                <td class="tableb_compact">
                                        <input type="text" class="textinput" name="msg_author" size="10" maxlength="20" value="{USER_NAME}" />
                                </td>
<!-- END user_name_input -->
<!-- BEGIN input_box_smilies -->
                                <td class="tableb_compact">
                                {COMMENT} </td>
                                <td width="100%" class="tableb_compact">
                                <input type="text" class="textinput" id="message" name="msg_body" onselect="storeCaret_post(this);" onclick="storeCaret_post(this);" onkeyup="storeCaret_post(this);" maxlength="{MAX_COM_LENGTH}" style="width: 100%;" />                                        <!-- END input_box_smilies -->
<!-- BEGIN input_box_no_smilies -->
                                <td class="tableb_compact">
                                <input type="text" class="textinput" id="message" name="msg_body"  maxlength="{MAX_COM_LENGTH}" style="width: 100%;" />
<!-- END input_box_no_smilies -->
                                </td>
                                <td class="tableb_compact">
                                <input type="hidden" name="event" value="comment" />
                                <input type="hidden" name="pid" value="{PIC_ID}" />
                                <input type="submit" class="comment_button" name="submit" value="{OK}" />
                                </td></tr>
                        </table>
                </form>
                </td>
        </tr>
<!-- BEGIN smilies -->
        <tr>
                <td width="100%" class="tableb_compact">
                        {SMILIES}
                </td>
        </tr>
</table>
<!-- END smilies -->

EOT;
// HTML template used by the cpg_die function
if (!isset($template_cpg_die))  //{THEMES}
$template_cpg_die = <<<EOT

        <tr>
                <td class="tableb" align="center">
                        <font size="3"><b>{MESSAGE}</b></font>
<!-- BEGIN file_line -->
                        <br />
                        <br />
                        {FILE_TXT}{FILE} - {LINE_TXT}{LINE}
<!-- END file_line -->
<!-- BEGIN output_buffer -->
                        <br />
                        <br />
                        <div align="left">
                                {OUTPUT_BUFFER}
                        </div>
<!-- END output_buffer -->
                        <br /><br />
                </td>
        </tr>


EOT;
// HTML template used by the msg_box function
if (!isset($template_msg_box))  //{THEMES}
$template_msg_box = <<<EOT

        <tr>
                <td class="tableb" align="center">
                        <font size="3"><b>{MESSAGE}</b></font>
                </td>
        </tr>
<!-- BEGIN button -->
                <tr>
                        <td align="center" class="tablef">
                                <table cellpadding="0" cellspacing="0">
                                        <tr>
                                                <td class="admin_menu">
                                                        <a href="{LINK}">{TEXT}</a>
                                                </td>
                                        </tr>
                                </table>
                        </td>
                </tr>
<!-- END button -->

EOT;
// HTML template for e-cards
if (!isset($template_ecard))  //{THEMES}
$template_ecard = <<<EOT
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="{LANG_DIR}">
<head>
<title>{TITLE}</title>
<meta http-equiv="content-type" content="text/html; charset={CHARSET}" />
</head>
<body bgcolor="#FFFFFF" text="#0F5475" link="#0F5475" vlink="#0F5475" alink="#0F5475">
<br />
<p align="center"><a href="{VIEW_ECARD_TGT}"><b>{VIEW_ECARD_LNK}</b></a></p>
<table border="0px" cellspacing="0px" cellpadding="1px" align="center">
  <tr>
    <td bgcolor="#000000">
      <table border="0px" cellspacing="0px" cellpadding="10px" bgcolor="#ffffff">
        <tr>
          <td valign="top">
           <a href="{VIEW_MORE_TGT}/displayimage.php?pos=-{PID}">
                                         <img src="{PIC_URL}" border="1px" alt="" /></a>
                                         <br />
                                         <div align="center">
                                                 <h2>{PIC_TITLE}</h2>
                                         </div>

          </td>
          <td valign="top" width="300px">
            <div align="right"><img src="{URL_PREFIX}images/stamp.gif" border="0px" alt="" /></div>
            <br />
            <b><font face="arial" color="#000000" size="4">{GREETINGS}</font></b>
            <br />
            <br />
            <font face="arial" color="#000000" size="2">{MESSAGE}</font>
            <br />
            <br />
            <font face="arial" color="#000000" size="2">{SENDER_NAME}</font>
            (<a href="mailto:{SENDER_EMAIL}"><font face="arial" color="#000000" size="2">{SENDER_EMAIL}</font></a>)
          </td>
        </tr>
                <tr>
                        <td colspan="2">
                                {PIC_CAPTION}
                        </td>
                </tr>
      </table>
    </td>
  </tr>
</table>
<p align="center"><a href="{VIEW_MORE_TGT}"><b>{VIEW_MORE_LNK}</b></a></p>
</body>
</html>
EOT;

// plain-text template for e-cards (as fallback for clients that can't display html-formatted mails)
if (!isset($template_ecard_plaintext))  //{THEMES}
$template_ecard_plaintext = <<<EOT
{TITLE}
=========================================

{VIEW_ECARD_LNK_PLAINTEXT}:
{VIEW_ECARD_TGT}

{GREETINGS}


{PLAINTEXT_MESSAGE}

{SENDER_NAME} ({SENDER_EMAIL})

-----------------------------------------
{VIEW_MORE_LNK}:
{VIEW_MORE_TGT}
EOT;

// HTML template for report
if (!isset($template_report))  //{THEMES}
$template_report = <<<EOT
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="{LANG_DIR}">
<head>
<title>{TITLE}</title>
<meta http-equiv="content-type" content="text/html; charset={CHARSET}" />
</head>
<body bgcolor="#FFFFFF" text="#0F5475" link="#0F5475" vlink="#0F5475" alink="#0F5475">
<br />
<p align="center"><a href="{VIEW_REPORT_TGT}"><b>{VIEW_REPORT_LNK}</b></a></p>
<table border="0px" cellspacing="0px" cellpadding="1px" align="center">
  <tr>
    <td bgcolor="#000000">
      <table border="0px" cellspacing="0px" cellpadding="10px" bgcolor="#ffffff">
        <tr>
          <td valign="top">
           <a href="{PIC_TGT}"><img src="{PIC_URL}" border="1px" alt="" /></a><br />
          </td>
          <td valign="top" width="200px">
            <b><font face="arial" color="#000000" size="4">{SUBJECT}</font></b>
            <br />
                                                <br />
                                                {REASON}
            <p>
            <font face="arial" color="#000000" size="2">{MESSAGE}</font>
            </p>
            <font face="arial" color="#000000" size="2">{SENDER_NAME}</font>
            (<a href="mailto:{SENDER_EMAIL}"><font face="arial" color="#000000" size="2">{SENDER_EMAIL}</font></a>)
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<p align="center"><a href="{VIEW_MORE_TGT}"><b>{VIEW_MORE_LNK}</b></a></p>
</body>
</html>
EOT;

// plain-text template for reports (as fallback for clients that can't display html-formatted mails)
if (!isset($template_report_plaintext))  //{THEMES}
$template_report_plaintext = <<<EOT
{TITLE}
=========================================

{VIEW_REPORT_LNK_PLAINTEXT}:
{VIEW_REPORT_TGT}


{SUBJECT}

{REASON}

{PLAINTEXT_MESSAGE}

{SENDER_NAME} ({SENDER_EMAIL})

-----------------------------------------
{VIEW_MORE_LNK}:
{VIEW_MORE_TGT}
EOT;

// HTML template for displaying a reported comment
if (!isset($template_report_comment))  //{THEMES}
$template_report_comment = <<<EOT
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="{LANG_DIR}">
<head>
<title>{TITLE}</title>
<meta http-equiv="content-type" content="text/html; charset={CHARSET}" />
</head>
<body bgcolor="#FFFFFF" text="#0F5475" link="#0F5475" vlink="#0F5475" alink="#0F5475">
<br />
<p align="center"><a href="{VIEW_REPORT_TGT}"><b>{VIEW_REPORT_LNK}</b></a></p>
<table border="0px" cellspacing="0px" cellpadding="1px" align="center">
  <tr>
    <td bgcolor="#000000">
      <table border="0px" cellspacing="0px" cellpadding="10px" bgcolor="#ffffff">
        <tr>
          <td valign="top">
           {COMMENT}
                                                <p align="center"><a href="{COMMENT_TGT}">{COMMENT_LNK}</a></p>
          </td>
                                        </tr>
                                        <tr>
          <td valign="top">
            <b><font face="arial" color="#000000" size="4">{SUBJECT}</font></b>
                                                <p>
              {REASON}
            <p>
            <font face="arial" color="#000000" size="2">{MESSAGE}</font>
            </p>
            <font face="arial" color="#000000" size="2">{SENDER_NAME}</font>
            (<a href="mailto:{SENDER_EMAIL}"><font face="arial" color="#000000" size="2">{SENDER_EMAIL}</font></a>)
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<p align="center"><a href="{VIEW_MORE_TGT}"><b>{VIEW_MORE_LNK}</b></a></p>
</body>
</html>
EOT;

// plain-text template for reports (as fallback for clients that can't display html-formatted mails)
if (!isset($template_report_comment_email))  //{THEMES}
$template_report_comment_email = <<<EOT
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="{LANG_DIR}">
<head>
<title>{TITLE}</title>
<meta http-equiv="content-type" content="text/html; charset={CHARSET}" />
</head>
<body bgcolor="#FFFFFF" text="#0F5475" link="#0F5475" vlink="#0F5475" alink="#0F5475">
<p><a href="{VIEW_REPORT_TGT}">{VIEW_COMMENT_LNK}</a></p>
                <b><font face="arial" color="#000000" size="4">{SUBJECT}</font></b>
                <p>
                        {REASON}
                <p>
                <font face="arial" color="#000000" size="2">{MESSAGE}</font>
                </p>
                <font face="arial" color="#000000" size="2">{SENDER_NAME}</font>
                (<a href="mailto:{SENDER_EMAIL}"><font face="arial" color="#000000" size="2">{SENDER_EMAIL}</font></a>)
<p><a href="{VIEW_MORE_TGT}"><b>{VIEW_MORE_LNK}</b></a></p>
</body>
</html>
EOT;

// Template used for tabbed display
if (!isset($template_tab_display))  //{THEMES}
$template_tab_display = array('left_text' => '<td width="100%%" align="left" valign="middle" class="tableh1_compact" style="white-space: nowrap"><b>{LEFT_TEXT}</b></td>' . "\n",
    'tab_header' => '',
    'tab_trailer' => '',
    'active_tab' => '<td><img src="images/spacer.gif" width="1" height="1" alt="" /></td>' . "\n" . '<td align="center" valign="middle" class="tableb_compact"><b>%d</b></td>',
    'inactive_tab' => '<td><img src="images/spacer.gif" width="1" height="1" alt="" /></td>' . "\n" . '<td align="center" valign="middle" class="navmenu"><a href="{LINK}"><b>%d</b></a></td>' . "\n"
);

// Template used for Vanity Footer
if (!isset($template_vanity))  //{THEMES}
$template_vanity = <<<EOT
<div id="vanity">
      <a id="v_php" href="http://www.php.net/"  rel="external"></a>
      <a id="v_mysql" href="http://www.mysql.com/"  rel="external"></a>
      <a id="v_xhtml" href="http://validator.w3.org/check/referer"  rel="external"></a>
      <a id="v_css" href="http://jigsaw.w3.org/css-validator/check/referer"  rel="external"></a>
</div>
EOT;

if (!function_exists('pageheader')) {  //{THEMES}
function pageheader($section, $meta = '')
{
    global $CONFIG, $THEME_DIR;
    global $template_header, $lang_charset, $lang_text_dir;

    $custom_header = cpg_get_custom_include($CONFIG['custom_header_path']);

    header('P3P: CP="CAO DSP COR CURa ADMa DEVa OUR IND PHY ONL UNI COM NAV INT DEM PRE"');
    user_save_profile();

    $template_vars = array('{LANG_DIR}' => $lang_text_dir,
        '{TITLE}' => $CONFIG['gallery_name'] . ' - ' . strip_tags(bb_decode($section)),
        '{CHARSET}' => $CONFIG['charset'] == 'language file' ? $lang_charset : $CONFIG['charset'],
        '{META}' => $meta,
        '{GAL_NAME}' => $CONFIG['gallery_name'],
        '{GAL_DESCRIPTION}' => $CONFIG['gallery_description'],
        '{SYS_MENU}' => theme_main_menu('sys_menu'),
        '{SUB_MENU}' => theme_main_menu('sub_menu'),
        '{ADMIN_MENU}' => theme_admin_mode_menu(),
        '{CUSTOM_HEADER}' => $custom_header,
        );

    echo template_eval($template_header, $template_vars);
}
}  //{THEMES}
// Function for writing a pagefooter
if (!function_exists('pagefooter')) {  //{THEMES}
function pagefooter()
{
    //global $HTTP_GET_VARS, $HTTP_POST_VARS, $HTTP_SERVER_VARS;
    global $USER, $USER_DATA, $ALBUM_SET, $CONFIG, $time_start, $query_stats, $queries;;
    global $template_footer;

    $custom_footer = cpg_get_custom_include($CONFIG['custom_footer_path']);

    if ($CONFIG['debug_mode']==1 || ($CONFIG['debug_mode']==2 && GALLERY_ADMIN_MODE)) {
    cpg_debug_output();
    }

    $template_vars = array(
        '{CUSTOM_FOOTER}' => $custom_footer,
        '{VANITY}' => (defined('THEME_IS_XHTML10_TRANSITIONAL') && $CONFIG['vanity_block']) ? theme_vanity() : '',
    );

    echo template_eval($template_footer, $template_vars);
}
}  //{THEMES}
// Function to start a 'standard' table
if (!function_exists('starttable')) {  //{THEMES}
function starttable($width = '-1', $title = '', $title_colspan = '1')
{
    global $CONFIG;

    if ($width == '-1') $width = $CONFIG['picture_table_width'];
    if ($width == '100%') $width = $CONFIG['main_table_width'];
    echo <<<EOT

<!-- Start standard table -->
<table align="center" width="$width" cellspacing="1" cellpadding="0" class="maintable">

EOT;
    if ($title) {
        echo <<<EOT
        <tr>
                <td class="tableh1" colspan="$title_colspan">$title</td>
        </tr>

EOT;
    }
}
}  //{THEMES}

if (!function_exists('endtable')) {  //{THEMES}
function endtable()
{
    echo <<<EOT
</table>
<!-- End standard table -->

EOT;
}
}  //{THEMES}

if (!function_exists('theme_main_menu')) {  //{THEMES}
function theme_main_menu($which)
{
    global $AUTHORIZED, $CONFIG, $album, $actual_cat, $cat, $REFERER;
    global $lang_main_menu, $template_sys_menu, $template_sub_menu;


    static $sys_menu = '', $sub_menu = '';
    if ($$which != '') {
        return $$which;
    }

    $album_l = isset($album) ? "?album=$album" : '';
    $cat_l = (isset($actual_cat))? "?cat=$actual_cat" : (isset($cat) ? "?cat=$cat" : '');
    $cat_l2 = isset($cat) ? "&amp;cat=$cat" : '';
    $my_gallery_id = FIRST_USER_CAT + USER_ID;



  if ($which == 'sys_menu' ) {
    if (USER_ID) {
        template_extract_block($template_sys_menu, 'login');
    } else {
        template_extract_block($template_sys_menu, 'logout');
        template_extract_block($template_sys_menu, 'my_profile');
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

    if (!USER_CAN_UPLOAD_PICTURES) {
        template_extract_block($template_sys_menu, 'upload_pic');
    }

    if (USER_ID || !$CONFIG['allow_user_registration']) {
        template_extract_block($template_sys_menu, 'register');
    }

    if (!USER_ID || !$CONFIG['allow_memberlist']) {
        template_extract_block($template_sys_menu, 'allow_memberlist');
    }

    if (!$CONFIG['display_faq']) {
        template_extract_block($template_sys_menu, 'faq');
    }

    $param = array(
        '{HOME_TGT}' => $CONFIG['home_target'],
        '{HOME_TITLE}' => $lang_main_menu['home_title'],
        '{HOME_LNK}' => $lang_main_menu['home_lnk'],
        '{MY_GAL_TGT}' => "index.php?cat=$my_gallery_id",
        '{MY_GAL_TITLE}' => $lang_main_menu['my_gal_title'],
        '{MY_GAL_LNK}' => $lang_main_menu['my_gal_lnk'],
        '{MEMBERLIST_TGT}' => "usermgr.php",
        '{MEMBERLIST_TITLE}' => $lang_main_menu['memberlist_title'],
        '{MEMBERLIST_LNK}' => $lang_main_menu['memberlist_lnk'],
        '{MY_PROF_TGT}' => "profile.php?op=edit_profile",
        '{MY_PROF_TITLE}' => $lang_main_menu['my_prof_title'],
        '{MY_PROF_LNK}' => $lang_main_menu['my_prof_lnk'],
        '{ADM_MODE_TGT}' => "mode.php?admin_mode=1&amp;referer=$REFERER",
        '{ADM_MODE_TITLE}' => $lang_main_menu['adm_mode_title'],
        '{ADM_MODE_LNK}' => $lang_main_menu['adm_mode_lnk'],
        '{USR_MODE_TGT}' => "mode.php?admin_mode=0&amp;referer=$REFERER",
        '{USR_MODE_TITLE}' => $lang_main_menu['usr_mode_title'],
        '{USR_MODE_LNK}' => $lang_main_menu['usr_mode_lnk'],
        '{UPL_PIC_TGT}' => "upload.php",
        '{UPL_PIC_TITLE}' => $lang_main_menu['upload_pic_title'],
        '{UPL_PIC_LNK}' => $lang_main_menu['upload_pic_lnk'],
        '{REGISTER_TGT}' => "register.php",
        '{REGISTER_TITLE}' => $lang_main_menu['register_title'],
        '{REGISTER_LNK}' => $lang_main_menu['register_lnk'],
        '{LOGIN_TGT}' => "login.php?referer=$REFERER",
        '{LOGIN_TITLE}' => $lang_main_menu['login_title'],
        '{LOGIN_LNK}' => $lang_main_menu['login_lnk'],
        '{LOGOUT_TGT}' => "logout.php?referer=$REFERER",
        '{LOGOUT_TITLE}' => $lang_main_menu['logout_title'],
        '{LOGOUT_LNK}' => $lang_main_menu['logout_lnk'] . " [" . USER_NAME . "]",
        '{FAQ_TGT}' => "faq.php",
        '{FAQ_TITLE}' => $lang_main_menu['faq_title'],
        '{FAQ_LNK}' => $lang_main_menu['faq_lnk'],
        );

        $sys_menu = template_eval($template_sys_menu, $param);
  } else {

    if (!$CONFIG['custom_lnk_url']) {
        template_extract_block($template_sub_menu, 'custom_link');
    }

    $param = array(
        '{ALB_LIST_TGT}' => "index.php$cat_l",
        '{ALB_LIST_TITLE}' => $lang_main_menu['alb_list_title'],
        '{ALB_LIST_LNK}' => $lang_main_menu['alb_list_lnk'],
        '{CUSTOM_LNK_TGT}' => $CONFIG['custom_lnk_url'],
        '{CUSTOM_LNK_TITLE}' => $CONFIG['custom_lnk_name'],
        '{CUSTOM_LNK_LNK}' => $CONFIG['custom_lnk_name'],
        '{LASTUP_TGT}' => "thumbnails.php?album=lastup$cat_l2",
        '{LASTUP_TITLE}' => $lang_main_menu['lastup_title'],
        '{LASTUP_LNK}' => $lang_main_menu['lastup_lnk'],
        '{LASTCOM_TGT}' => "thumbnails.php?album=lastcom$cat_l2",
        '{LASTCOM_TITLE}' => $lang_main_menu['lastcom_title'],
        '{LASTCOM_LNK}' => $lang_main_menu['lastcom_lnk'],
        '{TOPN_TGT}' => "thumbnails.php?album=topn$cat_l2",
        '{TOPN_TITLE}' => $lang_main_menu['topn_title'],
        '{TOPN_LNK}' => $lang_main_menu['topn_lnk'],
        '{TOPRATED_TGT}' => "thumbnails.php?album=toprated$cat_l2",
        '{TOPRATED_TITLE}' => $lang_main_menu['toprated_title'],
        '{TOPRATED_LNK}' => $lang_main_menu['toprated_lnk'],
        '{FAV_TGT}' => "thumbnails.php?album=favpics",
        '{FAV_TITLE}' => $lang_main_menu['fav_title'],
        '{FAV_LNK}' => $lang_main_menu['fav_lnk'],
        '{SEARCH_TGT}' => "search.php",
        '{SEARCH_TITLE}' => $lang_main_menu['search_title'],
        '{SEARCH_LNK}' => $lang_main_menu['search_lnk'],
        );
    $sub_menu = template_eval($template_sub_menu, $param);
  }

    return $$which;
}
}  //{THEMES}

if (!function_exists('theme_admin_mode_menu')) {  //{THEMES}
function theme_admin_mode_menu()
{
    global $cat;
    global $lang_gallery_admin_menu, $lang_user_admin_menu;
    global $template_gallery_admin_menu, $template_user_admin_menu;
    global $CONFIG;

    $cat_l = isset($cat) ? "?cat=$cat" : '';

    static $admin_menu = '';

    // Populate the admin menu only if empty to avoid template errors
    if ($admin_menu == '') {
        if ($CONFIG['log_ecards'] == 0) {
            template_extract_block($template_gallery_admin_menu, 'log_ecards');
        }

        if (cpg_get_pending_approvals() == 0) {
             template_extract_block($template_gallery_admin_menu, 'admin_approval');
        }

        if (GALLERY_ADMIN_MODE) {
            // do the docs exist on the webserver?
            if (file_exists('docs/index.htm') == true) {
                $documentation_href = 'docs/index.htm';
            } else {
                $documentation_href = 'http://coppermine.sf.net/docs/cpg14/index.php';
            }
            $param = array('{CATL}' => $cat_l,
                '{UPL_APP_TITLE}' => $lang_gallery_admin_menu['upl_app_title'],
                '{UPL_APP_LNK}' => $lang_gallery_admin_menu['upl_app_lnk'],
                '{ADMIN_TITLE}' => $lang_gallery_admin_menu['admin_title'],
                '{ADMIN_LNK}' => $lang_gallery_admin_menu['admin_lnk'],
                '{ALBUMS_TITLE}' => $lang_gallery_admin_menu['albums_title'],
                '{ALBUMS_LNK}' => $lang_gallery_admin_menu['albums_lnk'],
                '{CATEGORIES_TITLE}' => $lang_gallery_admin_menu['categories_title'],
                '{CATEGORIES_LNK}' => $lang_gallery_admin_menu['categories_lnk'],
                '{USERS_TITLE}' => $lang_gallery_admin_menu['users_title'],
                '{USERS_LNK}' => $lang_gallery_admin_menu['users_lnk'],
                '{GROUPS_TITLE}' => $lang_gallery_admin_menu['groups_title'],
                '{GROUPS_LNK}' => $lang_gallery_admin_menu['groups_lnk'],
                '{COMMENTS_TITLE}' => $lang_gallery_admin_menu['comments_title'],
                '{COMMENTS_LNK}' => $lang_gallery_admin_menu['comments_lnk'],
                '{SEARCHNEW_TITLE}' => $lang_gallery_admin_menu['searchnew_title'],
                '{SEARCHNEW_LNK}' => $lang_gallery_admin_menu['searchnew_lnk'],
                '{MY_PROF_TITLE}' => $lang_user_admin_menu['my_prof_title'],
                '{MY_PROF_LNK}' => $lang_user_admin_menu['my_prof_lnk'],
                '{UTIL_TITLE}' => $lang_gallery_admin_menu['util_title'],
                '{UTIL_LNK}' => $lang_gallery_admin_menu['util_lnk'],
                '{BAN_TITLE}' => $lang_gallery_admin_menu['ban_title'],
                '{BAN_LNK}' => $lang_gallery_admin_menu['ban_lnk'],
                '{DB_ECARD_TITLE}' => $lang_gallery_admin_menu['db_ecard_title'],
                '{DB_ECARD_LNK}' => $lang_gallery_admin_menu['db_ecard_lnk'],
                '{PICTURES_TITLE}' => $lang_gallery_admin_menu['pictures_title'],
                '{PICTURES_LNK}' => $lang_gallery_admin_menu['pictures_lnk'],
                '{DOCUMENTATION_HREF}' => $documentation_href,
                '{DOCUMENTATION_TITLE}' => $lang_gallery_admin_menu['documentation_lnk'],
                '{DOCUMENTATION_LNK}' => $lang_gallery_admin_menu['documentation_lnk'],
                );

            $html = template_eval($template_gallery_admin_menu, $param);
            $html.= cpg_alert_dev_version();
        } elseif (USER_ADMIN_MODE) {
            $param = array('{ALBMGR_TITLE}' => $lang_user_admin_menu['albmgr_title'],
                '{ALBMGR_LNK}' => $lang_user_admin_menu['albmgr_lnk'],
                '{MODIFYALB_TITLE}' => $lang_user_admin_menu['modifyalb_title'],
                '{MODIFYALB_LNK}' => $lang_user_admin_menu['modifyalb_lnk'],
                '{MY_PROF_TITLE}' => $lang_user_admin_menu['my_prof_title'],
                '{MY_PROF_LNK}' => $lang_user_admin_menu['my_prof_lnk'],
                '{PICTURES_TITLE}' => $lang_gallery_admin_menu['pictures_title'],
                '{PICTURES_LNK}' => $lang_gallery_admin_menu['pictures_lnk'],
                );

            $html = template_eval($template_user_admin_menu, $param);
        } else {
            $html = '';
        }

        $admin_menu = $html;
    }

    return $admin_menu;
}
}  //{THEMES}

if (!function_exists('theme_display_cat_list')) {  //{THEMES}
function theme_display_cat_list($breadcrumb, &$cat_data, $statistics)
{
    global $template_cat_list, $lang_cat_list;
    if (count($cat_data) > 0) {
        starttable('100%');
        $template = template_extract_block($template_cat_list, 'header');
        $params = array('{CATEGORY}' => $lang_cat_list['category'],
            '{ALBUMS}' => $lang_cat_list['albums'],
            '{PICTURES}' => $lang_cat_list['pictures'],
            );
        echo template_eval($template, $params);
    }

    $template_noabl = template_extract_block($template_cat_list, 'catrow_noalb');
    $template = template_extract_block($template_cat_list, 'catrow');
    foreach($cat_data as $category) {
        if (count($category) == 3) {
            $params = array('{CAT_TITLE}' => $category[0],
                    '{CAT_THUMB}' => $category['cat_thumb'],
                '{CAT_DESC}' => $category[1]
                );
            echo template_eval($template_noabl, $params);
        } elseif (isset($category['cat_albums']) && ($category['cat_albums'] != '')) {
            $params = array('{CAT_TITLE}' => $category[0],
                '{CAT_THUMB}' => $category['cat_thumb'],
                '{CAT_DESC}' => $category[1],
                '{CAT_ALBUMS}' => $category['cat_albums'],
                '{ALB_COUNT}' => $category[2],
                '{PIC_COUNT}' => $category[3],
                );
            echo template_eval($template, $params);
        } else {
            $params = array('{CAT_TITLE}' => $category[0],
                '{CAT_THUMB}' => $category['cat_thumb'],
                '{CAT_DESC}' => $category[1],
                '{CAT_ALBUMS}' => '',
                '{ALB_COUNT}' => $category[2],
                '{PIC_COUNT}' => $category[3],
                );
            echo template_eval($template, $params);
        }
    }

    if ($statistics && count($cat_data) > 0) {
        $template = template_extract_block($template_cat_list, 'footer');
        $params = array('{STATISTICS}' => $statistics);
        echo template_eval($template, $params);
    }


    if (count($cat_data) > 0)
          endtable();
        echo template_extract_block($template_cat_list, 'spacer');
}
}  //{THEMES}

if (!function_exists('theme_display_breadcrumb')) {  //{THEMES}
function theme_display_breadcrumb($breadcrumb, &$cat_data)
{
    /**
     * ** added breadcrumb as a seperate element
     */
    global $template_breadcrumb, $lang_breadcrumb;

    starttable('100%');
    if ($breadcrumb) {
        $template = template_extract_block($template_breadcrumb, 'breadcrumb');
        $params = array('{BREADCRUMB}' => $breadcrumb
            );
        echo template_eval($template, $params);
    }
        endtable();
}
}  //{THEMES}

if (!function_exists('theme_display_album_list'))  {  //{THEMES}
function theme_display_album_list(&$alb_list, $nbAlb, $cat, $page, $total_pages)
{

    global $CONFIG, $STATS_IN_ALB_LIST, $statistics, $template_tab_display, $template_album_list, $lang_album_list;

    $theme_alb_list_tab_tmpl = $template_tab_display;

    $theme_alb_list_tab_tmpl['left_text'] = strtr($theme_alb_list_tab_tmpl['left_text'], array('{LEFT_TEXT}' => $lang_album_list['album_on_page']));
    $theme_alb_list_tab_tmpl['inactive_tab'] = strtr($theme_alb_list_tab_tmpl['inactive_tab'], array('{LINK}' => 'index.php?cat=' . $cat . '&amp;page=%d'));
    $theme_alb_list_tab_tmpl['inactive_next_tab'] = strtr($theme_alb_list_tab_tmpl['inactive_next_tab'], array('{LINK}' => 'index.php?cat=' . $cat . '&amp;page=%d'));
    $theme_alb_list_tab_tmpl['inactive_prev_tab'] = strtr($theme_alb_list_tab_tmpl['inactive_prev_tab'], array('{LINK}' => 'index.php?cat=' . $cat . '&amp;page=%d'));

    $tabs = create_tabs($nbAlb, $page, $total_pages, $theme_alb_list_tab_tmpl);

    $album_cell = template_extract_block($template_album_list, 'album_cell');
    $empty_cell = template_extract_block($template_album_list, 'empty_cell');
    $tabs_row = template_extract_block($template_album_list, 'tabs');
    $stat_row = template_extract_block($template_album_list, 'stat_row');
    $spacer = template_extract_block($template_album_list, 'spacer');
    $header = template_extract_block($template_album_list, 'header');
    $footer = template_extract_block($template_album_list, 'footer');
    $rows_separator = template_extract_block($template_album_list, 'row_separator');

    $count = 0;

    $columns = $CONFIG['album_list_cols'];
    $column_width = ceil(100 / $columns);
    $thumb_cell_width = $CONFIG['alb_list_thumb_size'] + 2;

    starttable('100%');

    if ($STATS_IN_ALB_LIST) {
        $params = array('{STATISTICS}' => $statistics,
            '{COLUMNS}' => $columns,
            );
        echo template_eval($stat_row, $params);
    }

    echo $header;

    if (is_array($alb_list)) {
        foreach($alb_list as $album) {
            $count ++;

            $params = array('{COL_WIDTH}' => $column_width,
                '{ALBUM_TITLE}' => $album['album_title'],
                '{THUMB_CELL_WIDTH}' => $thumb_cell_width,
                '{ALB_LINK_TGT}' => "thumbnails.php?album={$album['aid']}",
                '{ALB_LINK_PIC}' => $album['thumb_pic'],
                '{ADMIN_MENU}' => $album['album_adm_menu'],
                '{ALB_DESC}' => $album['album_desc'],
                '{ALB_INFOS}' => $album['album_info'],
                );

            echo template_eval($album_cell, $params);

            if ($count % $columns == 0 && $count < count($alb_list)) {
                echo $rows_separator;
            }
        }
    }

    $params = array('{COL_WIDTH}' => $column_width,
          '{SPACER}' => $thumb_cell_width
          );
    $empty_cell = template_eval($empty_cell, $params);

    while ($count++ % $columns != 0) {
        echo $empty_cell;
    }

    echo $footer;
    // Tab display
    $params = array('{COLUMNS}' => $columns,
        '{TABS}' => $tabs,
        );
    echo template_eval($tabs_row, $params);

    endtable();

    echo $spacer;
}
}  //{THEMES}
// Function to display first level Albums of a category
if (!function_exists('theme_display_album_list_cat')) {  //{THEMES}
function theme_display_album_list_cat(&$alb_list, $nbAlb, $cat, $page, $total_pages)
{
    global $CONFIG, $STATS_IN_ALB_LIST, $statistics, $template_tab_display, $template_album_list_cat, $lang_album_list;
    if (!$CONFIG['first_level']) {
        return;
    }

    $theme_alb_list_tab_tmpl = $template_tab_display;

    $theme_alb_list_tab_tmpl['left_text'] = strtr($theme_alb_list_tab_tmpl['left_text'], array('{LEFT_TEXT}' => $lang_album_list['album_on_page']));
    $theme_alb_list_tab_tmpl['inactive_tab'] = strtr($theme_alb_list_tab_tmpl['inactive_tab'], array('{LINK}' => 'index.php?cat=' . $cat . '&amp;page=%d'));

    $tabs = create_tabs($nbAlb, $page, $total_pages, $theme_alb_list_tab_tmpl);
    // echo $template_album_list_cat;
    $template_album_list_cat1 = $template_album_list_cat;
    $album_cell = template_extract_block($template_album_list_cat1, 'c_album_cell');
    $empty_cell = template_extract_block($template_album_list_cat1, 'c_empty_cell');
    $tabs_row = template_extract_block($template_album_list_cat1, 'c_tabs');
    $stat_row = template_extract_block($template_album_list_cat1, 'c_stat_row');
    $spacer = template_extract_block($template_album_list_cat1, 'c_spacer');
    $header = template_extract_block($template_album_list_cat1, 'c_header');
    $footer = template_extract_block($template_album_list_cat1, 'c_footer');
    $rows_separator = template_extract_block($template_album_list_cat1, 'c_row_separator');

    $count = 0;

    $columns = $CONFIG['album_list_cols'];
    $column_width = ceil(100 / $columns);
    $thumb_cell_width = $CONFIG['alb_list_thumb_size'] + 2;

    starttable('100%');

    if ($STATS_IN_ALB_LIST) {
        $params = array('{STATISTICS}' => $statistics,
            '{COLUMNS}' => $columns,
            );
        echo template_eval($stat_row, $params);
    }

    echo $header;

    if (is_array($alb_list)) {
        foreach($alb_list as $album) {
            $count ++;

            $params = array('{COL_WIDTH}' => $column_width,
                '{ALBUM_TITLE}' => $album['album_title'],
                '{THUMB_CELL_WIDTH}' => $thumb_cell_width,
                '{ALB_LINK_TGT}' => "thumbnails.php?album={$album['aid']}",
                '{ALB_LINK_PIC}' => $album['thumb_pic'],
                '{ADMIN_MENU}' => $album['album_adm_menu'],
                '{ALB_DESC}' => $album['album_desc'],
                '{ALB_INFOS}' => $album['album_info'],
                );

            echo template_eval($album_cell, $params);

            if ($count % $columns == 0 && $count < count($alb_list)) {
                echo $rows_separator;
            }
        }
    }

    $params = array('{COL_WIDTH}' => $column_width,
          '{SPACER}' => $thumb_cell_width
          );
    $empty_cell = template_eval($empty_cell, $params);

    while ($count++ % $columns != 0) {
        echo $empty_cell;
    }

    echo $footer;
    // Tab display
    $params = array('{COLUMNS}' => $columns,
        '{TABS}' => $tabs,
        );
    echo template_eval($tabs_row, $params);

    endtable();

    echo $spacer;
}
}  //{THEMES}

if (!function_exists('theme_display_thumbnails')) {  //{THEMES}
function theme_display_thumbnails(&$thumb_list, $nbThumb, $album_name, $aid, $cat, $page, $total_pages, $sort_options, $display_tabs, $mode = 'thumb')
{
    global $CONFIG;
    global $template_thumb_view_title_row,$template_fav_thumb_view_title_row, $lang_thumb_view, $template_tab_display, $template_thumbnail_view;

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

    $theme_thumb_tab_tmpl = $template_tab_display;

    if ($mode == 'thumb') {
        $theme_thumb_tab_tmpl['left_text'] = strtr($theme_thumb_tab_tmpl['left_text'], array('{LEFT_TEXT}' => $lang_thumb_view['pic_on_page']));
        $theme_thumb_tab_tmpl['inactive_tab'] = strtr($theme_thumb_tab_tmpl['inactive_tab'], array('{LINK}' => 'thumbnails.php?album=' . $aid . $cat_link . '&amp;page=%d'));
        $theme_thumb_tab_tmpl['inactive_next_tab'] = strtr($theme_thumb_tab_tmpl['inactive_next_tab'], array('{LINK}' => 'thumbnails.php?album=' . $aid . $cat_link . '&amp;page=%d'));
        $theme_thumb_tab_tmpl['inactive_prev_tab'] = strtr($theme_thumb_tab_tmpl['inactive_prev_tab'], array('{LINK}' => 'thumbnails.php?album=' . $aid . $cat_link . '&amp;page=%d'));
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
                    '{LINK_TGT}' => "displayimage.php?album=$aid$cat_link&amp;pos={$thumb['pos']}",
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

    if ($display_tabs) {
        $params = array('{THUMB_COLS}' => $thumbcols,
            '{TABS}' => $tabs_html
            );
        echo template_eval($tabs, $params);
    }

    endtable();
    echo $spacer;
}
}  //{THEMES}
// Added to display flim_strip
if (!function_exists('theme_display_film_strip')) {  //{THEMES}
function theme_display_film_strip(&$thumb_list, $nbThumb, $album_name, $aid, $cat, $pos, $sort_options, $mode = 'thumb')
{
    global $CONFIG, $THEME_DIR;
    global $template_film_strip, $lang_film_strip;

    static $template = '';
    static $thumb_cell = '';
    static $empty_cell = '';
    static $spacer = '';

    if ((!$template)) {
        $template = $template_film_strip;
        $thumb_cell = template_extract_block($template, 'thumb_cell');
        $empty_cell = template_extract_block($template, 'empty_cell');
    }

    $cat_link = is_numeric($aid) ? '' : '&amp;cat=' . $cat;

    $thumbcols = $CONFIG['thumbcols'];
    $cell_width = ceil(100 / $CONFIG['max_film_strip_items']) . '%';

    $i = 0;
    $thumb_strip = '';
    foreach($thumb_list as $thumb) {
        $i++;
        if ($mode == 'thumb') {
            $params = array('{CELL_WIDTH}' => $cell_width,
                '{LINK_TGT}' => "displayimage.php?album=$aid$cat_link&amp;pos={$thumb['pos']}",
                '{THUMB}' => $thumb['image'],
                '{CAPTION}' => $thumb['caption'],
                '{ADMIN_MENU}' => ''
                );
        } else {
            $params = array('{CELL_WIDTH}' => $cell_width,
                '{LINK_TGT}' => "index.php?cat={$thumb['cat']}",
                '{THUMB}' => $thumb['image'],
                '{CAPTION}' => '',
                '{ADMIN_MENU}' => ''
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

    $params = array('{THUMB_STRIP}' => $thumb_strip,
        '{COLS}' => $i,
        '{TILE1}' => $tile1,
        '{TILE2}' => $tile2,
        );

    ob_start();
    starttable($CONFIG['picture_table_width']);
    echo template_eval($template, $params);
    endtable();
    $film_strip = ob_get_contents();
    ob_end_clean();

    return $film_strip;
}
}  //{THEMES}

if (!function_exists('theme_no_img_to_display')) {  //{THEMES}
function theme_no_img_to_display($album_name)
{
    global $lang_errors, $template_no_img_to_display;

    static $template = '';
    static $spacer;

    if ((!$template)) {
        $template = $template_no_img_to_display;
        $spacer = template_extract_block($template, 'spacer');
    }

    $params = array('{TEXT}' => $lang_errors['no_img_to_display']);
    starttable('100%', $album_name);
    echo template_eval($template, $params);
    endtable();
}
}  //{THEMES}

if (!function_exists('theme_display_image')) {  //{THEMES}
function theme_display_image($nav_menu, $picture, $votes, $pic_info, $comments, $film_strip)
{
    global $CONFIG;

    $width = $CONFIG['picture_table_width'];

    starttable();
    echo $nav_menu;
    endtable();

    starttable();
    echo $picture;
    endtable();
    if ($CONFIG['display_film_strip'] == 1) {
        echo $film_strip;
    }


    echo $votes;



    $picinfo = isset($_COOKIE['picinfo']) ? $_COOKIE['picinfo'] : ($CONFIG['display_pic_info'] ? 'block' : 'none');
    echo "<div id=\"picinfo\" style=\"display: $picinfo;\">\n";
    starttable();
    echo $pic_info;
    endtable();
    echo "</div>\n";

    echo "<div id=\"comments\">\n";
        echo $comments;
        echo "</div>\n";

}
}  //{THEMES}

if (!function_exists('theme_html_picinfo')) {  //{THEMES}
function theme_html_picinfo(&$info)
{
    global $lang_picinfo;

    $html = '';

    $html .= "        <tr><td colspan=\"2\" class=\"tableh2_compact\"><b>{$lang_picinfo['title']}</b></td></tr>\n";
    $template = "        <tr><td class=\"tableb_compact\" valign=\"top\" >%s:</td><td class=\"tableb_compact\">%s</td></tr>\n";
    foreach ($info as $key => $value) $html .= sprintf($template, $key, $value);

    return $html;
}
}  //{THEMES}

// Displays a picture
if (!function_exists('theme_html_picture')) {  //{THEMES}
function theme_html_picture()
{
    global $CONFIG, $CURRENT_PIC_DATA, $CURRENT_ALBUM_DATA, $USER;
    global $album, $comment_date_fmt, $template_display_media;
    global $lang_display_image_php, $lang_picinfo;

    $pid = $CURRENT_PIC_DATA['pid'];
    $pic_title = '';

    if (!isset($USER['liv']) || !is_array($USER['liv'])) {
        $USER['liv'] = array();
    }
    // Add 1 to hit counter
    if (!USER_IS_ADMIN && !in_array($pid, $USER['liv']) && isset($_COOKIE[$CONFIG['cookie_name'] . '_data'])) {
        add_hit($pid);
        if (count($USER['liv']) > 4) array_shift($USER['liv']);
        array_push($USER['liv'], $pid);
    }

    if($CONFIG['thumb_use']=='ht' && $CURRENT_PIC_DATA['pheight'] > $CONFIG['picture_width'] ){ // The wierd comparision is because only picture_width is stored
      $condition = true;
    }elseif($CONFIG['thumb_use']=='wd' && $CURRENT_PIC_DATA['pwidth'] > $CONFIG['picture_width']){
      $condition = true;
    }elseif($CONFIG['thumb_use']=='any' && max($CURRENT_PIC_DATA['pwidth'], $CURRENT_PIC_DATA['pheight']) > $CONFIG['picture_width']){
      $condition = true;
    }else{
     $condition = false;
    }

    if ($CURRENT_PIC_DATA['title'] != '') {
        $pic_title .= $CURRENT_PIC_DATA['title'] . "\n";
    }
    if ($CURRENT_PIC_DATA['caption'] != '') {
        $pic_title .= $CURRENT_PIC_DATA['caption'] . "\n";
    }
    if ($CURRENT_PIC_DATA['keywords'] != '') {
        $pic_title .= $lang_picinfo['Keywords'] . ": " . $CURRENT_PIC_DATA['keywords'];
    }

    if (!$CURRENT_PIC_DATA['title'] && !$CURRENT_PIC_DATA['caption']) {
        template_extract_block($template_display_media, 'img_desc');
    } else {
        if (!$CURRENT_PIC_DATA['title']) {
            template_extract_block($template_display_media, 'title');
        }
        if (!$CURRENT_PIC_DATA['caption']) {
            template_extract_block($template_display_media, 'caption');
        }
    }

    $CURRENT_PIC_DATA['menu'] = html_picture_menu(); //((USER_ADMIN_MODE && $CURRENT_ALBUM_DATA['category'] == FIRST_USER_CAT + USER_ID) || ($CONFIG['users_can_edit_pics'] && $CURRENT_PIC_DATA['owner_id'] == USER_ID && USER_ID != 0) || GALLERY_ADMIN_MODE) ? html_picture_menu($pid) : '';

    if ($CONFIG['make_intermediate'] && $condition ) {
        $picture_url = get_pic_url($CURRENT_PIC_DATA, 'normal');
    } else {
        $picture_url = get_pic_url($CURRENT_PIC_DATA, 'fullsize');
    }

    $image_size = compute_img_size($CURRENT_PIC_DATA['pwidth'], $CURRENT_PIC_DATA['pheight'], $CONFIG['picture_width']);

    $pic_title = '';
    $mime_content = cpg_get_type($CURRENT_PIC_DATA['filename']);


    if ($mime_content['content']=='movie' || $mime_content['content']=='audio') {

        if ($CURRENT_PIC_DATA['pwidth']==0 || $CURRENT_PIC_DATA['pheight']==0) {
            $CURRENT_PIC_DATA['pwidth']  = 320; // Default width

            // Set default height; if file is a movie
            if ($mime_content['content']=='movie') {
                $CURRENT_PIC_DATA['pheight'] = 240; // Default height
            }
        }

        $ctrl_offset['mov']=15;
        $ctrl_offset['wmv']=45;
        $ctrl_offset['swf']=0;
        $ctrl_offset['rm']=0;
        $ctrl_offset_default=45;
        $ctrl_height = (isset($ctrl_offset[$mime_content['extension']]))?($ctrl_offset[$mime_content['extension']]):$ctrl_offset_default;
        $image_size['whole']='width="'.$CURRENT_PIC_DATA['pwidth'].'" height="'.($CURRENT_PIC_DATA['pheight']+$ctrl_height).'"';
    }

    if ($mime_content['content']=='image') {
        if (isset($image_size['reduced'])) {
            $winsizeX = $CURRENT_PIC_DATA['pwidth']+5;  //the +'s are the mysterious FF and IE paddings
            $winsizeY = $CURRENT_PIC_DATA['pheight']+3; //the +'s are the mysterious FF and IE paddings
            $pic_html = "<a href=\"javascript:;\" onclick=\"MM_openBrWindow('displayimage.php?pid=$pid&amp;fullsize=1','" . uniqid(rand()) . "','scrollbars=yes,toolbar=yes,status=yes,resizable=yes,width=$winsizeX,height=$winsizeY')\">";
            $pic_title = $lang_display_image_php['view_fs'] . "\n==============\n" . $pic_title;
            $pic_html .= "<img src=\"" . $picture_url . "\" class=\"image\" border=\"0\" alt=\"{$lang_display_image_php['view_fs']}\" /><br />";
            $pic_html .= "</a>\n";
        } else {
            $pic_html = "<img src=\"" . $picture_url . "\" {$image_size['geom']} class=\"image\" border=\"0\" alt=\"\" /><br />\n";
        }
    } elseif ($mime_content['content']=='document') {
        $pic_thumb_url = get_pic_url($CURRENT_PIC_DATA,'thumb');
        $pic_html = "<a href=\"{$picture_url}\" target=\"_blank\" class=\"document_link\"><img src=\"".$pic_thumb_url."\" border=\"0\" class=\"image\" /></a>\n<br />";
    } else {
        $autostart = ($CONFIG['media_autostart']) ? ('true'):('false');

        $players['WMP'] = array('id' => 'MediaPlayer',
                                'clsid' => 'classid="clsid:6BF52A52-394A-11D3-B153-00C04F79FAA6" ',
                                'codebase' => 'codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=5,1,52,701" ',
                                'mime' => 'type="application/x-mplayer2" '
                               );
        $players['RMP'] = array('id' => 'RealPlayer',
                                'clsid' => 'classid="clsid:CFCDAA03-8BE4-11cf-B84B-0020AFBBCCFA" ',
                                'codebase' => '',
                                'mime' => 'type="audio/x-pn-realaudio-plugin" '
                               );
        $players['QT']  = array('id' => 'QuickTime',
                                'clsid' => 'classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B" ',
                                'codebase' => 'codebase="http://www.apple.com/qtactivex/qtplugin.cab" ',
                                'mime' => 'type="video/x-quicktime" '
                               );
        $players['SWF'] = array('id' => 'SWFlash',
                                'clsid' => ' classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" ',
                                'codebase' => 'codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" ',
                                'mime' => 'type="application/x-shockwave-flash" '
                               );
        $players['UNK'] = array('id' => 'DefaultPlayer',
                                'clsid' => '',
                                'codebase' => '',
                                'mime' => ''
                               );

        if (isset($_COOKIE[$CONFIG['cookie_name'].'_'.$mime_content['extension'].'player'])) {
            $user_player = $_COOKIE[$CONFIG['cookie_name'].'_'.$mime_content['extension'].'player'];
        } else {
            $user_player = $mime_content['player'];
        }

                // There isn't a player selected or user wants client-side control
        if (!$user_player) {
            $user_player = 'UNK';
        }

        $player = $players[$user_player];

        $pic_html  = '<object id="'.$player['id'].'" '.$player['classid'].$player['codebase'].$player['mime'].$image_size['whole'].'>';
        $pic_html .= "<param name=\"autostart\" value=\"$autostart\" /><param name=\"src\" value=\"". $picture_url . "\" />";
        $pic_html .= '<embed '.$image_size['whole'].' src="'. $picture_url . '" autostart="'.$autostart.'" '.$player['mime'].'></embed>';
        $pic_html .= "</object><br />\n";
    }

    $CURRENT_PIC_DATA['html'] = $pic_html;
    $CURRENT_PIC_DATA['header'] = '';
    $CURRENT_PIC_DATA['footer'] = '';

    $CURRENT_PIC_DATA = CPGPluginAPI::filter('file_data',$CURRENT_PIC_DATA);

    $params = array('{CELL_HEIGHT}' => '100',
        '{IMAGE}' => $CURRENT_PIC_DATA['header'].$CURRENT_PIC_DATA['html'].$CURRENT_PIC_DATA['footer'],
        '{ADMIN_MENU}' => $CURRENT_PIC_DATA['menu'],
        '{TITLE}' => bb_decode($CURRENT_PIC_DATA['title']),
        '{CAPTION}' => bb_decode($CURRENT_PIC_DATA['caption']),
        );

    return template_eval($template_display_media, $params);
}
}  //{THEMES}

if (!function_exists('theme_html_img_nav_menu')) {  //{THEMES}
function theme_html_img_nav_menu()
{
    global $CONFIG, $CURRENT_PIC_DATA, $meta_nav, $THEME_DIR ; //$PHP_SELF,
    global $album, $cat, $pos, $pic_count, $lang_img_nav_bar, $lang_text_dir, $template_img_navbar;

    $cat_link = is_numeric($album) ? '' : '&amp;cat=' . $cat;

    $human_pos = $pos + 1;
    $page = ceil(($pos + 1) / ($CONFIG['thumbrows'] * $CONFIG['thumbcols']));
    $pid = $CURRENT_PIC_DATA['pid'];

    $start = 0;
        $start_tgt = "{$_SERVER['PHP_SELF']}?album=$album$cat_link&amp;pos=$start";
        $start_title = $lang_img_nav_bar['go_album_start'];
        $meta_nav .= "<link rel=\"start\" href=\"$start_tgt\" title=\"$start_title\" />
        ";
        $end = $pic_count - 1;
        $end_tgt = "{$_SERVER['PHP_SELF']}?album=$album$cat_link&amp;pos=$end";
        $end_title = $lang_img_nav_bar['go_album_end'];
        $meta_nav .= "<link rel=\"last\" href=\"$end_tgt\" title=\"$end_title\" />
        ";

    if ($pos > 0) {
        $prev = $pos - 1;
        $prev_tgt = "{$_SERVER['PHP_SELF']}?album=$album$cat_link&amp;pos=$prev";
        $prev_title = $lang_img_nav_bar['prev_title'];
                                $meta_nav .= "<link rel=\"prev\" href=\"$prev_tgt\" title=\"$prev_title\" />
                                ";
    } else {
        $prev_tgt = "javascript:;";
        $prev_title = "";
    }

    if ($pos < ($pic_count -1)) {
        $next = $pos + 1;
        $next_tgt = "{$_SERVER['PHP_SELF']}?album=$album$cat_link&amp;pos=$next";
        $next_title = $lang_img_nav_bar['next_title'];
                                $meta_nav .= "<link rel=\"next\" href=\"$next_tgt\" title=\"$next_title\"/>
                                ";
    } else {
        $next_tgt = "javascript:;";
        $next_title = "";
    }

    if (USER_CAN_SEND_ECARDS) {
        $ecard_tgt = "ecard.php?album=$album$cat_link&amp;pid=$pid&amp;pos=$pos";
        $ecard_title = $lang_img_nav_bar['ecard_title'];
    } else {
        template_extract_block($template_img_navbar, 'ecard_button'); // added to remove button if cannot send ecard
        /*$ecard_tgt = "javascript:alert('" . addslashes($lang_img_nav_bar['ecard_disabled_msg']) . "');";
        $ecard_title = $lang_img_nav_bar['ecard_disabled'];*/
    }

                //report to moderator buttons
    if (($CONFIG['report_post']==1) && (USER_CAN_SEND_ECARDS)) {
        $report_tgt = "report_file.php?album=$album$cat_link&amp;pid=$pid&amp;pos=$pos";
    } else { // remove button if report toggle is off
        template_extract_block($template_img_navbar, 'report_file_button');

    }

                    $thumb_tgt = "thumbnails.php?album=$album$cat_link&amp;page=$page";
        $meta_nav .= "<link rel=\"up\" href=\"$thumb_tgt\" title=\"".$lang_img_nav_bar['thumb_title']."\"/>
        ";

    $slideshow_tgt = "{$_SERVER['PHP_SELF']}?album=$album$cat_link&amp;pid=$pid&amp;slideshow=".$CONFIG['slideshow_interval'];

    $pic_pos = sprintf($lang_img_nav_bar['pic_pos'], $human_pos, $pic_count);

    if (defined('THEME_HAS_NAVBAR_GRAPHICS')) {
            $location= $THEME_DIR;
        } else {
            $location= '';
        }

    $params = array('{THUMB_TGT}' => $thumb_tgt,
        '{THUMB_TITLE}' => $lang_img_nav_bar['thumb_title'],
        '{PIC_INFO_TITLE}' => $lang_img_nav_bar['pic_info_title'],
        '{SLIDESHOW_TGT}' => $slideshow_tgt,
        '{SLIDESHOW_TITLE}' => $lang_img_nav_bar['slideshow_title'],
        '{PIC_POS}' => $pic_pos,
        '{ECARD_TGT}' => $ecard_tgt,
        '{ECARD_TITLE}' => $ecard_title,
        '{PREV_TGT}' => $prev_tgt,
        '{PREV_TITLE}' => $prev_title,
        '{NEXT_TGT}' => $next_tgt,
        '{NEXT_TITLE}' => $next_title,
        '{PREV_IMAGE}' => ($lang_text_dir=='ltr') ? 'prev' : 'next',
        '{NEXT_IMAGE}' => ($lang_text_dir=='ltr') ? 'next' : 'prev',
        '{REPORT_TGT}' => $report_tgt,
        '{REPORT_TITLE}' => $lang_img_nav_bar['report_title'],
        '{LOCATION}' => $location,
        );

    return template_eval($template_img_navbar, $params);
}
}  //{THEMES}

if (!function_exists('theme_html_rating_box')) {  //{THEMES}
function theme_html_rating_box()
{
    global $CONFIG, $CURRENT_PIC_DATA, $CURRENT_ALBUM_DATA, $THEME_DIR;
    global $template_image_rating, $lang_rate_pic;

    if (!(USER_CAN_RATE_PICTURES && $CURRENT_ALBUM_DATA['votes'] == 'YES')) return '';

    $votes = $CURRENT_PIC_DATA['votes'] ? sprintf($lang_rate_pic['rating'], round($CURRENT_PIC_DATA['pic_rating'] / 2000, 1), $CURRENT_PIC_DATA['votes']) : $lang_rate_pic['no_votes'];
    $pid = $CURRENT_PIC_DATA['pid'];

    if (defined('THEME_HAS_RATING_GRAPHICS')) {
        $location= $THEME_DIR;
    } else {
        $location= '';
    }

    $params = array('{TITLE}' => $lang_rate_pic['rate_this_pic'],
        '{VOTES}' => $votes,
        '{RATE0}' => "ratepic.php?pic=$pid&amp;rate=0",
        '{RATE1}' => "ratepic.php?pic=$pid&amp;rate=1",
        '{RATE2}' => "ratepic.php?pic=$pid&amp;rate=2",
        '{RATE3}' => "ratepic.php?pic=$pid&amp;rate=3",
        '{RATE4}' => "ratepic.php?pic=$pid&amp;rate=4",
        '{RATE5}' => "ratepic.php?pic=$pid&amp;rate=5",
        '{RUBBISH}' => $lang_rate_pic['rubbish'],
        '{POOR}' => $lang_rate_pic['poor'],
        '{FAIR}' => $lang_rate_pic['fair'],
        '{GOOD}' => $lang_rate_pic['good'],
        '{EXCELLENT}' => $lang_rate_pic['excellent'],
        '{GREAT}' => $lang_rate_pic['great'],
        '{WIDTH}' => $CONFIG['picture_table_width'],
        '{LOCATION}' => $location,        //theme dir or default images directory
        );

    return template_eval($template_image_rating, $params);
}
}  //{THEMES}

// Displays comments for a specific picture
if (!function_exists('theme_html_comments')) {  //{THEMES}
function theme_html_comments($pid)
{
    global $CONFIG, $USER, $CURRENT_ALBUM_DATA, $comment_date_fmt, $HTML_SUBST;
    global $template_image_comments, $template_add_your_comment, $lang_display_comments;

    $html = '';

//report to moderator buttons
    if (!(($CONFIG['report_post']==1) && (USER_CAN_SEND_ECARDS))) {
        template_extract_block($template_image_comments, 'report_comment_button');
    }

    if (!$CONFIG['enable_smilies']) {
        $tmpl_comment_edit_box = template_extract_block($template_image_comments, 'edit_box_no_smilies', '{EDIT}');
        template_extract_block($template_image_comments, 'edit_box_smilies');
        template_extract_block($template_add_your_comment, 'input_box_smilies');
    } else {
        $tmpl_comment_edit_box = template_extract_block($template_image_comments, 'edit_box_smilies', '{EDIT}');
        template_extract_block($template_image_comments, 'edit_box_no_smilies');
        template_extract_block($template_add_your_comment, 'input_box_no_smilies');
    }

    $tmpl_comments_buttons = template_extract_block($template_image_comments, 'buttons', '{BUTTONS}');
    $tmpl_comments_ipinfo = template_extract_block($template_image_comments, 'ipinfo', '{IPINFO}');

    if ($CONFIG['comments_sort_descending'] == 1) {
        $comment_sort_order = 'DESC';
    } else {
        $comment_sort_order = 'ASC';
    }
    $result = cpg_db_query("SELECT msg_id, msg_author, msg_body, UNIX_TIMESTAMP(msg_date) AS msg_date, author_id, author_md5_id, msg_raw_ip, msg_hdr_ip, pid FROM {$CONFIG['TABLE_COMMENTS']} WHERE pid='$pid' ORDER BY msg_id $comment_sort_order");

    while ($row = mysql_fetch_array($result)) {
        $user_can_edit = (GALLERY_ADMIN_MODE) || (USER_ID && USER_ID == $row['author_id'] && USER_CAN_POST_COMMENTS) || (!USER_ID && USER_CAN_POST_COMMENTS && ($USER['ID'] == $row['author_md5_id']));
        $comment_buttons = $user_can_edit ? $tmpl_comments_buttons : '';
        $comment_edit_box = $user_can_edit ? $tmpl_comment_edit_box : '';
        $comment_ipinfo = ($row['msg_raw_ip'] && GALLERY_ADMIN_MODE)?$tmpl_comments_ipinfo : '';

        if ($CONFIG['enable_smilies']) {
            $comment_body = process_smilies(make_clickable($row['msg_body']));
            $smilies = generate_smilies("f{$row['msg_id']}", 'msg_body');
        } else {
            $comment_body = make_clickable($row['msg_body']);
            $smilies = '';
        }

        $ip = $row['msg_hdr_ip'];
        if ($row['msg_hdr_ip'] != $row['msg_raw_ip']) {
            $ip .= ' [' . $row['msg_raw_ip'] . ']';
        }

        $params = array('{EDIT}' => &$comment_edit_box,
            '{BUTTONS}' => &$comment_buttons,
            '{IPINFO}' => &$comment_ipinfo
            );

        $template = template_eval($template_image_comments, $params);

        $params = array('{MSG_AUTHOR}' => $row['msg_author'],
            '{MSG_ID}' => $row['msg_id'],
            '{PID}' => $row['pid'],
            '{EDIT_TITLE}' => &$lang_display_comments['edit_title'],
            '{CONFIRM_DELETE}' => &$lang_display_comments['confirm_delete'],
            '{MSG_DATE}' => localised_date($row['msg_date'], $comment_date_fmt),
            '{MSG_BODY}' => bb_decode($comment_body),
            '{MSG_BODY_RAW}' => $row['msg_body'],
            '{OK}' => &$lang_display_comments['OK'],
            '{SMILIES}' => $smilies,
            '{IP}' => $ip,
            '{REPORT_COMMENT_TITLE}' => &$lang_display_comments['report_comment_title'],
            '{WIDTH}' => $CONFIG['picture_table_width']
            );

        $html .= template_eval($template, $params);
    }

    if (USER_CAN_POST_COMMENTS && $CURRENT_ALBUM_DATA['comments'] == 'YES') {
        if (USER_ID) {
            $user_name_input = '<tr><td><input type="hidden" name="msg_author" value="' . USER_NAME . '" /></td>';
            template_extract_block($template_add_your_comment, 'user_name_input', $user_name_input);
            $user_name = '';
        } else {
            $user_name = isset($USER['name']) ? '"' . strtr($USER['name'], $HTML_SUBST) . '"' : $lang_display_comments['your_name'] . '" onclick="javascript:this.value=\'\';';
        }

        $params = array('{ADD_YOUR_COMMENT}' => $lang_display_comments['add_your_comment'],
            // Modified Name and comment field
            '{NAME}' => $lang_display_comments['name'],
            '{COMMENT}' => $lang_display_comments['comment'],
            '{PIC_ID}' => $pid,
            '{USER_NAME}' => $user_name,
            '{MAX_COM_LENGTH}' => $CONFIG['max_com_size'],
            '{OK}' => $lang_display_comments['OK'],
            '{SMILIES}' => '',
            '{WIDTH}' => $CONFIG['picture_table_width'],
            );

        if ($CONFIG['enable_smilies']) $params['{SMILIES}'] = generate_smilies();

        $html .= template_eval($template_add_your_comment, $params);
    }

    return $html;
}
}  //{THEMES}

if (!function_exists('theme_slideshow')) {  //{THEMES}
function theme_slideshow()
{
    global $CONFIG, $lang_display_image_php, $template_display_media;

    pageheader($lang_display_image_php['slideshow']);

    include "include/slideshow.inc.php";

    $start_slideshow = '<script language="JavaScript" type="text/JavaScript">runSlideShow()</script>';
    template_extract_block($template_display_media, 'img_desc', $start_slideshow);

    $params = array('{CELL_HEIGHT}' => $CONFIG['picture_width'] + 100,
        '{IMAGE}' => '<img src="' . $start_img . '" name="SlideShow" class="image" /><br />',
        '{ADMIN_MENU}' => '',
        );

    starttable();
    echo template_eval($template_display_media, $params);
    endtable();
    starttable();
    echo <<<EOT
        <tr>
                <td align="center" class="navmenu" style="white-space: nowrap;">
                        <a href="javascript:endSlideShow()" class="navmenu">{$lang_display_image_php['stop_slideshow']}</a>
                </td>
        </tr>

EOT;
    endtable();
    pagefooter();
}
}  //{THEMES}

// Display the full size image
if (!function_exists('theme_display_fullsize_pic')) {  //{THEMES}
function theme_display_fullsize_pic()
{
    global $CONFIG, $THEME_DIR, $ALBUM_SET;
    global $lang_errors, $lang_fullsize_popup, $lang_charset;

    if (isset($_GET['picfile']))
    {
        if (!GALLERY_ADMIN_MODE) cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);

    $picfile = $_GET['picfile'];
    $picname = $CONFIG['fullpath'] . $picfile;
    $imagesize = @getimagesize($picname);
    $imagedata = array('name' => $picfile, 'path' => path2url($picname), 'geometry' => $imagesize[3]);
    }
    elseif (isset($_GET['pid']))
    {
    $pid = (int)$_GET['pid'];
    $sql = "SELECT * " . "FROM {$CONFIG['TABLE_PICTURES']} " . "WHERE pid='$pid' $ALBUM_SET";
    $result = cpg_db_query($sql);

    if (!mysql_num_rows($result)) cpg_die(ERROR, $lang_errors['non_exist_ap'], __FILE__, __LINE__);

    $row = mysql_fetch_array($result);
    $pic_url = get_pic_url($row, 'fullsize');
    $geom = 'width="' . $row['pwidth'] . '" height="' . $row['pheight'] . '"';
    $imagedata = array('name' => $row['filename'], 'path' => $pic_url, 'geometry' => $geom);
    }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
  <head>
  <title><?php echo $CONFIG['gallery_name'] ?>: <?php echo $lang_fullsize_popup['click_to_close'];
      ?></title>
  <meta http-equiv="content-type" content="text/html; charset=<?php echo $CONFIG['charset'] == 'language file' ? $lang_charset : $CONFIG['charset'] ?>" />
  <script type="text/javascript" src="scripts.js"></script>
  <style type="text/css">
  body { margin: 0; padding: 0; background-color: gray; }
  img { margin:0; padding:0; border:0; }
  #content { margin:0 auto; padding:0; border:0; }
  table { border:0; height:100%; width:100%; border-collapse:collapse}
  td {         vertical-align: middle; text-align:center; }
  </style>
  </head>
  <body>
    <script language="JavaScript" type="text/JavaScript">
      adjust_popup();
    </script>
    <table>
      <tr>
            <td>
          <div id="content">
              <?php     echo  '<a href="javascript: window.close()"><img src="'
                . htmlspecialchars($imagedata['path']) . '" '
                . $imagedata['geometry']
                . 'alt="'
                . htmlspecialchars($imagedata['name'])
                . '" title="'
                . htmlspecialchars($imagedata['name'])
                . "\n" . $lang_fullsize_popup['click_to_close']
                . '" /></a><br />' ."\n";
               ?>
          </div>
        </td>
      </tr>
    </table>
  </body>
</html>
<?php
}
}  //{THEMES}


if (!function_exists('theme_vanity')) {  //{THEMES}
function theme_vanity()
{
    global $CONFIG, $THEME_DIR, $template_vanity ;

    if (defined('THEME_HAS_VANITY_GRAPHICS')) {
            $location= $THEME_DIR;
        } else {
            $location= '';
        }

    $params = array('{LOCATION}' => $location);

    return template_eval($template_vanity, $params);
}
} //{THEMES}

?>