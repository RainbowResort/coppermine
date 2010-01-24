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
Et svar er postet til det emne du holder øje med <a href="%s">%s</a>.
<br /><br />
Se svaret på: <a href="%s">%s</a>
<br /><br />
Afmeld notat om dette emne ved at klikke her: <a href="%s">%s</a>
<br /><br />
Flere svar er postet, men du vil ikke modtage flere notater før emnet er læst.
<br /><br />
Hilsen,<br />
%s
EOT;


$lang = Array(
    'fast_reply'           => 'Hurtigt svar',
    'reply'                => 'Svar',
    'topic_title'          => '%s - %s',
    'user_profile'         => '%s<br /><b>%s</b><br />Post: %s<br />Registreret: %s',
    'signature'            => '<fieldset class="signatur"><legend class="signatureTitle">&nbsp;Signatur&nbsp;</legend>%s</fieldset>',
    'no_message'           => 'Der er ikke nogen tilgængelige beskeder under dette emne.',
    'profile'              => 'PROFILE',
    'lock_topic'           => 'Lås Emne',
    'unlock_topic'         => 'Luk emnet op',
    'sticky_topic'         => 'MARKER SOM UØNSKET',
    'unsticky_topic'       => 'MARKER SOM ØNSKET',
    'delete_topic'         => 'DELETE EMNE',
    'move_topic'           => 'FLYT EMNE',
    'new_topic_success'    => 'Emne "%s" er oprettet successfuldt.',
    're'                   => 'Re: ',
    'new_topic'            => 'Nyt emne',
    'message_icon'         => 'Besked Icon',
    'subject'              => 'Subject',
    'message'              => 'Besked',
    'topic_name'           => 'Emne navn',
    'move_to'              => 'Flyt til',
    'move_topic_success'   => 'Emne "%s" blev flyttet med success!',
    'delete_topic_success' => 'Emne "%s" blev slettet successfuldt!',
    'topic_reply'          => 'Svar',
    'confirm_delete'       => 'Er du sikker paa at du ønsker at slette dette emne?',
    'addition_options'     => 'Yderligere muligheder...',
    'reply_nagavitor'      => 'Svar',
    'move_nagavitor'       => 'Flyt',
    'notify_this'          => 'Giv mig et notat ved svar',
    'upload'               => 'Upload fil',
    'notify'               => 'Noter',
    'active_notify'        => 'Er du sikker på at du ønsker at aktivere besked når der er nyt under dette emne ?',
    'disable_notify'       => 'Er du sikker på at du ønsker at deaktivere besked når der er nyt under dette emne ?',
    'topic_reply'          => 'Svar på emne: ',
    'notify_email'         => $notify_email,
);