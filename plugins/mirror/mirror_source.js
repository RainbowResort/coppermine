/*  This comment MUST stay intact for legal use, so don't remove it. MirrorIt! 
v1.0 - (c) 2009 Timo Schewe - http://www.timos-welt.de This program is free 
software: you can redistribute it and/or modify it under the terms of the GNU 
General Public License as published by the Free Software Foundation, either 
version 3 of the License, or (at your option) any later version. See LICENSE.TXT 
for details. */

var mirr_size = 30;          // size of mirror effect in pixel (5-30)
var mirr_opa = 50;           // start of mirror opacity (fades to zero)
var mirr_class = 'image';    // all images with this css class will get a mirror

function mirr_start()
{
  var mirr_imgs = document.getElementsByTagName('img');
  for (var i = 0; i < mirr_imgs.length; i++) {
    classNames = mirr_imgs[i].className.split(' ');
    for (var j = 0; j < classNames.length; j++) {
      if (classNames[j] == mirr_class) {
        try { mirr_reflect(mirr_imgs[i]); } catch(mirror_err) {}
        break;
      }
    }
  }
}

function mirr_reflect(mirr_image)
{
  var mirr_innerdiv =  new Array();
  var mirr_height = parseInt(mirr_image.height);
  var mirr_width = parseInt(mirr_image.width);
  if (mirr_height <= mirr_size) return true;
  var mirr_parent = mirr_image.parentNode;
  mirr_image.style.marginBottom = '0px';
  mirr_image.style.paddingBottom = '0px';
  mirr_image.galleryimg = 'no';
  mirr_div = document.createElement("div");
  var mirr_divwidth = mirr_width+10;
  mirr_div.style.width = mirr_divwidth+'px';
  mirr_div.appendChild(mirr_image);
  mirr_div.style.cursor = 'pointer';
  for (var i = 1;i<=mirr_size;i++)
  {
    
    mirr_innerdiv[i] = document.createElement("div");
    mirr_scroll = mirr_height-i;
    mirr_innerdiv[i].style.backgroundImage = 'url('+mirr_image.src+')';
    mirr_innerdiv[i].style.backgroundPosition = '0px -' + mirr_scroll + 'px';
    mirr_innerdiv[i].style.height = '1px';
    mirr_innerdiv[i].style.width = mirr_width+'px';
    mirr_innerdiv[i].style.overflow = 'hidden';
    mirr_opacity = mirr_opa-(mirr_opa/mirr_size*i);
    mirr_innerdiv[i].style.filter = "alpha(opacity="+mirr_opacity+")";
    mirr_opacity = mirr_opacity / 100;
    mirr_innerdiv[i].style.opacity = mirr_opacity;
    mirr_innerdiv[i].style.MozOpacity = mirr_opacity;
    mirr_div.appendChild(mirr_innerdiv[i]);
  }
mirr_parent.appendChild(mirr_div);
}


// add event to window.onload
function mirr_addLoad(mirr_func)
{
  var mirr_oldonload = window.onload;
  if (typeof window.onload != 'undefined')
  { window.onload = mirr_func; }
  else
  { window.onload = function() {
    if (mirr_oldonload) { mirr_oldonload(); }
    mirr_func();
    };
  }
}


mirr_addLoad(mirr_start);