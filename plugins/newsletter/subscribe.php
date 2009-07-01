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
newsletter_install_check();
$newsletter_init_array = newsletter_initialize();
$lang_plugin_newsletter = $newsletter_init_array['language']; 
$newsletter_icon_array = $newsletter_init_array['icon'];
$display_submit_button = 0;
$subscriber_email_warning = '';
$message = '';
$USER_DATA = array_merge($USER_DATA, $cpg_udb->get_user_infos(USER_ID));

if (USER_ID) { // Populate the user's profile
    $message = sprintf($lang_plugin_newsletter['welcome_x'], $USER_DATA['user_name']) . '<br />' . $LINEBREAK;
    // Let's query the subscriptions table to see if there already is a record for the user
    $result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PREFIX']}plugin_newsletter_subscriptions
                            WHERE user_id='{$USER_DATA['user_id']}'
                            LIMIT 1");
    $loopCounter = 0;
    $existing_subscription_array = array();
    while ($row = mysql_fetch_assoc($result)) {
        $existing_subscription_array = $row;
    }
    if (mysql_num_rows($result) == 1) {
        $existing_subscription_array['subscription_exists'] = 1;
        $message .= $lang_plugin_newsletter['edit_your_subscription']; 
    } else {
        $existing_subscription_array['subscription_exists'] = 0;
        $message .= $lang_plugin_newsletter['subscribe'];
    }
    $existing_subscription_array['category_array'] = explode(',', $existing_subscription_array['category_list']);
    mysql_free_result($result);
    if ($USER_DATA['user_email'] == '') {
        $message = '<div class="cpg_message_error">' . $lang_plugin_newsletter['no_email_in_profile'] . '</div>';
    }
}

if (USER_ID || $CONFIG['plugin_newsletter_guest_subscriptions'] == '1') { 
    // Run the query for available categories
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
}

if ($superCage->post->keyExists('submit')) {
    //Check if the form token is valid
    if(!checkFormToken()){
        cpg_die(ERROR, $lang_errors['invalid_form_token'], __FILE__, __LINE__);
    }
	// Let's loop through the list of categories first that the visitor has submit
	// and filter out those that he's not allowed to subscribe to or that no longer exist
	$submit_subscription_array = $superCage->post->getInt('subscribe');
	$write_to_db_category_list = '';
	foreach ($newsletter_categories_db as $category) {
	    if (in_array($category['category_id'], $submit_subscription_array) == TRUE && ($category['open_for_subscription'] == 'YES' || GALLERY_ADMIN_MODE))  { // Existing record?
	        $write_to_db_category_list .= $category['category_id'] . ',';
	    }
	}
	$write_to_db_category_list = rtrim($write_to_db_category_list, ','); // trim the ending coma
	if (USER_ID) {
        $query = '';
        // There are two possibilities: new record or update existing record
        if ($existing_subscription_array['subscription_exists'] == 1) {
            // We have a returning user. 
            if ($USER_DATA['user_name']    != $existing_subscription_array['subscriber_name'] ||
                $USER_DATA['user_email']   != $existing_subscription_array['subscriber_email'] ||
                $write_to_db_category_list != $existing_subscription_array['category_list']) { // Has there been an actual change
                $query = "UPDATE {$CONFIG['TABLE_PREFIX']}plugin_newsletter_subscriptions 
                          SET subscriber_name='{$USER_DATA['user_name']}',
                              subscriber_email='{$USER_DATA['user_email']}',
                              category_list='{$write_to_db_category_list}'
                          WHERE user_id='{$USER_DATA['user_id']}'";
                $existing_subscription_array['category_list'] = $write_to_db_category_list;
                $existing_subscription_array['category_array'] = explode(',', $existing_subscription_array['category_list']);
                if ($write_to_db_category_list != '') {
                    $message = '<div class="cpg_message_success">' . $lang_plugin_newsletter['sbuscription_updated'] . '</div>';
                } else {
                    $message = '<div class="cpg_message_success">' . $lang_plugin_newsletter['you_have_unsubscribed'] . '</div>';
                }
            } else { // There have been no changes, so there's no need to run a query
                $message = '<div class="cpg_message_info">' . $lang_plugin_newsletter['no_update_needed'] . '</div>';
            }
        } else { // New subscription
            $time = time();
            $query = "INSERT INTO {$CONFIG['TABLE_PREFIX']}plugin_newsletter_subscriptions 
                      SET user_id='{$USER_DATA['user_id']}',
                          subscriber_active='YES',
                          subscriber_name='{$USER_DATA['user_name']}',
                          subscriber_regdate='" . time() . "',
                          subscriber_email='{$USER_DATA['user_email']}',
                          category_list='{$write_to_db_category_list}'";
            $existing_subscription_array['category_list'] = $write_to_db_category_list;
            $existing_subscription_array['category_array'] = explode(',', $existing_subscription_array['category_list']);
            if ($write_to_db_category_list != '') {
                $message = '<div class="cpg_message_success">' . $lang_plugin_newsletter['successfully_subscribed'] . '</div>';
            } else {
                $message = '<div class="cpg_message_validation">' . $lang_plugin_newsletter['at_least_one_category_needed'] . '</div>';
            }
        }
        if ($query != '') {
            cpg_db_query($query);
        }
	} else { // guest --- start
    	if ($superCage->post->keyExists('subscriber_email') == TRUE) {
            $temp = $superCage->post->getRaw('subscriber_email'); // Usually, we would not use that method, but we'll sanitize later.
    		if (preg_match('#^([a-zA-Z0-9]((\.|\-|\_){0,1}[a-zA-Z0-9]){0,})@([a-zA-Z]((\.|\-){0,1}[a-zA-Z0-9]){0,})\.([a-zA-Z]{2,4})$#i', $temp)) {
    	        // The email Address is OK
    			$subscriber_email_warning = '';
            } else {
    			$subscriber_email_warning = $lang_plugin_newsletter['email_address_invalid'];
    		}
    	}
	} // guest --- end
}



pageheader($lang_plugin_newsletter['newsletter-subscription']);

echo <<< EOT
    <form action="" method="post" name="newsletter_subscribe" id="newsletter_subscribe">
EOT;
starttable('100%', $newsletter_icon_array['subscribe'] . $lang_plugin_newsletter['newsletter-subscription'], 3, 'cpg_zebra');
if (USER_ID) {
    // We have a registered user here --- start
	$display_submit_button++;
	if ($CONFIG['allow_email_change'] != '0' || $CONFIG['bridge_enable'] != '0' || GALLERY_ADMIN_MODE) {
		$subscriber_email_warning = sprintf($lang_plugin_newsletter['email_from_profile'], '<a href="profile.php?op=edit_profile">', '</a>');
	} else {
		$subscriber_email_warning = sprintf($lang_plugin_newsletter['email_from_profile'], '', '');
	}
	if ($USER_DATA['user_email'] != $existing_subscription_array['subscriber_email']) { // Update email record if profile email differs from plugin db record
		$existing_subscription_array['subscriber_email'] = $USER_DATA['user_email'];
		$query = "UPDATE {$CONFIG['TABLE_PREFIX']}plugin_newsletter_subscriptions 
				  SET subscriber_email='{$USER_DATA['user_email']}' 
				  WHERE user_id='{$USER_DATA['user_id']}'";
		cpg_db_query($query);
	}
	$subscriber_email_warning = '<span class="album_stat">' . $subscriber_email_warning . '</span>';
    echo <<< EOT
    <tr>
        <td colspan="3" class="tableh2">
			{$message}
        </td>
    </tr>
    <tr>
        <td>
            {$lang_plugin_newsletter['your_name']}:
        </td>
        <td colspan="2">
            <input type="text" name="subscriber_name" id="subscriber_name" class="textinput" size="40" maxlength="100" value="{$USER_DATA['user_name']}" disabled="disabled" readonly="readonly" title="{$lang_plugin_newsletter['your_cant_edit_this_field']}"  />
        </td>
    </tr>
	<tr>
        <td>
            {$lang_plugin_newsletter['your_email']}:
        </td>
        <td>
            <input type="text" name="user_email" id="user_email" class="textinput" size="40" maxlength="100" value="{$USER_DATA['user_email']}" disabled="disabled" readonly="readonly" title="{$lang_plugin_newsletter['your_cant_edit_this_field']}" />
        </td>
		<td>
			{$subscriber_email_warning}
		</td>
    </tr>
EOT;
    // We have a registered user here --- end
} else {
    // We have a guest --- start
    if ($CONFIG['plugin_newsletter_guest_subscriptions'] != '0') {
        // The guest is allowed to subscribe as well, so let's display the form fields for the email address
        $registration_message = sprintf($lang_plugin_newsletter['alternatively_register_to subscribe'], '<a href="register">', '</a>');
		if ($superCage->post->keyExists('subscriber_email') == TRUE) {
			$subscriber_email_value = $superCage->post->getRaw('subscriber_email');
		} else {
			$subscriber_email_value = '';
		}
		$display_submit_button++;
        echo <<< EOT
    <tr>
        <td>
            {$lang_plugin_newsletter['your_email']}
        </td>
        <td>
            <input type="text" name="subscriber_email" id="subscriber_email" class="textinput" size="30" maxlength="100" value="{$subscriber_email_value}" />
        </td>
        <td>
			{$subscriber_email_warning}
        </td>
    </tr>
EOT;
    } else {
        // The guest is not allowed to subscribe
        $registration_message = sprintf($lang_plugin_newsletter['register_to subscribe'], '<a href="register">', '</a>');
        echo <<< EOT
    <tr>
        <td colspan="3">
            {$lang_plugin_newsletter['not_allowed_to_subscribe']}
        </td>
    </tr>
EOT;
    }
    // Promote registration
    if ($CONFIG['allow_user_registration'] != 0) {
        echo <<< EOT
    <tr>
        <td colspan="3">
            {$registration_message}
        </td>
    </tr>
EOT;
    }
    // We have a guest --- end
}

// Display the list of categories to subscribe --- start
if (USER_ID || $CONFIG['plugin_newsletter_guest_subscriptions'] == '1') { 
    $loopCounter = 0;
    $category_output = '';
    foreach ($newsletter_categories_db as $category_loop => $category) {
        if ($category['open_for_subscription'] == 'YES' || $category['public_view'] == 'YES' || GALLERY_ADMIN_MODE) {
            if ($loopCounter == 0) {
                $leftcol_output = $lang_plugin_newsletter['subscribe_to'] . ': ';
            } else {
                $leftcol_output = '';
            }
			if (in_array($category['category_id'], $existing_subscription_array['category_array']) == TRUE) {
				$checkbox_checked ='checked="checked"';
			} else {
				$checkbox_checked ='';
			}
            if ($category['open_for_subscription'] == 'YES' || GALLERY_ADMIN_MODE) {
                $checkbox_output = '<input type="checkbox" name="subscribe[]" id="subscribe'.$loopCounter.'" value="'.$category['category_id'].'" class="checkbox" ' . $checkbox_checked . ' />';
            } else {
                $checkbox_output = '<input type="checkbox" name="subscribe[]" value="" class="checkbox" disabled="disabled" readonly="readonly" />';
            }
            if ($category['public_view'] == 'YES' || GALLERY_ADMIN_MODE) {
                $name_output = '<a href="index.php?file=newsletter/archive&amp;cat=' . $category['category_id'] . '" title="' . $lang_plugin_newsletter['browse_archived_mailings'] . '">' . $category['name'] . '</a>';
            } else {
                $name_output = '<label for="subscribe'.$loopCounter.'" class="clickable_option">' .
				                $category['name'] . 
								'</label>';
            } 
            if ($category['description'] != '') {
                $description_output = '<br /><label for="subscribe'.$loopCounter.'" class="album_stat clickable_option" style="padding-left:30px">' . $category['description'] . '</label>';
            } else {
                $description_output = '';
            }
            $frequency_words = newsletter_frequency_words();
            if (array_key_exists($category['frequency_year'], $frequency_words) == TRUE) {
                $frequency_output = $lang_plugin_newsletter[$frequency_words[$category['frequency_year']]];
            } else {
                $frequency_output = sprintf($lang_plugin_newsletter['frequency_x_times_per_year'], $category['frequency_year']);
            }
            $frequency_output = '<span class="album_stat">' . $lang_plugin_newsletter['frequency'] . ': ' . $frequency_output . '</span>';
            $category_output .= <<< EOT
                <tr>
                    <td>
                        {$leftcol_output}
                    </td>
                    <td>
                        {$checkbox_output}
                        {$name_output}
                        {$description_output}
                    </td>
                    <td>
                        {$frequency_output}
                    </td>
                </tr>
EOT;
        }
        $loopCounter++;
    }
    if ($loopCounter > 0) {
        echo $category_output;
    } else {
        echo <<< EOT
                <tr>
                    <td>
                        {$lang_plugin_newsletter['subscribe_to']}
                    </td>
                    <td colspan="2">
                        {$lang_plugin_newsletter['no_newsletter_to_subscribe_to']}
                    </td>
                </tr>
EOT;
    }
}
// Display the list of categories to subscribe --- end

list($timestamp, $form_token) = getFormToken();
if ($display_submit_button != 0) {
	echo <<< EOT
    <tr>
        <td class="tablef" colspan="3">
            <input type="hidden" name="form_token" value="{$form_token}" />
            <input type="hidden" name="timestamp" value="{$timestamp}" />			
			<button type="submit" class="button" name="submit" value="{$lang_common['ok']}">{$newsletter_icon_array['ok']}{$lang_common['ok']}</button>
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