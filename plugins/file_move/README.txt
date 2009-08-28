*******************************
  Coppermine Plugin "File Move"
  *****************************
  Copyright (c) 2003-2009 François Keller

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.
  ********************************************
  Coppermine version: 1.5.x
  $Source: /cvsroot/cpg-contrib/master_template/codebase.php,v $
  $Revision: 1.3 $
  $Author: donnoman $
  $Date: 2005/12/08 05:46:49 $
**********************************************

What is this:/Qu'est ce que c'est:
----------
This plugin allow you to reorder the folder where are all your pictures (generally the album folder)
You have two options:
	*tranfer the whole content from a folder to another
	*transfer only some files from a folder to another
The files are transfered (normal, thumbnails, intermediars) and the database is updated
Caution this plugin doesn't create nex folders. If you will have new folders into your album foldern you must create them by FTP.
It will have no changes in your albums, This is only managed the storage folder.
Plugin is avaible in English, French, Dutch, Italian, Persian, Spanish and German.
Feel free to translate the lang/english.php language file to your own language.


INSTALL/INSTALLATION
-------

* Unpack the archive and upload the "file_move" directory structure to your Coppermine gallery's plugins folder.
* Login as an admin, go to config, then "Manage Plugins"
* Find the "file_move" entry in the available plugins and click install.
* A new menu button is now added in the admin menu.


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

2009-08-28 [M] Added SVN properties {GauGau}
2009-08-28 [A] Added German language file {GauGau}
2009-08-28 [M] Inspectification of plugin {GauGau}
2009-08-28 [M] Renamed folder for compliance with naming scheme {GauGau}