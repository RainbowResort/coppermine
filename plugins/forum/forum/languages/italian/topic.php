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
	'fast_reply'    	   => 'Risposta Veloce',
	'reply'				   => 'Rispondi',
	'topic_title'		   => '%s - %s',
	'user_profile'		   => '%s<br /><b>%s</b><br />Post: %s<br />Registrato: %s',
	'signature'     	   => '<fieldset class="signature"><legend class="signatureTitle">&nbsp;Firma&nbsp;</legend>%s</fieldset>',
	'no_message'		   => 'Nessun messaggio disponibile in questo Argomento.',
	'profile'			   => 'PROFILO',
	'lock_topic'		   => 'ARGOMENTO CHIUSO',
	'unlock_topic'		   => 'ARGOMENTO APERTO',
	'sticky_topic'		   => 'SEGNA COME NON INTERESSANTE',
	'unsticky_topic'	   => 'SEGNA COME INTERESSANTE',
	'delete_topic'		   => 'CANCELLA ARGOMENTO',
	'move_topic'		   => 'MUOVI ARGOMENTO',
	'new_topic_success'    => 'Argomento "%s" creato con successo.',
	're'			       => 'Re: ',
	'new_topic'			   => 'Nuovo Argomento',
	'message_icon'		   => 'Icona Messaggio',
	'subject'              => 'Oggetto',
	'message'              => 'Descrizione',
	'topic_name'		   => 'Nome Argomento',
	'move_to'			   => 'Sposta in',
	'move_topic_success'   => 'Argomento "%s" spostato con successo!',
	'delete_topic_success' => 'Argomento "%s" cancellato con successo!',
	'topic_reply'		   => 'Rispondi',
	'confirm_delete'	   => 'Sei sicuro di voler cancellare questo Argomento?',
	'addition_options'	   => 'Opzioni aggiuntive...',
	'reply_nagavitor'	   => 'Rispondi',	
	'move_nagavitor'	   => 'Sposta',
	'notify_this'		   => 'Avvisami quando ricevo risposta',
	'upload'			   => 'Carica file',
    'notify'			   => 'Notifica',
    'active_notify'		   => 'Vuoi veramente attivare notifiche in questo Argomento ?',
    'disable_notify'	   => 'Vuoi veramente disattivare notifiche in questo Argomento ?',	
    'topic_reply'		   => 'Risposta Argomento: ',
    'notify_email'		   => $notify_email,    
);