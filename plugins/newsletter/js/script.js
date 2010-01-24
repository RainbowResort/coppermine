/**************************************************
  Coppermine 1.5.x Plugin - newsletter
  *************************************************
  Copyright (c) 2009-2010 Joachim Müller
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
  **************************************************/

$(document).ready(function() {
	$("#plugin_newsletter_mails_per_page").SpinButton({min: 1,max: 500});
	$("#plugin_newsletter_page_refresh_delay").SpinButton({min: 0,max: 600});
	$("#plugin_newsletter_retries").SpinButton({min: 0,max: 10});
});