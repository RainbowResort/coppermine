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
	'child_boards'	     => 'Child Boards',
	'page'			     => 'Pagina: ',
	'topic_title'        => 'Titolo',
	'replies'		     => 'Repliche',
	'views'			     => 'Viste',
	'latest_post_info'   => 'Info ultimi post',
	'no_topic'		     => 'Non esiste nessun Argomento in questo Forum.',	
	'new_topic'		     => 'Nuovo Argomento',
	'legend'		     => 'Legenda del Post Marker',
    'jump'		   	     => 'Salta',
    'n_n_m'			     => 'No nuovi Messaggi',
    'n_m'			     => 'Nuovi Messaggi',
    'h_t'			     => 'Argomenti Caldi (Hot Topics have %s or more replies)',
    's_t'			     => 'Argomenti Noiosi',
    'r_o_t'			     => 'Leggi solo Argomenti',
    'topics'		     => 'Argomenti',
    'select_destination' => 'Seleziona una destinazione:',
    'topic_preview'		 => 'Anteprima Argomenti',
    'newtopic_nagavitor' => 'Nuovo Argomento',
    'notify'			 => 'Rispondi',
    'active_notify'		 => 'Sei sicuro di voler attivare notifiche di nuovi Argomenti in questo Forum?',
    'disable_notify'	 => 'Sei sicuro di voler disattivare otifiche di nuovi Argomenti in questo Forum?',
    'board_new_topic'	 => 'Nuovo Argomento: ',
    'notify_email'		 => $notify_email,
);