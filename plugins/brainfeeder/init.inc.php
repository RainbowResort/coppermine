<?php
 /**
 *
 * BrainFeeder for CPG
 * Version 1.0 Beta relase
 * written  by Hallvard Natvik <hallvard@natvik.com>
 * Send me a mail if you use it
 * 
 * This is free software made available to you without any guarantees or obligations
 * You can use this sofware anyway you like.
 *------------------------------------------------------------
 * This file contains config-variables
 */

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...');}

$CONFIG['TABLE_brainfeeder'] = $CONFIG['TABLE_PREFIX'] . "brainfeeder";
$CONFIG['BF_db_ver'] = 5; //Defines the required version of the brainfeeder table(s)
