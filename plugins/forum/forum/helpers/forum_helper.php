<?php
/**************************************************
  Coppermine 1.5.x Plugin - forum
  *************************************************
  Copyright (c) 2010 foulu (Le Hoai Phuong), eenemeenemuu
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
  
/*
* ---------------------------------------
* @author Le Hoai Phuong
* @package forum helper
* @desc provide some specific html from the data
* ---------------------------------------
*/

class forum {
    function link($c, $m = null, $id = null, $addition = null) {
        return 'forum.php?c='.$c.'&m='.($m ? $m : 'index').($id ? '&id='.$id : '').($addition ? $addition : '');
    }
    function format_message($message) {
        if (!function_exists('process_smilies')) {
            include(BASE_DIR.'include'.DS.'smilies.inc.php');
        }
        return make_clickable(process_smilies(bb_decode($message)));
    }
    function redirect($link, $type = 'php') {
        if ($type == 'php') {
            header("Location: $link");
        } elseif ($type == 'js') {
            echo "<script language=\"javascript\" type=\"text/javascript\">window.location='{$link}';</script>";
        } else {
            echo "<html><head><meta http-equive=\"refresh\" content=\"2; URL={$link}\"></head></html>";
        }
        exit();
    }
    function message($title, $message, $link, $time = 2) {
        global $CONFIG;
        if ($CONFIG['display_redirection_page'] == 0) {
            header("Location: $link&message_id=".cpgStoreTempMessage($message));
        } else {
            pageheader($title, "<META http-equiv=\"refresh\" content=\"{$time};url={$link}\">");
            msg_box($title, $message, Lang::item('common.continue'), $link);
            pagefooter();
        }
        exit();
    }
    function nagavitor($nagavitor, $seperator = '::') {
        $sets = array();
        foreach ($nagavitor as $k => $v) {
            $sets[] = html::anchor($v[0], $v[1]);
        }
        $sets = array_reverse($sets);
        return implode(' '.$seperator.' ', $sets);
    }
    function child_board_list($childs) {
        foreach ($childs as $k => $v) {
            $childs[$k] = html::board_anchor($v['board_id'], $v['name']);
        }
        return implode(', ', $childs);
    }
    function paging($paging = array()) {
        $html = "";
        if ($paging['total'] != 0) {
            $number_of_page = ceil($paging['total'] / $paging['limit']); //total
            $current_page   = ceil($paging['start'] / $paging['limit']) + 1; //current
            if ($current_page == 0) { 
                $current_page = 1;
            }

            if ($current_page > 1) {
                $previous = ($current_page * $paging['limit']) - ($paging['limit'] * 2);
                $html .= "<a href=\"{$paging['pattern']}&start={$previous}\"><<</a>&nbsp;";
            }

            for ($i=1;$i<=$number_of_page;$i++) {
                $current_start = ($i-1)*$paging['limit'];
                if ($current_page == $i) {
                    $html .= "[<b>{$i}</b>]" . '&nbsp;&nbsp;';
                } else {
                    $html .= "<a href=\"{$paging['pattern']}&start={$current_start}\">{$i}</a>" . NBSP . NBSP;
                }
            }

            if ($current_page < $number_of_page) {
                $next = $current_page * $paging['limit'];
                $html .= "<a href=\"{$paging['pattern']}&start={$next}\">>></a>";
            }

            return $html;
        } else {
            return TRUE;
        }
    }

    function board_move_box($board_move_data, $board_id, $cat_id, $child_level, $parent_id) {
        $html = "";
        $html .="<select name=\"board_{$board_id}\" onchange=\"if(this.options[this.selectedIndex].value) window.location.href='forum.php?c=admin&m=moveboard&board={$board_id}&'+this.options[this.selectedIndex].value;\" class=\"listbox\" style=\"width: 100%;\">".PHP_EOL;
        $is_display = true;
        $display_level = 0;
        foreach ($board_move_data as $element) {
            if ($element[0] == "cat") {
                if ($element[1] == $cat_id && $child_level == 1)
                    $html .= "<option value=\"to_cat={$element[1]}\" selected=\"selected\">* {$element[2]} *</option>";
                else
                    $html .= "<option value=\"to_cat={$element[1]}\">* {$element[2]} *</option>";
                } else {
                if ($is_display == false)
                if ($element[3] == $display_level) $is_display = true;
                if ($element[1] != $board_id) {
                    if ($is_display) {
                        if ($parent_id == $element[1]) {
                            $html .= "<option value=\"to_board={$element[1]}\" selected=\"selected\">".forum::indent($element[3]+1)."{$element[2]}</option>";
                        } else {
                            $html .= "<option value=\"to_board={$element[1]}\">".forum::indent($element[3]+1).$element[2].'</option>';
                        }
                    }
                } else {
                    $is_display = false;
                    $display_level = $element[3];
                }
            }
        }
        $html .="</select>".PHP_EOL;
        return $html;
    }
    function redirect_box($cbs, $default = '') {
        $html = "<select class=\"listbox\" name=\"jumpto\" style=\"width: 100%\" onchange=\"if (this.options[this.selectedIndex].value) window.location.href=this.options[this.selectedIndex].value;\">".PHP_EOL;
        foreach ($cbs as $babe) {
            if ($babe[0] == 'cat') {
                if ($default == $babe[1]) {
                    $html .= "<option value=\"forum.php?c=home&amp;id={$babe[1]}\" selected=\"selected\">* {$babe[2]} *</option>".PHP_EOL;
                } else {
                    $html .= "<option value=\"forum.php?c=home&amp;id={$babe[1]}\">* {$babe[2]} *</option>".PHP_EOL;
                }
            }
            if ($babe[0] == 'board') {
                $html .= "<option value=\"forum.php?c=board&amp;id={$babe[1]}\">".forum::indent($babe[3]+1).$babe[2]."</option>".PHP_EOL;
            }
        }
        $html .= '</select>'.PHP_EOL;
        return $html;
    }
    function topic_move_box($cbs, $default = '') {
        $html = "<select class=\"listbox\" name=\"board_id\" style=\"width: 100%\">".PHP_EOL;
        foreach ($cbs as $babe) {
            if ($babe[0] == 'cat') {
                $html .= "<option value=\"0\" disabled>* {$babe[2]} *</option>".PHP_EOL;
            }
            if ($babe[0] == 'board') {
                if ($default == $babe[1]) {
                    $html .= "<option value=\"{$babe[1]}\" selected=\"selected\">".forum::indent($babe[3]+1).$babe[2]."</option>".PHP_EOL;
                } else {
                    $html .= "<option value=\"{$babe[1]}\">".forum::indent($babe[3]+1).$babe[2]."</option>".PHP_EOL;
                }
            }
        }
        $html .= "</select>".PHP_EOL;
        return $html;
    }
    function generate_bbcode_tags($form = 'post', $field = 'icon') {
        $html = "";
        // check if plugin 'bbcode_control' is installed
        if (function_exists(get_bbcode_tags) && function_exists(special_open_tag) && function_exists(special_close_tag)) {
            // language detection
            $lang = isset($CONFIG['lang']) ? $CONFIG['lang'] : 'english';
            include('plugins/bbcode_control/lang/english.php');
            if (in_array($lang, $enabled_languages_array) == TRUE && file_exists('plugins/bbcode_control/lang/'.$lang.'.php')) {
                include('plugins/bbcode_control/lang/'.$lang.'.php');
            }
            set_js_var('lang_please_enter_text', $lang_plugin_bbcode_control['please_enter_text']);
            set_js_var('lang_insert_at_position', $lang_plugin_bbcode_control['insert_at_position']);
            
            $bbcode_tags = get_bbcode_tags('enabled');
            foreach ($bbcode_tags as $tag) {
                $opentag = special_open_tag($tag);
                $closetag = special_close_tag($tag);
                $html .= "<img onclick=\"javascript:insert_bbcode_tag('$opentag', '$closetag', '$form', '$field')\" src=\"plugins/bbcode_control/images/$tag.png\" title=\"{$lang_plugin_bbcode_control[$tag]}\" alt=\"$tag\" class=\"button\" style=\"cursor:pointer;\" width=\"20\" height=\"16\" /> ";
            }
        } else {
            $bbcode_tags = array('b','u','i','img','url','email');
            foreach ($bbcode_tags as $tag)
                $html .= "<input type=\"button\" class=\"button\" value=\"{$tag}\" onclick=\"javascript:insert_bbcode_tag('[{$tag}]', '[/{$tag}]', '{$form}', '{$field}');\"> ";
            }
        return $html;
    }
    function generate_message_icons($name, $icons = array(), $default = 'icon1') {
        $html .= "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">".PHP_EOL;
        $html .= "<tr>".PHP_EOL;
        $count = 0;
        foreach ($icons as $icon) {
            $count++;
            if ($default == $icon['filename'])
                $html .= "<td><input type=\"radio\" name=\"{$name}\" value=\"{$icon['filename']}\" checked=\"checked\">&nbsp;<img src=\"plugins/forum/forum/html/images/post/{$icon['filename']}.gif\" title=\"{$icon['title']}\" alt=\"\" />".PHP_EOL;
            else
                $html .= "<td><input type=\"radio\" name=\"{$name}\" value=\"{$icon['filename']}\">&nbsp;<img src=\"plugins/forum/forum/html/images/post/{$icon['filename']}.gif\" title=\"{$icon['title']}\" alt=\"\" /></td>".PHP_EOL;
            if ($count % 16 == 0 && $count != 1) $html .= "</tr><tr>".PHP_EOL;
        }
        $html .= "</tr>".PHP_EOL;
        $html .= "</table>".PHP_EOL;
        return $html;
    }
    function indent($level, $indent = '<span style="color: red;">|=></span>') {
        $html = "";
        for ($i=0;$i<($level-1);$i++) {
            $html .= $indent;
        }
        if ($html) {
            $html .= "&nbsp;";
        }
        return $html;
    }
    function seperate($array, $string = ' | ') {
        return implode($string, $array);
    }
}
/* end of forum helper */
