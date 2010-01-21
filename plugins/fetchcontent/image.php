<?php
/********************************************************
  Coppermine 1.5.x plugin - FetchContent
  *******************************************************
  Copyright (c) 2010 Coppermine dev team
  *******************************************************
  This program is free software; you can redistribute 
  it and/or modify it under the terms of the GNU General
  Public License as published by the Free Software
  Foundation; either version 3 of the License, or 
  (at your option) any later version.
  *******************************************************
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
  *******************************************************/
  
if (!defined('IN_COPPERMINE')) { // Make sure this page is not being accessed directly 
    die('Not in Coppermine...');
}

// create Inspekt supercage$superCage = Inspekt::makeSuperCage();
$referer = urldecode($superCage->server->getRaw('HTTP_REFERER')); // Todo: needs to be sanitized, goes into the log file!
if ($referer != '') {
	$referer = ', Referer: ' . $referer;
}

// Initialize some variables
$output_denied = 0;
$denial_reason_array = array();
$size_array = array(1 => 'thumbnail', 2 => 'intermediate', 3 => 'full-size');

// Sanitize URL address parameters
if ($superCage->get->keyExists('pid')) {
    $pid = $superCage->get->getInt('pid'); // pid = (integer) pid of the image
} elseif ($superCage->get->keyExists('album') && $superCage->get->keyExists('meta') && $superCage->get->testAlpha('meta') && $superCage->get->getInt('album')) {
    // album = integer number of the album; only together with the specification of the meta album  
    // (not implemented yet)
    if ($superCage->get->testAlpha('album')) {
        $album = $superCage->get->getAlpha('album');
    } else {
        $album = $superCage->get->getInt('album');
    }
    $allowed_meta_array = array('random', 'lastup', 'toprated', 'mostviewed');
    $fetchcontent_meta = $superCage->get->getAlpha('meta');
	if (in_array($superCage->get->getAlpha('meta'), $allowed_meta_array) == TRUE) {
		$fetchcontent_meta = $superCage->get->getAlpha('meta');
	} else {
		$output_denied++;
		if ($CONFIG['plugin_fetchcontent_enable_logging'] != 0) {
			$denial_reason_array[] = 'Plugin fetchcontent: wrong parameter for meta specified by user ' . $USER_DATA['user_name'] . ' (ID ' . USER_ID . ', groups ' . implode(',', $USER_DATA['groups']) . '), remote IP address: ' . $superCage->server->getRaw('REMOTE_ADDR') . $referer;
		}
	}
	echo $album;
	echo '<hr />';
	echo $fetchcontent_meta;
	die;
} else {
    $output_denied++;
    if ($CONFIG['plugin_fetchcontent_enable_logging'] != 0) {
		$denial_reason_array[] = 'Plugin fetchcontent: not enough URL parameters specified by user ' . $USER_DATA['user_name'] . ' (ID ' . USER_ID . ', groups ' . implode(',', $USER_DATA['groups']) . '), remote IP address: ' . $superCage->server->getRaw('REMOTE_ADDR') . $referer;
    }
}

// size = what should be returned, in analogy to the access_level, either 1 = thumbnail, 2 = normal/intermediate, 3 = fullsize
$size = 1; // Default is 1, i.e. thumbnail access
if ($superCage->get->keyExists('size')) {
    if ($superCage->get->getInt('size') == 2) {
        $size = 2;
    } elseif ($superCage->get->getInt('size') == 3) {
        $size = 3;
    }
}

if ($superCage->get->keyExists('filetype') && in_array($superCage->get->getAlpha('filetype'), array('image', 'document', 'audio', 'movie', 'any')) == TRUE) {
    $fetchcontent_filetype = $superCage->get->getAlpha('filetype');
} else {
    $fetchcontent_filetype = 'image';
}

// Is the visitor allowed access in the first place
if (USER_ACCESS_LEVEL < $size ) {
    $output_denied++;
    if ($CONFIG['plugin_fetchcontent_enable_logging'] != 0) {
		$denial_reason_array[] = 'Plugin fetchcontent: denied access for ' . $size_array[$size] . ' of PID ' . $pid . ' for user ' . $USER_DATA['user_name'] . ' (ID ' . USER_ID . ', groups ' . implode(',', $USER_DATA['groups']) . '), remote IP address: ' . $superCage->server->getRaw('REMOTE_ADDR') . $referer;
    }
}

// Processing starts here
$result = cpg_db_query("SELECT filepath, filename, pwidth, pheight FROM {$CONFIG['TABLE_PICTURES']} AS p WHERE pid='$pid' $FORBIDDEN_SET LIMIT 1");
if (mysql_num_rows($result) == 0) {
    $output_denied++;
    if ($CONFIG['plugin_fetchcontent_enable_logging'] != 0) {
		$denial_reason_array[] = 'Plugin fetchcontent: empty database record for ' . $size_array[$size] . ' of PID ' . $pid . ' for user ' . $USER_DATA['user_name'] . ' (ID ' . USER_ID . ', groups ' . implode(',', $USER_DATA['groups']) . '), remote IP address: ' . $superCage->server->getRaw('REMOTE_ADDR') . $referer;
    }
} else {
    $row = mysql_fetch_assoc($result);
    // Determine the file type
    $filetype = cpg_get_type($row['filename']); // returns an associative array with keys extension, mime, content (possible values: 'image', 'audio', 'movie', 'document') and player. 
}
mysql_free_result($result);

if ($size == 1) { // Thumbnail size has been requested
	if (file_exists($CONFIG['fullpath'] . $row['filepath'] . $CONFIG['thumb_pfx'] . $row['filename'])) {
		$fetchcontent_redirection_path = $CONFIG['fullpath'] . $row['filepath'] . $CONFIG['thumb_pfx'] . $row['filename'];
	} else {
		if ($filetype['content'] == 'image') { // Requested file is an image
    		$output_denied++;
    		if ($CONFIG['plugin_fetchcontent_enable_logging'] != 0) {
    			$denial_reason_array[] = 'Plugin fetchcontent: file does not exist for ' . $size_array[$size] . ' of PID ' . $pid . ' for user ' . $USER_DATA['user_name'] . ' (ID ' . USER_ID . ', groups ' . implode(',', $USER_DATA['groups']) . '), remote IP address: ' . $superCage->server->getRaw('REMOTE_ADDR') . $referer;
    		}
		} else { // Requested file is NOT an image
		    if (file_exists($CONFIG['fullpath'] . 'images/thumbs/' . $CONFIG['thumb_pfx'] . $filetype['extension'] . '.png')) {
		        $fetchcontent_redirection_path = $CONFIG['fullpath'] . 'images/thumbs/' . $CONFIG['thumb_pfx'] . $filetype['extension'] . '.png'; // Return the generic thumb
		    } else {
        		$output_denied++;
        		if ($CONFIG['plugin_fetchcontent_enable_logging'] != 0) {
        			$denial_reason_array[] = 'Plugin fetchcontent: file does not exist for ' . $size_array[$size] . ' of PID ' . $pid . ' nor is there a generic thumbnail for the extension ' . $filetype['extension'] . ' for user ' . $USER_DATA['user_name'] . ' (ID ' . USER_ID . ', groups ' . implode(',', $USER_DATA['groups']) . '), remote IP address: ' . $superCage->server->getRaw('REMOTE_ADDR') . $referer;
		    }
	}
		}
	}
} else { // Another file size has been requested than the thumbnail - start
    if ($filetype['content'] != 'image') { // Processing here for non-images --- start
        if ($CONFIG['plugin_fetchcontent_non_image'] == '0') { // Non-images are not allowed at all
    		$output_denied++;
    		if ($CONFIG['plugin_fetchcontent_enable_logging'] != '0') {
    			$denial_reason_array[] = 'Plugin fetchcontent: file type ' . $filetype['extension'] . ' is not an image and therefore not allowed at all as ' . $size_array[$size] . ' of PID ' . $pid . ' for user ' . $USER_DATA['user_name'] . ' (ID ' . USER_ID . ', groups ' . implode(',', $USER_DATA['groups']) . '), remote IP address: ' . $superCage->server->getRaw('REMOTE_ADDR') . $referer;
    		}
    	} elseif ($CONFIG['plugin_fetchcontent_non_image'] == '1') {
    	    if ($fetchcontent_filetype == 'any' || ($fetchcontent_filetype == $filetype['content'])) {
    	        // The fetching of a non-image has been explicitely been allowed by URL pattern, 
    	        // so do nothing here. This if/then construct could of course be inverted as well...
    	    } else { // The fetching of a non-image has not been allowed by URL pattern, so deny access.
        		$output_denied++;
        		if ($CONFIG['plugin_fetchcontent_enable_logging'] != '0') {
        			$denial_reason_array[] = 'Plugin fetchcontent: file type ' . $filetype['extension'] . ' is not an image and has not been allowed neither as ' . $size_array[$size] . ' of PID ' . $pid . ' for user ' . $USER_DATA['user_name'] . ' (ID ' . USER_ID . ', groups ' . implode(',', $USER_DATA['groups']) . '), remote IP address: ' . $superCage->server->getRaw('REMOTE_ADDR') . $referer;
        		}    	    
    	    }
    	} elseif ($CONFIG['plugin_fetchcontent_non_image'] == '2') {
    	    if ($superCage->get->keyExists('imageonly') == TRUE) {
        		$output_denied++;
        		if ($CONFIG['plugin_fetchcontent_enable_logging'] != '0') {
        			$denial_reason_array[] = 'Plugin fetchcontent: file type ' . $filetype['extension'] . ' is not an image and has not been allowed neither as ' . $size_array[$size] . ' of PID ' . $pid . ' for user ' . $USER_DATA['user_name'] . ' (ID ' . USER_ID . ', groups ' . implode(',', $USER_DATA['groups']) . '), remote IP address: ' . $superCage->server->getRaw('REMOTE_ADDR') . $referer;
        		}
    	    }
        }
        // By now all forbidden stuff should be filtered. 
        // A non-image file doesn't have an intermediate view, so the parameter size=2 
        // wouldn't make sense. Set size to 3!
        $size = 3;
    } // Processing here for non-images --- end
    
    if ($size == 2) {
    	if (file_exists($CONFIG['fullpath'] . $row['filepath'] . $CONFIG['normal_pfx'] . $row['filename'])) {
    		$fetchcontent_redirection_path = $CONFIG['fullpath'] . $row['filepath'] . $CONFIG['normal_pfx'] . $row['filename'];
    	} elseif (USER_ACCESS_LEVEL > 2 && file_exists($CONFIG['fullpath'] . $row['filepath'] . $row['filename'])) {
    		$fetchcontent_redirection_path = $CONFIG['fullpath'] . $row['filepath'] . $row['filename'];
    	} else {
    		$output_denied++;
    		if ($CONFIG['plugin_fetchcontent_enable_logging'] != 0) {
    			$denial_reason_array[] = 'Plugin fetchcontent: file does not exist for ' . $size_array[$size] . ' of PID ' . $pid . ' for user ' . $USER_DATA['user_name'] . ' (ID ' . USER_ID . ', groups ' . implode(',', $USER_DATA['groups']) . '), remote IP address: ' . $superCage->server->getRaw('REMOTE_ADDR') . $referer;
    		}
    	}
    } elseif ($size == 3) {
    	if (file_exists($CONFIG['fullpath'] . $row['filepath'] . $row['filename'])) {
    		$fetchcontent_redirection_path = $CONFIG['fullpath'] . $row['filepath'] . $row['filename'];
    	} elseif (file_exists($CONFIG['fullpath'] . $row['filepath'] . $CONFIG['normal_pfx'] . $row['filename'])) {
    		$fetchcontent_redirection_path = $CONFIG['fullpath'] . $row['filepath'] . $CONFIG['normal_pfx'] . $row['filename'];
    	} else {
    		$output_denied++;
    		if ($CONFIG['plugin_fetchcontent_enable_logging'] != 0) {
    			$denial_reason_array[] = 'Plugin fetchcontent: file does not exist for ' . $size_array[$size] . ' of PID ' . $pid . ' for user ' . $USER_DATA['user_name'] . ' (ID ' . USER_ID . ', groups ' . implode(',', $USER_DATA['groups']) . '), remote IP address: ' . $superCage->server->getRaw('REMOTE_ADDR') . $referer;
    		}
    	}
    } else { // This should never happen, as we have sanitized the $size variable before 
    	$output_denied++;
    	if ($CONFIG['plugin_fetchcontent_enable_logging'] != 0) {
    		$denial_reason_array[] = 'Plugin fetchcontent: invalid URL parameter for size for PID ' . $pid . ' for user ' . $USER_DATA['user_name'] . ' (ID ' . USER_ID . ', groups ' . implode(',', $USER_DATA['groups']) . '), remote IP address: ' . $superCage->server->getRaw('REMOTE_ADDR') . $referer;
    	}
    }
} // Another file size has been requested than the thumbnail - end

if ($output_denied != 0) { // The visitor is denied to see the image he requested
    // Write the log file
	if ($CONFIG['plugin_fetchcontent_enable_logging'] != 0) {
		foreach ($denial_reason_array as $log_record) {
			log_write($log_record);
		}
	}
    if ($CONFIG['plugin_fetchcontent_image_denied'] == '2') {
        // redirect to the image that tells the visitor he's denied access. Not implemented yet
        if ($size == 1) {
            fetchcontent_header_redirect($CONFIG['site_url'] . 'plugins/fetchcontent/images/thumb_access_denied.png');
        } else {
            fetchcontent_header_redirect($CONFIG['site_url'] . 'plugins/fetchcontent/images/normal_access_denied.png');
        }
    } elseif ($CONFIG['plugin_fetchcontent_image_denied'] == '0') {
        die; // output nothing, i.e. do nothing - results in a broken image
    } elseif ($CONFIG['plugin_fetchcontent_image_denied'] == '1') {
        fetchcontent_header_redirect($CONFIG['site_url'] . 'images/spacer.gif');
    }
}

// Write the log file if success
if ($CONFIG['plugin_fetchcontent_enable_logging'] == '2') {
	log_write('Plugin fetchcontent: output OK for ' . $size_array[$size] . ' of PID ' . $pid . ' for user ' . $USER_DATA['user_name'] . ' (ID ' . USER_ID . ', groups ' . implode(',', $USER_DATA['groups']) . '), remote IP address: ' . $superCage->server->getRaw('REMOTE_ADDR') . $referer);
}

fetchcontent_header_redirect($CONFIG['site_url'] . $fetchcontent_redirection_path, '200');


// Main code ends here

// Function definition
function fetchcontent_header_redirect($redirect, $debug_helper = '') {
    global $CONFIG;
    if ($CONFIG['plugin_fetchcontent_debug'] != '0') {
        echo $redirect;
        echo '<hr />';
        echo $debug_helper;
    } else {
        header('Location: ' . $redirect);
    }
    die;
} 
?>