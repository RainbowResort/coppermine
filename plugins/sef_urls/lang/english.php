<?php
/**************************************************
  Coppermine 1.5.x Plugin - sef_urls
  *************************************************
  Copyright (c) 2003-2010 Coppermine Dev Team
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/branches/cpg1.5.x/plugins/sef_urls/configuration.php $
  $Revision: 7644 $
  $LastChangedBy: timoswelt $
  $Date: 2010-06-05 14:17:34 +0200 (Sa, 05 Jun 2010) $
  **************************************************/

if (!defined('IN_COPPERMINE')) {
    die('Not in Coppermine...');
}

$lang_plugin_sef_urls['name'] = 'Search Engine Friendly URLs';
$lang_plugin_sef_urls['description'] = 'Plugin creates search engine friendly URLs for index, thumbnails, and displayimage.php. (Apache webserver only!)';
$lang_plugin_sef_urls['known_issues_warning'] = 'Warning: this plugin is still experimental, there are known issues when using it. Test thoroughly and use at your own risk.';
$lang_plugin_sef_urls['recovery_instructions'] = 'When getting unexpected results, disable the plugin and remove the .htaccess file the plugin creates manually (using your FTP app).';
$lang_plugin_sef_urls['announcement_thread'] = 'Announcement thread';
$lang_plugin_sef_urls['configure_x'] = 'Configure %s';




?>