<?php
/**************************************************
  Coppermine 1.5.x Plugin - move_to_public
  *************************************************
  Copyright (c) 2010 Borzoo Mossavari (Sami)
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

if (!defined('IN_COPPERMINE')) { 
    die('Not in Coppermine...');
}

$lang_plugin_move_to_public['name'] = 'Move2Public'; // Display Name
$lang_plugin_move_to_public['admin_title'] = 'Move2Public'; // Title of the button on the gallery admin menu
$lang_plugin_move_to_public['description'] = 'Move2Public gives the admin the ability to move albums inside user galleries into public (admin-created) categories.';
$lang_plugin_move_to_public['announcement_thread'] = 'Announcement thread';
$lang_plugin_move_to_public['install_info'] = 'The plugin will add a new button to the admin menu that allows the admin to move albums easily.';
$lang_plugin_move_to_public['default_behaviour_explain'] = 'By default, albums will be moved to the latest category (with the highest category ID). Ownership will be given to the user with the lowest "user_id" (which should be the admin in most cases), if you don\'t choose another user.';
$lang_plugin_move_to_public['no_user_albums_available'] = 'No user albums available!';
$lang_plugin_move_to_public['move_to_public'] = 'Move to public';
$lang_plugin_move_to_public['status'] = 'status';
$lang_plugin_move_to_public['choose'] = 'choose';
$lang_plugin_move_to_public['user'] = 'User';
$lang_plugin_move_to_public['album'] = 'Album';
$lang_plugin_move_to_public['move_to_category'] = 'Move to category';
$lang_plugin_move_to_public['moved_to_category'] = 'Moved to category';
$lang_plugin_move_to_public['take_ownership'] = 'Take ownership';
$lang_plugin_move_to_public['enable'] = 'Enable';
$lang_plugin_move_to_public['no_album_selected'] = 'No album selected!';
$lang_plugin_move_to_public['move_more_albums_to_public'] = 'Move more albums to public';
$lang_plugin_move_to_public['failure'] = 'failure';
$lang_plugin_move_to_public['album_properties'] = 'Album properties';

?>