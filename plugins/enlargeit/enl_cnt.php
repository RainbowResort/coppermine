<?php
/**************************************************
  Coppermine 1.4.x Plugin - EnlargeIt! $VERSION$=2.15
  *************************************************
  Copyright (c) 2008 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ***************************************************/
  

define("IN_COPPERMINE", true);
require('include/init.inc.php');

if (!USER_ID && $CONFIG['allow_unlogged_access'] == 0) {
    $redirect = $redirect . "login.php";
    header("Location: $redirect");
    exit();
}

if (!GALLERY_ADMIN_MODE) {

/* Init variables */
$enlcnt_pid = '';

/* Get pic id */
if (isset($_GET['a']))
{
$enlcnt_pid = $_GET['a'];

/* Increase pic counter */
$enlcnt_query="UPDATE `".$CONFIG['TABLE_PREFIX']."pictures` SET hits=hits+1 WHERE (pid = '".$enlcnt_pid."')";
cpg_db_query($enlcnt_query);
}
}
?>