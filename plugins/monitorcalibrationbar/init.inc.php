<?php
function monitor_calibration_bar_language() {
	global $CONFIG, $lang_plugin_moncalb, $moncal_icon_array;
	require "./plugins/monitorcalibrationbar/lang/english.php";
	if ($CONFIG['lang'] != 'english' && file_exists("./plugins/monitorcalibrationbar/lang/{$CONFIG['lang']}.php")) {
	    require "./plugins/monitorcalibrationbar/lang/{$CONFIG['lang']}.php";
	}
	if ($CONFIG['enable_menu_icons'] == 2) {
		$moncal_icon_array['calibration'] = '<img src="./plugins/monitorcalibrationbar/images/icons/calibration.png" width="16" height="16" border="0" alt="" class="icon" />';
		$moncal_icon_array['config'] = '<img src="./plugins/monitorcalibrationbar/images/icons/calibration_config.png" width="16" height="16" border="0" alt="" class="icon" />';
		$moncal_icon_array['announcement'] = '<img src="./plugins/monitorcalibrationbar/images/icons/announcement.png" width="16" height="16" border="0" alt="" class="icon" />'; 
	} else {
		$moncal_icon_array['calibration'] = '';
		$moncal_icon_array['config'] = '';
		$moncal_icon_array['announcement'] = '';
	}
	if ($CONFIG['enable_menu_icons'] >= 1) {
		$moncal_icon_array['config_menu'] = '<img src="./plugins/monitorcalibrationbar/images/icons/calibration_config.png" width="16" height="16" border="0" alt="" class="icon" />';
	} else {
		$moncal_icon_array['config_menu'] = '';
	}
	$moncal_icon_array['plugin_manager'] = cpg_fetch_icon('plugin_mgr', 2);
	$moncal_icon_array['ok'] = cpg_fetch_icon('ok', 1);
	$return['language'] = $lang_plugin_moncalb;
	$return['icon'] = $moncal_icon_array;
	return $return;
}
?>