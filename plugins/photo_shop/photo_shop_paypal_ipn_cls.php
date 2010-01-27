<?php
/**************************************************
  CPG Photo Shop Plugin for Coppermine Photo Gallery
  *************************************************
  Copyright (c) 2006 Thomas Lange <stramm@gmx.net>
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  *************************************************
  Coppermine version: 1.4.19
  Photo Shop version: 1.4.0
  $Revision: 1.0 $
  $Author: stramm $
***************************************************/

class photo_shop_paypal_class {

   var $last_error;                 // holds the last error
   var $ipn_log;                    // bool: log IPN results
   var $ipn_log_file;               // filename of the log
   var $ipn_response;               // holds the IPN response
   var $ipn_data = array();         // contains the POST values


   function photo_shop_paypal_class () {

      // initialization constructor.  Called when class is created.
	  global $CONFIG;
      $this->last_error = '';
      $this->ipn_log = $CONFIG['photo_shop_paypal_ipn_log'];
      $this->ipn_log_file = $CONFIG['photo_shop_paypal_ipn_logfile'];
      $this->ipn_response = '';
   }


   function photo_shop_validate_ipn() {
	  global $CONFIG;
      // parse the paypal URL
      $url_parsed=parse_url($CONFIG['photo_shop_paypal_form_url']);
      // generate the post string from the _POST vars aswell as load the
      // _POST vars into an arry so we can play with them from the calling
      // script.
      $post_string = '';
      foreach ($_POST as $field=>$value) {
         $this->ipn_data["$field"] = $value;
         $post_string .= $field.'='.urlencode(stripslashes($value)).'&';
      }
      $post_string.="cmd=_notify-validate"; // append ipn command

      // open the connection to paypal
      $fp = fsockopen($url_parsed[host],"80",$err_num,$err_str,30);
      if(!$fp) {

         // could not open the connection.  If loggin is on, the error message
         // will be in the log.
         $this->last_error = "fsockopen error no. $errnum: $errstr";
         $this->photo_shop_log_ipn_results(true);
         return false;

      } else {

         // Post the data back to paypal
         fputs($fp, "POST $url_parsed[path] HTTP/1.1\r\n");
         fputs($fp, "Host: $url_parsed[host]\r\n");
         fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
         fputs($fp, "Content-length: ".strlen($post_string)."\r\n");
         fputs($fp, "Connection: close\r\n\r\n");
         fputs($fp, $post_string . "\r\n\r\n");

         // loop through the response from the server and append to variable
         while(!feof($fp)) {
            $this->ipn_response .= fgets($fp, 1024);
         }

         fclose($fp); // close connection

      }

      if (eregi("VERIFIED",$this->ipn_response)) {

         // Valid IPN transaction.
         $this->photo_shop_log_ipn_results(true);
         return true;

      } else {

         // Invalid IPN transaction.  Check the log for details.
         $this->last_error = 'IPN Validation Failed.';
         $this->photo_shop_log_ipn_results(true);
         return false;

      }

   }

   function photo_shop_log_ipn_results($success) {

      if (!$this->ipn_log == '1') return;  // is logging turned off?

      // Timestamp
      $text = '['.date('m/d/Y g:i A').'] - ';

      // Success or failure being logged?
      if ($success) $text .= "SUCCESS!\n";
      else $text .= 'FAIL: '.$this->last_error."\n";

      // Log the POST variables
      $text .= "IPN POST Vars from Paypal:\n";
      foreach ($this->ipn_data as $key=>$value) {
         $text .= "$key=$value, ";
      }

      // Log the response from the paypal server
      $text .= "\nIPN Response from Paypal Server:\n ".$this->ipn_response;

      // Write to log
      $fp=fopen($this->ipn_log_file,'a');
      fwrite($fp, $text . "\n\n");

      fclose($fp);  // close file
   }

}



