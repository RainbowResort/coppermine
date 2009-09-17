<?php
echo table::open();
echo table::title(Lang::item('board.topic_preview'), 1);
echo table::tds(array(
    'class' => 'tableh2', 'text'=>$subject,
));
echo table::tds(array(
    'class' => 'tableb', 'text'=>$message,
));
echo table::close();
?>