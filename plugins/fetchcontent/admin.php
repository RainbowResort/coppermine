<?php
/********************************************************
  Coppermine 1.5.x plugin - FetchContent
  *******************************************************
  Copyright (c) 2010 Coppermine dev team
  *******************************************************
  This program is free software; you can redistribute 
  it and/or modify it under the terms of the GNU General
  Public License as published by the Free Software
  Foundation; either version 3 of the License, or 
  (at your option) any later version.
  *******************************************************
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
  *******************************************************/

require('./plugins/fetchcontent/configuration.php');
require('./plugins/fetchcontent/init.inc.php');

if (in_array('js/jquery.spinbutton.js', $JS['includes']) != TRUE) {
	$JS['includes'][] = 'js/jquery.spinbutton.js';
}

if (in_array('plugins/fetchcontent/admin.js', $JS['includes']) != TRUE) {
	$JS['includes'][] = 'plugins/fetchcontent/admin.js';
}

// create Inspekt supercage
$superCage = Inspekt::makeSuperCage();

if (!GALLERY_ADMIN_MODE) {
    cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
}

// get sanitized POST parameters
if ($superCage->post->keyExists('submit')) {
	//Check if the form token is valid
	if(!checkFormToken()){
		cpg_die(ERROR, $lang_errors['invalid_form_token'], __FILE__, __LINE__);
	}
	// Define the sanitization patterns
	$sanitization_array = array(
	  'plugin_fetchcontent_image_denied' => array('type' => 'int', 'min' => '0', 'max' => '3'),
	  'plugin_fetchcontent_check_referer' => array('type' => 'checkbox', 'min' => '0', 'max' => '1'),
	  'plugin_fetchcontent_domainlist' => array('type' => 'raw', 'regex_ok' => '/^[a-z]+$/'),
	  'plugin_fetchcontent_enable_logging' => array('type' => 'int', 'min' => '0', 'max' => '2'),
	  'plugin_fetchcontent_non_image' => array('type' => 'int', 'min' => '0', 'max' => '3'),
	  'plugin_fetchcontent_debug' => array('type' => 'checkbox', 'min' => '0', 'max' => '1'),
	  'plugin_fetchcontent_max_cols' => array('type' => 'int', 'min' => '1', 'max' => '20'),
	  'plugin_fetchcontent_max_rows' => array('type' => 'int', 'min' => '1', 'max' => '100'),
	);
	// Todo: come up with the regex for the domainlist
	$config_changes_counter = 0;
	foreach ($sanitization_array as $san_key => $san_value) {
		if (isset($CONFIG[$san_key]) == TRUE) { // only loop if config value is set --- start
			if ($san_value['type'] == 'checkbox') { // type is checkbox --- start
				if ($superCage->post->getInt($san_key) == $san_value['max'] && $CONFIG[$san_key] != $san_value['max']) {
					$CONFIG[$san_key] = $san_value['max'];
					cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG[$san_key]}' WHERE name='$san_key'");
					$config_changes_counter++;
				} elseif($superCage->post->getInt($san_key) == $san_value['min'] && $CONFIG[$san_key] != $san_value['min']) {
					$CONFIG[$san_key] = $san_value['min'];
					cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG[$san_key]}' WHERE name='$san_key'");
					$config_changes_counter++;
				} elseif($superCage->post->keyExists($san_key) != TRUE && $CONFIG[$san_key] != '0') {
					$CONFIG[$san_key] = 0;
					cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG[$san_key]}' WHERE name='$san_key'");
					$config_changes_counter++;
				}
			} // type is checkbox --- end
			if ($san_value['type'] == 'int') { // type is integer --- start
				if ($superCage->post->getInt($san_key) <= $san_value['max'] && $superCage->post->getInt($san_key) >= $san_value['min'] && $superCage->post->getInt($san_key) != $CONFIG[$san_key]) {
				  $CONFIG[$san_key] = $superCage->post->getInt($san_key);
				  cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG[$san_key]}' WHERE name='$san_key'");
				  $config_changes_counter++;
				}
			} // type is integer --- end
			if ($san_value['type'] == 'raw') { // type is raw --- start
				if (isset($san_value['regex_ok']) == TRUE && preg_match($san_value['regex_ok'], $superCage->post->getRaw($san_key)) && $superCage->post->getRaw($san_key) != $CONFIG[$san_key]) {
				  $CONFIG[$san_key] = $superCage->post->getRaw($san_key);
				  if ($superCage->post->getRaw($san_key) == 'none') {
					$CONFIG[$san_key] = '';
				  }
				  cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG[$san_key]}' WHERE name='$san_key'");
				  $config_changes_counter++;
				}
			} // type is raw --- end
			if ($san_value['type'] == 'array') { // type is array --- start              
				$evaluate_value = $superCage->post->getRaw($san_key);
				//print_r($superCage->post->getRaw($san_key));
				if (is_array($evaluate_value) && isset($san_value['regex_ok']) == TRUE && isset($san_value['delimiter']) == TRUE) {
				  $temp = '';
				  for ($i = 0; $i <= count($evaluate_value); $i++) {
					  if (preg_match($san_value['regex_ok'], $evaluate_value[$i])) {
						  $temp .= $evaluate_value[$i] . $san_value['delimiter'];
					  }
				  }
				  unset($evaluate_value);
				  $evaluate_value = rtrim($temp, $san_value['delimiter']);
				  unset($temp);
				}
				if ($evaluate_value != $CONFIG[$san_key]) {
				  $CONFIG[$san_key] = $evaluate_value;
				  cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG[$san_key]}' WHERE name='$san_key'");
				  $config_changes_counter++;
				}
			} // type is array --- end
		} // only loop if config value is set --- end
	}
}


// display config page

// Set the option output stuff
if ($CONFIG['plugin_fetchcontent_enable_logging'] == '0') {
	$option_output['plugin_fetchcontent_enable_logging_0'] = 'checked="checked"';
	$option_output['plugin_fetchcontent_enable_logging_1'] = '';
	$option_output['plugin_fetchcontent_enable_logging_2'] = '';
} elseif ($CONFIG['plugin_fetchcontent_enable_logging'] == '1') { 
	$option_output['plugin_fetchcontent_enable_logging_0'] = '';
	$option_output['plugin_fetchcontent_enable_logging_1'] = 'checked="checked"';
	$option_output['plugin_fetchcontent_enable_logging_2'] = '';
} else { 
	$option_output['plugin_fetchcontent_enable_logging_0'] = '';
	$option_output['plugin_fetchcontent_enable_logging_1'] = '';
	$option_output['plugin_fetchcontent_enable_logging_2'] = 'checked="checked"';
}

if ($CONFIG['plugin_fetchcontent_debug'] == '1') {
	$option_output['plugin_fetchcontent_debug'] = 'checked="checked"';
} else { 
	$option_output['plugin_fetchcontent_debug'] = '';
}

if ($CONFIG['plugin_fetchcontent_image_denied'] == '0') {
	$option_output['plugin_fetchcontent_image_denied_0'] = 'checked="checked"';
	$option_output['plugin_fetchcontent_image_denied_1'] = '';
	$option_output['plugin_fetchcontent_image_denied_2'] = '';
	$option_output['plugin_fetchcontent_image_denied_3'] = '';
} elseif ($CONFIG['plugin_fetchcontent_image_denied'] == '1') { 
	$option_output['plugin_fetchcontent_image_denied_0'] = '';
	$option_output['plugin_fetchcontent_image_denied_1'] = 'checked="checked"';
	$option_output['plugin_fetchcontent_image_denied_2'] = '';
	$option_output['plugin_fetchcontent_image_denied_3'] = '';
} elseif ($CONFIG['plugin_fetchcontent_image_denied'] == '2') { 
	$option_output['plugin_fetchcontent_image_denied_0'] = '';
	$option_output['plugin_fetchcontent_image_denied_1'] = '';
	$option_output['plugin_fetchcontent_image_denied_2'] = 'checked="checked"';
	$option_output['plugin_fetchcontent_image_denied_3'] = '';
} else { 
	$option_output['plugin_fetchcontent_image_denied_0'] = '';
	$option_output['plugin_fetchcontent_image_denied_1'] = '';
	$option_output['plugin_fetchcontent_image_denied_2'] = '';
	$option_output['plugin_fetchcontent_image_denied_3'] = 'checked="checked"';
}

if ($CONFIG['plugin_fetchcontent_check_referer'] == '0') {
	$option_output['plugin_fetchcontent_check_referer_0'] = 'checked="checked"';
	$option_output['plugin_fetchcontent_check_referer_1'] = '';
	$option_output['plugin_fetchcontent_check_referer_2'] = '';
} elseif ($CONFIG['plugin_fetchcontent_check_referer'] == '1') { 
	$option_output['plugin_fetchcontent_check_referer_0'] = '';
	$option_output['plugin_fetchcontent_check_referer_1'] = 'checked="checked"';
	$option_output['plugin_fetchcontent_check_referer_2'] = '';
} else { 
	$option_output['plugin_fetchcontent_check_referer_0'] = '';
	$option_output['plugin_fetchcontent_check_referer_1'] = '';
	$option_output['plugin_fetchcontent_check_referer_2'] = 'checked="checked"';
}

if ($CONFIG['plugin_fetchcontent_non_image'] == '0') {
	$option_output['plugin_fetchcontent_non_image_0'] = 'checked="checked"';
	$option_output['plugin_fetchcontent_non_image_1'] = '';
	$option_output['plugin_fetchcontent_non_image_2'] = '';
	$option_output['plugin_fetchcontent_non_image_3'] = '';
} elseif ($CONFIG['plugin_fetchcontent_non_image'] == '1') { 
	$option_output['plugin_fetchcontent_non_image_0'] = '';
	$option_output['plugin_fetchcontent_non_image_1'] = 'checked="checked"';
	$option_output['plugin_fetchcontent_non_image_2'] = '';
	$option_output['plugin_fetchcontent_non_image_3'] = '';
} elseif ($CONFIG['plugin_fetchcontent_non_image'] == '2') { 
	$option_output['plugin_fetchcontent_non_image_0'] = '';
	$option_output['plugin_fetchcontent_non_image_1'] = '';
	$option_output['plugin_fetchcontent_non_image_2'] = 'checked="checked"';
	$option_output['plugin_fetchcontent_non_image_3'] = '';
} else { 
	$option_output['plugin_fetchcontent_non_image_0'] = '';
	$option_output['plugin_fetchcontent_non_image_1'] = '';
	$option_output['plugin_fetchcontent_non_image_2'] = '';
	$option_output['plugin_fetchcontent_non_image_3'] = 'checked="checked"';
}

$option_output['plugin_fetchcontent_max_cols'] = '';
$option_output['plugin_fetchcontent_max_rows'] = '';


pageheader($lang_plugin_fetchcontent['display_name']);
list($timestamp, $form_token) = getFormToken();
echo <<< EOT
<form action="index.php?file=fetchcontent/admin" method="post" name="im_settings">
EOT;
starttable('100%', $fetchcontent_icon_array['config'] . $lang_plugin_fetchcontent['configuration'] . ': ' . $lang_plugin_fetchcontent['display_name'] . ' v' . $version, 3, 'cpg_zebra');

if ($superCage->post->keyExists('submit')) {
    echo <<< EOT
	<tr>
		<td class="tablef" colspan="3" >
EOT;
    if ($config_changes_counter > 0) {
        msg_box('', $lang_plugin_fetchcontent['update_success'], '', '', 'success');
    } else {
        msg_box('', $lang_plugin_fetchcontent['no_changes'], '', '', 'validation');
    }
    echo <<< EOT
		</td>
	</tr>
EOT;
} 
	echo <<< EOT
	<tr>
		<td class="tablef" colspan="3" >
        	{$lang_plugin_fetchcontent['display_name']} &copy; Coppermine dev team
            {$announcement_thread}
        	{$documentation_link}
        	{$configuration_link}
		</td>
	</tr>
EOT;
echo <<< EOT
	<tr>
		<td valign="top" colspan="2" class="tableh1">
		    {$lang_plugin_fetchcontent['overall_settings']}
		</td>
	</tr>
	<tr>
	    <td valign="top">
	        {$lang_plugin_fetchcontent['enable_logging']} <a href="index.php?file=fetchcontent/docs_{$documentation_file}#configuration_overall_enable_logging" class="greybox" title="{$lang_plugin_fetchcontent['enable_logging']}"><img src="images/help.gif" width="13" height="11" border="0" alt="" /></a>
	    </td>
	    <td valign="top">
            <input type="radio" name="plugin_fetchcontent_enable_logging" id="plugin_fetchcontent_enable_logging_0" class="radio" value="0" {$option_output['plugin_fetchcontent_enable_logging_0']} /><label for="plugin_fetchcontent_enable_logging_0" class="clickable_option">{$lang_common['no']}</label><br />
            <input type="radio" name="plugin_fetchcontent_enable_logging" id="plugin_fetchcontent_enable_logging_1" class="radio" value="1" {$option_output['plugin_fetchcontent_enable_logging_1']} /><label for="plugin_fetchcontent_enable_logging_1" class="clickable_option">{$lang_plugin_fetchcontent['errors_only']}</label><br />
            <input type="radio" name="plugin_fetchcontent_enable_logging" id="plugin_fetchcontent_enable_logging_2" class="radio" value="2" {$option_output['plugin_fetchcontent_enable_logging_2']} /><label for="plugin_fetchcontent_enable_logging_2" class="clickable_option">{$lang_plugin_fetchcontent['log_anything']}</label>
	    </td>
	</tr>
	<tr>
		<td valign="top">
			<label for="plugin_fetchcontent_debug" class="clickable_option">{$lang_plugin_fetchcontent['debugging']}</label> <a href="index.php?file=fetchcontent/docs_{$documentation_file}#configuration_overall_debug" class="greybox" title="{$lang_plugin_fetchcontent['debugging']}"><img src="images/help.gif" width="13" height="11" border="0" alt="" /></a>
		</td>
		<td valign="top">
			<input type="checkbox" name="plugin_fetchcontent_debug" id="plugin_fetchcontent_debug" class="checkbox" value="1" {$option_output['plugin_fetchcontent_debug']} /><label for="plugin_fetchcontent_debug" class="clickable_option">{$lang_common['yes']}</label>
		</td>
	</tr>
	<tr>
		<td valign="top" colspan="2" class="tableh1">
		    {$lang_plugin_fetchcontent['individual_file_settings']}
		</td>
	</tr>
	<tr>
	    <td valign="top">
	        {$lang_plugin_fetchcontent['deny_access_action']} <a href="index.php?file=fetchcontent/docs_{$documentation_file}#configuration_image_image_denied" class="greybox" title="{$lang_plugin_fetchcontent['deny_access_action']}"><img src="images/help.gif" width="13" height="11" border="0" alt="" /></a>
	    </td>
	    <td valign="top">
            <input type="radio" name="plugin_fetchcontent_image_denied" id="plugin_fetchcontent_image_denied_0" class="radio" value="0" {$option_output['plugin_fetchcontent_image_denied_0']} /><label for="plugin_fetchcontent_image_denied_0" class="clickable_option">{$lang_plugin_fetchcontent['output_nothing']}</label><br />
            <input type="radio" name="plugin_fetchcontent_image_denied" id="plugin_fetchcontent_image_denied_1" class="radio" value="1" {$option_output['plugin_fetchcontent_image_denied_1']} /><label for="plugin_fetchcontent_image_denied_1" class="clickable_option">{$lang_plugin_fetchcontent['blank_image']}</label><br />
            <input type="radio" name="plugin_fetchcontent_image_denied" id="plugin_fetchcontent_image_denied_2" class="radio" value="2" {$option_output['plugin_fetchcontent_image_denied_2']} /><label for="plugin_fetchcontent_image_denied_2" class="clickable_option">{$lang_plugin_fetchcontent['placeholder_image']} ({$lang_plugin_fetchcontent['recommended']})</label><br />
            <input type="radio" name="plugin_fetchcontent_image_denied" id="plugin_fetchcontent_image_denied_3" class="radio" value="3" {$option_output['plugin_fetchcontent_image_denied_3']} /><label for="plugin_fetchcontent_image_denied_3" class="clickable_option">{$lang_plugin_fetchcontent['display_anyway']} ({$lang_plugin_fetchcontent['not_recommended']})</label>
	    </td>
	</tr>
	<tr>
		<td valign="top">
			{$lang_plugin_fetchcontent['check_referer']} <a href="index.php?file=fetchcontent/docs_{$documentation_file}#configuration_image_check_referer" class="greybox" title="{$lang_plugin_fetchcontent['check_referer']}"><img src="images/help.gif" width="13" height="11" border="0" alt="" /></a>
		</td>
		<td valign="top">
            <input type="radio" name="plugin_fetchcontent_check_referer" id="plugin_fetchcontent_check_referer_0" class="radio" value="0" {$option_output['plugin_fetchcontent_check_referer_0']} disabled="disabled" /><label for="plugin_fetchcontent_check_referer_0" class="clickable_option">{$lang_common['no']}</label><br />
            <input type="radio" name="plugin_fetchcontent_check_referer" id="plugin_fetchcontent_check_referer_1" class="radio" value="1" {$option_output['plugin_fetchcontent_check_referer_1']} disabled="disabled" /><label for="plugin_fetchcontent_check_referer_1" class="clickable_option">{$lang_plugin_fetchcontent['only_gallery_domain']}</label><br />
            <input type="radio" name="plugin_fetchcontent_check_referer" id="plugin_fetchcontent_check_referer_2" class="radio" value="2" {$option_output['plugin_fetchcontent_check_referer_2']} disabled="disabled" /><label for="plugin_fetchcontent_check_referer_2" class="clickable_option">{$lang_plugin_fetchcontent['domain_list']}</label>
            <input type="text" name="plugin_fetchcontent_domainlist" id="plugin_fetchcontent_domainlist" class="textinput" size="30" maxlength="255" value="{$CONFIG['plugin_fetchcontent_domainlist']}" disabled="disabled" />
	    </td>
	</tr>
	<tr>
	    <td valign="top">
	        {$lang_plugin_fetchcontent['allow_non_images']} <a href="index.php?file=fetchcontent/docs_{$documentation_file}#configuration_image_image_denied" class="greybox" title="{$lang_plugin_fetchcontent['allow_non_images']}"><img src="images/help.gif" width="13" height="11" border="0" alt="" /></a>
	    </td>
	    <td valign="top">
            <input type="radio" name="plugin_fetchcontent_non_image" id="plugin_fetchcontent_non_image_0" class="radio" value="0" {$option_output['plugin_fetchcontent_non_image_0']} /><label for="plugin_fetchcontent_non_image_0" class="clickable_option">{$lang_common['no']}</label><br />
            <input type="radio" name="plugin_fetchcontent_non_image" id="plugin_fetchcontent_non_image_1" class="radio" value="1" {$option_output['plugin_fetchcontent_non_image_1']} /><label for="plugin_fetchcontent_non_image_1" class="clickable_option">{$lang_plugin_fetchcontent['allowed_if_filetype_set']} ({$lang_plugin_fetchcontent['recommended']})</label><br />
            <input type="radio" name="plugin_fetchcontent_non_image" id="plugin_fetchcontent_non_image_2" class="radio" value="2" {$option_output['plugin_fetchcontent_non_image_2']} /><label for="plugin_fetchcontent_non_image_2" class="clickable_option">{$lang_plugin_fetchcontent['allowed_if_imageonly_not_set']}</label><br />
            <input type="radio" name="plugin_fetchcontent_non_image" id="plugin_fetchcontent_non_image_3" class="radio" value="3" {$option_output['plugin_fetchcontent_non_image_3']} /><label for="plugin_fetchcontent_non_image_3" class="clickable_option">{$lang_plugin_fetchcontent['allowed_no_matter_what']} ({$lang_plugin_fetchcontent['not_recommended']})</label>
	    </td>
	</tr>
	<tr>
		<td valign="top" colspan="2" class="tableh1">
		    {$lang_plugin_fetchcontent['fetching_several_files']}
		</td>
	</tr>
	<tr>
		<td valign="top">
			{$lang_plugin_fetchcontent['max_cols']} <a href="index.php?file=fetchcontent/docs_{$documentation_file}#configuration_several_cols" class="greybox" title="{$lang_plugin_fetchcontent['max_cols']}"><img src="images/help.gif" width="13" height="11" border="0" alt="" /></a>
		</td>
		<td>
			<input type="text" name="plugin_fetchcontent_max_cols" id="plugin_fetchcontent_max_cols" class="textinput spin-button" size="2" maxlength="2" value="{$CONFIG['plugin_fetchcontent_max_cols']}" {$option_output['plugin_fetchcontent_max_cols']} />
		</td>
	</tr>
	<tr>
		<td valign="top">
			{$lang_plugin_fetchcontent['max_rows']} <a href="index.php?file=fetchcontent/docs_{$documentation_file}#configuration_several_rows" class="greybox" title="{$lang_plugin_fetchcontent['max_rows']}"><img src="images/help.gif" width="13" height="11" border="0" alt="" /></a>
		</td>
		<td>
			<input type="text" name="plugin_fetchcontent_max_rows" id="plugin_fetchcontent_max_rows" class="textinput spin-button" size="2" maxlength="2" value="{$CONFIG['plugin_fetchcontent_max_rows']}" {$option_output['plugin_fetchcontent_max_rows']} />
		</td>
	</tr>
	<tr>
		<td class="tablef" colspan="3">
			<input type="hidden" name="form_token" value="{$form_token}" />
			<input type="hidden" name="timestamp" value="{$timestamp}" />
			<button type="submit" class="button" name="submit" value="{$lang_plugin_fetchcontent['submit']}">{$fetchcontent_icon_array['submit']}{$lang_plugin_fetchcontent['submit']}</button>
		</td>
	</tr>
EOT;

endtable();
echo <<< EOT
</form>
EOT;
pagefooter();



?>