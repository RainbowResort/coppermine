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

require_once "./plugins/filetypes_editor/init.inc.php";
$filetypes_editor_init_array = fte_init();
$lang_plugin_filetypes_editor = $filetypes_editor_init_array['language']; 
$filetypes_editor_icon_array = $filetypes_editor_init_array['icon'];
$name = $lang_plugin_filetypes_editor['plugin_name'];
$description = $lang_plugin_filetypes_editor['plugin_description'];
$author = sprintf($lang_plugin_filetypes_editor['author'], 
                  '<a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=941" rel="external" class="external">Nibbler</a>',
                  '<a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=2" rel="external" class="external">Joachim Müller</a>');
$version = '2.0';
$extra_info = <<<EOT
    {$lang_plugin_filetypes_editor['plugin_extra']}
    <a href="index.php?file=filetypes_editor/editor" class="admin_menu">{$filetypes_editor_icon_array['filetype']}{$lang_plugin_filetypes_editor['config_name']}</a><br />
    <a href="http://forum.coppermine-gallery.net/index.php/topic,59917.0.html" title="&laquo;{$lang_plugin_filetypes_editor['plugin_name']}&raquo; - {$lang_plugin_filetypes_editor['announcement_thread']}" class="admin_menu external">{$filetypes_editor_icon_array['announcement']}{$lang_plugin_filetypes_editor['announcement_thread']}</a>
EOT;

$install_info=<<<EOT
    {$lang_plugin_filetypes_editor['plugin_description_detail']}<br />&nbsp;<br />
    <a href="http://forum.coppermine-gallery.net/index.php/topic,59917.0.html" title="&laquo;{$lang_plugin_filetypes_editor['plugin_name']}&raquo; - {$lang_plugin_filetypes_editor['announcement_thread']}" class="admin_menu external">{$filetypes_editor_icon_array['announcement']}{$lang_plugin_filetypes_editor['announcement_thread']}</a>
EOT;
?>
