<?php
// ------------------------------------------------------------------------- //
//  Coppermine Photo Gallery                                                 //
// ------------------------------------------------------------------------- //
//  Copyright (C) 2002,2003  Gr�gory DEMAR <gdemar@wanadoo.fr>               //
//  http://www.chezgreg.net/coppermine/                                      //
// ------------------------------------------------------------------------- //
//  Based on PHPhotoalbum by Henning St�verud <henning@stoverud.com>         //
//  http://www.stoverud.com/PHPhotoalbum/                                    //
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
// ------------------------------------------------------------------------- //

define('IN_COPPERMINE', true);
define('SEARCH_PHP', true);

require('include/init.inc.php');

pageheader($lang_search_php[0]);

starttable(500, $lang_search_php[0]);
echo <<< EOT
	<tr>
		<form method="get" action="thumbnails.php">
       	<input type="hidden" name="album" value="search">
       	<input type="hidden" name="type" value="full">
        <td class="tableb" align="center" height="60">
        	<input type="input" style="width: 90%" name="search" maxlength="255" value="" class="textinput">
		</td>
	</tr>
	<tr>
		<td colspan="8" align="center" class="tablef">
			<input type="submit" value="{$lang_search_php[0]}" class="button">
		</td>
		</form>
	</tr>

EOT;
endtable();
pagefooter();
ob_end_flush();
?>