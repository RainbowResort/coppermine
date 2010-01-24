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
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
  **************************************************/

function newsletter_initialize() {
    global $CONFIG, $JS, $lang_plugin_newsletter, $newsletter_icon_array;
    $superCage = Inspekt::makeSuperCage();
    if (in_array('js/jquery.spinbutton.js', $JS['includes']) != TRUE) {
        $JS['includes'][] = 'js/jquery.spinbutton.js';
    }
    if (in_array('plugins/newsletter/js/script.js', $JS['includes']) != TRUE) {
        $JS['includes'][] = 'plugins/newsletter/js/script.js';
    }
    
    require "./plugins/newsletter/lang/english.php";
    if ($CONFIG['lang'] != 'english' && file_exists("./plugins/newsletter/lang/{$CONFIG['lang']}.php")) {
        require "./plugins/newsletter/lang/{$CONFIG['lang']}.php";
    }
    if ($CONFIG['enable_menu_icons'] == 2) {
        $newsletter_icon_array['config'] = '<img src="./plugins/newsletter/images/icons/config.png" width="16" height="16" border="0" alt="" class="icon" />';
        $newsletter_icon_array['newsletter'] = '<img src="./plugins/newsletter/images/icons/newsletter.png" width="16" height="16" border="0" alt="" class="icon" />';
        $newsletter_icon_array['catlist'] = '<img src="./plugins/newsletter/images/icons/catlist.png" width="16" height="16" border="0" alt="" class="icon" />';
        $newsletter_icon_array['subscribe'] = '<img src="./plugins/newsletter/images/icons/subscribe.png" width="16" height="16" border="0" alt="" class="icon" />';
        $newsletter_icon_array['mailing'] = '<img src="./plugins/newsletter/images/icons/mailing.png" width="16" height="16" border="0" alt="" class="icon" />';
        $newsletter_icon_array['archive'] = '<img src="./plugins/newsletter/images/icons/archive.png" width="16" height="16" border="0" alt="" class="icon" />';
        $newsletter_icon_array['locked'] = '<img src="./plugins/newsletter/images/icons/locked.png" width="16" height="16" border="0" alt="" class="icon" />';
        $newsletter_icon_array['unlocked'] = '<img src="./plugins/newsletter/images/icons/unlocked.png" width="16" height="16" border="0" alt="" class="icon" />';
        $newsletter_icon_array['search'] = '<img src="./plugins/newsletter/images/icons/search.png" width="16" height="16" border="0" alt="" class="icon" />';
        $newsletter_icon_array['send'] = '<img src="./plugins/newsletter/images/icons/send.png" width="16" height="16" border="0" alt="" class="icon" />';
        $newsletter_icon_array['queue'] = '<img src="./plugins/newsletter/images/icons/delete.png" width="16" height="16" border="0" alt="" class="icon" />';
    } else {
        $newsletter_icon_array['config'] = '';
        $newsletter_icon_array['announcement'] = '';
        $newsletter_icon_array['catlist'] = '';
        $newsletter_icon_array['subscribe'] = '';
        $newsletter_icon_array['mailing'] = '';
        $newsletter_icon_array['archive'] = '';
        $newsletter_icon_array['locked'] = '<img src="./plugins/newsletter/images/icons/locked.png" width="16" height="16" border="0" alt="" class="icon" />';
        $newsletter_icon_array['unlocked'] = '<img src="./plugins/newsletter/images/icons/unlocked.png" width="16" height="16" border="0" alt="" class="icon" />';
        $newsletter_icon_array['search'] = '';
        $newsletter_icon_array['send'] = '';
        $newsletter_icon_array['queue'] = '';
    }
    $newsletter_icon_array['announcement'] = cpg_fetch_icon('announcement', 1);
    $newsletter_icon_array['plugin_manager'] = cpg_fetch_icon('plugin_mgr', 2);
    $newsletter_icon_array['ok'] = cpg_fetch_icon('ok', 2);
    $newsletter_icon_array['success'] = cpg_fetch_icon('ok', 0);
    $newsletter_icon_array['failure'] = cpg_fetch_icon('cancel', 0);
    $newsletter_icon_array['cancel'] = cpg_fetch_icon('cancel', 2);
    $newsletter_icon_array['edit'] = cpg_fetch_icon('edit', 0);
    $newsletter_icon_array['delete'] = cpg_fetch_icon('delete', 0);
    $newsletter_icon_array['add'] = cpg_fetch_icon('add', 2);
    $newsletter_icon_array['visible'] = cpg_fetch_icon('online', 0);
    $newsletter_icon_array['invisible'] = cpg_fetch_icon('offline', 0);
    $return['language'] = $lang_plugin_newsletter;
    $return['icon'] = $newsletter_icon_array;
    return $return;
}

function newsletter_frequency_words() {
    global $lang_plugin_newsletter;
    $frequency_words = array(
                       '1' => 'frequency_once_year',
                       '2' => 'frequency_twice_year',
                       '12' => 'frequency_once_month',
                       '24' => 'frequency_twice_month',
                       '52' => 'frequency_once_week',
                       '360' => 'frequency_once_day',
                       );
    return $frequency_words;
}

function newsletter_frequency_options($highlighted = '0') {
    global $LINEBREAK, $lang_plugin_newsletter;
    $return = '';
    $frequency_words = array(
                       '1'   => $lang_plugin_newsletter['frequency_once_year'],
                       '2'   => $lang_plugin_newsletter['frequency_twice_year'],
                       '3'   => sprintf($lang_plugin_newsletter['frequency_x_times_per_year'], 3),
                       '4'   => sprintf($lang_plugin_newsletter['frequency_x_times_per_year'], 4),
                       '5'   => sprintf($lang_plugin_newsletter['frequency_x_times_per_year'], 5),
                       '6'   => sprintf($lang_plugin_newsletter['frequency_x_times_per_year'], 6),
                       '7'   => sprintf($lang_plugin_newsletter['frequency_x_times_per_year'], 7),
                       '8'   => sprintf($lang_plugin_newsletter['frequency_x_times_per_year'], 8),
                       '9'   => sprintf($lang_plugin_newsletter['frequency_x_times_per_year'], 9),
                       '10'  => sprintf($lang_plugin_newsletter['frequency_x_times_per_year'], 10),
                       '12'  => $lang_plugin_newsletter['frequency_once_month'],
                       '24'  => $lang_plugin_newsletter['frequency_twice_month'],
                       '52'  => $lang_plugin_newsletter['frequency_once_week'],
                       '100' => sprintf($lang_plugin_newsletter['frequency_x_times_per_year'], 100),
                       '360' => $lang_plugin_newsletter['frequency_once_day'],
                       );
    foreach ($frequency_words as $key => $value) {
        $return .= '			<option value="' . $key . '"';
        if ($key == $highlighted) {
            $return .= ' selected="selected"';
        }
        $return .= '>' . $value . '</option>' . $LINEBREAK;
    }
    return $return;
}

function newsletter_install_check() {
    global $CPG_PLUGINS, $lang_plugin_newsletter;
    $hit = 0;
    foreach ($CPG_PLUGINS as $installed_plugins) {
        if ($installed_plugins->path == 'newsletter') {
            $hit++;
        }
    }
    if ($hit != 0) {
        return;
    } else {
        cpgRedirectPage('index.php', $lang_plugin_newsletter['outdated_link'], $lang_plugin_newsletter['outdated_link_explain'], 0, 'error');
    }
}

function newsletter_mailing_frequency($category_id) {
    global $CONFIG;
    // Get all mailings form the specified category
    $result = cpg_db_query("SELECT date_sent FROM {$CONFIG['TABLE_PREFIX']}plugin_newsletter_mailings
                            WHERE category_id='{$category_id}'");
    $loopCounter = 0;
    $newsletter_mailings_date = array();
    while ($row = mysql_fetch_assoc($result)) {
        $newsletter_mailings_date[] = $row['date_sent'];
        $loopCounter++;
    }
    mysql_free_result($result);
    return $newsletter_mailings_date;
}

function newsletter_mailing_stats($category_id) {
    global $CONFIG;
    $mailing_dates = newsletter_mailing_frequency($category_id);
    if (count($mailing_dates) < 2) { // We don't have enough data for stats
        $mailings_per_year = count($mailing_dates);
    } else {
        $max_id = count($mailing_dates) - 1;
        $mailing_dates_temp = $mailing_dates;
        $mailing_dates_temp[count($mailing_dates)] = $mailing_dates_temp[$max_id];
        $difference_days =  round(abs($mailing_dates[$max_id] - $mailing_dates[0])/86400);
        foreach ($mailing_dates as $key => $value) {
            $total_days += abs($mailing_dates_temp[($key+1)] - $mailing_dates_temp[$key])/86400;
        }
        $average_number_of_days_between_mailings = $total_days/count($mailing_dates);
        $mailings_per_year = 360/$average_number_of_days_between_mailings;
    }
    $result = cpg_db_query("SELECT frequency_year FROM {$CONFIG['TABLE_PREFIX']}plugin_newsletter_categories
                            WHERE category_id='{$category_id}' LIMIT 1");
    list($category_frequency) = mysql_fetch_row($result);
    mysql_free_result($result);
    $return = array($mailings_per_year, $category_frequency);
    return $return;
}

function newsletter_subscriptions_per_category($category_id) {
    global $CONFIG;
    if (!$category_id) {
        return;
    }
    $result = cpg_db_query("SELECT COUNT(*) FROM {$CONFIG['TABLE_PREFIX']}plugin_newsletter_subscriptions WHERE FIND_IN_SET({$category_id},category_list) > 0 AND subscriber_active = 'YES' LIMIT 1");
    list($subscription_total) = mysql_fetch_row($result);
    mysql_free_result($result);
    return $subscription_total;
}

function newsletter_mailings_per_category($category_id) {
    global $CONFIG;
    $query = "SELECT COUNT(*) FROM {$CONFIG['TABLE_PREFIX']}plugin_newsletter_mailings
                WHERE category_id='{$category_id}'";
    $result = cpg_db_query($query);
    list($mailings_count) = mysql_fetch_row($result);
    mysql_free_result($result);
    return $mailings_count;
}

function newsletter_mailings_to_process() {
    global $CONFIG;
    // Get the number of records to process
    $max_attempts = $CONFIG['plugin_newsletter_retries']+1;
    $result = cpg_db_query("SELECT COUNT(*) FROM {$CONFIG['TABLE_PREFIX']}plugin_newsletter_queue WHERE attempts <= {$max_attempts}");
    list($remaining_records_count) = mysql_fetch_row($result);
    mysql_free_result($result);
    return $remaining_records_count;
}

function newsletter_timed_out_mailings() {
    global $CONFIG;
    // Get the number of records to process
    $result = cpg_db_query("SELECT COUNT(*) FROM {$CONFIG['TABLE_PREFIX']}plugin_newsletter_queue WHERE attempts > {$CONFIG['plugin_newsletter_retries']}");
    list($timed_out_records_count) = mysql_fetch_row($result);
    mysql_free_result($result);
    return $timed_out_records_count;
}

function newsletter_text2html($subject, $salutation, $body) {
    global $CONFIG, $LINEBREAK, $lang_plugin_newsletter;
    // Make sure that there is no mixture of linebreaks
    $body = str_replace("\r\n", '{LINEBREAK}', $body);
    $body = str_replace("\n\r", '{LINEBREAK}', $body);
    $body = str_replace("\n", '{LINEBREAK}', $body);
    $body = str_replace("\r", '{LINEBREAK}', $body);
    $body = str_replace('{LINEBREAK}', $LINEBREAK, $body);
    // Parse the HTML template
    $file = 'template.html';
    $file_handle = fopen($file, 'r');
    $html = fread($file_handle, filesize($file));
    fclose($file_handle);
    $html = str_replace('{MESSAGE}', str_replace($LINEBREAK, '<br />' . $LINEBREAK, $body), $html);
    // Add the unsubscribe link at the bottom
    $html = str_replace('{TITLE}', $subject, $html);
    $html = str_replace('{HEADING}', $subject, $html);
    $html = str_replace('{SALUTATION}', $salutation, $html);
    $html = str_replace('{UNSUBSCRIBE_TGT}', $CONFIG['site_url'] . 'index.php?file=newsletter/unsubscribe', $html);
    $html = str_replace('{UNSUBSCRIBE_LNK}', $lang_plugin_newsletter['unsubscribe_html'], $html);
    return $html;
}
?>