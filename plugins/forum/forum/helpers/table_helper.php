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

/**
* ****************************************************
* Coppermine Simple Forum
* 
* @package Table Helper Class
* ****************************************************
*/ 

class table {
    function open($table = 1, $title = '', $colspan = 1) {
        $html = '';
        switch ($table) {
            case 0:
                $table = array(
                    'align'       => 'center',
                    'width'       => -1,
                    'border'      => 0,
                    'cellspacing' => 0,
                    'cellpadding' => 0,
                );
                break;
            case 1:
                $table = array(
                    'align'       => 'center',
                    'class'       => 'maintable',
                    'width'       => -1,
                    'border'      => 0,
                    'cellspacing' => 1,
                    'cellpadding' => 0,
                );
                break;
            case 2:
                $table = array(
                    'align'       => 'center',
                    'width'       => '100%',
                    'border'      => 0,
                    'cellspacing' => 0,
                    'cellpadding' => 0,
                );
                break;
            case 3:
                $table = array(
                    'align'       => 'center',
                    'class'       => 'maintable',
                    'width'       => '100%',
                    'border'      => 0,
                    'cellspacing' => 1,
                    'cellpadding' => 0,
                );
                break;
        }
        // auto convert -1 to picture_table_width config value in with atribute
        if ($table['width'] == -1) {
            $table['width'] = Config::item('picture_table_width');
        }
        $html .= PHP_EOL.table::create_element('table', $table);
        // title
        if ($title) {
            $html .= table::td($title, $colspan);
        }
        return $html;
    }
    function close() {
        return table::create_element('/table');
    }
    function title($title, $colspan = 1, $class = 'tableh1') { // backward
        return table::td($title, $colspan, $class);
    }
    function td($title, $colspan = 1, $class = 'tableh1') {
        $tds = array(
            'class'   => $class,
            'colspan' => $colspan,
            'text'    => $title,
        );
        return table::tds($tds);
    }
    function tds($tds = array()) {
        $table_level = (int)Config::item('table_level');
        $html = '';
        // normalize the data
        if (!is_array($tds[0])) {
            $tds = array($tds);
        }
        if (count($tds) > 0) {
            $html .= table::create_element('tr');
            foreach ($tds as $td) {
                $html .= table::create_element('td', $td, TRUE);
            }
            $html .= table::create_element('/tr');
        }
        return $html;
    }
    function create_element($name, $options = array(), $need_close_tag = FALSE, $level = 0) {
        $html = "";
        for ($i=1;$i<=$level;$i++) {
            $html .= "\t";
        }
        $html .= '<'.$name;
        foreach ($options as $key => $value) {
            if ($key != 'text') {
                $html .= " {$key}=\"{$value}\"";
            }
        }
        if ($need_close_tag) {
            $html .= '>'.$options['text'].'</'.$name.'>'.PHP_EOL;
        } else {
            $html .= '>'.PHP_EOL;
        }
        return $html;
    }
    function error($errors) {
        $html = "";
        if (!is_array($errors)) $errors = array($errors);
        foreach ($errors as $error) {
            $html .= "<span style=\"color: red; font-weight: bold;\">$error</span><br />".PHP_EOL;
        }
        return $html;
    }
}