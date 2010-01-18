<?php
/********************************************************
  Coppermine 1.5.x plugin - FetchContent
  *******************************************************
  Copyright (c) 2010 Coppermine dev team
  *******************************************************
  This program is free software; you can redistribute 
  it and/or modify it under the terms of the GNU General
  Public License as published by the Free Software
  Foundation; either version 3 of the License, or 
  (at your option) any later version.
  *******************************************************
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/branches/cpg1.5.x/plugins/fetchcontent/admin.php $
  $Revision: 7043 $
  $LastChangedBy: gaugau $
  $Date: 2010-01-11 19:26:53 +0100 (Mo, 11. Jan 2010) $
  *******************************************************/
  
require_once('./plugins/fetchcontent/init.inc.php');

$name = $lang_plugin_fetchcontent['display_name'];
$description = $lang_plugin_fetchcontent['description'];
$name = 'FetchContent';
$description = 'Display content taken from coppermine on non-coppermine-driven pages. Might later become the successor of cpmFetch';
$author = 'Joachim Müller, later hopefully Bill Chmura (vuud), Coppermine dev team';
$version = '0.2';
$extra_info = <<< EOT
{$lang_plugin_fetchcontent['extra_info_create_file']}<br />
<textarea class="textinput" style="width:100%" rows="1" cols="50">&lt;img src="{$CONFIG['site_url']}?file=fetchcontent/image&pid=XXX&amp;size=1" border="1" alt="" /&gt;</textarea><br />
EOT;
$install_info = '';
$announcement_thread = '<a href="http://forum.coppermine-gallery.net/index.php/topic,63166.0.html" rel="external" class="admin_menu">' . $fetchcontent_icon_array['announcement'] . $lang_plugin_fetchcontent['announcement_thread'] . '</a>';
$configuration_link = '<a href="index.php?file=fetchcontent/admin" class="admin_menu">' . $fetchcontent_icon_array['config'] . $lang_plugin_fetchcontent['configuration'] . '</a>';
$documentation_link = '<a href="plugins/fetchcontent/docs/' . $documentation_file  . '.htm" class="admin_menu">' . $fetchcontent_icon_array['documentation'] . $lang_plugin_fetchcontent['documentation'] . '</a>';
$install_info .= '<br />' . $announcement_thread . '&nbsp;' . $documentation_link;
$extra_info .= '<br />' . $configuration_link . '&nbsp;' . $announcement_thread . '&nbsp;' . $documentation_link;


?>