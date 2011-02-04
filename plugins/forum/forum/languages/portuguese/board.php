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
Um novo tópico, '%s', foi criado no Painel que está a seguir.
<br /><br />
Pode vê-lo em<br />
<a href="%s">%s</a>
<br /><br />
Outros Tópicos podem ser criados, mas não receberá mais notificações enquando não voltar ao Painel e ler alguns deles.
<br /><br />
Para cancelar a subscrição de notificação de novos Tópicos deste Painel clicando aqui: <a href="%s">%s</a> 
<br /><br />
Cumprimentos,<br />
%s
EOT;

$lang = Array(
    'child_boards'       => 'Paineis anexos',
    'page'               => 'Página: ',
    'topic_title'        => 'Título',
    'replies'            => 'Respostas',
    'views'              => 'Visitas',
    'latest_post_info'   => 'Informação da última mensagem',
    'no_topic'           => 'Não há nenhum tópico neste painel.',
    'new_topic'          => 'Novo Tópico',
    'legend'             => 'Legenda',
    'jump'               => 'Saltar',
    'n_n_m'              => 'Não há novas mensagens',
    'n_m'                => 'Novas mensagens',
    'h_t'                => 'Tópico Quente (Um Tópico Quente é o que tem %s ou mais respostas)',
    's_t'                => 'Tópico de Aviso',
    'r_o_t'              => 'Tópico só de leitura',
    'topics'             => 'Tópicos',
    'select_destination' => 'Selecione um destino:',
    'topic_preview'      => 'Prévisualisação do Tópico',
    'newtopic_nagavitor' => 'Novo Tópico',
    'notify'             => 'Notificar',
    'active_notify'      => 'Tem a certeza que quer ativar notificação deste board ?',
    'disable_notify'     => 'Tem a certeza que quer desativar notificação deste board ?',
    'board_new_topic'    => 'Novo Tópico: ',
    'notify_email'       => $notify_email,
);