<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2009 Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  Coppermine version: 1.5.x
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**********************************************/

/* Create signon session */
$session_name = 'phpmyadminsession';
session_name($session_name);
session_start();

/* Store their credentials */
$_SESSION['PMA_single_signon_user'] = '';
$_SESSION['PMA_single_signon_password'] = '';
$_SESSION['PMA_single_signon_host'] = '';
   
/* Close that session */
session_write_close();

echo "<script>parent.location='../../index.php';</script>";