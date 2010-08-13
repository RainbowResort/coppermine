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

echo <<<EOT
<script type="text/JavaScript">
<!--
$(document).ready(function() {
    $("#preview").click(function() {
        subject   = document.forms['editmsg'].subject.value;
        body      = document.forms['editmsg'].body.value;
        $.post("forum.php?c=ajax&m=previewmessage", {subject: subject, body: body}, function(data) {
            document.getElementById('preview_area').style.display = 'block';
            datas = data.split('|_|', 2);
            document.getElementById('pv_subject').innerHTML = datas[0];
            document.getElementById('pv_body').innerHTML = datas[1];
        });
    });
});
-->
</script>
EOT;
echo "<div name=\"preview_area\" id=\"preview_area\" style=\"display: none;\">";
echo table::open();
echo table::td(Lang::item('board.topic_preview'), 1);
echo table::tds(array('class' => 'tableh2','id'=>'pv_subject',  'text'=>''));
echo table::tds(array('class' => 'tableb', 'id'=>'pv_body','text'=>''));
echo table::close();
echo "</div>";
echo table::open();
echo table::td(Lang::item('topic.new_topic'), 2);
echo form::open('forum.php?c=message&m=edit&id='.$msg_id, 'editmsg');
if (count($errors) > 0) {
    echo table::td(table::error($errors), 2, 'tableh2');
}
echo table::tds(array(
    array('class'=>'tableb', 'width'=>'30%', 'text'=>Lang::item('topic.subject')),
    array('class'=>'tableb', 'width'=>'70%', 'text'=>form::text('subject', $form['subject'])),
));
if (Config::item('fr_msg_icons') == 1) {
    echo table::tds(array(
        array('class'=>'tableb', 'text'=>Lang::item('topic.message_icon')),
        array('class'=>'tableb', 'text'=>forum::generate_message_icons('icon', $icons, $form['icon'])),
    ));
}
echo table::tds(array(
    array('class'=>'tableb', 'text'=>NBSP),
    array('class'=>'tableb', 'text'=>forum::generate_bbcode_tags('editmsg', 'body')),
));
echo table::tds(array(
    array('class'=>'tableb', 'text'=>Lang::item('topic.message')),
    array('class'=>'tableb', 'text'=>form::textarea('body', $form['body'])),
));
echo table::tds(array(
    array('class'=>'tableb', 'text'=>NBSP),
    array('class'=>'tableb', 'text'=>generate_smilies('editmsg', 'body')),
));
echo table::tds(array(
    array('class'=>'tablef', 'text'=>NBSP),
    array('class'=>'tablef', 'text'=>
        form::submit(Lang::item('common.modify'), 'submit').
        html::jsbutton('return false;', Lang::item('common.preview'), array('id'=>'preview')).
        NBSP.
        html::button('forum.php?c=board&id='.$board_id, Lang::item('common.cancel'))
    ),
));
echo form::close();
echo table::close();