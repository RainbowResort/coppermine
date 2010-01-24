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
        html::button('forum.php?c=admin&amp;m=setting', Lang::item('admin.setting')).
        NBSP.
        html::button('forum.php?c=admin&amp;m=update', Lang::item('admin.update'))
    ),
));
echo table::close();
// start
echo table::open();
echo table::td(Lang::item('admin.mdf_boards'), 6);
echo table::tds(array(
    array('class'=>'tableh1', 'width'=>'60%', 'text'=>Lang::item('admin.name')),
    array('class'=>'tableh1', 'width'=>'20%', 'colspan'=>'4', 'align'=>'center', 'text'=>Lang::item('admin.operator')),
    array('class'=>'tableh1', 'width'=>'20%', 'align'=>'center', 'text'=>Lang::item('admin.move')),
));
foreach ($cats as $cat) {
    echo table::tds(array(
        array('class'=>'tableh2', 'text'=>html::bold($cat['name'])),
        array('class'=>'tableh2', 'width'=>'5%', 'align'=>'center', 'text'=>$cat['up']),
        array('class'=>'tableh2', 'width'=>'5%', 'align'=>'center', 'text'=>$cat['down']),
        array('class'=>'tableh2', 'width'=>'5%', 'align'=>'center', 'text'=>html::anchor('forum.php?c=admin&amp;m=editcat&amp;id='.$cat['id'], html::img($img['edit']))),
        array('class'=>'tableh2', 'width'=>'5%', 'align'=>'center', 'text'=>html::anchor('forum.php?c=admin&amp;m=delcat&amp;id='.$cat['id'], html::img($img['delete']), array('onclick'=>"return anchor_confirm('".Lang::item('admin.confirm_del_cat')."');"))),
        array('class'=>'tableh2', 'text'=>NBSP),
    ));
    foreach ($cat['boards'] as $board) {
        echo table::tds(array(
            array('class'=>'tableb', 'text'=>forum::indent($board['level']+1).html::bold($board['name'])),
            array('class'=>'tableb', 'width'=>'5%', 'align'=>'center', 'text'=>$board['up']),
            array('class'=>'tableb', 'width'=>'5%', 'align'=>'center', 'text'=>$board['down']),
            array('class'=>'tableb', 'width'=>'5%', 'align'=>'center', 'text'=>html::anchor('forum.php?c=admin&amp;m=editboard&amp;id='.$board['id'], html::img($img['edit']))),
            array('class'=>'tableb', 'width'=>'5%', 'align'=>'center', 'text'=>html::anchor('forum.php?c=admin&amp;m=delboard&amp;id='.$board['id'], html::img($img['delete']), array('onclick'=>"return anchor_confirm('".Lang::item('admin.confirm_del_board')."');"))),
            array('class'=>'tableb', 'text'=>forum::board_move_box($board_move_data, $board['id'], $cat['id'], $board['level'], $board['parent'])),
        ));
    }
    echo table::tds(array(
        array('class'=>'tableb', 'align'=>'right', 'colspan'=>'6', 'text'=>html::button('forum.php?c=admin&amp;m=newboard&amp;id='.$cat['id'], Lang::item('admin.new_board'))),
    ));
}
echo table::close();