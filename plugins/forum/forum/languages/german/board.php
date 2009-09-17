<?php
$notify_email = <<<EOT
Ein neues Thema, '%s', wurde in einem Forum erstellt, welches du beobachtest.
<br /><br />
Hier geht es zum Thema<br />
<a href="%s">%s</a>
<br /><br />
Mehrere Themen können in der Zwischenzeit erstellt worden sein. Du erhätst aber keine weiteren Benachrichtigungen, solange du nicht das entsprechende Forum besucht und einige Themen gelesen hast.
<br /><br />
Um keine weiteren Benachrichtigungen für dieses Forum zu erhalten, klick hier: <a href="%s">%s</a>
<br /><br />
Grüße,<br />
%s
EOT;

$lang = Array(
    'child_boards'       => 'Unterforen',
    'page'               => 'Seite: ',
    'topic_title'        => 'Titel',
    'replies'            => 'Beiträge',
    'views'              => 'Zugriffe',
    'latest_post_info'   => 'Letzter Beitrag',
    'no_topic'           => 'In diesem Forum gibt es keine Themen.',
    'new_topic'          => 'Neues Thema',
    'legend'             => 'Legende',
    'jump'               => 'Gehe zu',
    'n_n_m'              => 'Keine neuen Beiträge',
    'n_m'                => 'Neue Beiträge',
    'h_t'                => 'Top Thema (Top Themen haben %s oder mehr Antworten)',
    's_t'                => 'Wichtiges Thema',
    'r_o_t'              => 'Gesperrtes Thema',
    'topics'             => 'Themen',
    'select_destination' => 'Wähle Ziel:',
    'topic_preview'      => 'Vorschau',
    'newtopic_nagavitor' => 'Neues Thema',
    'notify'             => 'Benachrichtigen',
    'active_notify'      => 'Willst du bei neuen Themen in diesem Forum wirklich benachrichtigt werden?',
    'disable_notify'     => 'Willst du bei neuen Themen in diesem Forum wirklich nicht benachrichtigt werden?',
    'board_new_topic'    => 'Neues Thema: ',
    'notify_email'       => $notify_email,
);
