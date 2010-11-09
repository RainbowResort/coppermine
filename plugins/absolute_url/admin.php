<?php
/**************************************************
  Coppermine 1.5.x Plugin - absolute_url
  *************************************************
  Copyright (c) 2010 eenemeenemuu
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

pageheader("Absolute picture urls - ".$lang_gallery_admin_menu['admin_lnk']);
$superCage = Inspekt::makeSuperCage();

$url = $superCage->post->keyExists('url') ? $superCage->post->getRaw('url') : $CONFIG['plugin_absolute_url_url'];

if ($superCage->post->keyExists('submit')) {
    if (!checkFormToken()) {
        global $lang_errors;
        cpg_die(ERROR, $lang_errors['invalid_form_token'], __FILE__, __LINE__);
    }

    if (!preg_match('/(^http:\/\/.*\/$)|^$/', $url)) {
        starttable("100%", $lang_common['error']);
        echo "
            <tr>
                <td class=\"tableb\" width=\"200\">
                    URL '$url' has <b>not</b> been saved. It has to start with 'http://' and needs a trailing slash!
                </td>
            </tr>
        ";
        endtable();
        echo "<br />";
    } else {
        $success = false;
        if (!array_key_exists('plugin_absolute_url_url', $CONFIG)) {
            if (cpg_db_query("INSERT INTO {$CONFIG['TABLE_CONFIG']} (name, value) VALUES ('plugin_absolute_url_url', '$url')")) {
                $success = true;
            }
        } else {
            if (cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$url' WHERE name = 'plugin_absolute_url_url'")) {
                $success = true;
            }
        }

        if ($success) {
            starttable("100%", $lang_common['information']);
            $message = $url ? "URL '$url' has been successfully saved." : "URL has been deleted.";
            echo "
                <tr>
                    <td class=\"tableb\" width=\"200\">
                        $message
                    </td>
                </tr>
            ";
            endtable();
            echo "<br />";
        }
    }
}

global $lang_common;
list($timestamp, $form_token) = getFormToken();
starttable("100%", "Absolute picture urls - ".$lang_gallery_admin_menu['admin_lnk'], 3);
echo "
    <tr>
        <td class=\"tableb\" width=\"200\">
            <form action=\"index.php?file=absolute_url/admin\" method=\"post\">
                URL of your CDN: <img src=\"images/help.gif\" style=\"cursor: help;\"title=\"Leave blank if you don't host your pictures on an external website.\" /> <input type=\"input\" class=\"textinput\" size=\"75\" name=\"url\" value=\"$url\" />
                <input type=\"submit\" value=\"{$lang_common['apply_changes']}\" name=\"submit\" class=\"button\" />
                <input type=\"hidden\" name=\"form_token\" value=\"{$form_token}\" />
                <input type=\"hidden\" name=\"timestamp\" value=\"{$timestamp}\" />
            </form>
        </td>
    </tr>
";
endtable();

pagefooter();
?>