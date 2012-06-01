<?php
/**************************************************
  Coppermine 1.5.x Plugin - Cookie consent
  *************************************************
  Copyright (c) 2012 eenemeenemuu
  ********************************************
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**************************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

$thisplugin->add_action('plugin_install', 'cookie_consent_install');
function cookie_consent_install() {
    global $CONFIG;
    cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '1' WHERE name = 'cookies_need_consent'");
    return true;
}


$thisplugin->add_action('plugin_uninstall', 'cookie_consent_uninstall');
function cookie_consent_uninstall() {
    global $CONFIG;
    cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '0' WHERE name = 'cookies_need_consent'");
    return true;
}

?>