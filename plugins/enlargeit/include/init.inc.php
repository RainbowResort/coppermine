<?php
/**************************************************
  Coppermine 1.5.x Plugin - EnlargeIt! $VERSION$=0.4
  *************************************************
  Copyright (c) 2009 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  Coppermine version: 1.5.2
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
  **************************************************/
  
if (!defined('IN_COPPERMINE')) { 
    die('Not in Coppermine...');
}

// submit your lang file for this plugin on the coppermine forums
// plugin will try to use the configured language if it is available.

if (file_exists("./plugins/enlargeit/lang/{$CONFIG['lang']}.php")) {
  require ("./plugins/enlargeit/lang/{$CONFIG['lang']}.php");
} else {
    require ("./plugins/enlargeit/lang/english.php");
}

if ($CONFIG['enable_menu_icons'] >= 1) {
    $enlargeit_icon_array['configure'] = '<img src="./plugins/enlargeit/images/icons/configure.png" border="0" width="16" height="16" alt="" class="icon" />';
    $enlargeit_icon_array['announcement'] = '<img src="./plugins/enlargeit/images/icons/announcement.png" border="0" width="16" height="16" alt="" class="icon" />';
} else {
    $enlargeit_icon_array['configure'] = '';
    $enlargeit_icon_array['announcement'] = '';
}
if ($CONFIG['enable_menu_icons'] == 2) {
    $enlargeit_icon_array['table'] = '<img src="./plugins/enlargeit/images/icons/enlargeit.png" border="0" width="16" height="16" alt="" class="icon" />';
    $enlargeit_icon_array['bbcode'] = '<img src="./plugins/enlargeit/images/icons/bbcode.png" border="0" width="16" height="16" alt="" class="icon" />';
    $enlargeit_icon_array['close'] = '<img src="./plugins/enlargeit/images/icons/close.png" border="0" width="16" height="16" alt="" class="icon" />';
    $enlargeit_icon_array['comment'] = '<img src="./plugins/enlargeit/images/icons/comment.png" border="0" width="16" height="16" alt="" class="icon" />';
    $enlargeit_icon_array['comments'] = '<img src="./plugins/enlargeit/images/icons/comments.png" border="0" width="16" height="16" alt="" class="icon" />';
    $enlargeit_icon_array['download'] = '<img src="./plugins/enlargeit/images/icons/download.png" border="0" width="16" height="16" alt="" class="icon" />';
    $enlargeit_icon_array['table'] = '<img src="./plugins/enlargeit/images/icons/enlargeit.png" border="0" width="16" height="16" alt="" class="icon" />';
    $enlargeit_icon_array['favorites'] = '<img src="./plugins/enlargeit/images/icons/favorites.png" border="0" width="16" height="16" alt="" class="icon" />';
    $enlargeit_icon_array['fullsize'] = '<img src="./plugins/enlargeit/images/icons/fullsize.png" border="0" width="16" height="16" alt="" class="icon" />';
    $enlargeit_icon_array['histogramm'] = '<img src="./plugins/enlargeit/images/icons/histogramm.png" border="0" width="16" height="16" alt="" class="icon" />';
    $enlargeit_icon_array['info'] = '<img src="./plugins/enlargeit/images/icons/info.png" border="0" width="16" height="16" alt="" class="icon" />';
    $enlargeit_icon_array['mail'] = '<img src="./plugins/enlargeit/images/icons/mail.png" border="0" width="16" height="16" alt="" class="icon" />';
    $enlargeit_icon_array['next'] = '<img src="./plugins/enlargeit/images/icons/next.png" border="0" width="16" height="16" alt="" class="icon" />';
    $enlargeit_icon_array['previous'] = '<img src="./plugins/enlargeit/images/icons/previous.png" border="0" width="16" height="16" alt="" class="icon" />';
    $enlargeit_icon_array['show'] = '<img src="./plugins/enlargeit/images/icons/show.png" border="0" width="16" height="16" alt="" class="icon" />';
    $enlargeit_icon_array['vote'] = '<img src="./plugins/enlargeit/images/icons/vote.png" border="0" width="16" height="16" alt="" class="icon" />';
} else {
    $enlargeit_icon_array['table'] = '';
    $enlargeit_icon_array['bbcode'] = '';
    $enlargeit_icon_array['close'] = '';
    $enlargeit_icon_array['comment'] = '';
    $enlargeit_icon_array['comments'] = '';
    $enlargeit_icon_array['download'] = '';
    $enlargeit_icon_array['table'] = '';
    $enlargeit_icon_array['favorites'] = '';
    $enlargeit_icon_array['fullsize'] = '';
    $enlargeit_icon_array['histogramm'] = '';
    $enlargeit_icon_array['info'] = '';
    $enlargeit_icon_array['mail'] = '';
    $enlargeit_icon_array['next'] = '';
    $enlargeit_icon_array['previous'] = '';
    $enlargeit_icon_array['show'] = '';
    $enlargeit_icon_array['vote'] = '';
}
$enlargeit_icon_array['ok'] = cpg_fetch_icon('ok', 0);
$enlargeit_icon_array['cancel'] = cpg_fetch_icon('cancel', 0);
$enlargeit_icon_array['stop'] = cpg_fetch_icon('stop', 0);

?>