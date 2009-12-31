<?php
/**
 * Coppermine Photo Gallery
 *
 * Copyright (c) 2003-2009 Coppermine Dev Team
 * v1.1 originally written by Gregory DEMAR
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * Coppermine version: 1.5.xx
 *
 * LightBox plugin ver 1.0 for Coppermine
 *
 * Plugin Written by Joe Carver - http://gallery.josephcarver.com/natural/ - http://i-imagine.net/artists/ - http://photos-by.joe-carver.com/
 * Based on plugin by jeepguy_1980 and mod. by Sander Weyens
 * 27 December 2009
 * 
 *  Using NFLightbox Copyright (c) 2009, Helori LAMBERTY NotesFor.net
 *
*/

define("IN_COPPERMINE", true);
global $CONFIG, $USER;
// only count if not in admin mode 
if (!GALLERY_ADMIN_MODE) {

  // init pid variable
  $enlcnt_pid = '';

  // create Inspekt instance to sanitize data
  $enlcnt_superCage = Inspekt::makeSuperCage();

  // check if GET variable a exists
  if ($enlcnt_superCage->get->keyExists('a'))
  {
    // if yes, get Variable a
    $pid = $enlcnt_superCage->get->getInt('a');

   // increase pic counter in database
    if ((!USER_IS_ADMIN && $CONFIG['count_admin_hits'] == 0 || $CONFIG['count_admin_hits'] == 1) && !in_array($pid, $USER['liv']) && $superCage->cookie->keyExists($CONFIG['cookie_name'] . '_data')) {
        add_hit($pid);
        if (count($USER['liv']) > 4) array_shift($USER['liv']);
        array_push($USER['liv'], $pid);
    }
  }
}

?>