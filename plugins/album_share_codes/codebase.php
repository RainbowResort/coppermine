<?php
/**************************************************
  Coppermine 1.5.x Plugin - album_share_codes
  *************************************************
  Copyright (c) 2010 eenemeenemuu
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

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

$thisplugin->add_action('post_breadcrumb', 'album_share_codes_main');

function album_share_codes_main() {
    $superCage = Inspekt::makeSuperCage();
    if ($superCage->get->testInt('album')) {
        global $CONFIG;
        $aid = $superCage->get->getInt('album');
        $result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PICTURES']} WHERE aid = '$aid'");
        if (mysql_num_rows($result) > 0) {
            while($row = mysql_fetch_assoc($result)) {
                $url = $CONFIG['ecards_more_pic_target'].'displayimage.php?pid='.$row['pid'];
                $thumb = $CONFIG['ecards_more_pic_target'].get_pic_url($row, 'thumb');
                $content1 .= '[url='.$url.'][img]'.$thumb.'[/img][/url]'."\n";
                $content2 .= '<a href="'.$url.'"><img src="'.$thumb.' /></a>'."\n";
            }
            starttable(-1, 'Share codes for <i>all files</i> in this album');
            echo <<<EOT
                <tr>
                    <td class="tableb">
                        <tt>[url][img][/url]</tt>: <textarea onfocus="this.select();" onclick="this.select();" class="textinput" rows="1" cols="64" wrap="off" style="overflow:hidden; height:15px;">{$content1}</textarea>
                        <br />
                        <tt>&lt;a&gt;&lt;img&gt;&lt;/a&gt;</tt>: <textarea onfocus="this.select();" onclick="this.select();" class="textinput" rows="1" cols="64" wrap="off" style="overflow:hidden; height:15px;">{$content2}</textarea>
                    </td>
                </tr>
EOT;
            endtable();
        }
    }
}

?>