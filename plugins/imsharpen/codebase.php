<?php
/**************************************************
  Coppermine 1.5.x Plugin - Sharpen Intermediate
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

  
if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

// Add filter for resizing images
$thisplugin->add_filter('image_sharpen','imsharpen_sharpen');

function imsharpen_sharpen($new_size) {
    global $CONFIG;
    $new_size = $new_size[1];
    if ($CONFIG['picture_width'] == $new_size || $CONFIG['thumb_width'] == $new_size) {
        $sharpen = 1;
    } else {
        $sharpen = 0;
    }
    return array($sharpen);
}


?>