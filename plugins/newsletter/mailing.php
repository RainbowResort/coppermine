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
$message = '';

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
	$salutation_text = $superCage->post->getEscaped('salutation');
} else {
	$salutation_text = $lang_plugin_newsletter['default_salutation'];
}
if ($superCage->post->keyExists('subject')) {
	$subject_text = $superCage->post->getEscaped('subject');
} else {
	$subject_text = sprintf($lang_plugin_newsletter['default_subject'], $CONFIG['gallery_name'], localised_date(time(), $lang_date['lastcom']));
}
if ($superCage->post->keyExists('body')) {
	$body_text = $superCage->post->getEscaped('body');
} else {
	$body_text = sprintf($lang_plugin_newsletter['default_body'], $CONFIG['gallery_name']);
}
$salutation_help = '&nbsp;'. cpg_display_help('f=empty.htm&amp;base=64&amp;h='.urlencode(base64_encode(serialize($lang_plugin_newsletter['salutation']))).'&amp;t='.urlencode(base64_encode(serialize($lang_plugin_newsletter['salutation_explain']))), 470, 245);

if ($superCage->post->keyExists('submit')) { // The form has been submit
    //Check if the form token is valid
    if(!checkFormToken()){
        cpg_die(ERROR, $lang_errors['invalid_form_token'], __FILE__, __LINE__);
    }
    if ($superCage->post->keyExists('category')) {
        // Populate the database variables
        $result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PREFIX']}plugin_newsletter_subscriptions WHERE FIND_IN_SET(".$superCage->post->getInt('category').",category_list) > 0 AND subscriber_active = 'YES'");
        $loopCounter = 0;
        while ($row = mysql_fetch_assoc($result)) {
            $newsletter_subscriptions_by_cat[$loopCounter]['subscriber_id']     = $row['subscriber_id'];
            $newsletter_subscriptions_by_cat[$loopCounter]['user_id']           = $row['user_id'];
            $newsletter_subscriptions_by_cat[$loopCounter]['subscriber_active'] = $row['subscriber_active'];
            $newsletter_subscriptions_by_cat[$loopCounter]['subscriber_name']   = $row['subscriber_name'];
            $newsletter_subscriptions_by_cat[$loopCounter]['subscriber_email']  = $row['subscriber_email'];
            $loopCounter++;
        }
        mysql_free_result($result);
        // Write the mailing record
        cpg_db_query("INSERT INTO {$CONFIG['TABLE_PREFIX']}plugin_newsletter_mailings 
                      SET subject='".$superCage->post->getRaw('subject')."',
                          salutation='".$superCage->post->getRaw('salutation')."',
                          body='".$superCage->post->getRaw('body')."',
                          date_sent='" . time() . "',
                          category_id='".$superCage->post->getInt('category')."',
                          completed=0,
                          recipients='{$loopCounter}'");
        $mailing_id = mysql_insert_id();
        // Write the queue
        $loopCounter = 0;
        foreach ($newsletter_subscriptions_by_cat as $subscription_key => $subscription_value) {
            cpg_db_query("INSERT INTO {$CONFIG['TABLE_PREFIX']}plugin_newsletter_queue (`mailing_id`, `subscriber_id`, `time`) VALUES ('{$mailing_id}', '{$subscription_value['subscriber_id']}', '" . time() . "')");
        }
        cpgRedirectPage('index.php?file=newsletter/send', $lang_common['information'], $lang_plugin_newsletter['mailing_created']);
    } else {
        $message = <<< EOT
        <div class="cpg_message_error">
            {$lang_plugin_newsletter['you_need_to_select_a_category']}
        </div>
EOT;
    }
}




pageheader($lang_plugin_newsletter['create_mailing']);
echo <<< EOT
    <form action="" method="post" name="newsletter_catlist" id="newsletter_catlist">
EOT;
starttable('100%', $newsletter_icon_array['mailing'] . $lang_plugin_newsletter['create_mailing'], 2);
if ($message != '') {
    echo <<< EOT
    <tr>
        <td colspan="3">
            {$message}
        </td>
    </tr>
EOT;
}
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
	if ($row['public_view'] == 'YES') {
		$publicly_viewable = '<span title="'.$lang_plugin_newsletter['viewable_explanation'].'">'.$newsletter_icon_array['visible'].'</span>';
	} else {
		$publicly_viewable = '<span title="'.$lang_plugin_newsletter['not_viewable_explanation'].'">'.$newsletter_icon_array['invisible'].'</span>';
	}
	$frequency = newsletter_mailing_stats($row['category_id']);
	$color_array = array(0 => '#FF0000', 20 => '#EA3102', 40 => '#D56904', 60 => '#CA8405', 80 => '#B9AE08', 100 => '#ACCF09', 120 => '#A5E40B', 140 => '#ACCF09', 160 => '#B9AE08', 180 => '#CA8405', 200 => '#D56904', 220 => '#EA3102', 240 => '#FF0000');
	$match_percentage = round(100*$frequency[0]/$frequency[1]);
	foreach ($color_array as $key => $value) {
		if ($match_percentage >= $key) {
			$match_color = $value;
		}
	}
	if ($match_percentage > 200) {
		$match_percentage = 200;
	}
	$frequency_output = theme_display_bar(round($frequency[0]),$frequency[1],$match_percentage,'', '', '/'.$frequency[1],$match_color,'');
	$number_of_subscriptions = newsletter_subscriptions_per_category($row['category_id']);
	if ($number_of_subscriptions == 1) {
	    $number_of_subscriptions_string = $lang_plugin_newsletter['one_subscription'];
	} else {
	    $number_of_subscriptions_string = sprintf($lang_plugin_newsletter['x_subscriptions'], $number_of_subscriptions);
	}
	if ($number_of_subscriptions == 0) {
		$category_option_output = 'disabled="disabled" readonly="readonly"';
	} else {
		$category_option_output = '';
	}
	$mailings_count = newsletter_mailings_per_category($row['category_id']);
	if ($mailings_count == 1) {
	    $mailings_count = $lang_plugin_newsletter['one_mailing'];
	} else {
	    $mailings_count = sprintf($lang_plugin_newsletter['x_mailings'], $mailings_count);
	}
	echo <<< EOT
				<tr>
					<td valign="top">
						<input type="radio" name="category" id="category{$row['category_id']}" class="radio" value="{$row['category_id']}" {$category_option_output} />
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
						<span class="album_stat">{$mailings_count}</span>
					</td>
					<td valign="top" width="220">
						<span class="album_stat">{$frequency_output}</span>
					</td>
					<td valign="top">
						<span class="album_stat">{$number_of_subscriptions_string}</span>
					</td>
				</tr>
EOT;
    $loopCounter++;
}

list($timestamp, $form_token) = getFormToken();
echo <<< EOT
			</table>
		</td>
	</tr>
EOT;
if ($loopCounter == 0) {
    // There is no category available yet. Let's send the user to the category creation screen first
    echo <<< EOT
    <tr>
        <td colspan="3" class="tableb">
            <div class="cpg_message_error">
                {$lang_plugin_newsletter['you_need_at_least_one_category']}&nbsp;
                <a href="index.php?file=newsletter/catlist" class="admin_menu admin">{$newsletter_icon_array['catlist']}{$lang_plugin_newsletter['create_category']}</a>
            </div>
        </td>
    </tr>
EOT;
}
echo <<< EOT
    <tr>
        <td class="tablef" colspan="3">
            <input type="hidden" name="form_token" value="{$form_token}" />
            <input type="hidden" name="timestamp" value="{$timestamp}" />
            <button type="submit" class="button" name="submit" id="submit" value="{$lang_common['ok']}">{$newsletter_icon_array['ok']}{$lang_common['ok']}</button>
        </td>
    </tr>
EOT;
endtable();
echo <<< EOT
</form>
EOT;
pagefooter();
die;
?>