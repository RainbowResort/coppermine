<?php
/**************************************************
  Coppermine 1.5.x Plugin - move_to_public
  *************************************************
  Copyright (c) 2010 Borzoo Mossavari (Sami)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/branches/cpg1.5.x/plugins/slider/codebase.php $
  $Revision: 6994 $
  $LastChangedBy: timoswelt $
  $Date: 2010-01-04 10:54:19 +0100 (Mo, 04. Jan 2010) $
  **************************************************/

if (!defined('IN_COPPERMINE')) {
    die('Not in Coppermine...');
}

function move_to_public_initialize() {
    global $CONFIG, $JS, $lang_plugin_move_to_public, $move_to_public_icon_array;
    $superCage = Inspekt::makeSuperCage();
    if (in_array('js/jquery.spinbutton.js', $JS['includes']) != TRUE) {
        $JS['includes'][] = 'js/jquery.spinbutton.js';
    }
    if (in_array('plugins/move_to_public/js/script.js', $JS['includes']) != TRUE) {
        $JS['includes'][] = 'plugins/move_to_public/js/script.js';
    }
    
    require_once "./plugins/move_to_public/lang/english.php";
    if ($CONFIG['lang'] != 'english' && file_exists("./plugins/move_to_public/lang/{$CONFIG['lang']}.php")) {
        require_once "./plugins/move_to_public/lang/{$CONFIG['lang']}.php";
    }

    if ($CONFIG['enable_menu_icons'] >= 1) {
        $move_to_public_icon_array['menu'] = '<img src="./plugins/move_to_public/images/icons/move.png" border="0" width="16" height="16" alt="" class="icon" />';
    } else {
        $move_to_public_icon_array['menu'] = '';
    }
    $move_to_public_icon_array['announcement'] = cpg_fetch_icon('announcement', 1);
    $move_to_public_icon_array['ok'] = cpg_fetch_icon('ok', 0);
    $move_to_public_icon_array['cancel'] = cpg_fetch_icon('cancel', 0);
    $move_to_public_icon_array['stop'] = cpg_fetch_icon('stop', 0);
    $return['language'] = $lang_plugin_move_to_public;
    $return['icon'] = $move_to_public_icon_array;
    return $return;
}
?>