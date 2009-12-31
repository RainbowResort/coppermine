
				LightBox ver 1.0 for Coppermine
				Author: Joe Carver aka "i-imagine" 
	 ========
	 * Coppermine version: 1.5.x
	 *
	 * LightBox plugin ver 1.0 for Coppermine
	 *
	 * Plugin Written by Joe Carver - http://gallery.josephcarver.com/natural/ - http://i-imagine.net/artists/ - http://photos-by.joe-carver.com/
	 * Based on plugin by jeepguy_1980 and mod. by Sander Weyens
	 * 27 December 2009
	 * 
	 *  Using NFLightbox Copyright (c) 2009, Helori LAMBERTY NotesFor.net
	 *
	 ========
	
	This plugin will override the default popup that shows the fullsize picture and 
	will show a LightBox instead. Options to set include adding image captions, a "nofollow"
	attribute, border sizes and slideshow timing.
	
	It uses NFLightbox Copyright (c) 2009, Helori LAMBERTY NotesFor.net which has been
	modified for Coppermibe 1.5.x by Joe Carver. Snips from the Coppermine 1.4.x LightBox Slideshow
	have been used for some of the modifications. The plugin also depends on the jsquery 
	built into cpg 1.5.x
	
	========
	
	To install:
	
	1) Download the zip file to your computer
	
	2) Log in as admin and install with Plugin Manager
	
	3) Enjoy it
	
	========
	
	All major functions can be changed through the plugin configuration page.
	
		1) Set visual slideshow timer bar. The plugin can show a counting timer for the 
		slideshow. It can be CPU intensive and slow the pages for your visitors.
		Default is OFF - no timer bar.
		
		2) Return on exit setting allows for the page to refresh with either the last 
		or the first slide seen. Default is last slide.
		
		3) Show image captions - default is yes. Some users that have very long captions
		might want to use no/off. The captions will occupy screen space that the image can use.
		
		4) Add atttribute "nofollow" to LightBox links. This will tell search engines not to 
		follow and list the links to help prevent listing excess duplicate content.
		Default is yes, add "nofollow".
		
		5) Set slideshow timer interval - set by millisecond. {6000 = 6 seconds, 7500 = 7.5 seconds)
		Should not be set to very short times to allow for next image preload. 
		Default is 6 seconds - 6000.
		
		6) Set image swap time - set by millisecond. (500 = 1/2 second) Too fast will make image change
		unpleasant. Default is 820.
		
		7) Set width of border in pixels. Default is 8.
		
		8) Set number of files in album to list for Slideshow. Will limit the number of links/files
		in Piclist (slideshow list) on each displayimage page. Large albums and/or galleries might 
		want to limit the value. For example: "Lastup" from the home page leads to all links 
		in a gallery. The corresponding displayimage.php page then would have all of those links listed
		for the LightBox.
		Default is 1 (all files)
	
	========
	
	To uninstall:

	1) Use Plugin Manager to uninstall
	
	========
	
	Credits:	
	
	1) jeepguy_1980 for LightBox plugin code
	
	2) Sander Weyens for LightBox .js mods and Coppermine mod.
	
	3) Helori LAMBERTY - NotesFor.net for NFLightBox 
	
	4) Timos Welt and Joachim Muller for EnlargeIt! counter.php
	
	========

	
		To Do:
		
		- nf.lightbox.css + .css for plugin needs work
	
		- config page 
	
	========
	
	*  Using NFLightbox Copyright (c) 2009, Helori LAMBERTY NotesFor.net
	*  Copyright Notice to remain with file

[===========================================================================]
[   Copyright (c) 2009, Helori LAMBERTY                                     ]
[   All rights reserved.                                                    ]
[                                                                           ]
[   Redistribution and use in source and binary forms, with or without      ] 
[   modification, are permitted provided that the following conditions      ]
[   are met:                                                                ]
[                                                                           ]  
[   * Redistributions of source code must retain the above copyright        ]
[   notice, this list of conditions and the following disclaimer.           ]
[                                                                           ]
[   * Redistributions in binary form must reproduce the above copyright     ]
[   notice, this list of conditions and the following disclaimer in         ]
[   the documentation and/or other materials provided with the              ]
[   distribution.                                                           ]
[                                                                           ]
[   * Neither the name of NotesFor.net nor the names of its                 ]
[   contributors may be used to endorse or promote products derived         ]
[   from this software without specific prior written permission.           ]   
[                                                                           ]
[   THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS     ]
[   "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT       ]
[   LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR   ]
[   A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT    ]
[   OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,   ]
[   SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT        ]
[   LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,   ]
[   DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY   ]
[   THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT     ]
[   (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE       ] 
[   USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH        ] 
[   DAMAGE.                                                                 ]
[===========================================================================]
*/
	
	========
	end
