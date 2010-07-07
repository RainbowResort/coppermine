/**************************************************
  Coppermine 1.5.x Plugin - Limit upload
  *************************************************
  Copyright (c) 2010 eenemeenemuu
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/branches/cpg1.5.x/plugins/limit_upload/admin.php $
  $Revision: 7745 $
  $LastChangedBy: eenemeenemuu $
  $Date: 2010-07-06 15:03:42 +0200 (Di, 06. Jul 2010) $
  **************************************************/

$(document).ready(function() {
	$("#plugin_limit_upload_files").SpinButton({min: -1,max: 500});
});