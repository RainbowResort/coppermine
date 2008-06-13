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

		var  Pics = new Array();		
		var Titel = new Array();
		Titel =js_vars.Title;	
		Pics = js_vars.Pic;
		var Time = js_vars.Time;

		var j = js_vars.position;
		var p = Pics.length;
	 	var i = new Image();
		
		loadImage(Pics[j],1 );
		runSlideShow();
		
		var tempImageNumber = 1;
		
	 function loadImage (src, stateImage){ 
	 	tempImageNumber = stateImage; 
		 i.src = src;
		
 } 
 
 	function showNextSlide(){
			j = j + 1;
        	if (j > (p-1)) j=0;
		 $("#showImage").attr({ src: i.src, title: "jQuery", alt: "jQuery Logo", style: "visibility:hidden;"});
			$("#showImage").fadeIn("slow");
			$("#showImage").css('visibility','visible');
			$("#Title").html(Titel[(j-1)]);
			
		/*
	tempImageNumber = tempImageNumber +1;
			if(tempImageNumber>2) {
				tempImageNumber = 1;
			}
*/ 
			loadImage(Pics[j], tempImageNumber );
			
	}
	
	function runSlideShow(){	
		showNextSlide();
		setTimeout(runSlideShow,Time);
}

			
});
