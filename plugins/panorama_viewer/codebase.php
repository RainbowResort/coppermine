<?php
/**************************************************
  Coppermine 1.5.x Plugin - panorama_viewer
  *************************************************
  Copyright (c) 2009-2010 eenemeenemuu
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

function panorama_viewer_is_360_degree_panorama() {
    global $CURRENT_PIC_DATA;
    if (stristr($CURRENT_PIC_DATA['filename'], "_360pano.jp")) {
        return true;
    } else {
        return false;
    }
}

if (defined('DISPLAYIMAGE_PHP')) {
    $superCage = Inspekt::makeSuperCage();
    if ($superCage->get->keyExists('slideshow')) {
        $thisplugin->add_filter('page_html','panorama_viewer_page_html_slideshow');

        function panorama_viewer_page_html_slideshow($html) {
            $panorama_start = "<table width=\"100%\" style=\"table-layout:fixed;\"><tr><td width=\"100%\" align=\"center\"><div style=\"width:100%; overflow:hidden;\">";
            $panorama_end = "</div></td></tr></table>";

            $html = preg_replace("/(<img id=\"showImage\".*\/>)/Uis", $panorama_start."\\1".$panorama_end, $html);
            return $html;
        }
    } else {
        $thisplugin->add_filter('html_image_reduced_overlay','panorama_viewer_image');
        $thisplugin->add_filter('html_image_reduced','panorama_viewer_image');
        $thisplugin->add_filter('html_image_overlay','panorama_viewer_image');
        $thisplugin->add_filter('html_image','panorama_viewer_image');

        function panorama_viewer_image($pic_html) {
            global $CURRENT_PIC_DATA;
            $pwidth = $CURRENT_PIC_DATA['pwidth'];
            $pheight = $CURRENT_PIC_DATA['pheight'];
            $div_height_extra_pixel = 24;
            $div_height = $CURRENT_PIC_DATA['pheight'] + $div_height_extra_pixel;
            if ($CURRENT_PIC_DATA['mode'] == 'normal') {
                global $CONFIG;
                $imagesize = getimagesize($CONFIG['fullpath'].$CURRENT_PIC_DATA['filepath'].$CONFIG['normal_pfx'].$CURRENT_PIC_DATA['filename']);
                $pwidth = $imagesize[0];
                $pheight = $imagesize[1];
                $div_height = $imagesize[1] + $div_height_extra_pixel;
            }
            if (panorama_viewer_is_360_degree_panorama()) {
                $pic_html = <<< EOT
                    <script type="text/javascript">
                        function scrollBackInit() {
                            backWidth = {$pwidth};
                            backXStep = 1;
                            backXCall = 20;
                            backXMove = 0;
                            if(document.getElementsByTagName) {
                                backXPos = backYPos = 0;
                                scrollBackObj = document.getElementById("360pano").style;
                                scrollBackObj.backgroundPosition = backXPos + "px " + backYPos + "px";
                                scrollBack();
                            }
                        }
                        function scrollBack() {
                            if(backXMove) {
                                backXPos = (Math.abs(backXPos) > backWidth) ? 0 : backXMove * backXStep + backXPos;
                                scrollBackObj.backgroundPosition = backXPos + "px " + backYPos + "px";
                            }
                            window.setTimeout("scrollBack()", backXCall);
                        }
                        $(document).ready(function() {
                            scrollBackInit();
                        });
                    </script>
                    <table id="360pano" background="{$CURRENT_PIC_DATA['url']}" style="width:100%; height:{$pheight}px; background-repeat:repeat-x; " border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="10%" onmouseover="backXMove=8;" onmouseout="backXMove=0;" valign="middle" align="left"><img src="plugins/panorama_viewer/arrow_left.png" /></td>
                            <td width="10%" onmouseover="backXMove=4;" onmouseout="backXMove=0;"></td>
                            <td width="10%" onmouseover="backXMove=2;" onmouseout="backXMove=0;"></td>
                            <td width="10%" onmouseover="backXMove=1;" onmouseout="backXMove=0;"></td>
                            <td width="20%"></td>
                            <td width="10%" onmouseover="backXMove=-1;" onmouseout="backXMove=0;"></td>
                            <td width="10%" onmouseover="backXMove=-2;" onmouseout="backXMove=0;"></td>
                            <td width="10%" onmouseover="backXMove=-4;" onmouseout="backXMove=0;"></td>
                            <td width="10%" onmouseover="backXMove=-8;" onmouseout="backXMove=0;" valign="middle" align="right"><img src="plugins/panorama_viewer/arrow_right.png" /></td>
                        </tr>
                    </table>
EOT;
            }
            $pic_html = "<div style=\"overflow:auto; width:100%; height:{$div_height}px;\">".$pic_html."</div>";
            $pic_html = "<table width=\"100%\" style=\"table-layout:fixed;\"><tr><td width=\"100%\" align=\"center\">".$pic_html."</td></tr></table>";
            return $pic_html;
        }
    }
} elseif (defined('INDEX_PHP')) {
    $thisplugin->add_filter('page_html','panorama_viewer_page_html_thumb');
    
    function panorama_viewer_page_html_thumb($html) {
        global $CONFIG;
        $panorama_start = "<table width=\"100%\" style=\"table-layout:fixed;\"><tr><td width=\"100%\" align=\"center\"><div style=\"width:100%; overflow:hidden;\">";
        $panorama_end = "</div></td></tr></table>";
        $pattern = "/(<a href=\"displayimage.*<img src=\".*\/{$CONFIG['thumb_pfx']}.*<\/a>)/Uis";
        $html = preg_replace($pattern, $panorama_start."\\1".$panorama_end, $html);
        return $html;
    }
}


?>