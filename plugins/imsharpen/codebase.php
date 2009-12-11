<?php
/**************************************************
  Coppermine 1.5.x Plugin - Sharpen Intermediate $VERSION$=0.2
  *************************************************
  Copyright (c) 2009 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  ***************************************************/

  
if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

// Add filter for resizing images
$thisplugin->add_filter('image_sharpen','imsharpen_sharpen');

function imsharpen_sharpen($new_size)
{
    global $CONFIG;
    $sharpen = 0;
    if ($CONFIG['picture_width'] == $new_size || $CONFIG['thumb_width'] == $new_size) $sharpen = 1;
    return $sharpen;
}


?>