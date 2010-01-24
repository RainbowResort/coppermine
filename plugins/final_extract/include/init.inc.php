<?php
/**************************************************
  Coppermine 1.5.x Plugin - final_extract
  *************************************************
  Copyright (c) 2009 Donnovan Bray
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/branches/cpg1.5.x/plugins/image_manipulation/admin.php $
  $Revision: 7043 $
  $LastChangedBy: gaugau $
  $Date: 2010-01-11 19:26:53 +0100 (Mo, 11. Jan 2010) $
  **************************************************/
  
if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...');}

// submit your lang file for this plugin on the coppermine forums
// plugin will try to use the configured language if it is available.

if (file_exists("plugins/final_extract/lang/{$CONFIG['lang']}.php")) {
  require "plugins/final_extract/lang/{$CONFIG['lang']}.php";
} else {require "plugins/final_extract/lang/english.php";}
?>