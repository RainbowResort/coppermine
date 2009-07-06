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
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**********************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');
// Initialize language and iconsrequire_once './plugins/newsletter/init.inc.php';
$newsletter_init_array = newsletter_initialize();
$lang_plugin_newsletter = $newsletter_init_array['language']; 
$newsletter_icon_array = $newsletter_init_array['icon'];

if ($CONFIG['plugin_newsletter_guest_subscriptions'] == '0') {
	cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
}

$USER_DATA = array_merge($USER_DATA, $cpg_udb->get_user_infos(USER_ID));

$category = '';
$mailing = '';
if (in_array('js/jquery.treeview.min.js', $JS['includes']) != TRUE) {
	$JS['includes'][] = 'js/jquery.treeview.min.js';
}
if (in_array('plugins/newsletter/js/archive.js', $JS['includes']) != TRUE) {
	$JS['includes'][] = 'plugins/newsletter/js/archive.js';
}

// Sanitize URL parameters
if ($superCage->get->keyExists('category')) {
$category = $superCage->get->getInt('category');
}
if ($superCage->get->keyExists('mailing')) {
$mailing = $superCage->get->getInt('mailing');
}


function browse_by_category_output($category = '') {
	global $CONFIG, $LINEBREAK, $lang_date;
	$result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PREFIX']}plugin_newsletter_categories");
	$loopCounter = 0;
	$newsletter_categories_db = array();
	while ($row = mysql_fetch_assoc($result)) {
		$newsletter_categories_db[$loopCounter]['category_id']           = $row['category_id'];
		$newsletter_categories_db[$loopCounter]['name']                  = $row['name'];
		$newsletter_categories_db[$loopCounter]['description']           = $row['description'];
		$newsletter_categories_db[$loopCounter]['open_for_subscription'] = $row['open_for_subscription'];
		$newsletter_categories_db[$loopCounter]['public_view']           = $row['public_view'];
		$newsletter_categories_db[$loopCounter]['frequency_year']        = $row['frequency_year'];
		$newsletter_categories_db[$loopCounter]['subscription_count']    = $row['subscription_count'];
		$loopCounter++;
	}
	mysql_free_result($result);
	if ($category == '') {
	    $return = $CONFIG['gallery_name'] . ' ' . $lang_plugin_newsletter['archive'];
    } else {
        $return = '';
    }
	$return .= <<< EOT
	<ul id="archive_by_category" class="treeview">
EOT;
	foreach ($newsletter_categories_db as $category_loop => $cat_row) {
		if ($cat_row['public_view'] == 'YES' || GALLERY_ADMIN_MODE) { // It's allowed to display that category
			if ($category == '' || $category == $cat_row['category_id']) {
    			$return .= '		<li>';
    			$return .= '<a href="index.php?file=newsletter/archive&amp;category=' . $cat_row['category_id'] . '">';
    			$return .= $cat_row['name'];
    			$return .= '</a>';
    			$result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PREFIX']}plugin_newsletter_mailings WHERE category_id='{$cat_row['category_id']}'");
    			if (mysql_num_rows($result)) {
    				$return .= $LINEBREAK . '			<ul>'. $LINEBREAK;
    			}
			}
			while ($row = mysql_fetch_assoc($result)) {
				$return .= '				<li>' . $LINEBREAK;
				$return .= '				<a href="index.php?file=newsletter/archive&amp;mailing=' . $row['mailing_id'] . '">';
				$return .= $row['subject'] .'</a> (';
				$return .= localised_date($row['date_sent'], $lang_date['comment']);
				$return .= ')';
				$return .= $LINEBREAK;
				$return .= '				</li>' . $LINEBREAK;
			}
			if ($category == '' || $category == $cat_row['category_id']) {
    			if (mysql_num_rows($result)) {
    				$return .= $LINEBREAK . '			</ul>'. $LINEBREAK;
    			}
    			$return .= '		</li>' . $LINEBREAK;
			}
			mysql_free_result($result);
		}
	}
	$return .= <<< EOT
	</ul>
EOT;
	return $return;
}

function browse_by_date_output() {
	global $CONFIG, $LINEBREAK, $lang_date;
	$result = cpg_db_query("SELECT category_id,name,public_view  FROM {$CONFIG['TABLE_PREFIX']}plugin_newsletter_categories");
	$newsletter_categories_public_view = array();
	while ($row = mysql_fetch_assoc($result)) {
		$newsletter_categories_public_view[$row['category_id']] = $row['public_view'];
		$newsletter_categories_name[$row['category_id']] = $row['name'];
	}
	mysql_free_result($result);
	unset($row);
	
	$return = <<< EOT
	{$CONFIG['gallery_name']} {$lang_plugin_newsletter['archive']}
EOT;
	$result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PREFIX']}plugin_newsletter_mailings ORDER BY date_sent");
	if (mysql_num_rows($result)) {
		$return .= $LINEBREAK . '		<ul id="archive_by_date" class="treeview">'. $LINEBREAK;
	}
	while ($row = mysql_fetch_assoc($result)) {
		if ($newsletter_categories_public_view[$row['category_id']] == 'YES' || GALLERY_ADMIN_MODE) {
			$return .= '			<li>' . $LINEBREAK;
			$return .= '			<a href="index.php?file=newsletter/archive&amp;mailing=' . $row['mailing_id'] . '">';
			$return .= $row['subject'] .'</a> (';
			$return .= localised_date($row['date_sent'], $lang_date['comment']);
			$return .= ')';
			$return .= $LINEBREAK;
			$return .= '			</li>' . $LINEBREAK;
		}
	}
	if (mysql_num_rows($result)) {
		$return .= $LINEBREAK . '		</ul>'. $LINEBREAK;
	}
	mysql_free_result($result);
	return $return;
}

pageheader($lang_plugin_newsletter['archive'], '<link rel="stylesheet" href="css/treeview.css" type="text/css" />');
starttable('100%', $newsletter_icon_array['archive'] . $lang_plugin_newsletter['archive'], 3);
if ($category != '') {
	// The visitor has chosen to browse by category
	$browse_by_category_output = browse_by_category_output($category);
	echo <<< EOT
	<tr>
		<th valign="top" colspan="3" class="tableh2">
			{$lang_plugin_newsletter['browse_by_category']}
		</th>
	</tr>
	<tr>
		<td valign="top" colspan="3" class="tableb">
			{$browse_by_category_output}
		</td>
	</tr>
EOT;
} elseif($mailing != '') {
	// Display an individual mailing
	$result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PREFIX']}plugin_newsletter_mailings WHERE mailing_id='{$mailing}' LIMIT 1");
	$mailing_array = mysql_fetch_assoc($result);
	mysql_free_result($result);
	$result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PREFIX']}plugin_newsletter_categories WHERE category_id='{$mailing_array['category_id']}' LIMIT 1");
	$category_array = mysql_fetch_assoc($result);
	mysql_free_result($result);
	$date_sent = localised_date($mailing_array['date_sent'], $lang_date['comment']);
	$number_of_subscriptions = newsletter_subscriptions_per_category($mailing_array['category_id']);
	if ($number_of_subscriptions == 1) {
	    $number_of_subscriptions = $lang_plugin_newsletter['one_subscription'];
	} else {
	    $number_of_subscriptions = sprintf($lang_plugin_newsletter['x_subscriptions'], $number_of_subscriptions);
	}
	if ($category_array['public_view'] == 'YES' || GALLERY_ADMIN_MODE) { // It's allowed to display that category
	echo <<< EOT
	<tr>
		<td valign="top" class="tableb">
			{$lang_plugin_newsletter['subject']}
		</td>
		<td valign="top" colspan="2" class="tableb">
		    <strong>{$mailing_array['subject']}</strong>
		</td>
	</tr>
	<tr>
		<td valign="top" class="tableb tableb_alternate">
			{$lang_plugin_newsletter['date_sent']}
		</td>
		<td valign="top" colspan="2" class="tableb tableb_alternate">
		    {$date_sent}
		</td>
	</tr>
	<tr>
		<td valign="top" class="tableb">
			{$lang_plugin_newsletter['body']}
		</td>
		<td valign="top" colspan="2" class="tableb">
		    {$mailing_array['salutation']}<br />&nbsp;<br />
		    {$mailing_array['body']}
		</td>
	</tr>
	<tr>
		<td valign="top" class="tableb tableb_alternate">
			{$lang_plugin_newsletter['category']}
		</td>
		<td valign="top" colspan="2" class="tableb tableb_alternate">
		    {$category_array['name']}
		</td>
	</tr>
	<tr>
		<td valign="top" class="tableb">
			{$lang_plugin_newsletter['recipients']}
		</td>
		<td valign="top" colspan="2" class="tableb">
		    {$mailing_array['recipients']}
		</td>
	</tr>
EOT;
    }
} else { // Basic selection screen if there are absolutely no $_GET data that make sense
	$browse_by_category_output = browse_by_category_output();
	$browse_by_date_output = browse_by_date_output();
	echo <<< EOT
	<tr>
		<th valign="top" colspan="3" class="tableh2">
			{$lang_plugin_newsletter['choose_method']}
		</th>
	</tr>
	<tr>
		<th class="tableb" style="width:33%">
			{$lang_plugin_newsletter['browse_by_category']}
		</th>
		<th class="tableb tableb_alternate" style="width:33%">
			{$lang_plugin_newsletter['browse_by_date']}
		</th>
		<th class="tableb" style="width:33%">
			{$lang_plugin_newsletter['search_the_archive']}
		</th>
	</tr>
	<tr>
		<td class="tableb" valign="top">
			{$browse_by_category_output}
		</td>
		<td class="tableb tableb_alternate" valign="top">
			{$browse_by_date_output}
		</td>
		<td class="tableb" valign="top">
			search form not implemented yet
		</td>
	</tr>
EOT;
}
endtable();
pagefooter();
die;
?>