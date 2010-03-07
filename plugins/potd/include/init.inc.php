<?php
/**************************************************
  Coppermine Plugin - PotD/PotW
  *************************************************
  Copyright (c) 2006 Paul Van Rompay, Casper
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
***************************************************/

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...');}

// submit your lang file for this plugin on the coppermine forums
// plugin will try to use the configured language if it is available.

global $CONFIG;

if (!isset($CONFIG['TABLE_PREFIX'])) { 
  $path_to = '../../';
  $CONFIG = array();
  // require_once($path_to.'include/debugger.inc.php');
  set_magic_quotes_runtime(0);
  // used for timing purpose
  $query_stats = array();
  $queries = array();
  function cpgGetMicroTime()
  {
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
  }
  $cpg_time_start = cpgGetMicroTime();
  require($path_to.'include/config.inc.php');
  require($path_to.'include/functions.inc.php');
  $CONFIG['TABLE_PICTURES']   = $CONFIG['TABLE_PREFIX'].'pictures';
  $CONFIG['TABLE_ALBUMS']     = $CONFIG['TABLE_PREFIX'].'albums';
  $CONFIG['TABLE_COMMENTS']   = $CONFIG['TABLE_PREFIX'].'comments';
  $CONFIG['TABLE_CATEGORIES'] = $CONFIG['TABLE_PREFIX'].'categories';
  $CONFIG['TABLE_CONFIG']     = $CONFIG['TABLE_PREFIX'].'config';
  $CONFIG['TABLE_USERGROUPS'] = $CONFIG['TABLE_PREFIX'].'usergroups';
  $CONFIG['TABLE_VOTES']      = $CONFIG['TABLE_PREFIX'].'votes';
  $CONFIG['TABLE_USERS']      = $CONFIG['TABLE_PREFIX'].'users';
  $CONFIG['TABLE_BANNED']     = $CONFIG['TABLE_PREFIX'].'banned';
  $CONFIG['TABLE_EXIF']       = $CONFIG['TABLE_PREFIX'].'exif';
  $CONFIG['TABLE_FILETYPES']  = $CONFIG['TABLE_PREFIX'].'filetypes';
  $CONFIG['TABLE_ECARDS']     = $CONFIG['TABLE_PREFIX'].'ecards';
  $CONFIG['TABLE_TEMPDATA']   = $CONFIG['TABLE_PREFIX'].'temp_data';
  $CONFIG['TABLE_FAVPICS']    = $CONFIG['TABLE_PREFIX'].'favpics';
  $CONFIG['TABLE_BRIDGE']     = $CONFIG['TABLE_PREFIX'].'bridge';
  $CONFIG['TABLE_VOTE_STATS'] = $CONFIG['TABLE_PREFIX'].'vote_stats';
  $CONFIG['TABLE_HIT_STATS']  = $CONFIG['TABLE_PREFIX'].'hit_stats';
  // Connect to database
  ($CONFIG['LINK_ID'] = cpg_db_connect()) || die('<b>Coppermine critical error</b>:<br />Unable to connect to database !<br /><br />MySQL said: <b>' . mysql_error() . '</b>');
  // Retrieve DB stored configuration
  $results = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_CONFIG']}");
  while ($row = mysql_fetch_array($results)) {
    $CONFIG[$row['name']] = $row['value'];
  } // while
  mysql_free_result($results);

  // Process theme selection if present in URI or in user profile
  if (!empty($_GET['theme'])) {
    $USER['theme'] = $_GET['theme'];
  }
  // Load theme file
  if (isset($USER['theme']) && !strstr($USER['theme'], '/') && is_dir($path_to.'themes/' . $USER['theme'])) {
    $CONFIG['theme'] = strtr($USER['theme'], '$/\\:*?"\'<>|`', '____________');
  } else {
    unset($USER['theme']);
  }

  if (!file_exists($path_to."themes/{$CONFIG['theme']}/theme.php")) $CONFIG['theme'] = 'classic';
  require $path_to."themes/{$CONFIG['theme']}/theme.php";
  require $path_to."include/themes.inc.php";  //All Fallback Theme Templates and Functions
  $THEME_DIR = $path_to."themes/{$CONFIG['theme']}/";

  // Process language selection if present in URI or in user profile or try
  // autodetection if default charset is utf-8
  if (!empty($_GET['lang']))
  {
    $USER['lang'] = ereg("^[a-z0-9_-]*$", $_GET['lang']) ? $_GET['lang'] : $CONFIG['lang'];
  }

  if (isset($USER['lang']) && !strstr($USER['lang'], '/') && file_exists($path_to.'lang/' . $USER['lang'] . '.php'))
  {
    $CONFIG['default_lang'] = $CONFIG['lang'];          // Save default language
    $CONFIG['lang'] = strtr($USER['lang'], '$/\\:*?"\'<>|`', '____________');
  }
  elseif ($CONFIG['charset'] == 'utf-8')
  {
    include($path_to.'include/select_lang.inc.php');
    if (file_exists($path_to.'lang/' . $USER['lang'] . '.php'))
    {
        $CONFIG['default_lang'] = $CONFIG['lang'];      // Save default language
        $CONFIG['lang'] = $USER['lang'];
    }
  }
  else
  {
    unset($USER['lang']);
  }

  if (isset($CONFIG['default_lang']) && ($CONFIG['default_lang']==$CONFIG['lang']))
  {
    unset($CONFIG['default_lang']);
  }

  if (!file_exists($path_to."lang/{$CONFIG['lang']}.php"))
    $CONFIG['lang'] = 'english';

  // We load the chosen language file
  require $path_to."lang/{$CONFIG['lang']}.php";

  // Include and process fallback here if lang <> english
  if($CONFIG['lang'] != 'english' && $CONFIG['language_fallback']==1 ){
    require $path_to."include/langfallback.inc.php";
  }

  // Language file path
  $path_to_plugin_lang = 'lang/';

} else {
  $path_to = '';
  $path_to_plugin_lang = 'plugins/potd/lang/';
}

$CONFIG['path_to'] = $path_to;
$CONFIG['TABLE_PLUGIN_POTD'] = $CONFIG['TABLE_PREFIX'].'plugin_potd';

if (file_exists($path_to_plugin_lang."{$CONFIG['lang']}.php")) {
  require $path_to_plugin_lang."{$CONFIG['lang']}.php";
} else require $path_to_plugin_lang.'english.php';

?>
