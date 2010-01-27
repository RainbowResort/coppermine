	////////////////

	reCAPTCHA plugin v2.6 for Copppermine

	Author: Joe Carver aka "i-imagine"

	Coppermine: ver 1.4.25 

	Coppermine Support Forum Thread: http://forum.coppermine-gallery.net/index.php/topic,60626.0.html

	///////////////

	This plugin will install reCAPTCHA - a powerful method for stopping spam bots.

	To install:

	1) Download recaptcha.zip to your computer

	2) Login, go to plugin manager and uninstall Captcha 3.0 if you have it

	3) Use plugin manager to Browse - Upload - Install   recaptcha.zip

	4) If you don't have the recaptcha keys yet click "Sign Up" to open a new window

	where you can sign up your domain. Your domain name is passed to recaptcha for easy

	signup. If you have the keys skip to 5)

	5) Copy and Paste your keys into the form (no extra spaces allowed) - press Go!

	You are done!

	//////////////////////////////////

	To uninstall - use this only if you can't log in. Otherwise use Plugin Manager.

	1) Use your ftp program to delete the file recaptcha_config.php. The plugin will now not run.

	2) Log in and use plugin manager to uninstall/delete the plugin

	//////////////////////////////////

	To Customize by Configuration File - Edit the file recaptcha_config.php

	- add or remove user groups >>> edit array >>> $CAPTCHA_DISABLE

	- change style/color of recaptcha widget >>> edit value >>> $recapt_thme

	- change language in recaptcha widget (get new, help, etc.) >>> edit value >>>  $recapt_lang

	//////////////////////////////////

	Lang files used, but need translation!

	//////////////////////////////////

	USE THESE INSTRUCTIONS TO INSTALL A CONTACT FORM WITH RECAPTCHA

	===================================
	Contact Form with reCAPTCHA v.9
	===================================
	
	 This form is made to work the plugin reCAPTCHA for Coppermine Photo Gallery
	 http://forum.coppermine-gallery.net/index.php/topic,60626.0.html
	 
	 It will allow users to send a messge to the Gallery Administrator by php mail.
	 
	 The mail is sent to the gallery admin address entered in config. (the email you
	 entered when you installed Coppermine. The user must solve the captcha before sending
	 the message. On error or success a notice is shown/returned to the user.
	

	===================================
	
	To Install:
	
	1) Log in, go to Admin - Config - Themes settings and enter the following
	
			Custom menu link name =   Contact
			
			Custom menu link URL =    index.php?file=recaptcha/echo
			
	2) Save the new settings, you now have a menu link leading to the new Contact Form
	
	===================================
	
	Notes;
	
	- Form was orginally made for narrow theme (600px). 
	Change/edit the table and td sizes as you like to fit your theme.
	
	- Text entered into form is filtered before the mail is sent. 
	This will change and remove links / http commands and some text formatting
	when you receive the mail.  
	
	For examples:   <1> me 		will be      &ampltl&ampgt me
	
	apostrophe's and stuff"s    will be      apostrophe&#39s and stuff&ampquots
	
	===================================	


	===================================
	
	
	
	//////////////////////////////////	

	Changelog:



	15 July, 2009		Release version 1.0 - posted on Coppermine Support forum



	18 July, 2009		Release version 1.1

				

					- Add reCaPTCHA language to config. options



					- Add reCaPTCHA theme options to config. 

						

					- Change captcha error return to preserve user input



					- remove noscript text from comments



					- add multi language support, now using plugin lang. files for all text

					

	

	2 August, 2009		Release of Version 2.0

	

					- Installation now through Plugin Manager - no mods. needed

					

					- Sign Up link forwards domain info and 'Coppermine Photo Gallery'


	
	16 August, 2009		Maintenance/Bugfix Release of Version 2.1

	
					- Users could not post multiple comments on the same file

					

					- Comment edit and delete functions were lost
					
					
					- (Both issues due to reCAPTCHA restriction of one captcha per page)
					
					
					
	23 September, 2009		Maintenance/Bugfix Release of Version 2.2

	
					- Remove extra quote (typo) in page header line					
					

					- Change regular expression to replace in Comments


					
	27 September, 2009		Maintenance/Bugfix Release of Version 2.3

	
					- Select error for button languages
					
					

	28 September, 2009		Maintenance/Bugfix Release of Version 2.4

	
					- Typo errors in recaptcha_config.php - users array
					
					
					- Add Contact form to package


	04 October, 2009		Maintenance/Bugfix Release of Version 2.5

	
					- Fix "conflict" with Slider plugin (<head> html would get over-write by Slider)
					
					
					- Change regular expression to replace in Registration
					
					
					- Misc html and lang. file cleanup


	22 Jnauary, 2010		Maintenance/Bugfix Release of Version 2.6

	
					- codebase.php change sql db query commands from insert into to insert into ignore
					
					- codebase.php change sql db query commands to delete specific records

//////////////////////////////////



	To Do:

		- Create option: Link reCAPTCHA lang  directly to Coppermine lang



		- Translations for language files 

		

		- String clean, key input - will be difficult - see this thread:
		http://groups.google.com/group/recaptcha/browse_thread/thread/e9a79b26927a2377#
		
	

		- Format/style adjustments, compliance conform - need more info reCAPTCHA

		

		- Config. page select recaptcha options



//////////////////////////////////



_end