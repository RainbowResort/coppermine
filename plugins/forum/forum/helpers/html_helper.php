<?php

class html {
    function button($link, $title, $params = array()) {
        return '<button class="button" '.($link ? "onclick=\"window.location.href='{$link}';\"" : '')." ".html::params($params).">{$title}</button>";
    }
    function jsbutton($js, $title, $params = array()) {
        return "<button class=\"button\" onclick=\"{$js}\"".html::params($params).">{$title}</button>";
    }
    function img($src, $size = '100%', $params = array()) {
        if (!$size) $size = Config::item('thumb_size');
        $image_info = @getimagesize($src);
        if ($image_info[3]) {
            $sizes = explode('"', $image_info[3]);
            $image_info[0] = $sizes[1];
            $image_info[1] = $sizes[3];
        }
        if (strpos($size, '%') !== false) {
            $image_info[0] = round($image_info[0]*(int)$size/100);
            $image_info[1] = round($image_info[1]*(int)$size/100);
        } else {
            if (max($image_info[0], $image_info[1]) > $size) {
                $ratio = $size/max($image_info[0], $image_info[1]);
                $image_info[0] = round($image_info[0]*$ratio);
                $image_info[1] = round($image_info[1]*$ratio);
            }
        }
        if ($image_info[1] && $image_info[1])
            return "<img border=\"0\" src=\"{$src}\" width=\"{$image_info[0]}\" height=\"{$image_info[1]}\" ".html::params($params)."/>";
        else
            return "<img border=\"0\" src=\"{$src}\" ".html::params($params)."/>";
    }
    function anchor($href, $title, $params = array()) {
        if (strpos($title, '<img') === false)
            return "<a href=\"{$href}\" title=\"{$title}\" ".html::params($params).">{$title}</a>".PHP_EOL;
        else {
            return "<a href=\"{$href}\" ".html::params($params).">{$title}</a>".PHP_EOL;
        }
    }
    function spacer() {
        return '<img src="images/spacer.gif" height="10" style="width: 100%;"><br />';
    }
    function profile_anchor($user_id, $user_name = '', $params = array()) {
        if (!$user_name) $user_name = get_username($user_id);
        $user_name = trim($user_name);
        if ($user_id != 0) {
            return "<a href=\"profile.php?uid={$user_id}\" ".html::params($params).">{$user_name}</a>".PHP_EOL;
        } else {
            return $user_name;
        }
    }
    function category_anchor($cat_id, $cat_title, $params = array()) {
        return "<a href=\"forum.php?c=home&amp;id={$cat_id}\" ".html::params($params).">{$cat_title}</a>".PHP_EOL;
    }
    function board_anchor($board_id, $board_title, $params = array()) {
        return "<a href=\"forum.php?c=board&amp;id={$board_id}\" ".html::params($params).">{$board_title}</a>".PHP_EOL;
    }
    function topic_anchor($topic_id, $topic_title, $params = array()) {
        return "<a href=\"forum.php?c=topic&amp;id={$topic_id}\" ".html::params($params).">{$topic_title}</a>".PHP_EOL;
    }
    function message_anchor($msg_id, $msg_subject, $params = array()) {
        return "<a href=\"forum.php?c=message&amp;id={$msg_id}\" ".html::params($params).">{$msg_subject}</a>".PHP_EOL;
    }
    function params($params = array()) {
        $html = '';
        if (count($params) > 0) {
            foreach ($params as $k => $v) {
                $html .= $k.'="'.$v.'" ';
            }
        }
        return $html;
    }
    function bold($text) {
        return html::cover('b', $text);
    }
    function b($text) {
        return html::cover('b', $text);
    }
    function i($text) {
        return html::cover('i', $text);
    }
    function u($text) {
        return html::cover('u', $text);
    }
    function span($text, $params = array('class'=>'album_stat')) {
        return html::cover('span', $text, $params);
    }
    function div($text, $params = array()) {
        return html::cover('div', $text, $params);
    }
    function cover($tag, $text, $params = array()) {
        return '<'.$tag.' '.html::params($params).'>'.$text.'</'.$tag.'>'.PHP_EOL;
    }
}
