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
    $dfolder=$superCage->get->getRaw('dfolder');
}
if($superCage->get->keyExists('selection')){
    $selection=$superCage->get->getRaw('selection');
}
if($superCage->get->keyExists('selection1')){
    $selection1=$superCage->get->getRaw('selection1');
}


$titre=$lang_plugin_FileMove['folder_ar'];
        
$Drep=path_name($dfolder);
//affichagede l'entête
pageheader($lang_plugin_FileMove['display_name']);
if ($superCage->post->keyExists('file_name'))
{
    $directory="./".$CONFIG['fullpath'];
    $Drep=path_name($dfolder);
    $selection = "ok";
    starttable('100%',$titre);
    echo "<tr><td class='tableh2'align='left'>{$lang_plugin_FileMove['DFolder']}<b>{$Drep}</b></td></tr>";
    echo "<tr><td class='tableh2'align='left'>{$lang_plugin_FileMove['confirm_files']}</td></tr>";
    echo "<tr><td class='tableh2'>";
    $filename=$superCage->post->getRaw('file_name');
    setcookie($CONFIG['cookie_name'].'_filemove', base64_encode(serialize($filename)), 0, $CONFIG['cookie_path']);
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