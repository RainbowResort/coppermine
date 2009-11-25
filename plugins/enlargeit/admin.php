<?php
/**************************************************
  Coppermine 1.5.x Plugin - EnlargeIt!
  *************************************************
  Copyright (c) 2009 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  **************************************************/

require('./plugins/enlargeit/configuration.php');
if (in_array('js/jquery.spinbutton.js', $JS['includes']) != TRUE) {
	$JS['includes'][] = 'js/jquery.spinbutton.js';
}
if (in_array('plugins/enlargeit/js/farbtastic.js', $JS['includes']) != TRUE) {
	$JS['includes'][] = 'plugins/enlargeit/js/farbtastic.js';
}
if (in_array('plugins/enlargeit/js/config.js', $JS['includes']) != TRUE) {
	$JS['includes'][] = 'plugins/enlargeit/js/admin.js';
}

// create Inspekt supercage
$superCage = Inspekt::makeSuperCage();

global $CONFIG,$lang_plugin_enlargeit,$lang_meta_album_names;
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
if ($superCage->post->keyExists('update')) {
  // Define the sanitization patterns
  $sanitization_array = array(
      'plugin_enlargeit_adminmode' => array('type' => 'checkbox', 'min' => '0', 'max' => '1'),
      'plugin_enlargeit_registeredmode' => array('type' => 'checkbox', 'min' => '0', 'max' => '1'),
      'plugin_enlargeit_guestmode' => array('type' => 'checkbox', 'min' => '0', 'max' => '1'),
      'plugin_enlargeit_pictype' => array('type' => 'int', 'min' => '0', 'max' => '2'),
      'plugin_enlargeit_ani' => array('type' => 'int', 'min' => '0', 'max' => '8'),
      'plugin_enlargeit_speed' => array('type' => 'int', 'min' => '10', 'max' => '32'),
      'plugin_enlargeit_maxstep' => array('type' => 'int', 'min' => '4', 'max' => '30'),
      'plugin_enlargeit_opaglide' => array('type' => 'checkbox', 'min' => '0', 'max' => '1'),
      'plugin_enlargeit_brdsize' => array('type' => 'int', 'min' => '0', 'max' => '40'),
      'plugin_enlargeit_brdcolor' => array('type' => 'raw', 'regex_ok' => '/^#(?:(?:[a-f\d]{3}){1,2})$/i'),
      'plugin_enlargeit_brdbck' => array('type' => 'raw', 'regex_ok' => '/^[a-z_]+$/'),
      'plugin_enlargeit_brdround' => array('type' => 'checkbox', 'min' => '0', 'max' => '1'),
      'plugin_enlargeit_shadowsize' => array('type' => 'int', 'min' => '0', 'max' => '9'),
      'plugin_enlargeit_shadowintens' => array('type' => 'int', 'min' => '1', 'max' => '30'),
      'plugin_enlargeit_titlebar' => array('type' => 'checkbox', 'min' => '0', 'max' => '1'),
      'plugin_enlargeit_titletxtcol' => array('type' => 'raw', 'regex_ok' => '/^#(?:(?:[a-f\d]{3}){1,2})$/i'),
      'plugin_enlargeit_ajaxcolor' => array('type' => 'raw', 'regex_ok' => '/^#(?:(?:[a-f\d]{3}){1,2})$/i'),
      'plugin_enlargeit_center' => array('type' => 'checkbox', 'min' => '0', 'max' => '1'),
      'plugin_enlargeit_dragdrop' => array('type' => 'checkbox', 'min' => '0', 'max' => '1'),
      'plugin_enlargeit_wheelnav' => array('type' => 'checkbox', 'min' => '0', 'max' => '1'),
      'plugin_enlargeit_dark' => array('type' => 'int', 'min' => '0', 'max' => '2'),
      'plugin_enlargeit_darkprct' => array('type' => 'int', 'min' => '0', 'max' => '100'),
      'plugin_enlargeit_darkensteps' => array('type' => 'int', 'min' => '1', 'max' => '20'),
      'plugin_enlargeit_buttonpic' => array('type' => 'checkbox', 'min' => '0', 'max' => '1'),
      'plugin_enlargeit_buttoninfo' => array('type' => 'int', 'min' => '0', 'max' => '2'),
      'plugin_enlargeit_buttonfav' => array('type' => 'checkbox', 'min' => '0', 'max' => '1'),
      'plugin_enlargeit_buttonvote' => array('type' => 'checkbox', 'min' => '0', 'max' => '1'),
      'plugin_enlargeit_buttoncomment' => array('type' => 'checkbox', 'min' => '0', 'max' => '1'),
      'plugin_enlargeit_buttondownload' => array('type' => 'int', 'min' => '0', 'max' => '2'),
      'plugin_enlargeit_buttonmax' => array('type' => 'int', 'min' => '0', 'max' => '2'),
      'plugin_enlargeit_buttonbbcode' => array('type' => 'checkbox', 'min' => '0', 'max' => '1'),
      'plugin_enlargeit_buttonhist' => array('type' => 'checkbox', 'min' => '0', 'max' => '1'),
      'plugin_enlargeit_buttonnav' => array('type' => 'checkbox', 'min' => '0', 'max' => '1'),
      'plugin_enlargeit_buttonclose' => array('type' => 'checkbox', 'min' => '0', 'max' => '1'),
      'plugin_enlargeit_flvplayer' => array('type' => 'int', 'min' => '0', 'max' => '2'),
      'plugin_enlargeit_adminmenu' => array('type' => 'checkbox', 'min' => '0', 'max' => '1'),
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
      } // only loop if config value is set --- end
  }
}


// display config page

// Set the option output stuff 
if ($CONFIG['plugin_enlargeit_adminmode'] == '1') {
	$option_output['plugin_enlargeit_adminmode'] = 'checked="checked"';
} else { 
	$option_output['plugin_enlargeit_adminmode'] = '';
}

if ($CONFIG['plugin_enlargeit_registeredmode'] == '1') {
	$option_output['plugin_enlargeit_registeredmode'] = 'checked="checked"';
} else { 
	$option_output['plugin_enlargeit_registeredmode'] = '';
}

if ($CONFIG['plugin_enlargeit_guestmode'] == '1') {
	$option_output['plugin_enlargeit_guestmode'] = 'checked="checked"';
} else { 
	$option_output['plugin_enlargeit_guestmode'] = '';
}

if ($CONFIG['plugin_enlargeit_pictype'] == '0') {
	$option_output['plugin_enlargeit_pictype_0'] = 'checked="checked"';
	$option_output['plugin_enlargeit_pictype_1'] = '';
	$option_output['plugin_enlargeit_pictype_2'] = '';
} elseif ($CONFIG['plugin_enlargeit_pictype'] == '1') { // 
	$option_output['plugin_enlargeit_pictype_0'] = '';
	$option_output['plugin_enlargeit_pictype_1'] = 'checked="checked"';
	$option_output['plugin_enlargeit_pictype_2'] = '';
} elseif ($CONFIG['plugin_enlargeit_pictype'] == '2') { // 
	$option_output['plugin_enlargeit_pictype_0'] = '';
	$option_output['plugin_enlargeit_pictype_1'] = '';
	$option_output['plugin_enlargeit_pictype_2'] = 'checked="checked"';
}

for ($i = 0; $i <= 10; $i++) {
	if ($CONFIG['plugin_enlargeit_ani'] == $i) {
		$option_output['plugin_enlargeit_ani'][$i] = 'selected="selected"';
	} else {
		$option_output['plugin_enlargeit_ani'][$i] = '';
	}
}

if ($CONFIG['plugin_enlargeit_opaglide'] == '1') {
	$option_output['plugin_enlargeit_opaglide'] = 'checked="checked"';
} else { 
	$option_output['plugin_enlargeit_opaglide'] = '';
}

$border_texture_options = '<option value="none">-</option>' . $LINEBREAK;
for ($i = 0; $i < count($border_texture_array); $i++) {
	if ($CONFIG['plugin_enlargeit_brdbck'] == $border_texture_array[$i]) {
		$option_output['plugin_enlargeit_brdbck'][$i] = 'selected="selected"';
	} else {
		$option_output['plugin_enlargeit_brdbck'][$i] = '';
	}
	$border_texture_options .= '<option value="'.$border_texture_array[$i].'" '.$option_output['plugin_enlargeit_brdbck'][$i].' >'.$lang_plugin_enlargeit[$border_texture_array[$i]].'</option>'.$LINEBREAK;
}

if ($CONFIG['plugin_enlargeit_brdround'] == '1') {
	$option_output['plugin_enlargeit_brdround'] = 'checked="checked"';
} else { 
	$option_output['plugin_enlargeit_brdround'] = '';
}

if ($CONFIG['plugin_enlargeit_titlebar'] == '1') {
	$option_output['plugin_enlargeit_titlebar'] = 'checked="checked"';
} else { 
	$option_output['plugin_enlargeit_titlebar'] = '';
}

if ($CONFIG['plugin_enlargeit_center'] == '1') {
	$option_output['plugin_enlargeit_center'] = 'checked="checked"';
} else { 
	$option_output['plugin_enlargeit_center'] = '';
}

if ($CONFIG['plugin_enlargeit_dragdrop'] == '1') {
	$option_output['plugin_enlargeit_dragdrop'] = 'checked="checked"';
} else { 
	$option_output['plugin_enlargeit_dragdrop'] = '';
}

if ($CONFIG['plugin_enlargeit_wheelnav'] == '1') {
	$option_output['plugin_enlargeit_wheelnav'] = 'checked="checked"';
} else { 
	$option_output['plugin_enlargeit_wheelnav'] = '';
}

if ($CONFIG['plugin_enlargeit_dark'] == '0') {
	$option_output['plugin_enlargeit_dark_0'] = 'checked="checked"';
	$option_output['plugin_enlargeit_dark_1'] = '';
	$option_output['plugin_enlargeit_dark_2'] = '';
} elseif ($CONFIG['plugin_enlargeit_dark'] == '1') { // 
	$option_output['plugin_enlargeit_dark_0'] = '';
	$option_output['plugin_enlargeit_dark_1'] = 'checked="checked"';
	$option_output['plugin_enlargeit_dark_2'] = '';
} elseif ($CONFIG['plugin_enlargeit_dark'] == '2') { // 
	$option_output['plugin_enlargeit_dark_0'] = '';
	$option_output['plugin_enlargeit_dark_1'] = '';
	$option_output['plugin_enlargeit_dark_2'] = 'checked="checked"';
}

if ($CONFIG['plugin_enlargeit_buttonpic'] == '1') {
	$option_output['plugin_enlargeit_buttonpic'] = 'checked="checked"';
} else { 
	$option_output['plugin_enlargeit_buttonpic'] = '';
}

if ($CONFIG['plugin_enlargeit_buttoninfo'] == '0') {
	$option_output['plugin_enlargeit_buttoninfo_0'] = 'checked="checked"';
	$option_output['plugin_enlargeit_buttoninfo_1'] = '';
	$option_output['plugin_enlargeit_buttoninfo_2'] = '';
} elseif ($CONFIG['plugin_enlargeit_buttoninfo'] == '1') { // 
	$option_output['plugin_enlargeit_buttoninfo_0'] = '';
	$option_output['plugin_enlargeit_buttoninfo_1'] = 'checked="checked"';
	$option_output['plugin_enlargeit_buttoninfo_2'] = '';
} elseif ($CONFIG['plugin_enlargeit_buttoninfo'] == '2') { // 
	$option_output['plugin_enlargeit_buttoninfo_0'] = '';
	$option_output['plugin_enlargeit_buttoninfo_1'] = '';
	$option_output['plugin_enlargeit_buttoninfo_2'] = 'checked="checked"';
}

if ($CONFIG['plugin_enlargeit_buttonfav'] == '1') {
	$option_output['plugin_enlargeit_buttonfav'] = 'checked="checked"';
} else { 
	$option_output['plugin_enlargeit_buttonfav'] = '';
}

if ($CONFIG['plugin_enlargeit_buttonvote'] == '1') {
	$option_output['plugin_enlargeit_buttonvote'] = 'checked="checked"';
} else { 
	$option_output['plugin_enlargeit_buttonvote'] = '';
}

if ($CONFIG['plugin_enlargeit_buttoncomment'] == '1') {
	$option_output['plugin_enlargeit_buttoncomment'] = 'checked="checked"';
} else { 
	$option_output['plugin_enlargeit_buttoncomment'] = '';
}

if ($CONFIG['plugin_enlargeit_buttondownload'] == '0') {
	$option_output['plugin_enlargeit_buttondownload_0'] = 'checked="checked"';
	$option_output['plugin_enlargeit_buttondownload_1'] = '';
	$option_output['plugin_enlargeit_buttondownload_2'] = '';
} elseif ($CONFIG['plugin_enlargeit_buttondownload'] == '1') { // 
	$option_output['plugin_enlargeit_buttondownload_0'] = '';
	$option_output['plugin_enlargeit_buttondownload_1'] = 'checked="checked"';
	$option_output['plugin_enlargeit_buttondownload_2'] = '';
} elseif ($CONFIG['plugin_enlargeit_buttondownload'] == '2') { // 
	$option_output['plugin_enlargeit_buttondownload_0'] = '';
	$option_output['plugin_enlargeit_buttondownload_1'] = '';
	$option_output['plugin_enlargeit_buttondownload_2'] = 'checked="checked"';
}

if ($CONFIG['plugin_enlargeit_buttonmax'] == '0') {
	$option_output['plugin_enlargeit_buttonmax_0'] = 'checked="checked"';
	$option_output['plugin_enlargeit_buttonmax_1'] = '';
	$option_output['plugin_enlargeit_buttonmax_2'] = '';
} elseif ($CONFIG['plugin_enlargeit_buttonmax'] == '1') { // 
	$option_output['plugin_enlargeit_buttonmax_0'] = '';
	$option_output['plugin_enlargeit_buttonmax_1'] = 'checked="checked"';
	$option_output['plugin_enlargeit_buttonmax_2'] = '';
} elseif ($CONFIG['plugin_enlargeit_buttonmax'] == '2') { // 
	$option_output['plugin_enlargeit_buttonmax_0'] = '';
	$option_output['plugin_enlargeit_buttonmax_1'] = '';
	$option_output['plugin_enlargeit_buttonmax_2'] = 'checked="checked"';
}

if ($CONFIG['plugin_enlargeit_buttonbbcode'] == '1') {
	$option_output['plugin_enlargeit_buttonbbcode'] = 'checked="checked"';
} else { 
	$option_output['plugin_enlargeit_buttonbbcode'] = '';
}

if ($CONFIG['plugin_enlargeit_buttonhist'] == '1') {
	$option_output['plugin_enlargeit_buttonhist'] = 'checked="checked"';
} else { 
	$option_output['plugin_enlargeit_buttonhist'] = '';
}

if ($CONFIG['thumb_method'] == 'gd2' || version_compare($enlargeit_gd_version, '2', '>=')) { // Only display histogram option if GD2 is available.
	$option_output['plugin_enlargeit_buttonhist'] .= '';
} else {
    $option_output['plugin_enlargeit_buttonhist'] .= ' disabled="disabled"';
}
if ($enlargeit_gd_version == '') {
    $enlargeit_gd_version = $lang_plugin_enlargeit['not_available'];
}
$gd_version_string = sprintf($lang_plugin_enlargeit['gd_version'], $enlargeit_gd_version);
$result = cpg_db_query("SELECT COUNT(*) FROM {$CONFIG['TABLE_PICTURES']} WHERE histogram='YES'");
list($cache_count) = mysql_fetch_row($result);
mysql_free_result($result);
$cached_files = sprintf($lang_plugin_enlargeit['cached_files_x'], cpg_float2decimal($cache_count));


if ($CONFIG['plugin_enlargeit_buttonnav'] == '1') {
	$option_output['plugin_enlargeit_buttonnav'] = 'checked="checked"';
} else { 
	$option_output['plugin_enlargeit_buttonnav'] = '';
}

if ($CONFIG['plugin_enlargeit_buttonclose'] == '1') {
	$option_output['plugin_enlargeit_buttonclose'] = 'checked="checked"';
} else { 
	$option_output['plugin_enlargeit_buttonclose'] = '';
}

if ($CONFIG['plugin_enlargeit_flvplayer'] == '0') {
	$option_output['plugin_enlargeit_flvplayer_0'] = 'checked="checked"';
	$option_output['plugin_enlargeit_flvplayer_1'] = '';
} elseif ($CONFIG['plugin_enlargeit_flvplayer'] == '1') { // 
	$option_output['plugin_enlargeit_flvplayer_0'] = '';
	$option_output['plugin_enlargeit_flvplayer_1'] = 'checked="checked"';
}

if ($CONFIG['plugin_enlargeit_adminmenu'] == '1') {
	$option_output['plugin_enlargeit_adminmenu'] = 'checked="checked"';
} else { 
	$option_output['plugin_enlargeit_adminmenu'] = '';
}

pageheader($lang_plugin_enlargeit['display_name']);
echo <<< EOT
<form action="index.php?file=enlargeit/admin" method="post" name="enlargeit_settings">
EOT;
starttable('100%', $enlargeit_icon_array['table'] . $lang_plugin_enlargeit['plugin_configuration'] . ': ' . $lang_plugin_enlargeit['main_title'] . ' v' . $version, 2, 'cpg_zebra');
echo <<< EOT
	<tr>
		<td class="tablef" colspan="2" >
EOT;
if ($superCage->post->keyExists('update')) {
    if ($config_changes_counter > 0) {
        msg_box('', $lang_plugin_enlargeit['update_success'], '', '', 'success');
    } else {
        msg_box('', $lang_plugin_enlargeit['no_changes'], '', '', 'validation');
    }
} else {
    echo '&copy; Timo Schewe (<a href="http://www.timos-welt.de/" rel="external" class="external">Timos-welt.de</a>)';
}
echo <<< EOT
		</td>
	</tr>
	<tr>
		<td class="tableh1" colspan="2">
			{$lang_plugin_enlargeit['enlargement_type']}
		</td>
	</tr>
	<tr>
		<td valign="top">
			{$lang_plugin_enlargeit['enable_for']}
		</td>
		<td>
			<input type="checkbox" name="plugin_enlargeit_adminmode" id="plugin_enlargeit_adminmode" class="checkbox" value="1" {$option_output['plugin_enlargeit_adminmode']} /><label for="plugin_enlargeit_adminmode" class="clickable_option">{$lang_plugin_enlargeit['administrators']}</label><br />
			<input type="checkbox" name="plugin_enlargeit_registeredmode" id="plugin_enlargeit_registeredmode" class="checkbox" value="1" {$option_output['plugin_enlargeit_registeredmode']} /><label for="plugin_enlargeit_registeredmode" class="clickable_option">{$lang_plugin_enlargeit['registered_users']}</label><br />
			<input type="checkbox" name="plugin_enlargeit_guestmode" id="plugin_enlargeit_guestmode" class="checkbox" value="1" {$option_output['plugin_enlargeit_guestmode']} /><label for="plugin_enlargeit_guestmode" class="clickable_option">{$lang_plugin_enlargeit['guests']}</label>
		</td>
	</tr>
	<tr>
		<td valign="top">
			{$lang_plugin_enlargeit['enlarge_to_pic_in']}
		</td>
		<td>
			<input type="radio" name="plugin_enlargeit_pictype" id="plugin_enlargeit_pictype_0" class="radio" value="0" {$option_output['plugin_enlargeit_pictype_0']} /><label for="plugin_enlargeit_pictype_0" class="clickable_option">{$lang_plugin_enlargeit['intermediate_size']}</label><br />
			<input type="radio" name="plugin_enlargeit_pictype" id="plugin_enlargeit_pictype_1" class="radio" value="1" {$option_output['plugin_enlargeit_pictype_1']} /><label for="plugin_enlargeit_pictype_1" class="clickable_option">{$lang_plugin_enlargeit['full_size']}</label><br />
			<input type="radio" name="plugin_enlargeit_pictype" id="plugin_enlargeit_pictype_2" class="radio" value="2" {$option_output['plugin_enlargeit_pictype_2']} /><label for="plugin_enlargeit_pictype_2" class="clickable_option">{$lang_plugin_enlargeit['force_intermediate_size']}</label>
		</td>
	</tr>
	<tr>
		<td class="tableh1" colspan="2">
			{$lang_plugin_enlargeit['animation']}
		</td>
	</tr>
	<tr>
		<td valign="top">
			{$lang_plugin_enlargeit['animation_type']}
		</td>
		<td>
			<select name="plugin_enlargeit_ani" id="plugin_enlargeit_ani" class="listbox">
				<option value="0" {$option_output['plugin_enlargeit_ani'][0]} >{$lang_plugin_enlargeit['none']}</option>
				<option value="1" {$option_output['plugin_enlargeit_ani'][1]} >{$lang_plugin_enlargeit['fade']}</option>
				<option value="2" {$option_output['plugin_enlargeit_ani'][2]} >{$lang_plugin_enlargeit['glide']}</option>
				<option value="3" {$option_output['plugin_enlargeit_ani'][3]} >{$lang_plugin_enlargeit['bumpglide']}</option>
				<option value="4" {$option_output['plugin_enlargeit_ani'][4]} >{$lang_plugin_enlargeit['smoothglide']}</option>
				<option value="5" {$option_output['plugin_enlargeit_ani'][5]} >{$lang_plugin_enlargeit['expglide']}</option>
				<option value="6" {$option_output['plugin_enlargeit_ani'][6]} >{$lang_plugin_enlargeit['topglide']}</option>
				<option value="7" {$option_output['plugin_enlargeit_ani'][7]} >{$lang_plugin_enlargeit['leftglide']}</option>
				<option value="8" {$option_output['plugin_enlargeit_ani'][8]} >{$lang_plugin_enlargeit['topleftglide']}</option>
			</select>
		</td>
	</tr>
	<tr>
		<td valign="top">
			{$lang_plugin_enlargeit['time_between_animation_steps']}
		</td>
		<td>
			<input type="text" name="plugin_enlargeit_speed" id="plugin_enlargeit_speed" class="textinput spin-button" size="2" maxlength="2" value="{$CONFIG['plugin_enlargeit_speed']}" /> {$lang_plugin_enlargeit['milliseconds']}
		</td>
	</tr>
	<tr>
		<td valign="top">
			{$lang_plugin_enlargeit['animation_steps']}
		</td>
		<td>
			<input type="text" name="plugin_enlargeit_maxstep" id="plugin_enlargeit_maxstep" class="textinput spin-button" size="2" maxlength="2" value="{$CONFIG['plugin_enlargeit_maxstep']}" />
		</td>
	</tr>
	<tr>
		<td valign="top">
			<label for="plugin_enlargeit_opaglide" class="clickable_option">{$lang_plugin_enlargeit['transparency_for_glide']}</label>
		</td>
		<td>
			<input type="checkbox" name="plugin_enlargeit_opaglide" id="plugin_enlargeit_opaglide" class="checkbox" value="1" {$option_output['plugin_enlargeit_opaglide']} />
		</td>
	</tr>
	<tr>
		<td class="tableh1" colspan="2">
			{$lang_plugin_enlargeit['border']}
		</td>
	</tr>
	<tr>
		<td valign="top">
			{$lang_plugin_enlargeit['border_width']}
		</td>
		<td>
			<input type="text" name="plugin_enlargeit_brdsize" id="plugin_enlargeit_brdsize" class="textinput spin-button" size="2" maxlength="2" value="{$CONFIG['plugin_enlargeit_brdsize']}" /> ({$lang_plugin_enlargeit['zero_to_disable']})
		</td>
	</tr>
	<tr>
		<td valign="top">
			{$lang_plugin_enlargeit['border_color']}
		</td>
		<td>
			<input type="text" name="plugin_enlargeit_brdcolor" id="plugin_enlargeit_brdcolor" class="textinput" size="8" maxlength="7" value="{$CONFIG['plugin_enlargeit_brdcolor']}" style="text-transform:uppercase;" />
			<span class="detail_head_collapsed">{$lang_plugin_enlargeit['toggle_color_picker']}</span>
			<div id="colorpicker_bordercolor" class="detail_body">foo</div>
		</td>
	</tr>
	<tr>
		<td valign="top">
			{$lang_plugin_enlargeit['border_texture']}
		</td>
		<td>
			<select name="plugin_enlargeit_brdbck" id="plugin_enlargeit_brdbck" class="listbox">
				{$border_texture_options}
			</select>
		</td>
	</tr>
	<tr>
		<td valign="top">
			<label for="plugin_enlargeit_brdround" class="clickable_option">{$lang_plugin_enlargeit['round_border']}</label>
		</td>
		<td>
			<input type="checkbox" name="plugin_enlargeit_brdround" id="plugin_enlargeit_brdround" class="checkbox" value="1" {$option_output['plugin_enlargeit_brdround']} /> ({$lang_plugin_enlargeit['mozilla_only']})
		</td>
	</tr>
	<tr>
		<td class="tableh1" colspan="2">
			{$lang_plugin_enlargeit['shadow']}
		</td>
	</tr>
	<tr>
		<td valign="top">
			{$lang_plugin_enlargeit['shadow_size']}
		</td>
		<td>
			<input type="text" name="plugin_enlargeit_shadowsize" id="plugin_enlargeit_shadowsize" class="textinput spin-button" size="1" maxlength="1" value="{$CONFIG['plugin_enlargeit_shadowsize']}" /> {$lang_plugin_enlargeit['right_bottom']} ({$lang_plugin_enlargeit['zero_to_disable']})
		</td>
	</tr>
	<tr>
		<td valign="top">
			{$lang_plugin_enlargeit['shadow_opacity']}
		</td>
		<td>
			<input type="text" name="plugin_enlargeit_shadowintens" id="plugin_enlargeit_shadowintens" class="textinput spin-button" size="2" maxlength="2" value="{$CONFIG['plugin_enlargeit_shadowintens']}" />
		</td>
	</tr>
	<tr>
		<td class="tableh1" colspan="2">
			{$lang_plugin_enlargeit['title_bar']}
		</td>
	</tr>
	<tr>
		<td valign="top">
			<label for="plugin_enlargeit_titlebar" class="clickable_option">{$lang_plugin_enlargeit['show_titlebar']}</label>
		</td>
		<td>
			<input type="checkbox" name="plugin_enlargeit_titlebar" id="plugin_enlargeit_titlebar" class="checkbox" value="1" {$option_output['plugin_enlargeit_titlebar']} /> <label for="plugin_enlargeit_titlebar" class="clickable_option">({$lang_plugin_enlargeit['recommended']})</label>
		</td>
	</tr>
	<tr>
		<td valign="top">
			{$lang_plugin_enlargeit['title_bar_text_color']}
		</td>
		<td>
			<input type="text" name="plugin_enlargeit_titletxtcol" id="plugin_enlargeit_titletxtcol" class="textinput" size="8" maxlength="7" value="{$CONFIG['plugin_enlargeit_titletxtcol']}" style="text-transform:uppercase;" />
			<span class="detail_head_collapsed">{$lang_plugin_enlargeit['toggle_color_picker']}</span>
			<div id="colorpicker_titletext" class="detail_body"></div>
		</td>
	</tr>
	<tr>
		<td valign="top">
			{$lang_plugin_enlargeit['background_color_ajax_area']}
		</td>
		<td>
			<input type="text" name="plugin_enlargeit_ajaxcolor" id="plugin_enlargeit_ajaxcolor" class="textinput" size="8" maxlength="7" value="{$CONFIG['plugin_enlargeit_ajaxcolor']}" style="text-transform:uppercase;" />
			<span class="detail_head_collapsed">{$lang_plugin_enlargeit['toggle_color_picker']}</span>
			<div id="colorpicker_backgroundcontent" class="detail_body"></div>
		</td>
	</tr>
	<tr>
		<td class="tableh1" colspan="2">
			{$lang_plugin_enlargeit['action']}
		</td>
	</tr>
	<tr>
		<td valign="top">
			<label for="plugin_enlargeit_center" class="clickable_option">{$lang_plugin_enlargeit['center_enlarge_images']}</label>
		</td>
		<td>
			<input type="checkbox" name="plugin_enlargeit_center" id="plugin_enlargeit_center" class="checkbox" value="1" {$option_output['plugin_enlargeit_center']} /> <label for="plugin_enlargeit_center" class="clickable_option">({$lang_plugin_enlargeit['recommended']})</label>
		</td>
	</tr>
	<tr>
		<td valign="top">
			<label for="plugin_enlargeit_dragdrop" class="clickable_option">{$lang_plugin_enlargeit['enable_drag_drop']}</label>
		</td>
		<td>
			<input type="checkbox" name="plugin_enlargeit_dragdrop" id="plugin_enlargeit_dragdrop" class="checkbox" value="1" {$option_output['plugin_enlargeit_dragdrop']} /> <label for="plugin_enlargeit_dragdrop" class="clickable_option">({$lang_plugin_enlargeit['recommended']})</label>
		</td>
	</tr>
	<tr>
		<td valign="top">
			<label for="plugin_enlargeit_wheelnav" class="clickable_option">{$lang_plugin_enlargeit['mouse_wheel_navigation']}</label>
		</td>
		<td>
			<input type="checkbox" name="plugin_enlargeit_wheelnav" id="plugin_enlargeit_wheelnav" class="checkbox" value="1" {$option_output['plugin_enlargeit_wheelnav']} /> <label for="plugin_enlargeit_wheelnav" class="clickable_option">({$lang_plugin_enlargeit['recommended']})</label>
		</td>
	</tr>
	<tr>
		<td valign="top" valign="top">
			{$lang_plugin_enlargeit['darken_screen']}
		</td>
		<td>
			<input type="radio" name="plugin_enlargeit_dark" id="plugin_enlargeit_dark_0" class="radio" value="0" {$option_output['plugin_enlargeit_dark_0']} /><label for="plugin_enlargeit_dark_0" class="clickable_option">{$lang_common['no']}</label><br />
			<input type="radio" name="plugin_enlargeit_dark" id="plugin_enlargeit_dark_1" class="radio" value="1" {$option_output['plugin_enlargeit_dark_1']} /><label for="plugin_enlargeit_dark_1" class="clickable_option">{$lang_common['yes']}: {$lang_plugin_enlargeit['only_darken_when_image_shows']}</label><br />
			<input type="radio" name="plugin_enlargeit_dark" id="plugin_enlargeit_dark_2" class="radio" value="2" {$option_output['plugin_enlargeit_dark_2']} /><label for="plugin_enlargeit_dark_2" class="clickable_option">{$lang_common['yes']}: {$lang_plugin_enlargeit['remain_dark_when_using_navigation']}</label>
		</td>
	</tr>
	<tr>
		<td valign="top">
			{$lang_plugin_enlargeit['darken_strength']}
		</td>
		<td>
			<input type="text" name="plugin_enlargeit_darkprct" id="plugin_enlargeit_darkprct" class="textinput spin-button" size="2" maxlength="2" value="{$CONFIG['plugin_enlargeit_darkprct']}" /> %
		</td>
	</tr>
	<tr>
		<td valign="top">
			{$lang_plugin_enlargeit['darkening_speed']}
		</td>
		<td>
			<input type="text" name="plugin_enlargeit_darkensteps" id="plugin_enlargeit_darkensteps" class="textinput spin-button" size="2" maxlength="2" value="{$CONFIG['plugin_enlargeit_darkensteps']}" /> ({$lang_plugin_enlargeit['darkening_speed_explain']})
		</td>
	</tr>
	<tr>
		<td class="tableh1" colspan="2">
			{$lang_plugin_enlargeit['buttons']}
		</td>
	</tr>
	<tr>
		<td valign="top">
			<label for="plugin_enlargeit_buttonpic" class="clickable_option">{$enlargeit_icon_array['show']} {$lang_plugin_enlargeit['button_picture']}</label>
		</td>
		<td>
			<input type="checkbox" name="plugin_enlargeit_buttonpic" id="plugin_enlargeit_buttonpic" class="checkbox" value="1" {$option_output['plugin_enlargeit_buttonpic']} />
		</td>
	</tr>
	<tr>
		<td valign="top">
			{$enlargeit_icon_array['info']} {$lang_plugin_enlargeit['button_info']}
		</td>
		<td>
			<input type="radio" name="plugin_enlargeit_buttoninfo" id="plugin_enlargeit_buttoninfo_0" class="radio" value="0" {$option_output['plugin_enlargeit_buttoninfo_0']} /><label for="plugin_enlargeit_buttoninfo_0" class="clickable_option">{$lang_common['no']}</label><br />
			<input type="radio" name="plugin_enlargeit_buttoninfo" id="plugin_enlargeit_buttoninfo_1" class="radio" value="1" {$option_output['plugin_enlargeit_buttoninfo_1']} /><label for="plugin_enlargeit_buttoninfo_1" class="clickable_option">{$lang_common['yes']}: {$lang_plugin_enlargeit['open_as_ajax']}</label><br />
			<input type="radio" name="plugin_enlargeit_buttoninfo" id="plugin_enlargeit_buttoninfo_2" class="radio" value="2" {$option_output['plugin_enlargeit_buttoninfo_2']} /><label for="plugin_enlargeit_buttoninfo_2" class="clickable_option">{$lang_common['yes']}: {$lang_plugin_enlargeit['open_intermediate_page']}</label>
		</td>
	</tr>
	<tr>
		<td valign="top">
			<label for="plugin_enlargeit_buttonfav" class="clickable_option">{$enlargeit_icon_array['favorites']} {$lang_plugin_enlargeit['button_favorites']}</label>
		</td>
		<td>
			<input type="checkbox" name="plugin_enlargeit_buttonfav" id="plugin_enlargeit_buttonfav" class="checkbox" value="1" {$option_output['plugin_enlargeit_buttonfav']} />
		</td>
	</tr>
	<tr>
		<td valign="top">
			<label for="plugin_enlargeit_buttonvote" class="clickable_option">{$enlargeit_icon_array['vote']} {$lang_plugin_enlargeit['button_vote']}</label>
		</td>
		<td>
			<input type="checkbox" name="plugin_enlargeit_buttonvote" id="plugin_enlargeit_buttonvote" class="checkbox" value="1" {$option_output['plugin_enlargeit_buttonvote']}  disabled="disabled" /> (<em>{$lang_plugin_enlargeit['not_implemented_yet']}</em>)
		</td>
	</tr>
	<tr>
		<td valign="top">
			<label for="plugin_enlargeit_buttoncomment" class="clickable_option">{$enlargeit_icon_array['comment']} {$lang_plugin_enlargeit['button_comments']}</label>
		</td>
		<td>
			<input type="checkbox" name="plugin_enlargeit_buttoncomment" id="plugin_enlargeit_buttoncomment" class="checkbox" value="1" {$option_output['plugin_enlargeit_buttoncomment']}  disabled="disabled" /> (<em>{$lang_plugin_enlargeit['not_implemented_yet']}</em>)
		</td>
	</tr>
	<tr>
		<td valign="top">
			{$enlargeit_icon_array['download']} {$lang_plugin_enlargeit['button_download']}
		</td>
		<td>
			<input type="radio" name="plugin_enlargeit_buttondownload" id="plugin_enlargeit_buttondownload_0" class="radio" value="0" {$option_output['plugin_enlargeit_buttondownload_0']} /><label for="plugin_enlargeit_buttondownload_0" class="clickable_option">{$lang_common['no']}</label><br />
			<input type="radio" name="plugin_enlargeit_buttondownload" id="plugin_enlargeit_buttondownload_1" class="radio" value="1" {$option_output['plugin_enlargeit_buttondownload_1']} /><label for="plugin_enlargeit_buttondownload_1" class="clickable_option">{$lang_common['yes']}: {$lang_plugin_enlargeit['for_all']}</label><br />
			<input type="radio" name="plugin_enlargeit_buttondownload" id="plugin_enlargeit_buttondownload_2" class="radio" value="2" {$option_output['plugin_enlargeit_buttondownload_2']} /><label for="plugin_enlargeit_buttondownload_2" class="clickable_option">{$lang_common['yes']}: {$lang_plugin_enlargeit['for_registered_users']}</label>
		</td>
	</tr>
	<tr>
		<td valign="top">
			{$enlargeit_icon_array['fullsize']} {$lang_plugin_enlargeit['button_maximize']}<br />Needs manual editing later, as the orginal options are silly!
		</td>
		<td>
			<input type="radio" name="plugin_enlargeit_buttonmax" id="plugin_enlargeit_buttonmax_0" class="radio" value="0" {$option_output['plugin_enlargeit_buttonmax_0']} /><label for="plugin_enlargeit_buttonmax_0" class="clickable_option">{$lang_common['no']}</label><br />
			<input type="radio" name="plugin_enlargeit_buttonmax" id="plugin_enlargeit_buttonmax_1" class="radio" value="1" {$option_output['plugin_enlargeit_buttonmax_1']} /><label for="plugin_enlargeit_buttonmax_1" class="clickable_option">{$lang_common['yes']}: {$lang_plugin_enlargeit['as_popup_window']}</label><br />
			<input type="radio" name="plugin_enlargeit_buttonmax" id="plugin_enlargeit_buttonmax_2" class="radio" value="2" {$option_output['plugin_enlargeit_buttonmax_2']} /><label for="plugin_enlargeit_buttonmax_2" class="clickable_option">{$lang_common['yes']}: {$lang_plugin_enlargeit['open_as_ajax']}</label>
		</td>
	</tr>
	<tr>
		<td valign="top">
			<label for="plugin_enlargeit_buttonbbcode" class="clickable_option">{$enlargeit_icon_array['bbcode']} {$lang_plugin_enlargeit['button_bbcode']}</label>
		</td>
		<td>
			<input type="checkbox" name="plugin_enlargeit_buttonbbcode" id="plugin_enlargeit_buttonbbcode" class="checkbox" value="1" {$option_output['plugin_enlargeit_buttonbbcode']} />
		</td>
	</tr>
	<tr>
		<td valign="top">
			<label for="plugin_enlargeit_buttonhist" class="clickable_option">{$enlargeit_icon_array['histogram']} {$lang_plugin_enlargeit['button_histogram']} ({$cached_files})</label>
		</td>
		<td>
			<input type="checkbox" name="plugin_enlargeit_buttonhist" id="plugin_enlargeit_buttonhist" class="checkbox" value="1" {$option_output['plugin_enlargeit_buttonhist']} /> <label for="plugin_enlargeit_buttonhist" class="clickable_option">({$gd_version_string})</label>
		</td>
	</tr>
	<tr>
		<td valign="top">
			<label for="plugin_enlargeit_buttonnav" class="clickable_option">{$enlargeit_icon_array['next']} {$lang_plugin_enlargeit['button_navigation']}</label>
		</td>
		<td>
			<input type="checkbox" name="plugin_enlargeit_buttonnav" id="plugin_enlargeit_buttonnav" class="checkbox" value="1" {$option_output['plugin_enlargeit_buttonnav']} /> <label for="plugin_enlargeit_buttonnav" class="clickable_option">({$lang_plugin_enlargeit['recommended']})</label>
		</td>
	</tr>
	<tr>
		<td valign="top">
			<label for="plugin_enlargeit_buttonclose" class="clickable_option">{$enlargeit_icon_array['close']} {$lang_plugin_enlargeit['button_close']}</label>
		</td>
		<td>
			<input type="checkbox" name="plugin_enlargeit_buttonclose" id="plugin_enlargeit_buttonclose" class="checkbox" value="1" {$option_output['plugin_enlargeit_buttonclose']} /> <label for="plugin_enlargeit_buttonclose" class="clickable_option">({$lang_plugin_enlargeit['recommended']})</label>
		</td>
	</tr>
	<tr>
		<td class="tableh1" colspan="2">
			{$lang_plugin_enlargeit['multimedia']}
		</td>
	</tr>
	<tr>
		<td valign="top">
			{$lang_plugin_enlargeit['flash_player']}
		</td>
		<td>
			<input type="radio" name="plugin_enlargeit_flvplayer" id="plugin_enlargeit_flvplayer_0" class="radio" value="0" {$option_output['plugin_enlargeit_flvplayer_0']} /><label for="plugin_enlargeit_flvplayer_0" class="clickable_option">{$lang_plugin_enlargeit['rphmedia']}</label><br />
			<input type="radio" name="plugin_enlargeit_flvplayer" id="plugin_enlargeit_flvplayer_1" class="radio" value="1" {$option_output['plugin_enlargeit_flvplayer_1']} /><label for="plugin_enlargeit_flvplayer_1" class="clickable_option">{$lang_plugin_enlargeit['os_flv']}</label>
		</td>
	</tr>
	<tr>
		<td class="tableh1" colspan="2">
			{$lang_plugin_enlargeit['plugin_setup']}
		</td>
	</tr>
	<tr>
		<td valign="top">
			<label for="plugin_enlargeit_adminmenu" class="clickable_option">{$lang_plugin_enlargeit['display_plugin_config_in_admin_menu']}</label>
		</td>
		<td>
			<input type="checkbox" name="plugin_enlargeit_adminmenu" id="plugin_enlargeit_adminmenu" class="checkbox" value="1" {$option_output['plugin_enlargeit_adminmenu']} />
		</td>
	</tr>
	<tr>
		<td class="tablef" colspan="2">
			<input name="update" type="hidden" id="update" value="1" />
			<button type="submit" class="button" name="submit" value="{$lang_plugin_enlargeit['submit']}">{$enlargeit_icon_array['ok']}{$lang_plugin_enlargeit['submit']}</button>
		</td>
	</tr>
EOT;

endtable();
echo <<< EOT
</form>
EOT;
pagefooter();
ob_end_flush();


?>