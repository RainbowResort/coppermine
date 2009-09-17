<?php 

$notify_email = <<<EOT
A reply has been posted to a topic you are watching by <a href="%s">%s</a>.
<br /><br />
View the reply at: <a href="%s">%s</a>
<br /><br />
Unsubscribe to this topic by clicking here: <a href="%s">%s</a>
<br /><br />
More replies may be posted, but you won't receive any more notifications until you read the topic.
<br /><br />
Regards,<br />
%s
EOT;

$lang = Array(
    'fast_reply'           => 'Fast Reply',
    'reply'                => 'Reply',
    'topic_title'          => '%s - %s',
    'user_profile'         => '%s<br /><b>%s</b><br />Post: %s<br />Registered: %s',
    'signature'            => '<fieldset class="signature"><legend class="signatureTitle">&nbsp;Signature&nbsp;</legend>%s</fieldset>',
    'no_message'           => 'There isn\'t any message available in this topic.',
    'profile'              => 'PROFILE',
    'lock_topic'           => 'LOCK TOPIC',
    'unlock_topic'         => 'UNLOCK TOPIC',
    'sticky_topic'         => 'MARK AS STICKY',
    'unsticky_topic'       => 'MARK AS NON STICKY',
    'delete_topic'         => 'DELETE TOPIC',
    'move_topic'           => 'MOVE TOPIC',
    'new_topic_success'    => 'Topic "%s" is created successful.',
    're'                   => 'Re: ',
    'new_topic'            => 'New Topic',
    'message_icon'         => 'Message Icon',
    'subject'              => 'Subject',
    'message'              => 'Message',
    'topic_name'           => 'Topic name',
    'move_to'              => 'Move to',
    'move_topic_success'   => 'Topic "%s" was moved successful!',
    'delete_topic_success' => 'Topic "%s" was deleted successful!',
    'topic_reply'          => 'Reply',
    'confirm_delete'       => 'Are your sure that you want to delete this topic?',
    'addition_options'     => 'Additional Options...',
    'reply_nagavitor'      => 'Reply',
    'move_nagavitor'       => 'Move',
    'notify_this'          => 'Notify me of replies',
    'upload'               => 'Upload file',
    'notify'               => 'Notify',
    'active_notify'        => 'Are you sure you wish to active notification of new post of this topic ?',
    'disable_notify'       => 'Are you sure you wish to diable notification of new post of this topic ?',
    'topic_reply'          => 'Topic reply: ',
    'notify_email'     => $notify_email,
);