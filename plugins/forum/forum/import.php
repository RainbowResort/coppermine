<?php
/**************************************************
  Coppermine 1.5.x Plugin - forum
  *************************************************
  Copyright (c) 2010 foulu (Le Hoai Phuong), eenemeenemuu
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

// very important so it go first
include(BASE_DIR.'plugins'.DS.'forum'.DS.'forum'.DS.'libraries'.DS.'Config.php');
// load some config data
include(BASE_DIR.'plugins'.DS.'forum'.DS.'forum'.DS.'config.php');
include(BASE_DIR.'plugins'.DS.'forum'.DS.'forum'.DS.'loader.php');
include(BASE_DIR.'plugins'.DS.'forum'.DS.'forum'.DS.'version.php');
// load libs
include(BASE_DIR.'plugins'.DS.'forum'.DS.'forum'.DS.'libraries'.DS.'Lang.php');
include(BASE_DIR.'plugins'.DS.'forum'.DS.'forum'.DS.'libraries'.DS.'Database.php');
include(BASE_DIR.'plugins'.DS.'forum'.DS.'forum'.DS.'libraries'.DS.'Model.php');
include(BASE_DIR.'plugins'.DS.'forum'.DS.'forum'.DS.'libraries'.DS.'View.php');
include(BASE_DIR.'plugins'.DS.'forum'.DS.'forum'.DS.'libraries'.DS.'Controller.php');
