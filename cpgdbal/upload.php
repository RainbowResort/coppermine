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
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/trunk/cpg1.5.x/upload.php $
  $Revision: 5129 $
  $LastChangedBy: gaugau $
  $Date: 2008-10-18 16:03:12 +0530 (Sat, 18 Oct 2008) $
**********************************************/

// Confirm we are in Coppermine and set the language blocks.
define('IN_COPPERMINE', true);
define('UPLOAD_PHP', true);
define('DB_INPUT_PHP', true);
define('ADMIN_PHP', true);

// Call basic functions, etc.
require('include/init.inc.php');
require('include/picmgmt.inc.php');
js_include('js/upload.js');

// Some placeholders.
$customize = CUSTOMIZE_UPLOAD_FORM;
$user_form = USER_UPLOAD_FORM;
$allowed_URI_boxes = NUM_URI_BOXES;
$allowed_file_boxes = NUM_FILE_BOXES;

// Check to see if user can upload pictures.  Quit with an error if he cannot.
if (!USER_CAN_UPLOAD_PICTURES && !USER_CAN_CREATE_ALBUMS) {
    cpg_die(ERROR, $lang_errors['perm_denied'], __FILE__, __LINE__);
}

// Globalize $CONFIG.
global $CONFIG, $lang_upload_php, $user_form, $max_file_size;

//___________________________________Function Block_______________________________________


// The form label creation function. Takes a non-array element form $data as its argument.
function form_label($text) 
{
    echo <<<EOT
        <tr>
                <td class="tableh2" colspan="2">
                        <strong>$text</strong>
                </td>
        </tr>

EOT;
}

// The form statement creation function. Takes a non-array element form $data as its argument.
function form_statement($text) 
{
    echo <<<EOT
        <tr>
                <td class="tableb" colspan="2">
                        $text
                </td>
        </tr>

EOT;
}

// The hidden form input function. Takes the hidden input field name and value.
function hidden_input($name, $value) 
{
        echo <<<EOT
        <tr>
            <td colspan="2">
                   <input type="hidden" name="$name" value="$value" />
            </td>
        </tr>

EOT;
}

// The text box form input function. Takes the text label for the box, the input name, the maximum length for text boxes,
// and the number of iterations.
function text_box_input($text, $name, $max_length, $iterations, $default='') 
{

    global $CONFIG;

    $ordinal = '';

    if (($text == '') and ($iterations == '')) {
        echo "        <input type=\"hidden\" name=\"$name\" value=\"$default\" />\n";
        return;
    }

    // Begin loop
    for ($counter=0; $counter<$iterations; $counter++) {

    // Create a numbering system when necessary.
    if ($text == '') {
        $cardinal = $counter + 1;
        $ordinal = "".$cardinal.". ";
    }

    // Create a text box.
    echo <<<EOT
        <tr>
            <td width="40%" class="tableb">
                        $text  $ordinal
        </td>
        <td width="60%" class="tableb" valign="top">
                <input type="text" style="width: 100%" name="$name" maxlength="$max_length" value="$default" class="textinput" id="$name" />
                </td>
        </tr>

EOT;
    }
}

// The file input function. Takes the label, field name, and number of iterations as arguments.
function file_input($text, $name, $iterations) 
{

    $ordinal = '';

    // Begin loop
    for ($counter=0; $counter<$iterations; $counter++) {

    // Create a numbering system when necessary.
    if ($text == '') {
        $cardinal = $counter + 1;
        $ordinal = "".$cardinal.". ";
    }

    // Create the file input box.
    echo <<<EOT
        <tr>
            <td class="tableb">
                        $text  $ordinal
        </td>
        <td class="tableb" valign="top">
                        <input type="file" name="$name" size="40" class="listbox" />
                </td>
        </tr>

EOT;
    }
}

// The function for text areas on forms. Takes the label, field name, and maximum length as arguments.
function text_area_input($text, $name, $max_length,$default='') 
{

    // Create the text area.
    echo <<<EOT
        <tr>
                <td class="tableb" valign="top">
                        $text
                </td>
                <td class="tableb" valign="top">
                        <textarea name="$name" rows="5" cols="40" class="textinput" style="width: 100%;" onKeyDown="textCounter(this, $max_length);" onKeyUp="textCounter(this, $max_length);">$default</textarea>
                </td>
        </tr>
EOT;
}

// The function to create the album list drop down.
function form_alb_list_box($text, $name) 
{
    $superCage = Inspekt::makeSuperCage();
    // Pull the $CONFIG array and the GET array into the function
    global $CONFIG, $lang_upload_php, $lang_common;

	// Also pull the album lists into the function
	global $user_albums_list, $public_albums_list;
	#####################      DB      ######################	
	global $cpg_db_upload_php;
	$cpgdb =& cpgDB::getInstance();
	$cpgdb->connect_to_existing($CONFIG['LINK_ID']);
	##################################################	

    // Check to see if an album has been preselected by URL addition or the last selected album. If so, make $sel_album the album number. Otherwise, make $sel_album 0.
    if ($superCage->get->keyExists('album')) {
      $sel_album = $superCage->get->getInt('album');
    } elseif ($superCage->post->keyExists('album')) {
      $sel_album = $superCage->post->getInt('album');
    } else {
      $sel_album = 0;
    }

    // Create the opening of the drop down box
    echo <<<EOT
    <tr>
        <td class="tableb">
            $text
        </td>
        <td class="tableb" valign="top">
            <select name="$name" class="listbox">

EOT;

    // Get the ancestry of the categories
	/*$vQuery = "SELECT cid, parent, name FROM " . $CONFIG['TABLE_CATEGORIES'] . " WHERE 1";
	$vResult = cpg_db_query($vQuery);
	$vRes = cpg_db_fetch_rowset($vResult);
	mysql_free_result($vResult);	*/
	####################          DB         #####################
	$vResult = $cpgdb->query($cpg_db_upload_php['get_cat_ancestry']);
	$vRes = $cpgdb->fetchRowSet();
	$cpgdb->free();
	###################################################
    foreach ($vRes as $vResI => $vResV) {
        $vResRow = $vRes[$vResI];
        $catParent[$vResRow['cid']] = $vResRow['parent'];
        $catName[$vResRow['cid']] = $vResRow['name'];
    }
    $catAnces = array();
    foreach ($catParent as $cid => $cid_parent) {
        $catAnces[$cid] = '';
        while ($cid_parent != 0) {
            $catAnces[$cid] = $catName[$cid_parent] . ($catAnces[$cid]?' - '.$catAnces[$cid]:'');
            $cid_parent = $catParent[$cid_parent];
        }
    }

    // Reset counter
    $list_count = 0;

    // Cycle through the User albums
    foreach($user_albums_list as $album) {

        // Add to multi-dim array for later sorting
        $listArray[$list_count]['cat'] = $lang_common['personal_albums'];
        $listArray[$list_count]['aid'] = $album['aid'];
        $listArray[$list_count]['title'] = $album['title'];
        $listArray[$list_count]['cid'] = -1;
        $list_count++;
    }

    // Cycle through the public albums
    foreach($public_albums_list as $album) {

        // Set $album_id to the actual album ID
        $album_id = $album['aid'];

        // Add to multi-dim array for sorting later
        if (array_key_exists('name', $album) && $album['name']) {
            $listArray[$list_count]['cat'] = $catAnces[$album['cid']] . ($catAnces[$album['cid']]?' - ':'') . $album['name'];
            $listArray[$list_count]['cid'] = $album['cid'];
        } else {
            $listArray[$list_count]['cat'] = $lang_common['albums_no_category'];
            $listArray[$list_count]['cid'] = 0;
        }
        $listArray[$list_count]['aid'] = $album['aid'];
        $listArray[$list_count]['title'] = $album['title'];
        $list_count++;
    }

    // Sort the pulldown options by category and album name
    $listArray = array_csort($listArray,'cat','title');     // alphabetically by category name
    // $listArray = array_csort($listArray,'cid','title');  // numerically by category ID
    // print_r($listArray); exit;

    // Finally, print out the nicely sorted and formatted drop down list
    // $alb_cat = '';
    $alb_cid = '';
    echo '                <option value="">' . $lang_common['select_album'] . "</option>\n";
    foreach ($listArray as $val) {
        //if ($val['cat'] != $alb_cat) {  // old method compared names which might not be unique
        if ($val['cid'] !== $alb_cid) {
            if ($alb_cid) {
                echo "                </optgroup>\n";
            }
            echo '                <optgroup label="' . $val['cat'] . '">' . "\n";
            $alb_cid = $val['cid'];
        }
        echo '                <option value="' . $val['aid'] . '"' . ($val['aid'] == $sel_album ? ' selected' : '') . '>   ' . $val['title'] . "</option>\n";
    }
    if ($alb_cid) {
        echo "                </optgroup>\n";
    }

    // Close the drop down
    echo <<<EOT
            </select>
        </td>
    </tr>

EOT;
}

// The create form function. Takes the $data array as its object.
//
// Type:
// 0 => text box input
// 1 => file input
// 2 => album list
// 3 => text area input
// 4 => hidden input
function create_form(&$data) 
{

    global $CONFIG, $lang_upload_php;

    // Cycle through the elements in the data array.
    foreach($data as $element) {

        // If the element is another array, parse the definition contained within the array.
        if ((is_array($element))) {
            $element[2] = (isset($element[2])) ? $element[2] : '';
            $element[3] = (isset($element[3])) ? $element[3] : '';
            $element[4] = (isset($element[4])) ? $element[4] : '';

            // Based on the type declared in the data array's third position, create a different form input.
            switch ($element[2]) {

                // If the type is a text box input
                case 0 :

                    //Call the form input function.
                    text_box_input($element[0], $element[1], $element[3], $element[4], (isset($element[5])) ? $element[5] : '');
                    break;

                // If the type is a file input.
                case 1 :

                    // Call the file input function.
                    file_input($element[0], $element[1], $element[3]);
                    break;

                // If the type is an album list dropdown.
                case 2 :

                    // Call the album list function.
                    form_alb_list_box($element[0], $element[1]);
                    break;

                // If the type is a text area
                case 3 :

                    // Call the text area function.
                    text_area_input($element[0], $element[1], $element[3], (isset($element[4])) ? $element[4] : '');
                    break;

                // If the type is a hidden form
                case 4 :

                    // Call the hidden input funtion.
                    hidden_input($element[0], $element[1]);
                    break;

                // If the type is not present, kill the script.
                default:
                    cpg_die(ERROR, $lang_upload_php['reg_instr_1'], __FILE__, __LINE__);
            } // switch
        } else {

            // If the element is not an array, it is a label, so call the label function.
            form_label($element);
        }
    }
}

// The open_form function creates the Javascript verification code and the opening form tags.
// $path hold the form action path.
function open_form($path) 
{
    echo <<<EOT
    <script language="javascript" type="text/javascript">
    function textCounter(field, maxlimit) {
            if (field.value.length > maxlimit) // if too long...trim it!
            field.value = field.value.substring(0, maxlimit);
    }
    </script>
    <form name="cpgform" id="cpgform" method="post" action="$path" enctype="multipart/form-data" onsubmit="cpgUploadToggleProgressBar();">
EOT;
}

// The close form function creates the submit button and the closing tags.
function close_form($button_value,$progress=0) 
{
    // Pull the language array into the function.
    global $lang_upload_php, $THEME_DIR;

    // Create the submit button and close the form.
    print <<<EOT
        <tr>
                <td colspan="2" align="center" class="tablef">
                	<span id="cpg_progress_bar" style="display:none">
EOT;
	if ($progress == 1) {
        if (defined('THEME_HAS_PROGRESS_GRAPHICS')) {
            $prefix = $THEME_DIR;
        } else {
            $prefix = '';
        }
		print '                        	<img src="' . $prefix . 'images/loader.gif" border="0" alt="" title="' . $lang_upload_php['please_wait'] . '" />';
	}
	print '                        </span>';
	print '                        <span id="cpg_upload_button" style="display:block">'; 
	print '                            <input type="submit" value="'.$button_value.'" class="button" />';
	print '                        </span>';
	print <<<EOT
                </td>

        </tr>

EOT;
}

function form_instructions() 
{
    global $CONFIG, $lang_upload_php, $user_form, $max_file_size;

    echo "<tr><td colspan=\"2\">";

    printf ($lang_upload_php['reg_instr_2'], $CONFIG['max_upl_size']);
    
    //show allowed filetypes
    echo "<br />{$lang_upload_php['allowed_types']}";
    printf ($lang_upload_php['allowed_img_types'], $CONFIG['allowed_img_types']);
    print "<br />\r\n";
    printf ($lang_upload_php['allowed_mov_types'], $CONFIG['allowed_mov_types']);
    print "<br />\r\n";
    printf ($lang_upload_php['allowed_snd_types'], $CONFIG['allowed_snd_types']);
    print "<br />\r\n";
    printf ($lang_upload_php['allowed_doc_types'], $CONFIG['allowed_doc_types']);

    if ($user_form > '3') {

        echo "<br />{$lang_upload_php['reg_instr_3']}";

    }

    if (($user_form == '2') or ($user_form == '3') or ($user_form == '5') or ($user_form == '6')) {

        echo "<br /><br />{$lang_upload_php['reg_instr_4']}";

    }

    echo "<br /><br />{$lang_upload_php['reg_instr_5']}";

    echo "</td></tr>";

}


// The get_and_convert_to_bytes function retrieves a limitng value from php.ini and converts the shorthand to bytes.
function get_and_convert_to_bytes ($ini_variable_name) 
{
    // Get the variable from php.ini
    $ini_string = ini_get($ini_variable_name);

    // Declare an array to store regex matches in.
    $parsed_ini_size = array();

    // Make sure the returned value is a string, then split the number and the unit in two.
    if ((is_string($ini_string)) and (eregi('^([[:digit:]])+([[:alpha:]])*$', $ini_string, $parsed_ini_size))) {

        // Store the numerical component in $ini_limit cast as an integer
        $ini_limit = (int) $parsed_ini_size[1];

        // Convert the unit to lower case for analysis and store in $ini_limit_unit.
        $ini_limit_unit = strtolower($parsed_ini_size[2]);


        // Check the unit to see if any conversion is necessary.
        if ($ini_limit_unit == 'm') {

             // The units indicate megabytes. Shift to bytes.
             $ini_limit = $ini_limit << 20;

        } elseif ($ini_limit_unit == 'k') {

             // The units indicate kilobytes. Shift to bytes.
             $ini_limit = $ini_limit << 10;
        }

        // Return the modified value from php.ini
        return $ini_limit;

    } else {

        // The returned value is not a string or no pattern match was found. Return false.
        return false;
    }
}

// Moved to 'logger.inc.php' - omni
// The function spring_cleaning is a garbage collection routine used to purge a directory of old files.
if (!function_exists('spring_cleaning')) {
function spring_cleaning($directory_path, $cache_time = 86400, $exclusion_list = array('index.html')) 
{
    //Storage the deleted files
    $deleted_list = array();

    //First we get the transitory directory handle.
    $directory_handle = opendir($directory_path);

    // Exit if the directory cannot be opened.
    if(!$directory_handle) {

        // Return.
        return;

    }

    // Now let's read through the directory contents.
    while (!(($file = readdir($directory_handle)) === false)) {

            // Avoid deleting the index page of the directory.
            if (in_array($file,$exclusion_list)) {

                // This is the index file, so we move on.
                continue;

            }

            $dir_path = $directory_path."/".$file;

            if (is_dir($dir_path)) {

                // This is a directory, so we move on.
                continue;

            }

            // We find out when the file was last accessed.
            $access_time = filemtime($dir_path); // fileatime() returned incorrect value on Windows

            // We find out the current time.
            $current_time = time();

            // We calculate the the delete time. We will delete anything older than $cache_time.
            $delete_time = $current_time - $access_time;

            // Now we compare the two.
            if ($delete_time >= $cache_time) {

                    // The file is old. We delete it.
                    $deleted_list[] = $dir_path; // Store the name of the file getting deleted
                    unlink($dir_path);
            }

    }

    // Don't forget to close the directory.
    closedir($directory_handle);
    return $deleted_list;
} // function spring_cleaning
} // if !function_exists(spring_cleaning)

// The create_record function. Takes the encoded string. Returns the unique record ID.
function create_record($encoded_string) 
{
	// Globalize $CONFIG
	global $CONFIG;
	#####################      DB      ######################	
	global $cpg_db_upload_php;
	$cpgdb =& cpgDB::getInstance();
	$cpgdb->connect_to_existing($CONFIG['LINK_ID']);
	##################################################	

    // Declare and initialize variables.
    $unique_ID_array = array();
    $generic_array = array();

	/*// Get all IDs from the table.
	$result = cpg_db_query("SELECT unique_ID FROM {$CONFIG['TABLE_TEMPDATA']}");

	// Create unique ID array.
	if (mysql_num_rows($result)) {

		// Move all values into $unique_ID_array.
		while ($generic_array = mysql_fetch_array($result)) {

			// Store the values.
			$unique_ID_array[] = $generic_array['unique_ID'];

		}

	} else {

		// The table may be empty. Give it a value.
		$unique_ID_array[] = 0;

	}

	// Free resources.
	mysql_free_result($result);	*/
	######################          DB         ######################
	// Get all IDs from the table.
	$cpgdb->query($cpg_db_upload_php['get_all_tempdata_id']);
	$rowset = $cpgdb->fetchRowSet();
	// Create unique ID array.
	if (count($rowset)) {
		// Move all values into $unique_ID_array.
		foreach ($rowset as $generic_array) {
			// Store the values.
			$unique_ID_array[] = $generic_array['unique_ID'];
		}
	} else {
		// The table may be empty. Give it a value.
		$unique_ID_array[] = 0;
	}
	// Free resources.
	$cpgdb->free();
	######################################################

	// Generate the unique ID. Keep generating new IDs until one that is not in use is found.
	do {

		// Create a random string by taking the first 8 characters of an MD5 hash of a concatenation of the current UNIX epoch time and the current server process ID.
		$unique_ID = substr(md5(uniqid("")), 0, 8);

	} while (in_array($unique_ID, $unique_ID_array));

	// Create a timestamp to track the record.
	$timestamp = time();

	// Insert the new record.
	//$result = cpg_db_query("INSERT INTO {$CONFIG['TABLE_TEMPDATA']} VALUES ('$unique_ID', '$encoded_string', '$timestamp')");
	#######################################           DB          ####################################
	 $result = $cpgdb->query($cpg_db_upload_php['add_tempdata'], $unique_ID, $encoded_string, $timestamp);
	#####################################################################################

	// Return the unique ID if insertion was successful. Otherwise, return false.
	if ($result) {

		return $unique_ID;

	} else {

		return FALSE;

	}

}

// The update_record function. Takes the $unique_ID and $encoded_string.
function update_record($unique_ID, $encoded_string) 
{
	// Globalize $CONFIG
	global $CONFIG;
	#####################      DB      ######################	
	global $cpg_db_upload_php;
	$cpgdb =& cpgDB::getInstance();
	$cpgdb->connect_to_existing($CONFIG['LINK_ID']);
	##################################################	

	// Update record.
	//$result = cpg_db_query("UPDATE {$CONFIG['TABLE_TEMPDATA']} SET encoded_string = '$encoded_string' WHERE unique_ID = '$unique_ID'");
	#####################################          DB         ###################################
	$result = $cpgdb->query($cpg_db_upload_php['update_record_tempdata'], $encoded_string, $unique_ID);
	##################################################################################

	// Return true if successful.
	if ($result) {

		return TRUE;

	} else {

		return FALSE;

	}

}

// The delete_record function. Takes the $unique_ID.
function delete_record($unique_ID) 
{
	// Globalize $CONFIG
	global $CONFIG;
	#####################      DB      ######################	
	global $cpg_db_upload_php;
	$cpgdb =& cpgDB::getInstance();
	$cpgdb->connect_to_existing($CONFIG['LINK_ID']);
	##################################################	

	// Delete record.
	//$result = cpg_db_query("DELETE FROM {$CONFIG['TABLE_TEMPDATA']} WHERE unique_ID = '$unique_ID'");
	#################################       DB     #################################
	$result = $cpgdb->query($cpg_db_upload_php['delete_record_tempdata'], $unique_ID);
	########################################################################

	// Return true if successful.
	if ($result) {

		return TRUE;

	} else {

		return FALSE;

	}

}

// The retrieve_record function. Takes the $unique_ID.
/*function retrieve_record($unique_ID) 
{

	// Globalize $CONFIG
	global $CONFIG;

	// Retrieve record.
	$result = cpg_db_query("SELECT encoded_string FROM {$CONFIG['TABLE_TEMPDATA']} WHERE unique_ID = '$unique_ID'");

	// Return string if successful.
	if (mysql_num_rows($result)) {

		// Move value into $encoded_string.
		while ($generic_array = mysql_fetch_array($result)) {

			// Store the value.
			$encoded_string = $generic_array['encoded_string'];

		}

		// Free resources.
		mysql_free_result($result);

		return $encoded_string;

	} else {

		// Free resources.
		mysql_free_result($result);

		return FALSE;

	}

}	*/
#######################         DB          #####################
function retrieve_record($unique_ID) 
{
	// Globalize $CONFIG
	global $CONFIG;
	global $cpg_db_upload_php;
	$cpgdb =& cpgDB::getInstance();
	$cpgdb->connect_to_existing($CONFIG['LINK_ID']);

	// Retrieve record.
	$cpgdb->query($cpg_db_upload_php['retrieve_record_tempdata'], $unique_ID);
	$rowset =$cpgdb->fetchRowSet();

	// Return string if successful.
	if (count($rowset)) {
		// Move value into $encoded_string.
		foreach ($rowset as $generic_array) {
			// Store the value.
			$encoded_string = $generic_array['encoded_string'];
		}
		// Free resources.
		$cpgdb->free();
		return $encoded_string;
	} else {
		// Free resources.
		$cpgdb->free();
		return FALSE;
	}

}
######################################################

// The clean_table function.
function clean_table() 
{
	// Globalize $CONFIG
	global $CONFIG;
	#####################      DB      ######################	
	global $cpg_db_upload_php;
	$cpgdb =& cpgDB::getInstance();
	$cpgdb->connect_to_existing($CONFIG['LINK_ID']);
	##################################################	

	// Create a timestamp from an hour ago.
	$comparative_timestamp = time() - 3600;

	// Delete record.
	//$result = cpg_db_query("DELETE FROM {$CONFIG['TABLE_TEMPDATA']} WHERE timestamp < $comparative_timestamp");
	#########################         DB        #########################
	$result = $cpgdb->query($cpg_db_upload_php['clean_table_tempdata'], $comparative_timestamp);
	###########################################################

	// Return true if successful.
	if ($result) {

		return TRUE;

	} else {

		return FALSE;

	}

}

//The function check_status determines the status of a URI resource.
//It takes the URI as its argument and serves to give more specific error
//messages about unavailable resources.
function check_status($URI) 
{

    // Parse the URI into it's requisite parts.
    $parts = @parse_url($URI);

    // If there is no detectable host, return FALSE.
    if (empty($parts["host"])) {

        return FALSE;

    } else {

        $host = $parts["host"];

    }

    // If a path is detected, make it $path. Otherwise, assume it is a directory.
    if (!empty($parts["path"])) {

        $path = $parts["path"];

    } else {

        $path = "/";

    }

    // Append any queries that might be attached.
    if (!empty($parts["query"])) {

        $path .= "?" . $parts["query"];

    }

    // Set the port if supplied. Default to port 80.
    if (!empty($parts["port"])) {

        $port = $parts["port"];

    } else {

        $port = "80";

    }

    // Attempt to open a socket to the host.
    $socket = @fsockopen( $host, $port, $errno, $errstr, 30 );

    // Verify that the socket opened.  Return false if it fails.
    if (!$socket) {

        return FALSE;

    } else {

        // Craft HTTP request.
        $request = "HEAD $path HTTP/1.0\r\nUser-Agent: PHP/".phpversion()."\r\nHost: $host\r\nAccept: */*\r\n\r\n";

        // Get request length.
        $length = strlen($request);

        // Send request data to host. Return false if there is an error.
        if(!(fwrite($socket, $request, $length))) {

            return FALSE;

        }

        // Collect the host's response.
        $response = fgets($socket, 22);

        // Close the socket.
        fclose($socket);

        // Return the response.
        return $response;
    }
}

//################################# MAIN CODE BLOCK ##################################################

// Check whether we are getting album id through _GET or _POST
if ($superCage->get->keyExists('album')) {
    $sel_album = $superCage->get->getInt('album');
} elseif ($superCage->post->keyExists('album')) {
    $sel_album = $superCage->post->getInt('album');
} else {
    $sel_album = 0;
}

// Check to see if user customizations are allowed and if one the request has been made yet.

if ((CUSTOMIZE_UPLOAD_FORM) and (!$superCage->post->keyExists('file_upload_request')) and (!$superCage->post->keyExists('URI_upload_request')) and (!$superCage->post->keyExists('control'))) {

    // Check to see if the form type is configurable.  If it is, produce the configuration form. Otherwise, generate a warning.

    if(!(USER_UPLOAD_FORM == 0) and !(USER_UPLOAD_FORM == 7)) {

        // Create the box request page.
        pageheader($lang_upload_php['custom_title']);
        open_form($CPG_PHP_SELF);
        starttable("100%", $lang_upload_php['custom_title'], 2);
        echo "<tr><td colspan=\"2\">";
        echo "{$lang_upload_php['cust_instr_1']}<br /><br />";

        $data = array();
        $data[] = $lang_upload_php['cust_instr_2'];

        // If the file upload type is only file uploads or is a dual mode, ask for the requisite number of file upload boxes.
        if ((USER_UPLOAD_FORM == '1') or (USER_UPLOAD_FORM == '3') or (USER_UPLOAD_FORM == '4') or (USER_UPLOAD_FORM == '6')) {

            // Add the file upload array element to the form array.
            $data[] = array($lang_upload_php['cust_instr_6'],'file_upload_request', '0', '4', '1');

            // Print number of allowed file upload boxes.
            printf ($lang_upload_php['cust_instr_3'], $allowed_file_boxes);

            echo "<br /><br />";

        }

        // If the file upload type is only URI uploads or is a dual mode, ask for the requisite number of URI upload boxes.
        if ((USER_UPLOAD_FORM == '2') or (USER_UPLOAD_FORM == '3') or (USER_UPLOAD_FORM == '5') or (USER_UPLOAD_FORM == '6')) {

            // Add the URI upload array element to the form array.
            $data[] = array($lang_upload_php['cust_instr_5'], 'URI_upload_request', '0', '4', '1');

            // Print number of allowed URI upload boxes.
            printf ($lang_upload_php['cust_instr_4'], $allowed_URI_boxes);

            echo "<br /><br />";

        }

        if ($sel_album) {
            //album id is available, put it in hidden field
            $data[] = array('album', $sel_album, 4);
        }

        echo "{$lang_upload_php['cust_instr_7']}<br /><br />";
        echo "</td></tr>";
        create_form($data);
        close_form($lang_common['continue'], 'continue0');
        endtable();
        echo "</form>";
        pagefooter();

        // Exit the script.
        exit;

    } else {

        //Use the default settings for the number of boxes.

        $num_URI_boxes = NUM_URI_BOXES;
        $num_file_boxes = NUM_FILE_BOXES;

    }

} elseif (CUSTOMIZE_UPLOAD_FORM) {

// If the user is allowed to customize the form, check the incoming data for the number of requested boxes.

    //Check for the number of file upload boxes.

    if ($superCage->post->keyExists('file_upload_request')) {

        // Do some validation.
        $filtered_request = max(0, $superCage->post->getInt('file_upload_request'));

        if ($filtered_request > NUM_FILE_BOXES) {
            $num_file_boxes = NUM_FILE_BOXES;
        } else {
            $num_file_boxes = $filtered_request;
        }

    }

    //Check for the number of requested URI upload boxes.

    if ($superCage->post->keyExists('URI_upload_request')) {

        // Do some validation.
        $filtered_request = max(0, $superCage->post->getInt('URI_upload_request'));

        if ($filtered_request > NUM_URI_BOXES) {
            $num_URI_boxes = NUM_URI_BOXES;
        } else {
            $num_URI_boxes = $filtered_request;
        }

    }

} else {

    //Use the default settings for the number of boxes.

    $num_URI_boxes = NUM_URI_BOXES;
    $num_file_boxes = NUM_FILE_BOXES;

}
if (empty($num_URI_boxes) && empty($num_file_boxes)) {
    $num_URI_boxes = 0;
    $num_file_boxes = 1;
}

// Get public and private albums, and set maximum individual file size.

/*if (GALLERY_ADMIN_MODE) {
	$public_albums = cpg_db_query("SELECT aid, title, cid, name FROM {$CONFIG['TABLE_ALBUMS']} INNER JOIN {$CONFIG['TABLE_CATEGORIES']} ON cid = category WHERE category < " . FIRST_USER_CAT);
	//select albums that don't belong to a category
	$public_albums_no_cat = cpg_db_query("SELECT aid, title FROM {$CONFIG['TABLE_ALBUMS']} WHERE category = 0");
} else {
		$public_albums = cpg_db_query("SELECT aid, title, cid, name FROM {$CONFIG['TABLE_ALBUMS']} INNER JOIN {$CONFIG['TABLE_CATEGORIES']} ON cid = category WHERE category < " . FIRST_USER_CAT . " AND ((uploads='YES' AND (visibility = '0' OR visibility IN ".USER_GROUP_SET.")) OR (owner=".USER_ID."))");
		//select albums that don't belong to a category
		$public_albums_no_cat = cpg_db_query("SELECT aid, title FROM {$CONFIG['TABLE_ALBUMS']} WHERE category = 0 AND ((uploads='YES' AND (visibility = '0' OR visibility IN ".USER_GROUP_SET.")) OR (owner=".USER_ID."))");   
}


if (mysql_num_rows($public_albums)) {
	$public_albums_list = cpg_db_fetch_rowset($public_albums);
} else {
	$public_albums_list = array();
}

//do the same for non categorized albums
if (mysql_num_rows($public_albums_no_cat)) {
	$public_albums_list_no_cat = cpg_db_fetch_rowset($public_albums_no_cat);
} else {
	$public_albums_list_no_cat = array();
}	*/
################################          DB        ##############################
if (GALLERY_ADMIN_MODE) {
	$public_albums = $cpgdb->query($cpg_db_upload_php['gal_admin_public_alb'], FIRST_USER_CAT);
	$public_albums_list = $cpgdb->fetchRowSet();
	//select albums that don't belong to a category
	$public_albums_no_cat = $cpgdb->query($cpg_db_upload_php['gal_admin_public_alb_no_cat']);
	$public_albums_list_no_cat = $cpgdb->fetchRowSet();
} else {
		$public_albums = $cpgdb->query($cpg_db_upload_php['public_alb'], FIRST_USER_CAT, USER_GROUP_SET, USER_ID);
		$public_albums_list = $cpgdb->fetchRowSet();
		//select albums that don't belong to a category
		$public_albums_no_cat = $cpgdb->query($cpg_db_upload_php['public_alb_no_cat'], USER_GROUP_SET, USER_ID);
		$public_albums_list_no_cat = $cpgdb->fetchRowSet();
}

if (!count($public_albums_list)) {
		$public_albums_list = array();
}

//do the same for non categorized albums
if (!count($public_albums_list_no_cat)) {
		$public_albums_list_no_cat = array();
}
#######################################################################

//merge the 2 album arrays
$public_albums_list = array_merge($public_albums_list, $public_albums_list_no_cat);


if (USER_ID) {
	/*$user_albums = cpg_db_query("SELECT aid, title FROM {$CONFIG['TABLE_ALBUMS']} WHERE category='" . (FIRST_USER_CAT + USER_ID) . "' ORDER BY title");
	if (mysql_num_rows($user_albums)) {
		$user_albums_list = cpg_db_fetch_rowset($user_albums);
	} else {
		$user_albums_list = array();
	}	*/
	################################          DB        ################################
	$user_albums = $cpgdb->query($cpg_db_upload_php['user_alb'], (FIRST_USER_CAT + USER_ID));
	$user_albums_list = $cpgdb->fetchRowSet();
	if (!count($user_albums_list)) {
		$user_albums_list = array();
	}
	##########################################################################
} else {
    $user_albums_list = array();
}

if (!count($public_albums_list) && !count($user_albums_list)) {  // there's no album where the user is allowed to upload to
    if (USER_CAN_CREATE_ALBUMS) {
       // cpg_die (ERROR, $lang_upload_php['err_no_alb_uploadables'].'<br />&nbsp;<br /><a href="albmgr.php" title="'.$lang_user_admin_menu['albmgr_title'].'" class="admin_menu">'.$lang_user_admin_menu['albmgr_lnk'].'</a>', __FILE__, __LINE__);
    } else {
        cpg_die (ERROR, $lang_upload_php['err_no_alb_uploadables'], __FILE__, __LINE__);
    }
}

// Assign maximum file size for browser crontrols.
$max_file_size = $CONFIG['max_upl_size'] << 10;

// Create the upload forms using the upload congfiguration.

if (!$superCage->post->keyExists('control')) {

    // Do some cleanup in the edit directory.
    spring_cleaning('./'.$CONFIG['fullpath'].'edit',CPG_HOUR);

    // Do some cleaning in the temp data table.
    clean_table();

    // Create upload form headers.
    pageheader($lang_upload_php['title']);

    // Select the form action.
    if (USER_UPLOAD_FORM == '0') {

        // The user has the single upload only form. Send the request to db_input.php.
        open_form('db_input.php');
        // Open the form table.
        starttable("100%", cpg_fetch_icon('upload',2).$lang_upload_php['title'], 2);
    } else {

        // Direct the request to this script and print the form instructions.
        open_form($CPG_PHP_SELF);
        // Open the form table.
        starttable("100%", cpg_fetch_icon('upload',2).$lang_upload_php['title'], 2);
        form_instructions();

    }



    // Use a if-then-else construct to create the upload form for the user based on the setting in the
    // groups panel.
    if(USER_UPLOAD_FORM == '0') {

        // The user should have the 'single upload only' form.

        // Declare an array containing the various upload form box definitions.
        $captionLabel = $lang_upload_php['description'];
        $keywordLabel = $lang_common['keywords_insert1']. '<br /><a href="#" onClick="return MM_openBrWindow(\'keyword_select.php\',\'selectKey\',\'width=250, height=400, scrollbars=yes,toolbar=no,status=yes,resizable=yes\')">' . $lang_common['keywords_insert2'] .'</a>';
        if ($CONFIG['show_bbcode_help']) {$captionLabel .= '&nbsp;'. cpg_display_help('f=empty.htm&amp;base=64&amp;h='.urlencode(base64_encode(serialize($lang_bbcode_help_title))).'&amp;t='.urlencode(base64_encode(serialize($lang_bbcode_help))),470,245);}
        $form_array = array(
        sprintf($lang_upload_php['max_fsize'], $CONFIG['max_upl_size']),
        array($lang_common['album'], 'album', 2),
        array('MAX_FILE_SIZE', $max_file_size, 4),
        array($lang_upload_php['picture'], 'userpicture', 1, 1),
        array($lang_upload_php['pic_title'], 'title', 0, 255, 1),
        array($captionLabel, 'caption', 3, $CONFIG['max_img_desc_length']),
        array($keywordLabel, 'keywords', 0, 255, 1),
        array('event', 'picture', 4)
        );

        if(!empty($CONFIG['user_field1_name'])) {
            $form_array[] = array($CONFIG['user_field1_name'], 'user1', 0, 255, 1);
        }

        if(!empty($CONFIG['user_field2_name'])) {
            $form_array[] = array($CONFIG['user_field2_name'], 'user2', 0, 255, 1);
        }

        if(!empty($CONFIG['user_field3_name'])) {
            $form_array[] = array($CONFIG['user_field3_name'], 'user3', 0, 255, 1);
        }

        if(!empty($CONFIG['user_field4_name'])) {
            $form_array[] = array($CONFIG['user_field4_name'], 'user4', 0, 255, 1);
        }

    } else {

        // Check for valid form number.
        if ((USER_UPLOAD_FORM >= '0') and (USER_UPLOAD_FORM <= '7')) {

            if ($sel_album) {
                //album id is available, put it in hidden field
                $form_array[] = array('album', $sel_album, 4);
            }

            // Create form array, and insert MAX_FILE_SIZE control.
            $form_array[] = array('MAX_FILE_SIZE', $max_file_size);

            // Add each upload type depending on the form number,
            if((USER_UPLOAD_FORM == '1') or (USER_UPLOAD_FORM == '3') or (USER_UPLOAD_FORM == '4') or (USER_UPLOAD_FORM == '6')) {

                if($num_file_boxes > 0) {

                    $form_array[] = $lang_upload_php['reg_instr_7'];

                    $form_array[] = array('', 'file_upload_array[]', 1, $num_file_boxes);

                }

            }

            if((USER_UPLOAD_FORM == '2') or (USER_UPLOAD_FORM == '3') or (USER_UPLOAD_FORM == '5') or (USER_UPLOAD_FORM == '6')) {

                if($num_URI_boxes > 0) {

                    $form_array[] = $lang_upload_php['reg_instr_8'];

                    $form_array[] = array('', 'URI_array[]', 0, 256, $num_URI_boxes);

                }

            }

            if((USER_UPLOAD_FORM == '4') or (USER_UPLOAD_FORM == '5') or (USER_UPLOAD_FORM == '6') or (USER_UPLOAD_FORM == '7')) {

                $form_array[] = $lang_upload_php['reg_instr_6'];
                $form_array[] = array('', 'ZIP_array[]', 1, 1);

            }

            // Add the control device.
            $form_array[] = array('control', 'phase_1', 4);

        } else {

            // Unknown form number.
            cpg_die(ERROR, $lang_upload_php['reg_instr_1'], __FILE__, __LINE__);

        }

    }

    // Create the form.
    create_form($form_array);



    // Close the form.
    if (USER_UPLOAD_FORM == '0') {

        // The user has the single upload only form. Select proper language for button.
        close_form($lang_upload_php['title'],1);

    } else {

        // Make button say 'Continue.'
        close_form($lang_common['continue'],1);

    }

    // Close the table, create footers, and flush the output buffer.
    endtable();
    echo "</form>";
    if ($CONFIG['display_xp_publish_link'] == 1) {
    	print '<br />';
    	starttable('100%', cpg_fetch_icon('info', 2) . $lang_upload_php['alternative_upload'],1);
    	print <<< EOT
    	<tr>
    		<td class="tableb">
    			{$lang_upload_php['xp_publish_promote']}<br />
    			[<a href="xp_publish.php">{$lang_upload_php['more']}</a>]
    		</td>
    	</tr>
EOT;
    	endtable();
    }    
    pagefooter();
    ob_end_flush();

    // Exit the script.

    exit;

}

// Receive incoming file uploads for phase I.
// Using getRaw() for comparison only
if ($superCage->post->keyExists('control') && $superCage->post->getEscaped('control') == 'phase_1') {
    // $_FILES['file_upload_array']['name'][$counter]
    // $_FILES['file_upload_array']['size'][$counter]
    // $_FILES['file_upload_array']['tmp_name'][$counter]
    // $_FILES['file_upload_array']['type'][$counter]
    // $_FILES['file_upload_array']['error'][$counter]
    //
    // Error values:
    // 0 - No error
    // 1 - Exceeded filesize allowed in php.ini
    // 2 - Exceeded filesize allowed by HTML MAX_FILE_SIZE
    // 3 - Only a partial upload
    // 4 - No upload occurred.

    //$file_upload_count = count($_FILES['file_upload_array']['name']);
    //$file_upload_count = count($superCage->files->getEscaped('/file_upload_array/name'));

    if (NUM_FILE_BOXES > 0) {


        // Check for error code support. Set the error code.

        if (count($superCage->files->getInt('/file_upload_array/error')) == 0) {

            // This version of PHP does not support error codes (PHP < 4.2.0).  Create our own error code.

            $error_code = 'default';

        } else {

            // We have error support.
            $error_support = 'TRUE';

        }

        //for ($counter = 0; $counter < $file_upload_count; $counter++) {
		for ($counter = 0; $counter < NUM_FILE_BOXES; $counter++) {

            // Check for error code support. Set the error code.

            if ($error_support) {

                //$error_code = $_FILES['file_upload_array']['error'][$counter];
                $error_code = $superCage->files->getInt("/file_upload_array/error/$counter");

            }

            // Create the failure ordinal for ordering the report of failed uploads.

            $failure_cardinal = $counter + 1;

            $failure_ordinal = ''.$failure_cardinal.'. ';

            // If there is no file name, make a dummy name for the error reporting system.

            //if (($_FILES['file_upload_array']['name'][$counter] == '')) {
            if ($superCage->files->getEscaped("/file_upload_array/name/$counter") == '') {
                $file_name = 'filename_unavailable';
            } else {
                //$file_name = $_FILES['file_upload_array']['name'][$counter];
                //Using getRaw() as we will sanitizing the filename later
                $file_name = $superCage->files->getEscaped("/file_upload_array/name/$counter");
            }

            // Test for a blank file upload box, hence using getRaw() is ok.
            //if (empty($_FILES['file_upload_array']['tmp_name'][$counter])) {
            $tmp_filename = $superCage->files->getRaw("/file_upload_array/tmp_name/$counter");
            if (empty($tmp_filename)) {
                // There is no need for further tests or action as there was no uploaded file, so skip the remainder of the iteration.
                continue;
            }

            // Check to make sure the file was uploaded via POST.

            //if (!is_uploaded_file($_FILES['file_upload_array']['tmp_name'][$counter])) {
            if (!is_uploaded_file($superCage->files->getPath("/file_upload_array/tmp_name/$counter"))) {

                // We reject the file, and make a note of the error.
                $file_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'file_name'=> $file_name, 'error_code'=>$lang_upload_php['no_post']);

                // There is no need for further tests or action, so skip the remainder of the iteration.
                continue;
            }

            // Check filename and extension:

            // Check that the file uploaded has a valid name and extension, and replace forbidden chars with underscores.

            // Initialise the $matches array.
            $matches = array();

            // If magic quotes is on, remove the slashes it added to the file name.
            //if (get_magic_quotes_gpc()) $_FILES['file_upload_array']['name'][$counter] = stripslashes($_FILES['file_upload_array']['name'][$counter]);
            /*if (get_magic_quotes_gpc()) {
                //Using getRaw() as we have custom sanitization code below
                $picture_name = stripslashes($superCage->files->getRaw("/file_upload_array/name/$counter"));
            } else {
                $picture_name = $superCage->files->getRaw("/file_upload_array/name/$counter");
            }*/
			$picture_name = stripslashes($superCage->files->getEscaped("/file_upload_array/name/$counter"));
            // Create the holder $picture_name by translating the file name. Translate any forbidden character into an underscore.
            //$picture_name = replace_forbidden($_FILES['file_upload_array']['name'][$counter]);
            $picture_name = replace_forbidden($picture_name);

            // Analyze the file extension using regular expressions.
            if (!preg_match("/(.+)\.(.*?)\Z/", $picture_name, $matches)) {

                // The file name is invalid.
                $matches[1] = 'invalid_fname';

                // Make a bogus file extension to trigger Coppermine's defenses.
                $matches[2] = 'xxx';
            }

            // If there is no extension, or if the extension is unknown/not permitted by Coppermine, zap the intruder.
            if ($matches[2] == '' || !is_known_filetype($matches)) {

                // We reject the file, and make a note of the error.
                $file_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'file_name'=> $file_name, 'error_code'=>$lang_upload_php['forb_ext']);

                // There is no need for further tests or action, so skip the remainder of the iteration.
                continue;

            }

            // Check for upload errors.

            if (!($error_code == '0') and !($error_code == 'default')) {

                // PHP has detected a file upload error.
                if ($error_code == '1') {
                    $error_message = $lang_upload_php['exc_php_ini'];
                } elseif ($error_code == '2') {
                    $error_message = $lang_upload_php['exc_file_size'];
                } elseif ($error_code == '3') {
                    $error_message = $lang_upload_php['partial_upload'];
                } elseif ($error_code == '4') {
                    $error_message = $lang_upload_php['no_upload'];
                } else {
                    $error_message = $lang_upload_php['unknown_code'];
                }

                //Make a note in the error array.
                $file_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'file_name'=> $file_name, 'error_code'=>$error_message);

                // There is no need for further tests or action, so skip the remainder of the iteration.
                continue;
				// again getRaw() for comparison only.
            } elseif ($superCage->files->getRaw("/file_upload_array/tmp_name/$counter") == '') {

                // There is no temporary file, so the file did not upload. Make a note of it in the file_failure_arrray and flip the failure switch to generate the ordinal. .

                $file_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'file_name'=> $file_name, 'error_code'=>$lang_upload_php['no_temp_name']);

                // There is no need for further tests or action, so skip the remainder of the iteration.
                continue;

            } elseif ($superCage->files->getInt("/file_upload_array/size/$counter") <= 0) {

                // The file contains no data or was corrupted. Make a note of it in the error array.

                $file_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'file_name'=> $file_name, 'error_code'=>$lang_upload_php['no_file_size']);

                // There is no need for further tests or action, so skip the remainder of the iteration.
                continue;

            } elseif ($superCage->files->getDigits("/file_upload_array/size/$counter") > $max_file_size) {

                // The file exceeds the amount specified by the max upload directive. Either the browser is stupid, or somebody isn't playing nice. (Ancient browser - MAX_UPLOAD forgery)

                $file_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'file_name'=> $file_name, 'error_code'=>$lang_upload_php['exc_file_size']);

                // There is no need for further tests or action, so skip the remainder of the iteration.
                continue;

            }

            // Now we need to move the file into the /edit directory.

            // We need specify the path for the transitory file.

            // Create a prefix for easier human recognition.
            $prefix = "mHTTP_temp_";

            //Set the correct file extension.

            $suffix = $matches[2];

            // Generate the unique name. Keep generating new names until one that is not in use is found.

            do {

                // Create a random seed by taking the first 8 characters of an MD5 hash of a concatenation of the current UNIX epoch time and the current server process ID.
                $seed = substr(md5(uniqid("")), 0, 8);

                // Assemble the file path.
                $path_to_image = './'.$CONFIG['fullpath'].'edit/'. $prefix . $seed . '.' . $suffix;

            } while (file_exists($path_to_image));

            // Create a holder called $tempname.
            $tempname = $prefix . $seed . '.' . $suffix;

            //Now we upload the file.
            if (!(move_uploaded_file($superCage->files->getPath("/file_upload_array/tmp_name/$counter"), $path_to_image))) {

                // The file upload has failed.

                $file_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'file_name'=> $file_name, 'error_code'=>$lang_upload_php['impossible']);

                // There is no need for further tests or action, so skip the remainder of the iteration.
                continue;

            }

            // Change file permission
            @chmod($path_to_image, octdec($CONFIG['default_file_mode'])); //silence the output in case chmod is disabled

            // Create a testing alias.
            $picture_alias = $matches[1].".".$matches[2];

            // Check to see if the filename is consistent with that of a picture.
            if (is_image($picture_alias)) {

                // If it is, get the picture information
                $imginfo = cpg_getimagesize($path_to_image);

                // If cpg_getimagesize does not recognize the file as a picture, delete the picture.
                if ($imginfo === 'FALSE') {
                    @unlink($path_to_image);

                    // The file upload has failed -- the image is not an image or it is corrupt.
                    $file_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'file_name'=> $file_name, 'error_code'=>$lang_upload_php['not_image']);

                    // There is no need for further tests or action, so skip the remainder of the iteration.
                    continue;

                // JPEG and PNG only are allowed with GD. If the image is not allowed for GD,delete it.
                //} elseif ($imginfo[2] != GIS_JPG && $imginfo[2] != GIS_PNG && ($CONFIG['thumb_method'] == 'gd1' || $CONFIG['thumb_method'] == 'gd2')) {
                } elseif ($imginfo[2] != GIS_JPG && $imginfo[2] != GIS_PNG && $CONFIG['GIF_support'] == 0) {
                    @unlink($path_to_image);

                    // The file upload has failed -- the image is not allowed with GD.
                    $file_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'file_name'=> $file_name, 'error_code'=>$lang_upload_php['not_GD']);

                    // There is no need for further tests or action, so skip the remainder of the iteration.
                    continue;

                // Check that picture size (in pixels) is lower than the maximum allowed. If not, delete it.
                } elseif (max($imginfo[0], $imginfo[1]) > $CONFIG['max_upl_width_height']) {
                  if ((USER_IS_ADMIN && $CONFIG['auto_resize'] == 1) || (!USER_IS_ADMIN && $CONFIG['auto_resize'] > 0)) //($CONFIG['auto_resize']==1)
                  {
                    //resize_image($uploaded_pic, $uploaded_pic, $CONFIG['max_upl_width_height'], $CONFIG['thumb_method'], $imginfo[0] > $CONFIG['max_upl_width_height'] ? 'wd' : 'ht');
                    resize_image($uploaded_pic, $uploaded_pic, $CONFIG['max_upl_width_height'], $CONFIG['thumb_method'], $CONFIG['thumb_use']);
                  }
                  else
                  {
                    @unlink($path_to_image);

                    // The file upload has failed -- the image dimensions exceed the allowed amount.
                    $file_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'file_name'=> $file_name, 'error_code'=>$lang_upload_php['pixel_allowance']);

                    // There is no need for further tests or action, so skip the remainder of the iteration.
                    continue;
                  }
                }

            // Image is ok
            }

            // Put array info for a successful upload in $escrow_array. Hold the actual file name and the name of the temporary image. We do not use the path for security reasons.
            $escrow_array[] = array('actual_name'=>$picture_alias, 'temporary_name'=>$tempname);

        } // end for loop
    } // end if statement

    // Count the number of items in the URI array.
    //Using getRaw() for counting purpose only.
    //$URI_upload_count = count($superCage->post->getRaw('URI_array'));

    //if ($URI_upload_count > 0) {
	if (NUM_URI_BOXES > 0) {

        //for ($counter = 0; $counter < $URI_upload_count; $counter++) {
		for ($counter = 0; $counter < NUM_URI_BOXES; $counter++) {

            // Create the failure ordinal for ordering the report of failed uploads.

            $failure_cardinal = $counter + 1;

            $failure_ordinal = ''.$failure_cardinal.'. ';

            // Initialize the $URI_MIME_type variable.
            $URI_MIME_type = "0";

            // Check to make sure the URI box was not blank.
            //if (empty($_POST['URI_array'][$counter])) {
            if (!$superCage->post->getEscaped("/URI_array/$counter")) {

                // The box was empty.
                // There is no need for further tests or action, so skip the remainder of the iteration.
                continue;

            }

            // Check for magic quotes and remove slashes if necessary.
            /*if (get_magic_quotes_gpc()) {
                //$_POST['URI_array'][$counter] = stripslashes($_POST['URI_array'][$counter]);
                $URI_name = stripslashes($superCage->post->getRaw("/URI_array/$counter"));
            } else {
            	$URI_name = $superCage->post->getRaw("/URI_array/$counter");
            }*/
			$URI_name = stripslashes($superCage->post->getEscaped("/URI_array/$counter"));

            // Remove excess whitespace.
            $URI_name = trim($URI_name);

            // Translate any interior spaces into hex replacements.
            $URI_name = strtr($URI_name, array(" "=>"%20"));

            // We do some validation for the URI. First we check for http:// or ftp:// at the start of the URI.
            if(!ereg('^http://|^ftp://',$URI_name)) {

                // The URL is malformed or not allowed in Coppermine. Note an error.
                $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $URI_name, 'error_code'=>$lang_upload_php['incorrect_prefix']);

                // There is no need for further tests or action, so skip the remainder of the iteration.
                continue;

            }

            // To obtain the file name, we explode the URI into $pieces.
            $pieces = explode('/',$URI_name);

            // We pop off the end of the $pieces array to obtain the possible file name.
            $possible_file_name = array_pop($pieces);

            // Strip the hex equivalent for spaces from the possible file name and restore the spaces.
            $possible_file_name = strtr($possible_file_name, array("%20"=>" "));

            // Check possible filename and extension:

            // Check that the possible file name has a valid name and extension, and replace forbidden chars with underscores.

            // Initialise the $matches array.
            $matches = array();

            // Create the holder $picture_name by translating the possible file name. Translate any forbidden character into an underscore.
            $picture_name = replace_forbidden($possible_file_name);

            // Analyze the file extension using regular expressions.
            if (!preg_match("/(.+)\.(.*?)\Z/", $picture_name, $matches)) {

                // The file name is invalid.
                $matches[1] = 'invalid_fname';

                // Make a bogus file extension to tell Coppermine to use a different name.
                $matches[2] = 'xxx';
            }

            // Set the variable $extension equal to $matches[2].
            $extension = $matches[2];

            // If there is no extension, or if the extension is unknown/not permitted by Coppermine, attenpt to detect a MIME type.
            if ($matches[2] == '' || !is_known_filetype($matches)) {

                // Check for stream_get_meta_data support.
                if (!function_exists('stream_get_meta_data')) {

                    // We cannot get the header information for the file, so we reject the URI as unsafe.
                    $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $URI_name, 'error_code'=>$lang_upload_php['unsafe_URI']);

                    // There is no need for further tests or action, so skip the remainder of the iteration.
                    continue;

                }

                // Open a stream to the resource.
                $fp = fopen($URI_name,"rb");

                // Check to see if the resource was opened.
                if (!$fp) {

                    // Attempt to get the status of the resource.
                    $response = check_status($URI_name);

                    // Try to parse header if we were able to get a response.
                    if ($response) {

                        if(strstr($response, '401')) {

                            // 401 Unauthorized - Authorization needed to obtain resource. Note an error.
                            $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $URI_name, 'error_code'=>$lang_upload_php['http_401']);

                        } elseif(strstr($response, '402')) {

                            // 402 Payment Required -  Where's the cash? :-) Note an error.
                            $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $URI_name, 'error_code'=>$lang_upload_php['http_402']);

                        } elseif(strstr($response, '403')) {

                            // 403 Forbidden - No permission to access the resource. Note an error.
                            $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $URI_name, 'error_code'=>$lang_upload_php['http_403']);

                        } elseif(strstr($response, '404')) {

                            // 404 Not Found - The resource is missing. Note an error.
                            $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $URI_name, 'error_code'=>$lang_upload_php['http_404']);

                        } elseif(strstr($response, '500')) {

                            // 500 Internal Server Error - The server has failed.  Note an error.
                            $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $URI_name, 'error_code'=>$lang_upload_php['http_500']);

                        } elseif(strstr($response, '503')) {

                            // 503 Service Unavailable - The server is busy.  Note an error.
                            $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $URI_name, 'error_code'=>$lang_upload_php['http_503']);

                        } else {

                            // Undocumented error. Note an error. Return status code.
                            $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $URI_name, 'error_code'=>$response);

                        }

                        // There is no need for further tests or action, so skip the remainder of the iteration.
                        continue;

                    } else {


                        // The resource could not be opened.
                        $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $URI_name, 'error_code'=>$lang_upload_php['could_not_open_URI']);

                        // There is no need for further tests or action, so skip the remainder of the iteration.
                        continue;

                    }

                } else {

                    $header = stream_get_meta_data($fp);

                    if($header === 'FALSE') {

                        // We could not get the meta data from the header. We must reject the URI as unsafe.
                        $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $URI_name, 'error_code'=>$lang_upload_php['meta_data_failure']);

                        // There is no need for further tests or action, so skip the remainder of the iteration.
                        continue;

                    }

                    //Look for server response. Proceed if status code 200 is returned.
                    if(!(strstr($header['wrapper_data'][0], '200'))) {

                        // The resource is not available. Attempt to determine why, and
                        // generate the appropriate error.

                        if(strstr($header['wrapper_data'][0], '401')) {

                            // 401 Unauthorized - Authorization needed to obtain resource. Note an error.
                            $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $URI_name, 'error_code'=>$lang_upload_php['http_401']);

                        } elseif(strstr($header['wrapper_data'][0], '402')) {

                            // 402 Payment Required -  Where's the cash? :-) Note an error.
                            $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $URI_name, 'error_code'=>$lang_upload_php['http_402']);

                        } elseif(strstr($header['wrapper_data'][0], '403')) {

                            // 403 Forbidden - No permission to access the resource. Note an error.
                            $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $URI_name, 'error_code'=>$lang_upload_php['http_403']);

                        } elseif(strstr($header['wrapper_data'][0], '404')) {

                            // 404 Not Found - The resource is missing. Note an error.
                            $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $URI_name, 'error_code'=>$lang_upload_php['http_404']);

                        } elseif(strstr($header['wrapper_data'][0], '500')) {

                            // 500 Internal Server Error - The server has failed.  Note an error.
                            $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $URI_name, 'error_code'=>$lang_upload_php['http_500']);

                        } elseif(strstr($header['wrapper_data'][0], '503')) {

                            // 503 Service Unavailable - The server is busy.  Note an error.
                            $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $URI_name, 'error_code'=>$lang_upload_php['http_503']);

                        } else {

                            // Undocumented error. Note an error. Return status code.
                            $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $URI_name, 'error_code'=>$header['wrapper_data'][0]);

                        }

                        // There is no need for further tests or action, so skip the remainder of the iteration.
                        continue;

                    }

                    // Cycle through returned HTTP header. Look for the MIME type, which we will use to create a proper file extension.

                    if (count($header['wrapper_data']) < 2) {

                        // We could not get the meta data from the header. We must reject the URI as unsafe.
                        $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $URI_name, 'error_code'=>$lang_upload_php['meta_data_failure']);

                        // There is no need for further tests or action, so skip the remainder of the iteration.
                        continue;

                    } else {

                        // Now we loop through each item returned in the wrapper data.
                        for ($i=1; isset($header['wrapper_data'][$i]); $i++) {

                            // We test each array element to see if it contains the content-type header.
                            if (strstr(strtolower($header['wrapper_data'][$i]), 'content-type')) {

                                // If we find it, we have found the MIME type.  Use regular expressions to extract it.
                                if(!(eregi('^content-type: ([[:graph:]]+)', $header['wrapper_data'][$i], $MIME_extraction_array))) {

                                    // We could not find a MIME type. Note an error and reject the URI as unsafe.
                                    $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $URI_name, 'error_code'=>$lang_upload_php['MIME_extraction_failure']);

                                    // There is no need for further tests or action, so skip the remainder of the iteration.
                                    continue 2;

                                } else {

                                    // We have found the MIME type, which we will store in $URI_MIME_type.
                                    $URI_MIME_type = $MIME_extraction_array[1];
                                }

                            // While we are at it, let's see if we can get a content length from the server.
                            } elseif (strstr(strtolower($header['wrapper_data'][$i]), 'content-length')) {

                                // We have found the Content-Length header.  Use regular expressions to extract it.
                                if(eregi('^content-length: ([[:digit:]]+)', $header['wrapper_data'][$i], $length_extraction_array)) {

                                    // The content length should be available in bytes.  Cross compare with the maximum file size allowed in an upload.
                                    // Reject the file with an error if it is too large.
                                    if ($length_extraction_array[1] > $max_file_size) {

                                        // The content is too large. Reject it with an error.
                                        $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $URI_name, 'error_code'=>$lang_upload_php['exc_file_size']);

                                        // There is no need for further tests or action, so skip the remainder of the iteration.
                                        continue 2;

                                    }

                                }

                            }

                        }

                    }

                    // Close the file pointer if we were able to open it.
                    fclose($fp);

                }

            }

            // Check to see if MIME type was detected.
            if($URI_MIME_type) {

                // A mime type was detected.  Determine the appropriate file extension for the MIME type.
                // We will hard code the most common GD compatible image MIME types to reduce calls to the DB.
                if(($URI_MIME_type == 'image/jpeg') or ($URI_MIME_type == 'image/jpg')) {

                    //The file will need a .jpg extension.
                    $extension = 'jpg';

                } elseif ($URI_MIME_type == 'image/png') {

                    //The file will need a .png extension.
                    $extension = 'png';

                } elseif ($URI_MIME_type == 'image/gif') {

                    //The file will need a .gif extension.
                    $extension = 'gif';

                } else {
                
                        $extension = '';
                        
                        foreach ($FILE_TYPES as $ext => $typedata){
                        
                            if ($typedata['mime'] == $URI_MIME_type){
                                // Store the extension in $extension.
                                $extension = $ext;
                                break;
                            }
                            
                        }
                        
                        if (!$extension) {
                        
                        // We cannot determine an extension from the MIME type provided, so note an error. Reject the file as unsafe.
                        $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $_POST['URI_array'][$counter], 'error_code'=>$lang_upload_php['MIME_type_unknown']);
  
                        // There is no need for further tests or action, so skip the remainder of the iteration.
                      continue;
                    
                        }

                }

            }

            //Now we must create the temporary file name.  This will be the permanent file name if MIME type detection was used to establish the extension.

            // First, we create a prefix for easier human recognition.
            $prefix = "mURI_temp_";

            //Set the correct file extension.

            $suffix = $extension;

            // Generate the unique name. Keep generating new names until one that is not in use is found.

            do {

                // Create a random seed by taking the first 8 characters of an MD5 hash of a concatenation of the current UNIX epoch time and the current server process ID.
                $seed = substr(md5(uniqid("")), 0, 8);

                // Assemble the file path.
                $path_to_image = './'.$CONFIG['fullpath'].'edit/'. $prefix . $seed . '.' . $suffix;

            } while (file_exists($path_to_image));

            // Create a holder called $tempname.
            $tempname = $prefix . $seed . '.' . $suffix;

            // The file name $path_to_image has been created. We must prepare to download the resource. First, we will attemt to detect the status code for the resource.

            // Open a stream to the resource.
            $fp = fopen($URI_name,"rb");

            // Check to see if the resource was opened.
            if (!$fp) {

                // Attempt to get the status of the resource.
                $response = check_status($URI_name);

                // Try to parse header if we were able to get a response.
                if ($response) {

                    if(strstr($response, '401')) {

                        // 401 Unauthorized - Authorization needed to obtain resource. Note an error.
                        $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $URI_name, 'error_code'=>$lang_upload_php['http_401']);

                    } elseif(strstr($response, '402')) {

                        // 402 Payment Required -  Where's the cash? :-) Note an error.
                        $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $URI_name, 'error_code'=>$lang_upload_php['http_402']);

                    } elseif(strstr($response, '403')) {

                        // 403 Forbidden - No permission to access the resource. Note an error.
                        $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $URI_name, 'error_code'=>$lang_upload_php['http_403']);

                    } elseif(strstr($response, '404')) {

                        // 404 Not Found - The resource is missing. Note an error.
                        $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $URI_name, 'error_code'=>$lang_upload_php['http_404']);

                    } elseif(strstr($response, '500')) {

                        // 500 Internal Server Error - The server has failed.  Note an error.
                        $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $URI_name, 'error_code'=>$lang_upload_php['http_500']);

                    } elseif(strstr($response, '503')) {

                        // 503 Service Unavailable - The server is busy.  Note an error.
                        $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $URI_name, 'error_code'=>$lang_upload_php['http_503']);

                    } else {

                        // Undocumented error. Note an error. Return status code.
                        $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $URI_name, 'error_code'=>$response);

                    }

                    // There is no need for further tests or action, so skip the remainder of the iteration.
                    continue;

                } else {


                    // The resource could not be opened.
                    $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $URI_name, 'error_code'=>$lang_upload_php['could_not_open_URI']);

                    // There is no need for further tests or action, so skip the remainder of the iteration.
                    continue;

                }

            } else {

                // Obtain header info if possible.
                if (function_exists('stream_get_meta_data')) {

                    // Store header data in $header.
                    $header = stream_get_meta_data($fp);

                    // If data was returned, test it.
                    if($header) {

                        //Look for server response. Proceed if status code 200 is returned.
                        if(!(strstr($header['wrapper_data'][0], '200'))) {

                            // The resource is not available. Attempt to determine why, and
                            // generate the appropriate error.

                            if(strstr($header['wrapper_data'][0], '401')) {

                                // 401 Unauthorized - Authorization needed to obtain resource. Note an error.
                                $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $URI_name, 'error_code'=>$lang_upload_php['http_401']);

                            } elseif(strstr($header['wrapper_data'][0], '402')) {

                                // 402 Payment Required -  Where's the cash? :-) Note an error.
                                $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $URI_name, 'error_code'=>$lang_upload_php['http_402']);

                            } elseif(strstr($header['wrapper_data'][0], '403')) {

                                // 403 Forbidden - No permission to access the resource. Note an error.
                                $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $URI_name, 'error_code'=>$lang_upload_php['http_403']);

                            } elseif(strstr($header['wrapper_data'][0], '404')) {

                                // 404 Not Found - The resource is missing. Note an error.
                                $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $URI_name, 'error_code'=>$lang_upload_php['http_404']);

                            } elseif(strstr($header['wrapper_data'][0], '500')) {

                                // 500 Internal Server Error - The server has failed.  Note an error.
                                $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $URI_name, 'error_code'=>$lang_upload_php['http_500']);

                            } elseif(strstr($header['wrapper_data'][0], '503')) {

                                // 503 Service Unavailable - The server is busy.  Note an error.
                                $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $URI_name, 'error_code'=>$lang_upload_php['http_503']);

                            } else {

                                // Undocumented error. Note an error. Return status code.
                                $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $URI_name, 'error_code'=>$header['wrapper_data'][0]);

                            }

                            // There is no need for further tests or action, so skip the remainder of the iteration.
                            continue;

                        }

                        // Cycle through returned HTTP header.
                        if (count($header['wrapper_data']) > 1) {

                            // Now we loop through each item returned in the wrapper data.
                            for ($i=1; isset($header['wrapper_data'][$i]); $i++) {

                                // Let's see if we can get a content length from the server.
                                if (strstr(strtolower($header['wrapper_data'][$i]), 'content-length')) {

                                    // We have found the Content-Length header.  Use regular expressions to extract it.
                                    if(eregi('^content-length: ([[:digit:]]+)', $header['wrapper_data'][$i], $length_extraction_array)) {

                                        // The content length should be available in bytes.  Cross compare with the maximum file size allowed in an upload.
                                        // Reject the file with an error if it is too large.
                                        if ($length_extraction_array[1] > $max_file_size) {

                                            // The content is too large. Reject it with an error.
                                            $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $URI_name, 'error_code'=>$lang_upload_php['exc_file_size']);

                                            // There is no need for further tests or action, so skip the remainder of the iteration.
                                            continue 2;

                                        }

                                    }

                                }

                            }

                        }

                    }

                }

                // Cannot get headers from meta data, or we have completed the metadata check and have found a 200 status code and appropriate content length.

                // Now we must create a file to write the data to.
                touch($path_to_image);

                // Conduct tests on write file.
                if (!is_file($path_to_image)) {

                    // The file was not created. Note an error.
                    $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $URI_name, 'error_code'=>$lang_upload_php['cant_create_write']);

                    // There is no need for further tests or action, so skip the remainder of the iteration.
                    continue;

                // Check for writability,
                } elseif (!is_writable($path_to_image)) {

                    // The file is not writeable. Note an error.
                    $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $URI_name, 'error_code'=>$lang_upload_php['not_writable']);

                    // There is no need for further tests or action, so skip the remainder of the iteration.
                    continue;

                } else {

                    // Initialize the $content variable.
                    $content = '';

                    // The write file has been created and is writeable.  Let's get the content from the URI.
                    while (!feof($fp)) {

                        // Read the data into $content in 8KB chunks.
                        $content .= fread($fp,8192);

                    }

                    // Close the file pointer now that we are done reading it.
                    fclose($fp);

                    // Open the temp file for writing.
                    $fpw = fopen($path_to_image, "wb");

                    // Verify the file has opened.
                    if (!$fpw) {

                        // The file did not open. Make a note of the error.
                        $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $URI_name, 'error_code'=>$lang_upload_php['cant_open_write_file']);

                        // There is no need for further tests or action, so skip the remainder of the iteration.
                        continue;

                    }

                    // Write the data to the file.
                    if (fwrite($fpw, $content, strlen($content)) === 'FALSE') {

                        // We could not write the data to the file. Note an error.
                        $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $URI_name, 'error_code'=>$lang_upload_php['cant_write_write_file']);

                        // There is no need for further tests or action, so skip the remainder of the iteration.
                        continue;

                    }

                    // The file now resides on the server. Let's close the write file.
                    fclose($fpw);

                }

            }

            // The file is located at $path_to_image.  We now need to continue with on server testing.

            // Change file permission
            @chmod($path_to_image, octdec($CONFIG['default_file_mode'])); //silence the output in case chmod is disabled

            // Create a testing alias. Use the temp name if a MIME type eas discovered.
            if ($URI_MIME_type) {

                // The MIME type eas detected, so we use the temp name.
                $picture_alias = $tempname;

            } else {

                $picture_alias = $matches[1].".".$matches[2];

            }

            // Test file size. Delete if too large.
            if (filesize($path_to_image) > $max_file_size) {

                // The file size is too large, delete it.
                @unlink($uploaded_pic);

                // The file upload has failed -- the file is too large. make a note of the error.
                $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $URI_name, 'error_code'=>$lang_upload_php['exc_file_size']);

                // There is no need for further tests or action, so skip the remainder of the iteration.
                continue;
            }

            // Check to see if the filename is consistent with that of a picture.
            if (is_image($picture_alias)) {

                // If it is, get the picture information
                $imginfo = cpg_getimagesize($path_to_image);

                // If cpg_getimagesize does not recognize the file as a picture, delete the picture.
                if ($imginfo === 'FALSE') {
                    @unlink($path_to_image);

                    // The file upload has failed -- the image is not an image or it is corrupt.
                    $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $URI_name, 'error_code'=>$lang_upload_php['not_image']);

                    // There is no need for further tests or action, so skip the remainder of the iteration.
                    continue;

                // JPEG and PNG only are allowed with GD. If the image is not allowed for GD,delete it.
                //} elseif ($imginfo[2] != GIS_JPG && $imginfo[2] != GIS_PNG && ($CONFIG['thumb_method'] == 'gd1' || $CONFIG['thumb_method'] == 'gd2')) {
                } elseif ($imginfo[2] != GIS_JPG && $imginfo[2] != GIS_PNG && $CONFIG['GIF_support'] == 0) {
                    @unlink($path_to_image);

                    // The file upload has failed -- the image is not allowed with GD.
                    $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $URI_name, 'error_code'=>$lang_upload_php['not_GD']);

                    // There is no need for further tests or action, so skip the remainder of the iteration.
                    continue;

                // Check that picture size (in pixels) is lower than the maximum allowed. If not, delete it.
                } elseif (max($imginfo[0], $imginfo[1]) > $CONFIG['max_upl_width_height']) {
                    @unlink($path_to_image);

                    // The file upload has failed -- the image dimensions exceed the allowed amount.
                    $URI_failure_array[] = array( 'failure_ordinal'=>$failure_ordinal, 'URI_name'=> $URI_name, 'error_code'=>$lang_upload_php['pixel_allowance']);

                    // There is no need for further tests or action, so skip the remainder of the iteration.
                    continue;
                }

            // Image is ok
            }

            // Put array info for a successful upload in $escrow_array. Array hold the actual file name and the name of the temporary image. We do not use the path for security reasons.
            $escrow_array[] = array('actual_name'=>$picture_alias, 'temporary_name'=>$tempname);

        }

    }

    // Decompressive ZIP uploading is disabled.
    // $zip_upload_count = count($_FILES['ZIP_array']['name']);

    //Now we must prepare the inital form for adding the pictures to the database, and we must move them to their final location.

    // Count errors in each error array and the escrow array.
    $escrow_array_count = isset($escrow_array) ? count($escrow_array) : 0;
    $file_error_count = isset($file_failure_array) ? count($file_failure_array) : 0;
    $URI_error_count = isset($URI_failure_array) ? count($URI_failure_array) : 0;
    $zip_error_count = isset($zip_failure_array) ? count($zip_failure_array) : 0;

    // Create page header.
    pageheader($lang_upload_php['title']);

    // Check for successful uploads.
    if ($escrow_array_count > '0') {

        // Serialize and base64_encode the array.
        $cayman_escrow = base64_encode(serialize($escrow_array));

        // Add temp data record to database.
        $unique_ID = create_record($cayman_escrow);

        // Verify record was created.
        if (!$unique_ID) {

            cpg_die(CRITICAL_ERROR, $lang_upload_php['cant_create_write'], __FILE__, __LINE__);

        }

        // Prepare success data for user.
        open_form($CPG_PHP_SELF); // Set the form action to this script.
        starttable("100%", $lang_upload_php['succ'], 2);
        echo "<tr><td colspan=\"2\">";
        printf ($lang_upload_php['success'], $escrow_array_count);
        echo "<br /><br />";
        echo $lang_upload_php['add'];
        echo "</td></tr>";

        $form_array = array(
             array('unique_ID', $unique_ID, 4),
             array('control', 'phase_2', 4)
        );
        if ($sel_album) {
            //album id is available, put it in hidden field
            $form_array[] = array('album', $sel_album, 4);
        }

        create_form($form_array);
        close_form($lang_common['continue']);
        endtable();

        // Throw in an HTML break for aesthetics.
        echo "<br />";

    } else {

        // we had no successful uploads. We create a redirect box.
        msg_box($lang_common['information'], sprintf($lang_upload_php['success'], $escrow_array_count), $lang_common['continue'], 'index.php', "100%");

        // Throw in an HTML break for aesthetics.
        echo "<br />";

    }

    // Create error report if we have errors.
    if (($file_error_count + $URI_error_count + $zip_error_count) > 0) {

        // Prepare error data for user.
        starttable("100%", $lang_upload_php['error_report'], 2);
        form_statement($lang_upload_php['error_instr']);

        // Look for file upload errors.
        if ($file_error_count > 0) {

            // There are file upload errors. Generate the section label.
            form_label($lang_upload_php['reg_instr_7']);
            echo "<tr><td>{$lang_upload_php['file_name_url']}</td><td>{$lang_upload_php['error_message']}</td></tr>";

            // Cycle through the file upload errors.
            for ($i=0; $i < $file_error_count; $i++) {

                // Print the error ordinal, file name, and error code.
                echo "<tr><td>{$file_failure_array[$i]['failure_ordinal']} {$file_failure_array[$i]['file_name']}</td><td>{$file_failure_array[$i]['error_code']}</td></tr>";

            }

        }

        // Look for URI upload errors.
        if ($URI_error_count > 0) {

            // There are URI upload errors. Generate the section label.
            form_label($lang_upload_php['reg_instr_8']);
            echo "<tr><td>{$lang_upload_php['file_name_url']}</td><td>{$lang_upload_php['error_message']}</td></tr>";

            // Cycle through the file upload errors.
            for ($i=0; $i < $URI_error_count; $i++) {

                // Print the error ordinal, file name, and error code.
                echo "<tr><td>{$URI_failure_array[$i]['failure_ordinal']} {$URI_failure_array[$i]['URI_name']}</td><td>{$URI_failure_array[$i]['error_code']}</td></tr>";

            }

        }

        // Look for zip upload errors.
        if ($zip_error_count > 0) {

            // There are file upload errors. Generate the section label.
            form_label($lang_upload_php['reg_instr_6']);
            echo "<tr><td>{$lang_upload_php['file_name_url']}</td><td>{$lang_upload_php['error_message']}</td></tr>";

            // Cycle through the file upload errors.
            for ($i=0; $i < $zip_error_count; $i++) {

                // Print the error ordinal, file name, and error code.
                echo "<tr><td>{$file_failure_array[$i]['failure_ordinal']} {$file_failure_array[$i]['file_name']}</td><td>{$file_failure_array[$i]['error_code']}</td></tr>";

            }

        }

        // Close the error report table.
        endtable();

    }

    // Create the footer and flush the output buffer.
    echo "</form>";
    pagefooter();
    ob_end_flush();

    // Exit the script.

    exit;
}

// Recieve incoming post information for phase II.
//if ((isset($_POST['control'])) and ($_POST['control'] == 'phase_2')) {
if ($superCage->post->keyExists('control') && $superCage->post->getEscaped('control') == 'phase_2') {

    // Check for incoming album placement data.
    //if ((isset($_POST['album'])) and (isset($_POST['unique_ID']))) {
    if ($superCage->post->keyExists('album') && $superCage->post->keyExists('unique_ID')) {

        // Check if user selected an album to upload picture to. If not, die with error.
        // added by frogfoot
        $album = $superCage->post->getInt('album');
        if (!$album) {
            cpg_die(ERROR, $lang_db_input_php['album_not_selected'], __FILE__, __LINE__);
        }

        if ($superCage->post->keyExists('unique_ID')) {

            // The unique ID is set, so let us retrieve the record.
            $cayman_string = retrieve_record($superCage->post->getAlnum('unique_ID'));

            // Verify record was retrieved.
            if (!$cayman_string) {
                cpg_die(CRITICAL_ERROR, $lang_errors['param_missing'], __FILE__, __LINE__);
            }
        } else {
            // The $_POST['unique_ID'] value is not present.  Die with an error.
            cpg_die(CRITICAL_ERROR, $lang_errors['param_missing'], __FILE__, __LINE__);
        }

        // Now we decode the string.
        $escrow_array = unserialize(base64_decode($cayman_string));

        // Now we need to pop a file set off $escrow_array.
        // The returned element will take the form: array('actual_name', 'temporary_name')

        // First, we test to make sure $escrow_array is an array.
        if (!(is_array($escrow_array))) {
            // The decoded information is not an array. Die with an error.
            cpg_die(CRITICAL_ERROR, $lang_errors['param_missing'], __FILE__, __LINE__);
        }

        // Initialize $file_set as an array.
        $file_set = array();

        // Create array index.
        $index = count($escrow_array) - 1;

        // Read the end of the $escrow_array array into $file_set.
        $file_set[0] = $escrow_array[$index]['actual_name'];
        $file_set[1] = $escrow_array[$index]['temporary_name'];

        // Get the image preview path.
        $preview_path = $escrow_array[$index]['preview_path'];

        // Remove end of $escrow_array.
        unset($escrow_array[$index]['preview_path']);
        unset($escrow_array[$index]['actual_name']);
        unset($escrow_array[$index]['temporary_name']);
        unset($escrow_array[$index]);

        // Re-encode the $escrow_array.
        $cayman_escrow = base64_encode(serialize($escrow_array));

        // Update the record.
        $update = update_record($superCage->post->getAlnum('unique_ID'), $cayman_escrow);

        // Verify that the update occurred.
        if (!$update) {

            // We cannot write to the temporary data file. Note a fatal error.
            cpg_die(CRITICAL_ERROR, $lang_upload_php['not_writable'], __FILE__, __LINE__);

        }

        // We have incoming placement data. Let's capture it.

        $album = $superCage->post->getInt('album');
        $title = $superCage->post->getEscaped('title');
        $caption = $superCage->post->getEscaped('caption');
        $keywords = $superCage->post->getEscaped('keywords');
        $user1 = $superCage->post->getEscaped('user1');
        $user2 = $superCage->post->getEscaped('user2');
        $user3 = $superCage->post->getEscaped('user3');
        $user4 = $superCage->post->getEscaped('user4');

        // Capture movie or audio width and height if sent.
        if($superCage->post->keyExists('movie_wd')) {
            $movie_wd = $superCage->post->getInt('movie_wd');
        } else {
            $movie_wd = 320;
        }

        if($superCage->post->keyExists('movie_ht')) {
            $movie_ht = $superCage->post->getInt('movie_wd');
        } else {
            $movie_ht = 240;
        }

		// Check if the album id provided is valid
		/*if (!GALLERY_ADMIN_MODE) {
			$result = cpg_db_query("SELECT category FROM {$CONFIG['TABLE_ALBUMS']} WHERE aid='$album' and (uploads = 'YES' OR category = '" . (USER_ID + FIRST_USER_CAT) . "' OR owner = '" . USER_ID . "')");
			if (mysql_num_rows($result) == 0)cpg_die(ERROR, $lang_db_input_php['unknown_album'], __FILE__, __LINE__);
			$row = mysql_fetch_array($result);
			mysql_free_result($result);
			$category = $row['category'];
		} else {
			$result = cpg_db_query("SELECT category FROM {$CONFIG['TABLE_ALBUMS']} WHERE aid='$album'");
			if (mysql_num_rows($result) == 0)cpg_die(ERROR, $lang_db_input_php['unknown_album'], __FILE__, __LINE__);
			$row = mysql_fetch_array($result);
			mysql_free_result($result);
			$category = $row['category'];
		}	*/
		#########################################            DB           ##########################################
		if (!GALLERY_ADMIN_MODE) {
			$cpgdb->query($cpg_db_upload_php['check_valid_alb'], $album, (USER_ID + FIRST_USER_CAT), USER_ID);
			$rowset = $cpgdb->fetchRowSet();
			if (count($rowset) == 0) cpg_die(ERROR, $lang_db_input_php['unknown_album'], __FILE__, __LINE__);
			$row = $rowset[0];
			$cpgdb->free();
			$category = $row['category'];
			
		} else {
			$cpgdb->query($cpg_db_upload_php['check_gal_admin_valid_alb'], $album);
			$rowset = $cpgdb->fetchRowSet();
			if (count($rowset) == 0) cpg_die(ERROR, $lang_db_input_php['unknown_album'], __FILE__, __LINE__);
			$row = $rowset[0];
			$cpgdb->free();
			$category = $row['category'];
		}
		###############################################################################################

        // Pictures are moved in a directory named 10000 + USER_ID
        if (USER_ID && $CONFIG['silly_safe_mode'] != 1) {
            $filepath = $CONFIG['userpics'] . (USER_ID + FIRST_USER_CAT);
            $dest_dir = $CONFIG['fullpath'] . $filepath;
            if (!is_dir($dest_dir)) {
                mkdir($dest_dir, octdec($CONFIG['default_dir_mode']));
                if (!is_dir($dest_dir)) cpg_die(CRITICAL_ERROR, sprintf($lang_db_input_php['err_mkdir'], $dest_dir), __FILE__, __LINE__, true);
                @chmod($dest_dir, octdec($CONFIG['default_dir_mode'])); //silence the output in case chmod is disabled
                $fp = fopen($dest_dir . '/index.html', 'w');
                fwrite($fp, ' ');
                fclose($fp);
            }
            $dest_dir .= '/';
            $filepath .= '/';
        } else {
            $filepath = $CONFIG['userpics'];
            $dest_dir = $CONFIG['fullpath'] . $filepath;
        }

        // Check that target dir is writable
        if (!is_writable($dest_dir)) cpg_die(CRITICAL_ERROR, sprintf($lang_db_input_php['dest_dir_ro'], $dest_dir), __FILE__, __LINE__, true);

        //Add the Perl regex to break the actual name.
        preg_match("/(.+)\.(.*?)\Z/", $file_set[0], $matches);

        // Create a unique name for the uploaded file
        $nr = 0;
        $picture_name = $matches[1] . '.' . $matches[2];
        while (file_exists($dest_dir . $picture_name)) {
            $picture_name = $matches[1] . '~' . $nr++ . '.' . $matches[2];
        }

        // Create path for final location.
        $uploaded_pic = $dest_dir . $picture_name;

        // Form path to temporary image.
        $path_to_image = './'.$CONFIG['fullpath'].'edit/'.$file_set[1];

                // prevent moving the edit directory...
                if (is_dir($path_to_image)) cpg_die(CRITICAL_ERROR, $lang_upload_php['failure'] . " - '$path_to_image'", __FILE__, __LINE__, true);

        // Move the picture into its final location
        if (rename($path_to_image, $uploaded_pic)) {

            // Change file permission
            @chmod($uploaded_pic, octdec($CONFIG['default_file_mode'])); //silence the output in case chmod is disabled

            // Create thumbnail and intermediate image and add the image into the DB
            $result = add_picture($album, $filepath, $picture_name, 0,$title, $caption, $keywords, $user1, $user2, $user3, $user4, $category, $raw_ip, $hdr_ip, $movie_wd, $movie_ht);

            if (!$result) {

                // The file could not be placed.
                $file_placement = 'no';

            } else {

                // The file was placed successfully.
                $file_placement = 'yes';

            }

        } else {

            // The file was not placed successfully.
            $file_placement = 'no';

        }

        // Time for garbage cleanup.

        // First, we delete the preview image.
        if ((!strstr($preview_path, 'thumb')) and (file_exists($preview_path))) {

            unlink($preview_path);

        }

        // Check to see if this is the last one.
        if(count($escrow_array) == '0') {

            // Create the final message.
            if ($PIC_NEED_APPROVAL) {

                if ($file_placement == 'no') {

                    $final_message = ''.$lang_upload_php['no_place'].'<br /><br />'.$lang_db_input_php['upload_success'];

                } else {

                    $final_message = ''.$lang_upload_php['yes_place'].'<br /><br />'.$lang_db_input_php['upload_success'];

                }

            } else {

                if ($file_placement == 'no') {

                    $final_message = ''.$lang_upload_php['no_place'].'<br /><br />'.$lang_upload_php['process_complete'];

                } else {

                    $final_message = ''.$lang_upload_php['yes_place'].'<br /><br />'.$lang_upload_php['process_complete'];

                }

            }

            // Delete the temporary data file.
            delete_record($superCage->post->getAlnum('unique_ID'));

            // Send e-mail notification to the admin if requested (added by gaugau: 03-11-09).
            if (($CONFIG['upl_notify_admin_email']) and ($PIC_NEED_APPROVAL)) {
                // Encapsulate so included lang file doesn't interfere with global one
                function cpg_send_upload_notification() {
                    global $CONFIG;
                    $lang_db_input_php = cpg_get_default_lang_var('lang_db_input_php');
                    // Get the mail files.
                    include_once('include/mailer.inc.php');

                    // Send the message.
                    cpg_mail('admin', sprintf($lang_db_input_php['notify_admin_email_subject'], $CONFIG['gallery_name']), sprintf($lang_db_input_php['notify_admin_email_body'], USER_NAME,  $CONFIG['ecards_more_pic_target']. (substr( $CONFIG["ecards_more_pic_target"], -1) == '/' ? '' : '/') .'editpics.php?mode=upload_approval' ));
                }
                cpg_send_upload_notification();
            }

            // That was the last one. Create a redirect box.
            pageheader($lang_common['information']);
            msg_box($lang_common['information'], $final_message, $lang_common['continue'], 'index.php', "100%");
            pagefooter();

            // Exit the script.
            exit;

        }

    }

    // The user has files that need to be processed and placed in albums.
    // We must pull that information from the temporary data file
    // whose ID is in $_POST['unique_ID'].

    if ($superCage->post->keyExists('unique_ID')) {

            // The unique ID is set, so let us retrieve the record.
            $cayman_string = retrieve_record($superCage->post->getAlnum('unique_ID'));

            // Verify record was retrieved.
            if (!$cayman_string) {
                cpg_die(CRITICAL_ERROR, $lang_errors['param_missing'], __FILE__, __LINE__);
            }
    } else {
        // The $_POST['cayman'] path is not present.  Die with an error.
        cpg_die(CRITICAL_ERROR, $lang_errors['param_missing'], __FILE__, __LINE__);
    }

    // Now we decode the string.
    $escrow_array = unserialize(base64_decode($cayman_string));

    // Now we need to detect the end file set of $escrow_array.
    // The returned element will take the form: array('actual_name', 'temporary_name')

    // First, we test to make sure $escrow_array is an array.
    if (!(is_array($escrow_array))) {

        // The decoded information is not an array. Die with an error.
        cpg_die(CRITICAL_ERROR, $lang_errors['param_missing'], __FILE__, __LINE__);

    }

    // Initialize $file_set as an array.
    $file_set = array();

    // Create array index.
    $index = count($escrow_array) - 1;

    // Read the end of the $escrow_array array into $file_set.
    $file_set[0] = $escrow_array[$index]['actual_name'];
    $file_set[1] = $escrow_array[$index]['temporary_name'];

    // Create preview image.

    // Create path to image.
    $path_to_image = './'.$CONFIG['fullpath'].'edit/'.$file_set[1];

    // Create the preview function.

    // Get the extension for the preview.

    // First we parse the file name to determine the file type.
    $pieces = explode('.',$file_set[1]);

    // We pop off the end of the $pieces array to obtain the possible file name.
    $extension = array_pop($pieces);

    // Detect if the file is an image.
    if(is_image($file_set[1])) {

        // Create preview image file name.

        do {

            // Create a random seed by taking the first 8 characters of an MD5 hash of a concatenation of the current UNIX epoch time and the current server process ID.
            $seed = substr(md5(uniqid("")), 0, 8);

            // Assemble the file path.
            $path_to_preview = './'.$CONFIG['fullpath'].'edit/preview_' . $seed . '.' . $extension;

        } while (file_exists($path_to_preview));

        // Create secure preview path.
        $s_preview_path = 'preview_' . $seed . '.' . $extension;

        // The file is an image, we must resize it for a preview image.
        resize_image($path_to_image, $path_to_preview, '150', $CONFIG['thumb_method'], 'wd');

        if ($CONFIG['read_iptc_data']) {
           $iptc = get_IPTC($path_to_image);
        }

    } else {

        // The file is not an image, so we will use the non-image thumbs
        // for preview images.

        // We create the path to the preview image.
        $path_to_preview = "images/thumb_{$extension}.jpg";

    }

    // Add preview image path to $escrow_array.
    $escrow_array[$index]['preview_path'] = $path_to_preview;

    // Re-encode the $escrow_array.
    $cayman_escrow = base64_encode(serialize($escrow_array));

    // Update the record.
    $update = update_record($superCage->post->getAlnum('unique_ID'), $cayman_escrow);

    // Verify that the update occurred.
    if (!$update) {
        // We cannot write to the temporary data file. Note a fatal error.
        cpg_die(CRITICAL_ERROR, $lang_upload_php['not_writable'], __FILE__, __LINE__);
    }

    // Create upload form headers.
    pageheader($lang_upload_php['title']);
    
    // Direct the request to this script.
    open_form($CPG_PHP_SELF);

    // Open the form table.
    starttable("100%", cpg_fetch_icon('upload',2).$lang_upload_php['title'], 2);

    // Create image tag and echo it to the output buffer.
    echo "<tr><td class=\"tableh2\"><img class=\"image\" src=\"".$path_to_preview."\"  /></td>";

    // Echo instructions.
    echo "<td class=\"tableh2\">{$lang_upload_php['picture']} - {$file_set[0]}<br /><br />{$lang_upload_php['place_instr_1']}<br /><br />";

    // If we have previously placed a picture, give a brief message about its success or failure.
    if (isset($file_placement)) {

        if ($file_placement == 'yes') {

            // The previous picture was placed successfully.
            echo "{$lang_upload_php['yes_place']}";

        } elseif ($file_placement == 'no') {

            // The previous image placement failed.
            echo "{$lang_upload_php['no_place']}";

        }

    }

    echo "</td></tr>";

    // Declare an array containing the various upload form box definitions.
    $captionLabel = $lang_upload_php['description'];
    $keywordLabel = $lang_common['keywords_insert1']. '<br /><a href="#" onClick="return MM_openBrWindow(\'keyword_select.php\',\'selectKey\',\'width=250, height=400, scrollbars=yes,toolbar=no,status=yes,resizable=yes\')">' . $lang_common['keywords_insert2'] .'</a>';
    if ($CONFIG['show_bbcode_help']) {$captionLabel .= '&nbsp;'. cpg_display_help('f=empty.htm&amp;base=64&amp;h='.urlencode(base64_encode(serialize($lang_bbcode_help_title))).'&amp;t='.urlencode(base64_encode(serialize($lang_bbcode_help))),470,245);}
    //$printed_file_name = "{$lang_upload_php['picture']} - {$file_set[0]}";

    //Use the IPTC title or headline for the Coppermine title if available.
    if (isset($iptc['Title']) && !empty($iptc['Title'])) {
        $title=$iptc['Title'];
    } elseif (isset($iptc['Headline']) && !empty($iptc['Headline'])) {
        $title=$iptc['Headline'];
    } else {
        $title='';
    }

    $form_array = array(
    array($lang_common['album'], 'album', 2),
    array($lang_upload_php['pic_title'], 'title', 0, 255, 1, $title),
    array($captionLabel, 'caption', 3, $CONFIG['max_img_desc_length'], (isset($iptc['Caption'])) ? $iptc['Caption'] : ''),
    array($keywordLabel, 'keywords', 0, 255, 1,(isset($iptc['Keywords'])) ? implode(' ',$iptc['Keywords']): ''),
    array('control', 'phase_2', 4),
    array('unique_ID', $superCage->post->getAlnum('unique_ID'), 4),
    );

    // Check for user defined fields.
    if(!empty($CONFIG['user_field1_name'])) {
        $form_array[] = array($CONFIG['user_field1_name'], 'user1', 0, 255, 1);
    }

    if(!empty($CONFIG['user_field2_name'])) {
        $form_array[] = array($CONFIG['user_field2_name'], 'user2', 0, 255, 1);
    }

    if(!empty($CONFIG['user_field3_name'])) {
        $form_array[] = array($CONFIG['user_field3_name'], 'user3', 0, 255, 1);
    }

    if(!empty($CONFIG['user_field4_name'])) {
        $form_array[] = array($CONFIG['user_field4_name'], 'user4', 0, 255, 1);
    }


    // Check for movies and audio, and create width and height boxes if true.
    if((is_movie($file_set[1])) or (is_audio($file_set[1]))) {

        //Add width and height boxes to the form.
        $form_array[] = array($lang_admin_php['th_wd'],'movie_wd', 0, 4, 1);
        $form_array[] = array($lang_admin_php['th_ht'],'movie_ht', 0, 4, 1);

    }

    // Create the form and echo more instructions.
    create_form($form_array);

    // More instructions.
    if(count($escrow_array) > '1') {

        form_statement($lang_upload_php['place_instr_2']);

    }

    // Make button say 'Continue.'
    close_form($lang_common['continue']);

    // Close the table, create footers, and flush the output buffer.
    endtable();
    echo "</form>";
    pagefooter();
    ob_end_flush();

    // Exit the script.
    exit;


}
?>
