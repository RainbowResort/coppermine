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
  $HeadURL$
  $Revision: 4220 $
  $LastChangedBy: Nuwan Sameera $
  $Date: 2008-12-13 23:08:30  $
**********************************************/

/**
 * This file contains dispalyimge.php specific javascript
 */


$(document).ready(function(){

		/** set variable from php  */
		var Time 	= 	js_vars.Time;
		var pos 	= 	js_vars.position;
		var album 	= 	js_vars.album;
		var PiCount = 	js_vars.Pic_count;
		var Pid		=   js_vars.Pid;
		var run_slideshow = js_vars.run_slideshow;
		var Title 	=	"";

		/** create a Image object */
	 	var i = new Image();
	 
		/** implement ajax call to get pic url and title */
	 	function loadImage (j){	 
	  	$.getJSON("displayimage.php?ajax_show=1&pos="+j+"&album="+album, function(data){
				i.src 	= data['url'];
				Title 	= data['title'];
				Pid		= data['pid'];
              }); 
			}
		/** start the slideshow */
		if(PiCount>1) runSlideShow();
 		/**  next pic view and keeping hold the previous pitcure ID */
 		var PidTemp = '';
 		function showNextSlide(i){
				pos = parseInt(pos) + 1;
        	if (pos  == (PiCount)){ pos=0; }
			var temp = i.src;
			
			if (temp.length>0) {
				$("#showImage").attr({
					src: i.src,
					title: Title,
					alt: "jQuery Logo",
					style: "visibility:hidden;"
				}).fadeIn("slow");
				
				$("#showImage").css('visibility', 'visible');
				$("#Title").html(Title);
				/** set Pid to temp */
				PidTemp = Pid; 
				loadImage(pos);
			}	
			else{
				loadImage(pos);
			}
	}
	
	/** set time to run slideshow */
	function runSlideShow(){
		showNextSlide(i);
		setTimeout(runSlideShow,Time);
	}
	
	/** close the slide show and will load the current show imags details*/
	$(".navmenu").click(function () { 
     self.document.location = 'displayimage.php?album='+album+'&pid='+PidTemp ;
    });
		
});


