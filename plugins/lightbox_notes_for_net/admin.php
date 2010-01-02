<?php
/**************************************************
  Coppermine 1.5.x Plugin - LightBox (NotesFor.net)
  *************************************************
  Copyright (c) 2009 Joe Carver and Helori Lamberty
  *************************************************
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
  **************************************************/

require_once('./plugins/lightbox_notes_for_net/init.inc.php');
pageheader(sprintf($lang_plugin_lightbox_notes_for_net['configure_plugin_x'], $lang_plugin_lightbox_notes_for_net['display_name']));

if (!GALLERY_ADMIN_MODE) cpg_die(ERROR, $lang_errors['perm_denied'], __FILE__, __LINE__);

global $lang_plugin_php, $CONFIG, $lang_common, $lang_pluginmgr_php, $lang_admin_php;

// variables for plugin
$lb_bor  = $CONFIG['plugin_lightbox_nfn_border'];	
$lb_tim  = $CONFIG['plugin_lightbox_nfn_slidetimer'];
$lb_spd  = $CONFIG['plugin_lightbox_nfn_sizespeed'];
$lb_not  = $CONFIG['plugin_lightbox_nfn_notimer'];			
$lb_ext  = $CONFIG['plugin_lightbox_nfn_image_exit'];
$lb_cap  = $CONFIG['plugin_lightbox_nfn_caption'];
$lb_fol  = $CONFIG['plugin_lightbox_nfn_nofollow'];			
$lb_max  = $CONFIG['plugin_lightbox_nfn_maxpics'];

$sel_not = '';	
if ($lb_not  == '1') {
   	$sel_not = 'selected="selected"';
}
$sel_notb = '';	
if ($lb_not  == '0') {
   	$sel_notb = 'selected="selected"';
}

$sel_ext = '';	
if ($lb_ext  == '1') {
   	$sel_ext = 'selected="selected"';
}
$sel_extb = '';	
if ($lb_ext  == '0') {
   	$sel_extb = 'selected="selected"';
}

$sel_cap = '';	
if ($lb_cap  == '1') {
   	$sel_cap = 'selected="selected"';
}
$sel_capb = '';	
if ($lb_cap  == '0') {
   	$sel_capb = 'selected="selected"';
}

$sel_fol = '';	
if ($lb_fol  == '1') {
   	$sel_fol = 'selected="selected"';
}
$sel_folb = '';	
if ($lb_fol  == '0') {
   	$sel_folb = 'selected="selected"';
}


// Make form 
$superCage = Inspekt::makeSuperCage();

echo <<< EOT
<form name="cpgform" id="cpgform" action="{$_SERVER['REQUEST_URI']}" method="post">
EOT;
starttable('100%', sprintf($lang_plugin_lightbox_notes_for_net['configure_plugin_x'], $lang_plugin_lightbox_notes_for_net['display_name']), 2, 'cpg_zebra');
echo <<< EOT
        <tr>
            <td> 
                {$lang_plugin_lightbox_notes_for_net['display_slideshow_timer_bar']} <a href="plugins/lightbox_notes_for_net/docs/{$documentation_file}.htm#config_timer_bar" class="greybox" title="{$lang_plugin_lightbox_notes_for_net['slideshow_timer']}"><img src="images/help.gif" width="13" height="11" border="0" alt="" /></a>
            </td>
            <td>
                <select name="notimer" id="notimer" class="listbox">
                     <option value="1" $sel_not>No timer bar</option>
                     <option value="0" $sel_notb>Show timer bar</option>
                </select>
            </td>
        </tr>
        <tr>
            <td> 
                 {$lang_plugin_lightbox_notes_for_net['on_exit_goto']}
            </td>
            <td> 
                <select name="exit" id="exit" class="listbox">
                    <option value="1" $sel_ext>Return to last</option>
                    <option value="0" $sel_extb>Return to first</option>
                </select>
            </td>
        </tr>
        <tr>
            <td> 
                 {$lang_plugin_lightbox_notes_for_net['image_caption_below_title']}
            </td>
            <td>
                <select name="caption" id="caption" class="listbox">
                    <option value="1" $sel_cap>Show captions</option>
                    <option value="0" $sel_capb>No captions</option>
                </select>
            </td>
        </tr>
        <tr>
            <td> 
                 {$lang_plugin_lightbox_notes_for_net['add_nofollow_attribute']}
            </td>
            <td>
                <select name="nofollow" id="nofollow" class="listbox">
                     <option value="1" $sel_fol>Add nofollow</option>
                     <option value="0" $sel_folb>No nofollow</option>
                </select>
            </td>
        </tr> 
        <tr>			
            <td>
                 {$lang_plugin_lightbox_notes_for_net['slideshow_timer']} 
            </td>
            <td>
                <input type="text" name="slidetimer" class="textinput" size="3" maxlength="3" value="$lb_tim" /> {$lang_plugin_lightbox_notes_for_net['milliseconds']}
            </td>
        </tr>
        <tr>			
            <td>
                 {$lang_plugin_lightbox_notes_for_net['image_swap_time']}
            </td>
            <td>
                <input type="text" name="sizespeed" class="textinput" size="3" maxlength="3" maxlength="3" value="$lb_spd" /> {$lang_plugin_lightbox_notes_for_net['milliseconds']}
            </td>
        </tr>
        <tr>			
            <td>
                 {$lang_plugin_lightbox_notes_for_net['border_width']}
            </td>
            <td>
                <input type="text" name="border" class="textinput" size="3" maxlength="2" value="$lb_bor" /> {$lang_plugin_lightbox_notes_for_net['pixels']}
            </td>
        </tr>
        <tr>			
            <td>
                 {$lang_plugin_lightbox_notes_for_net['files_in_album_list']} <a href="plugins/lightbox_notes_for_net/docs/{$documentation_file}.htm#config_alblist" class="greybox" title="{$lang_plugin_lightbox_notes_for_net['files_in_album_list']}"><img src="images/help.gif" width="13" height="11" border="0" alt="" /></a>
            </td>
            <td>
                <input type="text" name="maxpics" class="textinput" size="3" maxlength="4" value="$lb_max" /> {$lang_plugin_lightbox_notes_for_net['files_listed']}
            </td>
        </tr>			
        <tr>			
            <td class="tablef">
            </td>
            <td class="tablef">
                <button type="submit" class="button" name="submit" value="{$lang_plugin_lightbox_notes_for_net['submit']}">{$lang_plugin_lightbox_notes_for_net['submit']}</button> 
            </td>
        </tr>
        </td>		
EOT;
endtable();
echo <<< EOT
</form>
EOT;

//change values in the configuration table - minimal data filtering assumes admin use only
if ($superCage->post->keyExists('submit')) {
    
    $lb_bor = $superCage->post->getInt('border');
    $lb_tim = $superCage->post->getInt('slidetimer');
    $lb_spd = $superCage->post->getInt('sizespeed');
    $lb_not = $superCage->post->getInt('notimer');
    $lb_ext = $superCage->post->getRaw('exit');
    $lb_cap = $superCage->post->getInt('caption');
    $lb_fol = $superCage->post->getInt('nofollow');
    $lb_max = $superCage->post->getInt('maxpics');  
      
    if ($lb_bor == '') {
        cpg_die(ERROR, 'ERROR - BORDER FIELD EMPTY', __FILE__, __LINE__);
    }
    if ($lb_tim == '') {
        cpg_die(ERROR, 'ERROR - TIMER FIELD EMPTY', __FILE__, __LINE__);
    }
    if ($lb_spd == '') {
        cpg_die(ERROR, 'ERROR - RESIZE FIELD EMPTY', __FILE__, __LINE__);
    }
    if ($lb_max == '') {
        cpg_die(ERROR, 'ERROR - MAX FILES FIELD EMPTY', __FILE__, __LINE__);
    }
    if ($lb_fol < 0) {
        cpg_die(ERROR, 'ERROR - FOLLOW FIELD EMPTY', __FILE__, __LINE__);
    }
    if ($lb_cap < 0) {
        cpg_die(ERROR, 'ERROR - CAPTION FIELD EMPTY', __FILE__, __LINE__);
    }	
    
                
    cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$lb_bor' WHERE name = 'plugin_lightbox_nfn_border'");
    cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$lb_tim' WHERE name = 'plugin_lightbox_nfn_slidetimer'");	
    cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$lb_spd' WHERE name = 'plugin_lightbox_nfn_sizespeed'");
    cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$lb_not' WHERE name = 'plugin_lightbox_nfn_notimer'");
    cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$lb_ext' WHERE name = 'plugin_lightbox_nfn_image_exit'");
    cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$lb_cap' WHERE name = 'plugin_lightbox_nfn_caption'");
    cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$lb_fol' WHERE name = 'plugin_lightbox_nfn_nofollow'");
    cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '$lb_max' WHERE name = 'plugin_lightbox_nfn_maxpics'");		
    
    
    cpgRedirectPage('index.php?file=lightbox_notes_for_net/admin', $lang_common['information'], 'LightBox plugin settings saved successfully', 1);
    
    exit;
}


pagefooter();

ob_end_flush();

?>