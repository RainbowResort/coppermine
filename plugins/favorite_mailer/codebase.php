<?php
/**************************************************
  Coppermine 1.5.x Plugin - Favorite mailer
  *************************************************
  Copyright (c) 2009 eenemeenemuu
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

$thisplugin->add_action('page_start','favorite_mailer');

function favorite_mailer() {
    $superCage = Inspekt::makeSuperCage();

    if ($superCage->get->getAlpha('album') == 'favpics') {
        global $lang_meta_album_names;
        $lang_meta_album_names['favpics'] .= ' <a href="index.php?fm_mail" title="Send favorites to admin">'.cpg_fetch_icon('contact', 2).'</a>';
    }

    if ($superCage->get->keyExists('fm_mail')) {
        global $CONFIG, $FAVPICS;

        foreach ($FAVPICS as $pid) {
            $fav_pics .= $CONFIG['ecards_more_pic_target']."/displayimage.php?pid=$pid \n";
        }

        if ($fav_pics) {
            require('include/mailer.inc.php');
            cpg_mail('admin', 'Favorite mailer test', $fav_pics);
        }
    }

}



?>