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

require('./plugins/image_manipulation/init.inc.php');

  
$name = 'Ten Times';
$description = 'Allows a visitor to view 10 files, then forces registration or login';
$author = 'Timo Schewe (<a href="http://www.timos-welt.de/" rel="external" class="external">Timos-Welt</a>)';
$version = '1.1';
$plugin_cpg_version = array('min' => '1.5');
if ($CONFIG['allow_user_registration']) $install_info = '';
else $install_info = 'YOU MUST ENABLE REGISTRATION OF NEW USERS TO MAKE THIS PLUGIN WORK!';
if ($CONFIG['allow_user_registration']) $extra_info = '';
else $extra_info = 'YOU MUST ENABLE REGISTRATION OF NEW USERS TO MAKE THIS PLUGIN WORK!';

?>
