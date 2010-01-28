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
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
  **************************************************/

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

Todo
====

