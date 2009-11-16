<?php
/**************************************************
  Coppermine 1.5.x Plugin - EnlargeIt!
  *************************************************
  Copyright (c) 2009 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  Coppermine version: 1.5.2
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
  **************************************************/

define('IN_COPPERMINE', true);

require_once('include/init.inc.php');
require('./plugins/enlargeit/include/init.inc.php');

if (!USER_ID && $CONFIG['allow_unlogged_access'] == 0) {
    $redirect = $redirect . "login.php";
    header("Location: $redirect");
    exit();
}

$pid = $superCage->get->getInt('pid');



echo '<table cellspacing="1" style="width:100%;height:100%">';
echo '<tr>';
echo '<td colspan="2" class="enl_infotablehead" align="center"><a href="index.php?file=enlargeit/enl_download2&pid='.$pid.'" onclick="';

// if IE, Opera or Chrome, open download file in same browser window because they detect 
// that it's a download. else open in new window, cause mozilla needs this to not stop animated GIFs
echo 'if (window.ActiveXObject || window.opera || (navigator.userAgent.toLowerCase().indexOf(\'chrome\') > -1)) ';
echo 'window.location=\'index.php?file=enlargeit/enl_download2&pid='.$pid.'\';else window.open(\'index.php?file=enlargeit/enl_download2&pid='.$pid.'\');';
echo 'return false;';

echo '"><b>'.$lang_enlargeit['enl_clickdownload'].'</a></b><br /></td></tr>';
echo '</table>';

?>