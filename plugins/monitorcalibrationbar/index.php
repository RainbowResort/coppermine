<?php
/**************************************************
  Coppermine 1.5.x Plugin - monitorcalibrationbar
  *************************************************
  Copyright (c) 2010 Joachim Müller
  ********************************************
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/branches/cpg1.5.x/plugins/slider/codebase.php $
  $Revision: 6994 $
  $LastChangedBy: timoswelt $
  $Date: 2010-01-04 10:54:19 +0100 (Mo, 04. Jan 2010) $
  **************************************************/

$action = 'display';

if ($superCage->get->keyExists('action') == TRUE) {
    if ($superCage->get->getAlpha('action') == 'configure' && GALLERY_ADMIN_MODE) {
        $action = 'configure';
    }
}

if ($action == 'configure') {
    // Configuration
    pageheader($lang_plugin_moncalb['config']);
    monitor_calibration_bar_configure();
} else {
    pageheader($lang_plugin_moncalb['picinfo_heading']);
    echo '<h1>'.$lang_plugin_moncalb['config_name'].'</h1>';
    echo monitor_calibration_bar_display_bar('100%','no');
    echo '<p>'.$lang_plugin_moncalb['explain'].'</p>';
}

pagefooter();
?>