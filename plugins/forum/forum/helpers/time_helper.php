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

class time {
    function decode($time, $code = null) {
        global $CONFIG;
        if ($CONFIG['lang'] == "german") {
            $last_msg_date_fmt = '%d.%m.%Y %H:%M';
        } else {
            $last_msg_date_fmt = '%b %d, %Y, %H:%M:%S %p';
        }
        $registed_date_fmt = "%b %d, %Y";
        if ($code !== null) {
            return localised_date($time, $code);
        } else {
            return localised_date($time, $last_msg_date_fmt);
        }
    }
}


