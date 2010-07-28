<?php
/**************************************************
  Coppermine 1.5.x Plugin - Form token modifier
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

$name = 'Form token modifier';
$description = 'Adds client side values (ip address and browser agent) to the form token generator. This generates a super secure form token.';
$author = '<a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=24278" rel="external" class="external">eenemeenemuu</a>';
$version = '2.0';
$plugin_cpg_version = array('min' => '1.5.7');
$extra_info = $install_info = '<a href="http://forum.coppermine-gallery.net/index.php/topic,66044.0.html" rel="external" class="admin_menu">'.cpg_fetch_icon('announcement', 1).'Announcement thread</a>';

?>
