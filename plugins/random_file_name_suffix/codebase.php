<?php
/**************************************************
  Coppermine 1.5.x Plugin - Random File Name Suffix
  *************************************************
  Copyright (c) 2011-2012 eenemeenemuu
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

$thisplugin->add_filter('upload_file_name', 'rfns_upload_file_name');

function rfns_upload_file_name($picture_name) {

    $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $suffix = '_';
    for ($i = 0; $i < 8; $i++) {
        $suffix .= $characters[mt_rand(0, strlen($characters)-1)];
    }

    $picture_name_parts = explode(".", $picture_name);
    $count = count($picture_name_parts);
    $picture_name_parts[$count] = $picture_name_parts[$count-1];
    $picture_name_parts[$count-1] = $suffix;
    $picture_name = implode(".", $picture_name_parts);

    return $picture_name;
}

?>