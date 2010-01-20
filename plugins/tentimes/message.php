<?php
/**************************************************
  Coppermine 1.5.x Plugin - tentimes
  *************************************************
  Copyright (c) 2010 Timo Schewe (www.timos-welt.de)
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

if (!defined('IN_COPPERMINE')) { 
    die('Not in Coppermine...');
}

if (file_exists("plugins/tentimes/message/{$CONFIG['lang']}.htm")) {
    echo file_get_contents("plugins/tentimes/message/{$CONFIG['lang']}.htm");
}
else
{
    echo file_get_contents('plugins/tentimes/message/english.htm');
}


?>