/**************************************************
  Picture Annotation (annotate) plugin for cpg1.5.x
  *************************************************
  Copyright (c) 2003-2009 Coppermine Dev Team

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  *************************************************
  Coppermine version: 1.5.x
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**************************************************/

What it does:
=============
Add text annotations to your images like on Flickr or Amazon.

Announcement thread:
====================
http://forum.coppermine-gallery.net/index.php/topic,60622.0.html

Install:
========
No particular install instructions: install exactly as any other plugin. Refer to the documentation for details.

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

2009-11-06 [A] New permission system configuration (enable detailed settings for all user groups) {eenemeenemuu}
2009-11-05 [A] Added timestamp and database update function {eenemeenemuu}
2009-11-05 [B] Fixed language display on plugin uninstall {eenemeenemuu}
2009-11-04 [B] Typo in german language file {eenemeenemuu}
2009-10-27 [A] Added registration promotion {GauGau}
2009-10-27 [A] Added viewing permissions {GauGau}
2009-10-27 [A] Added more icons {GauGau}
2009-10-27 [B] Removed silly line in database schema that disabled more than one annotation per image. {GauGau}
2009-10-27 [M] Counted plugin version up to v2.1 {GauGau}
2009-10-13 [A] Added config screen {GauGau}
2009-10-13 [O] Dumped some of the extra stylesheets in favor of existing classes {GauGau}
2009-10-13 [A] Added icons to buttons {GauGau}
2009-10-13 [A] Converted <input>-buttons to "real" <button>s {GauGau}
2009-10-12 [M] Counted plugin version up to v2.0 {GauGau}
2009-10-12 [A] Added icons {GauGau}
2009-10-12 [A] Added i18n of plugin manager section {GauGau}
2009-10-12 [M] Counted plugin version up to v1.8 {GauGau}
2009-10-12 [A] Moved annotation button into buttons section {GauGau}
2009-10-12 [C] Moved JS includes down for safer fallback {GauGau}
2009-10-12 [A] Added i18n {GauGau}
2009-10-12 [O] Indentation for CSS file {GauGau}
2009-10-12 [M] Added file headers to all plugin files {GauGau}
2009-10-12 [M] Started readme file with changelog (plugin version 1.7) {GauGau}

Credits:
========
Plugin created by Nibbler for cpg1.4.x
Ported to cpg1.5.x by eenemeenemuu
JavaScript library by Dusty Davidson
Portions of the JavaScript library also by Angus Turnbull

Todo:
=====
Move embedded JS into separate file
Implement permission system (partially done)
Fix JS errors in IE
Add new config option: free text annotation / drop down list of current free text annotations with possibility to create new one / drop down list of all users {eenemeenemuu - I made a mod/fork and already have some of this code ready. I'll implement it soon}
Bug: Users cannot edit/delete their own annotations
Report to admin button for annotations?