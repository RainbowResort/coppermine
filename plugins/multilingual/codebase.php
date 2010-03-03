<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2006 Coppermine Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  ********************************************
  Coppermine version: 1.4.8
  $Source$
  $Revision: 3116 $
  $Author: abbas-ali $
  $Date: 2006-07-17 00:11:54 +0200 $
**********************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

// Add an install action
$thisplugin->add_action('plugin_install','multi_install');

// Add a configure action
$thisplugin->add_action('plugin_configure','multi_configure');

// Add plugin_uninstall action
$thisplugin->add_action('plugin_uninstall','multi_uninstall');

// Add plugin_cleanup action
$thisplugin->add_action('plugin_cleanup','multi_cleanup');

// Add page_start action
$thisplugin->add_action('page_start','multi_page_start');

// Add filter to convert cat, album texts
$thisplugin->add_filter('lang_convert','multi_convert');

// Add filter to convert
$thisplugin->add_filter('file_data','multi_convert_file_data');


function multi_page_start()
{
        global $CONFIG, $replaceArr;

        $CONFIG['TABLE_LANG_STRINGS'] = $CONFIG['TABLE_PREFIX']."lang_strings";

        $query = "SELECT * FROM {$CONFIG['TABLE_LANG_STRINGS']} WHERE lang = '{$CONFIG['lang']}'";
        $result = cpg_db_query($query);
        while ($row = mysql_fetch_array($result)) {
          if (trim($row['translated'])) {
            $replaceArr[$row['original']] = $row['translated'];
          }
        }
}

// Install
function multi_install()
{
        global $CONFIG, $thisplugin;

        if (isset($_POST['langs'])) {
                 require 'include/sql_parse.php';

                 $langStr = implode(',', $_POST['langs']);

                // create table
                $db_schema = $thisplugin->fullpath . '/schema.sql';
                $sql_query = fread(fopen($db_schema, 'r'), filesize($db_schema));
                $sql_query = preg_replace('/CPG_/', $CONFIG['TABLE_PREFIX'], $sql_query);

                $sql_query = remove_remarks($sql_query);
                $sql_query = split_sql_file($sql_query, ';');
                $sql_query[] = "REPLACE INTO {$CONFIG['TABLE_CONFIG']} (name, value) VALUES ('mod_active_lang', '$langStr')";

                foreach($sql_query as $q) cpg_db_query($q);

           return true;
    } else {
        return 1;
    }
}

// Configure function
// Displays the form
function multi_configure()
{
  $lang_array = getLanguages();
  foreach ($lang_array as $lang) {
    $langOpt .= "<input type=\"checkbox\" name=\"langs[]\" value=\"$lang\"> $lang <br />";
  }
  echo <<< EOT
    <form action="{$_SERVER['REQUEST_URI']}" method="post">
        <p>
            Select the languages you want to use
        </p>
        <div style="margin:25;">
        <table border="0" cellspacing="0" cellpadding="0">
            <tr>
                $langOpt
            </tr>
        </table>
        </div>
        <span>
           <input type="submit" name="submit" value="Submit" /> &nbsp;&nbsp;&nbsp;
            <input type="button" name="cancel" onClick="window.location='pluginmgr.php';" value="Cancel" />
        </span>
    </form>
EOT;
}

function getLanguages()
{
  global $CONFIG;

  $lang_dir = 'lang/';
  $dir = opendir($lang_dir);
  while ($file = readdir($dir)) {
     if ($file != '.' && $file != '..' && $file !='CVS' && strtolower(substr($file, 0 , -4)) != $CONFIG['lang']) {
         $lang_array[] = strtolower(substr($file, 0 , -4));
     }
  }
  closedir($dir);
  natcasesort($lang_array);
  return $lang_array;
}

// Unnstall (drop?)
function multi_uninstall()
{
        global $CONFIG;

        if (!isset($_POST['drop'])) return 1;

        if ($_POST['drop']) {
          cpg_db_query("DROP TABLE IF EXISTS {$CONFIG['TABLE_LANG_STRINGS']}");
          cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'mod_active_lang'");
        }

        return true;
}

// Ask if we want to drop the table
function multi_cleanup($action) {
    if ($action===1) {
        echo <<< EOT
    <form action="{$_SERVER['REQUEST_URI']}" method="post">
        <p>
            Remove the table that was used to store multi language texts?
        </p>
        <div style="margin:25;">
        <table border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td><input type="radio" name="drop" value="1" /></td>
                <td>Yes</td>
            </tr>
            <tr>
                <td><input type="radio" name="drop" checked="checked" value="0" /></td>
                <td>No</td>
            </tr>
        </table>
        </div>
        <span>
           <input type="submit" name="submit" value="Submit" /> &nbsp;&nbsp;&nbsp;
            <input type="button" name="cancel" onClick="window.location='pluginmgr.php';" value="Cancel" />
        </span>
    </form>
EOT;
    }
}

function multi_convert($text)
{
  global $replaceArr;

  if (array_key_exists($text, $replaceArr)) {
    $text = str_replace($text, $replaceArr[$text], $text);
  }

  return $text;
}

function multi_convert_file_data($rowset) {
  global $replaceArr;
  if (array_key_exists($rowset['title'], $replaceArr)) {
    $rowset['title'] = $replaceArr[$rowset['title']];
  }
  if (array_key_exists($rowset['caption'], $replaceArr)) {
    $rowset['caption'] = $replaceArr[$rowset['caption']];
  }
  return $rowset;
}

?>