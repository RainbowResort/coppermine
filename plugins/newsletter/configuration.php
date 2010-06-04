<?php
/**************************************************
  Coppermine 1.5.x Plugin - newsletter
  *************************************************
  Copyright (c) 2009-2010 Joachim Müller
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
  **************************************************/
  
require_once './plugins/newsletter/init.inc.php';
$newsletter_init_array = newsletter_initialize();
$lang_plugin_newsletter = $newsletter_init_array['language']; 
$newsletter_icon_array = $newsletter_init_array['icon'];

$name = $lang_plugin_newsletter['config_name'];
$description = $lang_plugin_newsletter['config_description'] . '<br />' . $lang_plugin_newsletter['config_details'];

$author = sprintf($lang_plugin_newsletter['author'],
    '<a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=2" rel="external" class="external">Joachim Müller</a>');

$version = '0.17';
$plugin_cpg_version = array('min' => '1.5');
$extra_info = <<<EOT
    <a href="index.php?file=newsletter/admin" class="admin_menu">{$newsletter_icon_array['config']}{$lang_plugin_newsletter['config']}</a>&nbsp;
    <a href="index.php?file=newsletter/catlist" class="admin_menu">{$newsletter_icon_array['catlist']}{$lang_plugin_newsletter['newsletter_categories']}</a>&nbsp;
    <a href="index.php?file=newsletter/subscribe" class="admin_menu">{$newsletter_icon_array['subscribe']}{$lang_plugin_newsletter['subscribe']}</a>&nbsp;
    <a href="index.php?file=newsletter/mailing" class="admin_menu">{$newsletter_icon_array['mailing']}{$lang_plugin_newsletter['create_mailing']}</a>&nbsp;
    <a href="index.php?file=newsletter/archive" class="admin_menu" title="{$lang_plugin_newsletter['browse_archived_mailings']}">{$newsletter_icon_array['archive']}{$lang_plugin_newsletter['archive']}</a>&nbsp;
    <a href="http://forum.coppermine-gallery.net/index.php/topic,60336.0.html" title="&laquo;{$lang_plugin_newsletter['config_name']}&raquo; - {$lang_plugin_newsletter['announcement_thread']}" class="admin_menu">{$newsletter_icon_array['announcement']}{$lang_plugin_newsletter['announcement_thread']}</a>&nbsp;
EOT;

$install_info = <<<EOT
    <a href="http://forum.coppermine-gallery.net/index.php/topic,60336.0.html" title="&laquo;{$lang_plugin_newsletter['config_name']}&raquo; - {$lang_plugin_newsletter['announcement_thread']}" class="admin_menu">{$newsletter_icon_array['announcement']}{$lang_plugin_newsletter['announcement_thread']}</a>
    As the plugin is still in a very early stage, please don't ask questions yet.
EOT;
?>