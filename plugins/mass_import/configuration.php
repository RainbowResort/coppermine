<?php
/*************************
  mass_import Plugin for cpg1.5.x
  ************************
  Copyright (c) 2003-2009 Coppermine Dev Team
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

$name = 'Mass Import';
$description = 'Mass Import gives the admin the ability to import large numbers of pictures organized by directory structure.';
$author = '<a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=941">Nibbler</a>, ';
$author.= '<a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=10059">Donnoman</a> (<a href="http://cpg-contrib.org">cpg-contrib.org</a>), ';
$author.= '<a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=15025">Flux</a>, ';
$author.= '<a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=23938">Paul Van Rompay</a>, ';
$author.= '<a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=2">Joachim Müller</a>';
$version = '3.1';
$extra_info = <<<EOT
    <a href="http://forum.coppermine-gallery.net/index.php/topic,61281.0.html" class="admin_menu">Announcement thread</a>&nbsp;
    <a href="index.php?file=mass_import/import" class="admin_menu">Mass Import</a>
EOT;
$install_info = <<<EOT
    The mass import works similarly to the batch-add process, but it allows you to add an entire structure of folders, subfolders and files to be added in one go. The plugin will create categories and albums that correspond to the folder names. It will then loop though the files in the structure and batch-add them to the database and create the resized images.<br />Use this plugin as well if you have issues with the regular batch-add process consuming too many resources.<br />&nbsp;<br /><a href="http://forum.coppermine-gallery.net/index.php/topic,61281.0.html" class="admin_menu">Announcement thread</a>&nbsp;
EOT;
?>