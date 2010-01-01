<?php
/**************************************************
  Coppermine 1.5.x Plugin - Mirror
  *************************************************
  Copyright (c) 2009 Timos-Welt (www.timos-welt.de)
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


// Add jsquery plugin mousewheel
$thisplugin->add_action('page_start','include_js_mirrorplug');


function include_js_mirrorplug() {
  global $JS;
  if (defined('DISPLAYIMAGE_PHP')) {
    $JS['includes'][] = 'plugins/mirror/mirror.js';
  }
}

?>