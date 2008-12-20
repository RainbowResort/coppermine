<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2005 Coppermine Dev Team
  v1.1 originaly written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  ********************************************
  Coppermine version: 1.4.8
  $Source: /cvsroot/cpg-contrib/master_template/codebase.php,v $
  $Revision: 1.3 $
  $Author: donnoman $
  $Date: 2005/12/08 05:46:49 $
**********************************************/
/**********************************************
Modified by Frantz for FileMove plugin
2007/09/22
**********************************************/
require('./include/init.inc.php');
require('plugins/FileMove/include/init.inc.php');
require ('plugins/FileMove/include/function.inc.php');
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
if(isset($_GET['dfolder'])){
	$dfolder=$_GET['dfolder'];
}
if(isset($_GET['selection'])){
	$selection=$_GET['selection'];
}
if(isset($_GET['selection1'])){
	$selection1=$_GET['selection1'];
}


$titre=$lang_plugin_FileMove['folder_ar'];
		
$Drep=path_name($dfolder);
//affichagede l'entête
pageheader($lang_plugin_FileMove['display_name']);
if (!empty($_POST['file_name']))
{
	$directory="./".$CONFIG['fullpath'];
	$Drep=path_name($dfolder);
	$selection = "ok";
	starttable('100%',$titre);
	echo "<tr><td class='tableh2'align='left'>{$lang_plugin_FileMove['DFolder']}<b>{$Drep}</b></td></tr>";
	echo "<tr><td class='tableh2'align='left'>{$lang_plugin_FileMove['confirm_files']}</td></tr>";
	echo "<tr><td class='tableh2'>";
	$filename=$_POST['file_name'];
	$_SESSION['filename']=$filename;
	foreach($filename as $n => $name)
	{
		echo $name."&nbsp;&nbsp;";
	}
	echo "</td></tr>";
	echo "<tr><td class='tableh1' align='center'><b>{$lang_plugin_FileMove['folder_ar']}</b></td></tr>";
	//choix du répertoire d'arrivée
	echo "<tr><td>";
	list_dir($directory,1,$dfolder,$selection,$selection1,$Drep);
	echo "</td></tr>";
	endtable();
}
else
{
	starttable('100%', $lang_plugin_FileMove['display_name'].' - '.$lang_plugin_FileMove['version'].'    '.'<a href="pluginmgr.php" class="admin_menu">Plugin Manager</a>',2);
	//affichage du contenu du répertoire
	echo "<tr><td>";
	$nb=2;//Change this value according the column number you will display
	starttable('100%',$lang_plugin_FileMove['DFolder'].$Drep,$nb);
	echo "<form name='file' action='' method='post'>";
	echo "<tr>";
	file_dir($dfolder,$nb);
	echo "<input type='hidden' name='dfolder' value='{$dfolder}'";
	echo "<tr><td align='center' colspan='{$nb}'<input type='Submit' value='{$lang_plugin_FileMove['valid']}'></td></tr>";
	echo "</tr></form>";
	endtable();
	echo "</td></tr>";
}
//Fin de tableau
endtable();
pagefooter();
ob_end_flush();


?>