<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2008 Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  Coppermine version: 1.5.x
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**********************************************/
/*********************************************
  Coppermine Plugin - BBCode Control
  ********************************************
  Copyright (c) 2008-2009 eenemeenemuu
**********************************************/

global $CONFIG, $enabled_languages_array, $lang_gallery_admin_menu;
// language detection
$lang = isset($CONFIG['lang']) ? $CONFIG['lang'] : 'english';
include('plugins/bbcode_control/lang/english.php');
if (in_array($lang, $enabled_languages_array) == TRUE && file_exists('plugins/bbcode_control/lang/'.$lang.'.php')) {
    include('plugins/bbcode_control/lang/'.$lang.'.php');
}

$name = 'BBCode Control';
$version = '1.3';
$description = <<< EOT
<ul>
    <li>{$lang_plugin_bbcode_control['description_new_codes']}</li>
    <li>{$lang_plugin_bbcode_control['description_control_codes']}</li>
    <li>{$lang_plugin_bbcode_control['description_buttons']}</li>
    <li>{$lang_plugin_bbcode_control['show_in_file_info']}</li>
</ul>
EOT;
$author = '<a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=24278" rel="external" class="external">eenemeenemuu</a>';

$extra_info = <<<EOT
    <table border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td class="admin_menu">
                <a href="http://forum.coppermine-gallery.net/index.php/topic,57432.0.html" rel="external" class="external">Announcement thread for <strong>$name</strong> plugin</a>
            </td>
            <td>
                &nbsp;
            </td>
            <td class="admin_menu">
                <a href="index.php?file=bbcode_control/admin">$name {$lang_gallery_admin_menu['admin_lnk']}</a>
            </td>
        </tr>
    </table>
EOT;

$install_info=<<<EOT
    <table border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td>
                {$lang_plugin_bbcode_control['install_info']}
            </td>
        </tr>
        <tr>
            <td>
                &nbsp;
            </td>
        </tr>
        <tr>
            <td>
                <a href="http://forum.coppermine-gallery.net/index.php/topic,57432.0.html" rel="external" class="external">Announcement thread for <strong>$name</strong> plugin</a>
            </td>
        </tr>
    </table>
EOT;
?>