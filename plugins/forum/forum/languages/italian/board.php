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
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/branches/cpg1.5.x/plugins/imageflow/codebase.php $
  $Revision: 7015 $
  $LastChangedBy: timoswelt $
  $Date: 2010-01-07 19:10:40 +0100 (Do, 07. Jan 2010) $
  **************************************************/

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