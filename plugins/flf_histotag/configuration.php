<?php
/**
 * Coppermine Photo Gallery
 *
 * Copyright (c) 2003-2009 Coppermine Dev Team
 * v1.1 originally written by Gregory DEMAR
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * Coppermine version: 1.5.xx
 *
 * Plugin Written by Florian Lechner - http://www.lounge-lizard.org/cms
 * 
 * 16 January 2010
*/

$name='flf histotag - geotag and histogram support for Coppermine';

$description='Adds full geotagging and histogram support for Coppermine, includes link to Googlemaps';


$author='Florian Lechner';
$extra_info = <<<EOT
<a href="index.php?file=flf_histotag/flf_histotag_config" class="admin_menu">Configure flf histotag Plugin</a>	
<a href="index.php?file=flf_histotag/readme" class="admin_menu">Plugin Readme File</a>
<a href="index.php?file=flf_histotag/createall" class="admin_menu">Gather exif from all files!</a>
<a href="index.php?file=flf_histotag/createallhistograms" class="admin_menu">Generate all histograms (DANGER!)</a>

EOT;


$version='1.0';
$plugin_cpg_version = array('min' => '1.5');

?>