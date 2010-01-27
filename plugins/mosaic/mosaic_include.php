<?php

/**
* phpMosaic
* Class to create mosaic images
*
* @author		Alexander Mank, Ortwin Kartmann
*
* some minor adaptions done by Stramm so it works together with CPG
* */

abstract class phpMosaicBase {

	//protected $db;
	protected $sqlTableName;
	protected $tnWidth;
	protected $tnHeight;
	protected $imageFormat;
	protected $pixelTotal;
	protected $configArray;
	protected $showErrors;
	protected $callbackFunction = null;
	protected $errorId;
	protected $errorMessage;
	protected $errorDescription;


	public function __construct() {
		global $CONFIG;
		$this->configArray = $CONFIG;
		$this->makeDatabaseConnection();
		$this->showErrorMessages(true);
		$this->setTimeLimit($this->configArray['mosaic_time_limit']);
		$this->setMemoryLimit($this->configArray['mosaic_memory_limit']);
		$this->setThumbnailSize($this->configArray['mosaic_thumbnail_width'], $this->configArray['mosaic_thumbnail_height']);
	}


	/**
	 * Enables or disables error messages output to browser
	 * default is enabled (true)
	 *
	 * @param bool $value
	 */
	public function showErrorMessages($value=true) {

		$this->showErrors = $value;
	}

	/**
	 * Set size of thumbnail for parser or creator
	 * parser will resize source images to this value
	 * creator will only use this size of thumbnails for mosaic
	 * if not set creator uses size from config-file
	 *
	 * @param int $width
	 * @param int $height
	 */
	public function setThumbnailSize($width, $height) {

		$this->tnWidth = (intval($width) > 0) ? intval($width) : 40;
		$this->tnHeight = (intval($height) > 0) ? intval($height) : 30;
		$this->imageFormat = $this->tnWidth / $this->tnHeight;
		$this->pixelTotal = $this->tnWidth * $this->tnHeight;
	}


	/**
	 * Set time limit for execution in seconds
	 * 0 = unlimited
	 * works only if php safe mode is off!
	 *
	 * @param int $limit
	 */
	public function setTimeLimit($limit) {

		ini_set('max_execution_time', intval($limit));
		ini_set('max_input_time', intval($limit/2));
	}


	/**
	 * Set memory limit for execution in megabyte
	 * if set to auto default from php.ini will be used
	 * works only if php safe mode is off!
	 *
	 * @param mixed $limit
	 */
	public function setMemoryLimit($limit) {

		if ($limit != 'auto') {

			$value = intval($limit) . "M";
			ini_set('memory_limit', $value);
		}
	}


	/**
	 * connects to the database
	 */
	protected function makeDatabaseConnection() {
		//$this->db = mysql_connect($this->configArray['db_host'], $this->configArray['db_user'], $this->configArray['db_pass']) or die("error");
		//mysql_select_db($this->configArray['db_name'], $this->db) or die("invalid database name");
		$this->sqlTableName = $this->configArray['TABLE_MOSAIC'];
	}


	/**
	 * runs sql-query and returns result-array
	 *
	 * @param string $query
	 * @return array
	 */
	protected function getSqlResult($query) {

		//$result = mysql_query($query, $this->db);
		$result = mysql_query($query);
		$new_array = array();

		while ( $row = @mysql_fetch_object($result) ) {
			$new_array[] = get_object_vars($row);
		}

		@mysql_free_result($result);
		return $new_array;
	}


	/**
	 * runs sql-query
	 *
	 * @param string $query
	 */
	protected function sqlQuery($query) {
		//mysql_query($query, $this->db);
		mysql_query($query);
	}

	/**
	 * escapes a
	 *
	 * @param string $text
	 */
	protected function sqlEscape ($str) {

		if (get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}

		//return mysql_real_escape_string ($str, $this->db);
		return mysql_real_escape_string ($str);
	}

	/**
	 * sets an error by id
	 *
	 * @param int $id
	 */
	protected function setError($id) {

		$this->errorId = $id;
	}


	/**
	 * return current error ID
	 *
	 * @return int
	 */
	private function getErrorId() {

		return $this->errorId;
	}

	/**
	 * sets the error message
	 * if showErrors is true this function sends error-message to browser
	 *
	 * @param string $message
	 */
	protected function setErrorMessage($message) {

		$this->errorMessage = $message;

		if ($this->showErrors)
			echo '<div style="color: red; font-weight: bold; font-size: 12px; background-color: orange; padding: 20px; text-align: center; border: 2px solid black;">' . $this->errorMessage . '</div>';
	}


	/**
	 * returns current error-message
	 *
	 * @return string
	 */
	public function getErrorMessage() {

		return $this->errorMessage;
	}

	/**
	 * sets the error description
	 * if showErrors is true this function sends error-description to browser
	 *
	 * @param string $description
	 */
	protected function setErrorDescription($description) {

		$this->setErrorDescription = $description;

		if ($this->showErrors)
			echo '<div style="color: red; font-weight: bold; font-size: 12px; background-color: orange; padding: 20px; text-align: center; border: 2px solid black;">' . $this->setErrorDescription . '</div>';
	}

	/**
	 * return current error-description
	 *
	 * @return string
	 */
	public function getErrorDescription() {

		return $this->setErrorDescription;
	}

	/**
	 * returns the extension of a filename
	 *
	 * @param string $string
	 * @return string
	 */
	protected function getFileExtention($string) {

		$ext = strrchr($string,".");
		$ext = str_replace(".","",$ext);
		return strtolower($ext);
	}

	/**
	 * register a callback function
	 *
	 * @param string $func
	 */
	public function registerProgressCallback ( $func ) {
		$this->callbackFunction = $func;
	}

	/**
	 * returns array of available groups in database-table
	 *
	 * @return array
	 */
	public function getGroupsArray() {
		return $this->getSqlResult("SELECT groups AS name, count(*) AS counter FROM $this->sqlTableName GROUP by name ORDER BY name ASC");
	}

}


/**
 * Klasse zum Parsen von Bildern
 * Die Bilder werden dann in der Datenbank gespeichert.
 */
class phpMosaicImageParser extends phpMosaicBase {

	private $includeSubfolders;
	private $resizeOption;
	private $imageExtensionsArray;
	private $tnQuality;
	private $regEx;
	private $overwriteImages;
	private $parsedImages = 0;

	public function __construct() {

		parent::__construct();
		$this->includeSubfolders = false;
		$this->overwriteImages = false;
		$this->setResizeOption($this->configArray['mosaic_resize_option']);
		$this->setThumbnailQuality($this->configArray['mosaic_thumbnail_quality']);
		$this->imageExtensionsArray = array("jpg","jpeg","bmp","gif","png");
		$this->regEx = '';
	}


	/**
	 * clears the database-table (all data in the table will be lost)
	 *
	 */
	public function clearAll() {
		$this->sqlQuery("TRUNCATE TABLE ".$this->sqlTableName);
	}


	/**
	 * clears all rows in the database-table with groupname
	 *
	 * @param string $groupName
	 */
	public function clearGroup($groupName='default') {

		$this->sqlQuery("DELETE FROM $this->sqlTableName WHERE groups='" . $this->sqlEscape($groupName) . "'");
	}


	/**
	 * if set to true function parseImageFolder will also parse included subfolders
	 *
	 * @param bool $value
	 */
	public function includeSubfolders($value=true) {

		$this->includeSubfolders = $value;
	}


	/**
	 * sets the resize option for source-images with different format than thumbnail format
	 * deform [default]: thumbnails will be deformed, but include all source-image information
	 * ignore: source images will be ignored
	 * cut: cuts the middle from source picture related to the thumbnail format, some source-image information will be lost
	 *
	 * @param string $value
	 */
	public function setResizeOption($value='deform') {

		if ($value == 'cut')
			$this->resizeOption = 'cut';
		elseif ($value == 'ignore')
			$this->resizeOption = 'ignore';
		else
			$this->resizeOption = 'deform';
	}


	/**
	 * Set thumbnail quality (1..100)
	 * default: 75%
	 *
	 * @param int $value
	 */
	public function setThumbnailQuality($value=75) {

		$value = intval($value);
		$this->tnQuality = (($value > 0) && ($value <= 100)) ? $value : 75;
	}


	/**
	 * if set function parseImageFolder will only parse source-images with given etensions
	 * possible values: jpg, jpeg, png, gif, bmp
	 *
	 * @param array $imageExtensionsArray
	 */
	public function setImageExtensions($imageExtensionsArray) {

		$this->imageExtensionsArray = array();

		if (count($imageExtensionsArray) > 0) {
			foreach ($imageExtensionsArray as $extension) {
				$this->imageExtensionsArray[] = str_replace('.','',$extension);
			}
		}
	}


	/**
	 * if set function parseImageFolder will only parse fitting source-images
	 *
	 * @param string $value
	 */
	public function setRegEx($value="") {

		$this->regEx = $value;
	}


	/**
	 * if set to true existing thmbnails in database-table will be overwritten
	 * default: false
	 *
	 * @param bool $value
	 */
	public function overwriteExistingImages($value=true) {

		$this->overwriteImages = $value;
	}


	/**
	 * return number of parsed source-images
	 *
	 * @return int
	 */
	public function getParsedImages() {

		return $this->parsedImages;
	}


	/**
	 * instead of parsing a folder, you can parse only one source-image
	 * returns error-id or 0 (0 = no error)
	 *
	 * @param string $file
	 * @param string $groupName
	 * @return int
	 */
	public function parseImage($file, $groupName='default') {

		if ($groupName == '')
			$groupName = 'default';

		if (file_exists($file)) {

			$this->parsedImages = 0;
			$file_array['file'] = $file;
			$file_array['filename'] = str_replace("/","",strrchr($file,"/"));
			$file_array['folder'] = str_replace(strrchr($file,"/"),"",$file);
			$file_array['extension'] = $this->getFileExtention($file_array['filename']);

			if (in_array($file_array['extension'], array('gif','jpg','jpeg','bmp','png','tif'))) {

				$this->_createThumbnail($file_array, $groupName);
				return true;
			}
			else {

				$this->setError(2);
				$this->setErrorMessage('Invalid filetype');
				$this->setErrorDescription('File is not of the necessary type: jpg, jpeg, gif, png, bmp');
				return false;
			}
		}
		else {

			$this->setError(1);
			$this->setErrorMessage('File doesn\'t exist');
			$this->setErrorDescription('Selected file wasn\'t found');
			return false;
		}
	}


	/**
	 * this function creates thumbnails from source-images of the assigned folder
	 * all information will be saved in the database-table
	 * you are able to group thumbnails with [optional] groupName
	 * if group names are set, you can create mosaic-images with and without specified groupnames
	 * returns error-id or 0 (0 = no error)
	 *
	 * @param string $folder
	 * @param string $groupName
	 * @return int
	 */
	public function parseImageFolder($folder, $groupName='default') {

		$folder = $this->_removeLastSlash($folder);
		$this->parsedImages = 0;

		if ($groupName == '')
			$groupName = 'default';

		if (is_dir($folder)) {

			$files = $this->_getFilesArray($folder);

			if (count($files) > 0) {

				$counter = 0;
				$percent = 0;
				$percent_tmp = 0;

				foreach ($files as $file) {

					$counter++;

					if (in_array($file['extension'], $this->imageExtensionsArray)) {

						if (($this->regEx == '') || (preg_match($this->regEx,$file['file']))) {
							$this->_createThumbnail($file, $groupName);
						}

						// Wenn eine Callback Funktion registriert wurde, wird diese hier aufgerufen
						// Und als Parameter wird die aktuelle Prozentzahl übergeben

						if (!is_null($this->callbackFunction)) {
							$percent = round((100 / count($files)) * $counter);
							if ($percent > $percent_tmp) {
								call_user_func ( $this->callbackFunction, $percent );
							}
							$percent_tmp = $percent;
						}
					}
				}
			}

			return true;
		}
		else {

			$this->setError(3);
			$this->setErrorMessage('Directory doesn\'t exist');
			$this->setErrorDescription('Directory not found');
			return false;
		}
	}


	/**
	 * this function creates a thmubnail from a source-image an writes image information and image data to database table
	 *
	 * @param array $file
	 * @param string $groupName
	 */
	private function _createThumbnail($file, $groupName) {

		$sqlQuery = "SELECT id FROM $this->sqlTableName WHERE folder='". $this->sqlEscape($file['folder']) ."' && filename='".$this->sqlEscape($file['filename'])."' && width='" . $this->sqlEscape($this->tnWidth) . "' && height='" . $this->sqlEscape($this->tnHeight) . "'";
		$res = $this->getSqlResult($sqlQuery);
		$id = (isset($res[0]['id'])) ? intval($res[0]['id']) : 0;

		if (($this->overwriteImages) || ($id <= 0)) {

			$src_dim = getimagesize($file['file']);
			$format = $src_dim[0] / $src_dim[1];

			if (($src_dim[0] >= $this->tnWidth) && ($src_dim[1] >= $this->tnHeight)) {

				if (($this->resizeOption != 'ignore') || ($format == $this->imageFormat)) {

					if ($file['extension'] == "gif")
						$im0 = imagecreatefromgif($file['file']);
					elseif ($file['extension'] == "png")
						$im0 = imagecreatefrompng($file['file']);
					elseif ($file['extension'] == "bmp")
						$im0 = imagecreatefromwbmp($file['file']);
					else
						$im0 = imagecreatefromjpeg($file['file']);

					$im1 = imagecreatetruecolor($this->tnWidth,$this->tnHeight);

					if ($this->resizeOption == 'cut') {

						$diff_w = $src_dim[0] / $this->tnWidth;
						$diff_h = $src_dim[1] / $this->tnHeight;
						$factor = ($diff_w < $diff_h) ? $diff_w : $diff_h;
						$new_src_w = round($this->tnWidth * $factor);
						$new_src_h = round($this->tnHeight * $factor);
						$src_x = round(($src_dim[0] - $new_src_w) / 2);
						$src_y = round(($src_dim[1] - $new_src_h) / 2);
						imagecopyresampled($im1,$im0,0,0,$src_x,$src_y,$this->tnWidth,$this->tnHeight,$new_src_w,$new_src_h);
					}
					else {

						imagecopyresampled($im1,$im0,0,0,0,0,$this->tnWidth,$this->tnHeight,$src_dim[0],$src_dim[1]);
					}

					$sum_red = 0;
					$sum_green = 0;
					$sum_blue = 0;

					for ($x=0; $x<$this->tnWidth; $x++) {

						for($y=0; $y<$this->tnHeight; $y++) {

							$color = imagecolorsforindex($im1,imagecolorat($im1,$x,$y));
							$sum_red += $color['red'];
							$sum_green += $color['green'];
							$sum_blue += $color['blue'];
						}
					}

					$red = round($sum_red / $this->pixelTotal);
					$green = round($sum_green / $this->pixelTotal);
					$blue = round($sum_blue / $this->pixelTotal);

					ob_start();
						imagejpeg($im1,'',$this->tnQuality);
						$x = ob_get_contents();
					ob_end_clean();

					if ($id > 0) {
						$sqlQuery = "UPDATE $this->sqlTableName
											SET width='" . $this->sqlEscape($this->tnWidth) . "',
												height='" . $this->sqlEscape($this->tnHeight) . "',
												red='" . $this->sqlEscape($red) . "',
												green='" . $this->sqlEscape($green) . "',
												blue='" . $this->sqlEscape($blue) . "',
												folder='" . $this->sqlEscape($file['folder']) . "',
												filename='" . $this->sqlEscape($file['filename']) . "',
												groups='" . $this->sqlEscape($groupName) . "',
												image='".addslashes($x)."',
												_update='".time()."'
											WHERE id='$id'";
						$this->sqlQuery($sqlQuery);
					}
					else {
						$sqlQuery = "INSERT INTO $this->sqlTableName
											SET width='" . $this->sqlEscape($this->tnWidth) . "',
												height='" . $this->sqlEscape($this->tnHeight) . "',
												red='" . $this->sqlEscape($red) . "',
												green='" . $this->sqlEscape($green) . "',
												blue='" . $this->sqlEscape($blue) . "',
												folder='" . $this->sqlEscape($file['folder']) . "',
												filename='" . $this->sqlEscape($file['filename']) . "',
												groups='" . $this->sqlEscape($groupName) . "',
												image='".addslashes($x)."',
												_insert='".time()."',
												_update='".time()."'";
						$this->sqlQuery($sqlQuery);
					}

					$this->parsedImages++;
					imagedestroy($im0);
					imagedestroy($im1);
				}
			}
		}
	}


	/**
	 * returns array of the folder-structure (recursive function)
	 *
	 * @param string $folder
	 * @param array $files
	 * @return array
	 */
	private function _getFilesArray($folder, $files=array()) {

		$elements = scandir($folder);

		if (count($elements) > 0) {

			foreach ($elements as $element) {

				if (($element != '.') && ($element != '..')) {

					if (is_dir($folder."/".$element)) {

						if ($this->includeSubfolders)
							$files = $this->_getFilesArray($folder."/".$element, $files);
					}
					else {

						$files[] = array("filename"=>$element, "folder"=>$folder, "file"=>$folder."/".$element, "extension"=>$this->getFileExtention($element));
					}
				}
			}
		}

		return $files;
	}


	/**
	 * removes last slash of a string and return it
	 *
	 * @param string $string
	 * @return string
	 */
	private function _removeLastSlash($string) {

		$string = str_replace("//","/",$string);
		$lastPos = strlen($string) - 1;
		$lastChar = substr($string,$lastPos,1);

		return ($lastChar == '/') ? substr($string,0,$lastPos) : $string;
	}
}

class phpMosaicImageCreator extends phpMosaicBase {

	private $srcImage;
	private $tnArray;
	private $quality;
	private $range;
	private $distance;
	private $optimiser;
	private $groupsFilter;
	private $thumbnailLimit;

	public function __construct() {

		parent::__construct();
		$this->srcImage = '';
		$this->quality = 75;
		$this->range = 0;
		$this->distance = 0;
		$this->optimiser = true;
		$this->groupsFilter = array();
		$this->setThumbnailLimit($this->configArray['mosaic_thumbnail_limit']);
	}


	/**
	 * the source image must be set to create a mosaic-image
	 * returns error-id or 0 (0 = no error)
	 *
	 * @param string $file
	 * @return int
	 */
	public function setSourceImageFile($file) {

		if (file_exists($file)) {

			if (in_array($this->getFileExtention($file), array('gif','jpg','jpeg','bmp','png','tif'))) {

				$this->srcImage = $file;
				return true;
			}
			else {

				$this->setError(5);
				$this->setErrorMessage('invalid filetype');
				$this->setErrorDescription('Source is not of a valid format: jpg, jpeg, gif, png, bmp');
				return false;
			}
		}
		else {

			$this->setError(4);
			$this->setErrorMessage('File doesn\'t exist');
			$this->setErrorDescription('Source pic not found');
			return false;
		}
	}


	/**
	 * Set mosaic-image quality (1..100)
	 * default: 75%
	 *
	 * @param int $value
	 */
	public function setQuality($value=75) {

		$value = intval($value);
		$this->quality = (($value > 0) && ($value <= 100)) ? $value : 75;
	}


	/**
	 * this number of pixels of the source-image width will be replaced by one thumbnail
	 * if set to 0 mosaic-image will contain round about 1000 thumbnails
	 *
	 * @param int $value
	 */
	public function setRange($value=0) {

		$this->range = intval($value);
	}


	/**
	 * set the distance of equal thumbnails
	 * if set to 0 all thumbnails can be used unlimited
	 * if set to 8 for example equal thumbnails have a distance from 8 and more thumbnails (row and col)
	 *
	 * @param int $value
	 */
	public function setDistance($value=0) {

		$this->distance = intval($value);
	}


	/**
	 * if groups-filter ist set, only groups in assigned array will be taken for mosaic-image creation process
	 *
	 * @param array $filter_array
	 */
	public function setGroupsFilter($filter_array) {

		$this->groupsFilter = $filter_array;
	}


	/**
	 * set maximum number of thumbnails for mosaic-image
	 * creation process returns error if mosaic-image needs more thumbnails
	 * 0 = unlimited
	 *
	 * @param int $value
	 */
	public function setThumbnailLimit($value=0) {

		$this->thumbnailLimit = intval($value);
	}


	/**
	 * Enables mosaic-image optimiser (takes more time for creation process)
	 * Optimiser is enabled by default
	 *
	 */
	public function enableOptimiser() {

		$this->optimiser = true;
	}


	/**
	 * Disables mosaic-image optimiser (takes less time for creation process)
	 * Optimiser is enabled by default
	 *
	 */
	public function disableOptimiser() {

		$this->optimiser = false;
	}

	/**
	 * returns array of available thumbnail sizes in database-table
	 *
	 * @return array
	 */
	public function getThumbnailSizesArray() {

		return $this->getSqlResult("SELECT DISTINCT width, height FROM $this->sqlTableName");
	}


	/**
	 * starts the mosaic-image creation process
	 * target file name must be JPG (.jpg)
	 * returns error-id or 0 (0 = no error)
	 *
	 * @param string $target
	 * @return unknown
	 */
	public function createMosaicImage($target='phpmosaic.jpg') {

		if ($this->srcImage != '') {

			$src_dim = getimagesize($this->srcImage);
			$filters = count($this->groupsFilter);

			if ($filters > 0) {

				$sql_where = '';

				for ($i=1; $i<$filters; $i++) {
					$sql_where .= " || groups='" . $this->sqlEscape($this->groupsFilter[$i]) . "'";
				}
				$sqlQuery = "SELECT id, red, green, blue FROM $this->sqlTableName WHERE width='" . $this->sqlEscape($this->tnWidth) . "' && height='" . $this->sqlEscape($this->tnHeight) . "' && (groups='" . $this->sqlEscape($this->groupsFilter[0]) . "'".$sql_where.")";
				$this->tnArray = $this->getSqlResult($sqlQuery);
			}
			else {

				$this->tnArray = $this->getSqlResult("SELECT id, red, green, blue FROM $this->sqlTableName WHERE width='" . $this->sqlEscape($this->tnWidth) . "' && height='" . $this->sqlEscape($this->tnHeight) . "'");
			}

			$tn_total = count($this->tnArray);

			if ($this->range <= 0)
				$this->range = round($src_dim[0] / 32);

			$anz_tn_x = round($src_dim[0] / $this->range);
			$src_format = $src_dim[0] / $src_dim[1];
			$mosaic_dim_x = $anz_tn_x * $this->tnWidth;
			$tmp_y = $mosaic_dim_x / $src_format;
			$anz_tn_y = round($tmp_y / $this->tnHeight);
			$mosaic_dim_y = $anz_tn_y * $this->tnHeight;

			$tn_need_max = $anz_tn_x * $anz_tn_y;
			$tn_need = ($this->distance + 1) * ($this->distance + 1);

			if (($tn_need > $tn_total) && ($tn_need_max > $tn_total)) {

				$this->setError(7);
				$this->setErrorMessage('Not enough thumbnails');
				$tn_msg = ($tn_need > $tn_need_max) ? $tn_need_max : $tn_need;
				$this->setErrorDescription('Minimum needed are '.$tn_msg.' thumbnails to build the mosaic picture. In the database ore only '.$tn_total.' thumbnails. Still needed are ' . ($tn_msg - $tn_total) . " pics.");
				return false;
			}
			else {

				if (($this->thumbnailLimit > 0) && ($tn_need_max > $this->thumbnailLimit)) {

					$this->setError(8);
					$this->setErrorMessage('Max size exceeded');
					$this->setErrorDescription('Necessary are '.$tn_need_max.' thumbs for to create the mosaic picture. The admin has set a limit of '.$this->thumbnailLimit.' thumbnails. Please change range or distance.');
					return false;
				}
				else {

					if ($this->optimiser)
						$this->_createMosaicImageWithOptimiser($target, $src_dim, $anz_tn_x, $anz_tn_y, $mosaic_dim_x, $mosaic_dim_y);
					else
						$this->_createMosaicImageWithoutOptimiser($target, $src_dim, $anz_tn_x, $anz_tn_y, $mosaic_dim_x, $mosaic_dim_y);

					return true;
				}
			}
		}
		else {

			$this->setError(6);
			$this->setErrorMessage('No source picture selected');
			$this->setErrorDescription('Use method setSourceImage()');
			return false;
		}
	}


	/**
	 * creates mosaic-image without optimiser
	 *
	 * @param string $target
	 * @param array $src_dim
	 */
	private function _createMosaicImageWithoutOptimiser($target, $src_dim, $anz_tn_x, $anz_tn_y, $mosaic_dim_x, $mosaic_dim_y) {

		if (count($this->tnArray) > 0) {

			foreach($this->tnArray as $key => $value) {

				$this->tnArray[$key]['used'] = 0;
				$this->tnArray[$key]['x'] = -1;
				$this->tnArray[$key]['y'] = -1;
			}
		}

		$extension = $this->getFileExtention($this->srcImage);

		if ($extension == "gif")
			$im0 = imagecreatefromgif($this->srcImage);
		elseif ($extension == "png")
			$im0 = imagecreatefrompng($this->srcImage);
		elseif ($extension == "bmp")
			$im0 = imagecreatefromwbmp($this->srcImage);
		else
			$im0 = imagecreatefromjpeg($this->srcImage);

		$im1 = imagecreatetruecolor($anz_tn_x,$anz_tn_y);
		imagecopyresampled($im1,$im0,0,0,0,0,$anz_tn_x,$anz_tn_y,$src_dim[0],$src_dim[1]);
		$im_mosaic = imagecreatetruecolor($mosaic_dim_x,$mosaic_dim_y);

		$percent = 0;
		$percent_tmp = 0;

		for ($x=0; $x<$anz_tn_x; $x++) {

			for($y=0; $y<$anz_tn_y; $y++) {

				$color = imagecolorsforindex($im1,imagecolorat($im1,$x,$y));
				$im_tmp = imagecreatefromstring($this->_findClosestThumbnailWithoutOptimiser($color['red'], $color['green'], $color['blue'], $x, $y));
				$pos_x = $x * $this->tnWidth;
				$pos_y = $y * $this->tnHeight;

				imagecopy($im_mosaic, $im_tmp, $pos_x, $pos_y, 0, 0, $this->tnWidth, $this->tnHeight);
				imagedestroy($im_tmp);

				// Wenn eine Callback Funktion registriert wurde, wird diese hier aufgerufen
				// Und als Parameter wird die aktuelle Prozentzahl übergeben

				if (!is_null($this->callbackFunction)) {
					$percent = round((100 / ($anz_tn_x*$anz_tn_y)) * ($x*$anz_tn_y+$y));
					if ($percent > $percent_tmp) {
						call_user_func ( $this->callbackFunction, $percent );
					}
					$percent_tmp = $percent;

				///

				}
			}

		}

		imagejpeg($im_mosaic, $target, $this->quality);
		imagedestroy($im0);
		imagedestroy($im1);
		imagedestroy($im_mosaic);
	}


	/**
	 * this function finds the closest possible thumbnail in database and returns the image-data (binary)
	 * use only without optimiser
	 * red, green and blue: 0-255
	 *
	 * @param int $red
	 * @param int $green
	 * @param int $blue
	 * @param int $x
	 * @param int $y
	 * @return string
	 */
	private function _findClosestThumbnailWithoutOptimiser($red, $green, $blue, $x, $y) {

		$id = 0;
		$diff = 195075; // maximum (255*255+255*255+255*255)

		foreach($this->tnArray as $key => $tn) {

			$diff_tn = ( (($red-$tn['red'])*($red-$tn['red'])) + (($green-$tn['green'])*($green-$tn['green'])) + (($blue-$tn['blue'])*($blue-$tn['blue'])) );

			if ($diff_tn < $diff) {

				if (($tn['x'] < 0) || ($x > $tn['x']+$this->distance) || ($y > $tn['y']+$this->distance)) {

					$id = $tn['id'];
					$diff = $diff_tn;
					$used_key = $key;
				}
			}
		}

		$this->tnArray[$used_key]['x'] = $x;
		$this->tnArray[$used_key]['y'] = $y;
		$res = $this->getSqlResult("SELECT image FROM $this->sqlTableName WHERE id='$id'");
		return $res[0]['image'];
	}


	/**
	 * creates mosaic-image with optimiser
	 *
	 * @param string $target
	 * @param array $src_dim
	 */
	public function _createMosaicImageWithOptimiser($target, $src_dim, $anz_tn_x, $anz_tn_y, $mosaic_dim_x, $mosaic_dim_y) {

		if (count($this->tnArray) > 0) {

			foreach($this->tnArray as $key => $value) {

				$this->tnArray[$key]['positions'] = array();
			}
		}

		$extension = $this->getFileExtention($this->srcImage);

		if ($extension == "gif")
			$im0 = imagecreatefromgif($this->srcImage);
		elseif ($extension == "png")
			$im0 = imagecreatefrompng($this->srcImage);
		elseif ($extension == "bmp")
			$im0 = imagecreatefromwbmp($this->srcImage);
		else
			$im0 = imagecreatefromjpeg($this->srcImage);

		$im1 = imagecreatetruecolor($anz_tn_x,$anz_tn_y);
		imagecopyresampled($im1,$im0,0,0,0,0,$anz_tn_x,$anz_tn_y,$src_dim[0],$src_dim[1]);
		$im_mosaic = imagecreatetruecolor($mosaic_dim_x,$mosaic_dim_y);

		for ($x=0; $x<$anz_tn_x; $x++) {

			for($y=0; $y<$anz_tn_y; $y++) {

				$mosaic[$x][$y] = imagecolorsforindex($im1,imagecolorat($im1,$x,$y));
				$replaced[$x][$y] = false;

				$pos_x = $x * $this->tnWidth;
				$pos_y = $y * $this->tnHeight;
			}
		}

		$i = 0;

		for ($x=1; $x<$anz_tn_x; $x++) {

			for($y=1; $y<$anz_tn_y; $y++) {

				$priority[$i]['x'] = $x;
				$priority[$i]['y'] = $y;
				$priority[$i]['color'] = $mosaic[$x][$y];
				$priority[$i]['direction'] = 'x';
				$priority[$i]['distance'] = ( (($mosaic[$x-1][$y]['red']-$mosaic[$x][$y]['red'])*($mosaic[$x-1][$y]['red']-$mosaic[$x][$y]['red'])) + (($mosaic[$x-1][$y]['green']-$mosaic[$x][$y]['green'])*($mosaic[$x-1][$y]['green']-$mosaic[$x][$y]['green'])) + (($mosaic[$x-1][$y]['blue']-$mosaic[$x][$y]['blue'])*($mosaic[$x-1][$y]['blue']-$mosaic[$x][$y]['blue'])) );
				$i++;

				$priority[$i]['x'] = $x;
				$priority[$i]['y'] = $y;
				$priority[$i]['color'] = $mosaic[$x][$y];
				$priority[$i]['direction'] = 'y';
				$priority[$i]['distance'] = ( (($mosaic[$x][$y-1]['red']-$mosaic[$x][$y]['red'])*($mosaic[$x][$y-1]['red']-$mosaic[$x][$y]['red'])) + (($mosaic[$x][$y-1]['green']-$mosaic[$x][$y]['green'])*($mosaic[$x][$y-1]['green']-$mosaic[$x][$y]['green'])) + (($mosaic[$x][$y-1]['blue']-$mosaic[$x][$y]['blue'])*($mosaic[$x][$y-1]['blue']-$mosaic[$x][$y]['blue'])) );
				$i++;
			}
		}

		$sortedArray = $this->sortArrayByField($priority, 'distance');

		$percent = 0;
		$percent_tmp = 0;
		$counter = 0;

		foreach ($sortedArray as $value) {

			if (!$replaced[$value['x']][$value['y']]) {

				$im_tmp = imagecreatefromstring($this->_findClosestThumbnailWithOptimiser($value['color']['red'], $value['color']['green'], $value['color']['blue'], $value['x'], $value['y']));
				$pos_x = $value['x'] * $this->tnWidth;
				$pos_y = $value['y'] * $this->tnHeight;

				imagecopy($im_mosaic, $im_tmp, $pos_x, $pos_y, 0, 0, $this->tnWidth, $this->tnHeight);
				imagedestroy($im_tmp);
				$replaced[$value['x']][$value['y']] = true;
			}

			if ($value['direction'] == 'x') {

				$prev_x = $value['x'] - 1;
				$prev_y = $value['y'];
			}
			else {

				$prev_x = $value['x'];
				$prev_y = $value['y'] - 1;
			}

			if (!$replaced[$prev_x][$prev_y]) {

				$im_tmp = imagecreatefromstring($this->_findClosestThumbnailWithOptimiser($mosaic[$prev_x][$prev_y]['red'], $mosaic[$prev_x][$prev_y]['green'], $mosaic[$prev_x][$prev_y]['blue'], $prev_x, $prev_y));
				$pos_x = $prev_x * $this->tnWidth;
				$pos_y = $prev_y * $this->tnHeight;

				imagecopy($im_mosaic, $im_tmp, $pos_x, $pos_y, 0, 0, $this->tnWidth, $this->tnHeight);
				imagedestroy($im_tmp);
				$replaced[$prev_x][$prev_y] = true;
			}

			// Wenn eine Callback Funktion registriert wurde, wird diese hier aufgerufen
			// Und als Parameter wird die aktuelle Prozentzahl übergeben

			$counter++;
			if (!is_null($this->callbackFunction)) {
				$percent = round((100 / count($sortedArray)) * $counter);
				if ($percent > $percent_tmp) {
					call_user_func ( $this->callbackFunction, $percent );
				}
				$percent_tmp = $percent;
			}
			///

		}

		$im_tmp = imagecreatefromstring($this->_findClosestThumbnailWithOptimiser($mosaic[0][0]['red'], $mosaic[0][0]['green'], $mosaic[0][0]['blue'], 0, 0));
		imagecopy($im_mosaic, $im_tmp, 0, 0, 0, 0, $this->tnWidth, $this->tnHeight);
		imagedestroy($im_tmp);

		imagejpeg($im_mosaic, $target, $this->quality);
		imagedestroy($im0);
		imagedestroy($im1);
		imagedestroy($im_mosaic);
	}


	/**
	 * this function finds the closest possible thumbnail in database and returns the image-data (binary)
	 * use only with optimiser
	 * red, green and blue: 0-255
	 *
	 * @param int $red
	 * @param int $green
	 * @param int $blue
	 * @param int $x
	 * @param int $y
	 * @return string
	 */
	private function _findClosestThumbnailWithOptimiser($red, $green, $blue, $x, $y) {

		$id = 0;
		$diff = 195075; // maximum (255*255+255*255+255*255)

		foreach($this->tnArray as $key => $tn) {

			$diff_tn = ( (($red-$tn['red'])*($red-$tn['red'])) + (($green-$tn['green'])*($green-$tn['green'])) + (($blue-$tn['blue'])*($blue-$tn['blue'])) );
			$outOfDistance = true;

			if ($diff_tn < $diff) {

				if (count($tn['positions']) > 0) {

					foreach($tn['positions'] as $pos) {

						if ((abs($pos['x']-$x) <= $this->distance) && (abs($pos['y']-$y) <= $this->distance))
							$outOfDistance = false;
					}
				}

				if ($outOfDistance) {

					$id = $tn['id'];
					$diff = $diff_tn;
					$used_key = $key;
				}
			}
		}

		$this->tnArray[$used_key]['positions'][] = array("x"=>$x, "y"=>$y);
		$res = $this->getSqlResult("SELECT image FROM $this->sqlTableName WHERE id='$id'");
		return $res[0]['image'];
	}

	/**
	 * sorts an array by field name
	 *
	 * @param array $original
	 * @param string $field
	 * @return array
	 */
	private function sortArrayByField($original, $field) {

		$sortArray = array();
		$resultArray = array();

		if (count($original) > 0) {

			foreach($original as $key => $value) {

				$sortArray[$key] = $value[$field];
			}
		}

		arsort($sortArray);

		if (count($sortArray) > 0) {

			foreach($sortArray as $key => $value) {

				$resultArray[$key] = $original[$key];
			}
		}

		return $resultArray;
	}

}

class phpMosaicHelper {

	public static function createFolderIfNotExists ( $dir ) {
		if (!file_exists($dir)) {
			mkdir($dir, 0777);
		}
	}
}

?>