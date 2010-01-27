<?php



/**************************************************



  LightBox JS Slideshow Plugin for Coppermine Photo Gallery



  *************************************************



  Copyright (c) 2009 SaWey  <>



  *************************************************



  This program is free software; you can redistribute it and/or modify

  it under the terms of the GNU General Public License as published by

  the Free Software Foundation; either version 2 of the License, or

  (at your option) any later version.



  *************************************************



  Coppermine version: 1.4.x



***************************************************/



if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');







// Add a filter for the gallery header

$thisplugin->add_filter('page_meta','LightBoxJS_header');

$thisplugin->add_filter('file_data','LightBox_theme_html_picture');



// Function to modify the gallery header

function LightBoxJS_header($html) {

    $html = '<link rel="stylesheet" href="plugins/light_box/slideshow/css/lightbox.css" type="text/css" media="screen" />'

    .$html = '<script type="text/javascript" src="plugins/light_box/slideshow/js/prototype.js"></script>'

	.$html = '<script type="text/javascript" src="plugins/light_box/slideshow/js/scriptaculous.js?load=effects"></script>'

	.$html = '<script type="text/javascript" src="plugins/light_box/slideshow/js/lightbox_s.js"></script>'

            .$html;

    return $html;

}



// Changes HTML for theme_html_picture() in themes.inc.php

function LightBox_theme_html_picture($SlideShowhtml)

{

	global $slideshow_pic_html, $LBmime_content, $CURRENT_PIC_DATA;

	$LBmime_content = cpg_get_type($SlideShowhtml['filename']);

	if ($LBmime_content['content']=='image') {

        if (preg_match('/^youtube_(.*)\.jpg$/', $CURRENT_PIC_DATA['filename'], $ytmatches)){
    	
    		$vid = $ytmatches[1];
      		$slideshow_pic_html = '<object width="560" height="350"><param name="movie" value="http://www.youtube.com/v/'. $vid . '"></param><param name="wmode" value="transparent"></param><embed src="http://www.youtube.com/v/'. $vid . '" type="application/x-shockwave-flash" wmode="transparent" width="560" height="350"></embed></object><br />';
                $SlideShowhtml['html'] = $slideshow_pic_html;

    	} elseif (isset($image_size['reduced'])) {

			$slideshow_pic_html = lightbox_list($SlideShowhtml);

			$SlideShowhtml['html'] = $slideshow_pic_html;

        } else {

		$slideshow_pic_html = lightbox_list($SlideShowhtml);

		$SlideShowhtml['html'] = $slideshow_pic_html;

        //    $pic_html = "<img src=\"" . $picture_url . "\" {$image_size['geom']} class=\"image\" border=\"0\" alt=\"\" /><br />\n";

        }

    }

	//$slideshow_pic_html = lightbox_list($SlideShowhtml);

	//$SlideShowhtml['html'] = $slideshow_pic_html;

	return $SlideShowhtml;

   

}



#################################################

 //Second part of lightbox update

 

function lightbox_list($picId) {
  
	################################################
	//Set max number of images
	$max = 100; 			//(-1 for all pics in album)
	################################################

    global $lang_display_image_php, $CONFIG;
	$i = 0;
	$pid = $picId['pid'];
	$aid = (empty($_GET['album']) || $_GET['album']=='random' || $_GET['album']=='lastup') ? $picId['aid'] : $_GET['album'];

	$pic_data = get_pic_data($aid, $pic_count, $album_name, -1, -1, false);

	$imax = 0;			//counter

	$max = $max/2;

	foreach ($pic_data as $picture){

		if ($picture['pid'] == $pid) {

		//the number of the picture in  order

		$picnumber = $imax;

		}

	$imax++;

	}	

	//Check beginning and ending of album

	if(! ($max == ((-1)/2))){

		if ($imax > $max){

			if ($picnumber < $max || $picnumber == 0){

				$down = 0;

				$up = 0 + ($max*2);

			}elseif (($picnumber + $max) > $imax){

				$down = $imax - ($max*2);

				$up = $imax;

			}else{

				$down = $picnumber - $max;

				$up = $picnumber + $max;

			}

		}else{

			$down = 0;

			$up = $imax;

		}

	}else{

			$down = 0;

			$up = $imax;

	}

	

	$pic_already_shown = false; //fix to remove duplicate entries

	foreach ($pic_data as $picture) {

		if ($i >= $down && $i <= $up){

			if($CONFIG['thumb_use']=='ht' && $picture['pheight'] > $CONFIG['picture_width'] ){

			  $condition = true;

			}elseif($CONFIG['thumb_use']=='wd' && $picture['pwidth'] > $CONFIG['picture_width']){

			  $condition = true;

			}elseif($CONFIG['thumb_use']=='any' && max($picture['pwidth'], $picture['pheight']) > $CONFIG['picture_width']){

			  $condition = true;

			}else{

			$condition = false;

			}

			$picture_page = "./displayimage.php?album=".$picture['aid']."&pos=-".$picture['pid'];

			if (is_image($picture['filename'])) {

				if ($CONFIG['make_intermediate'] && $condition ) {

					$picture_url = get_pic_url($picture, 'normal');

				} else {

					$picture_url = get_pic_url($picture, 'fullsize');

				}

				$picture_url_fullsize = get_pic_url($picture, 'fullsize');

				$pic_title = ($picture['title'] ? $picture['title'] : strtr(preg_replace("/(.+)\..*?\Z/", "\\1", htmlspecialchars($picture['filename'])), "_", " "));

				if ($picture['pid'] == $pid && !$pic_already_shown ) {

					$picList .= "<a href=\"$picture_url_fullsize\" picpage=\"$picture_page\" rel=\"lightbox[list]\" pid=\"$picture[pid]\" title=\"$pic_title\" >";

					$picList .= "<img src=\"$picture_url\" class=\"image\" border=\"0\" alt=\"$lang_display_image_php[view_fs]\" /><br />";

					$picList .= "</a>\n";

					$pic_already_shown = true; //fix to remove duplicate entries



				}else{

					$picList .= "<a href=\"$picture_url_fullsize\" picpage=\"$picture_page\" rel=\"lightbox[list]\" title=\"$pic_title\"></a>\n";

				}

			}

		}

		$i++;

	}

	return $picList;

}//End of second part

#################################################





?>