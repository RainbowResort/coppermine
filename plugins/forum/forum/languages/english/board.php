<?php
$notify_email = <<<EOT
A new topic, '%s', has been made on a board you are watching.
<br /><br />
You can see it at<br />
<a href="%s">%s</a>
<br /><br />
More topics may be posted, but you won't receive more email notifications until you return to the board and read some of them.
<br /><br />
Unsubscribe to new topics from this board by clicking here: <a href="%s">%s</a> 
<br /><br />
Regards,<br />
%s
EOT;

$lang = Array(
    'child_boards'       => 'Child Boards',
    'page'               => 'Page: ',
    'topic_title'        => 'Title',
    'replies'            => 'Replies',
    'views'              => 'Views',
    'latest_post_info'   => 'Latest Post Info',
    'no_topic'           => 'There isn\'t any topic in this board.',
    'new_topic'          => 'New Topic',
    'legend'             => 'Post Marker Legend',
    'jump'               => 'Jump',
    'n_n_m'              => 'No New Messages',
    'n_m'                => 'New Messages',
    'h_t'                => 'Hot Topic (Hot Topics have %s or more replies)',
    's_t'                => 'Sticky Topic',
    'r_o_t'              => 'Read Only Topic',
    'topics'             => 'Topics',
    'select_destination' => 'Please select a destination:',
    'topic_preview'      => 'Topic Preview',
    'newtopic_nagavitor' => 'New Topic',
    'notify'             => 'Notify',
    'active_notify'      => 'Are you sure you wish to active notification of new topic of this board ?',
    'disable_notify'     => 'Are you sure you wish to diable notification of new topic of this board ?',
    'board_new_topic'    => 'New Topic: ',
    'notify_email'       => $notify_email,
);