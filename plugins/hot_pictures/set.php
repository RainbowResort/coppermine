<?php
if (USER_ID) {
    $pid = $superCage->get->getInt('pid');
    $days = $superCage->get->getInt('hot');
    if ($days === 0) {
        cpg_db_query("UPDATE {$CONFIG['TABLE_PICTURES']} SET hot_expire = 0 WHERE pid = $pid");
        $set = 0;
    } elseif (in_array($days, array(1, 2, 3))) {
        cpg_db_query("UPDATE {$CONFIG['TABLE_PICTURES']} SET hot_expire = ".(time()+60*60*24*$days)." WHERE pid = $pid");
        $set = $days;
    } else {
        $set = -1;
    }
    header("Location: displayimage.php?pid=$pid&set=$set#top_display_media");
}