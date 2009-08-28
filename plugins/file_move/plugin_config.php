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
//require('./include/init.inc.php');
require('plugins/file_move/include/init.inc.php');
require ('plugins/file_move/include/function.inc.php');
global $CONFIG,$titre,$Drep;
if (!GALLERY_ADMIN_MODE) cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
if($lang_text_dir=='ltr') {
	$align="left";
	$direction="ltr";
}else {
	$align="right";
	$direction="rtl";
}
//Définition des variables
if(isset($_GET['dfolder'])){
	$dfolder=$_GET['dfolder'];
}
if(isset($_GET['selection'])){
	$selection=$_GET['selection'];
}
if(isset($_GET['selection1'])){
	$selection1=$_GET['selection1'];
}

if ($selection1=="ok"){
			$titre=$lang_plugin_file_move['folder_ar'];
		}else{
			$titre=$lang_plugin_file_move['folder_name'];
}

//affichagede l'entête
pageheader($lang_plugin_file_move['display_name']);
starttable('100%', $lang_plugin_file_move['display_name'],2);
//if(isset($selection)){
	switch($selection){
		case "ok":
		//Affichage de l'arborescence d'arrivée
		if($selection1=="ok"){
			$directory="./".$CONFIG['fullpath'];
			$Drep=path_name($dfolder);
			$RepD=$Drep;
			starttable('100%',$titre);
			echo "<tr><td align='left'>{$lang_plugin_file_move['DFolder']}<b>{$Drep}</b></td></tr>";
			echo "<tr><td>";
			list_dir($directory,1,$dfolder,$selection,$selection1,$RepD);
			echo "</td></tr>";
			endtable();
		}else{
			$selection="ok";
			//Affichage du choix de l'action (déplacer tout le contenu du répertoire ou travailler sur certains fichier
			echo "<tr><td>";
			action_select($dfolder,$selection);
			echo "</td></tr>";
		}
		break;
		case "oui":
		$Arep=path_name($dfolder);
		$RepD=$_GET['RepD'];
		//affichage des deux répertoires à déplacer et confirmation pour traitement
		echo "<tr><td>";
		confirm_choix($RepD,$Arep);
		echo "</td></tr>";
		break;
		default:
		$directory="./".$CONFIG['fullpath'];
	starttable('100%',$titre);
	echo "<tr><td>";
	list_dir($directory,1,$dfolder,$selection,$selection1,$Drep);
	echo "</td></tr>";
	endtable();
	}
//Fin de tableau
endtable();
pagefooter();
ob_end_flush();


?>