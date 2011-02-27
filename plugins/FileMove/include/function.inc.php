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

/*********************************************
*extension($file)
*fonction d'attribution d'une icone pour chaque type de fichiers
$file:nom du fichier
*********************************************/
function extension($file)
{
        
    $ext = strrchr( $file , "." );
    ############### Folder
    if ( $file == "folder" )
    {
        $icon  = "<IMG SRC='plugins/FileMove/images/folder.gif' alt='Dossier' border='0' width='15' ";
        $icon .= "height='13' hspace='3' vspace='3'>";
        ############### Image
    }
    else if ((!strcasecmp($ext, ".gif")) || (!strcasecmp($ext, ".jpg")) || 
             (!strcasecmp($ext, ".png")) || (!strcasecmp($ext, ".bmp")) || 
             (!strcasecmp($ext, ".jpeg")))
    {
        $icon = "<IMG SRC='plugins/FileMove/images/image1.gif' alt='Image' border='0' width='16' ";
        $icon .= "height='16' hspace='3' vspace='2'>";
        ############### Textfile
    }
    else if (!strcasecmp($ext, ".txt"))
    {
        $icon = "<IMG SRC='plugins/FileMove/images/text.gif' alt='Text' border='0' width='16' ";
        $icon .= "height='16' hspace='3' vspace='2'>";
        ############### Audiofile
    }
    else if ((!strcasecmp($ext, ".wav")) || (!strcasecmp($ext, ".mp2")) || 
             (!strcasecmp($ext, ".mp3")) || (!strcasecmp($ext, ".mp4")) || 
             (!strcasecmp($ext, ".vqf")) || (!strcasecmp($ext, ".midi")) || 
             (!strcasecmp($ext, ".mid")))
    {
        $icon = "<IMG SRC='plugins/FileMove/images/sound.gif' alt='Audio' border='0' width='16' ";
        $icon .= "height='16' hspace='3' vspace='2'>";
        ############### Webscript
    }
    else if ((!strcasecmp($ext, ".phps")) || (!strcasecmp($ext, ".php")) || 
             (!strcasecmp($ext, ".php2")) || (!strcasecmp($ext, ".php3")) || 
             (!strcasecmp($ext, ".php4")) || (!strcasecmp($ext, ".phtml")) || 
             (!strcasecmp($ext, ".asp")) || (!strcasecmp($ext, ".asa")) || 
             (!strcasecmp($ext, ".cgi")) || (!strcasecmp($ext, ".shtml")) || 
             (!strcasecmp($ext, ".pl")))
    {
        $icon = "<IMG SRC='plugins/FileMove/images/html.gif' alt='Web program' border='0' ";
        $icon .= "width='15' height='15' hspace='3' vspace='2'>";
        ############### Apache Webserver security settings
    }
    else if (!strcasecmp($ext, ".htaccess"))
    {
        $icon = "<IMG SRC='plugins/FileMove/images/security.gif' alt='Apache Webserver security ";
        $icon .= "settings' border='0' width='15' height='16' hspace='3' vspace='2'>";
        ############### Web page
    }
    else if ((!strcasecmp($ext, ".html")) || (!strcasecmp($ext, ".htm")))
    {
        $icon = "<IMG SRC='plugins/FileMove/images/html.gif' alt='Web page' border='0' width='15' ";
        $icon .= "height='15' hspace='3' vspace='2'>";
        ############### WAP page
    }
    else if (!strcasecmp($ext, ".wml"))
    {
        $icon = "<IMG SRC='plugins/FileMove/images/html.gif' alt='WAP page' border='0' ";
        $icon .= "width='15' height='15' hspace='3' vspace='2'>";
        ############### Compressed file
    }
    else if ((!strcasecmp($ext, ".zip")) || (!strcasecmp($ext, ".tar")) || 
             (!strcasecmp($ext, ".rar")) || (!strcasecmp($ext, ".gz")))
    {
        $icon = "<IMG SRC='plugins/FileMove/images/zip.gif' alt='Compressed file' border='0' ";
        $icon .= "width='15' height='15' hspace='3' vspace='2'>";
        ############### PowerPoint file
    }
    else if ((!strcasecmp($ext, ".ppt")) || (!strcasecmp($ext, ".pps")))
    {
        $icon = "<IMG SRC='plugins/FileMove/images/ppt.gif' alt='PowerPoint file' border='0' ";
        $icon .= "width='16' height='16' hspace='3' vspace='2'>";
        ############### PDF file
    }
    else if ((!strcasecmp($ext, ".pdf")))
    {
        $icon = "<IMG SRC='plugins/FileMove/images/pdf.gif' alt='PDF file' border='0' width='16' ";
        $icon .= "height='16' hspace='3' vspace='2'>";
        ############### Word file
    }
    else if ((!strcasecmp($ext, ".doc")))
    {
        $icon = "<IMG SRC='plugins/FileMove/images/doc.gif' alt='Word file' border='0' width='16' ";
        $icon .= "height='16' hspace='3' vspace='2'>";
        ############### Excel file
    }
    else if ((!strcasecmp($ext, ".xls")) || (!strcasecmp($ext, ".xl")) || 
             (!strcasecmp($ext, ".tab")))
    {
        $icon = "<IMG SRC='plugins/FileMove/images/xls.gif' alt='Excel file' border='0' width='16' ";
        $icon .= "height='16' hspace='3' vspace='2'>";
        ############### Unknown
    }
    else
    {
        $icon = "<IMG SRC='plugins/FileMove/images/unknown.gif' alt='Unknown filetype' border='0' ";
        $icon .= "width='16' height='16' hspace='3' vspace='2'>";
    }
    
    return $icon;
}
/******************************************
*indent($max)
*fonction implémentant l'indentation de l'arborescence
*$max:niveau de départ de l'indentation
******************************************/
function indent($max)
{
    for ($i=1;$i<$max;$i++) 
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
}
/******************************************
*count_files($dir)
*fonction de comptage des fichiers dansun répertoire avec filtres sur certaines extensions
*$dir:cheminrelatif du répertoire à traiter
******************************************/
 function count_files($dir)
 {
     global $CONFIG;
   $num = 0;    
   $dir_handle = opendir($dir);
   while($entry = readdir($dir_handle))
   {
    $path_parts = pathinfo($entry);   	
    if ($path_parts['extension'] !="php" && $path_parts['extension']  != "html"&& $entry !="edit" && $path_parts['extension']  !="" && $path_parts['extension']  !="db" && $path_parts['extension']  != "svn" && $path_parts['extension']  != "DS_Store")
       {
                if(is_file($dir.'/'.$entry))
                {
                    if (strpos($entry, stristr($entry,$CONFIG['normal_pfx'])) !== 0 && strpos($entry, stristr($entry,$CONFIG['thumb_pfx'])) !== 0)
                    {
                        $num++;
                    }
                }
         }
    }
    closedir($dir_handle);
    return $num;
}     
/*****************************************
*list_dir($path,$step,$dfolder)
*fonction d'affichage de l'arborescence
*$path: chemin relatif du répertoire de départ de l'arborescence
*$step: valeur de départ pour l'indentation
*$dfolder: chemin du répertoire sélectionné au départ
*****************************************/
function list_dir ($path,$step,$dfolder,$selection,$selection1,$Drep)
{
    global $num,$lang_plugin_FileMove,$filename;
    
    if ($selection1=="ok"){
        $select="oui";
    }else{
        $select="ok";
    }
    
    $dir = opendir($path);
    $i = 0;
        while($file = readdir($dir))
        {
            if ($file !="." && $file != ".."&& $file !="edit" && $file !=".svn")
                {
                    if (is_dir($path."/".$file)){
                // on passe les datas dans un tableau
                        $ListFiles[$i]=$file;
                        $i++; 
                    }
                }
         }
         closedir($path);
         usort($ListFiles,"strnatcmp");
         
         $i = 0;
         while ( $i < count($ListFiles)) 
         {
                
                    indent($step);
                    $folder_name=$path."/".$ListFiles[$i];
                    $nb=count_files($folder_name);
                   if ($folder_name == $dfolder){
                        if ($nb==0){
                            echo extension("folder")."{$ListFiles[$i]}<br>";
                            $i++;
                        }
                        if ($nb==1){
                            echo extension("folder")."{$ListFiles[$i]}({$nb} {$lang_plugin_FileMove['file']})<br>";
                            $i++;
                        }
                        if ($nb > 1){
                            echo extension("folder")."{$ListFiles[$i]}({$nb} {$lang_plugin_FileMove['files']})<br>";
                            $i++;
                        }
                    }else{
                        if ($nb==0){
                            if (!$filename){
                                echo extension("folder")."<a href='index.php?file=FileMove/plugin_config&dfolder=$folder_name&selection=$select&RepD=$Drep'>{$ListFiles[$i]}</a><br>";
                                $i++;
                            }else{
                                echo extension("folder")."<a href='index.php?file=FileMove/move_file&dfolder=$folder_name&selection=$select&RepD=$Drep'>{$ListFiles[$i]}</a><br>";
                                $i++;
                            }
                        }
                        if ($nb==1){
                            if (!$filename){
                                echo extension("folder")."<a href='index.php?file=FileMove/plugin_config&dfolder=$folder_name&selection=$select&RepD=$Drep'>{$ListFiles[$i]}({$nb} {$lang_plugin_FileMove['file']})</a><br>";
                                $i++;
                            }else{
                                echo extension("folder")."<a href='index.php?file=FileMove/move_file&dfolder=$folder_name&selection=$select&RepD=$Drep'>{$ListFiles[$i]}({$nb} {$lang_plugin_FileMove['file']})</a><br>";
                                $i++;
                            }
                        }
                        if ($nb > 1){
                            if (!$filename){
                                echo extension("folder")."<a href='index.php?file=FileMove/plugin_config&dfolder=$folder_name&selection=$select&RepD=$Drep'>{$ListFiles[$i]}({$nb} {$lang_plugin_FileMove['files']})</a><br>";
                                $i++;
                            }else{
                                echo extension("folder")."<a href='index.php?file=FileMove/move_file&dfolder=$folder_name&selection=$select&RepD=$Drep'>{$ListFiles[$i]}({$nb} {$lang_plugin_FileMove['files']})</a><br>";
                                $i++;
                            }
                        }
                    }
                    list_dir ($folder_name, $step+1,$dfolder,$selection,$selection1,$Drep);              	
               
    }
    
}
/*********************************
*file_dir($dfolder)
*affichage du contenu du répertoire avec checkbox devant les noms de fichiers
*$dfolder: chemin relatif du répertoire à traiter
*********************************/
function file_dir($dfolder,$nb)
{
    global $num,$lang_plugin_FileMove,$CONFIG;
    $n=0;
    if ($dir = @opendir($dfolder))
    {
        while($file = readdir($dir))
        {
            if ($file !="." && $file != ".."&& $file !="edit"&& $file!="index.html"&&$file!="Thumbs.db"&&$file!=".DS_Store"&&$file!="no_FTP-uploads_into_this_folder!.txt"&&$file!="index.php")
            {               
                if (is_file($dfolder."/".$file))
                {
                    if (strpos($file, stristr($file,$CONFIG['normal_pfx'])) !== 0 && strpos($file, stristr($file,$CONFIG['thumb_pfx'])) !== 0)
                    {
                        if ($n < $nb)
                        {
                            echo "<td><input type='checkbox' name='file_name[]' value='$file'>".extension($file)."{$file}</td>";
                            $n++;
                            if ($n == $nb)
                            {
                                echo "</tr><tr>";
                                $n=0;
                            }
                        }
                    }
                }
             }
         }
    }
}
/*********************************
*path_name($dfolder)
*Extrait le nom du répertoire
*$dfolder: chemin relatif du répertoire à traiter
**********************************/
function path_name($dfolder)
{
    global $CONFIG;
    $path_leng=strlen($CONFIG['fullpath'])+3;
    $Drep=substr($dfolder,$path_leng);
    return $Drep;
}
/********************************
*action_select($dfolder)
*fonction d'affichage du menu de choix de l'action a mener (déplacement de l'ensemble du contenu du répertoire ou de certains fichiers)
*$dfolder: chemin relatif du répertoire à traiter
*********************************/
function action_select($dfolder,$selection)
{
    global $lang_plugin_FileMove,$selection,$Drep;
    $Drep=path_name($dfolder);	
    starttable('100%',$lang_plugin_FileMove['choix'],2);
$menu_action=<<<EOT
    <tr><td class="tableh2" align="left"><b>{$lang_plugin_FileMove['choix2']}</b></td>
    <td class="tableh2" align="right">{$lang_plugin_FileMove['DFolder']}<b>{$Drep}</b></td></tr>		
    <tr><td colspan="2" align="center">
    <a href="index.php?file=FileMove/plugin_config&dfolder=$dfolder&selection1=ok&selection=ok"><input type="button" name="all" value="{$lang_plugin_FileMove['folder']}"></a>
    <a href="index.php?file=FileMove/file_move&dfolder=$dfolder"><input type="button" name="some" value="{$lang_plugin_FileMove['some_files']}"></a>
    <a href="index.php?file=FileMove/plugin_config"><input type="button" name="back" value="{$lang_plugin_FileMove['back']}"></a>
    </td></tr>
EOT;
echo $menu_action;
endtable();
}
/***********************************
*confirm_choix($RepD,$Arep)
*fonction affichant les répertoires de départ et d'arrivée pour confirmation
*$ReD: répertoire de départ
*$Arep: répertoire d'arrivée
***********************************/
function confirm_choix($RepD,$Arep)
{
global $lang_plugin_FileMove;
starttable('100%',$lang_plugin_FileMove['confirm']);
$confirm=<<<EOT
    <tr><td align="center">{$lang_plugin_FileMove['confirm_titre']}</td></tr>
    <tr><td align="center">{$lang_plugin_FileMove['DFolder']}<b>{$RepD}</b>&nbsp;&nbsp;<img align="top" src="./plugins/FileMove/images/arrow.gif">&nbsp;&nbsp; {$lang_plugin_FileMove['AFolder']}<b>{$Arep}</b> </td></tr>
    <tr><td align="center">
    <a href="index.php?file=FileMove/move_folder&Drep=$RepD&Arep=$Arep"><input type="button" name="ok"value="{$lang_plugin_FileMove['valid']}"></a>
    <a href="index.php?file=FileMove/plugin_config"><input type="button" name="ok"value="{$lang_plugin_FileMove['back']}"></a>
    </td></tr>
EOT;
echo $confirm;
endtable();
}
function file_move($file_name,$DRep,$ARep)
{
    global $CONFIG;
    //Fichiers de départ
    $Dpath="./".$CONFIG['fullpath'].$DRep;
    $DFile=$Dpath.$file_name;
    $DFile_Thumb=$Dpath.$CONFIG['thumb_pfx'].$file_name;
    $DFile_Normal=$Dpath.$CONFIG['normal_pfx'].$file_name;
    //Fichiers d'arrivée
    $Apath="./".$CONFIG['fullpath'].$ARep;
    $AFile=$Apath.$file_name;
    $AFile_Thumb=$Apath.$CONFIG['thumb_pfx'].$file_name;
    $AFile_Normal=$Apath.$CONFIG['normal_pfx'].$file_name;
    //copie des fichiers,
    copy($DFile,$AFile);
    copy($DFile_Thumb,$AFile_Thumb);
    copy($DFile_Normal,$AFile_Normal);
    //modpack compatibility {Stramm}
    if(isset($CONFIG['mini_pfx'])) {
        $DFile_Mini=$Dpath.$CONFIG['mini_pfx'].$file_name;
        $DFile_Orig=$Dpath.$CONFIG['orig_pfx'].$file_name;
        $AFile_Mini=$Apath.$CONFIG['mini_pfx'].$file_name;
        $AFile_Orig=$Apath.$CONFIG['orig_pfx'].$file_name;
        if(file_exists($DFile_Mini)){
            if(copy($DFile_Mini,$AFile_Mini)) {
                unlink($DFile_Mini);
            }
        }
        if(file_exists($DFile_Orig)){
            if(copy($DFile_Orig,$AFile_Orig)) {
                unlink($DFile_Orig);
            }
        }
    }
    //effacement des fichiers d'origine
    unlink($DFile);
    unlink($DFile_Thumb);
    unlink($DFile_Normal);
}
?>