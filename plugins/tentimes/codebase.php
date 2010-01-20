<?php
/**************************************************
  Coppermine 1.5.x Plugin - tentimes
  *************************************************
  Copyright (c) 2010 Timo Schewe (www.timos-welt.de)
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

$thisplugin->add_action('page_start','tentimes_include_js'); // Add js files

function tentimes_include_js() 
{
    global $JS, $CONFIG, $CPG_PHP_SELF;
    if (!USER_ID && !GALLERY_ADMIN_MODE && $CONFIG['allow_user_registration'])
    {
        $tentimes_pages_array = array('displayimage.php');
	      if (in_array($CPG_PHP_SELF, $tentimes_pages_array) == TRUE) {  
            $JS['includes'][] = "./plugins/tentimes/js/tentimes.js";
        }
    }
}

?>