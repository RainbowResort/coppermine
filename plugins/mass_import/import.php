<?php
/**************************************************
  Coppermine 1.5.x Plugin - mass_import
  *************************************************
  Copyright (c) 2010 Nibbler
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
  
define('IN_COPPERMINE', true);
define('ADDPIC_PHP', true);

require_once 'include/picmgmt.inc.php';
require_once './plugins/mass_import/init.inc.php';
$mass_import_init_array = mass_import_initialize();
$lang_plugin_mass_import = $mass_import_init_array['language']; 
$mass_import_icon_array = $mass_import_init_array['icon'];
$scriptname = 'index.php?file=mass_import/import';

if (!GALLERY_ADMIN_MODE) {
    cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
}

register_shutdown_function('reload');

$db_query_wrapper = 'cpg_db_query';

$output_array['row_start'] = <<< EOT
    <tr>
        <td>
EOT;
$output_array['row_end'] = <<< EOT
        </td>
    </tr>
EOT;
$output_array['row_separator'] = <<< EOT
        </td>
        <td>
EOT;

function dir_parse($path)
{
    global $CONFIG;
    $blockdirs=array('.','..','CVS','.svn',str_replace('/','',$CONFIG['userpics']),'edit','_vti_cnf');
    if ($dir = opendir($path)) {
        $thisdir = array();
        while (false !== ($file = readdir($dir))) {
            if  (!in_array($file,$blockdirs)) {
                if (is_dir("$path/$file")) {
                    $thisdir[$file] = dir_parse("$path/$file");
                } else {
                    $thisdir[] = $file;
                }
            }
        }
        return $thisdir;
    }
}

function createstructure($data, $parent, $path) {
    global $CONFIG, $filelist;
    $i = 0;
    $names = array_keys($data);
    $cat_names = array();
    foreach ($data as $set) {
        if (is_array($set)) {
            $cat_names[] = $names[$i];
        }
        $i++;
    }
    $i = 0;
    foreach ($cat_names as $name) {
        unset($aid);
        $base = true;
        foreach ($data[$name] as $lower) {
            if (is_array($lower)){
                $base = false;
                break;
            }
        }
        if ($base){
            $directory = $name;
        } else {
            $parent2 = createcategory($parent, $name);
            $directory = $data[$name];
        }
        if (is_array($directory)) {
            createstructure($directory, $parent2, "$path/$name");
        } else {
            if (!isset($aid)) {
                $aid = createalbum($parent, $name);
            }
            $contents = dir_parse("$path/$name");
            foreach ($contents as $file) {
                if (strncmp($file,$CONFIG['thumb_pfx'],strlen($CONFIG['thumb_pfx'])) != 0  &&  strncmp($file,$CONFIG['normal_pfx'],strlen($CONFIG['normal_pfx'])) != 0 &&  strncmp($file,'orig_',strlen('orig_')) != 0 && strncmp($file,'mini_',strlen('mini_')) != 0 && strpos('Thumbs.db',$file) === false ) {  
                    $filelist["$path/$name/$file"] = $aid;
                }
            }
        }
    }
}

function cleanupfilelist() {
    global $filelist, $CONFIG, $db_query_wrapper, $lang_plugin_mass_import, $output_array;

    $sql = "SELECT aid, CONCAT('./" . addslashes($CONFIG['fullpath']) . "',filepath,filename) As filepath FROM {$CONFIG['TABLE_PICTURES']} ORDER BY filepath";
    $result = $db_query_wrapper($sql);
    while($row = mysql_fetch_row($result)) {
        $arr[$row[1]] = $row[0];
    }
    flush();

    echo $output_array['row_start'] . $lang_plugin_mass_import['pics_found'] . ': ' . $output_array['row_separator'] . count($filelist) . $output_array['row_end'];
    echo $output_array['row_start'] . $lang_plugin_mass_import['pics_indb'] . ': ' . $output_array['row_separator'] . count($arr) . $output_array['row_end'];
    if (is_array($arr)) {
       $filelist = array_diff_assoc($filelist,$arr);
    }
    echo $output_array['row_start'] . $lang_plugin_mass_import['pics_afterfilter'] . ': ' . $output_array['row_separator'] . count($filelist) . $output_array['row_end'];
    //var_dump($filelist); //debug
}

function populatealbums()
{
    global $filelist, $counter;
    // Create the super cage
    $superCage = Inspekt::makeSuperCage();
    
    if ($superCage->post->keyExists('hardlimit') && $superCage->post->getInt('hardlimit') > 0) {
        $lim = $superCage->post->getInt('hardlimit');
    } else {
        $lim = getrandmax();
    }
        
    foreach ($filelist as $filename => $aid)
    {
        if ($counter < $lim)
        {
            set_time_limit(180);
            //echo "$filename - $aid<br />"; //chatty debug
            addpic($aid, $filename);
            $filelist = array_diff_assoc($filelist, array($filename => $aid));
            usleep($superCage->post->getInt('sleep') * 1000);
            $counter++;
        }
    }
}

function createcategory($parent, $name)
{
    global $CONFIG, $db_query_wrapper, $lang_plugin_mass_import, $output_array;

    $sql = "SELECT cid " . "FROM {$CONFIG['TABLE_CATEGORIES']} " . "WHERE name='" . addslashes($name) . "' AND parent=" . (INT)$parent . " LIMIT 1";
    $result = $db_query_wrapper($sql);

    if (mysql_num_rows($result)) {
        echo $output_array['row_start'] . $lang_plugin_mass_import['cat_exists'] . ': ' . $output_array['row_separator'] . $name. $output_array['row_end'];
        $row = mysql_fetch_row($result);
        $cid = $row[0];
    } else {
        $db_query_wrapper("INSERT INTO {$CONFIG['TABLE_CATEGORIES']} (pos, parent, name, description) VALUES ('10000', '$parent', '" . addslashes($name) . "', '')");
        echo $output_array['row_start'] . $lang_plugin_mass_import['cat_create'] . ': ' . $output_array['row_separator'] . $name. $output_array['row_end'];
        $cid = mysql_insert_id();
    }
    flush();

    return $cid;
}

function createalbum($category, $title)
{
    global $CONFIG, $db_query_wrapper, $lang_plugin_mass_import, $output_array;
    
    $sql = "SELECT aid " . "FROM {$CONFIG['TABLE_ALBUMS']} " . "WHERE title='" . addslashes($title) . "' AND category=" . (INT)$category . " LIMIT 1";
    $result = $db_query_wrapper($sql);

    if (mysql_num_rows($result)) {
        echo $output_array['row_start'] . $lang_plugin_mass_import['album_exists'] . ': ' . $output_array['row_separator'] . $title. $output_array['row_end'];
        $row = mysql_fetch_row($result);
        $aid = $row[0];
    } else {
        $db_query_wrapper("INSERT INTO {$CONFIG['TABLE_ALBUMS']} (category, title, pos, description) VALUES ('".(INT)$category."', '" . addslashes($title) . "', '10000', '')");
        echo $output_array['row_start'] . $lang_plugin_mass_import['album_create'].': ' . $output_array['row_separator'] . $title . $output_array['row_end'];
        $aid = mysql_insert_id();
    }
    flush();
    return $aid;
}

function addpic($aid, $pic_file)
{
    global $CONFIG, $db_query_wrapper, $lang_plugin_mass_import, $output_array, $mass_import_icon_array;
    
    $pic_file = str_replace('./' . $CONFIG['fullpath'], '', $pic_file);
    
    $dir_name = dirname($pic_file) . "/";
    $dir_name = ( substr($dir_name,0,1) == "/" ) ? substr($dir_name,1) : $dir_name;
    $file_name = basename($pic_file);
    $sane_name = str_replace('%20', '_', $file_name);
    $sane_name = preg_replace('/[^a-zA-Z0-9\.\-_]/', '_', $sane_name);
    $sane_name = preg_replace('/[^a-zA-Z0-9\.\-_]/', '_', $sane_name);
    while ( strpos($sane_name,'__') !== FALSE ) {
        $sane_name = str_replace('__', '_', $sane_name);
    }
    $c = 0;
    $sane_name2 = $sane_name;
    
    $sql = "SELECT pid " . "FROM {$CONFIG['TABLE_PICTURES']} " . "WHERE filepath='" . addslashes($dir_name) . "' AND filename='" . addslashes($sane_name) . "' " . "LIMIT 1";
    $result = $db_query_wrapper($sql);
    
    $extra = strstr($pic_file, $sane_name) ? '' : " (as $sane_name)";
    if (mysql_num_rows($result)) {
        echo $output_array['row_start'] . $mass_import_icon_array['cancel'] . $lang_plugin_mass_import['file_already_in_database'] . ': ' . $output_array['row_separator'] . $pic_file . $output_array['row_end'];
    } else {
        while (($sane_name != $file_name) && file_exists("./" . $CONFIG['fullpath'] . $dir_name . $sane_name))
        {
            $c++;
            $sane_name = $c . '_' . $sane_name2;
        }
    
        $source = "./" . $CONFIG['fullpath'] . $dir_name . $file_name;
        rename($source, "./" . $CONFIG['fullpath'] . $dir_name . $sane_name);
    
        if (add_picture($aid, $dir_name, $sane_name, $file_name)) {
            echo $output_array['row_start'] . $mass_import_icon_array['ok'] . $lang_plugin_mass_import['file_added_to_database'] . ': ' . $output_array['row_separator'] . $pic_file . $output_array['row_end']; 
        } else {
            echo $output_array['row_start'] . $mass_import_icon_array['stop'] . $lang_plugin_mass_import['failed_to_add_file_to_database'] . ': ' . $output_array['row_separator'] . $pic_file . $output_array['row_end']; 
        }
    }
    flush();
}

function reload()
{
    global $filelist, $counter, $lang_plugin_mass_import, $output_array, $lang_common, $mass_import_icon_array;
    // Create the super cage
    $superCage = Inspekt::makeSuperCage();
    
    if ($superCage->post->keyExists('auto') ||
        $superCage->post->keyExists('directory') ||
        $superCage->post->keyExists('sleep') ||
        $superCage->post->keyExists('hardlimit')) {
        // Do nothing
    } else {
        exit();
    }
    
    $remaining = countup($filelist);
    
    $filelist = base64_encode(serialize($filelist));
    if ($superCage->post->keyExists('auto') && $superCage->post->getInt('auto') == 1) {
        $auto = 'checked = "checked"';
    } else {
        $auto = '';
    }
    if ($counter != 0) {
        $counter = $output_array['row_start'] . $lang_plugin_mass_import['files_added']. ': ' . $output_array['row_separator'] . $counter . $output_array['row_end'];
    } else {
        $counter = $output_array['row_start'] . $lang_plugin_mass_import['structure_created'] . $output_array['row_separator'] . $output_array['row_end'];
    }
    if ($superCage->post->keyExists('directory')) {
        $directory = $superCage->post->getRaw('directory'); // We rely on the fact that only the admin can run this page
    } else {
        $directory = '';
    }
    if ($superCage->post->keyExists('sleep')) {
        $sleep = $superCage->post->getInt('sleep');
    } else {
        $sleep = '1000';
    }
    if ($superCage->post->keyExists('hardlimit')) {
        $hardlimit = $superCage->post->getInt('hardlimit');
    } else {
        $hardlimit = '0';
    }
    $js = ($superCage->post->keyExists('auto') && $remaining) ? '<script type="text/javascript"> onload = document.form.submit();</script>' : ''; 
    
    if (!connection_aborted()) {
    echo $counter;
    echo $output_array['row_start'] . $lang_plugin_mass_import['files_to_add'] . ': ' . $output_array['row_separator'] . $remaining . $output_array['row_end'];
    echo <<< EOT
    {$output_array['row_start']}
        <input name="filelist" type="hidden" value="$filelist" />
        <input type="hidden" name="directory" value="$directory" />	
        {$lang_plugin_mass_import['sleep_desc']}:
        {$output_array['row_separator']}	
        <input type="text" name="sleep" id="sleep" value="{$sleep}" size="5" maxlength="5" class="textinput spin-button" /> ({$lang_plugin_mass_import['in_milliseconds']})
        {$output_array['row_end']}
        {$output_array['row_start']}
        {$lang_plugin_mass_import['hardlimit_desc']}: 
        {$output_array['row_separator']}	
        <input type="text" name="hardlimit" id="hardlimit" value="{$hardlimit}" size="3" maxlength="3" class="textinput spin-button" />
        {$output_array['row_end']}
        {$output_array['row_start']}
        <label for="auto" class="clickable_option">{$lang_plugin_mass_import['autorun_desc']}</label>: 
        {$output_array['row_separator']}	
        <input type="checkbox" name="auto" id="auto" value="1" class="checkbox" $auto />
        {$output_array['row_end']}
        {$output_array['row_start']}
        <button type="submit" class="button" name="continue" value="{$lang_common['continue']}">{$mass_import_icon_array['continue']}{$lang_common['continue']}</button>
        {$output_array['row_separator']}
        {$output_array['row_end']}

EOT;
    }
echo $js;
endtable();
echo <<< EOT
    </form>
EOT;
pagefooter();
}
    
function countup($array)
{
    $result = 0;

    foreach ($array as $a)
        $result += is_array($a) ? countup($a) : count($a);

    return $result;
}

pageheader($lang_plugin_mass_import['name']);
echo <<< EOT
<form name="form" method="POST" action="$scriptname">
EOT;
starttable('100%', $mass_import_icon_array['table'] . $lang_plugin_mass_import['name'], 2, 'cpg_zebra');
$post_directory = $superCage->post->getRaw('directory');


if ($superCage->post->keyExists('filelist')){
    $filelist = unserialize(base64_decode($superCage->post->getRaw('filelist'))); // We rely on the fact that only the admin can use this page in the first place
    $counter = 0;
    //echo '<br />';
    populatealbums();

} elseif ($superCage->post->keyExists('start')) {

    $data = dir_parse('./' . $CONFIG['fullpath'] . trim($post_directory));

    if (!$superCage->post->keyExists('directory')) {
        echo $output_array['row_start'] . $lang_plugin_mass_import['root_use']. $output_array['row_separator'] . $output_array['row_end'];
        $parent=0;
    } else {
        $sql = "SELECT cid " . "FROM {$CONFIG['TABLE_CATEGORIES']} " . "WHERE parent='0' AND name='" . $post_directory . "' " . "LIMIT 1";
        $result = $db_query_wrapper($sql);
        if (mysql_num_rows($result)) {
            echo $output_array['row_start'] . $lang_plugin_mass_import['root_exists'].": " . $output_array['row_separator'] . $post_directory . $output_array['row_end'];
            $row = mysql_fetch_row($result);
            $cid = $row[0];
        } else {
            $db_query_wrapper("INSERT INTO {$CONFIG['TABLE_CATEGORIES']} (pos, parent, name, description) VALUES ('10000', '0', '{$post_directory}', '')");
            echo $output_array['row_start'] . $lang_plugin_mass_import['root_create'] . $output_array['row_separator'] . $output_array['row_end'];
            $cid = mysql_insert_id();
        }
    }

    $path = ( trim($post_directory) == "" ) ? rtrim($CONFIG['fullpath'],"/") : $CONFIG['fullpath'] . trim($post_directory);

    echo $output_array['row_start'] . $lang_plugin_mass_import['path'].": " . $output_array['row_separator'] . $path . $output_array['row_end'];

    createstructure($data, $cid, './' . $path);

    cleanupfilelist();
    

} else {

    echo <<< EOT
    <tr>
        <td>
            {$lang_plugin_mass_import['subdir_desc']}:
        </td>
        <td>
            <input type="text" name="directory" id="directory" value="" size="100" maxlength="255" class="textinput" />
        </td>
    </tr>
    <tr>
        <td>
            {$lang_plugin_mass_import['sleep_desc']}:
        </td>
        <td>
            <input type="text" name="sleep" id="sleep" value="1000" size="5" maxlength="5" class="textinput spin-button" /> 
            ({$lang_plugin_mass_import['in_milliseconds']})
        </td>
    </tr>
    <tr>
        <td>
            <label for="auto" class="clickable_option">{$lang_plugin_mass_import['autorun_desc']}</label>:
        </td>
        <td>
            <input type="checkbox" name="auto" id="auto" value="1" class="checkbox" />
        </td>
    </tr>
    <tr>
        <td>
            {$lang_plugin_mass_import['hardlimit_desc']}:
        </td>
        <td>
            <input type="text" name="hardlimit" id="hardlimit" value="10" size="3" maxlength="3" class="textinput spin-button" />
        </td>
    </tr>
    <tr>
        <td colspan="2" class="tablef">
            <button type="submit" class="button" name="start" value="{$lang_common['go']}">{$mass_import_icon_array['continue']}{$lang_common['go']}</button>
        </td>
    </tr>


EOT;
}

?>