<?php
/**************************************************
  Coppermine 1.5.x Plugin - skype_demarkup
  *************************************************
  Copyright (c) 2010 eenemeenemuu
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

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

$thisplugin->add_action('page_start', 'skype_demarkup_js');
function skype_demarkup_js() {
    js_include('plugins/skype_demarkup/demark.js');
}

$thisplugin->add_filter('page_meta', 'skype_demarkup_meta');
function skype_demarkup_meta($meta) {
    return $meta.'<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />';
}


?>
