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
*********************************************/
if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');
GLOBAL $lang_plugin_update_history,$FORBIDDENT_SET;
GLOBAL $CONFIG,$lastup_date_fmt;
$superCage = Inspekt::makeSuperCage();

require ('plugins/update_history/include/init.inc.php');
pageheader($lang_plugin_update_history['plugin_name']);
starttable("100%",$lang_plugin_update_history['archive_title']);
if ($superCage->post->keyExists('day_ok')){
	$choice=$superCage->post->getAlnum('choice');
	$days = $superCage->post->getAlnum('days');
	$end = time();
	$counter = array();
	$info = array();
	$FORBIDDEN_SET_UPD = ($FORBIDDEN_SET) ? "AND $FORBIDDEN_SET" : '';
if ($choice=="days"){
	
	starttable("100%",$lang_plugin_update_history['history'].$superCage->post->getAlnum('days').$lang_plugin_update_history['last_days']);
	for ($d = 0; $d < $days; $d++) {
		$start = strtotime(date("Ymd")) - ($d*60*60*24);
		$result = cpg_db_query("SELECT *,a.title AS album_title,p.owner_id AS owner FROM {$CONFIG['TABLE_PICTURES']} AS p,{$CONFIG['TABLE_ALBUMS']} AS a WHERE (APPROVED ='YES') AND (p.aid = a.aid)  AND (ctime BETWEEN $start AND $end) $FORBIDDEN_SET_UPD ORDER BY ctime DESC");
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
                echo '<tr><td class="tableb">' .$date. ": $number". $lang_plugin_update_history['new']."<a href=\"thumbnails.php?album={$album_info['aid']}\">$album</a>" ;
		} else {
                echo '<tr><td class="tableb">' .$date. ": $number". $lang_plugin_update_history['news']."<a href=\"thumbnails.php?album={$album_info['aid']}\">$album</a>" ;
		}
		$links = array();
		
		foreach ($users[$date][$album] as $u) {
			//if (USER_ID){ //uncoment this line if you don't want to show uploader name to unregistred users
				if ($u > 0) $links[] = $lang_plugin_update_history['by']."<a href=\"profile.php?uid=$u\">". get_username($u) ."</a>";
			}
		//}//uncoment this line if you don't want to show uploader name to unregistred users
		$out = array_unique($links);
		echo implode(', ',$out);
		echo "</td></tr>";
	}
	$i++;
}
	endtable();
}else{
$limit=$days;
	echo '<tr><td class="tableh2"><b>'.$lang_plugin_update_history['history'].$days.$lang_plugin_update_history_admin['uploaded_files'].'</b></td></tr>';
	
	$result=cpg_db_query("SELECT *,a.title AS album_title,p.owner_id AS owner FROM {$CONFIG['TABLE_PICTURES']} AS p,{$CONFIG['TABLE_ALBUMS']} AS a WHERE (APPROVED ='YES') AND (p.aid = a.aid) $FORBIDDEN_SET_UPD  ORDER BY ctime DESC LIMIT $days");
for ($d = 0; $d < $days; $d++) {	
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
}
starttable("100%",$lang_plugin_update_history['archive_setup']);
?>
<form id='update' name='update' action='<?php echo $superCage->server->getEscaped('REQUEST_URI')?>' method='post'>
<tr><td align="center"><?php echo $lang_plugin_update_history['day_nb'];?><input name="days" type="text" size="5"></td></tr>
<tr><td align="center"><input name="choice" type="radio" checked="true" value="days"><?php echo $lang_plugin_update_history_admin['days'];?></td></tr>
<tr><td align="center"><input name="choice" type="radio" value="last"><?php echo $lang_plugin_update_history_admin['last'];?></td></tr>
<tr><td align="center"><input name="day_ok" type="hidden" value="1">
<input name="submit" type="submit" value="<?php echo $lang_plugin_update_history['submit'];?>"></td></tr>
</form>
<?php


endtable();
endtable();
pagefooter();
mysql_free_result($result);
ob_end_flush();
?>
