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

if (count($child_boards) > 0) {
    echo table::open();
    echo table::td(Lang::item('board.child_boards'), 5);
    echo table::tds(array(
        array('class'=>'tableh2', 'align'=>'center', 'text'=>NBSP),
        array('class'=>'tableh2', 'width'=>'60%', 'text'=>html::bold(Lang::item('home.forum_name'))),
        array('class'=>'tableh2', 'width'=>'5%',  'align'=>'center', 'text'=>html::bold(Lang::item('home.topics'))),
        array('class'=>'tableh2', 'width'=>'5%', ' align'=>'center', 'text'=>html::bold(Lang::item('home.replies'))),
        array('class'=>'tableh2', 'width'=>'30%', 'text'=>html::bold(Lang::item('home.l_post_info'))),
    ));
    foreach ($child_boards as $board) {
        echo table::tds(array(
            array('class'=>'tableb', 'align'=>'center', 'text'=>html::img($board['icon'])),
            array('class'=>'tableb', 'valign'=>'top', 'text'=>html::board_anchor($board['id'], $board['name']).'<br />'.($board['description'] ? html::span($board['description']) : '')),
            array('class'=>'tableb', 'align'=>'center', 'text'=>$board['topics']),
            array('class'=>'tableb', 'align'=>'center', 'text'=>$board['replies']),
            array('class'=>'tableb', 'text'=>
                $board['last_post_id'] ? html::span(sprintf(Lang::item('home.last_post_title'), html::category_anchor($board['last_post_id'], $board['last_post_title']), time::decode($board['last_post_time']), html::profile_anchor($board['last_post_author_id'], $board['last_post_author_name']))) : ''
            ),
        ));
        if ($board['childs']) {
            echo table::td(html::span(html::bold(Lang::item('home.child_boards')).forum::child_board_list($board['childs'])), 5, 'tablef');
        }
    }
    echo table::close();
}
echo html::spacer();
// paging
echo table::open();
echo table::tds(array(
    array('class'=>'tableb', 'text'=>
        table::open(2).
        table::tds(array(
            array('width'=>'70%', 'align'=>'left' , 'text'=>Lang::item('board.page').forum::paging($paging)),
            array('width'=>'30%', 'align'=>'right', 'text'=>
                ($authorizer->is_user() ?
                    html::jsbutton(
                        "button_confirm('".($authorizer->is_notify_board($board_id) ? Lang::item('board.disable_notify') : Lang::item('board.active_notify'))."','".($authorizer->is_notify_board($board_id) ? 'forum.php?c=board&m=unnotify&id='.$board_id : 'forum.php?c=board&m=notify&id='.$board_id)."');", Lang::item('board.notify')).NBSP : ''
                ).
                ($authorizer->can_create_topic(board_id) ?
                    html::button('forum.php?c=board&amp;m=newtopic&amp;id='.$board_id,Lang::item('board.new_topic'))
                    : ''
                )
            )
        )).
        table::close()
    ),
));
echo table::close();
// topic listing
echo table::open();
echo table::td(Lang::item('board.topics'), 5);
echo table::tds(array(
    array('class'=>'tableh2', 'width'=>'60%', 'colspan'=>'2', 'text'=>html::bold(Lang::item('board.topic_title'))),
    array('class'=>'tableh2', 'width'=>'5%', 'text'=>html::bold(Lang::item('board.replies'))),
    array('class'=>'tableh2', 'width'=>'5%', 'text'=>html::bold(Lang::item('board.views'))),
    array('class'=>'tableh2', 'width'=>'30%', 'text'=>html::bold(Lang::item('board.latest_post_info'))),

));
foreach ($topics as $topic) {
    $buffer = '';
    $buffer .= table::open(array());
    if (Config::item('fr_msg_icons') == 1) {
        $buffer .= table::tds(array(
            array('text'=>html::img($topic['icon'])),
            array('text'=>NBSP),
            array('text'=>html::topic_anchor($topic['id'], $topic['name'])),
        ));
    } else {
        $buffer .= table::tds(array(
            array('text'=>html::topic_anchor($topic['id'], $topic['name'])),
        ));
    }
    $buffer .= table::close();
    echo table::tds(array(
        array('class'=>'tableb', 'width'=>'0%', 'align'=>'center', 'text'=> html::img($topic['status'])),
        array('class'=>'tableb', 'width'=>'60%', 'align'=>'left', 'valign'=>'middle', 'text'=>$buffer),
        array('class'=>'tableb', 'align'=>'center', 'text'=>$topic['replies']),
        array('class'=>'tableb', 'align'=>'center', 'text'=>$topic['views']),
        array('class'=>'tableb', 'valign'=>'top', 'text'=>
            $topic['last_post_id'] ? html::span(sprintf(Lang::item('home.last_post_title'), html::message_anchor($topic['last_post_id'], $topic['last_post_title']), time::decode($topic['last_post_time']), html::profile_anchor($topic['last_post_author_id'], $topic['last_post_author_name']))) : ''
        ),
    ));
}
if (count($topics) == 0) {
    echo table::td(Lang::item('board.no_topic'), 5, 'tableb');
}
echo table::close();
// paging
echo table::open();
echo table::tds(array(
    array('class'=>'tableb', 'text'=>
        table::open(2).
        table::tds(array(
            array('width'=>'70%', 'align'=>'left' , 'text'=>Lang::item('board.page').forum::paging($paging)),
            array('width'=>'30%', 'align'=>'right', 'text'=>
                ($authorizer->is_user() ?
                    html::jsbutton(
                        "button_confirm('".($authorizer->is_notify_board($board_id) ? Lang::item('board.disable_notify') : Lang::item('board.active_notify'))."','".($authorizer->is_notify_board($board_id) ? 'forum.php?c=board&m=unnotify&id='.$board_id : 'forum.php?c=board&m=notify&id='.$board_id)."');", Lang::item('board.notify')).NBSP : ''
                ).
                ($authorizer->can_create_topic(board_id) ?
                    html::button('forum.php?c=board&amp;m=newtopic&amp;id='.$board_id,Lang::item('board.new_topic'))
                    : ''
                )
            )
        )).
        table::close()
    ),
));
echo table::close();
echo html::spacer();
// legend
echo table::open();
echo table::tds(array(
    array('class'=>'tableh1', 'width'=>'66%', 'text'=>Lang::item('board.legend')),
    array('class'=>'tableh1', 'width'=>'33%', 'text'=>Lang::item('board.jump')),
));
echo table::tds(array(
    array('class'=>'tableb', 'colspan'=>2, 'text'=>
        table::open(2).
        table::tds(array(
            array('class'=>'tableb', 'valign'=>'top', 'width'=>'33%', 'text'=>
                html::img('plugins/forum/forum/html/images/icon_topic.gif').
                Lang::item('board.n_n_m').'<br />'.
                html::img('plugins/forum/forum/html/images/icon_topic_new.gif').
                Lang::item('board.n_m').'<br />'.
                html::img('plugins/forum/forum/html/images/icon_topic_hot.gif').
                sprintf(lang::item('board.h_t'), Config::item('fr_hot_topic_msg')).'<br />'
            ),
            array('class'=>'tableb', 'valign'=>'top', 'width'=>'33%', 'text'=>
                html::img('plugins/forum/forum/html/images/icon_topic_reply.gif').
                Lang::item('board.s_t').'<br />'.
                html::img('plugins/forum/forum/html/images/icon_topic_readonly.gif').
                Lang::item('board.r_o_t').'<br />'
            ),
            array('class'=>'tableb', 'width'=>'33%', 'valign'=>'middle', 'text'=>forum::redirect_box($cbs, $board_id)),
        )).
        table::close()
    ),
));
echo table::close();
