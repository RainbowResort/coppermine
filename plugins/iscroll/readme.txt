	========
	iscroll for Coppermine v2.0
	========
	Author: Joe Carver aka "i-imagine"

	Coppermine: ver 1.4.26
	

   Based on mod. by rphMedia  http://forum.coppermine-gallery.net/index.php?action=profile;u=9702
   Plugin Written by Joe Carver - http://gallery.josephcarver.com/natural/ - http://i-imagine.net
   
   04 February 2010

	========
	
	This plugin will add a scoller to the main (home) page of a Coppermine Gallery.
	
	It is based on the work by  rphMedia and uses a SWF (flash) script to create the 
	scrolling display. Configuration options are for the number of thumbs to display,
	the META album/thumb set (lastup, toprated, most viewed and random) and the size 
	of the iscroll window on the page.
	
	========
	To install:
	
	1) Download the zip file to your computer
	
	2) Log in as admin and go to the Config page
	
	3) Open Album list view, in setting for "The content of the main page"
	add the value   iscroll   (example:  iscroll/breadcrumb/catlist/.......)
	
	4) Open General Settings - Manage Plugins, then use Browse - Upload - Install
	to install the iscroll plugin. Check your home page for the new display.
	
	5) You can now see "CONFIGURATION" in the plugin description.
	Open that link to set your options. You will see "Success!" after you Submit acceptable 
	values.
	
	6) To change the style of the thumbs you must replace file flow_link.swf. Within the 
	iscroll folder there are two folders with different thumb settings. To change, upload
	the newer flow_link.swf to your gallery root.
	
	
	INSTALLATION NOTES: The plugin relies on correct settings in Admin->	Config.
	->General Settings/URL of your coppermine gallery folder. 
	(example: http://mysite.tld/my_coppermine_folder/).
		
	========
	To uninstall:

	1) Use Plugin Manager to uninstall - use the advised instructions
	
	========
	
	
	To run this plugin with both www and http prefixes for your domain.

	Create a file named crossdomain.xml , copy and paste the following. 
	Add your domain where shown.
	
	<?xml version="1.0"?><crossdomain.xml>
	<cross-domain-policy>
	<allow-access-from domain="*.your-domain.com" />
	<allow-access-from domain="*www.your-domain.com" />
	</cross-domain-policy>

	Save (no extra spaces or lines at the end) and upload the file to your 
	gallery root directory. 

	The same formats also apply to subdomains in crossdomain.xml.
	The same formats can also apply to galleries in folders.
	ex. "......your-domain.com/coppermine" />
	
	
	========
	Credits:	
	
	1) rphMedia - for doing a lot of hard work creating the mod. and swf files
	
	2) The dev. team for snips from SEF URLs
	
	3) Timos Welt and his Slider Plugin for snips and inspiration 
	
	========
	Changelog
	
		- Version 2.1  -  04 February 2010
		
			- Change in codebase.php - $PHP_SELF check to add .js only on index pages
			
			- Change codebase.php for XHTML compliance
	

	
		- Version 2.0  -  04 February 2010
		
			- Change in flow_link.php - replace html characters to text
			
			- Change codebase.php to delete specific plugin records fom db - uninstall
			
			- Change codebase.php "INSERT IGNORE" now used for plugin vars. to db - install
						
			- Config page changes, cosmetic and functional
			
			- Add minimum version check to configuration.php - must be > cpg1.4.23 to install
						
		
		
		- Version 1.1  -  09 October 2009
		
			- Change in codebase.php from 'allowScriptAccess','always' to 'allowScriptAccess','sameDomain'
			
			- Change in flow_link.php to select 'files not like youtube' (beta change, need confirming test)
			
			- Change default set of images from 5 large to 17 small
						
			- Config page changes, default count and size setting adjusted
			
			
		- Release Version 1.0 - 25 August 2009
				
	
	========	

	
	
	
	
	========
	end