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

// paging
echo table::open();
echo table::tds(array(
    array('class'=>'tableb', 'text' =>
        table::open(2).
        table::tds(array(
            array('width'=>'70%', 'align'=>'left', 'text'=>Lang::item('board.page').forum::paging($paging)),
            array('width'=>'30%', 'align'=>'right', 'text'=>
                (check_model::can_reply($topic_id) ?
                    html::jsbutton('show_section(\'fastreply\');', Lang::item('topic.fast_reply')).
                    NBSP.
                    html::button('forum.php?c=topic&m=reply&id='.$topic_id, Lang::item('topic.reply'))
                    : ''
                ).
                NBSP.
                ($authorizer->is_user() ?
                    html::jsbutton(
                        "button_confirm('".($authorizer->is_notify_topic($topic_id) ? Lang::item('topic.disable_notify') : Lang::item('topic.active_notify'))."','".($authorizer->is_notify_topic($topic_id) ? 'forum.php?c=topic&m=unnotify&id='.$topic_id : 'forum.php?c=topic&m=notify&id='.$topic_id)."');", Lang::item('topic.notify')).NBSP : ''
                )
            ),
        )).
        table::close()
    ),
));
echo table::close();
foreach ($messages as $message) {
    echo "<a name=\"{$message['id']}\"></a>";
    echo table::open();
    echo table::tds(array(
        array('class'=>'tableh1', 'width'=>'170px', 'text'=>html::profile_anchor($message['poster_id'], $message['poster_name'])),
        array('class'=>'tableh1', 'text'=>
            table::open(2).
            table::tds(array(
                array('text'=>
                     html::img($message['icon'], '65%').
                     NBSP.
                     sprintf(
                        Lang::item('topic.topic_title'),
                        html::b(html::anchor('forum.php?c=message&id='.$message['id'],$message['name'])),
                        time::decode($message['time']))
                ),
                array('align'=>'right', 'text'=>html::anchor('forum.php?c=message&m=single&id='.$message['id'], html::b('#'.$message['pos']))),
            )).
            table::close()
        ),
    ));
    echo table::tds(array(
        array('class'=>'tablef', 'valign'=>'top', 'align'=>'left', 'text'=>
            html::span(sprintf(Lang::item('topic.user_profile'), html::img($message['avatar'], Config::item('fr_avatar_size')), $message['poster_group'], $message['poster_posts'], $message['poster_registed']))
        ),
        array('class'=>'tableb', 'valign'=>'top', 'text'=>
            forum::format_message($message['post']).
            ((trim($message['signature']) != '') ? sprintf(Lang::item('topic.signature'), forum::format_message($message['signature'])) : '')
        ),
    ));
    echo table::tds(array(
        array('class'=>'tablef', 'text'=>
            html::button('profile.php?uid='.$message['poster_id'], Lang::item('topic.profile')).NBSP
            //.(($message['poster_id'] != USER_ID) ? html::button('forum.php?c=pm&m=compose&id='.$message['poster_id'], Lang::item('topic.pm')) : '')
            ),
        array('class'=>'tablef', 'text'=>
            (function_exists('get_bbcode_tags') ? html::button('forum.php?c=topic&m=reply&id='.$topic_id.'&quote='.$message['id'], Lang::item('common.quote')).NBSP : '').
            ($authorizer->can_edit_msg($message['id']) ? html::button('forum.php?c=message&m=edit&id='.$message['id'], Lang::item('common.modify')).NBSP : '').
            ($authorizer->can_delete_msg($message['id']) ?
                html::jsbutton("button_confirm('".Lang::item('message.confirm_delete')."','forum.php?c=message&m=delete&id={$message['id']}');",
            Lang::item('common.delete')) : '')
        ),
    ));
    echo table::close();
}
if (count($messages) == 0) {
    echo table::open();
    echo table::td(Lang::item('topic.no_message'), 1, 'tableb');
    echo table::close();
}
// paging
echo table::open();
echo table::tds(array(
    array('class'=>'tableb', 'text' =>
        table::open(2).
        table::tds(array(
            array('width'=>'70%', 'align'=>'left', 'text'=>Lang::item('board.page').forum::paging($paging)),
            array('width'=>'30%', 'align'=>'right', 'text'=>
                (check_model::can_reply($topic_id) ?
                    html::jsbutton('show_section(\'fastreply\');', Lang::item('topic.fast_reply')).
                    NBSP.
                    html::button('forum.php?c=topic&m=reply&id='.$topic_id, Lang::item('topic.reply'))
                    : ''
                ).
                NBSP.
                ($authorizer->is_user() ?
                    html::jsbutton(
                        "button_confirm('".($authorizer->is_notify_topic($topic_id) ? Lang::item('topic.disable_notify') : Lang::item('topic.active_notify'))."','".($authorizer->is_notify_topic($topic_id) ? 'forum.php?c=topic&m=unnotify&id='.$topic_id : 'forum.php?c=topic&m=notify&id='.$topic_id)."');", Lang::item('topic.notify')).NBSP : ''
                )
            ),
        )).
        table::close()
    ),
));
echo html::spacer();
echo table::open();
echo table::tds(array(
    array('class'=>'tableb', 'text'=>
        table::open(2).
        table::tds(array(
            array('width'=>'66%', 'text'=>
                ($authorizer->can_moderator_topic($topic_id) ?
                    html::button('forum.php?c=topic&m=locked&id='.$topic_id,
                ($authorizer->is_locked($topic_id) ? Lang::item('topic.unlock_topic') : Lang::item('topic.lock_topic'))).NBSP : '').
                ($authorizer->can_moderator_topic($topic_id) ?
                    html::button('forum.php?c=topic&m=sticky&id='.$topic_id,
                ($authorizer->is_sticky($topic_id) ? Lang::item('topic.unsticky_topic') : Lang::item('topic.sticky_topic'))).NBSP : '').
                ($authorizer->can_moderator_topic($topic_id) ?
                    html::jsbutton("button_confirm('".Lang::item('topic.confirm_delete')."','forum.php?c=topic&m=delete&id={$topic_id}');", Lang::item('topic.delete_topic')).NBSP : '').
                ($authorizer->can_moderator_topic($topic_id) ?
                    html::button('forum.php?c=topic&m=move&id='.$topic_id, Lang::item('topic.move_topic')) : '')
            ),
            array('width'=>'33%', 'align'=>'right', 'text'=>forum::redirect_box($cbs, $board_id)),
        )).
        table::close()
    ),
));
echo table::close();
echo "<div id=\"fastreply\" style=\"display: none;\">";
echo table::open();
echo form::open('forum.php?c=topic&m=reply&id='.$topic_id, 'fastreply', 'post');
echo table::td(Lang::item('topic.topic_reply'), 4);
echo table::tds(array(
    array('class'=>'tableb', 'width'=>'30%', 'text'=>Lang::item('topic.subject')),
    array('class'=>'tableb', 'width'=>'70%', 'text'=>form::text('subject', Lang::item('topic.re').$topic_name)),
));
if (Config::item('fr_msg_icons') == 1) {
    echo table::tds(array(
        array('class'=>'tableb', 'text'=>Lang::item('topic.message_icon')),
        array('class'=>'tableb', 'text'=>forum::generate_message_icons('icon', $icons, 'icon1')),
    ));
}
echo table::tds(array(
    array('class'=>'tableb', 'text'=>NBSP),
    array('class'=>'tableb', 'text'=>forum::generate_bbcode_tags('fastreply', 'body')),
));
echo table::tds(array(
    array('class'=>'tableb', 'text'=>Lang::item('topic.message')),
    array('class'=>'tableb', 'text'=>form::textarea('body')),
));
echo table::tds(array(
    array('class'=>'tableb', 'text'=>NBSP),
    array('class'=>'tableb', 'text'=>generate_smilies('fastreply', 'body')),
));
echo table::tds(array(
    array('class'=>'tablef', 'text'=>NBSP),
    array('class'=>'tablef', 'text'=>
        form::submit(Lang::item('common.reply'), 'submit')
    ),
));
echo form::close();
echo table::close();
echo "</div>";
