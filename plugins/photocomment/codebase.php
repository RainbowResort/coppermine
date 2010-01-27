<?php

/*************************
  PhotoComment Plugin
  Shows the EXIF UserCommment field as the image text for pictures
**********************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

include_once("include/exif.php");

$thisplugin->add_filter('thumb_caption','thumb_caption_mgr');
$thisplugin->add_filter('thumb_caption_regular','thumb_caption_mgr');
$thisplugin->add_filter('thumb_caption_lastcom','thumb_caption_mgr');
$thisplugin->add_filter('thumb_caption_lastcomby','thumb_caption_mgr');
$thisplugin->add_filter('thumb_caption_lastup','thumb_caption_mgr');
$thisplugin->add_filter('thumb_caption_lastupby','thumb_caption_mgr');
$thisplugin->add_filter('thumb_caption_topn','thumb_caption_mgr');
$thisplugin->add_filter('thumb_caption_toprated','thumb_caption_mgr');
$thisplugin->add_filter('thumb_caption_lasthits','thumb_caption_mgr');
$thisplugin->add_filter('thumb_caption_random','thumb_caption_mgr');
$thisplugin->add_filter('thumb_caption_search','thumb_caption_mgr');
$thisplugin->add_filter('thumb_caption_lastalb','thumb_caption_mgr');
$thisplugin->add_filter('thumb_caption_favpics','thumb_caption_mgr');


function thumb_caption_mgr($rowset) {

  global $CONFIG;
  foreach ( $rowset as $ind=>$val ) {
      $pic_data = $rowset[$ind];
      $pic_data['title'] = 'Filename - title: ' . $pic_data['filename'] . ', no: ' . $i;
	  

	  $fullpath =  $CONFIG['fullpath'] . $val['filepath'] . $val['filename'];
      $exif = read_exif_data_raw($fullpath, true);
	  $str = '';	  
	  foreach ($exif as $key => $val) {	  
	     if($key == 'SubIFD') {		 
		 	$str = substr($val['UserCommentOld'], 5);
		 }
      }
	  	  
      $pic_data['caption'] = ''; 
      $pic_data['caption_text'] = $str; 
      $pic_data['title'] = $str; 
      $rowset[$ind] = $pic_data;
  }
    return $rowset;
}

?>
