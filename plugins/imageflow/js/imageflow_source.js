/**************************************************
  Coppermine 1.5.x Plugin - Imageflow
  *************************************************
  Copyright (c) 2010 Timo Schewe (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/branches/cpg1.5.x/plugins/imageflow/codebase.php $
  $Revision: 7015 $
  $LastChangedBy: timoswelt $
  $Date: 2010-01-07 19:10:40 +0100 (Do, 07. Jan 2010) $
  **************************************************/

/**
 *	ImageFlow 0.9
 *
 *	This code is based on Michael L. Perrys Cover flow in Javascript.
 *	For he wrote that "You can take this code and use it as your own" [1]
 *	this is my attempt to improve some things. Feel free to use it! If
 *	you have any questions on it leave me a message in my shoutbox [2].
 *
 *	The reflection is generated server-sided by a slightly hacked  
 *	version of Richard Daveys easyreflections [3] written in PHP.
 *	
 *	The mouse wheel support is an implementation of Adomas Paltanavicius
 *	JavaScript mouse wheel code [4].
 *
 *	Thanks to Stephan Droste ImageFlow is now compatible with Safari 1.x.
 *
 *
 *	[1] http://www.adventuresinsoftware.com/blog/?p=104#comment-1981
 *	[2] http://shoutbox.finnrudolph.de/
 *	[3] http://reflection.corephp.co.uk/v2.php
 *	[4] http://adomas.org/javascript-mouse-wheel/
 */



var cpgif_auto = 1;
var cpgif_autotime = 4;
var cpgif_usewheel = 1;
var cpgif_usekeys = 1;


/* Configuration variables */
var cpgif_conf_reflection_p = 0.4;         // Sets the height of the reflection in % of the source image 
var cpgif_conf_focus = 3;                  // Sets the numbers of images on each side of the focussed one
var cpgif_conf_slider_width = 14;          // Sets the px width of the slider div
var cpgif_conf_images_cursor = 'pointer';  // Sets the cursor type for all images default is 'default'
var cpgif_conf_slider_cursor = 'default';  // Sets the slider cursor type: try "e-resize" default is 'default'

/* Id names used in the HTML */
var cpgif_conf_imageflow = 'imageflow';    // Default is 'imageflow'
var cpgif_conf_loading = 'imgflowloading';        // Default is 'loading'
var cpgif_conf_images = 'imgflowimages';          // Default is 'images'
var cpgif_conf_captions = 'imgflowcaptions';      // Default is 'captions'
var cpgif_conf_scrollbar = 'imgflowscrollbar';    // Default is 'scrollbar'
var cpgif_conf_slider = 'imgflowslider';          // Default is 'slider'

/* Define global variables */
var cpgif_caption_id = 0;
var cpgif_new_caption_id = 0;
var cpgif_current = 0;
var cpgif_target = 0;
var cpgif_mem_target = 0;
var cpgif_timer = 0;
var cpgif_array_images = new Array();
var cpgif_new_slider_pos = 0;
var cpgif_dragging = false;
var cpgif_dragobject = null;
var cpgif_dragx = 0;
var cpgif_posx = 0;
var cpgif_new_posx = 0;
var cpgif_xstep = 150;


// add event to window.onload
function cpgif_addLoad(cpgif_func) { var cpgif_oldonload = window.onload; if (typeof window.onload != 'function') { window.onload = cpgif_func; } else { window.onload = function() { if (cpgif_oldonload) { cpgif_oldonload(); } cpgif_func(); }; } }


function cpgif_step()
{
	switch (cpgif_target < cpgif_current-1 || cpgif_target > cpgif_current+1) 
	{
		case true:
			cpgif_moveTo(cpgif_current + (cpgif_target-cpgif_current)/3);
			window.setTimeout(cpgif_step, 50);
			cpgif_timer = 1;
			break;

		default:
			cpgif_timer = 0;
			break;
	}
}

function cpgif_glideTo(cpgif_x, cpgif_new_caption_id)
{	
	/* Animate gliding to new x position */
	cpgif_target = cpgif_x;
	cpgif_mem_target = cpgif_x;
	if (cpgif_timer == 0)
	{
		window.setTimeout(cpgif_step, 50);
		cpgif_timer = 1;
	}
	
	/* Display new caption */
	cpgif_caption_id = cpgif_new_caption_id;
	cpgif_caption = cpgif_img_div.childNodes.item(cpgif_array_images[cpgif_caption_id]).getAttribute('alt');
	if (cpgif_caption == '') cpgif_caption = '&nbsp;';
	cpgif_caption_div.innerHTML = cpgif_caption;

	/* Set scrollbar slider to new position */
	if (cpgif_dragging == false)
	{
		cpgif_new_slider_pos = (cpgif_scrollbar_width * (-(cpgif_x*100/((cpgif_max-1)*cpgif_xstep))) / 100) - cpgif_new_posx;
		cpgif_slider_div.style.marginLeft = (cpgif_new_slider_pos - cpgif_conf_slider_width) + 'px';
	}
}

function cpgif_moveTo(cpgif_x)
{
	cpgif_current = cpgif_x;
	var cpgif_zIndex = cpgif_max;
	
	/* Main loop */
	for (var cpgif_index = 0; cpgif_index < cpgif_max; cpgif_index++)
	{
		var cpgif_image = cpgif_img_div.childNodes.item(cpgif_array_images[cpgif_index]);
		var cpgif_current_image = cpgif_index * -cpgif_xstep;

		/* Don't display images that are not conf_focussed */
		if ((cpgif_current_image+cpgif_max_conf_focus) < cpgif_mem_target || (cpgif_current_image-cpgif_max_conf_focus) > cpgif_mem_target)
		{
			cpgif_image.style.visibility = 'hidden';
			cpgif_image.style.display = 'none';
		}
		else 
		{
			var cpgif_z = Math.sqrt(10000 + cpgif_x * cpgif_x) + 100;
			var cpgif_xs = cpgif_x / cpgif_z * cpgif_size + cpgif_size;

			/* Still hide images until they are processed, but set display style to block */
			cpgif_image.style.display = 'block';
		
			/* Process new image height and image width */
			var cpgif_new_img_h = (cpgif_image.cpgif_h / cpgif_image.cpgif_w * cpgif_image.cpgif_pc) / cpgif_z * cpgif_size;
			switch ( cpgif_new_img_h > cpgif_max_height )
			{
				case false:
					var cpgif_new_img_w = cpgif_image.cpgif_pc / cpgif_z * cpgif_size;
					break;

				default:
					cpgif_new_img_h = cpgif_max_height;
					var cpgif_new_img_w = cpgif_image.cpgif_w * cpgif_new_img_h / cpgif_image.cpgif_h;
					break;
			}
			var cpgif_new_img_top = (cpgif_images_width * 0.34 - cpgif_new_img_h) + cpgif_images_top + ((cpgif_new_img_h / (cpgif_conf_reflection_p + 1)) * cpgif_conf_reflection_p);

			/* Set new image properties */
			cpgif_image.style.left = cpgif_xs - (cpgif_image.cpgif_pc / 2) / cpgif_z * cpgif_size + cpgif_images_left + 'px';
			if(cpgif_new_img_w && cpgif_new_img_h)
			{ 
				cpgif_image.style.height = cpgif_new_img_h + 'px'; 
				cpgif_image.style.width = cpgif_new_img_w + 'px'; 
				cpgif_image.style.top = cpgif_new_img_top + 'px';
			}
			cpgif_image.style.visibility = 'visible';

			/* Set image layer through zIndex */
			switch ( cpgif_x < 0 )
			{
				case true:
					cpgif_zIndex++;
					break;

				default:
					cpgif_zIndex = cpgif_zIndex - 1;
					break;
			}
			
			/* Change zIndex and onclick function of the focussed image */
			switch ( cpgif_image.cpgif_i == cpgif_caption_id )
			{
				case false:
					cpgif_image.onclick = function() { cpgif_glideTo(this.cpgif_x_pos, this.cpgif_i); };
					break;

				default:
					cpgif_zIndex = cpgif_zIndex + 1;
					cpgif_image.onclick = function() { document.location = this.URL; };
					break;
			}
			cpgif_image.style.zIndex = cpgif_zIndex;
		}
		cpgif_x += cpgif_xstep;
	}
}

/* Main function */
function cpgif_refresh(onload)
{
	/* Cache document objects in global variables */
	cpgif_imageflow_div = document.getElementById(cpgif_conf_imageflow);
	cpgif_img_div = document.getElementById(cpgif_conf_images);
	cpgif_scrollbar_div = document.getElementById(cpgif_conf_scrollbar);
	cpgif_slider_div = document.getElementById(cpgif_conf_slider);
	cpgif_caption_div = document.getElementById(cpgif_conf_captions);

	/* Cache global variables, that only change on refresh */
	cpgif_images_width = cpgif_img_div.offsetWidth;
	cpgif_images_top = cpgif_imageflow_div.offsetTop;
	cpgif_images_left = cpgif_imageflow_div.offsetLeft;
	cpgif_max_conf_focus = cpgif_conf_focus * cpgif_xstep;
	cpgif_size = cpgif_images_width * 0.5;
	cpgif_scrollbar_width = cpgif_images_width * 0.6;
	cpgif_conf_slider_width = cpgif_conf_slider_width * 0.5;
	cpgif_max_height = cpgif_images_width * 0.51;

	/* Change imageflow div properties */
	cpgif_imageflow_div.style.height = cpgif_max_height + 'px';

	/* Change images div properties */
	cpgif_img_div.style.height = cpgif_images_width * 0.338 + 'px';

	/* Change captions div properties */
	cpgif_caption_div.style.width = cpgif_images_width + 'px';
	cpgif_caption_div.style.marginTop = cpgif_images_width * 0.03 + 'px';

	/* Change scrollbar div properties */
	cpgif_scrollbar_div.style.marginTop = cpgif_images_width * 0.02 + 'px';
	cpgif_scrollbar_div.style.marginLeft = cpgif_images_width * 0.2 + 'px';
	cpgif_scrollbar_div.style.width = cpgif_scrollbar_width + 'px';
	
	/* Set slider attributes */
	cpgif_slider_div.onmousedown = function () { cpgif_dragstart(this);return false; };
	cpgif_slider_div.style.cursor = cpgif_conf_slider_cursor;

	/* Cache EVERYTHING! */
	cpgif_max = cpgif_img_div.childNodes.length;
	var cpgif_i = 0;
	for (var cpgif_index = 0; cpgif_index < cpgif_max; cpgif_index++)
	{ 
		var cpgif_image = cpgif_img_div.childNodes.item(cpgif_index);
		if (cpgif_image.nodeType == 1)
		{
			cpgif_array_images[cpgif_i] = cpgif_index;
			
			/* Set image onclick by adding i and x_pos as attributes! */
			cpgif_image.onclick = function() { cpgif_glideTo(this.cpgif_x_pos, this.cpgif_i); };
			cpgif_image.cpgif_x_pos = (-cpgif_i * cpgif_xstep);
			cpgif_image.cpgif_i = cpgif_i;
			
			/* Add width and height as attributes ONLY once onload */
			if(onload == true)
			{
				cpgif_image.cpgif_w = cpgif_image.width;
				cpgif_image.cpgif_h = cpgif_image.height;
			}

			/* Check source image format. Get image height minus reflection height! */
			switch ((cpgif_image.cpgif_w + 1) > (cpgif_image.cpgif_h / (cpgif_conf_reflection_p + 1))) 
			{
				/* Landscape format */
				case true:
					cpgif_image.cpgif_pc = 118;
					break;

				/* Portrait and square format */
				default:
					cpgif_image.cpgif_pc = 90;
					break;
			}

			/* Set ondblclick event */
			cpgif_image.URL = cpgif_image.getAttribute('longdesc');
			cpgif_image.ondblclick = function() { document.location = this.URL; };

			/* Set image cursor type */
			cpgif_image.style.cursor = cpgif_conf_images_cursor;

			cpgif_i++;
		}
	}
	cpgif_max = cpgif_array_images.length;

	/* Display images in current order */
	cpgif_moveTo(cpgif_current);
	cpgif_glideTo(cpgif_current, cpgif_caption_id);
}

/* Show/hide element functions */
function cpgif_show(cpgif_id)
{
	var cpgif_element = document.getElementById(cpgif_id);
	cpgif_element.style.visibility = 'visible';
}
function cpgif_hide(cpgif_id)
{
	var cpgif_element = document.getElementById(cpgif_id);
	cpgif_element.style.visibility = 'hidden';
	cpgif_element.style.display = 'none';
}

/* Hide loading bar, show content and initialize mouse event listening after loading */
function startimageflow()
{
    cpgif_auto        = parseInt(js_vars.cpgif_auto);
    cpgif_usewheel    = parseInt(js_vars.cpgif_usewheel);
    cpgif_usekeys     = parseInt(js_vars.cpgif_usekeys);
    cpgif_autotime    = parseInt(js_vars.cpgif_autotime);
	if(document.getElementById(cpgif_conf_imageflow))
	{
		cpgif_hide(cpgif_conf_loading);
		cpgif_refresh(true);
		cpgif_show(cpgif_conf_images);
		cpgif_show(cpgif_conf_scrollbar);
		if (cpgif_usewheel) cpgif_initMouseWheel();
		cpgif_initMouseDrag();
		cpgif_glideTo( -450, 3);
		if (cpgif_auto) setInterval('cpgif_autorun()',cpgif_autotime*1000);
		if (cpgif_usewheel) 
		{ document.onkeydown = function(cpgif_event)
           {
	       var cpgif_charCode  = cpgif_getKeyCode(cpgif_event);
	       switch (cpgif_charCode)
	          {
		       /* Right arrow key */
		      case 39:
			     cpgif_handle(-1);
			     break;
		
		      /* Left arrow key */
		      case 37:
			     cpgif_handle(1);
			     break;
	         }
          };
        }
	}
}

function cpgif_autorun()
{
    			var cpgif_change = false;
			if(cpgif_caption_id < (cpgif_max-1))
			{
				cpgif_target = cpgif_target - cpgif_xstep;
				cpgif_new_caption_id = cpgif_caption_id + 1;
				cpgif_change = true;
			}
			else
			    { 
			      cpgif_target = 0;
			      cpgif_new_caption_id  = 0;
			      cpgif_change = true;
			    }
	if (cpgif_change == true)
	{
		cpgif_glideTo(cpgif_target, cpgif_new_caption_id);
	}

}



/* Refresh ImageFlow on window resize */
window.onresize = function()
{
	if(document.getElementById(cpgif_conf_imageflow)) cpgif_refresh();
};

/* Fixes the back button issue */
window.onunload = function()
{
  document = null;
};


/* Handle the wheel angle change (delta) of the mouse wheel */
function cpgif_handle(cpgif_delta)
{
	var cpgif_change = false;
	switch (cpgif_delta > 0)
	{
		case true:
			if(cpgif_caption_id >= 1)
			{
				cpgif_target = cpgif_target + cpgif_xstep;
				cpgif_new_caption_id = cpgif_caption_id - 1;
				cpgif_change = true;
			}
			break;

		default:
			if(cpgif_caption_id < (cpgif_max-1))
			{
				cpgif_target = cpgif_target - cpgif_xstep;
				cpgif_new_caption_id = cpgif_caption_id + 1;
				cpgif_change = true;
			}
			break;
	}

	/* Glide to next (mouse wheel down) / previous (mouse wheel up) image */
	if (cpgif_change == true)
	{
		cpgif_glideTo(cpgif_target, cpgif_new_caption_id);
	}
}

/* Event handler for mouse wheel event */
function cpgif_wheel(cpgif_event)
{
	var cpgif_delta = 0;
	if (!cpgif_event) cpgif_event = window.event;
	if (cpgif_event.wheelDelta)
	{
		cpgif_delta = cpgif_event.wheelDelta / 120;
	}
	else if (cpgif_event.detail)
	{
		cpgif_delta = -cpgif_event.detail / 3;
	}
	if (cpgif_delta) cpgif_handle(cpgif_delta);
	if (cpgif_event.preventDefault) cpgif_event.preventDefault();
	cpgif_event.returnValue = false;
}

/* Initialize mouse wheel event listener */
function cpgif_initMouseWheel()
{
	if(window.addEventListener) cpgif_imageflow_div.addEventListener('DOMMouseScroll', cpgif_wheel, false);
	cpgif_imageflow_div.onmousewheel = cpgif_wheel;
}

/* This function is called to drag an object (= slider div) */
function cpgif_dragstart(cpgif_element)
{
	cpgif_dragobject = cpgif_element;
	cpgif_dragx = cpgif_posx - cpgif_dragobject.offsetLeft + cpgif_new_slider_pos;
}

/* This function is called to stop dragging an object */
function cpgif_dragstop()
{
	cpgif_dragobject = null;
	cpgif_dragging = false;
}

/* This function is called on mouse movement and moves an object (= slider div) on user action */
function cpgif_drag(cpgif_e)
{
	cpgif_posx = document.all ? window.event.clientX : cpgif_e.pageX;
	if(cpgif_dragobject != null)
	{
		cpgif_dragging = true;
		cpgif_new_posx = (cpgif_posx - cpgif_dragx) + cpgif_conf_slider_width;

		/* Make sure, that the slider is moved in proper relation to previous movements by the glideTo function */
		if(cpgif_new_posx < ( - cpgif_new_slider_pos)) cpgif_new_posx = - cpgif_new_slider_pos;
		if(cpgif_new_posx > (cpgif_scrollbar_width - cpgif_new_slider_pos)) cpgif_new_posx = cpgif_scrollbar_width - cpgif_new_slider_pos;
		
		var cpgif_slider_pos = (cpgif_new_posx + cpgif_new_slider_pos);
		var cpgif_step_width = cpgif_slider_pos / ((cpgif_scrollbar_width) / (cpgif_max-1));
		var cpgif_image_number = Math.round(cpgif_step_width);
		var cpgif_new_target = (cpgif_image_number) * -cpgif_xstep;
		var cpgif_new_caption_id = cpgif_image_number;

		cpgif_dragobject.style.left = cpgif_new_posx + 'px';
		cpgif_glideTo(cpgif_new_target, cpgif_new_caption_id);
	}
}

/* Initialize mouse event listener */
function cpgif_initMouseDrag()
{
	document.onmousemove = cpgif_drag;
	document.onmouseup = cpgif_dragstop;

	/* Avoid text and image selection while dragging  */
	document.onselectstart = function () 
	{
		if (cpgif_dragging == true)
		{
			return false;
		}
		else
		{
			return true;
		}
	};
}

function cpgif_getKeyCode(cpgif_event)
{
	cpgif_event = cpgif_event || window.event;
	return cpgif_event.keyCode;
}



cpgif_addLoad(startimageflow);