<?php
pageheader($fr_title ? $fr_title : Config::item('fr_title'));
print html::spacer();
print table::open(0);
print table::tds(array(
    array('text' =>$fr_title ? $fr_title : Config::item('fr_title')),
    array('align'=>'right', 'text'=>
        ($authorizer->is_user() ? html::button('forum.php?c=profile', Lang::item('home.fr_profile')) : '').
        NBSP.
        html::button('forum.php?c=search', Lang::item('home.search'))
    ),
));
print table::close();
print html::spacer();
print table::open();
print form::hidden('c','search');
print table::tds(array(
    array('class'=>'tableb', 'text'=>html::span(forum::nagavitor($nagavitor))),
));
print table::close();
print html::spacer();
print $fr_contents;
pagefooter();