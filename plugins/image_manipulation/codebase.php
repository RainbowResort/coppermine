<?php
/**************************************************
  Coppermine 1.5.x Plugin - Image manipulation $VERSION$=0.5
  *************************************************
  Copyright (c) 2009 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  ***************************************************/

  
if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');


// Add jsquery plugin mousewheel
$thisplugin->add_action('page_start','include_js_maniplug');


function include_js_maniplug() {
  global $JS, $CONFIG;
  if (defined('DISPLAYIMAGE_PHP')) 
  {  
    $JS['includes'][] = "./plugins/image_manipulation/myslider.js";
    if (file_exists("./plugins/image_manipulation/pixastic_{$CONFIG['lang']}.js")) 
    {
      $JS['includes'][] = "./plugins/image_manipulation/pixastic_{$CONFIG['lang']}.js";
    }
    else
    {
      $JS['includes'][] = "./plugins/image_manipulation/pixastic_english.js";
    }
  }
}

?>