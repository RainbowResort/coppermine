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

echo table::open();
echo table::title(Lang::item('board.topic_preview'), 1);
echo table::tds(array(
    'class' => 'tableh2', 'text'=>$subject,
));
echo table::tds(array(
    'class' => 'tableb', 'text'=>$message,
));
echo table::close();
?>