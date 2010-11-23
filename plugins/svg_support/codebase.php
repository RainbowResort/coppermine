<?php
/**************************************************
  Coppermine 1.5.x Plugin - svg_support
  *************************************************
  Copyright (c) 2010 eenemeenemuu
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

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

$thisplugin->add_action('plugin_install', 'svg_install');

function svg_install() {
    global $CONFIG;
    if (!mysql_result(cpg_db_query("SELECT COUNT(*) FROM {$CONFIG['TABLE_FILETYPES']} WHERE extension = 'svg'"), 0)) {
        cpg_db_query("INSERT INTO {$CONFIG['TABLE_FILETYPES']} (extension, mime, content, player) VALUES ('svg', 'image/svg+xml', 'document', '')");
    } else {
        cpg_db_query("UPDATE {$CONFIG['TABLE_FILETYPES']} SET mime = 'image/svg+xml', content = 'document', player = '' WHERE extension = 'svg'");
    }
    if (strpos($CONFIG['allowed_doc_types'], 'svg') === FALSE) {
        cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = CONCAT(value, '/svg') WHERE name = 'allowed_doc_types'");
    }
    return true;
}


$thisplugin->add_filter('theme_display_thumbnails_params', 'svg_thumbnail_params');

function svg_thumbnail_params($params) {

    if (preg_match('/(\.svg)/Usi', $params['{THUMB}'])) {
        global $CONFIG;
        switch ($CONFIG['thumb_use']) {
            case 'any':
            case 'ex':
                $width_height = 'width="'.$CONFIG['thumb_width'].'" height="'.$CONFIG['thumb_width'].'"';
                break;
            case 'ht':
                $width_height = 'height="'.$CONFIG['thumb_width'].'"';
                break;
            case 'wd':
                $width_height = 'width="'.$CONFIG['thumb_width'].'"';
                break;
        }
        preg_match('/pid=([0-9]+)/', $params['{LINK_TGT}'], $matches);
        $pid = $matches[1];
        $CURRENT_PIC_DATA = mysql_fetch_assoc(cpg_db_query("SELECT filepath, filename FROM {$CONFIG['TABLE_PICTURES']} WHERE pid = ".$pid));
        $file = $CONFIG['fullpath'].$CURRENT_PIC_DATA['filepath'].$CURRENT_PIC_DATA['filename'];
        $params['{THUMB}'] = '<div><object data="'.$file.'" type="image/svg+xml" '.$width_height.'>Your browser doesn\'t support svg files</object></div>';
    }

    return $params;
}


$thisplugin->add_filter('html_document', 'svg_html_document');

function svg_html_document($pic_html) {
    global $CONFIG, $CURRENT_PIC_DATA;
    if ($CURRENT_PIC_DATA['mime'] == 'image/svg+xml') {
        $resize_method = $CONFIG['picture_use'] == "thumb" ? ($CONFIG['thumb_use'] == "ex" ? "any" : $CONFIG['thumb_use']) : $CONFIG['picture_use'];
        switch ($resize_method) {
            case 'any':
                $width_height = 'width="'.$CONFIG['picture_width'].'" height="'.$CONFIG['picture_width'].'"';
                break;
            case 'ht':
                $width_height = 'height="'.$CONFIG['picture_width'].'"';
                break;
            case 'wd':
                $width_height = 'width="'.$CONFIG['picture_width'].'"';
                break;
        }
        $file = $CONFIG['fullpath'].$CURRENT_PIC_DATA['filepath'].$CURRENT_PIC_DATA['filename'];
        $pic_html = '<object data="'.$file.'" type="image/svg+xml" '.$width_height.'>Your browser doesn\'t support svg files</object>';
    }
    return $pic_html;
}

?>
