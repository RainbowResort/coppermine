<?php
/********************************************************
  Coppermine 1.5.x plugin - file_move
  *******************************************************
  Copyright (c) 2003-2009 François Keller
  *******************************************************
  This program is free software; you can redistribute 
  it and/or modify it under the terms of the GNU General
  Public License as published by the Free Software
  Foundation; either version 3 of the License, or 
  (at your option) any later version.
  *******************************************************
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
  *******************************************************/
  
if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...');}

// submit your lang file for this plugin on the coppermine forums
// plugin will try to use the configured language if it is available.

if (file_exists("plugins/file_move/lang/{$CONFIG['lang']}.php")) {
 	require "plugins/file_move/lang/{$CONFIG['lang']}.php";
} 
else {
	require "plugins/file_move/lang/english.php";
}
?>