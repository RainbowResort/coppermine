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

print <<<EOT
<script type="text/JavaScript">
<!--
$(document).ready(function() {
    $("#preview").click(function() {
        subject   = document.forms['newtopic'].subject.value;
        body      = document.forms['newtopic'].body.value;
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
print "<div name=\"preview_area\" id=\"preview_area\" style=\"display: none;\">";
print table::open();
print table::td(Lang::item('board.topic_preview'), 1);
print table::tds(array('class' => 'tableh2','id'=>'pv_subject',  'text'=>''));
print table::tds(array('class' => 'tableb', 'id'=>'pv_body','text'=>''));
print table::close();
print "</div>";
print table::open();
print table::td(Lang::item('topic.new_topic'), 2);
print form::open('forum.php?c=board&m=newtopic&id='.$board_id, 'newtopic', 'post');
if (count($errors) > 0) {
    print table::td(table::error($errors), 2, 'tableh2');
}
print table::tds(array(
    array('class'=>'tableb', 'width'=>'30%', 'text'=>Lang::item('topic.subject')),
    array('class'=>'tableb', 'width'=>'70%', 'text'=>form::text('subject', $form['subject'])),
));
if (Config::item('fr_msg_icons') == 1) {
    print table::tds(array(
        array('class'=>'tableb', 'text'=>Lang::item('topic.message_icon')),
        array('class'=>'tableb', 'text'=>forum::generate_message_icons('icon', $icons, $form['icon'])),
    ));
}
print table::tds(array(
    array('class'=>'tableb', 'text'=>NBSP),
    array('class'=>'tableb', 'text'=>forum::generate_bbcode_tags('newtopic', 'body')),
));
print table::tds(array(
    array('class'=>'tableb', 'text'=>Lang::item('topic.message')),
    array('class'=>'tableb', 'text'=>form::textarea('body', $form['body'])),
));
print table::tds(array(
    array('class'=>'tableb', 'text'=>NBSP),
    array('class'=>'tableb', 'text'=>generate_smilies('newtopic', 'body')),
));
print table::td(Lang::item('topic.addition_options'), 2, 'tablef');
print table::tds(array(
    array('class'=>'tableb', 'text'=>Lang::item('topic.notify_this')),
    array('class'=>'tableb', 'text'=>
        form::yesno('notify', 1)
    ),
));
print table::tds(array(
    array('class'=>'tablef', 'text'=>NBSP),
    array('class'=>'tablef', 'text'=>
        form::submit(Lang::item('common.add'), 'submit').
        html::jsbutton('return false;', Lang::item('common.preview'), array('id'=>'preview')).
        NBSP.
        html::button('forum.php?c=board&id='.$board_id, Lang::item('common.cancel'))
    ),
));
print form::close();
print table::close();