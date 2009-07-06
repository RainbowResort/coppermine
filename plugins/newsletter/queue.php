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
// Initialize language and icons
require_once './plugins/newsletter/init.inc.php';
$newsletter_init_array = newsletter_initialize();
$lang_plugin_newsletter = $newsletter_init_array['language']; 
$newsletter_icon_array = $newsletter_init_array['icon'];

if (!GALLERY_ADMIN_MODE) {
	cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
}

$query = ("SELECT * 
		   FROM {$CONFIG['TABLE_PREFIX']}plugin_newsletter_queue 
		   AS queue 
		   INNER JOIN {$CONFIG['TABLE_PREFIX']}plugin_newsletter_mailings 
		   AS mailings
		   ON mailings.mailing_id = queue.mailing_id
		   INNER JOIN {$CONFIG['TABLE_PREFIX']}plugin_newsletter_subscriptions 
		   AS subscriptions
		   ON subscriptions.subscriber_id = queue.subscriber_id
		   WHERE queue.attempts > 10
		   ORDER BY queue.attempts,queue.time 
		   LIMIT 10");
$result = cpg_db_query($query);
$mailqueue_array = cpg_db_fetch_rowset($result);
mysql_free_result($result);



pageheader($lang_plugin_newsletter['send_mailings']);
print_r($mailqueue_array);
starttable('100%', $newsletter_icon_array['queue'] . $lang_plugin_newsletter['queue'], 3, 'cpg_zebra');
echo <<< EOT
	<tr>
		<th class="tableh2" valign="top" align="center">
			{$lang_plugin_newsletter['delete']}
		</th>
		<th class="tableh2" valign="top" align="left">
			{$lang_plugin_newsletter['category']}
		</th>
		<th class="tableh2" valign="top" align="left">
			{$lang_plugin_newsletter['subject']}
		</th>
	</tr>
EOT;
foreach ($mailqueue_array as $mailqueue) {
	$loopCounter = 0;
	$result = cpg_db_query("SELECT name FROM {$CONFIG['TABLE_PREFIX']}plugin_newsletter_categories WHERE category_id={$mailqueue['queue_id']} LIMIT 1");
	list($category_name) = mysql_fetch_row($result);
	mysql_free_result($result);

	echo <<< EOT
    <tr>
        <td valign="top" align="center">
            <input type="checkbox" name="delete{$loopCounter}" id="delete{$loopCounter}" value="{$mailqueue['queue_id']}" class="checkbox" />
        </td>
		<td class="album_stat">
			<a href="index.php?file=newsletter/archive&amp;category={$mailqueue['category_id']}">{$category_name}</a>
		</td>
		<td class="album_stat">
			<a href="index.php?file=newsletter/archive&amp;mailing={$mailqueue['mailing_id']}">{$mailqueue['subject']}</a>
		</td>
    </tr>
EOT;
	$loopCounter++;
}

endtable();
pagefooter();
die;
?>