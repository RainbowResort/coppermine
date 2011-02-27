<?php
/**************************************************
  Coppermine 1.5.x Plugin - FileMove
  *************************************************
  Copyright (c) 2003-2010 Coppermine Dev Team
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
  
if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...');}

// submit your lang file for this plugin on the coppermine forums
// plugin will try to use the configured language if it is available.

if (file_exists("./plugins/FileMove/lang/{$CONFIG['lang']}.php")) {
    require "./plugins/FileMove/lang/{$CONFIG['lang']}.php";
} 
else {
    require "./plugins/FileMove/lang/english.php";
}
?>