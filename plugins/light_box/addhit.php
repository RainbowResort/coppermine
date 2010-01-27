<?php
define('IN_COPPERMINE', true);

require('include/init.inc.php');

if (isset($_GET['pid'])) {
  // Add 1 to hit counter
  $pid = (int)$_GET['pid'];
  if (!in_array($pid, $USER['liv']) && isset($HTTP_COOKIE_VARS[$CONFIG['cookie_name'] . '_data'])) {
      add_hit($pid);
      if (count($USER['liv']) > 4) array_shift($USER['liv']);
      array_push($USER['liv'], $pid);
      user_save_profile();
  }  
}
?>