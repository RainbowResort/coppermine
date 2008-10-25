<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2008 Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.
  
  ********************************************
  Coppermine version: 1.5.0
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/trunk/cpg1.5.x/phpinfo.php $
  $Revision: 5129 $
  $LastChangedBy: gaugau $
  $Date: 2008-10-18 16:03:12 +0530 (Sat, 18 Oct 2008) $
**********************************************/

error_reporting (E_ALL ^ E_NOTICE);
define('IN_COPPERMINE', true);
define('PHPINFO_PHP', true);
require('include/init.inc.php');

$CONFIG['debug_mode']=0;

if (!GALLERY_ADMIN_MODE) cpg_die(ERROR, $lang_errors['access_denied']);

pageheader($lang_cpg_debug_output['phpinfo']);

ob_start();
phpinfo();
$string = ob_get_contents();
$string = strchr($string, '</style>');
$string = str_replace('</style>','',$string);
$string = str_replace('class="p"','',$string);
$string = str_replace('class="e"','class="tableb"',$string);
$string = str_replace('class="v"','class="tablef"',$string);
$string = str_replace('class="h"','class="tableh2"',$string);
$string = str_replace('class="center"','',$string);
ob_end_clean();

print '<div align="left" style="overflow:hidden;width:800px;text-align:left;">';
starttable('100%', cpg_fetch_icon('phpinfo', 2) . $lang_phpinfo_php['php_info'], 1);
print '<tr><td class="tableb">';
print $lang_phpinfo_php['explanation'];
print '<br />';
print $lang_phpinfo_php['no_link'];
print '</td></tr>';
endtable();
print '<br />';


print $string;
print "</div>\n";


pagefooter();
ob_end_flush();

?>
