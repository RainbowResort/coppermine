<?php
if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');
function flf_create_directory() {
		if (file_exists("histograms")) {
			// directory exists
			if (!is_writable("histograms")) {
				// Directory is not writable
				echo "Directory 'histograms' exists but is not writable!";
				return false;
			}
			return true;
		}
		else 
		{
			// directory does not exist
			mkdir ("histograms",0775);	
			if (!is_writable("histograms")) {
				echo "Directory 'histograms' created but it is not writable!";
				return false;
			}
			return true;	
		}
	return true;

}
function flf_create_table($tablename) {
		global $CONFIG, $thisplugin;

	    // TODO: Read sql-Install-Statement from include/install.sql
	    $sql = "DROP TABLE IF EXISTS {$CONFIG['TABLE_PREFIX']}{$tablename}";
	    cpg_db_query($sql);	
		
		$sql = " CREATE TABLE {$CONFIG['TABLE_PREFIX']}{$tablename} (
		  `pid` int(11) NOT NULL,
		  `exif_GPS_GPSVersion` varchar(45) DEFAULT NULL,
		  `exif_GPS_GPSLatitudeRef` varchar(45) DEFAULT NULL,
		  `exif_GPS_GPSLatitude_1` varchar(45) DEFAULT NULL,
		  `exif_GPS_GPSLatitude_2` varchar(45) DEFAULT NULL,
		  `exif_GPS_GPSLatitude_3` varchar(45) DEFAULT NULL,
		  `exif_GPS_GPSLongitudeRef` varchar(45) DEFAULT NULL,
		  `exif_GPS_GPSLongitude_1` varchar(45) DEFAULT NULL,
		  `exif_GPS_GPSLongitude_2` varchar(45) DEFAULT NULL,
		  `exif_GPS_GPSLongitude_3` varchar(45) DEFAULT NULL,
		  `exif_GPS_GPSAltitudeRef` varchar(45) DEFAULT NULL,
		  `exif_GPS_GPSAltitude` varchar(45) DEFAULT NULL,
		  `exif_GPS_GPSMapDatum` varchar(45) DEFAULT NULL,
		  `exif_EXIF_ExposureTime` varchar(45) DEFAULT NULL,
		  `exif_EXIF_FNumber` varchar(45) DEFAULT NULL,
		  `exif_EXIF_ISOSpeedRatings` varchar(45) DEFAULT NULL,
		  `exif_EXIF_ExifVersion` varchar(45) DEFAULT NULL,
		  `exif_EXIF_DateTimeOriginal` varchar(45) DEFAULT NULL,
		  `exif_EXIF_ComponentsConfiguration` varchar(45) DEFAULT NULL,
		  `exif_EXIF_ShutterSpeedValue` varchar(45) DEFAULT NULL,
		  `exif_EXIF_ApertureValue` varchar(45) DEFAULT NULL,
		  `exif_EXIF_FocalLenght` varchar(45) DEFAULT NULL,
		  `exif_EXIF_FlashPixVersion` varchar(45) DEFAULT NULL,
		  `exif_EXIF_Colorspace` varchar(45) DEFAULT NULL,
		  `exif_EXIF_ImageUniqueID` varchar(45) DEFAULT NULL,
		  `exif_IFD0_Model` varchar(45) DEFAULT NULL,
		  `exif_IFD0_XResolution` varchar(45) DEFAULT NULL,
		  `exif_IFD0_YResolution` varchar(45) DEFAULT NULL,
		  `exif_IFD0_ResolutionUnit` varchar(45) DEFAULT NULL,
		  `exif_IFD0_Software` varchar(45) DEFAULT NULL,
		  `exif_IFD0_DateTime` varchar(45) DEFAULT NULL,
		  `exif_IFD0_YCbCrPositioning` varchar(45) DEFAULT NULL,
		  `exif_IFD0_Copyright` varchar(45) DEFAULT NULL,
		  `exif_IFD0_Exif_IFD_Pointer` varchar(45) DEFAULT NULL,
		  `exif_IFD0_GPS_IFD_Pointer` varchar(45) DEFAULT NULL,
		  PRIMARY KEY (`pid`)
		) COMMENT='Holds all exif information for fotos during upload';";
		cpg_db_query($sql);


		
		
		return true;	

}
function flf_enter_base_config() {
		global $CONFIG, $thisplugin;
		if (!$CONFIG['flf_histotag_tablename']) {	
			$sql = "insert into {$CONFIG['TABLE_CONFIG']} values ('flf_histotag_tablename','plugin_flf_histotag')";
			cpg_db_query($sql);
		}
		if (!$CONFIG['flf_histotag_mapwidth']) {
		$sql = "insert into {$CONFIG['TABLE_CONFIG']} values ('flf_histotag_mapwidth','640')";
		cpg_db_query($sql); }
		
		if (!$CONFIG['flf_histotag_mapheight']) {
			$sql = "insert into {$CONFIG['TABLE_CONFIG']} values ('flf_histotag_mapheight','480')";
		cpg_db_query($sql);		}

		if (!$CONFIG['flf_histotag_lyteboxwidth']) {
			$sql = "insert into {$CONFIG['TABLE_CONFIG']} values ('flf_histotag_lyteboxwidth','650')";
		cpg_db_query($sql);		}

		if (!$CONFIG['flf_histotag_lyteboxheight']) {
			$sql = "insert into {$CONFIG['TABLE_CONFIG']} values ('flf_histotag_lyteboxheight','490')";
		cpg_db_query($sql);		}

		if (!$CONFIG['flf_histotag_apikey']) {
			$sql = "insert into {$CONFIG['TABLE_CONFIG']} values ('flf_histotag_apikey','ENTER YOUR PERSONAL GOOGLE MAPS API KEY')";
	cpg_db_query($sql);		}
	
		if (!$CONFIG['flf_histotag_show_geo_button']) {
			$sql = "insert into {$CONFIG['TABLE_CONFIG']} values ('flf_histotag_show_geo_button','1')";
		cpg_db_query($sql);	}
	
		if (!$CONFIG['flf_histotag_show_geo_no_geotag']) {
			$sql = "insert into {$CONFIG['TABLE_CONFIG']} values ('flf_histotag_show_geo_no_geotag','1')";
			cpg_db_query($sql);	}

		if (!$CONFIG['flf_histogram_use_hist_feature']) {
			$sql = "insert into {$CONFIG['TABLE_CONFIG']} values ('flf_histogram_use_hist_feature','1')";
		cpg_db_query($sql);			}

		if (!$CONFIG['flf_histogram_show_hist_button']) {
			$sql = "insert into {$CONFIG['TABLE_CONFIG']} values ('flf_histogram_show_hist_button','1')";
		cpg_db_query($sql);		}

		if (!$CONFIG['flf_histogram_show_hist_if_no_hist']) {
			$sql = "insert into {$CONFIG['TABLE_CONFIG']} values ('flf_histogram_show_hist_if_no_hist','1')";
		cpg_db_query($sql);		}

		if (!$CONFIG['flf_histogram_type']) {
			$sql = "insert into {$CONFIG['TABLE_CONFIG']} values ('flf_histogram_type','combined')";
		cpg_db_query($sql);		}

		if (!$CONFIG['flf_histogram_width']) {
			$sql = "insert into {$CONFIG['TABLE_CONFIG']} values ('flf_histogram_width','256')";
		cpg_db_query($sql);		}
	
		if (!$CONFIG['flf_histogram_color']) {
			$sql = "insert into {$CONFIG['TABLE_CONFIG']} values ('flf_histogram_color','#151515')";
		cpg_db_query($sql);		}

		if (!$CONFIG['flf_histo_lyteboxwidth']) {
			$sql = "insert into {$CONFIG['TABLE_CONFIG']} values ('flf_histo_lyteboxwidth','300')";
		cpg_db_query($sql);
				}

		if (!$CONFIG['flf_histo_lyteboxheight']) {
			$sql = "insert into {$CONFIG['TABLE_CONFIG']} values ('flf_histo_lyteboxheight','200')";
		cpg_db_query($sql);
				}

		if (!$CONFIG['flf_histo_onthefly']) {
			$sql = "insert into {$CONFIG['TABLE_CONFIG']} values ('flf_histo_onthefly','1')";
		cpg_db_query($sql);
		}

	
		
		
		return true;
	
}

function flf_delete_table($tablename) {
		global $CONFIG, $thisplugin;
		$sql = "DROP TABLE IF EXISTS {$CONFIG['TABLE_PREFIX']}{$tablename}";
	    cpg_db_query($sql);	
	    return true;
}
function flf_delete_base_config() {
		global $CONFIG, $thisplugin;
		  $sql = "DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name like 'flf_%'";
	      cpg_db_query($sql);	
	   return true;
}
// TODO: Generate Histogram directory!
?>