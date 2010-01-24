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

print table::open();
print form::open('forum.php?c=topic&amp;m=move&amp;id='.$topic_id);
print table::td(Lang::item('topic.move_topic'), 2);
print table::tds(array(
    array('class'=>'tableb', 'width'=>'30%', 'text'=>Lang::item('topic.topic_name')),
    array('class'=>'tableb', 'width'=>'70%', 'text'=>$topic['name']),
));
print table::tds(array(
    array('class'=>'tableb', 'width'=>'30%', 'text'=>Lang::item('topic.move_to')),
    array('class'=>'tableb', 'text'=>forum::topic_move_box($topic_move_data, $topic['board_id'])),
));
print table::tds(array(
    array('class'=>'tablef', 'colspan'=>2, 'text'=>
        form::submit(Lang::item('common.move'), 'submit'),
    ),
));
print form::close();
print table::close();