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
Et nyt emne, '%s', er skrevet på det område du holder øje med.
<br /><br />
Du kan se det på<br />
<a href="%s">%s</a>
<br /><br />
Flere emner er blevet skrevet men du vil ikke modtage flere notater før du har været inde på forummet og læse.
<br /><br />
Modtag ikke flere notater fra dette område ved at klikke her: <a href="%s">%s</a> 
<br /><br />
Hilsen,<br />
%s
EOT;

$lang = Array(
    'child_boards'       => 'Underliggende emner',
    'page'               => 'Side: ',
    'topic_title'        => 'Tittel',
    'replies'            => 'Svar',
    'views'              => 'Antal kig',
    'latest_post_info'   => 'Sidste indlæg information',
    'no_topic'           => 'Der er ikke nye emner her.',     
    'new_topic'          => 'Nyt emne',
    'legend'             => 'Markeret tekst',
    'jump'               => 'Hop',
    'n_n_m'              => 'Ingen nye beskeder',
    'n_m'                => 'Nye beskeder',
    'h_t'                => 'Varmt emne (Varmt emne har %s eller flere svar)',
    's_t'                => 'Uønsket emne',
    'r_o_t'              => 'Emne er ok',
    'topics'             => 'Emner',
    'select_destination' => 'Vælg venligst en destination:',
    'topic_preview'      => 'Emne prøvekig',
    'newtopic_nagavitor' => 'Nyt emne',
    'notify'             => 'Gør opmærksom',
    'active_notify'      => 'Er du sikker på at du ønsker at aktivere besked når der kommer nyt herfra?',
    'disable_notify'     => 'Er du sikker på at du ønsker at deaktivere beskeder her fra?',
    'board_new_topic'    => 'Nyt emne: ',
    'notify_email'       => $notify_email,
);