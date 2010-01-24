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

$notify_email = <<<EOT
<a href="%s">%s</a> hat einen Beitrag zu einen Thema geschrieben, welches du beobachtest.
<br /><br />
Lies den Beitrag: <a href="%s">%s</a>
<br /><br />
Um keine weiteren Benachrichtigungen zu diesem Thema zu erhalten, klick hier: <a href="%s">%s</a>
<br /><br />
Mehrere Beiträge können in der Zwischenzeit geschrieben worden sein. Du erhätst aber keine weiteren Benachrichtigungen, bis du das Thema gelesen hast.
<br /><br />
Grüß,<br />
%s
EOT;

$lang = Array(
    'fast_reply'           => 'Schnelle Antwort',
    'reply'                => 'Antworten',
    'topic_title'          => '%s - %s',
    'user_profile'         => '%s<br /><b>%s</b><br />Beiträge: %s<br />Registriert: %s',
    'signature'            => '<br /><br /><fieldset class="signature"><legend class="signatureTitle">&nbsp;Signatur&nbsp;</legend>%s</fieldset>',
    'no_message'           => 'In diesem Thema gibt es keine Beiträge.',
    'profile'              => 'Profil',
    'lock_topic'           => 'Thema sperren',
    'unlock_topic'         => 'Thema entsperren',
    'sticky_topic'         => 'Als wichtig markieren',
    'unsticky_topic'       => 'Als unwichtig markieren',
    'delete_topic'         => 'Thema löschen',
    'move_topic'           => 'Thema verschieben',
    'new_topic_success'    => 'Thema "%s" wurde erfolgreich angelegt.',
    're'                   => 'Re: ',
    'new_topic'            => 'Neues Thema',
    'message_icon'         => 'Symbol',
    'subject'              => 'Thema',
    'message'              => 'Beitrag',
    'topic_name'           => 'Thema',
    'move_to'              => 'Verschieben nach',
    'move_topic_success'   => 'Thema "%s" wurde erfolgreich verschoben!',
    'delete_topic_success' => 'Thema "%s" wurde erfolgreich gelöscht!',
    'topic_reply'          => 'Antwort',
    'confirm_delete'       => 'Willst du dieses Thema wirklich löschen?',
    'addition_options'     => 'Weitere Optionen...',
    'reply_nagavitor'      => 'Antwort',
    'move_nagavitor'       => 'Verschieben',
    'notify_this'          => 'Benachrichtige mich bei Antworten',
    'upload'               => 'Datei hochladen',
    'notify'               => 'Benachrichtigen',
    'active_notify'        => 'Willst du bei neuen Antworten wirklich benachrichtigt werden?',
    'disable_notify'       => 'Willst du bei neuen Antworten wirklich nicht benachrichtigt werden?',
    'topic_reply'          => 'Antwort: ',
    'notify_email'         => $notify_email,
);
