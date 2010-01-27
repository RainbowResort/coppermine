<?php
 /**
 *
 * BrainFeeder for CPG
 * Version 1.1 RC
 * written  by Hallvard Natvik <hallvard@natvik.com>
 * Send me a mail if you use it
 * 
 * This is free software made available to you without any guarantees or obligations
 * You can use this sofware anyway you like.
 *------------------------------------------------------------
 * This file manages the configuration screen 
 */
require('include/init.inc.php');
echo "<SCRIPT language=\"JavaScript1.2\">
function popup(URL)
{
popwindow= window.open (URL, \"popwindow\",
    \"status=0,toolbar=0,location=1,menubar=0,directories=0,resizable=1,scrollbars=1,width=450,height=500\");
}
</SCRIPT>";
if (!GALLERY_ADMIN_MODE) cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);
$query = "SELECT value FROM {$CONFIG['TABLE_CONFIG']} WHERE name ='BF_db_ver'";
$result = cpg_db_query($query);
if (!$data = cpg_db_fetch_row($result)) {
    $exBF_db_ver =1;
    cpg_db_query("INSERT INTO {$CONFIG['TABLE_CONFIG']} values ('BF_db_ver', 1)");
} else {
    $exBF_db_ver = $data['value'];
}
if ($exBF_db_ver < $CONFIG['BF_db_ver']) { //Checks if the required version of brainfeeder table(s) is used - upgrades old versions
    if ($exBF_db_ver == 1) {
        $result=cpg_db_query("ALTER table {$CONFIG[TABLE_brainfeeder]} ADD feed_random VARCHAR(10) DEFAULT NULL");
        $result=cpg_db_query("UPDATE {$CONFIG[TABLE_brainfeeder]} SET feed_type ='Any' WHERE feed_type='Last public'");
        $result=cpg_db_query("UPDATE {$CONFIG[TABLE_brainfeeder]} SET feed_random ='Last' WHERE feed_random=''");
        $result=cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value =2 WHERE name='BF_db_ver'");
        $exBF_db_ver = 2;
    }
    if ($exBF_db_ver == 2) {
        $result=cpg_db_query("ALTER table {$CONFIG[TABLE_brainfeeder]} ADD feed_media VARCHAR(20) DEFAULT NULL");
        $result=cpg_db_query("UPDATE {$CONFIG[TABLE_brainfeeder]} SET feed_media ='Any' ");
        $result=cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value =3 WHERE name='BF_db_ver'");
        $exBF_db_ver = 3;
    }
    if ($exBF_db_ver == 3) {
        $result=cpg_db_query("ALTER table {$CONFIG[TABLE_brainfeeder]} ADD pic_size VARCHAR(15) DEFAULT NULL");
        $result=cpg_db_query("UPDATE {$CONFIG[TABLE_brainfeeder]} SET pic_size ='Thumb' ");
        $result=cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value =4 WHERE name='BF_db_ver'");
        $exBF_db_ver = 4;
    }
    if ($exBF_db_ver == 4) {
        $result=cpg_db_query("ALTER table {$CONFIG[TABLE_brainfeeder]} ADD item_content VARCHAR(250) DEFAULT NULL");
        $result=cpg_db_query("UPDATE {$CONFIG[TABLE_brainfeeder]} SET item_content ='{descr}' ");
        if (isset($CONFIG['TABLE_CMS'])) $result=cpg_db_query("UPDATE {$CONFIG[TABLE_brainfeeder]} SET item_content ='{descr}{br}{miniCMS}' WHERE item_cms='Yes'");
        $result=cpg_db_query("ALTER table {$CONFIG[TABLE_brainfeeder]} DROP item_cms");
        $result=cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value =5 WHERE name='BF_db_ver'");
        $exBF_db_ver = 5;
    }
}
pageheader(' ');
if (!isset($_GET['cf_op'])) {
    $operation = "list";
} else {
    $operation = $_GET['cf_op'];
}

$fields = array (
        "Desciption"=> array ("Description", "bar"),
        "fid"=> array ("Id:", "readonly",3,"",'value'=>""),
        "feed_name" => array ("Feed Name:", "input", 30, "",'value'=>""),
        "feed_title" => array("Feed Title:", "input",60, $CONFIG['gallery_name'],'value'=>""),
        "logo_keyw" => array ("Keyword for logo picture", "input", 10, "", 'value'=>""),
        "feed_link" => array("Feed main link:", "input",100, $CONFIG['site_url'],'value'=>""),
        "feed_description" => array("Description:", "textarea",250, $CONFIG['gallery_description'],'value'=>""),
        "feed_copyright" => array("Copyright message:", "input",100, "",'value'=>""),
        "feed_keywords" => array("Feed categories:", "input",100, "",'value'=>""),
        
        "Selection"=> array ("Select content", "bar"),
        "items_to_include" => array("Number of items to include:", "input",10, 10, 'value'=>""),
        "feed_type" => array("Type:", "options",array("Any", "Keyword", "Album", "Category", "Hits", "Rating"), 'Keyword', 'value'=>""),
        "feed_parameter" => array("Which keyword(s), Album id or Cat id?:", "input",100, "", 'value'=>""),
        "feed_media" => array ("Media types:", "options", array("Pictures", "Pictures and video", "Any"),"Any", 'value'=>""),
        "feed_random" => array ("Last pictures or random?", "options", array("Last", "Random"),"Last", 'value'=>""),
        "feed_incl_restr" => array ("Include protected pictures?", "yesno", "No",'value'=>""),
        
        "item_setup"=> array ("Configure items", "bar"),
        "item_def_title" => array("Heading for pictures without title in Coppermine:", "input",100, $CONFIG['gallery_description'], 'value'=>""),
        "pic_size" => array("Select size of picture in feed:","options",array("Thumb","Normal"),'Thumb','value'=>""),
        "item_content" => array("Picture caption: <a href=\"#\" onClick=\"javascript: popup('http://www.natvik.com/bfdoc/brainfeeder_anchors.html')\">Anchors</a>", "textarea",250, $CONFIG['gallery_description'],'value'=>"{descr}"),
        "item_comments" => array("Include comments?", "yesno", "No", 'value'=>""),
        "feed_enclosure" => array ("Enclose picture?", "options", array("No", "Normal", "Original"),"No", 'value'=>""),
        "feed_source" => array("Include source?", "yesno", "No", 'value'=>""),
        "feed_category_opt" => array ("Include picture keywords?", "yesno", "No",'value'=>""),
        
        "setup"=> array ("Publishing options", "bar"),
        "feed_mode" => array ("Batch or realtime?", "options", array("Batch","Realtime"), "Batch", 'value'=>""),
        "file_name" => array ("Filename for batchmode: ", "input", 30, "feed".rand(1,999). ".xml", 'value'=>""),
        "feed_refresh" => array ("Minutes between each refresh: ", "input", 4, 1440, 'value'=>"")
     );   

switch ($operation) {
    case "list": 
        show_feed_roster();
        break;
    case "add":         //Display emtpy form for entering a new feed
        add_feed($fields);
        break;
    case "insert":      //Form for new feed has been posted, insert new record into database
        update_feed("insert",$fields);
        show_feed_roster(); 
        break;
    case "edit":        //Display existing record for editing
        edit_feed($fields);
        break;
    case "delete":      //Delete record
        delete_feed();
        show_feed_roster(); 
        break;
    case "update":      //Update an existing record
        update_feed("update",$fields);
        show_feed_roster(); 
        break;
    case "topupdate";
        topupdate();
        show_feed_roster();
        break;
    case "catfeed": //Admin clicked button to create feed from category or album thumbnail view
        cat_feed($fields);
        break;
}


function show_feed_roster() {
    global $CONFIG;
    $query = "SELECT name, value FROM {$CONFIG['TABLE_CONFIG']} WHERE name like 'cpg_brainfeeder_%' ORDER BY name";
    $result = cpg_db_query($query);
    while (list($name, $value) = cpg_db_fetch_row($result)) { 
        $$name = $value;
    } 
    if (!isset($cpg_brainfeeder_icons)) $cpg_brainfeeder_icons = "No";
    if (!isset($cpg_brainfeeder_main)) {
        $query = "SELECT min(fid) as lfid FROM {$CONFIG[TABLE_brainfeeder]}";
        $result = cpg_db_query($query);
        if (!$data = cpg_db_fetch_row($result)) {
            $cpg_brainfeeder_main =0;
        } else {
            $cpg_brainfeeder_main = $data['lfid'];
        }
    }
    
    $topfields = array("cpg_brainfeeder_icons" => array ("Show RSS-icon on thumbnail pages?", "yesno", $cpg_brainfeeder_icons, 'value'=>""),
                       "cpg_brainfeeder_main" => array ("Id for main feed (0 for none)", "input", 5, $cpg_brainfeeder_main, 'value'=>""),
                       "cpg_brainfeeder_rsstext" => array ("Mouseover text RSS icon", "input", 30, $cpg_brainfeeder_rsstext, 'value'=>"")
                       );
    $query = "SELECT * from ".$CONFIG['TABLE_brainfeeder'];
    $result = cpg_db_query($query);
    $feeds = cpg_db_fetch_rowset($result);
    echo "
    <table align=\"center\" width=\"100%\" cellspacing=\"1\" cellpadding=\"0\" class=\"maintable\">
        <TR>
            <td class=\"tableh1\" colspan=\"7\">RSS configuration</td>
        </TR>
        <TR>
            <td class=\"tableh2\" colspan=\"7\"><p>Genaral settings</td>
        </TR>
        <TR><TD colspan=\"7\">
        <table>";
    echo build_form("topupdate",$topfields);
    echo "</table width=\"800px\" >   </TD></TR>
        <TR>
            <th class=\"tableh1\">id</th>
            <th class=\"tableh1\">Name</th>
            <th class=\"tableh1\">Title</th>
            <th class=\"tableh1\">Description</th>
            <th class=\"tableh1\">Type</th>
            <th class=\"tableh1\">URL</th>
            <th class=\"tableh1\">Actions</th>
        </TR>
     ";
    $c = count ($feeds);
    if ($c > 0) {
        for ($i = 0;$i<$c; $i++){
            if ($feeds[$i]['feed_mode']=="Realtime"){
                $url = "rss.php?fid=".$feeds[$i]['fid'];
            } else {
                $url = $feeds[$i]['file_name']{0}=='.' ? substr($feeds[$i]['file_name'],2) : $feeds[$i]['file_name'];
                $url = $feeds[$i]['file_name']{0}=='/' ? substr($feeds[$i]['file_name'],1) : $url;
            }
            if (strlen($feeds[$i]['feed_description'])>29) {
                $descr = substr($feeds[$i]['feed_description'],0,27)."...";
            } else {
                $descr = $feeds[$i]['feed_description'];
            }
            $kurl = $CONFIG['ecards_more_pic_target'].$url;
            $fid =$feeds[$i]['fid'];
            echo "\n\t<TR>";
            echo "<td class =\"tableb\">".$fid."</td>";
            echo "<td class =\"tableb\" width=\"15%\"><a href=\"?file=brainfeeder/brainfeeder_config&amp;cf_op=edit&amp;fid=".$fid."\">".$feeds[$i]['feed_name']."</a></td>";
            echo "<td class =\"tableb\" width=\"20%\"><a href=\"rss.php?fid=".$fid."\">".$feeds[$i]['feed_title']."</a></td>";
            echo "<td class =\"tableb\" title =\"".$feeds[$i]['feed_description']."\">".$descr."</td>";
            echo "<td class =\"tableb\">".$feeds[$i]['feed_type']."</td>";
            echo "<td class =\"tableb\">".$kurl."</td>";
            echo "<td class =\"tableb\"><a href=\"?file=brainfeeder/brainfeeder_config&amp;cf_op=delete&amp;fid=".$fid."\">
                    <img src=\"images/delete.gif\" title=\"delete feed\" border=\"0\" width=\"16\" height=\"16\" alt=\"delete.gif (603 bytes)\"></a> 
                    <a href=\"?file=brainfeeder/brainfeeder_config&amp;cf_op=edit&amp;fid=".$fid."\">
                    <img src=\"images/edit.gif\" title=\"edit feed\" border=\"0\" width=\"16\" height=\"16\" alt=\"edit.gif (603 bytes)\"></a> </td>\n\t</TR>";
        }
            echo "\n\t<TR>";
    }
    
     echo "<td class =\"tableh1\" colspan = \"7\">
              <a href=\"{$_SERVER['PHP_SELF']}?file=brainfeeder/brainfeeder_config&amp;cf_op=add\" class=\"admin_menu\">Add Feed</a>
              </td>";
    echo "</TABLE>";
}

function add_feed ($fields) {
    global $CONFIG;
     echo "
    <table align=\"center\" width=\"100%\" cellspacing=\"1\" cellpadding=\"0\" class=\"maintable\">
        <TR>\n\t<TD class=\"tableh2\" colspan =\"2\">Configure channel-parameters</TD></TR>\n<TR>";
     echo build_form("insert", $fields);
     echo "</table>";
}

function edit_feed ($fields) {
    global $CONFIG;
    $fid = $_GET['fid'];
    $query = "SELECT * FROM ".$CONFIG['TABLE_brainfeeder']." WHERE fid=".$fid;
    $result = cpg_db_query($query);
    $row = cpg_db_fetch_row($result);
    foreach (array_keys($fields) as $field) {
        if (isset($row[$field])) {
            $fields[$field]['value'] = $row[$field];   //assumes that Coppermine sanitizes input 
        }
    }
     echo "
    <table align=\"center\" width=\"100%\" cellspacing=\"1\" cellpadding=\"0\" class=\"maintable\">
        <TR>\n\t<TD class=\"tableh1\" colspan =\"2\">Edit channel-parameters</TD></TR>\n<TR>";
     echo build_form("update", $fields);
     echo "</table>";
}

function cat_feed ($fields) {
    global $CONFIG;
    if (isset($_GET['catf'])) {
        $fields['feed_type']['value'] = "Category";
        $fields['feed_parameter']['value'] = $_GET['catf'];
        $data=cpg_db_fetch_row(cpg_db_query("SELECT name FROM {$CONFIG['TABLE_CATEGORIES']} WHERE cid ={$_GET['catf']}"));
        $fields['feed_name']['value']=$fields['feed_title']['value']=$data['name'];
    }
    if (isset($_GET['albf'])) {
        $fields['feed_type']['value'] = "Album";
        $fields['feed_parameter']['value'] = $_GET['albf'];
        $data=cpg_db_fetch_row(cpg_db_query("SELECT title FROM {$CONFIG['TABLE_ALBUMS']} WHERE aid ={$_GET['albf']}"));
        $fields['feed_name']['value']=$fields['feed_title']['value']=$data['title'];
    }
    if (isset($_GET['specf'])) {
        $situation = $_GET['specf'];
        switch ($situation) {
            case 'lastup':
                $fields['feed_type']['value'] = "Any";
                $fields['feed_parameter']['value'] = "";
                $fields['feed_random']['value'] = "Last";
                $fields['feed_name']['value']="Last uploaded";
                $fields['feed_title']['value']="The newest pictures from ".$CONFIG['gallery_name'];
            case 'topn':
                $fields['feed_type']['value'] = "Hits";
                $fields['feed_parameter']['value'] = "";
                $fields['feed_random']['value'] = "Last";
                $fields['feed_name']['value']="Most viewed";
                $fields['feed_title']['value']="The most viewed pictures from ".$CONFIG['gallery_name'];
            case 'toprated':
                $fields['feed_type']['value'] = "Rating";
                $fields['feed_parameter']['value'] = "";
                $fields['feed_random']['value'] = "Last";
                $fields['feed_name']['value']="Top rated";
                $fields['feed_title']['value']="The toprated pictures from ".$CONFIG['gallery_name'];
            case 'random':
                $fields['feed_type']['value'] = "Any";
                $fields['feed_parameter']['value'] = "";
                $fields['feed_random']['value'] = "Random";
                $fields['feed_name']['value']="Random pictures";
                $fields['feed_title']['value']="Random pictures from ".$CONFIG['gallery_name'];
                
        }
    }
     echo "
    <table align=\"center\" width=\"100%\" cellspacing=\"1\" cellpadding=\"0\" class=\"maintable\">
        <TR>\n\t<TD class=\"tableh2\" colspan =\"2\">Edit channel-parameters</TD></TR>\n<TR>";
     echo build_form("insert", $fields);
     echo "</table>";
}

function build_form($operation, $fields) {
    $ret = "<form action=\"". $_SERVER['PHP_SELF']."?file=brainfeeder/brainfeeder_config&cf_op=$operation\" method =\"POST\" enctype=\"multipart/form-data\">\n";
    foreach ($fields as $name=>$field) {
        if ($field[1]!='bar') {
            $ret .= "<TR>\n\t<TD class=\"tableb\"><a href=\"http://www.natvik.com/bfdoc/brainfeeder_doc.html#".$name."\" target=\"_blank\"><img src=\"images/help.gif\" width=\"13\" height=\"11\" border=\"0\" alt=\"\" title=\"\" /></a>&nbsp;".$field[0]."</TD>";   //caption
        }
        switch ($field[1]) {
            case "input":
                $val=strlen($field['value'])>=1 ? $field['value'] : $field[3];
                $ret .= "\n\t<TD class=\"tableb\">\n\t\t<INPUT id=\"".$name."\" type =\"text\" name=\"".$name."\" class =\"textinput\" size =\"".$field[2]."\" maxlength =\"".$field[2]."\" value=\"". $val."\" /> ";
                break;
            case "textarea":
                $val=strlen($field['value'])>=1 ? $field['value'] : $field[3];
                $ret .= "\n\t<TD class=\"tableb\">\n\t\t<TEXTAREA  id=\"".$name."\" class =\"textinput\" name=\"".$name."\" rows =\"".$val."\" cols=\"30\" >".$field['value']."</TEXTAREA>";
                break;
            case "yesno":
                $val=strlen($field['value'])>1 ? $field['value'] : $field[2];
                $checked = FALSE;
                $ret .= "\n\t<TD class=\"tableb\">\n\t\t<INPUT id=\"".$name."0"."\" class =\"radio\" type =\"radio\" name=\"".$name."\" value=\"Yes\"";
                        if ($val=='Yes') {   //takes priority over $field['2']
                            $ret .= " checked=\"Yes\"";
                            $checked = TRUE;
                        } elseif ($field[2]=="Yes") {
                            $ret .= " checked=\"Yes\"";
                            $checked = TRUE;
                        }
                        $ret .= " />\n\t\t\t<label for=\"".$name."0"."\" class=\"clickable_option\"  style=\"vertical-align:bottom;\">Yes </label>";
                $ret .= "\n\t\t<INPUT id=\"".$name."1"."\" class =\"radio\" type =\"radio\" name=\"".$name."\" value=\"No\"";
                        if (!$checked){
                            if ($val=='No') {   //takes priority over $field['2']
                                $ret .= " checked=\"Yes\"";
                            } elseif ($field[2]=="No") {
                                $ret .= " checked=\"Yes\"";
                            }
                        }
                        $ret .= " />\n\t\t\t<label for=\"".$name."1"."\" class=\"clickable_option\" style=\"vertical-align:bottom;\">No</label>";
                break;
            case "options":
                $i=0;
                $val=strlen($field['value'])>=1 ? $field['value'] : $field[3];
                $ret .= "\n\t<TD  class=\"tableb\">";
                foreach ($field[2] as $opt) {
                    $ret .="\n\t\t<INPUT id=\"".$name.$i."\" class =\"radio\" type =\"radio\" name=\"".$name."\" value=\"".$opt."\"";
                            if ($val==$opt) $ret .= " checked=\"yes\"";
                            $ret .= " />\n\t\t<LABEL for=\"".$name.$i."\" class=\"clickable_option\" valign=\"bottom\" style=\"vertical-align:bottom;\">".$opt."</LABEL>&nbsp;";
                            $i++;
                }
                break;
            case "readonly":
                $val=strlen($field['value'])>=1 ? $field['value'] : $field[3];
                $ret .= "\n\t<TD class=\"tableb\">\n\t\t<INPUT id=\"".$name."\" type =\"text\" name=\"".$name."\" class =\"textinput\" size =\"".$field[2]."\" value =\"".$val."\" readonly=\"yes\" /> ";
                break;
            case "bar":
                $ret .="<TR>\n\t<TD class=\"tableh2\" colspan =\"2\">".$field[0];
        }
        $ret .= "\n\t</TD>\n</TR>";
    }
    $ret .= "\n<TR>\n\t<TD class =\"tableh2\" colspan =\"2\">
            \n\t\t<button name =\"send\" type =\"submit\" value = \"sent\">Go</button>
            \n\t</TD>\n</TR>";
    $ret .= "</form>";
    return $ret;
}

function update_feed ($edit, $fields) {
    global $CONFIG;
    $sql_fields ="";
    $fields = array_keys($fields); //field names are in the keys. values are underlaying arrays.
    foreach ($fields as $field) {
        if (isset ($_POST[$field])) $sql_fields .= " ".$field."='".$_POST[$field]."',";
    }
    $sql_fields=substr($sql_fields,0,-1);    //remove last comma
    if ($edit=="insert") {
        $query = "INSERT ";
        $where ="";
    } else {
        $query = "UPDATE ";
        $where = " WHERE fid =".$_POST['fid']; 
    }
    $query .=  $CONFIG['TABLE_brainfeeder']." SET ". $sql_fields.$where;
    
    $results=cpg_db_query($query);
}

function delete_feed () {
    global $CONFIG;
    $fid = $_GET['fid'];
    $query = "DELETE FROM ".$CONFIG['TABLE_brainfeeder']." WHERE fid=".$fid;
    $results=cpg_db_query($query);
}

function topupdate() {
    global $CONFIG;
    if ((!$knas = cpg_db_fetch_row(cpg_db_query("SELECT * FROM {$CONFIG[TABLE_brainfeeder]} WHERE fid =".$_POST['cpg_brainfeeder_main']))) && ($_POST['cpg_brainfeeder_main']>0)) cpg_die(ERROR,"There is no feed with the id ".$_POST['cpg_brainfeeder_main'],__FILE__,__LINE__);
    if ($_POST['cpg_brainfeeder_icons']=="") $_POST['cpg_brainfeeder_icons']="No"; //have observed instances where radio buttons are blank in Google Chrome
    cpg_db_query("DELETE FROM {$CONFIG['TABLE_CONFIG']} WHERE name LIKE 'cpg_brainfeeder_%'");
    $query= "INSERT INTO {$CONFIG['TABLE_CONFIG']} (name, value) values 
                ('cpg_brainfeeder_icons', '".$_POST['cpg_brainfeeder_icons']."'),
                ('cpg_brainfeeder_main',   ".$_POST['cpg_brainfeeder_main' ]."),  
                ('cpg_brainfeeder_rsstext',  '".$_POST['cpg_brainfeeder_rsstext']."')";
   // print_r($_POST);
 
 //   die ($query);
    cpg_db_query($query);
    
    return;
}

function shorten($text="", $length=30) {
    if (strlen($text>$length)) {
                $ret = substr($text,0,$length-3)."...";
            } else {
                $ret = $text;
            }
    return $ret;
}



pagefooter();
ob_end_flush();
?>
