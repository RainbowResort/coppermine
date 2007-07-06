<?php
/*
 * PHP library for English translation in CPG
 * @borrowed from CPG 1.5.0
 * @latestAuthor xnitingupta
 */

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...');}

$LANG = array();

$LANG['charset'] = 'iso-8859-1';

// For the word censor
$LANG['bad_words'] = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$LANG['forgot_passwd'] = array(
  'forgot_passwd' => 'Password reminder',
  'err_already_logged_in' => 'You are already logged in !',
  'enter_email' => 'Enter your email address',
  'submit' => 'go',
  'illegal_session' => 'Forgot password session invalid or has expired.',
  'failed_sending_email' => 'The password reminder email can\'t be sent !',
  'email_sent' => 'An email with your username and new password was sent to %s',
  'verify_email_sent' => 'An email has been sent to %s. Please check your email to complete the process.',
  'err_unk_user' => 'Selected user does not exist!',
  'account_verify_subject' => '%s - New password request',
  'account_verify_body' => 'You have requested a new password. If you would like to proceed with having a new password sent to you, click on the following link:

%s',
  'passwd_reset_subject' => '%s - Your New Password',
  'passwd_reset_body' => 'Here is the new password you requested:
Username: %s
Password: %s
Click %s to log in.',
);

$LANG['register_confirm_email'] = <<<EOT
Thank you for registering at {SITE_NAME}

In order to activate your account with username "{USER_NAME}", you need to click on the link below or copy and paste it in your web browser.

<a href="{ACT_LINK}">{ACT_LINK}</a>

Regards,

The management of {SITE_NAME}

EOT;

$LANG['register_approve_email'] = <<<EOT
A new user with the username "{USER_NAME}" has registered in your gallery.

In order to activate the account, you need to click on the link below or copy and paste it in your web browser.

<a href="{ACT_LINK}">{ACT_LINK}</a>

EOT;

$LANG['register_activated_email'] = <<<EOT
Your account has been approved and activated.

You can now log in at <a href="{SITE_LINK}">{SITE_LINK}</a> using the username "{USER_NAME}"


Regards,

The management of {SITE_NAME}

EOT;

$LANG['register'] = array(
  'confirm_email_subject' => '%s - Registration confirmation',
  'notify_admin_email_subject' => '%s - Registration notification',
  'notify_admin_email_body' => 'A new user with the username "%s" has registered in your gallery',
  'notify_admin_request_email_subject' => '%s - Registration request',
  'notify_user_email_subject' => '%s - Activation notification'
);
?>