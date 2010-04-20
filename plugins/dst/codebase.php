<?php
/**************************************************
  Coppermine 1.5.x Plugin - Daylight saving time
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

$thisplugin->add_action('page_start','dst_start');
$thisplugin->add_action('plugin_install','dst_install');
$thisplugin->add_action('plugin_uninstall','dst_uninstall');
$thisplugin->add_action('plugin_configure','dst_configure');

function dst_start() {
    global $CONFIG, $CPG_PHP_SELF, $lang_admin_php, $lang_date, $lang_plugin_dst;

    require_once "./plugins/dst/lang/english.php";
    if ($CONFIG['lang'] != 'english' && file_exists("./plugins/dst/lang/{$CONFIG['lang']}.php")) {
        require_once "./plugins/dst/lang/{$CONFIG['lang']}.php";
    }

    if ($CONFIG['plugin_dst_on'] == '1') {
        if ($CPG_PHP_SELF != 'admin.php') {
            $CONFIG['time_offset']++;
        } else {
            $lang_admin_php['time_offset_detail'] = str_replace('%s', localised_date(time() + 3600, $lang_date['comment']), $lang_admin_php['time_offset_detail']);
        }
    }

    if ($CONFIG['plugin_dst_country'] != '') {
        $lang_admin_php['time_offset_detail'] .= '<br />' . sprintf($lang_plugin_dst['plugin_is_installed_and_interferes'], '<a href="pluginmgr.php">' . $lang_plugin_dst['dst'] . '</a>') . ' ';
        $lang_admin_php['time_offset_detail'] .= sprintf($lang_plugin_dst['you_have_selected_x_as_country'], '<em>' . $CONFIG['plugin_dst_country'] . '</em>') . ' ';
        $lang_admin_php['time_offset_detail'] .= sprintf(($CONFIG['plugin_dst_on'] == '1' ? $lang_plugin_dst['dst_will_end_on'] : $lang_plugin_dst['dst_will_start_on']), $CONFIG['plugin_dst_datetime']) . ' ' . $lang_plugin_dst['time_will_auto_adjust'];
    }

    if ($CONFIG['plugin_dst_datetime'] != '' && date('Y-m-d H:i:s') > $CONFIG['plugin_dst_datetime']) {
        // We have reached the trigger date: DST plugin is on and the trigger date has passed, so let's toggle the DST and set the new trigger date
        include_once('./plugins/dst/functions.inc.php');
        $dst_array = plugin_dst_xml_read();
        plugin_dst_datetime_update($dst_array);
    }
}

function dst_install() {
    global $CONFIG, $dst_installation;
    // Create the super cage
    $superCage = Inspekt::makeSuperCage();
    $dst_installation = 1;
    if (isset($CONFIG['plugin_dst_country']) != TRUE) {
        $CONFIG['plugin_dst_country'] = '';
    }
    if (isset($CONFIG['plugin_dst_locations']) != TRUE) {
        $CONFIG['plugin_dst_locations'] = '';
    }
    if (isset($CONFIG['plugin_dst_on']) != TRUE) {
        $CONFIG['plugin_dst_on'] = '1';
    }
    if (isset($CONFIG['plugin_dst_datetime']) != TRUE) {
        $CONFIG['plugin_dst_datetime'] = '';
    }
    cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_dst_country', '{$CONFIG['plugin_dst_country']}')");
    cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_dst_locations', '{$CONFIG['plugin_dst_locations']}')");
    cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_dst_on', '{$CONFIG['plugin_dst_on']}')");
    cpg_db_query("INSERT IGNORE INTO {$CONFIG['TABLE_CONFIG']} (`name`, `value`) VALUES ('plugin_dst_datetime', '{$CONFIG['plugin_dst_datetime']}')");
    if ($superCage->post->keyExists('dst_install_submit') == TRUE && $superCage->post->getInt('dst_install_submit') == 1 && preg_match('/^[a-zA-Z ]+$/', $superCage->post->getRaw('plugin_dst_country'))) {
        $dst_installation = 0;
        // Perform the database change
        $CONFIG['plugin_dst_country'] = $superCage->post->getRaw('plugin_dst_country');
        cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_dst_country']}' WHERE name='plugin_dst_country'");
        include_once('./plugins/dst/functions.inc.php');
        $dst_array = plugin_dst_xml_read();
        plugin_dst_datetime_update($dst_array);
        return true;
    } else { // Loop again
        return 1;
    }
}

function dst_uninstall() {
    global $CONFIG;
    cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_dst_country'");
    cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_dst_locations'");
    cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_dst_on'");
    cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_dst_datetime'");
    return true;
}

function dst_configure() {
    global $CONFIG, $dst_installation;
    // create Inspekt supercage
    $superCage = Inspekt::makeSuperCage();

    if (!GALLERY_ADMIN_MODE) {
        cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
    }

    require "./plugins/dst/lang/english.php";
    if ($CONFIG['lang'] != 'english' && file_exists("./plugins/dst/lang/{$CONFIG['lang']}.php")) {
        require "./plugins/dst/lang/{$CONFIG['lang']}.php";
    }
    $plugin_dst_icon['submit'] = cpg_fetch_icon('ok', 1);
    include_once('./plugins/dst/functions.inc.php');
    $dst_array = plugin_dst_xml_read();

    // create Inspekt supercage
    $superCage = Inspekt::makeSuperCage();

    // get sanitized POST parameters
    if ($superCage->post->keyExists('submit')) {
        //Check if the form token is valid
        if(!checkFormToken()){
            cpg_die(ERROR, $lang_errors['invalid_form_token'], __FILE__, __LINE__);
        }
        // Define the sanitization patterns
        $sanitization_array = array(
            'plugin_dst_country' => array('type' => 'raw', 'regex_ok' => '/^[a-zA-Z ]+$/'),
        );
        $config_changes_counter = 0;
      foreach ($sanitization_array as $san_key => $san_value) {
          if (isset($CONFIG[$san_key]) == TRUE) { // only loop if config value is set --- start
              if ($san_value['type'] == 'checkbox') { // type is checkbox --- start
                if ($superCage->post->getInt($san_key) == $san_value['max'] && $CONFIG[$san_key] != $san_value['max']) {
                    $CONFIG[$san_key] = $san_value['max'];
                    cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG[$san_key]}' WHERE name='$san_key'");
                    $config_changes_counter++;
                } elseif($superCage->post->getInt($san_key) == $san_value['min'] && $CONFIG[$san_key] != $san_value['min']) {
                    $CONFIG[$san_key] = $san_value['min'];
                    cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG[$san_key]}' WHERE name='$san_key'");
                    $config_changes_counter++;
                } elseif($superCage->post->keyExists($san_key) != TRUE && $CONFIG[$san_key] != '0') {
                    $CONFIG[$san_key] = 0;
                    cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG[$san_key]}' WHERE name='$san_key'");
                    $config_changes_counter++;
                }
              } // type is checkbox --- end
              if ($san_value['type'] == 'int') { // type is integer --- start
                  if ($superCage->post->getInt($san_key) <= $san_value['max'] && $superCage->post->getInt($san_key) >= $san_value['min'] && $superCage->post->getInt($san_key) != $CONFIG[$san_key]) {
                      $CONFIG[$san_key] = $superCage->post->getInt($san_key);
                      cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG[$san_key]}' WHERE name='$san_key'");
                      $config_changes_counter++;
                  }
              } // type is integer --- end
              if ($san_value['type'] == 'raw') { // type is raw --- start
                  if (isset($san_value['regex_ok']) == TRUE && preg_match($san_value['regex_ok'], $superCage->post->getRaw($san_key)) && $superCage->post->getRaw($san_key) != $CONFIG[$san_key]) {
                      $CONFIG[$san_key] = $superCage->post->getRaw($san_key);
                      if ($superCage->post->getRaw($san_key) == 'none') {
                        $CONFIG[$san_key] = '';
                      }
                      cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG[$san_key]}' WHERE name='$san_key'");
                      $config_changes_counter++;
                  }
              } // type is raw --- end
              if ($san_value['type'] == 'array') { // type is array --- start              
              $evaluate_value = $superCage->post->getRaw($san_key);
                  //print_r($superCage->post->getRaw($san_key));
                  if (is_array($evaluate_value) && isset($san_value['regex_ok']) == TRUE && isset($san_value['delimiter']) == TRUE) {
                      $temp = '';
                      for ($i = 0; $i <= count($evaluate_value); $i++) {
                          if (preg_match($san_value['regex_ok'], $evaluate_value[$i])) {
                              $temp .= $evaluate_value[$i] . $san_value['delimiter'];
                          }
                      }
                      unset($evaluate_value);
                      $evaluate_value = rtrim($temp, $san_value['delimiter']);
                      unset($temp);
                  }
                  if ($evaluate_value != $CONFIG[$san_key]) {
                      $CONFIG[$san_key] = $evaluate_value;
                      cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG[$san_key]}' WHERE name='$san_key'");
                      $config_changes_counter++;
                  }
              } // type is array --- end
          } // only loop if config value is set --- end
      }
    }

    list($timestamp, $form_token) = getFormToken();

    if ($superCage->post->keyExists('submit')) {
        if ($config_changes_counter == 0) {
            msg_box($lang_common['error'], $lang_plugin_dst['no_changes'], '', '', 'error');
        } else {
            msg_box($lang_common['information'], $lang_plugin_dst['changes_saved'], '', '', 'success');
        }
    }
    if ($dst_installation == 1) {
        msg_box($lang_common['information'], sprintf($lang_plugin_dst['plugin_x_not_installed_yet'], '&laquo;' . $lang_plugin_dst['dst'] . '&raquo') . ' ' . $lang_plugin_dst['submit_form_to_install'], '', '', 'warning');
    }

    echo <<< EOT
<form action="" method="post" name="dst_config" id="dst_config">
EOT;
    if ($dst_installation == 1) {
        starttable('100%', '', 2);
    } else {
        starttable('100%', $lang_plugin_dst['dst'] . ' - ' . $lang_plugin_dst['configuration'], 2);
    }
    if ($CONFIG['plugin_dst_country'] == '') {
        $selected = 'selected="selected"';
    } else {
        $selected = '';
    }
    echo <<< EOT
                <tr>
                    <td valign="top" class="tableb">
                        {$lang_plugin_dst['select_your_country_or_region']}
                    </td>
                    <td valign="top" class="tableb">
                        <select name="plugin_dst_country" id="plugin_dst_country" class="listbox">
                            <option value="none" {$selected} disabled="disabled">{$lang_plugin_dst['no_daylight_saving_time']}</option>

EOT;
    foreach ($dst_array as $value) {
        if ($CONFIG['plugin_dst_country'] == $value['country']) {
            $selected = 'selected="selected"';
            if ($superCage->post->keyExists('submit') && $config_changes_counter != 0) {
                // The country has changed, so let's populate the other config values
                if ($CONFIG['plugin_dst_on'] == '1') {
                    $CONFIG['plugin_dst_on'] = '0';
                    cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_dst_on']}' WHERE name='plugin_dst_on'");
                }
                $datetime = date('Y-m-d H:i:s');
                //$datetime = '2018-11-12 14:30:00'; // For testing purposes you can manually override the date here
                $previoustime = '';
                foreach ($value['data'] as $selected_array) {
                    $starttime = current($selected_array);
                    $endtime = next($selected_array);
                    if ($datetime >= $starttime && $datetime <= $endtime) {
                        // We have a winner - it's currently DST and we have a time zone difference
                        $CONFIG['plugin_dst_locations'] = $value['locations'];
                        $CONFIG['plugin_dst_datetime'] = $endtime;
                        $CONFIG['plugin_dst_on'] = '1';
                    } elseif ($datetime > $previoustime && $datetime < $starttime) { // We're out of the DST time range, i.e. in winter on the norther hemisphere
                        $CONFIG['plugin_dst_locations'] = $value['locations'];
                        $CONFIG['plugin_dst_datetime'] = $starttime;
                        $CONFIG['plugin_dst_on'] = '0';
                    }
                    $previoustime = $endtime;
                }
                cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_dst_locations']}' WHERE name='plugin_dst_locations'");
                cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_dst_datetime']}' WHERE name='plugin_dst_datetime'");
                cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_dst_on']}' WHERE name='plugin_dst_on'");
            }
        } else {
            $selected = '';
        }
        if ($value['locations'] != '') {
            $location = ' - ' . $value['locations'];
        } else {
            $location = '';
        }
        echo <<< EOT
                            <option value="{$value['country']}" {$selected}>{$value['country']}{$location}</option>

EOT;
    }
    echo <<< EOT
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="tablef" colspan="2">
                        <input type="hidden" name="form_token" value="{$form_token}" />
                        <input type="hidden" name="timestamp" value="{$timestamp}" />
                        <input type="hidden" name="dst_install_submit" value="1" />
                        <button type="submit" class="button" name="submit" value="{$lang_plugin_enlargeit['submit']}">{$plugin_dst_icon['submit']}{$lang_plugin_dst['submit']}</button>
                    </td>
                </tr>
EOT;
    endtable();
    if ($CONFIG['plugin_dst_country'] == '') {
        $CONFIG['plugin_dst_locations'] = '';
        $CONFIG['plugin_dst_datetime'] = '';
        $CONFIG['plugin_dst_on'] = '0';
        cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_dst_locations']}' WHERE name='plugin_dst_locations'");
        cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_dst_datetime']}' WHERE name='plugin_dst_datetime'");
        cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value='{$CONFIG['plugin_dst_on']}' WHERE name='plugin_dst_on'");
    }
    echo <<< EOT
</form>
EOT;
}

?>