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
* Coppermine Photo Gallery 1.4.x showweekpic.php
*
* This file can be called directly, or into another page using an iframe
*
*/

define('SHOWWEEKPIC_PHP', true);
define('IN_COPPERMINE', true);

require('include/init.inc.php');
global $prefix, $dbi; 

$content = '';
{
  $query = <<< EOT
    SELECT p.pid, aid, filepath, filename, owner_name, owner_id  
      FROM {$CONFIG['TABLE_PLUGIN_POTD']} AS pp LEFT JOIN {$CONFIG['TABLE_PICTURES']} AS p 
      ON p.pid=pp.pid 
    WHERE pp.potw='1'
EOT;
  $result = cpg_db_query($query, $dbi); // aid numbers can be changed as need to respect permissions
  $picture = mysql_fetch_array($result); 
  
  $img = "<img src=\"{$CONFIG['path_to']}albums/{$picture['filepath']}normal_{$picture['filename']}\"  border=\"0\">"; 
  $content .= <<< EOT
    <table width="378px" height="410px" border="0" cellpadding="0" cellspacing="0" align="center">
      <tr>
        <td align="center"><a href="{$CONFIG['path_to']}displayimage.php?pos=-{$picture['pid']}" target="new">$img</a><br />
          <br />
          <big>{$lang_meta_album_names['potw']}</big><br />
          <small>{$lang_meta_album_names['by']}</small>
          <b><a href="{$CONFIG['path_to']}thumbnails.php?album=lastupby&uid={$picture['owner_id']}" target="new">{$picture['owner_name']}</a></b><br />
          <br />
          <a href="{$CONFIG['path_to']}thumbnails.php?album=potwarch" target="new">{$lang_meta_album_names['potwarch']}</a><br />
        </td>
      </tr>
    </table>

EOT;
  $stop++; 
} 

print $content;
?>
