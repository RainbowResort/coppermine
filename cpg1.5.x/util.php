<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2007 Coppermine Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  Coppermine version: 1.5.0
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**********************************************/

define('IN_COPPERMINE', true);
define('UTIL_PHP', true);
define('UPLOAD_PHP', true);

require('include/init.inc.php');
require('include/picmgmt.inc.php');

$defpicnum = 25; // Default number of pictures to process at a time when rebuilding thumbs or normals:
$dayolder = 365; // Default number of days for deleting files older than xxx days {Frantz}
if (!GALLERY_ADMIN_MODE) cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);

pageheader($lang_util_php['title']);

// 'action name (for the $_REQUEST)' => array('function name','title for main page','description/options for main page')

$tasks =  array(

        'update_thumbs' => array('update_thumbs', $lang_util_php['update'],'

                <strong>'.$lang_util_php['update_what'].' (2):</strong><br />
                <input type="radio" name="updatetype" id="updatetype1" value="0" class="nobg" /><label for="updatetype1" class="clickable_option">'.$lang_util_php['update_thumb'].'</label><br />
                <input type="radio" name="updatetype" id="updatetype2" value="1" class="nobg" /><label for="updatetype2" class="clickable_option">'.$lang_util_php['update_pic'].'</label><br />
                <input type="radio" name="updatetype" id="updatetype3" value="2" class="nobg" /><label for="updatetype3" class="clickable_option">'.$lang_util_php['update_both'].'</label><br />
                <input type="radio" name="updatetype" id="updatetype5" value="4" class="nobg" /><label for="updatetype5" class="clickable_option">'.$lang_util_php['update_full'].'</label><br />
                <input type="radio" name="updatetype" id="updatetype4" value="3" checked="checked" class="nobg" /><label for="updatetype4" class="clickable_option">'.$lang_util_php['update_full_normal'].'</label><br />
                <input type="radio" name="updatetype" id="updatetype6" value="5" class="nobg" /><label for="updatetype6" class="clickable_option">'.$lang_util_php['update_full_normal_thumb'].'</label><br />
                '.$lang_util_php['update_number'].'
                <input type="text" name="numpics" value="'.$defpicnum.'" size="5" class="textinput" /><br />'.$lang_util_php['update_option'].'<br /><br />
                <input type="Checkbox" name="autorefresh" checked value="1" class="nobg" />'.$lang_util_php['autorefresh']
                ),

        'filename_to_title' => array('filename_to_title', $lang_util_php['filename_title'],'

                <strong>'.$lang_util_php['filename_how'].' (2):</strong><br />
        <input type="radio" name="parsemode" id="parsemode1" value="0" checked="checked" class="nobg" /><label for="parsemode1" class="clickable_option">' . $lang_util_php['filename_remove'] . '</label><br />
                <input type="radio" name="parsemode" id="parsemode2" value="1" class="nobg" /><label for="parsemode2" class="clickable_option">'.$lang_util_php['filename_euro'].'</label><br />
                <input type="radio" name="parsemode" id="parsemode3" value="2" class="nobg" /><label for="parsemode3" class="clickable_option">'.$lang_util_php['filename_us'].'</label><br />
                <input type="radio" name="parsemode" id="parsemode4" value="3" class="nobg" /><label for="parsemode4" class="clickable_option">'.$lang_util_php['filename_time'].'</label><br /><br />'),

        'del_titles' => array('del_titles', $lang_util_php['delete_title'], $lang_util_php['delete_title_explanation']),

        'del_orig' => array('del_orig', $lang_util_php['delete_original'], $lang_util_php['delete_original_explanation']),

        'del_norm' => array('del_norm', $lang_util_php['delete_intermediate'], $lang_util_php['delete_intermediate_explanation']),

        'del_old' => array('del_old',
                           $lang_util_php['delete_old'],
                           $lang_util_php['delete_old_explanation'].
                           '<br /><span style="color:red">'.
                           $lang_util_php['delete_old_warning'].
                           '</span><br />'.
                           sprintf($lang_util_php['older_than'],
                           '<input type="text" name="day_number" value="'.$dayolder.'" size="5" class="textinput"/>')
                           ),


        'del_orphans' => array('del_orphans', $lang_util_php['delete_orphans'], $lang_util_php['delete_orphans_explanation']),

        'deletbackup_img' => array('deletbackup_img', $lang_util_php['delete_back'], $lang_util_php['delete_back_explanation']),

        'refresh_db' => array('refresh_db', $lang_util_php['refresh_db'], $lang_util_php['refresh_db'].'<br />' . $lang_util_php['update_number'].'

                <input type="text" name="refresh_numpics" value="'.$defpicnum.'" size="5" class="textinput" /><br />'.$lang_util_php['update_option']),

        'reset_views' => array('reset_views', $lang_util_php['reset_views'], $lang_util_php['reset_views_explanation']),
        );

//$action = (isset($_REQUEST['action'])) ? $_REQUEST['action'] : '';
if ($superCage->post->keyExists('action')) {
    $action = $superCage->post->getInt('action');
} elseif ($superCage->get->keyExists('action')) {
    $action = $superCage->get->getInt('action');
} else {
	$action = '';
}
if (array_key_exists($action, $tasks)){
        call_user_func($action);
        echo "<br /><a href=\"util.php\">{$lang_util_php['back']}</a>";
} else {

        $help = '&nbsp;'.cpg_display_help('f=admin_menu.htm&amp;as=admin_tools&amp;ae=admin_tools_end&amp;top=1', '600', '400');

        starttable('100%', $lang_util_php['title'].$help, 2);

        echo '<tr>
                        <td class="tablef"><strong>'.$lang_util_php['what_it_does'] . '</strong>:
                                <ul style="margin-top:0px;margin-bottom:0px;list-style-type:square">';
        foreach($lang_util_desc_php as $value) {
        echo "<li>$value</li>\n";
        }
        echo '                        </ul>
                          </td>
                        <td class="tableb"><strong>' . $lang_util_php['instruction'] . '</strong>:<br />
                                (1) ' . $lang_util_php['instruction_action'] . '<br />
                              (2) ' . $lang_util_php['instruction_parameter'] . '<br />
                              (3) ' . $lang_util_php['instruction_album'] . '<br />
                              (4) ' . sprintf($lang_util_php['instruction_press'], $lang_util_php['submit_form']).'
                          </td>
              </tr>';

        endtable();

        echo '<br /><form name="cpgform" id="cpgform" action="util.php" method="post">';

        foreach ($tasks as $task){

            list($name, $title, $options) = $task;

                if ($name){
                    starttable('100%', "<input type=\"radio\" name=\"action\" value=\"$name\" id=\"$name\" class=\"nobg\" /><label for=\"$name\" class=\"clickable_option\" >$title</label> (1)");
                } else {
                          starttable('100%', $title);
                }
                echo "<tr><td class=\"tablef\">$options</td></tr>";
                endtable();
            echo '<br />';
        }

        starttable('100%', $lang_util_php['select_album']);
        echo '<tr><td class="tablef"><br />';
        //if (defined('UDB_INTEGRATION')){
                $cpg_udb->util_filloptions();
        /*} else {
                filloptions();
        }*/
        echo '<br /></td></tr>';
        endtable();
        echo '</form>';
}

function my_flush()
{
        print str_repeat(" ", 4096); // force a flush;
}

function del_titles()
{
        global $CONFIG, $lang_util_php;

        $superCage = Inspekt::makeSuperCage();
        //$albumid = (isset($_POST['albumid'])) ? $_POST['albumid'] : 0;
        if ($superCage->post->keyExists('albumid')) {
	       	$albumid = $superCage->post->getInt('albumid');
		} else {
			$albumid = 0;
		}
        $albstr = ($albumid) ? "WHERE aid = $albumid" : '';
        echo "<h2>{$lang_util_php['delete_wait']}</h2>";
        $query = cpg_db_query("UPDATE {$CONFIG['TABLE_PICTURES']} SET title = '' $albstr");
        if ($query) {
            echo $lang_util_php['titles_deleted']."<br />";
        }
}

function filename_to_title()
{
        global $CONFIG, $lang_util_php;

		$superCage = Inspekt::makeSuperCage();
        //$albumid = (isset($_POST['albumid'])) ? $_POST['albumid'] : 0;
        if ($superCage->post->keyExists('albumid')) {
            $albumid = $superCage->post->getInt('albumid');
		} else {
            $albumid = 0;
		}
        $albstr = ($albumid) ? " WHERE aid = $albumid" : '';
        $parsemode = $_POST['parsemode'];

        $result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PICTURES']} $albstr");

        echo "<h2>{$lang_util_php['titles_wait']}</h2>";

        while ($row = mysql_fetch_assoc($result)){

        $filename = $row['filename'];
        $pid = $row['pid'];
        // //////////////////////////////////////////
        // ADD YOUR OWN PARSEMODES HERE //
        // /////////////////////////////////////////
        $pattern = "/(\d+)(.)(\d+)(.)(\d+)(.)(\d+)(.)(\d+)(.)(\d+)(.+)/";

        switch ($parsemode){

                case 0: // REMOVE .JPG AND REPLACE _ WITH [ ]
                        $filename = substr($filename, 0, -4);
                        $newtitle = str_replace("_", " ", $filename);
                        break;
                case 1: // CHANGE 2003_11_23_13_20_20.jpg TO 23/11/2003 13:20
                        $newtitle = str_replace("%20", " ", $filename);
                        $replacement = "$5/$3/$1 $7:$9";
                        $newtitle = preg_replace($pattern, $replacement, $filename);
                        break;
                case 2: // CHANGE 2003_11_23_13_20_20.jpg TO 11/23/2003 13:20
                        $newtitle = str_replace("%20", " ", $filename);
                        $replacement = "$3/$5/$1 $7:$9";
                        $newtitle = preg_replace($pattern, $replacement, $filename);
                        break;
                case 3: // CHANGE 2003_11_23_13_20_20.jpg TO 13:20
                        $newtitle = str_replace("%20", " ", $filename);
                        $replacement = "$7:$9";
                        $newtitle = preg_replace($pattern, $replacement, $filename);
                        break;
        }

        $query = cpg_db_query("UPDATE {$CONFIG['TABLE_PICTURES']} SET title = '$newtitle' WHERE pid = '$pid'");
        if ($query){
                echo "{$lang_util_php['file']} : $filename {$lang_util_php['title_set_to']} : $newtitle<br />";
        }

        my_flush();

        }
}

function filloptions()
{
        global $CONFIG, $lang_util_php;

        $result = cpg_db_query("SELECT aid, category, IF(user_name IS NOT NULL, CONCAT('(', user_name, ') ',title), CONCAT(' - ', title)) AS title " . "FROM {$CONFIG['TABLE_ALBUMS']} AS a " . "LEFT JOIN {$CONFIG['TABLE_USERS']} AS u ON category = (" . FIRST_USER_CAT . " + user_id) " . "ORDER BY category, title");

        echo "&nbsp;&nbsp;&nbsp;&nbsp;<select size='1' name='albumid' class='listbox'><option value='0'>{$lang_util_php['all_albums']}</option>";

        while ($row = mysql_fetch_array($result)){
                $result2 = cpg_db_query("SELECT name FROM {$CONFIG['TABLE_CATEGORIES']} WHERE cid = {$row['category']}");
                $row2 = mysql_fetch_assoc($result2);
                echo "<option value=\"{$row['aid']}\">{$row2['name']} {$row['title']}</option>";
        }

        echo '</select> (3)&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="'.$lang_util_php['submit_form'].'" class="button" /> (4)';
}

function update_thumbs()
{
        global $CONFIG, $lang_util_php;

        $superCage = Inspekt::makeSuperCage();
        //$albumid = (isset($_REQUEST['albumid'])) ? $_REQUEST['albumid'] : 0;
        if ($superCage->post->keyExists('albumid')) {
		 	$albumid = $superCage->post->getInt('albumid');
		} elseif ($superCage->get->keyExists('albumid')) {
			$albumid = $superCage->get->getInt('albumid');
		} else {
			$albumid = 0;
		}
        $albstr = ($albumid) ? "WHERE aid = $albumid" : '';
        //$autorefresh = $_REQUEST['autorefresh'];
        if ($superCage->post->keyExists('autorefresh')) {
		 	$autorefresh = $superCage->post->getInt('autorefresh');
		} elseif ($superCage->get->keyExists('autorefresh')) {
			$autorefresh = $superCage->get->getInt('autorefresh');
		}
        //$updatetype = $_REQUEST['updatetype'];
        if ($superCage->post->keyExists('updatetype')) {
		 	$updatetype = $superCage->post->getInt('updatetype');
		} elseif ($superCage->get->keyExists('updatetype')) {
			$updatetype = $superCage->get->getInt('updatetype');
		}
        //$numpics = $_REQUEST['numpics'];
        if ($superCage->post->keyExists('numpics')) {
		 	$numpics = $superCage->post->getInt('numpics');
		} elseif ($superCage->get->keyExists('numpics')) {
			$numpics = $superCage->get->getInt('numpics');
		}
        //$startpic = (isset($_REQUEST['startpic'])) ? $_REQUEST['startpic'] : 0;
		if ($superCage->post->keyExists('startpic')) {
		 	$startpic = $superCage->post->getInt('startpic');
		} elseif ($superCage->get->keyExists('startpic')) {
			$startpic = $superCage->get->getInt('startpic');
		} else {
			$albumid = 0;
		}
        echo "<h2>{$lang_util_php['thumbs_wait']}</h2>";

        $result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PICTURES']} $albstr LIMIT $startpic, $numpics");
        $count = mysql_num_rows($result);

        while ($row = mysql_fetch_assoc($result)) {

                $image = $CONFIG['fullpath'] . $row['filepath'] . $row['filename'];
                $normal = $CONFIG['fullpath'] . $row['filepath'] . $CONFIG['normal_pfx'] . $row['filename'];
                $thumb = $CONFIG['fullpath'] . $row['filepath'] . $CONFIG['thumb_pfx'] . $row['filename'];
                $orig=$CONFIG['fullpath'] . $row['filepath'] . $CONFIG['orig_pfx'] . $row['filename'];

                if (file_exists($orig)) {
                        $work_image=$orig;
                        $orig_true='true';
                } else {
                        $work_image=$image;
                        $orig_true='false';
                }

                $imagesize = getimagesize($work_image);
                if ($updatetype == 0 || $updatetype == 2 || $updatetype == 5)  {
                    if (resize_image($work_image, $thumb, $CONFIG['thumb_width'], $CONFIG['thumb_method'], $CONFIG['thumb_use'], "false", 1)) {
                        echo $thumb .' '. $lang_util_php['updated_succesfully'] . '!<br />';
                        my_flush();
                    } else {
                        echo $lang_util_php['error_create'] . ':$thumb<br />';
                        my_flush();
                    }
                }

                if ($updatetype == 1 || $updatetype == 2 || $updatetype == 3 || $updatetype == 5) {
                    ($CONFIG['enable_watermark'] == '1' && $CONFIG['which_files_to_watermark'] == 'both' || $CONFIG['which_files_to_watermark'] == 'resized') ? $watermark="true" : $watermark="false";
                    if (max($imagesize[0], $imagesize[1]) > $CONFIG['picture_width'] && $CONFIG['make_intermediate']) {
                        if (resize_image($work_image, $normal, $CONFIG['picture_width'], $CONFIG['thumb_method'], $CONFIG['thumb_use'], $watermark)) {
                            echo $normal . " " . $lang_util_php['updated_succesfully'] . '!<br />';
                            my_flush();
                        } else {
                            echo $lang_util_php['error_create'] . ':$normal<br />';
                            my_flush();
                        }
                    }
                }

                if ($updatetype == 3 || $updatetype == 4 || $updatetype == 5) {
                    ($CONFIG['thumb_use'] == "ex") ? $resize_method = "any" : $resize_method = $CONFIG['thumb_use'];

                    if (((USER_IS_ADMIN && $CONFIG['auto_resize'] == 1) || (!USER_IS_ADMIN && $CONFIG['auto_resize'] > 0)) && max($imagesize[0], $imagesize[1]) > $CONFIG['max_upl_width_height']) {
                        $max_size_size = $CONFIG['max_upl_width_height'];
                    } else {
                        $resize_method = "orig";
                        $max_size_size = max($imagesize[0], $imagesize[1]);
                    }

                    if ($orig_true == 'false') {
                        if (copy($image, $orig)) {
                            if ($CONFIG['enable_watermark'] == '1' && $CONFIG['which_files_to_watermark'] == 'both' || $CONFIG['which_files_to_watermark'] == 'original') {
                                if (resize_image($work_image, $image, $max_size_size, $CONFIG['thumb_method'], $resize_method, 'true')) {
                                    echo $image . " " . $lang_util_php['updated_succesfully'] . '!<br />';
                                    my_flush();
                                } else {
                                    echo $lang_util_php['error_create'] . ':$image<br />';
                                    my_flush();
                                }
                            }
                        }
                    } else {
                        if ($CONFIG['enable_watermark'] == '1' && $CONFIG['which_files_to_watermark'] == 'both' || $CONFIG['which_files_to_watermark'] == 'original') {
                            if (resize_image($work_image, $image, $max_size_size, $CONFIG['thumb_method'], $resize_method, 'true')) {
                                echo $image . " " . $lang_util_php['updated_succesfully'] . '!<br />';
                                my_flush();
                            } else {
                                echo $lang_util_php['error_create'] . ':$image<br />';
                                my_flush();
                            }
                        } else {
                            if (((USER_IS_ADMIN && $CONFIG['auto_resize'] == 1) || (!USER_IS_ADMIN && $CONFIG['auto_resize'] > 0)) && max($imagesize[0], $imagesize[1]) > $CONFIG['max_upl_width_height']) {
                                if (resize_image($work_image, $image, $max_size_size, $CONFIG['thumb_method'], $resize_method, 'false')) {
                                    echo $image . " " . $lang_util_php['updated_succesfully'] . '!<br />';
                                    my_flush();
                                } else {
                                    echo $lang_util_php['error_create'] . ':$image<br />';
                                    my_flush();
                                }
                            } elseif (copy($orig, $image)) {
                                echo $orig . " " . $lang_util_php['updated_succesfully'] . '!<br />';
                                my_flush();
                            } else {
                                echo $lang_util_php['error_create'] . ':$image<br />';
                                my_flush();
                            }
                        }
                    }
                }

                $imagesize = getimagesize($image);
                $query_up = "UPDATE {$CONFIG['TABLE_PICTURES']} SET pwidth='$imagesize[0]' , pheight='$imagesize[1]' WHERE pid='".$row['pid']."' ";
                cpg_db_query($query_up);
        }

        if ($count == $numpics) {

            $startpic += $numpics;
            if($autorefresh) {
                echo <<< EOT
                <meta http-equiv="refresh" content="1; URL=util.php?numpics={$numpics}&startpic={$startpic}&albumid={$albumid}&autorefresh={$autorefresh}&action=update_thumbs&updatetype={$updatetype}">
EOT;
            } else {
                echo <<< EOT
                <form action="util.php" method="post">
                    <input type="hidden" name="action" value="update_thumbs" />
                    <input type="hidden" name="numpics" value="$numpics" />
                    <input type="hidden" name="startpic" value="$startpic" />
                    <input type="hidden" name="updatetype" value="$updatetype" />
                    <input type="hidden" name="albumid" value="$albumid" />
                    <input type="hidden" name="autorefresh" value="$autorefresh" />
                    <input type="submit" value="{$lang_util_php['continue']}" class="button" />
                </form>
EOT;
            }
        }
        else echo $lang_util_php['finished'];
}

function deletbackup_img()
{
        global $CONFIG, $lang_util_php;
				$superCage = Inspekt::makeSuperCage();
        //$albumid = (isset($_POST['albumid'])) ? $_POST['albumid'] : 0;
        if ($superCage->post->keyExists('albumid')) {
    			$albumid = $superCage->post->getInt('albumid');
				} else {
						$albumid = 0;
				}
        $albstr = ($albumid) ? "WHERE aid = $albumid" : '';

        $result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PICTURES']} $albstr");
        $num = mysql_num_rows($result);
        $i = 0;
        while ($i < $num) {
            $pid = mysql_result($result, $i, "pid");
            $back = $CONFIG['fullpath'] . mysql_result($result, $i, "filepath") . $CONFIG['orig_pfx'] . mysql_result($result, $i, "filename");

            if (file_exists($back)) {
                            if(unlink($back)){
                    printf("Success".$lang_util_php['main_success'], $back);
                    print '!<br>';
                                    }
                } else {
                    printf("Error".$lang_util_php['error_rename'], $back);
                }
            ++$i;
        }
}

function del_orig()
{
        global $CONFIG, $lang_util_php;

        $superCage = Inspekt::makeSuperCage();
        //$albumid = (isset($_POST['albumid'])) ? $_POST['albumid'] : 0;
        if ($superCage->post->keyExists('albumid')) {
		$albumid = $superCage->post->getInt('albumid');
		} else {
				$albumid = 0;
		}
        $albstr = ($albumid) ? "WHERE aid = $albumid" : '';

        $result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PICTURES']} $albstr");
        $num = mysql_num_rows($result);
        echo "<h2>{$lang_util_php['replace_wait']}</h2>";

        while ($row = mysql_fetch_assoc($result)) {

                $pid = $row['pid'];
                $image = $CONFIG['fullpath'] . $row['filepath'] . $row['filename'];
                $normal = $CONFIG['fullpath'] . $row['filepath'] . $CONFIG['normal_pfx'] . $row['filename'];
                $thumb = $CONFIG['fullpath'] . $row['filepath'] . $CONFIG['thumb_pfx'] . $row['filename'];

                if (file_exists($normal)) {
                        $deleted = unlink($image);
                        $renamed = rename($normal, $image);
                        if ($deleted AND $renamed){
                                $imagesize = getimagesize($image); // dimensions
                                $image_filesize = filesize($image); // bytes
                                $total_filesize = $image_filesize + filesize($thumb);
                                cpg_db_query("UPDATE {$CONFIG['TABLE_PICTURES']} SET filesize='$image_filesize', total_filesize='$total_filesize', pwidth='{$imagesize[0]}', pheight='{$imagesize[1]}' WHERE pid='$pid' ");
                                printf($lang_util_php['main_success'], $normal);
                        } else {
                                echo (!$renamed) ? sprintf($lang_util_php['error_rename'], $normal, $image) : sprintf($lang_util_php['error_deleting'], $image);;
                        }
                } else {
                        printf($lang_util_php['error_not_found'], $normal);
                }
                echo '<br />';
           }
}

function del_norm()
{
        global $CONFIG, $lang_util_php;

		$superCage = Inspekt::makeSuperCage();
        //$albumid = (isset($_POST['albumid'])) ? $_POST['albumid'] : 0;
        if ($superCage->post->keyExists('albumid')) {
            $albumid = $superCage->post->getInt('albumid');
		} else {
			$albumid = 0;
		}
        $albstr = ($albumid) ? "WHERE aid = $albumid" : '';
        $result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PICTURES']} $albstr");
        $num = mysql_num_rows($result);
        echo "<h2>".$lang_util_php['deleting_intermediates']."</h2>";

        while ($row = mysql_fetch_assoc($result)){

                $pid = $row['pid'];
                $image = $CONFIG['fullpath'] . $row['filepath'] . $row['filename'];
                $normal = $CONFIG['fullpath'] . $row['filepath'] . $CONFIG['normal_pfx'] . $row['filename'];
                $thumb = $CONFIG['fullpath'] . $row['filepath'] . $CONFIG['thumb_pfx'] . $row['filename'];

                if (file_exists($normal)){
                        $test = unlink($normal);
                        if ($test){
                                $total_filesize = filesize($image) + filesize($thumb);
                                cpg_db_query("UPDATE {$CONFIG['TABLE_PICTURES']} SET total_filesize='$total_filesize' WHERE pid='$pid'");
                                printf('The intermediate pic %s was successfully deleted', $normal);
                                print '<br />';
                        } else {
                                printf($lang_util_php['del_error'], $normal);
                        }
                } else {
                        printf($lang_util_php['error_not_found'], $normal);
                        print '<br />';
                }
           }
}

function del_orphans()
{
    global $CONFIG, $lang_util_php;

    $superCage = Inspekt::makeSuperCage();
    $count = 0;
    echo "<h2>".$lang_util_php['searching_orphans']."</h2><br />";
    my_flush();

    //if (isset($_GET['single'])){
    if ($superCage->get->keyExists('single')) {
		$single = $superCage->get->getInt('single');
        $delone = cpg_db_query("DELETE FROM {$CONFIG['TABLE_COMMENTS']} WHERE msg_id= '{$single}' LIMIT 1");
    }

    $result = cpg_db_query("SELECT pid FROM {$CONFIG['TABLE_PICTURES']}");

    while ($row = mysql_fetch_assoc($result)){
        $ok_array[] = $row['pid'];
    }

    $check_str = '(' . implode(',',$ok_array) . ')';
    $result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_COMMENTS']} WHERE pid NOT IN $check_str");

    while ($row = mysql_fetch_array($result)){
        $pid = $row['pid'];
        $msg_id = $row['msg_id'];
        $msg_body = $row['msg_body'];

        //if (isset($_POST['del'])){
        if ($superCage->post->keyExists('del')) {
            cpg_db_query("DELETE FROM {$CONFIG['TABLE_COMMENTS']} WHERE msg_id= $msg_id");
            echo "{$lang_util_php['comment']} $msg_body {$lang_util_php['nonexist']} $pid - <a href=\"util.php?action=del_orphans&amp;single=$msg_id\">{$lang_util_php['delete']}</a><br />";
        }

        $count = mysql_num_rows($result);
        echo "<br /><br />$count {$lang_util_php['orphan_comment']}<br /><br />";
        if ($count > 1){
            echo <<< EOT
            <form name="cpgform3" id="cpgform3" action="util.php" method="post">
                    <input type="hidden" name="action" value="del_orphans" />
                    <input type="hidden" name="del" value="all" />
                    {$lang_util_php['delete_all_orphans']}
                    <input type="submit" value="{$lang_util_php['delete_all']}" class="button" />
            </form>
EOT;
        }
    }
}

function del_old() {
  global $CONFIG, $lang_util_php;

  $superCage = Inspekt::makeSuperCage();
  //$d = $_POST['day_number']*60*60*24;
  $day_number = $superCage->post->getInt('day_number');
  $d = $day_number*60*60*24;
  $start = strtotime(date("Ymd")) - $d;
  $delete_counter = 0;
  //$albumid = (isset($_POST['albumid'])) ? $_POST['albumid'] : 0;
    if ($superCage->post->keyExists('albumid')) {
	   $albumid = $superCage->post->getInt('albumid');
    } else {
    	$albumid = 0;
	}
  $albstr = ($albumid) ? "WHERE ctime <= $start AND aid = $albumid " : "WHERE ctime <= $start";
  $result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PICTURES']} $albstr");
  $num = mysql_num_rows($result);
  echo "<h2>".$lang_util_php['deleting_old']."</h2>";
  while ($row = mysql_fetch_assoc($result)){
    $pid = $row['pid'];
    $image = $CONFIG['fullpath'] . $row['filepath'] . $row['filename'];
    $normal = $CONFIG['fullpath'] . $row['filepath'] . $CONFIG['normal_pfx'] . $row['filename'];
    $thumb = $CONFIG['fullpath'] . $row['filepath'] . $CONFIG['thumb_pfx'] . $row['filename'];

    if (file_exists($normal)){
      $test = unlink($normal);
      if ($test){
              printf($lang_util_php['del_intermediate'], '&laquo;'.$normal.'&raquo;');
              print '<br />';
      } else {
              printf($lang_util_php['del_error'], '&laquo;'.$normal.'&raquo;');
      }

    } else {
      printf($lang_util_php['error_not_found'], '&laquo;'.$normal.'&raquo;');
      print '<br />';
    }
    if (file_exists($image)){
      $test = unlink($image);
      if ($test){
              printf($lang_util_php['del_orig'], '&laquo;'.$image.'&raquo;');
              print '<br />';
      } else {
              printf($lang_util_php['del_error'], '&laquo;'.$image.'&raquo;');
      }

    } else {
      printf($lang_util_php['error_not_found'], '&laquo;'.$image.'&raquo;');
      print '<br />';
    }
    if (file_exists($thumb)){
      $test = unlink($thumb);
      if ($test){
              printf($lang_util_php['del_thumb'], '&laquo;'.$thumb.'&raquo;');
              print '<br />';
      } else {
              printf($lang_util_php['del_error'], '&laquo;'.$thumb.'&raquo;');
      }

    } else {
      printf($lang_util_php['error_not_found'], '&laquo;'.$thumb.'&raquo;');
      print '<br />';
    }
    cpg_db_query("DELETE FROM {$CONFIG['TABLE_PICTURES']} WHERE pid='$pid' LIMIT 1");
    if (mysql_affected_rows()>0){
      $delete_counter++;
    }
    cpg_db_query("DELETE FROM {$CONFIG['TABLE_COMMENTS']} WHERE pid='$pid' LIMIT 1");
    cpg_db_query("DELETE FROM {$CONFIG['TABLE_EXIF']} WHERE filename='".addslashes($image)."' LIMIT 1");
  }
  printf($lang_util_php['affected_records'], $delete_counter);
}

function reset_views()
{
        global $CONFIG, $lang_util_php;

        $superCage = Inspekt::makeSuperCage();
        //$albumid = (isset($_POST['albumid'])) ? $_POST['albumid'] : 0;
        if ($superCage->post->keyExists('albumid')) {
            $albumid = $superCage->post->getInt('albumid');
		} else {
			$albumid = 0;
		}
        $albstr = ($albumid) ? "WHERE aid = $albumid" : '';

        if (cpg_db_query("UPDATE {$CONFIG['TABLE_PICTURES']} SET hits ='0' $albstr")) echo $lang_util_pgp['reset_succes'];
}

function refresh_db()
{
        global $CONFIG, $lang_util_php;

		$superCage = Inspekt::makeSuperCage();
        //$albumid = (isset($_POST['albumid'])) ? $_POST['albumid'] : 0;
        if ($superCage->post->keyExists('albumid')) {
            $albumid = $superCage->post->getInt('albumid');
		} else {
			$albumid = 0;
		}

        $albstr = ($albumid) ? "WHERE aid = $albumid" : '';
        //$numpics = $_POST['refresh_numpics'];
        $numpics = $superCage->post->getInt('refresh_numpics');
        //$startpic = (isset($_POST['refresh_startpic'])) ? $_POST['refresh_startpic'] : 0;

        if ($superCage->post->keyExists('refresh_startpic')) {
            $startpic = $superCage->post->getInt('refresh_startpic');
		} else {
			$startpic = 0;
		}
        starttable('100%', $lang_util_php['update_result'], 3);

        echo "<tr><th class=\"tableh2\">{$lang_util_php['file']}</th><th class=\"tableh2\">{$lang_util_php['problem']}</th><th class=\"tableh2\">{$lang_util_php['status']}</th></tr>";

        $outcome = 'none';
        $result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PICTURES']} $albstr ORDER BY pid ASC LIMIT $startpic, $numpics");
        $count = mysql_num_rows($result);
        $found = 0;

        while ($row = mysql_fetch_assoc($result)){

                extract($row, EXTR_PREFIX_ALL, "db");
                unset($prob);

                $full_pic_url = $CONFIG['fullpath'] . $db_filepath . $db_filename;
                $thumb_url = $CONFIG['fullpath'] . $db_filepath . $CONFIG['thumb_pfx'] . $db_filename;
                $normal_url = $CONFIG['fullpath'] . $db_filepath . $CONFIG['normal_pfx'] . $db_filename;
                $url = '<a href="' . $CONFIG["ecards_more_pic_target"] . (substr($CONFIG["ecards_more_pic_target"], -1) == '/' ? '' : '/') ."displayimage.php?pos=-$db_pid" . '" target="_blank">' . "$db_title ($db_pid)" . '</a>';

                if (@file_exists($full_pic_url)){

                        $filesize = @filesize($full_pic_url);
                        $dimensions = @getimagesize($full_pic_url);

                        if ($filesize){

                                $thumb_filesize = @filesize($thumb_url);
                                $normal_filesize = @filesize($normal_url);
                                $total_filesize = $filesize + $thumb_filesize + $normal_filesize;

                                if ($total_filesize <> $db_total_filesize){

                                        $prob .= "{$lang_util_php['incorrect_filesize']}<br />{$lang_util_php['database']}{$db_total_filesize}{$lang_util_php['bytes']}<br />{$lang_util_php['actual']}{$total_filesize}{$lang_util_php['bytes']}<br />";
                                        $fs1_upd = @cpg_db_query("UPDATE {$CONFIG['TABLE_PICTURES']} SET total_filesize = '$total_filesize' WHERE pid = '$db_pid' LIMIT 1");
                                        $outcome = ($fs1_upd) ? $lang_util_php['updated'] : $lang_util_php['update_failled'];
                                }

                                if ($filesize <> $db_filesize){

                                        $prob .= "{$lang_util_php['incorrect_filesize']}<br />{$lang_util_php['database']}{$db_filesize}{$lang_util_php['bytes']}<br />{$lang_util_php['actual']}{$filesize}{$lang_util_php['bytes']}<br />";
                                        $fs2_upd = @cpg_db_query("UPDATE {$CONFIG['TABLE_PICTURES']} SET filesize = '$filesize' WHERE pid = '$db_pid' LIMIT 1");
                                        $outcome = ($fs2_upd) ? $lang_util_php['updated'] : $lang_util_php['update_failled'];
                                }
                        } else {
                                $prob .= $lang_util_php['filesize_error'].'<br />';
                                $outcome = $lang_util_php['skipped'];
                        }

                        if ($dimensions){
                                if (($dimensions[0] <> $db_pwidth) ||  ($dimensions[1] <> $db_pheight)){

                                        $prob .= "{$lang_util_php['incorect_dimension']}<br />{$lang_util_php['database']}{$db_pwidth}x{$db_pheight}<br />{$lang_util_php['actual']}{$dimensions[0]}x{$dimensions[1]}<br />";
                                        $dim_upd = @cpg_db_query("UPDATE {$CONFIG['TABLE_PICTURES']} SET `pwidth` = '{$dimensions[0]}', `pheight` = '{$dimensions[1]}' WHERE `pid` = '$db_pid' LIMIT 1");
                                        $outcome = ($dim_upd) ? $lang_util_php['updated'] : $lang_util_php['update_failled'].mysql_error();
                                }
                        } else {
                                $prob .= $lang_util_php['dimension_error'].'<br />';
                                $outcome = $lang_util_php['skipped'];
                        }
                } else {
                        $prob .= sprintf($lang_util_php['fullpic_error'], $full_pic_url).'<br />';
                        $outcome = $lang_util_php['cannot_fix'];
                }

                if ($prob){

                        $found++;
                        echo "<tr><td class=\"tableb\">$url</td><td class=\"tableb\">$prob</td><td class=\"tableb\">$outcome</td></tr>";
                } else {
                        echo "<tr><td class=\"tableb\">$url</td><td class=\"tableb\">{$lang_util_php['no_prob_detect']}</td><td class=\"tableb\">OK</td></tr>";
                }
                my_flush();

        }

        endtable();

        if ($outcome == 'none') echo $lang_util_php['no_prob_found'];

        if ($count == $numpics){
                   $startpic += $numpics;
                echo <<< EOT
                        <form name="cpgform4" id="cpgform4" action="util.php" method="post">
                                <input type="hidden" name="action" value="refresh_db" />
                                <input type="hidden" name="refresh_numpics" value="$numpics" />
                                <input type="hidden" name="refresh_startpic" value="$startpic" />
                                <input type="hidden" name="albumid" value="$albumid" />
                                <input type="submit" value="{$lang_util_php['continue']}" class="button" />
                        </form>
EOT;
        }
}
pagefooter();
ob_end_flush();
?>