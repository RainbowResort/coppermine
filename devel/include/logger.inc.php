<?php
// ------------------------------------------------------------------------- //
//  Coppermine Photo Gallery                                                 //
// ------------------------------------------------------------------------- //
//  Copyright (C) 2002,2003  Gregory DEMAR                                   //
//  http://www.chezgreg.net/coppermine/                                      //
// ------------------------------------------------------------------------- //
//  Based on PHPhotoalbum by Henning Stverud <henning@stoverud.com>          //
//  http://www.stoverud.com/PHPhotoalbum/                                    //
// ------------------------------------------------------------------------- //
// Updated by the Coppermine Dev Team                                        //
// (http://coppermine.sf.net/team/)                                          //
// see /docs/credits.html for details                                        //
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
// ------------------------------------------------------------------------- //

function log_write( $text, $log = null ) {
        if (is_null($log)) {
                $log = 'global';
        }

        $log = 'logs/'.$log.'.php';

        if (!file_exists($log)) {
                $log_header = readfile('logs/log_header.inc.php');
        }

        $fp = fileopen($log,'a');
        fwrite($log_header);
        fwrite($text);
        fclose($fp);
}

function log_read( $log = null ) {
        if (is_null($log)) {
                $log = 'global';
        }

        $log = 'logs/'.$log.'.php';
        
        @include($log);
}
?>
