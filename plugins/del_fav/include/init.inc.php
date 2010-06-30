<?php
/**************************************************
  Coppermine 1.4.x Plugin - Delete Favorite 
  *************************************************
  Copyright (c) 2006 Borzoo Mossavari
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  *************************************************
  Delete all your favorite file with just one click !
  ***************************************************/
  
if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...');}

// submit your lang file for this plugin on the coppermine forums
// plugin will try to use the configured language if it is available.

if (file_exists("plugins/del_fav/lang/{$CONFIG['lang']}.php")) {
  require "plugins/del_fav/lang/{$CONFIG['lang']}.php";
} else {require "plugins/del_fav/lang/english.php";}
?>