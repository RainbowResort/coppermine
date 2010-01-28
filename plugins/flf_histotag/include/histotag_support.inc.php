<?php
if (file_exists("./plugins/xfeed/lang/{$CONFIG['lang']}.php")) {
    require "./plugins/flf_histotag/lang/{$CONFIG['lang']}.php";
} else {
    require "./plugins/flf_histotag/lang/english.php";
}


function generateAllExifsIntoTable() {
    global $CONFIG, $flf_lang_var;
	$insertedvalues=0;
    $result = cpg_db_query("SELECT t.pid, t.filepath, t.filename FROM {$CONFIG['TABLE_PICTURES']} t WHERE t.pid not in (SELECT pid from  {$CONFIG['TABLE_PREFIX']}{$CONFIG['flf_histotag_tablename']} );");
    while ($row = mysql_fetch_assoc($result)) {
    
        $calldata['pid'] = $row['pid'];
        $calldata['filepath'] = $row['filepath'];
        $calldata['filename'] = $row['filename'];

		$success=extractExifsAndImport($calldata);
		if ($success) {
			$insertedvalues++;
		}
		
    }
    return $insertedvalues;
}

function deleteExifData($CoppermineData) {
	// delete the EXIF data once an image is removed 
	// TODO: Check if Data exists first!
	global $CONFIG, $flf_lang_var;
	$id= $CoppermineData['pid'];
	$sql_delete="DELETE FROM {$CONFIG['TABLE_PREFIX']}{$CONFIG['flf_histotag_tablename']} where pid='{$id}'";
	$vResult = cpg_db_query($sql_delete);
    mysql_free_result($vResult);	
	
}

function extractExifsAndImport($CoppermineData) {
	global $CONFIG, $flf_lang_var;

	$filepath=$CoppermineData['filepath'];
	$filename=$CoppermineData['filename'];
	$id= $CoppermineData['pid'];
	$exif=exif_read_data('albums/'.$filepath.$filename);

	//TODO: Check if header is present!
	
	/*foreach ($exif as $key => $section) {
	    foreach ($section as $name => $val) {
	        echo "$key.$name: $val<br />\n";
	    }
	}
	*/
	
	//$exif_gps_gpsversion=$exif['GPSVersion'];
	$exif_gps_gpsversion='';
	$exif_gps_gpslatituderef=$exif['GPSLatitudeRef'];
	$exif_gps_gpslatitude_1=$exif['GPSLatitude'][0];
	$exif_gps_gpslatitude_2=$exif['GPSLatitude'][1];
	$exif_gps_gpslatitude_3=$exif['GPSLatitude'][2];
	$exif_gps_gpslongituderef=$exif['GPSLongitudeRef'];
	$exif_gps_gpslongitude_1=$exif['GPSLongitude'][0];
	$exif_gps_gpslongitude_2=$exif['GPSLongitude'][1];
	$exif_gps_gpslongitude_3=$exif['GPSLongitude'][2];
	//$exif_gps_gpsaltituderef=$exif['GPSAltitudeRef'];
	$exif_gps_gpsaltituderef='';
	$exif_gps_gpsaltitude=$exif['GPSAltitude'];
	$exif_gps_gpsmapdatum=$exif['GPSMapDatum'];
	$exif_exif_exposuretime=$exif['ExposureTime'];
	$exif_exif_fnumber=$exif['FNumber'];
	$exif_exif_exposureprogram=$exif['ExposureProgram'];
	$exif_exif_isospeedrations=$exif['ISOSpeedRatings'];
	$exif_exif_exifversion=$exif['ExifVersion'];
	$exif_exif_datetimeoriginal=$exif['DateTimeOriginal'];
	$exif_exif_datetimedigitized=$exif['DateTimeDigitized'];
	//$exif_exif_componentsconfiguration=$exif['ComponentsConfiguration'];
	$exif_exif_componentsconfiguration='';
	$exif_exif_shutterspeedvalue=$exif['ShutterSpeedValue'];
	$exif_exif_aperturevalue=$exif['ApertureValue'];
	$exif_exif_focallength=$exif['FocalLength'];
	$exif_exif_flashpixversion=$exif['FlashPixVersion'];
	$exif_exif_colorspace=$exif['ColorSpace'];	
	$exif_exif_imageuniqueid=$exif['ColorSpace'];	
	$exif_ifd0_model=$exif['Model'];
	$exif_ifd0_xresolution=$exif['XResolution'];	
	$exif_ifd0_yresolution=$exif['YResolution'];
	$exif_ifd0_resolutionunit=$exif['ResolutionUnit'];
	$exif_ifd0_software='';
	$exif_ifd0_datetime=$exif['DateTime'];
	$exif_ifd0_ycbcrpositioning=$exif['YCbCrPositioning'];
	$exif_ifd0_copyright='';
	$exif_ifd0_exififdpointer=$exif['Exif_IFD_Pointer'];
	$exif_ifd0_gpsifdpointer=$exif['GPS_IFD_Pointer'];
	

	//TODO: Complete!
	// TODO: Parametrize correctly
	$sql_insert="INSERT into {$CONFIG['TABLE_PREFIX']}{$CONFIG['flf_histotag_tablename']} VALUES ('".
	$id."','".
	$exif_gps_gpsversion."','".
	$exif_gps_gpslatituderef."','".
	$exif_gps_gpslatitude_1."','".
	$exif_gps_gpslatitude_2."','".
	$exif_gps_gpslatitude_3."','".
	$exif_gps_gpslongituderef."','".
	$exif_gps_gpslongitude_1."','".
	$exif_gps_gpslongitude_2."','".
	$exif_gps_gpslongitude_3."','".
	$exif_gps_gpsaltituderef."','".
	$exif_gps_gpsaltitude."','".
	$exif_gps_gpsmapdatum."','".
	$exif_exif_exposuretime."','".
	$exif_exif_fnumber."','".
	// $exif_exif_exposureprogram
	$exif_exif_isospeedrations."','".
	$exif_exif_exifversion."','".
	$exif_exif_datetimeoriginal."','".
	// $exif_exif_datetimedigitized
	$exif_exif_componentsconfiguration."','".
	$exif_exif_shutterspeedvalue."','".
	$exif_exif_aperturevalue."','".
	$exif_exif_focallength."','".
	$exif_exif_flashpixversion."','".
	$exif_exif_colorspace."','".

	// ab hier keine Werte mehr
	$exif_exif_imageuniqueid."','".
	$exif_ifd0_model."','".
	$exif_ifd0_xresolution."','".
	$exif_ifd0_yresolution."',".
	$exif_ifd0_resolutionunit.",'".
	$exif_ifd0_software."','".
	$exif_ifd0_datetime."','".
	$exif_ifd0_ycbcrpositioning."','".
	$exif_ifd0_copyright."','".
	$exif_ifd0_exififdpointer."','".
	$exif_ifd0_gpsifdpointer."')";
		//
	$vResult = cpg_db_query($sql_insert);
    if ($vResult) {
    	mysql_free_result($vResult);
    	return true;
   		 }
    	else{
    		mysql_free_result($vResult);
    		return false;
    	}
    
   
		//TODO: Make sure to output results!
		
	
	
}


function renderGeoButton($template_img_navbar) {
    global $CONFIG, $CURRENT_PIC_DATA, $FAVPICS, $REFERER, $lang_picinfo, $flf_lang_var;

    $ref = $REFERER ? "&amp;referer=$REFERER" : '';
    $geo_tgt_return=generateLinkToGoogleMap($CURRENT_PIC_DATA['pid']);
    $geo_tgt=$geo_tgt_return[0].$ref."#top_display_media";
    
   // $fav_tgt = "addfav.php?pid={$CURRENT_PIC_DATA['pid']}".$ref."#top_display_media";
    if ($geo_tgt_return[0]) {
    	// Geo-Daten-gefunden
    	$geo_tgt=$geo_tgt_return[0];
    	$geo_title = $flf_lang_var['click_link'];
        $geo_icon = "geo.png";
        $geo_icon_hover = "geo.png";
        $geo_button = "
        <td align=\"center\" valign=\"middle\" class=\"navmenu\" width=\"42\">
            <a href=\"$geo_tgt\" rel=\"lyteframe\" rev=\"width: {$CONFIG['flf_histotag_lyteboxwidth']}px; height: {$CONFIG['flf_histotag_lyteboxheight']}px; \" class=\"navmenu_pic\" title=\"{$flf_lang_var['notice']}\" id=\"geo_lnk\"><img src=\"plugins/flf_histotag/images/$geo_icon\" border=\"0\" align=\"middle\" alt=\"$geo_title\" id=\"geo_ico\" /></a>
        </td>
        <script type=\"text/javascript\">
            $('#fav_lnk').mouseover(function() { $('#fav_ico').attr('src', 'plugins/flf_histotag/images/$geo_icon_hover'); } );
            $('#fav_lnk').mouseout(function() { $('#fav_ico').attr('src', 'plugins/flf_histotag/images/$geo_icon'); } );
        </script>
    ";
        
     } else {
     	if ($CONFIG['flf_histotag_show_geo_no_geotag']=='1') {
     		// show button only if parameter is set, otherwise: no button!
     		    $geo_tgt="#top_display_media";
		        $geo_title = $flf_lang_var['no_data'];
		        $geo_icon = "nogeo.png";
		        $geo_icon_hover = "nogeo.png";
		        $geo_button = "
		        <td align=\"center\" valign=\"middle\" class=\"navmenu\" width=\"42\">
		            <a href=\"$geo_tgt\" class=\"navmenu_pic\" title=\"$geo_title\" id=\"geo_lnk\"><img src=\"plugins/flf_histotag/images/$geo_icon\" border=\"0\" align=\"middle\" alt=\"$geo_title\" id=\"geo_ico\" /></a>
		        </td>
		        <script type=\"text/javascript\">
		            $('#fav_lnk').mouseover(function() { $('#fav_ico').attr('src', 'plugins/flf_histotag/images/$geo_icon_hover'); } );
		            $('#fav_lnk').mouseout(function() { $('#fav_ico').attr('src', 'plugins/flf_histotag/images/$geo_icon'); } );
		        </script>
		    ";
     	}

  	   } 

    
    
    
    $search = substr_count($template_img_navbar, "<!-- BEGIN pic_info_button -->") > 0 ? "<!-- BEGIN pic_info_button -->" : "<!-- BEGIN slideshow_button -->";

    $template_img_navbar = str_replace($search, $geo_button.$search, $template_img_navbar);

    return $template_img_navbar;


}


function GenerateLinkToMap($CoppermineID) {


	// Generate a Link to the Google Map for the picture with the given $ID
	// 1st read GPS EXIF-Data from Datbase
	// IF exists, convert to decimal output for google Maps
	// Then generate link to open new map
	// New map is being generated with code from map.php
	global $CONFIG, $flf_lang_var;
	$query="select * from {$CONFIG['TABLE_PREFIX']}{$CONFIG['flf_histotag_tablename']} where pid='{$CoppermineID}'";
	$vResult = cpg_db_query($query);
	$array = mysql_fetch_assoc($vResult);
	

	if ($vResult) {
		// found data in table
			$lat_hour=flf_calc($array['exif_GPS_GPSLatitude_1']);
			$lat_min=flf_calc($array['exif_GPS_GPSLatitude_2']);
			$lat_sec=flf_calc($array['exif_GPS_GPSLatitude_3']);
			
			$long_hour=flf_calc($array['exif_GPS_GPSLongitude_1']);
			$long_min=flf_calc($array['exif_GPS_GPSLongitude_2']);
			$long_sec=flf_calc($array['exif_GPS_GPSLongitude_3']);	
			
			if ($lat_hour && $lat_min && $lat_sec && $long_hour && $long_min & $long_sec) {

				$flf_longitude =degree2decimal($long_hour."h".$long_min."m".$long_sec."s".$array['exif_GPS_GPSLongitudeRef']);
				$flf_latitude=degree2decimal($lat_hour."h".$lat_min."m".$lat_sec."s".$array['exif_GPS_GPSLatitudeRef']);
				$maplink = <<<EOT
	plugins/flf_histotag/include/map.php?width={$CONFIG['flf_histotag_mapwidth']}&height={$CONFIG['flf_histotag_mapheight']	}&apiKey={$CONFIG['flf_histotag_apikey']	}&latitude={$flf_latitude}&longitude={$flf_longitude}
EOT;
				$returnvalues[0]=$maplink;}
			else {
				// at least one value not correct --> don't return a link!
				
			}
		

	
	}
	return $returnvalues;
}

	
function flf_calc($value) {
// takes the string x/y and returns the correct floating number

	$temp[]=explode('/',$value);
	$num=$temp[0][0];
	$den=$temp[0][1];
	if ($den!=0 && $den!=NULL)
	{
	return $num/$den;
	}
	else {
		return false;
	}
	
}
	
function degree2decimal($deg_coord="")
//degree format 121h8m6s"
//decimal format 121.135 
//accepts a coordinate in degree format and returns the equivalent decimal
//N & S are latitudes
//E & W are longitudes
//South latitudes and West longitudes are negative decimals
//calling examples 
//degree2decimal('121h8m6sN'); returns 121.135
//degree2decimal('121h8m6sS'); returns -121.135
//degree2decimal('121h8m6sE'); returns 121.135
//degree2decimal('121h8m6sW'); returns -121.135

{
	$dpos=strpos($deg_coord,'h');
	$mpos=strpos($deg_coord,'m');
	$spos=strpos($deg_coord,'s');
	$mlen=(($mpos-$dpos)-1);
	$slen=(($spos-$mpos)-1);
	$direction=substr(strrev($deg_coord),0,1);
	$degrees=substr($deg_coord,0,$dpos);
	$minutes=substr($deg_coord,$dpos+1,$mlen);
	$seconds=substr($deg_coord,$mpos+1,$slen);
	$seconds=($seconds/60);
	$minutes=($minutes+$seconds);
	$minutes=($minutes/60);
	$decimal=($degrees+$minutes);
	//South latitudes and West longitudes need to return a negative result
	if (($direction=="S") or ($direction=="W"))
	        { $decimal=$decimal*(-1);}
	return $decimal;
}
?>
