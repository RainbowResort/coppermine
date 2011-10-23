<?php header("Content-type: text/css");

define('IN_COPPERMINE', true);

/*************************
album_directory plugin 1.0 for Coppermine 1.4.10 by wirewolf
http://academyphotos.net/
image preview css mod 
**************************/
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
$top = '0EM'; // sets the window position over the Image Preview Title 
$left = '5EM'; // sets the center window position over the Image Preview Title

/*************************
NOTE I suggest you don't edit the z-index's, or the position or display values!
*************************/

?>

.summary{
position: relative;
z-index: 24;
font-size:<?=$fonttitle?>;
font-family: <?=$fontfamily?>;
text-decoration: none;
}

.summary:hover{
background-color: transparent;
z-index: 25;
cursor:pointer; 
cursor:hand;
text-decoration: none;
}

.summary span{ 
position:absolute;
z-index: 100;
border:1px solid <?=$border?>;
background-color: <?=$background?>;
color: <?=$textcolor?>;
font-size:<?=$fontwindow?>;
font-family: <?=$fontfamily?>;
padding: 5px;
display:none;
text-align:left;
text-decoration: none;
filter:<?=$filter?>;
}

.summary:hover span{ 
display:inline;
text-decoration: none;
top: <?=$top?>;
left: <?=$left?>;
}
