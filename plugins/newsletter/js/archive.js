/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2009 Coppermine Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/branches/cpg1.5.x/plugins/newsletter/subscribe.php $
  $Revision: 6248 $
  $LastChangedBy: gaugau $
  $Date: 2009-06-30 11:09:21 +0200 (Di, 30 Jun 2009) $
**********************************************/

$(function() {
	$("#archive_by_category").treeview({
		collapsed: true,
		unique: true,
		animated: "slow",
		persist: "location",
	});
	$("#archive_by_date").treeview({
		collapsed: true,
		unique: true,
		animated: "slow",
		persist: "location",
	});
});