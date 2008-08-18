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
  $HeadURL$
  $Revision: 4841 $
  $LastChangedBy: gaugau $
  $Date: 2008-08-12 03:00:08 +0530 (Tue, 12 Aug 2008) $
**********************************************/

define('IN_COPPERMINE', true);
define('DISPLAYIMAGE_PHP', true);
require('include/init.inc.php');
require('include/picmgmt.inc.php');

if (!GALLERY_ADMIN_MODE) die('Access denied');
pageheader($lang_picinfo['ManageExifDisplay']);

//String containing all the available exif tags.
$exif_info = "AFFocusPosition|Adapter|ColorMode|ColorSpace|ComponentsConfiguration|CompressedBitsPerPixel|Contrast|CustomerRender|DateTimeOriginal|DateTimedigitized|DigitalZoom|DigitalZoomRatio|ExifImageHeight|ExifImageWidth|ExifInteroperabilityOffset|ExifOffset|ExifVersion|ExposureBiasValue|ExposureMode|ExposureProgram|ExposureTime|FNumber|FileSource|Flash|FlashPixVersion|FlashSetting|FocalLength|FocusMode|GainControl|IFD1Offset|ISOSelection|ISOSetting|ISOSpeedRatings|ImageAdjustment|ImageDescription|ImageSharpening|LightSource|Make|ManualFocusDistance|MaxApertureValue|MeteringMode|Model|NoiseReduction|Orientation|Quality|ResolutionUnit|Saturation|SceneCaptureMode|SceneType|Sharpness|Software|WhiteBalance|YCbCrPositioning|xResolution|yResolution";

$exifRawData = explode ("|",$exif_info);
$exifCurrentData = explode ("|",$CONFIG['show_which_exif']);

//If the form is submitted to save the data
//if (isset($_POST['save'])) {
if ($superCage->post->keyExists('save')){
  $str = "";
  foreach ($exifRawData as $val) {
    //if (in_array($val, $_POST['exif_tags'])) {
    $exif_tags = $superCage->post->getEscaped('exif_tags');
    if (in_array($val, $exif_tags )){
      $str .= "1|";
    } else {
      $str .= "0|";
    }
  }

  //Remove the last pipe from the string.
  $selectedExifTags = substr ($str,0,strlen($str)-1);
  $selectedExifTags = $str;
  /*$sql = "UPDATE ".$CONFIG['TABLE_CONFIG']." SET value = '".$selectedExifTags."' WHERE name = 'show_which_exif'";
     cpg_db_query($sql);	*/
  ################################          DB         ##################################
  $cpgdb->query($cpg_db_exifmgr_php['config_set_show_which_exif'], $selectedExifTags);
  ############################################################################
  msg_box($lang_picinfo['ManageExifDisplay'], $lang_picinfo['success'], $lang_common['continue'], "admin.php");
} else {
  echo <<< EOT
    <form method="POST" action="" name="editForm" id="cpgform">
    <input type="hidden" name="save" value="save" />

    <script type="text/javascript" language="javascript">
    <!--
    function selectAll(d,box) {
      var f = document.editForm;
      for (i = 0; i < f.length; i++) {
        //alert (f[i].name.indexOf(box));
        if (f[i].type == "checkbox" && f[i].name.indexOf(box) >= 0) {
          if (d.checked) {
            f[i].checked = true;
          } else {
            f[i].checked = false;
          }
        }
      }
      if (d.name == "checkAll") {
          document.getElementsByName('checkAll2')[0].checked = document.getElementsByName('checkAll')[0].checked;
      } else {
          document.getElementsByName('checkAll')[0].checked = document.getElementsByName('checkAll2')[0].checked;
      }
    }

    -->
    </script>
EOT;
  starttable('100%', cpg_fetch_icon('exif_mgr', 2) . $lang_picinfo['ManageExifDisplay'], 2);
  echo '<tr><td class="tableh2">&nbsp;</td><td class="tableh2" align="center">';
  echo '<input type="checkbox" name="checkAll" onClick="selectAll(this,\'exif_tags\');" class="checkbox" title="'.$lang_common['check_uncheck_all'].'" />';
  echo '</td></tr>';
  $loopCounter = 0;
  foreach ($exifRawData as $key => $val) {
    $checked = $exifCurrentData[$key] == 1 ? 'checked' : '';
    if (($loopCounter/2) == floor($loopCounter/2)) {
    	$style = 'tableb';
    } else {
    	$style = 'tableb tableb_alternate';
    }
    $loopCounter++;
    echo '<tr><td class="'.$style.'">'.$lang_picinfo[$val].'</td><td class="'.$style.'" align="center"><input type="checkbox" name="exif_tags[]" value="'.$val.'" ' . $checked . ' class="checkbox" /></td></tr>'."\r\n";
  }
  echo '<tr>
  <td class="tablef" align="center"><input type="submit" class="button" name="submit" value="'.$lang_picinfo['submit'].'" />';
  echo '<td class="tablef" align="center">';
  echo '<input type="checkbox" name="checkAll2" onClick="selectAll(this,\'exif_tags\');" class="checkbox" title="'.$lang_common['check_uncheck_all'].'" />';
  echo '  </td></tr>';
  endtable();
  echo <<< EOT
    </form>
EOT;
}
ob_end_flush();
pagefooter();
?>