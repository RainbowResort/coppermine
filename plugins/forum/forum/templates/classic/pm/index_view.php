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

// left
$left = '';
$left .= table::open();
$left .= table::tds(array(
    array('class'=>'tableh1','text'=>html::anchor('forum.php', 'Message')),
));
$left .= table::tds(array(
    array('class'=>'tableb','text'=>'New message'),
));
$left .= table::tds(array(
    array('class'=>'tableb','text'=>'Inbox'),
));
$left .= table::tds(array(
    array('class'=>'tableb','text'=>'Outbox'),
));
$left .= table::close();
// right
// stats table
$right .= table::open();
$right .= table::tds(array(
    array('class'=>'tableh1', 'width'=>'5%', 'text'=>NBSP),
    array('class'=>'tableh1', 'width'=>'30%', 'text'=>'Date'),
    array('class'=>'tableh1', 'width'=>'30%', 'text'=>'Subject'),
    array('class'=>'tableh1', 'width'=>'30%', 'text'=>'Form'),
    array('class'=>'tableh1', 'width'=>'5%', 'align'=>'center','text'=>form::checkbox('selectall')),
));
$right .= table::tds(array(
    array('class'=>'tableh2', 'colspan'=>5, 'text'=>
        '<div style="float: left;">Page:</div>'.   
        '<div style="float: right;">Page:</div>'
    ),
));
$right .= table::close();
$right .= table::open();
foreach ($pms as $key => $pm) {
    
    
    
    
}
$right .= table::close();
// display table 
echo table::open(0);
echo table::tds(array(
    array('width'=>'150px', 'valign'=>'top', 'text'=>$left),
    array('valign'=>'top', 'text'=>$right),
));
echo table::close();