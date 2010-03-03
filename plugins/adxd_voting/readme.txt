WHY
I have developed for my own need a photo contest plugin, to be used on a photography forum to evaluate several photo during a fixed period, and to identify the best one.

WHAT DOES IT DO
1) adds a new option in album configuraion: is this album a contest, and saves the data in a new column of the album table (YES / NO); Adds a table to keep detail of votes along with voter id for contests.
2) non contest albums have an unmodified behavior
3) Contest albums with voting ="YES":
- data are anonymized (no display of any info, owner_name, ...)
- voting shows only vote from the currently logged person (does not show the average)
- does not allow photo owner to vote for own photo
- shows a square around each photo in the film strip for which the current user has already voted
- only own comment can be seen (max 1 per person)
- image are not displayed as part of any of the pseudo-albums categories (such as best vote / most viewed / ...)
4) Contest albums with voiting ='NO'
- results of vote are displayed, but not possible to vote
- other capabilities are reset to normal.
5) automateed install / deinstall from plugin page.

SUPPORT
This is my first plugin; I'll be grateful to here any feedback / suggestion for improvement / bug report; however, I cannot systematically guarantee fast corrections. Thanks for your understanding.


Pascal (from round-planet.com)

Announcement thread:

http://forum.coppermine-gallery.net/index.php/topic,62496.0.html