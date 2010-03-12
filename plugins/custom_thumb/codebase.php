<?php
/**************************************************
  Coppermine 1.5.x Plugin - Custom Thumbnail
  *************************************************
  Copyright (c) 2009 eenemeenemuu
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

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

$thisplugin->add_action('page_start','custom_thumb_page_start');
$thisplugin->add_filter('file_data','custom_thumb_file_data');


function custom_thumb_page_start() {
    global $CONFIG, $lang_errors;
    $superCage = Inspekt::makeSuperCage();

    if ($superCage->get->keyExists('custom_thumb_pid')) {
        $pid = $superCage->get->getInt('custom_thumb_pid');
        $result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PICTURES']} AS p INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS a ON a.aid = p.aid WHERE p.pid = '$pid' LIMIT 1");
        $row = mysql_fetch_assoc($result);

        if (!((USER_ADMIN_MODE && $row['category'] == FIRST_USER_CAT + USER_ID) || ($CONFIG['users_can_edit_pics'] && $row['owner_id'] == USER_ID && USER_ID != 0) || GALLERY_ADMIN_MODE)) {
            load_template();
            cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
        }

        require_once "./plugins/custom_thumb/lang/english.php";
        if ($CONFIG['lang'] != 'english' && file_exists("./plugins/custom_thumb/lang/{$CONFIG['lang']}.php")) {
            require_once "./plugins/custom_thumb/lang/{$CONFIG['lang']}.php";
        }

        if ($superCage->files->keyExists('fileupload') && $row) {
            if (!checkFormToken()) {
                load_template();
                global $lang_errors;
                cpg_die(ERROR, $lang_errors['invalid_form_token'], __FILE__, __LINE__);
            }

            $fileupload = $superCage->files->getRaw('fileupload');

            if ($fileupload['error']) {
                load_template();
                cpg_die(ERROR, $lang_errors['error'].' '.$fileupload['error'], __FILE__, __LINE__);
            }

            if (is_image($fileupload['name'])) {
                if (!is_image($row['filename'])) {
                    $path_parts = pathinfo($row['filename']);
                    $row['filename'] = str_replace($row['filename'], basename($row['filename'], '.'.$path_parts['extension']).'.jpg', $row['filename']);
                }
                $thumb = $CONFIG['fullpath'] . $row['filepath'] . $CONFIG['thumb_pfx'] . $row['filename'];
                if (move_uploaded_file($fileupload['tmp_name'], $thumb) == TRUE) {
                    require('include/picmgmt.inc.php');
                    resize_image($thumb, $thumb, $CONFIG['thumb_width'], $CONFIG['thumb_method'], $CONFIG['thumb_use']);
                }
            } else {
                load_template();
                cpg_die(ERROR, $lang_plugin_custom_thumb['error_images_only'], __FILE__, __LINE__);
            }

            header("Location: {$CONFIG['site_url']}displayimage.php?pid=$pid");
            die();
        } else {
            load_template();
            pageheader($lang_plugin_custom_thumb['custom_thumbnail']);
            echo '<form method="post" enctype="multipart/form-data">';
            starttable('60%', $lang_plugin_custom_thumb['upload_custom_thumbnail'], 2);
            list($timestamp, $form_token) = getFormToken();
            echo <<< EOT
                <tr>
                    <td class="tableb" valign="top">
                        {$lang_plugin_custom_thumb['browse']}:
                    </td>
                    <td class="tableb" valign="top">
                        <input type="file" name="fileupload" size="40" class="listbox" />
                    </td>
                </tr>
                <tr>
                    <td align="center" colspan="2" class="tablef">
                        <input type="hidden" name="form_token" value="{$form_token}" />
                        <input type="hidden" name="timestamp" value="{$timestamp}" />
                        <input type="submit" name="commit" class="button" value="{$lang_plugin_custom_thumb['upload']}"/>
                    </td>
                </tr>
EOT;
            endtable();
            echo '</form>';
            pagefooter();
            exit;
        }
    }
}


function custom_thumb_file_data($data) {
    global $CONFIG, $CURRENT_ALBUM_DATA;

    if ((USER_ADMIN_MODE && $CURRENT_ALBUM_DATA['category'] == FIRST_USER_CAT + USER_ID) || ($CONFIG['users_can_edit_pics'] && $data['owner_id'] == USER_ID && USER_ID != 0) || GALLERY_ADMIN_MODE) {
        require_once "./plugins/custom_thumb/lang/english.php";
        if ($CONFIG['lang'] != 'english' && file_exists("./plugins/custom_thumb/lang/{$CONFIG['lang']}.php")) {
            require_once "./plugins/custom_thumb/lang/{$CONFIG['lang']}.php";
        }
        $custom_thumb_menu_icon = ($CONFIG['enable_menu_icons'] > 0) ? '<img src="images/icons/file_approval.png" border="0" width="16" height="16" class="icon" /> ' : '';
        $menu_button = "<li><a href=\"?custom_thumb_pid={$data['pid']}\" class=\"admin_menu\">{$custom_thumb_menu_icon}{$lang_plugin_custom_thumb['custom_thumbnail']}</a></li>";
        $data['menu'] = str_replace('</ul>', $menu_button.'</ul>', $data['menu']);
    }
    return $data;
}

?>