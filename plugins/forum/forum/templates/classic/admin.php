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