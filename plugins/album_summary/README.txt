
Album Summary Plugin v1.0 by Frantz
with this plugin display the picture title list from a selected album:
* at first you will have the category list.
* by clicking on a category, you'll have the album list for this category
* by clicking on an album, you'll see the picture title for this album with preview pop up window by "hover"

To work properly, your pictures must have a title.
Install:
unzip package and upload album_directory folder as is to plugins folder and use plugin manager to install it.
if you're not sure, read - How to install plugins - http://coppermine-gallery.net/forum/index.php?topic=24327.0

Language:
english and french only available in the package. You can translate into your language, please share if you do.

Options within the preview script (adapted from wirewolf's preview mod):
you also have edit options in the album_summary_css.php file as well
At the top of this file, look for:

/*************************
edit the border, background and text colors; window width,
font sizes and number of thumbnails below for the preview
you can match to your theme. but if you use multiple themes
than I suggest leaving the border, background and text colors
as black #000000, white #FFFFFF and black #000000 respectively
*************************/

$border = '#000000'; // border color of the window
$background = '#FFFFFF'; // background color of the window. 
$textcolor = '#000000'; // text color in the window
$fonttitle = '11px'; // sets title font size
$fontwindow = '10px'; // sets window font size
$fontfamily = 'Verdana, Arial, Helvetica, sans-serif';
// comment out below line to remove shadow. works in IE only
$filter = 'progid:DXImageTransform.Microsoft.Shadow(color=gray,direction=135)';
/*************************
do not edit these next two lines! unless you feel like playing around!
You can use a '-' (minus) also to move the position. EM is a percentage '1EM or '-1EM',
or set actual pxs '-15px' or '15pxs' The position of the css window span is measured
from the left side of the Image Title - "This is a Title",
the span position (top) (left) would be at the start of the 'T' is the word 'This' 
*************************/
$top = '1EM'; // sets the window position over the Image Preview Title 
$left = '2EM'; // sets the center window position over the Image Preview Title

/*************************
NOTE I suggest you don't edit the z-index's, or the position or display values!
*************************/

For now I suggest leaving the default values. Try the script out and get used to it. 