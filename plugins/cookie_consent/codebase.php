<?php
/**************************************************
  Coppermine 1.5.x Plugin - Cookie consent
  *************************************************
  Copyright (c) 2012 eenemeenemuu
  ********************************************
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
**************************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

$thisplugin->add_action('page_start', 'cookie_consent_page_start');
function cookie_consent_page_start() {
    global $CONFIG, $lang_plugin_cookie_consent, $plugin_cookie_consent_cookies;

    require "./plugins/cookie_consent/lang/english.php";
    if ($CONFIG['lang'] != 'english' && file_exists("./plugins/cookie_consent/lang/{$CONFIG['lang']}.php")) {
        require "./plugins/cookie_consent/lang/{$CONFIG['lang']}.php";
    }

    // Make cookie list accessible to other plugins so they can add their cookies
    $plugin_cookie_consent_cookies = array(
        $CONFIG['cookie_name'].'_fav' => $lang_plugin_cookie_consent['cookie_fav'],
        '32 digit MD5 hash' => $lang_plugin_cookie_consent['cookie_cpg_session'],
        'sessioncookie' => $lang_plugin_cookie_consent['cookie_mambo_sessioncookie'],
        $CONFIG['cookie_name'].'_data' => $lang_plugin_cookie_consent['cookie_data'],
        'picinfo' => $lang_plugin_cookie_consent['cookie_picinfo'], // <-- add prefix or better: store value in _data
    );
}

$thisplugin->add_filter('gallery_header', 'cookie_consent_gallery_header');
function cookie_consent_gallery_header($template_header) {
    if (!CPG_COOKIES_ALLOWED) {
        global $REFERER, $lang_plugin_cookie_consent, $lang_common;
        $ref = urlencode($REFERER);
        $text = <<<EOT
            <form action="index.php?file=cookie_consent/set&amp;ref={$ref}" method="post">
            {$lang_plugin_cookie_consent['why_cookies']} <br />
            <input class="checkbox" type="checkbox" name="accept_cookies" id="accept_cookies" />
            <label class="clickable_option" for="accept_cookies">{$lang_plugin_cookie_consent['accept']}</label>
            <input class="button" type="submit" value="{$lang_common['continue']}" />
            </form>
EOT;
        ob_start();
        msg_box('', $text);
        $msg_box = ob_get_contents()."<br />";
        ob_end_clean();
        //  -> print message (checkbox, button, explanation which cookies are stored and why are they needed
        $template_header = str_replace('{CUSTOM_HEADER}', $msg_box.'{CUSTOM_HEADER}', $template_header);
    }
    return $template_header;
}

$thisplugin->add_action('plugin_install', 'cookie_consent_install');
function cookie_consent_install() {
    global $CONFIG;
    cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '1' WHERE name = 'cookies_need_consent'");
    return true;
}

$thisplugin->add_action('plugin_uninstall', 'cookie_consent_uninstall');
function cookie_consent_uninstall() {
    global $CONFIG;
    cpg_db_query("UPDATE {$CONFIG['TABLE_CONFIG']} SET value = '0' WHERE name = 'cookies_need_consent'");
    return true;
}

?>