<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2005 Coppermine Dev Team
  v1.1 originaly written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  ********************************************
  Coppermine version: 1.4.8
  $Source: /cvsroot/cpg-contrib/master_template/codebase.php,v $
  $Revision: 1.3 $
  $Author: donnoman $
  $Date: 2005/12/08 05:46:49 $
**********************************************/
/*************************
fotofreek's mod addapted by Frantz for Coppermine photo_summary plugin
adding image preview with wirefolf css popup window
**************************/
require('include/init.inc.php');
require ('./plugins/keyword_list/include/init.inc.php');
//form to chose method for diplaying keywords
pageheader($lang_plugin_keyword_list['name']);
starttable('100%', $lang_plugin_keyword_list['display_choice'], 1);
echo "<tr><td align=\"center\"><a href=\"index.php?file=keyword_list/keyword_list\"><input type=\"button\" name=\"list\" value=\"{$lang_plugin_keyword_list['list']}\"></a></td></tr>";		
echo "<tr><td align=\"center\"><a href=\"index.php?file=keyword_list/keyword_alpha\"><input type=\"button\" name=\"list\" value=\"{$lang_plugin_keyword_list['alpha']}\"></a></td></tr>";	
endtable();
pagefooter(); 
ob_end_flush();
?>