<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2007 Coppermine Dev Team
  v0.1 originally written by Nitin Gupta

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  ********************************************
  Coppermine version: 1.5.0
  $HeadURL$
  $Revision: 2 $
  $LastChangedBy: xnitingupta $
  $Date: 6:01 PM 6/1/2007 $
**********************************************/

/**
 * Class specifying everthing about the display structure
 */
class displayspecs {
  var $userpersonalfields, $groupfields, $messagecode;

  function initialize() {
    // Database connection settings

    $this->userpersonalfields = array(
       'username', 'user_id', 'email', 'regdate', 'lastvisit', 'active', 'group_id'
    );

    $this->groupfields = array(
       'groupname', 'group_id', 'admin'
    );

    $this->messagecode = array(
       'success' => 0,
       'dbserver' => 1,
       'login_error' => 2,
       'unknown_query' => 3,
       'unknown_user' => 4,
       'no_perms' => 5,
       'install_error' => 6
    );
  }
}
?>