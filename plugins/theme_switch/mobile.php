<?php
/**************************************************
  Coppermine 1.5.x Plugin - Theme switch
  *************************************************
  Copyright (c) 2010-2012 eenemeenemuu
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**************************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

setcookie($CONFIG['cookie_name'].'_mobile_theme', '', time() - CPG_WEEK, $CONFIG['cookie_path']);

header('Location: '.urldecode($superCage->get->getRaw('ref')));

?>