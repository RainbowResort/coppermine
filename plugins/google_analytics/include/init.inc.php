<?php
/*************************
  Coppermine 1.4 Plugin - Google Anylytics
  ************************
  Copyright (c) 2009
  
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  Coppermine version: 1.4
  $Author: papukaija $
**********************************************/

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...');}

// submit your lang file for this plugin on the coppermine forums
// plugin will try to use the configured language if it is available.

if (file_exists("plugins/google_analytics/lang/{$CONFIG['lang']}.php")) {
  require "plugins/google_analytics/lang/{$CONFIG['lang']}.php";
} else require 'plugins/google_analytics/lang/english.php';
?>