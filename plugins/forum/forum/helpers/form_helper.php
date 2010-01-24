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

class form {
    function open($action, $name = '', $method = 'post', $is_upload_form = FALSE) {
        if ($is_upload_form) {
            $addon = ' enctype="multipart/form-data"';
        } else {
            $addon = '';
        }
        if ($name != '') {
            return "<form name=\"{$name}\" id=\"{$name}\" action=\"{$action}\" method=\"{$method}\"{$addon}>".PHP_EOL;
        } else {
            return "<form action=\"{$action}\" method=\"{$method}\"{$addon}>".PHP_EOL;
        }
    }
    function close() {
        return '</form>'.PHP_EOL;
    }
    function text($name, $value = '', $is_100 = TRUE) {
        if ($is_100) {
            return "<input class=\"textinput\" type=\"text\" name=\"{$name}\" id=\"{$name}\" style=\"width: 100%\" value=\"{$value}\" />".PHP_EOL;
        } else {
            return "<input class=\"textinput\" type=\"text\" name=\"{$name}\" id=\"{$name}\" value=\"{$value}\" />".PHP_EOL;        
        }
    }
    function file($name, $value = '') {
        return "<input type=\"file\" name=\"{$name}\" id=\"{$name}\" value=\"{$value}\" />".PHP_EOL;
    }
    function radio($name, $value = '', $text = '', $default = '') {
        if ($value == $default) {
            return "<input type=\"radio\" name=\"{$name}\" id=\"{$name}\" value=\"{$value}\" checked=\"checked\" />{$text}".PHP_EOL;
        } else {
            return "<input type=\"radio\" name=\"{$name}\" id=\"{$name}\" value=\"{$value}\" />{$text}".PHP_EOL;
        }
    }
    function yesno($name, $value = '') {
        // 1||0//Y||N//y||n//YES||NO - autodetect
        $html = "";
        switch ($value) {
            case '0':
            case '1':
                $values = array(1,0);
                break;
            case 'Y':
            case 'N':
                $values = array('Y','N');
            case 'y':
            case 'n':
                $values = array('y','n');
            case 'YES':
            case 'NO':
                $values = array('YES','NO');
            default:
                $values = array('YES','NO');
        }
        $html .= form::radio($name, $values[0], Lang::item('common.yes'), $value);
        $html .= form::radio($name, $values[1], Lang::item('common.no'),  $value);
        return $html;
    }
    function hidden($name, $value = '') {
        return "<input type=\"hidden\" name=\"{$name}\" id=\"{$name}\" value=\"{$value}\" />".PHP_EOL;
    }
    function textarea($name, $value = '', $rows = '8') {
        return "<textarea class=\"textinput\" id=\"{$name}\" name=\"{$name}\" style=\"width: 100%;\" rows=\"{$rows}\">{$value}</textarea>".PHP_EOL;
    }
    function select($name, $values = array(), $default = '', $is_100 = TRUE) {
        $html = "";
        if ($is_100) {
            $html .= "<select name=\"{$name}\" id=\"{$name}\" class=\"listbox\" style=\"width: 100%;\">".PHP_EOL;
        } else {
            $html .= "<select name=\"{$name}\" id=\"{$name}\" class=\"listbox\">".PHP_EOL;
        }
        foreach ($values as $key => $title) {
            if ($key == $default) {
                $html .= "<option value=\"{$key}\" selected=\"selected\">{$title}</option>".PHP_EOL;
            } else {
                $html .= "<option value=\"{$key}\">{$title}</option>".PHP_EOL;
            }
        }
        $html .= "</select>".PHP_EOL;
        return $html;
    }
    function checkbox($name, $checked = TRUE) {
        if ($checked) {
            return "<input type=\"checkbox\" name=\"{$name}\" checked>".PHP_EOL;
        } else {
            return "<input type=\"checkbox\" name=\"{$name}\">".PHP_EOL;
        }
    }
    function submit($value, $name = '') {
        if ($name) {
            return "<input class=\"button\" type=\"submit\" value=\"{$value}\" name=\"{$name}\" id=\"{$name}\" />".PHP_EOL;
        } else {
            return "<input class=\"button\" type=\"submit\" value=\"{$value}\" />".PHP_EOL;
        }
    }
    function reset($value, $name = '') {
        if ($name) {
            return "<input class=\"button\" type=\"reset\" value=\"{$value}\" name=\"{$name}\" id=\"{$name}\" />".PHP_EOL;
        } else {
            return "<input class=\"button\" type=\"reset\" value=\"{$value}\" />".PHP_EOL;
        }
    }
}

?>