<?php
/**************************************************
  Picture Annotation (annotate) plugin for cpg1.5.x
  *************************************************
  Copyright (c) 2003-2009 Coppermine Dev Team

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  *************************************************
  Coppermine version: 1.5.x
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**************************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

if (defined('DISPLAYIMAGE_PHP')) {
    $thisplugin->add_filter('page_meta','annotate_meta');
    $thisplugin->add_filter('file_data','annotate_file_data');
}
$thisplugin->add_action('plugin_configure','annotate_configure');
$thisplugin->add_action('page_start','annotate_page_start');
$thisplugin->add_action('plugin_install','annotate_install');
$thisplugin->add_action('plugin_uninstall','annotate_uninstall');
$thisplugin->add_action('plugin_cleanup','annotate_cleanup');
$thisplugin->add_filter('meta_album_get_pic_pos','annotate_get_pic_pos');
$thisplugin->add_filter('meta_album', 'annotate_meta_album');

function annotate_meta($meta){
    global $JS, $CONFIG, $lang_common, $lang_plugin_annotate;
    require_once './plugins/annotate/init.inc.php';
    $annotate_init_array = annotate_initialize();
    $lang_plugin_annotate = $annotate_init_array['language'];
    $annotate_icon_array = $annotate_init_array['icon'];
    if (in_array('plugins/annotate/lib/httpreq.js', $JS['includes']) != TRUE) {
        $JS['includes'][] = 'plugins/annotate/lib/httpreq.js';
    }
    if (in_array('plugins/annotate/lib/photonotes.js', $JS['includes']) != TRUE) {
        $JS['includes'][] = 'plugins/annotate/lib/photonotes.js';
    }
    set_js_var('lang_annotate_save', $lang_plugin_annotate['save']);
    set_js_var('lang_annotate_cancel', $lang_plugin_annotate['cancel']);
    set_js_var('lang_annotate_delete', $lang_common['delete']);
    set_js_var('lang_annotate_error_saving_note', $lang_plugin_annotate['error_saving_note']);
    set_js_var('lang_annotate_onsave_not_implemented', $lang_plugin_annotate['onsave_not_implemented']);
    set_js_var('icon_annotate_ok', $annotate_icon_array['ok']);
    set_js_var('icon_annotate_cancel', $annotate_icon_array['cancel']);
    set_js_var('icon_annotate_delete', $annotate_icon_array['delete']);
    if (GALLERY_ADMIN_MODE) {
        set_js_var('visitor_annotate_permission_level', 3);
        set_js_var('visitor_annotate_gallery_admin_mode', 'true');
    } else {
        set_js_var('visitor_annotate_permission_level', annotate_get_permission_level());
        set_js_var('visitor_annotate_gallery_admin_mode', 'false');
    }
    set_js_var('visitor_annotate_user_id', USER_ID);
    $meta  .= '<link rel="stylesheet" href="plugins/annotate/lib/photonotes.css" type="text/css" />';
    return $meta;
}

function annotate_file_data($data){
    global $CONFIG, $LINEBREAK, $lang_plugin_annotate, $annotate_icon_array, $REFERER;
    // Determine if the visitor is allowed to have that button
    if (annotate_get_permission_level() >= 2) {
        $data['menu'] .= <<< EOT
        <script type="text/javascript">
            document.write(' <a href="javascript:void();" class="admin_menu" title="{$lang_plugin_annotate['plugin_name']}" onclick="return addnote();" rel="nofollow">');
            document.write('{$annotate_icon_array['annotate']}{$lang_plugin_annotate['annotate']}');
            document.write('</a>');
        </script>
EOT;
    }

    if (is_image($data['filename'])){
        if (function_exists(panorama_viewer_is_360_degree_panorama)) {
            if (panorama_viewer_is_360_degree_panorama()) {
                return $data;
            }
        }

        $sql = "SELECT * FROM {$CONFIG['TABLE_PREFIX']}plugin_annotate WHERE pid = {$data['pid']}";
        $result = cpg_db_query($sql);
        
        $notes = array();
        
        while ($row = mysql_fetch_assoc($result)) {
            $row['note'] = addslashes($row['note']);
            $notes[] = $row;
        }
                
        mysql_free_result($result);
        $nr_notes = count($notes);
        
        // Visitor can view annotations in the first place?
        if (USER_ID && annotate_get_permission_level() == 0) {
            // Stop processing the annotations any further
            return $data;
        } elseif (!USER_ID && annotate_get_permission_level() == 0) {
            $max_permission_level = mysql_result(cpg_db_query("SELECT MAX(value) FROM {$CONFIG['TABLE_CONFIG']} WHERE name LIKE 'plugin_annotate_permissions_%'"),0);
            if ($max_permission_level >= 1 && $nr_notes > 0 && $CONFIG['allow_user_registration'] != 0) {
                // There are annotations, so let's promote them
                if ($nr_notes == 1) {
                    $data['footer'] .= $lang_plugin_annotate['1_annotation_for_file'] . '<br />' . $LINEBREAK;
                } elseif ($nr_notes > 1) {
                    $data['footer'] .= sprintf($lang_plugin_annotate['x_annotations_for_file'], $nr_notes) . '<br />' . $LINEBREAK;
                }
                $data['footer'] .= sprintf(
                                            $lang_plugin_annotate['registration_promotion'],
                                            '<a href="login.php?referer='.$REFERER.'">',
                                            '</a>',
                                            '<a href="register.php?referer='.$REFERER.'">',
                                            '</a>'
                                            );
            }
            // Stop processing the annotations any further
            return $data;
        } 
    
        $jsarray = arrayToJS4($notes, 'annotations');

        $html =& $data['html'];

        $html = str_replace("<img ", "<img style=\"padding:0px\" ", $html);

        if (function_exists(panorama_viewer_image)) {
            $search = "/(<table.*style=\"table-layout:fixed.*<div style=\"overflow:auto.*>)(.*)(<\/div><\/td><\/tr><\/table>)/Uis";
            preg_match($search, $html, $panorama_viewer_matches);
            $html = preg_replace($search, "\\2", $html);
        }

        $container_width = $data['pwidth'];
        if ($data['mode'] == 'normal') {
            $imagesize = getimagesize($CONFIG['fullpath'].$data['filepath'].$CONFIG['normal_pfx'].$data['filename']);
            $container_width = $imagesize[0];
        }
        $container_width += 4;

        $html = '<div class="Photo fn-container" style="width:'.$container_width.'px;" id="PhotoContainer">' . $html . '</div>';

        if (function_exists(panorama_viewer_image)) {
            $html = $panorama_viewer_matches[1].$html.$panorama_viewer_matches[3];
        }

        $superCage = Inspekt::MakeSuperCage();

        // list existing annotations of the currently viewed album // TODO - add config option to toggle display
        $btns_person = "";
        if ($superCage->get->getInt('album')) {
            $result = cpg_db_query("
                SELECT DISTINCT note FROM {$CONFIG['TABLE_PREFIX']}plugin_annotate n
                INNER JOIN {$CONFIG['TABLE_PICTURES']} p
                ON p.pid = n.pid
                WHERE p.aid = {$superCage->get->getInt('album')}
                ORDER BY note
            ");

            if (mysql_num_rows($result)) {
                $btns_person .= "<div id=\"btns_person\" style=\"white-space:normal; cursor:default;\"> {$lang_plugin_annotate['rapid_annotation']}: ";
                while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
                    $btns_person .= "<span onclick=\"return addnote('{$row[0]}')\" class=\"button\" style=\"cursor:pointer;\" title=\"{$row[0]} auf dem Bild markieren\">&nbsp;{$row[0]}&nbsp;</span> ";
                }
                $btns_person .= "</div>";
                $html = $btns_person.$html;
            }
        }

        // list annotations from the currently viewed picture // TODO - add config option to toggle display
        if ($nr_notes > 0) {
            $on_this_pic_array = array();
            $n = 0;
            foreach($notes as $value) {
                $on_this_pic_array[] = "<a href=\"thumbnails.php?album=shownotes&amp;note={$value['note']}\" class=\"admin_menu\" title=\"{$lang_plugin_annotate['all_pics_of']} {$value['note']}\" onmouseover=\"notes.notes[$n].ShowNote(); notes.notes[$n].ShowNoteText();\" onmouseout=\"notes.notes[$n].HideNote(); notes.notes[$n].HideNoteText();\">{$value['note']}</a> ";
                $n++;
            }
            sort($on_this_pic_array);
            $on_this_pic_div = "<div id=\"on_this_pic\" style=\"white-space:normal; cursor:default; padding-bottom:4px;\"> {$lang_plugin_annotate['on_this_pic']}: ";
            foreach($on_this_pic_array as $value) {
                $on_this_pic_div .= $value;
            }
            $on_this_pic_div .= "</div>";
            $html .= $on_this_pic_div;
        }

        $user_id  = USER_ID;
        $admin = GALLERY_ADMIN_MODE ? 'true' : 'false';
        
        $html .= <<< EOT
        
<script type="text/javascript">

var $jsarray

/* create the Photo Note Container */
var container = document.getElementById('PhotoContainer');

var notes = new PhotoNoteContainer(container);

for (var n = 0; n < annotations.length; n++){
    /* create a note */
    var size = new PhotoNoteRect(annotations[n].posx, annotations[n].posy, annotations[n].width, annotations[n].height);
    var note = new PhotoNote(annotations[n].note,'note' + n, size);
    /* implement the save/delete functions */
    note.onsave = function (note) { return ajax_save(note); };
    note.ondelete = function (note) { return ajax_delete(note); };
    /* assign the note id number */
    note.nid = annotations[n].nid;
    if (!$admin && note.user_id != $user_id) note.editable = false;
    /* add it to the container */
    notes.AddNote(note);
}

notes.HideAllNotes();

addEvent(container, 'mouseover', function() {
         notes.ShowAllNotes();
    });
    
 addEvent(container, 'mouseout', function() {
         notes.HideAllNotes();
    });

function addnote(note_text){
    if (js_vars.visitor_annotate_permission_level < 2) {
        return false;
    }
    var newNote = new PhotoNote(note_text,'note' + n,new PhotoNoteRect(10,10,50,50));
    newNote.onsave = function (note) { return ajax_save(note); };
    newNote.ondelete = function (note) { return ajax_delete(note); };
    notes.AddNote(newNote);
    newNote.Select();
    newNote.nid = 0;
    return false;
}

function ajax_save(note){
    var data = 'add=' + {$data['pid']} + '&nid=' + note.nid + '&posx=' + note.rect.left + '&posy=' + note.rect.top + '&width=' + note.rect.width + '&height=' + note.rect.height + '&note=' + encodeURI(note.text);
    annotate_request(data, note);
    return true;
}

function ajax_delete(note){
    var data = 'remove=' + note.nid;
    annotate_request(data, note);
    return true;
}
</script>

    
EOT;

    }

    return $data;
}

// Based on code by Rob Williams
//Convert a PHP array to a JavaScript one (rev. 4)
function arrayToJS4($array, $baseName) {
    global $LINEBREAK;
    $return = '';
   //Write out the initial array definition
   $return .= $baseName . ' = new Array();'.$LINEBREAK;    
   //Reset the array loop pointer
   reset ($array);
   //Use list() and each() to loop over each key/value
   //pair of the array
   while (list($key, $value) = each($array)) {
      if (is_numeric($key)) {
         //A numeric key, so output as usual
         $outKey = "[" . $key . "]";
      } else {
         //A string key, so output as a string
         $outKey = "['" . $key . "']";
      }
      if (is_array($value)) {
         //The value is another array, so simply call
         //another instance of this function to handle it
         $return .= arrayToJS4($value, $baseName . $outKey);
      } else {
         //Output the key declaration
         $return .= ($baseName . $outKey . " = ");      
         //Now output the value
         if (is_numeric($value)){
            $return .= $value . ';'.$LINEBREAK;
         } else if (is_string($value)) {
            //Output as a string, as we did before       
            $return .= "'" . $value . "';".$LINEBREAK;
         } else if ($value === false) {
            //Explicitly output false
            $return .= 'false;'.$LINEBREAK;
         } else if ($value === NULL) {
            //Explicitly output null
            $return .= 'null;'.$LINEBREAK;
         } else if ($value === true) {
            //Explicitly output true
            $return .= 'true;'.$LINEBREAK;
         } else {
            //Output the value directly otherwise
            $return .= $value . ';'.$LINEBREAK;
         }
      }
   }
   return $return;
}


function annotate_install() {
    global $thisplugin, $CONFIG;
    // Create the super cage
    $superCage = Inspekt::makeSuperCage();
    $annotate_installation = 1;
    require 'include/sql_parse.php';
    // Perform the database changes
    $db_schema = $thisplugin->fullpath . '/schema.sql';
    $sql_query = fread(fopen($db_schema, 'r'), filesize($db_schema));
    $sql_query = preg_replace('/CPG_/', $CONFIG['TABLE_PREFIX'], $sql_query);
    $sql_query = remove_remarks($sql_query);
    $sql_query = split_sql_file($sql_query, ';');
    foreach($sql_query as $q) {
        cpg_db_query($q);
    }
    $db_schema = $thisplugin->fullpath . '/update.sql';
    $sql_query = fread(fopen($db_schema, 'r'), filesize($db_schema));
    $sql_query = preg_replace('/CPG_/', $CONFIG['TABLE_PREFIX'], $sql_query);
    $sql_query = remove_remarks($sql_query);
    $sql_query = split_sql_file($sql_query, ';');
    foreach($sql_query as $q) {
        @mysql_query($q);
    }

    if ($superCage->post->keyExists('submit')) {
        annotate_configuration_submit();
        return true;
    } else {
        return 1;
    }
}


function annotate_uninstall() {
    $superCage = Inspekt::makeSuperCage();

    if (!$superCage->post->keyExists('drop')) {
        return 1;
    }

    if (!checkFormToken()) {
        global $lang_errors;
        cpg_die(ERROR, $lang_errors['invalid_form_token'], __FILE__, __LINE__);
    }

    if ($superCage->post->getInt('drop') == 1) {
        global $CONFIG;
        // Delete the plugin config records
        cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name LIKE 'plugin_annotate_%'");
        // Drop the extra plugin table
        cpg_db_query("DROP TABLE IF EXISTS {$CONFIG['TABLE_PREFIX']}plugin_annotate");
    }
    return true;
}


function annotate_cleanup($action) {
    global $CONFIG, $lang_common, $lang_plugin_annotate;
    require_once './plugins/annotate/init.inc.php';
    $annotate_init_array = annotate_initialize();
    $lang_plugin_annotate = $annotate_init_array['language'];
    $superCage = Inspekt::makeSuperCage();
    $cleanup = $superCage->server->getEscaped('REQUEST_URI');
    if ($action == 1) {
        list($timestamp, $form_token) = getFormToken();
        echo <<< EOT
            <form action="{$cleanup}" method="post">
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td class="tableb">
                            {$lang_plugin_annotate['prune_database']}
                        </td>
                        <td class="tableb">
                            <input type="radio" name="drop" id="drop_yes" value="1" checked="checked" />
                            <label for="drop_yes" class="clickable_option">{$lang_common['yes']}</label>
                        </td>
                        <td class="tableb">
                            <input type="radio" name="drop" id="drop_no"  value="0" />
                            <label for="drop_no" class="clickable_option">{$lang_common['no']}</label>
                        </td>
                        <td class="tableb">
                            <input type="hidden" name="form_token" value="{$form_token}" />
                            <input type="hidden" name="timestamp" value="{$timestamp}" />
                            <input type="submit" name="submit" value="{$lang_common['go']}" class="button" />
                        </td>
                    </tr>
                </table>
            </form>
EOT;
    }
}





//// New meta album

// Meta album titles, delete orphans
function annotate_page_start() {
    global $lang_meta_album_names;

    $lang_meta_album_names['lastnotes'] = 'Pictures with latest annotations'; // TODO - i18n
    $lang_meta_album_names['shownotes'] = 'Pictures of: ....'; // TODO - i18n

    $superCage = Inspekt::makeSuperCage();
    if ($superCage->get->getAlpha('plugin') == "annotate" && $superCage->get->keyExists('delete_orphans')) {
        global $CONFIG;
        require_once './plugins/annotate/init.inc.php';
        $annotate_init_array = annotate_initialize();
        $lang_plugin_annotate = $annotate_init_array['language'];
        $annotate_icon_array = $annotate_init_array['icon'];
        load_template();
        pageheader($lang_plugin_annotate['delete_orphaned_entries']);

        $result = cpg_db_query("SELECT pid FROM {$CONFIG['TABLE_PICTURES']}");
        $pids = array();
        while ($row = mysql_fetch_row($result)) {
            $pids[] = $row[0];
        }
        $pids = implode(",", $pids);

        $result = cpg_db_query("SELECT COUNT(*) FROM {$CONFIG['TABLE_PREFIX']}plugin_annotate WHERE pid NOT IN ($pids)");
        list($count) = mysql_fetch_row($result);
        $result = cpg_db_query("DELETE FROM {$CONFIG['TABLE_PREFIX']}plugin_annotate WHERE pid NOT IN ($pids)");
        if ($count == 1) {
            $count_output = $lang_plugin_annotate['1_orphaned_entry_deleted'];
        } else {
            $count_output = sprintf($lang_plugin_annotate['x_orphaned_entries_deleted'], $count);
        }
        starttable('-1', $annotate_icon_array['delete'] . $lang_plugin_annotate['delete_orphaned_entries']);
        echo <<< EOT
        <tr>
            <td class="tableb">
                {$count_output}
            </td>
        </tr>
EOT;
        endtable();
        exit;
    }

    if ($superCage->get->getAlpha('plugin') == "annotate" && $superCage->get->keyExists('update_database')) {
        global $CONFIG;
        require_once './plugins/annotate/init.inc.php';
        $annotate_init_array = annotate_initialize();
        $lang_plugin_annotate = $annotate_init_array['language'];
        $annotate_icon_array = $annotate_init_array['icon'];
        load_template();
        pageheader($lang_plugin_annotate['update_database']);

        require 'include/sql_parse.php';
        $db_schema = './plugins/annotate/update.sql';
        $sql_query = fread(fopen($db_schema, 'r'), filesize($db_schema));
        $sql_query = preg_replace('/CPG_/', $CONFIG['TABLE_PREFIX'], $sql_query);
        $sql_query = remove_remarks($sql_query);
        $sql_query = split_sql_file($sql_query, ';');
        foreach($sql_query as $q) {
            @mysql_query($q);
        }
        starttable('-1', $annotate_icon_array['update_database'] . $lang_plugin_annotate['update_database']);
        echo <<< EOT
        <tr>
            <td class="tableb">
                {$lang_plugin_annotate['update_database_success']}
            </td>
        </tr>
EOT;
        endtable();
        exit;
    }
}


// Meta album get_pic_pos
function annotate_get_pic_pos($album) {
    global $CONFIG, $pid, $RESTRICTEDWHERE;

    switch ($album) {
        case 'lastnotes':
            $query = "SELECT MAX(nid) FROM {$CONFIG['TABLE_PREFIX']}plugin_annotate WHERE pid = $pid";
            $result = cpg_db_query($query);
            $nid = mysql_result($result, 0);
            mysql_free_result($result);            

            $query = "SELECT COUNT(DISTINCT n.pid) 
                FROM {$CONFIG['TABLE_PREFIX']}plugin_annotate AS n 
                INNER JOIN {$CONFIG['TABLE_PICTURES']} AS p ON n.pid = p.pid 
                INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r on r.aid = p.aid 
                $RESTRICTEDWHERE
                AND approved = 'YES'
                AND n.nid > $nid";

                $result = cpg_db_query($query);

                list($pos) = mysql_fetch_row($result);
                mysql_free_result($result);

            return $pos;
            break;

        case 'shownotes':
            $superCage = Inspekt::makeSuperCage();
            $note = $superCage->get->keyExists('note') ? trim(preg_replace("[\s+]", " ", $superCage->get->getRaw('note'))) : $superCage->cookie->getRaw($CONFIG['cookie_name'].'note');
            setcookie($CONFIG['cookie_name'].'note', $note);

            $query = "SELECT DISTINCT p.pid 
                FROM {$CONFIG['TABLE_PICTURES']} AS p INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON p.aid = r.aid 
                INNER JOIN {$CONFIG['TABLE_PREFIX']}plugin_annotate n ON p.pid = n.pid 
                $RESTRICTEDWHERE 
                AND approved = 'YES' 
                AND n.note = '$note' 
                GROUP BY p.pid 
                ORDER BY p.pid DESC";

                $result = cpg_db_query($query);
                $pos = 0;
                while($row = mysql_fetch_assoc($result)) {
                    if ($row['pid'] == $pid) {
                        break;
                    }
                    $pos++;
                }
                mysql_free_result($result);

            return $pos;
            break;

        default: 
            return $album;
    }
}


function annotate_get_shownotes_values() {
    global $CONFIG;
    $superCage = Inspekt::makeSuperCage();

    $note = $superCage->get->keyExists('note') ? trim(preg_replace("[\s+]", " ", $superCage->get->getRaw('note'))) : $superCage->cookie->getRaw($CONFIG['cookie_name'].'note');
    setcookie($CONFIG['cookie_name'].'note', $note);

    $return['columns'] = "";
    $return['tables'] = "{$CONFIG['TABLE_PICTURES']} AS p INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON p.aid = r.aid";
    $return['where'] = "";
    $return['suffix'] = "";
    $return['order'] = "p.pid";

    if ($note != "") {
        $return['columns'] .= ", COUNT(DISTINCT note) AS anzahl";
        $return['tables'] .= " INNER JOIN {$CONFIG['TABLE_PREFIX']}plugin_annotate n ON p.pid = n.pid";
        $return['where'] .= "AND n.note = '$note'";
        $return['suffix'] = "GROUP BY p.pid";
    }

    return $return;
}


// New meta albums
function annotate_meta_album($meta) {
    global $CONFIG, $CURRENT_CAT_NAME, $RESTRICTEDWHERE, $lang_plugin_annotate;
    require_once './plugins/annotate/init.inc.php';
    $annotate_init_array = annotate_initialize();
    $lang_plugin_annotate = $annotate_init_array['language'];
    $annotate_icon_array = $annotate_init_array['icon'];
    
    switch ($meta['album']) {
        case 'lastnotes':
            $album_name = $annotate_icon_array['annotate'] . ' ' . $lang_plugin_annotate['lastnotes'];
            if ($CURRENT_CAT_NAME) {
                $album_name .= " - $CURRENT_CAT_NAME";
            }

            $query = "SELECT DISTINCT n.pid 
                FROM {$CONFIG['TABLE_PREFIX']}plugin_annotate AS n 
                INNER JOIN {$CONFIG['TABLE_PICTURES']} AS p ON n.pid = p.pid 
                INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON r.aid = p.aid 
                $RESTRICTEDWHERE";

            $result = cpg_db_query($query);
            $count = mysql_num_rows($result);
            mysql_free_result($result);

            $query = "SELECT *
                FROM {$CONFIG['TABLE_PICTURES']} AS p
                INNER JOIN {$CONFIG['TABLE_PREFIX']}plugin_annotate AS n1 ON p.pid = n1.pid 
                INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON r.aid = p.aid 
                $RESTRICTEDWHERE 
                AND approved = 'YES'
                AND n1.nid IN (SELECT MAX(n2.nid) FROM {$CONFIG['TABLE_PREFIX']}plugin_annotate AS n2 WHERE n1.pid = n2.pid)
                ORDER BY n1.nid DESC {$meta['limit']}";

            $result = cpg_db_query($query);
            $rowset = cpg_db_fetch_rowset($result);
            mysql_free_result($result);

            build_caption($rowset, array('msg_date'));
            break;

        case 'shownotes':
            $album_name = cpg_fetch_icon('search', 2)." Suchergebnisse"; // TODO - i18n
            if ($CURRENT_CAT_NAME) {
                $album_name .= " - $CURRENT_CAT_NAME";
            }

            $superCage = Inspekt::makeSuperCage();
            $note = $superCage->get->keyExists('note') ? trim(preg_replace("[\s+]", " ", $superCage->get->getRaw('note'))) : $superCage->cookie->getRaw($CONFIG['cookie_name'].'note');
            setcookie($CONFIG['cookie_name'].'note', $note);

            $query = "SELECT p.pid FROM {$CONFIG['TABLE_PICTURES']} AS p INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON p.aid = r.aid INNER JOIN {$CONFIG['TABLE_PREFIX']}plugin_annotate n ON p.pid = n.pid $RESTRICTEDWHERE AND approved = 'YES' AND n.note = '$note' GROUP BY p.pid";
            $result = cpg_db_query($query);
            $count = mysql_num_rows($result);
            mysql_free_result($result);

            $query = "SELECT p.*, r.title FROM {$CONFIG['TABLE_PICTURES']} AS p INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON p.aid = r.aid INNER JOIN {$CONFIG['TABLE_PREFIX']}plugin_annotate n ON p.pid = n.pid $RESTRICTEDWHERE AND approved = 'YES' AND n.note = '$note' GROUP BY p.pid ORDER BY p.pid DESC {$meta['limit']}";
            $result = cpg_db_query($query);
            $rowset = cpg_db_fetch_rowset($result);
            mysql_free_result($result);

            build_caption($rowset);
            break;

        default:
            return $meta;
    }
    
    $meta['album_name'] = $album_name;
    $meta['count'] = $count;
    $meta['rowset'] = $rowset;

    return $meta;
}

function annotate_configuration_submit() {
    global $CONFIG, $lang_errors;
    $superCage = Inspekt::makeSuperCage();
    // Populate the form fields and run the queries for the submit form
    $config_changes_counter = 0;
    if (!GALLERY_ADMIN_MODE) {
        cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
    }

    $result = cpg_db_query("SELECT group_id FROM {$CONFIG['TABLE_USERGROUPS']} WHERE has_admin_access != '1'");
    while($row = mysql_fetch_assoc($result)) {
        if ($superCage->post->keyExists('plugin_annotate_permissions_'.$row['group_id']) && $superCage->post->getInt('plugin_annotate_permissions_'.$row['group_id']) >= '0'  && $superCage->post->getInt('plugin_annotate_permissions_'.$row['group_id']) <= '3') {
            $new_value = $superCage->post->getInt('plugin_annotate_permissions_'.$row['group_id']);
            if ($new_value === $CONFIG['plugin_annotate_permissions_'.$row['group_id']]) {
                continue;
            }
            elseif (is_numeric($CONFIG['plugin_annotate_permissions_'.$row['group_id']])) {
                cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$new_value' WHERE name = 'plugin_annotate_permissions_{$row['group_id']}'");
                $config_changes_counter++;
            } else {
                cpg_db_query("INSERT INTO {$CONFIG['TABLE_CONFIG']} (name, value) VALUES('plugin_annotate_permissions_{$row['group_id']}', '$new_value')");
                $config_changes_counter++;
            }
        }
    }

    return $config_changes_counter;
}

function annotate_configure() {
    global $CONFIG, $THEME_DIR, $thisplugin, $lang_plugin_annotate, $lang_common, $annotate_icon_array, $lang_errors, $annotate_installation, $annotate_title;
    $superCage = Inspekt::makeSuperCage();
    $additional_submit_information = '';
    if (!GALLERY_ADMIN_MODE) {
        cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
    }

    // Form submit?
    if ($superCage->post->keyExists('submit') == TRUE) {
        //Check if the form token is valid
        if(!checkFormToken()){
            cpg_die(ERROR, $lang_errors['invalid_form_token'], __FILE__, __LINE__);
        }
        $config_changes_counter = annotate_configuration_submit();
        if ($config_changes_counter > 0) {
            $additional_submit_information .= '<div class="cpg_message_success">' . $lang_plugin_annotate['changes_saved'] . '</div>';
        } else {
            $additional_submit_information .= '<div class="cpg_message_validation">' . $lang_plugin_annotate['no_changes'] . '</div>';
        }
    }

    // Check if guests have greater permissions than registered users - TODO: doesn't work after permission system change -- how do we detect the guest group? Fixed group_id 3?
    if ($CONFIG['plugin_annotate_permissions_registered'] < $CONFIG['plugin_annotate_permissions_guest']) {
        $additional_submit_information .= '<div class="cpg_message_warning">' . $lang_plugin_annotate['guests_more_permissions_than_registered'] . '</div>';
    }

    // Create the table row that is displayed during initial install
    if ($annotate_installation == 1) {
        $additional_submit_information .= '<div class="cpg_message_info">' . $lang_plugin_annotate['submit_to_install'] . '</div>';
    }

    // Fetch user groups
    $usergroups = "";
    $result = cpg_db_query("SELECT group_id, group_name, has_admin_access FROM {$CONFIG['TABLE_USERGROUPS']} ORDER BY group_id ASC");
    while($row = mysql_fetch_assoc($result)) {
        if ($row['has_admin_access'] == "1") {
            $usergroups .= <<< EOT
                <tr>
                    <td valign="top" align="left" class="tableb">
                        {$row['group_name']}
                    </td>
                    <td valign="top" align="center" class="tableb">
                        <input type="radio" class="radio" disabled="disabled" />
                    </td>
                    <td valign="top" align="center" class="tableb">
                        <input type="radio" class="radio" disabled="disabled" />
                    </td>
                    <td valign="top" align="center" class="tableb">
                        <input type="radio" class="radio" disabled="disabled" />
                    </td>
                    <td valign="top" align="center" class="tableb">
                        <input type="radio" class="radio" checked="checked" />
                    </td>
                </tr>
EOT;
        } else {
            $row['permission'] = mysql_result(cpg_db_query("SELECT value FROM {$CONFIG['TABLE_CONFIG']} WHERE name = 'plugin_annotate_permissions_{$row['group_id']}'"),0);
            $usergroups .= <<< EOT
                <tr>
                    <td valign="top" align="left" class="tableb">
                        {$row['group_name']}
                    </td>
EOT;
            for ($i=0; $i < 4; $i++) {
                if (!is_numeric($row['permission']) && $i == 0) {
                    $checked = "checked=\"checked\"";
                } else {
                    $checked = $row['permission'] == $i ? "checked=\"checked\"" : "";
                }
                $usergroups .= <<< EOT
                    <td valign="top" align="center" class="tableb">
                        <input type="radio" name="plugin_annotate_permissions_{$row['group_id']}" id="plugin_annotate_permissions_{$row['group_id']}_{$i}" class="radio" value="{$i}" $disabled $checked />
                    </td>
EOT;
            }

            $usergroups .= <<< EOT
                </tr>
EOT;
        }
    }

    list($timestamp, $form_token) = getFormToken();
    
    // Start the actual output
    echo <<< EOT
            <form action="" method="post" name="annotate_config" id="annotate_config">
EOT;

    starttable('100%', $annotate_icon_array['configure'] . $lang_plugin_annotate['configure_plugin'], 3);
    echo <<< EOT
                    <tr>
                        <td valign="top" class="tableb">
                            {$lang_plugin_annotate['permissions']}
                        </td>
                        <td valign="top" class="tableb" colspan="2">
                            <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                <tr>
                                    <th valign="top" align="left" class="tableh2">
                                        {$lang_plugin_annotate['group']}
                                    </th>
                                    <th valign="top" align="left" class="tableh2">
                                        {$annotate_icon_array['permission_none']}{$lang_plugin_annotate['no_access']}
                                    </th>
                                    <th valign="top" align="center" class="tableh2">
                                        {$annotate_icon_array['permission_read']}{$lang_plugin_annotate['read_annotations']}
                                    </th>
                                    <th valign="top" align="center" class="tableh2">
                                        {$annotate_icon_array['permission_write']}{$lang_plugin_annotate['read_write_annotations']}
                                    </th>
                                    <th valign="top" align="center" class="tableh2">
                                    {$annotate_icon_array['permission_delete']}{$lang_plugin_annotate['read_write_delete_annotations']}
                                    </th>
                                </tr>
                                $usergroups
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign="middle" class="tablef">
                        </td>
                        <td valign="middle" class="tablef" colspan="2">
                            <input type="hidden" name="form_token" value="{$form_token}" />
                            <input type="hidden" name="timestamp" value="{$timestamp}" />
                            <button type="submit" class="button" name="submit" value="{$lang_common['ok']}">{$annotate_icon_array['ok']}{$lang_common['ok']}</button>
                        </td>
                    </tr>
EOT;
    endtable();
    echo <<< EOT
            {$additional_submit_information}
            </form>

EOT;
}


function annotate_get_permission_level() {
    global $CONFIG;

    $user = mysql_fetch_assoc(cpg_db_query("SELECT user_group, user_group_list FROM {$CONFIG['TABLE_USERS']} WHERE user_id = ".USER_ID));
    if ($user['user_group_list'] != "") {
        $user_group_list = explode(",", $user['user_group_list']);
    }
    $user_group_list[] = $user['user_group'];
    
    for($i=0; $i<count($user_group_list); $i++) {
        $user_group_list[$i] = "name = 'plugin_annotate_permissions_{$user_group_list[$i]}'";
    }

    $permission_level = mysql_result(cpg_db_query("SELECT MAX(value) FROM {$CONFIG['TABLE_CONFIG']} WHERE ".implode(" OR ", $user_group_list)),0);
    $permission_level = $permission_level > 0 ? $permission_level : 0;
    $permission_level = GALLERY_ADMIN_MODE ? 3 : $permission_level;

    return $permission_level;
}


?>