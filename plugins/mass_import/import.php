<?php
/*************************
  mass_import Plugin for cpg1.5.x
  ************************
  Copyright (c) 2003-2009 Coppermine Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  Coppermine version: 1.5.x
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**********************************************/
define('IN_COPPERMINE', true);
define('ADDPIC_PHP', true);


require_once('include/picmgmt.inc.php');

if (!GALLERY_ADMIN_MODE) die('Access denied');



register_shutdown_function('reload');

$db_query_wrapper = 'cpg_db_query';

$icon_array['ok']  = cpg_fetch_icon('ok', 1);

function dir_parse($path)
{
    global $CONFIG;
    $blockdirs=array('.','..','CVS','.SVN',str_replace('/','',$CONFIG['userpics']),'edit','_vti_cnf');
	if ($dir = opendir($path))
	{
		$thisdir = array();
		while (false !== ($file = readdir($dir)))
		{
			if  (!in_array($file,$blockdirs))
			{
				if (is_dir("$path/$file"))
				{
					$thisdir[$file] = dir_parse("$path/$file");
				} else {
					$thisdir[] = $file;
				}
			}
		}
		return $thisdir;
	}
}

function createstructure($data, $parent, $path)
{
	global $CONFIG, $filelist;
	
	$i = 0;
	
	$names = array_keys($data);

	$cat_names = array();

	foreach ($data as $set)
	{
		if (is_array($set)) $cat_names[] = $names[$i];
		$i++;
	}

	$i = 0;
	
	foreach ($cat_names as $name)
	{
		unset($aid);
		
		$base = true;

		foreach ($data[$name] as $lower)
		{
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
		
		if (is_array($directory))
		{
			createstructure($directory, $parent2, "$path/$name");
		} else {
			if (!isset($aid)) $aid = createalbum($parent, $name);
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
	global $filelist, $CONFIG, $db_query_wrapper, $lang_plugin_mass_import;

	$sql = "SELECT aid, CONCAT('./" . addslashes($CONFIG['fullpath']) . "',filepath,filename) As filepath FROM {$CONFIG['TABLE_PICTURES']} ORDER BY filepath";
    $result = $db_query_wrapper($sql);
	while($row = mysql_fetch_row($result)) {
		$arr[$row[1]] = $row[0];
	}
	flush();

	echo count($filelist) ." ". $lang_plugin_mass_import['pics_found'] . "<br />";
	echo count($arr) ." ". $lang_plugin_mass_import['pics_indb'] . "<br />";
	if (is_array($arr)) {
	   $filelist = array_diff_assoc($filelist,$arr);
	}
	echo $lang_plugin_mass_import['pics_afterfilter']. " " . count($filelist) . " ". $lang_plugin_mass_import['pics_to_add'] ."<br />";
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
	//$lim = $_POST['hardlimit'] > 0 ? $_POST['hardlimit'] : getrandmax();
		
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
	global $CONFIG, $db_query_wrapper, $lang_plugin_mass_import;

	$sql = "SELECT cid " . "FROM {$CONFIG['TABLE_CATEGORIES']} " . "WHERE name='" . addslashes($name) . "' AND parent=" . (INT)$parent . " LIMIT 1";
    $result = $db_query_wrapper($sql);

    if (mysql_num_rows($result)) {
		echo $lang_plugin_mass_import['cat_exists']." : $name<br />";
		$row = mysql_fetch_row($result);
		$cid = $row[0];
	} else {
		$db_query_wrapper("INSERT INTO {$CONFIG['TABLE_CATEGORIES']} (pos, parent, name) VALUES ('10000', '$parent', '" . addslashes($name) . "')");
		echo $lang_plugin_mass_import['cat_create'].": $name<br/>";
		$cid = mysql_insert_id();
	}
	flush();

	return $cid;
}

function createalbum($category, $title)
{
	global $CONFIG, $db_query_wrapper, $lang_plugin_mass_import;
	
	$sql = "SELECT aid " . "FROM {$CONFIG['TABLE_ALBUMS']} " . "WHERE title='" . addslashes($title) . "' AND category=" . (INT)$category . " LIMIT 1";
    $result = $db_query_wrapper($sql);

    if (mysql_num_rows($result)) {
		echo $lang_plugin_mass_import['album_exists']." : $title<br />";
		$row = mysql_fetch_row($result);
		$aid = $row[0];
	} else {
		$db_query_wrapper("INSERT INTO {$CONFIG['TABLE_ALBUMS']} (category, title, pos) VALUES ('".(INT)$category."', '" . addslashes($title) . "', '10000')");
		echo $lang_plugin_mass_import['album_create']." : $title<br/>";
		$aid = mysql_insert_id();
	}
	flush();
	return $aid;
}

function addpic($aid, $pic_file)
{
	global $CONFIG, $db_query_wrapper, $lang_plugin_mass_import;
	
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
		echo $lang_plugin_mass_import['picture']." '$pic_file' ".$lang_plugin_mass_import['already']."$extra<br />";
	} else {
		while (($sane_name != $file_name) && file_exists("./" . $CONFIG['fullpath'] . $dir_name . $sane_name))
		{
			$c++;
			$sane_name = $c . '_' . $sane_name2;
		}
	
		$source = "./" . $CONFIG['fullpath'] . $dir_name . $file_name;
		rename($source, "./" . $CONFIG['fullpath'] . $dir_name . $sane_name);
	
		if (add_picture($aid, $dir_name, $sane_name, $file_name)) {
			echo $lang_plugin_mass_import['picture']." '$pic_file' ".$lang_plugin_mass_import['added']."$extra<br />"; 
		} else {
			echo $lang_plugin_mass_import['picture']." '$pic_file' ".$lang_plugin_mass_import['failed']."$extra<br />"; 
		}
	}
	flush();
}

function reload()
{
	global $filelist, $counter, $lang_plugin_mass_import, $lang_continue;
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
	//$auto = (isset($_POST['auto']) && $_POST['auto']) ? 'checked = "checked"' : '';
	$counter = $counter ? "$counter ".$lang_plugin_mass_import['files_added'] : $lang_plugin_mass_import['structure_created'];
	if ($superCage->post->keyExists('directory')) {
	    $directory = $superCage->post->getRaw('directory'); // We rely on the fact that only the admin can run this page
	} else {
	    $directory = '';
	}
	//$directory = isset($_POST['directory'])  ? $_POST['directory'] : '';
	if ($superCage->post->keyExists('sleep')) {
	    $sleep = $superCage->post->getInt('sleep');
	} else {
	    $sleep = '1000';
	}
	//$sleep = isset($_POST['sleep'])  ? $_POST['sleep'] : '1000';
	if ($superCage->post->keyExists('hardlimit')) {
	    $hardlimit = $superCage->post->getInt('hardlimit');
	} else {
	    $hardlimit = '0';
	}
	//$hardlimit = isset($_POST['hardlimit'])  ? $_POST['hardlimit'] : '0';
	$js = ($superCage->post->keyExists('auto') && $remaining) ? '<script type="text/javascript"> onload = document.form.submit();</script>' : ''; 
	$scriptname = 'index.php?file=mass_import/import';
	
	if (!connection_aborted()) echo <<< EOT
	</br>
	$counter, $remaining {$lang_plugin_mass_import['files_to_add']}.<br />
	<form name="form" method="POST" action="$scriptname">
		<input name="filelist" type="hidden" value="$filelist">
		<input type="hidden" name="directory" value="$directory">	
		{$lang_plugin_mass_import['sleep']}: <input type="text" name="sleep" value="$sleep">
		{$lang_plugin_mass_import['hardlimit']}: <input type="text" name="hardlimit" value="$hardlimit">
		<input type="submit" value="$lang_continue" />
		{$lang_plugin_mass_import['autorun']}: <input type="checkbox" name="auto" value="1" $auto>
	</form>

EOT;
pagefooter();
echo $js;
}
	
function countup($array)
{
	$result = 0;

	foreach ($array as $a)
		$result += is_array($a) ? countup($a) : count($a);

	return $result;
}

pageheader($lang_plugin_mass_import['name']);
$post_directory = $superCage->post->getRaw('directory');

if ($superCage->post->keyExists('filelist')){
	$filelist = unserialize(base64_decode($superCage->post->getRaw('filelist'))); // We rely on the fact that only the admin can use this page in the first place
	$counter = 0;
	echo '<br />';
	populatealbums();

} elseif ($superCage->post->keyExists('start')) {

	$data = dir_parse('./' . $CONFIG['fullpath'] . trim($post_directory));

	if (!$superCage->post->keyExists('directory')) {
        echo $lang_plugin_mass_import['root_use'].'<br />';
        $parent=0;
    } else {
        $sql = "SELECT cid " . "FROM {$CONFIG['TABLE_CATEGORIES']} " . "WHERE parent='0' AND name='" . $post_directory . "' " . "LIMIT 1";
    	$result = $db_query_wrapper($sql);
        if (mysql_num_rows($result)) {
			echo $lang_plugin_mass_import['root_exists']." : " . $post_directory . "<br />";
			$row = mysql_fetch_row($result);
			$cid = $row[0];
		} else {
			$db_query_wrapper("INSERT INTO {$CONFIG['TABLE_CATEGORIES']} (pos, parent, name) VALUES ('10000', '0', '{$post_directory}')");
			echo $lang_plugin_mass_import['root_create'].'<br />';
			$cid = mysql_insert_id();
		}
	}

	$path = ( trim($post_directory) == "" ) ? rtrim($CONFIG['fullpath'],"/") : $CONFIG['fullpath'] . trim($post_directory);

	echo $lang_plugin_mass_import['path'].": " . $path . "</br>";

	createstructure($data, $cid, './' . $path);

	cleanupfilelist();

} else {

	$scriptname = 'index.php?file=mass_import/import';
		echo <<< EOT
	
    <form method="POST" action="$scriptname">
EOT;
	
	starttable('100%', $lang_plugin_mass_import['name'],2,'cpg_zebra');

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
	        <input type="text" name="sleep" id="sleep" value="1000" size="5" maxlength="5" class="textinput" />
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
	        <input type="text" name="hardlimit" id="hardlimit" value="10" size="4" maxlength="5" class="textinput" />
	    </td>
	</tr>
	<tr>
	    <td colspan="2" class="tablef">
	        <button type="submit" class="button" name="start" value="{$lang_common['go']}">{$icon_array['ok']}{$lang_common['go']}</button>
	    </td>
	</tr>


EOT;
endtable();
echo <<< EOT
    </form>
EOT;
}

?>