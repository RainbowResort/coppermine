************************
Coppermine Photo Gallery
************************
Copyright (c) 2003-2009 Coppermine Dev Team
v1.1 originally written by Gregory DEMAR

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License version 3
as published by the Free Software Foundation.
********************************************
Coppermine version: 1.5.1
$HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/trunk/cpg1.5.x/CHANGELOG.txt $
$Revision: 6199 $
$Author: gaugau $
$Date: 2009-06-18 19:37:47 +0200 (Do, 18 Jun 2009) $
*********************************************

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

2009-06-29 [A] Added plugin to SVN repository {GauGau}
2009-06-29 [A] Added admin menu items {GauGau}
2009-06-28 [A] Added form token check {GauGau}
2009-06-28 [A] Added mailings and subscribers column to catlist {GauGau}
2009-06-26 [A] Added form to category list {GauGau}
2009-06-25 [A] Added category list {GauGau}
2009-06-25 [A] Added icons {GauGau}
2009-06-25 [A] Created subscribe page {GauGau}
2009-06-25 [A] Finished config screen {GauGau}
2009-06-24 [A] Added JavaScript {GauGau}
2009-06-23 [A] Database table layout created {GauGau}
2009-06-22 [A] Initial draft of the plugin created {GauGau}




Todo
====
* All emails contain an unsubscribe link at the bottom
* Config: allow guest subscriptions? If yes: guests need to opt in, so we'll need a corresponding toggle in the subscriptions table
* Config: newsletter frequency (to display to users when they sign up), per newsletter category
* Config: simple or advanced (one newsletter per site or several of them)
* Config: mails to send per page refresh
* Subscribe token in template (parsing!)?
* Display on registration page
* Display on my_profile page
* Display on user manager
* Add a toggle to the unsubscribe page that checks if the plugin is installed in the first place. If it isn't, disaply a generic message.
* Populate subscriber stats on catlist from subscribers table instead of the
* Add confirmation JS dialog for category deleting