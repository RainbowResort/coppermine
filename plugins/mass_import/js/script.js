/*************************
  mass_import Plugin for cpg1.5.x
  ************************
  Copyright (c) 2003-2009 Coppermine Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  Coppermine version: 1.5.x
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/branches/cpg1.5.x/plugins/mass_import/configuration.php $
  $Revision: 6490 $
  $LastChangedBy: gaugau $
  $Date: 2009-08-19 10:44:55 +0200 (Mi, 19 Aug 2009) $
**********************************************/

$(document).ready(function() {
	$('#sleep').SpinButton({min: 0,max: 99999});
	$('#hardlimit').SpinButton({min: 1,max: 100});
});