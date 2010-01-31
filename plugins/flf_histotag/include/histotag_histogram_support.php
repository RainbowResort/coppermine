<?php

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

function deleteHistogram($filepath, $filename, $pid) {
	// TODO: Validate!
	// attempt to delete histogram
	$hist_name='histograms\hist_$pid_$filename';
	if (file_exists($hist_name)) {
	// File exists
		unlink ($hist_name);
	}
	else {
		// file does not exist
	}


}
function checkandcreatehistogram($pid) {
	// get filename for pid
	// check histofilenanem.
	// if exists: return filename
	// if not: create histogram and return filename later.
	 global $CONFIG;
	 $hist_filename='';
	 $result = cpg_db_query("SELECT t.filepath, t.filename FROM {$CONFIG['TABLE_PICTURES']} t WHERE t.pid ='{$pid}'");
     $row = mysql_fetch_assoc($result);
     if(($row['filepath']&&$row['filename'])) {
     	// valid image exists
     	$hist_filename='histograms/hist_'.$pid.'_'.$row['filename'];
     	// check if histogram already exists;
     	if (file_exists($hist_filename)) {
     		// histogram already exists
     		return $hist_filename;
     	}
     	else {
     		makeHistogram('albums/'.$row['filepath'], $row['filename'], $pid);
     	  	if (file_exists($hist_filename)) {
     		// histogram successfully created 
     		return $hist_filename;
     		}
     	}
     
     }
	return false;
	
	
}
function renderHistoButton($template_img_navbar) {
    global $CONFIG, $CURRENT_PIC_DATA, $FAVPICS, $REFERER, $lang_picinfo, $flf_lang_var;
    $pid=$CURRENT_PIC_DATA['pid'];
    $filename=$CURRENT_PIC_DATA['filename'];
    $ref = $REFERER ? "&amp;referer=$REFERER" : '';
    $hist_filename='histograms/hist_'.$pid.'_'.$filename;
    $geo_tgt=$hist_filename;
    /* Algorithm to change to on-demand-generation:
     * 1. Check whether histo_onthefly = 1
     * 		if yes: - Always show the "real" histo button
     *              - Move the histo-generation-feature to histotag_histogram_display.php
     *      if no: 
     *      2.    Check wheter histogram exists
     *      3. 	  If exists: Link to the page
     *      4. 	  If it does not exist: 
     *      	5. Check wheter to show button at all (Parameter flf_histogram_show_hist_if_no_hist)
     *             6. If true: Show button, otherwise skip.
     *      
     *      
     * To clarify: How to put functions in display.php that require access to coppermine variables
     * Also: change parameter so only the pid is transferred
     */
    $showhistobutton=false;
    $linklive=false;
    if ($CONFIG['flf_histo_onthefly']=='1') {
    	// always show button because we generate on the fly if necessary
    	$showhistobutton=true;
    	$linklive=true;

    }
    else {
    	if (file_exists($hist_filename)==false) {
    		// No histogram available yet - check if empty button should be displayed
    		 	if ($CONFIG['flf_histogram_show_hist_if_no_hist']=='1') {
    		 		$showhistobutton=true;
    		 		$linklive=false;	
    		 	}
    	}
    	
    }
    
    if ($showhistobutton) {
    	if ($linklive) {
    		// Show live link button
    		    $geo_title = $flf_lang_var['histo_click_link'];
		        $geo_icon = "histo.png";
		        $geo_icon_hover = "histo.png";
		        $_SESSION['flfhisto_pid'] = $CURRENT_PIC_DATA['pid'];
		        $geo_button = "
		               
		        <script type=\"text/javascript\" src=\"plugins/flf_histotag/include/greybox_rightsize.js\"></script>
		         <td align=\"center\" valign=\"middle\" class=\"navmenu\" width=\"42\">
		            <a href=\"index.php?file=flf_histotag/histotag_histogram_display\"  flfwidth=\"{$CONFIG['flf_histo_lyteboxwidth']}\" flfheight=\"{$CONFIG['flf_histo_lyteboxheight']}\" class=\"flfbox\" title=\"{$flf_lang_var['histo_click_link']}\" id=\"geo_lnk\"><img src=\"plugins/flf_histotag/images/$geo_icon\" border=\"0\" align=\"middle\" alt=\"$geo_title\" id=\"histo_ico\" /></a>
		        </td>
		        <script type=\"text/javascript\">
		            $('#histo_lnk').mouseover(function() { $('#histo_ico').attr('src', 'plugins/flf_histotag/images/$geo_icon_hover'); } );
		            $('#histo_lnk').mouseout(function() { $('#histo_ico').attr('src', 'plugins/flf_histotag/images/$geo_icon'); } );
		        </script>
		    	";	
    		
      	}
    	else {
    		// show empty button
    		    $geo_tgt="#top_display_media";
		        $geo_title = $flf_lang_var['histo_no_data'];
		        $geo_icon = "nohisto.png";
		        $geo_icon_hover = "nogeo.png";
		        $geo_button = "
		        <td align=\"center\" valign=\"middle\" class=\"navmenu\" width=\"42\">
		            <a href=\"$geo_tgt\" class=\"navmenu_pic\" title=\"$geo_title\" id=\"geo_lnk\"><img src=\"plugins/flf_histotag/images/$geo_icon\" border=\"0\" align=\"middle\" alt=\"$geo_title\" id=\"histo_ico\" /></a>
		        </td>
		        <script type=\"text/javascript\">
		            $('#histo_lnk').mouseover(function() { $('#histo_ico').attr('src', 'plugins/flf_histotag/images/$geo_icon_hover'); } );
		            $('#histo_lnk').mouseout(function() { $('#histo_ico').attr('src', 'plugins/flf_histotag/images/$geo_icon'); } );
		        </script>
    			";
    		
    	}
    	
    }
    /*
    if (file_exists($hist_filename)==false && ($CONFIG['flf_histo_onthefly']=='1')) {
   		// file does not exist but should be generated now
   		makeHistogram('albums/'.$CURRENT_PIC_DATA['filepath'],$filename,$pid);
   		
    }
    
   
    if (file_exists($hist_filename)) {
    	// Histogram found 
    	
    	$geo_title = $flf_lang_var['histo_click_link'];
        $geo_icon = "histo.png";
        $geo_icon_hover = "histo.png";
        $geo_button = "
               
        <script type=\"text/javascript\" src=\"plugins/flf_histotag/include/greybox_rightsize.js\"></script>
         <td align=\"center\" valign=\"middle\" class=\"navmenu\" width=\"42\">
            <a href=\"plugins/flf_histotag/include/histotag_histogram_display.php?histogram=$geo_tgt\"  flfwidth=\"{$CONFIG['flf_histo_lyteboxwidth']}\" flfheight=\"{$CONFIG['flf_histo_lyteboxheight']}\" class=\"flfbox\" title=\"{$flf_lang_var['histo_click_link']}\" id=\"geo_lnk\"><img src=\"plugins/flf_histotag/images/$geo_icon\" border=\"0\" align=\"middle\" alt=\"$geo_title\" id=\"histo_ico\" /></a>
        </td>
        <script type=\"text/javascript\">
            $('#histo_lnk').mouseover(function() { $('#histo_ico').attr('src', 'plugins/flf_histotag/images/$geo_icon_hover'); } );
            $('#histo_lnk').mouseout(function() { $('#histo_ico').attr('src', 'plugins/flf_histotag/images/$geo_icon'); } );
        </script>
    ";
        
     } else {
     	// TODO: Correct!
     	if ($CONFIG['flf_histogram_show_hist_if_no_hist']=='1') {
     		// show button only if parameter is set, otherwise: no button!
     		    $geo_tgt="#top_display_media";
		        $geo_title = $flf_lang_var['histo_no_data'];
		        $geo_icon = "nohisto.png";
		        $geo_icon_hover = "nogeo.png";
		        $geo_button = "
		        <td align=\"center\" valign=\"middle\" class=\"navmenu\" width=\"42\">
		            <a href=\"$geo_tgt\" class=\"navmenu_pic\" title=\"$geo_title\" id=\"geo_lnk\"><img src=\"plugins/flf_histotag/images/$geo_icon\" border=\"0\" align=\"middle\" alt=\"$geo_title\" id=\"histo_ico\" /></a>
		        </td>
		        <script type=\"text/javascript\">
		            $('#histo_lnk').mouseover(function() { $('#histo_ico').attr('src', 'plugins/flf_histotag/images/$geo_icon_hover'); } );
		            $('#histo_lnk').mouseout(function() { $('#histo_ico').attr('src', 'plugins/flf_histotag/images/$geo_icon'); } );
		        </script>
		    ";
     	}

  	   } 

    */
    
    
    $search = substr_count($template_img_navbar, "<!-- BEGIN pic_info_button -->") > 0 ? "<!-- BEGIN pic_info_button -->" : "<!-- BEGIN slideshow_button -->";

    $template_img_navbar = str_replace($search, $geo_button.$search, $template_img_navbar);

    return $template_img_navbar;


}

function generateAllHistograms() {
	// TODO: DO something about max execution time!
    global $CONFIG, $flf_lang_var;
	$insertedvalues=0;
    set_time_limit(500);
    $result = cpg_db_query("SELECT t.pid, t.filepath, t.filename FROM {$CONFIG['TABLE_PICTURES']} t ");
    while ($row = mysql_fetch_assoc($result)) {
    
        $calldata['pid'] = $row['pid'];
        $calldata['filepath'] = $row['filepath'];
        $calldata['filename'] = $row['filename'];
		if (!file_exists('histograms/hist_'.$calldata['pid'].'_'.$calldata['filename'])) {
			$success=makeHistogram('albums/'.$calldata['filepath'],$calldata['filename'],$calldata['pid']);
			if ($success) {
				echo ".";
				$insertedvalues++;
			}
		}
	
		
    }
    return $insertedvalues;
}


function makeHistogram($filepath, $filename, $pid) {
	// set_time_limit(500);
	
	//HISTOGRAM VARIABLES
	global $CONFIG;
	$coppermineid=$pid;
	$source_file = $filepath.$filename;
	// TODO: Check if Histogram already exists; if so: skip!
	$maxheight = 100;
	$barwidth = 1;
	$iscolor = false;
	$im = ImageCreateFromJpeg($source_file); 
	$color = $CONFIG['flf_histogram_color'];
	$imgw = imagesx($im);
	$imgh = imagesy($im);
	$n = $imgw*$imgh;
	$histo = array();
	$histoR = array();
	$histoG = array();
	$histoB = array();
	
	// ZERO HISTOGRAM VALUES
	
	for ($i=0; $i<256; $i++) {
	       $histo[$i] = 0;
		   $histoR[$i] = 0;
		   $histoG[$i] = 0;
		   $histoB[$i] = 0;
	}
	
	// CALCULATE PIXELS
	
	for ($i=0; $i<$imgw; $i++) {
	        for ($j=0; $j<$imgh; $j++) {                
	                $rgb = ImageColorAt($im, $i, $j); 
	                $r = ($rgb >> 16) & 0xFF;
	                $g = ($rgb >> 8) & 0xFF;
	                $b = $rgb & 0xFF;
					$V = round(($r + $g + $b) / 3);
					$histo[$V] += 1;
					
					$V = round($r * 1);
	        		$histoR[$V] += 1 ;
					$V = round($g * 1);
					$histoG[$V] += 1 ;
					$V = round($b * 1);
					$histoB[$V] += 1 ;
	        }
	}
	imagedestroy($im);
	
	// COLOR OR GRAYSCALE
	for ($a=0; $a < count($histoR); $a++) {
		if( $histoR[$a]!= $histoG[$a] || $histoG[$a]!= $histoB[$a]){
	        $iscolor = true;
	        break;
	        }
	}
	
	//CREATE HISTOGRAM IMAGE
  // TODO: internationalize!
	if(($CONFIG['flf_histogram_type'] == 'combined') or ($iscolor == false)) {
		$imR = imagecreatetruecolor(256, 100)
		or die ("Cannot Initialize new GD image stream");
	} else {
		$imR = imagecreatetruecolor(256, 300)
		or die ("Cannot Initialize new GD image stream");
	}
	
	// CONVERT BACKGROUND COLOR TO RGB
	
	$rgbcolor = html2rgb($color);
	
	
	//RGB
	
	if ($iscolor)
	{
		// MAKE BACKGROUND
		$back = imagecolorallocate($imR, $rgbcolor[0], $rgbcolor[1], $rgbcolor[2]);
		//$back = imagecolorallocate($imR, 37, 37, 37);
	      
	    // compute bounds of vertical axis
	    
	    // sort the histograms to find tallest bins
	    $sHistoR = $histoR;
	    $sHistoG = $histoG;
	    $sHistoB = $histoB;
	    sort($sHistoR);
	    sort($sHistoG);
	    sort($sHistoB);
	    
	    // we allow clipping of at most the 5 tallest histogram bins, but clipping
	    // also needs to be useful. i.e. if clipping does not change the vertical
	    // range much, then don't do it. The following heuristic code enforces this.
	    $lerpR = min(max(($sHistoR[255]/$sHistoR[250] - 1.15)/2.0, 0.0), 1.0);
	    $lerpG = min(max(($sHistoG[255]/$sHistoG[250] - 1.15)/2.0, 0.0), 1.0);
	    $lerpB = min(max(($sHistoB[255]/$sHistoB[250] - 1.15)/2.0, 0.0), 1.0);
	    $histoClipR = (1.0 - $lerpR)*$sHistoR[255] + $lerpR*$sHistoR[250];
	    $histoClipG = (1.0 - $lerpG)*$sHistoG[255] + $lerpG*$sHistoG[250];
	    $histoClipB = (1.0 - $lerpB)*$sHistoB[255] + $lerpB*$sHistoB[250];
	    $histoClip = max($histoClipR, $histoClipG, $histoClipB);
	    
	    if ($CONFIG['flf_histogram_type'] == 'combined')
	    {
	      // COMBINED COLOR HISTOGRAM
	      imagefilledrectangle($imR, 0, 0, 256, 100, $back);
	  
	      // CREATE GRAPH
	      for ($a = 0; $a < 256; $a++)
	      {
	          $heightsRGB = array(min($histoR[$a]/$histoClip, 1.0)*$maxheight,
	                              min($histoG[$a]/$histoClip, 1.0)*$maxheight,
	                              min($histoB[$a]/$histoClip, 1.0)*$maxheight);
	          $lineOrder = array(0, 1, 2);
	          array_multisort($heightsRGB, $lineOrder);
	          
	          // Draw 3 vertical lines.
	          // First a white line, for the extent that all the histograms overlap,
	          // Then as we cross each histogram, remove that appropriate color
	          // component.
	          $lineRGB = array(255, 255, 255);
	          $lineColor = ImageColorAllocateAlpha ($imR, $lineRGB[0], $lineRGB[1], $lineRGB[2], 0);
	          $start = $maxheight - $heightsRGB[0];
	          $end = $maxheight;
	          imageline ($imR,($a+1),$start,($a+1),$end,$lineColor);
	
	          $lineRGB[$lineOrder[0]] = 0;
	          $lineColor = ImageColorAllocateAlpha ($imR, $lineRGB[0], $lineRGB[1], $lineRGB[2], 0);
	          $start = $maxheight - $heightsRGB[1];
	          $end = $maxheight - $heightsRGB[0];
	          imageline ($imR,($a+1),$start,($a+1),$end,$lineColor);
	          
	          $lineRGB[$lineOrder[1]] = 0;
	          $lineColor = ImageColorAllocateAlpha ($imR, $lineRGB[0], $lineRGB[1], $lineRGB[2], 0);
	          $start = $maxheight - $heightsRGB[2];
	          $end = $maxheight - $heightsRGB[1];
	          imageline ($imR,($a+1),$start,($a+1),$end,$lineColor);
	      }
	    }
	    else
	    {   // SEPARATE R G B HISTOGRAMS
	        imagefilledrectangle($imR, 0, 0, 256, 300, $back);
	        
	        // CREATE GRAPH
	        for ($a = 0; $a < 256; $a++)
	        {
	            $lineColor = ImageColorAllocateAlpha ($imR, 255, 0, 0, 0);
	            $start = $maxheight - min($histoR[$a]/$histoClipR, 1.0)*$maxheight;
	            $end = $maxheight;
	            imageline ($imR,($a+1),$start,($a+1),$end,$lineColor);
	            
	            $lineColor = ImageColorAllocateAlpha ($imR, 0, 255, 0, 0);
	            $start = $maxheight - min($histoG[$a]/$histoClipG, 1.0)*$maxheight;
	            $end = $maxheight;
	            imageline ($imR,($a+1),$start+100,($a+1),$end+100,$lineColor);
	            
	            $lineColor = ImageColorAllocateAlpha ($imR, 0, 0, 255, 0);
	            $start = $maxheight - min($histoB[$a]/$histoClipB, 1.0)*$maxheight;
	            $end = $maxheight;
	            imageline ($imR,($a+1),$start+200,($a+1),$end+200,$lineColor);
	        }
	    }
	}
	else
	{   // GRAYSCALE
	
	    // COMPUTE MAX VALUES
	    $max = max($histo);
	    
	    // compute bounds of vertical axis
	    
	    // sort the histogram to find tallest bins
	    $sortedHisto = $histo;
	    sort($sortedHisto);
	    
	    // we allow clipping of at most the 5 tallest histogram bins, but clipping
	    // also needs to be useful. i.e. if clipping does not change the vertical
	    // range much, then don't do it. The following heuristic code enforces this.
	    $lerpFactor = min(max(($sortedHisto[255]/$sortedHisto[250] - 1.15)/2.0, 0.0), 1.0);
	    $histoClip = (1.0 - $lerpFactor)*$sortedHisto[255] + $lerpFactor*$sortedHisto[250];
	
		// CREATE HISTOGRAM BACKGROUND
		$back = imagecolorallocate($imR, $rgbcolor[0], $rgbcolor[1], $rgbcolor[2]);
		imagefilledrectangle($imR, 0, 0, 256, 100, $back);
		
		// MAKE HISTOGRAM COLOR NOT MATCH BACKGROUND LIGHTNESS
		if ((($rgbcolor[0] + $rgbcolor[0] + $rgbcolor[0])/3) < 127) {
			$graphcolor = 255;
		} else {
			$graphcolor = 0;
		}
		$text_color = ImageColorAllocateAlpha ($imR, $graphcolor, $graphcolor, $graphcolor, 0);
	
		// CREATE HISTOGRAM
		for ($a = 0; $a < 256; $a++){
			$h = min($histo[$a]/$histoClip, 1.0)*$maxheight;
			$start = ($maxheight - $h);
			imageline ($imR,($a+1),$start,($a+1),$maxheight,$text_color);
		}
	
		// ENG GRAY HISTOGRAM
	}
	
	
	
	
	// GET FILENAME OF FULL SIZE PHOTO
	
	$file = $coppermineid.'_'.$filename;
	
	// SAVE HISTOGRAM AND DESTROY RESOURCE

	if(is_writable("histograms")) {
		touch("histograms/hist_$file");
		
		
		if($CONFIG['flf_histogram_width'] != 256) {
	        $newW = $CONFIG['flf_histogram_width'];
	        $scale = $newW / 256;
	        
	        $width = imagesx($imR);
	        $height = imagesy($imR);
	        
	        
	        
	        $new_width = floor($scale*$width);
	        $new_height = floor($scale*$height);
	        $tmp_img = imagecreatetruecolor($new_width,$new_height);
	            // gd 2.0.1 or later: imagecopyresampled
	            // gd less than 2.0: imagecopyresized
	        if(function_exists(imagecopyresampled)) {
	            imagecopyresampled($tmp_img, $imR, 0,0,0,0,$new_width,$new_height,$width,$height);
	        } else {
	            imagecopyresized($tmp_img, $imR, 0,0,0,0,$new_width,$new_height,$width,$height);
	        }
	        imagedestroy($imR);
	        $imR = $tmp_img;
	            
	    }
		
		
		
		
		
		
		
		
		
		
		imagejpeg($imR,"histograms/hist_$file", 75);
		$histogram = "histograms/hist_$file";
		chmod($histogram,0644);
		imagedestroy($imR);
		$perms = fileperms("histograms");
		$retvar=true;
	} else {
		$retvar=false;
		echo '<div class="content"><h4>Histogram NOT Created! Check Directory(../histograms) Permissions</h4></div>';
	}
	
	
return $retvar;

}

function html2rgb($color)
{
    if ($color[0] == '#')
        $color = substr($color, 1);
    if (strlen($color) == 6)
        list($r, $g, $b) = array($color[0].$color[1],
                                 $color[2].$color[3],
                                 $color[4].$color[5]);
    elseif (strlen($color) == 3)
        list($r, $g, $b) = array($color[0], $color[1], $color[2]);
    else
        return false;
    $r = hexdec($r); $g = hexdec($g); $b = hexdec($b);
    return array($r, $g, $b);
}
