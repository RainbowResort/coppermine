<?php
/********************************************************
  Coppermine 1.5.x plugin - FetchContent
  *******************************************************
  Copyright (c) 2010 Coppermine dev team
  *******************************************************
  This program is free software; you can redistribute 
  it and/or modify it under the terms of the GNU General
  Public License as published by the Free Software
  Foundation; either version 3 of the License, or 
  (at your option) any later version.
  *******************************************************
  $HeadURL: https://coppermine.svn.sourceforge.net/svnroot/coppermine/branches/cpg1.5.x/plugins/fetchcontent/image.php $
  $Revision: 7091 $
  $LastChangedBy: gaugau $
  $Date: 2010-01-18 19:32:22 +0100 (Mo, 18. Jan 2010) $
  *******************************************************/
  
if (!defined('IN_COPPERMINE')) { // Make sure this page is not being accessed directly 
    die('Not in Coppermine...');
}

// Parameters from the URL
$tableid = 'tableid';

echo <<< EOT
document.write('    <table border="1" cellspacing="0" cellpadding="0" class="fc_table" id="{$tableid}">');
document.write('        <tr>');
document.write('            <td class="fc_tablecell">');
document.write('                <img src="{$CONFIG['site_url']}?file=fetchcontent/image&pid=25&size=2" border="0" alt="" id="fc_cell_{$i}" class="fc_cell" />');
document.write('            </td>');
document.write('        </tr>');
document.write('    </table>');
EOT;
?>