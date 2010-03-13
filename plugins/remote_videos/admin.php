<?php
/**************************************************
  Coppermine 1.5.x Plugin - remote_videos
  *************************************************
  Copyright (c) 2009-2010 eenemeenemuu
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

if (!GALLERY_ADMIN_MODE) {
    cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
}

pageheader("Remote Videos - ".$lang_gallery_admin_menu['admin_lnk']);
$superCage = Inspekt::makeSuperCage();
global $lang_common;


if ($superCage->post->keyExists('submit')) {
    if (!checkFormToken()) {
        global $lang_errors;
        cpg_die(ERROR, $lang_errors['invalid_form_token'], __FILE__, __LINE__);
    }

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

    function remote_videos_save_value($name) {
        if (!GALLERY_ADMIN_MODE) {
            global $lang_errors;
            cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
        }
        global $CONFIG;
        $superCage = Inspekt::makeSuperCage();
        $new_value = $superCage->post->getInt($name);
        
        if ($new_value >= 0) {
            if (!isset($CONFIG[$name])) {
                cpg_db_query("INSERT INTO {$CONFIG['TABLE_CONFIG']} (name, value) VALUES('$name', '$new_value')");
                $CONFIG[$name] = $new_value;
            } elseif ($new_value != $CONFIG[$name]) {
                cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$new_value' WHERE name = '$name'");
                $CONFIG[$name] = $new_value;
            }
        }
    }
    remote_videos_save_value('remote_video_movie_width');
    remote_videos_save_value('remote_video_movie_height');

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


echo "<form action=\"index.php?file=remote_videos/admin\" method=\"post\" name=\"custform\">";
starttable("100%", "Remote Videos - ".$lang_gallery_admin_menu['admin_lnk'], 3);
echo "
    <tr>
        <td class=\"tableb\" width=\"200\">
            <strong>Hoster</strong>
        </td>
        <td class=\"tableb\" width=\"200\">
            <strong>Extension</strong>
        </td>
        <td class=\"tableb\">
            <strong>Allow new uploads</strong>
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

$movie_width = $CONFIG['remote_video_movie_width'] ? $CONFIG['remote_video_movie_width'] : 0;
$movie_height = $CONFIG['remote_video_movie_height'] ? $CONFIG['remote_video_movie_height'] : 0;
starttable("100%", "Overwrite default video dimensions", 2);
echo <<<EOT
    <tr>
        <td class="tableb" width="200">
            Width (0 = use default)
        </td>
        <td class="tableb">
            <input type="input" class="textinput" size="5" name="remote_video_movie_width" value="$movie_width" /> px
        </td>
    </tr>
    <tr>
        <td class="tableb" width="200">
            Height (0 = use default) 
        </td>
        <td class="tableb">
            <input type="input" class="textinput" size="5" name="remote_video_movie_height" value="$movie_height" /> px
        </td>
    </tr>
EOT;
endtable();

list($timestamp, $form_token) = getFormToken();
echo "<input type=\"hidden\" name=\"form_token\" value=\"{$form_token}\" />";
echo "<input type=\"hidden\" name=\"timestamp\" value=\"{$timestamp}\" />";
echo "<input type=\"submit\" value=\"{$lang_common['apply_changes']}\" name=\"submit\" class=\"button\" /> ";
echo "<input type=\"reset\" value=\"reset\" name=\"reset\" class=\"button\" /> </form>";
pagefooter();

?>