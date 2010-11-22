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
                $thumb = '[img]'.$CONFIG['ecards_more_pic_target'].get_pic_url($CURRENT_PIC_DATA, 'thumb').'[/img]';
                $content1 .= '[url='.$url.']'.$thumb.'[/url]'."\n";
            }
            echo '<tt>[url][img][/url]</tt>: <br /><textarea onfocus="this.select();" onclick="this.select();" class="textinput" rows="1" cols="64" wrap="off" style="overflow:hidden; height:15px;">'.$content1.'</textarea>';
        }
    }
}

?>