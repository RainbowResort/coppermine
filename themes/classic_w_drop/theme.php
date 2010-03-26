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
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/trunk/cpg1.5.x/themes/classic_w_drop/theme.php $
  $Revision:  $
  $LastChangedBy: gfy $
  $Date: 2009-10-06 (Wed, 06 Oct 2009) $
**********************************************/

/******************************************************************************
** Section <<<assemble_template_buttons>>> - START
******************************************************************************/
// Creates buttons from a template using an array of tokens
// this function is used in this file it needs to be declared before being called.
//
// Modified by GFY to add class button for sys_menu and sub_menu <b class="xxx"> 
// to add icons to drop down menus
//
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
	            '{HREF_LNK}'   => $button[0],
	            '{HREF_ICON}'   => $button[6],
	            '{HREF_ATTRIBUTES}'   => $button[5]
            );
        $output.=template_eval($template_buttons, $params);
    }
    return $output;
}
/******************************************************************************
** Section <<<assemble_template_buttons>>> - END
******************************************************************************/

/******************************************************************************
** Section <<<addbutton>>> - START
******************************************************************************/
// Creates an array of tokens to be used with function assemble_template_buttons
// this function is used in this file it needs to be declared before being called.
//
// Modified by GFY to add class button for sys_menu and sub_menu <b class="xxx"> 
// to add icons to drop down menus 
//
function addbutton(&$menu,$href_lnk,$href_title,$href_tgt,$block_id,$spacer,$href_attrib='',$href_icon) {
  $menu[]=array($href_lnk,$href_title,$href_tgt,$block_id,$spacer,$href_attrib,$href_icon);
}
/******************************************************************************
** Section <<<addbutton>>> - END
******************************************************************************/
// HTML template for sub_menu
//
// Modified by GFY to add drop down/hover buttoms to sub_menu
//
$template_sub_menu = <<<EOT

	<ul class="menu">
		<li class="top"><a href="" id="top_level_albums" class="top_link"><b class="b_top"></b><span class="span_top drop">Albums</span><!--[if gte IE 7]><!--></a><!--<![endif]-->
			<!--[if lte IE 6]><table><tr><td><![endif]-->
			<ul class="sub">{BUTTONS}</ul>
		<!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
	</ul>
	
EOT;
/******************************************************************************
** Section <<<$template_sys_menu>>> - START
******************************************************************************/
//
// Modified by GFY to add drop down/hover buttoms to sys_menu
//
if (!defined('THEME_HAS_NO_SYS_MENU_BUTTONS')) {

  // HTML template for template sys_menu spacer

  $template_sys_menu_spacer =" ";

  // HTML template for template sys_menu buttons
  $template_sys_menu_button = <<<EOT
  <!-- BEGIN {BLOCK_ID} -->
	<li><a href="{HREF_TGT}" title="{HREF_TITLE}" {HREF_ATTRIBUTES}><b class="{HREF_ICON}"></b><span style="padding: 0 5px 0 5px">{HREF_LNK}</span></a></li>{SPACER}
  <!-- END {BLOCK_ID} -->
  	
EOT;

	// HTML template for template sys_menu buttons
    // {HREF_LNK}{HREF_TITLE}{HREF_TGT}{BLOCK_ID}{SPACER}{HREF_ATTRIBUTES}{HREF_ICON}
    addbutton($sys_menu_buttons,'{HOME_LNK}','{HOME_TITLE}','{HOME_TGT}','home',$template_sys_menu_spacer,'',"Home");
    addbutton($sys_menu_buttons,'{CONTACT_LNK}','{CONTACT_TITLE}','{CONTACT_TGT}','contact',$template_sys_menu_spacer,'',"Contact");
    addbutton($sys_menu_buttons,'{MY_GAL_LNK}','{MY_GAL_TITLE}','{MY_GAL_TGT}','my_gallery',$template_sys_menu_spacer,'',"My_Gallery");
    addbutton($sys_menu_buttons,'{MEMBERLIST_LNK}','{MEMBERLIST_TITLE}','{MEMBERLIST_TGT}','allow_memberlist',$template_sys_menu_spacer,'',"MemberList");
    if (array_key_exists('allowed_albums', $USER_DATA) && is_array($USER_DATA['allowed_albums']) && count($USER_DATA['allowed_albums'])) {
      addbutton($sys_menu_buttons,'{UPL_APP_LNK}','{UPL_APP_TITLE}','{UPL_APP_TGT}','upload_approval',$template_sys_menu_spacer,'',"Upload_App");
    }
    addbutton($sys_menu_buttons,'{MY_PROF_LNK}','{MY_PROF_TITLE}','{MY_PROF_TGT}','my_profile',$template_sys_menu_spacer,'',"My_Profile");
    addbutton($sys_menu_buttons,'{ADM_MODE_LNK}','{ADM_MODE_TITLE}','{ADM_MODE_TGT}','enter_admin_mode',$template_sys_menu_spacer,'',"Admin_Mode");
    addbutton($sys_menu_buttons,'{USR_MODE_LNK}','{USR_MODE_TITLE}','{USR_MODE_TGT}','leave_admin_mode',$template_sys_menu_spacer,'',"User_Mode");
    addbutton($sys_menu_buttons,'{SIDEBAR_LNK}','{SIDEBAR_TITLE}','{SIDEBAR_TGT}','sidebar',$template_sys_menu_spacer,'',"SideBar");
    addbutton($sys_menu_buttons,'{UPL_PIC_LNK}','{UPL_PIC_TITLE}','{UPL_PIC_TGT}','upload_pic',$template_sys_menu_spacer,'',"Upload_Pic");
    addbutton($sys_menu_buttons,'{REGISTER_LNK}','{REGISTER_TITLE}','{REGISTER_TGT}','register',$template_sys_menu_spacer,'',"Register");
    addbutton($sys_menu_buttons,'{LOGIN_LNK}','{LOGIN_TITLE}','{LOGIN_TGT}','login','','',"LogIn");
    addbutton($sys_menu_buttons,'{LOGOUT_LNK}','{LOGOUT_TITLE}','{LOGOUT_TGT}','logout','','',"LogOut");
    // Login and Logout don't have a spacer as only one is shown, and either would be the last option.

  $sys_menu_buttons = CPGPluginAPI::filter('sys_menu',$sys_menu_buttons);
  $params = array('{BUTTONS}' => assemble_template_buttons($template_sys_menu_button,$sys_menu_buttons));
  $template_sys_menu = template_eval($template_sys_menu,$params);
}
/******************************************************************************
** Section <<<$template_sys_menu>>> - END
******************************************************************************/
/******************************************************************************
** Section <<<$template_sys_menu>>> - START 
******************************************************************************/
// HTML template for main menu
//
// Modified by GFY to add drop down/hover buttoms to sys_menu
//
$template_sys_menu = <<<EOT

	<ul class="menu">
		<li class="top"><a href="" id="top_level_user" title="Users" class="top_link"><b class="b_top"></b><span class="span_top drop">Users</span><!--[if IE 7]><!--></a><!--<![endif]-->
			<table><tr><td><!--[if lte IE 6]><![endif]-->
			<ul class="sub">{BUTTONS}</ul>
		</td></tr></table></a><!--[if lte IE 6]><![endif]-->
		</li>
	</ul>
			
EOT;
/******************************************************************************
** Section <<<$template_sys_menu>>> - END
******************************************************************************/

/******************************************************************************
** Section <<<THEME_HAS_NO_SUB_MENU_BUTTONS>>> - START
******************************************************************************/
//
// Modified by GFY to add drop down/hover buttoms to sub_menu
//
if (!defined('THEME_HAS_NO_SUB_MENU_BUTTONS')) {

  // HTML template for template sub_menu spacer

  $template_sub_menu_spacer = $template_sys_menu_spacer;

  // HTML template for template sub_menu buttons

  $template_sub_menu_button = <<<EOT
  <!-- BEGIN {BLOCK_ID} -->
  		<li><a href="{HREF_TGT}" title="{HREF_TITLE}" {HREF_ATTRIBUTES}><b class="{HREF_ICON}"></b><span style="padding: 0 5px 0 5px">{HREF_LNK}</span></a></li>{SPACER}
  <!-- END {BLOCK_ID} -->	
EOT;

  // HTML template for template sub_menu buttons

    // {HREF_LNK}{HREF_TITLE}{HREF_TGT}{BLOCK_ID}{SPACER}{HREF_ATTRIBUTES}{HREF_CLASS}
    addbutton($sub_menu_buttons,'{CUSTOM_LNK_LNK}','{CUSTOM_LNK_TITLE}','{CUSTOM_LNK_TGT}','custom_link',$template_sub_menu_spacer,'',"Custom_Lnk");
    addbutton($sub_menu_buttons,'{ALB_LIST_LNK}','{ALB_LIST_TITLE}','{ALB_LIST_TGT}','album_list',$template_sub_menu_spacer,'',"Alb_List");
    addbutton($sub_menu_buttons,'{LASTUP_LNK}','{LASTUP_TITLE}','{LASTUP_TGT}','lastup',$template_sub_menu_spacer,'rel="nofollow"',"LastUpload");
    addbutton($sub_menu_buttons,'{LASTCOM_LNK}','{LASTCOM_TITLE}','{LASTCOM_TGT}','lastcom',$template_sub_menu_spacer,'rel="nofollow"',"LastComment");
    addbutton($sub_menu_buttons,'{TOPN_LNK}','{TOPN_TITLE}','{TOPN_TGT}','topn',$template_sub_menu_spacer,'rel="nofollow"',"TopN_Lnk");
    addbutton($sub_menu_buttons,'{FAV_LNK}','{FAV_TITLE}','{FAV_TGT}','favpics',$template_sub_menu_spacer,'rel="nofollow"',"Favorite");
    addbutton($sub_menu_buttons,'{TOPRATED_LNK}','{TOPRATED_TITLE}','{TOPRATED_TGT}','toprated',$template_sub_menu_spacer,'rel="nofollow"',"TopRated");
    addbutton($sub_menu_buttons,'{SEARCH_LNK}','{SEARCH_TITLE}','{SEARCH_TGT}','search',$template_sub_menu_spacer,'',"Search");
    if ($CONFIG['browse_by_date'] != 0) {
    	addbutton($sub_menu_buttons, '{BROWSEBYDATE_LNK}', '{BROWSEBYDATE_TITLE}', '{BROWSEBYDATE_TGT}', 'browse_by_date', $template_sub_menu_spacer, 'rel="nofollow" class="greybox"',"Browse");
    }

  $sub_menu_buttons = CPGPluginAPI::filter('sub_menu',$sub_menu_buttons);
  $params = array('{BUTTONS}' => assemble_template_buttons($template_sub_menu_button,$sub_menu_buttons));
  $template_sub_menu = template_eval($template_sub_menu,$params);
}
/******************************************************************************
** Section <<<THEME_HAS_NO_SUB_MENU_BUTTONS>>> - END
******************************************************************************/

/******************************************************************************
** Section <<<$template_gallery_admin_menu>>> - START
******************************************************************************/
//
// Modified by GFY to add drop down/hover buttoms to admin_menu
//
$template_gallery_admin_menu = <<<EOT
<ul class="menu">
<!-- First button without submenus -->	
	<li class="top"><a href="" id="config" class="top_link"><b class="b_top"></b><span class="span_top drop">{ADMIN_LNK}</span><!--[if gte IE 7]><!--></a><!--<![endif]-->
		<!--[if lte IE 6]><table><tr><td><![endif]-->
		<ul class="sub">
			<!-- BEGIN config -->
			<li><a href="admin.php" title="{ADMIN_TITLE}"><b class="Xicon">{ADMIN_ICO}</b><span style="padding: 0 5px 0 5px">{ADMIN_LNK}</span></a></li>
			<!-- END config -->
			<!-- BEGIN plugin_manager -->
			<li><a href="pluginmgr.php" title="{PLUGINMGR_TITLE}"><b class="Xicon">{PLUGINMGR_ICO}</b><span style="padding: 0 5px 0 5px">{PLUGINMGR_LNK}</span></a></li>
            <!-- END plugin_manager -->
            <!-- BEGIN bridge_manager -->
   			<li><a href="bridgemgr.php" title="{BRIDGEMGR_TITLE}"><b class="Xicon">{BRIDGEMGR_ICO}</b><span style="padding: 0 5px 0 5px">{BRIDGEMGR_LNK}</span></a></li>
			<!-- END bridge_manager -->
			<!-- BEGIN export -->
			<li><a href="export.php" title="{EXPORT_TITLE}"><b class="Xicon">{EXPORT_ICO}</b><span style="padding: 0 5px 0 5px">{EXPORT_LNK}</span></a></li>
			<!-- END export -->
			<!-- BEGIN update_database -->
			<li><a href="update.php" title="{UPDATE_DATABASE_TITLE}"><b class="Xicon">{UPDATE_DATABASE_ICO}</b><span style="padding: 0 5px 0 5px">{UPDATE_DATABASE_LNK}</span></a></li>
			<!-- END update_database -->
			<!-- BEGIN check_versions -->
			<li><a href="versioncheck.php" title="{CHECK_VERSIONS_TITLE}"><b class="Xicon">{CHECK_VERSIONS_ICO}</b><span style="padding: 0 5px 0 5px">{CHECK_VERSIONS_LNK}</span></a></li>
			<!-- END check_versions -->
			<!-- BEGIN view_log_files -->
			<li><a href="viewlog.php" title="{VIEW_LOG_FILES_TITLE}"><b class="Xicon">{VIEW_LOG_FILES_ICO}</b><span style="padding: 0 5px 0 5px">{VIEW_LOG_FILES_LNK}</span></a></li>
			<!-- END view_log_files -->
			<!-- BEGIN php_info -->
			<li><a href="phpinfo.php" title="{PHPINFO_TITLE}"><b class="Xicon">{PHPINFO_ICO}</b><span style="padding: 0 5px 0 5px">{PHPINFO_LNK}</span></a></li>
			<!-- END php_info -->
			<!-- BEGIN show_news -->
			<li><a href="mode.php?what=news&amp;referer=$REFERER" title="{SHOWNEWS_TITLE}"><b class="Xicon">{SHOWNEWS_ICO}</b><span style="padding: 0 5px 0 5px">{SHOWNEWS_LNK}</span></a></li>
			<!-- END show_news -->
			<!-- BEGIN documentation -->
			<li><a href="{DOCUMENTATION_HREF}" title="{DOCUMENTATION_TITLE}"><b class="Xicon">{DOCUMENTATION_ICO}</b><span style="padding: 0 5px 0 5px">{DOCUMENTATION_LNK}</span></a></li>
			<!-- END documentation -->
			</ul>
        <!--[if lte IE 6]></td></tr></table></a><![endif]-->
	</li>
<!-- Second button without submenus -->	
	<li class="top"><a href="" id="albums" class="top_link"><b class="b_top"></b><span class="span_top drop">Gallery/{ALBUMS_LNK}</span><!--[if gte IE 7]><!--></a><!--<![endif]-->
		<!--[if lte IE 6]><table><tr><td><![endif]-->
		<ul class="sub">
			<!-- BEGIN catmgr -->
			<li><a href="catmgr.php" title="{CATEGORIES_TITLE}"><b class="Xicon">{CATEGORIES_ICO}</b><span style="padding: 0 5px 0 5px">{CATEGORIES_LNK}</span></a></li>
			<!-- END catmgr -->
			<!-- BEGIN albmgr -->
			<li><a href="albmgr.php{CATL}" title="{ALBUMS_TITLE}"><b class="Xicon">{ALBUMS_ICO}</b><span style="padding: 0 5px 0 5px">{ALBUMS_LNK}</span></a></li>
			<!-- END albmgr -->
			<!-- BEGIN picmgr -->
			<li><a href="picmgr.php" title="{PICTURES_TITLE}"><b class="Xicon">{PICTURES_ICO}</b><span style="padding: 0 5px 0 5px">{PICTURES_LNK}</span></a></li>
			<!-- end picmgr -->
			<!-- BEGIN review_comments -->
			<li><a href="reviewcom.php" title="{COMMENTS_TITLE}"><b class="Xicon">{COMMENTS_ICO}</b><span style="padding: 0 5px 0 5px">{COMMENTS_LNK}</span></a></li>
			<!-- END review_comments -->
			<!-- BEGIN log_ecards -->
			<li><a href="db_ecard.php" title="{DB_ECARD_TITLE}"><b class="Xicon">{DB_ECARD_ICO}</b><span style="padding: 0 5px 0 5px">{DB_ECARD_LNK}</span></a></li>
			<!-- END log_ecards -->
		</ul>
        <!--[if lte IE 6]></td></tr></table></a><![endif]-->
	</li>
<!-- Second button without submenus -->	
	<li class="top"><a href="" id="users" class="top_link"><b class="b_top"></b><span class="span_top drop">{USERS_LNK}/{GROUPS_LNK}</span><!--[if gte IE 7]><!--></a><!--<![endif]-->
		<!--[if lte IE 6]><table><tr><td><![endif]-->
		<ul class="sub">
			<!-- BEGIN admin_approval -->
			<li><a href="editpics.php?mode=upload_approval" title="{UPL_APP_TITLE}"><b class="Xicon">{UPL_APP_ICO}</b><span style="padding: 0 5px 0 5px">{UPL_APP_LNK}</span></a></li>
			<!-- END admin_approval -->
			<!-- BEGIN usermgr -->
			<li><a href="usermgr.php" title="{USERS_TITLE}"><b class="Xicon">{USERS_ICO}</b><span style="padding: 0 5px 0 5px">{USERS_LNK}</span></a></li>
			<!-- END usermgr -->
			<!-- BEGIN groupmgr -->
			<li><a href="groupmgr.php" title="{GROUPS_TITLE}"><b class="Xicon">{GROUPS_ICO}</b><span style="padding: 0 5px 0 5px">{GROUPS_LNK}</span></a></li>
			<!-- END groupmgr -->
			<!-- BEGIN banmgr -->
			<li><a href="banning.php" title="{BAN_TITLE}"><b class="Xicon">{BAN_ICO}</b><span style="padding: 0 5px 0 5px">{BAN_LNK}</span></a></li>
			<!-- END banmgr -->
			<!-- BEGIN admin_profile -->
			<li><a href="profile.php?op=edit_profile" title="{MY_PROF_TITLE}"><b class="Xicon">{MY_PROF_ICO}</b><span style="padding: 0 5px 0 5px">{MY_PROF_LNK}</span></a></li>
			<!-- END admin_profile -->
		</ul>
        <!--[if lte IE 6]></td></tr></table></a><![endif]-->
	</li>
<!-- Second button without submenus -->	
	<li class="top"><a href="" id="admin_tools" class="top_link"><b class="b_top"></b><span class="span_top drop">Media/File settings</span><!--[if gte IE 7]><!--></a><!--<![endif]-->
		<!--[if lte IE 6]><table><tr><td><![endif]-->
		<ul class="sub">
			<!-- BEGIN admin_tools -->
			<li><a href="util.php?t={TIME_STAMP}#admin_tools" title="{UTIL_TITLE}"><b class="Xicon">{UTIL_ICO}</b><span style="padding: 0 5px 0 5px">{UTIL_LNK}</span></a></li>
			<!-- END admin_tools -->
			<!-- BEGIN batch_add -->
			<li><a href="searchnew.php" title="{SEARCHNEW_TITLE}"><b class="Xicon">{SEARCHNEW_ICO}</b><span style="padding: 0 5px 0 5px">{SEARCHNEW_LNK}</span></a></li>
			<!-- END batch_add -->
			<!-- BEGIN exif_manager -->
			<li><a href="exifmgr.php" title="{EXIFMGR_TITLE}"><b class="Xicon">{EXIFMGR_ICO}</b><span style="padding: 0 5px 0 5px">{EXIFMGR_LNK}</span></a></li>
			<!-- END exif_manager -->
			<!-- BEGIN keyword_manager -->
			<li><a href="keyword.php" title="{KEYWORDMGR_TITLE}"><b class="Xicon">{KEYWORDMGR_ICO}</b><span style="padding: 0 5px 0 5px">{KEYWORDMGR_LNK}</span></a></li>
			<!-- END keyword_manager -->
			<!-- BEGIN overall_stats -->
			<li><a href="stat_details.php?type=hits&amp;sort=sdate&amp;dir=&amp;sdate=1&amp;ip=1&amp;search_phrase=0&amp;referer=0&amp;browser=1&amp;os=1&amp;mode=fullscreen&amp;page=1&amp;amount=50" title="{OVERALL_STATS_TITLE}"><b class="Xicon">{OVERALL_STATS_ICO}</b><span style="padding: 0 5px 0 5px">{OVERALL_STATS_LNK}</span></a></li>
			<!-- END overall_stats -->
			</ul>
        <!--[if lte IE 6]></td></tr></table></a><![endif]-->
	</li>
</ul>
EOT;
/******************************************************************************
** Section <<<$template_gallery_admin_menu>>> - END
******************************************************************************/
/******************************************************************************
** Section <<<$template_user_admin_menu>>> - START  

******************************************************************************/
// HTML template for user admin menu
$template_user_admin_menu = <<<EOT
<ul class="menu">
	<li class="top"><a href="" id="admin_tools" class="top_link"><b class="b_top"></b><span class="span_top drop">User Tools</span><!--[if gte IE 7]><!--></a><!--<![endif]-->
		<!--[if lte IE 6]><table><tr><td><![endif]-->
		<ul class="sub">
		  <li><a href="albmgr.php" 					title="{ALBMGR_TITLE}">   <b class="Xicon">{ALBUMS_ICO}   </b><span style="padding: 0 5px 0 5px">{ALBMGR_LNK}   </span></a></li>
          <li><a href="modifyalb.php" 				title="{MODIFYALB_TITLE}"><b class="Xicon">{MODIFYALB_ICO}</b><span style="padding: 0 5px 0 5px">{MODIFYALB_LNK}</span></a></li>
          <li><a href="profile.php?op=edit_profile" title="{MY_PROF_TITLE}">  <b class="Xicon">{MY_PROF_ICO}  </b><span style="padding: 0 5px 0 5px">{MY_PROF_LNK}  </span></a></li>
          <li><a href="picmgr.php" 					title="{PICTURES_TITLE}"> <b class="Xicon">{PICTURES_ICO} </b><span style="padding: 0 5px 0 5px">{PICTURES_LNK} </span></a></li>
        </ul>
        <!--[if lte IE 6]></td></tr></table></a><![endif]-->
	</li>
</ul>
EOT;

?>