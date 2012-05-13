<?php
/**************************************************
  Coppermine 1.5.x Plugin - Check files
  *************************************************
  Copyright (c) 2012 eenemeenemuu
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

$CONFIG['debug_mode'] = 0;

$limit_offset = $superCage->get->getInt('offset') ? $superCage->get->getInt('offset') : 0;
$limit_row_count = $superCage->get->getInt('row_count') ? $superCage->get->getInt('row_count') : 500;
$starttime = $superCage->get->getInt('starttime') ? $superCage->get->getInt('starttime') : time();
$numpics = $superCage->get->getInt('numpics') ? $superCage->get->getInt('numpics') : mysql_result(cpg_db_query("SELECT COUNT(*) FROM {$CONFIG['TABLE_PICTURES']}"),0);
$found = $superCage->get->getInt('found') ? $superCage->get->getInt('found') : 0;

if (!$superCage->get->keyExists('offset')) {
    cpg_db_query("DROP TABLE IF EXISTS {$CONFIG['TABLE_PREFIX']}plugin_check_files_missing");
    cpg_db_query("CREATE TABLE {$CONFIG['TABLE_PREFIX']}plugin_check_files_missing (
                    id int(11) NOT NULL auto_increment,
                    filepath varchar(255) NOT NULL,
                    filename varchar(255) NOT NULL,
                    PRIMARY KEY (id) )");
}

$filetype = array();
$result = cpg_db_query("SELECT extension FROM {$CONFIG['TABLE_FILETYPES']} WHERE content = 'image'");
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    $filetype[] = $row[0];
}

$result = cpg_db_query("SELECT filepath, filename, pwidth, pheight FROM {$CONFIG['TABLE_PICTURES']} ORDER BY filepath LIMIT $limit_offset, $limit_row_count");
while ($file = mysql_fetch_assoc($result)) {
    if (!file_exists($CONFIG['fullpath'].$file['filepath'].$file['filename'])) {
        cpg_db_query("INSERT INTO {$CONFIG['TABLE_PREFIX']}plugin_check_files_missing (filepath, filename) VALUES('{$file['filepath']}', '{$file['filename']}')");
        $found++;
    }

    if (is_image($file['filename'])) {
        if (!file_exists($CONFIG['fullpath'].$file['filepath'].$CONFIG['thumb_pfx'].$file['filename'])) {
            cpg_db_query("INSERT INTO {$CONFIG['TABLE_PREFIX']}plugin_check_files_missing (filepath, filename) VALUES('{$file['filepath']}', '{$CONFIG['thumb_pfx']}{$file['filename']}')");
            $found++;
        }

        if ($CONFIG['make_intermediate'] && cpg_picture_dimension_exceeds_intermediate_limit($file['pwidth'], $file['pheight'])) {
            if(!file_exists($CONFIG['fullpath'].$file['filepath'].$CONFIG['normal_pfx'].$file['filename'])) {
                cpg_db_query("INSERT INTO {$CONFIG['TABLE_PREFIX']}plugin_check_files_missing (filepath, filename) VALUES('{$file['filepath']}', '{$CONFIG['normal_pfx']}{$file['filename']}')");
                $found++;
            }
        }

        /*
        if ($CONFIG['enable_watermark']) {
            if(!file_exists($CONFIG['fullpath'].$file['filepath'].$CONFIG['orig_pfx'].$file['filename'])) {
                cpg_db_query("INSERT INTO {$CONFIG['TABLE_PREFIX']}plugin_check_files_missing (filepath, filename) VALUES('{$file['filepath']}', '{$CONFIG['orig_pfx']}{$file['filename']}')");
                $found++;
            }
        }
        */
    }
}
$limit_offset += $limit_row_count;
$progress = $limit_offset <= $numpics ? round($limit_offset / $numpics * 100, 2) : "100";
$begin = date("H:i", $starttime);
$elapsed = time() - $starttime;
$remaining = round ($elapsed*100/$progress - $elapsed, 0);
$end = date("H:i", time()+$remaining);
pageheader("Search for missing files - {$progress}%");
echo "<a name=\"check_files_top\"></a>";
starttable("100%", "Search for missing files", 2);
if ($limit_offset <= $numpics) {
    echo "
        <meta http-equiv=\"refresh\" content=\"0; URL=index.php?file=check_files/missing_files&amp;offset=$limit_offset&amp;found=$found&amp;row_count=$limit_row_count&amp;numpics=$numpics&amp;starttime=$starttime#check_files_top\">
        <tr><td class=\"tableb\">Progress:</td><td class=\"tableb\">{$progress}% (checking files ".($limit_offset - $limit_row_count)." - $limit_offset of $numpics)</td></tr>
        <tr><td class=\"tableb\">Start:</td><td class=\"tableb\">$begin</td></tr>
        <tr><td class=\"tableb\">Time elapsed:</td><td class=\"tableb\">$elapsed seconds</td></tr>
        <tr><td class=\"tableb\">Time remaining:</td><td class=\"tableb\">$remaining seconds</td></tr>
        <tr><td class=\"tableb\">End:</td><td class=\"tableb\">$end</td></tr>
        <tr><td class=\"tableb\">Missing&nbsp;files&nbsp;up&nbsp;to&nbsp;this&nbsp;point:</td><td class=\"tableb\" width=\"100%\">$found</td></tr>
    ";
} else {
    $result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PREFIX']}plugin_check_files_missing ORDER BY filepath ASC, filename ASC");
    while ($row = mysql_fetch_assoc($result)) {
        $missing[$row['filepath']][] = $row['filename'];
    }
    if (!$missing) {
        echo "<tr><td class=\"tableb\" colspan=\"2\">There are no missing files in the albums directory, hooray!</tr></td>";
    } else {
        echo "<tr><td class=\"tableb\" colspan=\"2\">The following files are missing in the albums directory (grouped by expandable paths):</tr></td>";
        foreach($missing as $dir => $files) {
            $id = "check_files_missing_".$i++;
            echo "<tr><td class=\"tableb\" colspan=\"2\"><span onclick=\"$('#{$id}').slideToggle();\" style=\"cursor:pointer;\">{$dir} [".count($files)."]</span></td></tr>";
            echo "<tr><td class=\"tableb\" colspan=\"2\"><div id=\"{$id}\" style=\"display:none;\"><table width=\"100%\" cellspacing=\"0\"><tr><td class=\"tableb\">";
            foreach($files as $file) {
                echo $CONFIG['fullpath'].$dir.$file."<br />";
            }
            echo "</td></tr></table></tr></td></div>";
        }
    }
    cpg_db_query("DROP TABLE {$CONFIG['TABLE_PREFIX']}plugin_check_files_missing");
}
endtable();
pagefooter();
exit;

?>