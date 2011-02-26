<?php
/*********************************************
  Coppermine 1.5.x Plugin - External tracker
  ********************************************
  Copyright (c) 2009 - 2011 papukaija
  
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  $HeadURL$
  $Revision$
**********************************************/
if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

//to install
$thisplugin->add_action('plugin_install','external_tracker_install');

//to uninstall with clean up
$thisplugin->add_action('plugin_uninstall','external_tracker_uninstall');
$thisplugin->add_action('plugin_cleanup','external_tracker_cleanup');

//to edit footer, for non-asynchronous trackers
$thisplugin->add_filter('gallery_footer','external_tracker_footer');

//to edit header, for asynchronous trackers
$thisplugin->add_filter('page_meta','external_tracker_header');

//async
function external_tracker_header($meta) {
    global $CONFIG;
    $superCage = Inspekt::makeSuperCage();

    $stats=''; //Tracker code added if user is not an admin or is using the optional cookie
    if (!GALLERY_ADMIN_MODE) {
        $stats = 'yes';
    }
    if ($superCage->cookie->keyExists($CONFIG['cookie_name'] . '_ext_stats')) {
        $stats = $superCage->cookie->getAlpha($CONFIG['cookie_name'] . '_ext_stats');
        //cookie disables all trackers
    }
    
    $ext_js_async = '';
    if ($stats == 'yes') {
        // Query the services
        $result = cpg_db_query("SELECT service_name_short, tracker, tracker_extra FROM {$CONFIG['TABLE_PREFIX']}plugin_external_tracker WHERE service_active='YES' AND async='YES'");
        while ($row = mysql_fetch_assoc($result)) {
            include("./plugins/external_tracker/include/{$row['service_name_short']}.inc.php");
        }
        mysql_free_result($result);
    }
    return $ext_js_async . $meta;
}

//non-async
function external_tracker_footer($html) {
    global $CONFIG;
    $superCage = Inspekt::makeSuperCage();
    $_GET=$superCage->get->_source; //these are needed for the 3rd party php files
    $_POST=$superCage->post->_source;
    $_COOKIE=$superCage->cookie->_source;
    $_ENV=$superCage->env->_source;
    $_FILES=$superCage->files->_source;
    //$_SESSION=$superCage->session->_source; $_SESSION isn't yet supported by makeSuperCage
    $_SERVER=$superCage->server->_source;

    $stats=''; //Tracker code added if user is not an admin or is using the optional cookie
    if (!GALLERY_ADMIN_MODE) {
        $stats = 'yes';
    }
    if ($superCage->cookie->keyExists($CONFIG['cookie_name'] . '_ext_stats')) {
        $stats = $superCage->cookie->getAlpha($CONFIG['cookie_name'] . '_ext_stats');
        //cookie disables all trackers
    }
    
    $ext_js = '';
    if ($stats == 'yes') {
        // Query the services
        $result = cpg_db_query("SELECT service_name_short, tracker, tracker_extra FROM {$CONFIG['TABLE_PREFIX']}plugin_external_tracker WHERE service_active='YES' AND async='NO'");
        while ($row = mysql_fetch_assoc($result)) {
            include("./plugins/external_tracker/include/{$row['service_name_short']}.inc.php");
        }
        mysql_free_result($result);
        //Destroy superglobals for better security ($_SESSION isn't yet supported by makeSuperCage)
        $_REQUEST=$_GET=$_POST=$_COOKIE=$_SERVER=$_FILES=$_ENV= '';
    }
$return = $ext_js.$html;
return $return;
}

function external_tracker_install() {
    global $CONFIG, $thisplugin;
    require 'include/sql_parse.php';
    
    // create table
    $db_schema = $thisplugin->fullpath . '/schema.sql';
    $sql_query = fread(fopen($db_schema, 'r'), filesize($db_schema));
    $sql_query = preg_replace('/CPG_/', $CONFIG['TABLE_PREFIX'], $sql_query);
    $sql_query = remove_remarks($sql_query);
    $sql_query = split_sql_file($sql_query, ';');
    
    foreach($sql_query as $q) {
        cpg_db_query($q);
    }

    // insert default values
    $db_basic = $thisplugin->fullpath . '/basic.sql';
    $sql_query = fread(fopen($db_basic, 'r'), filesize($db_basic));
    $sql_query = preg_replace('/CPG_/', $CONFIG['TABLE_PREFIX'], $sql_query);
    $sql_query = remove_remarks($sql_query);
    $sql_query = split_sql_file($sql_query, ';');

    foreach($sql_query as $q) {
        cpg_db_query($q);
    }
    return true;
    
}

function external_tracker_cleanup($action) {
    global $CONFIG, $lang_common, $lang_plugin_external_tracker;
   
    require_once 'plugins/external_tracker/include/init.inc.php';
    $superCage = Inspekt::makeSuperCage();
    $form_action = $superCage->server->getEscaped('REQUEST_URI');
    
    if ($action == '1') {
        list($timestamp, $form_token) = getFormToken();
        $help_icon = '<img src="images/help.gif" width="13" height="11" border="0" alt="" />';
        echo <<< EOT
        <form action="{$form_action}" method="post">
            <p>
                {$lang_plugin_external_tracker['clean_up_question']}&nbsp;<a href="plugins/external_tracker/docs/{$doc_lng}.html?hide_nav=1#uninstall" class="greybox" title="{$lang_plugin_external_tracker['help']}">{$help_icon}</a>
            </p>
            <div style="margin:25;">
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><input type="radio" name="remove" value="1" /></td>
                        <td>{$lang_common['yes']}</td>
                    </tr>
                    <tr>
                        <td><input type="radio" name="remove" checked="checked" value="0" /></td>
                        <td>{$lang_common['no']}</td>
                    </tr>
                </table>
            </div>
            <br />
            <span>
                <input type="hidden" name="form_token" value="{$form_token}" />
                <input type="hidden" name="timestamp" value="{$timestamp}" />
                <input type="submit" name="submit" class="button" value="{$lang_common['continue']}" />
                <input type="button" name="cancel" class="button" onClick="window.location='pluginmgr.php';" value="{$lang_common['back']}" />
            </span>
        </form>
EOT;
    }
}

function external_tracker_uninstall() {
    global $CONFIG;
    if(!checkFormToken()){
        cpg_die(ERROR, $lang_errors['invalid_form_token'], __FILE__, __LINE__);
    }

    // the cookie is removed always, config on request
    $superCage = Inspekt::makeSuperCage();
    if (!$superCage->post->keyExists('remove')) {
        setcookie($CONFIG['cookie_name'].'_ext_stats', 'no', time() - 600, $CONFIG['cookie_path']);
        return 1;
    }

    if ($superCage->post->getEscaped('remove')) {
        cpg_db_query("DROP TABLE IF EXISTS {$CONFIG['TABLE_PREFIX']}plugin_external_tracker");
        setcookie($CONFIG['cookie_name'].'_ext_stats', 'no', time() - 600, $CONFIG['cookie_path']);
    }

    return true;
}
?>
