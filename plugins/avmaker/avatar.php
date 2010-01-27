<?php
/*************************************************
  avatar maker plugin for cpg 1.4.x
  *******************************************
  Copyright (c) 2003-2009 foulu (Le Hoai Phuong)
  <foulu_bk@yahoo.com> 
  *************************************************/
// init
require('include/init.inc.php');
// config
if (!$CONFIG['avmk_enabled']) cpg_die(ERROR, $lang_avmaker_php['er0'], __FILE__, __LINE__);
// language
if (!file_exists("plugins/avmaker/lang/{$CONFIG['lang']}.php"))
	$CONFIG['lang'] = 'english';
require "plugins/avmaker/lang/{$CONFIG['lang']}.php";
// get action
$action = isset($_GET['action']) ? $_GET['action'] : '';
// get pid
$pid = isset($_GET['pid']) ? (int)$_GET['pid'] : '';
// error if no pid define
if (!$pid) cpg_die(ERROR, $lang_avmaker_php['er1'], __FILE__, __LINE__);
// get file information
$result   = cpg_db_query("SELECT filepath, filename, pwidth, pheight FROM `{$CONFIG['TABLE_PICTURES']}` WHERE pid = '{$pid}' LIMIT 1;");
$pic_data = cpg_db_fetch_row($result);
if (!isset($pic_data['filepath'])) cpg_die(ERROR, $lang_avmaker_php['er2'], __FILE__, __LINE__);
// main action
switch ($action) {
	case 'crop':
		pageheader($lang_avmaker_php[2]);
		starttable('100%', $lang_avmaker_php[3], 2);
		// get post/get vars
		if (isset($_POST['av_width'])) {
			$av_width = (int)$_POST['av_width'];
		} elseif (isset($_GET['av_width'])) {	
			$av_width = (int)$_GET['av_width'];
		} else {
			$av_width = 100;
		}
		if (isset($_POST['av_height'])) {
			$av_height = (int)$_POST['av_height'];
		} elseif (isset($_GET['av_height'])) {	
			$av_height = (int)$_GET['av_height'];
		} else {
			$av_height = 100;
		}
		// do evil things
		include('plugins/avmaker/include/class.cropinterface.php');
		$avatar =& new CropInterface(true);
		$avatar->setCropAllowResize(true);
		$avatar->setCropTypeDefault(ccRESIZEANY);
		$avatar->setCropTypeAllowChange(true);
		$avatar->setCropSizeDefault("{$av_width}x{$av_height}");
		$avatar->setCropPositionDefault(ccCENTRE);
		$avatar->setCropMinSize(10, 10);
		$avatar->setExtraParameters(array('file' => 'avmaker/avatar', 'action' => 'effect', 'pid' => $pid));
		$avatar->setCropSizeList(array(					
			"60x60"     => sprintf($lang_avmaker_php[6], 60, 60),
			"100x100"   => sprintf($lang_avmaker_php[6], 100, 100),			
		));		
		$avatar->setMaxDisplaySize("{$pic_data['pwidth']}x{$pic_data['pheight']}");		
		$av_form = array(						
			array('crop'),	
			array('centertext', '<input type="submit" value="'.$lang_avmaker_php[19].'" id="cropSubmitButton" class="button" onClick="cc_Submit();" />'),					
		);	
		make_form($av_form, array());
		endtable();			
		break;
	case 'effect':
		pageheader($lang_avmaker_php[2]);
		starttable('100%', $lang_avmaker_php[4], 2);
		$av_form = array(	
			array('label', $lang_avmaker_php[7]),
			array('centertext', "<img class=\"image\" src=\"index.php?file=avmaker/avatar&pid={$pid}&action=showimage&sx={$_GET['sx']}&sy={$_GET['sy']}&ex={$_GET['ex']}&ey={$_GET['ey']}\">"),
			array('label', '<center>' . "<a class=\"button\" href=\"index.php?file=avmaker/avatar&pid={$pid}&action=download&sx={$_GET['sx']}&sy={$_GET['sy']}&ex={$_GET['ex']}&ey={$_GET['ey']}\">&nbsp;{$lang_avmaker_php[8]}&nbsp;</a>" . '</center>'),
			array('label', '<center>' . "<a class=\"button\" href=index.php?file=avmaker/avatar&pid={$pid}&action=crop&av_width=".($_GET['ex']-$_GET['sx'])."&av_height=".($_GET['ey']-$_GET['sy']).">&nbsp;{$lang_avmaker_php[9]}&nbsp;</a>" . '</center>'),
		);	
		make_form($av_form, array());
		endtable();			
		break;
	case 'showimage':
		include('plugins/avmaker/include/class.cropinterface.php');	
		$avatar =& new CropInterface(true);
		$avatar->loadImage($CONFIG['fullpath'] . $pic_data['filepath'] . $pic_data['filename']);
		$avatar->cropToDimensions($_GET['sx'], $_GET['sy'], $_GET['ex'], $_GET['ey']);
		$avatar->showImage('png', $CONFIG['avmk_jpeg_quality']);
		break;
	case 'download':        
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $clen = strlen($chars) - 1;  //a variable with the fixed length of chars correct for the fence post issue
        while (strlen($code) < 8) {
            $code .= $chars[mt_rand(0,$clen)];  //mt_rand's range is inclusive - this is why we need 0 to n-1
        }        
		header('Content-type: image/png');				
		header('Content-Disposition: attachment; filename="'.$code.'.png"');
		readfile($CONFIG['ecards_more_pic_target'] . "index.php?file=avmaker/avatar&pid={$pid}&action=showimage&sx={$_GET['sx']}&sy={$_GET['sy']}&ex={$_GET['ex']}&ey={$_GET['ey']}");
		break;
	default;
		// for set size thing
		pageheader($lang_avmaker_php[2]);
		starttable('100%', $lang_avmaker_php[5], 2);
		// form
		$av_form = array(
			array('startform', 'crop'),
			array('normaltext', $lang_avmaker_php[10]),
			array('input', 'av_width' , $lang_avmaker_php[11] , 255),
			array('input', 'av_height', $lang_avmaker_php[12], 255),
			array('label', $lang_avmaker_php[13]),
			array('normaltext', $lang_avmaker_php[14]),
			array('normaltext', $lang_avmaker_php[15]),
			array('normaltext', $lang_avmaker_php[16]),
			array('submit', $lang_avmaker_php[17]),
			array('endform'),
		);			
		make_form($av_form, array('av_width' => $CONFIG['avmk_df_width'], 'av_height' => $CONFIG['avmk_df_height']));
		endtable();
}
// end everthing
pagefooter();
if ($action == 'crop') {
	$avatar->loadJavascript();
}
// function
function make_form($form_param, $form_data)
{
    global $CONFIG; //, $PHP_SELF;
    global $lang_register_php;
	global $pid;
	global $pic_data, $avatar;

    foreach ($form_param as $element) switch ($element[0]) {
		// crop display
		case 'crop':
			echo <<<EOT
    <tr>
        <td colspan="2" align="center" class="tablef">
EOT;
			$avatar->loadInterface($CONFIG['fullpath'] . $pic_data['filepath'] . $pic_data['filename']);	
			echo <<<EOT
        </td>
    </tr>
EOT;
			break;
		// start a form
		case 'startform' :
			echo <<<EOT
    <form method="post" action="index.php?file=avmaker/avatar&action={$element[1]}&pid={$pid}">
EOT;
			break;
		// end a form
		case 'endform' :		
			echo "</form>";		
			break;
		// submit button
		case 'submit' :		
			echo <<<EOT
    <tr>
        <td colspan="2" align="center" class="tablef">
            <input type="submit" value="{$element[1]}" class="button" />            
        </td>
    </tr>
EOT;
			break;
		// make a label
        case 'label' :
            echo <<<EOT
    <tr>
        <td colspan="2" class="tableh2 graybox">
            <b>{$element[1]}<b>
        </td>
    </tr>
EOT;
            break;
		// normal text ^^
		case 'normaltext' :
            echo <<<EOT
    <tr>
        <td colspan="2" class="tableb graybox">
            {$element[1]}
        </td>
    </tr>
EOT;
            break;
	
		// normal text ^^
		case 'centertext' :
            echo <<<EOT
    <tr>
        <td colspan="2" class="tableb graybox" align="center">
            {$element[1]}
        </td>
    </tr>
EOT;
            break;
		
		case 'text' :
            if ($form_data[$element[1]] == '') break;
            echo <<<EOT
            <b>{$element[2]}</b>:<br />{$form_data[$element[1]]}<br /><br />
EOT;
	
            break;
        case 'input' :
            $value = $form_data[$element[1]];

        if ($element[2]) echo <<<EOT
    <tr>
        <td width="40%" class="tableb graybox"  height="25">
            {$element[2]}
        </td>
        <td width="60%" class="tableb graybox" valign="top">
            <input type="text" style="width: 100%" name="{$element[1]}" maxlength="{$element[3]}" value="$value" class="textinput" />
        </td>
    </tr>


EOT;
            break;

        case 'textarea' :
            $value = $form_data[$element[1]];

           if ($element[2]) echo <<<EOT
        <tr>
            <td width="40%" class="tableb graybox"  height="25">
                        {$element[2]}
        </td>
        <td width="60%" class="tableb graybox" valign="top">
                <textarea name="{$element[1]}" rows="7" cols="40" class="textinput" style="width: 100%">$value</textarea>
                </td>
        </tr>


EOT;
            break;

        case 'password' :
            echo <<<EOT
    <tr>
        <td width="40%" class="tableb graybox">
            {$element[2]}
        </td>
        <td width="60%" class="tableb graybox" valign="top">
            <input type="password" style="width: 100%" name="{$element[1]}" maxlength="{$element[3]}" value="" class="textinput" />
        </td>
    </tr>

EOT;
            break;
        case 'thumb' :
            $value = $form_data[$element[1]];

            if ($value) echo <<<EOT
    <tr>
        <td valign="top" colspan="2" class="thumbnails graybox" align="center">
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="center">
                        $value
                    </td>
                </tr>
            </table>
        </td>
    </tr>
EOT;
            break;
        case 'check' :
            $value = $form_data[$element[1]];
			if ($value==1)
				$checked="checked";
			else
				$checked="";
            echo <<<EOT
    <tr>
        <td width="40%" class="tableb graybox"  height="25">
            {$element[2]}
        </td>
        <td width="60%" class="tableb graybox" valign="top">
            <input type="checkbox" name="{$element[1]}" $checked value="1">
        </td>
    </tr>

EOT;
            break;
        case 'textplain' :
            echo <<<EOT
    <tr>
        <td width="40%" class="tableb graybox" valign="top" height="25">
            {$element[2]}
        </td>
        <td width="60%" class="tableb graybox" valign="top">
            {$element[1]}
        </td>
    </tr>

EOT;
			break;

        default:
            cpg_die(CRITICAL_ERROR, $lang_avmaker_php['er3'] . $element[0], __FILE__, __LINE__);
    }
}

?>