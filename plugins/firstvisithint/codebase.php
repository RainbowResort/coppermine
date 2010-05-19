<?php
/**************************************************
  Coppermine 1.5.x Plugin - firstvisithint
  *************************************************
  Copyright (c) 2010 Timo Schewe (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/branches/cpg1.5.x/plugins/tentimes/codebase.php $
  $Revision: 7101 $
  $LastChangedBy: timoswelt $
  $Date: 2010-01-20 13:54:24 +0100 (Mi, 20 Jan 2010) $
  **************************************************/

  
if (!defined('IN_COPPERMINE')) {
	die('Not in Coppermine...');
}

$thisplugin->add_action('page_start','firstvisithint_include_js'); // Add js files

function firstvisithint_include_js() 
{
    global $JS;
    if (!USER_ID && !GALLERY_ADMIN_MODE)
    {
            $JS['includes'][] = "./plugins/firstvisithint/js/firstvisithint.js";
    }
}

?>