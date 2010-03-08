<?php
/**************************************************
  Coppermine 1.5.x Plugin - final_extract
  *************************************************
  Copyright (c) 2009 Donnovan Bray
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

if (file_exists("plugins/final_extract/lang/{$CONFIG['lang']}.php")) {
  require "plugins/final_extract/lang/{$CONFIG['lang']}.php";
} else {require "plugins/final_extract/lang/english.php";}

$name = 'Final_Extract';
$description = 'Removes specified template blocks from final output with Usergroup Option';
$author = <<< EOT
    Donnoman@donovanbray.com from cpg-contrib.org<br />
    Modified by: <a href="http://www.myprj.com/" rel="external" class="external">Borzoo Mossavari</a> (aka Sami)<br />
    Modified by: Frantz
EOT;
$extra_info .= 'Configure this plugin using the admin menu item <a href="index.php?file=final_extract/admin" class="admin_menu">Final extract</a>';
$version = '2.5';
$plugin_cpg_version = array('min' => '1.5');
$final_extract_icon_array['ok'] = cpg_fetch_icon('ok', 1); 
?>
