<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2005 Coppermine Dev Team
  v1.1 originaly written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  ********************************************
  Adapted for CPG 1.5.* by daxad # http://forum.coppermine-gallery.net/index.php?action=profile;u=45771
  Plugin Created by Frantz 04/11/2006
*/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');
require ('plugins/update_history/include/init.inc.php');
// Add an install & configure & uninstall actions
$thisplugin->add_action('plugin_install','update_history_install');
$thisplugin->add_action('plugin_configure','update_history_configure');
$thisplugin->add_action('plugin_uninstall','update_history_uninstall');
$thisplugin->add_action('plugin_cleanup','update_history_cleanup');
// Add block action
$thisplugin->add_filter('plugin_block','update_history');


//install function
function update_history_install()
{
	$superCage = Inspekt::makeSuperCage();
  global $CONFIG, $lang_plugin_update_history_config, $thisplugin;
	require ('plugins/update_history/include/init.inc.php');
	if ($superCage->post->getAlnum('submit')==$lang_plugin_update_history_config['button_install']) {
		require 'include/sql_parse.php';
		//if(!isset($CONFIG['fex_enable'])) {
		//	$query="INSERT INTO ".$CONFIG['TABLE_CONFIG']." VALUES ('fex_enable', '1');";
		//	cpg_db_query($query);
			// create table
			$db_schema = $thisplugin->fullpath . '/schema.sql';
			$sql_query = fread(fopen($db_schema, 'r'), filesize($db_schema));
			$sql_query = preg_replace('/CPG_/', $CONFIG['TABLE_PREFIX'], $sql_query);

			$sql_query = remove_remarks($sql_query);
			$sql_query = split_sql_file($sql_query, ';');

			foreach($sql_query as $q) {
				cpg_db_query($q);
			}
			// Put default setting
			$db_schema = $thisplugin->fullpath . '/basic.sql';
			$sql_query = fread(fopen($db_schema, 'r'), filesize($db_schema));
			$sql_query = preg_replace('/CPG_/', $CONFIG['TABLE_PREFIX'], $sql_query);

			$sql_query = remove_remarks($sql_query);
			$sql_query = split_sql_file($sql_query, ';');

			foreach($sql_query as $q) {
				cpg_db_query($q);
			}

		//}
		return true;
	} else {
		return 1;
	}
}

// Configure Plugin
function update_history_configure()
{
	$superCage = Inspekt::makeSuperCage();
  global $CONFIG, $lang_plugin_update_history_config;
	require ('plugins/update_history/include/init.inc.php');

	echo "<tr><td><h2>".$lang_plugin_update_history_config['install_click']."</h2></td></tr>";
	echo "<tr><td>".$lang_plugin_update_history_config['install_note']."</td></tr>";
	echo "<tr><td>".$lang_plugin_update_history_config['display_block']."</td></tr>";
	echo "<tr><td><form action=\"{$superCage->server->getEscaped('REQUEST_URI')}\" method=\"post\">";
	echo "<input type=\"submit\" value=\"{$lang_plugin_update_history_config['button_install']}\" name=\"submit\" /></form></td></tr>";

}
// Uninstall (ask admin about dropping table)
function update_history_uninstall()
{
	$superCage = Inspekt::makeSuperCage();
  global $CONFIG, $thisplugin;

	if (!$superCage->post->keyExists('drop')) return 1;

	if ($superCage->post->getInt('drop')) {
		cpg_db_query("DROP TABLE IF EXISTS {$CONFIG['TABLE_PREFIX']}update_history_config");
		//cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name='fex_enable';");
   	}
	return true;
}
// Ask if admin wants to drop the table
function update_history_cleanup($action)
{
    global $lang_plugin_update_history_config;
$superCage = Inspekt::makeSuperCage();
    require ('plugins/update_history/include/init.inc.php');

    if ($action===1) {
        echo <<< EOT
    <form action="{$superCage->server->getEscaped('REQUEST_URI')}" method="post">
        <p>
            {$lang_plugin_update_history_config['cleanup_question']}
        </p>
        <div style="margin:25;">
        <table border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td><input type="radio" name="drop" value="1" /></td>
                <td>{$lang_plugin_update_history_config['yes']}</td>
            </tr>
            <tr>
                <td><input type="radio" name="drop" checked="checked" value="0" /></td>
                <td>{$lang_plugin_update_history_config['no']}</td>
            </tr>
        </table>
        </div>
        <span>
           <input type="submit" name="submit" value="{$lang_plugin_update_history_config['button_submit']}" /> &nbsp;&nbsp;&nbsp;
            <input type="button" name="cancel" onClick="window.location='pluginmgr.php';" value="{$lang_plugin_update_history_config['button_cancel']}" />
        </span>
    </form>
EOT;
    }
}
function update_history($html)
{
$superCage = Inspekt::makeSuperCage();
GLOBAL $CONFIG, $matches,$cat,$USER_DATA, $FORBIDDEN_SET;
GLOBAL $lang_plugin_update_history,$lastup_date_fmt;
require ('plugins/update_history/include/init.inc.php');
$CONFIG['TABLE_UPDATE_HISTORY_CONFIG'] = $CONFIG['TABLE_PREFIX'].'update_history_config';
$Group_Id=$USER_DATA['groups'][0];
$result=cpg_db_query("select * FROM {$CONFIG['TABLE_UPDATE_HISTORY_CONFIG']} WHERE Group_Id=$Group_Id");
$param=mysql_fetch_array($result);

//settings
$GID=$param['Group_Id'];
$bloc=$param['bloc'];
$archive=$param['archive'];
$uploader_name=$param['uploader_name'];
$days=$param['days'];
if ($superCage->get->keyExists('cat')) {
    $cat = $superCage->get->getInt('cat');
} else {
        $cat = '';
}

$nb=intval($param['number']);
$end = time();
$counter = array();
$info = array();
$FORBIDDEN_SET_UPD = ($FORBIDDEN_SET) ? "AND $FORBIDDEN_SET" : '';
$CAT_FILTER = ($cat) ? "AND a.category = $cat" : '';
//if $bloc set to 1 display the block
if($matches[1] != 'updatehistory'|| !$bloc=="1" ) {
          return $matches;
}
//if GALLERY_ADMIN_MODE, display button to plugin admin page
if (GALLERY_ADMIN_MODE){
//if $archive set to 1, button displayed to acces to the plugin archive page
	if ($archive=="1"){
		$bloc_title=$lang_plugin_update_history['update']."&nbsp;&nbsp;&nbsp;<a class=\"admin_menu\" href=\"index.php?file=update_history/history_archive\">{$lang_plugin_update_history[archive]}</a>&nbsp;&nbsp;&nbsp;<a class=\"admin_menu\" href=\"index.php?file=update_history/history_admin\">{$lang_plugin_update_history[admin]}</a>";
	}else{
		$bloc_title=$lang_plugin_update_history['update']."&nbsp;&nbsp;&nbsp;<a class=\"admin_menu\" href=\"index.php?file=update_history/history_admin\">{$lang_plugin_update_history[admin]}</a>";
	}
}else{
	if ($archive=="1"){
		$bloc_title=$lang_plugin_update_history['update']."&nbsp;&nbsp;&nbsp;<a class=\"admin_menu\" href=\"index.php?file=update_history/history_archive\">{$lang_plugin_update_history[archive]}</a>";
	}else{
		$bloc_title=$lang_plugin_update_history['update'];
	}
}
//display update history bloc
starttable("100%",$bloc_title );
//If $days set to 1 show the last uploads since the $nb last days (default setting)
if ($days=="1"){
	echo '<tr><td class="tableh2"><b>'.$lang_plugin_update_history['history'].$nb.$lang_plugin_update_history['last_days'].'</b></td></tr>';
for ($d = 0; $d < $nb; $d++) {
	$start = strtotime(date("Ymd")) - ($d*60*60*24);
$result = cpg_db_query("SELECT *,a.title AS album_title,p.owner_id AS owner FROM {$CONFIG['TABLE_PICTURES']} AS p,{$CONFIG['TABLE_ALBUMS']} AS a WHERE (APPROVED ='YES') AND (p.aid = a.aid)  AND (ctime BETWEEN $start AND $end) $FORBIDDEN_SET_UPD $CAT_FILTER ORDER BY ctime DESC");
	while ($row = mysql_fetch_assoc($result)) {
		$day = localised_date($row['ctime'],$plugin_update_history_date_fmt);
		//$day = ($day, $lastup_date_fmt);
		$counter[$day][$row[album_title]] += 1;
		$info[$day][$row[album_title]] = $row;
		$users[$day][$row[album_title]][] = $row['owner'];
	}
	$end = $start;
}

$i = 0;
$test = array_keys($counter);

foreach ($counter as $day) {
	foreach ($day as $album => $number) {
		$date = $test[$i];
		$album_info = $info[$date][$album];
		if ($number == 1) {
                echo '<tr><td class="tableb">' .$date. ": $number". $lang_plugin_update_history['new']."<a href=\"thumbnails.php?album={$album_info['aid']}\">$album</a>";
		} else {
                echo '<tr><td class="tableb">' .$date. ": $number". $lang_plugin_update_history['news']."<a href=\"thumbnails.php?album={$album_info['aid']}\">$album</a>" ;
		}
		$links = array();

		foreach ($users[$date][$album] as $u) {
			if ($uploader_name==1){ //show the uploader name if $uploader_name set to 1
				if ($u > 0) $links[] = $lang_plugin_update_history['by']."<a href=\"profile.php?uid=$u\">". get_username($u) ."</a>";
			}
		}
		$out = array_unique($links);
		echo implode(', ',$out);
		echo "</td></tr>";
	}
	$i++;
	}
}else{
//otheerway Show n last uploaded files according settings
$limit=$nb;
	echo '<tr><td class="tableh2"><b>'.$lang_plugin_update_history['history'].$nb.$lang_plugin_update_history_admin['uploaded_files'].'</b></td></tr>';

	$result=cpg_db_query("SELECT *,a.title AS album_title,p.owner_id AS owner FROM {$CONFIG['TABLE_PICTURES']} AS p,{$CONFIG['TABLE_ALBUMS']} AS a WHERE (APPROVED ='YES') AND (p.aid = a.aid) $FORBIDDEN_SET_UPD $CAT_FILTER  ORDER BY ctime DESC LIMIT $nb");
for ($d = 0; $d < $nb; $d++) {
	while($row=mysql_fetch_assoc($result)){
		$day = localised_date($row['ctime'],$plugin_update_history_date_fmt);
		$album=$row['album_title'];
		$thumb=$CONFIG['fullpath']."/".$row['filepath']."/".$CONFIG['thumb_pfx'].$row['filename'];
		echo '<tr><td class="tableb">' .$day.": <a href=\"displayimage.php?pos=-$row[pid]\"><img border=\"1\" width=\"{$CONFIG['alb_list_thumb_size']}\" src=\"{$thumb}\" alt=\"{$row['filename']}\" title=\"{$row['filename']}\"/></a>".$lang_plugin_update_history['add']."<a href=\"thumbnails.php?album={$row['aid']}\">$album</a>";
		if ($uploader_name==1){ //show the uploader name if $uploader_name set to 1
			$links[] = $lang_plugin_update_history['by']."<a href=\"profile.php?uid=$u\">".get_username($row['owner'])."</a>";
		}
		$out = array_unique($links);
		echo implode(', ',$out);
		echo "</td></tr>";
		}
	}

}
endtable();
mysql_free_result($result);
}
?>
