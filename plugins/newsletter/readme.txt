************************
Coppermine Photo Gallery
************************
Copyright (c) 2003-2009 Coppermine Dev Team
v1.1 originally written by Gregory DEMAR

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License version 3
as published by the Free Software Foundation.
********************************************
$HeadURL$
$Revision$
$Author$
$Date$
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

2009-07-08 [A] Added queue stat output to admin menu {GauGau}
2009-07-08 [M] Re-enabled guest subscription in config {GauGau}
2009-07-08 [O] Moved sending of emails from the initialization routine into a function of it's own {GauGau}
2009-07-08 [B] Fixed wrong link to profile on subscriptions page {GauGau}
2009-07-07 [A] Added option to specify number of retries {GauGau}
2009-07-07 [A] Added status output for admin {GauGau}
2009-07-07 [A] Added broken mailings screen {GauGau}
2009-07-07 [A] Added HTML mail template {GauGau}
2009-07-07 [A] Added countdown script on send screen {GauGau}
2009-07-06 [A] Added clickable mailing stats on the catlist screen that lead to the archive {GauGau}
2009-07-06 [A] Added admin option to configure other's subscriptions {GauGau}
2009-07-06 [A] Added confirmation JS dialog for category deleting {GauGau}
2009-07-06 [A] Added link to send page {GauGau}
2009-07-06 [A] Disabled categories that nobody has subscribed to yet {GauGau}
2009-07-06 [A] Added search icon {GauGau}
2009-07-06 [A] Added sending mechanism to all pages {GauGau}
2009-07-05 [A] Added actual sending page {GauGau}
2009-07-02 [A] Added archive page {GauGau}
2009-07-02 [A] Added index page {GauGau}
2009-07-02 [A] Added option to have admin menu link point only to index page {GauGau}
2009-07-02 [A] Finished mailing form {GauGau}
2009-07-02 [A] Added subscription stats {GauGau}
2009-07-01 [A] Added frequency stats {GauGau}
2009-06-30 [A] Added mailing page {GauGau}
2009-06-30 [B] Fixed bug with config changes entered during plugin install not being taken into account by moving the queries into a separate function {GauGau}
2009-06-30 [A] Added more icons {GauGau}
2009-06-30 [B] Added subscribe feature for registered users that wasn't working yet {GauGau}
2009-06-30 [B] Hide menu link if visitor isn't allowed to subscribe in the first place {GauGau}
2009-06-29 [M] Added SVN header data {GauGau}
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
* Subscribe token in template (parsing!)?
* Display on registration page
* Display on my_profile page
* Display on user manager
* Add a toggle to the unsubscribe page that checks if the plugin is installed in the first place. If it isn't, display a generic message.
* Add a check to all files if the plugin is installed in the first place or if an ex-subscriber is accessing the link in error
* Sanitize all input fields against special chars and escape them
* Browse by date: create branches by year and month
* check all boxes on broken queue screen
