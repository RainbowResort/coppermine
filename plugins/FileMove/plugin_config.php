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

if ($selection1=="ok"){
            $titre=$lang_plugin_FileMove['folder_ar'];
        }else{
            $titre=$lang_plugin_FileMove['folder_name'];
}

//affichagede l'entête
pageheader($lang_plugin_FileMove['display_name']);
starttable('100%', $lang_plugin_FileMove['display_name'].' - '.$lang_plugin_FileMove['version'].'    '.'<a href="pluginmgr.php" class="admin_menu">Plugin Manager</a>',2);
//if(isset($selection)){
    switch($selection){
        case "ok":
        //Affichage de l'arborescence d'arrivée
        if($selection1=="ok"){
            $directory="./".$CONFIG['fullpath'];
            $Drep=path_name($dfolder);
            $RepD=$Drep;
            starttable('100%',$titre);
            echo "<tr><td align='left'>{$lang_plugin_FileMove['DFolder']}<b>{$Drep}</b></td></tr>";
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
        $RepD=$superCage->get->getRaw('RepD');
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