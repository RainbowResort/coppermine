<?php
/*********************************************
  Coppermine 1.5.x Plugin - External tracker
  ********************************************
  Copyright (c) 2009 - 2010 papukaija
  
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  $HeadURL$
  $Revision$
**********************************************/
if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...');}

require './plugins/external_tracker/lang/english.php';
if ($CONFIG['lang'] != 'english' && file_exists("./plugins/external_tracker/lang/{$CONFIG['lang']}.php")) {
    require "./plugins/external_tracker/lang/{$CONFIG['lang']}.php";
}
// Determine the help file link
if (file_exists("./plugins/external_tracker/docs/{$CONFIG['lang']}.html")) {
    $doc_lng = $CONFIG['lang'];
} else {
    $doc_lng = 'english';
}
?>
