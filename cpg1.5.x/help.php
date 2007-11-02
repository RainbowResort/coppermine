<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2006 Coppermine Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  Coppermine version: 1.5.0
  $HeadURL$
  $Revision: 3241 $
  $LastChangedBy: gaugau $
  $Date: 2006-08-18 08:52:27 +0200 (Fr, 18 Aug 2006) $
**********************************************/

define('IN_COPPERMINE', true);
define('HELP_PHP', true);
require('include/init.inc.php');

// set charset
$meta_charset = '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />';

// Get the vars from the url
if ($superCage->get->keyExists('as')) {
    $anchor_start = $superCage->get->getEscaped('as');
} else {
    $anchor_start = '';
}
if ($superCage->get->keyExists('ae')) {
    $anchor_end = $superCage->get->getEscaped('ae');
} else {
    $anchor_end = '';
}
if ($superCage->get->keyExists('close')) {
    $close = $superCage->get->getEscaped('close');
} else {
    $close = '0';
}
if ($superCage->get->keyExists('base')) {
    $base = $superCage->get->getEscaped('base');
    if ($CONFIG['charset'] == 'language file') {
        $meta_charset = '<meta http-equiv="Content-Type" content="text/html; charset='.$lang_charset.'" />';
    } else {
        $meta_charset = '<meta http-equiv="Content-Type" content="text/html; charset='.$CONFIG['charset'].'" />';
    }
} else {
    $base = '';
}
if ($superCage->get->keyExists('h')) {
    $header = $superCage->get->getEscaped('h');
} else {
    $header = '';
}
if ($superCage->get->keyExists('t')) {
    $text = $superCage->get->getEscaped('t');
} else {
    $text = '';
}

if ($superCage->get->keyExists('style')) {
    $style = $superCage->get->getEscaped('style');
} else {
    $style = '';
}
if ($superCage->get->keyExists('f')) {
    $file = $superCage->get->getEscaped('f');
} else {
    $file = 'index.htm';
}
// sanitize the file name
if (strrpos($file, '.') != FALSE) {
  $file = substr($file, 0, strrpos($file, '.'));
}
$file = preg_replace('/[^0-9a-zA-Z_-]/', '', $file);
$file = $file . '.htm';

if ($base != '') {
// content of header and text have been base64-encoded - decode it now
$header = @unserialize(@base64_decode($header));
$text = @unserialize(@base64_decode($text));
}

if ($close != 1) {
$close_link = '<br />&nbsp;<br /><div align="center"><a href="#" class="admin_menu" onclick="window.close();">'.$lang_common['close'].'</a><br />&nbsp;</div>';
}

ob_start();
@include('docs/'.$file);
$string = ob_get_contents();
ob_end_clean();

// manipulate the string according to settings


if ($anchor_start != '') {
    $pattern = '<a name="' . $anchor_start . '"></a>';
    $string = strstr($string, $pattern);
    //remove the start anchor
    $pattern = "'".$pattern."'si";
    //$string = preg_replace($pattern, "", $string);
}

if ($anchor_end != '') {
    $pattern = '<a name="' . $anchor_end . '"></a>';
    $string2 = strstr($string, $pattern);
    //remove the start anchor
    $pattern = "'".$pattern."'si";
    $string2 = preg_replace($pattern, "", $string2);
    $string = str_replace($string2, '', $string);
    $string = preg_replace($pattern, "", $string);
}

// Fix path for some tags
$string = str_replace('<img src="pics/', '<img src="docs/pics/', $string);
$string = str_replace('<a href="http://', '<a externalLinkTempReplacement', $string); // get external links out of the way
$string = str_replace('<a href="#', '<a internalAnchorLinkTempReplacement', $string); // get links to anchors on this page out of the way
$string = str_replace('<a href="', '<a href="docs/', $string);
$string = str_replace('<a externalLinkTempReplacement', '<a href="http://', $string); // restore external links
$string = str_replace('<a internalAnchorLinkTempReplacement', '<a href="#', $string); // restore links to anchors on this page


    $string = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\"\n\t\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n<html>\n<head>\n<title>".$lang_common['help']."</title>\n" .
              $meta_charset . "\n" .
              '<link href="themes/'.$CONFIG['theme'].'/style.css" rel="stylesheet" type="text/css" />' .
              "\n</head>\n<body class=\"tableb\">\n<div style=\"padding: 5px;\">\n" .
              $string;
    if ($header != '') {
        $string .= '<h1>'.$header.'</h1>';
        $string .= $text;
    }
    $string .= $close_link."\n</div>\n</body>\n</html>";




print $string;
?>