<?php
/**************************************************
  Coppermine 1.5.x Plugin - flf_histotag
  *************************************************
  Copyright (c) 2010 Florian Lechner - www.lounge-lizard.org/cms
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
*/

function flf_histotag_initialize() {
    global $CONFIG, $flf_lang_var;
    $superCage = Inspekt::makeSuperCage();
    if (GALLERY_ADMIN_MODE) {
        global $JS;
        $JS['includes'][] = 'plugins/flf_histotag/js/farbtastic.js';
        $JS['includes'][] = 'js/jquery.spinbutton.js';
    }

    require "./plugins/flf_histotag/lang/english.php";
    if ($CONFIG['lang'] != 'english' && file_exists("./plugins/flf_histotag/lang/{$CONFIG['lang']}.php")) {
        require "./plugins/flf_histotag/lang/{$CONFIG['lang']}.php";
    }

    $return['language'] = $flf_lang_var;
 	
    return $return;
}
?>