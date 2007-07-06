<?php
/*
 * PHP library for German language in CPG
 * @borrowed from CPG 1.5.0
 * @latestAuthor xnitingupta
 */

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...');}

$LANG = array();

$LANG['charset'] = 'utf-8';

// For the word censor
$LANG['bad_words'] = array('*fuck*', 'Fu\(*', 'fuk*', 'masturbat*', 'motherfucker', 'nigger*', 'penis', 'pussy', 'shit', 
  'titties', 'titty',  'arsch*', 'fick*', 'fotze', 'votze', 'Sieg Heil', 'Heil Hitler', 'Nutte', 'Möse', 'Moese', 'Pimmel', 
  'Schwengel', 'Titte*', 'bums*', 'Scheiss*', 'Scheiß*');

$LANG['forgot_passwd'] = array(
  'forgot_passwd' => 'Passwort-Erinnerung',
  'err_already_logged_in' => 'Du bist schon angemeldet!',
  'enter_email' => 'Gib Deine eMail-Adresse ein',
  'submit' => 'los!',
  'illegal_session' => 'Die Session für die Passwort-Erinnerung ist ungültig oder abgelaufen.',
  'failed_sending_email' => 'Die eMail mit der Passwort-Erinnerung kann nicht gesendet werden!',
  'email_sent' => 'Eine eMail mit Deinem Benutzernamen und einem neuen Passwort wurde an %s gesendet.',
  'verify_email_sent' => 'Eine eMail wurde an %s gesendet. Bitte überprüfe Deine Mailbox, um den Vorgang abzuschliessen.', 
  'err_unk_user' => 'Der gewählte Benutzer existiert nicht!',
  'account_verify_subject' => '%s - Anforderung neues Passwort',
  'account_verify_body' => 'Du hast ein neues Passwort beantragt - um dieses neue Passwort tatsächlich zu erhalten, klicke 
auf nachstehenden Link:
%s',
  'passwd_reset_subject' => '%s - Dein neues Passwort',
  'passwd_reset_body' => 'Hier ist das neue Passwort, dass Du beantragt hast:
Benutzername: %s
Passwort: %s
Klicke %s, um Dich anzumelden.',
);

$LANG['register_confirm_email'] = <<<EOT
Danke für Deine Registrierung bei {SITE_NAME}

Dein Benutzername ist : "{USER_NAME}"


Um Dein Benutzerkonto zu aktivieren, musst Du auf den untenstehenden Link klicken
oder ihn kopieren und in der Adresszeile Deines Browsers einfügen.
<a href="{ACT_LINK}">{ACT_LINK}</a>

Grüße,

Das Team von {SITE_NAME}

EOT;

$LANG['register_approve_email'] = <<<EOT
Ein neuer Benutzer hat sich mit dem Benutzernamen "{USER_NAME}" in Deiner Galerie registriert.
Um das Benutzerkonto zu aktivieren, klicke auf den untenstehenden Link oder kopiere ihn in die Adresszeile Deines Browsers.
<a href="{ACT_LINK}">{ACT_LINK}</a>

EOT;

$LANG['register_activated_email'] = <<<EOT
Dein Benutzerkonto wurden genehmigt und aktiviert.
Du kannst Dich jetzt auf der Seite <a href="{SITE_LINK}">{SITE_LINK}</a> mit dem Benutzernamen "{USER_NAME}" anmelden.

Gruss,

Das {SITE_NAME} Team

EOT;

$LANG['register'] = array(
  'confirm_email_subject' => '%s - Registrierungs-Bestätigung',
  'notify_admin_email_subject' => '%s - Registrierungs-Benachrichtigung',
  'notify_admin_email_body' => 'Jemand mit dem Benutzernamen "%s" hat sich in Deiner Galerie registriert',
  'notify_admin_request_email_subject' => '%s - Registrierungsversuch',
  'notify_user_email_subject' => '%s - Aktivierungs-Benachrichtigung'
);
?>