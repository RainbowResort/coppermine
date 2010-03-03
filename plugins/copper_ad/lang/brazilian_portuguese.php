<?php

/**************************************************

  Coppermine 1.4.x Plugin - Copper ad

  *************************************************

  Copyright (c) 2006 Borzoo Mossavari

  *************************************************

  This program is free software; you can redistribute it and/or modify

  it under the terms of the GNU General Public License as published by

  the Free Software Foundation; either version 2 of the License, or

  (at your option) any later version.

  *************************************************

  This is a simple Advertisement plugin without statistics

  or any kind of log.

  this will give you flash/picture/HTML banner

  By using FRAME technology

  ***************************************************/



if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...'); }



$lang_plugin_copperad = array(

  'display_name'  => 'Anúncio',			// Display Name

  'config_title'  => 'Configurar Anúncio',			// Title of the button on the gallery config menu

  'config_button' => 'Anúncio',				// Label of the button on the gallery config menu

  'page_success'  => 'Alterações efetuadas com sucesso.',		// Page success message

  'page_failure'  => 'Não foi possível efetuar as alterações.',		// Page failure message

  'install_note'  => 'Configurar plugin usando o botão no menu de administrador.',	// Note about configuring plugin

  'install_click' => 'Clique para instalar o plugin.',	// Message to install plugin

  'create_success'=> 'Seu banner foi criado com sucesso', // Create success message

  'version'       => 'Ver 1.2.5<font size=1><em>Stable</em></font>' // CPA 1.2.5



);



$lang_plugin_copperad_config = array(

  'status'        => 'Status do Plugin',

  'max_show'      => 'Quantas vezes quer que o banner apareça?',

  'button_install'=> 'Instalar',

  'button_submit' => 'Submeter',

  'button_cancel' => 'Cancelar',

  'button_done'   => 'Feito',

  'cleanup_question' => 'Remover a tabela de confirgurações ?',

  'text_title'    => 'Digite o título abaixo do banner (deixe em branco para desabilitar)',

  'text_title_des'=> '<font size="1" color="red">Não use Tags HTML</font>',

  'admin_show'    => 'Quer que o banner apareça no mode de administrador  ?',

  'banner_bg'     => 'Digite a cor de fundo do banner',

  'expand_all'    => 'Expandir Todos',

  'permission'    => 'Mude a permissão da pasta de sua Galeria para 777 (apenas a pasta e não os arquivos e subpastas)', // CPA 1.2.2

);

// Banner Management

$lang_plugin_copperad_manage= array(

	'display_name'=> 'Configurações do Banner',

	'list_name'   => 'Nome',

	'list_delete' => 'Excluir',

	'list_edit'   => 'Editar',

	'list_kind'   => 'Tipo de Anúncio',

	'list_address'=> 'URL da imagem (ex: adv/pic/adv1.gif ou adv/flash/adv1.swf)',

	'list_linkto' => 'Link para (digite a URL)',

	'list_height' => 'Altura <em><font color="#FF0000">Max 100 px</font> </em>',

	'list_width'  => 'Largura <em><font color="#FF0000">Max 780 px</font></em>',

	'list_alt'    => 'Alt (configure este valor para otimização do sistema de pesquisa)',

	'list_html'   => 'HTML',

	'list_html_des' => 'Todas as tags HTML são aceitáveis mesmo <em>iframe</em> mas use-as <font color="#FF0000">com cuidado</font>',

	'list_pic'    => '<font color="red">Apenas para imagens</font>',

	'list_submit' => 'Salvar novas configurações',

	'list_create' => 'Criar novo banner', // CPA 1.2.2

	'list_restore'=> 'Restaurar padrões de fábrica',

	'list_status' => 'Status de Banner', // CPA 1.2.2

	'list_banner' => 'Lista de Banner', // CPA 1.2.2

	'list_conf'   => 'Configuração', // CPA 1.2.2

	'list_stat'   => 'Habilitar', // CPA 1.2.2

	'list_chstat' => 'Mudar status', // CPA 1.2.2

	'list_chkall' => 'Marcar TODOS', // CPA 1.2.2

);

// Delete

$lang_plugin_copperad_delete= array(

  'display_name'  => 'Excluir Banner',

  'nothing_do'    => 'Não há nada que possa fazer!',

  'cant_delete'   => 'Ao menos UM banner deve estar disponível!',

  'delete_okey'   => 'Banner excluído com sucesso.',

 );

?>