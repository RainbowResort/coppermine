*************************
  mass_import Plugin for cpg1.5.x
  ************************
  Copyright (c) 2003-2009 Coppermine Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  Coppermine version: 1.5.x
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**********************************************

What it does
============
Mass Import gives the admin the ability to import large numbers of pictures organized by directory structure.

Details
=======
The mass import works similarly to the batch-add process, but it allows you to add an entire structure 
of folders, subfolders and files to be added in one go. 
The plugin will create categories and albums that correspond to the folder names. It will then loop though 
the files in the structure and batch-add them to the database and create the resized images.
Use this plugin as well if you have issues with the regular batch-add process consuming too many resources.

Announcement
============
Visit the announcement thread of this plugin for breaking news
http://forum.coppermine-gallery.net/index.php/topic,61281.0.html

SVN checkouts
=============
Use subversion checkout to get the latest and greatest version of this plugin. Refer to the documentation 
that comes with Coppermine to find out details on the Subversion repository.
Check out https://coppermine.svn.sourceforge.net/svnroot/coppermine/branches/cpg1.5.x/plugins/mass_import/ 
or use WebSVN to browse the repository at 
http://coppermine.svn.sourceforge.net/viewvc/coppermine/branches/cpg1.5.x/plugins/mass_import/

Credits
=======
Nibbler initially created this as a mod of the batch-add function that featured the delayed execution.
Donnoman converted the mod into a plugin for cpg1.4.x
Flux and Paul Van Rompay contributed code to improve the functionality.
Joachim Müller ported the plugin for cpg1.5.x and spiced up the output a bit. 

Support
=======
The scope of support for this tool is limited. Basically, it comes as-is.

Changelog
=========
[A] = Added new feature
[B] = Bugfix (fix something that wasn't working as expected)
[C] = Cosmetical fix (layout, typo etc.)
[D] = Documentation improvements
[M] = Maintenance works
[O] = Optimization of code
[S] = Security fix (issues that are related to security)
*********************************************

2009-08-20 [M] First public release of the plugin for cpg1.5.x (plugin version 3.3) {GauGau}
2009-08-20 [D] Added screenshot to install information {GauGau}
2009-08-20 [O] I18n of configuration file {GauGau}
2009-08-19 [A] Addeded spin button {GauGau}
2009-08-19 [A] Addeded German language file {GauGau}
2009-08-19 [A] Added menu icons {GauGau}
2009-08-19 [C] Converted admin menu entry function for cpg1.5.x {GauGau}
2009-08-18 [B] Inspectified form {GauGau}
2009-08-18 [C] Spiced up form {GauGau}
2009-08-18 [M] Added SVN header {GauGau}
2009-08-18 [M] Renamed plugin folder from CPGMassImport to mass_import to respect naming conventions {GauGau}
2009-08-18 [M] Increased plugin version count from 2.0 to 3.0 to reflect the in-depth changes {GauGau}

Todo
====

