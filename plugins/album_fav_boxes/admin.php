<?php
/**************************************************
  Coppermine 1.5.x Plugin - album_fav_boxes!
  *************************************************
  Copyright (c) 2009 Nibbler
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/branches/cpg1.5.x/plugins/album_fav_boxes/admin.php $
  $Revision: 6793 $
  $LastChangedBy: gaugau $
  $Date: 2009-11-26 18:23:33 +0100 (Do, 26. Nov 2009) $
  **************************************************/

require_once('./plugins/album_fav_boxes/configuration.php');
	
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
      'plugin_album_fav_boxes_regular' => array('type' => 'checkbox', 'min' => '0', 'max' => '1'),
      'plugin_album_fav_boxes_search' => array('type' => 'checkbox', 'min' => '0', 'max' => '1'),
      'plugin_album_fav_boxes_favpics' => array('type' => 'checkbox', 'min' => '0', 'max' => '1'),
      'plugin_album_fav_boxes_lastcom' => array('type' => 'checkbox', 'min' => '0', 'max' => '1'),
      'plugin_album_fav_boxes_lastcomby' => array('type' => 'checkbox', 'min' => '0', 'max' => '1'),
      'plugin_album_fav_boxes_lastup' => array('type' => 'checkbox', 'min' => '0', 'max' => '1'),
      'plugin_album_fav_boxes_lastupby' => array('type' => 'checkbox', 'min' => '0', 'max' => '1'),
      'plugin_album_fav_boxes_topn' => array('type' => 'checkbox', 'min' => '0', 'max' => '1'),
      'plugin_album_fav_boxes_toprated' => array('type' => 'checkbox', 'min' => '0', 'max' => '1'),
      'plugin_album_fav_boxes_lasthits' => array('type' => 'checkbox', 'min' => '0', 'max' => '1'),
      'plugin_album_fav_boxes_random' => array('type' => 'checkbox', 'min' => '0', 'max' => '1'),
      'plugin_album_fav_boxes_lastalb' => array('type' => 'checkbox', 'min' => '0', 'max' => '1'),
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
if ($CONFIG['plugin_album_fav_boxes_regular'] == '1') {
	$option_output['plugin_album_fav_boxes_regular'] = 'checked="checked"';
} else { 
	$option_output['plugin_album_fav_boxes_regular'] = '';
}

if ($CONFIG['plugin_album_fav_boxes_search'] == '1') {
	$option_output['plugin_album_fav_boxes_search'] = 'checked="checked"';
} else { 
	$option_output['plugin_album_fav_boxes_search'] = '';
}

if ($CONFIG['plugin_album_fav_boxes_favpics'] == '1') {
	$option_output['plugin_album_fav_boxes_favpics'] = 'checked="checked"';
} else { 
	$option_output['plugin_album_fav_boxes_favpics'] = '';
}

if ($CONFIG['plugin_album_fav_boxes_lastcom'] == '1') {
	$option_output['plugin_album_fav_boxes_lastcom'] = 'checked="checked"';
} else { 
	$option_output['plugin_album_fav_boxes_lastcom'] = '';
}

if ($CONFIG['plugin_album_fav_boxes_lastcomby'] == '1') {
	$option_output['plugin_album_fav_boxes_lastcomby'] = 'checked="checked"';
} else { 
	$option_output['plugin_album_fav_boxes_lastcomby'] = '';
}

if ($CONFIG['plugin_album_fav_boxes_lastup'] == '1') {
	$option_output['plugin_album_fav_boxes_lastup'] = 'checked="checked"';
} else { 
	$option_output['plugin_album_fav_boxes_lastup'] = '';
}

if ($CONFIG['plugin_album_fav_boxes_lastupby'] == '1') {
	$option_output['plugin_album_fav_boxes_lastupby'] = 'checked="checked"';
} else { 
	$option_output['plugin_album_fav_boxes_lastupby'] = '';
}

if ($CONFIG['plugin_album_fav_boxes_topn'] == '1') {
	$option_output['plugin_album_fav_boxes_topn'] = 'checked="checked"';
} else { 
	$option_output['plugin_album_fav_boxes_topn'] = '';
}

if ($CONFIG['plugin_album_fav_boxes_toprated'] == '1') {
	$option_output['plugin_album_fav_boxes_toprated'] = 'checked="checked"';
} else { 
	$option_output['plugin_album_fav_boxes_toprated'] = '';
}

if ($CONFIG['plugin_album_fav_boxes_lasthits'] == '1') {
	$option_output['plugin_album_fav_boxes_lasthits'] = 'checked="checked"';
} else { 
	$option_output['plugin_album_fav_boxes_lasthits'] = '';
}

if ($CONFIG['plugin_album_fav_boxes_random'] == '1') {
	$option_output['plugin_album_fav_boxes_random'] = 'checked="checked"';
} else { 
	$option_output['plugin_album_fav_boxes_random'] = '';
}

if ($CONFIG['plugin_album_fav_boxes_lastalb'] == '1') {
	$option_output['plugin_album_fav_boxes_lastalb'] = 'checked="checked"';
} else { 
	$option_output['plugin_album_fav_boxes_lastalb'] = '';
}

pageheader($lightbox_lang['plugin_name']);
list($timestamp, $form_token) = getFormToken();
echo <<< EOT
<form action="index.php?file=album_fav_boxes/admin" method="post" name="album_fav_boxes_settings">
EOT;
starttable('100%', $lightbox['lang']['Configuration'] . ': ' . $lightbox['lang']['plugin_name'] . ' v' . $version, 3, 'cpg_zebra');
if ($superCage->post->keyExists('submit')) {
echo <<< EOT
	<tr>
		<td class="tablef" colspan="3" >
EOT;
    if ($config_changes_counter > 0) {
        msg_box('', $lightbox['lang']['Update success'], '', '', 'success');
    } else {
        msg_box('', $lightbox['lang']['No changes'], '', '', 'validation');
    }
echo <<< EOT
		</td>
	</tr>
EOT;
} 
$meta_album_translation = sprintf($lightbox['lang']['Albums'], $lightbox['lang']['plugin_name']);
echo <<< EOT
	<tr>
		<td class="tableh2" colspan="3">
			{$meta_album_translation}:
		</td>
	</tr>
	<tr>
		<td colspan="3">
			<input type="checkbox" name="plugin_album_fav_boxes_regular" id="plugin_album_fav_boxes_regular" class="checkbox" value="1" {$option_output['plugin_album_fav_boxes_regular']} /><label for="plugin_album_fav_boxes_regular" class="clickable_option">{$album_fav_boxes_icon_array['regular']}{$lightbox['lang']['Regular albums']}</label>
		</td>
	</tr>
	<tr>
		<td colspan="3">
			<input type="checkbox" name="plugin_album_fav_boxes_search" id="plugin_album_fav_boxes_search" class="checkbox" value="1" {$option_output['plugin_album_fav_boxes_search']} /><label for="plugin_album_fav_boxes_search" class="clickable_option">{$album_fav_boxes_icon_array['search']}{$lightbox['lang']['Search results']}</label>
		</td>
	</tr>
	<tr>
		<td colspan="3">
			<input type="checkbox" name="plugin_album_fav_boxes_favpics" id="plugin_album_fav_boxes_favpics" class="checkbox" value="1" {$option_output['plugin_album_fav_boxes_favpics']} /><label for="plugin_album_fav_boxes_favpics" class="clickable_option">{$album_fav_boxes_icon_array['favpics']}{$lang_meta_album_names['favpics']}</label>
		</td>
	</tr>
	<tr>
		<td colspan="3">
			<input type="checkbox" name="plugin_album_fav_boxes_lastcom" id="plugin_album_fav_boxes_lastcom" class="checkbox" value="1" {$option_output['plugin_album_fav_boxes_lastcom']} /><label for="plugin_album_fav_boxes_lastcom" class="clickable_option">{$album_fav_boxes_icon_array['lastcom']}{$lang_meta_album_names['lastcom']}</label>
		</td>
	</tr>
	<tr>
		<td colspan="3">
			<input type="checkbox" name="plugin_album_fav_boxes_lastcomby" id="plugin_album_fav_boxes_lastcomby" class="checkbox" value="1" {$option_output['plugin_album_fav_boxes_lastcomby']} /><label for="plugin_album_fav_boxes_lastcomby" class="clickable_option">{$album_fav_boxes_icon_array['lastcom']}{$lightbox['lang']['Last comments by']}</label>
		</td>
	</tr>
	<tr>
		<td colspan="3">
			<input type="checkbox" name="plugin_album_fav_boxes_lastup" id="plugin_album_fav_boxes_lastup" class="checkbox" value="1" {$option_output['plugin_album_fav_boxes_lastup']} /><label for="plugin_album_fav_boxes_lastup" class="clickable_option">{$album_fav_boxes_icon_array['lastup']}{$lang_meta_album_names['lastup']}</label>
		</td>
	</tr>
	<tr>
		<td colspan="3">
			<input type="checkbox" name="plugin_album_fav_boxes_lastupby" id="plugin_album_fav_boxes_lastupby" class="checkbox" value="1" {$option_output['plugin_album_fav_boxes_lastupby']} /><label for="plugin_album_fav_boxes_lastupby" class="clickable_option">{$album_fav_boxes_icon_array['lastup']}{$lightbox['lang']['Last additions by']}</label>
		</td>
	</tr>
	<tr>
		<td colspan="3">
			<input type="checkbox" name="plugin_album_fav_boxes_topn" id="plugin_album_fav_boxes_topn" class="checkbox" value="1" {$option_output['plugin_album_fav_boxes_topn']} /><label for="plugin_album_fav_boxes_topn" class="clickable_option">{$album_fav_boxes_icon_array['topn']}{$lang_meta_album_names['topn']}</label>
		</td>
	</tr>
	<tr>
		<td colspan="3">
			<input type="checkbox" name="plugin_album_fav_boxes_toprated" id="plugin_album_fav_boxes_toprated" class="checkbox" value="1" {$option_output['plugin_album_fav_boxes_toprated']} /><label for="plugin_album_fav_boxes_toprated" class="clickable_option">{$album_fav_boxes_icon_array['toprated']}{$lang_meta_album_names['toprated']}</label>
		</td>
	</tr>
	<tr>
		<td colspan="3">
			<input type="checkbox" name="plugin_album_fav_boxes_lasthits" id="plugin_album_fav_boxes_lasthits" class="checkbox" value="1" {$option_output['plugin_album_fav_boxes_lasthits']} /><label for="plugin_album_fav_boxes_lasthits" class="clickable_option">{$album_fav_boxes_icon_array['lasthits']}{$lang_meta_album_names['lasthits']}</label>
		</td>
	</tr>
	<tr>
		<td colspan="3">
			<input type="checkbox" name="plugin_album_fav_boxes_random" id="plugin_album_fav_boxes_random" class="checkbox" value="1" {$option_output['plugin_album_fav_boxes_random']} /><label for="plugin_album_fav_boxes_random" class="clickable_option">{$album_fav_boxes_icon_array['random']}{$lang_meta_album_names['random']}</label>
		</td>
	</tr>
	<tr>
		<td colspan="3">
			<input type="checkbox" name="plugin_album_fav_boxes_lastalb" id="plugin_album_fav_boxes_lastalb" class="checkbox" value="1" {$option_output['plugin_album_fav_boxes_lastalb']} /><label for="plugin_album_fav_boxes_lastalb" class="clickable_option">{$album_fav_boxes_icon_array['lastalb']}{$lang_meta_album_names['lastalb']}</label>
		</td>
	</tr>
	<tr>
		<td class="tablef" colspan="3">
			<input type="hidden" name="form_token" value="{$form_token}" />
			<input type="hidden" name="timestamp" value="{$timestamp}" />
			<button type="submit" class="button" name="submit" value="{$lightbox['lang']['Submit']}">{$album_fav_boxes_icon_array['ok']}{$lightbox['lang']['Submit']}</button>
		</td>
	</tr>
EOT;

endtable();
echo <<< EOT
</form>

EOT;
pagefooter();



?>