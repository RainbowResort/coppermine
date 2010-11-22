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
 * 28 January 2010
*/

require_once('init.inc.php');
GLOBAL $flf_lang_var;
$return=flf_histotag_initialize();
$flf_lang_var=$return['language'];

$name=$flf_lang_var['name'];

$description=$flf_lang_var['description'];



$author='Florian Lechner (<a href="http://www.lounge-lizard.org/cms/" target="_blank" rel="external" class="external">www.lounge-lizard.org</a>)';

$extra_info = <<<EOT
<a href="index.php?file=flf_histotag/configure" class="admin_menu">{$flf_lang_var['config']}</a>	
<a href="index.php?file=flf_histotag/readme" class="admin_menu">{$flf_lang_var['readme']}</a>
<a href="index.php?file=flf_histotag/createall" class="admin_menu">{$flf_lang_var['getallgeo']}</a>
<a href="index.php?file=flf_histotag/createallhistograms" class="admin_menu">{$flf_lang_var['getallhistos']}</a>
<a href="index.php?file=flf_histotag/deleteallhistograms" class="admin_menu">{$flf_lang_var['deleteallhistograms']}</a>
<a href="http://forum.coppermine-gallery.net/index.php/topic,63486.0.html rel="external" class="admin_menu" target="_blank">{$flf_lang_var['supportthread']}</a>

EOT;


$version='1.4';
$plugin_cpg_version = array('min' => '1.5.10');

?>