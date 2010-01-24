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

// start
pageheader($fr_title);
// forum header
echo html::spacer();
echo table::open(0);
echo table::tds(array(
    array('text' =>Config::item('fr_title')),
    array('align'=>'right', 'text'=>
        ($authorizer->is_user() ? html::button('forum.php?c=profile', Lang::item('home.fr_profile')) : '').
        NBSP.
        html::button('forum.php?c=search', Lang::item('home.search'))
    ),
));
echo table::close();
echo html::spacer();
echo table::open();
echo form::open('forum.php', 'search', 'get');
echo form::hidden('c','search');
echo table::tds(array(
    array('class'=>'tableb', 'text'=>
        table::open(2).
        table::tds(array(
            array('text'=>html::span(forum::nagavitor($nagavitor))),
            array('align'=>'right', 'text'=>
                Lang::item('home.dosearch').
                form::text('search', '', false).
                form::submit(Lang::item('home.submit_search'), 'submit').
                html::anchor('forum.php?c=search', Lang::item('home.adv_search')) 
            ),
        )).
        table::close()
    ),
));
echo form::close();
echo table::close();
echo html::spacer();
// forum body
echo $fr_contents;
// end
pagefooter();