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
  $Revision: 1.3 $
  $Author: donnoman $
  $Date: 2005/12/08 05:46:49 $
**********************************************/

require('./include/init.inc.php');
require('plugins/file_move/include/init.inc.php');
require ('plugins/file_move/include/function.inc.php');
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
session_start();
$DRep = $superCage->get->getRaw('RepD') . "/";
$ARep=path_name($superCage->get->getRaw('dfolder'))."/";
$file_name=$_SESSION['filename'];
echo "filename:".implode(", ",$_SESSION['filename']);
//affichagede l'entête
pageheader($lang_plugin_file_move['display_name']);
starttable('100%', $lang_plugin_file_move['display_name'].'    '.'<a href="pluginmgr.php" class="admin_menu">Plugin Manager</a>',2);
echo "<tr><td>";
$title=$lang_plugin_file_move['transfer_file'].$lang_plugin_file_move['folder2']."<b>".$DRep."</b>".$lang_plugin_file_move['to'].$lang_plugin_file_move['folder2']."<b>".$ARep."</b>";
starttable('100%',$title);
//Traitement de la base de donnée
$c=0;
//Sélection des images du répertoire de départ
$result=cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PICTURES']} WHERE `filepath`='$DRep'");
echo "<tr><td>";

	//echo "name:".$name."<br>";
while($row=mysql_fetch_array($result))
{
		$base_name=$row['filename'];
		foreach($file_name as $n => $name)
		{
			if ($base_name==$name)
			{
				echo "{$base_name}<br>";
				//déplacement du fichier d'un répertoire à l'autre
				file_move($base_name,$DRep,$ARep);
				++$c;
				$result2=cpg_db_query("UPDATE {$CONFIG['TABLE_PICTURES']} SET `filepath`='$ARep' WHERE `filepath`='$DRep' AND `filename`='$base_name'");
			}
		} 
}
unset($_SESSION['filename']);
echo "</td></tr>";
echo "<tr><td align='center'><b>{$c} {$lang_plugin_file_move['traitement']}</b><a href='index.php'<input type='button' name='ok'value='{$lang_plugin_file_move['continue']}'></a></td></tr>";
endtable();
echo "</td></tr>";
endtable();
pagefooter();
ob_end_flush();
mysql_free_result($result);
mysql_free_result($result2);
?>