/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2009 Coppermine Dev Team
  v1.1 originaly written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  Coppermine version: 1.5.2
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**********************************************/

// write function to get the table serialize 
function getSerialize ()
{
    jQuery.tableDnD.currentTable = document.getElementById("album_sort");
    var bb = jQuery.tableDnD.serialize();
    return bb;
}

// write function to get the table serialize 
function getSerializePic ()
{
    jQuery.tableDnD.currentTable = document.getElementById("pic_sort");
    var bb = jQuery.tableDnD.serialize();
    return bb;
}
var Sort = {

    updateAlbum: function(albumSelectedTr)
    {
        // get aid from albumSelectedTr
        var serializeRegexp = /[^\-]*$/;
        var aid             = albumSelectedTr.match(serializeRegexp)[0];
        var form_token      = js_vars.form_token;
        var timestamp       = js_vars.timestamp;
        // get the name of the edited album value
        var editedName = $.trim($("#edit-name").val());
        // check whether null and event to edit the album
        if(editedName.length > 0){
            $("input#edit-name").hide();
            $("button#updateEvent").hide();
            $("button#updateCancel").hide();
            // loading image
            $("#loading").show();
            
        // make ajax call to update the table
        $.getJSON("delete.php?what=albmgr&aid="+aid+"&updatedname="+editedName+"&op=update&form_token="+form_token+"&timestamp="+timestamp, function(data){
            if(data['message'] == 'true') {
                // get the DOM of change album name
                editedObject = $('#'+albumSelectedTr).find('span.albumName');
                // change the text which having album name.
                $(editedObject).empty().text(editedName);
                // show user the changes
                $('#'+albumSelectedTr).css({'background-color': '#FFFFDD'});
                $("#loading").hide();
            } else {
                var error_msg = '<div class="cpg_message_validation"><h2>' + data['title'] + '</h2>' + data['description'] + '</div>';
                $('#cpg_form_album').before(error_msg);
                // empty the value
                $("#edit-name").val("");
                $("#loading").hide();
            }
        });
        
        } else {
            $("#edit-name").val("").focus();
        }

        return false;
        
    },
    addAlbum: function(cat){
        var addedName = $.trim($("#add-name").val());
        var form_token = js_vars.form_token;
        var timestamp = js_vars.timestamp;
        
        $('.cpg_message_validation').hide();
        
        // add new album check whether null and event
        if(addedName.length > 0){
            $("input#add-name").hide();
            $("button#addEvent").hide();
            $("button#cancelEvent").hide();

            // get the position of the album
            if($("#album_sort tr").length>0){
                var albumCount = 100 + $("#album_sort tr").length ;
            }else{
                var albumCount = 100 ;  
            }
            // loading image
            $("#loading").show();

            // make ajax call to add the table
            $.getJSON("delete.php?what=albmgr&cat="+cat+"&op=add&position="+albumCount+"&name="+addedName+"&form_token="+form_token+"&timestamp="+timestamp, function(data){

                if(data['message'] == 'true'){
                    //check if we have a table already
                    if($.trim($('div#sort').html()) == ''){
                        //create the table
                        $('div#sort').html('<table id="album_sort" cellspacing="0" cellpadding="0" border="0"></table>');
                    }
                    
                    var album_tr = '<tr id="sort-'+data['newAid']+'" ><td class="dragHandle"></td><td class="album_text" width="96%"><span class="albumName">'+addedName+'</span><span class="editAlbum">'+js_vars.lang_edit+'</span></td></tr>';
                    $("#album_sort").append(album_tr);
                    // call the function to add the new TR on more action
                    jQuery.tableDnD.currentTable = document.getElementById("album_sort");
                    jQuery.tableDnD.makeDraggable(jQuery.tableDnD.currentTable);
                    // to empty the box value
                    Sort.addRowColors();
                    // empty the value
                    $("#add-name").val("");
                    $("#loading").hide();
                }else{
                    var error_msg = '<div class="cpg_message_validation"><h2>' + data['title'] + '</h2>' + data['description'] + '</div>';
                    $('#cpg_form_album').before(error_msg);
                    // empty the value
                    $("#add-name").val("");
                    $("#loading").hide();
                }
            });
        }else{
            $("#add-name").val('').focus();
        }

        return false;
    },

    // styles to album list
    addRowColors: function(){
        jQuery("#album_sort").addClass("tableb");
        jQuery("#album_sort tr:even").removeClass("tableb_alternate");
        jQuery("#album_sort tr:odd").addClass("tableb_alternate");
    },

    // show the message
    showMessage: function(){
        $('#submit_reminder').fadeIn('slow');
        $('#apply').show();
    },

    // Disable Form Submit on Enter Key Press
    // code: http://www.bloggingdeveloper.com/post/Disable-Form-Submit-on-Enter-Key-Press.aspx
    disableEnterKey: function(e){
         var key;     
         if(window.event)
              key = window.event.keyCode; //IE
         else
              key = e.which; //firefox
         return (key != 13);
    }
};

// this jquery.tablednd is to drag and drop to sort images
jQuery(document).ready(function(){
    // get the lang variable to js file
    var change_album    = js_vars.change_album;
    var confirm_modifs  = js_vars.confirm_modifs;
    // to hold the selected photo object
    var photoSelectedObject = null;
    // to hold the selected photo color
    var photoselectedColor  = null;
    // album changes option (whether ok or not to change the albums)
    var albumSelectOption   = true;

    //jQuery("#pic_sort").tableDnD();
    // styles to photo list
    function addRowColorsPhoto(){
        jQuery("#pic_sort").addClass("tableb");
        jQuery("#pic_sort tr:even").removeClass("tableb_alternate");
        jQuery("#pic_sort tr:odd").addClass("tableb_alternate");
    }
    addRowColorsPhoto();
    // add query to input hidden when drop the pic item
    $('#pic_sort').tableDnD({
        onDrop: function(table, row) {
            // call the getSerializePic() function to get query
            $("#picture_order").val(getSerializePic());
            // set to category changes don't select if you have changed
            albumSelectOption = false;  
        }
    });

    //highlight the album onclick event
    $("#pic_sort tr").livequery('mousedown click', function() {
        // assign the last color to TR object and remove the selected class having selected last object
        $(photoSelectedObject).css("background-color", photoselectedColor);
        $(photoSelectedObject).removeClass("selected");
        // add the selected class to currently-selected object
        $(this).addClass("selected");
        // add the selected color to variable selectedColor
        photoselectedColor = $(this).css("background-color");
        // alert(selectedColor)
        $(this).css("background-color", "#E0ECFF");
        // $('button#up_click, button#down_click, button#delete_album, button#modify_album, button#editfiles_album, button#thumbnail_album').removeAttr("disabled");
        $('button#pic_up, button#pic_down').removeAttr("disabled");
        // $('button#pic_down').hide();
        // set current selected item in the album
        photoSelectedObject = this;
    });

    // sort items using up and down arrows
    $("button#pic_up").click(function(){
        if(photoSelectedObject){
            // sort manually upwards
            jQuery.tableDnD.sortManually(-1,photoSelectedObject,'pic_sort');
            // after one click event called to doChanges function
            $("#picture_order").val(getSerializePic());  
            // set to album changes don't select if you have changed
            albumSelectOption = false;
            // show the message to save changes
            Sort.showMessage();
        }
    });
    $("button#pic_down").click(function(){
        if(photoSelectedObject){
            // sort manually downwards
            jQuery.tableDnD.sortManually(1,photoSelectedObject,'pic_sort');
            // after one click event called to doChanges function
            $("#picture_order").val(getSerializePic());
            // set to album changes don't select if you have changed
            albumSelectOption = false;
            // show the message to save changes
            Sort.showMessage();
        }
    });

    // when user changes the album name if user has done some changes to the current album name then let's use known
    $("select[name='aid']").change(function(){
        var getSelectedOption = $(this).val();
        if(!albumSelectOption){
            if(confirm(change_album)){
                window.location.href = ("picmgr.php?aid="+getSelectedOption);
                return true;
            }else{
                // will not load a page
                return false;
            }
        }else{
            // load a page itself without any confirmation alert
            window.location.href = ("picmgr.php?aid="+getSelectedOption);
        }
    }); 

    // load the form when click the submit button
    $("#cpgformPic").submit(function () { 

        $("#picture_order").val(getSerializePic());
        var a = $("input[name='picture_order']").attr("value");

        if(a.length > 0){
            if(confirm(confirm_modifs)) {
                return true;
            }
        }
        return false; 
    }); // so it won't submit

});


// this jquery.tablednd is to drag and drop sort albums
jQuery(document).ready(function() {
    // Get messages to the javascript file
    var confirm_modifs  = js_vars.confirm_modifs;
    var confirm_delete  = js_vars.confirm_delete;
    var dontDelete      = js_vars.dontDelete;
    var category_change = js_vars.category_change;
    var page_change     = js_vars.page_change;
    var category        = js_vars.category;

    // variables to handle the events
    var object_edit =   null;
    var event       =   null;
    // assign variable to hold the selected TR object
    var albumObjectSelectedTr   = null;
    // assign variable to hold the selected TR id
    var albumSelectedTr         = null;
    // assign variable to hold the color of selected TR object
    var selectedColor           = null;
    // category changes option (whether ok or not to change the category)
    var categorySelectOption    = true;

    // addRowColors when document ready state
    Sort.addRowColors();

    // If new TR object is added then input text field will ready to type album names
    $("#add_new_album").click(function(){
        // when edit box is visible then just hide to show add box
        $("input#edit-name").hide();
        $("button#updateEvent").hide();
        $("button#updateCancel").hide();
        $("input#add-name").show();
        $("button#addEvent").show();
        $("button#cancelEvent").show();
        $("#add-name").focus().val();
        event = 'addAlbumButton';
    });

    // Cancel when user doesn't want to add the album to the list
    $(".album_cancel").click(function(){
        $("input#edit-name").hide();
        $("button#updateEvent").hide();
        $("button#updateCancel").hide();
    });
    
    // Cancel when user doesn't want to add the album to the list
    $(".add_cancel").click(function(){
        $("input#add-name").hide();
        $("button#addEvent").hide();
        $("button#cancelEvent").hide();
    });        

    // make visible the edit link when user edits the album name
    $("#album_sort tr").livequery('mouseover', function () {
        $(this).find("span:last").show();   
    }).livequery('mouseout', function(){
        $(this).find("span:last").hide();
    }).livequery('mousedown click', function() {
        // addRowColors();
        // assign the last color to TR object and remove the selected class having the selected last object
        $(albumObjectSelectedTr).css("background-color", selectedColor);
        $(albumObjectSelectedTr).removeClass("selected");
        // add the slected class to the currently-selected object
        $(this).addClass("selected");
        // add the selected color to variable selectedColor
        selectedColor = $(this).css("background-color");
        //alert(this);
        $(this).css("background-color", "#E0ECFF");
        $('button#up_click, button#down_click, button#delete_album, button#modify_album, button#editfiles_album, button#thumbnail_album').removeAttr("disabled");
        $('button#pic_up, button#pic_down').show();
        // set current selected item in the album
        albumObjectSelectedTr = this;
    });


    // now user can edit the album name contain list
    $(".editAlbum").livequery("click", function(){
        // selected item's text put into the input field
        object_edit     = $(this).prev().text();
        albumSelectedTr = $(this).parents("tr").attr("id");
        // first hide the add box
        $("input#add-name").hide();
        $("button#addEvent").hide();
        $("button#cancelEvent").hide();
        $("input#edit-name").show();
        $("button#updateEvent").show();
        $("button#updateCancel").show();
        $("#edit-name").val(object_edit).focus();

    });

    // Now update the album name
    $("#updateEvent").click(function(){
        // call to updateAlbum function
        Sort.updateAlbum(albumSelectedTr);
        return false;
    });

    // Bind the keypress event to album title edit box
    $("#edit-name").keyup(function(e) {
        // If the pressed key is ENTER then call saveEvent function and return false so that form is not submitted
        if (e.which == 13 || e.keyCode == 13) {
            Sort.updateAlbum(albumSelectedTr);
            return false;
        }
    });

    // Now add a album to the list
    $("#addEvent").livequery('click', function(){
        if(!isNaN(category)){
            Sort.addAlbum(category);
        }
        return false;
    });

    // Bind the keypress event to album title edit box
    $("#add-name").keyup(function(e) {
        // If the pressed key is ENTER then call saveEvent function and return false so that form is not submitted
        if (e.which == 13 || e.keyCode == 13) {
            $("cpg_form_album").submit(function(){
                return false;
            });
            if(!isNaN(category)){
                Sort.addAlbum(category);
                return false;
            }
        }

    });

    // delete the selected TR object item
    $("button#delete_album").livequery('click', function(){
        // if there isn't a TR object selected, then can't delete
        if(!albumObjectSelectedTr){
            alert(dontDelete);
            return false;
        }
        // get aid from albumSelectedTr
        var albumTrId       = $(albumObjectSelectedTr).attr("id");
        var serializeRegexp = /[^\-]*$/;
        var aid             = albumTrId.match(serializeRegexp)[0];
        var form_token      = js_vars.form_token;
        var timestamp       = js_vars.timestamp;

        if(confirm(confirm_delete)) {
            window.location.href = ("delete.php?what=albmgr&op=delete&deleteAid="+aid+"&cat="+category+"&form_token="+form_token+"&timestamp="+timestamp);
            return true;
        }else{
            return false;
        }

    }); 

    // album links: album properties, edit files, thumbnail view
    $('button#modify_album,button#editfiles_album,button#thumbnail_album').livequery('click', function(){
        // if there isn't a TR object selected, then nothing to do
        if(!albumObjectSelectedTr){
            return false;
        }
        // get aid from albumSelectedTr
        var albumTrId       = $(albumObjectSelectedTr).attr("id");
        var serializeRegexp = /[^\-]*$/;
        var aid             = albumTrId.match(serializeRegexp)[0];
        var album_link      = '';

        if ($(this).attr("id") == 'modify_album') {
            album_link = "modifyalb.php?album="+aid;
        } else if ($(this).attr("id") == 'editfiles_album') {
            album_link = "editpics.php?album="+aid;
        } else if ($(this).attr("id") == 'thumbnail_album') {
            album_link = "thumbnails.php?album="+aid;
        } else {
            return false;
        }
        if(!categorySelectOption){
            if(confirm(page_change)) {
                window.location.href = album_link;
                return true;
            } else {
                return false;
            }
        } else {
            window.location.href = album_link;
        }

    }); 

    // after drag and drop assign changes to the TR title
    $('#album_sort').tableDnD({
        onDrop: function(table, row) {
            $("#album_order").val(getSerialize());
            // set to category changes don't select if you have changed
            categorySelectOption = false;    
        }    
    });

    //sort items using up and down arrows
    $("#up_click").click(function(){
        if(albumObjectSelectedTr){
            // sort manually upwards
            jQuery.tableDnD.sortManually(-1,albumObjectSelectedTr,'album_sort');
            // after one click event called to doChanges function
            $("#album_order").val(getSerialize());   
            // set to category changes don't select if you have changed
            categorySelectOption = false;
            // show the message to save changes
            Sort.showMessage();
        }
    });  

    //sort items using up and down arrows
    $("#down_click").click(function(){
        if(albumObjectSelectedTr){
            // sort manually downwards
            jQuery.tableDnD.sortManually(1,albumObjectSelectedTr,'album_sort');
            // after one click event called to doChanges function
            $("#album_order").val(getSerialize());        
            // set to category changes don't select if you have changed
            categorySelectOption = false; 
            // show the message to save changes
            Sort.showMessage();
        }          
    });

    // load the form when click the submit button
    $("#cpg_form_album").submit( "click", function () {          
        var a = $("input[name='album_order']").attr("value");
        if(a.length > 0){
            if(confirm(confirm_modifs)) {
                return true;
            }
        }
        return false; 
    }); // so it won't submit

    // when user changes the category, alert user if there are unsaved changes
    $("select[name='cat']").change(function(){
        var getSelectedOption = $(this).val();
        if(!categorySelectOption){
            if(confirm(category_change)){
                window.location.href = ("albmgr.php?cat="+getSelectedOption);
                return true;
            }else{
                // will not load a page
                return false;
            }
        }else{
            // load a page itself without any confirmation alert
            window.location.href = ("albmgr.php?cat="+getSelectedOption);
        }
    });

});

