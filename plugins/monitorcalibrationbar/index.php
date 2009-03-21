<?php
$action = 'display';

if ($superCage->get->keyExists('action') == TRUE) {
    if ($superCage->get->getAlpha('action') == 'configure' && GALLERY_ADMIN_MODE) {
        $action = 'configure';
    }
}

if ($action == 'configure') {
    // Configuration
    pageheader($lang_plugin_moncalb['config']);
    monitor_calibration_bar_configure();
} else {
    pageheader($lang_plugin_moncalb['picinfo_heading']);
    echo '<h1>'.$lang_plugin_moncalb['config_name'].'</h1>';
    echo monitor_calibration_bar_display_bar('100%','no');
    echo '<p>'.$lang_plugin_moncalb['explain'].'</p>';
}

pagefooter();
?>