<?php
function thumb_rotate_initialize() {
	global $CONFIG, $lang_plugin_thumb_rotate, $thumb_rotate_icon_array;
	$superCage = Inspekt::makeSuperCage();

	require "./plugins/thumb_rotate/lang/english.php";
	if ($CONFIG['lang'] != 'english' && file_exists("./plugins/thumb_rotate/lang/{$CONFIG['lang']}.php")) {
	    require "./plugins/thumb_rotate/lang/{$CONFIG['lang']}.php";
	}
	if ($CONFIG['enable_menu_icons'] == 2) {
		$thumb_rotate_icon_array['thumb_rotate'] = '<img src="./plugins/thumb_rotate/images/icons/thumb_rotate.png" width="16" height="16" border="0" alt="" class="icon" />';
		$thumb_rotate_icon_array['config'] = '<img src="./plugins/thumb_rotate/images/icons/config.png" width="16" height="16" border="0" alt="" class="icon" />';
		$thumb_rotate_icon_array['announcement'] = '<img src="./plugins/thumb_rotate/images/icons/announcement.png" width="16" height="16" border="0" alt="" class="icon" />'; 
	} else {
		$thumb_rotate_icon_array['thumb_rotate'] = '';
		$thumb_rotate_icon_array['config'] = '';
		$thumb_rotate_icon_array['announcement'] = '';
	}
	if ($CONFIG['enable_menu_icons'] >= 1) {
		$thumb_rotate_icon_array['config_menu'] = '<img src="./plugins/thumb_rotate/images/icons/thumb_rotate_config.png" width="16" height="16" border="0" alt="" class="icon" />';
	} else {
		$thumb_rotate_icon_array['config_menu'] = '';
	}
	$thumb_rotate_icon_array['plugin_manager'] = cpg_fetch_icon('plugin_mgr', 2);
	$thumb_rotate_icon_array['ok'] = cpg_fetch_icon('ok', 1);
	$return['language'] = $lang_plugin_thumb_rotate;
	$return['icon'] = $thumb_rotate_icon_array;
	return $return;
}
?>