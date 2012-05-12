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

// Check the albums directory recursively for files that weren't added to the database (yet)

function get_all_directories() {
    global $CONFIG;

    $dir = $CONFIG['fullpath'];
    $found = array($dir);
    $directories = array($dir);

    while (sizeof($directories)) {
        $dir = array_pop($directories);
        if ($handle = opendir($dir)) {
            while (false !== ($file = readdir($handle))) {
                if ($file == '.' || $file == '..') {
                    continue;
                }
                $file  = $dir.$file;
                if (is_dir($file)) {
                    $directory_path = $file.DIRECTORY_SEPARATOR;
                    if ($directory_path == $CONFIG['fullpath'].'edit'.DIRECTORY_SEPARATOR) {
                        continue;
                    }
                    array_push($directories, $directory_path);
                    $found[] = str_replace('\\', '/', $directory_path);
                }
            }
            closedir($handle);
        }
    }
    sort($found);

    return $found;
} 

if (!$superCage->get->keyExists('dirs_read')) {
    pageheader("Directory tree");
    echo "<img src=\"images/loader.gif\" /> Reading directories";
    pagefooter();
    cpg_db_query("DROP TABLE IF EXISTS {$CONFIG['TABLE_PREFIX']}plugin_check_files_dirs");
    cpg_db_query("DROP TABLE IF EXISTS {$CONFIG['TABLE_PREFIX']}plugin_check_files_additional");
    cpg_db_query("CREATE TABLE {$CONFIG['TABLE_PREFIX']}plugin_check_files_dirs (
                    id int(11) NOT NULL auto_increment,
                    path varchar(255) NOT NULL,
                    PRIMARY KEY (id) )");
    cpg_db_query("CREATE TABLE {$CONFIG['TABLE_PREFIX']}plugin_check_files_additional (
                    id int(11) NOT NULL auto_increment,
                    filepath varchar(255) NOT NULL,
                    filename varchar(255) NOT NULL,
                    PRIMARY KEY (id) )");
    cpg_db_query("INSERT INTO {$CONFIG['TABLE_PREFIX']}plugin_check_files_dirs (path) VALUES ('".implode("'), ('", get_all_directories())."')");
    echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?file=check_files/additional_files&amp;dirs_read=done\">";
} else {
    $result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PREFIX']}plugin_check_files_dirs");
    while ($row = mysql_fetch_assoc($result)) {
        $path_array[] = $row['path'];
    }
    mysql_free_result($result);

    $starttime = $superCage->get->getInt('starttime') ? $superCage->get->getInt('starttime') : time();
    $found = $superCage->get->getInt('found') ? $superCage->get->getInt('found') : 0;
    $path_id = $superCage->get->getInt('path_id') ? $superCage->get->getInt('path_id') : 1;
    $num_paths = count($path_array);
    $progress = $path_id <= $num_paths ? round($path_id / $num_paths * 100, 2) : "100";
    pageheader("Search for additional files - {$progress}%");
    starttable("100%", "Search for additional files", 2);
    if ($path_id <= $num_paths) {
        $path = $path_array[$path_id];
        if ($handle = opendir($path)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != ".." && !is_dir($path.$file)) {
                    $file_array[] = $file;
                }
            }
            closedir($handle);
        }
        if (count($file_array)) {
            $filepath = substr($path, strlen($CONFIG['fullpath']));
            if ($filepath == "") {
                $filepath = "/";
            }
            $result = cpg_db_query("SELECT filename FROM {$CONFIG['TABLE_PICTURES']} WHERE filepath = '$filepath'");
            while ($row = mysql_fetch_assoc($result)) {
                $files_in_db_array[] = $row['filename'];
            }
            mysql_free_result($result);
        }
        //print_r($file_array);
        //print_r($files_in_db_array);
        //if ($path_id == 1) die();

        $prefix_array = array($CONFIG['thumb_pfx'], $CONFIG['normal_pfx'], $CONFIG['orig_pfx']);
        foreach ($file_array as $file) {
            foreach ($prefix_array as $prefix) {
                if (strpos($file, $prefix) === 0) {
                    $filename_wo_prefix = substr($file, strlen($prefix));
                    if (in_array($filename_wo_prefix, $file_array)) {
                        continue 2;
                    }
                }
            }
            if (!in_array($file, $files_in_db_array)) {
                cpg_db_query("INSERT INTO {$CONFIG['TABLE_PREFIX']}plugin_check_files_additional (filepath, filename) VALUES('$filepath', '$file')");
                $found++;
            }
        }

        $begin = date("H:i", $starttime);
        $elapsed = time() - $starttime;
        $remaining = round ($elapsed*100/$progress - $elapsed, 0);
        $end = date("H:i", time()+$remaining);
        $path_id += 1;
        echo "
            <meta http-equiv=\"refresh\" content=\"0; URL=index.php?file=check_files/additional_files&amp;dirs_read=done&amp;found=$found&amp;path_id=$path_id&amp;starttime=$starttime\">
            <tr><td class=\"tableb\">Progress:</td><td class=\"tableb\">{$progress}%</td></tr>
            <tr><td class=\"tableb\">Start:</td><td class=\"tableb\">$begin</td></tr>
            <tr><td class=\"tableb\">Time elapsed:</td><td class=\"tableb\">$elapsed seconds</td></tr>
            <tr><td class=\"tableb\">Time remaining:</td><td class=\"tableb\">$remaining seconds</td></tr>
            <tr><td class=\"tableb\">End:</td><td class=\"tableb\">$end</td></tr>
            <tr><td class=\"tableb\">Additional&nbsp;files&nbsp;up&nbsp;to&nbsp;this&nbsp;point:</td><td class=\"tableb\" width=\"100%\">$found</td></tr>
        ";
    } else {
        $result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PREFIX']}plugin_check_files_additional");
        while ($row = mysql_fetch_assoc($result)) {
            $additional[$row['filepath']][] = $row['filename'];
        }
        if (!$additional) {
            echo "<tr><td class=\"tableb\" colspan=\"2\">There are no additional files in the albums directory, hooray!</tr></td>";
        } else {
            echo "<tr><td class=\"tableb\" colspan=\"2\">The following files aren't added to the database (grouped by expandable paths):</tr></td>";
            foreach($additional as $dir => $files) {
                $id = "check_files_additional_".$i++;
                echo "<tr><td class=\"tableb\" colspan=\"2\"><span onclick=\"$('#{$id}').slideToggle();\" style=\"cursor:pointer;\">{$dir} [".count($files)."]</span></td></tr>";
                echo "<tr><td class=\"tableb\" colspan=\"2\"><div id=\"{$id}\" style=\"display:none;\"><table width=\"100%\" cellspacing=\"0\"><tr><td class=\"tableb\">";
                foreach($files as $file) {
                    echo $CONFIG['fullpath'].$dir.$file."<br />";
                }
                echo "</td></tr></table></tr></td></div>";
            }
        }
        cpg_db_query("DROP TABLE IF EXISTS {$CONFIG['TABLE_PREFIX']}plugin_check_files_dirs");
        cpg_db_query("DROP TABLE IF EXISTS {$CONFIG['TABLE_PREFIX']}plugin_check_files_additional");
    }

    pagefooter();
}

?>