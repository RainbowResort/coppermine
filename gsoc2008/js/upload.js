
/**this Upload function to control the upload form events*/
var Upload = {  

	/**submit all the data to the upload.php*/
	sumbitForm: function()
	{
		return false;
	}
	,
	
	disableFrom: function(currentFromNumber)
	{
	/**disable the input fields*/	
		$('#form_'+currentFromNumber+' .listbox').attr({disabled: 'disabled'});
		$('#form_'+currentFromNumber+' .filebox').attr({disabled: 'disabled'});
		$('#form_'+currentFromNumber+' .title').attr({disabled: 'disabled'});
		$('#form_'+currentFromNumber+' .textinput').attr({disabled: 'disabled'});
		$('#form_'+currentFromNumber+' .serachUp').attr({disabled: 'disabled'});
		$('#uploadAdd').attr({disabled: 'disabled'});
		
		return true;
	},
	
	disableUrlForm: function(currentUrlNumer){
		/**sisable the Url form input fields*/
		$('#formUrl_'+currentUrlNumer+' .listbox').attr({disabled: 'disabled'});
		$('#formUrl_'+currentUrlNumer+' .url').attr({disabled: 'disabled'});
		$('#formUrl_'+currentUrlNumer+' .title').attr({disabled: 'disabled'});
		$('#formUrl_'+currentUrlNumer+' .textinput').attr({disabled: 'disabled'});
		$('#formUrl_'+currentUrlNumer+' .serachUp').attr({disabled: 'disabled'});
		
		return true;	
	},
	
	changeSubmit: function()
	{
		/**change the submit button now*/
		$('#SumbitButton').hide();
		$('#uploadingImage').hide();
		$('#SaveEntryContainer').show();
		
	
	},
	
	getThumbPath: function(ThumbArray)
	{
		/**split the thumb images path to view*/
		var words = ThumbArray.split('@');
		var thumbPrevHtml	= "";
		
		var result = [];
		$.each(words, function(i, value) {
			if ( $.trim(value) )
				result[i] = $.trim(value);
				thumbPrevHtml += "<img class=\"image\" src=\""+result[i]+"\"  />";
		});
		return thumbPrevHtml;
	},
	
	setThumbImages: function(ThumbContent)
	{
		/**put thumb images on store_container*/
		var thumbPrevHtml	= 'You have Uploaded follwing files successfully!';
		$('#emptyEntry').text(thumbPrevHtml);
		$("#store_container > *").remove();
		$("#store_url_container > *").remove();
		$('#store_container').append(ThumbContent);
		return true;
	}, 
	
	getFileName: function(path)
	{
		var fn = path.match(/\/([a-z0-9_-]+\.\w+)$/gi);
		return (fn == null)? "" : fn[fn.length-1];
	}

};


/**main controller of the events of uploadding*/
$(document).ready(function(){
	 
	/**varibles for files uploading*/
	var maxFiles 	= js_vars.maxFiles;
	var fileCount	= 0;
	var formNumber 	= 0;
	
	/**varibles for Urls uploading*/	
	var maxUrls		= js_vars.maxUrls;
	var urlCount	= 0;
	var urlFormNumber = 0;
	
	/**keeping hold the states of upload areas whether upload file area or upload URL area*/
	var areaState 	= 'file';
	/**get alubm hmtl*/
	var albumHtml = js_vars.albumForm;
	/**get urlform HTML*/
	var albumUrlHtml = js_vars.albumUrlForm;
	
		
	//	alert(albumHtml);
	$('.mainForm').empty();	
	albumHtmlClone		=	"<div id='form_"+formNumber+"' class='albumForm'>"+ albumHtml + "</div>";
	$('.mainForm').append(albumHtmlClone);
	
	//palce the urls form "UrlForm"
	$('.UrlForm').empty();	
    albumUrlHtmlClone	=	"<div id='formUrl_"+urlFormNumber+"' class='albumForm'>"+ albumUrlHtml + "</div>";
	$('.UrlForm').append(albumUrlHtmlClone);
		
	/**hide the UrlForm at frist time*/
	$('.UrlForm').hide();
	/**Upload form navigation form show*/
	$('.Nvi_bk').show();
	/**upload available box show*/
	$('.availableBox').show();
	/**Uplaod page loding states*/
	$('table#storeFile').show();
	/**remove the hidden action field*/
	$('input[name="action"]').remove();
		if($('input[name="action"]').val() != null)
		{
			$('input[name="action"]').remove();
		}
	
	/**agin remove if there is hidden file named album*/
	$('input[name="album"]').remove();
		if($('input[name="album"]').val() != null)
		{
			$('input[name="album"]').remove();
		}
	
	
	/**here we can hide or show the upload file area or upload URL area*/
	$('#fileUploadNvi').livequery('click',function()
	{
		$('.mainForm').show();
		$('.UrlForm').hide();
		
		//change the available box
		$('#fileAvailable').show();
		$('#urlAvailable').hide();
		
		//menu highlight
		$(this).removeClass().addClass('currentUp');
		$('#urlUploadNvi').removeClass().addClass('uploadNvi');
		
		//change the save button
		$('#uploadAdd').removeClass().addClass('FileUpoadAdd').removeAttr('val').attr({ value :"Add File" });
		/*now we are going to upload files*/
		areaState = 'file';			
	});
	
	//URL area show 
	$('#urlUploadNvi').livequery('click',function()
	{
		$('.UrlForm').show();
		$('.mainForm').hide();
		
				//change the available box
		$('#urlAvailable').show();
		$('#fileAvailable').hide();
		
		//menu highlight
		$(this).removeClass().addClass('currentUp');
		$('#fileUploadNvi').removeClass().addClass('uploadNvi');
		
		//change add button class
		$('#uploadAdd').removeClass().addClass('UrlUpoadAdd').removeAttr('val').attr({ value :"Add Url" });
		/*now we are going to upload URLs*/
		areaState = 'url';			
	});

	/**store file data into the File upload box*/
	$(".FileUpoadAdd").livequery('click',function()
	{
 		//check whether we have used max number of file upload, if then operation stop and give alert message./
  		if(fileCount >= maxFiles)
  		{
  			alert("You have used Maximum number of file uploads, so have to submit");
  			return false;
  		}
  		
		//	var getAlbumName = null;
		var getAlbumName = $('#form_'+formNumber+' .listbox').attr("value");		
		/**get file name which going to be upload*/
		var getFileName = $('#form_'+formNumber+' .filebox').attr("value");
	
 			if(!getAlbumName)
			{
 				alert("You have to select album before adding file");
 				return false;
 			}
			  			
 			if(!getFileName)
 			{
				alert("you have to select file to upload");
				return false;
			} 			

			/**stroe the files data temparily on the hidden field*/
			if(getFileName)
			{
				/**add the save data and apparing at the Stored file data*/
				/**Insert HTML variables */
						var
							storeContainer 	= $('#store_container'),
							fileList 		= $('<div class="photo_list"></div>'),
							fileAttribute	= $('<span class="file" id="'+formNumber+'">'+getFileName.match(/[^\/\\]+$/gi)[0]+'</span>'),
						//	fileEdit		 = $('<INPUT type="button" value="[ edit ]" class="photo_edit_button">');
							fileClose		 = $('<INPUT type="button" value="[ X ]" class="photo_list_button">');
				/**insert to the HTML*/
					storeContainer.append(fileList);
					fileList.append(fileAttribute,'&nbsp; <br />', fileClose);

				var getCurrentAlbum = $('#form_'+formNumber+' .listbox').val();
				/**hide added input form and show new form */	
				$("#form_"+formNumber).hide();
									
				/**increase by one in files count*/ 
				formNumber ++;
				fileCount ++;
			
				albumHtmlClone	=	"<div id='form_"+formNumber+"' class='albumForm'>"+ albumHtml + "</div>";
				$('.mainForm').append(albumHtmlClone);
				$('#form_'+formNumber+' .listbox option[value="'+getCurrentAlbum+'"]').attr({selected: 'selected'});
				/**decrese the number of files to having upload*/
				$("input[name='added_files']").val(maxFiles-fileCount);
				
				/**remove the empty message*/
			$("#emptyEntry").empty();
			/**close the file upload box*/
		//	$("#AddFile").hide();	
			}

		return false;	
	});
	
	/**store file data into the Urls upload box*/
	$('.UrlUpoadAdd').livequery('click', function()
	{
		//check whether we have used max number of file upload, if then operation stop and give alert message./
  		if( urlCount >= maxUrls)
  		{
  			alert("You have used Maximum number of Urls uploads, so have to submit");
  			return false;
  		}
  		
		//	var getAlbumName = null;
		var getUrlAlbumName = 	$('#formUrl_'+urlFormNumber+' .listbox').attr("value");		
		/**get file name which going to be upload*/
		var getUrlName 		= 	$('#formUrl_'+urlFormNumber+' .url').attr("value");

 			if(!getUrlAlbumName)
			{
 				alert("You have to select album before adding Urls");
 				return false;
 			}
			  			
 			if(!getUrlName)
 			{
				alert("you have to select Urls to upload");
				return false;
			} 			

			/**stroe the URL data temparily on the hidden field*/
			if(getUrlName)
			{
				/**add the save data and apparing at the Stored urls data*/
				/**Insert HTML variables */
						var
							storeContainer 	= $('#store_url_container'),
							fileList 		= $('<div class="photo_list"></div>'),
							fileAttribute	= $('<span class="file" id="'+urlFormNumber+'">'+getUrlName+'</span>'),
						//	fileEdit		 = $('<INPUT type="button" value="[ edit ]" class="photo_edit_button">');
							fileClose		 = $('<INPUT type="button" value="[ X ]" class="url_list_button">');
				/**insert to the HTML*/
					storeContainer.append(fileList);
					fileList.append(fileAttribute,'&nbsp; <br />', fileClose);

				var getCurrentAlbum = $('#formUrl_'+urlFormNumber+' .listbox').val();
				/**hide added input form and show new form */	
				$("#formUrl_"+urlFormNumber).hide();
									
				/**increase by one in files count*/ 
				urlFormNumber ++;
				urlCount ++;
			
				albumUrlHtmlClone	=	"<div id='formUrl_"+urlFormNumber+"' class='albumForm'>"+ albumUrlHtml + "</div>";
				$('.UrlForm').append(albumUrlHtmlClone);
				
				$('#formUrl_'+urlFormNumber+' .listbox option[value="'+getCurrentAlbum+'"]').attr({selected: 'selected'});
				/**decrese the number of files to having upload*/
				$("input[name='added_urls']").val(maxUrls - urlCount);
				
				/**remove the empty message*/
			$("#emptyEntry").empty();
			/**close the file upload box*/
		//	$("#AddFile").hide();	
			}

		return false;	
	});
	
	/**delete the file which user need*/
	$("input.photo_list_button").livequery('click', function()
	{
		var getRemovedFileId = $(this).prev().prev().attr("id");
			/**remove the file informaiton lable and input file field*/
			$(this).parent().remove();
			$("#form_"+getRemovedFileId).remove();
			/**handle count varialbes*/
			fileCount --;
			/**show the empty file message*/
			if(fileCount==0){
				$("#emptyEntry").text("You have Empty files saved!");
			}
			$("input[name='added_files']").val(maxFiles-fileCount);
	});
	
	/**delete URLs which user needs*/
	$("input.url_list_button").livequery('click', function()
	{
		var getRemovedFileId = $(this).prev().prev().attr("id");
			/**remove the URL informaiton lable and input file field*/
			$(this).parent().remove();
			$("#formUrl_"+getRemovedFileId).remove();
			/**handle count varialbes*/
			urlCount --;
			/**show the empty file message*/
			if(fileCount == 0 && urlCount == 0){
				$("#emptyEntry").text("You have Empty files saved!");
			}
			$("input[name='added_urls']").val(maxUrls-urlCount);
	});
	/**this variable keeping hold unique_ID after uploading files */
	var getUnique_ID	= 	null;
	var getThumbImage	= 	null;
	
	/**this is loading the form to upload files*/	
		var options = {         
		//target:        	'#output1',
		url				:	'upload.php?action=1',
		beforeSubmit	:	setUploading, 
        success			:	compleate,
        dataType		:  'json'
  
		}
        
        /*give loading message*/        
        function setUploading(){
        	/*uploading message*/
        	$('#SumbitButton').hide();
        	$('#uploadingImage').show();
          return true; 
		}
		
		/*inform upload complete*/
		function compleate(data){
			/*Complete message*/
			getUnique_ID	= data.JId;
			getThumbImage	= data.thumbPrev;
			
			/**set hidden variable to*/			
			$("input[name='unique_ID']").val(getUnique_ID);
			/**return the thumb images URLs*/
			getThumbImage 	= Upload.getThumbPath(getThumbImage);
			/**add this thumb images to store_container*/
			if(getThumbImage != null){
				Upload.setThumbImages(getThumbImage);
			} 
			//var message = "Upload Complete.";
			//$('span.message').empty().text(message);
			
			/**change the submit button to save entry*/
			Upload.changeSubmit();
		//	Upload.sumbitForm();
		}
		
        $("input[name='Continue']").click(function() {
        /**if there is no nay file in the page don't submit form*/
		if(fileCount==0 && urlCount==0){
			return false;
		}
		/**now disable the new form_n, cannot add more file untill save this files*/
		if(!Upload.disableFrom(formNumber)){
			return false;
		}
		
		/**now disble the new formUrl_n, cannot add more file untill save this feilds*/
		if(!Upload.disableUrlForm(urlFormNumber)){
			return false;
		}
        // inside event callbacks 'this' is the DOM element so we first 
        $('#cpgform').ajaxSubmit(options); 
        // always return false to prevent standard browser submit and page navigation 
		return false;
    }); 
    
    	$('#SaveEntry').click(function(){
    		$get = 	$("input[name='unique_ID']").attr('value');	
			if($get){
				$('#cpgform').submit();
			}
			//$('#cpgform').ajaxSubmit(options); 		
		});
      //
});


