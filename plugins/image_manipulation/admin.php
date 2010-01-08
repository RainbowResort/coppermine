<?php
/**************************************************
  Coppermine 1.5.x Plugin - Image manipulation
  *************************************************
  Copyright (c) 2010 Timo Schewe (www.timos-welt.de)
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

require('./plugins/image_manipulation/configuration.php');

// create Inspekt supercage
$superCage = Inspekt::makeSuperCage();

if (!GALLERY_ADMIN_MODE) {
    cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
}

// text direction
if($lang_text_dir=='ltr') {
  $align="left";
  $direction="ltr";
}else {
  $align="right";
  $direction="rtl";
}

// get sanitized POST parameters
if ($superCage->post->keyExists('submit')) {
	//Check if the form token is valid
	if(!checkFormToken()){
		cpg_die(ERROR, $lang_errors['invalid_form_token'], __FILE__, __LINE__);
	}
	// Define the sanitization patterns
	$sanitization_array = array(
	  'plugin_image_manipulation_compatible' => array('type' => 'checkbox', 'min' => '0', 'max' => '1'),
	  'plugin_image_manipulation_cookies' => array('type' => 'checkbox', 'min' => '0', 'max' => '1'),
	  'plugin_image_manipulation_urlvalues' => array('type' => 'checkbox', 'min' => '0', 'max' => '1'),
	);
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
if ($CONFIG['plugin_image_manipulation_compatible'] == '1') {
	$option_output['plugin_image_manipulation_compatible'] = 'checked="checked"';
} else { 
	$option_output['plugin_image_manipulation_compatible'] = '';
}

if ($CONFIG['plugin_image_manipulation_cookies'] == '1') {
	$option_output['plugin_image_manipulation_cookies'] = 'checked="checked"';
} else { 
	$option_output['plugin_image_manipulation_cookies'] = '';
}

if ($CONFIG['plugin_image_manipulation_urlvalues'] == '1') {
	$option_output['plugin_image_manipulation_urlvalues'] = 'checked="checked"';
} else { 
	$option_output['plugin_image_manipulation_urlvalues'] = 'checked="checked"';
}



pageheader($lang_plugin_image_manipulation['display_name']);
list($timestamp, $form_token) = getFormToken();
echo <<< EOT
<form action="index.php?file=image_manipulation/admin" method="post" name="im_settings">
EOT;
starttable('100%', $image_manipulation_icon_array['config'] . $lang_plugin_image_manipulation['plugin_config'] . ': ' . $lang_plugin_image_manipulation['main_title'] . ' v' . $version, 3, 'cpg_zebra');
echo <<< EOT
	<tr>
		<td class="tablef" colspan="3" >
EOT;
if ($superCage->post->keyExists('submit')) {
    if ($config_changes_counter > 0) {
        msg_box('', $lang_plugin_image_manipulation['update_success'], '', '', 'success');
    } else {
        msg_box('', $lang_plugin_image_manipulation['no_changes'], '', '', 'validation');
    }
} else {
	echo <<< EOT
	{$lang_plugin_image_manipulation['display_name']} &copy; Timo Schewe (<a href="http://www.timos-welt.de/" rel="external" class="external">Timos-welt.de</a>)
    <a href="http://forum.coppermine-gallery.net/index.php/topic,62875.0.html" rel="external" class="admin_menu">{$image_manipulation_icon_array['announcement']}{$lang_plugin_image_manipulation['announcement_thread']}</a>
EOT;
}
echo <<< EOT
		</td>
	</tr>
	<tr>
		<td valign="top">
			<label for="plugin_image_manipulation_compatible" class="clickable_option">{$lang_plugin_image_manipulation['usecompatible']}</label> <a href="plugins/image_manipulation/docs/{$documentation_file}.htm#configuration_compatible_mode" class="greybox" title="{$lang_plugin_image_manipulation['usecompatible']}"><img src="images/help.gif" width="13" height="11" border="0" alt="" /></a>
		</td>
		<td colspan="1">
			<input type="checkbox" name="plugin_image_manipulation_compatible" id="plugin_image_manipulation_compatible" class="checkbox" value="1" {$option_output['plugin_image_manipulation_compatible']} /><label for="plugin_image_manipulation_compatible" class="clickable_option">{$lang_common['yes']}</label>
		</td>
	</tr>
	<tr>
		<td valign="top">
			<label for="plugin_image_manipulation_cookies" class="clickable_option">{$lang_plugin_image_manipulation['usecookies']}</label>
		</td>
		<td colspan="1">
			<input type="checkbox" name="plugin_image_manipulation_cookies" id="plugin_image_manipulation_cookies" class="checkbox" value="1" {$option_output['plugin_image_manipulation_cookies']} /><label for="plugin_image_manipulation_cookies" class="clickable_option">{$lang_common['yes']}</label>
		</td>
	</tr>
	<tr>
		<td valign="top">
			<label for="plugin_image_manipulation_urlvalues" class="clickable_option">{$lang_plugin_image_manipulation['useurlvalues']}</label>
		</td>
		<td colspan="1">
			<input type="checkbox" name="plugin_image_manipulation_urlvalues" id="plugin_image_manipulation_urlvalues" class="checkbox" value="1" {$option_output['plugin_image_manipulation_urlvalues']} /><label for="plugin_image_manipulation_urlvalues" class="clickable_option">{$lang_common['yes']}</label>
		</td>
	</tr>
	<tr>
		<td class="tablef" colspan="3">
			<input type="hidden" name="form_token" value="{$form_token}" />
			<input type="hidden" name="timestamp" value="{$timestamp}" />
			<button type="submit" class="button" name="submit" value="{$lang_plugin_image_manipulation['submit']}">{$image_manipulation_icon_array['submit']}{$lang_plugin_image_manipulation['submit']}</button>
		</td>
	</tr>
EOT;

endtable();
echo <<< EOT
</form>
EOT;
pagefooter();



?>