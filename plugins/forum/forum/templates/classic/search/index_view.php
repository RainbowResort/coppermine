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
echo form::open('forum.php?c=search','search','get');
echo form::hidden('c', Config::item('c'));
echo table::td(Lang::item('search.search'), 2);
echo table::tds(array(
    array('class'=>'tableb','width'=>'30%','text'=>Lang::item('search.search')),
    array('class'=>'tableb','width'=>'70%','text'=>form::text('search', $search)),
));
echo table::tds(array(
    array('class'=>'tablef', 'colspan'=>2, 'text'=>form::submit(Lang::item('common.search'), 'submit')),
));
echo form::close();
echo table::close();
if (count($messages) > 0) {
    echo html::spacer();
    // paging
    echo table::open();
    echo table::td(Lang::item('search.search_result').' - '.sprintf(Lang::item('search.found'), $results));
    echo table::tds(array(
        array('class'=>'tableb', 'text'=>Lang::item('board.page').forum::paging($paging)),
    ));
    echo table::close();
    foreach ($messages as $message) {
        echo table::open();
        echo table::tds(array(
            array('class'=>'tableh1', 'text'=>
                table::open(2).
                table::tds(array(
                    array('align'=>'left', 'width'=>'70%','text'=>
                        forum::nagavitor($message['linkto'], '-->')
                    ),
                    array('align'=>'right', 'width'=>'30%', 'text'=>
                        Lang::item('search.on').
                        time::decode($message['poster_time'])
                    ),
                )).
                table::close()
            )
        ));
        echo table::tds(array(
            array('class'=>'tableh2', 'colspan'=>2, 'text'=>
                Lang::item('search.start_by').
                html::profile_anchor($message['starter_id'], $message['starter_name']).
                ' | '.
                Lang::item('search.message_by').
                html::profile_anchor($message['poster_id'], $message['poster_name'])
            ),
        ));
        echo table::tds(array(
            array('class'=>'tableb', 'colspan'=>2, 'text'=>forum::format_message($message['body'])),
        ));
        echo table::close();
    }
    // paging
    echo table::open();
    echo table::tds(array(
        array('class'=>'tableb', 'text'=>Lang::item('board.page').forum::paging($paging)),
    ));
    echo table::close();
    echo html::spacer();
} else {
    if (isset($search)) {
        echo table::open();
        echo table::td(Lang::item('search.search_result'));
        echo table::tds(array(
            array('class'=>'tableb', 'text'=>Lang::item('search.no_result')),
        ));
        echo table::close();
        echo html::spacer();
    }
}