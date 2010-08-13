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
echo form::open('forum.php?c=admin&m=setting');
echo table::td('Forum Setting', 2);
if (count($errors) > 0) {
    echo table::tds(array(
        array('class'=>'tableh2', 'colspan'=>'2', 'text'=>table::error($errors)),
    ));
}
echo table::td(html::b(Lang::item('admin.basic_features')), 2, 'tableh2');
echo table::tds(array(
    array('class'=>'tableb', 'width'=>'50%', 'text'=>Lang::item('admin.title')),
    array('class'=>'tableb', 'width'=>'50%', 'text'=>form::text('fr_title', Config::item('fr_title'))),
));
echo table::tds(array(
    array('class'=>'tableb', 'width'=>'50%', 'text'=>Lang::item('admin.allow_guest_browse')),
    array('class'=>'tableb', 'width'=>'50%', 'text'=>form::yesno('fr_guest_browse', Config::item('fr_guest_browse'))),
));
echo table::tds(array(
    array('class'=>'tableb', 'width'=>'50%', 'text'=>Lang::item('admin.allow_guest_post')),
    array('class'=>'tableb', 'width'=>'50%', 'text'=>form::yesno('fr_guest_post', Config::item('fr_guest_post'))),
));
echo table::tds(array(
    array('class'=>'tableb', 'width'=>'50%', 'text'=>Lang::item('admin.enable_message_icons')),
    array('class'=>'tableb', 'width'=>'50%', 'text'=>form::yesno('fr_msg_icons', Config::item('fr_msg_icons'))),
));
echo table::tds(array(
    array('class'=>'tableb', 'width'=>'50%', 'text'=>Lang::item('admin.time_online_checking')),
    array('class'=>'tableb', 'width'=>'50%', 'text'=>form::text('fr_time_online_checking', Config::item('fr_time_online_checking'))),
));
echo table::td(html::b(Lang::item('admin.topic_features')), 2, 'tableh2');
echo table::tds(array(
    array('class'=>'tableb', 'width'=>'50%', 'text'=>Lang::item('admin.topic_per_page')),
    array('class'=>'tableb', 'width'=>'50%', 'text'=>form::text('fr_topic_per_page', Config::item('fr_topic_per_page'))),
));
echo table::tds(array(
    array('class'=>'tableb', 'width'=>'50%', 'text'=>Lang::item('admin.hot_topic_msg')),
    array('class'=>'tableb', 'width'=>'50%', 'text'=>form::text('fr_hot_topic_msg', Config::item('fr_hot_topic_msg'))),
));
echo table::td(html::b(Lang::item('admin.message_features')), 2, 'tableh2');
echo table::tds(array(
    array('class'=>'tableb', 'width'=>'50%', 'text'=>Lang::item('admin.msg_per_page')),
    array('class'=>'tableb', 'width'=>'50%', 'text'=>form::text('fr_msg_per_page', Config::item('fr_msg_per_page'))),
));
echo table::tds(array(
    array('class'=>'tableb', 'width'=>'50%', 'text'=>Lang::item('admin.max_msg_size')),
    array('class'=>'tableb', 'width'=>'50%', 'text'=>form::text('fr_msg_max_size', Config::item('fr_msg_max_size'))),
));

echo table::tds(array(
    array('class'=>'tableb', 'width'=>'50%', 'text'=>Lang::item('admin.max_word_length')),
    array('class'=>'tableb', 'width'=>'50%', 'text'=>form::text('fr_max_word_length', Config::item('fr_max_word_length'))),
));
echo table::tds(array(
    array('class'=>'tableb', 'width'=>'50%', 'text'=>Lang::item('admin.gap_time')),
    array('class'=>'tableb', 'width'=>'50%', 'text'=>form::text('fr_gap_time', Config::item('fr_gap_time'))),
));
echo table::td(html::b(Lang::item('admin.profile_features')), 2, 'tableh2'); 
echo table::tds(array(
    array('class'=>'tableb', 'width'=>'50%', 'text'=>Lang::item('admin.avatar_size')),
    array('class'=>'tableb', 'width'=>'50%', 'text'=>form::text('fr_avatar_size', Config::item('fr_avatar_size'))),
));
echo table::tds(array(
    array('class'=>'tableb', 'width'=>'50%', 'text'=>Lang::item('admin.signature_max_size')),
    array('class'=>'tableb', 'width'=>'50%', 'text'=>form::text('fr_signature_max_size', Config::item('fr_signature_max_size'))),
));
echo table::tds(array(
    array('class'=>'tablef', 'colspan'=>'2', 'text'=>
        form::submit(Lang::item('common.modify'), 'submit').
        form::reset(Lang::item('common.reset'), 'reset')
    ),
));

echo form::close();
echo table::close();