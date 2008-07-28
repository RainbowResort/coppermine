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
  $LastChangedBy: saweyyy $
  $Date: 2008-01-24 23:08:30 +0100 (Do, 24 Jan 2008) $
**********************************************/

/**
 * This file contains displayimage.php specific javascript
 */
// When the document is ready
		
$(document).ready(function() {
	
			var $next_position 	= js_vars.position; 
			var $album 			= js_vars.album; 
			var NumberOfPics 	= js_vars.count;
			var NumberOfItems   = parseInt(js_vars.max_item);
				
				if(NumberOfItems%2==0){
					NumberOfItems = NumberOfItems +1;
				}
				
				var $go_next = parseInt(NumberOfItems/2); 
			
		//	alert($next_position)
			//cache the images RULs 
			//create a objects to keep an array
			var url_cache 		= new Array(NumberOfPics);
			var link_cache		= new Array(NumberOfPics);
			var img 	  		= new Image();
			
			for(var i=0; i<NumberOfItems; i++){
				url_cache[($next_position-$go_next)+i] = $("img.strip_image").eq(i).attr("src");
			}
	
			//alert(url_cache[$next_position]);
			var prev_link = $next_position > 1 ? "<a id=\"filmstrip_prev\" rel=\"nofollow\" style=\"cursor: pointer;\"><img src=\"./images/prev.gif\" border=\"0\" /></a>" : "<a id=\"filmstrip_prev\" rel=\"nofollow\" style=\"cursor: pointer;display:none\"><img src=\"./images/prev.gif\" border=\"0\" /></a>";
			
			var next_link = $next_position < (NumberOfPics - ((NumberOfItems+1)/2)) ? "<a id=\"filmstrip_next\" rel=\"nofollow\" style=\"cursor: pointer;\"><img src=\"./images/next.gif\" border=\"0\" /></a>" : "<a id=\"filmstrip_next\" rel=\"nofollow\" style=\"cursor: pointer;display:none\"><img src=\"./images/next.gif\" border=\"0\" /></a>";

			$('td.prve_strip').html(prev_link);
			$('td.next_strip').html(next_link);
			
		// Bind a onclick event on element with id filmstrip_next
		$('#filmstrip_next').click(function() {
			// Get the url for next set of thumbnails. This will be the href of 'next' link; 
			$next_position = $next_position +1;

			if((NumberOfPics-((NumberOfItems+1)/2)) <= $next_position ){
				$('#filmstrip_next').hide();
			}
			if($next_position >= (((NumberOfItems+1)/2)-2)){
				$('#filmstrip_prev').show();			
			}
				
			if (!url_cache[$next_position + $go_next]) {
				var next_url = "displayimage.php?film_strip=1&album=" + $album + "&ajax_call=2&pos=" + $next_position;
				// Send the ajax request for getting next set of filmstrip thumbnails
				$.getJSON(next_url, function(data){
				
					//	alert(data['target']);
					url_cache[$next_position+$go_next] = data['url'];
					link_cache[$next_position+$go_next] = data['target'];
					
					var itemLength = $("ul.tape > li.thumb").length;
					var itemsToRemove = NumberOfItems+1;
					if (itemLength == itemsToRemove) {
						$('li.remove').remove();
					}
					//$('ul.tape').css("marginLeft", '0px');
					var thumb = '<li align="center" class="thumb" valign="bottom"><a style="width:100px;float:left" href="' + data['target'] + '"><img border="0"  class="strip_image" src="' + data['url'] + '"/></a></li>';
					$('ul.tape').append(thumb);
					
					$('ul.tape').css({
						marginLeft: "-100px"
					});
					
					$('li.thumb').eq(0).addClass("remove");
					
					
				});
			}
			else {
				var itemLength = $("ul.tape > li.thumb").length;
				if (itemLength == (NumberOfItems+1)) {
					$('li.remove').remove();
				}
				//$('ul.tape').css("marginLeft", '0px');
				var thumb = '<li align="center"  class="thumb" valign="bottom"><a style="width:100px;float:left" href="' + link_cache[$next_position + $go_next] + '"><img border="0"  class="strip_image" src="' + url_cache[$next_position + $go_next] + '"/></a></li>';
				$('ul.tape').append(thumb);
				
				$('ul.tape').css({
					marginLeft: "-100px"
				});
				
				$('li.thumb').eq(0).addClass("remove");
			}
		});


		// Bind a onclick event on element with id filmstrip_prev
		$('#filmstrip_prev').click(function() {
			// Get the url for previous set of thumbnails. This will be the href of 'previous' link
			$next_position = $next_position -1;
			
			if($next_position < (NumberOfPics-(((NumberOfItems+1)/2)-1))){
				$('#filmstrip_next').show();	
			}
			if($next_position < (((NumberOfItems+1)/2)-1)){
				$('#filmstrip_prev').hide();			
			}
						
		if(!url_cache[$next_position-$go_next]) {
			var prev_url = "displayimage.php?film_strip=1&album="+$album+"&ajax_call=1&pos="+$next_position;  
			$.getJSON(prev_url, function(data){
			
				url_cache[$next_position-$go_next] 	= data['url'];
				link_cache[$next_position-$go_next] 	= data['target'];
			
				var itemLength = $("ul.tape > li.thumb").length;
				if (itemLength == (NumberOfItems+1)) {
					$('li.remove').remove();
				}
				

				var thumb_prev = '<li align="center"  class="thumb" valign="bottom"><a style="width:100px;float:left" href="'+data['target']+'"><img border="0" class="strip_image" src="'+data['url']+'"/></a></li>';
				$('ul.tape').prepend(thumb_prev);
								$('ul.tape').css("marginLeft", '0');
/**
 * 				$('ul.tape').css({
 * 					marginRight: "-102px"
 * 				});
 */

				$('li.thumb').eq((NumberOfItems)).addClass("remove");
				
			});
		}
		else{
				var itemLength = $("ul.tape > li.thumb").length;
				if (itemLength == (NumberOfItems+1)) {
					$('li.remove').remove();
				}
		
				var thumb_prev = '<li align="center"  class="thumb" valign="bottom"><a style="width:100px;float:left" href="'+link_cache[$next_position-$go_next]+'"><img border="0"  class="strip_image" src="'+url_cache[$next_position-$go_next]+'"/></a></li>';
				$('ul.tape').prepend(thumb_prev);
						$('ul.tape').css("marginLeft", '0');
/**
 * 				$('ul.tape').css({
 * 					marginRight: "102px"
 * 				});
 */
				

				$('li.thumb').eq(NumberOfItems).addClass("remove");
		}
		
		})
	
});

/**
* This part is the rating part of displayimage.php
*/
var displayRating = '';
var currentId = '';
var root = '';

function rate(obj, rating, theme_dir){
	var id = obj.title;
	var fullId = obj.id;
	var vote_id = document.getElementById('vote_id').innerHTML;
	var idName = fullId.substr(0, fullId.indexOf('_'));
	//window.location = root+'ratepic.php?rate=' + id + '&pic=' + idName + '&id=' + vote_id;
	$.get('ratepic.php?rate=' + id + '&pic=' + idName + '&id=' + vote_id, function(data){
		//create a JSON object of the returned data
		var json_data = eval('(' + data + ')');
		//check the data and respond upon it
		if(json_data.status == 'error'){
			//something went wrong, tell the user what it was
			$('#rating_stars').next().html( json_data.msg ); 
		}else if(json_data.status == 'success'){
			//vote casted, update rating and show user
			$('#rating_stars').html( '<center>' + json_data.msg + '<br />' + buildRating(json_data.new_rating, 'null', theme_dir, false) + '</center>');
			$('#voting_title').html( json_data.new_rating_text );	
		}
	});

}

function changeover(obj, rating, theme_dir){
	var imageName = obj.src;
	var id = obj.title;
	var index = imageName.lastIndexOf('/');
	var filename = imageName.substring(index+1);
	var fullId = obj.id;
	var idName = fullId.substr(0, fullId.indexOf('_'));
	var totalRating = rating;

	for(i=0; i<id; i++) {
		var num = i+1;
		document.getElementById(idName+'_'+num).src = theme_dir + 'images/rate_new.gif';			
	}

}

function changeout(obj, rating, theme_dir){
	var imageName = obj.src;
	var id = obj.title;
	var index = imageName.lastIndexOf('/');
	var filename = imageName.substring(index+2);
	var fullId = obj.id;
	var idName = fullId.substr(0, fullId.indexOf('_'));
	var totalRating = rating;
	
	for(i=0; i<id; i++) {
		var num = i+1;
		if(i < totalRating) {
			document.getElementById(idName+'_'+num).src = theme_dir + 'images/rate_full.gif';			
		}
		else {
			document.getElementById(idName+'_'+num).src = theme_dir + 'images/rate_empty.gif';			
		}
	}
}

function displayStars(rating, idName, theme_dir, allow_vote, help_line){
	var fallback = document.getElementById("stars_amount").innerHTML;
	if(fallback != 'fallback'){
		document.write('<center>');
		if(allow_vote){
			document.write(help_line + '<br />');
		}
		document.write(buildRating(rating, idName, theme_dir, allow_vote));
		document.write('</center>');
	}
}

function buildRating(rating, idName, theme_dir, allow_vote){
	var stars_amount = document.getElementById("stars_amount").innerHTML;
	var rating_stars = '';
	
	if(!isNumber(stars_amount)){
		//default to 5 stars
		stars_amount = 5;
	}
	
	for(i=0; i < stars_amount; i++ ){
		if(i < rating) {
			if(allow_vote){
				rating_stars += '<img style="cursor:pointer" src="'+theme_dir+'images/rate_full.gif" id="'+idName+'_'+(i+1)+'" title="'+(i+1)+'" onmouseout="changeout(this, '+rating+', \''+theme_dir+'\')" onmouseover="changeover(this, '+rating+', \''+theme_dir+'\')" onclick="rate(this, '+rating+', \''+theme_dir+'\')" />';
			}else{
				rating_stars += '<img src="'+theme_dir+'images/rate_new.gif" alt="' + rating + '"/>';
			}
		}
		else {
			if(allow_vote){
				rating_stars += '<img style="cursor:pointer" src="'+theme_dir+'images/rate_empty.gif" id="'+idName+'_'+(i+1)+'" title="'+(i+1)+'" onmouseout="changeout(this, '+rating+', \''+theme_dir+'\')" onmouseover="changeover(this, '+rating+', \''+theme_dir+'\')" onclick="rate(this, '+rating+', \''+theme_dir+'\')" />';
			}else{
				rating_stars += '<img src="'+theme_dir+'images/rate_empty.gif" alt="' + rating + '"/>';
			}
		}		
	}
	return rating_stars;
}

function isNumber(test_input){
	var possible_numbers = "1234567890";
	var n;

	for (i = 0; i < test_input.length; i++){ 
    	n = test_input.charAt(i); 
    	if(possible_numbers.indexOf(n) == -1){
        	return false;
		}
	}
	return true;
}




/**
 * this jquery plugin for view full size image. 
 * this full size image will fatch using ajax call. 
 * file name: facebox.js  
 */

(function($) {
	
  $.facebox = function(data) {
    $.facebox.init()
    $.facebox.loading()
    $.isFunction(data) ? data.call() : $.facebox.reveal(data)
  }

  $.facebox.settings = {
    loading_image : 'themes/classic/images/face_loading.gif',
    close_image   : 'themes/classic/images/closelabel.gif',
    image_types   : [ 'png', 'jpg', 'jpeg', 'gif' ],
    facebox_html  : '\
<div id="jquery-overlay"></div> \
  <div id="facebox" style="display:none;"> \
    <div class="popup"> \
      <table> \
        <tbody> \
          <tr> \
            <td class="body"> \
              <div class="content"> \
              </div> \
              <div class="title">\
              </div>\
               <div class="footer"> \
                <a href="#" class="close"> \
                  <img src="" title="close" class="close_image" /> \
                </a> \
              </div> \
            </td> \
          </tr> \
        </tbody> \
      </table> \
    </div> \
  </div>'
  }

  $.facebox.loading = function() {
    if ($('#facebox .loading').length == 1) return true

    $('#facebox .content').empty()
    $('#facebox .title').empty();
    _set_interface();
    $('#jquery-overlay').fadeIn('normal');
    $('#facebox .body').children().hide().end().
      append('<div class="loading"><img src="'+$.facebox.settings.loading_image+'"/></div>')

    var pageScroll = $.facebox.getPageScroll()
    $('#facebox').css({
      top:	pageScroll[1] + ($.facebox.getPageHeight() / 10),
      left:	pageScroll[0]
    }).show()

    $(document).bind('keydown.facebox', function(e) {
      if (e.keyCode == 27) $.facebox.close()
    })
  }

  $.facebox.reveal = function(data, klass,a) {  
    if (klass) $('#facebox .content').addClass(klass)
    $('#facebox .content').append(data['url'])
    $('#facebox .title').append(data['title']);
    $('#facebox .loading').remove();
    $('#facebox .body').children().fadeIn('normal');
  }

  $.facebox.close = function() {
    $(document).unbind('keydown.facebox')
    $('#facebox').fadeOut(function() {
      $('#facebox .content').removeClass().addClass('content');
       $('#facebox .fotter').removeClass().addClass('fotter');
       _finish();
    })
    return false
  }

  $.fn.facebox = function() {
    $.facebox.init()

    var image_types = $.facebox.settings.image_types.join('|')
    image_types = new RegExp('\.' + image_types + '$', 'i')

    function click_handler() {
      $.facebox.loading(true)

      // support for rel="facebox[.inline_popup]" syntax, to add a class
      var klass = this.rel.match(/facebox\[\.(\w+)\]/)
      if (klass) klass = klass[1]

      // div
      if (this.href.match(/#/)) {
        var url    = window.location.href.split('#')[0]
        var target = this.href.replace(url,'')
        $.facebox.reveal($(target).clone().show(), klass)

      // image
      } else if (this.href.match(image_types)) {
        var image = new Image()
        image.onload = function() {
          $.facebox.reveal('<div class="image"><img src="' + image.src + '" /></div>', klass)
        }
        image.src = this.href

      // ajax
      } else {
        $.getJSON(this.href+'&full_image_ajax=1', function(data){
			$.facebox.reveal(data, klass) 
		})
      }

      return false
    }

    this.click(click_handler)
    return this
  }

  $.facebox.init = function() {
    if ($.facebox.settings.inited) {
      return true
    } else {
      $.facebox.settings.inited = true
    }

    $('body').append($.facebox.settings.facebox_html)

    var preload = [ new Image(), new Image() ]
    preload[0].src = $.facebox.settings.close_image
    preload[1].src = $.facebox.settings.loading_image

    $('#facebox').find('.b:first, .bl, .br, .tl, .tr').each(function() {
      preload.push(new Image())
      preload.slice(-1).src = $(this).css('background-image').replace(/url\((.+)\)/, '$1')
    })

    $('#facebox .close').click(function(){
        $.facebox.close(); 
        return false
    })
    
    $('#facebox .close_image').attr('src', $.facebox.settings.close_image)
  }

  // getPageScroll() by quirksmode.com
  $.facebox.getPageScroll = function() {
    var xScroll, yScroll;
    if (self.pageYOffset) {
      yScroll = self.pageYOffset;
      xScroll = self.pageXOffset;
    } else if (document.documentElement && document.documentElement.scrollTop) {	 // Explorer 6 Strict
      yScroll = document.documentElement.scrollTop;
      xScroll = document.documentElement.scrollLeft;
    } else if (document.body) {// all other Explorers
      yScroll = document.body.scrollTop;
      xScroll = document.body.scrollLeft;	
    }
    return new Array(xScroll,yScroll) 
  }

  // adapter from getPageSize() by quirksmode.com
  $.facebox.getPageHeight = function() {
    var windowHeight
    if (self.innerHeight) {	// all except Explorer
      windowHeight = self.innerHeight;
    } else if (document.documentElement && document.documentElement.clientHeight) { // Explorer 6 Strict Mode
      windowHeight = document.documentElement.clientHeight;
    } else if (document.body) { // other Explorers
      windowHeight = document.body.clientHeight;
    }	
    return windowHeight
  }
  
  /**
		 / THIRD FUNCTION
		 * getPageSize() by quirksmode.com
		 *
		 * @return Array Return an array with page width, height and window width, height
		 */
		function ___getPageSize() {
			var xScroll, yScroll;
			if (window.innerHeight && window.scrollMaxY) {	
				xScroll = window.innerWidth + window.scrollMaxX;
				yScroll = window.innerHeight + window.scrollMaxY;
			} else if (document.body.scrollHeight > document.body.offsetHeight){ // all but Explorer Mac
				xScroll = document.body.scrollWidth;
				yScroll = document.body.scrollHeight;
			} else { // Explorer Mac...would also work in Explorer 6 Strict, Mozilla and Safari
				xScroll = document.body.offsetWidth;
				yScroll = document.body.offsetHeight;
			}
			var windowWidth, windowHeight;
			if (self.innerHeight) {	// all except Explorer
				if(document.documentElement.clientWidth){
					windowWidth = document.documentElement.clientWidth; 
				} else {
					windowWidth = self.innerWidth;
				}
				windowHeight = self.innerHeight;
			} else if (document.documentElement && document.documentElement.clientHeight) { // Explorer 6 Strict Mode
				windowWidth = document.documentElement.clientWidth;
				windowHeight = document.documentElement.clientHeight;
			} else if (document.body) { // other Explorers
				windowWidth = document.body.clientWidth;
				windowHeight = document.body.clientHeight;
			}	
			// for small pages with total height less then height of the viewport
			if(yScroll < windowHeight){
				pageHeight = windowHeight;
			} else { 
				pageHeight = yScroll;
			}
			// for small pages with total width less then width of the viewport
			if(xScroll < windowWidth){	
				pageWidth = xScroll;		
			} else {
				pageWidth = windowWidth;
			}
			arrayPageSize = new Array(pageWidth,pageHeight,windowWidth,windowHeight);
			return arrayPageSize;
		};

		function _set_interface() {
			// Apply the HTML markup into body tag	
			// Get page sizes
			var arrPageSizes = ___getPageSize();
			// Style overlay and show it
			$('#jquery-overlay').css({
				backgroundColor:	'#000',
				opacity:			'0.8',
				width:				arrPageSizes[0],
				height:				arrPageSizes[1]
			}).fadeIn();
			// Get page scroll

			// If window was resized, calculate the new overlay dimensions
			$(window).resize(function() {
				// Get page sizes
				var arrPageSizes = ___getPageSize();
				// Style overlay and show it
				$('#jquery-overlay').css({
					width:		arrPageSizes[0],
					height:		arrPageSizes[1]
				});
		});
		}
		
		function _finish() {
			$('#jquery-lightbox').hide();
			$('#jquery-overlay').fadeOut(function() { $('#jquery-overlay').hide(); });
		}

})(jQuery);

    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox({
      }); 
     // alert($('.someclass').metadata().some);
    });


