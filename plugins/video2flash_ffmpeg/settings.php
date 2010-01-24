<?php
/**************************************************
  Coppermine 1.5.x Plugin - video2flash_ffmpeg
  *************************************************
  Copyright (c) 2010 Abbas Ali
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

if (!GALLERY_ADMIN_MODE) {
    cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__); 
}

if (video2flash_ffmpeg_install() !== 1) {
    cpgRedirectPage('pluginmgr.php', $lang_common['information'], 'Plugin settings saved successfully', 1);
}

pageheader('Configure Video to Flash Plugin');
starttable('100%', 'Configure : Video to Flash Plugin');
echo '<tr><td>';
video2flash_ffmpeg_configure();
echo '</tr></td>';
endtable();
pagefooter();
?>