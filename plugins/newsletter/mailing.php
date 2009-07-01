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

if (!GALLERY_ADMIN_MODE) {
	cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
}

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

// Populate the form defaults
if ($superCage->post->keyExists('salutation')) {
	$salutation_text = $superCage->post->getRaw('salutation');
} else {
	$salutation_text = $lang_plugin_newsletter['default_salutation'];
}
if ($superCage->post->keyExists('subject')) {
	$subject_text = $superCage->post->getRaw('subject');
} else {
	$subject_text = sprintf($lang_plugin_newsletter['default_subject'], $CONFIG['gallery_name'], localised_date(time(), $lang_date['lastcom']));
}
if ($superCage->post->keyExists('body')) {
	$body_text = $superCage->post->getRaw('body');
} else {
	$body_text = sprintf($lang_plugin_newsletter['default_body'], $CONFIG['gallery_name']);
}
$salutation_help = '&nbsp;'. cpg_display_help('f=empty.htm&amp;base=64&amp;h='.urlencode(base64_encode(serialize($lang_plugin_newsletter['salutation']))).'&amp;t='.urlencode(base64_encode(serialize($lang_plugin_newsletter['salutation_explain']))), 470, 245);

pageheader($lang_plugin_newsletter['create_mailing']);
starttable('100%', $newsletter_icon_array['mailing'] . $lang_plugin_newsletter['create_mailing'], 2);
echo <<< EOT
	<tr>
		<td class="tableb">
			{$lang_plugin_newsletter['subject']}
		</td>
		<td class="tableb">
			<input type="text" name="subject" id="subject" class="textinput" size="60" maxlength="100" value="{$subject_text}" style="width:90%" />
		</td>
	</tr>
	<tr>
		<td valign="top" class="tableb tableb_alternate">
			{$lang_plugin_newsletter['salutation']}
		<td valign="top" class="tableb tableb_alternate">
			<input type="text" name="salutation" id="salutation" class="textinput" size="60" maxlength="100" value="{$salutation_text}"  style="width:90%" />{$salutation_help}
		</td>
	</tr>
	<tr>
		<td valign="top" class="tableb">
			{$lang_plugin_newsletter['body']}
		</td>
		<td valign="top" class="tableb">
			<textarea name="body" id="body" rows="1" cols="80" class="textinput" style="height:300px;width:90%">{$body_text}</textarea>
		</td>
	</tr>
	<tr>
		<td valign="top" class="tableb tableb_alternate">
			{$lang_plugin_newsletter['category']}
		</td>
		<td valign="top" align="left" class="tableb tableb_alternate">
			<table border="0" width="90%" cellspacing="0" cellpadding="0" class="cpg_zebra">
EOT;
// Loop through the categories
$loopCounter = 0;
foreach ($newsletter_categories_db as $category_loop => $row) {
	if ($row['open_for_subscription'] == 'YES') {
		$open_for_subscription = '<span title="'.$lang_plugin_newsletter['open_explanation'].'">'.$newsletter_icon_array['unlocked'].'</span>';
	} else {
		$open_for_subscription = '<span title="'.$lang_plugin_newsletter['closed_explanation'].'">'.$newsletter_icon_array['locked'].'</span>';
	}
	if ($row['open_for_subscription'] == 'YES') {
		$publicly_viewable = '<span title="'.$lang_plugin_newsletter['viewable_explanation'].'">'.$newsletter_icon_array['visible'].'</span>';
	} else {
		$publicly_viewable = '<span title="'.$lang_plugin_newsletter['not_viewable_explanation'].'">'.$newsletter_icon_array['invisible'].'</span>';
	}
	$frequency = count(newsletter_mailing_frequency($row['category_id']));
	echo <<< EOT
				<tr>
					<td valign="top">
						<input type="radio" name="category" id="category{$row['category_id']}" class="radio" value="{$row['category_id']}" />
						<label for="category{$row['category_id']}" class="clickable_option">{$row['name']}</label>
					</td>
					<td valign="top">
						<span class="album_stat">{$row['description']}</span>
					</td>
					<td valign="top">
						{$open_for_subscription}
					</td>
					<td valign="top">
						{$publicly_viewable}
					</td>
					<td valign="top">
						<span class="album_stat">{$frequency}</span>
					</td>
					<td valign="top">
						<span class="album_stat">Number of subscriptions here</span>
					</td>
				</tr>
EOT;
}
echo <<< EOT
			</table>
		</td>
	</tr>
EOT;
endtable();

pagefooter();
die;
?>