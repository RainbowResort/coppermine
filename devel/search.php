<?php
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.4.0                                            //
// ------------------------------------------------------------------------- //
// Copyright (C) 2002-2004 Gregory DEMAR                                     //
// http://www.chezgreg.net/coppermine/                                       //
// ------------------------------------------------------------------------- //
// Updated by the Coppermine Dev Team                                        //
// see /docs/credits.html for details                                        //
// ------------------------------------------------------------------------- //
// This program is free software; you can redistribute it and/or modify      //
// it under the terms of the GNU General Public License as published by      //
// the Free Software Foundation; either version 2 of the License, or         //
// (at your option) any later version.                                       //
// ------------------------------------------------------------------------- //
// $Id$
// ------------------------------------------------------------------------- //

define('IN_COPPERMINE', true);
define('SEARCH_PHP', true);

require('include/init.inc.php');

pageheader($lang_search_php['title']);
echo <<< EOT
<script language="javascript" type="text/javascript">
<!--
document.searchcpg.search.focus();
-->
</script>
<form method="get" action="thumbnails.php" name="searchcpg">
EOT;


starttable('100%', $lang_search_php['title']);
echo <<< EOT
        <tr>
            <td class="tableb" align="center">
                <input type="input" style="width: 80%" name="search" maxlength="255" value="" class="textinput">
                <input type="submit" value="{$lang_search_php['submit_search']}" class="button">
                <input type="hidden" name="album" value="search">
                <input type="hidden" name="type" value="full">
            </td>
        </tr>
</form>

EOT;
endtable();
if ($CONFIG['clickable_keyword_search'] != 0) {
    include('include/keyword.inc.php');
}
pagefooter();
ob_end_flush();

?>