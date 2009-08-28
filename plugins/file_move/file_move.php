<?php
/******************************
  Coppermine Plugin "File Move"
  *****************************
  Copyright (c) 2003-2009 François Keller

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.
  ********************************************
  Coppermine version: 1.5.x
  $Source: /cvsroot/cpg-contrib/master_template/codebase.php,v $
  $Revision$
  $Author$
  $Date$
**********************************************/
require('./include/init.inc.php');
require('plugins/file_move/include/init.inc.php');
require ('plugins/file_move/include/function.inc.php');
global $CONFIG,$titre,$Drep;
session_start();
if (!GALLERY_ADMIN_MODE) cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
if($lang_text_dir=='ltr') {
	$align="left";
	$direction="ltr";
}else {
	$align="right";
	$direction="rtl";
}
//Définition des variables
if($superCage->get->keyExists('dfolder')){
	$dfolder = $superCage->get->getEscaped('dfolder');
}
if($superCage->get->keyExists('selection')){
	$selection = $superCage->get->getEscaped('selection');
}
if($superCage->get->keyExists('selection1')){
	$selection = $superCage->get->getEscaped('selection1');
}


$titre=$lang_plugin_file_move['folder_ar'];
		
$Drep=path_name($dfolder);
//affichagede l'entête
pageheader($lang_plugin_file_move['display_name']);
if ($superCage->post->keyExists('file_name') && $superCage->post->getRaw('file_name') != '')
{
	$directory="./".$CONFIG['fullpath'];
	$Drep=path_name($dfolder);
	$selection = "ok";
	starttable('100%',$titre);
	echo "<tr><td class='tableh2'align='left'>{$lang_plugin_file_move['DFolder']}<b>{$Drep}</b></td></tr>";
	echo "<tr><td class='tableh2'align='left'>{$lang_plugin_file_move['confirm_files']}</td></tr>";
	echo "<tr><td class='tableh2'>";
	$filename = $superCage->post->getRaw('file_name');
	$_SESSION['filename'] = $filename;
	foreach($filename as $n => $name)
	{
		echo $name."&nbsp;&nbsp;";
	}
	echo "</td></tr>";
	echo "<tr><td class='tableh1' align='center'><b>{$lang_plugin_file_move['folder_ar']}</b></td></tr>";
	//choix du répertoire d'arrivée
	echo "<tr><td>";
	list_dir($directory,1,$dfolder,$selection,$selection1,$Drep);
	echo "</td></tr>";
	endtable();
}
else
{
	starttable('100%', $lang_plugin_file_move['display_name'].'    '.'<a href="pluginmgr.php" class="admin_menu">Plugin Manager</a>',2);
	//affichage du contenu du répertoire
	echo "<tr><td>";
	$nb=2;//Change this value according the column number you will display
	starttable('100%',$lang_plugin_file_move['DFolder'].$Drep,$nb);
	echo "<form name='file' action='' method='post'>";
	echo "<tr>";
	file_dir($dfolder,$nb);
	echo "<input type='hidden' name='dfolder' value='{$dfolder}'";
	echo "<tr><td align='center' colspan='{$nb}'<input type='Submit' value='{$lang_plugin_file_move['valid']}'></td></tr>";
	echo "</tr></form>";
	endtable();
	echo "</td></tr>";
}
//Fin de tableau
endtable();
pagefooter();
ob_end_flush();


?>