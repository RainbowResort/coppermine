<?php
/**************************************************
  Coppermine 1.5.x Plugin - js_to_bottom
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

// Add page_html filter
$thisplugin->add_filter('page_html','move_js_to_bottom');

function move_js_to_bottom($html)
{
    // move script calls to page bottom
        preg_match("#<head>.*</head>#s", $html, $foundit);
		preg_match("#<script.*</script>#s",$foundit[0], $foundit2);
		$html = str_replace($foundit2[0],'',$html);
		$html = str_replace('</body>',$foundit2[0].'
</body>',$html);
        return $html;
}

?>