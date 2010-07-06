<?php
/**************************************************
  Coppermine 1.5.x Plugin - Limit upload
  *************************************************
  Copyright (c) 2010 eenemeenemuu
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


if (defined('DB_INPUT_PHP')) {
    $thisplugin->add_action('page_start', 'limit_upload_page_start');
}

function limit_upload_page_start() {
    if (!GALLERY_ADMIN_MODE && $CONFIG['limit_upload_upload_limit'] >= 0) {
        global $CONFIG;

        switch($CONFIG['limit_upload_upload_limit']) {
            // TODO: determine beginning of current hour/day/week/month/year and adjust the calculation
            case 'hour': $sql_and = ' AND ctime > '.time()-(60*60); break;
            case 'day': $sql_and = ' AND ctime > '.time()-(24*60*60); break;
            case 'week': $sql_and = ' AND ctime > '.time()-(7*24*60*60); break;
            case 'month': $sql_and = ' AND ctime > '.time()-(30*24*60*60); break;
            case 'year': $sql_and = ' AND ctime > '.time()-(365*24*60*60); break;
            default: $sql_and = ''; break;
        }

        $count = mysql_result(cpg_db_query("SELECT COUNT(*) FROM {$CONFIG['TABLE_PICTURES']} WHERE owner_id = ".USER_ID.$sql_and), 0);
        if ($count >= $CONFIG['limit_upload_upload_limit']) {
            $superCage = Inspekt::makeSuperCage();
            require_once "./plugins/limit_upload/lang/english.php";
            if ($CONFIG['lang'] != 'english' && file_exists("./plugins/limit_upload/lang/{$CONFIG['lang']}.php")) {
                require_once "./plugins/limit_upload/lang/{$CONFIG['lang']}.php";
            }

            $error = sprintf($lang_plugin_limit_upload['limit_reached_x'], $CONFIG['limit_upload_upload_limit'], $lang_plugin_limit_upload['time_limit_values'][$CONFIG['limit_upload_time_limit']]);

            if ($CONFIG['limit_upload_time_limit'] != 'total') {
                // TODO: determine end of current hour/day/week/month/year and adjust the query
                // TODO: more precise waiting time calculation with different units
                $last_upload = mysql_result(cpg_db_query("SELECT MAX(ctime) FROM {$CONFIG['TABLE_PICTURES']} WHERE owner_id = ".USER_ID), 0);
                $wait = ceil( (time() - $last_upload) / 3600);
                $error .= '<br /> ';
                $error .= sprintf($lang_plugin_limit_upload['limit_reached_wait'], $wait);
            }

            if ($superCage->post->keyExists('process')) {
                die($error);
            } else {
                load_template();
                cpg_die(ERROR, $error, __FILE__, __LINE__);
            }
        }
    }
}


$thisplugin->add_action('plugin_install','limit_upload_install');

function limit_upload_install () {
    global $CONFIG;
    cpg_db_query("INSERT INTO {$CONFIG['TABLE_CONFIG']} (name, value) VALUES ('limit_upload_upload_limit', '-1')");
    cpg_db_query("INSERT INTO {$CONFIG['TABLE_CONFIG']} (name, value) VALUES ('limit_upload_time_limit', 'total')");

    return true;
}


$thisplugin->add_action('plugin_uninstall','limit_upload_uninstall');

function limit_upload_uninstall () {
    global $CONFIG;
    cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'limit_upload_upload_limit'");
    cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'limit_upload_time_limit'");

    return true;
}

?>