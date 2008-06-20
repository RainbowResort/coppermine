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
  $Date: 2008-06-13 23:08:30  $
**********************************************/

/**
 * This file contains dispalyimge.php specific javascript
 */

$(document).ready(function(){

		//set variable from php  
		var Time = 		js_vars.Time;
		var j = 		js_vars.position;
		var $album = 	js_vars.album;
		var run_slideshow = js_vars.run_slideshow;
		var p = 		js_vars.Pic_count;
		
		var Title ="";
	 	var i = new Image();
		
		//called to laoadImage 
		loadImage(j);
	 	
		//start to run slideshow
		runSlideShow();
		 
		//implement ajax call to get pic url and title
	 function loadImage (j){ 	 
	 	var prev_url = "displayimage.php?ajax_show=1&pos="+j+"&album="+$album;  
			$.get(prev_url, {}, function(msg) {
				if (msg.indexOf("|") != -1) {
						splitMsg = msg.split("|");
						i.src = splitMsg[0];
						Title= splitMsg[1];
					}
			});
 }

 		// next pic view
 	function showNextSlide(i){
			j = j + 1;
        	if (j > (p-1)) j=0;
			var temp = i.src;
			
			if (temp) {
				$("#showImage").attr({
					src: i.src,
					title: "jQuery",
					alt: "jQuery Logo",
					style: "visibility:hidden;"
				});
				$("#showImage").fadeIn("slow");
				$("#showImage").css('visibility', 'visible');
				$("#Title").html(Title);
				loadImage(j);
			}
			
	}
	//set time to run slideshow 
	function runSlideShow(){	
		showNextSlide(i);
		setTimeout(runSlideShow,Time);
	}

			
});

