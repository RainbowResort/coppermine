<?php
/**************************************************
  Coppermine 1.5.x Plugin - Mouse wheel support for filmstrip $VERSION$=0.1
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
$thisplugin->add_action('page_start','include_js_wheelplug');


function include_js_wheelplug() {
  global $JS;
  if (defined('DISPLAYIMAGE_PHP')) {
    $JS['includes'][] = 'plugins/stripwheel/jquery.mousewheel.js';
    $JS['includes'][] = 'plugins/stripwheel/makewheel.js';
  }
}

?>