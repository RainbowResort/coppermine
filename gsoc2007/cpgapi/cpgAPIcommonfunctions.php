<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2007 Coppermine Dev Team
  v0.1 originally written by Nitin Gupta

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  ********************************************
  Coppermine version: 1.5.0
  $HeadURL$
  $Revision: 2 $
  $LastChangedBy: xnitingupta $
  $Date: 6:01 PM 6/1/2007 $
**********************************************/

/**
 * Class specifying the common functions
 */
class commonfunctions {
  /**
   * Get the variable from get or post data
   * @ variablename : the name of the variable requested
   */
  function getvariable($variablename) {
    global $_POST, $_GET;
    if(isset($_POST[$variablename])) 
      return addslashes($_POST[$variablename]);
    if(isset($_GET[$variablename])) 
      return addslashes($_GET[$variablename]);
    return "";
  }

  function showheader() {
    print "<?xml version=\"1.0\" encoding=\"ISO-8859-1\" ?>\n";
    print "<catalog>\n";
  }

  function showfooter() {
    print "</catalog>\n";
  }

  function unsafeexit($code, $error) {
    global $DBS, $DISPLAY;
    if($DBS->dbactive) $DBS->sql_disconnect();
    print "<messagecode>{$DISPLAY->messagecode[$code]}</messagecode>\n";
    print "<message>{$error}</message>\n";
    $this->showfooter();
    exit(1);
  }

  function safeexit() {
    global $DBS;
    if($DBS->dbactive) $DBS->sql_disconnect();
    $this->showfooter();
    exit(0);
  }


  function str_makerand ($minlength, $maxlength, $useupper, $usespecial, $usenumbers) 
  { 
    $charset = "abcdefghijklmnopqrstuvwxyz"; 
    if ($useupper)   $charset .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
    if ($usenumbers) $charset .= "0123456789"; 
    if ($usespecial) $charset .= "~@#$%^*()_+-={}|][";   // Note: using all special characters this reads: "~!@#$%^&*()_+`-={}|\\]?[\":;'><,./"; 
    if ($minlength > $maxlength) $length = mt_rand ($maxlength, $minlength); 
    else                         $length = mt_rand ($minlength, $maxlength); 
    $key = "";
    for ($i=0; $i<$length; $i++) $key .= $charset[(mt_rand(0,(strlen($charset)-1)))]; 
    return $key; 
  }

}

?>