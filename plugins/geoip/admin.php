<?php
/**************************************************
  Coppermine 1.5.x Plugin - Geo IP Lookup (geoip)
  *************************************************
  Copyright (c) 2010 Joachim Müller
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

if (!defined('IN_COPPERMINE')) {
    die('Not in Coppermine...');
}

require_once('./plugins/geoip/configuration.php');
	
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
      'plugin_geoip_scope' => array('type' => 'checkbox', 'min' => '0', 'max' => '1'),
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
          if ($san_value['type'] == 'array') { // type is array --- start              $evaluate_value = $superCage->post->getRaw($san_key);
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
if ($CONFIG['plugin_geoip_scope'] == '0') {
	$option_output['plugin_geoip_scope_0'] = 'checked="checked"';
	$option_output['plugin_geoip_scope_1'] = '';
} else { 
	$option_output['plugin_geoip_scope_0'] = '';
	$option_output['plugin_geoip_scope_1'] = 'checked="checked"';
}

if (!file_exists("./plugins/geoip/GeoLiteCity.dat")) {
	$option_output['plugin_geoip_scope_0'] = 'checked="checked"';
	$option_output['plugin_geoip_scope_1'] = 'disabled="disabled"';
	if ($CONFIG['plugin_geoip_scope'] == '1') {
	    $CONFIG['plugin_geoip_scope'] = '0';
        cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_geoip_scope']}' WHERE name='plugin_geoip_scope'");
	}
}

pageheader(sprintf($lang_plugin_geoip['configure_plugin'], $lang_plugin_geoip['plugin_name']));
list($timestamp, $form_token) = getFormToken();
echo <<< EOT
<form action="index.php?file=geoip/admin" method="post" name="geoip_settings">
EOT;
starttable('100%', $geoip_icon_array['configure'] . sprintf($lang_plugin_geoip['configure_plugin'], $lang_plugin_geoip['plugin_name'] . ' v' . $version), 2, 'cpg_zebra');
if ($superCage->post->keyExists('submit')) {
echo <<< EOT
	<tr>
		<td class="tablef" colspan="2" >
EOT;
    if ($config_changes_counter > 0) {
        msg_box('', $lang_plugin_geoip['update_success'], '', '', 'success');
    } else {
        msg_box('', $lang_plugin_geoip['no_changes'], '', '', 'validation');
    }
echo <<< EOT
		</td>
	</tr>
EOT;
} 
echo <<< EOT
	<tr>
		<td valign="top">
		    {$lang_plugin_geoip['scope']}
		</td>
		<td>
			<input type="radio" name="plugin_geoip_scope" id="plugin_geoip_scope_0" class="radio" value="0" {$option_output['plugin_geoip_scope_0']} /><label for="plugin_geoip_scope_0" class="clickable_option">{$lang_plugin_geoip['country']}</label>&nbsp;&nbsp;
			<input type="radio" name="plugin_geoip_scope" id="plugin_geoip_scope_1" class="radio" value="1" {$option_output['plugin_geoip_scope_1']} /><label for="plugin_geoip_scope_1" class="clickable_option">{$lang_plugin_geoip['city']}</label>
			{$city_lookup}
		</td>
	</tr>
	<tr>
		<td class="tablef" colspan="2">
			<input type="hidden" name="form_token" value="{$form_token}" />
			<input type="hidden" name="timestamp" value="{$timestamp}" />
			<button type="submit" class="button" name="submit" value="{$lang_common['ok']}">{$geoip_icon_array['ok']}{$lang_common['ok']}</button>
		</td>
	</tr>
EOT;

endtable();
echo <<< EOT
</form>

EOT;
pagefooter();

?>