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

(function($){$.fn.extend({elastic:function(){var i=new Array('paddingTop','paddingRight','paddingBottom','paddingLeft','fontSize','lineHeight','fontFamily','width','fontWeight');return this.each(function(){if(this.type=='textarea'){var b=$(this);var c=parseInt(b.css('lineHeight'),10)||parseInt(b.css('fontSize'),'10');var d=parseInt(b.css('height'),10)||c*3;var e=parseInt(b.css('max-height'),10)||0;var f=0;var g=null;var h=true;if(e<0)e=0;if(!g){g=$('<div />').css({'position':'absolute','display':'none'}).appendTo(b.parent());$.each(i,function(){g.css(this.toString(),b.css(this.toString()))})};function update(){var a=b.val().replace(/<|>/g,' ').replace(/\n/g,'<br />').replace(/&/g,"&amp;");if(g.text()!=a){g.html(a+"&nbsp;");f=(g.height()+c*2>d)?g.height()+c*2:d;if(f<=e||e==0){b.css({overflow:'hidden'});if(Math.abs(f-b.height())>c){b.css({'height':f+(c*2)+'px'})}}else{b.css({overflow:'auto'});if(e!=b.height()){b.css({'height':e+'px'});if(h){temp=b.val();b.val('');setTimeout(function(){b.val(temp)},1);h=false}}}}}b.css({overflow:'auto'}).bind('focus',function(){self.periodicalUpdater=window.setInterval(function(){update()},400)}).bind('blur',function(){clearInterval(self.periodicalUpdater)});update()}})}})})(jQuery);