<?php
/**************************************************
  Coppermine 1.5.x Plugin - Picture Annotation (annotate)
  *************************************************
  Copyright (c) 2003-2009 Coppermine Dev Team
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

if (!defined('IN_COPPERMINE')) {
    die('Not in Coppermine...');
}

global $CONFIG, $LINEBREAK;

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

$version = '2.10';
$plugin_cpg_version = array('min' => '1.5');
$install_info = '<a href="http://forum.coppermine-gallery.net/index.php/topic,60622.0.html" rel="external" class="admin_menu">' . $annotate_icon_array['announcement'] . $lang_plugin_annotate['announcement_thread'] . '</a>';
$extra_info .= '<a href="index.php?file=annotate/admin" class="admin_menu">' . $annotate_icon_array['configure'] . $lang_plugin_annotate['configure_plugin'] . '</a> ';
$extra_info .= '<a href="index.php?plugin=annotate&amp;update_database" class="admin_menu">' . $annotate_icon_array['update_database'] . $lang_plugin_annotate['update_database'] . '</a> ';
if ($CONFIG['plugin_annotate_import'] != "1" && mysql_result(mysql_query("SELECT COUNT(*) FROM {$CONFIG['TABLE_PREFIX']}notes"), 0) > 0) {
    $extra_info .= '<a href="index.php?plugin=annotate&amp;import" class="admin_menu">' . $annotate_icon_array['import'] . $lang_plugin_annotate['import'] . '</a> ';
}
$extra_info .= '<a href="index.php?plugin=annotate&amp;manage" class="admin_menu">' . $annotate_icon_array['manage'] . $lang_plugin_annotate['manage'] . '</a> ';
$extra_info .= '<a href="index.php?plugin=annotate&amp;delete_orphans" class="admin_menu">' . $annotate_icon_array['delete'] . $lang_plugin_annotate['delete_orphaned_entries'] . '</a> ';
$extra_info .= $install_info;




?>