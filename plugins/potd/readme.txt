----------------
  INSTALLATION
----------------

This plugin requires one hack to a core script.  Normally, plugins should *not* require any hacks.  
This hack is being considered for inclusion in the next major version of Coppermine (1.5.x).
For the 1.4.x series, you must apply the following hack in order to use the archive features.

In the file "include/functions.inc.php", look for the following three lines:

      // Meta albums
        switch($album){
        case 'lastcom': // Last comments

Directly above these three lines, add the following code block as shown (the three lines are shown for clarity):

        // MOD - begin
        $meta_album_passto = array (
                'album' => $album,
                'limit' => $limit,
                'set_caption' => $set_caption,
        );
        $meta_album_params = CPGPluginAPI::filter('meta_album', $meta_album_passto);
        if ($meta_album_params['album_name']) {
                $album_name = $meta_album_params['album_name'];
                $count = $meta_album_params['count'];
                $rowset = $meta_album_params['rowset'];
                return $rowset;
        }
        // MOD - end
  
      // Meta albums
        switch($album){
        case 'lastcom': // Last comments

Now, installation is complete.

--------------------
  USING THE PLUGIN
--------------------

Look in the docs folder for instructions on how to use this plugin.

This plugin is in beta, so please report any issues on the Coppermine forum:

Plugins for the Coppermine Photo Gallery are add-ons that use the plugin interface of Coppermine.
Read up the documentation that comes with Coppermine to find out more, e.g. how to install a plugin.

Coppermine version: cpg1.4.x
Plugin name: Photo of the Day/Week, with Archive
Plugin version: 1.02 beta
Plugin author: Paul Van Rompay (Paver) / Clive Leech (Casper)
Plugin announcement thread: http://forum.coppermine-gallery.net/index.php/topic,36916.0.html


This plugin is a conversion of the popular mod/hack by Casper (forum thread).

This first release is a straight conversion and a beta release.  There might be issues, so please report any issues on this thread.  In converting this mod, I thought about a few usability improvements and other such things, but didn't have time to tackle them now and have no idea when I will.  I welcome any contributions; please post on this thread.

This plugin requires one hack to a core script.  Normally, plugins should not require any hacks.  However, the archive feature of this plugin requires this hack.  The hack is being considered for the next major version of Coppermine (1.5.x).  For the 1.4.x series, you must apply this hack for the archive feature to work.  Read the README.txt file.

Known Issues (for version 1.02beta) - all present in the original mod/hack:
* A 'normal_' photo must exist for the photo of the day/week.
* If you set a new photo of the day/week, you must move the previous one to the archive manually in order for the new one to show up.

Version 1.01beta - commented out artifacts not relevant to this plugin from previously-copied sample plugins - one would affect using the 'onlinestats' plugin
Version 1.02beta - the 'meta_album' plugin hook hack has been fixed so it functions properly