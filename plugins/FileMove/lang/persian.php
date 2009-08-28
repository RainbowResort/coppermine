<?php
/******************************
  Coppermine Plugin "File Move"
  *****************************
  Copyright (c) 2003-2009 François Keller

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.
  ********************************************
  Coppermine version: 1.5.x
  $Source: /cvsroot/cpg-contrib/master_template/codebase.php,v $
  $Revision: 1.3 $
  $Author: donnoman $
  $Date: 2005/12/08 05:46:49 $
**********************************************/

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...'); }

$lang_plugin_file_move = array(
  'display_name'    => 'File Move',			// Display Name
  'config_title'    => 'تنظیمات پلاگین',			// Title of the button on the gallery config menu
  'config_button'   => 'File Move',				// Label of the button on the gallery config menu
  'install_note'    => 'برای تنظیم پلاگین از دکمه اضافه شده به منوی مدیریت استفاده کنید.',	// Note about configuring plugin
  'install_click'   => 'برای نصب بر روی دکمه کلیک کنید.',	// Message to install plugin
  'folder_name'     => 'پوشه را که میخواهید جابجا کنید انتخاب کنید.',
  'folder_ar'				=> 'پوشه مقصد را انتخاب کنید.',
  'some_files'			=> 'جابجا کردن فایل',
  'choix'						=>'انتخاب نوع عمل',
  'choix2'					=>'چه کاری میخواهید انجام دهید ، انتخاب کنید',
  'confirm'					=>'تایید انتخاب',
  'confirm_titre' 	=>'<b>شما این پوشه های را انتخاب کرده اید:</b>',
  'confirm_files' 	=>'<b>شما این فایل ها را انتخاب کرده اید:</b>',
  'folder'					=> 'جابجایی کل پوشه',
  'DFolder'					=> 'پوشه مبدا : ',
  'AFolder'					=> 'پوشه مقصد : ',
  'to'							=>' به ',
  'error'      			=> 'خطا!',
  'file'	  				=> 'فایل',
  'files'						=> 'فایلها',
  'valid'						=> 'تائید',
  'continue' 				=> 'ادامه',
  'back'						=> 'بازگشت',
  'transfer'				=> 'ارسال محتوای ',
  'transfer_file' 	=> 'ارسال چند فایل از ',
  'folder2'					=> 'پوشه ',
  'folder_error'		=> 'خطا ، پوشه مورد نظر وجود ندارد !',
  'traitement'			=> ' فایلها ارسال شدند.',
);
?>