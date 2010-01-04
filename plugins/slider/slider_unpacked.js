/**********************************************************************************************
* Conveyor belt slideshow script- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
**********************************************************************************************/

// $VERSION$=0.3

var slideshowgap;
var copyspeed;
var realcopyspeed;
var cpgslid_brwsx,cpgslid_brwsy,cpgslid_oldbrwsx,cpgslid_oldbrwsy;
var actualwidth='';
var cross_slide;
var cross_slide2;
var slider_autowidth;
var autowidth;


function slid_addLoad(slid_func)
	{
	var slid_oldonload=window.onload;
	if(typeof window.onload!='function')
		{
		window.onload=slid_func
	}
	else
		{
		window.onload=function()
			{
			if(slid_oldonload)
				{
				slid_oldonload()
			}
			slid_func()
		}
	}
};
function cpgslideplug_fillup()
{
	im_usecookies      = parseInt(js_vars.im_usecookies);
	slideshowgap = 2;
	copyspeed = parseInt(js_vars.slider_copyspeed);
	realcopyspeed = parseInt(js_vars.slider_copyspeed);
	autowidth = parseInt(js_vars.slider_autow);
	slider_autowidth=document.getElementById("slidergetwidth").offsetWidth;
	slider_autowidth=parseInt(slider_autowidth)-1;
	cross_slide=document.getElementById?document.getElementById("slider_test2"):document.all.slider_test2;
	cross_slide2=document.getElementById?document.getElementById("slider_test3"):document.all.slider_test3;
	actualwidth=document.all?cross_slide.offsetWidth:document.getElementById("slider_temp").offsetWidth;
	actualwidth=parseInt(actualwidth);
	cross_slide2.style.left=actualwidth+slideshowgap+"px";
	if(autowidth)
		{
		document.getElementById('slider_autow1').style.width=slider_autowidth+'px';
		document.getElementById('slider_autow2').style.width=slider_autowidth+'px'
	}
	cross_slide.style.visibility='visible';
	cross_slide2.style.visibility='visible';
	cpgslid_getbrwsxy();
	cpgslid_oldbrwsx=cpgslid_brwsx;
	cpgslid_oldbrwsy=cpgslid_brwsy;
	lefttime=setInterval("cpgslideplug_slideleft()",75)
}
function cpgslideplug_resize()
	{
	document.getElementById("slider_autow1").style.position='absolute';
	cpgslideplug_templeft=document.getElementById("slider_autow1").style.left;
	document.getElementById("slider_autow1").style.left='-5000px';
	slider_autowidth=document.getElementById("slidergetwidth").offsetWidth;
	slider_autowidth=parseInt(slider_autowidth)-1;
	document.getElementById('slider_autow1').style.width=slider_autowidth+'px';
	document.getElementById('slider_autow2').style.width=slider_autowidth+'px';
	document.getElementById("slider_autow1").style.position='relative';
	document.getElementById("slider_autow1").style.left=cpgslideplug_templeft
}
function cpgslid_getbrwsxy()
	{
	if(typeof window.innerWidth!='undefined')
		{
		cpgslid_brwsx=window.innerWidth-10;
		cpgslid_brwsy=window.innerHeight
	}
	else if(typeof document.documentElement!='undefined'&&typeof document.documentElement.clientWidth!='undefined'&&document.documentElement.clientWidth!=0)
		{
		cpgslid_brwsx=document.documentElement.clientWidth;
		cpgslid_brwsy=document.documentElement.clientHeight
	}
	else
		{
		cpgslid_brwsx=document.getElementsByTagName('body')[0].clientWidth;
		cpgslid_brwsy=document.getElementsByTagName('body')[0].clientHeight
	}
}
function cpgslideplug_slideleft()
	{
	if(copyspeed)
		{
		if(autowidth)
			{
			cpgslid_getbrwsxy();
			if(cpgslid_brwsx!=cpgslid_oldbrwsx||cpgslid_brwsy!=cpgslid_oldbrwsy)cpgslideplug_resize();
			cpgslid_oldbrwsx=cpgslid_brwsx;
			cpgslid_oldbrwsy=cpgslid_brwsy
		}
		if(parseInt(cross_slide.style.left)>(actualwidth*(-1)+8))
			{
			cross_slide.style.left=parseInt(cross_slide.style.left)-copyspeed+"px"
		}
		else
			{
			cross_slide.style.left=parseInt(cross_slide2.style.left)+actualwidth+slideshowgap+"px"
		}
		if(parseInt(cross_slide2.style.left)>(actualwidth*(-1)+8))
			{
			cross_slide2.style.left=parseInt(cross_slide2.style.left)-copyspeed+"px"
		}
		else
			{
			cross_slide2.style.left=parseInt(cross_slide.style.left)+actualwidth+slideshowgap+"px"
		}
	}
}

slid_addLoad(cpgslideplug_fillup);
