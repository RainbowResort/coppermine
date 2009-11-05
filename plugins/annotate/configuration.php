<?php
/**************************************************
  Picture Annotation (annotate) plugin for cpg1.5.x
  *************************************************
  Copyright (c) 2003-2009 Coppermine Dev Team

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  *************************************************
  Coppermine version: 1.5.x
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**************************************************/

if (!defined('IN_COPPERMINE')) {
    die('Not in Coppermine...');
}

require_once './plugins/annotate/init.inc.php';
$annotate_init_array = annotate_initialize();
$lang_plugin_annotate = $annotate_init_array['language']; 
$annotate_icon_array = $annotate_init_array['icon'];

$name = $lang_plugin_annotate['plugin_name'];

$description = $lang_plugin_annotate['plugin_description'];

$author = '<ul>' . $LINEBREAK;
$author .= '<li>' . sprintf($lang_plugin_annotate['plugin_credit_creator'], '<a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=941" rel="external" class="external">Nibbler</a>') . '</li>' . $LINEBREAK;
$author .= '<li>' . sprintf($lang_plugin_annotate['plugin_credit_porter'], '<a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=24278" rel="external" class="external">eenemeenemuu</a>') . '</li>' . $LINEBREAK;
$author .= '<li>' . sprintf($lang_plugin_annotate['plugin_credit_js'], '<a href="http://www.dustyd.net/" rel="external" class="external">Dusty Davidson</a>', '<a href="http://www.twinhelix.com/" rel="external" class="external">Angus Turnbull</a>') . '</li>' . $LINEBREAK;
$author .= '<li>' . sprintf($lang_plugin_annotate['plugin_credit_i18n'], '<a href="http://forum.coppermine-gallery.net/index.php?action=profile;u=2" rel="external" class="external">Joachim Müller</a>') . '</li>' . $LINEBREAK;
$author .= '</ul>';

$version = '2.1';

$install_info = '<a href="http://forum.coppermine-gallery.net/index.php/topic,60622.0.html" rel="external" class="admin_menu external">' . $annotate_icon_array['announcement'] . sprintf($lang_plugin_annotate['announcemen_thread'], $lang_plugin_annotate['plugin_name']) . '</a>';
$extra_info .= '<a href="index.php?file=annotate/admin" class="admin_menu">' . $annotate_icon_array['configure'] . $lang_plugin_annotate['configure_plugin'] . '</a> ';
$extra_info .= '<a href="index.php?plugin=annotate&delete_orphans" class="admin_menu">' . $annotate_icon_array['delete'] . $lang_plugin_annotate['delete_orphaned_entries'] . '</a> ';
$extra_info .= '<a href="index.php?plugin=annotate&update_database" class="admin_menu">' . $annotate_icon_array['update_database'] . $lang_plugin_annotate['update_database'] . '</a> ';
$extra_info .= $install_info;




?>