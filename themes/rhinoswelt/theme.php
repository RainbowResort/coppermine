<?php

// ------------------------------------------------------------------------- //
// This theme has had redundant CORE items removed                           //
// ------------------------------------------------------------------------- //
define('THEME_HAS_RATING_GRAPHICS', 1);
define('THEME_HAS_NO_SUB_MENU_BUTTONS', 1);
define('THEME_HAS_PROGRESS_GRAPHICS', 1);
define('THEME_HAS_MENU_ICONS', 16);
define('THEME_HAS_NAVBAR_GRAPHICS', 16);

// HTML template for sys_menu
$template_sys_menu = <<< EOT
         |{BUTTONS}|
EOT;



// HTML template for template sys_menu spacer
$template_sys_menu_spacer = "|";


// HTML template for template sub_menu
// special note: I left the JavaScript 'hide' off of the first and third buttons to help avoid trouble keeping sys_menu open. :Donnoman
if ($CONFIG['custom_lnk_url'] != '') {

    $template_sub_menu = <<< EOT
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
<!-- BEGIN custom_link -->
                                                                                <td class="top_menu_bttn">
                                                <span class="top_menu_container"><a href="{CUSTOM_LNK_TGT}" title="{CUSTOM_LNK_TITLE}"><img src="themes/rhinoswelt/images/icons/announcement.png" border="0" height="16" width="16" alt="" style="vertical-align:middle;" /> {CUSTOM_LNK_LNK}</a></span>
                                        </td>
                                        <td><img src="themes/rhinoswelt/images/menu_spacer.gif" width="8" height="35" border="0" alt="" /><br /></td>
<!-- END custom_link -->
                                        <td class="top_menu_bttn">
                                                <span class="top_menu_container"><a href="{ALB_LIST_TGT}" title="{ALB_LIST_TITLE}"><img src="themes/rhinoswelt/images/icons/alb_mgr.png" border="0" height="16" width="16" alt="" style="vertical-align:middle;" /> {ALB_LIST_LNK}</a></span>
                                        </td>
                                        <td><img src="themes/rhinoswelt/images/menu_spacer.gif" width="8" height="35" border="0" alt="" /><br /></td>
                                        <td class="top_menu_bttn">
                                                <span class="top_menu_container"><a href="javascript:;" onmouseover="MM_showHideLayers('SYS_MENU','','show')"><img src="themes/rhinoswelt/images/icons/menu_down.png" border="0" height="16" width="16" alt="" style="vertical-align:middle;" /></a></span>
                                        </td>
                                        <td><img src="themes/rhinoswelt/images/menu_spacer.gif" width="8" height="35" border="0" alt="" /><br /></td>
                                        <td class="top_menu_bttn">
                                                <span class="top_menu_container"><a href="{LASTUP_TGT}" title="{LASTUP_LNK}"><img src="themes/rhinoswelt/images/icons/last_uploads.png" border="0" /><img src="themes/rhinoswelt/images/icons/last_uploads.png" border="0" height="16" width="16" alt="" style="vertical-align:middle;" /> {LASTUP_LNK}</a></span>
                                        </td>
                                        <td><img src="themes/rhinoswelt/images/menu_spacer.gif" width="8" height="35" border="0" alt="" /><br /></td>
                                        <td class="top_menu_bttn">
                                                <span class="top_menu_container"><a href="{LASTCOM_TGT}" onmouseover="MM_showHideLayers('SYS_MENU','','hide')" title="{LASTCOM_LNK}"><img src="themes/rhinoswelt/images/icons/comment.png" border="0" height="16" width="16" alt="" style="vertical-align:middle;" /> {LASTCOM_LNK}</a></span>
                                        </td>
                                        <td><img src="themes/rhinoswelt/images/menu_spacer.gif" width="8" height="35" border="0" alt="" /><br /></td>
                                        <td class="top_menu_bttn">
                                                <span class="top_menu_container"><a href="{TOPN_TGT}" onmouseover="MM_showHideLayers('SYS_MENU','','hide')" title="{TOPN_LNK}"><img src="themes/rhinoswelt/images/icons/most_viewed.png" border="0" height="16" width="16" alt="" style="vertical-align:middle;" /> {TOPN_LNK}</a></span>
                                        </td>
                                        <td><img src="themes/rhinoswelt/images/menu_spacer.gif" width="8" height="35" border="0" alt="" /><br /></td>
                                        <td class="top_menu_bttn">
                                                <span class="top_menu_container"><a href="{TOPRATED_TGT}" onmouseover="MM_showHideLayers('SYS_MENU','','hide')" title="{TOPRATED_LNK}"><img src="themes/rhinoswelt/images/icons/top_rated.png" border="0" height="16" width="16" alt="" style="vertical-align:middle;" /> {TOPRATED_LNK}</a></span>
                                        </td>
                                        <td><img src="themes/rhinoswelt/images/menu_spacer.gif" width="8" height="35" border="0" alt="" /><br /></td>
                                        <td class="top_menu_bttn">
                                                <span class="top_menu_container"><a href="{FAV_TGT}" onmouseover="MM_showHideLayers('SYS_MENU','','hide')" title="{FAV_LNK}"><img src="themes/rhinoswelt/images/icons/favorites.png" border="0" height="16" width="16" alt="" style="vertical-align:middle;" /> {FAV_LNK}</a></span>
                                        </td>
                                        <td><img src="themes/rhinoswelt/images/menu_spacer.gif" width="8" height="35" border="0" alt="" /><br /></td>
                                        <td class="top_menu_bttn">
                                                <span class="top_menu_container"><a href="{SEARCH_TGT}" onmouseover="MM_showHideLayers('SYS_MENU','','hide')" title="{SEARCH_LNK}"><img src="themes/rhinoswelt/images/icons/search.png" border="0" height="16" width="16" alt="" style="vertical-align:middle;" /> {SEARCH_LNK}</a></span>
                                        </td>
                                        <td width="100%">&nbsp;</td>
                                </tr>
                        </table>
EOT;

} else {

    $template_sub_menu = <<< EOT
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
<!-- BEGIN custom_link -->
<!-- END custom_link -->
                                        <td class="top_menu_bttn">
                                                <span class="top_menu_container"><a href="{ALB_LIST_TGT}" title="{ALB_LIST_TITLE}"><img src="themes/rhinoswelt/images/icons/alb_mgr.png" border="0" height="16" width="16" alt="" style="vertical-align:middle;" /> {ALB_LIST_LNK}</a></span>
                                        </td>
                                        <td><img src="themes/rhinoswelt/images/menu_spacer.gif" width="8" height="35" border="0" alt="" /><br /></td>
                                        <td class="top_menu_bttn">
                                                <span class="top_menu_container"><a href="javascript:;" onmouseover="MM_showHideLayers('SYS_MENU','','show')">&nbsp;<img src="themes/rhinoswelt/images/icons/menu_down.png" border="0" height="16" width="16" alt="" style="vertical-align:middle;" />&nbsp;</a></span>
                                        </td>
                                        <td><img src="themes/rhinoswelt/images/menu_spacer.gif" width="8" height="35" border="0" alt="" /><br /></td>
                                        <td class="top_menu_bttn">
                                                <span class="top_menu_container"><a href="{LASTUP_TGT}" title="{LASTUP_LNK}"><img src="themes/rhinoswelt/images/icons/last_uploads.png" border="0" height="16" width="16" alt="" style="vertical-align:middle;" /> {LASTUP_LNK}</a></span>
                                        </td>
                                        <td><img src="themes/rhinoswelt/images/menu_spacer.gif" width="8" height="35" border="0" alt="" /><br /></td>
                                        <td class="top_menu_bttn">
                                                <span class="top_menu_container"><a href="{LASTCOM_TGT}" onmouseover="MM_showHideLayers('SYS_MENU','','hide')" title="{LASTCOM_LNK}"><img src="themes/rhinoswelt/images/icons/comment.png" border="0" height="16" width="16" alt="" style="vertical-align:middle;" /> {LASTCOM_LNK}</a></span>
                                        </td>
                                        <td><img src="themes/rhinoswelt/images/menu_spacer.gif" width="8" height="35" border="0" alt="" /><br /></td>
                                        <td class="top_menu_bttn">
                                                <span class="top_menu_container"><a href="{TOPN_TGT}" onmouseover="MM_showHideLayers('SYS_MENU','','hide')" title="{TOPN_LNK}"><img src="themes/rhinoswelt/images/icons/most_viewed.png" border="0" height="16" width="16" alt="" style="vertical-align:middle;" /> {TOPN_LNK}</a></span>
                                        </td>
                                        <td><img src="themes/rhinoswelt/images/menu_spacer.gif" width="8" height="35" border="0" alt="" /><br /></td>
                                        <td class="top_menu_bttn">
                                                <span class="top_menu_container"><a href="{TOPRATED_TGT}" onmouseover="MM_showHideLayers('SYS_MENU','','hide')" title="{TOPRATED_LNK}"><img src="themes/rhinoswelt/images/icons/top_rated.png" border="0" height="16" width="16" alt="" style="vertical-align:middle;" /> {TOPRATED_LNK}</a></span>
                                        </td>
                                        <td><img src="themes/rhinoswelt/images/menu_spacer.gif" width="8" height="35" border="0" alt="" /><br /></td>
                                        <td class="top_menu_bttn">
                                                <span class="top_menu_container"><a href="{FAV_TGT}" onmouseover="MM_showHideLayers('SYS_MENU','','hide')" title="{FAV_LNK}"><img src="themes/rhinoswelt/images/icons/favorites.png" border="0" height="16" width="16" alt="" style="vertical-align:middle;" /> {FAV_LNK}</a></span>
                                        </td>
                                        <td><img src="themes/rhinoswelt/images/menu_spacer.gif" width="8" height="35" border="0" alt="" /><br /></td>
                                        <td class="top_menu_bttn">
                                                <span class="top_menu_container"><a href="{SEARCH_TGT}" onmouseover="MM_showHideLayers('SYS_MENU','','hide')" title="{SEARCH_LNK}"><img src="themes/rhinoswelt/images/icons/search.png" border="0" height="16" width="16" alt="" style="vertical-align:middle;" /> {SEARCH_LNK}</a></span>
                                        </td>
                                        <td width="100%">&nbsp;</td>
                                </tr>
                        </table>
EOT;
}

// Function for the JavaScript inside the <head>-section
function theme_javascript_head()
{
    global $CONFIG, $JS, $LINEBREAK;
    $return = '';
    // Check if we have any variables being set using set_js_vars function
    $JS['vars']['not_default_theme'] = true;
    if (isset($JS['vars']) && count($JS['vars'])) {
        $json_vars = json_encode($JS['vars']);
        $return .= '<script type="text/javascript">var js_vars = ' . $json_vars . ";</script>" . $LINEBREAK;
    }

    // Check if we have any js includes
    if (isset($JS['includes']) && count($JS['includes'])) {
    	// Bring the jquery core library to the very top of the list 
    	if (in_array('js/jquery-1.3.2.js', $JS['includes']) == TRUE) {
    		$key = array_search('js/jquery-1.3.2.js', $JS['includes']);
    		unset($JS['includes'][$key]);
    		array_unshift($JS['includes'], 'js/jquery-1.3.2.js');
    	}
        /* Include all the file which were set using js_include() function */
        foreach ($JS['includes'] as $js_file) {
            $return .= '<script type="text/javascript" src="' . $js_file . '"></script>' . $LINEBREAK;
        }
    }
    $return .= <<< EOT

<script language="JavaScript" type="text/javascript">
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_showHideLayers() { //v6.0
  var i,p,v,obj,args=MM_showHideLayers.arguments;
  for (i=0; i<(args.length-2); i+=3) if ((obj=MM_findObj(args[i]))!=null) { v=args[i+2];
    if (obj.style) { obj=obj.style; v=(v=='show')?'visible':(v=='hide')?'hidden':v; }
    obj.visibility=v; }
}
-->
</script>
EOT;
    return $return;
}


/******************************************************************************
** Section <<<$template_album_list>>> - START
******************************************************************************/
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
                <td>
                        <img src="images/spacer.gif" width="1" height="1" border="0" alt="" /><br />
                </td>
        </tr>
        <tr>
                <td width="100%" valign="top" class="tableb tableb_alternate">
                    <div class="thumbnails" style="background-color:transparent"><img src="images/spacer.gif" width="1" height="1" border="0" style="border:0;margin-top:1px;margin-bottom:0" alt="" /></div>
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
/******************************************************************************
** Section <<<$template_album_list>>> - END
******************************************************************************/

/******************************************************************************
** Section <<<theme_html_rating_box>>> - START
******************************************************************************/
function theme_html_rating_box()
{
    global $CONFIG, $CURRENT_PIC_DATA, $CURRENT_ALBUM_DATA, $THEME_DIR, $USER_DATA, $USER, $LINEBREAK;
    global $template_image_rating, $template_image_rating_oldstyle, $lang_rate_pic;

    if (!(USER_CAN_RATE_PICTURES && $CURRENT_ALBUM_DATA['votes'] == 'YES')) {
        return '';
    } else {
        //check if the users already voted or if this user is the owner
        $user_md5_id = USER_ID ? md5(USER_ID) : $USER['ID'];
        $result = cpg_db_query("SELECT pic_id FROM {$CONFIG['TABLE_VOTES']} WHERE pic_id={$CURRENT_PIC_DATA['pid']} AND user_md5_id='$user_md5_id'");

        $user_can_vote = 'false';
        if ($CURRENT_PIC_DATA['owner_id'] == $USER_DATA['user_id'] && $USER_DATA['user_id'] != 0 && ($CONFIG['rate_own_files'] == 0 || $CONFIG['rate_own_files'] == 2 && !USER_IS_ADMIN)) {
            // user is owner
            $rate_title = $lang_rate_pic['forbidden'];
        } elseif (!mysql_num_rows($result)) {
            // user hasn't voted yet, show voting things
            $rate_title = $lang_rate_pic['rate_this_pic'];
            $user_can_vote = 'true';
        } else {
            //user has voted
            $rate_title = $lang_rate_pic['already_voted'];
        }
        $rating_stars_amount = ($CONFIG['old_style_rating']) ? 5 : $CONFIG['rating_stars_amount'];
        $votes = $CURRENT_PIC_DATA['votes'] ? sprintf($lang_rate_pic['rating'], round(($CURRENT_PIC_DATA['pic_rating'] / 2000) / (5/$rating_stars_amount), 1), $rating_stars_amount, $CURRENT_PIC_DATA['votes']) : $lang_rate_pic['no_votes'];
        $pid = $CURRENT_PIC_DATA['pid'];

        if (defined('THEME_HAS_RATING_GRAPHICS')) {
            $location= $THEME_DIR;
        } else {
            $location= '';
        }

        $superCage = Inspekt::makeSuperCage();

        $params = array(
            '{TITLE}'      => $rate_title,
            '{VOTES}'      => $votes,
            '{LOCATION}'   => $location,
            '{WIDTH}'      => $CONFIG['picture_table_width'],
        );

        if ($CONFIG['old_style_rating']) {
            // use old-style rating
            $start_td = '<td class="tableb" width="17%" align="center">';
            $end_td = '</td>';
            $empty_star = '<img style="cursor:pointer" id="' . $pid . '_0" title="0" src="' . $location . 'images/rate_empty.png" alt="' . $lang_rate_pic['rubbish'] . '" onclick="rate(this)" />';
            $rating_images = $start_td . $empty_star . $empty_star . $empty_star . $empty_star . $empty_star . $end_td . $LINEBREAK;

            $empty_star = '<img style="cursor:pointer" id="' . $pid . '_1" title="1" src="' . $location . 'images/rate_empty.png" alt="' . $lang_rate_pic['poor'] . '" onclick="rate(this)" />';
            $full_star = '<img style="cursor:pointer" id="' . $pid . '_1" title="1" src="' . $location . 'images/rate_full.png" alt="' . $lang_rate_pic['poor'] . '" onclick="rate(this)" />';
            $rating_images .= $start_td . $full_star . $empty_star . $empty_star . $empty_star . $empty_star . $end_td . $LINEBREAK;

            $empty_star = '<img style="cursor:pointer" id="' . $pid . '_2" title="2" src="' . $location . 'images/rate_empty.png" alt="' . $lang_rate_pic['fair'] . '" onclick="rate(this)" />';
            $full_star = '<img style="cursor:pointer" id="' . $pid . '_2" title="2" src="' . $location . 'images/rate_full.png" alt="' . $lang_rate_pic['fair'] . '" onclick="rate(this)" />';
            $rating_images .= $start_td . $full_star . $full_star . $empty_star . $empty_star . $empty_star . $end_td . $LINEBREAK;

            $empty_star = '<img style="cursor:pointer" id="' . $pid . '_3" title="3" src="' . $location . 'images/rate_empty.png" alt="' . $lang_rate_pic['good'] . '" onclick="rate(this)" />';
            $full_star = '<img style="cursor:pointer" id="' . $pid . '_3" title="3" src="' . $location . 'images/rate_full.png" alt="' . $lang_rate_pic['good'] . '" onclick="rate(this)" />';
            $rating_images .= $start_td . $full_star . $full_star . $full_star . $empty_star . $empty_star . $end_td . $LINEBREAK;

            $empty_star = '<img style="cursor:pointer" id="' . $pid . '_4" title="4" src="' . $location . 'images/rate_empty.png" alt="' . $lang_rate_pic['excellent'] . '" onclick="rate(this)" />';
            $full_star = '<img style="cursor:pointer" id="' . $pid . '_4" title="4" src="' . $location . 'images/rate_full.png" alt="' . $lang_rate_pic['excellent'] . '" onclick="rate(this)" />';
            $rating_images .= $start_td . $full_star . $full_star . $full_star . $full_star . $empty_star . $end_td . $LINEBREAK;

            $full_star = '<img style="cursor:pointer" id="' . $pid . '_5" title="5" src="' . $location . 'images/rate_full.png" alt="' . $lang_rate_pic['great'] . '" onclick="rate(this)" />';
            $rating_images .= $start_td . $full_star . $full_star . $full_star . $full_star . $full_star . $end_td . $LINEBREAK;

            set_js_var('stars_amount', 'fallback');
            set_js_var('lang_rate_pic', $rate_title);
            $params['{RATING_IMAGES}'] = $rating_images;
            $template_rating = $template_image_rating_oldstyle;

        } else {
            //use new rating
            set_js_var('stars_amount', $rating_stars_amount);
            set_js_var('lang_rate_pic', $lang_rate_pic['rollover_to_rate']);
            $params['{JS_WARNING}'] = $lang_rate_pic['js_warning'];
            $template_rating = $template_image_rating;
        }
        set_js_var('rating', round(($CURRENT_PIC_DATA['pic_rating'] / 2000) / (5/$rating_stars_amount), 0));
        set_js_var('picture_id', $pid);
        set_js_var('theme_dir', $location);
        set_js_var('can_vote', $user_can_vote);
        list($timestamp, $form_token) = getFormToken();
        set_js_var('form_token', $form_token);
        set_js_var('timestamp', $timestamp);

        return template_eval($template_rating, $params);
    }
}
/******************************************************************************
** Section <<<theme_html_rating_box>>> - END
******************************************************************************/


/******************************************************************************
** Section <<<theme_display_thumbnails>>> - START
******************************************************************************/
function theme_display_thumbnails(&$thumb_list, $nbThumb, $album_name, $aid, $cat, $page, $total_pages, $sort_options, $display_tabs, $mode = 'thumb', $date='')
{
    global $CONFIG, $CURRENT_ALBUM_DATA;
    global $template_thumb_view_title_row,$template_fav_thumb_view_title_row, $lang_thumb_view, $lang_common, $template_tab_display, $template_thumbnail_view, $lang_album_list, $lang_errors;

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
                '{CAT_ID}'     => ($cat > 0 ? $cat : $CURRENT_ALBUM_DATA['category']),
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
                    '{CAPTION}'    => str_replace('.gif','.png',$thumb['caption']),
                    '{ADMIN_MENU}' => $thumb['admin_menu'],
                );
            } else {
                // determine if thumbnail link targets should open in a pop-up
                if ($CONFIG['thumbnail_to_fullsize'] == 1) { // code for full-size pop-up
                    if (!USER_ID && $CONFIG['allow_unlogged_access'] <= 2) {
                       $target = 'javascript:;" onclick="alert(\''.sprintf($lang_errors['login_needed'],'','','','').'\');';
                    } elseif (USER_ID && USER_ACCESS_LEVEL <= 2) {
                        $target = 'javascript:;" onclick="alert(\''.sprintf($lang_errors['access_intermediate_only'],'','','','').'\');';
                    } else {
                       $target = 'javascript:;" onclick="MM_openBrWindow(\'displayimage.php?pid=' . $thumb['pid'] . '&fullsize=1\',\'' . uniqid(rand()) . '\',\'scrollbars=yes,toolbar=no,status=no,resizable=yes,width=' . ((int)$thumb['pwidth']+(int)$CONFIG['fullsize_padding_x']) .  ',height=' .   ((int)$thumb['pheight']+(int)$CONFIG['fullsize_padding_y']). '\');';
                    }
                } elseif ($aid == 'random') {
                    $target = "displayimage.php?pid={$thumb['pid']}$uid_link#top_display_media";
                } elseif ($aid == 'lastcom' || $aid == 'lastcomby') {
                    $page = cpg_get_comment_page_number($thumb['msg_id']);
                    $page = (is_numeric($page)) ? "&amp;page=$page" : '';
                    $target = "displayimage.php?album=$aid$cat_link$date_link&amp;pid={$thumb['pid']}$uid_link&amp;msg_id={$thumb['msg_id']}$page#comment{$thumb['msg_id']}";
                } else {
                    $target = "displayimage.php?album=$aid$cat_link$date_link&amp;pid={$thumb['pid']}$uid_link#top_display_media";
                }
                $params = array(
                    '{CELL_WIDTH}' => $cell_width,
                    '{LINK_TGT}'   => $target,
                    '{THUMB}'      => $thumb['image'],
                    '{CAPTION}'    => str_replace('.gif','.png',$thumb['caption']),
                    '{ADMIN_MENU}' => $thumb['admin_menu'],
                );
            }

        } else {  // mode != 'thumb'

            // Used for mode = 'user' from list_users() in index.php
            $params = array(
                '{CELL_WIDTH}' => $cell_width,
                '{LINK_TGT}'   => "index.php?cat={$thumb['cat']}",
                '{THUMB}'      => $thumb['image'],
                '{CAPTION}'    => str_replace('.gif','.png',$thumb['caption']),
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

    if ($display_tabs) {
        $params = array(
            '{THUMB_COLS}' => $thumbcols,
            '{TABS}'       => $tabs_html,
        );
        echo template_eval($tabs, $params);
    }

    endtable();
    echo $spacer;
}
/******************************************************************************
** Section <<<theme_display_thumbnails>>> - END
******************************************************************************/


/******************************************************************************
** Section <<<theme_display_image>>> - START
******************************************************************************/
function theme_display_image($nav_menu, $picture, $votes, $pic_info, $comments, $film_strip)
{
    global $CONFIG, $LINEBREAK;

    $superCage = Inspekt::makeSuperCage();

    $width = $CONFIG['picture_table_width'];

    echo '<a name="top_display_media"></a>'; // set the navbar-anchor
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

    $picinfo = $superCage->cookie->keyExists('picinfo') ? $superCage->cookie->getAlpha('picinfo') : ($CONFIG['display_pic_info'] ? 'block' : 'none');
    echo $LINEBREAK . '<div id="picinfo" style="display: '.str_replace('.gif','.png',$picinfo).';">' . $LINEBREAK;
    starttable();
    echo $pic_info;
    endtable();
    echo '</div>' . $LINEBREAK;

    echo '<a name="comments_top"></a>';
    echo '<div id="comments">' . $LINEBREAK;
        echo $comments;
        echo '</div>' . $LINEBREAK;

}
/******************************************************************************
** Section <<<theme_display_image>>> - END
******************************************************************************/

?>