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
2007/07/19
**********************************************/

require('./include/init.inc.php');
require('plugins/FileMove/include/init.inc.php');
require ('plugins/FileMove/include/function.inc.php');
global $CONFIG;
if (!GALLERY_ADMIN_MODE) cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
if($lang_text_dir=='ltr') {
	$align="left";
	$direction="ltr";
}else {
	$align="right";
	$direction="rtl";
}
//Définition des variables
$DRep=$_GET['Drep']."/";
$ARep=$_GET['Arep']."/";

//affichagede l'entête
pageheader($lang_plugin_FileMove['display_name']);
starttable('100%', $lang_plugin_FileMove['display_name'].' - '.$lang_plugin_FileMove['version'].'    '.'<a href="pluginmgr.php" class="admin_menu">Plugin Manager</a>',2);
echo "<tr><td>";
$title=$lang_plugin_FileMove['transfer'].$lang_plugin_FileMove['folder2']."<b>".$DRep."</b>".$lang_plugin_FileMove['to'].$lang_plugin_FileMove['folder2']."<b>".$ARep."</b>";
starttable('100%',$title);
//Traitement de la base de donnée
$c=0;
//Sélection des images du répertoire de départ
$result=cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PICTURES']} WHERE `filepath`='$DRep'");
echo "<tr><td>";
while($row=mysql_fetch_array($result)){
	$file_name=$row['filename'];
	echo "{$file_name}<br>";
	//déplacement du fichier d'un répertoire à l'autre
	file_move($file_name,$DRep,$ARep);
	++$c;
} // while
$result2=cpg_db_query("UPDATE {$CONFIG['TABLE_PICTURES']} SET `filepath`='$ARep' WHERE `filepath`='$DRep'");
echo "</td></tr>";
echo "<tr><td align='center'><b>{$c} {$lang_plugin_FileMove['traitement']}</b><a href='index.php'<input type='button' name='ok'value='{$lang_plugin_FileMove['continue']}'></a></td></tr>";
endtable();
echo "</td></tr>";

endtable();
pagefooter();
ob_end_flush();
mysql_free_result($result);
mysql_free_result($result2);
?>