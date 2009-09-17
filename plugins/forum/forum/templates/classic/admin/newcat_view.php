<?php
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
echo form::open('forum.php?c=admin&m=newcat');
echo table::td(Lang::item('admin.new_cat'), 2);
if (count($errors) > 0) echo table::td(table::error($errors), 2, 'tableh2');
echo table::tds(array(
    array('class'=>'tableb', 'width'=>'22%', 'text'=>Lang::item('admin.order')),
    array('class'=>'tableb', 'width'=>'78%', 'text'=>form::select('cat_order', $orders, $form['cat_order'])),
));
echo table::tds(array(
    array('class'=>'tableb', 'text'=>Lang::item('admin.fullname')),
    array('class'=>'tableb', 'text'=>form::text('name', $form['name'])),
));
echo table::tds(array(
    array('class'=>'tablef', 'colspan'=>'2', 'text'=>form::submit(Lang::item('common.add'), 'submit')),
));
echo form::close();
echo table::close();