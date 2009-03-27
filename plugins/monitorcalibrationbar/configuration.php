<?php
require_once "./plugins/monitorcalibrationbar/init.inc.php";
$moncalb_init_array = monitor_calibration_bar_language();
$lang_plugin_moncalb = $moncalb_init_array['language']; 
$moncal_icon_array = $moncalb_init_array['icon'];

$name = $lang_plugin_moncalb['config_name'];
$description = $lang_plugin_moncalb['config_description'];

$author='<a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=2" rel="external" class="external">Joachim Müller</a>';
$version='1.2';

$extra_info = <<<EOT
    <a href="index.php?file=monitorcalibrationbar/index&amp;action=configure" class="admin_menu">{$moncal_icon_array['config']}{$lang_plugin_moncalb['config']}</a>&nbsp;
    <a href="http://forum.coppermine-gallery.net/index.php/topic,58638.0.html" title="&laquo;{$lang_plugin_moncalb['config_name']}&raquo; - {$lang_plugin_moncalb['announcement_thread']}" class="admin_menu">{$moncal_icon_array['announcement']}{$lang_plugin_moncalb['announcement_thread']}</a>&nbsp;
    <a href="index.php?file=monitorcalibrationbar/index&action=display" class="admin_menu" title="{$lang_plugin_moncalb['menu']}">{$moncal_icon_array['calibration']}{$lang_plugin_moncalb['picinfo_heading']}</a>
EOT;

$install_info=<<<EOT
    <a href="http://forum.coppermine-gallery.net/index.php/topic,58638.0.html" title="&laquo;{$lang_plugin_moncalb['config_name']}&raquo; - {$lang_plugin_moncalb['announcement_thread']}" class="admin_menu">{$moncal_icon_array['announcement']}{$lang_plugin_moncalb['announcement_thread']}</a>
EOT;
?>