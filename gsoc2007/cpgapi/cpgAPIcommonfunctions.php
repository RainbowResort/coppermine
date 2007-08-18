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
   var $htmlSubst = array('&' => '&amp;', '"' => '&quot;', '<' => '&lt;', '>' => '&gt;', '%26' => '&amp;', '%22' => '&quot;', '%3C' => '&lt;', '%3E' => '&gt;','%27' => '&#39;', "'" => '&#39;');

  function printMessage($msg) {
  	 print "<messagecode>" . $msg . "</messagecode>";
  }

  function typeCheck($variablename, $val) {
  	global $ALLVARS;
  	if (!isset($ALLVARS[$variablename])) {  	
  	   return $val;
  	}
  	switch($ALLVARS[$variablename][0]) {
  		case 'integer':
			if (!is_numeric($val) || !(strpos($val, '.')===false)) {
  			   $val = $ALLVARS[$variablename][1];
			}   		
  		case 'natural':
			if (!is_numeric($val) || !(strpos($val, '.')===false) || $val < 1) {
  			   $val = $ALLVARS[$variablename][1];
			}   		
  		case 'naturalWith0':
			if (!is_numeric($val) || !(strpos($val, '.')===false) || $val < 0) {
  			   $val = $ALLVARS[$variablename][1];
			}   		
  		case 'float':
			if (!is_numeric($val)) {
  			   $val = $ALLVARS[$variablename][1];
			}   		
  		case 'string':
  			break;
  		
  		case 'booleanString':
  			if ($val!="YES" && $val!="NO") {
  				$val = $ALLVARS[$variablename][1]; 
  			}
  		
  		default:
  		   		
  	}
  	return $val;
  }

  /**
   * Get the variable from get or post data for install (no check)
   * @ variablename : the name of the variable requested
   */
  function getuncheckedvariable($variablename) {
  	global $ALLVARS;
  	$val = "";
    if(isset($_POST[$variablename])) 
      $val = addslashes($_POST[$variablename]);
    if(isset($_GET[$variablename])) 
      $val = addslashes($_GET[$variablename]);
    $val = $this->typeCheck($variablename, $val);
    return $val;
  }

  /**
   * Get the variable from get or post data
   * @ variablename : the name of the variable requested
   */
  function getvariable($variablename) {
    global $CONFIG, $ALLVARS;
    $val = "";
    if(isset($_POST[$variablename])) 
      $val = addslashes($_POST[$variablename]);
    if($CONFIG['allow_get_api'] && isset($_GET[$variablename])) 
      $val = addslashes($_GET[$variablename]);
    $val = $this->typeCheck($variablename, $val);
    return $val;
  }

  /**
   * Checks if the variable is in get or post data
   * @ variablename : the name of the variable requested
   */
  function checkvariable($variablename) {
    global $CONFIG;
    if(isset($_POST[$variablename])) 
      return true;
    if($CONFIG['allow_get_api'] && isset($_GET[$variablename])) 
      return true;
    return false;
  }

  function showheader() {
    print "<?xml version=\"1.0\" encoding=\"ISO-8859-1\" ?>\n";
    print "<catalog>";
  }

  function showfooter() {
    print "</catalog>";
  }

  function unsafeexit($code) {
    global $DBS, $IS_HEADER;
    if($DBS->dbactive) $DBS->sql_disconnect();
    if(!$IS_HEADER) $this->showheader();
    $this->printMessage($code);
    $this->showfooter();
    exit(1);
  }

  function safeexit($code) {
    global $DBS, $IS_HEADER;
    if($DBS->dbactive) $DBS->sql_disconnect();
    if(!$IS_HEADER) $this->showheader();
    if($code) $this->printMessage($code); 
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