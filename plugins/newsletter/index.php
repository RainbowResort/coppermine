<?php
/**************************************************
  Coppermine 1.5.x Plugin - newsletter
  *************************************************
  Copyright (c) 2009-2010 Joachim Müller
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/branches/cpg1.5.x/plugins/slider/codebase.php $
  $Revision: 6994 $
  $LastChangedBy: timoswelt $
  $Date: 2010-01-04 10:54:19 +0100 (Mo, 04. Jan 2010) $
  **************************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');
// Initialize language and iconsrequire_once './plugins/newsletter/init.inc.php';
$newsletter_init_array = newsletter_initialize();
$lang_plugin_newsletter = $newsletter_init_array['language']; 
$newsletter_icon_array = $newsletter_init_array['icon'];

if ($CONFIG['plugin_newsletter_guest_subscriptions'] == '0' && USER_ID == 0) {
	cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
}

pageheader($lang_plugin_newsletter['config_name']);
starttable('100%', $newsletter_icon_array['newsletter'] . $lang_plugin_newsletter['config_name'], 2);
echo <<< EOT
	<tr>
		<td class="tableb" valign="top">
			{$lang_plugin_newsletter['menu']}
		</td>
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
	// Get the number of records to process
	$result = cpg_db_query("SELECT COUNT(*) FROM {$CONFIG['TABLE_PREFIX']}plugin_newsletter_queue");
	list($remaining_records_count) = mysql_fetch_row($result);
	mysql_free_result($result);
	$result = cpg_db_query("SELECT COUNT(*) FROM {$CONFIG['TABLE_PREFIX']}plugin_newsletter_queue WHERE ATTEMPTS > {$CONFIG['plugin_newsletter_retries']}");
	list($timedout_records_count) = mysql_fetch_row($result);
	mysql_free_result($result);
	echo <<< EOT
				<li style="list-style-type:none">
					<hr />
				</li>
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
	if ($remaining_records_count > 0) {
		echo <<< EOT
				<li style="list-style-type:none">
					<a href="index.php?file=newsletter/send">{$newsletter_icon_array['send']}{$lang_plugin_newsletter['send_mailings']}</a>
				</li>
EOT;
	}
	if ($timedout_records_count > 0) {
		echo <<< EOT
				<li style="list-style-type:none">
					<a href="index.php?file=newsletter/queue">{$newsletter_icon_array['queue']}{$lang_plugin_newsletter['queue']}</a>
				</li>
EOT;
	}
}
echo <<< EOT
			</ul>
		</td>
	</tr>
	<tr>
		<td class="tableb tableb_alternate" valign="top">
			{$lang_plugin_newsletter['statistics']}
		</td>
		<td class="tableb tableb_alternate" valign="top">
		</td>
	</tr>
EOT;
endtable();
pagefooter();
die;
?>