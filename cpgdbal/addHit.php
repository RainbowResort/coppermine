<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2008 Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.
  
  ********************************************
  Coppermine version: 1.5.0
  $HeadURL$
  $Revision: 4502 $
  $LastChangedBy: pvanrompay $
  $Date: 2008-06-06 03:51:20 +0530 (Fri, 06 Jun 2008) $
**********************************************/

define('IN_COPPERMINE', true);

require('include/init.inc.php');

/**
 * Clean up GPC and other Globals here
 */
 $pid = $superCage->get->getInt('pid');

if ($pid && !GALLERY_ADMIN_MODE && $CONFIG['slideshow_hits'] != 0) {
    // Add 1 to hit counter
    if (!in_array($pid, $USER['liv']) && $superCage->cookie->keyExists($CONFIG['cookie_name'] . '_data')) {
        add_hit($pid);
        if (count($USER['liv']) > 4) array_shift($USER['liv']);
        array_push($USER['liv'], $pid);
        user_save_profile();
    }
}

?>