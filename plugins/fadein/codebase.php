<?php
/**************************************************
  Coppermine 1.5.x Plugin - Fade in
  *************************************************
  Copyright (c) 2012 eenemeenemuu
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

$thisplugin->add_filter('file_data', 'fadein_file_data');
function fadein_file_data($CURRENT_PIC_DATA) {
    global $CONFIG;
    $fadetime = 750; // in ms
    if ($CONFIG['transparent_overlay']) {
        $CURRENT_PIC_DATA['html'] = str_replace('<td ', '<td style="opacity: 0;" id="background_picture"" ', $CURRENT_PIC_DATA['html']);
        $CURRENT_PIC_DATA['html'] = str_replace('<img ', '<img onload="jQuery(\'#background_picture\').fadeTo('.$fadetime.', 1);" ', $CURRENT_PIC_DATA['html']);
    } else {
        $CURRENT_PIC_DATA['html'] = str_replace('<img ', '<img style="opacity: 0;" onload="jQuery(this).fadeTo('.$fadetime.', 1);" ', $CURRENT_PIC_DATA['html']);
    }
    return $CURRENT_PIC_DATA;
}

?>