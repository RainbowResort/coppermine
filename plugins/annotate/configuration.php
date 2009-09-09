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
  Coppermine Plugin - Picture Annotation
  ********************************************
  Created by Nibbler for cpg1.4.x - ported to cpg1.5.x by eenemeenemuu 
**********************************************/

$name='Picture Annotation';
$description='Add text annotations to your images';
$author = 'Created by <a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=941" rel="external" class="external">Nibbler</a> for cpg1.4.x - ported to cpg1.5.x by <a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=24278" rel="external" class="external">eenemeenemuu</a>';
$version = '1.7';
$install_info = <<<EOT
    <table border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td class="admin_menu">
                <a href="http://forum.coppermine-gallery.net/index.php/topic,60622.0.html" rel="external" class="external">Announcement thread for <strong>$name</strong> plugin</a>
            </td>
        </tr>
    </table>
EOT;
$extra_info = <<<EOT
    <table border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td class="admin_menu">
                <a href="http://forum.coppermine-gallery.net/index.php/topic,60622.0.html" rel="external" class="external">Announcement thread for <strong>$name</strong> plugin</a>
            </td>
            <td>
                &nbsp;
            </td>
            <td class="admin_menu">
                <a href="index.php?plugin=annotate&delete_orphans">Delete orphaned entries</a>
            </td>
        </tr>
    </table>
EOT;

?>