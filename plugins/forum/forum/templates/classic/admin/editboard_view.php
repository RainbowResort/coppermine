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
  
// menu
echo table::open(); 
echo table::tds(array(
    array('class'=>'tableb', 'text'=>
        html::button('forum.php?c=admin', Lang::item('admin.home')).
        '&nbsp;'.
        html::button('forum.php?c=admin&amp;m=newcat', Lang::item('admin.new_category')).
        '&nbsp;'.
        html::button('forum.php?c=admin&amp;m=setting', Lang::item('admin.setting'))
    ),
));
echo table::close();
echo table::open();
echo form::open('forum.php?c=admin&m=editboard');
echo form::hidden('id', $board_id);
echo table::td(Lang::item('admin.edit_board'), 2);
if (count($errors) > 0) echo table::td(table::error($errors), 2, 'tableh2');
echo table::tds(array(
    array('class'=>'tableb', 'text'=>Lang::item('admin.fullname')),
    array('class'=>'tableb', 'text'=>form::text('name', $form['name'])),
));
echo table::tds(array(
    array('class'=>'tableb', 'text'=>Lang::item('admin.description')),
    array('class'=>'tableb', 'text'=>form::textarea('description', $form['description'])),
));
echo table::tds(array(
    array('class'=>'tablef', 'colspan'=>'2', 'text'=>form::submit(Lang::item('common.modify'), 'submit')),
));
echo form::close();
echo table::close();