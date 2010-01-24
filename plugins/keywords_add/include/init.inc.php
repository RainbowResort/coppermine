<?php
/**************************************************
  Coppermine 1.5.x Plugin - keywords_add
  *************************************************
  Copyright (c) coppermine dev team
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/branches/cpg1.5.x/plugins/mirror/codebase.php $
  $Revision: 7039 $
  $LastChangedBy: gaugau $
  $Date: 2010-01-11 09:55:27 +0100 (Mo, 11. Jan 2010) $
  **************************************************/
  
if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...');}

// submit your lang file for this plugin on the coppermine forums
// plugin will try to use the configured language if it is available.

if (file_exists("plugins/keywords_add/lang/{$CONFIG['lang']}.php")) {
 	require "plugins/keywords_add/lang/{$CONFIG['lang']}.php";
} 
else {
	require "plugins/keywords_add/lang/english.php";
}
?>