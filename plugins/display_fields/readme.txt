Plugins for the Coppermine Photo Gallery are add-ons that use the plugin interface of Coppermine.
Read up the documentation that comes with Coppermine to find out more, e.g. how to install a plugin.

Coppermine version: cpg1.4.x
Plugin name: Filter & Sort File Information Fields on Image Display Page
Plugin version: 1.02
Plugin author: Paul Van Rompay (Paver)
Plugin announcement thread: http://forum.coppermine-gallery.net/index.php/topic,27407.0.html


This plugin lets you choose which non-EXIF fields you want to display in the "File Information" box under photos/files.

It also adds the album description to the list of fields since that is not included in the Coppermine core.

You can choose whether the admin sees all the fields always or not.  If you set this to "yes", you can still check to see what users see by going to "User Mode" while logged in as Admin (and then switch back to "Admin Mode" when you are done posing as a user).

There is one feature that is not available on the web-based configuration panel (for now).

If you want to sort the fields, modify the options at the top of codebase.php.
Read the comments there on how to set the options.


To do: allow customization of the order of the fields.

v1.01 added bb_decode to album description
v1.02 added manual sorting of fields using a configuration option in codebase.php
v1.02 has a bug whose fix is noted here
