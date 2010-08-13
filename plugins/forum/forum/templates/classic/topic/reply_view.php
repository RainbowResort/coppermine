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

$superCage = Inspekt::makeSuperCage();
if ($superCage->get->keyExists('quote')) {
    global $CONFIG;
    $id = $superCage->get->getInt('quote');
    $result = cpg_db_query("SELECT poster_name, body FROM {$CONFIG['TABLE_FR_MESSAGES']} WHERE msg_id = $id");
    $row = mysql_fetch_assoc($result);
    $form['body'] = "[quote={$row['poster_name']}]{$row['body']}[/quote]\n";
}
print <<<EOT
<script type="text/JavaScript">
<!--
$(document).ready(function() {
    $("#preview").click(function() {
        subject   = document.forms['reply'].subject.value;
        body      = document.forms['reply'].body.value;
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
print table::tds(array('class' => 'tableh2','id'=>'pv_subject', 'text'=>''));
print table::tds(array('class' => 'tableb', 'id'=>'pv_body','text'=>''));
print table::close();
print "</div>";
print table::open();
print table::td(Lang::item('topic.topic_reply'), 2);
print form::open('forum.php?c=topic&m=reply&id='.$topic_id, 'reply', 'post');
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
    array('class'=>'tableb', 'text'=>forum::generate_bbcode_tags('reply', 'body')),
));
print table::tds(array(
    array('class'=>'tableb', 'text'=>Lang::item('topic.message')),
    array('class'=>'tableb', 'text'=>form::textarea('body', $form['body'])),
));
print table::tds(array(
    array('class'=>'tableb', 'text'=>NBSP),
    array('class'=>'tableb', 'text'=>generate_smilies('reply', 'body')),
));
print table::td(Lang::item('topic.addition_options'), 2, 'tablef');
print table::tds(array(
    array('class'=>'tableb', 'text'=>Lang::item('topic.notify_this')),
    array('class'=>'tableb', 'text'=>
        form::yesno('notify', $authorizer->is_notify_topic($topic_id) ? 1 : 0)
    ),
));
/*
print table::tds(array(
    array('class'=>'tableb', 'text'=>Lang::item('topic.upload')),
    array('class'=>'tableb', 'text'=>''),
));
*/
print table::tds(array(
    array('class'=>'tablef', 'text'=>NBSP),
    array('class'=>'tablef', 'text'=>
        form::submit(Lang::item('common.reply'), 'submit').
        html::jsbutton('return false;', Lang::item('common.preview'), array('id'=>'preview')).
        NBSP.
        html::button('forum.php?c=topic&id='.$topic_id, Lang::item('common.cancel'))
    ),
));
print form::close();
print table::close();