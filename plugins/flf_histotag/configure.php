<?php
/**************************************************
  Coppermine 1.5.x Plugin - flf histotag
  *************************************************
  Copyright (c) 2010 Florian Lechner (www.lounge-lizard.org/cms)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************

  **************************************************/
 
// Initialize language and icons
require_once './plugins/flf_histotag/init.inc.php';

$flf_histotag_init_array = flf_histotag_initialize();
$flf_lang_var = $flf_histotag_init_array['language']; 
// $flf_histotag_icon_array = $flf_histotag_init_array['icon'];
// Configuration
pageheader($flf_lang_var['config']);
flf_histotag_configure();
pagefooter();
die;
?>