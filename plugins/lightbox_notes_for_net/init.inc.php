<?php
/**************************************************
  Coppermine 1.5.x Plugin - lightbox_notes_for_net!
  *************************************************
  Copyright (c) 2009 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/branches/cpg1.5.x/plugins/lightbox_notes_for_net/init.inc.php $
  $Revision: 6862 $
  $LastChangedBy: gaugau $
  $Date: 2009-12-14 19:22:52 +0100 (Mo, 14. Dez 2009) $
  **************************************************/
  
if (!defined('IN_COPPERMINE')) { 
    die('Not in Coppermine...');
}

// Define the default language array (English)
require_once ("./plugins/lightbox_notes_for_net/lang/english.php");
// submit your lang file for this plugin on the coppermine forums
// plugin will try to use the configured language if it is available.
if (file_exists("./plugins/lightbox_notes_for_net/lang/{$CONFIG['lang']}.php")) {
    require_once ("./plugins/lightbox_notes_for_net/lang/{$CONFIG['lang']}.php");
} 

// Determine the help file link
if (file_exists("./plugins/lightbox_notes_for_net/docs/{$CONFIG['lang']}.htm")) {
    $documentation_file = $CONFIG['lang'];
} else {
    $documentation_file = 'english';
}

if ($CONFIG['enable_menu_icons'] >= 1) {
    $lightbox_notes_for_net_icon_array['configure'] = '<img src="./plugins/lightbox_notes_for_net/images/icons/configure.png" border="0" width="16" height="16" alt="" class="icon" />';
} else {
    $lightbox_notes_for_net_icon_array['configure'] = '';
}

if ($CONFIG['enable_menu_icons'] == 2) {
    $lightbox_notes_for_net_icon_array['table'] = '<img src="./plugins/lightbox_notes_for_net/images/icons/lightbox_notes_for_net.png" border="0" width="16" height="16" alt="" class="icon" />';
} else {
    $lightbox_notes_for_net_icon_array['table'] = '';
}

$lightbox_notes_for_net_icon_array['ok'] = cpg_fetch_icon('ok', 0);
$lightbox_notes_for_net_icon_array['cancel'] = cpg_fetch_icon('cancel', 0);
$lightbox_notes_for_net_icon_array['stop'] = cpg_fetch_icon('stop', 0);
$lightbox_notes_for_net_icon_array['announcement'] = cpg_fetch_icon('announcement', 1);
$lightbox_notes_for_net_icon_array['documentation'] = cpg_fetch_icon('documentation', 1);
?>