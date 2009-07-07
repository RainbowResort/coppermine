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
$output_array = array();

if (!GALLERY_ADMIN_MODE) {
	cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
}




// Populate the stats defaults
if ($superCage->get->keyExists('time')) {
	$timestamp_start = $superCage->get->getInt('time');
} else {
	$timestamp_start = time();
}
if ($superCage->get->keyExists('counter')) {
	$processed_records_counter = $superCage->get->getInt('counter');
} else {
	$processed_records_counter = 0;
}

$output_array = newsletter_mailqueue();
$processed_records_counter = $processed_records_counter + count($output_array);

// Get the number of records to process
$result = cpg_db_query("SELECT COUNT(*) FROM {$CONFIG['TABLE_PREFIX']}plugin_newsletter_queue WHERE attempts <= {$CONFIG['plugin_newsletter_mails_per_page']}");
list($remaining_records_count) = mysql_fetch_row($result);
mysql_free_result($result);
$result = cpg_db_query("SELECT COUNT(*) FROM {$CONFIG['TABLE_PREFIX']}plugin_newsletter_queue WHERE attempts > {$CONFIG['plugin_newsletter_mails_per_page']}");
list($failed_records_count) = mysql_fetch_row($result);
mysql_free_result($result);
if ($failed_records_count > 0) {
    $timed_out_mailings = '<br /><a href="index.php?file=newsletter/queue">' . sprintf($lang_plugin_newsletter['timed_out_mailings'], $failed_records_count) . '</a>';
} else {
    $timed_out_mailings = '';
}
$remaining_queued_mailings = sprintf($lang_plugin_newsletter['remaining_queued_mailings'], $remaining_records_count);
if ($processed_records_counter != 0) {
    $remaining_timestamp = ($remaining_records_count * (time() - $timestamp_start)) / $processed_records_counter;
    $remaining_time = '<br />' . sprintf($lang_plugin_newsletter['remaining_time'], date('i:s', $remaining_timestamp));
}
if ($remaining_records_count == 0) {
    $remaining_queued_mailings = $lang_plugin_newsletter['all_queued_mailings_processed'];
    $remaining_time = '';
    $redirector = '';
    $countdown = '';
} else {
    $redirector = '<meta http-equiv="refresh" content="'.$CONFIG['plugin_newsletter_page_refresh_delay'].'; URL=index.php?file=newsletter/send&amp;time='.$timestamp_start.'&amp;counter='.$processed_records_counter.'" />';
    $countdown = <<< EOT
    <tr>
        <td class="tableb tableb_alternate">
EOT;
    $countdown .= sprintf($lang_plugin_newsletter['page_will_refresh_in_x'], '<span id="countdown"></span>');
    $countdown .= <<< EOT
        </td>
    </tr>
EOT;
}

set_js_var('page_refresh_delay', $CONFIG['plugin_newsletter_page_refresh_delay']);
set_js_var('reloading', strtoupper($lang_plugin_newsletter['reloading']));
set_js_var('reload_url', 'index.php?file=newsletter/send&time='.$timestamp_start.'&counter='.$processed_records_counter);
if (in_array('plugins/newsletter/js/jquery.countdown.js', $JS['includes']) != TRUE) {
	$JS['includes'][] = 'plugins/newsletter/js/jquery.countdown.js';
}

pageheader($lang_plugin_newsletter['send_mailings'], $redirector);
if ($CONFIG['plugin_newsletter_mails_per_page'] == '1') {
	$mails_per_page = $lang_plugin_newsletter['one_email'];
} else {
	$mails_per_page = sprintf($lang_plugin_newsletter['x_emails'], $CONFIG['plugin_newsletter_mails_per_page']);
}
if ($CONFIG['plugin_newsletter_page_refresh_delay'] == '1') {
	$page_refresh_delay = $lang_plugin_newsletter['second'];
} elseif($CONFIG['plugin_newsletter_page_refresh_delay'] == '60') {
	$page_refresh_delay = $lang_plugin_newsletter['minute'];
} elseif($CONFIG['plugin_newsletter_page_refresh_delay'] > '60' && ($CONFIG['plugin_newsletter_page_refresh_delay']/60 == floor($CONFIG['plugin_newsletter_page_refresh_delay']/60))) {
	$page_refresh_delay = sprintf($lang_plugin_newsletter['x_minutes'], $CONFIG['plugin_newsletter_page_refresh_delay']/60);
} else {
	$page_refresh_delay = sprintf($lang_plugin_newsletter['x_seconds'], $CONFIG['plugin_newsletter_page_refresh_delay']);
}

$explanation = sprintf($lang_plugin_newsletter['send_mailings_explain'], '<a href="index.php?file=newsletter/admin">', '</a>', $mails_per_page, $page_refresh_delay);
starttable('100%', $newsletter_icon_array['send'] . $lang_plugin_newsletter['send_mailings'], 1);
echo <<< EOT
    <tr>
        <td class="tableb">
            {$explanation}
        </td>
    </tr>
    <tr>
        <td class="tableb tableb_alternate">
            <ul>
EOT;
foreach ($output_array as $output) {
    echo <<< EOT
                 <li style="list-style-type:none">
                     {$output}
                 </li>
EOT;
}
echo <<< EOT
            </ul>
        </td>
    </tr>
    <tr>
        <td class="tableb">
            {$remaining_queued_mailings}
            {$remaining_time}
            {$timed_out_mailings}
        </td>
    </tr>
EOT;

echo $countdown;

endtable();
pagefooter();
die;
?>