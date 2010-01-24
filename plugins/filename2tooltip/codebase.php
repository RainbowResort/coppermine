<?php
/**************************************************
  Coppermine 1.5.x Plugin - filename2tooltip
  *************************************************
  Copyright (c) 2010 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/branches/cpg1.5.x/plugins/better_tooltip/codebase.php $
  $Revision: 7120 $
  $LastChangedBy: gaugau $
  $Date: 2010-01-24 21:57:04 +0100 (So, 24. Jan 2010) $
  **************************************************/

  
if (!defined('IN_COPPERMINE')) 
    die('Not in Coppermine...');
}

// Add filter for html thumb title
$thisplugin->add_filter('thumb_html_title','modify_title');

function modify_title($row_data)
{
    // replace standard tooltip with pic title
    if ($row_data[1]['title']) {
        return $row_data[1]['title'];
    } else {
        return $row_data[1]['filename'];
    }
}


?>