<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2005 Coppermine Dev Team
  v1.1 originaly written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  ********************************************
  Coppermine version: 1.5.12
  $Source: /cvsroot/cpg-contrib/master_template/codebase.php,v $
  $Revision: 2.1 $
  $Author: donnoman $
  $Date: 2011/01/17 05:46:49 $
**********************************************/
/**********************************************
Modified By BMossavari 
- Add menu option to remove each part
- Add config page
**********************************************/
  
if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...');}

// submit your lang file for this plugin on the coppermine forums
// plugin will try to use the configured language if it is available.

if (file_exists("plugins/update_history/lang/{$CONFIG['lang']}.php")) {
  require "plugins/update_history/lang/{$CONFIG['lang']}.php";
} else {require "plugins/update_history/lang/english.php";}
?>
