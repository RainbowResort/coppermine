<?php
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.4.0                                            //
// ------------------------------------------------------------------------- //
// Copyright (C) 2002-2004 Gregory DEMAR                                     //
// http://www.chezgreg.net/coppermine/                                       //
// ------------------------------------------------------------------------- //
// Updated by the Coppermine Dev Team                                        //
// (http://coppermine.sf.net/team/)                                          //
// see /docs/credits.html for details                                        //
// ------------------------------------------------------------------------- //
// This program is free software; you can redistribute it and/or modify      //
// it under the terms of the GNU General Public License as published by      //
// the Free Software Foundation; either version 2 of the License, or         //
// (at your option) any later version.                                       //
// ------------------------------------------------------------------------- //
// $Id$
// ------------------------------------------------------------------------- //

if (!defined('E_STRICT')) {
    define('E_STRICT', 2048); // PHP 5
}

class cpg_debugger {
    // Define variables that store the old error reporting and logging states
    var $old_handler;
    var $old_display_level;
    var $old_error_logging;
    var $old_error_log;

    var $logfile;
    var $report;
    var $active;
    var $error_level;
    var $basepath_len;

    function cpg_debugger($log = 'debug.log') {
        $this->logfile = $log;
        $this->basepath_len = strlen(dirname(dirname(__FILE__)));
    }

    function start() {
        if (!$this->active) {
            $this->report = false;
            $this->old_display_level = ini_set('display_errors', 1);
            $this->old_error_logging = ini_set('log_errors', 0);

            $phpver = explode('.', phpversion());
            $phpver = "$phpver[0]$phpver[1]";
            if ($phpver < 43) {
                $this->old_handler = set_error_handler('cpg_error_handler');
            } else {
                $this->old_handler = set_error_handler(array(&$this, 'handler'));
            }
//            $this->old_error_log = ini_set('error_log', $this->logfile);
            $this->active = true;
        }
    }

    function stop() {
        if ($this->active) {
            // restore the previous state
            if ($this->old_handler) set_error_handler($this->old_handler);
            ini_set('display_errors', $this->old_display_level);
            ini_set('log_errors', $this->old_error_logging);
//            ini_set('error_log', $this->old_error_log);
            $this->active = false;
            return $this->report;
        }
    }

    // user defined error handling function
    function handler($errno, $errmsg, $filename, $linenum, $vars='')
    {
        global $CONFIG;
        $CONFIG['error_level'] = E_ALL;
        $filename = substr($filename, $this->basepath_len);
        $errortype = array (
//            E_ERROR           => 'Error',
            E_WARNING         => 'Warning',
//            E_PARSE           => 'Parsing Error',
            E_NOTICE          => 'Notice',
            E_CORE_ERROR      => 'Core Error',
            E_CORE_WARNING    => 'Core Warning',
            E_COMPILE_ERROR   => 'Compile Error',
            E_COMPILE_WARNING => 'Compile Warning',
            E_USER_ERROR      => 'CPG Error',
            E_USER_WARNING    => 'CPG Warning',
            E_USER_NOTICE     => 'CPG Notice',
            E_STRICT          => 'Runtime Notice'
        );
        // NOTE: E_ERROR, E_PARSE, E_CORE_ERROR, E_CORE_WARNING, E_COMPILE_ERROR and E_COMPILE_WARNING
        // error levels will be handled as per the error_reporting settings.
        if ($errno == E_USER_ERROR) {
            if (USER_IS_ADMIN) {
                $errmsg = $errortype[$errno]." $filename line $linenum: ".$errmsg;
            } else {
                $errmsg = "A error occured while processing this page.<br />Please report the following error to the owner of this website.<br /><br /><b>$errmsg</b>";
            }
            cpg_die(CRITICAL_ERROR, $errmsg, $filename, $linenum);
        }

        // set of errors for which a var trace will be saved
        if ($errno & $CONFIG['error_level']) {
            $this->report[$filename][] = $errortype[$errno]." line $linenum: ".$errmsg;
        }

        // save to the error log
        // error_log($err, 0); //message is sent to PHP's system logger
        // error_log($err, 1, 'operator@example.com'); //message is sent by email to the address in the destination
        // error_log($err, 3, $this->logfile); //message is appended to the file destination.
    }
}

function cpg_error_handler($errno, $errmsg, $filename, $linenum, $vars='') {
    global $cpgdebugger;
    $cpgdebugger->handler($errno, $errmsg, $filename, $linenum, $vars);
}

error_reporting(E_ALL);
$cpgdebugger =& new cpg_debugger();
$cpgdebugger->start();
?>
