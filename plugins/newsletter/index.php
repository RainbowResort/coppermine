<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2009 Coppermine Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/branches/cpg1.5.x/plugins/newsletter/archive.php $
  $Revision: 6247 $
  $LastChangedBy: gaugau $
  $Date: 2009-06-29 18:32:21 +0200 (Mo, 29 Jun 2009) $
**********************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');
// Initialize language and iconsrequire_once './plugins/newsletter/init.inc.php';
$newsletter_init_array = newsletter_initialize();
$lang_plugin_newsletter = $newsletter_init_array['language']; 
$newsletter_icon_array = $newsletter_init_array['icon'];

pageheader($lang_plugin_newsletter['config_name']);
starttable('100%', $newsletter_icon_array['newsletter'] . $lang_plugin_newsletter['config_name'], 1);
echo <<< EOT
	<tr>
		<td class="tableb">
			<ul style="list-style-type:none">
				<li style="list-style-type:none">
					<a href="index.php?file=newsletter/subscribe">{$newsletter_icon_array['subscribe']}{$lang_plugin_newsletter['subscribe']}</a>
				</li>
				<li style="list-style-type:none">
					<a href="index.php?file=newsletter/archive" title="{$lang_plugin_newsletter['browse_archived_mailings']}">{$newsletter_icon_array['archive']}{$lang_plugin_newsletter['archive']}</a>
				</li>
EOT;
if (GALLERY_ADMIN_MODE) {
	echo <<< EOT
				<li style="list-style-type:none">
					<a href="index.php?file=newsletter/admin">{$newsletter_icon_array['config']}{$lang_plugin_newsletter['config']}</a>
				</li>
				<li style="list-style-type:none">
					<a href="index.php?file=newsletter/catlist">{$newsletter_icon_array['catlist']}{$lang_plugin_newsletter['newsletter_categories']}</a>
				</li>
				<li style="list-style-type:none">
					<a href="index.php?file=newsletter/mailing">{$newsletter_icon_array['mailing']}{$lang_plugin_newsletter['create_mailing']}</a>
				</li>
				<li style="list-style-type:none">
					<a href="http://forum.coppermine-gallery.net/index.php/topic,60336.0.html" title="&laquo;{$lang_plugin_newsletter['config_name']}&raquo; - {$lang_plugin_newsletter['announcement_thread']}">{$newsletter_icon_array['announcement']}{$lang_plugin_newsletter['announcement_thread']}</a>
				</li>
				<li style="list-style-type:none">
					<a href="index.php?file=newsletter/mailing">{$newsletter_icon_array['plugin_manager']}{$lang_plugin_newsletter['pluginmgr_lnk']}</a>
				</li>
EOT;
}
echo <<< EOT
			</ul>
		</td>
	</tr>
EOT;
endtable();
pagefooter();
die;
?>