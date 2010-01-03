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
      'plugin_im_compatible' => array('type' => 'checkbox', 'min' => '0', 'max' => '1'),
      'plugin_im_cookies' => array('type' => 'checkbox', 'min' => '0', 'max' => '1'),
      'plugin_im_urlvalues' => array('type' => 'checkbox', 'min' => '0', 'max' => '1'),
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
      } // only loop if config value is set --- end
  }
}


// display config page

// Set the option output stuff 
if ($CONFIG['plugin_im_compatible'] == '1') {
	$option_output['plugin_im_compatible_1'] = 'checked="checked"';
	$option_output['plugin_im_compatible_0'] = '';
} else { 
	$option_output['plugin_im_compatible_0'] = 'checked="checked"';
	$option_output['plugin_im_compatible_1'] = '';
}

if ($CONFIG['plugin_im_cookies'] == '1') {
	$option_output['plugin_im_cookies_1'] = 'checked="checked"';
	$option_output['plugin_im_cookies_0'] = '';
} else { 
	$option_output['plugin_im_cookies_1'] = '';
	$option_output['plugin_im_cookies_0'] = 'checked="checked"';
}

if ($CONFIG['plugin_im_urlvalues'] == '1') {
	$option_output['plugin_im_urlvalues_1'] = 'checked="checked"';
	$option_output['plugin_im_urlvalues_0'] = '';
} else { 
	$option_output['plugin_im_urlvalues_0'] = 'checked="checked"';
	$option_output['plugin_im_urlvalues_1'] = '';
}



pageheader($lang_plugin_im['display_name']);
list($timestamp, $form_token) = getFormToken();
echo <<< EOT
<form action="index.php?file=image_manipulation/admin" method="post" name="im_settings">
EOT;
starttable('100%', $lang_plugin_im['plugin_configuration'] . ': ' . $lang_plugin_im['main_title'] . ' v' . $version, 3, 'cpg_zebra');
echo <<< EOT
	<tr>
		<td class="tablef" colspan="3" >
EOT;
if ($superCage->post->keyExists('submit')) {
    if ($config_changes_counter > 0) {
        msg_box('', $lang_plugin_im['update_success'], '', '', 'success');
    } else {
        msg_box('', $lang_plugin_im['no_changes'], '', '', 'validation');
    }
} else {
	echo <<< EOT
	{$lang_plugin_im['display_name']} &copy; Timo Schewe (<a href="http://www.timos-welt.de/" rel="external" class="external">Timos-welt.de</a>)
    <a href="http://forum.coppermine-gallery.net/index.php/topic,62875.0.html" rel="external" class="admin_menu">{$lang_plugin_im['announcement_thread']}</a>
EOT;
}
echo <<< EOT
		</td>
	</tr>
	<tr>
		<td valign="top">
			{$lang_plugin_im['usecompatible']}
		</td>
		<td colspan="1">
			<input type="radio" name="plugin_im_compatible" id="plugin_im_compatible_1" class="radio" value="1" {$option_output['plugin_im_compatible_1']} /><label for="plugin_im_compatible_1" class="clickable_option">{$lang_plugin_im['enable']}</label><br />
			<input type="radio" name="plugin_im_compatible" id="plugin_im_compatible_0" class="radio" value="0" {$option_output['plugin_im_compatible_0']} /><label for="plugin_im_compatible_0" class="clickable_option">{$lang_plugin_im['disable']}</label>
		</td>
	</tr>
	<tr>
		<td valign="top">
			{$lang_plugin_im['usecookies']}
		</td>
		<td colspan="1">
			<input type="radio" name="plugin_im_cookies" id="plugin_im_cookies_1" class="radio" value="1" {$option_output['plugin_im_cookies_1']} /><label for="plugin_im_cookies_1" class="clickable_option">{$lang_plugin_im['enable']}</label><br />
			<input type="radio" name="plugin_im_cookies" id="plugin_im_cookies_0" class="radio" value="0" {$option_output['plugin_im_cookies_0']} /><label for="plugin_im_cookies_0" class="clickable_option">{$lang_plugin_im['disable']}</label>
		</td>
	</tr>
	<tr>
		<td valign="top">
			{$lang_plugin_im['useurlvalues']}
		</td>
		<td colspan="1">
			<input type="radio" name="plugin_im_urlvalues" id="plugin_im_urlvalues_1" class="radio" value="1" {$option_output['plugin_im_urlvalues_1']} /><label for="plugin_im_urlvalues_1" class="clickable_option">{$lang_plugin_im['enable']}</label><br />
			<input type="radio" name="plugin_im_urlvalues" id="plugin_im_urlvalues_0" class="radio" value="0" {$option_output['plugin_im_urlvalues_0']} /><label for="plugin_im_urlvalues_0" class="clickable_option">{$lang_plugin_im['disable']}</label>
		</td>
	</tr>
	<tr>
		<td class="tablef" colspan="3">
			<input type="hidden" name="form_token" value="{$form_token}" />
			<input type="hidden" name="timestamp" value="{$timestamp}" />
			<button type="submit" class="button" name="submit" value="Submit">{$lang_plugin_im['submit']}</button>
		</td>
	</tr>
EOT;

endtable();
echo <<< EOT
</form>
EOT;
pagefooter();



?>