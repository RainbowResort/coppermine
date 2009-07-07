<?php
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
		$newsletter_icon_array['announcement'] = '<img src="./plugins/newsletter/images/icons/announcement.png" width="16" height="16" border="0" alt="" class="icon" />';
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
		$newsletter_icon_array['newsletter'] = '';
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
	if (function_exists('newsletter_mailqueue') && $superCage->get->getRaw('file') != 'newsletter/send') {
	    newsletter_mailqueue();
	}
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
    $result = cpg_db_query("SELECT COUNT(*) FROM {$CONFIG['TABLE_PREFIX']}plugin_newsletter_subscriptions WHERE FIND_IN_SET({$category_id},category_list) > 0 LIMIT 1");
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
?>