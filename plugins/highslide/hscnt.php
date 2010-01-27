<?php
/**************************************************
  Coppermine 1.4.x Plugin - HighSlide v 3.04 - Counter Script
  This file must be moved to gallery root!
  *************************************************
  Copyright (c) 2007-2008 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  *************************************************
  Skip Intermediate Page and show full page on the page
  Based on Highslide JS @ http://vikjavev.no/highslide/ 
  ***************************************************/
define("IN_COPPERMINE", true);
require('include/init.inc.php');

/* Init variables */
$hsbrowser = '';
$hsap = '';
$hspn = '';
$hsno = '';
$hspp = '';

/* Get info about image URL out of own URL */
$hsap = $_GET['a'];
$hspn = $_GET['p'];
$hsno = $_GET['n'];

/* Build picture URL $hspp */
if ($hsno == '1') {
	$hspp = 'albums/'.$hsap.$CONFIG['normal_pfx'].$hspn;
} else {
	$hspp = 'albums/'.$hsap.$hspn;
}

/* Send browser to real image */
   @ header ("HTTP/1.1 301 Moved Permanently");
   @ header ("Location: ".$hspp);  

/* Check if Opera browser */
 $hsbrowser = ( isset( $_SERVER['HTTP_USER_AGENT'] ) ) ? strtolower( $_SERVER['HTTP_USER_AGENT'] ) : '';
 if (stristr($hsbrowser, "opera")) {
  	 /* Do nothing if Opera detected */
 } 
 else
 {
    /* If not in Opera: Query CPG table 'pictures' for picture ID */
 	  $query="SELECT * FROM `".$CONFIG['TABLE_PREFIX']."pictures` WHERE (filename = '".$hspn."' AND filepath = '".$hsap."')";
    $hsresult=cpg_db_query($query);
    
    /* Get picture ID $hspid out of array */
    $hsrowresult=mysql_fetch_array($hsresult);
    $hspid=$hsrowresult['pid'];

    /* Increase picture counter for picture ID */
    $query="UPDATE `".$CONFIG['TABLE_PREFIX']."pictures` SET hits=hits+1 WHERE pid=".$hspid;
    cpg_db_query($query);
 }
?>