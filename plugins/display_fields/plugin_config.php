<?php
/**************************************************
  Coppermine Plugin - Display Fields
  *************************************************
  Copyright (c) 2006 Paul Van Rompay
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  *************************************************/

global $CONFIG, $lang_yes, $lang_no;
global $lang_plugin_displayfields, $lang_plugin_displayfields_config;
require('include/init.inc.php');

if (!GALLERY_ADMIN_MODE) cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);

require('plugins/display_fields/include/init.inc.php');

if (count($_POST) > 0) {
	if (isset($_POST['update_config'])) {

		$field_list = isset($_POST['field_list']) ? $_POST['field_list'] : '';
		foreach(array_keys($plugin_displayfields_params) as $name) {
			$name = str_replace('plugin_displayfields_','',$name);
			$name = str_replace('_',' ',$name);
			$value = in_array($name,$field_list) ? '1' : '0';
			$name = str_replace(' ','_',$name);
			$sql = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$value' WHERE name = 'plugin_displayfields_$name'";
			cpg_db_query($sql);
			if ($CONFIG['log_mode'] == CPG_LOG_ALL) {
				log_write('CONFIG UPDATE SQL: '.$sql.";\n".
					'TIME: '.date("F j, Y, g:i a")."\n".
					'USER: '.$USER_DATA['user_name'],
					CPG_DATABASE_LOG
					);
			}
		}
		$sql = "UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '{$_POST['admin_showall']}' WHERE name = 'plugin_displayfields_adminshowall'";
		cpg_db_query($sql);
		if ($CONFIG['log_mode'] == CPG_LOG_ALL) {
			log_write('CONFIG UPDATE SQL: '.$sql.";\n".
				'TIME: '.date("F j, Y, g:i a")."\n".
				'USER: '.$USER_DATA['user_name'],
				CPG_DATABASE_LOG
				);
		}
	}
        pageheader($lang_plugin_displayfields['display_name']);
        msg_box($lang_plugin_displayfields['display_name'], $lang_plugin_displayfields['page_success'], $lang_continue, 'index.php');
	pagefooter();
        exit;
}

pageheader($lang_plugin_displayfields['display_name']);
starttable('100%', $lang_plugin_displayfields['display_name'].' - <a href="pluginmgr.php" class="admin_menu">Plugin Manager</a>', 3);
echo '<tr><td>'."\n";

echo <<< EOT
	<br />
	<h3>{$lang_plugin_displayfields_config['select_fields']}:</h3>
	<form action="{$_SERVER['REQUEST_URI']}" method="post">
EOT;
$field_cb = '';

$keys = array_keys($plugin_displayfields_params);
sort($keys);
for($i=0;$i<count($keys);$i++) {
	$name = $keys[$i];
	$value = $plugin_displayfields_params[$name];
	if ($name != 'plugin_displayfields_adminshowall') {
		$checked = ($value=='1') ? 'checked' : '';
		$field_name = str_replace('plugin_displayfields_','',$name);
		$field_name = str_replace('_',' ',$field_name);
		$field_cb .= '<input name="field_list[]" type="checkbox" value="' . $field_name . '" ' . $checked . ' />' . $field_name . "<br />\n";
	}
}

$adminshow_yes_selected = '';
$adminshow_no_selected = '';
if ($plugin_displayfields_params['plugin_displayfields_adminshowall'] == '1') { 
	$adminshow_yes_selected = "selected"; 
} else { 
	$adminshow_no_selected = "selected"; 
}

echo <<< EOT
	$field_cb<br />
	{$lang_plugin_displayfields_config['admin_showall']} -->
	<select name="admin_showall"><option value="1" $adminshow_yes_selected>{$lang_yes}</option>
		<option value="0" $adminshow_no_selected>{$lang_no}</option></select><br />
	<br />
	<input type="submit" value="{$lang_plugin_displayfields_config['button_done']}" name="update_config"/>
	</form>
EOT;

echo '</td></tr>'."\n";
endtable();
pagefooter();
ob_end_flush();
?>
