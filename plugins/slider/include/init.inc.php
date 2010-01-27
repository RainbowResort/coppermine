<?php
/**************************************************
  Coppermine 1.4.x Plugin - Slider $VERSION$=2.15
  *************************************************
  Copyright (c) 2008 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  ***************************************************
  Based on a mod by pbasmo, you can find it in this thread:
  http://coppermine-gallery.net/forum/index.php?topic=41197.0
  ***************************************************/
  
if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...');}

// submit your lang file for this plugin on the coppermine forums
// plugin will try to use the configured language if it is available.

if (file_exists("./plugins/slider/lang/{$CONFIG['lang']}.php")) {
  require "./plugins/slider/lang/{$CONFIG['lang']}.php";
} else {require "./plugins/slider/lang/english.php";}

?>