<?php
/**************************************************
  Coppermine Plugin - PotD/PotW
  *************************************************
  Copyright (c) 2006 Paul Van Rompay
  Plugin based on Mod by Casper, Copyright 2005
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
***************************************************/

/**
* Coppermine Photo Gallery 1.4.x potw.php
*
* This file file gets included in the index.php if you set the option in admin
* can be used to display any content from any program, it is always to be edited
* according to tastes and then used
*
*/

define('POTW_PHP', true);
define('IN_COPPERMINE', true);

global $prefix, $dbi, $lang_meta_album_names, $CONFIG; 

starttable("100%", "{$lang_meta_album_names['potw']}");

$content = '';
{
  $query = <<< EOT
    SELECT p.pid, aid, filepath, filename, owner_name, owner_id 
      FROM {$CONFIG['TABLE_PLUGIN_POTD']} AS pp LEFT JOIN {$CONFIG['TABLE_PICTURES']} AS p 
      ON p.pid=pp.pid 
    WHERE pp.potw='1'
EOT;
  $result = cpg_db_query($query, $dbi); 
  $picture = mysql_fetch_array($result); 

  $img = "<img src=\"albums/{$picture['filepath']}normal_{$picture['filename']}\"  border=\"0\">"; 
  $content .= <<<EOT
    <tr>
      <td align="center"><a href="displayimage.php?pos=-{$picture['pid']}">$img</a><br />
        <br />
        <big>{$lang_meta_album_names['potw']}</big><br />
        <small>{$lang_meta_album_names['by']}</small>
        <b><a href="thumbnails.php?album=lastupby&uid={$picture['owner_id']}">{$picture['owner_name']}</a></b><br />
        <a href="thumbnails.php?album=potwarch">{$lang_meta_album_names['potwarch']}</a>
      </td>
    </tr>
EOT;

  $stop++; 
} 
print $content;

endtable();
?>
