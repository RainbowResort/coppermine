<?php
if (file_exists("./plugins/monitorcalibrationbar/lang/{$CONFIG['lang']}.php")) {
    require "./plugins/monitorcalibrationbar/lang/{$CONFIG['lang']}.php";
} else {
    require "./plugins/monitorcalibrationbar/lang/english.php";
}
$name = $lang_plugin_moncalb['config_name'];
$description = $lang_plugin_moncalb['config_description'];

$author='Joachim Müller';
$version='1.0';

$extra_info = <<<EOT
    <a href="index.php?file=monitorcalibrationbar/index&amp;action=configure" class="admin_menu">{$lang_plugin_moncalb['config']}</a>&nbsp;
    <a href="http://forum.coppermine-gallery.net/index.php/topic,58638.0.html" title="&laquo;{$lang_plugin_moncalb['config_name']}&raquo; - {$lang_plugin_moncalb['announcement_thread']}" class="admin_menu">{$lang_plugin_moncalb['announcement_thread']}</a>&nbsp;
    <a href="index.php?file=monitorcalibrationbar/index&action=display" class="admin_menu" title="{$lang_plugin_moncalb['menu']}">{$lang_plugin_moncalb['picinfo_heading']}</a>
EOT;

$install_info=<<<EOT
    <a href="http://forum.coppermine-gallery.net/index.php/topic,58638.0.html" title="&laquo;{$lang_plugin_moncalb['config_name']}&raquo; - {$lang_plugin_moncalb['announcement_thread']}" class="admin_menu">{$lang_plugin_moncalb['announcement_thread']}</a>
EOT;
?>