<?php
/**************************************************
  Coppermine 1.5.x Plugin - Image manipulation
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
  
if (!defined('IN_COPPERMINE')) { 
    die('Not in Coppermine...');
}

// Define the default language array (English)
require ("./plugins/image_manipulation/lang/english.php");
// submit your lang file for this plugin on the coppermine forums
// plugin will try to use the configured language if it is available.
if (file_exists("./plugins/image_manipulation/lang/{$CONFIG['lang']}.php")) {
    require ("./plugins/image_manipulation/lang/{$CONFIG['lang']}.php");
} 

// Determine the help file link
if (file_exists("./plugins/image_manipulation/docs/{$CONFIG['lang']}.htm")) {
    $documentation_file = $CONFIG['lang'];
} else {
    $documentation_file = 'english';
}

?>