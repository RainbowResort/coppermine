<?php
/**************************************************
  Coppermine 1.5.x Plugin - thumb_rotate
  *************************************************
  Copyright (c) 2010 Timos-Welt (www.timos-welt.de)
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

function thumb_rotate_initialize() {
    global $CONFIG, $lang_plugin_thumb_rotate, $thumb_rotate_icon_array, $gd_extension_array;
    $superCage = Inspekt::makeSuperCage();
    $gd_extension_array = array('jpg', 'jpeg', 'gif', 'png');
    if (GALLERY_ADMIN_MODE) {
        global $JS;
        $JS['includes'][] = 'plugins/thumb_rotate/js/farbtastic.js';
        $JS['includes'][] = 'js/jquery.spinbutton.js';
    }

    require "./plugins/thumb_rotate/lang/english.php";
    if ($CONFIG['lang'] != 'english' && file_exists("./plugins/thumb_rotate/lang/{$CONFIG['lang']}.php")) {
        require "./plugins/thumb_rotate/lang/{$CONFIG['lang']}.php";
    }
    if ($CONFIG['enable_menu_icons'] == 2) {
        $thumb_rotate_icon_array['thumb_rotate'] = '<img src="./plugins/thumb_rotate/images/icons/thumb_rotate.png" width="16" height="16" border="0" alt="" class="icon" />';
        $thumb_rotate_icon_array['config'] = '<img src="./plugins/thumb_rotate/images/icons/config.png" width="16" height="16" border="0" alt="" class="icon" />';
        $thumb_rotate_icon_array['batch'] = '<img src="./plugins/thumb_rotate/images/icons/batch.png" width="16" height="16" border="0" alt="" class="icon" />';
    } else {
        $thumb_rotate_icon_array['thumb_rotate'] = '';
        $thumb_rotate_icon_array['config'] = '';
        $thumb_rotate_icon_array['batch'] = '';
    }
    if ($CONFIG['enable_menu_icons'] >= 1) {
        $thumb_rotate_icon_array['config_menu'] = '<img src="./plugins/thumb_rotate/images/icons/thumb_rotate_config.png" width="16" height="16" border="0" alt="" class="icon" />';
    } else {
        $thumb_rotate_icon_array['config_menu'] = '';
    }
    $thumb_rotate_icon_array['announcement'] = cpg_fetch_icon('announcement', 1);
    $thumb_rotate_icon_array['plugin_manager'] = cpg_fetch_icon('plugin_mgr', 2);
    $thumb_rotate_icon_array['ok'] = cpg_fetch_icon('ok', 2);
    $thumb_rotate_icon_array['cancel'] = cpg_fetch_icon('cancel', 2);
    $thumb_rotate_icon_array['next'] = cpg_fetch_icon('right', 2);
    $return['language'] = $lang_plugin_thumb_rotate;
    $return['icon'] = $thumb_rotate_icon_array;
    return $return;
}
?>