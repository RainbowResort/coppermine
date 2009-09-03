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
  Coppermine version: 1.5.x
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**********************************************/
/*********************************************
  Coppermine Plugin - BBCode Control
  ********************************************
  Copyright (c) 2008-2009 eenemeenemuu
**********************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

// plugin (un)install
$thisplugin->add_action('plugin_install','bbcode_install');
$thisplugin->add_action('plugin_uninstall','bbcode_uninstall');
$thisplugin->add_action('plugin_cleanup','bbcode_cleanup');

// admin config  button
$thisplugin->add_filter('admin_menu','bbcode_control_config_button');

// new bbcode tags
$thisplugin->add_filter('bbcode','new_bbcodes');

// bbcode buttons
$thisplugin->add_filter('theme_add_comment','buttons_add_comment');
$thisplugin->add_filter('theme_edit_comment','buttons_edit_comment');

// bbcodes in file info
$thisplugin->add_filter('file_info','embed_code');


function insert_into_config($name, $value) {
    global $CONFIG;
    if (!isset($CONFIG[$name])) {
        cpg_db_query("INSERT INTO {$CONFIG['TABLE_CONFIG']} (name,value) VALUES ('$name','$value')");
    }
}


function bbcode_install() {
    $bbcode_tags = get_bbcode_tags('available');
    foreach ($bbcode_tags as $tag) {
        insert_into_config('bbcode_control_tag_'.$tag.'_show', '1');
        insert_into_config('bbcode_control_tag_'.$tag.'_process', '1');
    }

    insert_into_config('bbcode_control_tag_img_localhost_only', '0');
    insert_into_config('bbcode_control_tag_img_max_width', '0');
    insert_into_config('bbcode_control_tag_img_max_height', '0');
    insert_into_config('bbcode_control_tag_img_embed_code', '0');

    return true;
}


function bbcode_uninstall() {
    $superCage = Inspekt::makeSuperCage();

    if (!$superCage->post->keyExists('drop')) {
        return 1;
    }

    if ($superCage->post->getInt('drop') == 1) {
        global $CONFIG;
        cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name LIKE 'bbcode_control_%'");
    }
    return true;
}


function bbcode_cleanup($action) {
    global $CONFIG, $lang_common, $enabled_languages_array;

    // language detection
    $lang = isset($CONFIG['lang']) ? $CONFIG['lang'] : 'english';
    include('plugins/bbcode_control/lang/english.php');
    if (in_array($lang, $enabled_languages_array) == TRUE && file_exists('plugins/bbcode_control/lang/'.$lang.'.php')) {
        include('plugins/bbcode_control/lang/'.$lang.'.php');
    }

    $superCage = Inspekt::makeSuperCage();
    $cleanup = $superCage->server->getEscaped('REQUEST_URI');
    if ($action == 1) {
    echo <<< EOT
    <form action="{$cleanup}" method="post">
        <table border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td class="tableb">
                    {$lang_plugin_bbcode_control['cleanup']}
                </td>
                <td class="tableb">
                    <input type="radio" name="drop" id="drop_yes" value="1" checked="checked" />
                    <label for="drop_yes" class="clickable_option">{$lang_common['yes']}</label>
                </td>
                <td class="tableb">
                    <input type="radio" name="drop" id="drop_no"  value="0" />
                    <label for="drop_no" class="clickable_option">{$lang_common['no']}</label>
                </td>
                <td class="tableb">
                    <input type="submit" name="submit" value="{$lang_common['go']}" class="button" />
                </td>
            </tr>
        </table>
    </form>
EOT;
    }
}


function bbcode_control_config_button($admin_menu){
    global $CONFIG, $enabled_languages_array;

    // language detection
    $lang = isset($CONFIG['lang']) ? $CONFIG['lang'] : 'english';
    include('plugins/bbcode_control/lang/english.php');
    if (in_array($lang, $enabled_languages_array) == TRUE && file_exists('plugins/bbcode_control/lang/'.$lang.'.php')) {
        include('plugins/bbcode_control/lang/'.$lang.'.php');
    }

    if ($CONFIG['enable_menu_icons'] > 0) {
        $bbcode_config_icon = '<img src="plugins/bbcode_control/images/bbcode.png" border="0" alt="" width="16" height="16" class="icon" />';
    } else {
        $bbcode_config_icon = '';
    }

    $new_button = '<!-- BEGIN bbcode_control --><div class="admin_menu admin_float"><a href="index.php?file=bbcode_control/admin" title="'.$lang_plugin_bbcode_control['config_link_title'].'">'.$bbcode_config_icon.'BBCode Control</a></div><!-- END bbcode_control -->';
    $look_for = '<!-- END export -->';
    $admin_menu = str_replace($look_for, $look_for . $new_button, $admin_menu);

    return $admin_menu;
}


function new_bbcodes($text) {
    // replace disabled bbcode tags with ""
    $bbcode_tags_disabled = get_bbcode_tags('disabled');
    foreach ($bbcode_tags_disabled as $tag) {
        $text = str_replace("[$tag]", "", $text);
        $text = preg_replace("/\[$tag=(.*)]/Uis", "", $text);
        $text = str_replace("[/$tag]", "", $text);
    }

    // images on same domain only
    if ($CONFIG['bbcode_control_tag_img_localhost_only'] == 1) {
        // language detection
        global $CONFIG, $enabled_languages_array;
        $lang = isset($CONFIG['lang']) ? $CONFIG['lang'] : 'english';
        include('plugins/bbcode_control/lang/english.php');
        if (in_array($lang, $enabled_languages_array) == TRUE && file_exists('plugins/bbcode_control/lang/'.$lang.'.php')) {
            include('plugins/bbcode_control/lang/'.$lang.'.php');
        }

        // get host name from URL
        preg_match('@^(?:http://)?([^/]+)@i', $CONFIG['ecards_more_pic_target'], $matches);
        $host = $matches[1];
        preg_match('/[^.]+\.[^.]+$/', $host, $matches);
        $domain = isset($matches[0]) ? $matches[0] : $host;

        $text = preg_replace("/\[img\]([^\[img\]]*)$domain(.*)\[\/img\]/Uis", "[img_local]\\1$domain\\2[/img_local]", $text);
        $text = preg_replace("/\[img\](.*)\[\/img\]/Uis", "<a href=\"\\1\" rel=\"external\"><img src=\"plugins/bbcode_control/images/warning.png\" border=\"0\" alt=\"No bandwidth theft\" height=\"100\" title=\"{$lang_plugin_bbcode_control['save_bandwidth']}\" /></a>", $text);
        $text = str_replace("[img_local]", "[img]", $text);
        $text = str_replace("[/img_local]", "[/img]", $text);
    }

    // limit image dimensions
    if ($CONFIG['bbcode_control_tag_img_max_width'] > 0 || $CONFIG['bbcode_control_tag_img_max_height'] > 0) {
        $max_width = $CONFIG['bbcode_control_tag_img_max_width'] > 0 ? "max-width: {$CONFIG['bbcode_control_tag_img_max_width']}px;" : "";
        $max_height = $CONFIG['bbcode_control_tag_img_max_height'] > 0 ? "max-height: {$CONFIG['bbcode_control_tag_img_max_height']}px;" : "";
        $text = preg_replace("/\[img\](.*)\[\/img\]/Uis", "<img src=\"\\1\" border=\"0\" style=\"$max_width $max_height\" /></a>", $text);
    }

    // change font size
    if (!in_array('size', $bbcode_tags_disabled)) {
        $text = preg_replace("/\[size=([1-9][\d]?p[xt]|(?:x-)?small(?:er)?|(?:x-)?large[r]?)\](.*)\[\/size\]/Usi", "<span style=\"font-size:\\1\">\\2</span>", $text);
    }

    // insert youtube video
    if (!in_array('youtube', $bbcode_tags_disabled)) {
        $youtube_embed_code_replacement  = "<object type=\"application/x-shockwave-flash\" width=\"640\" height=\"385\" data=\"http://www.youtube.com/v/\\2&hl=de&fs=1\">";
        $youtube_embed_code_replacement .= "<param name=\"movie\" value=\"http://www.youtube.com/v/\\2&hl=de&fs=1\" />";
        $youtube_embed_code_replacement .= "<param name=\"allowfullscreen\" value=\"true\" />";
        $youtube_embed_code_replacement .= "</object>";
        $text = preg_replace("/\[youtube\](.*)youtube.com\/watch\?v=(.*)\[\/youtube\]/Usi", $youtube_embed_code_replacement, $text);
    }

    // insert quote
    if (!in_array('quote', $bbcode_tags_disabled)) {
        $style = "style=\"background-image:url(plugins/bbcode_control/images/quote_show.png); background-repeat:no-repeat; background-position:top right; padding-right:40px;\"";
        $text = preg_replace("/\[quote=(.*)](.*)\[\/quote\]/Uis", "<fieldset $style><legend>\\1</legend>\\2</fieldset>", $text);
        $text = str_replace("[quote]", "<fieldset $style>", $text);
        $text = str_replace("[/quote]", "</fieldset>", $text);
    }

    // horizontal line
    if (!in_array('hr', $bbcode_tags_disabled)) {
        $text = str_replace("[hr]", "<hr />", $text);
    }

    // tele type font
    if (!in_array('tt', $bbcode_tags_disabled)) {
        $text = str_replace("[tt]", "<tt>", $text);
        $text = str_replace("[/tt]", "</tt>", $text);
    }

    return $text;
}


function get_bbcode_tags($which) {
    // available tags
    $bbcode_tags_available = array(
        'b', // cpg standard
        'u', // cpg standard
        'i', // cpg standard
        's', // cpg standard
        'size',
        'tt',
        'color', // cpg standard
        'hr',
        'quote',
        'url', // cpg standard
        'img', // cpg standard
        'youtube',
    );

    if ($which == 'available') {
        return $bbcode_tags_available;
    }

    // enabled buttons
    if ($which == 'enabled') {
        global $CONFIG;
        foreach($bbcode_tags_available as $tag) {
            if ($CONFIG['bbcode_control_tag_'.$tag.'_process'] != 0 && ($CONFIG['bbcode_control_tag_'.$tag.'_show'] == 2 || $CONFIG['bbcode_control_tag_'.$tag.'_show'] == 1 && GALLERY_ADMIN_MODE)) {
                $bbcode_tags_enabled[] = $tag;
            }
        }
        return $bbcode_tags_enabled;
    }

    // disabled for processing
    if ($which == 'disabled') {
        global $CONFIG;
        foreach($bbcode_tags_available as $tag) {
            if ($CONFIG['bbcode_control_tag_'.$tag.'_process'] == 0) {
                $bbcode_tags_disabled[] = $tag;
            }
        }
        return $bbcode_tags_disabled;
    }

    return FALSE;
}


function special_open_tag($tag) {
    switch ($tag) {
        case 'size': return "[$tag=10pt]";
        case 'color': return "[$tag=red]";
        default: return "[$tag]";
    }
}


function special_close_tag($tag) {
    switch ($tag) {
        case 'hr': return "";
        default: return "[/$tag]";
    }
}


function buttons_add_comment($template_add_your_comment) {
    global $CONFIG, $enabled_languages_array;

    // language detection
    $lang = isset($CONFIG['lang']) ? $CONFIG['lang'] : 'english';
    include('plugins/bbcode_control/lang/english.php');
    if (in_array($lang, $enabled_languages_array) == TRUE && file_exists('plugins/bbcode_control/lang/'.$lang.'.php')) {
        include('plugins/bbcode_control/lang/'.$lang.'.php');
    }
    set_js_var('lang_please_enter_text', $lang_plugin_bbcode_control['please_enter_text']);
    set_js_var('lang_insert_at_position', $lang_plugin_bbcode_control['insert_at_position']);

    // include js file
    js_include('plugins/bbcode_control/js/bbcode.js');

    // get bbcode tags
    $bbcode_tags = get_bbcode_tags('enabled');

    // create buttons
    $bbcodes = '';
    foreach ($bbcode_tags as $tag) {
        $opentag = special_open_tag($tag);
        $closetag = special_close_tag($tag);
        $bbcodes .= "<img onclick=\"javascript:insert('$opentag', '$closetag', 'post')\" src=\"plugins/bbcode_control/images/$tag.png\" title=\"{$lang_plugin_bbcode_control[$tag]}\" alt=\"$tag\" class=\"button\" style=\"cursor:pointer;\" width=\"20\" height=\"16\" /> ";
    }

    // replace html
    $new_html_add_comment = '                                <td>
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td class="tableh2_compact">
                                                    {ADD_YOUR_COMMENT}{HELP_ICON}
                                                </td>
                                                <td class="tableh2_compact" align="right">
                                                    ' . $bbcodes . '
                                                </td>
                                            </tr>
                                        </table>
                                </td>';
    $template_add_your_comment = str_replace('<td width="100%" class="tableh2">{ADD_YOUR_COMMENT}{HELP_ICON}</td>', $new_html_add_comment , $template_add_your_comment);

    return $template_add_your_comment;
}


function buttons_edit_comment($template_image_comments) {
    global $CONFIG, $enabled_languages_array;

    // language detection
    $lang = isset($CONFIG['lang']) ? $CONFIG['lang'] : 'english';
    include('plugins/bbcode_control/lang/english.php');
    if (in_array($lang, $enabled_languages_array) == TRUE && file_exists('plugins/bbcode_control/lang/'.$lang.'.php')) {
        include('plugins/bbcode_control/lang/'.$lang.'.php');
    }
    set_js_var('lang_please_enter_text', $lang_plugin_bbcode_control['please_enter_text']);
    set_js_var('lang_insert_at_position', $lang_plugin_bbcode_control['insert_at_position']);

    // include js file
    js_include('plugins/bbcode_control/js/bbcode.js');

    // get bbcode tags
    $bbcode_tags = get_bbcode_tags('enabled');

    // create buttons
    $bbcodes = '';
    foreach ($bbcode_tags as $tag) {
        $opentag = special_open_tag($tag);
        $closetag = special_close_tag($tag);
        $bbcodes .= "<img onclick=\"javascript:insert('$opentag', '$closetag', 'f{MSG_ID}')\" src=\"plugins/bbcode_control/images/$tag.png\" title=\"{$lang_plugin_bbcode_control[$tag]}\" alt=\"$tag\" class=\"button\" style=\"cursor:pointer;\" width=\"20\" height=\"16\"  /> ";
    }

    // replace html
    $search_html_edit_comment = '<textarea cols="40" rows="2" class="textinput" name="msg_body"';
    $template_image_comments = str_replace($search_html_edit_comment, $bbcodes.$search_html_edit_comment , $template_image_comments);

    return $template_image_comments;
}


function embed_code($info) {
    global $CONFIG;

    if ($CONFIG['bbcode_control_tag_img_embed_code'] == 1)
    {
        global $CURRENT_PIC_DATA;

        $url = $CONFIG['ecards_more_pic_target'].'displayimage.php?pid='.$CURRENT_PIC_DATA['pid'];
        $thumb = '[img]'.$CONFIG['ecards_more_pic_target'].get_pic_url($CURRENT_PIC_DATA, 'thumb').'[/img]';

        $info['BBCode'] = '<textarea onfocus="this.select();" onclick="this.select();" class="textinput" rows="1" cols="64" wrap="off" style="overflow:hidden; height:15px;">[url='.$url.']'.$thumb.'[/url]</textarea>';
    }

    return $info;
}

?>