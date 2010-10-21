<?php
/**************************************************
  Coppermine 1.5.x Plugin - FileMove
  *************************************************
  Copyright (c) 2003-2010 Coppermine Dev Team
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

require('plugins/FileMove/include/init.inc.php');
require('plugins/FileMove/include/function.inc.php');
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
$DRep=$superCage->get->getRaw('RepD')."/";
$ARep=path_name($superCage->get->getRaw('dfolder'))."/";
if ($superCage->cookie->keyExists($CONFIG['cookie_name'].'_filemove')) {
    $file_name = @unserialize(@base64_decode($superCage->cookie->getRaw($CONFIG['cookie_name'].'_filemove')));
    setcookie($CONFIG['cookie_name'].'_filemove', '', 0, $CONFIG['cookie_path']);
}
echo "filename:".implode(", ",$file_name);
//affichagede l'entête
pageheader($lang_plugin_FileMove['display_name']);
starttable('100%', $lang_plugin_FileMove['display_name'].' - '.$lang_plugin_FileMove['version'].'    '.'<a href="pluginmgr.php" class="admin_menu">Plugin Manager</a>',2);
echo "<tr><td>";
$title=$lang_plugin_FileMove['transfer_file'].$lang_plugin_FileMove['folder2']."<b>".$DRep."</b>".$lang_plugin_FileMove['to'].$lang_plugin_FileMove['folder2']."<b>".$ARep."</b>";
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