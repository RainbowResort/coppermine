/**************************************************
  Coppermine 1.5.x Plugin - mass_import
  *************************************************
  Copyright (c) 2010 Nibbler
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/branches/cpg1.5.x/plugins/mirror/codebase.php $
  $Revision: 7039 $
  $LastChangedBy: gaugau $
  $Date: 2010-01-11 09:55:27 +0100 (Mo, 11. Jan 2010) $
  **************************************************/

$(document).ready(function() {
	$('#sleep').SpinButton({min: 0, max: 90000, step: 100});
	$('#hardlimit').SpinButton({min: 1, max: 100});
});