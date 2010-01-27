<?php
/**************************************************
  Coppermine Plugin - Advanced Caption
  *************************************************
  Copyright (c) 2006 Paul Van Rompay
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
***************************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

// ------------------------------------------------------------------------------------------------
// Add filters - process search album and add to search results page
// ------------------------------------------------------------------------------------------------
$thisplugin->add_filter('thumb_caption_favpics','advcap_simplify');
$thisplugin->add_filter('thumb_caption_lastup','advcap_simplify');
$thisplugin->add_filter('thumb_caption_lastupby','advcap_simplify');
$thisplugin->add_filter('thumb_caption_lastalb','advcap_simplify');

// ------------------------------------------------------------------------------------------------
// Remove date from 'favpics' thumbnails
// ------------------------------------------------------------------------------------------------
function advcap_simplify ($rowset) {
	build_caption($rowset);
	return $rowset;
}

// ------------------------------------------------------------------------------------------------
// End of plugin code
// ------------------------------------------------------------------------------------------------

?>
