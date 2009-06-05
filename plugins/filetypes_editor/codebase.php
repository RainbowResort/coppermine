<?php
/**************************
  Plugin "Filetypes Editor"
  *************************
  Copyright (c) Nibbler
  For Coppermine Photo Gallery cpg1.5.x

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

**********************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

require_once "./plugins/filetypes_editor/init.inc.php";

$thisplugin->add_action('page_start','fte_init');
$thisplugin->add_filter('admin_menu','fte_add_admin_button');

function fte_add_admin_button($admin_menu){
    global $lang_plugin_filetypes_editor, $filetypes_editor_icon_array;
    $new_button = '<div class="admin_menu admin_float"><a href="index.php?file=filetypes_editor/editor" title="' . $lang_plugin_filetypes_editor['config_title'] . '">'. $filetypes_editor_icon_array['filetype'] . $lang_plugin_filetypes_editor['config_name'] . '</a></div>';
    $look_for = '<!-- END documentation -->';
    $admin_menu = str_replace($look_for, $look_for . $new_button, $admin_menu);
    return $admin_menu;
}
?>
