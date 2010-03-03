<?php
/*************************
  Coppermine 1.4.x Plugin - Google Anylytics
  ********************************************
  Copyright (c) 2009 papukaija
  
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

**********************************************/

$name='Google Analytics';
$description='This plugin will add Google Analytics\'s tracking code to every page if you aren\'t logged in as admin. An additional cookie based exclusion is also available after the installation of this plugin.';
$author='<a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=56739" rel="external">papukaija</a>';
$version='1.3';
$plugin_cpg_version = array('min' => '1.4', 'max' => '1.4.99');
/*
 * $extra_info is displayed with the title of a plugin that is NOT installed and
 * can be used to present extra information.
 */
$extra_info = <<<EOT
    <table border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td>Please remember to clean up your template, master_template plugin or anycontent.php before installing this plugin.</td>
    </tr>
    </table>
EOT;
/*
 * $install_info is displayed with the title of a plugin that IS installed and
 * can be used to present extra information.
 */
$install_info=<<<EOT
    <table border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td class="admin_menu"><a href="index.php?file=google_analytics/cookie" title="Install or update the cookie">Install or update the cookie</a></td>
    </tr>
    </table>
EOT;
?>
