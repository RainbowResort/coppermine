<?php
/**************************************************
  Picture Annotation (annotate) plugin for cpg1.5.x
  *************************************************
  Copyright (c) 2003-2009 Coppermine Dev Team

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  *************************************************
  Coppermine version: 1.5.x
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/branches/cpg1.5.x/plugins/annotate/codebase.php $
  $Revision: 6675 $
  $LastChangedBy: gaugau $
  $Date: 2009-10-12 17:29:23 +0200 (Mo, 12. Okt 2009) $
**************************************************/

if (!defined('IN_COPPERMINE')) {
    die('Not in Coppermine...');
}
// Initialize language and icons
require_once './plugins/annotate/init.inc.php';
$annotate_init_array = annotate_initialize();
$lang_plugin_annotate = $annotate_init_array['language']; 
$annotate_icon_array = $annotate_init_array['icon'];
// Configuration
pageheader($lang_plugin_annotate['configure_plugin']);
annotate_configure();
pagefooter();
die;
?>