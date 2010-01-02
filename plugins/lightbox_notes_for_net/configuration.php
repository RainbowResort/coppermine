<?php
/**************************************************
  Coppermine 1.5.x Plugin - LightBox (NotesFor.net)
  *************************************************
  Copyright (c) 2009 Joe Carver and Helori Lamberty
  *************************************************
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
  **************************************************/

require_once('./plugins/lightbox_notes_for_net/init.inc.php');
$name = $lang_plugin_lightbox_notes_for_net['display_name'];
$configuration_link = '<a href="index.php?file=lightbox_notes_for_net/admin" class="admin_menu">' . sprintf($lang_plugin_lightbox_notes_for_net['configure_plugin_x'], $lang_plugin_lightbox_notes_for_net['display_name']) . '</a> ';
$documentation_link = '<a href="plugins/lightbox_notes_for_net/docs/{$documentation_file}.htm" class="admin_menu greybox">' . $lang_plugin_lightbox_notes_for_net['plugin_documentation'] . '</a> ';
$announcement_thread = '<a href="http://forum.coppermine-gallery.net/index.php/topic,62905.0.html" class="admin_menu">' . $lang_plugin_lightbox_notes_for_net['announcement_thread'] . '</a>';
$extra_info = $configuration_link . $documentation_link . $announcement_thread;
$install_info = $documentation_link . $announcement_thread;
$author='Joe Carver ' . $lang_plugin_lightbox_notes_for_net['aka'] . ' i-imagine';

$version='2.1';

$description = $lang_plugin_lightbox_notes_for_net['description'];

?>