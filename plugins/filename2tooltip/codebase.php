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
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
  **************************************************/

  
if (!defined('IN_COPPERMINE')) {
    die('Not in Coppermine...');
}

// Add filter for html thumb title
$thisplugin->add_filter('thumb_html_title','modify_title');

// Add filter for html filmstrip thumb title
$thisplugin->add_filter('thumb_strip_html_title','modify_strip_title');


function modify_title($row_data)
{
    // replace standard tooltip with pic title
    if ($row_data[1]['title']) {
        return $row_data[1]['title'];
    } else {
        return $row_data[1]['filename'];
    }
}

function modify_strip_title($row_data)
{
    // replace standard tooltip with pic title
    if ($row_data[1]['title']) {
        return $row_data[1]['title'];
    } else {
        return $row_data[1]['filename'];
    }
}


?>