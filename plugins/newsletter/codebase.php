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

$thisplugin->add_action('page_start','newsletter_initialize');
$thisplugin->add_action('plugin_install','newsletter_install');
$thisplugin->add_action('plugin_uninstall','newsletter_uninstall');
$thisplugin->add_action('plugin_cleanup','newsletter_cleanup');
$thisplugin->add_action('plugin_configure','newsletter_configure');
$thisplugin->add_filter('admin_menu','newsletter_admin_menu_button');
if ($CONFIG['plugin_newsletter_visitor_menu_links'] == 1) {
    $thisplugin->add_filter('sys_menu','newsletter_menu_button');
} elseif ($CONFIG['plugin_newsletter_visitor_menu_links'] == 2) {
    $thisplugin->add_filter('sub_menu','newsletter_menu_button');
}

function newsletter_install() {
    global $CONFIG, $newsletter_installation, $thisplugin, $USER_DATA, $lang_plugin_newsletter;
	// Create the super cage
	$superCage = Inspekt::makeSuperCage();
	$newsletter_installation = 1;
	require 'include/sql_parse.php';
	
    // Perform the database changes
    $db_schema = $thisplugin->fullpath . '/schema.sql';
    $sql_query = fread(fopen($db_schema, 'r'), filesize($db_schema));
    $sql_query = preg_replace('/CPG_/', $CONFIG['TABLE_PREFIX'], $sql_query);
    $sql_query = preg_replace('/ADMIN_EMAIL/', $CONFIG['gallery_admin_email'], $sql_query);
    $sql_query = preg_replace('/ADMIN_USERNAME/', $USER_DATA['user_name'], $sql_query);
	$sql_query = preg_replace('/COPPERMINE_SITE_NAME/', $CONFIG['gallery_name'], $sql_query);
    $sql_query = remove_remarks($sql_query);
    $sql_query = split_sql_file($sql_query, ';');
    foreach($sql_query as $q) {
    	cpg_db_query($q);
    }
	// Set the plugin config defaults
	$plugin_config_defaults = array(
	                                'plugin_newsletter_guest_subscriptions' => '0',
	                                'plugin_newsletter_salutation_for_guests' => 'Dear subscriber,',
	                                'plugin_newsletter_from_email' => $CONFIG['gallery_admin_email'],
	                                'plugin_newsletter_from_name' => $USER_DATA['user_name'],
	                                'plugin_newsletter_mails_per_page' => '1',
	                                'plugin_newsletter_admin_menu_links' => '1',
	                                'plugin_newsletter_visitor_menu_links' => '2',
	                                );
	foreach ($plugin_config_defaults as $key => $value) {
	    if (!$CONFIG[$key]) {
	        $CONFIG[$key] = $value;
	    }
	}
	
	if ($superCage->post->keyExists('submit')) {
		newsletter_configuration_submit();
		return true;
	} else {
		return 1;
	}
}

function newsletter_uninstall() {
	global $CONFIG;
	$superCage = Inspekt::makeSuperCage();
	if (!$superCage->post->keyExists('submit')) {
		return 1;
	}
	// Drop the database records
	if ($superCage->post->keyExists('drop_config') && $superCage->post->getInt('drop_config') == 1) {
		cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_newsletter_guest_subscriptions'");
		cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_newsletter_salutation_for_guests'");
		cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_newsletter_from_email'");
		cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_newsletter_from_name'");
		cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_newsletter_mails_per_page'");
		cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_newsletter_admin_menu_links'");
		cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_newsletter_visitor_menu_links'");
	}
	if ($superCage->post->keyExists('drop_subscribers') && $superCage->post->getInt('drop_subscribers') == 1) {
		cpg_db_query("DROP TABLE IF EXISTS {$CONFIG['TABLE_PREFIX']}plugin_newsletter_subscriptions");
	}
	if ($superCage->post->keyExists('drop_categories') && $superCage->post->getInt('drop_categories') == 1) {
		cpg_db_query("DROP TABLE IF EXISTS {$CONFIG['TABLE_PREFIX']}plugin_newsletter_categories");
	}
	if ($superCage->post->keyExists('drop_mailings') && $superCage->post->getInt('drop_mailings') == 1) {
		cpg_db_query("DROP TABLE IF EXISTS {$CONFIG['TABLE_PREFIX']}plugin_newsletter_mailings");
	}
	if ($superCage->post->keyExists('drop_queue') && $superCage->post->getInt('drop_queue') == 1) {
		cpg_db_query("DROP TABLE IF EXISTS {$CONFIG['TABLE_PREFIX']}plugin_newsletter_queue");
	}
	return true;
}

// Ask if we want to drop the table
function newsletter_cleanup($action) {
    global $CONFIG, $LINEBREAK, $lang_plugin_newsletter, $lang_common, $newsletter_icon_array;
	// Initialize language and icons
	require_once './plugins/newsletter/init.inc.php';
	$newsletter_init_array = newsletter_initialize();
	$lang_plugin_newsletter = $newsletter_init_array['language']; 
	$newsletter_icon_array = $newsletter_init_array['icon'];
    $superCage = Inspekt::makeSuperCage();
    $cleanup = $superCage->server->getEscaped('REQUEST_URI');
	$hidden_array = array();
    if ($action===1) {
    	// Come up with the total number of records for the plugin tables
    	$result = cpg_db_query("SELECT COUNT(*) FROM {$CONFIG['TABLE_PREFIX']}plugin_newsletter_mailings");
    	list($total_mailings) = mysql_fetch_row($result);
    	mysql_free_result($result);
    	$result = cpg_db_query("SELECT COUNT(*) FROM {$CONFIG['TABLE_PREFIX']}plugin_newsletter_subscriptions");
    	list($total_subscribers) = mysql_fetch_row($result);
    	mysql_free_result($result);
    	$result = cpg_db_query("SELECT COUNT(*) FROM {$CONFIG['TABLE_PREFIX']}plugin_newsletter_queue");
    	list($total_queued) = mysql_fetch_row($result);
    	mysql_free_result($result);
    	$result = cpg_db_query("SELECT COUNT(*) FROM {$CONFIG['TABLE_PREFIX']}plugin_newsletter_categories");
    	list($total_categories) = mysql_fetch_row($result);
    	mysql_free_result($result);
    
        echo <<< EOT
    <form action="{$cleanup}" method="post">
EOT;
    starttable('100%', '', 2);

        if ($total_mailings > 0) {
            echo <<< EOT
            <tr>
                <td class="tableh2" colspan="2">
                    {$lang_plugin_newsletter['remove_plugin_warning']}
                </td>
            </tr>
EOT;
        }
        echo <<< EOT
            <tr>
                <td class="tableb">
                    {$lang_plugin_newsletter['config']}
                </td>
                <td class="tableb">
                    <input type="checkbox" class="checkbox" name="drop_config" id="drop_config" value="1" />
                    <label for="drop_config" class="clickable_option">{$lang_plugin_newsletter['remove_config']}<br />({$lang_plugin_newsletter['remove_config_explanation']})</label>
                </td>
            </tr>
EOT;
        if ($total_subscribers > 0) {
            echo <<< EOT
            <tr>
                <td class="tableb tableb_alternate">
                    {$lang_plugin_newsletter['subscriber_list']}
                </td>
                <td class="tableb tableb_alternate">
                    <input type="checkbox" class="checkbox" name="drop_subscribers" id="drop_subscribers" value="1" />
                    <label for="drop_subscribers" class="clickable_option">{$lang_plugin_newsletter['remove_subscribers']}<br />({$lang_plugin_newsletter['remove_subscribers_explanation']})</label>
                </td>
            </tr>
EOT;
        } else {
			$hidden_array[] = 'drop_subscribers';
		}
        if ($total_categories > 0) {
            echo <<< EOT
            <tr>
                <td class="tableb">
                    {$lang_plugin_newsletter['newsletter_categories']}
                </td>
                <td class="tableb">
                    <input type="checkbox" class="checkbox" name="drop_categories" id="drop_categories" value="1" />
                    <label for="drop_categories" class="clickable_option">{$lang_plugin_newsletter['remove_categories']}<br />({$lang_plugin_newsletter['remove_categories_explanation']})</label>
                </td>
            </tr>
EOT;
        } else {
			$hidden_array[] = 'drop_categories';
		}
        if ($total_mailings > 0) {
            echo <<< EOT
            <tr>
                <td class="tableb tableb_alternate">
                    {$lang_plugin_newsletter['mailings']}
                </td>
                <td class="tableb tableb_alternate">
                    <input type="checkbox" class="checkbox" name="drop_mailings" id="drop_mailings" value="1" />
                    <label for="drop_mailings" class="clickable_option">{$lang_plugin_newsletter['remove_mailings']}<br />({$lang_plugin_newsletter['remove_mailings_explanation']})</label>
                </td>
            </tr>
EOT;
        } else {
			$hidden_array[] = 'drop_mailings';
		}
        if ($total_queued > 0) {
            echo <<< EOT
            <tr>
                <td class="tableb tableb_alternate">
                    {$lang_plugin_newsletter['mail_queue']}
                </td>
                <td class="tableb tableb_alternate">
                    <input type="checkbox" class="checkbox" name="drop_queue" id="drop_queue" value="1" />
                    <label for="drop_queue" class="clickable_option">{$lang_plugin_newsletter['remove_queue']}<br />({$lang_plugin_newsletter['remove_queue_explanation']})</label>
                </td>
            </tr>
EOT;
        } else {
			$hidden_array[] = 'drop_queue';
		}
        echo <<< EOT
            <tr>
                <td class="tablef">
					<button type="submit" class="button" name="submit" value="{$lang_common['go']}">{$newsletter_icon_array['ok']}{$lang_common['go']}</button>
				</td>
				<td class="tablef">
				    {$lang_plugin_newsletter['drop_table_warning']}<br />
                </td>
            </tr>
EOT;
	    endtable();
		foreach ($hidden_array as $value) {
			echo '<input type="hidden" name="'.$value.'" value="1" />' . $LINEBREAK;
		}
        echo <<< EOT
    </form>
EOT;
    }
}

function newsletter_admin_menu_button($admin_menu) {
    global $CONFIG;
    if ($CONFIG['plugin_newsletter_admin_menu_links'] == 1) {
    	// Initialize language and icons
    	require_once './plugins/newsletter/init.inc.php';
    	$newsletter_init_array = newsletter_initialize();
    	$lang_plugin_newsletter = $newsletter_init_array['language']; 
    	$newsletter_icon_array = $newsletter_init_array['icon'];
	    $new_button = '<div class="admin_menu admin_float"><a href="index.php?file=newsletter/admin">';
	    $new_button .= $newsletter_icon_array['config'] . $lang_plugin_newsletter['config'] . '</a></div>';
	    $new_button .= '<div class="admin_menu admin_float"><a href="index.php?file=newsletter/catlist">';
	    $new_button .= $newsletter_icon_array['catlist'] . $lang_plugin_newsletter['newsletter_categories'] . '</a></div>';
		$new_button .= '<div class="admin_menu admin_float"><a href="index.php?file=newsletter/mailing">';
	    $new_button .= $newsletter_icon_array['mailing'] . $lang_plugin_newsletter['create_mailing'] . '</a></div>';
		$new_button .= '<div class="admin_menu admin_float"><a href="index.php?file=newsletter/archive"';
	    $new_button .= ' title="'.$lang_plugin_newsletter['browse_archived_mailings'].'">';
	    $new_button .= $newsletter_icon_array['archive'] . $lang_plugin_newsletter['archive'] . '</a></div>';
	    $look_for = '<!-- END export -->'; // This is where you determine the place in the admin menu
	    $admin_menu = str_replace($look_for, $look_for . $new_button, $admin_menu);
    }
    return $admin_menu;
}

function newsletter_menu_button($menu) {
    global $CONFIG, $lang_plugin_newsletter, $template_sys_menu_spacer, $template_sub_menu_spacer;
	// Initialize language and icons
	require_once './plugins/newsletter/init.inc.php';
	$newsletter_init_array = newsletter_initialize();
	$lang_plugin_newsletter = $newsletter_init_array['language']; 
    $new_button = array();
    $new_button[0][0] = $lang_plugin_newsletter['subscribe_to_newsletter'];
    $new_button[0][1] = $lang_plugin_newsletter['subscribe_to_newsletter'];
    $new_button[0][2] = 'index.php?file=newsletter/subscribe';
    $new_button[0][3] = 'newsletter_subscribe';
    if ($CONFIG['plugin_newsletter_visitor_menu_links'] == 1) {
        $new_button[0][4] = $template_sys_menu_spacer;
    } elseif ($CONFIG['plugin_newsletter_visitor_menu_links'] == 2) {
        $new_button[0][4] = $template_sub_menu_spacer;
    } 
    $new_button[0][5] = '';
    array_splice($menu, count($menu)-1, 0, $new_button);
    return $menu;
}

function newsletter_configuration_submit() {
	global $CONFIG;
	$superCage = Inspekt::makeSuperCage();
	// Populate the form fields and run the queries for the submit form
    $config_changes_counter = 0;
    if (!GALLERY_ADMIN_MODE) {
    	cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
    }
	
	// plugin_newsletter_guest_subscriptions
    if ($superCage->post->keyExists('plugin_newsletter_guest_subscriptions') == TRUE && ($superCage->post->getInt('plugin_newsletter_guest_subscriptions') == '0'  || $superCage->post->getInt('plugin_newsletter_guest_subscriptions') == '1') ) {
        if ($superCage->post->getInt('plugin_newsletter_guest_subscriptions') != $CONFIG['plugin_newsletter_guest_subscriptions']) {
        	$CONFIG['plugin_newsletter_guest_subscriptions'] = $superCage->post->getInt('plugin_newsletter_guest_subscriptions');
        	$query = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_newsletter_guest_subscriptions']}' WHERE name='plugin_newsletter_guest_subscriptions'";
        	cpg_db_query($query);
        	$config_changes_counter++;
    	}
    }
	
    // plugin_newsletter_salutation_for_guests
    if ($superCage->post->keyExists('plugin_newsletter_salutation_for_guests') == TRUE) {
        if ($CONFIG['plugin_newsletter_salutation_for_guests'] != $superCage->post->getRaw('plugin_newsletter_salutation_for_guests')) {
            $CONFIG['plugin_newsletter_salutation_for_guests'] = $superCage->post->getRaw('plugin_newsletter_salutation_for_guests'); // Usually, we would not use that method, but it's the admin - he should know what he does
            $query = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_newsletter_salutation_for_guests']}' WHERE name='plugin_newsletter_salutation_for_guests'";
            cpg_db_query($query);
            $config_changes_counter++;
        }
    }
    
    // plugin_newsletter_from_email
    if ($superCage->post->keyExists('plugin_newsletter_from_email') == TRUE) {
        $temp = $superCage->post->getRaw('plugin_newsletter_from_email'); // Usually, we would not use that method, but we'll sanitize later.
		if (preg_match('#^([a-zA-Z0-9]((\.|\-|\_){0,1}[a-zA-Z0-9]){0,})@([a-zA-Z]((\.|\-){0,1}[a-zA-Z0-9]){0,})\.([a-zA-Z]{2,4})$#i', $temp)) {
	        if ($CONFIG['plugin_newsletter_from_email'] != $temp) {
	            $CONFIG['plugin_newsletter_from_email'] = $temp;
	            $query = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_newsletter_from_email']}' WHERE name='plugin_newsletter_from_email'";
	            cpg_db_query($query);
	            $config_changes_counter++;
	        }
        }
    }
    
    // plugin_newsletter_from_name
    if ($superCage->post->keyExists('plugin_newsletter_from_name') == TRUE) {
        if ($CONFIG['plugin_newsletter_from_name'] != $superCage->post->getRaw('plugin_newsletter_from_name')) {
            $CONFIG['plugin_newsletter_from_name'] = $superCage->post->getRaw('plugin_newsletter_from_name'); // Usually, we would not use that method, but it's the admin - he should know what he does
            $query = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_newsletter_from_name']}' WHERE name='plugin_newsletter_from_name'";
            cpg_db_query($query);
            $config_changes_counter++;
        }
    }
    
    // plugin_newsletter_mails_per_page
    if ($superCage->post->keyExists('plugin_newsletter_mails_per_page') == TRUE) {
        if ($superCage->post->getInt('plugin_newsletter_mails_per_page') >= 1 && $superCage->post->getInt('plugin_newsletter_mails_per_page') <= 500 && $CONFIG['plugin_newsletter_mails_per_page'] != $superCage->post->getInt('plugin_newsletter_mails_per_page')) {
            $CONFIG['plugin_newsletter_mails_per_page'] = $superCage->post->getInt('plugin_newsletter_mails_per_page');
            $query = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_newsletter_mails_per_page']}' WHERE name='plugin_newsletter_mails_per_page'";
            cpg_db_query($query);
            $config_changes_counter++;
        }
    }
    
    // plugin_newsletter_admin_menu_links
    if ($superCage->post->keyExists('plugin_newsletter_admin_menu_links') == TRUE && ($superCage->post->getInt('plugin_newsletter_admin_menu_links') == '0'  || $superCage->post->getInt('plugin_newsletter_admin_menu_links') == '1') ) {
        if ($superCage->post->getInt('plugin_newsletter_admin_menu_links') != $CONFIG['plugin_newsletter_admin_menu_links']) {
        	$CONFIG['plugin_newsletter_admin_menu_links'] = $superCage->post->getInt('plugin_newsletter_admin_menu_links');
        	$query = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_newsletter_admin_menu_links']}' WHERE name='plugin_newsletter_admin_menu_links'";
        	cpg_db_query($query);
        	$config_changes_counter++;
    	}
    }
	
    // plugin_newsletter_visitor_menu_links
    if ($superCage->post->keyExists('plugin_newsletter_visitor_menu_links') == TRUE && ($superCage->post->getInt('plugin_newsletter_visitor_menu_links') == '0'  || $superCage->post->getInt('plugin_newsletter_visitor_menu_links') == '1' || $superCage->post->getInt('plugin_newsletter_visitor_menu_links') == '2') ) {
        if ($superCage->post->getInt('plugin_newsletter_visitor_menu_links') != $CONFIG['plugin_newsletter_visitor_menu_links']) {
        	$CONFIG['plugin_newsletter_visitor_menu_links'] = $superCage->post->getInt('plugin_newsletter_visitor_menu_links');
        	$query = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_newsletter_visitor_menu_links']}' WHERE name='plugin_newsletter_visitor_menu_links'";
        	cpg_db_query($query);
        	$config_changes_counter++;
    	}
    }
	
	return $config_changes_counter;
}

// Configure function: displays the configuration form
function newsletter_configure() {
    global $CONFIG, $thisplugin, $lang_plugin_newsletter, $lang_common, $newsletter_icon_array, $lang_errors, $newsletter_installation;
    $superCage = Inspekt::makeSuperCage();
    if (!GALLERY_ADMIN_MODE) {
    	cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
    }
    
    // Form submit?
    if ($superCage->post->keyExists('submit') == TRUE) {
        //Check if the form token is valid
        if(!checkFormToken()){
            cpg_die(ERROR, $lang_errors['invalid_form_token'], __FILE__, __LINE__);
        }
		$config_changes_counter = newsletter_configuration_submit();
    	if ($config_changes_counter > 0) {
    		$additional_submit_information = '<div class="cpg_message_success">' . $lang_plugin_newsletter['changes_saved'] . '</div>';
    	} else {
    		$additional_submit_information = '<div class="cpg_message_validation">' . $lang_plugin_newsletter['no_changes'] . '</div>';
    	}
    }
	
    // Set the option output stuff 
	if ($CONFIG['plugin_newsletter_guest_subscriptions'] == '1') {
    	$option_output['plugin_newsletter_guest_subscriptions_yes'] = 'checked="checked"';
    	$option_output['plugin_newsletter_guest_subscriptions_no'] = '';
    } else { // 
    	$option_output['plugin_newsletter_guest_subscriptions_yes'] = '';
    	$option_output['plugin_newsletter_guest_subscriptions_no'] = 'checked="checked"';
    }
    

    if ($CONFIG['plugin_newsletter_admin_menu_links'] == '1') {
    	$option_output['plugin_newsletter_admin_menu_links_yes'] = 'checked="checked"';
    	$option_output['plugin_newsletter_admin_menu_links_no'] = '';
    } else { // 
    	$option_output['plugin_newsletter_admin_menu_links_yes'] = '';
    	$option_output['plugin_newsletter_admin_menu_links_no'] = 'checked="checked"';
    }
    
    if ($CONFIG['plugin_newsletter_visitor_menu_links'] == '1') {
    	$option_output['plugin_newsletter_visitor_menu_links_sys'] = 'checked="checked"';
    	$option_output['plugin_newsletter_visitor_menu_links_sub'] = '';
    	$option_output['plugin_newsletter_visitor_menu_links_no'] = '';
    } elseif($CONFIG['plugin_newsletter_visitor_menu_links'] == '2') {
    	$option_output['plugin_newsletter_visitor_menu_links_sys'] = '';
    	$option_output['plugin_newsletter_visitor_menu_links_sub'] = 'checked="checked"';
    	$option_output['plugin_newsletter_visitor_menu_links_no'] = '';
    } else {
    	$option_output['plugin_newsletter_visitor_menu_links_sys'] = '';
    	$option_output['plugin_newsletter_visitor_menu_links_sub'] = '';
    	$option_output['plugin_newsletter_visitor_menu_links_no'] = 'checked="checked"';
    }

	// Create the table row that is displayed during initial install
	if ($newsletter_installation == 1) {
		$additional_submit_information = '<div class="cpg_message_info">' . $lang_plugin_newsletter['submit_to_install'] . '</div>';
		$install_section = <<< EOT

EOT;

	}
	
	list($timestamp, $form_token) = getFormToken();
	
	// Start the actual output
    echo <<< EOT
            <form action="" method="post" name="newsletter_config" id="newsletter_config">
EOT;

    starttable('100%', $newsletter_icon_array['config'] . $lang_plugin_newsletter['config'], 2);
    echo <<< EOT
                    <tr>
                        <td valign="top" class="tableb">
                            {$lang_plugin_newsletter['allow_guest_subscriptions']}
                        </td>
                        <td valign="top" class="tableb">
							<input type="radio" name="plugin_newsletter_guest_subscriptions" id="plugin_newsletter_guest_subscriptions_yes" class="checkbox" value="1" {$option_output['plugin_newsletter_guest_subscriptions_yes']} disabled="disabled" readonly="readonly" /> 
                        	<label for="plugin_newsletter_guest_subscriptions_yes">{$lang_common['yes']}</label>
                        	&nbsp;
                        	<input type="radio" name="plugin_newsletter_guest_subscriptions" id="plugin_newsletter_guest_subscriptions_no" class="checkbox" value="0" {$option_output['plugin_newsletter_guest_subscriptions_no']} /> 
                        	<label for="plugin_newsletter_guest_subscriptions_no">{$lang_common['no']}</label>
                        </td>
                    </tr>
					<tr>
                        <td valign="top" class="tableb tableb_alternate">
                            {$lang_plugin_newsletter['salutation_for_guests']}
                        </td>
                        <td valign="top" class="tableb tableb_alternate">
							<input type="text" name="plugin_newsletter_salutation_for_guests" id="plugin_newsletter_salutation_for_guests" class="textinput" size="30" maxlength="100" value="{$CONFIG['plugin_newsletter_salutation_for_guests']}" disabled="disabled" readonly="readonly" />
                        </td>
                    </tr>
					<tr>
                        <td valign="top" class="tableb">
                            {$lang_plugin_newsletter['from_email']}
                        </td>
                        <td valign="top" class="tableb">
								<input type="text" name="plugin_newsletter_from_email" id="plugin_newsletter_from_email" class="textinput" size="30" maxlength="100" value="{$CONFIG['plugin_newsletter_from_email']}" />
                        </td>
                    </tr>
					<tr>
                        <td valign="top" class="tableb tableb_alternate">
                            {$lang_plugin_newsletter['from_name']}
                        </td>
                        <td valign="top" class="tableb tableb_alternate">
								<input type="text" name="plugin_newsletter_from_name" id="plugin_newsletter_from_name" class="textinput" size="30" maxlength="100" value="{$CONFIG['plugin_newsletter_from_name']}" />
                        </td>
                    </tr>
					<tr>
                        <td valign="top" class="tableb">
                            {$lang_plugin_newsletter['mails_per_page']}
                        </td>
                        <td valign="top" class="tableb">
								<input type="text" name="plugin_newsletter_mails_per_page" id="plugin_newsletter_mails_per_page" class="textinput spin-button" size="4" maxlength="4" value="{$CONFIG['plugin_newsletter_mails_per_page']}" />
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" class="tableb tableb_alternate">
                            {$lang_plugin_newsletter['administration_links']}
                        </td>
                        <td valign="top" class="tableb tableb_alternate">
							<input type="radio" name="plugin_newsletter_admin_menu_links" id="plugin_newsletter_admin_menu_links_no" class="checkbox" value="0" {$option_output['plugin_newsletter_admin_menu_links_no']} /> 
                        	<label for="plugin_newsletter_admin_menu_links_no">{$lang_common['no']}</label>
                        	&nbsp;
                        	<input type="radio" name="plugin_newsletter_admin_menu_links" id="plugin_newsletter_admin_menu_links_yes" class="checkbox" value="1" {$option_output['plugin_newsletter_admin_menu_links_yes']} /> 
                        	<label for="plugin_newsletter_admin_menu_links_yes">{$lang_common['yes']}</label>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" class="tableb">
                            {$lang_plugin_newsletter['display_newsletter_in_menu_for_visitor']}
                        </td>
                        <td valign="top" class="tableb">
							<input type="radio" name="plugin_newsletter_visitor_menu_links" id="plugin_newsletter_visitor_menu_links_no" class="checkbox" value="0" {$option_output['plugin_newsletter_visitor_menu_links_no']} /> 
                        	<label for="plugin_newsletter_visitor_menu_links_no">{$lang_common['no']}</label>
                        	&nbsp;
                        	<input type="radio" name="plugin_newsletter_visitor_menu_links" id="plugin_newsletter_visitor_menu_links_sys" class="checkbox" value="1" {$option_output['plugin_newsletter_visitor_menu_links_sys']} /> 
                        	<label for="plugin_newsletter_visitor_menu_links_sys">{$lang_common['yes']}: {$lang_plugin_newsletter['in_sys_menu']}</label>
                        	&nbsp;
                        	<input type="radio" name="plugin_newsletter_visitor_menu_links" id="plugin_newsletter_visitor_menu_links_sub" class="checkbox" value="2" {$option_output['plugin_newsletter_visitor_menu_links_sub']} /> 
                        	<label for="plugin_newsletter_visitor_menu_links_sub">{$lang_common['yes']}: {$lang_plugin_newsletter['in_sub_menu']}</label>
                        </td>
                    </tr>
                    {$install_section}
                    <tr>
                        <td valign="middle" class="tablef">
                        </td>
                        <td valign="middle" class="tablef">
                            <input type="hidden" name="form_token" value="{$form_token}" />
                            <input type="hidden" name="timestamp" value="{$timestamp}" />
                            <button type="submit" class="button" name="submit" value="{$lang_common['ok']}">{$newsletter_icon_array['ok']}{$lang_common['ok']}</button>
                        </td>
                    </tr>
EOT;
    endtable();
    echo <<< EOT
            {$additional_submit_information}
            </form>

EOT;

}
?>