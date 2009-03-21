<?php
/**************************************************
  Coppermine 1.5.x Plugin - Thumb Rotate $VERSION$=0.2
  *************************************************
  Copyright (c) 2009 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  **************************************************/
  
if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');


// Add plugin_install action
$thisplugin->add_action('plugin_install','rotate_install');

// Add plugin_uninstall action
$thisplugin->add_action('plugin_uninstall','rotate_uninstall');

// Add filter for page body
$thisplugin->add_filter('page_html','rotate_main');



function rotate_main($html) 
{
  // *******************
  // Your settings HERE!
  // *******************
  $maxdegree = 15;            // maximum rotation to left/right (2-20)
  $themebackcolor = 'efefef'; // background color of your theme (hex format without leading '#')
  $border = 10;               // border size (px), set to 0 for no border
  $brdcolor = 'ffffff';       // border color (hex format without leading '#')

  global $CONFIG;

  // build search string $ausdruck depending on thumb_use setting
  switch ($CONFIG['thumb_use'])
  {
    case "wd":
      $ausdruck = "#href=\"displayimage.php\?(.*)\">\s*<img\s*src=\"(.*?)\"\s*class=\"(.*)\"\s*width=\"(.*?)\"#i";
      break;
    case "ht":
      $ausdruck = "#href=\"displayimage.php\?(.*)\">\s*<img\s*src=\"(.*?)\"\s*class=\"(.*)\"\s*height=\"(.*?)\"#i";
      break;
    default:
      $ausdruck = "#href=\"displayimage.php\?(.*)\">\s*<img\s*src=\"(.*?)\"\s*class=\"(.*)\"\s*width=\"(.*)\"\s*height=\"(.*?)\"#i";
  }

  preg_match_all($ausdruck, $html, $treffer, PREG_SET_ORDER);

  $lastdegree = -1;    
  
  // get match for each thumb
  foreach($treffer as $match) 
  {
      // degree of rotation is random at start, but later we want to have one left, one right
      if ($lastdegree == -1)
      {
        $degrees = rand(0,$maxdegree*2);
        if ($degrees > $maxdegree) $degrees = $degrees + 359 - $maxdegree*2;
      }
      else if ($lastdegree < $maxdegree)
      {
        $degrees = rand(1,$maxdegree) + 360 - $maxdegree;
      }
      else
      {
        $degrees = rand(1,$maxdegree);
      }
      $lastdegree = $degrees;

      // build replacement string for thumb
      // first check if thumb is already in cache; if yes, use this one
      $source_image = str_replace('/','_',$match[2]).$themebackcolor.$brdcolor.$border.'.png';
      if (file_exists('plugins/thumb_rotate/thumb_cache/'.$source_image))
      {
        $replacestring = "href=\"displayimage.php?".$match[1]."\"><img src=\"plugins/thumb_rotate/thumb_cache/".$source_image."\" class=\"".$match[3]."\" style=\"border:none;\"";
      }
      else
      {
        $replacestring = "href=\"displayimage.php?".$match[1]."\"><img src=\"plugins/thumb_rotate/thumb_rotate.php?img=".$match[2]."&amp;deg=".$degrees."&bg=".$themebackcolor."&brd=".$border."&brdcol=".$brdcolor."\" class=\"".$match[3]."\" style=\"border:none;\"";
      }
      $html = str_replace($match[0],$replacestring,$html);
  }
  return $html;
}

// install
function rotate_install()
{
    return true;
}

// uninstall
function rotate_uninstall()
{
    return true;
}
?>