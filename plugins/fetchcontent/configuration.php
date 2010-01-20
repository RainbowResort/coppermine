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
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
  *******************************************************/
  
require_once('./plugins/fetchcontent/init.inc.php');

$name = $lang_plugin_fetchcontent['display_name'];
$description = $lang_plugin_fetchcontent['description'];
$name = 'FetchContent';
$description = 'Display content taken from coppermine on non-coppermine-driven pages. Might later become the successor of cpmFetch';
$author = 'Joachim Müller, later hopefully Bill Chmura (vuud), Coppermine dev team';
$version = '0.3';

$result = cpg_db_query("SELECT pid FROM {$CONFIG['TABLE_PICTURES']} AS r INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS a ON a.aid = r.aid $RESTRICTEDWHERE AND approved = 'YES' AND ((filename LIKE '%.jpg') OR (filename LIKE '%.png') OR (filename LIKE '%.gif')) ORDER BY RAND() LIMIT 1");
list($fetchcontent_random_pid) = mysql_fetch_row($result);
mysql_free_result($result);

$extra_info = <<< EOT
{$lang_plugin_fetchcontent['extra_info_create_file']}<br />
<input type="text" class="textinput" style="width:100%;font-family:'Courier New',Courier, monospace;" value="&lt;img src=&quot;{$CONFIG['site_url']}?file=fetchcontent/image&pid={$fetchcontent_random_pid}&amp;size=1&quot; border=&quot;1&quot; alt=&quot;&quot; /&gt;" /><br />
<textarea class="textinput" style="width:100%;font-family:'Courier New',Courier, monospace;" rows="5">&lt;!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"&gt;
&lt;html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr"&gt;
&lt;head&gt;
&lt;title&gt;{$lang_plugin_fetchcontent['display_name']} {$lang_plugin_fetchcontent['example_file']}&lt;/title&gt;
&lt;meta http-equiv="Content-Type" content="text/html; charset=utf-8" /&gt;
&lt;/head&gt;
&lt;body&gt;
&lt;script src="{$CONFIG['site_url']}?file=fetchcontent/js" type="text/javascript"&gt;&lt;/script&gt;
&lt;/body&gt;
&lt;/html&gt;</textarea>
EOT;
$install_info = '';
$announcement_thread = '<a href="http://forum.coppermine-gallery.net/index.php/topic,63166.0.html" rel="external" class="admin_menu">' . $fetchcontent_icon_array['announcement'] . $lang_plugin_fetchcontent['announcement_thread'] . '</a>';
$configuration_link = '<a href="index.php?file=fetchcontent/admin" class="admin_menu">' . $fetchcontent_icon_array['config'] . $lang_plugin_fetchcontent['configuration'] . '</a>';
$info_link = '<a href="index.php?file=fetchcontent/info&amp;pretty" class="admin_menu">' . $fetchcontent_icon_array['info'] . $lang_plugin_fetchcontent['info'] . '</a>';
$documentation_link = '<a href="plugins/fetchcontent/docs/' . $documentation_file  . '.htm" class="admin_menu">' . $fetchcontent_icon_array['documentation'] . $lang_plugin_fetchcontent['documentation'] . '</a>';
$install_info .= '<br />' . $announcement_thread . '&nbsp;' . $documentation_link;
$extra_info .= '<br />' . $configuration_link . '&nbsp;' . $announcement_thread . '&nbsp;' . $documentation_link . '&nbsp;' . $info_link;


?>