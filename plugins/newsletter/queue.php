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

if ($superCage->post->keyExists('submit')) { // The form has been submit
    //Check if the form token is valid
    if(!checkFormToken()){
        cpg_die(ERROR, $lang_errors['invalid_form_token'], __FILE__, __LINE__);
    }
    if ($superCage->post->keyExists('resend')) {
        $resend_array = $superCage->post->getRaw('resend');
        foreach ($resend_array as $resend) {
            cpg_db_query("UPDATE {$CONFIG['TABLE_PREFIX']}plugin_newsletter_queue SET attempts='0' WHERE queue_id='{$resend}'");
        }
    } 
    if ($superCage->post->keyExists('delete')) {
        $delete_array = $superCage->post->getRaw('delete');
        foreach ($delete_array as $delete) {
            cpg_db_query("DELETE FROM {$CONFIG['TABLE_PREFIX']}plugin_newsletter_queue WHERE queue_id='{$delete}'");
        }
    }
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
		   WHERE queue.attempts > {$CONFIG['plugin_newsletter_mails_per_page']}
		   ORDER BY queue.attempts,queue.time");
$result = cpg_db_query($query);
$mailqueue_array = cpg_db_fetch_rowset($result);
mysql_free_result($result);

pageheader($lang_plugin_newsletter['send_mailings']);
echo <<< EOT
    <form action="" method="post" name="newsletter_queue" id="newsletter_queue">
EOT;
starttable('100%', $newsletter_icon_array['queue'] . $lang_plugin_newsletter['queue'], 7, 'cpg_zebra');
echo <<< EOT
	<tr>
		<th class="tableh2" valign="top" align="center">
			{$lang_plugin_newsletter['delete']}
		</th>
		<th class="tableh2" valign="top" align="center">
			{$lang_plugin_newsletter['re_send']}
		</th>
		<th class="tableh2" valign="top" align="left">
			{$lang_plugin_newsletter['category']}
		</th>
		<th class="tableh2" valign="top" align="left">
			{$lang_plugin_newsletter['subject']}
		</th>
		<th class="tableh2" valign="top" align="left">
			{$lang_plugin_newsletter['date_sent']}
		</th>
		<th class="tableh2" valign="top" align="left">
			{$lang_plugin_newsletter['name']}
		</th>
		<th class="tableh2" valign="top" align="left">
			{$lang_plugin_newsletter['email_address']}
		</th>
	</tr>
EOT;
foreach ($mailqueue_array as $mailqueue) {
	$loopCounter = 0;
	$result = cpg_db_query("SELECT name FROM {$CONFIG['TABLE_PREFIX']}plugin_newsletter_categories WHERE category_id={$mailqueue['category_id']} LIMIT 1");
	list($category_name) = mysql_fetch_row($result);
	mysql_free_result($result);
	$date_sent = strftime($lang_date['lastcom'], $mailqueue['date_sent']);
    
	echo <<< EOT
    <tr>
        <td valign="top" align="center">
            <input type="checkbox" name="delete[]" id="delete{$loopCounter}" value="{$mailqueue['queue_id']}" class="checkbox" />
        </td>
        <td valign="top" align="center">
            <input type="checkbox" name="resend[]" id="resend{$loopCounter}" value="{$mailqueue['queue_id']}" class="checkbox" />
        </td>
		<td class="album_stat">
			<a href="index.php?file=newsletter/archive&amp;category={$mailqueue['category_id']}">{$category_name}</a>
		</td>
		<td class="album_stat">
			<a href="index.php?file=newsletter/archive&amp;mailing={$mailqueue['mailing_id']}">{$mailqueue['subject']}</a>
		</td>
		<td class="album_stat">
		    {$date_sent}
		</td>
		<td class="album_stat">
		    <a href="index.php?file=newsletter/subscribe&amp;subscriber={$mailqueue['subscriber_id']}">{$mailqueue['subscriber_name']}</a>
		</td>
		<td class="album_stat">
		    {$mailqueue['subscriber_email']}
		</td>
    </tr>
EOT;
	$loopCounter++;
}
list($timestamp, $form_token) = getFormToken();
if ($loopCounter != 0) {
    echo <<< EOT
    <tr>
        <td colspan="7" class="tablef">
            <input type="hidden" name="form_token" value="{$form_token}" />
            <input type="hidden" name="timestamp" value="{$timestamp}" />
            <button type="submit" class="button" name="submit" id="submit" value="{$lang_common['ok']}">{$newsletter_icon_array['ok']}{$lang_common['ok']}</button>
        </td>
    </tr>
EOT;
} else {
    echo <<< EOT
    <tr>
        <td colspan="7" class="tablef">
            <div class="cpg_message_info">
                {$lang_plugin_newsletter['no_broken_mailings']}
            </div>
        </td>
    </tr>
EOT;
}

endtable();
echo <<< EOT
    </form>
EOT;
pagefooter();
die;
?>