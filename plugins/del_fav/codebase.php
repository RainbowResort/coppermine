<?php
/**************************************************
  Coppermine 1.4.x Plugin - Delete Favorite 
  *************************************************
  Copyright (c) 2006 Borzoo Mossavari
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  *************************************************
  Delete all your favorite file with just one click !
  ***************************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

$superCage = Inspekt::makeSuperCage();
if (defined('THUMBNAILS_PHP') && $superCage->get->getAlpha('album') == 'favpics') {
    $thisplugin->add_filter('page_html', 'delfav_main');
    $thisplugin->add_action('page_start','delfav_temp'); 
}

function delfav_temp() {
    global $CONFIG, $enabled_languages_array, $lang_plugin_delfav;

    $lang = isset($CONFIG['lang']) ? $CONFIG['lang'] : 'english';
    include('plugins/del_fav/lang/english.php');
    if (in_array($lang, $enabled_languages_array) == TRUE && file_exists('plugins/del_fav/lang/'.$lang.'.php')) {
        include('plugins/del_fav/lang/'.$lang.'.php');
    }
} 

function delfav_main($html) {
    global $lang_meta_album_names, $lang_plugin_delfav;

    $delfav_but = ' <a href="index.php?file=del_fav/remfav" onclick="return confirm(\''.$lang_plugin_delfav['confirm'].'\');" title="'.$lang_plugin_delfav['config_button'].'"><img src="images/icons/delete.png" border="0" style="display:inline" /></a>';
    $html = str_replace($lang_meta_album_names['favpics'].'</h2></td>', $lang_meta_album_names['favpics'].$delfav_but.'</h2></td>', $html);

    return $html;
}
?>