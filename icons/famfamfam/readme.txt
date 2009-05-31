Icon pack "FamFamFam" for Coppermine Photo Gallery cpg1.5.x, 
bundled by Joachim Mueller (aka "GauGau").
============================================================


Starting with cpg1.5.x, there is a feature that allows gallery 
admins to use a set of icons throughout the gallery or within a 
particular theme.

While Coppermine is released under GNU GPL, the famous "Silk 
icon set 1.3" (aka FamFamFam) by Mark James does not come with 
that particular license.
Therefor, the beautiful Silk icon set can not be bundled with 
Coppermine for legal reasons.
However, you're free to download this icon set that will feature 
part of the icons from the Silk icon set, renamed to fit the 
coppermine standards.
For the usage and license of the Silk icon set, please read and 
respect the license that comes with the original set:

	Silk icon set 1.3
	
	_________________________________________
	Mark James
	http://www.famfamfam.com/lab/icons/silk/
	_________________________________________
	
	This work is licensed under a
	Creative Commons Attribution 2.5 License.
	[ http://creativecommons.org/licenses/by/2.5/ ]
	
	This means you may use it for any purpose,
	and make any changes you like.
	All I ask is that you include a link back
	to this page in your credits.
	
	Are you using this icon set? Send me an email
	(including a link or picture if available) to
	mjames@gmail.com
	
	Any other questions about this icon set please
	contact mjames@gmail.com

==========================================================

Usage with coppermine: 
----------------------
unzip the archive's content into a temporary folder. 
If you wish to replace coppermine's default icons with the 
ones that come with this icon set, replace the files in 
./your_coppermine_folder/images/icons/ with the ones from this set.
If you want to use the silk icon set with a particular theme, copy
the content of this archive into 
./your_coppermine_folder/themes/your_custom_theme/images/icons/
To enable the use of per-theme icons, edit 
./your_coppermine_folder/themes/your_custom_theme/theme.php with 
a plain text editor and add
define('THEME_HAS_MENU_ICONS',16);
into a line of it's own somewhere between the starting and ending 
PHP tags.
