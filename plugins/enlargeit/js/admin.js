/**************************************************
  Coppermine 1.5.x Plugin - EnlargeIt!
  *************************************************
  Copyright (c) 2009 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  Coppermine version: 1.5.2
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/branches/cpg1.5.x/plugins/enlargeit/codebase.php $
  $Revision: 6759 $
  $LastChangedBy: gaugau $
  $Date: 2009-11-22 09:35:47 +0100 (So, 22. Nov 2009) 
  **************************************************/
$(document).ready(function() {
	$('#colorpicker_bordercolor').farbtastic('#plugin_enlargeit_brdcolor');
	$('#colorpicker_titletext').farbtastic('#plugin_enlargeit_titletxtcol');
	$('#colorpicker_backgroundcontent').farbtastic('#plugin_enlargeit_ajaxcolor');
	$('#plugin_enlargeit_speed').SpinButton({min: 10,max: 32});
	$('#plugin_enlargeit_maxstep').SpinButton({min: 4,max: 30});
	$('#plugin_enlargeit_brdsize').SpinButton({min: 0,max: 40});
	$('#plugin_enlargeit_shadowsize').SpinButton({min: 0,max: 9});
	$('#plugin_enlargeit_shadowintens').SpinButton({min: 1,max: 30});
	$('#plugin_enlargeit_darkprct').SpinButton({min: 0,max: 100, step: 10});
	$('#plugin_enlargeit_darkensteps').SpinButton({min: 1,max: 20});
});