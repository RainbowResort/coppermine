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
echo form::open('forum.php?c=profile&amp;id='.$user['user_id'], 'profile', 'post', TRUE);
echo table::td(Lang::item('profile.profile_title'), 4);
echo table::td(Lang::item('profile.avatar'), 4, 'tableh2');
echo table::tds(array(
    array('class'=>'tableb', 'width'=>'5%', 'align'=> 'center', 'text'=>form::radio('avatar_type', 'url', '', $user['fr_avatar'] ? 'url' : '')),
    array('class'=>'tableb', 'width'=>'20%', 'text'=>Lang::item('profile.url')),
    array('class'=>'tableb', 'width'=>'50%', 'text'=>form::text('fr_avatar_url', $user['fr_avatar'])),
    array('class'=>'tableb', 'width'=>'25%', 'align'=> 'center', 'rowspan'=>2, 'text'=>
        (!php::is_empty_string($user['fr_avatar']) ?
            html::img($user['fr_avatar'], Config::item('fr_avatar_size')).
            BR.BR.
            html::button('forum.php?c=profile&m=remove_avatar', Lang::item('profile.remove_avatar'))
            : ''
        )
    ),
));
echo table::tds(array(
    array('class'=>'tableb', 'align'=> 'center', 'text'=>form::radio('avatar_type', 'file')),
    array('class'=>'tableb', 'text'=>Lang::item('profile.file')),
    array('class'=>'tableb', 'text'=>form::file('fr_avatar_file')),
));
echo table::td(Lang::item('profile.profile'), 4, 'tableh2');
echo table::tds(array(
    array('class'=>'tableb', 'colspan'=>2, 'rowspan'=> 3, 'text'=>Lang::item('profile.signature')),
    array('class'=>'tableb', 'colspan'=>2, 'text'=>forum::generate_bbcode_tags('profile', 'fr_signature')),
));
echo table::tds(array(
    array('class'=>'tableb', 'colspan'=>2, 'align'=> 'center', 'text'=>form::textarea('fr_signature', $user['fr_signature'])),
));
echo table::tds(array(
    array('class'=>'tableb', 'colspan'=>2, 'text'=>generate_smilies('profile', 'fr_signature')),
));
echo table::tds(array(
    array('class'=>'tablef', 'colspan'=>4, 'text'=>form::submit(Lang::item('common.change'), 'submit')),
));
echo form::close();
echo table::close();