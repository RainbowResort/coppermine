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
No tópico em que está interessado foi escrita uma resposta por <a href="%s">%s</a>.
<br /><br />
Pode vê-la em: <a href="%s">%s</a>
<br /><br />
Para desativar os avisos clique aqui: <a href="%s">%s</a>
<br /><br />
Outras respostas poderão ser escritas mas não será avisado de novo enquanto não voltar ao tópico.
<br /><br />
Cumprimentos,<br />
%s
EOT;

$lang = Array(
    'fast_reply'           => 'Resposta rápida',
    'reply'                => 'Resposta',
    'topic_title'          => '%s - %s',
    'user_profile'         => '%s<br /><b>%s</b><br />Mensagem: %s<br />Registada: %s',
    'signature'            => '<fieldset class="assinatura"><legend class="signatureTitle">&nbsp;Assinatura&nbsp;</legend>%s</fieldset>',
    'no_message'           => 'Não há nenhuma mensagem neste tópico.',
    'profile'              => 'PERFIL',
    'lock_topic'           => 'BLOQUEAR TÓPICO',
    'unlock_topic'         => 'DESBLOQUEAR TÓPICO',
    'sticky_topic'         => 'MARCAR COM DE AVISO',
    'unsticky_topic'       => 'MARCAR COM NÃO DE AVISO',
    'delete_topic'         => 'APAGAR TÓPICO',
    'move_topic'           => 'MOVER TÓPICO',
    'new_topic_success'    => 'O tópico "%s" foi criado.',
    're'                   => 'Re: ',
    'new_topic'            => 'Novo Tópico',
    'message_icon'         => 'Icon de mensagem',
    'subject'              => 'Assunto',
    'message'              => 'Mensagem',
    'topic_name'           => 'Nome do Tópico',
    'move_to'              => 'Mover para ',
    'move_topic_success'   => 'Tópico "%s" movido !',
    'delete_topic_success' => 'Tópico "%s" apagado com sucesso !',
    'topic_reply'          => 'Resposta',
    'confirm_delete'       => 'Tem a certeza que quer apagar este tópico ?',
    'addition_options'     => 'Opções Adicionais',
    'reply_nagavitor'      => 'Resposta',
    'move_nagavitor'       => 'Mover',
    'notify_this'          => 'Notifique-me das respostas',
    'upload'               => 'Carregar ficheiro',
    'notify'               => 'Notificar',
    'active_notify'        => 'Tem a certeza que quer ativar notificações de novas mensagens neste tópico ?',
    'disable_notify'       => 'Tem a certeza que quer desativar notificações de novas mensagens neste tópico ?',
    'topic_reply'          => 'Resposta ao Tópico: ',
    'notify_email'     => $notify_email,
);