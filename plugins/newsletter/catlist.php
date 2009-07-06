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
// Initialize language and icons
require_once './plugins/newsletter/init.inc.php';
$newsletter_init_array = newsletter_initialize();
$lang_plugin_newsletter = $newsletter_init_array['language']; 
$newsletter_icon_array = $newsletter_init_array['icon'];
$message = '';
$columns_total = 8; 

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

if ($superCage->post->keyExists('submit')) { // The form has been submit
    //Check if the form token is valid
    if(!checkFormToken()){
        cpg_die(ERROR, $lang_errors['invalid_form_token'], __FILE__, __LINE__);
    }
    // Build the arrays that hold the submit data using getRaw - we'll have to sanitize that later, but basically we rely on the fact that this page is admin-only
    $submit_cat_id                = $superCage->post->getInt('cat_id');
    $submit_name                  = cpgSanitizeUserTextInput($superCage->post->getEscaped('name'));
    $submit_description           = cpgSanitizeUserTextInput($superCage->post->getRaw('description'));
    $submit_open_for_subscription = $superCage->post->getInt('open_for_subscription');
    $submit_publicly_viewable     = $superCage->post->getInt('publicly_viewable');
    $submit_frequency_year        = $superCage->post->getInt('frequency_year');
    $submit_delete                = $superCage->post->getInt('delete');
    
    $loopCounter = 0;
    foreach ($submit_cat_id as $cat_key => $cat_id) {
        // Convert the checkbox fields to YES/NO records
        if ($submit_open_for_subscription[$cat_key] == 1) {
            $submit_open_for_subscription[$cat_key] = 'YES';
        } else {
            $submit_open_for_subscription[$cat_key] = 'NO';
        }
        if ($submit_publicly_viewable[$cat_key] == 1) {
            $submit_publicly_viewable[$cat_key] = 'YES';
        } else {
            $submit_publicly_viewable[$cat_key] = 'NO';
        }
        // Different actions for existing records vs new records
        if (isset($newsletter_categories_db[$loopCounter]['category_id'])) { // Determine the existing records
            // The records that already exist in the database
            if ($submit_delete[$cat_key] == 1) {
                cpg_db_query("DELETE FROM {$CONFIG['TABLE_PREFIX']}plugin_newsletter_categories WHERE category_id='{$cat_id}'");
                $message .= '<li>' . sprintf($lang_plugin_newsletter['category_x_deleted'], '<strong>' . $submit_name[$cat_key] . '</strong>').'</li>' . $LINEBREAK;
                unset($newsletter_categories_db[$loopCounter]);
                unset($submit_cat_id[$cat_key]);
                unset($submit_name[$cat_key]);
                unset($submit_description[$cat_key]);
                unset($submit_open_for_subscription[$cat_key]);
                unset($submit_publicly_viewable[$cat_key]);
                unset($submit_frequency_year[$cat_key]);
                unset($submit_delete[$cat_key]);
            }
            if ($submit_name[$cat_key] == '') { // There mustn't be an empty name field
                $submit_name[$cat_key] = $newsletter_categories_db[$loopCounter]['name']; // Set back to how it used to be
            }
            if ($submit_name[$cat_key] != $newsletter_categories_db[$loopCounter]['name'] ||
                $submit_description[$cat_key] != $newsletter_categories_db[$loopCounter]['description'] ||
                $submit_open_for_subscription[$cat_key] != $newsletter_categories_db[$loopCounter]['open_for_subscription'] ||
                $submit_publicly_viewable[$cat_key] != $newsletter_categories_db[$loopCounter]['public_view'] ||
                $submit_frequency_year[$cat_key] != $newsletter_categories_db[$loopCounter]['frequency_year']) {
                // At least one of the records differ, so let's write the changes to the database
                $query = "UPDATE {$CONFIG['TABLE_PREFIX']}plugin_newsletter_categories 
                          SET name='{$submit_name[$cat_key]}',
                              description='{$submit_description[$cat_key]}',
                              open_for_subscription='{$submit_open_for_subscription[$cat_key]}',
                              public_view='{$submit_publicly_viewable[$cat_key]}',
                              frequency_year='{$submit_frequency_year[$cat_key]}'
                          WHERE category_id='{$cat_id}'";
        	    cpg_db_query($query);
        	    // Increase the changes counter
        	    $message .= '<li>' . sprintf($lang_plugin_newsletter['changes_saved_for_category_x'], '<strong>' . $submit_name[$cat_key] . '</strong>').'</li>' . $LINEBREAK;
        	    // Update the content of the output
        	    $newsletter_categories_db[$loopCounter]['name'] = $submit_name[$cat_key];
        	    $newsletter_categories_db[$loopCounter]['description'] = $submit_description[$cat_key];
        	    $newsletter_categories_db[$loopCounter]['open_for_subscription'] = $submit_open_for_subscription[$cat_key];
        	    $newsletter_categories_db[$loopCounter]['public_view'] = $submit_publicly_viewable[$cat_key];
        	    $newsletter_categories_db[$loopCounter]['frequency_year'] = $submit_frequency_year[$cat_key];
            } else {
                // The submit data match the database -  no changes required
            }
        } else {
            // The "add newsletter category" form field
            // Only create a new record if the name field isn't empty
            if ($submit_name[$cat_key] != '') {
                // Create a new record
                $query = "INSERT INTO {$CONFIG['TABLE_PREFIX']}plugin_newsletter_categories 
                          SET name='{$submit_name[$cat_key]}',
                              description='{$submit_description[$cat_key]}',
                              open_for_subscription='{$submit_open_for_subscription[$cat_key]}',
                              public_view='{$submit_publicly_viewable[$cat_key]}',
                              frequency_year='{$submit_frequency_year[$cat_key]}'";
                cpg_db_query($query);
                // Populate the categories array
        	    $newsletter_categories_db[$loopCounter]['name'] = $submit_name[$cat_key];
        	    $newsletter_categories_db[$loopCounter]['description'] = $submit_description[$cat_key];
        	    $newsletter_categories_db[$loopCounter]['open_for_subscription'] = $submit_open_for_subscription[$cat_key];
        	    $newsletter_categories_db[$loopCounter]['public_view'] = $submit_publicly_viewable[$cat_key];
        	    $newsletter_categories_db[$loopCounter]['frequency_year'] = $submit_frequency_year[$cat_key];
        	    $newsletter_categories_db[$loopCounter]['subscription_count'] = '0';
        	    // Add a message about the creation
        	    $message .= '<li>' . sprintf($lang_plugin_newsletter['category_x_created'], '<strong>' . $submit_name[$cat_key] . '</strong>') . '</li>' . $LINEBREAK;
    	    }
        }
        $loopCounter++;
    }
}

pageheader($lang_plugin_newsletter['category_list']);
echo <<< EOT
    <form action="" method="post" name="newsletter_catlist" id="newsletter_catlist">
EOT;
if ($message != '') {
    echo <<< EOT
    <div class="cpg_message_info">
        <ul>
            {$message}
        </ul>
    </div>
EOT;
}

starttable('100%', $newsletter_icon_array['catlist'] . $lang_plugin_newsletter['category_list'], $columns_total, 'cpg_zebra');
$loopCounter = 1;
$frequency_help = '&nbsp;'. cpg_display_help('f=empty.htm&amp;base=64&amp;h='.urlencode(base64_encode(serialize($lang_plugin_newsletter['frequency']))).'&amp;t='.urlencode(base64_encode(serialize($lang_plugin_newsletter['frequency_explanation']))), 470, 245);
$open_help = '&nbsp;'. cpg_display_help('f=empty.htm&amp;base=64&amp;h='.urlencode(base64_encode(serialize($lang_plugin_newsletter['open']))).'&amp;t='.urlencode(base64_encode(serialize($lang_plugin_newsletter['open_explanation']))), 470, 245);
$viewable_help = '&nbsp;'. cpg_display_help('f=empty.htm&amp;base=64&amp;h='.urlencode(base64_encode(serialize($lang_plugin_newsletter['viewable']))).'&amp;t='.urlencode(base64_encode(serialize($lang_plugin_newsletter['viewable_explanation']))), 470, 245);

echo <<< EOT
	<tr>
		<th align="center" class="tableh2">
			{$lang_plugin_newsletter['delete']}
		</th>
		<th align="left" class="tableh2">
			{$lang_plugin_newsletter['name']}
		</th>
		<th align="left" class="tableh2">
			{$lang_plugin_newsletter['description']}
		</th>
		<th align="left" class="tableh2">
			{$lang_plugin_newsletter['open']}{$open_help}
		</th>
		<th align="left" class="tableh2">
			{$lang_plugin_newsletter['viewable']}{$viewable_help}
		</th>
		<th align="left" class="tableh2">
			{$lang_plugin_newsletter['frequency']}{$frequency_help}
		</th>
		<th align="left" class="tableh2">
		    {$lang_plugin_newsletter['mailings']}
		</th>
		<th align="left" class="tableh2">
		    {$lang_plugin_newsletter['subscriptions']}
		</th>
	</tr>
EOT;
// Loop through the database content
foreach ($newsletter_categories_db as $category_loop => $row) {
	if ($row['open_for_subscription'] == 'YES') {
	    $open_for_subscription = 'checked="checked"';
	} else {
	    $open_for_subscription = '';
	}
	if ($row['public_view'] == 'YES') {
	    $publicly_viewable = 'checked="checked"';
	} else {
	    $publicly_viewable = '';
	}
	// Get the number of mailings for this category
    $mailings_count = newsletter_mailings_per_category($row['category_id']);
    $number_of_subscriptions = newsletter_subscriptions_per_category($row['category_id']);
	$newsletter_frequency_options = newsletter_frequency_options($row['frequency_year']);
	echo <<< EOT
	<tr>
		<td align="center">
			<input type="hidden" name="cat_id[{$loopCounter}]" value="{$row['category_id']}" />
			<input type="checkbox" name="delete[{$loopCounter}]" id="delete{$loopCounter}" value="1" class="checkbox" onclick="if (this.checked) return confirm('{$lang_plugin_newsletter['category_delete_confirmation']}');" />
		</td>
		<td>
			<input type="text" name="name[{$loopCounter}]" id="name{$loopCounter}" class="textinput" size="20" maxlength="100" value="{$row['name']}" />
		</td>
		<td>
			<textarea name="description[{$loopCounter}]" id="description{$loopCounter}" rows="1" cols="40" class="textinput elastic" style="max-height:200px;">{$row['description']}</textarea>
		</td>
		<td>
			<input type="checkbox" name="open_for_subscription[{$loopCounter}]" id="open_for_subscription{$loopCounter}" value="1" class="checkbox" {$open_for_subscription} />
		</td>
		<td>
			<input type="checkbox" name="publicly_viewable[{$loopCounter}]" id="publicly_viewable{$loopCounter}" value="1" class="checkbox" {$publicly_viewable} />
		</td>
		<td>
			<select name="frequency_year[{$loopCounter}]" id="frequency_year{$loopCounter}" class="listbox" size="1">
			{$newsletter_frequency_options}
			</select>
		</td>
		<td align="right">
		    <a href="index.php?file=newsletter/archive&amp;category={$row['category_id']}" title="{$lang_plugin_newsletter['browse_archived_mailings']}">{$mailings_count}</a>
		</td>
		<td align="right">
		    {$number_of_subscriptions}
		</td>
	</tr>
EOT;
	$loopCounter++;
}



$loopCounter++;

list($timestamp, $form_token) = getFormToken();

$newsletter_frequency_options = newsletter_frequency_options('360');
echo <<< EOT
    <tr>
        <td align="center">
            {$newsletter_icon_array['add']}{$lang_plugin_newsletter['add']}
            <input type="hidden" name="cat_id[{$loopCounter}]" value="{$loopCounter}" />
        </td>
        <td>
            <input type="text" name="name[{$loopCounter}]" id="name{$loopCounter}" class="textinput" size="20" maxlength="100" value="" />
        </td>
        <td>
            <textarea name="description[{$loopCounter}]" id="description{$loopCounter}" rows="1" cols="40" class="textinput elastic" style="max-height:200px;"></textarea>
        </td>
        <td>
            <input type="checkbox" name="open_for_subscription[{$loopCounter}]" id="open_for_subscription{$loopCounter}" value="1" class="checkbox" checked="checked" />
        </td>
        <td>
			<input type="checkbox" name="publicly_viewable[{$loopCounter}]" id="publicly_viewable{$loopCounter}" value="1" class="checkbox" checked="checked" />
        </td>
        <td>
			<select name="frequency_year[{$loopCounter}]" id="frequency_year{$loopCounter}" class="listbox" size="1">
			{$newsletter_frequency_options}
			</select>
		</td>
		<td>
		</td>
		<td>
		</td>
    </tr>
    <tr>
        <td class="tablef" colspan="{$columns_total}">
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