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

$thisplugin->add_action('page_start', 'favorite_mailer_button');
$thisplugin->add_filter('page_html', 'favorite_mailer_form');

function favorite_mailer_button() {
    $superCage = Inspekt::makeSuperCage();

    if ($superCage->get->getAlpha('album') == 'favpics') {
        global $lang_meta_album_names;
        $lang_meta_album_names['favpics'] .= ' <a href="contact.php?fm_mail" title="Send favorites to admin">'.cpg_fetch_icon('contact', 2).'</a>';
    }
}

function favorite_mailer_form($html) {
    $superCage = Inspekt::makeSuperCage();

    if ($superCage->get->keyExists('fm_mail')) {
        global $CONFIG, $FAVPICS;

        foreach ($FAVPICS as $pid) {
            $fav_pics .= $CONFIG['ecards_more_pic_target']."displayimage.php?pid=$pid \n\n";
        }

        if ($fav_pics) {
            $html = str_replace('<textarea name="message" cols="50" rows="10" class="textinput"></textarea>', '<textarea name="message" cols="50" rows="10" class="textinput">'.$fav_pics.'</textarea>', $html);
        }
    }

    return $html;
}

?>