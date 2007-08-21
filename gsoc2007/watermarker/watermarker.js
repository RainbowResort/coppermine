/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2007 Coppermine Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  ********************************************
  Coppermine version: 1.5.0
  $HeadURL$
  $Revision: 3267 $
  $LastChangedBy: gaugau $
  $Date: 2006-09-01 11:38:25 +0200 (Fr, 01 Sep 2006) $
**********************************************/

function write_watermarker(flashvars) { 
document.write("<object  classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0\" width=\"600\" height=\"500\">")
document.write("      <param name=\"movie\" value=\"./watermarker/configurator.swf\" />")
document.write(flashvars)
document.write("      <param name=\"quality\" value=\"high\" />")
document.write("</object>")
document.write("<br /><iframe frameborder=\"0\" id=\"iframe\" height=\"400\" width=\"500\" src=\"\" style=\"display:none\"></iframe>")
}

function previewIframe(vars){
	var rand = "&ran=" + Math.floor(Math.random()*999999); 
	document.getElementById("iframe").style.display = '';
	document.getElementById("iframe").src = './watermarker.php?action=preview' + vars + rand;
}