<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2007 Coppermine Dev Team
  v1.1 originally written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  ********************************************
  Coppermine version: 1.5.0
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**********************************************/

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...');}

// encoding match for workaround

$multibyte_charset = 'utf-8, big5, shift_jis, euc-kr, gb2312';

$charset = $CONFIG['charset'] == 'language file' ? $GLOBALS['lang_charset'] : $CONFIG['charset'];

$sort_array = array('na' => 'filename ASC', 'nd' => 'filename DESC', 'ta'=>'title ASC', 'td'=>'title DESC', 'da' => 'pid ASC', 'dd' => 'pid DESC', 'pa' => 'position ASC', 'pd' => 'position DESC');
$sort_code = isset($USER['sort'])? $USER['sort'] : $CONFIG['default_sort_order'];
$sort_order = isset($sort_array[$sort_code]) ? $sort_array[$sort_code] : $sort_array[$CONFIG['default_sort_order']];

$allowed = array('title', 'caption', 'keywords', 'owner_name', 'filename', 'pic_raw_ip', 'pic_hdr_ip', 'user1', 'user2', 'user3', 'user4');

$mb_charset = stristr($multibyte_charset, $charset);

$search_string = str_replace('&quot;', '"', $search_string);
$search_string = str_replace('\'', '"', $search_string);
$search_string = preg_replace('/&.*;/i', '', $search_string);

if (!$mb_charset)
        $search_string = preg_replace('/[^0-9a-z %]/i', '', $search_string);

if (!isset($USER['search']['params'])){
        $USER['search']['params']['title'] = $USER['search']['params']['caption'] = $USER['search']['params']['keywords'] = $USER['search']['params']['filename'] = 1;
}

if (isset($_GET['params'])) unset($_GET['album']);

if (isset($_GET['album']) && $_GET['album'] == 'search') {
        $_GET = $USER['search'];
        $_GET['type'] = $USER['search']['type'];
}

$type = $_GET['type'] == 'AND' ? " AND " : " OR ";

if (isset($_GET['params']['pic_raw_ip'])) $_GET['params']['pic_hdr_ip'] = $_GET['params']['pic_raw_ip'];

if ($search_string && isset($_GET['params'])) {
        $sections = array();
        $albcat_terms = array(); // For Album & Category Title Search: populated as needed
        if($_GET['type'] == 'regex') {
                $fields = array();
                $search_string = preg_replace('/[^\w\+\*\?\{\,\}\|\(\)\\\^\$\[\]\:\<\>\-\.]/','',$search_string);
                $search_string = addslashes($search_string);
                if (isset($_GET['album_title']) || isset($_GET['category_title'])) $albcat_terms[] = " REGEXP '$search_string'";                
                foreach($_GET['params'] as $param => $value) {
                        if (in_array($param, $allowed)) $fields[] = "$param REGEXP '$search_string'";
                }
                $sql .= count($fields) ? ('((' . implode(' OR ', $fields) . '))') : '';
        } else {
                $search_string = strtr($search_string, array('_' => '\_', '%' => '\%', '*' => '%'));

                $quote_offset = (preg_match('^(\s)*\"',$search_string) + 1);
                $split_search = explode('"',$search_string);
                foreach($split_search as $index => $string) {
                        if(($index & 1) && strlen($string)) {
                                $fields = array();
                                if (isset($_GET['album_title']) || isset($_GET['category_title'])) $albcat_terms[] = " LIKE '%$string%'";                                
                                foreach ($_GET['params'] as $param => $value){
                                        if (in_array($param, $allowed)) $fields[] = "$param LIKE '%$string%'";
                                }
                                $sections[] = count($fields) ? '(' . implode(' OR ', $fields) . ')' : '';  
                        } else if (strlen($string)) {
                                $words = explode(' ', $string);
                                foreach($words as $word) {
                                        if(strlen($word)) {
                                                $word = addslashes($word);
                                                $fields = array();
                                                if (isset($_GET['album_title']) || isset($_GET['category_title'])) $albcat_terms[] = " LIKE '%$word%'";
                                                foreach ($_GET['params'] as $param => $value){
                                                        if (in_array($param, $allowed)) $fields[] = "$param LIKE '%$word%'";
                                                }
                                                $sections[] = count($fields) ? '(' . implode(' OR ', $fields) . ')' : '';  
                                        }
                                }
                        }
                }
                
                $sql .= count($sections) ? '(' . implode($type, $sections) . ')' : '0';
        }


        $sql .= $_GET['newer_than'] ? ' AND ( ctime > UNIX_TIMESTAMP() - '.( (int) $_GET['newer_than'] * 60*60*24).')' : '';
        $sql .= $_GET['older_than'] ? ' AND ( ctime < UNIX_TIMESTAMP() - '.( (int) $_GET['older_than'] * 60*60*24).')' : '';
        $sql .=  " $ALBUM_SET AND approved = 'YES'";

        if(isset($_GET['album_title'])) {
                $album_query = "SELECT * FROM `{$CONFIG['TABLE_ALBUMS']}` WHERE (`title` " . implode(" $type `title` ",$albcat_terms) . ')';
                $result = cpg_db_query($album_query);
                if(mysql_num_rows($result) > 0) {
                        starttable('100%', $lang_meta_album_names['album_search'],2);
                        while($alb = mysql_fetch_array($result,MYSQL_ASSOC))
                        {
                                ?>
                                <tr>
                                <td width="40%"><a href="<?php printf("thumbnails.php?album=%u", $alb['aid']); ?> "> <?php echo $alb['title']; ?> </a></td>
                                        <td><?php if ($alb['description'] == "") { echo '&nbsp;'; }else { echo $alb['description']; } ?></td>
                                        </tr>
                                        <?php
                        }
                        endtable();
                        echo '<br/>';                        
                }
        }
                                              
        if(isset($_GET['category_title'])) {
                $category_query = "SELECT * FROM `{$CONFIG['TABLE_CATEGORIES']}` WHERE (`name` " . implode(" $type `name` ",$albcat_terms) . ')';
                $result = cpg_db_query($category_query);
                if(mysql_num_rows($result) > 0) {
                        starttable('100%', $lang_meta_album_names['category_search'],2);
                        while($cat = mysql_fetch_array($result,MYSQL_ASSOC))
                        {
                                ?>
                                        <tr>
                                                <td width="40%"> <a href="<?php printf("index.php?cat=%u", $cat['cid']); ?> "><?php echo $cat['name']; ?> </a></td>
                                                <td> <?php if ($cat['description'] == "") { echo '&nbsp;'; }else { echo $cat['description']; } ?></td>
                                        </tr>
                                <?php
                        }
                        endtable();
                        echo '<br/>';
                }
        }                                              

        // Make sure they selected some parameter other than album/category
        $other=0;
        foreach ($_GET['params'] as $param => $value){
                if (in_array($param, $allowed)) $other=1;
        }
        
        
        if(!$other) $sql = '0';
                                              
                                              
        $sql = "SELECT * FROM {$CONFIG['TABLE_PICTURES']} WHERE " . $sql;
                                              
        $temp = str_replace('SELECT *', 'SELECT COUNT(*)', $sql);
        $result = cpg_db_query($temp);
        $row = mysql_fetch_row($result);
        $count = $row[0];
                                              
        $sql .= " ORDER BY $sort_order $limit";
        $result = cpg_db_query($sql);
        $rowset = cpg_db_fetch_rowset($result);
        mysql_free_result($result);

        if ($set_caption) build_caption($rowset);
}
?>
