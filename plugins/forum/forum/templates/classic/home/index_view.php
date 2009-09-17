<?php
if ($authorizer->is_user()) {
    echo table::open(0);
    echo table::tds(array(
        array('align'=>'left', 'text'=>
            forum::seperate(array(
                //html::anchor('forum.php?c=home&amp;m=mark_all_read',    html::bold(Lang::item('home.mark_as_read'))),
                html::anchor('forum.php?c=search&amp;m=new_topics',     Lang::item('home.new_topcis')),
                html::anchor('forum.php?c=search&amp;m=active_topics',  Lang::item('home.active_topcis')),
                html::anchor('forum.php?c=search&amp;m=pending_topics', Lang::item('home.pending_topcis'))
            ))
        ),
        array('align'=>'right', 'text'=>sprintf(Lang::item('home.user_q_stats'), $user_posts, $last_visit)),
    ));
    echo table::close();
}
foreach ($categories as $k => $category) {
    echo table::open();
    echo table::td(html::category_anchor($category['id'], $category['name']), 5);
    echo table::tds(array(
        array('class'=>'tableh2', 'width'=>'0%', 'align'=>'center', 'text'=>'&nbsp;'),
        array('class'=>'tableh2', 'width'=>'60%', 'text'=>html::bold(Lang::item('home.forum_name'))),
        array('class'=>'tableh2', 'width'=>'5%',' align'=>'center', 'text'=>html::bold(Lang::item('home.topics'))),
        array('class'=>'tableh2', 'width'=>'5%',' align'=>'center', 'text'=>html::bold(Lang::item('home.replies'))),
        array('class'=>'tableh2', 'width'=>'30%', 'text'=>html::bold(Lang::item('home.l_post_info'))),
    ));
    foreach ($category['boards'] as $board) {
        echo table::tds(array(
            array('class'=>'tableb', 'align'=>'center', 'text'=>html::img($board['icon'])),
            array('class'=>'tableb', 'valign'=>'top', 'text'=>html::board_anchor($board['id'], $board['name']).'<br />'.($board['description'] ? html::span($board['description']) : '')),
            array('class'=>'tableb', 'align'=>'center', 'text'=>$board['topics']),
            array('class'=>'tableb', 'align'=>'center', 'text'=>$board['replies']),
            array('class'=>'tableb', 'text'=>($board['last_post_title'] ? html::span(sprintf(Lang::item('home.last_post_title'), html::message_anchor($board['last_post_id'], $board['last_post_title']), time::decode($board['last_post_time']), html::profile_anchor($board['last_post_author_id'], $board['last_post_author_name']))) : '')),
        ));
        if ($board['childs']) {
            echo table::td(html::span(html::bold(Lang::item('home.child_boards')).forum::child_board_list($board['childs'])), 5, 'tablef');
        }
    }
    if (count($category['boards']) == 0) {
        echo table::td(Lang::item('home.no_board'), 5, 'tableb');
    }
    echo table::close();
    echo html::spacer();
}
echo table::open(0);
echo table::tds(array('text'=>
    html::img('plugins/forum/forum/html/images/icon_board_new.gif').
    html::span(Lang::item('home.new_posts')).
    html::img('plugins/forum/forum/html/images/icon_board.gif').
    html::span(Lang::item('home.no_new_posts'))
));
echo table::close();
echo table::open();
echo table::td(Lang::item('home.latest_posts'), 2);
foreach ($recents as $recent) {
    echo table::tds(array(
        array('class'=>'tableb', 'text'=> 
            table::open(2).
            table::tds(array(
                array('text'=>sprintf(Lang::item('home.latest_post'), html::message_anchor($recent['msg_id'], $recent['subject']), html::profile_anchor($recent['poster_id'], $recent['poster_name']))),
                array('align'=>'right', 'text'=>time::decode($recent['poster_time'])),
            )).
            table::close()
        ),
    ));
}
echo table::close();
// left
$left_table = '';
$left_table .= table::open(3);
$left_table .= table::td(Lang::item('home.visitor_stats'), 4);
$left_table .= table::tds(array(
    array('class'=>'tableb', 'text'=>Lang::item('home.t_r_m')),
    array('class'=>'tableb', 'text'=>$stats['t_r_m']),
    array('class'=>'tableb', 'text'=>Lang::item('home.t_li_u')),
    array('class'=>'tableb', 'text'=>$stats['t_li_u']),
));
$left_table .= table::tds(array(
    array('class'=>'tableb', 'text'=>Lang::item('home.t_t')),
    array('class'=>'tableb', 'text'=>$stats['t_t']),
    array('class'=>'tableb', 'text'=>Lang::item('home.t_a_u')),
    array('class'=>'tableb', 'text'=>$stats['t_a_u']),
));
$left_table .= table::tds(array(
    array('class'=>'tableb', 'text'=>Lang::item('home.t_r')),
    array('class'=>'tableb', 'text'=>$stats['t_r']),
    array('class'=>'tableb', 'text'=>'&nbsp;'),
    array('class'=>'tableb', 'text'=>'&nbsp;'),
));
$left_table .= table::close();
// right
foreach ($newest_members as $k => $v) {
    $newest_members[$k] = html::profile_anchor($v['user_id'], $v['user_name']);
} $newest_members = implode(', ', $newest_members);
foreach ($active_members as $k => $v) {
    $active_members[$k] = html::profile_anchor($v['user_id'], $v['user_name']);
} $active_members = implode(', ', $active_members);
$right_table = '';
$right_table .= table::open(3);
$right_table .= table::td(Lang::item('home.members'));
$right_table .= table::tds(array(
    'class'=>'tableb', 'text'=>Lang::item('home.newest_members').$newest_members,
));
$right_table .= table::tds(array(
    'class'=>'tableb', 'text'=>Lang::item('home.active_members').$active_members,
));
$right_table .= table::close();
echo table::open(array('align'=>'center','width'=>-1,'border'=>0,'cellspacing'=>1,'cellpadding'=>0));
echo table::tds(array(
    array('width'=>'50%', 'valign'=>'top', 'text'=>$left_table),
    array('width'=>'50%', 'valign'=>'top', 'text'=>$right_table),
));
echo table::close();