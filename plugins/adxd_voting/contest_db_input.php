<?php

define('IN_COPPERMINE', true);
define('CONTEST_DB_INPUT_PHP', true);
define('DB_INPUT_PHP', true);//needed for language messages
chdir('../..');
require('include/init.inc.php');

if (!isset($_GET['event']) && !isset($_POST['event'])) {
    cpg_die(CRITICAL_ERROR, $lang_errors['param_missing'], __FILE__, __LINE__);
}

$event = isset($_POST['event']) ? $_POST['event'] : $_GET['event'];
switch ($event) {

    // Update album

    case 'album_update':
        if (!GALLERY_ADMIN_MODE) cpg_die(ERROR, $lang_errors['perm_denied'], __FILE__, __LINE__);

        $aid = (int)$_POST['aid'];
        $title = addslashes(trim($_POST['title']));
        $category = (int)$_POST['category'];
        $description = addslashes(trim($_POST['description']));
                $keyword = addslashes(trim($_POST['keyword']));
        $thumb = (int)$_POST['thumb'];
        $visibility = (int)$_POST['visibility'];
        $uploads = $_POST['uploads'] == 'YES' ? 'YES' : 'NO';
        $comments = $_POST['comments'] == 'YES' ? 'YES' : 'NO';
        $votes = $_POST['votes'] == 'YES' ? 'YES' : 'NO';
        $contest = $_POST['contest'] == 'YES' ? 'YES' : 'NO';
        $password = addslashes($_POST['alb_password']);
                $password_hint = addslashes(trim($_POST['alb_password_hint']));
        $visibility = !empty($password) ? FIRST_USER_CAT + USER_ID : $visibility;

        if (!$title) cpg_die(ERROR, $lang_db_input_php['alb_need_title'], __FILE__, __LINE__);

        $query = "UPDATE {$CONFIG['TABLE_ALBUMS']} SET title='$title', description='$description', category='$category', thumb='$thumb', uploads='$uploads', comments='$comments', votes='$votes', contest='$contest', visibility='$visibility', alb_password='$password', alb_password_hint='$password_hint', keyword='$keyword' WHERE aid='$aid' LIMIT 1";
        $update = cpg_db_query($query);
        $result=(!mysql_affected_rows())?$lang_db_input_php['no_udp_needed']:$lang_db_input_php['alb_updated'];
        pageheader($result, "<meta http-equiv=\"refresh\" content=\"1;url=../../modifyalb.php?album=$aid\" />");
        msg_box($lang_db_input_php['info'], $result, $lang_continue, "../../modifyalb.php?album=$aid");
        pagefooter();
        ob_end_flush();
        exit;
        break;

    // Reset album
    default:
        cpg_die(CRITICAL_ERROR, $lang_errors['param_missing'], __FILE__, __LINE__);
}
?>
