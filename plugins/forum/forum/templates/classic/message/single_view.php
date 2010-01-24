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
echo table::tds(array(
    array('class'=>'tableh1', 'width'=>'170px', 'text'=>html::profile_anchor($message['poster_id'], $message['poster_name'])),
    array('class'=>'tableh1', 'text'=>
        html::img($message['icon'], '65%').
        NBSP.
        sprintf(
            Lang::item('topic.topic_title'), 
            html::anchor('forum.php?c=message&m=single&id='.$message['msg_id'],$message['subject']), 
            time::decode($message['time']))
    ),
));
echo table::tds(array(
    array('class'=>'tablef', 'valign'=>'top', 'align'=>'left', 'text'=>
        html::span(sprintf(Lang::item('topic.user_profile'), html::img($message['avatar'], Config::item('fr_avatar_size')), $message['poster_group'], $message['poster_posts'], $message['poster_registed']))
    ),
    array('class'=>'tableb', 'valign'=>'top', 'text'=>
        forum::format_message($message['body']).
        ((trim($message['signature']) != '') ? sprintf(Lang::item('topic.signature'), forum::format_message($message['signature'])) : '')
    ),
));
echo table::tds(array(
    array('class'=>'tablef', 'text'=>
        html::button('profile.php?uid='.$message['poster_id'], Lang::item('topic.profile')).NBSP
        //.(($message['poster_id'] != USER_ID) ? html::button('forum.php?c=pm&m=compose&id='.$message['poster_id'], Lang::item('topic.pm')) : '')
        ),
    array('class'=>'tablef', 'text'=>
        ($authorizer->can_edit_msg($message['msg_id']) ? html::button('forum.php?c=message&m=edit&id='.$message['msg_id'], Lang::item('common.modify')).NBSP : '').
        ($authorizer->can_delete_msg($message['msg_id']) ?
            html::jsbutton("button_confirm('".Lang::item('message.confirm_delete')."','forum.php?c=message&m=delete&id={$message['msg_id']}');", 
        Lang::item('common.delete')) : '')            
    ),
));    
echo table::close();