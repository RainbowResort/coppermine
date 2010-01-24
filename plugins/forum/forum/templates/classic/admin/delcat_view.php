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
        NBSP.
        html::button('forum.php?c=admin&amp;m=newcat', Lang::item('admin.new_category')).
        NBSP.
        html::button('forum.php?c=admin&amp;m=setting', Lang::item('admin.setting'))
    ),
));
echo table::close();
echo table::open();
echo form::open('forum.php?c=admin&m=delcat');
echo form::hidden('id', $cat_id);
echo table::td(Lang::item('admin.del_cat'), 1);
if (count($errors) > 0) echo table::td(table::error($errors), 1, 'tableh2');
echo table::tds(array(
    array('class'=>'tableb', 'width'=>'22%', 'text'=>Lang::item('admin.delcat_text').form::select('move_cat_id', $cats, '', false)),
));
echo table::tds(array(
    array('class'=>'tablef', 'colspan'=>'1', 'text'=>form::submit(Lang::item('common.delete'), 'submit')),
));
echo form::close();
echo table::close();