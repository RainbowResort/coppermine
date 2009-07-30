/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2009 Coppermine Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  Coppermine version: 1.5.2
  $HeadURL$
  $Revision: 6120 $
  $LastChangedBy: gaugau $
  $Date: 2009-06-09 11:34:53 +0530 (Tue, 09 Jun 2009) $
**********************************************/

var swfu;
var button_enabled_style;
var button_disabled_style;
var notify_upload = false; // Flag to be used for sending notification request

SWFUpload.onload = function () {
    var settings = {
        flash_url : "js/swfupload/swfupload.swf",
        upload_url: js_vars.site_url + "/upload.php",    // Relative to the SWF file
        post_params: {"process" : "1", "user" : js_vars.user},
        file_size_limit : "100 MB",
        file_types : "*.*", //js_vars.allowed_file_types,
        file_types_description : js_vars.lang_upload_swf_php.all_files,
        custom_settings : {
            progressTarget : "upload_progress",
            cancelButtonId : "button_cancel"
        },
        debug: false,

        // Button settings
        button_width: "130",
        button_height: "20",
        button_image_url: "images/browse_swf.png",
        button_placeholder_id: "browse_button_place_holder",
        button_text: '<span id="browse_button" class="browse">' + js_vars.lang_upload_swf_php.browse + '</span>',
        button_text_style: button_disabled_style,
        button_text_left_padding: 30,
        // By default browse button will be disabled. It will get enabled when some album is chosen
        button_disabled : true,

        // The event handler functions are defined in handlers.js
        file_queued_handler : fileQueued,
        file_queue_error_handler : fileQueueError,
        //file_dialog_start_handler : fileDialogStart,
        file_dialog_complete_handler : fileDialogComplete,
        upload_start_handler : uploadStart,
        upload_progress_handler : uploadProgress,
        upload_error_handler : uploadError,
        upload_success_handler : uploadSuccess,
        upload_complete_handler : uploadComplete,
        queue_complete_handler : queueComplete,    // Queue plugin event
        swfupload_loaded_handler : swfUploadLoaded,
        // SWFObject settings
        minimum_flash_version : "9.0.28",
        swfupload_pre_load_handler : swfUploadPreLoad,
        swfupload_load_failed_handler : swfUploadLoadFailed
    };

    swfu = new SWFUpload(settings);

    // Bind a change event on album drop down
    $("select[name='album']").change(function() {
        // Enable the browse button only if some album is selected
       if ($(this).val()) {
           swfu.setButtonDisabled(false);
           // Set the button style to enabled
           swfu.setButtonTextStyle(button_enabled_style);
       } else {
           // If no album is selected then disable the browse button
           swfu.setButtonDisabled(true);
           // Set the button style to disabled
           swfu.setButtonTextStyle(button_disabled_style);
       }
    });
}

function continue_upload() {
    window.location = js_vars.site_url + '/editpics.php?album=' + $("select[name='album']").val();
    return false;
}