<?php
/**************************************************
  Coppermine 1.5.x Plugin - Check files
  *************************************************
  Copyright (c) 2012 eenemeenemuu
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**************************************************/

if (!GALLERY_ADMIN_MODE) {
    cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
}

// Check the albums directory recursively for files that weren't added to the database (yet)

?>