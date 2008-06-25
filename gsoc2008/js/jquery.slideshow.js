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
		
		if(length.run_slideshow!=0){
		loadImage(j+1);
		}
		 
		//implement ajax call to get pic url and title
	 function loadImage (j){ 	 
	 
	  $.getJSON("displayimage.php?ajax_show=1&pos="+j+"&album="+$album,
            function(data){
				i.src = data['url'];
				Title = data['title'];
              }); 
			}
		runSlideShow(i);
 		// next pic view
 	function showNextSlide(i){
			j = j + 1;
        	if (j > (p-1)) j=0;
			var temp = i.src;
			
			if (temp) {
				$("#showImage").attr({
					src: i.src,
					title: Title,
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
	
	$(".navmenu").click(function () { 
     self.document.location = 'displayimage.php?album='+$album+'&pos='+j;
    });
		
});

