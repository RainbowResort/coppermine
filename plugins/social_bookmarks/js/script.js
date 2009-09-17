/********************************************
  social_bookmarks plugin for cpg1.5.x
  *******************************************
  Copyright (c) 2003-2009 Coppermine Dev Team

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  Coppermine version: 1.5.x
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/branches/cpg1.5.x/plugins/mass_import/codebase.php $
  $Revision: 6497 $
  $LastChangedBy: gaugau $
  $Date: 2009-08-19 18:54:16 +0200 (Mi, 19. Aug 2009) $
**********************************************/

$(document).ready(function() {
	$('#plugin_social_bookmarks_columns').SpinButton({min: 1,max: 50});
	//$("#plugin_social_bookmarks_layout_icons_only:checked").
    $('#social_bookmarks_menu_link').wrap('<div id="social_bookmarks_wrapper"></div>');
    $('#social_bookmarks_menu_link').after('<div id="social_bookmarks_content"></div>');
    $('#social_bookmarks_content').append(js_vars.bookmarks_content);
    //$("#social_bookmarks_menu_link").append(js_vars.bookmarks_visibility);
    if (js_vars.bookmarks_visibility == '0' ) {
	    $('#social_bookmarks_content').show();
	}
   $('#social_bookmarks_menu_link').click(function(event){
       event.preventDefault();
       if (js_vars.bookmarks_visibility == '1' ) {
           $('#social_bookmarks_content').toggle();
       }
   });
});


