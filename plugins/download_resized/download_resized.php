<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2005 Coppermine Dev Team
  v1.1 originaly written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  *************************************************
  Coppermine version: 1.4.13
  Download Resized version: 1.2
  $Author$
**********************************************/

$image = $superCage->get->getRaw('image');
$filename = $superCage->get->getRaw('filename');
Header ("Content-type: image/jpeg");
Header('Content-Disposition: attachment; filename="'.$filename.'"');
$tmp = file_get_contents($image);
echo $tmp;

?>