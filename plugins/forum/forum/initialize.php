<?php
/**************************************************
  Coppermine 1.5.x Plugin - forum
  *************************************************
  Copyright (c) 2010 foulu (Le Hoai Phuong), eenemeenemuu
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

// copyright
$fr_copyright = "<div class=\"footer\" align=\"center\"><a href=\"http://cpgsf.amfcvn.net/forum.php\">Coppermine Simple Forum ".$CONFIG['fr_version']."</a> &#169; <a href=\"http://forum.coppermine-gallery.net/index.php?action=profile;u=3924\">foulu</a> :: Sponsored by <a href=\"http://haophong.vn\">banh xe day tay</a></div>";
$template_footer = str_replace('Coppermine Photo Gallery</a></div>', 'Coppermine Photo Gallery</a></div>' . $fr_copyright, $template_footer);
// REFERER
$CONFIG['referer'] = $REFERER;
// forum prefix - for email ...
$CONFIG['fr_prefix_url'] = $CONFIG['ecards_more_pic_target']. (substr($CONFIG['ecards_more_pic_target'], -1) == '/' ? '' : '/');
// check if forum install - still need core database function
$result = cpg_db_query("SELECT count(*) as count FROM `{$CONFIG['TABLE_PREFIX']}plugins` WHERE path='forum';");
$row    = cpg_db_fetch_row($result);
if ($row['count'] != 1) {
    cpg_die(ERROR, Lang::item('error.fr_not_install'), __FILE__, __LINE__);
}

// $query_string = $superCage->server->getRaw('QUERY_STRING');
// echo $query_string;

// get controller & method
$c = $superCage->get->getAlpha('c');
$m = $superCage->get->getRaw('m');
// convert to correct type
$c = strtolower(trim($c));
$m = strtolower(trim($m));
// assign || default
$c = ($c != '') ? $c : 'home';
$m = ($m != '') ? $m : 'index';
// set to config array
$CONFIG['c'] = $c;
$CONFIG['m'] = $m;
// ip to config
$CONFIG['hdr_ip'] = $hdr_ip;
$CONFIG['raw_ip'] = $raw_ip;
// if admin page
if (substr_count($c, 'admin') > 0) {
    if (!GALLERY_ADMIN_MODE) {
        cpg_die(ERROR, Lang::item('error.access_denied'), __FILE__, __LINE__);
    }
}
// convert to file path
$source_file = BASE_DIR.'plugins'.DS.'forum'.DS.'forum'.DS.'sources'.DS.$c.'.php';
// main controller + views
if (file_exists($source_file)) {
    include($source_file);
    $class_name = $c . '_controller';
    if (class_exists($class_name)) {
        $main = new $class_name;
        if (method_exists($main, $m)) {
            $main->$m();
        } else {
            // error
            cpg_die(ERROR, sprintf(Lang::item('error.missing_method'), $m, $c), __FILE__, __LINE__);
        }
    } else {
        // error
        cpg_die(ERROR, sprintf(Lang::item('error.missing_class'), $c), __FILE__, __LINE__);
    }
} else {
    // error
    cpg_die(ERROR, sprintf(Lang::item('error.missing_file'), $source_file), __FILE__, __LINE__);
}
