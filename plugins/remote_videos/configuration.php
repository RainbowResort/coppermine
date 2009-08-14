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
  Coppermine Plugin - Remote Videos
  ********************************************
  Copyright (c) 2009 eenemeenemuu
**********************************************/

$name = 'Remote Videos';
$description = 'Upload videos from video file hosters to your gallery (YouTube, Google, Yahoo!, ...)';
$author = '<a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=24278" rel="external" class="external">eenemeenemuu</a>';
$version = '1.1';

$extra_info = <<<EOT
    <table border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td class="admin_menu">
                <a href="http://forum.coppermine-gallery.net/index.php/topic,60195.0.html" rel="external" class="external">Announcement thread for <strong>$name</strong> plugin</a>
            </td>
            <td>
                &nbsp;
            </td>
            <td class="admin_menu">
                <a href="index.php?file=remote_videos/admin">$name {$lang_gallery_admin_menu['admin_lnk']}</a>
            </td>
        </tr>
    </table>
EOT;


$install_info = <<<EOT
    <table border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td class="admin_menu">
                <a href="http://forum.coppermine-gallery.net/index.php/topic,60195.0.html" rel="external" class="external">Announcement thread for <strong>$name</strong> plugin</a>
            </td>
        </tr>
    </table>
    <strong>Please consider your country's law, if you are liable when embedding content.</strong>
EOT;

?>
