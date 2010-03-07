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
* Coppermine Photo Gallery 1.4.x weekthumb.php
*
* This file can be called using an iframe into any other page
*
*/

define('WEEKTHUMB_PHP', true);
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
  $result = cpg_db_query($query, $dbi);
  $picture = mysql_fetch_array($result); 
  
  $img = "<img src=\"{$CONFIG['path_to']}albums/{$picture['filepath']}thumb_{$picture['filename']}\"  border=\"0\">"; 
  $content .= <<< EOT
    <table>
      <tr>
        <td align="center">
          <a href="{$CONFIG['path_to']}plugins/potd/week.php" target="new">$img</a><br />
          <br />
          {$lang_meta_album_names['potw']}<br />
          <small>{$lang_meta_album_names['by']}</small>
          <b><a href="{$CONFIG['path_to']}thumbnails.php?album=lastupby&uid={$picture['owner_id']}" target="new">{$picture['owner_name']}</a></b><br />
          <br />
          Click on the thumbnail above to see the Photo of the week and further info.<br />
          <br />
          <a href="{$CONFIG['path_to']}thumbnails.php?album=potwarch"  target="new">{$lang_meta_album_names['potwarch']}</a>
        </td>
      </tr>
    </table>

EOT;
  $stop++; 
} 

print $content;
?>
