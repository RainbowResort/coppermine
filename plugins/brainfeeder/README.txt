
  BrainFeeder for PHP 5 and higher
  Version 1.1 Release Candidate
  written by Hallvard Natvik <hallvard@natvik.com>
  send me a mail telling me how you use it!
  
  This is free software made available to you without any guarantees or obligations
  You can use this sofware anyway you like.
  
Welcome to BrainFeeder for Coppermine 1.4x

BrainFeeder for Coppermine 1.4x is a plugin that lets you configure RSS feeds based on the photos in your
Coppermine 1.4x gallery. You can set up as many feeds as you want, each selecting its own set of pictures based on various
criterias. 

The feeds can be run in either runtime or batch mode. Batch mode generates a XML file that users can subscribe to, 
in order to reduce the load on your Coppermine gallery and database.

Please go to http://www.natvik.com/bfdoc/brainfeeder_doc.html for a further description of the functionality and
user documentation. 

INSTALLATION
PHP5 is required
The zip file contains seven files.
The rss.php file goes into your coppermine root directory (same directory as coppermines index.php)
The rss.gif file goes into your coppermine images directory ([coppermine root]/images)
The others go into the ./plugins/brainfeeder directory

If you want to run in batch mode, it is recommended that you create a separate directory for storing the XML files, 
for example ./rss When you enter the name of the XML file to be created by BrainFeeder, the path needs to be either relative to 
the coppermine root dirctory, or absolute from you system root.

Please refer to http://www.natvik.com/bfdoc/brainfeeder_doc.html for further information.

CHANGE LOG
0.5 First publicly available alpha release
0.6 Beta release, April 6, 2009
    Version handling of database table - BF_db_ver in config table
    Implemented Random feeds
    Changed first feed type from "Last public" to "Any
    Implemented conversion logic to upgrade smoothly from 0.5 to 0.6
0.61 Beta release, April 10, 2009
    Updated installation script to install ver 2 of the brainfeeder table
    Corrected the version number shown in "manage plugins" in Coppermine
0.7 Beta release 
    Improved handling of non-picture files
    Made pictures in feeds clickable
    Introduced a parameter that decides what media types (pictures, video etc) that will be included in the feed
0.9 Beta release
    Bug fixes
    Optionally, add RSS icons to thumbnail views
    Select what size of picture to show in the feed
1.0 Release candidate
    Structured the configuration screen to make it easier to understand
    Made it possible to build the picture caption in the feed by entering text and data anchors
    Minor bugfixes
    Improved installation and upgrading process 
1.1 Release candidate
    Fixed incorrect default anchor in picture caption