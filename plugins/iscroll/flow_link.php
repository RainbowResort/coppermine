<?php
/**
 * Coppermine Photo Gallery
 *
 * Copyright (c) 2003-2009 Coppermine Dev Team
 * v1.1 originally written by Gregory DEMAR
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * Coppermine version: 1.4.26
 *
 * isroll ver 2.1 
 * Based on mod. by rphMedia  http://forum.coppermine-gallery.net/index.php?action=profile;u=9702
 * Plugin Written by JR Carver - http://gallery.josephcarver.com/natural/ - http://i-imagine.net
 * 04 February 2010
*/

	define('IN_COPPERMINE', true);
	require('include/init.inc.php');

	$path=$CONFIG['site_url'];
	$i_count=$CONFIG['iscroll_cfg_count'];
	$i_thumbs=$CONFIG['iscroll_cfg_meta'];

	if ($i_thumbs == "1")  {
	$this_meta = <<< EOT
	$META_ALBUM_SET ORDER BY pid DESC
EOT;
}
	if ($i_thumbs == "2")  {
	$this_meta = <<< EOT
	AND hits > 0 $META_ALBUM_SET ORDER BY hits DESC, filename
EOT;
}
	if  ($i_thumbs == "3") {
	$this_meta = <<< EOT
	AND votes >= '{$CONFIG['min_votes_for_rating']}' $META_ALBUM_SET ORDER BY pic_rating DESC, votes DESC, pid DESC
EOT;
}
	if  ($i_thumbs == "4") {
	$this_meta = <<< EOT
	$META_ALBUM_SET ORDER BY RAND()
EOT;
}

	$xml = '<?xml version="1.0" encoding="iso-8859-1"?><content>';
	if ($FORBIDDEN_SET != "") $FORBIDDEN_SET = "AND $FORBIDDEN_SET";
	$result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PICTURES']} AS p WHERE filename LIKE '%.jpg' AND filename not like 'youtube_%' $FORBIDDEN_SET  $this_meta LIMIT $i_count");
	$row = mysql_fetch_array($result);
	while ($row = mysql_fetch_array($result)) 
	{
		$title = $row['title'];
		$title = str_replace(array('&amp;', '&quot;', '&lt;', '&gt;', '&#39;'), array('&', '"', '<', '>', "'"), $title);
		$type = max($row['pwidth'], $row['pheight']) > $CONFIG['picture_width'] ? 'thumb' : 'thumb';
		$xml .= "<image><path><![CDATA[" . $path . get_pic_url($row, $type) . "]]></path><description><![CDATA[" . $title . "]]></description><data><![CDATA[" . $path . "displayimage.php?pos=-" . $row['pid'] . "]]></data></image>";
	}
	$xml .= '</content>';
	echo $xml;
?>