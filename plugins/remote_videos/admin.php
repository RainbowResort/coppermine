<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2008 Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  Coppermine version: 1.5.0
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**********************************************/
/*********************************************
  Coppermine Plugin - Remote Videos
  ********************************************
  Copyright (c) 2009 eenemeenemuu
**********************************************/

if (!GALLERY_ADMIN_MODE) {
    cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
}

pageheader("Remote Videos - ".$lang_gallery_admin_menu['admin_lnk']);
$superCage = Inspekt::makeSuperCage();
global $lang_common;


if ($superCage->post->keyExists('submit')) {
    foreach(remote_videos_get_hoster() as $filetype => $value) {
        global $CONFIG;
        if ($superCage->post->getInt($filetype) == 1) {
            if (strpos($CONFIG['allowed_mov_types'], $filetype) === FALSE) {
                $CONFIG['allowed_mov_types'] .= "/{$filetype}";
            }
            if (mysql_result(cpg_db_query("SELECT COUNT(*) FROM {$CONFIG['TABLE_FILETYPES']} WHERE extension = '{$filetype}'"),0) == "0") {
                cpg_db_query("INSERT INTO {$CONFIG['TABLE_FILETYPES']} (extension,mime,content,player) VALUES ('{$filetype}','application/x-shockwave-flash','movie','SWF')");
            }
        } else {
            $CONFIG['allowed_mov_types'] = str_replace("/{$filetype}", '', $CONFIG['allowed_mov_types']);
            $CONFIG['allowed_mov_types'] = str_replace("{$filetype}/", '', $CONFIG['allowed_mov_types']);
            $CONFIG['allowed_mov_types'] = str_replace("{$filetype}", '', $CONFIG['allowed_mov_types']);
        }
        cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '{$CONFIG['allowed_mov_types']}' WHERE name = 'allowed_mov_types'");
    }
    
    starttable("100%", $lang_common['information']);
    echo "
        <tr>
            <td class=\"tableb\" width=\"200\">
                Settings saved
            </td>
        </tr>
    ";
    endtable();
    echo "<br />";
}


echo "<form action=\"index.php?file=".$superCage->get->getRaw(file)."\" method=\"post\" name=\"custform\">";
starttable("100%", "Remote Videos - ".$lang_gallery_admin_menu['admin_lnk'], 3);
echo "
    <tr>
        <td class=\"tableb\" width=\"200\">
            Hoster
        </td>
        <td class=\"tableb\" width=\"200\">
            Extension
        </td>
        <td class=\"tableb\">
            Allow new uploads
        </td>
    </tr>
";

foreach(remote_videos_get_hoster() as $key => $value) {
    global $CONFIG;
    $checked = strpos($CONFIG['allowed_mov_types'], $key) ? "checked=\"checked\" " : "";
    echo "
        <tr>
            <td class=\"tableb\" width=\"200\">
                $value
            </td>
            <td class=\"tableb\" width=\"200\">
                .$key
            </td>
            <td class=\"tableb\">
                <input type=\"checkbox\" class=\"checkbox\" name=\"$key\" value=\"1\" {$checked}/>
            </td>
        </tr>
    ";
}

echo "
    <script type=\"text/javascript\">
    function selectall(el)
    {
        var checked = el.checked;
        var elements = el.form.elements;
        for(var i = 0; i < elements.length;i++)
            if(elements[i].type.toLowerCase() == 'checkbox') elements[i].checked = checked;
    }
    </script>

    <tr>
        <td class=\"tableb\" width=\"200\">
            
        </td>
        <td class=\"tableb\" width=\"200\">
            &nbsp;
        </td>
        <td class=\"tableb\">
            <input type=\"checkbox\" class=\"checkbox\" name=\"selectall\" onclick=\"window.selectall(this);\"> <i>select all</i>
        </td>
    </tr>
";


endtable();

echo "<input type=\"submit\" value=\"{$lang_common['apply_changes']}\" name=\"submit\" class=\"button\" /> ";
echo "<input type=\"reset\" value=\"reset\" name=\"reset\" class=\"button\" /> </form>";
pagefooter();

?>