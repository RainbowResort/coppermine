/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2009 Coppermine Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**********************************************/

$(document).ready(function() {
	$("#plugin_newsletter_mails_per_page").SpinButton({min: 1,max: 500});
	$("#plugin_newsletter_page_refresh_delay").SpinButton({min: 0,max: 600});
	$("#plugin_newsletter_retries").SpinButton({min: 0,max: 10});
});