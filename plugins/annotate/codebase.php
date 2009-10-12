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
$thisplugin->add_action('plugin_install','annotate_install');
$thisplugin->add_action('plugin_uninstall','annotate_uninstall');
$thisplugin->add_action('plugin_cleanup','annotate_cleanup');
$thisplugin->add_filter('meta_album_get_pic_pos','annotate_get_pic_pos');

function annotate_meta($meta){
    global $JS, $lang_common, $lang_plugin_annotate;
    require_once './plugins/annotate/init.inc.php';
    $annotate_init_array = annotate_initialize();
	$lang_plugin_annotate = $annotate_init_array['language'];
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
    $meta  .= '<link rel="stylesheet" href="plugins/annotate/lib/photonotes.css" type="text/css" />';
    return $meta;
}

function annotate_file_data($data){
    global $CONFIG, $lang_plugin_annotate;
    // This is the place where the permissions section needs to reside later 
    if (USER_ID) {
        $data['menu'] .= ' <a href="#" class="admin_menu" title="'.$lang_plugin_annotate['plugin_name'].'" onclick="return addnote();">';
    	$data['menu'] .= $annotate_icon_array['annotate'];
    	$data['menu'] .= $lang_plugin_annotate['annotate'];
    	$data['menu'] .= '</a>';
    }

    if (is_image($data['filename'])){

        if (function_exists(panorama_viewer_is_360_degree_panorama)) {
            if (panorama_viewer_is_360_degree_panorama()) {
                return $data;
            }
        }

        $sql = "SELECT * FROM {$CONFIG['TABLE_PREFIX']}notes WHERE pid = {$data['pid']}";
        $result = cpg_db_query($sql);
        
        $notes = array();
        
        while ($row = mysql_fetch_assoc($result)) {
            $row['note'] = addslashes($row['note']);
            $notes[] = $row;
        }
                
        mysql_free_result($result);
    
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

function addnote(){

    var newNote = new PhotoNote('','note' + n,new PhotoNoteRect(10,10,50,50));
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

    $return = '';

   //Write out the initial array definition
   $return .= ($baseName . " = new Array(); \r\n ");    

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
            $return .= ($value . "; \r\n ");
         } else if (is_string($value)) {
            //Output as a string, as we did before       
            $return .= ("'" . $value . "'; \r\n ");
         } else if ($value === false) {
            //Explicitly output false
            $return .= ("false; \r\n ");
         } else if ($value === NULL) {
            //Explicitly output null
            $return .= ("null; \r\n ");
         } else if ($value === true) {
            //Explicitly output true
            $return .= ("true; \r\n ");
         } else {
            //Output the value directly otherwise
            $return .= ($value . "; \r\n ");
         }
      }
   }
   
   return $return;
}


function annotate_install() {
    global $thisplugin, $CONFIG;

    $sql = <<< EOT
    
CREATE TABLE IF NOT EXISTS `{$CONFIG['TABLE_PREFIX']}notes` (
  `nid` smallint(5) unsigned NOT NULL auto_increment,
  `pid` mediumint(8) unsigned NOT NULL,
  `posx` smallint(5) unsigned NOT NULL,
  `posy` smallint(5) unsigned NOT NULL,
  `width` smallint(5) unsigned NOT NULL,
  `height` smallint(5) unsigned NOT NULL,
  `note` text NOT NULL,
  `user_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY  (`nid`),
  KEY `pid` (`pid`)
) TYPE=MyISAM ;

EOT;

    return cpg_db_query($sql);
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
        cpg_db_query("DROP TABLE `{$CONFIG['TABLE_PREFIX']}notes`");
    }
    return true;
}


function annotate_cleanup($action) {
    global $CONFIG, $lang_common;

    $superCage = Inspekt::makeSuperCage();
    $cleanup = $superCage->server->getEscaped('REQUEST_URI');
    if ($action == 1) {
        list($timestamp, $form_token) = getFormToken();
        echo <<< EOT
            <form action="{$cleanup}" method="post">
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td class="tableb">
                            Do you want to remove all annotations from the database?
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
$thisplugin->add_action('page_start','annotate_page_start');
function annotate_page_start() {
    global $lang_meta_album_names;

    $lang_meta_album_names['lastnotes'] = 'Pictures with latest annotations';

    $superCage = Inspekt::makeSuperCage();
    if ($superCage->get->getAlpha('plugin') == "annotate" && $superCage->get->keyExists('delete_orphans')) {
        global $CONFIG;
        load_template();
        pageheader("Delete orphans");

        $result = cpg_db_query("SELECT pid FROM {$CONFIG['TABLE_PICTURES']}");
        $pids = array();
        while ($row = mysql_fetch_row($result)) {
            $pids[] = $row[0];
        }
        $pids = implode(",", $pids);

        $result = cpg_db_query("SELECT COUNT(*) FROM {$CONFIG['TABLE_PREFIX']}notes WHERE pid NOT IN ($pids)");
        list($count) = mysql_fetch_row($result);
        $result = cpg_db_query("DELETE FROM {$CONFIG['TABLE_PREFIX']}notes WHERE pid NOT IN ($pids)");
        echo "Orphaned entries deleted: ".$count;

        exit;
    }
}


// Meta album get_pic_pos
function annotate_get_pic_pos($album) {
    global $CONFIG, $pid, $RESTRICTEDWHERE;

    if ($album === 'lastnotes') {
        $query = "SELECT MAX(nid) FROM {$CONFIG['TABLE_PREFIX']}notes WHERE pid = $pid";
        $result = cpg_db_query($query);
        $nid = mysql_result($result, 0);
        mysql_free_result($result);            

        $query = "SELECT COUNT(DISTINCT n.pid) 
            FROM {$CONFIG['TABLE_PREFIX']}notes AS n 
            INNER JOIN {$CONFIG['TABLE_PICTURES']} AS p ON n.pid = p.pid 
            INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r on r.aid = p.aid 
            $RESTRICTEDWHERE
            AND approved = 'YES'
            AND n.nid > $nid";

            $result = cpg_db_query($query);

            list($pos) = mysql_fetch_row($result);
            mysql_free_result($result);

        return $pos;
    } else {
        return $album;
    }
}


// New meta albums
$thisplugin->add_filter('meta_album', 'annotate_meta_album');
function annotate_meta_album($meta) {
    global $CONFIG, $CURRENT_CAT_NAME, $RESTRICTEDWHERE;

    if ($meta['album'] === 'lastnotes') {
        $album_name = cpg_fetch_icon('user_mgr', 2)." zuletzt markierte Bilder";
        if ($CURRENT_CAT_NAME) {
            $album_name .= " - $CURRENT_CAT_NAME";
        }

        $query = "SELECT DISTINCT n.pid 
            FROM {$CONFIG['TABLE_PREFIX']}notes AS n 
            INNER JOIN {$CONFIG['TABLE_PICTURES']} AS p ON n.pid = p.pid 
            INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON r.aid = p.aid 
            $RESTRICTEDWHERE";

        $result = cpg_db_query($query);
        $count = mysql_num_rows($result);
        mysql_free_result($result);

        $query = "SELECT *
            FROM {$CONFIG['TABLE_PICTURES']} AS p
            INNER JOIN {$CONFIG['TABLE_PREFIX']}notes AS n1 ON p.pid = n1.pid 
            INNER JOIN {$CONFIG['TABLE_ALBUMS']} AS r ON r.aid = p.aid 
            $RESTRICTEDWHERE 
            AND approved = 'YES'
            AND n1.nid IN (SELECT MAX(n2.nid) FROM {$CONFIG['TABLE_PREFIX']}notes AS n2 WHERE n1.pid = n2.pid)
            ORDER BY n1.nid DESC {$meta['limit']}";

        $result = cpg_db_query($query);
        $rowset = cpg_db_fetch_rowset($result);
        mysql_free_result($result);

        build_caption($rowset, array('msg_date'));
    } else {
        return $meta;
    }
    
    $meta['album_name'] = $album_name;
    $meta['count'] = $count;
    $meta['rowset'] = $rowset;

    return $meta;
}

?>