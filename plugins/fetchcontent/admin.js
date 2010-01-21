/********************************************************
  Coppermine 1.5.x plugin - FetchContent
  *******************************************************
  Copyright (c) 2010 Coppermine dev team
  *******************************************************
  This program is free software; you can redistribute 
  it and/or modify it under the terms of the GNU General
  Public License as published by the Free Software
  Foundation; either version 3 of the License, or 
  (at your option) any later version.
  *******************************************************
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
  *******************************************************/
$(document).ready(function() {
	$('#plugin_fetchcontent_max_cols').SpinButton({min: 1,max: 20});
	$('#plugin_fetchcontent_max_rows').SpinButton({min: 1,max: 99});
});