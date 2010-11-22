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

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

$thisplugin->add_action('page_start','newsletter_initialize');
$thisplugin->add_action('plugin_install','newsletter_install');
$thisplugin->add_action('plugin_uninstall','newsletter_uninstall');
$thisplugin->add_action('plugin_cleanup','newsletter_cleanup');
$thisplugin->add_action('plugin_configure','newsletter_configure');
$thisplugin->add_filter('admin_menu','newsletter_admin_menu_button');
$thisplugin->add_action('gallery_footer','newsletter_footer');
$thisplugin->add_filter('register_form_create','newsletter_registration_form');
$thisplugin->add_action('register_form_submit','newsletter_registration_submit');
$thisplugin->add_action('register_user_activation','newsletter_registration_activation');
$thisplugin->add_filter('profile_add_data','newsletter_profile');
$thisplugin->add_filter('usermgr_form_list','newsletter_form_list');

if (USER_ID != 0 || $CONFIG['plugin_newsletter_guest_subscriptions'] != '0') {
    if ($CONFIG['plugin_newsletter_visitor_menu_links'] == 1) {
        $thisplugin->add_filter('sys_menu','newsletter_menu_button');
    } elseif ($CONFIG['plugin_newsletter_visitor_menu_links'] == 2) {
        $thisplugin->add_filter('sub_menu','newsletter_menu_button');
    }
}
if (GALLERY_ADMIN_MODE && $CONFIG['plugin_newsletter_admin_menu_links'] == 0) {
    $thisplugin->add_filter('gallery_header','newsletter_header');
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
                                    'plugin_newsletter_page_refresh_delay' => '10',
                                    'plugin_newsletter_admin_menu_links' => '1',
                                    'plugin_newsletter_visitor_menu_links' => '2',
                                    'plugin_newsletter_retries' => '2',
                                    'plugin_newsletter_default_on_register' => '0',
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
        cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_newsletter_page_refresh_delay'");
        cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_newsletter_admin_menu_links'");
        cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_newsletter_visitor_menu_links'");
        cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_newsletter_retries'");
        cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_newsletter_default_on_register'");
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
            <tr>
                <td class="tablef" colspan="2">
                    <div class="cpg_message_info">
                        {$lang_plugin_newsletter['submit_to_uninstall']}
                    </div>
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
    if ($CONFIG['plugin_newsletter_admin_menu_links'] == '2') {
        require_once './plugins/newsletter/init.inc.php'; // Initialize language and icons
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
        $remaining_records_count = newsletter_mailings_to_process();
        if ($remaining_records_count > 0) {
            $new_button .= '<div class="admin_menu admin_float"><a href="index.php?file=newsletter/send">';
            $new_button .= $newsletter_icon_array['send'] . $lang_plugin_newsletter['send_mailings'];
            $new_button .= ' (<span title="' . sprintf($lang_plugin_newsletter['x_open_mailings'], $remaining_records_count) . '">'.$remaining_records_count.'</span>)';
            $new_button .= '</a></div>';
        }
        $timed_out_records_count = newsletter_timed_out_mailings();
        if ($timed_out_records_count > 0) {
            $new_button .= '<div class="admin_menu admin_float"><a href="index.php?file=newsletter/queue">';
            $new_button .= $newsletter_icon_array['queue'] . $lang_plugin_newsletter['queue'];
            $new_button .= ' (<span title="' . sprintf($lang_plugin_newsletter['timed_out_mailings'], $timed_out_records_count) . '">'.$timed_out_records_count.'</span>)';
            $new_button .= '</a></div>';
        }
        $look_for = '<!-- END export -->'; // This is where you determine the place in the admin menu
        $admin_menu = str_replace($look_for, $look_for . $new_button, $admin_menu);
    } elseif($CONFIG['plugin_newsletter_admin_menu_links'] == '1') {
        require_once './plugins/newsletter/init.inc.php'; // Initialize language and icons
        $newsletter_init_array = newsletter_initialize();
        $lang_plugin_newsletter = $newsletter_init_array['language']; 
        $newsletter_icon_array = $newsletter_init_array['icon'];
        $new_button = '<div class="admin_menu admin_float"><a href="index.php?file=newsletter/index">';
        $new_button .= $newsletter_icon_array['newsletter'] . $lang_plugin_newsletter['config_name'];
        $remaining_records_count = newsletter_mailings_to_process();
        if ($remaining_records_count > 0) {
            $new_button .= ' (<span title="' . sprintf($lang_plugin_newsletter['x_open_mailings'], $remaining_records_count) . '">'.$remaining_records_count.'</span>)';
        }
        $timed_out_records_count = newsletter_timed_out_mailings();
        if ($timed_out_records_count > 0) {
            $new_button .= ' [<span title="' . sprintf($lang_plugin_newsletter['timed_out_mailings'], $timed_out_records_count) . '">'.$timed_out_records_count.'</span>]';
        }
        $new_button .= '</a></div>';
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
    
    // plugin_newsletter_page_refresh_delay
    if ($superCage->post->keyExists('plugin_newsletter_page_refresh_delay') == TRUE) {
        if ($superCage->post->getInt('plugin_newsletter_page_refresh_delay') >= 0 && $superCage->post->getInt('plugin_newsletter_page_refresh_delay') <= 600 && $CONFIG['plugin_newsletter_page_refresh_delay'] != $superCage->post->getInt('plugin_newsletter_page_refresh_delay')) {
            $CONFIG['plugin_newsletter_page_refresh_delay'] = $superCage->post->getInt('plugin_newsletter_page_refresh_delay');
            $query = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_newsletter_page_refresh_delay']}' WHERE name='plugin_newsletter_page_refresh_delay'";
            cpg_db_query($query);
            $config_changes_counter++;
        }
    }
    
    // plugin_newsletter_retries
    if ($superCage->post->keyExists('plugin_newsletter_retries') == TRUE) {
        if ($superCage->post->getInt('plugin_newsletter_retries') >= 0 && $superCage->post->getInt('plugin_newsletter_retries') <= 10 && $CONFIG['plugin_newsletter_retries'] != $superCage->post->getInt('plugin_newsletter_retries')) {
            $CONFIG['plugin_newsletter_retries'] = $superCage->post->getInt('plugin_newsletter_retries');
            $query = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_newsletter_retries']}' WHERE name='plugin_newsletter_retries'";
            cpg_db_query($query);
            $config_changes_counter++;
        }
    }
    
    // plugin_newsletter_admin_menu_links
    if ($superCage->post->keyExists('plugin_newsletter_admin_menu_links') == TRUE && ($superCage->post->getInt('plugin_newsletter_admin_menu_links') == '0'  || $superCage->post->getInt('plugin_newsletter_admin_menu_links') == '1' || $superCage->post->getInt('plugin_newsletter_admin_menu_links') == '2') ) {
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
    
    // plugin_newsletter_default_on_register
    if ($superCage->post->keyExists('plugin_newsletter_default_on_register') == TRUE && ($superCage->post->getInt('plugin_newsletter_default_on_register') == '0'  || $superCage->post->getInt('plugin_newsletter_default_on_register') == '1') ) {
        if ($superCage->post->getInt('plugin_newsletter_default_on_register') != $CONFIG['plugin_newsletter_default_on_register']) {
            $CONFIG['plugin_newsletter_default_on_register'] = $superCage->post->getInt('plugin_newsletter_default_on_register');
            $query = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_newsletter_default_on_register']}' WHERE name='plugin_newsletter_default_on_register'";
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
        $option_output['plugin_newsletter_admin_menu_links_all'] = '';
        $option_output['plugin_newsletter_admin_menu_links_single'] = 'checked="checked"';
        $option_output['plugin_newsletter_admin_menu_links_no'] = '';
    } elseif ($CONFIG['plugin_newsletter_admin_menu_links'] == '2') { // 
        $option_output['plugin_newsletter_admin_menu_links_all'] = 'checked="checked"';
        $option_output['plugin_newsletter_admin_menu_links_single'] = '';
        $option_output['plugin_newsletter_admin_menu_links_no'] = '';
    } else {
        $option_output['plugin_newsletter_admin_menu_links_all'] = '';
        $option_output['plugin_newsletter_admin_menu_links_single'] = '';
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
    
    if ($CONFIG['plugin_newsletter_default_on_register'] == '1') {
        $option_output['plugin_newsletter_default_on_register_yes'] = 'checked="checked"';
        $option_output['plugin_newsletter_default_on_register_no'] = '';
    } else { // 
        $option_output['plugin_newsletter_default_on_register_yes'] = '';
        $option_output['plugin_newsletter_default_on_register_no'] = 'checked="checked"';
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
                            <input type="radio" name="plugin_newsletter_guest_subscriptions" id="plugin_newsletter_guest_subscriptions_yes" class="checkbox" value="1" {$option_output['plugin_newsletter_guest_subscriptions_yes']} /> 
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
                            <input type="text" name="plugin_newsletter_salutation_for_guests" id="plugin_newsletter_salutation_for_guests" class="textinput" size="30" maxlength="100" value="{$CONFIG['plugin_newsletter_salutation_for_guests']}" />
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
                            {$lang_plugin_newsletter['page_refresh_delay']}
                        </td>
                        <td valign="top" class="tableb tableb_alternate">
                                <input type="text" name="plugin_newsletter_page_refresh_delay" id="plugin_newsletter_page_refresh_delay" class="textinput spin-button" size="4" maxlength="4" value="{$CONFIG['plugin_newsletter_page_refresh_delay']}" /> {$lang_plugin_newsletter['seconds']}
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" class="tableb">
                            {$lang_plugin_newsletter['retries']}
                        </td>
                        <td valign="top" class="tableb">
                                <input type="text" name="plugin_newsletter_retries" id="plugin_newsletter_retries" class="textinput spin-button" size="4" maxlength="3" value="{$CONFIG['plugin_newsletter_retries']}" /> ({$lang_plugin_newsletter['retries_explain']})
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
                            <input type="radio" name="plugin_newsletter_admin_menu_links" id="plugin_newsletter_admin_menu_links_single" class="checkbox" value="1" {$option_output['plugin_newsletter_admin_menu_links_single']} /> 
                            <label for="plugin_newsletter_admin_menu_links_single">{$lang_common['yes']}: {$lang_plugin_newsletter['link_to_newsletter_index_page']}</label>
                            &nbsp;
                            <input type="radio" name="plugin_newsletter_admin_menu_links" id="plugin_newsletter_admin_menu_links_all" class="checkbox" value="2" {$option_output['plugin_newsletter_admin_menu_links_all']} /> 
                            <label for="plugin_newsletter_admin_menu_links_all">{$lang_common['yes']}: {$lang_plugin_newsletter['several_links_control']}</label>
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
                    <tr>
                        <td valign="top" class="tableb">
                            {$lang_plugin_newsletter['default_on_register']}
                        </td>
                        <td valign="top" class="tableb">
                            <input type="radio" name="plugin_newsletter_default_on_register" id="plugin_newsletter_default_on_register_no" class="checkbox" value="0" {$option_output['plugin_newsletter_default_on_register_no']} /> 
                            <label for="plugin_newsletter_default_on_register_no">{$lang_common['no']} ({$lang_plugin_newsletter['opt_in']}, {$lang_plugin_newsletter['recommended']})</label>
                            &nbsp;
                            <input type="radio" name="plugin_newsletter_default_on_register" id="plugin_newsletter_default_on_register_yes" class="checkbox" value="1" {$option_output['plugin_newsletter_default_on_register_yes']} /> 
                            <label for="plugin_newsletter_default_on_register_yes">{$lang_common['yes']} ({$lang_plugin_newsletter['opt_out']}, {$lang_plugin_newsletter['not_recommended']})</label>
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

function newsletter_mailqueue() {
    if (defined('CPG_PLUGIN_NEWSLETTER_MAILQUEUE')) {
        return;
    }
    global $CONFIG, $lang_plugin_newsletter, $newsletter_icon_array;
    require_once('include/mailer.inc.php');
    $output_array = array();
    $query = ("SELECT * 
               FROM {$CONFIG['TABLE_PREFIX']}plugin_newsletter_queue 
               AS queue 
               INNER JOIN {$CONFIG['TABLE_PREFIX']}plugin_newsletter_mailings 
               AS mailings
               ON mailings.mailing_id = queue.mailing_id
               INNER JOIN {$CONFIG['TABLE_PREFIX']}plugin_newsletter_subscriptions 
               AS subscriptions
               ON subscriptions.subscriber_id = queue.subscriber_id
               WHERE queue.attempts <= {$CONFIG['plugin_newsletter_mails_per_page']}
               ORDER BY queue.attempts,queue.time 
               LIMIT {$CONFIG['plugin_newsletter_mails_per_page']}");
    $result = cpg_db_query($query);
    $mailqueue_array = cpg_db_fetch_rowset($result);
    mysql_free_result($result);

    foreach ($mailqueue_array as $mailqueue) {
        if ($mailqueue['user_id'] == '') { // Guest
            $salutation = $CONFIG['plugin_newsletter_salutation_for_guests'];
        } else { // Registered user
            $salutation = str_replace('{USERNAME}', $mailqueue['subscriber_name'], $mailqueue['salutation']);
        }
        $mailing_message_plain = $salutation .$LINEBREAK. $mailqueue['body'] . $LINEBREAK . $LINEBREAK;
        // Add the unsubscribe link at the bottom
        $mailing_message_plain .= $lang_plugin_newsletter['unsubscribe_text'];
        $mailing_message_plain .= ' ' . $CONFIG['site_url'] . 'index.php?file=newsletter/unsubscribe';
        $mailing_message_html = newsletter_text2html($mailqueue['subject'], $salutation, $mailqueue['body']);
        
        
        if (!cpg_mail($mailqueue['subscriber_email'], $mailqueue['subject'], $mailing_message_html, 'text/plain', $CONFIG['plugin_newsletter_from_name'], $CONFIG['plugin_newsletter_from_email'], $mailing_message_plain)) { // sending the email has failed --- start
            $output_array[] = '<span class="important">' . $newsletter_icon_array['failure'] . sprintf($lang_plugin_newsletter['sending_email_failed'], '<a href="index.php?file=newsletter/archive&amp;mailing="'.$mailqueue['mailing_id'].'">'.$mailqueue['subject'].'</a>', '<a href="index.php?file=newsletter/subscribe&amp;subscriber='.$mailqueue['subscriber_id'].'">' . $mailqueue['subscriber_email'] . '</a>', $mailqueue['attempts'] + 1) . '</span>';
            cpg_db_query("UPDATE {$CONFIG['TABLE_PREFIX']}plugin_newsletter_queue SET attempts = attempts + 1 WHERE queue_id={$mailqueue['queue_id']}");
            if ($CONFIG['log_mode'] != CPG_NO_LOGGING) {
                log_write("Sending an email using the newsletter plugin failed (recipient email: {$mailqueue['subscriber_email']}, subscriber ID: {$mailqueue['subscriber_id']}, Mailing ID: {$mailqueue['mailing_id']}, Attempt: {$mailqueue['attempts']})", CPG_MAIL_LOG);
            }
        } else {  // sending the email has failed --- end // sending the email has been successfull --- start
            $output_array[] = $newsletter_icon_array['success'] . sprintf($lang_plugin_newsletter['sending_email_succeeded'], '<a href="index.php?file=newsletter/archive&amp;mailing="'.$mailqueue['mailing_id'].'>'.$mailqueue['subject'].'</a>', '<a href="index.php?file=newsletter/subscribe&amp;subscriber='.$mailqueue['subscriber_id'].'">' . $mailqueue['subscriber_email'] . '</a>');
            $processed_records_counter++;
            cpg_db_query("DELETE FROM {$CONFIG['TABLE_PREFIX']}plugin_newsletter_queue WHERE queue_id={$mailqueue['queue_id']}");
            if ($CONFIG['log_mode'] == CPG_LOG_ALL) {
                log_write("Sending email from newsletter plugin successful (recipient email: {$mailqueue['subscriber_email']}, subscriber ID: {$mailqueue['subscriber_id']}, Mailing ID: {$mailqueue['mailing_id']})", CPG_MAIL_LOG);
            }
        } // sending the email has been successfull --- end
    }
    define('CPG_PLUGIN_NEWSLETTER_MAILQUEUE', true);
    return $output_array;
}


function newsletter_header($html) {
    require_once './plugins/newsletter/init.inc.php';
    $newsletter_init_array = newsletter_initialize();
    $lang_plugin_newsletter = $newsletter_init_array['language']; 
    $newsletter_icon_array = $newsletter_init_array['icon'];
    
    $remaining_records_count = newsletter_mailings_to_process();
    if ($remaining_records_count > 0) {
        $return .= '<a href="index.php?file=newsletter/send">'. sprintf($lang_plugin_newsletter['x_open_mailings'], $remaining_records_count).'</a>';
    }
    $timed_out_records_count = newsletter_timed_out_mailings();
    if ($timed_out_records_count > 0) {
        $return .= ' <a href="index.php?file=newsletter/queue">'. sprintf($lang_plugin_newsletter['timed_out_mailings'], $timed_out_records_count).'</a>';
    }
    $return .= $html;
    return $return;
}

function newsletter_footer($html) {
    $superCage = Inspekt::makeSuperCage();
    if (function_exists('newsletter_mailqueue') && $superCage->get->getRaw('file') != 'newsletter/send') {
        newsletter_mailqueue(); // Trigger the sending of emails at the end of the page
    }
    return $html;
}

function newsletter_registration_form($form_data) {
    global $CONFIG, $lang_plugin_newsletter, $newsletter_icon_array;
    $result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PREFIX']}plugin_newsletter_categories WHERE open_for_subscription = 'YES'");
    $rowset = cpg_db_fetch_rowset($result);
    mysql_free_result($result);
    $loopCounter = 0;
    if ($CONFIG['plugin_newsletter_default_on_register'] == '1') {
        $defaultOnRegister = 'checked="checked"';
    } else {
        $defaultOnRegister = '';
    }
    foreach ($rowset as $category) {
        if ($category['description'] != '') {
            $form_data[] = array('checkbox', 'newsletter['.$loopCounter.']', $newsletter_icon_array['newsletter'] . $lang_plugin_newsletter['subscribe_to_newsletter'], $category['name']. ' ('.$category['description'].')', $category['category_id'], '2', $defaultOnRegister);
        } else {
            $form_data[] = array('checkbox', 'newsletter['.$loopCounter.']', $newsletter_icon_array['newsletter'] . $lang_plugin_newsletter['subscribe_to_newsletter'], $category['name'], $category['category_id'], '2', $defaultOnRegister);
        }
        $loopCounter++;
        
    }
    return $form_data;
}

function newsletter_registration_submit($user_array) {
    global $CONFIG;
    $superCage = Inspekt::makeSuperCage();
    if ($superCage->post->keyExists('newsletter')) {
        $checkbox_array = $superCage->post->getRaw('newsletter');
        $list = '';
        foreach ($checkbox_array as $checkbox) {
                $list .= (int)$checkbox . ',';
        }
        $list = rtrim($list, ',');
        if ($list != '') {
            // Run the query
            $query = "INSERT INTO {$CONFIG['TABLE_PREFIX']}plugin_newsletter_subscriptions 
                      SET user_id='{$user_array['user_id']}',
                          subscriber_active='{$user_array['user_active']}',
                          subscriber_name='{$user_array['user_name']}',
                          subscriber_regdate='" . time() . "',
                          subscriber_email='{$user_array['user_email']}',
                          category_list='{$list}'";
            $result = cpg_db_query($query);
        }
    }
}

function newsletter_registration_activation($act_key) {
    global $CONFIG;
    $result = cpg_db_query("SELECT user_id FROM {$CONFIG['TABLE_USERS']} WHERE user_actkey = '$act_key' LIMIT 1");
    list($user_id) = mysql_fetch_row($result);
    mysql_free_result($result);
    $query = "UPDATE {$CONFIG['TABLE_PREFIX']}plugin_newsletter_subscriptions SET subscriber_active='YES' WHERE user_id='$user_id'";
    cpg_db_query($query);
}

function newsletter_profile($profile_data) {
    //print_r($profile_data);
}

function newsletter_form_list($data) {
    global $CONFIG, $lang_plugin_newsletter, $newsletter_icon_array;
    $form_data = $data[0];
    $user_id = $data[1];
    $result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PREFIX']}plugin_newsletter_categories");
    $category_array = cpg_db_fetch_rowset($result);
    mysql_free_result($result);
    $result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PREFIX']}plugin_newsletter_subscriptions
                            WHERE user_id='{$user_id}'
                            LIMIT 1");
    list($user_subscription) = mysql_fetch_row($result);
    mysql_free_result($result);
    $loopCounter = 0;
    foreach ($rowset as $category) {
        if ($category['description'] != '') {
            $form_data[] = array('checkbox', 'newsletter['.$loopCounter.']', $newsletter_icon_array['newsletter'] . $lang_plugin_newsletter['subscribe_to_newsletter'], $category['name']. ' ('.$category['description'].')', $category['category_id'], '2');
        } else {
            $form_data[] = array('checkbox', 'newsletter['.$loopCounter.']', $newsletter_icon_array['newsletter'] . $lang_plugin_newsletter['subscribe_to_newsletter'], $category['name'], $category['category_id'], '2');
        }
        $loopCounter++;
        
    }
    return $form_data;
}
?>