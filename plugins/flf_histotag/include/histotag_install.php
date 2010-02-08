<?php
if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

function flf_create_table() {
		global $CONFIG, $thisplugin;

		$tablename='plugin_flf_histotag';
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
		
		if (!$CONFIG['plugin_flf_histotag_histoquality']) {
		$sql = "insert IGNORE  into {$CONFIG['TABLE_CONFIG']} values ('plugin_flf_histotag_histoquality','100')";
		cpg_db_query($sql); }
		
		if (!$CONFIG['plugin_flf_histotag_mapwidth']) {
		$sql = "insert IGNORE  into {$CONFIG['TABLE_CONFIG']} values ('plugin_flf_histotag_mapwidth','640')";
		cpg_db_query($sql); }
		
		if (!$CONFIG['plugin_flf_histotag_mapheight']) {
			$sql = "insert IGNORE  into {$CONFIG['TABLE_CONFIG']} values ('plugin_flf_histotag_mapheight','480')";
		cpg_db_query($sql);		}

		if (!$CONFIG['plugin_flf_histotag_mapboxwidth']) {
			$sql = "insert IGNORE  into {$CONFIG['TABLE_CONFIG']} values ('plugin_flf_histotag_mapboxwidth','650')";
		cpg_db_query($sql);		}

		if (!$CONFIG['plugin_flf_histotag_mapboxheight']) {
			$sql = "insert IGNORE  into {$CONFIG['TABLE_CONFIG']} values ('plugin_flf_histotag_mapboxheight','490')";
		cpg_db_query($sql);		}

		if (!$CONFIG['plugin_flf_histotag_apikey']) {
			$sql = "insert IGNORE  into {$CONFIG['TABLE_CONFIG']} values ('plugin_flf_histotag_apikey','ENTER YOUR PERSONAL GOOGLE MAPS API KEY')";
	cpg_db_query($sql);		}
	
		if (!$CONFIG['plugin_flf_histotag_createonupload']) {
			$sql = "insert IGNORE  into {$CONFIG['TABLE_CONFIG']} values ('plugin_flf_histotag_createonupload','1')";
		cpg_db_query($sql);			}

		if (!$CONFIG['plugin_flf_histotag_histotype']) {
			$sql = "insert IGNORE  into {$CONFIG['TABLE_CONFIG']} values ('plugin_flf_histotag_histotype','1')";
		cpg_db_query($sql);		}

		if (!$CONFIG['plugin_flf_histotag_histowidth']) {
			$sql = "insert IGNORE  into {$CONFIG['TABLE_CONFIG']} values ('plugin_flf_histotag_histowidth','256')";
		cpg_db_query($sql);		}
	
		if (!$CONFIG['plugin_flf_histotag_histocolor']) {
			$sql = "insert  IGNORE into {$CONFIG['TABLE_CONFIG']} values ('plugin_flf_histotag_histocolor','#151515')";
		cpg_db_query($sql);		}

		if (!$CONFIG['plugin_flf_histotag_histoboxwidth']) {
			$sql = "insert  IGNORE into {$CONFIG['TABLE_CONFIG']} values ('plugin_flf_histotag_histoboxwidth','300')";
		cpg_db_query($sql);
				}

		if (!$CONFIG['plugin_flf_histotag_histoboxheight']) {
			$sql = "insert IGNORE  into {$CONFIG['TABLE_CONFIG']} values ('plugin_flf_histotag_histoboxheight','200')";
		cpg_db_query($sql);
				}

			if (!$CONFIG['plugin_flf_histotag_mapmode']) {
			$sql = "insert IGNORE into {$CONFIG['TABLE_CONFIG']} values ('plugin_flf_histotag_mapmode','1')";
		cpg_db_query($sql);
		}
		
		if (!$CONFIG['plugin_flf_histotag_geosupport']) {
			$sql = "insert IGNORE into {$CONFIG['TABLE_CONFIG']} values ('plugin_flf_histotag_geosupport','1')";
		cpg_db_query($sql);
		}

		if (!$CONFIG['plugin_flf_histotag_histosupport']) {
			$sql = "insert IGNORE into {$CONFIG['TABLE_CONFIG']} values ('plugin_flf_histotag_histosupport','2')";
		cpg_db_query($sql);
		}
		
		
		return true;
	
}

function flf_delete_table() {
		global $CONFIG, $thisplugin;		
		$tablename='plugin_flf_histotag';
		$sql = "DROP TABLE IF EXISTS {$CONFIG['TABLE_PREFIX']}{$tablename}";
	    cpg_db_query($sql);	
	    return true;
}
function flf_delete_base_config() {
		global $CONFIG, $thisplugin;
		  $sql = "DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name like 'plugin_flf_histotag_%'";
	      cpg_db_query($sql);	
	   return true;
}
// TODO: Generate Histogram directory!
?>