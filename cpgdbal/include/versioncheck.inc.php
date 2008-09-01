<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2008 Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  Coppermine version: 1.5.0
  $HeadURL$
  $Revision: 4787 $
  $LastChangedBy: gaugau $
  $Date: 2008-08-08 20:08:16 +0530 (Fri, 08 Aug 2008) $
**********************************************/

/*
Dev note: I had to re-design the versioncheck page to make the code less cluttered. 
As a result, the changes applied by Sander to make this page fit into the new installer 
are gone. Please do not re-introduce those changes: they were bad in the first place. 
Instead, the installer needs to be reviewed. I updated the installer a little bit to make 
sure it doesn't break entirely, however I suggest re-designing the installer without the 
OO-approach: only use OO where it makes sense and if you have no dependencies. 
This is not the case: coppermine has been built the old-school way (with OO), and there 
is little benefit in the OO-tech of the new installer. It doesn't have to be re-built from 
scratch though. 
Further discussion should be led on the dev board. 
Joachim 2008-08-08
*/

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...');}

// define some vars
$textFileExtensions_array = array(
  'php', 'txt', 'htm', 'html', 'js', 'css', 'sql'
);

$imageFileExtensions_array = array(
  'jpg', 'png', 'gif'
);
$subversionRepository = 'http://coppermine.svn.sourceforge.net/viewvc/coppermine/trunk/';

$maxLength_array = array();
$maxLength_array['counter'] = strlen($lang_versioncheck_php['counter']);
$maxLength_array['folderfile'] = strlen($lang_versioncheck_php['type']);
$maxLength_array['fullpath'] = strlen($lang_versioncheck_php['path']);
$maxLength_array['exist'] = strlen($lang_versioncheck_php['missing']);
$maxLength_array['readwrite'] = strlen($lang_versioncheck_php['permissions']);
$maxLength_array['version'] = strlen($lang_versioncheck_php['version']);
$maxLength_array['revision'] = strlen($lang_versioncheck_php['revision']);
$maxLength_array['coment'] = strlen($lang_versioncheck_php['comment']);

function cpg_get_path_and_file($string) {
    // check if $string contains delimiter that triggers replacement
    $return['path'] = str_replace(str_replace('/', '', strrchr($string, '/')), '', $string);
    $return['file'] = str_replace('/', '', strrchr($string, '/'));
    if (strstr($return['path'], '.') != FALSE && $return['file'] == '') {
        $return['file'] = $return['path'];
        $return['path'] = '';
    }
    if (strstr($return['file'], '.') == FALSE) {
        $return['path'] = $return['path'].$return['file'];
        $return['file'] = '';
    }
    return $return;
}

function cpg_is_writable($folder){
  $return = 0;
  $file_content = "this is just a test file that hasn't been deleted properly.\nIt's safe to delete it now";
  @unlink($folder.'/cpgvc_tf.txt');
  if ($fd = @fopen($folder.'/cpgvc_tf.txt', 'w')) {
      @fwrite($fd, $file_content);
      @fclose($fd);
      @unlink($folder.'/cpgvc_tf.txt');
      $return = 'write';
  } else {
      $return = 'read';
  }
  return $return;
}

function cpg_fillArrayFieldWithSpaces($text, $maxchars, $fillUpOn = 'right') {
  $spaceCharsToAdd = $maxchars - strlen($text);
  if ($spaceCharsToAdd > 0) {
    for ($i = 1; $i <= $spaceCharsToAdd; $i++) {
      if ($fillUpOn != 'left') {
        $text .= ' ';
      } else {
        $text = ' '.$text;
      }
    }
  }
  return $text;
}

function cpg_versioncheckDisplayOptions() {
  global $CPG_PHP_SELF, $lang_versioncheck_php, $optionDisplayOutput_array;
  print '<form name="options" action="'.$CPG_PHP_SELF.'" method="get">';
  print <<< EOT
<table align="center" width="100%" cellspacing="1" cellpadding="0" class="maintable">
  <tr>
          <td class="tableh1" colspan="2">{$lang_versioncheck_php['options']}</td>
  </tr>
  <tr>
    <td class="tableb" valign="top">
      {$lang_versioncheck_php['display_output']}
    </td>
    <td class="tableb" valign="top">
      <input type="radio" name="output" id="output_screen" value="screen" class="radio" {$optionDisplayOutput_array['screen']} /><label for="output_screen" class="clickable_option">{$lang_versioncheck_php['on_screen']}</label>&nbsp;&nbsp;
      <input type="radio" name="output" id="output_textarea" value="textarea" class="radio" {$optionDisplayOutput_array['textarea']} /><label for="output_textarea" class="clickable_option">{$lang_versioncheck_php['text_only']}</label>
    </td>
  </tr>
  <tr>
    <td class="tableb tableb_alternate" valign="top">
      <label for="errors_only">
        {$lang_versioncheck_php['errors_only']}
      </label>
    </td>
    <td class="tableb tableb_alternate" valign="top">
      <input type="checkbox" name="errors_only" id="errors_only" value="1" class="checkbox" {$optionDisplayOutput_array['errors_only']} />
    </td>
  </tr>
  <tr>
    <td class="tableb" valign="top">
      <label for="do_not_connect_to_online_repository">
        {$lang_versioncheck_php['do_not_connect_to_online_repository']}
      </label>
    </td>
    <td class="tableb" valign="top">
      <input type="checkbox" name="do_not_connect_to_online_repository" id="do_not_connect_to_online_repository" value="1" class="checkbox" {$optionDisplayOutput_array['do_not_connect_to_online_repository']} />({$lang_versioncheck_php['online_repository_explain']})
    </td>
  </tr>
  <tr>
    <td align="center" class="tablef" colspan="2">
      <input type="submit" name="submit" value="{$lang_versioncheck_php['submit']}" class="button" />
    </td>
  </tr>
</table>
EOT;
  print '</form>';
  print '<br />';
}

function cpg_versioncheckPopulateArray($file_data_array) {
    global $displayOption_array, $textFileExtensions_array, $imageFileExtensions_array, $CONFIG, $maxLength_array, $lang_versioncheck_php;
    $extensionMatrix_array = array(
      'unknown' => 'images/extensions/unknown.gif',
      'folder' => 'images/extensions/folder.gif',
      'php' => 'images/extensions/php.gif',
      'js' => 'images/extensions/js.gif',
      'css' => 'images/extensions/css.gif',
      'htm' => 'images/extensions/htm.gif',
      'html' => 'images/extensions/htm.gif',
      'sql' => 'images/extensions/sql.gif',
      'ttf' => 'images/extensions/ttf.gif',
      'ico' => 'images/extensions/unknown.gif',
    );

    $loopCounter = 0;
    foreach ($file_data_array as $file_data_key => $file_data_values) { // start the foreach loop
	    $file_data_array[$file_data_key]['comment'] = '';
	    // Replace the placeholders with actual content --- start
	    $file_data_array[$file_data_key]['fullpath'] = str_replace('**fullpath**', rtrim($CONFIG['fullpath'], '/'), $file_data_array[$file_data_key]['fullpath']);
	    $file_data_array[$file_data_key]['fullpath'] = str_replace('**userpics**', rtrim($CONFIG['userpics'], '/'), $file_data_array[$file_data_key]['fullpath']);
	    // Replace the placeholders with actual content --- end
	    // populate the path and file from the fullpath --- start
	    $tempArray = cpg_get_path_and_file($file_data_array[$file_data_key]['fullpath']);
	    $file_data_array[$file_data_key]['folder'] = $tempArray['path'];
	    $file_data_array[$file_data_key]['file'] = $tempArray['file'];
	    // populate the path and file from the fullpath --- end
	    // determine the number of parent folders --- start
	    $file_data_array[$file_data_key]['folderDepth'] = count(explode('/', rtrim($tempArray['path'], '/')));
	    if (strlen($file_data_array[$file_data_key]['folder']) > $maxLength_array['folder']) {
	      $maxLength_array['folder'] = strlen($file_data_array[$file_data_key]['folder']);
	    }
	    // determine the number of parent folders --- end
        // Determine the icon -- start
        if ($file_data_array[$file_data_key]['file'] == '') {
            // we have a folder here --- start
            $file_data_array[$file_data_key]['icon'] = '<img src="'.$extensionMatrix_array['folder'].'" border="0" width="16" height="16" alt="" style="margin-left:'. (16 * ($file_data_array[$file_data_key]['folderDepth'] - 1)) . 'px" />';
            // we have a folder here --- end
        } else {
            // we have a file here --- start
            // determine the extension -- start
            $file_data_array[$file_data_key]['extension'] = ltrim(substr($file_data_array[$file_data_key]['file'],strrpos($file_data_array[$file_data_key]['file'],'.')),'.');
            // determine the extension -- end
            // determine the icon representing the file -- start
            if (array_key_exists($file_data_array[$file_data_key]['extension'],$extensionMatrix_array) == TRUE) {
                $file_data_array[$file_data_key]['icon'] = '<img src="'.$extensionMatrix_array[$file_data_array[$file_data_key]['extension']].'" border="0" width="16" height="16" alt="'.$file_data_array[$file_data_key]['extension'].'" style="margin-left:'. (16 * $file_data_array[$file_data_key]['folderDepth']) . 'px" />';
            } elseif (in_array($file_data_array[$file_data_key]['extension'],$imageFileExtensions_array)) {
                $file_data_array[$file_data_key]['icon'] = '<img src="images/extensions/'.$file_data_array[$file_data_key]['extension'].'.gif" border="0" width="16" height="16" alt="'.$file_data_array[$file_data_key]['extension'].'" style="margin-left:'. (16 * $file_data_array[$file_data_key]['folderDepth']) . 'px" />';
            } else {
                $file_data_array[$file_data_key]['icon'] = '<img src="'.$extensionMatrix_array['unknown'].'" border="0" width="16" height="16" alt="'.$file_data_array[$file_data_key]['extension'].'" style="margin-left:'. (16 * $file_data_array[$file_data_key]['folderDepth']) . 'px" />';
            }
            // determine the icon representing the file -- end            
            // we have a file here --- end
        }
        // Determine the icon -- end
	    // Is the folder/file actually there --- start
	    $file_data_array[$file_data_key]['exists'] = file_exists($file_data_array[$file_data_key]['fullpath']);
	    // Is the folder/file actually there --- end
	    if ($file_data_array[$file_data_key]['exists'] != 1) { 
		    // The folder/file is missing --- start
	        if ($file_data_array[$file_data_key]['status'] == 'mandatory') {
	          $file_data_array[$file_data_key]['txt_missing'] = $lang_versioncheck_php['mandatory'];
	          $file_data_array[$file_data_key]['comment'] .= $lang_versioncheck_php['mandatory'];
	        } else {
	          $file_data_array[$file_data_key]['txt_missing'] = $lang_versioncheck_php['optional'];
	        }
	        if (strlen($file_data_array[$file_data_key]['txt_missing']) > $maxLength_array['exist']) {
	          $maxLength_array['exist'] = strlen($file_data_array[$file_data_key]['txt_missing']);
	        }
	         // The folder/file is missing --- end
	    } else {
		    // The folder/file exists --- start
		    if ($file_data_array[$file_data_key]['file'] == '') { 
			  // we have a folder here --- start
		      $file_data_array[$file_data_key]['txt_folderfile'] = $lang_versioncheck_php['folder'];
		      // no version or revision number for folder names
		      $file_data_array[$file_data_key]['txt_version'] = $lang_versioncheck_php['not_applicable'].' ('.$lang_versioncheck_php['ok'].')';
		      $file_data_array[$file_data_key]['txt_revision'] = $lang_versioncheck_php['not_applicable'].' ('.$lang_versioncheck_php['ok'].')';
		      $file_data_array[$file_data_key]['local_version'] = '';
		      $file_data_array[$file_data_key]['local_revision'] = '';
		      if (is_readable($file_data_values['fullpath']) == TRUE) { // check if the folder is readable/writable --- start
		        // Sadly, is_readable doesn't really work on all server setups
		        $file_data_array[$file_data_key]['local_readwrite'] = 'read';
		        $file_data_array[$file_data_key]['local_readwrite'] = cpg_is_writable($file_data_array[$file_data_key]['fullpath']);
		        if (is_writable($file_data_values['fullpath']) == TRUE) {
		          $file_data_array[$file_data_key]['local_readwrite'] = 'write';
		        }
		      } // check if the folder is readable/writable --- end
			  // we have a folder here --- end
		    } else {
                // we have a file here --- start
                $file_data_array[$file_data_key]['txt_folderfile'] = $lang_versioncheck_php['file'];
                if (in_array($file_data_array[$file_data_key]['extension'],$textFileExtensions_array) == TRUE) {
                // the file is not binary, i.e. it's a text file --- start
                $handle = @fopen($file_data_array[$file_data_key]['fullpath'], 'r');
                if ($handle == FALSE) {
                    // We haven't been able to even fopen the file, so the information retrieved by is_readable/is_writable returned nonsense. Let's reset the information accordingly.
                    $file_data_array[$file_data_key]['local_readwrite'] = '--';
                    $file_data_array[$file_data_key]['comment'] .= $lang_versioncheck_php['inaccessible'].'. '.$lang_versioncheck_php['review_permissions'].'. ';
                    //$file_data_array[$file_data_key]['comment'] .= '|'.$file_data_values['fullpath'];
                } else {
                    // File is readable -- start
                    $blob = '';
                    $blob = @fread($handle, filesize($file_data_array[$file_data_key]['fullpath']));
                    @fclose($handle);
                    $revision_string = '$'.'Revision'.':';
                    $cpg_version_determination = 'Coppermine' . ' ' . 'version:';
                    $blob = str_replace('<?php','',$blob);
                    // Determine the cpg version -- start
                    $file_data_array[$file_data_key]['local_version'] = substr($blob,strpos($blob, $cpg_version_determination)); // chop off the first bit up to the string $cpg_version_determination
                    $double_slash_position = strpos($file_data_array[$file_data_key]['local_version'], '//');
                    if ($double_slash_position) {
                        $file_data_array[$file_data_key]['local_version'] = substr($file_data_array[$file_data_key]['local_version'],0,$double_slash_position);
                    }
                    $file_data_array[$file_data_key]['local_version'] = trim(str_replace($cpg_version_determination, '', $file_data_array[$file_data_key]['local_version']));
                    $file_data_array[$file_data_key]['local_version'] = trim(str_replace('#', '', $file_data_array[$file_data_key]['local_version']));
                    $file_data_array[$file_data_key]['local_version'] = trim(substr($file_data_array[$file_data_key]['local_version'], 0, strpos($file_data_array[$file_data_key]['local_version'], '$')));
                    if (strlen($file_data_array[$file_data_key]['local_version']) > 6) { // Version numbers larger than 6 are not likely at all
                        $file_data_array[$file_data_key]['local_version'] = $lang_versioncheck_php['not_applicable'];
                    }
                    if ($file_data_array[$file_data_key]['version'] != '' && $file_data_array[$file_data_key]['exists'] == 1 && $file_data_array[$file_data_key]['local_version'] != '') {
                        $file_data_array[$file_data_key]['txt_version'] = ' (';
                        $versionCompare = version_compare($file_data_array[$file_data_key]['local_version'],$file_data_array[$file_data_key]['version']);
                        if ($versionCompare == 0) {
                            $file_data_array[$file_data_key]['txt_version'] .= $lang_versioncheck_php['ok'];
                        } elseif($versionCompare == -1) {
                            $file_data_array[$file_data_key]['txt_version'] .= sprintf($lang_versioncheck_php['outdated'],$file_data_array[$file_data_key]['version']);
                            $file_data_array[$file_data_key]['comment'] .= $lang_versioncheck_php['review_version'].'. ';
                        } else {
                            $file_data_array[$file_data_key]['txt_version'] .= sprintf($lang_versioncheck_php['newer'], $file_data_array[$file_data_key]['version']);
                            $file_data_array[$file_data_key]['comment'] .= $lang_versioncheck_php['review_dev_version'].'. ';
                        }
                        $file_data_array[$file_data_key]['txt_version'] .= ')';
                    } else {
                        $file_data_array[$file_data_key]['txt_version'] = '';
                    }
                    if (strlen($file_data_array[$file_data_key]['local_version'] . $file_data_array[$file_data_key]['txt_version']) > $maxLength_array['version']) {
                        $maxLength_array['version'] = strlen($file_data_array[$file_data_key]['local_version'] . $file_data_array[$file_data_key]['txt_version']);
                    }
                    // Determine the cpg version -- end
                    // Determine file revision -- start
                    if ($file_data_array[$file_data_key]['revision'] != '') { // only look the revision up if a revision is given in the XML data
                        $file_data_array[$file_data_key]['local_revision'] = str_replace($revision_string, '', substr($blob,strpos($blob, $revision_string),25));
                        $file_data_array[$file_data_key]['local_revision'] = trim(substr($file_data_array[$file_data_key]['local_revision'], 0, strpos($file_data_array[$file_data_key]['local_revision'], '$')));
                        if (strlen($file_data_array[$file_data_key]['local_revision']) > 5) { // Check validity of revision: more than 5 chars is not expected
                            $file_data_array[$file_data_key]['local_revision']= $lang_versioncheck_php['not_applicable'];
                        }
                        if ($file_data_array[$file_data_key]['local_revision'] != '' && $file_data_array[$file_data_key]['exists'] == 1) {
                          //$file_data_array[$file_data_key]['local_revision'] = $file_data_array[$file_data_key]['revision'];
                          if ($file_data_array[$file_data_key]['local_revision'] == $file_data_array[$file_data_key]['revision']) {
                            $file_data_array[$file_data_key]['txt_revision'] .= ' ('.$lang_versioncheck_php['ok'];
                          } elseif($file_data_array[$file_data_key]['local_revision'] < $file_data_array[$file_data_key]['revision']) {
                            $file_data_array[$file_data_key]['txt_revision'] .= ' ('. sprintf($lang_versioncheck_php['outdated'], $file_data_array[$file_data_key]['revision']);
                            if ($versionCompare == 0) {
                              $file_data_array[$file_data_key]['comment'] .= $lang_versioncheck_php['review_version'].'. ';
                            }
                          } else {
                            $file_data_array[$file_data_key]['txt_revision'] .= ' ('. sprintf($lang_versioncheck_php['newer'], $file_data_array[$file_data_key]['revision']);
                            if ($versionCompare == 0) {
                              $file_data_array[$file_data_key]['comment'] .= $lang_versioncheck_php['review_dev_version'].'. ';
                            }
                          }
                          $file_data_array[$file_data_key]['txt_revision'] .= ')';
                        } else {
                          $file_data_array[$file_data_key]['txt_revision'] = '';
                        }
                    }
                    // Determine file revision -- end
                    // File is readable -- end
                }
                // the file is not binary, i.e. it's a text file --- end
                } else {
                // the file is binary, i.e. it's an image --- start
                // binary files don't come with version numbers -- start
                $file_data_array[$file_data_key]['txt_version'] = $lang_versioncheck_php['not_applicable'].' ('.$lang_versioncheck_php['ok'].')';
                // binary files don't come with version numbers -- end
                // check the md5 hashes --- start
                if(function_exists('md5')) { // the MD5-function may not exist
                    // Do we have an md5-hash that we could compare against? -- start
                    if ($file_data_array[$file_data_key]['hash'] != '') {
                        // only perform the md5-check if the versions and revisions match anyway - we'd be comparing apples with bananas if we checked the hashes otherwise -- start
                        if ($file_data_array[$file_data_key]['version'] == $file_data_array[$file_data_key]['local_version'] && $file_data_array[$file_data_key]['revision'] == $file_data_array[$file_data_key]['local_revision']) { 
                            $file_data_array[$file_data_key]['local_hash'] = md5($file_data_values['fullpath']);
                            if ($file_data_array[$file_data_key]['local_hash'] == $file_data_array[$file_data_key]['hash']) {
                                $file_data_array[$file_data_key]['unmodified'] = 1;
                                $file_data_array[$file_data_key]['txt_revision'] = $lang_versioncheck_php['not_modified'] . ' ('.$lang_versioncheck_php['ok'].')';
                            } else {
                                $file_data_array[$file_data_key]['unmodified'] = 0;
                                $file_data_array[$file_data_key]['txt_revision'] = $lang_versioncheck_php['modified'];
                                $file_data_array[$file_data_key]['comment'] .= $lang_versioncheck_php['review_modified'].'. ';
                            }
                        } else {
                            $file_data_array[$file_data_key]['txt_revision'] = $lang_versioncheck_php['not_applicable'];
                        }
                        // only perform the md5-check if the versions and revisions match anyway - we'd be comparing apples with bananas if we checked the hashes otherwise -- end
                    }
                    // Do we have an md5-hash that we could compare against? -- end
                }
                // check the md5 hashes --- end
                // the file is binary, i.e. it's an image --- end
                }
                // we have a file here --- end
		    }
		    // The folder/file exists --- end
	    }
	    $loopCounter++;
        //  Adapt the maxLength array -- start
        if (strlen($file_data_array[$file_data_key]['fullpath']) > $maxLength_array['fullpath']) {
            $maxLength_array['fullpath'] = strlen($file_data_array[$file_data_key]['fullpath']);
        }
        if (strlen($file_data_array[$file_data_key]['txt_folderfile']) > $maxLength_array['folderfile']) {
            $maxLength_array['folderfile'] = strlen($file_data_array[$file_data_key]['txt_folderfile']);
        }
        if (strlen($file_data_array[$file_data_key]['txt_revision']) > $maxLength_array['revision']) {
            $maxLength_array['revision'] = strlen($file_data_array[$file_data_key]['txt_revision']);
        }  
        if (strlen($file_data_array[$file_data_key]['local_revision'] . $file_data_array[$file_data_key]['txt_revision']) > $maxLength_array['revision']) {
          $maxLength_array['revision'] = strlen($file_data_array[$file_data_key]['local_revision'] . $file_data_array[$file_data_key]['txt_revision']);
        }
        if (strlen($lang_versioncheck_php['warning']) > $maxLength_array['comment']) {
            $maxLength_array['comment'] = strlen($lang_versioncheck_php['warning']);
        }
        //  Adapt the maxLength array -- end
    } // end the foreach loop
    return $file_data_array;
} // end function definition "cpg_versioncheckPopulateArray()"

function cpg_versioncheckCreateXml($file_data_array) {
  global $textFileExtensions_array, $lang_versioncheck_php, $displayOption_array;
  $newLine = "\r\n";
  $loopCounter = 0;
  print <<< EOT
  <script type="text/javascript">
            document.write('<a href="javascript:HighlightAll(\'versioncheckdisplay.versioncheck_text\')" class="admin_menu">');
            document.write("{$lang_versioncheck_php['select_all']}");
            document.write('</a>');
            document.write('<br />');
  </script>
EOT;
  print '<form name="versioncheckdisplay"><textarea name="versioncheck_text" rows="20" class="textinput debug_text" style="width:98%;font-family:\'Courier New\',Courier,monospace;font-size:9px;height:auto;overflow:auto;">';
  print '<file_data>'.$newLine;
  $loopCounter++;
  foreach ($file_data_array as $file_data_key => $file_data_values) {
    print '  <element>'.$newLine;
    $loopCounter++;
    // populate the path and file from the fullpath
    $tempArray = cpg_get_path_and_file($file_data_values['fullpath']);
    $file_data_array[$file_data_key]['folder'] = $tempArray['path'];
    $file_data_array[$file_data_key]['file'] = $tempArray['file'];
    $file_data_array[$file_data_key]['extension'] = ltrim(substr($file_data_array[$file_data_key]['file'],strrpos($file_data_array[$file_data_key]['file'],'.')),'.');
    print "    <fullpath>".$file_data_values['fullpath']."</fullpath>".$newLine;
    $loopCounter++;
    if (in_array($file_data_array[$file_data_key]['extension'],$textFileExtensions_array) == TRUE) { // the file is not binary --- start
      $handle = @fopen($file_data_values['fullpath'], 'r');
      $blob = '';
      $blob = @fread($handle, filesize($file_data_values['fullpath']));
      @fclose($handle);
      $revision_string = '$'.'Revision'.':';
      $cpg_version_determination = 'Coppermine' . ' ' . 'version:';
      $blob = str_replace('<?php','',$blob);
      // Determine the cpg version
      $file_data_array[$file_data_key]['version'] = substr($blob,strpos($blob, $cpg_version_determination)); // chop off the first bit up to the string $cpg_version_determination
      $double_slash_position = strpos($file_data_array[$file_data_key]['version'], '//');
      if ($double_slash_position) {
         $file_data_array[$file_data_key]['version'] = substr($file_data_array[$file_data_key]['version'],0,$double_slash_position);
      }
      $file_data_array[$file_data_key]['version'] = trim(str_replace($cpg_version_determination, '', $file_data_array[$file_data_key]['version']));
      $file_data_array[$file_data_key]['version'] = trim(str_replace('#', '', $file_data_array[$file_data_key]['version']));
      $file_data_array[$file_data_key]['version'] = trim(substr($file_data_array[$file_data_key]['version'], 0, strpos($file_data_array[$file_data_key]['version'], '$')));
      if (strlen($file_data_array[$file_data_key]['version']) > 6) {
        $file_data_array[$file_data_key]['version']= $lang_versioncheck_php['not_applicable'];
      }
      // Determine file revision
      $file_data_array[$file_data_key]['revision'] = str_replace($revision_string, '', substr($blob,strpos($blob, $revision_string),25));
      $file_data_array[$file_data_key]['revision'] = trim(substr($file_data_array[$file_data_key]['revision'], 0, strpos($file_data_array[$file_data_key]['revision'], '$')));
      if (strlen($file_data_array[$file_data_key]['revision']) > 6) {
        $file_data_array[$file_data_key]['revision'] = $lang_versioncheck_php['not_applicable'];
      }
    } else { // the file is not binary --- end
        $file_data_array[$file_data_key]['version'] = '';
        $file_data_array[$file_data_key]['revision'] = '';
    }
    if ($file_data_array[$file_data_key]['version'] != '') {
        print "    <version>".$file_data_array[$file_data_key]['version']."</version>".$newLine;
        $loopCounter++;
    }
    if ($file_data_array[$file_data_key]['revision'] != '') {
        print "    <revision>".$file_data_array[$file_data_key]['revision']."</revision>".$newLine;
        $loopCounter++;
    }
    if ($file_data_array[$file_data_key]['status'] != '') {
      $status = $file_data_array[$file_data_key]['status'];
    } else {
      $status = 'mandatory';
    }
    print "    <status>".$status."</status>".$newLine;
    $loopCounter++;
    if ($file_data_array[$file_data_key]['permission'] != '') {
      $permission = $file_data_array[$file_data_key]['permission'];
    } else {
      $permission = 'read';
    }
    print "    <permission>".$permission."</permission>".$newLine;
    $loopCounter++;
    if ($file_data_array[$file_data_key]['file'] != '') {
      $hash = md5($file_data_values['fullpath']);
    } else {
      $hash = '';
    }
    if ($hash != '') {
        print "    <hash>".$hash."</hash>".$newLine;
        $loopCounter++;
    }
    print "  </element>".$newLine;
    $loopCounter++;
  }
  print '</file_data>'.$newLine;
  // display formatted footer data
  if ($displayOption_array['output'] == 'textarea' || $displayOption_array['output'] == 'create') {
    print <<< EOT
    </textarea>
    </form>
EOT;
  }
  $loopCounter++;
  return $loopCounter;
} // end function definition "cpg_versioncheckCreateXml()"

function cpg_versioncheckCreateTextOnlyOutput($file_data_array) {
  global $displayOption_array, $file_data_count, $lang_versioncheck_php, $maxLength_array;
  $newLine = "\r\n";

    // display formatted header data
    if ($displayOption_array['output'] == 'textarea') {
      print <<< EOT
      <script type="text/javascript">
                document.write('<a href="javascript:HighlightAll(\'versioncheckdisplay.versioncheck_text\')" class="admin_menu">');
                document.write("{$lang_versioncheck_php['select_all']}");
                document.write('</a>');
                document.write('<br />');
      </script>
EOT;
      print '<form name="versioncheckdisplay"><textarea name="versioncheck_text" rows="'.($file_data_count + 5).'" class="textinput debug_text" style="width:98%;font-family:\'Courier New\',Courier,monospace;font-size:9px;">';
    }

  $loopCounter = 1;
  $textSeparator = '|';
  $caption = '';
  $underline = '';
  $output = '';
  if (strlen($file_data_count) > $maxLength_array['counter']) {
    $maxLength_array['counter'] = strlen($file_data_count);
  }
  // the caption for the table
  $caption .= cpg_fillArrayFieldWithSpaces($lang_versioncheck_php['counter'], $maxLength_array['counter']);
  $caption .= $textSeparator;
  $caption .= cpg_fillArrayFieldWithSpaces($lang_versioncheck_php['type'], $maxLength_array['folderfile']);
  $caption .= $textSeparator;
  $caption .= cpg_fillArrayFieldWithSpaces($lang_versioncheck_php['path'], $maxLength_array['fullpath']);
  $caption .= $textSeparator;
  $caption .= cpg_fillArrayFieldWithSpaces($lang_versioncheck_php['missing'], $maxLength_array['exist']);
  $caption .= $textSeparator;
  $caption .= cpg_fillArrayFieldWithSpaces($lang_versioncheck_php['permissions'], $maxLength_array['readwrite']);
  $caption .= $textSeparator;
  $caption .= cpg_fillArrayFieldWithSpaces($lang_versioncheck_php['version'], $maxLength_array['version']);
  $caption .= $textSeparator;
  $caption .= cpg_fillArrayFieldWithSpaces($lang_versioncheck_php['revision'], $maxLength_array['revision']);
  $caption .= $textSeparator;
  $caption .= cpg_fillArrayFieldWithSpaces($lang_versioncheck_php['comment'], $maxLength_array['comment']);
  $caption .= $newLine;
  for ($i = 1; $i <= strlen($caption); $i++) {
    $underline .= '-';
  }
  $underline .= $newLine;
  // loop through all the elements in $file_data_array (which equals looping thorugh all folders and files) once more and create the textual output
  foreach ($file_data_array as $file_data_values) {
    if (($displayOption_array['errors_only'] == 0) || ($displayOption_array['errors_only'] == 1 && $file_data_values['comment'] != '')) { // only display if corrsponding option is not disabled --- start
      $output .= cpg_fillArrayFieldWithSpaces(ltrim($loopCounter), $maxLength_array['counter'],'left');
      $output .= $textSeparator;
      $output .= cpg_fillArrayFieldWithSpaces($file_data_values['txt_folderfile'], $maxLength_array['folderfile']);
      $output .= $textSeparator;
      $output .= cpg_fillArrayFieldWithSpaces($file_data_values['fullpath'], $maxLength_array['fullpath']);
      $output .= $textSeparator;
      $output .= cpg_fillArrayFieldWithSpaces($file_data_values['txt_missing'], $maxLength_array['exist']);
      $output .= $textSeparator;
      $output .= cpg_fillArrayFieldWithSpaces($file_data_values['local_readwrite'].$file_data_values['txt_readwrite'], $maxLength_array['readwrite']);
      $output .= $textSeparator;
      $output .= cpg_fillArrayFieldWithSpaces($file_data_values['local_version'].$file_data_values['txt_version'], $maxLength_array['version']);
      $output .= $textSeparator;
      $output .= cpg_fillArrayFieldWithSpaces($file_data_values['local_revision'].$file_data_values['txt_revision'], $maxLength_array['revision']);
      $output .= $textSeparator;
      if ($file_data_values['comment'] != '') {
        $output .= $lang_versioncheck_php['warning'];
      }
      $output .= $newLine;
      $loopCounter++;
    } // only display if corrsponding option is not disabled --- end
  }

  ob_start();
  print $caption;
  print $underline;
  print $output;
    // display formatted footer data
    if ($displayOption_array['output'] == 'textarea') {
      print <<< EOT
      </textarea>
      </form>
EOT;
    }
  $string = ob_get_contents();
  ob_end_clean();
  return $string;
}

function cpg_versioncheckCreateHTMLOutput($file_data_array) {
  global $textFileExtensions_array, $lang_versioncheck_php, $majorVersion, $displayOption_array;
  $newLine = "\r\n";
  $loopCounter_array = array('total' => 0, 'error' => 0, 'display' => 0);
  if (strlen($file_data_count) > $maxLength_array['counter']) {
    $maxLength_array['counter'] = strlen($file_data_count);
  }
  // the caption for the table
  print <<< EOT
<table align="center" width="100%" cellspacing="1" cellpadding="0" class="maintable">
  <tr>
          <td class="tableh1" colspan="9">{$lang_versioncheck_php['title']}</td>
  </tr>
  <tr>
    <th class="tableh2" style="font-size:8px">{$lang_versioncheck_php['path']}</th>
    <th class="tableh2" style="font-size:8px">{$lang_versioncheck_php['missing']}</th>
    <th class="tableh2" style="font-size:8px">{$lang_versioncheck_php['permissions']}</th>
    <th class="tableh2" style="font-size:8px">{$lang_versioncheck_php['version']}</th>
    <th class="tableh2" style="font-size:8px">{$lang_versioncheck_php['revision']}</th>
    <th class="tableh2" style="font-size:8px">{$lang_versioncheck_php['comment']}</th>
    <th class="tableh2" style="font-size:8px">{$lang_versioncheck_php['repository_link']}</th>
    <th class="tableh2" style="font-size:8px">{$lang_versioncheck_php['help']}</th>
  </tr>
EOT;
  foreach ($file_data_array as $file_data_values) {
    if (($loopCounter_array['display']/2) == floor($loopCounter_array['display']/2)) {
      $cellstyle = 'tableb tableb_alternate';
    } else {
      $cellstyle = 'tableb';
    }
    if ($file_data_values['txt_missing'] != '') {
      $file_data_values['link_start'] = '<a href="'.$file_data_values['fullpath'].'">';
      $file_data_values['link_end'] = '</a>';
    }
    $important['path'] = '';
    $important['missing'] = '';
    $important['readwrite'] = '';
    $important['version'] = '';
    $important['revision'] = '';
    $important['comment'] = '';
    $important['svn'] = '';
    $important['help'] = '';
    if ($displayOption_array['errors_only'] == 0 && $file_data_values['comment'] != '') {
      if ($file_data_values['txt_missing'] == $lang_versioncheck_php['mandatory']) {
        $important['missing'] = ' important';
      }
      if ($file_data_values['txt_missing'] == $lang_versioncheck_php['mandatory']) {
        $important['missing'] = ' important';
      }
    }
    $loopCounter_array['total']++;
    if (($displayOption_array['errors_only'] == 0) || ($displayOption_array['errors_only'] == 1 && $file_data_values['comment'] != '')) { // only display if corrsponding option is not disabled --- start
      if ($file_data_values['comment'] != '') {
        $loopCounter_array['error']++;
      }
      print <<< EOT
    <tr>
      <td class="{$cellstyle}{$important['path']}" align="left" style="font-size:9px">{$file_data_values['icon']}{$file_data_values['link_start']}{$file_data_values['fullpath']}{$file_data_values['link_start']}</td>
      <td class="{$cellstyle}{$important['missing']}" align="left" style="font-size:9px">{$file_data_values['txt_missing']}</td>
      <td class="{$cellstyle}{$important['readwrite']}" align="left" style="font-size:9px">{$file_data_values['local_readwrite']}{$file_data_values['txt_readwrite']}</td>
      <td class="{$cellstyle}{$important['version']}" align="left" style="font-size:9px">{$file_data_values['local_version']}{$file_data_values['txt_version']}</td>
      <td class="{$cellstyle}{$important['revision']}" align="left" style="font-size:9px">{$file_data_values['local_revision']}{$file_data_values['txt_revision']}</td>
      <td class="{$cellstyle}{$important['comment']}" align="left" style="font-size:9px">{$file_data_values['comment']}</td>
      <td class="{$cellstyle}{$important['svn']}" align="left" style="font-size:9px"><a href="{$subversionRepository}{$majorVersion}/{$file_data_values['fullpath']}"><img src="images/subversion.gif" width="16" height="16" border="0" alt="" title="{$lang_versioncheck_php['browse_corresponding_page_subversion']}" /></a></td>
      <td class="{$cellstyle}{$important['help']}" align="left" style="font-size:9px"></td>
    </tr>
EOT;
      ob_end_flush();
      $loopCounter_array['display']++;
    } // only display if corrsponding option is not disabled --- end
  }
    print "\r\n".'</table>';
    return $loopCounter_array;
}

function cpgVersioncheckConnectRepository() {
    global $displayOption_array;
    //print_r($displayOption_array);
    //die;
    // Perform the repository lookup and xml creation --- start
    //$displayOption_array['do_not_connect_to_online_repository'] = 1;
    $majorVersion = 'cpg'.str_replace('.' . ltrim(substr(COPPERMINE_VERSION,strrpos(COPPERMINE_VERSION,'.')),'.'), '', COPPERMINE_VERSION).'.x';
    $remoteURL = 'http://coppermine-gallery.enet/' . str_replace('.', '', $majorVersion) . '.files.xml';
    $localFile = 'include/' . str_replace('.', '', $majorVersion) . '.files.xml';
    $remoteConnectionFailed = '';
    if ($displayOption_array['do_not_connect_to_online_repository'] == 0) { // connect to the online repository --- start
      $result = cpgGetRemoteFileByURL($remoteURL, 'GET','','200');
      if (strlen($result['body']) < 200) {
        $remoteConnectionFailed = 1;
        $error = $result['error'];
        //print_r($error);
        //print '<hr />';
      }
    } // connect to the online repository --- end
    if ($displayOption_array['do_not_connect_to_online_repository'] == 1 || $remoteConnectionFailed == 1) {
      $result = cpgGetRemoteFileByURL($localFile, 'GET','','200');
    }
    unset($result['headers']); // we should take a look the header data and error messages before dropping them. Well, later maybe ;-)
    unset($result['error']);
    $result = array_shift($result);
    include_once('include/lib.xml.php');
    $xml = new Xml;
    $file_data_array = $xml->parse($result);
    $file_data_array = array_shift($file_data_array);
    // Perform the repository lookup and xml creation --- end
    return $file_data_array;
}

if (!function_exists('cpgGetRemoteFileByURL')) {  // This function is normally being populated in include/functions.inc.php - let's define it in case it doesn't exist
function cpgGetRemoteFileByURL($remoteURL, $method = "GET", $redirect = 10, $minLength = '0') {
    global $lang_get_remote_File_by_url;
    // FSOCK code snippets taken from http://jeenaparadies.net/weblog/2007/jan/get_remote_file
    $url = parse_url($remoteURL); // chop the URL into protocol, domain, port, folder, file, parameter
    $error = '';
    $lineBreak = "<br />\r\n";
    // Let's try CURL first
    if (function_exists('curl_init') == TRUE) { // don't bother to try curl if it isn't there in the first place
      $curl = curl_init();
      curl_setopt($curl, CURLOPT_URL, $remoteURL);
      curl_setopt($curl, CURLOPT_HEADER, 0);
      ob_start();
      curl_exec($curl);
      $body = ob_get_contents();
      ob_end_clean();
      ob_end_flush();
      $headers = curl_getinfo($curl);
      curl_close($curl);
      if (strlen($body) < $minLength ) {
              // Fetching the data by CURL obviously failed
              $error .= sprintf($lang_get_remote_File_by_url['no_data_returned'], $lang_get_remote_File_by_url['curl']) . $lineBreak;
      } else {
              // Fetching the data by CURL was successfull. Let's return the data
              return array("headers" => $headers, "body" => $body);
      }
    } else {
      // Curl is not available
      $error .= $lang_get_remote_File_by_url['curl_not_available'] . $lineBreak;
    }
    // Now let's try FSOCKOPEN
    if ($url['host'] != ''){
      $fp = @fsockopen ($url['host'], (!empty($url['port']) ? (int)$url['port'] : 80), $errno, $errstr, 30);
      if ($fp) { // fsockopen file handle success - start
          $path = (!empty($url['path']) ? $url['path'] : "/").(!empty($url['query']) ? "?".$url['query'] : "");
          $header = "\r\nHost: ".$url['host'];
          fputs ($fp, $method." ".$path." HTTP/1.0".$header."\r\n\r\n".("post" == strtolower($method) ? $data : ""));
          if(!feof($fp)) {
            $scheme = fgets($fp);
            //list(, $code ) = explode(" ", $scheme);
            $headers = explode(" ", $scheme);
            //$headers = array("Scheme" => $scheme);
          }
          while ( !feof($fp) ) {
              $h = fgets($fp);
              if($h == "\r\n" OR $h == "\n") {
                break;
              }
              list($key, $value) = explode(":", $h, 2);
              $key = strtolower($key);
              $value = trim($value);
              if(isset($headers[$key])) {
                $headers[$key] .= ','.trim($value);
              } else {
                $headers[$key] = trim($value);
              }
          }
          $body = '';
          while ( !feof($fp) ) {
            $body .= fgets($fp);
          }
          fclose($fp);
          if (strlen($body) < $minLength) {
                // Fetching the data by FSOCKOPEN obviously failed
                $error .= sprintf($lang_get_remote_File_by_url['no_data_returned'], $lang_get_remote_File_by_url['fsockopen']) . $lineBreak;
          } elseif (in_array('404', $headers) == TRUE) {
                // We got a 404 error
                $error .= sprintf($lang_get_remote_File_by_url['error_number'], '404') . $lineBreak;
          } else {
                // Fetching the data by FSOCKOPEN was successfull. Let's return the data
                return array("headers" => $headers, "body" => $body, "error" => $error);
          }
      } else {  // fsockopen file handle failure - start
              $error .= $lang_get_remote_File_by_url['fsockopen'] . ': ';
              $error .= sprintf($lang_get_remote_File_by_url['error_number'], $errno);
              $error .= sprintf($lang_get_remote_File_by_url['error_message'], $errstr);
      }
    } else {
      //$error .= 'No Hostname set. In other words: we\'re trying to retrieve a local file';
    }
    // Finally, try FOPEN
    @ini_set('allow_url_fopen','1'); // Try to override the existing policy
    if ($url['scheme'] != '') {
      $protocol = $url['scheme'].'://';
    }  else {
      $protocol = '';
    }
    if ($url['port'] != '') {
      $port = ':'.(int)$url['port'];
    }  elseif($url['host'] != '') {
      $port = ':80';
    } else {
      $port = '';
    }
    $handle  = @fopen($protocol.$url['host'].$port.$url['path'], 'r');
    if ($handle) {
      while(!feof($handle)) {
        $body .= fread($handle, 1024);
      }
      fclose($handle);
      if (strlen($body) < $minLength) {
        $error .= sprintf($lang_get_remote_File_by_url['no_data_returned'], $lang_get_remote_File_by_url['fopen']) . $lineBreak;
      } else {
        // Fetching the data by FOPEN was successfull. Let's return the data
        return array("headers" => $headers, "body" => $body, "error" => $error);
      }
    } else { // opening the fopen handle failed as well
      // if the script reaches this stage, all available methods failed, so let's return the error messages and give up
      return array("headers" => $headers, "body" => $body, "error" => $error);
    }
}
}

?>