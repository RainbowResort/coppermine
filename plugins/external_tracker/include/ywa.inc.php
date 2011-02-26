<?php
/*********************************************
  Coppermine 1.5.x Plugin - External tracker
  ********************************************
  Copyright (c) 2009 - 2011 papukaija
  
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  $HeadURL$
  $Revision$
**********************************************/
$ext_js .= <<< EOT
<!-- Yahoo! Web Analytics - All rights reserved -->
<script type="text/javascript" src="http://d.yimg.com/mi/ywa.js"></script>
<script type="text/javascript">
/*globals YWA*/
var YWATracker = YWA.getTracker("{$row['tracker']}");
YWATracker.setDocumentGroup("Coppermine");
YWATracker.submit();
</script>
<noscript>
<div><img src="http://a.analytics.yahoo.com/p.pl?a={$row['tracker']}&js=no" width="1" height="1" alt="" /></div>
</noscript>
EOT;
?>
