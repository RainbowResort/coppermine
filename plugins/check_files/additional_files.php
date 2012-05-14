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

if ($superCage->get->getAlpha('do') == 'dashboard') {
    if ($CONFIG['plugin_check_files_status_additional'] == '') {
        header("Location: index.php?file=check_files/additional_files&do=new");
    }
    pageheader("Search for additional files - Dashboard");
    starttable("100%", "Search for additional files", 2);
    $view_continue = $CONFIG['plugin_check_files_status_additional'] == 'complete' ? 'View results of last run' : 'Continue incomplete run';
    echo <<< EOT
        <tr>
            <td class="tableb">
                <ul>
                    <li><a href="index.php?file=check_files/additional_files&amp;do=continue">$view_continue</a></li>
                    <li><a href="index.php?file=check_files/additional_files&amp;do=new">Delete results of last run and start new run</a></li>
                </ul>
            </td>
        </tr>
EOT;
    pagefooter();
    die();
}

if ($superCage->get->getAlpha('do') == 'continue') {
    if ($CONFIG['plugin_check_files_status_additional'] == 'complete') {
        header("Location: index.php?file=check_files/additional_files&do=view");
    }
    if (is_numeric($CONFIG['plugin_check_files_status_additional'])) {
        header("Location: index.php?file=check_files/additional_files&do=search#check_files_top");
    }
}

if ($superCage->get->getAlpha('do') == 'new') {
    cpg_db_query("DELETE FROM {$CONFIG['TABLE_PREFIX']}plugin_check_files_additional");
    cpg_db_query("DELETE FROM {$CONFIG['TABLE_PREFIX']}plugin_check_files_dirs");
    cpg_db_query("ALTER TABLE {$CONFIG['TABLE_PREFIX']}plugin_check_files_additional AUTO_INCREMENT = 1");
    cpg_db_query("ALTER TABLE {$CONFIG['TABLE_PREFIX']}plugin_check_files_dirs AUTO_INCREMENT = 1");
    cpg_db_query("INSERT INTO {$CONFIG['TABLE_PREFIX']}plugin_check_files_dirs (path) VALUES ('{$CONFIG['fullpath']}')");
    cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '1' WHERE name = 'plugin_check_files_status_additional'");
    header("Location: index.php?file=check_files/additional_files&do=search#check_files_top");
}

if ($superCage->get->getAlpha('do') == 'search') {
    if (!is_numeric($CONFIG['plugin_check_files_status_additional'])) {
        header("Location: index.php?file=check_files/additional_files&do=continue");
    }
    $CONFIG['debug_mode'] = 0;

    // Get directory contents
    $path_id = $CONFIG['plugin_check_files_status_additional'];
    $dir = mysql_result(cpg_db_query("SELECT path FROM {$CONFIG['TABLE_PREFIX']}plugin_check_files_dirs WHERE id = $path_id"), 0);
    if ($handle = opendir($dir)) {
        while (false !== ($file = readdir($handle))) {
            if ($file == '.' || $file == '..') {
                continue;
            }
            $path = $dir.$file;
            if (is_dir($path)) {
                $directory_path = $path.DIRECTORY_SEPARATOR;
                if ($directory_path == $CONFIG['fullpath'].'edit'.DIRECTORY_SEPARATOR) {
                    continue;
                }
                $dir_array[] = str_replace('\\', '/', $directory_path);
            } else {
                if ($file == 'no_FTP-uploads_into_this_folder!.txt') {
                    continue;
                }
                if (in_array($file, array('index.htm', 'index.html', 'index.php')) && filesize($path) == 1) {
                    continue;
                }
                if ($file == 'index.php' && strpos('<?', file_get_contents($path)) === FALSE) {
                    continue;
                }
                $file_array[] = $file;
            }
        }
        closedir($handle);
    }

    // Add directories to database
    sort($dir_array);
    foreach ($dir_array as $path) {
        cpg_db_query("INSERT INTO {$CONFIG['TABLE_PREFIX']}plugin_check_files_dirs (path) VALUES ('$path')");
    }
    $num_paths = mysql_result(cpg_db_query("SELECT MAX(id) FROM {$CONFIG['TABLE_PREFIX']}plugin_check_files_dirs"), 0);

    // Get current path's existing files from database
    if (count($file_array)) {
        $filepath = substr($dir, strlen($CONFIG['fullpath']));
        if ($filepath == "") {
            $filepath = "/";
        }
        $result = cpg_db_query("SELECT filename FROM {$CONFIG['TABLE_PICTURES']} WHERE filepath = '$filepath'");
        while ($row = mysql_fetch_assoc($result)) {
            $files_in_db_array[] = $row['filename'];
        }
        mysql_free_result($result);
    }

    // Add additional files to database
    $found = $superCage->get->getInt('found') ? $superCage->get->getInt('found') : 0;
    $prefix_array = array($CONFIG['thumb_pfx'], $CONFIG['normal_pfx'], $CONFIG['orig_pfx']);
    sort($file_array);
    foreach ($file_array as $file) {
        // Hide (custom) thumbnail, intermediate-sized and original pictures if full-sized exists
        foreach ($prefix_array as $prefix) {
            if (strpos($file, $prefix) === 0) {
                $filename_wo_prefix = substr($file, strlen($prefix));
                if (in_array($filename_wo_prefix, $file_array)) {
                    continue 2;
                }
                // Custom thumbnail?
                if ($prefix == $CONFIG['thumb_pfx']) {
                    $filename_wo_prefix_and_extension = substr($filename_wo_prefix, 0, strrpos($filename_wo_prefix, '.') + 1);
                    foreach ($file_array as $file_tmp) {
                        if (strpos($file_tmp, $filename_wo_prefix_and_extension) === 0) {
                            continue 3;
                        }
                    }
                }
            }
        }
        if (!in_array($file, $files_in_db_array)) {
            cpg_db_query("INSERT INTO {$CONFIG['TABLE_PREFIX']}plugin_check_files_additional (filepath, filename) VALUES('$filepath', '$file')");
            $found++;
        }
    }

    // Status
    $path_id += 1;
    if ($path_id <= $num_paths) {
        cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$path_id' WHERE name = 'plugin_check_files_status_additional'");
        $starttime = $superCage->get->getInt('starttime') ? $superCage->get->getInt('starttime') : time();
        $begin = date("H:i", $starttime);
        $elapsed = time() - $starttime;
        $remaining = round ($elapsed/($path_id/$num_paths) - $elapsed, 0);
        $end = date("H:i", time()+$remaining);
        pageheader("Search for additional files ({$path_id}/{$num_paths})");
        echo "<a name=\"check_files_top\"></a>";
        starttable("100%", "Search for additional files", 2);
        echo "
            <meta http-equiv=\"refresh\" content=\"0; URL=index.php?file=check_files/additional_files&amp;do=search&amp;found=$found&amp;starttime=$starttime#check_files_top\">
            <tr><td class=\"tableb\">Progress:</td><td class=\"tableb\">Reading directory $path_id of $num_paths (<tt>$dir</tt>)</td></tr>
            <tr><td class=\"tableb\">Start:</td><td class=\"tableb\">$begin</td></tr>
            <tr><td class=\"tableb\">Time elapsed:</td><td class=\"tableb\">$elapsed seconds</td></tr>
            <tr><td class=\"tableb\">Time remaining:</td><td class=\"tableb\">$remaining seconds</td></tr>
            <tr><td class=\"tableb\">End:</td><td class=\"tableb\">$end</td></tr>
            <tr><td class=\"tableb\">Additional&nbsp;files&nbsp;up&nbsp;to&nbsp;this&nbsp;point:</td><td class=\"tableb\" width=\"100%\">$found</td></tr>
        ";
        endtable();
        pagefooter();
    } else {
        cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = 'complete' WHERE name = 'plugin_check_files_status_additional'");
        header("Location: index.php?file=check_files/additional_files&do=view");
    }
}

if ($superCage->get->getAlpha('do') == 'view') {
    if ($CONFIG['plugin_check_files_status_additional'] != 'complete') {
        header("Location: index.php?file=check_files/additional_files&do=continue");
    }
    pageheader("Search for additional files - Results");
    starttable("100%", "Search for additional files", 2);
    $result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PREFIX']}plugin_check_files_additional ORDER BY filepath ASC, filename ASC");
    while ($row = mysql_fetch_assoc($result)) {
        $additional[$row['filepath']][] = $row['filename'];
    }
    if (!$additional) {
        echo "<tr><td class=\"tableb\" colspan=\"2\">There are no additional files in the albums directory, hooray!</tr></td>";
    } else {
        echo "<tr><td class=\"tableb\" colspan=\"2\">The following files aren't added to the database (grouped by expandable paths):</tr></td>";
        foreach($additional as $dir => $files) {
            if ($dir == '/') {
                $dir = './';
            }
            $id = "check_files_additional_".$i++;
            echo "<tr><td class=\"tableb\" colspan=\"2\"><span onclick=\"$('#{$id}').slideToggle();\" style=\"cursor:pointer;\">{$dir} [".count($files)."]</span></td></tr>";
            echo "<tr><td class=\"tableb\" colspan=\"2\"><div id=\"{$id}\" style=\"display:none;\"><table width=\"100%\" cellspacing=\"0\"><tr><td class=\"tableb\">";
            foreach($files as $file) {
                if ($dir == './') {
                    $dir = '';
                }
                $path = $CONFIG['fullpath'].$dir.$file;
                echo "<a href=\"$path\" target=\"check_files\">$path</a><br />";
            }
            echo "</td></tr></table></tr></td></div>";
        }
    }
    endtable();
    pagefooter();
}

?>