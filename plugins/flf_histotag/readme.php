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
 * Coppermine version: 1.5.xx
 *
 * 
 *
*/


	pageheader('flf exif Readme file');
	
	starttable("90%");
		
	$iscr_read = "plugins/flf_histotag/readme.txt";
	$fh = fopen($iscr_read, 'r');
	$read_iscr = fread($fh, filesize($iscr_read));
	fclose($fh);
	
	echo <<< EOT
	<table border="0" cellspacing="2" cellpadding="2" width= "60%">
	<tr>
	<td class="tableb">
	<div style="white-space: pre; line-height: 1.5;"><span class="sc0">
	<a href="plugins/flf_histotag/readme.txt" title="View as a plain text file">View/open this as a plain text file</a>
	$read_iscr
	</span></div>
EOT;

	endtable();

	pagefooter();
	
	ob_end_flush();

?>