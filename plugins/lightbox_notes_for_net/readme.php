<?php
/**************************************************
  Coppermine 1.5.x Plugin - LightBox (NotesFor.net)
  *************************************************
  Copyright (c) 2009 Joe Carver and Helori Lamberty
  *************************************************
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
  **************************************************/


	pageheader('LightBox Readme file');
	
	starttable("90%");
		
	$iscr_read = "plugins/lightbox_notes_for_net/readme.txt";
	$fh = fopen($iscr_read, 'r');
	$read_iscr = fread($fh, filesize($iscr_read));
	fclose($fh);
	
	echo <<< EOT
	<table border="0" cellspacing="2" cellpadding="2" width= "60%">
	<tr>
	<td class="tableb">
	<div style="white-space: pre; line-height: 1.5;"><span class="sc0">
	<a href="plugins/lightbox_notes_for_net/readme.txt" title="View as a plain text file">View/open this as a plain text file</a>
	$read_iscr
	</span></div>
EOT;

	endtable();

	pagefooter();
	
	ob_end_flush();

?>