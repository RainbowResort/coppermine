<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2007 Coppermine Dev Team
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

// ------------------------------------------------------------------------- //
// This theme has had redundant CORE items removed                           //
// ------------------------------------------------------------------------- //
define('THEME_HAS_RATING_GRAPHICS', 1);
define('THEME_HAS_NAVBAR_GRAPHICS', 1);
define('THEME_HAS_NO_SYS_MENU_BUTTONS', 1);
define('THEME_HAS_NO_SUB_MENU_BUTTONS', 1);
define('THEME_HAS_SIDEBAR_GRAPHICS',1);
define('THEME_IS_XHTML10_TRANSITIONAL',1);  // Remove this if you edit this template until
                                            // you have validated it. See docs/theme.htm.

// HTML template for sys menu
$template_sys_menu = <<<EOT

                        <table border="0" cellpadding="0" cellspacing="0">
                                <tr>
<!-- BEGIN home -->
                                        <td><img name="spacer" src="images/spacer.gif" width="5" height="25" border="0" alt="" /></td>
                                        <td><img name="buttonlefthome" src="themes/hardwired/images/buttonlefthome.gif" width="17" height="25" border="0" alt="" /></td>
                                        <td style="background: url(themes/hardwired/images/buttoncenter.gif);">
                                                <a href="{HOME_TGT}" title="{HOME_TITLE}">{HOME_LNK}</a>
                                        </td>
                                        <td><img name="buttonright" src="themes/hardwired/images/buttonright.gif" width="7" height="25" border="0"  alt="" /></td>
<!-- END home -->
<!-- BEGIN contact -->
                                        <td><img name="spacer" src="images/spacer.gif" width="5" height="25" border="0" alt="" /></td>
                                        <td><img name="buttonleftcontact" src="themes/hardwired/images/buttonleftcontact.gif" width="17" height="25" border="0" alt="" /></td>
                                        <td style="background: url(themes/hardwired/images/buttoncenter.gif);">
                                                <a href="{CONTACT_TGT}" title="{CONTACT_TITLE}">{CONTACT_LNK}</a>
                                        </td>
                                        <td><img name="buttonright" src="themes/hardwired/images/buttonright.gif" width="7" height="25" border="0"  alt="" /></td>
<!-- END contact -->
<!-- BEGIN my_gallery -->
                                        <td><img name="spacer" src="images/spacer.gif" width="5" height="25" border="0" alt="" /></td>
                                        <td><img name="buttonleftmy" src="themes/hardwired/images/buttonleftmy.gif" width="17" height="25" border="0" alt="" /></td>
                                        <td style="background: url(themes/hardwired/images/buttoncenter.gif);">
                                                <a href="{MY_GAL_TGT}" title="{MY_GAL_TITLE}">{MY_GAL_LNK}</a>
                                        </td>
                                        <td><img name="buttonright" src="themes/hardwired/images/buttonright.gif" width="7" height="25" border="0"  alt="" /></td>
<!-- END my_gallery -->
<!-- BEGIN allow_memberlist -->
                                        <td><img name="spacer" src="images/spacer.gif" width="5" height="25" border="0" alt="" /></td>
                                        <td><img name="buttonleft" src="themes/hardwired/images/buttonleftmemb.gif" width="17" height="25" border="0" alt="" /></td>
                                        <td style="background: url(themes/hardwired/images/buttoncenter.gif);">
                                                <a href="{MEMBERLIST_TGT}" title="{MEMBERLIST_TITLE}">{MEMBERLIST_LNK}</a>
                                        </td>
                                        <td><img name="buttonright" src="themes/hardwired/images/buttonright.gif" width="7" height="25" border="0"  alt="" /></td>
<!-- END allow_memberlist -->
<!-- BEGIN upload_approval -->
                                        <td><img name="spacer" src="images/spacer.gif" width="5" height="25" border="0" alt="" /></td>
                                        <td><img name="buttonleft" src="themes/hardwired/images/buttonleftmemb.gif" width="17" height="25" border="0" alt="" /></td>
                                        <td style="background: url(themes/hardwired/images/buttoncenter.gif);">
                                                <a href="{UPL_APP_TGT}" title="{UPL_APP_TITLE}">{UPL_APP_LNK}</a>
                                        </td>
                                        <td><img name="buttonright" src="themes/hardwired/images/buttonright.gif" width="7" height="25" border="0"  alt="" /></td>
<!-- END upload_approval -->
<!-- BEGIN my_profile -->
                                        <td><img name="spacer" src="images/spacer.gif" width="5" height="25" border="0" alt="" /></td>
                                        <td><img name="buttonleft" src="themes/hardwired/images/buttonleft.gif" width="17" height="25" border="0" alt="" /></td>
                                        <td style="background: url(themes/hardwired/images/buttoncenter.gif);">
                                                <a href="{MY_PROF_TGT}" title="{MY_PROF_LNK}">{MY_PROF_LNK}</a>
                                        </td>
                                        <td><img name="buttonright" src="themes/hardwired/images/buttonright.gif" width="7" height="25" border="0"  alt="" /></td>
<!-- END my_profile -->
<!-- BEGIN faq -->
                                        <td><img name="spacer" src="images/spacer.gif" width="5" height="25" border="0" alt="" /></td>
                                        <td><img name="buttonleft" src="themes/hardwired/images/buttonleftfaq.gif" width="17" height="25" border="0" alt="" /></td>
                                        <td style="background: url(themes/hardwired/images/buttoncenter.gif);">
                                        <a href="{FAQ_TGT}" title="{FAQ_TITLE}">{FAQ_LNK}</a>
                                        </td>
                                        <td><img name="buttonright" src="themes/hardwired/images/buttonright.gif" width="7" height="25" border="0"  alt="" /></td>
<!-- END faq -->
<!-- BEGIN enter_admin_mode -->
                                        <td><img name="spacer" src="images/spacer.gif" width="5" height="25" border="0" alt="" /></td>
                                        <td><img name="buttonleftad" src="themes/hardwired/images/buttonleftad.gif" width="17" height="25" border="0" alt="" /></td>
                                        <td style="background: url(themes/hardwired/images/buttoncenter.gif);">
                                                <a href="{ADM_MODE_TGT}" title="{ADM_MODE_TITLE}">{ADM_MODE_LNK}</a>
                                        </td>
                                        <td><img name="buttonright" src="themes/hardwired/images/buttonright.gif" width="7" height="25" border="0"  alt="" /></td>
<!-- END enter_admin_mode -->
<!-- BEGIN leave_admin_mode -->
                                        <td><img name="spacer" src="images/spacer.gif" width="5" height="25" border="0" alt="" /></td>
                                        <td><img name="buttonleftad" src="themes/hardwired/images/buttonleftad.gif" width="17" height="25" border="0" alt="" /></td>
                                        <td style="background: url(themes/hardwired/images/buttoncenter.gif);">
                                                <a href="{USR_MODE_TGT}" title="{USR_MODE_TITLE}">{USR_MODE_LNK}</a>
                                        </td>
                                        <td><img name="buttonright" src="themes/hardwired/images/buttonright.gif" width="7" height="25" border="0" alt="" /></td>
<!-- END leave_admin_mode -->
<!-- BEGIN upload_pic -->
                                        <td><img name="spacer" src="images/spacer.gif" width="5" height="25" border="0" alt="" /></td>
                                        <td><img name="buttonleftup" src="themes/hardwired/images/buttonleftup.gif" width="17" height="25" border="0" alt="" /></td>
                                       <td style="background: url(themes/hardwired/images/buttoncenter.gif);">
                                                <a href="{UPL_PIC_TGT}" title="{UPL_PIC_TITLE}">{UPL_PIC_LNK}</a>
                                        </td>
                                        <td><img name="buttonright" src="themes/hardwired/images/buttonright.gif" width="7" height="25" border="0"  alt="" /></td>
<!-- END upload_pic -->
<!-- BEGIN register -->
                                        <td><img name="spacer" src="images/spacer.gif" width="5" height="25" border="0" alt="" /></td>
                                        <td><img name="buttonleft" src="themes/hardwired/images/buttonleft.gif" width="17" height="25" border="0" alt="" /></td>
                                        <td style="background: url(themes/hardwired/images/buttoncenter.gif);">
                                                <a href="{REGISTER_TGT}" title="{REGISTER_TITLE}">{REGISTER_LNK}</a>
                                        </td>
                                        <td><img name="buttonright" src="themes/hardwired/images/buttonright.gif" width="7" height="25" border="0"  alt="" /></td>
<!-- END register -->
<!-- BEGIN login -->
                                        <td><img name="spacer" src="images/spacer.gif" width="5" height="25" border="0" alt="" /></td>
                                        <td><img name="buttonleft" src="themes/hardwired/images/buttonleft.gif" width="17" height="25" border="0" alt="" /></td>
                                       <td style="background: url(themes/hardwired/images/buttoncenter.gif);">
                                                <a href="{LOGIN_TGT}" title="{LOGIN_LNK}">{LOGIN_LNK}</a>
                                        </td>
                                        <td><img name="buttonright" src="themes/hardwired/images/buttonright.gif" width="7" height="25" border="0"  alt="" /></td>
<!-- END login -->
<!-- BEGIN logout -->
                                        <td><img name="spacer" src="images/spacer.gif" width="5" height="25" border="0" alt="" /></td>
                                        <td><img name="buttonleftout" src="themes/hardwired/images/buttonleftout.gif" width="17" height="25" border="0" alt="" /></td>
                                        <td style="background: url(themes/hardwired/images/buttoncenter.gif);">
                                                <a href="{LOGOUT_TGT}" title="{LOGOUT_LNK}">{LOGOUT_LNK}</a>
                                        </td>
                                        <td><img name="buttonright" src="themes/hardwired/images/buttonright.gif" width="7" height="25" border="0" alt="" /></td>
<!-- END logout -->
                                </tr>
                        </table>

EOT;

// HTML template for sub menu
$template_sub_menu = <<<EOT

                        <table border="0" cellpadding="0" cellspacing="0">
                                <tr>
<!-- BEGIN custom_link -->
                                                                                <td><img name="spacer" src="images/spacer.gif" width="5" height="25" border="0" alt="" /></td>
                                        <td><img name="buttonleft1" src="themes/hardwired/images/buttonleft1.gif" width="7" height="25" border="0" alt="" /></td>
                                        <td style="background: url(themes/hardwired/images/buttoncenter.gif);">
                                                <a href="{CUSTOM_LNK_TGT}" title="{CUSTOM_LNK_TITLE}">{CUSTOM_LNK_LNK}</a>
                                        </td>
                                        <td><img name="buttonright1" src="themes/hardwired/images/buttonright1.gif" width="7" height="25" border="0" alt="" /></td>
<!-- END custom_link -->
<!-- BEGIN album_list -->
                                        <td><img name="spacer" src="images/spacer.gif" width="5" height="25" border="0" alt="" /></td>
                                        <td><img name="buttonleft1" src="themes/hardwired/images/buttonleft1.gif" width="7" height="25" border="0" alt="" /></td>
                                        <td style="background: url(themes/hardwired/images/buttoncenter.gif);">
                                                <a href="{ALB_LIST_TGT}" title="{ALB_LIST_TITLE}">{ALB_LIST_LNK}</a>
                                        </td>
                                        <td><img name="buttonright1" src="themes/hardwired/images/buttonright1.gif" width="7" height="25" border="0" alt="" /></td>
<!-- END album_list -->
                                        <td><img name="spacer" src="images/spacer.gif" width="5" height="25" border="0" alt="" /></td>
                                        <td><img name="buttonleft1" src="themes/hardwired/images/buttonleft1.gif" width="7" height="25" border="0" alt="" /></td>
                                       <td style="background: url(themes/hardwired/images/buttoncenter.gif);">
                                                <a href="{LASTUP_TGT}" title="{LASTUP_LNK}">{LASTUP_LNK}</a>
                                        </td>
                                        <td><img name="buttonright1" src="themes/hardwired/images/buttonright1.gif" width="7" height="25" border="0" alt="" /></td>
                                        <td><img name="spacer" src="images/spacer.gif" width="5" height="25" border="0" alt="" /></td>
                                        <td><img name="buttonleft1" src="themes/hardwired/images/buttonleft1.gif" width="7" height="25" border="0" alt="" /></td>
                                       <td style="background: url(themes/hardwired/images/buttoncenter.gif);">
                                                <a href="{LASTCOM_TGT}" title="{LASTCOM_LNK}">{LASTCOM_LNK}</a>
                                        </td>
                                        <td><img name="buttonright1" src="themes/hardwired/images/buttonright1.gif" width="7" height="25" border="0" alt="" /></td>
                                        <td><img name="spacer" src="images/spacer.gif" width="5" height="25" border="0" alt="" /></td>
                                        <td><img name="buttonleft1" src="themes/hardwired/images/buttonleft1.gif" width="7" height="25" border="0" alt="" /></td>
                                        <td style="background: url(themes/hardwired/images/buttoncenter.gif);">
                                                <a href="{TOPN_TGT}" title="{TOPN_LNK}">{TOPN_LNK}</a>
                                        </td>
                                        <td><img name="buttonright1" src="themes/hardwired/images/buttonright1.gif" width="7" height="25" border="0" alt="" /></td>
                                        <td><img name="spacer" src="images/spacer.gif" width="5" height="25" border="0" alt="" /></td>
                                        <td><img name="buttonleft1" src="themes/hardwired/images/buttonleft1.gif" width="7" height="25" border="0" alt="" /></td>
                                        <td style="background: url(themes/hardwired/images/buttoncenter.gif);">
                                                <a href="{TOPRATED_TGT}" title="{TOPRATED_LNK}">{TOPRATED_LNK}</a>
                                        </td>
                                        <td><img name="buttonright1" src="themes/hardwired/images/buttonright1.gif" width="7" height="25" border="0" alt="" /></td>
                                        <td><img name="spacer" src="images/spacer.gif" width="5" height="25" border="0" alt="" /></td>
                                        <td><img name="buttonleft1" src="themes/hardwired/images/buttonleft1.gif" width="7" height="25" border="0" alt="" /></td>
                                        <td style="background: url(themes/hardwired/images/buttoncenter.gif);">
                                                <a href="{FAV_TGT}" title="{FAV_LNK}">{FAV_LNK}</a>
                                        </td>
                                        <td><img name="buttonright1" src="themes/hardwired/images/buttonright1.gif" width="7" height="25" border="0" alt="" /></td>
                                        <td><img name="spacer" src="images/spacer.gif" width="5" height="25" border="0" alt="" /></td>
                                        <td><img name="buttonleft1" src="themes/hardwired/images/buttonleft1.gif" width="7" height="25" border="0" alt="" /></td>
                                        <td style="background: url(themes/hardwired/images/buttoncenter.gif);">
                                                <a href="{BROWSEBYDATE_TGT}" title="{BROWSEBYDATE_LNK}">{BROWSEBYDATE_LNK}</a>
                                        </td>
                                        <td><img name="buttonright1" src="themes/hardwired/images/buttonright1.gif" width="7" height="25" border="0" alt="" /></td>
                                        <td><img name="spacer" src="images/spacer.gif" width="5" height="25" border="0" alt="" /></td>
                                        <td><img name="buttonleft1" src="themes/hardwired/images/buttonleft1.gif" width="7" height="25" border="0" alt="" /></td>
                                        <td style="background: url(themes/hardwired/images/buttoncenter.gif);">
                                                <a href="{SEARCH_TGT}" title="{SEARCH_LNK}">{SEARCH_LNK}</a>
                                        </td>
                                        <td><img name="buttonright1" src="themes/hardwired/images/buttonright1.gif" width="7" height="25" border="0" alt="" /></td>
                                </tr>
                        </table>

EOT;

?>