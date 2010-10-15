<?php
/**************************************************
  Coppermine 1.5.x Plugin - remote_videos
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

$superCage = Inspekt::makeSuperCage();
$album = $superCage->post->getInt('album');

if (remote_videos_upload_permission($album)) {

    // check if url is supported and extension is enabled for upload
    $extension = "";
    foreach (remote_videos_get_hoster() as $key => $value) {
        if (is_numeric(strpos($superCage->post->getAlpha('url'), $key))) {
            $extension = $key;
            break;
        }
    }
    if ($extension == "" || !is_numeric(strpos($CONFIG['allowed_mov_types'], $extension))) {
        cpg_die(ERROR, 'file extension', __FILE__, __LINE__);
    }

    // CHECK IF IT'S POSSIBLE TO CREATE THE FILE TEMPORARY ON THE SERVER AND THEN SUBMIT IT TO THE UPLOAD FORM!
    
    // check if quota is exceeded
    // generate file name by hoster video id + extension
    // check if file exists
    // check if directory exists (try to create if not exists)
    // file_put_contents to appropriate userpics directory
    // create message "uploaded successfully"
    // redirect to uploaded file & show message
    echo "Upload... (TODO)";
} else {
    cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
}

?>