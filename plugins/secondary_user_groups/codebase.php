<?php
/**************************************************
  Coppermine 1.5.x Plugin - Secondary user groups
  *************************************************
  Copyright (c) 2012 eenemeenemuu
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

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

if (defined('USERMGR_PHP')) {
    $thisplugin->add_action('page_start', 'secondary_user_groups_page_start');
    $thisplugin->add_filter('page_html', 'secondary_user_groups_page_html');
}

function secondary_user_groups_page_start() {
    global $CONFIG, $cpg_udb, $secondary_user_groups_user_groups;

    if (!$cpg_udb->can_join_tables) {
        return;
    } else {
        define('CAN_JOIN_TABLES', '1');
    }

    $group_id_add = $CONFIG['bridge_enable'] ? 100 : 0;

    $result = cpg_db_query("SELECT {$cpg_udb->field['grouptbl_group_id']} AS group_id, {$cpg_udb->field['grouptbl_group_name']} AS group_name FROM {$cpg_udb->groupstable}");
    while ($row = mysql_fetch_assoc($result)) {
        $group_names[$row['group_id'] + $group_id_add] = $row['group_name'];
    }
    mysql_free_result($result);

    $users = cpg_db_fetch_rowset(cpg_db_query("SELECT {$cpg_udb->field['user_id']} AS user_id FROM {$cpg_udb->usertable}"));
    foreach ($users as $user) {
        $group_ids = cpg_get_groups($user['user_id']);
        foreach ($group_ids as $group_id) {
            if ($group_names[$group_id]) {
                $secondary_user_groups_user_groups[$user['user_id']][] = $group_names[$group_id];
            }
        }
    }
}

function append_user_group_names($matches) {
    global $secondary_user_groups_user_groups;
    $user_id = $matches[2];
    $group_names_cell = $matches[3];

    if (count($secondary_user_groups_user_groups[$user_id]) < 2) {
        return $matches[0];
    }

    preg_match('/<td.*>(.*)<\/td>/', $group_names_cell, $primary_group_name);
    $primary_group_name = $primary_group_name[1];
    foreach ($secondary_user_groups_user_groups[$user_id] as $group_name) {
        if ($group_name != $primary_group_name) {
            $groups .= ', '.$group_name;
        }
    }
    $group_names_cell = str_replace($primary_group_name.'</td>', '<u>'.$primary_group_name.'</u>'.$groups.'</td>', $group_names_cell);

    return $matches[1].$group_names_cell.$matches[4];
}

function secondary_user_groups_page_html($html) {
    if (defined('CAN_JOIN_TABLES')) {
        $html = preg_replace_callback('/(<tr.*<a href="profile\.php\?uid=([0-9]+)">.*<td.*)(<td.*<\/td>)(.*<\/tr>)/Usi', 'append_user_group_names', $html);
    }
    return $html;
}

?>