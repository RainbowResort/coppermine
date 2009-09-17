<?php
// topic listing
echo table::open();
echo table::td(Lang::item('search.search_result'), 5);
echo table::tds(array(
    array('class'=>'tableb', 'colspan'=>5, 'text'=>sprintf(Lang::item('search.found'), $paging['total'])),
));
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
    $buffer .= table::tds(array(
        array('text'=>html::img($topic['icon'])),
        array('text'=>NBSP),
        array('text'=>html::topic_anchor($topic['id'], $topic['name'])),    
    ));    
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
            array('align'=>'left' , 'text'=>Lang::item('board.page').forum::paging($paging)),
        )).
        table::close()    
    ),
));









?>