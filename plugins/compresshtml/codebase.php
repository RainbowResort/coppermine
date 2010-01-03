<?php
/**************************************************
  Coppermine 1.5.x Plugin - Compress HTML
  *************************************************
  Copyright (c) 2010 Timos-Welt (www.timos-welt.de)
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

// Add filter for page body
$thisplugin->add_filter('page_html','compr_main');


function compr_main($html) {
  if (!GALLERY_ADMIN_MODE) {
    $comprmatch = explode("<html", $html);
    $tocompress = $comprmatch[1];
    $tocompress=(str_replace("\t", " ", $tocompress));
    $tocompress=(str_replace("\n\n", "\n", $tocompress));
    
    // Comment out the following line if problems occur 
    // (invalid HTML, javascripts not working etc)
    $tocompress=(str_replace("\n", "", $tocompress));
    
    $tocompress=(str_replace("\r", "", $tocompress));
    while (stristr($tocompress, '  '))
      {
      $tocompress=(str_replace("  ", " ", $tocompress));
      }
    $tocompress=(str_replace(" />", "/>", $tocompress));
  
    $html = str_replace($comprmatch[1],$tocompress,$html);
    $html = str_replace('</body>','
  <!-- CompressHTML saved '.ceil(100-(strlen($tocompress)/strlen($comprmatch[1]))*100).'%--></body>',$html);
  }
  return $html;
}

?>