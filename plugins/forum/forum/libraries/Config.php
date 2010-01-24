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

class Config {
    function item($item) {
        static $instance = array();
        if (empty($instance['config'])) {
            global $CONFIG;
            $instance['config'] = & $CONFIG;
        }
        return $instance['config'][$item];
    }
    function set($item, $value) {
        global $CONFIG;
        $CONFIG[$item] = $value;
    }
}