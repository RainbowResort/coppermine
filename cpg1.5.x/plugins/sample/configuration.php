<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2007 Coppermine Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.
  
  ********************************************
  Coppermine version: 1.5.0
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**********************************************/

$name='Sample Plugin';
$description='This is a sample plugin. It will not do anything particular usefull - it is just meant to demonstrate what plugins can do and how to code them. When enabled, it will display some sample text in red.';
$author='Coppermine Development Team';
$version='1.0';
/*
 * $extra_info is displayed with the title of a plugin that is NOT installed and
 * can be used to present extra information.  In this case I show a complex
 * example that forms a button the user can click.
 */
$extra_info = <<<EOT
    <table border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td class="admin_menu"><a target="_blank" href="docs/index.htm#plugin" title="Plugin Documentation">Documentation</a></td>
    </tr>
    </table>
EOT;
/*
 * $install_info is displayed with the title of a plugin that IS installed and
 * can be used to present extra information. In this case I show a complex
 * example that forms a button the user can click.
 */
$install_info=<<<EOT
    <table border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td class="admin_menu"><a target="_blank" href="http://coppermine-gallery.net/forum/index.php?board=53.0" title="Plugin Support">Support</a></td>
    </tr>
    </table>
EOT;
?>