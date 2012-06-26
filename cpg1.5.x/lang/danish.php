<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2012 Coppermine Dev Team
  v1.0 originally written by Gregory Demar

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 3
  as published by the Free Software Foundation.

  ********************************************
  Coppermine version: 1.5.21
  $HeadURL$
  $Revision$
**********************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

// info about translators and translated language
$lang_translation_info['lang_name_english'] = 'Danish';
$lang_translation_info['lang_name_native'] = 'Dansk';
$lang_translation_info['lang_country_code'] = 'dk';
$lang_translation_info['trans_name'] = array('Tomas C. Jensen', 'Mimer');
$lang_translation_info['trans_email'] = array('tcj@tomas.dk', 'mimer@fjotte.dk');
$lang_translation_info['trans_website'] = array('http://forum.coppermine-gallery.net/index.php?action=profile;u=81069', 'http://forum.coppermine-gallery.net/index.php?action=profile;u=26052');
$lang_translation_info['trans_date'] = '2012-06-25';


$lang_charset = 'utf-8';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Bytes, Kibibytes, Mebibytes, Gibibytes
$lang_byte_units = array('Bytes', 'KiB', 'MiB', 'GiB');
$lang_decimal_separator = array('.', ','); //cpg1.5 // symbol used to separate thousands from hundreds and rounded number from decimal place

// Day of weeks and months
$lang_day_of_week = array('Søn', 'Man', 'Tir', 'Ons', 'Tor', 'Fre', 'Lør');
$lang_month = array('Jan', 'Feb', 'Mar', 'Apr', 'Maj', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec');

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$lang_date['album'] = '%d %B, %Y';
$lang_date['lastcom'] = '%d/%m/%y at %H:%M';
$lang_date['lastup'] = '%d %B, %Y';
$lang_date['register'] = '%B %d, %Y';
$lang_date['lasthit'] = '%d %B, %Y at %I:%M %p';
$lang_date['comment'] = '%d %B, %Y at %I:%M %p';
$lang_date['log'] = '%d %B, %Y at %I:%M %p';
$lang_date['scientific'] = '%Y-%m-%d %H:%M:%S';

// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'assrammer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack','penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names['random'] = 'Tilfældige filer';
$lang_meta_album_names['lastup'] = 'Seneste tilføjelser';
$lang_meta_album_names['lastalb'] = 'Senest opdaterede album';
$lang_meta_album_names['lastcom'] = 'Seneste kommentarer';
$lang_meta_album_names['topn'] = 'Mest sete';
$lang_meta_album_names['toprated'] = 'Top karakter';
$lang_meta_album_names['lasthits'] = 'Senest sete';
$lang_meta_album_names['search'] = 'Billede søgeresultater';
$lang_meta_album_names['album_search'] = 'Album søgeresultater';
$lang_meta_album_names['category_search'] = 'Kategori søgeresultater';
$lang_meta_album_names['favpics'] = 'Favorit filer';
$lang_meta_album_names['datebrowse'] = 'Gennemse efter dato'; //cpg1.5

$lang_errors['access_denied'] = 'Du har ikke tilladelse til at se denne side.';
$lang_errors['invalid_form_token'] = 'Der kunne ikke findes et gyldigt \'token\' for skemaet.'; //cpg1.5
$lang_errors['perm_denied'] = 'Du har ikke tilladelse til at udføre operationen.';
$lang_errors['param_missing'] = 'Script kaldt uden nødvendig(e) parameter.';
$lang_errors['non_exist_ap'] = 'Det valgte album/fil findes ikke!';
$lang_errors['quota_exceeded'] = 'Diskkvota overskredet.'; //cpg1.5
$lang_errors['quota_exceeded_details'] = 'Du har [quota]K diskplads, dine filer bruger [space]K, tilføjelse af dette vil overskride din kvota.'; //cpg1.5
$lang_errors['gd_file_type_err'] = 'Ved brug af GD billededitor, kan du kun bruge JPEG og PNG typer.';
$lang_errors['invalid_image'] = 'Det uploadede billede er ødelagt eller kan ikke håndteres af GD.';
$lang_errors['resize_failed'] = 'Kan ikke oprette thumpnail eller reduceret størrelse.';
$lang_errors['no_img_to_display'] = 'Der kan ikke vises nogle billeder';
$lang_errors['non_exist_cat'] = 'Den valgte katagori findes ikke.';
$lang_errors['directory_ro'] = 'Mappen \'%s\' er ikke skrivbart, filer kan ikke slettes!';
$lang_errors['pic_in_invalid_album'] = 'Fil er i et ikke eksisterende album (%s)!?!?';
$lang_errors['banned'] = 'Du er udelukket fra at bruge denne side.';
$lang_errors['offline_title'] = 'Offline';
$lang_errors['offline_text'] = 'Galleriet er i øjeblikket offline - Tjek igen senere';
$lang_errors['ecards_empty'] = 'Der er i øjeblikket ingen e-kort at kan vises.';
$lang_errors['database_query'] = 'Der opstod en fejl under en databaseforespørgsel';
$lang_errors['non_exist_comment'] = 'Den valgte kommentar findes ikke';
$lang_errors['captcha_error'] = 'Bekræftelses koden passede ikke'; // cpg1.5
$lang_errors['login_needed'] = 'Du skal %sregister%s/%slogin%s for at få adgang til denne side'; // cpg1.5
$lang_errors['error'] = 'Fejl'; // cpg1.5
$lang_errors['critical_error'] = 'Kritisk fejl'; // cpg1.5
$lang_errors['access_thumbnail_only'] = 'Du har kun ret til at se thumbnail billeder.'; // cpg1.5
$lang_errors['access_intermediate_only'] = 'Du har ikke ret til at se billeder i fuld størrelse.'; // cpg1.5
$lang_errors['access_none'] = 'Du har ikke ret til at se nogen billeder.'; // cpg1.5
$lang_errors['register_globals_title'] = 'Register Globals on!';// cpg1.5
$lang_errors['register_globals_warning'] = 'PHP indstillingen register_globals er slået til på din server, hvilket er en dårlig ide med hensyn til sikkerhed. Det er STÆRKT tilrådeligt at slå den fra.'; //cpg1.5

$lang_bbcode_help_title = 'BBCode hjælp';
$lang_bbcode_help = 'Du kan tilføje klikbare links og noget formattering til dette felt ved hjælp af BBCode: <li>[b]Fed[/b] =&gt; <strong>Fed</strong></li><li>[i]Kursiv[/i] =&gt; <i>Kursiv</i></li><li>[url=http://dinside.com/]Url Text[/url] =&gt; <a href="http://dinside.com">Url Tekst</a></li><li>[email]user@domain.com[/email] =&gt; <a href="mailto:user@domain.com">user@domain.com</a></li><li>[color=red]noget tekst[/color] =&gt; <span style="color:red">noget tekst</span></li><li>[img]http://documentation.coppermine-gallery.net/images/browser.png[/img] =&gt; <img src="docs/images/browser.png" border="0" alt="" /></li>';

$lang_common['yes'] = 'Ja'; // cpg1.5
$lang_common['no'] = 'Nej'; // cpg1.5
$lang_common['back'] = 'Tilbage'; // cpg1.5
$lang_common['continue'] = 'Fortsæt'; // cpg1.5
$lang_common['information'] = 'Information'; // cpg1.5
$lang_common['error'] = 'Fejl'; // cpg1.5
$lang_common['check_uncheck_all'] = 'maker/afmarker alt'; // cpg1.5
$lang_common['confirm'] = 'Bekræftigelse'; // cpg1.5
$lang_common['captcha_help_title'] = 'Visuel bekræftigelse (captcha)'; // cpg1.5
$lang_common['captcha_help'] = 'For at undgå spam, skal du bekræfte, at du er et menneske og ikke bare et bot script ved at skrive den viste tekst.<br />Du kan bruge både store og små bogstaver, så du kan bare skive med små..'; // cpg1.5
$lang_common['title'] = 'Titel'; // cpg1.5
$lang_common['caption'] = 'Beskrivelse'; // cpg1.5
$lang_common['keywords'] = 'Nøgleord'; // cpg1.5
$lang_common['keywords_insert1'] = 'Nøgleord (adskilt med %s)'; // cpg1.5
$lang_common['keywords_insert2'] = 'Indsæt fra liste'; // cpg1.5
$lang_common['keyword_separator'] = 'Nøgleords separator'; //cpg1.5
$lang_common['keyword_separators'] = array(' '=>'mellemrum', ','=>'komma', ';'=>'semikolon'); // cpg1.5
$lang_common['owner_name'] = 'Ejernavn'; // cpg1.5
$lang_common['filename'] = 'Filnavn'; // cpg1.5
$lang_common['filesize'] = 'Filstørrelse'; // cpg1.5
$lang_common['album'] = 'Album'; // cpg1.5
$lang_common['file'] = 'Fil'; // cpg1.5
$lang_common['date'] = 'Dato'; // cpg1.5
$lang_common['help'] = 'Hjælp'; // cpg1.5
$lang_common['close'] = 'Luk'; // cpg1.5
$lang_common['go'] = 'go'; // cpg1.5
$lang_common['javascript_needed'] = 'Denne side kræver JavaScript. Slå JavaScript til i din browser.'; // cpg1.5
$lang_common['move_up'] = 'Flyt up'; // cpg1.5
$lang_common['move_down'] = 'Flyt ned'; // cpg1.5
$lang_common['move_top'] = 'Flyt til toppen'; // cpg1.5
$lang_common['move_bottom'] = 'Flyt til bunden'; // cpg1.5
$lang_common['delete'] = 'Slet'; // cpg1.5
$lang_common['edit'] = 'Rediger'; // cpg1.5
$lang_common['username_if_blank'] = 'Ukendt bruger'; // cpg1.5
$lang_common['albums_no_category'] = 'Albums uden kategori'; // cpg1.5
$lang_common['personal_albums'] = '* Personlige albums'; // cpg1.5
$lang_common['select_album'] = 'Vælg Album'; // cpg1.5
$lang_common['ok'] = 'OK'; // cpg1.5
$lang_common['status'] = 'Status'; // cpg1.5
$lang_common['apply_changes'] = 'Tilføj ændringer'; // cpg1.5
$lang_common['done'] = 'Udført'; // cpg1.5
$lang_common['album_properties'] = 'Album egenskaber'; // cpg1.5
$lang_common['parent_category'] = 'Overliggende kategori'; // cpg1.5
$lang_common['edit_files'] = 'Rediger filer'; // cpg1.5
$lang_common['thumbnail_view'] = 'Thumbnail oversigt'; // cpg1.5
$lang_common['album_manager'] = 'Album Håndtering'; // cpg1.5
$lang_common['more'] = 'mere'; // cpg1.5

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu['home_title'] = 'Gå til hjemmeside';
$lang_main_menu['home_lnk'] = 'Hjem';
$lang_main_menu['alb_list_title'] = 'Gå til albumlisten';
$lang_main_menu['alb_list_lnk'] = 'Albumliste';
$lang_main_menu['my_gal_title'] = 'Gå til mit personlige galleri';
$lang_main_menu['my_gal_lnk'] = 'Mit galleri';
$lang_main_menu['my_prof_title'] = 'Gå til min personlige profil';
$lang_main_menu['my_prof_lnk'] = 'Min profil';
$lang_main_menu['adm_mode_title'] = 'Aktiver visning af admin værktøjer'; // cpg1.5
$lang_main_menu['adm_mode_lnk'] = 'Vis admin værktøjer'; // cpg1.5
$lang_main_menu['usr_mode_title'] = 'Deaktiver visning af admin værktøjer'; // cpg1.5
$lang_main_menu['usr_mode_lnk'] = 'Skjul admin værktøjer'; // cpg1.5
$lang_main_menu['upload_pic_title'] = 'Upload en fil til et album';
$lang_main_menu['upload_pic_lnk'] = 'Upload fil';
$lang_main_menu['register_title'] = 'Opret en bruger';
$lang_main_menu['register_lnk'] = 'Registrer';
$lang_main_menu['login_title'] = 'Luk mig ind';
$lang_main_menu['login_lnk'] = 'Login';
$lang_main_menu['logout_title'] = 'Luk mig ud';
$lang_main_menu['logout_lnk'] = 'Logout';
$lang_main_menu['lastup_title'] = 'Vis de seneste uploads';
$lang_main_menu['lastup_lnk'] = 'Seneste uploads';
$lang_main_menu['lastcom_title'] = 'Vis seneste kommentarer';
$lang_main_menu['lastcom_lnk'] = 'Seneste kommentarer';
$lang_main_menu['topn_title'] = 'Vis mest viste emner';
$lang_main_menu['topn_lnk'] = 'Mest viste';
$lang_main_menu['toprated_title'] = 'Vis emner med højeste karakter';
$lang_main_menu['toprated_lnk'] = 'Højeste karakter';
$lang_main_menu['search_title'] = 'Søg i galleriet';
$lang_main_menu['search_lnk'] = 'Søg';
$lang_main_menu['fav_title'] = 'Gå til mine favoriter';
$lang_main_menu['fav_lnk'] = 'Mine Favoriter';
$lang_main_menu['memberlist_title'] = 'Vis medlemsliste';
$lang_main_menu['memberlist_lnk'] = 'Medlemsliste';
$lang_main_menu['browse_by_date_lnk'] = 'Efter dato'; // cpg1.5
$lang_main_menu['browse_by_date_title'] = 'Vis efter uploaddato'; // cpg1.5
$lang_main_menu['contact_title'] = 'Kom i kontakt med %s'; // cpg1.5
$lang_main_menu['contact_lnk'] = 'Kontakt'; // cpg1.5
$lang_main_menu['sidebar_title'] = 'Tilføj en Sidebar til din browser'; // cpg1.5
$lang_main_menu['sidebar_lnk'] = 'Sidebar'; // cpg1.5

$lang_gallery_admin_menu['upl_app_title'] = 'Godkend nye uploads';
$lang_gallery_admin_menu['upl_app_lnk'] = 'Upload godkendelse';
$lang_gallery_admin_menu['admin_title'] = 'Gå til Indstillinger';
$lang_gallery_admin_menu['admin_lnk'] = 'Indstillinger';
$lang_gallery_admin_menu['albums_title'] = 'Gå til album indstillinger';
$lang_gallery_admin_menu['albums_lnk'] = 'Albums';
$lang_gallery_admin_menu['categories_title'] = 'Gå til kategori indstillinger';
$lang_gallery_admin_menu['categories_lnk'] = 'Kategorier';
$lang_gallery_admin_menu['users_title'] = 'Gå til bruger indstillinger';
$lang_gallery_admin_menu['users_lnk'] = 'Brugere';
$lang_gallery_admin_menu['groups_title'] = 'Gå til gruppe indstillinger';
$lang_gallery_admin_menu['groups_lnk'] = 'Grupper';
$lang_gallery_admin_menu['comments_title'] = 'Gennemse alle kommentarer';
$lang_gallery_admin_menu['comments_lnk'] = 'Gennemse kommentarer';
$lang_gallery_admin_menu['searchnew_title'] = 'Gå til massetilføjelse';
$lang_gallery_admin_menu['searchnew_lnk'] = 'Masse tilføjelser';
$lang_gallery_admin_menu['util_title'] = 'Gå til admin værktøjer';
$lang_gallery_admin_menu['util_lnk'] = 'Admin værktøjer';
$lang_gallery_admin_menu['key_lnk'] = 'Nøgleords Bibliotek';
$lang_gallery_admin_menu['ban_title'] = 'Gå til blokkerede brugere';
$lang_gallery_admin_menu['ban_lnk'] = 'Udeluk brugere';
$lang_gallery_admin_menu['db_ecard_title'] = 'Gennemse e-kort';
$lang_gallery_admin_menu['db_ecard_lnk'] = 'Vis e-kort';
$lang_gallery_admin_menu['pictures_title'] = 'Sorter mine billeder';
$lang_gallery_admin_menu['pictures_lnk'] = 'Sorter mine billeder';
$lang_gallery_admin_menu['documentation_lnk'] = 'Dokumentation';
$lang_gallery_admin_menu['documentation_title'] = 'Coppermine manual';
$lang_gallery_admin_menu['phpinfo_lnk'] = 'phpinfo'; // cpg1.5
$lang_gallery_admin_menu['phpinfo_title'] = 'Indeholder teknisk information om din server. Du kan blive bedt om information når du skal bruge support.'; // cpg1.5
$lang_gallery_admin_menu['update_database_lnk'] = 'Opdater database'; // cpg1.5
$lang_gallery_admin_menu['update_database_title'] = 'Hvis du har erstattet Coppermine filer, tilføjet en modifikation eller opgraderet fra en tidligere version af Coppermine, vær sikker på at køre databaseopdateringen en gang. Dette vil oprette de nødvendige tabeller og/eller konfig værdier i din Coppermine database.'; // cpg1.5
$lang_gallery_admin_menu['view_log_files_lnk'] = 'Vis log filer'; // cpg1.5
$lang_gallery_admin_menu['view_log_files_title'] = 'Coppermine kan holde øje med forskellige operationer udført af brugere. Du kan gennemse disse logs hvis du har slået logging til i Coppermine konfiguration.'; // cpg1.5
$lang_gallery_admin_menu['check_versions_lnk'] = 'Tjek versioner'; // cpg1.5
$lang_gallery_admin_menu['check_versions_title'] = 'Tjek dine fil versioner for at finde ud af om du har erstattet alle efter en opgradering, eller om Coppermine kilde filer er blevet opdateret efter frigivelsen af en pakke.'; // cpg1.5
$lang_gallery_admin_menu['bridgemgr_lnk'] = 'Bridge håndtering'; // cpg1.5
$lang_gallery_admin_menu['bridgemgr_title'] = 'Slå integration(bridging) til/fra af Coppermine med anden applikation (f.eks. din BBS).'; // cpg1.5
$lang_gallery_admin_menu['pluginmgr_lnk'] = 'Plugin håndtering'; // cpg1.5
$lang_gallery_admin_menu['pluginmgr_title'] = 'Plugin håndtering'; // cpg1.5
$lang_gallery_admin_menu['overall_stats_lnk'] = 'Grundlæggende statistikker'; // cpg1.5
$lang_gallery_admin_menu['overall_stats_title'] = 'Se Grundlæggende statistikker efter browser og operativ system (hvis funktionerne er slået til i konfig).'; // cpg1.5
$lang_gallery_admin_menu['keywordmgr_lnk'] = 'Nøgleords håndtering'; // cpg1.5
$lang_gallery_admin_menu['keywordmgr_title'] = 'Håndter nøgleord (hvis funktionerne er slået til i konfig).'; // cpg1.5
$lang_gallery_admin_menu['exifmgr_lnk'] = 'EXIF håndtering'; // cpg1.5
$lang_gallery_admin_menu['exifmgr_title'] = 'Håndter EXIF visning (hvis funktionerne er slået til i konfig).'; // cpg1.5
$lang_gallery_admin_menu['shownews_lnk'] = 'Vis Nyheder'; // cpg1.5
$lang_gallery_admin_menu['shownews_title'] = 'Vis nyheder fra coppermine-gallery.net'; // cpg1.5

$lang_user_admin_menu['albmgr_title'] = 'Opret og sorter mine albums';
$lang_user_admin_menu['albmgr_lnk'] = 'Opert/sorter mine albums';
$lang_user_admin_menu['modifyalb_title'] = 'Gå til ændre mine albums';
$lang_user_admin_menu['modifyalb_lnk'] = 'Ændre mine albums';
$lang_user_admin_menu['my_prof_title'] = 'Gå til min personlige profil';
$lang_user_admin_menu['my_prof_lnk'] = 'Min profil';

$lang_cat_list['category'] = 'Kategori';
$lang_cat_list['albums'] = 'Albums';
$lang_cat_list['pictures'] = 'Filer';

$lang_album_list['album_on_page'] = '%d albums på %d side(r)';

$lang_thumb_view['date'] = 'Dato';
//Sort by filename and title
$lang_thumb_view['name'] = 'Fil Navn';
$lang_thumb_view['sort_da'] = 'Sorter efter dato stigende';
$lang_thumb_view['sort_dd'] = 'Sorter efter dato faldende';
$lang_thumb_view['sort_na'] = 'Sorter efter navn stigende';
$lang_thumb_view['sort_nd'] = 'Sorter efter navn falende';
$lang_thumb_view['sort_ta'] = 'Sorter efter titel stigende';
$lang_thumb_view['sort_td'] = 'Sorter efter titel faldende';
$lang_thumb_view['position'] = 'Position';
$lang_thumb_view['sort_pa'] = 'Sorter på position stigende';
$lang_thumb_view['sort_pd'] = 'Sort på position faldende';
$lang_thumb_view['download_zip'] = 'Download som Zip fil';
$lang_thumb_view['pic_on_page'] = '%d filer på %d side(r)';
$lang_thumb_view['user_on_page'] = '%d filer på %d side(r)';
$lang_thumb_view['enter_alb_pass'] = 'Indtast Album Kodeord';
$lang_thumb_view['invalid_pass'] = 'Forkert Kodeord';
$lang_thumb_view['pass'] = 'Kodeord';
$lang_thumb_view['submit'] = 'Send';
$lang_thumb_view['zipdownload_copyright'] = 'Overhold copyrights - brug kun filer som ejeren af dette galleri, har tænkt det.'; // cpg1.5
$lang_thumb_view['zipdownload_username'] = 'Dette arkiv indeholder zippede filer af favoritter fra %s'; // cpg1.5

$lang_img_nav_bar['thumb_title'] = 'Returner til thumbnail siden';
$lang_img_nav_bar['pic_info_title'] = 'Vis/skjul fil information';
$lang_img_nav_bar['slideshow_title'] = 'Diasfremvisning';
$lang_img_nav_bar['ecard_title'] = 'Send denne fil som et e-kort';
$lang_img_nav_bar['ecard_disabled'] = 'e-kort er slået fra';
$lang_img_nav_bar['ecard_disabled_msg'] = 'Du har ikke rettigheder til at sende e-kort'; // js-alert
$lang_img_nav_bar['prev_title'] = 'Se foregående fil';
$lang_img_nav_bar['next_title'] = 'Se næste fil';
$lang_img_nav_bar['pic_pos'] = 'FIL %s/%s';
$lang_img_nav_bar['report_title'] = 'Rapporter denne fil til administratoren';
$lang_img_nav_bar['go_album_end'] = 'Gå til slutning';
$lang_img_nav_bar['go_album_start'] = 'Returner til start';

$lang_rate_pic['rate_this_pic'] = 'Giv karakter til denne fil ';
$lang_rate_pic['no_votes'] = '(Ingen stemmer endnu)';
$lang_rate_pic['rating'] = '(Nuværende stilling : %s / %s med %s stemmer)';
$lang_rate_pic['rubbish'] = 'Sludder';
$lang_rate_pic['poor'] = 'Ringe';
$lang_rate_pic['fair'] = 'Middel';
$lang_rate_pic['good'] = 'God';
$lang_rate_pic['excellent'] = 'Rigtig god';
$lang_rate_pic['great'] = 'Fantastisk';
$lang_rate_pic['js_warning'] = 'JavaScript skal være slået til for at du kan stemme'; // cpg1.5
$lang_rate_pic['already_voted'] = 'Du har allerede afgivet stemme for dette billede.'; // cpg1.5
$lang_rate_pic['forbidden'] = 'Du kan ikke stemme på egne filer.'; // cpg1.5
$lang_rate_pic['rollover_to_rate'] = 'Træk over for at give karakter til billedet'; // cpg1.5

// ------------------------------------------------------------------------- //
// File include/functions.inc.php
// ------------------------------------------------------------------------- //

$lang_cpg_die['file'] = 'Fil: ';
$lang_cpg_die['line'] = 'Linie: ';

$lang_display_thumbnails['dimensions'] = 'Dimensioner=';
$lang_display_thumbnails['date_added'] = 'Dato for tilføjelse=';

$lang_get_pic_data['n_comments'] = '%s kommentarer';
$lang_get_pic_data['n_views'] = '%s visninger';
$lang_get_pic_data['n_votes'] = '(%s stemmer)';

$lang_cpg_debug_output['debug_info'] = 'Debug Info';
$lang_cpg_debug_output['debug_output'] = 'Debug Output'; // cpg1.5
$lang_cpg_debug_output['select_all'] = 'Vælg Alt';
$lang_cpg_debug_output['copy_and_paste_instructions'] = 'Hvis du vil spørge om hjælp på Coppermine support board, klip-og-klister denne debug udskrift i din henvendelse når du bliver forespurgt, sammmen med den fejlbesked du fik (hvis der var nogen). Vedhæft kun debug_output til support board hvis en supporter  beder om det! Udskift evt. forekomster af kodeord i teksten med *** før afsendelse.'; // cpg1.5
$lang_cpg_debug_output['debug_output_explain'] = 'Note: Dette er kun information og betyder ikke at der er en fejl i galleriet.'; // cpg1.5
$lang_cpg_debug_output['phpinfo'] = 'vis phpinfo';
$lang_cpg_debug_output['notices'] = 'Notitser';
$lang_cpg_debug_output['notices_help_admin'] = 'Denne notits vist på denne side, optræder kun fordi du (som galleri admin) har slået denne funktion til i Coppermine\'s konfiguration. De betyder nødvendigvis ikke, at der er noget galt med dit galleri. Faktisk er det en funktion som kun erfarne programmører bruger for at finde fejl. Hvis visning af notitser plager dig og/eller du ikke aner, hvad de betyder, slå funktionen fra i konfig.'; // cpg1.5
$lang_cpg_debug_output['notices_help_non_admin'] = 'Denne notits er slået til af admin. Det betyder ikke, at der er en fejl i din ende. Du kan roligt ignorere denne notits og hvad der står i den.'; // cpg1.5
$lang_cpg_debug_output['show_hide'] = 'vis / skjul'; // cpg1.5

$lang_language_selection['reset_language'] = 'Standard sprog';
$lang_language_selection['choose_language'] = 'Vælg dit sprog';

$lang_theme_selection['reset_theme'] = 'Standard tema';
$lang_theme_selection['choose_theme'] = 'Vælg et tema';

$lang_version_alert['version_alert'] = 'Ikke understøttet version!';
$lang_version_alert['no_stable_version'] = 'Du bruger Coppermine %s (%s) som kun er bestemt for meget erfarne brugere - denne version er uden support eller nogen garantier. Det er din egen risiko at bruge den eller nedgrader til seneste stabile version hvis du skal have support!';
$lang_version_alert['gallery_offline'] = 'Galleriet er i øjeblikket offline og kan kun ses af dig som admin. Glem ikke at sætte tilbage til online efter vedligehold er afsluttet.';
$lang_version_alert['coppermine_news'] = 'Nyheder from coppermine-gallery.net'; // cpg1.5
$lang_version_alert['no_iframe'] = 'Din browser kan ikke vise inline frames'; // cpg1.5
$lang_version_alert['hide'] = 'skjul'; // cpg1.5

$lang_create_tabs['previous'] = 'Forrige'; // cpg1.5
$lang_create_tabs['next'] = 'Næste'; // cpg1.5
$lang_create_tabs['jump_to_page'] = 'Gå til side'; // cpg1.5

$lang_get_remote_file_by_url['no_data_returned'] = 'Returnerede ingen data ved brug af %s'; // cpg1.5
$lang_get_remote_file_by_url['curl'] = 'CURL'; // cpg1.5
$lang_get_remote_file_by_url['fsockopen'] = 'Socket forbindelse (FSOCKOPEN)'; // cpg1.5
$lang_get_remote_file_by_url['fopen'] = 'fopen'; // cpg1.5
$lang_get_remote_file_by_url['curl_not_available'] = 'Curl er ikke tilgængelig på serveren'; // cpg1.5
$lang_get_remote_file_by_url['error_number'] = 'Fejlnummer: %s'; // cpg1.5
$lang_get_remote_file_by_url['error_message'] = 'Fejlbesked: %s'; // cpg1.5

// ------------------------------------------------------------------------- //
// File include/mailer.inc.php
// ------------------------------------------------------------------------- //
$lang_mailer['provide_address'] = 'Du skal opgive mindst en ';
$lang_mailer['mailer_not_supported'] = ' mailer ikke understøttet.';
$lang_mailer['execute'] = 'Kunne ikke udføres: ';
$lang_mailer['instantiate'] = 'Kunne ikke starte mail funktionen.';
$lang_mailer['authenticate'] = 'SMTP Fejl: Kunne ikke autoriseres.';
$lang_mailer['from_failed'] = 'Følgende Fra adresse fejlede: ';
$lang_mailer['recipients_failed'] = 'SMTP Fejl: Følgende ';
$lang_mailer['data_not_accepted'] = 'SMTP fejl: Data ikke accepteret.';
$lang_mailer['connect_host'] = 'SMTP Fejl: Kunne ikke forbinde til SMTP host.';
$lang_mailer['file_access'] = 'Kunne ikke tilgå fil: ';
$lang_mailer['file_open'] = 'Fil Fejl: Kunne ikke åbne fil: ';
$lang_mailer['encoding'] = 'Ukendt kodning: ';
$lang_mailer['signing'] = 'Signeringsfejl: ';

// ------------------------------------------------------------------------- //
// File include/plugin_api.inc.php
// ------------------------------------------------------------------------- //
$lang_plugin_api['error_install'] = 'Kunne ikke installere plugin \'%s\'';
$lang_plugin_api['error_uninstall'] = 'Kunne ikke fjerne plugin \'%s\'';
$lang_plugin_api['error_sleep'] = 'Kunne ikke slå plugin \'%s\' fra'; // cpg1.5

// ------------------------------------------------------------------------- //
// File include/smilies.inc.php
// ------------------------------------------------------------------------- //
if (defined('SMILIES_PHP')) {
$lang_smilies_inc_php['Exclamation'] = 'Bestemt';
$lang_smilies_inc_php['Question'] = 'Spørgsmål';
$lang_smilies_inc_php['Very Happy'] = 'Meget glad';
$lang_smilies_inc_php['Smile'] = 'Smil';
$lang_smilies_inc_php['Sad'] = 'Ked af det';
$lang_smilies_inc_php['Surprised'] = 'Overrasket';
$lang_smilies_inc_php['Shocked'] = 'Chokeret';
$lang_smilies_inc_php['Confused'] = 'Forvirret';
$lang_smilies_inc_php['Cool'] = 'Cool';
$lang_smilies_inc_php['Laughing'] = 'Griner';
$lang_smilies_inc_php['Mad'] = 'Gal';
$lang_smilies_inc_php['Razz'] = 'Razz';
$lang_smilies_inc_php['Embarrassed'] = 'Flov'; // cpg1.5
$lang_smilies_inc_php['Crying or Very sad'] = 'Græder - eller meget ked';
$lang_smilies_inc_php['Evil or Very Mad'] = 'Ond eller meget gal';
$lang_smilies_inc_php['Twisted Evil'] = 'Rablende gal';
$lang_smilies_inc_php['Rolling Eyes'] = 'Rullende øjne';
$lang_smilies_inc_php['Wink'] = 'Vinker';
$lang_smilies_inc_php['Idea'] = 'Ide';
$lang_smilies_inc_php['Arrow'] = 'Pil';
$lang_smilies_inc_php['Neutral'] = 'Neutral';
$lang_smilies_inc_php['Mr. Green'] = 'Mr. Green';
}

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //
if (defined('ALBMGR_PHP')) {
$lang_albmgr_php['title'] = 'Album Håndtering'; // cpg1.5
$lang_albmgr_php['alb_need_name'] = 'Albums skal have et navn!'; // js-alert
$lang_albmgr_php['confirm_modifs'] = 'Er du sikker på du vil lave disse ændringer?'; // js-alert
$lang_albmgr_php['no_change'] = 'Du lavede ingen ændringer!'; // js-alert
$lang_albmgr_php['new_album'] = 'Nyt album';
$lang_albmgr_php['delete_album'] = 'Slet album'; // cpg1.5
$lang_albmgr_php['confirm_delete1'] = 'Er du sikker på du vil slette dette album?'; // js-alert
$lang_albmgr_php['confirm_delete2'] = 'Alle filer og kommentarer det indeholder vil blive tabt!'; // js-alert
$lang_albmgr_php['select_first'] = 'Vælg et album først'; // js-alert
$lang_albmgr_php['my_gallery'] = '* Mit galleri *';
$lang_albmgr_php['no_category'] = '* Ingen kategori *';
$lang_albmgr_php['select_category'] = 'Vælg kategori';
$lang_albmgr_php['category_change'] = 'Hvis du ændrer kategori, vil dine ændringer være tabte!'; // cpg1.5
$lang_albmgr_php['page_change'] = 'Hvis du følger dette link, vil alle dine ændringer være tabte!'; // cpg1.5
$lang_albmgr_php['cancel'] = 'Annuler'; // cpg1.5
$lang_albmgr_php['submit_reminder'] = 'Sorterings ændringer er ikke gemt før du klikker &quot;Tilføj ændringer&quot;.'; // cpg1.5
}

// ------------------------------------------------------------------------- //
// File banning.php
// ------------------------------------------------------------------------- //

if (defined('BANNING_PHP')) {
$lang_banning_php['title'] = 'Udeluk brugere';
$lang_banning_php['user_name'] = 'Bruger navn';
$lang_banning_php['user_account'] = 'Bruger konto';
$lang_banning_php['email_address'] = 'E-mail Adresse'; // cpg1.5
$lang_banning_php['ip_address'] = 'IP Adresse';
$lang_banning_php['expires'] = 'Udløber'; // cpg1.5
$lang_banning_php['expiry_date'] = 'Udløbsdato'; // cpg1.5
$lang_banning_php['expired'] = 'Udløbet'; // cpg1.5
$lang_banning_php['edit_ban'] = 'Gem ændringer';
$lang_banning_php['add_new'] = 'Tilføj ny udelukkelse';
$lang_banning_php['add_ban'] = 'Tilføj';
$lang_banning_php['error_user'] = 'Kan ikke finde bruger';
$lang_banning_php['error_specify'] = 'Du skal angive enten bruger navn eller ip adresse';
$lang_banning_php['error_ban_id'] = 'Forkert udelukkelses ID!';
$lang_banning_php['error_admin_ban'] = 'Du kan ikke udelukke dig selv!';
$lang_banning_php['error_server_ban'] = 'Du var ved at blokkere din egen server? Tsk tsk, den går ikke...';
$lang_banning_php['skipping'] = 'Springer den kommando over.'; // cpg1.5
$lang_banning_php['lookup_ip'] = 'Find IP Addresse';
$lang_banning_php['select_date'] = 'vælg dato';
$lang_banning_php['delete_comments'] = 'Slet kommentarer'; // cpg1.5
$lang_banning_php['current'] = 'nuværende'; // cpg1.5
$lang_banning_php['all'] = 'alle'; // cpg1.5
$lang_banning_php['none'] = 'ingen'; // cpg1.5
$lang_banning_php['view'] = 'se'; // cpg1.5
$lang_banning_php['ban_id'] = 'Udelukkelses ID'; // cpg1.5
$lang_banning_php['existing_bans'] = 'Eksisterende udelukkelser'; // cpg1.5
$lang_banning_php['no_banning_when_bridged'] = 'Du har integreret dit galleri med en anden applikation. Brug den integrerede applikations funktion fremfor for Coppermine\'. Coppermine\'s udelukkelses mekanismer virker sjældent når den er integreret.'; // cpg1.5
$lang_banning_php['records_on_page'] = '%d poster på %d side(r)'; // cpg1.5
$lang_banning_php['ascending'] = 'stigende'; // cpg1.5
$lang_banning_php['descending'] = 'faldende'; // cpg1.5
$lang_banning_php['sort_by'] = 'Sorter efter'; // cpg1.5
$lang_banning_php['sorted_by'] = 'sorteret efter'; // cpg1.5
$lang_banning_php['ban_record_x_updated'] = 'Udeluk post %s er blevet opdateret'; // cpg1.5
$lang_banning_php['ban_record_x_deleted'] = 'Udeluk post %s er blevet slettet'; // cpg1.5
$lang_banning_php['new_ban_record_created'] = 'Ny udeluk post er oprettet'; // cpg1.5
$lang_banning_php['ban_record_x_already_exists'] = 'Udeluk post for %s findes allerede!'; // cpg1.5
$lang_banning_php['comment_deleted'] = '%s kommentar oprettet af %s er blevet slettet'; // cpg1.5
$lang_banning_php['comments_deleted'] = '%s kommentarer oprettet af %s her blevet slettet'; // cpg1.5
$lang_banning_php['email_field_invalid'] = 'Indtast en gyldig e-mail adresse'; // cpg1.5
$lang_banning_php['ip_address_field_invalid'] = 'Indtast en gyldig ip-adresse (x.x.x.x)'; // cpg1.5
$lang_banning_php['expiry_field_invalid'] = 'Indtast en gyldig udløbsdato (YYYY-MM-DD)'; // cpg1.5
$lang_banning_php['form_not_submit'] = 'Formularen er ikke blevet sendt - Der er fejl som du skal rette først!'; // cpg1.5
};

// ------------------------------------------------------------------------- //
// File bridgemgr.php
// ------------------------------------------------------------------------- //
if (defined('BRIDGEMGR_PHP')) {
$lang_bridgemgr_php['title'] = 'Integration guide';
$lang_bridgemgr_php['back'] = 'tilbage';
$lang_bridgemgr_php['next'] = 'næste';
$lang_bridgemgr_php['start_wizard'] = 'Start integration guide';
$lang_bridgemgr_php['finish'] = 'Afslut';
$lang_bridgemgr_php['no_action_needed'] = 'Der skal intet gøres i dette trin. Klik \'næste\' for at fortsætte.';
$lang_bridgemgr_php['reset_to_default'] = 'Nulstil til standard værdier';
$lang_bridgemgr_php['choose_bbs_app'] = 'Vælg applikation som Coppermine skal integreres med';
$lang_bridgemgr_php['support_url'] = 'Gå hertil for support på denne applikation';
$lang_bridgemgr_php['settings_path'] = 'sti(er) brugt af din integrerede applikation';
$lang_bridgemgr_php['full_forum_url'] = 'URL for den integrerede applikation';
$lang_bridgemgr_php['relative_path_of_forum_from_webroot'] = 'Absolut sti til den integrerede applikation';
$lang_bridgemgr_php['relative_path_to_config_file'] = 'Relativ sti til den integrerede applikations konfig file';
$lang_bridgemgr_php['cookie_prefix'] = 'Cookie præfiks';
$lang_bridgemgr_php['special_settings'] = 'integrerede applikation specifikke indstillinger';
$lang_bridgemgr_php['use_post_based_groups'] = 'Brug integrerede applikation tilpassede grupper?';
$lang_bridgemgr_php['use_post_based_groups_yes'] = 'ja';
$lang_bridgemgr_php['use_post_based_groups_no'] = 'nej';
$lang_bridgemgr_php['error_title'] = 'Du skal rette disse fejl før du kan fortsætte. Gå til den forrige skærm.';
$lang_bridgemgr_php['error_specify_bbs'] = 'Du skal angive, hvilken applikation Coppermine skal installeres med.';
$lang_bridgemgr_php['finalize'] = 'slå integration til/fra';
$lang_bridgemgr_php['finalize_explanation'] = 'Indtil vider er dine indstillinger gemt i databasen, men integrationen er endnu ikke slået til. Du kan slå dette til/fra på et vilkårligt tidspunkt. Husk på admin brugernavn og kodeord fra din standalone Coppermine, du kan få brug for det på et senere tidspunkt for at lave ændringer. Hvis noget går galt, gå til %s og slå integration fra der, ved hjælp af din gamle brugeradgang (normalt den du brugte under installationen af Coppermine).';
$lang_bridgemgr_php['your_bridge_settings'] = 'Dine integrations instillinger';
$lang_bridgemgr_php['title_enable'] = 'Slå integration til med %s';
$lang_bridgemgr_php['bridge_enable_yes'] = 'til';
$lang_bridgemgr_php['bridge_enable_no'] = 'fra';
$lang_bridgemgr_php['error_must_not_be_empty'] = 'må ikke være tom';
$lang_bridgemgr_php['error_either_be'] = 'Skal være enten %s eller %s';
$lang_bridgemgr_php['error_folder_not_exist'] = '%s eksisterer ikke. Ret værdien indtastede for %s';
$lang_bridgemgr_php['error_cookie_not_readible'] = 'Coppermine kan ikke læse en cookie kaldet %s. Ret værdien du indtastede for %s, eller gå til din integrerede applikations admin panel og sikrer dig at cookie stien er læsbar for Coppermine.';
$lang_bridgemgr_php['error_mandatory_field_empty'] = 'Du kan ikke efterlade feltet %s tomt - indtast en passende værdi.';
$lang_bridgemgr_php['error_no_trailing_slash'] = 'Der må ikke være en efterfølgende skråstreg i feltet %s.';
$lang_bridgemgr_php['error_trailing_slash'] = 'Der skal være en efterfølgende skråstreg i feltet %s.';
$lang_bridgemgr_php['error_prefix_and_table'] = '%s og ';
$lang_bridgemgr_php['recovery_title'] = 'Integration Håndtering: nød genopretning';
$lang_bridgemgr_php['recovery_explanation'] = 'Hvis du kom her for at administrere integrationen af dit Coppermine galleri, skal du først logge ind som admin. Hvis du ikke kan logge ind fordi integrationen ikke virker korrekt, kan du slå integration fra på denne side. Indtastningen af dit brugernavn og kodeord vil ikke logge dig ind, men blot slå integrationen fra. Se i dokumentatione for detaljer.';
$lang_bridgemgr_php['username'] = 'Brugernavn';
$lang_bridgemgr_php['password'] = 'Kodeord';
$lang_bridgemgr_php['disable_submit'] = 'send';
$lang_bridgemgr_php['recovery_success_title'] = 'Authorisation lykkedes';
$lang_bridgemgr_php['recovery_success_content'] = 'Det er lykkedes dig at slå integrationen fra. Din Coppermine kører nu i standalone mode.';
$lang_bridgemgr_php['recovery_success_advice_login'] = 'Log ind som admin for at rette på integrationsindstillingerne og/eller slå integrationen til igen.';
$lang_bridgemgr_php['goto_login'] = 'Gå til login side';
$lang_bridgemgr_php['goto_bridgemgr'] = 'Gå til Integration Håndtering';
$lang_bridgemgr_php['recovery_failure_title'] = 'Authorisation fejlede';
$lang_bridgemgr_php['recovery_failure_content'] = 'Du har brugt forkerte brugernavn/kodeord. Du skal bruge brugernavn/kodeord fra den normale Coppermine standalone version (normalt fra kontoen der blev sat op under installationen af Coppermine).';
$lang_bridgemgr_php['try_again'] = 'prøv igen';
$lang_bridgemgr_php['recovery_wait_title'] = 'Vente tiden er ikke udløbet';
$lang_bridgemgr_php['recovery_wait_content'] = 'Af sikkerhedsgrunde dette script holder en pause efter hver mislykkede login forsøg, så du må vente lidt før du kan prøve igen.';
$lang_bridgemgr_php['wait'] = 'vent';
$lang_bridgemgr_php['browse'] = 'gennemse';
}

// ------------------------------------------------------------------------- //
// File calendar.php
// ------------------------------------------------------------------------- //
if (defined('CALENDAR_PHP')) {
$lang_calendar_php['title'] = 'Kalender';
$lang_calendar_php['clear_date'] = 'ryd dato';
$lang_calendar_php['files'] = 'filer'; // cpg1.5
}

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //
if (defined('CATMGR_PHP')) {
$lang_catmgr_php['miss_param'] = 'Parameter krævet for \'%s\' handlinger ikke tilføjet!';
$lang_catmgr_php['unknown_cat'] = 'Valgte katagori eksistere ikke i databasen';
$lang_catmgr_php['usergal_cat_ro'] = 'Bruger galleri kategori kan ikke slettes!';
$lang_catmgr_php['manage_cat'] = 'Administrer katagorier';
$lang_catmgr_php['confirm_delete'] = 'Er du sikker på du vil SLETTE denne kategori'; // js-alert
$lang_catmgr_php['category'] = 'Katagorier'; // cpg1.5
$lang_catmgr_php['operations'] = 'Handlinger';
$lang_catmgr_php['move_into'] = 'Flyt ind i';
$lang_catmgr_php['update_create'] = 'Opdater/Opret kategori';
$lang_catmgr_php['parent_cat'] = 'Overliggende kategori';
$lang_catmgr_php['cat_title'] = 'Katagori titel';
$lang_catmgr_php['cat_thumb'] = 'Katagori thumbnail';
$lang_catmgr_php['cat_desc'] = 'Katagori beskrivelse';
$lang_catmgr_php['categories_alpha_sort'] = 'Sorter katagorier alfabetisk (fremfor efter brugervalgt sortering)';
$lang_catmgr_php['save_cfg'] = 'Gem konfiguration';
$lang_catmgr_php['no_category'] = '* Ingen katagori *'; // cpg1.5
$lang_catmgr_php['group_create_alb'] = 'Gruppe(r) med ret til at oprette albums i denne katagori'; // cpg1.5
}

// ------------------------------------------------------------------------- //
// File contact.php
// ------------------------------------------------------------------------- //
if (defined('CONTACT_PHP')) {
$lang_contact_php['title'] = 'Kontakt'; // cpg1.5
$lang_contact_php['your_name'] = 'Dit navn'; // cpg1.5
$lang_contact_php['your_email'] = 'Din e-mail adresse'; // cpg1.5
$lang_contact_php['subject'] = 'Emne'; // cpg1.5
$lang_contact_php['your_message'] = 'Din besked'; // cpg1.5
$lang_contact_php['name_field_mandatory'] = 'Indtast dit navn'; // cpg1.5 // js-alert
$lang_contact_php['name_field_invalid'] = 'Indtast dit rigtige navn'; // cpg1.5 // js-alert
$lang_contact_php['email_field_mandatory'] = 'Indtast din e-mail adresse'; // cpg1.5 // js-alert
$lang_contact_php['email_field_invalid'] = 'Indtast en gyldig e-mail adresse'; // cpg1.5 // js-alert
$lang_contact_php['subject_field_mandatory'] = 'Indtast et meningsfyldt emne'; // cpg1.5 // js-alert
$lang_contact_php['message_field_mandatory'] = 'Indtast din besked'; // cpg1.5 // js-alert
$lang_contact_php['confirmation'] = 'Bekræftelse'; // cpg1.5
$lang_contact_php['email_headline'] = 'Denne e-mail blev sendt %s fra kontakt formularen på %s fra ip-adresse %s'; // cpg1.5
$lang_contact_php['registered_user'] = 'registreret bruger'; // cpg1.5
$lang_contact_php['guest'] = 'gæst'; // cpg1.5
$lang_contact_php['unknown'] = 'ukendt'; // cpg1.5
$lang_contact_php['user_info'] = '%s kaldet %s med email adresse %s skrev:'; // cpg1.5
$lang_contact_php['failed_sending_email'] = 'Kunne ikke sende e-mail. Prøv igen senere.'; // cpg1.5
$lang_contact_php['email_sent'] = 'Din e-mail er blevet sendt.'; // cpg1.5
}

// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //
if (defined('ADMIN_PHP')) {
$lang_admin_php['title'] = 'Galleri Konfiguration';
$lang_admin_php['general_settings'] = 'Generelle indstillinger'; // cpg1.5
$lang_admin_php['language_charset_settings'] = 'Sprog og tegnsæt indstillinger'; // cpg1.5
$lang_admin_php['themes_settings'] = 'Tema indstillinger'; // cpg1.5
$lang_admin_php['album_list_view'] = 'Albumliste indstillinger'; // cpg1.5
$lang_admin_php['thumbnail_view'] = 'Thumbnail indstillinger'; // cpg1.5
$lang_admin_php['image_view'] = 'Billedvisnings indstillinger'; // cpg1.5
$lang_admin_php['comment_settings'] = 'Kommentar indstillinger'; // cpg1.5
$lang_admin_php['thumbnail_settings'] = 'Thumbnails indstillinger'; // cpg1.5
$lang_admin_php['file_settings'] = 'Fil indstillinger'; // cpg1.5
$lang_admin_php['image_watermarking'] = 'Billedvandmærkning'; // cpg1.5
$lang_admin_php['registration'] = 'Registrering'; // cpg1.5
$lang_admin_php['user_settings'] = 'Bruger indstillinger'; // cpg1.5
$lang_admin_php['custom_fields_user_profile'] = 'Tilpassede felter for brugerprofil (tomt hvis ubrugt). Brug profil 6 for lange tekster, såsom biografier'; // cpg1.5
$lang_admin_php['custom_fields_image_description'] = 'Tilpassede felter for billedbeskrivelser (tomt hvis ubrugt)'; // cpg1.5
$lang_admin_php['cookie_settings'] = 'Cookies indstillinger'; // cpg1.5
$lang_admin_php['email_settings'] = 'E-mail instillinger (normalt skal der ikke laves ændringer her, efterlad alle felter tomme, hvis du er usikker)'; // cpg1.5
$lang_admin_php['logging_stats'] = 'Logning og statistikker'; // cpg1.5
$lang_admin_php['maintenance_settings'] = 'Vedligeholdelses indstillinger'; // cpg1.5
$lang_admin_php['manage_exif'] = 'Indstil EXIF visning';
$lang_admin_php['manage_plugins'] = 'Indstil plugins';
$lang_admin_php['manage_keyword'] = 'Indstil nøgleord';
$lang_admin_php['restore_cfg'] = 'Genskab standardindstillinger';
$lang_admin_php['restore_cfg_confirm'] = 'Vil du virkelig genskabe hele konfigurationen til standardindstillinger? Dette kan ikke laves om!'; // cpg1.5 // js-alert
$lang_admin_php['save_cfg'] = 'Gem ny konfiguration';
$lang_admin_php['notes'] = 'Noter';
$lang_admin_php['info'] = 'Information';
$lang_admin_php['upd_success'] = 'Coppermine konfigurationen er opdateret';
$lang_admin_php['restore_success'] = 'Coppermine standardkonfiguration genskabt';
$lang_admin_php['name_a'] = 'Navn stigende';
$lang_admin_php['name_d'] = 'Navn faldende';
$lang_admin_php['title_a'] = 'Titel stigende';
$lang_admin_php['title_d'] = 'Titel faldende';
$lang_admin_php['date_a'] = 'Dato stigende';
$lang_admin_php['date_d'] = 'Dato faldende';
$lang_admin_php['pos_a'] = 'Position stigende';
$lang_admin_php['pos_d'] = 'Position faldende';
$lang_admin_php['th_any'] = 'Maks Aspekt';
$lang_admin_php['th_ht'] = 'Højde';
$lang_admin_php['th_wd'] = 'Bredde';
$lang_admin_php['th_ex'] = 'Eksakt'; // cpg1.5
$lang_admin_php['debug_everyone'] = 'Alle';
$lang_admin_php['debug_admin'] = 'Kun admin';
$lang_admin_php['no_logs'] = 'Off';
$lang_admin_php['log_normal'] = 'Normal';
$lang_admin_php['log_all'] = 'Alle';
$lang_admin_php['view_logs'] = 'Vis alle logger';
$lang_admin_php['click_expand'] = 'Klik på sektion for at udvide';
$lang_admin_php['click_collapse'] = 'Klik på sektion for at samle'; // cpg1.5
$lang_admin_php['expand_all'] = 'Udvid alle';
$lang_admin_php['toggle_all'] = 'Modsæt'; // cpg1.5
$lang_admin_php['notice1'] = '(*) Disse instillinger må ikke ændres, hvis du allerede har filer i databasen.';
$lang_admin_php['notice2'] = '(**) Når denne indstilling ændres, berører det kun filer der er tilføjet herefter, så det er ikke tilrådeligt at ændre på denne instilling, når der alered er filer i galleriet. Du kan dog tilføje ændringerne til eksisterende filer med &quot;<a href="util.php">admin værktøjet</a> (ændre billedstørrelse)&quot; værktøjet fra admin menuen.';
$lang_admin_php['notice3'] = '(***) Alle logfiler er skrevet på engelsk.';
$lang_admin_php['bbs_disabled'] = 'Funktion slået fra når der anvendes integration';
$lang_admin_php['auto_resize_everyone'] = 'Alle';
$lang_admin_php['auto_resize_user'] = 'Kun bruger';
$lang_admin_php['ascending'] = 'stigende';
$lang_admin_php['descending'] = 'faldende';
$lang_admin_php['collapse_all'] = 'Saml alle'; // cpg1.5
$lang_admin_php['separate_page'] = 'på en seperat side'; // cpg1.5
$lang_admin_php['inline'] = 'inline'; // cpg1.5
$lang_admin_php['guests_only'] = 'Kun gæster'; // cpg1.5
$lang_admin_php['wm_bottomright'] = 'Bunden til højre'; // cpg1.5
$lang_admin_php['wm_bottomleft'] = 'Bunden til venstre'; // cpg1.5
$lang_admin_php['wm_topleft'] = 'Top til venstre'; // cpg1.5
$lang_admin_php['wm_topright'] = 'Top til højre'; // cpg1.5
$lang_admin_php['wm_center'] = 'Center'; // cpg1.5
$lang_admin_php['wm_both'] = 'Begge'; // cpg1.5
$lang_admin_php['wm_original'] = 'Original'; // cpg1.5
$lang_admin_php['wm_resized'] = 'Størrelse ændret'; // cpg1.5
$lang_admin_php['gallery_name'] = 'Galleri navn'; // cpg1.5
$lang_admin_php['gallery_description'] = 'Galleri beskrivelse'; // cpg1.5
$lang_admin_php['gallery_admin_email'] = 'Galleri administrator e-mail'; // cpg1.5
$lang_admin_php['ecards_more_pic_target'] = 'URL til din Coppermine galleri mappe'; // cpg1.5
$lang_admin_php['ecards_more_pic_target_detail'] = '(med en efterfølgende skråstreg, ikke \'index.php\' eller lign. i enden)'; // cpg1.5
$lang_admin_php['home_target'] = 'URL til din hjemmeside'; // cpg1.5
$lang_admin_php['enable_zipdownload'] = 'Tillad ZIP-download af favoritter'; // cpg1.5
$lang_admin_php['enable_zipdownload_no_textfile'] = 'kun favoritter'; // cpg1.5
$lang_admin_php['enable_zipdownload_additional_textfile'] = 'favoritter og readme fil'; // cpg1.5
$lang_admin_php['time_offset'] = 'Tidszone forskel relativ til GMT'; // cpg1.5
$lang_admin_php['time_offset_detail'] = '(nuværende tid: %s)'; // cpg1.5
$lang_admin_php['enable_help'] = 'Slå hjælpe-ikoner til'; // cpg1.5
$lang_admin_php['enable_help_description'] = 'hjælp kun delvist tilgængeligt på engelsk'; // cpg1.5
$lang_admin_php['clickable_keyword_search'] = 'Slå klikbare nøgleord til i søgning'; // cpg1.5
$lang_admin_php['keyword_separator'] = 'Nøgleordsadskiller'; // cpg1.5
$lang_admin_php['keyword_convert'] = 'Konverter nøgleordsadskiller'; // cpg1.5
$lang_admin_php['enable_plugins'] = 'Slå plugins til'; // cpg1.5
$lang_admin_php['purge_expired_bans'] = 'Slet automatisk udløbne udelukkelser'; // cpg1.5
$lang_admin_php['browse_batch_add'] = 'Browsable batch-add interface'; // cpg1.5
$lang_admin_php['batch_proc_limit'] = 'Process concurrency for batch-add interface'; // cpg1.5
$lang_admin_php['display_thumbs_batch_add'] = 'Vis små thumbnails på batch-add interface'; // cpg1.5
$lang_admin_php['lang'] = 'Standard sprog'; // cpg1.5
$lang_admin_php['language_autodetect'] = 'Autodetekter sprog'; // cpg1.5
$lang_admin_php['charset'] = 'Tegnsæt kodning'; // cpg1.5
// 'previous_next_tab'] = 'Vis forrige/næste på sider med faneblade'; // cpg1.5
$lang_admin_php['theme'] = 'Tema'; // cpg1.5
$lang_admin_php['custom_lnk_name'] = 'Tilpasset menu link navn'; // cpg1.5
$lang_admin_php['custom_lnk_url'] = 'Tilpasset menu link URL'; // cpg1.5
$lang_admin_php['enable_menu_icons'] = 'Slå menu ikoner til'; // cpg1.5
$lang_admin_php['show_bbcode_help'] = 'Vis BBCode hjælp'; // cpg1.5
$lang_admin_php['vanity_block'] = 'Vis vanity block på temaer der følger XHTML og CSS standard'; // cpg1.5
$lang_admin_php['highlight_multiple'] = 'Vælg flere linier ved at holde [Ctrl]-tasten nede'; // cpg1.5
$lang_admin_php['custom_header_path'] = 'Sti til tilpasset sidehoved'; // cpg1.5
$lang_admin_php['custom_footer_path'] = 'Sti til tilpasset sidefødder'; // cpg1.5
$lang_admin_php['browse_by_date'] = 'Slå bladring efter dato til'; // cpg1.5
$lang_admin_php['display_redirection_page'] = 'Vis omdirigeringssider'; // cpg1.5
$lang_admin_php['display_xp_publish_link'] = 'Fremhæv brugen af XP Publisher ved at vise korresponderende link på upload side'; // cpg1.5
$lang_admin_php['main_table_width'] = 'Bredde af hovedtabellen'; // cpg1.5
$lang_admin_php['pixels_or_percent'] = 'pixels eller %'; // cpg1.5
$lang_admin_php['subcat_level'] = 'Antal niveauer af kategorier der vises'; // cpg1.5
$lang_admin_php['albums_per_page'] = 'Antal album der vises'; // cpg1.5
$lang_admin_php['album_list_cols'] = 'Antal kolonner for albumlisten'; // cpg1.5
$lang_admin_php['alb_list_thumb_size'] = 'Størrelse på album thumbnails'; // cpg1.5
$lang_admin_php['main_page_layout'] = 'Indholdet af forsiden'; // cpg1.5
$lang_admin_php['first_level'] = 'Vis første niveau album thumbnails i kategorier'; // cpg1.5
$lang_admin_php['categories_alpha_sort'] = 'Sorter kategorier alfabetisk'; // cpg1.5
$lang_admin_php['categories_alpha_sort_details'] = '(fremfor tilpasset sorteringsrækkefølge)'; // cpg1.5
$lang_admin_php['link_pic_count'] = 'Vis antal linkede filer'; // cpg1.5
$lang_admin_php['thumbcols'] = 'Antal kolonner på thumbnail siden'; // cpg1.5
$lang_admin_php['thumbrows'] = 'Antal rækker på thumbnail siden'; // cpg1.5
$lang_admin_php['max_tabs'] = 'Maksimum antal faner der vises'; // cpg1.5
$lang_admin_php['tabs_dropdown'] = 'Vis dropdown liste af alle sider ved siden af faner'; // cpg1.5
$lang_admin_php['caption_in_thumbview'] = 'Vis filbeskrivelse (sammen med titlen) under thumbnail'; // cpg1.5
$lang_admin_php['views_in_thumbview'] = 'Vis antal visninger under thumbnail'; // cpg1.5
$lang_admin_php['display_comment_count'] = 'Vis antal kommentarer under thumbnail'; // cpg1.5
$lang_admin_php['display_uploader'] = 'Vis upload navn under thumbnail'; // cpg1.5
// 'display_admin_uploader'] = 'Vis admin uploaders navn under thumbnail'; // cpg1.5
$lang_admin_php['display_filename'] = 'Vis fil navn under thumbnail'; // cpg1.5
$lang_admin_php['display_thumbnail_rating'] = 'Vis karakter under thumbnail'; // cpg1.5
$lang_admin_php['alb_desc_thumb'] = 'Vis albumbeskrivelse'; // cpg1.5
$lang_admin_php['thumbnail_to_fullsize'] = 'Gå direkte fra thumbnail til fuldstørrelse billede'; // cpg1.5
$lang_admin_php['default_sort_order'] = 'Standard sorteringsrækkefølge for filer'; // cpg1.5
$lang_admin_php['min_votes_for_rating'] = 'Mindste antal stemmer på en fil før den vises i \'top rated\' listen'; // cpg1.5
$lang_admin_php['picture_table_width'] = 'Bredde af tabellen ved fil visning'; // cpg1.5
$lang_admin_php['display_pic_info'] = 'Fil information er synlig som standard'; // cpg1.5
$lang_admin_php['picinfo_movie_download_link'] = 'Vis film download link i fil information område'; // cpg1.5
$lang_admin_php['max_img_desc_length'] = 'Maks længde for en billedbeskrivelse'; // cpg1.5
$lang_admin_php['max_com_wlength'] = 'Maks antal tegn i et ord'; // cpg1.5
$lang_admin_php['display_film_strip'] = 'Vis film strip'; // cpg1.5
$lang_admin_php['max_film_strip_items'] = 'Antal emner i en film strip'; // cpg1.5
$lang_admin_php['slideshow_interval'] = 'Diasshow interval'; // cpg1.5
$lang_admin_php['milliseconds'] = 'millisekunder'; // cpg1.5
$lang_admin_php['slideshow_interval_detail'] = '1 sekund = 1000 millisekunder'; // cpg1.5
$lang_admin_php['slideshow_hits'] = 'Tæl visninger i diasshow'; // cpg1.5
$lang_admin_php['ecard_flash'] = 'Tillad Flash i e-kort'; // cpg1.5
$lang_admin_php['not_recommended'] = 'ikke anbefalet'; // cpg1.5
$lang_admin_php['recommended'] = 'anbefalet'; // cpg1.5
$lang_admin_php['transparent_overlay'] = 'Indsæt transperent over billede for at minimere billedtyveri'; // cpg1.5
$lang_admin_php['old_style_rating'] = 'Gå tilbage til gammelt karaktersystem'; // cpg1.5
$lang_admin_php['old_style_rating_extra'] = 'Dette vil fjerne \'Antal af bedømmelsesstjerner\' valget'; // cpg1.5
$lang_admin_php['rating_stars_amount'] = 'Antal stjerner i brug ved bedømmelse ved afstemning'; // cpg1.5
$lang_admin_php['rate_own_files'] = 'Bruger kan stemme på egne filer'; // cpg1.5
$lang_admin_php['filter_bad_words'] = 'Filtrer \'grimme\' ord i kommentarer'; // cpg1.5
$lang_admin_php['enable_smilies'] = 'Tillad smileyer i kommentarer'; // cpg1.5
$lang_admin_php['disable_comment_flood_protect'] = 'Tillad flere på hinanden følgende kommentarer fra samme bruger'; // cpg1.5
$lang_admin_php['disable_comment_flood_protect_details'] = '(slå flood protection fra)'; // cpg1.5
$lang_admin_php['max_com_lines'] = 'Maks antal linier i en kommentar'; // cpg1.5
$lang_admin_php['max_com_size'] = 'Maks længde af linie i en kommentar'; // cpg1.5
$lang_admin_php['email_comment_notification'] = 'Adviser admin om kommentarer gennem e-mail'; // cpg1.5
$lang_admin_php['comments_sort_descending'] = 'Sorteringsrækkefølge af kommentarer'; // cpg1.5
$lang_admin_php['comments_per_page'] = 'Kommentarer pr. side'; // cpg1.5
$lang_admin_php['comments_anon_pfx'] = 'Præfiks for anonyme kommentar forfattere'; // cpg1.5
$lang_admin_php['comment_approval'] = 'Kommentar kræver godkendelse'; // cpg1.5
$lang_admin_php['display_comment_approval_only'] = 'Vis kun kommentarer der behøver godkendelse på &quot;Gennemse kommentarer&quot; siden'; // cpg1.5
$lang_admin_php['comment_placeholder'] = 'Vis tekst for brugere der venter på at få godkendt kommentarer af admin'; // cpg1.5
$lang_admin_php['comment_user_edit'] = 'Tillad brugere at rette deres kommentarer'; // cpg1.5
$lang_admin_php['comment_captcha'] = 'Vis Captcha (Visuel Bekræftigelse) for tilføjning af kommentarer'; // cpg1.5
$lang_admin_php['comment_akismet_enable'] = 'Akismet Muligheder'; // cpg1.5
$lang_admin_php['comment_akismet_enable_description'] = 'Hvad skal ske hvis Akismet afviser en kommentar som spam?'; // cpg1.5
$lang_admin_php['comment_akismet_applicable_only'] = 'Valgmuligheder gælder kun hvis Akismet er slået til ved at indtaste en gældende  API nøgle'; // cpg1.5
$lang_admin_php['comment_akismet_enable_approval'] = 'Tillad kommentarer som ikke kan godkendes af Akismet, men marker dem som ikke godkendte'; // cpg1.5
$lang_admin_php['comment_akismet_drop_tell'] = 'Slet kommentar der fejler godkendelsen og fortæl forfatteren at den blev afvist'; // cpg1.5
$lang_admin_php['comment_akismet_drop_lie'] = 'Slet kommentar der fejler godkendelsen men fortæl forfatteren (spammer) at den er tilføjet'; // cpg1.5
$lang_admin_php['comment_akismet_api_key'] = 'Akismet API nøgle'; // cpg1.5
$lang_admin_php['comment_akismet_api_key_description'] = 'Efterlad tom for at slå Akismet fra'; // cpg1.5
$lang_admin_php['comment_akismet_group'] = 'Tilføj Akismet for kommentarer lavet af'; // cpg1.5
$lang_admin_php['comment_promote_registration'] = 'Bed gæster om at logge ind for at lave kommentarer'; // cpg1.5
$lang_admin_php['thumb_width'] = 'Maks dimension af en thumbnail (bredde, hvis du bruger "eksakt" i "Brug dimension")'; // cpg1.5
$lang_admin_php['thumb_use'] = 'Brug dimension'; // cpg1.5
$lang_admin_php['thumb_use_detail'] = '(Bredde eller højde eller maks aspekt for thumbnail)'; // cpg1.5
$lang_admin_php['thumb_height'] = 'Højde af en thumbnail'; // cpg1.5
$lang_admin_php['thumb_height_detail'] = '(gælder kun hvis du bruger &quot;eksakt&quot; i &quot;Brug dimension&quot;)'; // cpg1.5
$lang_admin_php['movie_audio_document'] = 'film, audio, dokument'; // cpg1.5
$lang_admin_php['thumb_pfx'] = 'Præfikset for thumbnails'; // cpg1.5
$lang_admin_php['enable_unsharp'] = 'Thumb Sharpening: slå Uskarp Mask til'; // cpg1.5
$lang_admin_php['unsharp_amount'] = 'Thumb Sharpening mængde'; // cpg1.5
$lang_admin_php['unsharp_radius'] = 'Thumb Sharpening radius'; // cpg1.5
$lang_admin_php['unsharp_threshold'] = 'Thumb Sharpening styrke'; // cpg1.5
$lang_admin_php['jpeg_qual'] = 'Kvalitet for JPEG filer'; // cpg1.5
$lang_admin_php['make_intermediate'] = 'Opret mellemstørrelse billeder'; // cpg1.5
$lang_admin_php['picture_use'] = 'Brug dimension'; // cpg1.5
$lang_admin_php['picture_use_detail'] = '(bredde eller højde er maks aspekt for en mellemstørrelse billede)'; // cpg1.5
$lang_admin_php['picture_use_thumb'] = 'Lige som thumbnail'; // cpg1.5
$lang_admin_php['picture_width'] = 'Maks bredde eller højde af en mellemstørrelse billed'; // cpg1.5
$lang_admin_php['max_upl_size'] = 'Maks størrelse for uploadede filer'; // cpg1.5
$lang_admin_php['kilobytes'] = 'KB'; // cpg1.5
$lang_admin_php['pixels'] = 'pixels'; // cpg1.5
$lang_admin_php['max_upl_width_height'] = 'Maks bredde eller højde for uploadede billeder'; // cpg1.5
$lang_admin_php['auto_resize'] = 'Auto justere billeder der er større end maks bredde eller højde'; // cpg1.5
$lang_admin_php['fullsize_padding_x'] = 'Horisontal grænse for fuld-størrelse pop-up'; // cpg1.5
$lang_admin_php['fullsize_padding_y'] = 'Vertikal grænse for fuld-størrelse pop-up'; // cpg1.5
$lang_admin_php['allow_private_albums'] = 'Albums kan være private'; // cpg1.5
$lang_admin_php['allow_private_albums_note'] = '(Note: hvis du skifter fra \'ja\' til \'nej\' vil alle nuværende privat albums blive synlig )'; // cpg1.5
$lang_admin_php['show_private'] = 'Vis privat album ikon til brugere der ikke er logget ind'; // cpg1.5
$lang_admin_php['forbiden_fname_char'] = 'Karakterer forbudt i filnavne'; // cpg1.5
$lang_admin_php['silly_safe_mode'] = 'Aktiver &quot;idiot sikker beskyttelse&quot;'; // cpg1.5
$lang_admin_php['allowed_img_types'] = 'Tilladte billedtyper'; // cpg1.5
$lang_admin_php['allowed_mov_types'] = 'Tilladte filmtyper'; // cpg1.5
$lang_admin_php['media_autostart'] = 'Film afspilning autostart'; // cpg1.5
$lang_admin_php['allowed_snd_types'] = 'Tilladte lydtyper'; // cpg1.5
$lang_admin_php['allowed_doc_types'] = 'Tilladte dokumenttyper'; // cpg1.5
$lang_admin_php['thumb_method'] = 'Metode for ændring af billeder'; // cpg1.5
$lang_admin_php['impath'] = 'Stil til ImageMagick \'koverterings\' værktøj'; // cpg1.5
$lang_admin_php['impath_example'] = '(eg. /usr/bin/)'; // cpg1.5
$lang_admin_php['im_options'] = 'Ekstra kommandolinie muligheder for ImageMagick'; // cpg1.5
$lang_admin_php['read_exif_data'] = 'Læs EXIF data fra JPEG filer'; // cpg1.5
$lang_admin_php['read_iptc_data'] = 'Læs IPTC data fra JPEG filer'; // cpg1.5
$lang_admin_php['fullpath'] = 'Sti til album mappe'; // cpg1.5
$lang_admin_php['userpics'] = 'Sti til mappe til brugers filer'; // cpg1.5
$lang_admin_php['normal_pfx'] = 'Præfiks for mellemstørrelse billeder'; // cpg1.5
$lang_admin_php['default_dir_mode'] = 'Standard opsætning for mapper'; // cpg1.5
$lang_admin_php['default_file_mode'] = 'Standard opsætning for filer'; // cpg1.5
$lang_admin_php['enable_watermark'] = 'Vandmærkebilleder'; // cpg1.5
$lang_admin_php['enable_thumb_watermark'] = 'Vandmærke brugerspecifik thumbnails'; // cpg1.5
$lang_admin_php['where_put_watermark'] = 'Hvor skal vandmærke placeres'; // cpg1.5
$lang_admin_php['which_files_to_watermark'] = 'Hvilke filer skal vandmærkes'; // cpg1.5
$lang_admin_php['watermark_file'] = 'Hvilken fil skal bruges til at vandmærke'; // cpg1.5
$lang_admin_php['watermark_transparency'] = 'Gennemsigtighed for hele billed'; // cpg1.5
$lang_admin_php['zero_2_hundred'] = '0-100'; // cpg1.5
$lang_admin_php['reduce_watermark'] = 'Minimer vandmærket hvis bredde af billedet er smaller end den indtastede værdi. Dette er 100% referense punktet. Ændring af størrelse af vandmærket er lineær (0 for at slå fra)'; // cpg1.5
$lang_admin_php['watermark_transparency_featherx'] = 'Sæt farve transparent x'; // cpg1.5
$lang_admin_php['watermark_transparency_feathery'] = 'Sæt farve transparent y'; // cpg1.5
$lang_admin_php['gd2_only'] = 'kun GD2'; // cpg1.5
$lang_admin_php['allow_user_registration'] = 'Tillad ny brugerregistrering'; // cpg1.5
$lang_admin_php['global_registration_pw'] = 'Globalt kodeord til registrering'; // cpg1.5
$lang_admin_php['user_registration_disclaimer'] = 'Vis ansvarsfraskrivelse på bruger registreringen'; // cpg1.5
$lang_admin_php['registration_captcha'] = 'Vis Captcha (Visual Bekrætigelse) på registrerings siden'; // cpg1.5
$lang_admin_php['reg_requires_valid_email'] = 'Brugerregistrering kræver e-mail kontrol'; // cpg1.5
$lang_admin_php['reg_notify_admin_email'] = 'Adviser admin om brugerregistrering gennem e-mail'; // cpg1.5
$lang_admin_php['admin_activation'] = 'Admin aktivering af registreringer'; // cpg1.5
$lang_admin_php['personal_album_on_registration'] = 'Opret brugeralbum i personlig galleri under registreringen'; // cpg1.5
$lang_admin_php['allow_unlogged_access'] = 'Tillad adgang for bruger der ikke er logget ind (gæst eller anonym)'; // cpg1.5
$lang_admin_php['thumbnail_intermediate_full'] = 'thumbnail, mellemstørrelse, og fuldstørrelse billede'; // cpg1.5
$lang_admin_php['thumbnail_intermediate'] = 'thumbnail og mellemstørrelse billede'; // cpg1.5
$lang_admin_php['thumbnail_only'] = 'kun thumbnail'; // cpg1.5
$lang_admin_php['upload_mechanism'] = 'standard upload metode'; // cpg1.5
$lang_admin_php['upload_swf'] = 'advanceret - flere filer ad gangen, Flash-dreven (anbefales)'; // cpg1.5
$lang_admin_php['upload_single'] = 'simpel - en fil ad gangen'; // cpg1.5
$lang_admin_php['allow_user_upload_choice'] = 'Tillad brugere at vælge upload metode'; // cpg1.5
$lang_admin_php['allow_duplicate_emails_addr'] = 'Tillad to bruger at have samme e-mail adresse'; // cpg1.5
$lang_admin_php['upl_notify_admin_email'] = 'Adviser admin om brugerupload afventer godkendelse'; // cpg1.5
$lang_admin_php['allow_memberlist'] = 'Tillad bruger der er logget ind at se medlemsliste'; // cpg1.5
$lang_admin_php['allow_email_change'] = 'Tillad brugere at ændre e-mail adresse i deres profil'; // cpg1.5
$lang_admin_php['allow_user_account_delete'] = 'Tillad brugere at slette deres egen brugerkonto'; // cpg1.5
$lang_admin_php['users_can_edit_pics'] = 'Tillad brugere at beholde kontrol over deres billeder i offentlige gallerier'; // cpg1.5
$lang_admin_php['allow_user_move_album'] = 'Tillad brugere at flytte deres albums fra/til tilladte kategorier'; // cpg1.5
$lang_admin_php['allow_user_album_keyword'] = 'Tillad brugere at tilføje album nøgleord'; // cpg1.5
$lang_admin_php['allow_user_edit_after_cat_close'] = 'Tillad brugere at ændre deres albums når de er i låste kategorier'; // cpg1.5
$lang_admin_php['login_method_username'] = 'Brugernavn'; // cpg1.5
$lang_admin_php['login_method_email'] = 'E-mail addesse'; // cpg1.5
$lang_admin_php['login_method_both'] = 'Begge'; // cpg1.5
$lang_admin_php['login_method'] = 'Hvordan ønsker du at brugerne de kan logge ind'; // cpg1.5
$lang_admin_php['login_threshold'] = 'Antal af fejlede login forsøg indtil midlertidig udelukkelse'; // cpg1.5
$lang_admin_php['login_threshold_detail'] = '(for at undgå brute force angreb)'; // cpg1.5
$lang_admin_php['login_expiry'] = 'Varighed af midlertidig udelukkelse efter fejlede logins'; // cpg1.5
$lang_admin_php['minutes'] = 'minuter'; // cpg1.5
$lang_admin_php['report_post'] = 'Aktiver Adviser til Admin'; // cpg1.5
$lang_admin_php['user_profile1_name'] = 'Profil 1 navn'; // cpg1.5
$lang_admin_php['user_profile2_name'] = 'Profil 2 navn'; // cpg1.5
$lang_admin_php['user_profile3_name'] = 'Profil 3 navn'; // cpg1.5
$lang_admin_php['user_profile4_name'] = 'Profil 4 navn'; // cpg1.5
$lang_admin_php['user_profile5_name'] = 'Profil 5 navn'; // cpg1.5
$lang_admin_php['user_profile6_name'] = 'Profil 6 navn'; // cpg1.5
$lang_admin_php['user_field1_name'] = 'Felt 1 navn'; // cpg1.5
$lang_admin_php['user_field2_name'] = 'Felt 2 navn'; // cpg1.5
$lang_admin_php['user_field3_name'] = 'Felt 3 navn'; // cpg1.5
$lang_admin_php['user_field4_name'] = 'Felt 4 navn'; // cpg1.5
$lang_admin_php['cookie_name'] = 'Cookie navn'; // cpg1.5
$lang_admin_php['cookie_path'] = 'Cookie sti'; // cpg1.5
$lang_admin_php['smtp_host'] = 'SMTP Host (hvis tom, vil sendmail blive brugt)'; // cpg1.5
$lang_admin_php['smtp_username'] = 'SMTP Brugernavn'; // cpg1.5
$lang_admin_php['smtp_password'] = 'SMTP Kodeord'; // cpg1.5
$lang_admin_php['log_mode'] = 'Lognings metode'; // cpg1.5
$lang_admin_php['log_mode_details'] = 'Alle logfiler er skrevet på Engelsk.'; // cpg1.5
$lang_admin_php['log_ecards'] = 'Log e-kort'; // cpg1.5
$lang_admin_php['log_ecards_detail'] = 'Note: logning kan have lovmæssig følger. Brugerne bør informeres ved registrering at e-kort bliver logget. Det anbefales at vise en seperat side med privatlivspolitik.'; // cpg1.5
$lang_admin_php['vote_details'] = 'Behold detaljeret stemme statistik'; // cpg1.5
$lang_admin_php['hit_details'] = 'Behold detaljeret hit statestik'; // cpg1.5
$lang_admin_php['display_stats_on_index'] = 'Vis statestik på indeks side'; // cpg1.5
$lang_admin_php['count_file_hits'] = 'Tæl fil visninger'; // cpg1.5
$lang_admin_php['count_album_hits'] = 'Tæl album visninger'; // cpg1.5
$lang_admin_php['count_admin_hits'] = 'Tæl admin visninger'; // cpg1.5
$lang_admin_php['debug_mode'] = 'Aktiver debug tilstand'; // cpg1.5
$lang_admin_php['debug_notice'] = 'Vis beskeder i debug tilstand'; // cpg1.5
$lang_admin_php['offline'] = 'Galleriet er lukket'; // cpg1.5
$lang_admin_php['display_coppermine_news'] = 'Vis nyheder fra coppermine-gallery.net'; // cpg1.5
$lang_admin_php['display_coppermine_detail'] = 'Vil kun blive vist for admin'; // cpg1.5
$lang_admin_php['config_setting_invalid'] = 'Værdien du har sat for &laquo;%s&raquo; er forkert, ret det venligst.'; // cpg1.5
$lang_admin_php['config_setting_ok'] = 'Din opsætning for &laquo;%s&raquo; er blevet gemt.'; // cpg1.5
$lang_admin_php['contact_form_settings'] = 'Kontaktformular indstillinger'; // cpg1.5
$lang_admin_php['contact_form_guest_enable'] = 'Vis kontaktformular til anonyme besøgende (gæster)'; // cpg1.5
$lang_admin_php['contact_form_registered_enable'] = 'Vis kontaktformular til registrerede bruger'; // cpg1.5
$lang_admin_php['with_captcha'] = 'med captcha'; // cpg1.5
$lang_admin_php['without_captcha'] = 'uden captcha'; // cpg1.5
$lang_admin_php['optional'] = 'valgfri'; // cpg1.5
$lang_admin_php['mandatory'] = 'krævet'; // cpg1.5
$lang_admin_php['contact_form_guest_name_field'] = 'Vis gæster feltet Afsendersnavn'; // cpg1.5
$lang_admin_php['contact_form_guest_email_field'] = 'Vis gæster feltet e-mail afsender'; // cpg1.5
$lang_admin_php['contact_form_subject_field'] = 'Vis Emne feltet'; // cpg1.5
$lang_admin_php['contact_form_subject_content'] = 'Emnelinien i e-mails genereret af kontaktformular'; // cpg1.5
$lang_admin_php['contact_form_sender_email'] = 'Brug afsenders e-mail adresse som &quot;fra&quot; adresse'; // cpg1.5
$lang_admin_php['allow_no_link'] = 'tillad, men vis ikke link'; // cpg1.5
$lang_admin_php['allow_show_link'] = 'tillad og fremhæv det ved at vise et link'; // cpg1.5
$lang_admin_php['display_sidebar_user'] = 'Sidebar for registrerede brugere'; // cpg1.5
$lang_admin_php['display_sidebar_guest'] = 'Sidebar for gæster'; // cpg1.5
$lang_admin_php['do_not_change'] = 'Lav IKKE dette om medmindre at du er HELT sikker på hvad du gør!'; // cpg1.5
$lang_admin_php['reset_to_default'] = 'Nulstil til standard opsætning'; // cpg1.5
$lang_admin_php['no_change_needed'] = 'Ingen ændringer nødvendig, konfiguration er allerede sat til standard'; // cpg1.5
$lang_admin_php['enabled'] = 'aktiveret'; // cpg1.5
$lang_admin_php['disabled'] = 'deaktiveret'; // cpg1.5
$lang_admin_php['none'] = 'ingen'; // cpg1.5
$lang_admin_php['warning_change'] = 'Ved at ændre denne indstilling, påvirkes kun de filer der tilføjes fra nu. Så det er bedst ikke at ændre denne indstilling hvis der allerede er filer i galleriet. Du kan, selvfølgelig, ændre de eksisterende billeder med "admin værktøjerne" (ændre størrelse af billeder)" værktøjet fra admin menuen.'; // cpg1.5
$lang_admin_php['warning_exist'] = 'Disse indstilliger må ikke ændres hvis du allerede har filer i databasen.'; // cpg1.5
$lang_admin_php['warning_dont_submit'] = 'Hvis du ikke er sikker på hvad denne ændring gør så lad vær med at sende formularen, men læs istedet dokumentationen først.'; // cpg1.5 // js-alert
$lang_admin_php['menu_only'] = 'kun menuen'; // cpg1.5
$lang_admin_php['everywhere'] = 'over alt'; // cpg1.5
$lang_admin_php['manage_languages'] = 'Administrer sprog'; // cpg1.5
$lang_admin_php['form_token_lifetime'] = 'Formular token levetid'; // cpg1.5
$lang_admin_php['seconds'] = 'Sekunder'; // cpg1.5
$lang_admin_php['display_reset_boxes_in_config'] = 'Vis nulstil boks i konfig'; // cpg1.5
$lang_admin_php['upd_not_needed'] = 'Opdatering ikke nødvendigt.'; // cpg 1.5
}


// ------------------------------------------------------------------------- //
// File db_ecard.php
// ------------------------------------------------------------------------- //
if (defined('DB_ECARD_PHP')) {
$lang_db_ecard_php['title'] = 'Send E-kort';
$lang_db_ecard_php['ecard_sender'] = 'Afsender';
$lang_db_ecard_php['ecard_recipient'] = 'Modtager';
$lang_db_ecard_php['ecard_date'] = 'Dato';
$lang_db_ecard_php['ecard_display'] = 'Vis e-kort';
$lang_db_ecard_php['ecard_name'] = 'Navn';
$lang_db_ecard_php['ecard_email'] = 'E-mail';
$lang_db_ecard_php['ecard_ip'] = 'IP';
$lang_db_ecard_php['ecard_ascending'] = 'stigenden';
$lang_db_ecard_php['ecard_descending'] = 'faldende';
$lang_db_ecard_php['ecard_sorted'] = 'Sorteret';
$lang_db_ecard_php['ecard_by_date'] = 'efter dato';
$lang_db_ecard_php['ecard_by_sender_name'] = 'efter afsenders navn';
$lang_db_ecard_php['ecard_by_sender_email'] = 'efter afsenders e-mail';
$lang_db_ecard_php['ecard_by_sender_ip'] = 'efter afsenders IP adresse';
$lang_db_ecard_php['ecard_by_recipient_name'] = 'efter modtagers navn';
$lang_db_ecard_php['ecard_by_recipient_email'] = 'efter modtagers e-mail';
$lang_db_ecard_php['ecard_number'] = 'Viser e-korts %s til %s af %s';
$lang_db_ecard_php['ecard_goto_page'] = 'gå til side';
$lang_db_ecard_php['ecard_records_per_page'] = 'E-kort pr side';
$lang_db_ecard_php['check_all'] = 'Marker alle';
$lang_db_ecard_php['uncheck_all'] = 'Fjern alle markeringer';
$lang_db_ecard_php['ecards_delete_selected'] = 'Slet valgte e-kort';
$lang_db_ecard_php['ecards_delete_confirm'] = 'Er du sikker du vil slette dette E-kort? Marker afkrydsningsboks!';
$lang_db_ecard_php['ecards_delete_sure'] = 'Jeg er sikker';
$lang_db_ecard_php['invalid_data'] = 'Oplysningerne i e-kortet du prøver at åbne er ødelagt af din mail klient. Tjek at linket er hel.';
}

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //
if (defined('DB_INPUT_PHP')) {
$lang_db_input_php['empty_name_or_com'] = 'Du mangler at indtaste dit navn og kommentar';
$lang_db_input_php['com_added'] = 'Din kommentar blev tilføjet'; // cpg1.5
$lang_db_input_php['alb_need_title'] = 'Du skal indtaste en titel til albumet!';
$lang_db_input_php['no_udp_needed'] = 'Ingen opdateringen nødvendigt.';
$lang_db_input_php['alb_updated'] = 'Albumet blev opdateret';
$lang_db_input_php['unknown_album'] = 'Valgte album findes ikke eller du har ikke ret til at uploade til dette album';
$lang_db_input_php['no_pic_uploaded'] = 'Ingen filer blev uploadet!<br /> Hvis du har udvalgt filer til upload, tjek at serveren tillader fil uploads...';
$lang_db_input_php['err_mkdir'] = 'Fejlede ved oprettelse af mappe %s!';
$lang_db_input_php['dest_dir_ro'] = 'Modtage mappe %s er ikke skrivebar for server!';
$lang_db_input_php['err_move'] = 'Umulig at flytte %s til %s!';
$lang_db_input_php['err_fsize_too_large'] = 'Størrelsen af filen du har uploadet er for stor (maksimum tilladt er %s x %s)!';
$lang_db_input_php['err_imgsize_too_large'] = 'Størrelsen af filen du har uploadet er for stor (maksimum tilladt er %s KB)!';
$lang_db_input_php['err_invalid_img'] = 'Filen du har uploadet er ikke et gyldig billed!';
$lang_db_input_php['allowed_img_types'] = 'Du kan kun uploade %s billeder.';
$lang_db_input_php['err_insert_pic'] = 'Filen \'%s\' kan ikke indsættes i albumet';
$lang_db_input_php['upload_success'] = 'Din fil blev uploadet korrekt.<br />Den vil blive synligt når en admin har godkendt den.';
$lang_db_input_php['notify_admin_email_subject'] = '%s - Upload advisering';
$lang_db_input_php['notify_admin_email_body'] = 'Et billed blev uploadet af %s som kræver din godkendelse. Besøg %s';
$lang_db_input_php['info'] = 'Information';
$lang_db_input_php['com_updated'] = 'Kommentar opdateret'; // cpg1.5
$lang_db_input_php['alb_updated'] = 'Album opdateret';
$lang_db_input_php['err_comment_empty'] = 'Din kommentar er tom!';
$lang_db_input_php['err_invalid_fext'] = 'Kun filer med følgende endelser accepteres:'; // js-alert
$lang_db_input_php['no_flood'] = 'Beklager men du er allerede forfatter af seneste kommentar postet for denne fil<br />Redigere kommentaren du har postet hvis du vil ændre den';
$lang_db_input_php['redirect_msg'] = 'Du bliver videresendt.<br /><br />Klik \'FORTSÆT\' hvis siden ikke genindlæses automatisk';
$lang_db_input_php['upl_success'] = 'Din fil blev tilføjet korrekt';
$lang_db_input_php['email_comment_subject'] = 'Kommentar postet på Coppermine Photo Gallery';
$lang_db_input_php['email_comment_body'] = 'Nogen har postet en kommentar på dit galleri. Det er den her';
$lang_db_input_php['album_not_selected'] = 'Album ikke valgt';
$lang_db_input_php['com_author_error'] = 'En registreret bruger, bruger allerede dette brugernavn. Login eller vælg et andet';
}

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //
if (defined('DELETE_PHP')) {
$lang_delete_php['orig_pic'] = 'original billede'; // cpg1.5
$lang_delete_php['fs_pic'] = 'fuldstørrelse billede';
$lang_delete_php['del_success'] = 'korrekt slettet';
$lang_delete_php['ns_pic'] = 'normalstørrelse billede';
$lang_delete_php['err_del'] = 'kan ikke slettes';
$lang_delete_php['thumb_pic'] = 'thumbnail';
$lang_delete_php['comment'] = 'kommentar';
$lang_delete_php['im_in_alb'] = 'billede i album';
$lang_delete_php['alb_del_success'] = 'Album &laquo;%s&raquo; slettet';
$lang_delete_php['alb_mgr'] = 'Album Administrator';
$lang_delete_php['err_invalid_data'] = 'Ubrugelig data modtaget i \'%s\'';
$lang_delete_php['create_alb'] = 'Opret album \'%s\'';
$lang_delete_php['update_alb'] = 'Opdaterer album \'%s\' med titel \'%s\' og indeks \'%s\'';
$lang_delete_php['del_pic'] = 'Slet fil';
$lang_delete_php['del_alb'] = 'Slet album';
$lang_delete_php['del_user'] = 'Slet bruger';
$lang_delete_php['err_unknown_user'] = 'Den valgte bruger findes ikke!';
$lang_delete_php['err_empty_groups'] = 'Der er ingen gruppetabel, eller gruppetabelen er tom!';
$lang_delete_php['comment_deleted'] = 'Kommentar blev korrekt slettet';
$lang_delete_php['npic'] = 'Billede';
$lang_delete_php['pic_mgr'] = 'Billed Administrator';
$lang_delete_php['update_pic'] = 'Opdaterer billed \'%s\' med filnavn \'%s\' og indeks \'%s\'';
$lang_delete_php['username'] = 'Brugernavn';
$lang_delete_php['anonymized_comments'] = '%s kommentar(er) anonymiseret';
$lang_delete_php['anonymized_uploads'] = '%s offentlig upload(s) anonymiseret';
$lang_delete_php['deleted_comments'] = '%s kommentar(er) slettet';
$lang_delete_php['deleted_uploads'] = '%s offentlig upload(s) slettet';
$lang_delete_php['user_deleted'] = 'bruger %s slettet';
$lang_delete_php['activate_user'] = 'Aktivere bruger';
$lang_delete_php['user_already_active'] = 'Konto er allerede aktiv';
$lang_delete_php['activated'] = 'Aktiveret';
$lang_delete_php['deactivate_user'] = 'Deaktiver bruger';
$lang_delete_php['user_already_inactive'] = 'Konto er allerede inaktiv';
$lang_delete_php['deactivated'] = 'Deaktiveret';
$lang_delete_php['reset_password'] = 'Nulstil kodeord';
$lang_delete_php['password_reset'] = 'Nulstil kodeord til %s';
$lang_delete_php['change_group'] = 'Ændre primær gruppe';
$lang_delete_php['change_group_to_group'] = 'Ændre fra %s til %s';
$lang_delete_php['add_group'] = 'Tilføj sekundær gruppe';
$lang_delete_php['add_group_to_group'] = 'Tilføj bruger %s til gruppe %s. Han er nu medlem af %s både primær og %s som sekundær Medlemsgruppe(r).';
$lang_delete_php['status'] = 'Status';
$lang_delete_php['updating_album'] = 'Opdaterer album '; // cpg1.5
$lang_delete_php['moved_picture_to_position'] = 'Flyttede billede %s til position %s'; // cpg1.5
}

// ------------------------------------------------------------------------- //
// File displayimage.php
// ------------------------------------------------------------------------- //
if (defined('DISPLAYIMAGE_PHP')){
$lang_display_image_php['confirm_del'] = 'Er du sikker på du vil SLETTE denne fil?\\nKommentarer vil også blive slettet.'; // js-alert
$lang_display_image_php['del_pic'] = 'Slet denne fil';
$lang_display_image_php['size'] = '%s x %s pixels';
$lang_display_image_php['views'] = '%s gange';
$lang_display_image_php['slideshow'] = 'Diasfremvisning';
$lang_display_image_php['stop_slideshow'] = 'Stop diasfremvisning';
$lang_display_image_php['view_fs'] = 'Klik for fuld størrelse';
$lang_display_image_php['edit_pic'] = 'Ret fil informationer';
$lang_display_image_php['crop_pic'] = 'Beskær og roter';
$lang_display_image_php['set_player'] = 'Skift afspiller';

$lang_picinfo['title'] = 'Fil informationer';
$lang_picinfo['Album name'] = 'Album navn';
$lang_picinfo['Rating'] = 'Karakter (%s stemmer)';
$lang_picinfo['Date Added'] = 'Dato for tilføjelse';
$lang_picinfo['Dimensions'] = 'Dimensioner';
$lang_picinfo['Displayed'] = 'Vist';
$lang_picinfo['URL'] = 'URL';
$lang_picinfo['Make'] = 'Fabrikat';
$lang_picinfo['Model'] = 'Model';
$lang_picinfo['DateTime'] = 'Dato Tid';
$lang_picinfo['ISOSpeedRatings'] = 'ISO';
$lang_picinfo['MaxApertureValue'] = 'Maks blænde';
$lang_picinfo['FocalLength'] = 'Fokus længde';
$lang_picinfo['Comment'] = 'Kommentar';
$lang_picinfo['addFav'] = 'Tilføj til Favoriter';
$lang_picinfo['addFavPhrase'] = 'Favoriter';
$lang_picinfo['remFav'] = 'Fjern fra Favoriter';
$lang_picinfo['iptcTitle'] = 'IPTC Titel';
$lang_picinfo['iptcCopyright'] = 'IPTC Copyright';
$lang_picinfo['iptcKeywords'] = 'IPTC Nøgleord';
$lang_picinfo['iptcCategory'] = 'IPTC Kategori';
$lang_picinfo['iptcSubCategories'] = 'IPTC Underkategorier';
$lang_picinfo['ColorSpace'] = 'Farverum';
$lang_picinfo['ExposureProgram'] = 'Eksponeringsprogram';
$lang_picinfo['Flash'] = 'Blitz';
$lang_picinfo['MeteringMode'] = 'Lysmålingsmetode';
$lang_picinfo['ExposureTime'] = 'Eksponerings tid';
$lang_picinfo['ExposureBiasValue'] = 'Exposure Bias';
$lang_picinfo['ImageDescription'] = 'Billede Beskrivelse';
$lang_picinfo['Orientation'] = 'Retning';
$lang_picinfo['xResolution'] = 'X Opløsning';
$lang_picinfo['yResolution'] = 'Y Opløsning';
$lang_picinfo['ResolutionUnit'] = 'Opløsningsenhed';
$lang_picinfo['Software'] = 'Software';
$lang_picinfo['YCbCrPositioning'] = 'YCbCrPosition';
$lang_picinfo['ExifOffset'] = 'EXIF Offset';
$lang_picinfo['IFD1Offset'] = 'IFD1 Offset';
$lang_picinfo['FNumber'] = 'FNumber';
$lang_picinfo['ExifVersion'] = 'EXIF Version';
$lang_picinfo['DateTimeOriginal'] = 'DatoTid Original';
$lang_picinfo['DateTimedigitized'] = 'DatoTid Digitaliseret';
$lang_picinfo['ComponentsConfiguration'] = 'Components Indstilling';
$lang_picinfo['CompressedBitsPerPixel'] = 'Komprimerede Bits Pr Pixel';
$lang_picinfo['LightSource'] = 'Lyskilde';
$lang_picinfo['ISOSetting'] = 'ISO Indstilling';
$lang_picinfo['ColorMode'] = 'Farvetilstand';
$lang_picinfo['Quality'] = 'Kvalitet';
$lang_picinfo['ImageSharpening'] = 'Billede Sharpening';
$lang_picinfo['FocusMode'] = 'Fokus tilstand';
$lang_picinfo['FlashSetting'] = 'Blitz indstilling';
$lang_picinfo['ISOSelection'] = 'ISO valg';
$lang_picinfo['ImageAdjustment'] = 'Billed justering';
$lang_picinfo['Adapter'] = 'Adapter';
$lang_picinfo['ManualFocusDistance'] = 'Manual Fokusafstand';
$lang_picinfo['DigitalZoom'] = 'Digital Zoom';
$lang_picinfo['AFFocusPosition'] = 'AF Fokus Position';
$lang_picinfo['Saturation'] = 'Mætning';
$lang_picinfo['NoiseReduction'] = 'Støjreduktion';
$lang_picinfo['FlashPixVersion'] = 'FlashPix Version';
$lang_picinfo['ExifImageWidth'] = 'EXIF Billedbredde';
$lang_picinfo['ExifImageHeight'] = 'EXIF Billedhøjde';
$lang_picinfo['ExifInteroperabilityOffset'] = 'EXIF Interoperability Offset';
$lang_picinfo['FileSource'] = 'Filkilde';
$lang_picinfo['SceneType'] = 'Scenetype';
$lang_picinfo['CustomerRender'] = 'Customer Render';
$lang_picinfo['ExposureMode'] = 'Eksponerings tilstand';
$lang_picinfo['WhiteBalance'] = 'Hvidbalance';
$lang_picinfo['DigitalZoomRatio'] = 'Digital Zoom forhold';
$lang_picinfo['SceneCaptureMode'] = 'Scene optagelses tilstand';
$lang_picinfo['GainControl'] = 'Tage kontrol';
$lang_picinfo['Contrast'] = 'Kontrast';
$lang_picinfo['Sharpness'] = 'Skarphed';
$lang_picinfo['ManageExifDisplay'] = 'Administrer EXIF Display';
$lang_picinfo['success'] = 'Information opdateret.';
$lang_picinfo['show_details'] = 'Vis detaljer'; // cpg1.5
$lang_picinfo['hide_details'] = 'Skjul Detaljer'; // cpg1.5
$lang_picinfo['download_URL'] = 'Direkte Link';
$lang_picinfo['movie_player'] = 'Afspil filen i din standardafspiller';

$lang_display_comments['comment_x_to_y_of_z'] = '%d til %d fra %d'; // cpg1.5
$lang_display_comments['page'] = 'Side'; // cpg1.5
$lang_display_comments['edit_title'] = 'Rediger denne kommentar';
$lang_display_comments['delete_title'] = 'Slet denne kommentar'; // cpg1.5
$lang_display_comments['confirm_delete'] = 'Er du sikker på du vil slette denne kommentar?'; // js-alert
$lang_display_comments['add_your_comment'] = 'Tilføj din kommentar';
$lang_display_comments['name'] = 'Navn';
$lang_display_comments['comment'] = 'Kommentar';
$lang_display_comments['your_name'] = 'Dit navn';
$lang_display_comments['report_comment_title'] = 'Rapporter denne kommentar til admin';
$lang_display_comments['pending_approval'] = 'Kommentar vil først være synlig efter godkendelse'; // cpg1.5
$lang_display_comments['unapproved_comment'] = 'Ikke godkendt kommentar'; // cpg1.5
$lang_display_comments['pending_approval_message'] = 'Nogen har postet en kommentar her. Den vil først være synlig efter admin godkendelse.'; // cpg1.5
$lang_display_comments['approve'] = 'Godkend kommentar'; // cpg1.5
$lang_display_comments['disapprove'] = 'Marker kommentar som ikke godkendt'; // cpg1.5
$lang_display_comments['log_in_to_comment'] = 'Anonyme kommentarer er ikke tilladt. %sLog ind%s for at poste din kommentar'; // cpg1.5 // do not translate the %s placeholders - they will be used as wrappers for the link (<a>)
$lang_display_comments['default_username_message'] = 'Vær venlig at tilføje dit navn til kommentar'; // cpg1.5
$lang_display_comments['comment_rejected'] = 'Din kommentar er blevet afvist'; // cpg1.5

$lang_fullsize_popup['click_to_close'] = 'Klik billede for at lukke dette vindue';
$lang_fullsize_popup['close_window'] = 'luk vinduet'; // cpg1.5
}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP')) {
$lang_ecard_php['title'] = 'Send et e-kort';
$lang_ecard_php['invalid_email'] = 'Advarsel: ugyldig e-mail adresse'; // cpg1.5
$lang_ecard_php['ecard_title'] = 'Et e-kort fra %s til dig';
$lang_ecard_php['error_not_image'] = 'Kun billeder kan sendes som E-kort.'; // cpg1.5
$lang_ecard_php['error_not_image_flash'] = 'Kun billeder og flash filer kan sendes som E-kort.'; // cpg1.5
$lang_ecard_php['view_ecard'] = 'Alternativt link hvis e-kort ikke vises korrekt';
$lang_ecard_php['view_ecard_plaintext'] = 'For at vise e-kort, kopier og indsæt url i din browser\'s adresse felt:';
$lang_ecard_php['view_more_pics'] = 'Se flere billeder!';
$lang_ecard_php['send_success'] = 'Dit e-kort blev sendt';
$lang_ecard_php['send_failed'] = 'Beklager at serveren ikke kan sende dit e-kort...';
$lang_ecard_php['from'] = 'Fra';
$lang_ecard_php['your_name'] = 'Dit navn';
$lang_ecard_php['your_email'] = 'Din e-mail adresse';
$lang_ecard_php['to'] = 'Til';
$lang_ecard_php['rcpt_name'] = 'Modtagerens navn';
$lang_ecard_php['rcpt_email'] = 'Modtagerens e-mail adresse';
$lang_ecard_php['greetings'] = 'Overskrift';
$lang_ecard_php['message'] = 'Besked';
$lang_ecard_php['ecards_footer'] = 'Sendt af %s fra IP %s ved %s (Galleri tid)';
$lang_ecard_php['preview'] = 'Preview af E-kort';
$lang_ecard_php['preview_button'] = 'Preview';
$lang_ecard_php['submit_button'] = 'Send e-kort';
$lang_ecard_php['preview_view_ecard'] = 'Dette vil være det alternative link til e-kortet når det er genereret. Det virker ikke som preview.';
}

// ------------------------------------------------------------------------- //
// File report_file.php
// ------------------------------------------------------------------------- //

if (defined('REPORT_FILE_PHP')) {
$lang_report_php['title'] = 'Anmeld til administrator';
$lang_report_php['invalid_email'] = '<strong>Advarsel</strong> : forkert e-mail adresse!';
$lang_report_php['report_subject'] = 'En anmeldelse fra %s på et galleri %s';
$lang_report_php['view_report'] = 'Alternativ link hvis anmeldelse ikke vises korrekt';
$lang_report_php['view_report_plaintext'] = 'For at vise anmeldelse, kopiere denne url til din browser adresse felt:';
$lang_report_php['view_more_pics'] = 'Galleri';
$lang_report_php['send_success'] = 'Din anmeldelse blev sendt';
$lang_report_php['send_failed'] = 'Beklager men serveren kan ikke sende din anmeldelse...';
$lang_report_php['from'] = 'Fra';
$lang_report_php['your_name'] = 'Dit navn';
$lang_report_php['your_email'] = 'Din e-mail adresse';
$lang_report_php['to'] = 'Til';
$lang_report_php['administrator'] = 'Administrator/Moderator';
$lang_report_php['subject'] = 'Emne';
$lang_report_php['comment_field_name'] = 'Anmeldelse angående kommentar af "%s"';
$lang_report_php['reason'] = 'Årsag';
$lang_report_php['message'] = 'Besked';
$lang_report_php['report_footer'] = 'Sendt af %s fra IP %s ved %s (Galleri tid)';
$lang_report_php['obscene'] = 'uanstændig';
$lang_report_php['offensive'] = 'anstødelig';
$lang_report_php['misplaced'] = 'udenfor-emne/malplaceret';
$lang_report_php['missing'] = 'manglende';
$lang_report_php['issue'] = 'fejl/kan ikke vises';
$lang_report_php['other'] = 'andet';
$lang_report_php['refers_to'] = 'Filanmeldelse henviser til';
$lang_report_php['reasons_list_heading'] = 'årsag(er) til anmeldelsen:';
$lang_report_php['no_reason_given'] = 'ingen årsag angivet';
$lang_report_php['go_comment'] = 'Gå til kommentar';
$lang_report_php['view_comment'] = 'Vis fuld anmeldelse med kommentar';
$lang_report_php['type_file'] = 'fil';
$lang_report_php['type_comment'] = 'kommentar';
$lang_report_php['invalid_data'] = 'Oplysningerne fra anmeldelsen som du prøver og få vist er ødelagt af din e-mail klient. Tjek at linket er komplet.';
}

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) {
$lang_editpics_php['pic_info'] = 'Fil info';
$lang_editpics_php['desc'] = 'Beskrivelse';
$lang_editpics_php['approval'] = 'Godkendelse'; //cpg 1.5
$lang_editpics_php['approved'] = 'Godkendt'; // cpg 1.5
$lang_editpics_php['unapproved'] = 'Ikke godkendt'; // cpg 1.5
$lang_editpics_php['new_keyword'] = 'Nyt nøgleord';
$lang_editpics_php['new_keywords'] = 'Nyt nøgleord fundet';
$lang_editpics_php['existing_keyword'] = 'Eksisterende nøgleord';
$lang_editpics_php['pic_info_str'] = '%s &tid; %s - %s KB - %s vist - %s stemmer';
$lang_editpics_php['approve'] = 'Godkend fil';
$lang_editpics_php['postpone_app'] = 'Udsæt godkendelse';
$lang_editpics_php['del_pic'] = 'Slet fil';
$lang_editpics_php['del_all'] = 'Slet alle filer';
$lang_editpics_php['read_exif'] = 'Læs EXIF info igen';
$lang_editpics_php['reset_view_count'] = 'Nulstil vis tæller';
$lang_editpics_php['reset_all_view_count'] = 'Nulstil ALLE vis tæller';
$lang_editpics_php['reset_votes'] = 'Nulstil stemmer';
$lang_editpics_php['reset_all_votes'] = 'Nulstil ALLE stemmer';
$lang_editpics_php['del_comm'] = 'Slet kommentarer';
$lang_editpics_php['del_all_comm'] = 'Slet ALLE kommentarer';
$lang_editpics_php['upl_approval'] = 'Upload godkendelse';
$lang_editpics_php['edit_pics'] = 'Rediger filer';
$lang_editpics_php['edit_pic'] = 'Rediger fil'; // cpg 1.5
$lang_editpics_php['see_next'] = 'Se de næste filer';
$lang_editpics_php['see_prev'] = 'Se forrige filer';
$lang_editpics_php['n_pic'] = '%s filer';
$lang_editpics_php['n_of_pic_to_disp'] = 'Antal filer at vise';
$lang_editpics_php['crop_title'] = 'Coppermine Billed Editor';
$lang_editpics_php['preview'] = 'Preview';
$lang_editpics_php['save'] = 'Gem billede';
$lang_editpics_php['save_thumb'] = 'Gem som thumbnail';
$lang_editpics_php['gallery_icon'] = 'Gør dette til mit ikon';
$lang_editpics_php['sel_on_img'] = 'Hele billedet skal vælges!'; // js-alert
$lang_editpics_php['album_properties'] = 'Album egenskaber';
$lang_editpics_php['parent_category'] = 'Overliggende kategori';
$lang_editpics_php['thumbnail_view'] = 'Thumbnail visning';
$lang_editpics_php['select_unselect'] = 'vælg/fravælg alle';
$lang_editpics_php['file_exists'] = 'Destinations fil \'%s\' findes allerede.';
$lang_editpics_php['rename_failed'] = 'Omdøbning af \'%s\' til \'%s\'.';
$lang_editpics_php['src_file_missing'] = 'Original fil \'%s\' mangler.';
$lang_editpics_php['mime_conv'] = 'Kan ikke konvertere filen fra \'%s\' til \'%s\'';
$lang_editpics_php['forb_ext'] = 'Forbudt filendelse.';
$lang_editpics_php['error_editor_class'] = 'Redigerings klasse til at ændre størrelse ikke implementeret'; // cpg 1.5
$lang_editpics_php['error_document_size'] = 'Dokument har ingen bredde eller højde'; // cpg 1.5 // js-alert
$lang_editpics_php['success_picture'] = 'Billed gemt korrekt - du kan %sclose%s dette vindue nu'; // cpg1.5 // do not translate "%s" here
$lang_editpics_php['success_thumb'] = 'Thumbnail gemt korrekt - du kan %sclose%s dette vindue nu'; // cpg1.5 // do not translate "%s" here
$lang_editpics_php['rotate'] = 'Rotere'; // cpg 1.5
$lang_editpics_php['mirror'] = 'Spejlvend'; // cpg 1.5
$lang_editpics_php['scale'] = 'Skalere'; // cpg 1.5
$lang_editpics_php['new_width'] = 'Ny bredde'; // cpg 1.5
$lang_editpics_php['new_height'] = 'Ny højde'; // cpg 1.5
$lang_editpics_php['enable_clipping'] = 'Aktivere beskæring, gælder for beskær'; // cpg 1.5
$lang_editpics_php['jpeg_quality'] = 'JPEG Output Kvalitet'; // cpg 1.5
$lang_editpics_php['or'] = 'ELLER'; // cpg 1.5
$lang_editpics_php['approve_pic'] = 'Godkend fil'; // cpg 1.5
$lang_editpics_php['approve_all'] = 'Godkend ALLE filer'; // cpg 1.5
$lang_editpics_php['error_empty'] = 'Album er tomt'; // cpg1.5
$lang_editpics_php['error_approval_empty'] = 'Ikke flere billeder til godkendelse'; // cpg1.5
$lang_editpics_php['error_linked_only'] = 'Album indholde kun linket filer, hvilket ikke kan redigeres her'; // cpg1.5
$lang_editpics_php['note_approve_public'] = 'Filer flyttet til en offentlig album skal godkendes af en admin.'; // cpg1.5
$lang_editpics_php['note_approve_private'] = 'Filer flyttet til et privat album skal godkendes af en admin.' ; // cpg1.5
$lang_editpics_php['note_edit_control'] = 'Filer flyttet til en offentlig album kan ikke redigeres.'; // cpg1.5
$lang_editpics_php['confirm_move'] = 'Er du sikker på, at du vil flytte filen?'; // cpg1.5 //js-alert
$lang_editpics_php['success_changes'] = 'Ændringer korrekt gemt'; // cpg1.5
}

// ------------------------------------------------------------------------- //
// File forgot_passwd.php
// ------------------------------------------------------------------------- //

if (defined('FORGOT_PASSWD_PHP')) {
$lang_forgot_passwd_php['forgot_passwd'] = 'Glemt kodeord';
$lang_forgot_passwd_php['err_already_logged_in'] = 'Du er allerede logget ind!';
$lang_forgot_passwd_php['enter_email'] = 'Indtast din e-mail adresse';
$lang_forgot_passwd_php['submit'] = 'send';
$lang_forgot_passwd_php['illegal_session'] = 'Glemt kodeord session invalid eller udløbet.';
$lang_forgot_passwd_php['failed_sending_email'] = 'E-mail med glemt kodeord kan ikke sendes!';
$lang_forgot_passwd_php['email_sent'] = 'En e-mail med dit brugernavn og nyt kodeord er sendt %s';
$lang_forgot_passwd_php['verify_email_sent'] = 'E-mail er sendt %s. Tjek venligst din E-mail for at afslutte processen.';
$lang_forgot_passwd_php['err_unk_user'] = 'Valgte bruger findes ikke!';
$lang_forgot_passwd_php['account_verify_subject'] = '%s - Anmodning om nyt kodeord';
$lang_forgot_passwd_php['passwd_reset_subject'] = '%s - Dit nye kodeord';
$lang_forgot_passwd_php['account_verify_email'] = <<< EOT
Du har anmodet om et nyt kodeord. Hvis du fortsat vil anmode om et nyt kodeord, klik på følgende link:

<a href="{VERIFY_LINK}">{VERIFY_LINK}</a>


Mvh,

Administrator af {SITE_NAME}

EOT;

$lang_forgot_passwd_php['reset_email'] = <<< EOT
Her er det nye kodeord du anmodede om:

Brugernavn: {USER_NAME}
Kodeord: {PASSWORD}

Gå til <a href="{SITE_LINK}">{SITE_LINK}</a> for at logge ind.


Mvh,

Administrator af {SITE_NAME}

EOT;
}

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //
if (defined('GROUPMGR_PHP')) {
$lang_groupmgr_php['group_manager'] = 'Gruppe administrator'; // cpg1.5.x
$lang_groupmgr_php['group_name'] = 'Gruppe';
$lang_groupmgr_php['permissions'] = 'Rettigheder';
$lang_groupmgr_php['public_albums'] = 'Offentlig album upload';
$lang_groupmgr_php['personal_gallery'] = 'Personlig galleri';
$lang_groupmgr_php['disk_quota'] = 'Kvota';
$lang_groupmgr_php['rating'] = 'Karakter';
$lang_groupmgr_php['ecards'] = 'E-kort';
$lang_groupmgr_php['comments'] = 'Kommentarer';
$lang_groupmgr_php['allowed'] = 'Tilladt';
$lang_groupmgr_php['approval'] = 'Godkendelse';
$lang_groupmgr_php['create_new_group'] = 'Opret ny gruppe';
$lang_groupmgr_php['del_groups'] = 'Slet valgte gruppe(r)';
$lang_groupmgr_php['confirm_del'] = 'Advarsel, når du sletter denne gruppe, bliver bruger der er medlem af gruppen flyttet til \'Registered\' gruppe!\n\nVil du fortsætte?'; // js-alert
$lang_groupmgr_php['title'] = 'Administrere bruger grupper';
$lang_groupmgr_php['reset_to_default'] = 'Nulstil til standardnavn (%s) - anbefales!';
$lang_groupmgr_php['error_group_empty'] = 'Gruppe tabel var tom!<br />Standard gruppe oprettet, genindlæs siden igen';
$lang_groupmgr_php['explain_greyed_out_title'] = 'Hvorfor er denne kolonne grå?';
$lang_groupmgr_php['explain_guests_greyed_out_text'] = 'Du kan ikke ændre egenskaberne for denne gruppe fordi adgangs niveauet til gruppen er NONE. Alle ikke logget ind bruger (medlem af denne gruppe %s) kan intet andet end og logge ind; derfor gælder gruppe rettighederne ikke for dem. Ændre adgangs niveau her eller på Galleri konfigurations side under "Bruger egenskaber", "Tillad brugere der ikke er logget ind adgang".';
$lang_groupmgr_php['group_assigned_album'] = 'Tildelt(e) album(s)';
$lang_groupmgr_php['access_level'] = 'Adgangs niveau'; // cpg1.5
$lang_groupmgr_php['thumbnail_intermediate_full'] = 'thumbnail, mellemstørrelse, og fuldstørrelse billede'; // cpg1.5
$lang_groupmgr_php['thumbnail_intermediate'] = 'thumbnail og mellemstørrelse billed'; // cpg1.5
$lang_groupmgr_php['thumbnail_only'] = 'kun thumbnail'; // cpg1.5
$lang_groupmgr_php['none'] = 'ingen'; // cpg1.5
}

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //
if (defined('INDEX_PHP')){
$lang_index_php['welcome'] = 'Velkommen!';

$lang_album_admin_menu['confirm_delete'] = 'Er du sikker på at du vil SLETTE dette Album?\\nAlle filer og kommentarer vil blive slettet.'; // js-alert
$lang_album_admin_menu['delete'] = 'Slet';
$lang_album_admin_menu['modify'] = 'Egenskaber';
$lang_album_admin_menu['edit_pics'] = 'Rediger Filer';
$lang_album_admin_menu['cat_locked'] = 'Dette album er blevet låst for redigering'; // cpg1.5.x

$lang_list_categories['home'] = 'Hjem';
$lang_list_categories['stat1'] = '[pictures] filer i [albums] albums og [cat] kategorier med [comments] kommentarer vist [views] gange'; // do not translate the stuff in square brackets
$lang_list_categories['stat2'] = '[pictures] filer i [albums] albums set [views] gange'; // do not translate the stuff in square brackets
$lang_list_categories['xx_s_gallery'] = '%s\'s Galleri';
$lang_list_categories['stat3'] = '[pictures] filer i [albums] albums med [comments] kommentarer vist [views] gange'; // do not translate the stuff in square brackets

$lang_list_users['user_list'] = 'Bruger liste';
$lang_list_users['no_user_gal'] = 'Der er ingen bruger gallerier';
$lang_list_users['n_albums'] = '%s album(s)';
$lang_list_users['n_pics'] = '%s file(r)';

$lang_list_albums['n_pictures'] = '%s filer';
$lang_list_albums['last_added'] = ', seneste lagt på den %s';
$lang_list_albums['n_link_pictures'] = '%s linkede filer';
$lang_list_albums['total_pictures'] = '%s filer i alt';
$lang_list_albums['alb_hits'] = 'Album set %s gange'; // cpg1.5
$lang_list_albums['from_category'] = ' - Fra Kategori: '; // cpg1.5
}

// ------------------------------------------------------------------------- //
// File install.php
// ------------------------------------------------------------------------- //

if (defined('INSTALL_PHP')) {
$lang_install['already_succ'] = 'Installations programmet har allerede været kørt en gang med success og er nu låst.';
$lang_install['already_succ_explain'] = 'Hvis du ønsker at køre installations programmet igen, skal du først slette \'include/config.inc.php\' filen som blev oprettet mappen hvor du installerede din Coppermine. Du kan kan gøre det med et FTP program';
$lang_install['cant_read_tmp_conf'] = 'Installations programmet kan ikke læse den midlertidig konfig fil %s.';
$lang_install['cant_write_tmp_conf'] = 'Installations programmet kan ikke skrive til den midlertidig konfig fil %s.';
$lang_install['review_permissions'] = 'Tjek venligst mappe rettighederne.';
$lang_install['change_lang'] = 'Skift sprog';
$lang_install['check_path'] = 'Tjek sti';
$lang_install['continue'] = 'Næste skridt';
$lang_install['conv_said'] = 'Konverteringsprogrammet sagde:';
$lang_install['license_info'] = 'Coppermine er et billed/multimedia galleri pakke som er udgivet under GNU GPL v3. Ved og installere det, acceptere du at være bundet til Coppermine\'s licensregler:';
$lang_install['cpg_info_frames'] = 'Din browser lader til og ikke kunne vise på linie rammer. Dukan se læse om licensen i docs Mappen som fulgte med din Coppermine pakke.';
$lang_install['license'] = 'Coppermine licens aftale';
$lang_install['create_table'] = 'Opret tabel \'%s\'';
$lang_install['db_populating'] = 'Prøver og indsætte data i databasen.';
$lang_install['db_alr_populated'] = 'Ønskede data er allerede indsat i databasen.';
$lang_install['dir_ok'] = 'Mappe fundet';
$lang_install['directory'] = 'Mappe';
$lang_install['email'] = 'E-mail adresse';
$lang_install['email_no_match'] = 'E-mail adressen passer ikke eller er forkert.';
$lang_install['email_verif'] = 'Tjek e-mail';
$lang_install['err_cpgnuke'] = '<h1>ERROR</h1>Det ser ud til at du prøver og installere standalone Coppermine på din Nuke portal.<br />Denne version can kun blive kørt som standalone!<br />Nogle server setups viser måske denne fejl selvom der ikke er installeret en nuke portal - Hvis det er tilfældet, <a href="%s?continue_anyway=1">fortsæt</a> installationen. Hvis du bruger en nuke portal, bør du læse nærmere her <a href=\"http://www.cpgnuke.com/\">CpgNuke</a> eller bruge en af disse (usupporterede)<a href=\"http://sourceforge.net/project/showfiles.php?group_id=89658&amp;package_id=95984\">Coppermine ports</a> - fortsæt ikke!';
$lang_install['error'] = 'FEJL';
$lang_install['error_need_corr'] = 'Følgende fejl er fundet og skal rettes først:';
$lang_install['finish'] = 'Afslut installationen';
$lang_install['gd_note'] = '<strong>Vigtigt :</strong> ældre versioner af GD graphic library supportere kun JPEG and PNG billeder. Hvis det er tilfældet for dig, så vil systemet ikke kunne lave thumpnails til GIF billeder.';
$lang_install['go_to_main'] = 'Gå til hovedsiden';
$lang_install['im_no_convert_ex'] = 'Installations programmet fandt ImageMagick \'convert\' programmet i \'%s\', men det kan ikke køres af systemet.<br />Du bør overveje og bruge GD istedet for ImageMagick.';
$lang_install['im_not_found'] = 'Installations programmet forsøgte og finde ImageMagick, men kunne afgøre om det findes eller der var en fejl. <br />Coppermine kan bruge <a href="http://www.imagemagick.org/">ImageMagick</a> \'convert\' programmet til og oprette thumpnails. Kvaliteten af billederne lavet med ImageMagick er overlegen i forhold til GD1 men sammenlignlig med GD2.<br />Hvis ImageMagick er installeret på dit system og du ønsker at bruge det, <br />så skal du indstætte en fuld sti til \'convert\' programmet nedenfor. <br />I Windows skal stien se nogenlunde sådan ud \'c:/ImageMagick/\' og må ikke indeholde mellemrum, på Unix er det nogenlunde sådan \'/usr/bin/\'.<br />Hvis du ikke ved om du har ImageMagick, lad feltet være tomt - Installations programmet vil så prøve og bruge GD2 som standard (hvilket de fleste har). <br />Du kan altid ændre det senere (i Coppermine\'s konfig side), så tænk ikke mere på hvad du skal indtaste - lad feltet være tomt.';
$lang_install['im_packages'] = 'Din server understøtter følgende billedpakker';
$lang_install['im_path'] = 'Sti til ImageMagick:';
$lang_install['im_path_space'] = 'Sti til ImageMagick (\'%s\') indeholder mindst et mellemrum. Det vil give problemer med scriptet.<br />Du skal flytte ImageMagick til en anden mappe.';
$lang_install['installation'] = 'installation';
$lang_install['installer_locked'] = 'Installations programmet er låst';
$lang_install['installer_selected'] = 'Installations program valgt';
$lang_install['inv_im_path'] = 'Installations programet kan ikke finde \'%s\' mappen som du har angivet for ImageMagick eller har ikke rettigheder til mappen. Tjek at du har tastet korrekt og de er adgang til mappen.';
$lang_install['lets_go'] = 'Start!';
$lang_install['mysql_create_btn'] = 'Opret';
$lang_install['mysql_create_db'] = 'Opret ny MySQL database';
$lang_install['mysql_db_name'] = 'MySQL database navn';
$lang_install['mysql_error'] = 'MySQL fejl: ';
$lang_install['mysql_host'] = 'MySQL host<br />(localhost er normalt OK)';
$lang_install['mysql_username'] = 'MySQL brugernavn'; // cpg1.5
$lang_install['mysql_password'] = 'MySQL kodeord'; // cpg1.5
$lang_install['mysql_no_create_db'] = 'Kunne ikke oprette MySQL database.';
$lang_install['mysql_no_sel_dbs'] = 'Kunne ikke læse tilgængelige MySQL databases';
$lang_install['mysql_succ'] = 'Vellykket forbindelse til database';
$lang_install['mysql_tbl_pref'] = 'MySQL tabel præfiks';
$lang_install['mysql_test_connection'] = 'Test forbindelse';
$lang_install['mysql_wrong_db'] = 'MySQL kunne ikke finde en database der hedder \'%s\' tjek venligst at navnet er korrekt';
$lang_install['n_a'] = 'N/A';
$lang_install['no_admin_email'] = 'Du skal indtaste en admin e-mail adresse';
$lang_install['no_admin_password'] = 'Du skal indtaste et admin kodeord';
$lang_install['no_admin_username'] = 'Du skal indtaste et admin brugernavn';
$lang_install['no_dir'] = 'Mappe findes ikke';
$lang_install['no_gd'] = 'Din installation af PHP inkludere ikke \'GD\' graphic library extension og du har ikke angivet at ville bruge ImageMagick istedet for. Coppermine er indstillet til og bruge GD2 da den automatiske registrering sommetider fejler. Hvis GD er installeret på dit system, scriptet skulle virke eller må du installere ImageMagick.';
$lang_install['no_mysql_conn'] = 'Kunne ikke oprette en MySQL forbindelse, tjek venligst alle MySQL oplysinger indtastet';
$lang_install['no_mysql_support'] = 'PHP lader ikke til at have MySQL support aktiveret.';
$lang_install['no_thumb_method'] = 'Du skal vælge et billedmanipulationsprogram (GD/IM)';
$lang_install['nok'] = 'Ikke OK';
$lang_install['not_here_yet'] = 'Findes endnu ikke, klik venligst %sher%s for at gå tilbage.';
$lang_install['ok'] = 'OK';
$lang_install['on_q'] = 'under forespørgsel';
$lang_install['or'] = 'eller';
$lang_install['pass_err'] = 'Kodeordene er ikke ens, du har brugt en forbudt tegn eller har intet skrevet.';
$lang_install['password'] = 'Kodeord';
$lang_install['password_verif'] = 'Bekræft kodeord';
$lang_install['perm_error'] = 'Rettighederne til \'%s\' er sat til %s, ret dem venligst til';
$lang_install['perm_ok'] = 'Rettighederne på visse mapper er blevet tjekket og ser ud til at være OK. <br />Fortsæt venligst til sætte trin.';
$lang_install['perm_not_ok'] = 'Rettighederne på visse mapper er ikke sat korrekt.<br />Ret venligst rettighederne på nedenstående mapper der er markeret "Ikke OK".'; // cpg1.5
$lang_install['please_go_back'] = 'Venligst %stryk her%s og gå tilbage for at rette fejlen før du kan fortsætte.';
$lang_install['populate_db'] = 'Udgive database';
$lang_install['ready_to_roll'] = '<a href="index.php">Coppermine</a> er nu korrekt indstillet og klar til brug.<br /><a href="login.php">Login</a> brug oplysningerne du angav for din admin konto.';
$lang_install['sect_create_adm'] = 'Denne sektion kræver oplysninger for at oprette en administrativ konto. Brug kun alfanumerisk karakterer. Indtast oplysningerne omhyggeligt!';
$lang_install['sect_mysql_info'] = 'Denne sektion kræver oplysninger om hvordan du tilgår din MySQL database.<br />Hvis du ikke ved hvordan de fyldes ud, tjek med din webhost support.';
$lang_install['sect_mysql_sel_db'] = 'Her skal du vælge hvilken database du ønsker at bruge til Coppermine.<br />Hvis din MySQL konto har de nødvendige rettigheder, kan du oprette en ny database inde fra installations programmet eller du kan bruge en eksisterende database. Hvis du ikke kan lide begge muligheder, skal du først oprette en databasen uden for Coppermine installations programmet, og så returnere igen for og vælge den nye database fra dropdown boksen nedenfor. Du kan også ændre tabel præfiks (brug dog ikke punktum), men de anbefales at bruge standard præfiks.';
$lang_install['select_lang'] = 'Vælg standard sprog: ';
$lang_install['sql_file_not_found'] = 'Filen \'%s\' kunne ikke findes. Tjek at du har uploadet alle Coppermine filer til din server.';
$lang_install['status'] = 'Status';
$lang_install['subdir_called'] = 'En undermappe kaldet \'%s\' skulle normalt eksistere i den mappe hvor du uploadede Coppermine.<br />Installations programmet kunne ikke finde denne mappe. Tjek at du har uploadet alle Coppermine filer til din server.';
$lang_install['title_admin'] = 'Opret Coppermine administrator';
$lang_install['title_dir_check'] = 'Tjekker mappe rettigheder';
$lang_install['title_file_check'] = 'Tjekker installations filer';
$lang_install['title_finished'] = 'Installation fuldført';
$lang_install['title_imp'] = 'Billed pakke valg';
$lang_install['title_imp_test'] = 'Tester billed mappe';
$lang_install['title_mysql_db_sel'] = 'MySQL database valg';
$lang_install['title_mysql_pop'] = 'Opretter database struktur';
$lang_install['title_mysql_user'] = 'MySQL brugergodkendelse';
$lang_install['title_welcome'] = 'Velkommen til Coppermine installation';
$lang_install['tmp_conf_error'] = 'Kan ikke skrive til den midlertidig konfig fil - tjek at \'include\' mappe er skrivebar for systemet.';
$lang_install['tmp_conf_ser_err'] = 'En alvorlig fejl er opstået i installations programmet, prøv og genindlæse siden eller start forfra ved og fjerne \'include/config.tmp\' fil.';
$lang_install['try_again'] = 'Prøv igen!';
$lang_install['unable_write_config'] = 'Kan ikke skrive konfig filen';
$lang_install['user_err'] = 'Admin brugernavnet må kun indeholde alfanumerisk karakterer og må ikke være tomt.';
$lang_install['username'] = 'Brugernavn';
$lang_install['your_admin_account'] = 'Din admin konto';
$lang_install['no_cookie'] = 'Din browser accepterede ikke vores cookie. Det anbefales at acceptere cookies.';
$lang_install['no_javascript'] = 'Din browser lader ikke til at have Javascript slået til - det anbefales på det kraftigste at slå det til.';
$lang_install['register_globals_detected'] = 'Det ser ud til at PHP konfigurationen har \'register_globals\' enabled - Du bør slå dette fra af sikkerheds årsagen.';
$lang_install['more'] = 'mere';
$lang_install['version_undetected'] = 'Dette script kunne ikke afgøre versionen %s din server bruger. Sikre dig at du bruger mindst version %s.';
$lang_install['version_incompatible'] = 'Dette script opdagede en inkompatible version (%s) af %s på din server.<br />Vær sikker på kun at bruge en kompatibel version (%s eller bedre) før du fortsætter!';
$lang_install['read_gif'] = 'Læs/skriv .gif fil';
$lang_install['read_png'] = 'Læs/skriv .png fil';
$lang_install['read_jpg'] = 'Læs/skriv .jpg fil';
$lang_install['write_error'] = 'Kunne ikke skrive oprettede billede til disken.';
$lang_install['read_error'] = 'Kunne ikke læse original billede.';
$lang_install['combine_error'] = 'Kunne ikke lægge original billederne sammen';
$lang_install['text_error'] = 'Kunne ikke tilføje tekst til original billede';
$lang_install['scale_error'] = 'Kunne ikke skalere original billede';
$lang_install['pixels'] = 'pixels';
$lang_install['combine'] = 'kombinere 2 billeder';
$lang_install['text'] = 'Skriv tekst til billede';
$lang_install['scale'] = 'Skalere et billede';
$lang_install['generated_image'] = 'Generere billede';
$lang_install['reference_image'] = 'Reference billede';
$lang_install['imp_test_error'] = 'Der var en fejl i en eller flere af testene, tjek venligst at valgte billedbehandlings pakke er indstillet korrekt!';
$lang_install['writable'] = 'Skrivebar';
$lang_install['not_writable'] = 'Ikke skrivebar';
$lang_install['not_exist'] = 'Findes ikke';
$lang_install['old_install'] = 'Dette er den nye installations wizard. Klik %sher%s for den klassiske installations side.'; //cpg1.5

}

// ------------------------------------------------------------------------- //
// File keywordmgr.php
// ------------------------------------------------------------------------- //
if (defined('KEYWORDMGR_PHP')) {
$lang_keywordmgr_php['title'] = 'Administrer nøgleord';
$lang_keywordmgr_php['search'] = 'Søg';
$lang_keywordmgr_php['keyword_test_search'] = 'Søg efter %s i nyt vindue';
$lang_keywordmgr_php['keyword_del'] = 'Slet nøgleordet %s';
$lang_keywordmgr_php['confirm_delete'] = 'Er du sikker på du vil slette dette nøgleord %s fra hele galleriet?'; // js-alert
$lang_keywordmgr_php['change_keyword'] = 'Skift nøgleord';
}

// ------------------------------------------------------------------------- //
// File langmgr.php
// ------------------------------------------------------------------------- //
if (defined('LANGMGR_PHP')) {
$lang_langmgr_php['title'] = 'Sprog administration';
$lang_langmgr_php['english_language_name'] = 'Engelsk';
$lang_langmgr_php['native_language_name'] = 'Native';
$lang_langmgr_php['custom_language_name'] = 'Tilpasset';
$lang_langmgr_php['language_name'] = 'Sprog navn';
$lang_langmgr_php['language_file'] = 'Sprog fil';
$lang_langmgr_php['flag'] = 'Flag';
$lang_langmgr_php['file_available'] = 'Tilgængelig';
$lang_langmgr_php['enabled'] = 'Aktiveret';
$lang_langmgr_php['complete'] = 'Fuldfør';
$lang_langmgr_php['default'] = 'Standard';
$lang_langmgr_php['missing'] = 'mangler';
$lang_langmgr_php['broken'] = 'ser ud til og være ødelagt eller mangler';
$lang_langmgr_php['exists_in_db_and_file'] = 'findes i databasen og som fil';
$lang_langmgr_php['exists_as_file_only'] = 'findes kun som fil';
$lang_langmgr_php['pick_a_flag'] = 'Vælg en';
$lang_langmgr_php['replace_x_with_y'] = 'Udskift %s med %s';
$lang_langmgr_php['tanslator_information'] = 'Oversætter oplysninger';
$lang_langmgr_php['cpg_version'] = 'Coppermine version';
$lang_langmgr_php['hide_details'] = 'Skjul detaljer';
$lang_langmgr_php['show_details'] = 'Vis detaljer';
$lang_langmgr_php['loading'] = 'Indlæser';
$lang_langmgr_php['english_missing'] = 'Den engelske sprog fil mangler selvom den aldrig bør fjernes. Den skal geninstalleres omgående.';
$lang_langmgr_php['enable_at_least_one'] = 'Du skal aktivere mindst et sprog for at galleriet virker';
$lang_langmgr_php['enable_default'] = 'Du har valgt et standard sprog som ikke er aktiveret. Vælg et andet sprog eller aktivere det sprog du har valgt som standard!';
$lang_langmgr_php['available_default'] = 'Du har valgt et standard sprog som slet ikke findes. Vælg et andet standard sprog!';
$lang_langmgr_php['version_does_not_match'] = 'Versionen af denne fil passer ikke din Coppermine version. Brug med forsigtighed og test grundigt!';
$lang_langmgr_php['no_version'] = 'Ingen versions oplysinger kunne findes. Det er meget sandsynligt at sprog filen ikke virker eller at det ikke er en sprog fil.';
$lang_langmgr_php['filesize'] = 'Filstørrelse er usandsynlig %s ';
$lang_langmgr_php['content_missing'] = 'Filen ser ud til ikke at indeholde nogen data, så det er sandsynligt ikke en sprog fil.';
$lang_langmgr_php['status'] = 'Status';
$lang_langmgr_php['default_language'] = 'Standard sprog er sat til %s';
}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //
if (defined('LOGIN_PHP')) {
$lang_login_php['login'] = 'Login';
$lang_login_php['enter_login_pswd'] = 'Indtast dit brugernavn og kodeord for at logge ind';
$lang_login_php['username'] = 'Brugernavn';
$lang_login_php['email'] = 'E-mail Adresse'; // cpg1.5
$lang_login_php['both'] = 'Brugernavn / E-mail Adresse'; // cpg1.5
$lang_login_php['password'] = 'Kodeord';
$lang_login_php['remember_me'] = 'Husk mig';
$lang_login_php['welcome'] = 'Velkommen %s ...';
$lang_login_php['err_login'] = 'Login fejlede. Prøv igen.';
$lang_login_php['err_already_logged_in'] = 'Du er allerede logget ind!';
$lang_login_php['forgot_password_link'] = 'Jeg har glemt mit kodeord';
$lang_login_php['cookie_warning'] = 'Advarsel, din browser acceptere ikke script\'s cookies';
$lang_login_php['send_activation_link'] = 'Glippede du aktiverings link?';
$lang_login_php['force_login'] = 'Du skal logge ind for at se denne side'; // cpg1.5
$lang_login_php['force_login_title'] = 'Login for at fortsætte'; // cpg1.5
}

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) {
$lang_logout_php['logout'] = 'Log ud';
$lang_logout_php['bye'] = 'Farvel Farvel %s ...';
$lang_logout_php['err_not_logged_in'] = 'Du er ikke logget ind!'; // cpg1.5
}

// ------------------------------------------------------------------------- //
// File minibrowser.php
// ------------------------------------------------------------------------- //
if (defined('MINIBROWSER_PHP')) {
$lang_minibrowser_php['up'] = 'et niveau op';
$lang_minibrowser_php['current_path'] = 'nuværende sti';
$lang_minibrowser_php['select_directory'] = 'Vælg en mappe';
$lang_minibrowser_php['click_to_close'] = 'Klik på billede for at lukke dette vindue';
$lang_minibrowser_php['folder'] = 'Mappe'; // cpg1.5
}

// ------------------------------------------------------------------------- //
// File mode.php
// ------------------------------------------------------------------------- //
if (defined('MODE_PHP')) {
$lang_mode_php[0] = 'Sætte visning af admin kontrol til off...'; // cpg1.5
$lang_mode_php[1] = 'Sætte visning ad admin kontrol til on...'; // cpg1.5
$lang_mode_php['news_hide'] = 'Skjuler nyheder...'; // cpg1.5
$lang_mode_php['news_show'] = 'Viser nyheder...'; // cpg1.5
}

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //
if (defined('MODIFYALB_PHP')) {
$lang_modifyalb_php['upd_alb_n'] = 'Opdater album %s';
$lang_modifyalb_php['related_tasks'] = 'Relaterede opgaver'; // cpg1.5
$lang_modifyalb_php['choose_album'] = 'Vælg album'; // cpg1.5
$lang_modifyalb_php['general_settings'] = 'Generelle indstillinger';
$lang_modifyalb_php['alb_title'] = 'Album titel';
$lang_modifyalb_php['alb_cat'] = 'Album kategori';
$lang_modifyalb_php['alb_desc'] = 'Album beskrivelse';
$lang_modifyalb_php['alb_keyword'] = 'Album nøgleord';
$lang_modifyalb_php['alb_thumb'] = 'Album thumbnail';
$lang_modifyalb_php['alb_perm'] = 'Tilladelser for dette album';
$lang_modifyalb_php['can_view'] = 'Album kan ses af';
$lang_modifyalb_php['can_upload'] = 'Besøgende kan uploade filer';
$lang_modifyalb_php['can_post_comments'] = 'Besøgende kan poste kommentarer';
$lang_modifyalb_php['can_rate'] = 'Besøgende kan give filer karakterer';
$lang_modifyalb_php['user_gal'] = 'Bruger galleri';
$lang_modifyalb_php['my_gal'] = '* Mit Galleri *'; // cpg 1.5
$lang_modifyalb_php['no_cat'] = '* Ingen kategori *';
$lang_modifyalb_php['alb_empty'] = 'Album er tomt';
$lang_modifyalb_php['last_uploaded'] = 'Seneste upload';
$lang_modifyalb_php['public_alb'] = 'Alle (offentligt album)';
$lang_modifyalb_php['me_only'] = 'Kun mig';
$lang_modifyalb_php['owner_only'] = 'Kun album ejer (%s)';
$lang_modifyalb_php['group_only'] = 'Medlemmer af \'%s\' gruppen';
$lang_modifyalb_php['err_no_alb_to_modify'] = 'Der er ingen album i databasen du kan redigere.';
$lang_modifyalb_php['update'] = 'Opdater album';
$lang_modifyalb_php['reset_album'] = 'Nulstil album';
$lang_modifyalb_php['reset_views'] = 'Nulstil visningstæller til &quot;0&quot; i %s';
$lang_modifyalb_php['reset_rating'] = 'Nulstil karakterer for alle filer i %s';
$lang_modifyalb_php['delete_comments'] = 'Slet alle kommentarer i %s';
$lang_modifyalb_php['delete_files'] = 'Slet %s(uden fortrydelse)%s alle filer i %s';
$lang_modifyalb_php['views'] = 'visninger';
$lang_modifyalb_php['votes'] = 'stemmer';
$lang_modifyalb_php['comments'] = 'kommentarer';
$lang_modifyalb_php['files'] = 'filer';
$lang_modifyalb_php['submit_reset'] = 'Udfør ændringer';
$lang_modifyalb_php['reset_views_confirm'] = 'Jeg er sikker';
$lang_modifyalb_php['notice1'] = '(*) afhængig af %sgroups%s indstillinger'; // do not translate the %s placeholders
$lang_modifyalb_php['can_moderate'] = 'Album kan ændres af'; // cpg 1.5
$lang_modifyalb_php['admins_only'] = 'Kun admins'; // cpg 1.5
$lang_modifyalb_php['alb_password'] = 'Album kodeord (Nyt kodeord)';
$lang_modifyalb_php['alb_password_hint'] = 'Album kodeord hint';
$lang_modifyalb_php['edit_files'] = 'Rediger filer';
$lang_modifyalb_php['parent_category'] = 'Overliggende kategori';
$lang_modifyalb_php['thumbnail_view'] = 'Thumbnail visning';
$lang_modifyalb_php['random_image'] = 'Tilfældigt billede'; // cpg 1.5
$lang_modifyalb_php['password_protect'] = 'Beskyt dette album med kodeord (Marker for ja)'; //cpg1.5
}

// ------------------------------------------------------------------------- //
// File phpinfo.php
// ------------------------------------------------------------------------- //
if (defined('PHPINFO_PHP')) {
$lang_phpinfo_php['php_info'] = 'PHP info';
$lang_phpinfo_php['explanation'] = 'Dette er output genereret af PHP funktionen <a href="http://www.php.net/phpinfo">phpinfo()</a>, vist i Coppermine.';
$lang_phpinfo_php['no_link'] = 'At have andre til og se dine phpinfo kan være en sikkerhedsrisiko, derfor er siden kun synlig når du er logget ind som admin.  Du kan ikke sende et link til siden til andre, de vil blive afvist.';
}

// ------------------------------------------------------------------------- //
// File picmgr.php
// ------------------------------------------------------------------------- //
if (defined('PICMGR_PHP')) {
$lang_picmgr_php['pic_mgr'] = 'Billed Administration';
$lang_picmgr_php['confirm_modifs'] = 'Vil du virkelig udføre disse ændringer?'; // cpg1.5 // js-alert
$lang_picmgr_php['no_change'] = 'Ingen ændringer udført!';
$lang_picmgr_php['no_album'] = '* Intet album *';
$lang_picmgr_php['explanation_header'] = 'Den brugerdefineret sorteringsorden vil kun blive udført hvis';
$lang_picmgr_php['explanation1'] = 'administrator har sat "Standard sorteringsorden for filer" i konfig til "Position faldende" eller "Position stigende" (global indstilling for alle brugere som ikke har valgt deres egen sorterings indstilling)';
$lang_picmgr_php['explanation2'] = 'brugeren har valgt "Position faldende" or "Position stigende" på deres thumpnails side (per bruger indstilling)';
$lang_picmgr_php['change_album'] = 'Hvis du ændre albumet, vil rettelser gå tabt!'; // cpg1.5 // js-alert
$lang_picmgr_php['submit_reminder'] = 'Sorterings ændringer er ikke gemt før du klikker på &quot;Godkend ændringer&quot;.'; // cpg1.5
}


// ------------------------------------------------------------------------- //
// File pluginmgr.php
// ------------------------------------------------------------------------- //
if (defined('PLUGINMGR_PHP')){
$lang_pluginmgr_php['confirm_uninstall'] = 'Er du sikker på at du vil AFINSTALLERE dette plugin?';
$lang_pluginmgr_php['confirm_remove'] = 'NOTE: Plugin API  er slået fra. Vil du virkelig MANUELT FJERNE dette plugin og ignorere alle oprydningshandlinger?'; // cpg1.5
$lang_pluginmgr_php['confirm_delete'] = 'Er du sikker på at du vil SLETTE dette plugin?';
$lang_pluginmgr_php['pmgr'] = 'Plugin Administration';
$lang_pluginmgr_php['explanation'] = 'Installer / afinstaller / administrer plugins på denne side.'; // cpg1.5
$lang_pluginmgr_php['plugin_enabled'] = 'Plugin API enabled'; // cpg1.5
$lang_pluginmgr_php['name'] = 'Navn';
$lang_pluginmgr_php['author'] = 'Forfatter';
$lang_pluginmgr_php['desc'] = 'Beskrivelse';
$lang_pluginmgr_php['vers'] = 'v';
$lang_pluginmgr_php['i_plugins'] = 'Installerede Plugins';
$lang_pluginmgr_php['n_plugins'] = 'Ikke installerede Plugins';
$lang_pluginmgr_php['none_installed'] = 'Ingen Installeret';
$lang_pluginmgr_php['operation'] = 'Funktion';
$lang_pluginmgr_php['not_plugin_package'] = 'Den uploadede fil er ikke en plugin pakke.';
$lang_pluginmgr_php['copy_error'] = 'Der var en fejl under kopiering af pakken til plugins mappe.';
$lang_pluginmgr_php['upload'] = 'Upload';
$lang_pluginmgr_php['configure_plugin'] = 'Indstil plugin';
$lang_pluginmgr_php['cleanup_plugin'] = 'Ryd op i plugin';
$lang_pluginmgr_php['extra'] = 'Ekstra'; // cpg1.5
$lang_pluginmgr_php['install_info'] = 'Installations oplysninger'; // cpg1.5
$lang_pluginmgr_php['plugin_disabled_note'] = 'Plugin API er slået fra, så funktionen er ikke tilladt.'; // cpg1.5
$lang_pluginmgr_php['install'] = 'installer'; // cpg1.5
$lang_pluginmgr_php['uninstall'] = 'afinstaller'; // cpg1.5
$lang_pluginmgr_php['minimum_requirements_not_met'] = 'Minimums krav ikke opfyldt'; // cpg1.5
$lang_pluginmgr_php['confirm_version'] = 'Kunne ikke afklare denne versions krav for dette plugin. Dette skyldes normalt at plugin ikke var designet til denne version af Coppermine og kan måske få dit galleri til og gå ned. Fortsæt alligevel (anbefales ikke)?'; // cpg1.5 // js-alert
}

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //
if (defined('RATEPIC_PHP')) {
$lang_rate_pic_php['already_rated'] = 'Beklager - Du har allerede givet denne fil karakter';
$lang_rate_pic_php['rate_ok'] = 'Din stemme er accepteret';
$lang_rate_pic_php['forbidden'] = 'Du kan ikke give dine egne filer karakter.';
}

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //
if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {
$lang_register_php['Ansvarsfraskrivelse'] = <<< EOT
Mens administratorerne af denne side {SITE_NAME} vil prøve at fjerne eller tilrette alt generelt relevant materiale så hurtigt som muligt, er det umuligt at gennemse alle indlæg. Derfor bør du være opmÆrksom på at alle indlæg der er lavet til denne side Tilkendegiver meninger og holdninger af de forskellige forfattere og ikke altid administratorernes mening (med undtagelse af de indlæg skrevet af disse) derfor kan disse ikke stille til ansvar for andres indlæg.<br />
<br />
Du accepterer hermed ikke at indsende anstødelige, vulgære, usmagelige, hadefulde, truende, sex-relaterede eller andet materiale der er i strid med lovgivningen. Du accepterer hermed at webmaster, administratorerne af {SITE_NAME} har lov til at fjerne eller rette i indholdet til enhver tid. Som bruger accepterer du at alle dine oplysninger bliver gemt i en database. Men dine informationer bliver ikke givet videre til andre uden din accept. Administratorerne kan ikke kræves til ansvar overfor hackerforsøg der eventuelt kan føre til videregivelse af dine oplysninger.<br />
<br />
Denne side bruger cookies til at gemme informationer på din private computer. Disse cookies tjener kun det formål, at forbedre billedkvaliteten. Den tilsendte e-mail bekræfter din registrering, detaljer og adgangskode.<br>
<br />
Ved at klikke på 'Jeg accepterer' nedenfor accepterer du disse betingelser.
EOT;
$lang_register_php['page_title'] = 'Bruger registrering';
$lang_register_php['term_cond'] = 'Regler og betingelser';
$lang_register_php['i_agree'] = 'Jeg acceptere';
$lang_register_php['submit'] = 'Send registrering';
$lang_register_php['err_user_exists'] = 'Brugernavnet findes allerede, vælg venligst et andet';
$lang_register_php['err_global_pw'] = 'Global registrerings kodeord ugyldig'; // cpg1.5
$lang_register_php['err_global_pass_same'] = 'Dit kodeord skal være forskellig fra det globale kodeord'; // cpg1.5
$lang_register_php['err_duplicate_email'] = 'En anden bruger er allerede registreret med denne e-mail adresse';
$lang_register_php['err_disclaimer'] = 'Du mangler at godkende ansvarsfraskrivelsen'; // cpg1.5
$lang_register_php['enter_info'] = 'Indtast registreringsoplysninger';
$lang_register_php['required_info'] = 'Krævede oplysninger';
$lang_register_php['optional_info'] = 'Valgfri oplysninger';
$lang_register_php['username'] = 'Brugernavn';
$lang_register_php['password'] = 'Kodeord';
$lang_register_php['password_again'] = 'Genindtast kodeord';
$lang_register_php['global_registration_pw'] = 'Globalt registrerings kodeord'; // cpg1.5
$lang_register_php['email'] = 'E-mail';
$lang_register_php['location'] = 'Placering';
$lang_register_php['interests'] = 'Interesser';
$lang_register_php['website'] = 'Hjemmeside';
$lang_register_php['occupation'] = 'Erhverv';
$lang_register_php['error'] = 'FEJL';
$lang_register_php['confirm_email_subject'] = '%s - Registrerings bekrætelse';
$lang_register_php['information'] = 'Oplysning';
$lang_register_php['failed_sending_email'] = 'Registrerings e-mail kan ikke sendes!';
$lang_register_php['thank_you'] = 'Tak for din registrering.<br />En e-mail er sendt med information om hvordan du aktivere din konto til den oplyste e-mail adresse.';
$lang_register_php['acct_created'] = 'Din konto er blevet oprettet og du kan nu logge ind med dit brugernavn og kodeord';
$lang_register_php['acct_active'] = 'Din konto er nu aktiv og du kan hermed logge ind med dit brugernavn og kodeord';
$lang_register_php['acct_already_act'] = 'Din konto er allerede aktiv!';
$lang_register_php['acct_act_failed'] = 'Denne konto kan ikke aktiveres!';
$lang_register_php['err_unk_user'] = 'Valgte bruger findes ikke!';
$lang_register_php['x_s_profile'] = '%s\'s profil';
$lang_register_php['group'] = 'Gruppe';
$lang_register_php['reg_date'] = 'Indmeldt';
$lang_register_php['disk_usage'] = 'Disk forbrug';
$lang_register_php['change_pass'] = 'Skift kodeord';
$lang_register_php['current_pass'] = 'Nuværende kodeord';
$lang_register_php['new_pass'] = 'Nyt kodeord';
$lang_register_php['new_pass_again'] = 'Nyt kodeord igen';
$lang_register_php['err_curr_pass'] = 'Nuværende kodeord er forkert';
$lang_register_php['change_pass'] = 'Skift mit kodeord';
$lang_register_php['update_success'] = 'Din profil blev opdateret';
$lang_register_php['pass_chg_success'] = 'Dit kodeord blev ændret';
$lang_register_php['pass_chg_error'] = 'Dit kodeord blev ikke ændret';
$lang_register_php['notify_admin_email_subject'] = '%s - Registrerings meddelelse';
$lang_register_php['last_uploads'] = 'Seneste uploadede fil'; // cpg1.5
$lang_register_php['last_uploads_detail'] = 'Klik for at se alle uploads af %s'; // cpg1.5
$lang_register_php['last_comments'] = 'Seneste kommentar'; // cpg1.5
$lang_register_php['you'] = 'dig'; // cpg1.5
$lang_register_php['last_comments_detail'] = 'Klik for at se alle kommentarer af %s'; // cpg1.5
$lang_register_php['notify_admin_email_body'] = 'En ny bruger med brugernavn "%s" er blevet oprettet på dit galleri';
$lang_register_php['pic_count'] = 'Filer uploadet';
$lang_register_php['notify_admin_request_email_subject'] = '%s - Registrerings anmodning';
$lang_register_php['thank_you_admin_activation'] = 'Tak.<br />Din anmodning om konto aktivering er sendt til administrator. Du vil modtage en e-mail når den er godkendt.';
$lang_register_php['acct_active_admin_activation'] = 'Kontoen er nu aktiv og en e-mail er sendt til brugeren.';
$lang_register_php['notify_user_email_subject'] = '%s - Aktiverings meddelelse';
$lang_register_php['delete_my_account'] = 'Slet min brugerkonto'; // cpg1.5
$lang_register_php['warning_delete'] = 'Advarsel: sletning af din konto er permanent. %sFilerne du har uploadet%s til offentlige albums og %sdine kommentarer%s bliver ikke slettet når du sletter din brugerkonto! Men, filer du har uploadet til dit private galleri bliver slettet.'; // cpg1.5 // The %s-placeholders mustn't be removed, they will later be replaced by the wrappers for the links
$lang_register_php['i_am_sure'] = 'Jeg er sikker på, at jeg vil slette min brugerkonto'; // cpg1.5
$lang_register_php['really_delete'] = 'Vil du virkelig slette din brugerkonto?'; // cpg1.5 // js-alert
$lang_register_php['edit_xs_profile'] = 'Rediger profilen for %s'; // cpg1.5
$lang_register_php['edit_my_profile'] = 'Rediger min profil'; // cpg1.5
$lang_register_php['none'] = 'intet'; // cpg1.5
$lang_register_php['user_name_banned'] = 'Det brugernavn du har valgt er ikke tilladt/udelukket. Vælg et andet brugernavn'; // cpg1.5
$lang_register_php['email_address_banned'] = 'Du er ikke ønsket på dette galleri. Du har ikke tilladelse til og gen-registrere. Farvel!'; // cpg1.5
$lang_register_php['email_warning1'] = 'E-mail adresse feltet skal være udfyldt!'; // cpg1.5
$lang_register_php['email_warning2'] = 'E-mail adresse du indtastede er ikke korrekt. Tjek venligst!'; // cpg1.5
$lang_register_php['username_warning1'] = 'Brugernavn feltet skal være udfyldt!'; // cpg1.5
$lang_register_php['username_warning2'] = 'Brugernavn skal være på mindst 2 karakterer!'; // cpg1.5
$lang_register_php['password_warning1'] = 'Kodeordet skal være på mindst 2 karakterer!'; // cpg1.5
$lang_register_php['password_warning2'] = 'Brugernavn og kodeord skal være forskellig!'; // cpg1.5
$lang_register_php['password_verification_warning1'] = 'De to kodeord er ikke ens, indtast dem venligst igen!'; // cpg1.5
$lang_register_php['form_not_submit'] = 'Formularen blev ikke sendt - der er fejl som først skal rettes!'; // cpg1.5
$lang_register_php['banned'] = 'Afvist!'; // cpg1.5

$lang_register_php['confirm_email'] = <<< EOT
Tak for din registrering på {SITE_NAME}

For at aktivere din konto med brugernavn "{USER_NAME}", skal du klikke på nedenstående link eller kopiere det til din browser.
<a href="{ACT_LINK}">{ACT_LINK}</a>

Regards,

Administrator af {SITE_NAME}

EOT;

$lang_register_approve_email = <<< EOT
En ny bruger med dette brugernavn "{USER_NAME}" er blevet registreret på dit galleri.
For at aktivere kontoen, skal du klikke på nedenstående link eller kopiere det til din browser.

<a href="{ACT_LINK}">{ACT_LINK}</a>

EOT;

$lang_register_php['activated_email'] = <<< EOT
Din konto er blevet godkendt og aktiveret.

Du kan nu logge ind på <a href="{SITE_LINK}">{SITE_LINK}</a> med dit brugernavn "{USER_NAME}"


Mvh,

Administrator af {SITE_NAME}

EOT;
}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //
if (defined('REVIEWCOM_PHP')) {
$lang_reviewcom_php['title'] = 'Kommentar oversigt';
$lang_reviewcom_php['no_comment'] = 'Der er ingen kommentarer at vise';
$lang_reviewcom_php['n_comm_del'] = '%s kommentar(er) slettet';
$lang_reviewcom_php['n_comm_disp'] = 'Antal af kommentarer at vise';
$lang_reviewcom_php['see_prev'] = 'Se forrige';
$lang_reviewcom_php['see_next'] = 'Se næste';
$lang_reviewcom_php['del_comm'] = 'Slet udvalgte kommentarer';
$lang_reviewcom_php['user_name'] = 'Navn';
$lang_reviewcom_php['date'] = 'Dato';
$lang_reviewcom_php['comment'] = 'Kommentar';
$lang_reviewcom_php['file'] = 'Fil';
$lang_reviewcom_php['name_a'] = 'Bruger navn stigende';
$lang_reviewcom_php['name_d'] = 'Bruger navn faldende';
$lang_reviewcom_php['date_a'] = 'Dato stigende';
$lang_reviewcom_php['date_d'] = 'Dato faldende';
$lang_reviewcom_php['comment_a'] = 'Kommentar besked stigende';
$lang_reviewcom_php['comment_d'] = 'Kommentar besked faldende';
$lang_reviewcom_php['file_a'] = 'Fil stigende';
$lang_reviewcom_php['file_d'] = 'Fil faldende';
$lang_reviewcom_php['approval_a'] = 'Godkendt stigende'; // cpg1.5
$lang_reviewcom_php['approval_d'] = 'Godkendt faldende'; // cpg1.5
$lang_reviewcom_php['ip_a'] = 'IP adresse stigende'; // cpg1.5
$lang_reviewcom_php['ip_d'] = 'IP adresse faldende'; // cpg1.5
$lang_reviewcom_php['akismet_a'] = 'Akismet rangliste (Valid kommentar i bunden)'; // cpg1.5
$lang_reviewcom_php['akismet_d'] = 'Akismet rangliste (valid kommentar i toppen)'; // cpg1.5
$lang_reviewcom_php['n_comm_appr'] = '%s godkendt kommentar(er)'; // cpg1.5
$lang_reviewcom_php['n_comm_unappr'] = '%s ikke godkendt kommentar(er)'; // cpg1.5
$lang_reviewcom_php['configuration_changed'] = 'Godkendt konfig ændringer'; // cpg1.5
$lang_reviewcom_php['only_approval'] = 'Vis kun kommentarer der mangler godkendelse'; // cpg1.5
$lang_reviewcom_php['approval'] = 'Godkendt'; // cpg1.5
$lang_reviewcom_php['save_changes'] = 'Gem ændringer'; // cpg1.5
$lang_reviewcom_php['n_confirm_delete'] = 'Vil du virkelig slette disse valgte kommentar(er)?'; // cpg1.5
$lang_reviewcom_php['with_selected'] = 'Udvalgte'; // cpg1.5
$lang_reviewcom_php['delete'] = 'Slet'; // cpg1.5
$lang_reviewcom_php['approve'] = 'Godkend'; // cpg1.5
$lang_reviewcom_php['disapprove'] = 'Marker ikke godkendte'; // cpg1.5
$lang_reviewcom_php['do_nothing'] = 'gør intet'; // cpg1.5
$lang_reviewcom_php['comment_approved'] = 'Kommentar godkendt'; // cpg1.5
$lang_reviewcom_php['comment_unapproved'] = 'Kommentar markeret ikke godkendt'; // cpg1.5
$lang_reviewcom_php['ban_and_delete'] = 'Forbyd bruger og slet kommentar(er)'; // cpg1.5
$lang_reviewcom_php['akismet_status'] = 'Akismet sagde'; // cpg1.5
$lang_reviewcom_php['is_spam'] = 'er spam'; // cpg1.5
$lang_reviewcom_php['is_not_spam'] = 'er ikke spam'; // cpg1.5
$lang_reviewcom_php['akismet'] = 'Akismet'; // cpg1.5
$lang_reviewcom_php['akismet_count'] = 'Akismet har fundet %s spam beskeder til dig indtil videre'; // cpg1.5
$lang_reviewcom_php['akismet_test_result'] = 'Test resultat for din Akismet API nøgle %s'; // cpg1.5
$lang_reviewcom_php['invalid'] = 'ugyldig'; // cpg1.5
$lang_reviewcom_php['missing_gallery_url'] = 'Du mangler at angive en specifik galleri URL i Coppermine\'s konfig'; // cpg1.5
$lang_reviewcom_php['unable_to_connect'] = 'Kan ikke forbinde til akismet.com'; // cpg1.5
$lang_reviewcom_php['not_found'] = 'Modtager URL blev ikke fundet. Måske har side strukturen hos akismet.com ændret sig.'; // cpg1.5
$lang_reviewcom_php['unknown_error'] = 'Ukendt fejl'; // cpg1.5
$lang_reviewcom_php['error_message'] = 'Fejlbeskeden var'; // cpg1.5
$lang_reviewcom_php['ip_address'] = 'IP adresse'; // cpg1.5
}

// ------------------------------------------------------------------------- //
// File sidebar.php
// ------------------------------------------------------------------------- //
if (defined('SIDEBAR_PHP')) {
$lang_sidebar_php['sidebar'] = 'Side Bar'; // cpg1.5
$lang_sidebar_php['install'] = 'installer'; // cpg1.5
$lang_sidebar_php['install_explain'] = 'Blandt mange af de smarte måder og finde informationer på siden, tilbydes der en sidebar til de mest populære browser på forskellige operativ systemer for at tilgå siden let. Her kan du finde installations- og afinstallerings-information for de understøttede browsers.'; // cpg1.5
$lang_sidebar_php['os_browser_detect'] = 'Detekterer dit OS og din browser'; // cpg1.5
$lang_sidebar_php['os_browser_detect_explain'] = 'Systemet forsøger og afgøres hvilket operativ system og hvilken browser du bruger - vent venligst et øjeblik. Hvis auto-detektion fejler, kan du blive nød til og %svise%s alle de mulige sidebar installationsmuligheder manuelt.'; // cpg1.5
$lang_sidebar_php['mozilla'] = 'Mozilla, Firefox, Netscape 6+, Konqueror 3.2+'; // cpg1.5
$lang_sidebar_php['mozilla_explain'] = 'Hvis du bruger 0.9.4 eller senere, kan du %stilføje vores sidebar%s. Du kan afinstallere sidebaren ved og bruge "Tilpas Sidebar" dialogen i Mozilla.'; // cpg1.5
$lang_sidebar_php['ie_mac'] = 'Internet Explorer 5 eller højere på Mac OS'; // cpg1.5
$lang_sidebar_php['ie_mac_explain'] = 'Hvis du bruger 5 eller højere på MacOS, %sÅben vores sidebar side%s i et seperat vindue. I dette vindue, åben "Page Holder" tabulere til venstre side af window. Klik "tiløj". Hvis du ønsker og beholde til for fremtiden, klik på "Favorites" og vælg "Add to Page Holder Favorites".'; // cpg1.5
$lang_sidebar_php['ie_win'] = 'Internet Explorer 5 eller højere på Windows'; // cpg1.5
$lang_sidebar_php['ie_win_explain'] = 'Hvis du bruger Internet Explorer 5 eller højere på Windows, kan du tilføje Side Bar til dine Links værktøjslinie eller du kan tilføje den til dine favoriter og klikke på det vises den istedet for din normale søge bar ved og højreklikke %shere%s og vælg "Add to favorites" fra menuen. Dette link installere ikke vores bar som standard søge bar, så ingen ændringer af dit system.'; // cpg1.5
$lang_sidebar_php['ie7_win'] = 'Internet Explorer 7 på Windows XP/Vista'; // cpg1.5
$lang_sidebar_php['ie7_win_explain'] = 'Hvis du bruger Internet Explorer 7 on Windows, kan di tilføje en navigations pop-up til din link toolbar eller du kan tilføje den til dine favoritter og ved at klikke på den vores bar vist som et pop-up vindue, ved og høre-klikke %shere%s og vælge "Add to favorites" fra menuen. I tidligere versioner af IE, var det muligt og tilføje en sidebar, men iIE7 kan det ikke lade sig gøre uden og lave omfattende ændringer. Der anbefales og bruge en anden browser hvis du vil bruge sidebaren.'; // cpg1.5
$lang_sidebar_php['opera'] = 'Opera 6 og højere'; // cpg1.5
$lang_sidebar_php['opera_explain'] = 'Hvis du bruger Opera, kan du klikke %sklikke på dette link og tilføj sidebaren til dit setup%s. Klik "Show in panel" . Du kan afinstallere sidebaren ved og højre klikke på fane og vælg slet fra menuen.'; // cpg1.5
$lang_sidebar_php['additional_options'] = 'Ekstra muligheder'; // cpg1.5
$lang_sidebar_php['additional_options_explain'] = 'Hvis du har en anden browser end nævn ovenfor, så klik %sher%s for at få vist mulige sidebars.'; // cpg1.5
$lang_sidebar_php['cannot_add_sidebar'] = 'Sidebar kan ikke tilføjes! Din browser supportere ikke denne metode!'; // cpg1.5 // js-alert
$lang_sidebar_php['search'] = 'søg'; // cpg1.5
$lang_sidebar_php['reload'] = 'Genindlæs'; // cpg1.5
}


// ------------------------------------------------------------------------- //
// File search.php
// ------------------------------------------------------------------------- //
if (defined('SEARCH_PHP')){
$lang_search_php['title'] = 'Søg';
$lang_search_php['submit_search'] = 'søg';
$lang_search_php['keyword_list_title'] = 'Nøgleords liste';
$lang_search_php['keyword_msg'] = 'Overstående liste inkluderer ikke alt. Den indholder ikke ord fra filnavne eller beskrivelser. Prøv fuld tekst søging.';
$lang_search_php['edit_keywords'] = 'Rediger nøgleord';
$lang_search_php['search in'] = 'Søg i:';
$lang_search_php['ip_address'] = 'IP adresse';
$lang_search_php['imgfields'] = 'Søg filer';
$lang_search_php['albcatfields'] = 'Søg albums eller kategorier';
$lang_search_php['age'] = 'Alder';
$lang_search_php['newer_than'] = 'Nyere end';
$lang_search_php['older_than'] = 'Ældre end';
$lang_search_php['days'] = 'dage';
$lang_search_php['all_words'] = 'Match alle ord (AND)';
$lang_search_php['any_words'] = 'Match tilfældig ord (OR)';
$lang_search_php['regex'] = 'Match almindelige udtryk';
$lang_search_php['album_title'] = 'Album titler';
$lang_search_php['category_title'] = 'Katagori titler';
}

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //
if (defined('SEARCHNEW_PHP')) {
$lang_search_new_php['page_title'] = 'Søg nye filer';
$lang_search_new_php['select_dir'] = 'Vælg mappe';
$lang_search_new_php['select_dir_msg'] = 'Denne funktion tillader dig at massetilføje de filer du har oploadet til serveren via FTP.<br />Vælg mappen hvor du har uploadet filerne til.';
$lang_search_new_php['no_pic_to_add'] = 'Der er ingen filer at tilføje';
$lang_search_new_php['need_one_album'] = 'Du skal have mindst et album oprettet for at bruge denne funktion';
$lang_search_new_php['warning'] = 'Advarsel';
$lang_search_new_php['change_perm'] = 'Systemet kan ikke skrive i denne mappe, du skal ændre rettighederne til 755 eller 777 før du kan prøve og tilføje filer!';
$lang_search_new_php['target_album'] = '<strong>Anbring filer fra&quot;</strong>%s<strong>&quot; i </strong>%s';
$lang_search_new_php['folder'] = 'Mappe';
$lang_search_new_php['image'] = 'fil';
$lang_search_new_php['result'] = 'Resultat';
$lang_search_new_php['dir_ro'] = 'Ikke skrivebar. ';
$lang_search_new_php['dir_cant_read'] = 'Ikke læsbar. ';
$lang_search_new_php['insert'] = 'Tilføjer nye filer til dette galleri';
$lang_search_new_php['list_new_pic'] = 'Liste over nye filer';
$lang_search_new_php['insert_selected'] = 'Indsæt valgte filer';
$lang_search_new_php['no_pic_found'] = 'Ingen nye filer fundet';
$lang_search_new_php['be_patient'] = 'Vent venligst, systemet skal have tid til at tilføje filerne';
$lang_search_new_php['no_album'] = 'ingen album valgt';
$lang_search_new_php['result_icon'] = 'klik for detaljer eller genindlæs';
$lang_search_new_php['notes'] = <<< EOT
    <ul>
        <li>%s: filen blev tilføjet korrekt</li>
        <li>%s: filen er en duplikat og findes allerede i databasen</li>
        <li>%s: filen kunne ikke tilføjes, tjek din konfiguration og rettigheder til mapperne for filerne ligger</li>
        <li>%s: du mangler og vælge et album</li>
        <li>%s: filen er ødelagt eller findes ikke</li>
        <li>%s: ukendt filtype</li>
        <li>%s: filen er et GIF billede</li>
        <li>Hvis ikonerne ikke vises så klik på den ødelagte fil og fejlbeskeden fra PHP</li>
        <li>Hvis din browser giver timeouts, tryk på genindlæs knappen</li>
    </ul>
EOT;
// Translator note: Do not translate the %s placeholders - they are being replaced with icons
$lang_search_new_php['check_all'] = 'Marker Alle';
$lang_search_new_php['uncheck_all'] = 'Fjern markeringer';
$lang_search_new_php['no_folders'] = 'Der er ikke nogen mapper inde i "album" mappen endnu. Vær sikker på, at oprette mindst en egen mappe i "albums" mappen og FTP upload filerne hertil. Må må ikke uploade til "userpics" eller "edit" mapperne, de er reserveret til intern brug.';
$lang_search_new_php['browse_batch_add'] = 'Browse bar interface'; // cpg1.5
$lang_search_new_php['display_thumbs_batch_add'] = 'Vis preview af thumpnails'; // cpg1.5
$lang_search_new_php['edit_pics'] = 'Rediger filer';
$lang_search_new_php['edit_properties'] = 'Album egenskaber';
$lang_search_new_php['view_thumbs'] = 'Thumpnail visning';
$lang_search_new_php['add_more_folder'] = 'Massetilføj flere filer fra mappen %s'; // cpg1.5
}

// ------------------------------------------------------------------------- //
//File send_activation.php
// ------------------------------------------------------------------------- //
if (defined('SEND_ACTIVATION_PHP')) {
$lang_send_activation_php['err_already_logged_in'] = 'Du er allerde logget ind!'; // cpg1.5
$lang_send_activation_php['activation_not_required'] = 'Dette website kræver ikke aktivering via e-mail'; // cpg1.5
$lang_send_activation_php['err_unk_user'] = 'Valgte bruger findes ikke!'; // cpg1.5
$lang_send_activation_php['resend_act_link'] = 'Gensend aktiverings link'; // cpg1.5
$lang_send_activation_php['enter_email'] = 'Indtast din e-mail adresse'; // cpg1.5
$lang_send_activation_php['submit'] = 'Kør'; // cpg1.5
$lang_send_activation_php['failed_sending_email'] = 'Kunne ikke sende e-mail med aktiverings link'; // cpg1.5
$lang_send_activation_php['activation_email_sent'] = 'En e-mail med aktiverings link sendt til %s. Tjek venligst din e-mail for at afslutte processen'; // cpg1.5
}

// ------------------------------------------------------------------------- //
// File stat_details.php
// ------------------------------------------------------------------------- //

if (defined('STAT_DETAILS_PHP')) {
$lang_stat_details_php['show_hide'] = 'vis/skjul denne kolonne';
$lang_stat_details_php['title'] = 'Statistike detaljer'; // cpg1.5
$lang_stat_details_php['vote'] = 'Afstemnings Detaljer';
$lang_stat_details_php['hits'] = 'Hit Detaljer';
$lang_stat_details_php['stats'] = 'Afstemnings Statistik';
$lang_stat_details_php['users'] = 'Bruger Statistik';
$lang_stat_details_php['sdate'] = 'Dato';
$lang_stat_details_php['rating'] = 'Vurdering';
$lang_stat_details_php['search_phrase'] = 'Søg udtryk';
$lang_stat_details_php['referer'] = 'Henvisning';
$lang_stat_details_php['browser'] = 'Browser';
$lang_stat_details_php['os'] = 'Operativ System';
$lang_stat_details_php['ip'] = 'IP';
$lang_stat_details_php['uid'] = 'Bruger'; // cpg1.5
$lang_stat_details_php['sort_by_xxx'] = 'Sorter efter %s';
$lang_stat_details_php['ascending'] = 'stigende';
$lang_stat_details_php['descending'] = 'faldende';
$lang_stat_details_php['internal'] = 'int';
$lang_stat_details_php['close'] = 'luk';
$lang_stat_details_php['hide_internal_referers'] = 'skjul intern henvisning';
$lang_stat_details_php['date_display'] = 'Dato visning';
$lang_stat_details_php['records_per_page'] = 'records pr side';
$lang_stat_details_php['submit'] = 'send / genindlæs';
$lang_stat_details_php['overall_stats'] = 'Samlet Statistik'; // cpg1.5
$lang_stat_details_php['stats_by_os'] = 'Stats by operativ systems'; // cpg1.5
$lang_stat_details_php['number_of_hits'] = 'Antal hits'; // cpg1.5
$lang_stat_details_php['total'] = 'I alt'; // cpg1.5
$lang_stat_details_php['stats_by_browser'] = 'Stats by browser'; // cpg1.5
$lang_stat_details_php['overall_stats_config'] = 'Samlet stats configuration'; // cpg1.5
$lang_stat_details_php['hit_details'] = 'Behold detaljeret hit statistik'; // cpg1.5
$lang_stat_details_php['hit_details_explanation'] = 'Behold detaljeret hit statistik'; // cpg1.5
$lang_stat_details_php['vote_details'] = 'Behold detaljeret stemme statistik'; // cpg1.5
$lang_stat_details_php['vote_details_explanation'] = 'Behold detaljeret stemme statistik'; // cpg1.5
$lang_stat_details_php['empty_hits_table'] = 'Tøm alle hit stats'; // cpg1.5
$lang_stat_details_php['empty_hits_table_confirm'] = 'Er du helt sikker du vil slette ALLE hit stat records for hele galleriet? De er permanent slettet!'; // cpg1.5 // js-alert
$lang_stat_details_php['empty_votes_table'] = 'Tøm alle stemme stats'; // cpg1.5
$lang_stat_details_php['empty_votes_table_confirm'] = 'Er du helt sikkerdu vil slette ALLE stemme records for hele galleriet? De er permanet slettet!'; // cpg1.5 // js-alert
$lang_stat_details_php['submit'] = 'Send'; // cpg1.5
$lang_stat_details_php['upd_success'] = 'Coppermine konfiguration blev opdateret'; // cpg1.5
$lang_stat_details_php['votes'] = 'stemmer'; // cpg1.5
$lang_stat_details_php['reset_votes_individual'] = 'Nulstil valgte stemme(r)'; // cpg1.5
$lang_stat_details_php['reset_votes_individual_confirm'] = 'Er du sikker du vil slette de valgte stemmer? De slettes permanent!'; // cpg1.5
$lang_stat_details_php['back_to_intermediate'] = 'Tilbage til mellemstørrelse fil visning'; // cpg1.5
$lang_stat_details_php['records_on_page'] = '%s records på %s side(r)'; // cpg1.5
$lang_stat_details_php['guest'] = 'Gæst'; // cpg1.5
$lang_stat_details_php['not_implemented'] = 'ikke implementeret endnu'; // cpg1.5
}

// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) {
$lang_upload_php['title'] = 'Upload filer';
$lang_upload_php['restrictions'] = 'Begrænsninger'; // cpg1.5
$lang_upload_php['choose_method'] = 'Vælg upload metode'; // cpg1.5
$lang_upload_php['upload_swf'] = 'Mange filer - Flash-dreven (anbefalet)'; // cpg1.5
$lang_upload_php['upload_single'] = 'simpel - en fil af gangen'; // cpg1.5
$lang_upload_php['up_instr_1'] = 'Vælg et album fra album dropdown listen';
$lang_upload_php['up_instr_2'] = 'Klik  "Gennemse" knappen nedenfor og navigere frem til filen du vil upload. Du kan udvælge flere filer ved og bruge ctrl + klik.';
$lang_upload_php['up_instr_3'] = 'Vælg flere filer til upload ved og gentage punkt 2';
$lang_upload_php['up_instr_4'] = 'Klik "Fortsæt" knappen efter alle dine valgte filer er færdig med at blive uploadet (knappen vil først blive vist når minst en fil er uploadet).';
$lang_upload_php['up_instr_5'] = 'Du vil blive sendt videre til et skema, hvor du kan indtaste detaljer om de uploadede filer. Efter at have indsat oplysningerne, send oplysningerne ved og tryk "Tilføj ændringer" knappen i bunden af skemaet.';
$lang_upload_php['restriction_zip'] = 'ZIP filer der er uploadet vil forblive pakket, de bliver ikke udpakket på serveren.';
$lang_upload_php['restriction_filesize'] = 'Størrelsen på filerne der er uploadet fra din klient til serveren må ikke overstige %s per stk.';
$lang_upload_php['reg_instr_1'] = 'Ulovlig handling for dannelse af skema.';
$lang_upload_php['no_name'] = 'Filnavn ikke tilgængeligt'; // cpg 1.5
$lang_upload_php['no_tmp_name'] = 'Kan ikke upload'; // cpg 1.5
$lang_upload_php['no_post'] = 'Fil ikke uploadet af POST.';
$lang_upload_php['forb_ext'] = 'Forbudt filendelse.';
$lang_upload_php['exc_php_ini'] = 'Overskredet filstørrelse tilladt i php.ini.';
$lang_upload_php['exc_file_size'] = 'Overskredet filstørrelse tillladt af CPG.';
$lang_upload_php['partial_upload'] = 'Kun en delvis upload.';
$lang_upload_php['no_upload'] = 'Ingen upload udført.';
$lang_upload_php['unknown_code'] = 'Ukendt PHP upload fejl kode.';
$lang_upload_php['impossible'] = 'Umulig at flytte.';
$lang_upload_php['not_image'] = 'Ikke et billed/korrupt fil';
$lang_upload_php['not_GD'] = 'Ikke en GD udvidelse.';
$lang_upload_php['pixel_allowance'] = 'Højde og/eller bredde af det oploadede billede er større end det tilladte i galleriets indstillinger.';
$lang_upload_php['failure'] = 'Upload fejl';
$lang_upload_php['no_place'] = 'Den forrige fil kunne ikke placeres.';
$lang_upload_php['max_fsize'] = 'Maksimum tilladte filstørrelse er %s';
$lang_upload_php['picture'] = 'Fil';
$lang_upload_php['pic_title'] = 'Filnavn';
$lang_upload_php['description'] = 'Fil beskrivelse';
$lang_upload_php['keywords_sel'] = 'Vælg et nøgleord';
$lang_upload_php['err_no_alb_uploadables'] = 'Beklager der er ikke nogen album hvor du har tilladelse til at upload';
$lang_upload_php['close'] = 'Luk';
$lang_upload_php['no_keywords'] = 'Beklager, ingen nøgleord tilgængelig!';
$lang_upload_php['regenerate_dictionary'] = 'Gendan ordbog';
$lang_upload_php['allowed_types'] = 'Du har tilladelse til at upload filer med endelserne:'; // cpg1.5
$lang_upload_php['allowed_img_types'] = 'Billedfil endelsers: %s'; // cpg1.5
$lang_upload_php['allowed_mov_types'] = 'Videofil endelser: %s'; // cpg1.5
$lang_upload_php['allowed_doc_types'] = 'Dokumentfil endelser: %s'; // cpg1.5
$lang_upload_php['allowed_snd_types'] = 'Lydfil endelser: %s'; // cpg1.5
$lang_upload_php['please_wait'] = 'Vent venligst medens skript uploades - Det kan tage lidt tid'; // cpg1.5
$lang_upload_php['alternative_upload'] = 'Alternative upload metode'; // cpg1.5
$lang_upload_php['xp_publish_promote'] = 'Hvis du bruger Windows XP/Vista, du kan bruge Windows XP Uploading Wizard til at upload filer, da den giver en lettere adgang direkte fra din klient.'; // cpg1.5
$lang_upload_php['err_js_disabled'] = 'Flash upload mulighed kunne ikke indlæses. Du skal have JavaScript slået til for at kunne bruge flash upload muligheden.'; // cpg1.5
$lang_upload_php['err_flash_disabled'] = 'Upload mulighed tager for lang tid at indlæse eller indlæsningen fejler. Tjek venligst at Flash Plugin er slået til og en fungeren version af Flash Player er installeret.'; // cpg1.5
$lang_upload_php['err_alternate_method'] = 'Alternativt kan du bruge <a href="upload.php?single=1">single</a> fil upload mulighed.'; // cpg1.5
$lang_upload_php['err_flash_version'] = 'Upload mulighed kunne ikke indlæses. Du mangler måske og installere eller opgradere din Flash Player. Besøg <a href="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash">Adobe website</a> for at hente Flash Playeren.'; // cpg1.5
$lang_upload_php['flash_loading'] = 'Upload mulighed indlæses. Vent venligst...'; // cpg1.5

$lang_upload_swf_php['browse'] = 'Gennemse...'; //cpg1.5
$lang_upload_swf_php['cancel_all'] = 'Stop alle uploads'; //cpg1.5
$lang_upload_swf_php['upload_queue'] = 'Upload kø'; //cpg1.5
$lang_upload_swf_php['files_uploaded'] = 'filer uploadet'; //cpg1.5
$lang_upload_swf_php['all_files'] = 'Alle Filer'; //cpg1.5
$lang_upload_swf_php['status_pending'] = 'Afventer...'; //cpg1.5
$lang_upload_swf_php['status_uploading'] = 'Uploader...'; //cpg1.5
$lang_upload_swf_php['status_complete'] = 'Fuldført.'; //cpg1.5
$lang_upload_swf_php['status_cancelled'] = 'Annuleret.'; //cpg1.5
$lang_upload_swf_php['status_stopped'] = 'Stoppet.'; //cpg1.5
$lang_upload_swf_php['status_failed'] = 'Upload fejlede.'; //cpg1.5
$lang_upload_swf_php['status_too_big'] = 'Fil er for stor.'; //cpg1.5
$lang_upload_swf_php['status_zero_byte'] = 'Kan ikke uploade nul byte filer.'; //cpg1.5
$lang_upload_swf_php['status_invalid_type'] = 'Ulovlig filtype.'; //cpg1.5
$lang_upload_swf_php['status_unhandled'] = 'Uhåndteret fejl'; //cpg1.5
$lang_upload_swf_php['status_upload_error'] = 'Upload fejl: '; //cpg1.5
$lang_upload_swf_php['status_server_error'] = 'Server (IO) fejl'; //cpg1.5
$lang_upload_swf_php['status_security_error'] = 'Sikkerhedsfejl'; //cpg1.5
$lang_upload_swf_php['status_upload_limit'] = 'Upload grænse overskredet.'; //cpg1.5
$lang_upload_swf_php['status_validation_failed'] = 'Validering fejlet. Upload afbrudt.'; //cpg1.5
$lang_upload_swf_php['queue_limit'] = 'Du har forsøgt at gemme for mange filer på samme tid.'; //cpg1.5
$lang_upload_swf_php['upload_limit_1'] = 'Du har nået din upload grænse.'; //cpg1.5
$lang_upload_swf_php['upload_limit_2'] = 'Du kan udvælge op til %s file(r)'; //cpg1.5
}
// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //
if (defined('USERMGR_PHP')) {
$lang_usermgr_php['memberlist'] = 'Medlemsliste';
$lang_usermgr_php['user_manager'] = 'Bruger administration';
$lang_usermgr_php['title'] = 'Administrer bruger';
$lang_usermgr_php['name_a'] = 'Navn stigende';
$lang_usermgr_php['name_d'] = 'Navn faldende';
$lang_usermgr_php['group_a'] = 'Gruppe stigende';
$lang_usermgr_php['group_d'] = 'Gruppe faldende';
$lang_usermgr_php['reg_a'] = 'Reg dato stigende';
$lang_usermgr_php['reg_d'] = 'Reg dato faldende';
$lang_usermgr_php['pic_a'] = 'Fil tæller stigende';
$lang_usermgr_php['pic_d'] = 'Fil tæller faldende';
$lang_usermgr_php['disku_a'] = 'Disk forbrug stigende';
$lang_usermgr_php['disku_d'] = 'Disk forbrug faldende';
$lang_usermgr_php['lv_a'] = 'Seneste besøg stigende';
$lang_usermgr_php['lv_d'] = 'Seneste besøg faldende';
$lang_usermgr_php['sort_by'] = 'Sortere brugere efter';
$lang_usermgr_php['err_no_users'] = 'Bruger tabel er tom!';
$lang_usermgr_php['err_edit_self'] = 'Du kan ikke redigere din egen profil, brug \'Min profil\' link til det';
$lang_usermgr_php['with_selected'] = 'Med valgte:';
$lang_usermgr_php['delete_files_no'] = 'behold offentlige filer (men anonymisere)';
$lang_usermgr_php['delete_files_yes'] = 'slet også offentlige filer';
$lang_usermgr_php['delete_comments_no'] = 'behold kommentarer (men anonymisere)';
$lang_usermgr_php['delete_comments_yes'] = 'slet også kommentarer';
$lang_usermgr_php['activate'] = 'Aktiver';
$lang_usermgr_php['deactivate'] = 'Deaktiver';
$lang_usermgr_php['reset_password'] = 'Nulstil Kodeord';
$lang_usermgr_php['change_primary_membergroup'] = 'Skift primær medlemsgruppe';
$lang_usermgr_php['add_secondary_membergroup'] = 'Tilføj sekundær medlemsgruppe';
$lang_usermgr_php['name'] = 'Brugernavn';
$lang_usermgr_php['group'] = 'Gruppe';
$lang_usermgr_php['inactive'] = 'Inaktiv';
$lang_usermgr_php['operations'] = 'Handlinger';
$lang_usermgr_php['pictures'] = 'Filer';
$lang_usermgr_php['disk_space_used'] = 'Plads brugt';
$lang_usermgr_php['disk_space_quota'] = 'Kvota'; // cpg1.5
$lang_usermgr_php['registered_on'] = 'Registreret den';
$lang_usermgr_php['last_visit'] = 'Seneste besøg';
$lang_usermgr_php['u_user_on_p_pages'] = '%d brugere på %d side(r)';
$lang_usermgr_php['confirm_del'] = 'Er du sikker på at du vil SLETTE denne bruger?\\nAlle hans/hendes filer og albums vil blive slettet.'; // js-alert
$lang_usermgr_php['mail'] = 'POST';
$lang_usermgr_php['err_unknown_user'] = 'Valgte bruger findes ikke!';
$lang_usermgr_php['modify_user'] = 'Rediger bruger';
$lang_usermgr_php['notes'] = 'Noter';
$lang_usermgr_php['note_list'] = 'Hvis du ikke vil ændre det nuværende kodeord, lad feltet "kodeord" forblive tomt';
$lang_usermgr_php['password'] = 'Kodeord';
$lang_usermgr_php['user_active'] = 'Bruger er aktiv';
$lang_usermgr_php['user_group'] = 'Bruger gruppe';
$lang_usermgr_php['user_email'] = 'Bruger e-mail';
$lang_usermgr_php['user_web_site'] = 'Brugers web side';
$lang_usermgr_php['create_new_user'] = 'Oprette ny bruger';
$lang_usermgr_php['user_location'] = 'Brugers placering';
$lang_usermgr_php['user_interests'] = 'Brugers interesser';
$lang_usermgr_php['user_occupation'] = 'Brugers beskæftigelse';
$lang_usermgr_php['user_profile1'] = '$user_profile1';
$lang_usermgr_php['user_profile2'] = '$user_profile2';
$lang_usermgr_php['user_profile3'] = '$user_profile3';
$lang_usermgr_php['user_profile4'] = '$user_profile4';
$lang_usermgr_php['user_profile5'] = '$user_profile5';
$lang_usermgr_php['user_profile6'] = '$user_profile6';
$lang_usermgr_php['latest_upload'] = 'Seneste uploads';
$lang_usermgr_php['no_latest_upload'] = 'Har ikke uploadet nogle filer'; // cpg1.5
$lang_usermgr_php['last_comments'] = 'Seneste kommentar'; // cpg1.5
$lang_usermgr_php['no_last_comments'] = 'Har ikke lavet nogle kommentarer'; // cpg1.5
$lang_usermgr_php['comments'] = 'Kommentarer'; // cpg1.5
$lang_usermgr_php['never'] = 'aldrig';
$lang_usermgr_php['search'] = 'Bruger søgning';
$lang_usermgr_php['submit'] = 'Send';
$lang_usermgr_php['search_submit'] = 'OK!';
$lang_usermgr_php['search_result'] = 'Søge resultat for: ';
$lang_usermgr_php['alert_no_selection'] = 'Du skal vælge mindst en bruger først!'; // js-alert
$lang_usermgr_php['select_group'] = 'Vælg gruppe';
$lang_usermgr_php['groups_alb_access'] = 'Album rettigheder udfra gruppe';
$lang_usermgr_php['category'] = 'Kategori';
$lang_usermgr_php['modify'] = 'Ret?';
$lang_usermgr_php['group_no_access'] = 'Denne gruppe af ingen speciel adgang';
$lang_usermgr_php['notice'] = 'Notits';
$lang_usermgr_php['group_can_access'] = 'Album(s) som kun "%s" har adgang til';
$lang_usermgr_php['send_login_data'] = 'Send login data til denne bruger (Kodeord vil blive sendt via e-mail)'; // cpg1.5
$lang_usermgr_php['send_login_email_subject'] = 'Din nye konto information'; // cpg1.5
$lang_usermgr_php['failed_sending_email'] = 'Login data e-mail kan ikke sendes!'; // cpg1.5
$lang_usermgr_php['view_profile'] = 'Se profil'; // cpg1.5
$lang_usermgr_php['edit_profile'] = 'Rediger profil'; // cpg1.5
$lang_usermgr_php['ban_user'] = 'Udeluk bruger'; // cpg1.5
$lang_usermgr_php['user_is_banned'] = 'Bruger er udelukket'; // cpg1.5
$lang_usermgr_php['status'] = 'Status'; // cpg1.5
$lang_usermgr_php['status_active'] = 'Aktiv'; // cpg1.5
$lang_usermgr_php['status_inactive'] = 'Ikke aktiv'; // cpg1.5
$lang_usermgr_php['total'] = 'I alt'; // cpg1.5
$lang_usermgr_php['send_login_data_email'] = <<< EOT
En ny konto er blevet oprettet på {SITE_NAME}.

Du kan nu logge ind her <a href="{SITE_LINK}">{SITE_LINK}</a> med dit brugernavn "{USER_NAME}" og kodeord "{USER_PASS}"


Mvh,

Adminitrator af {SITE_NAME}

EOT;
}

// ------------------------------------------------------------------------- //
// File update.php
// ------------------------------------------------------------------------- //
if (defined('UPDATE_PHP')) {
$lang_update_php['title'] = 'Opdatere'; // cpg1.5
$lang_update_php['welcome_updater'] = 'Velkommen til Copppermine opdatering'; // cpg1.5
$lang_update_php['could_not_authenticate'] = 'Kunne ikke autorisere dig'; // cpg1.5
$lang_update_php['provide_admin_account'] = 'Venligst oplys din Coppermine admin konto eller din MySQL konto data'; // cpg1.5
$lang_update_php['try_again'] = 'Prøv igen'; // cpg1.5
$lang_update_php['mysql_connect_error'] = 'Kunne ikke oprette en MySQL forbindelse'; // cpg1.5
$lang_update_php['mysql_database_error'] = 'MySQL kunne ikke finde en database kaldet %s'; // cpg1.5
$lang_update_php['mysql_said'] = 'MySQL sagde'; // cpg1.5
$lang_update_php['check_config_file'] = 'Tjek venligst MySQL detaljerne i %s'; // cpg1.5
$lang_update_php['performing_database_updates'] = 'Udfører Database opdateringer'; // cpg1.5
$lang_update_php['performing_file_updates'] = 'Udfører fil opdateringer'; // cpg1.5
$lang_update_php['already_done'] = 'Allerede udført'; // cpg1.5
$lang_update_php['password_encryption'] = 'Kryptering af kodeord'; // cpg1.5
$lang_update_php['alb_password_encryption'] = 'Kryptering af album kodeord'; // cpg1.5
$lang_update_php['category_tree'] = 'Katagori træ'; // cpg1.5
$lang_update_php['authentication_needed'] = 'Godkendelse nødvendig'; // cpg1.5
$lang_update_php['username'] = 'Brugernavn'; // cpg1.5
$lang_update_php['password'] = 'Kodeord'; // cpg1.5
$lang_update_php['update_completed'] = 'Opdatering udført'; // cpg1.5
$lang_update_php['check_versions'] = 'Det anbefales at du %stjekker dine filversioner%s Hvis du lige har opgraderet fra en ældre version af Coppermine'; // cpg1.5 // Leave the %s untouched when translating - it wraps the link
$lang_update_php['start_page'] = 'Hvis du ikke (eller du ikke ønsker at tjekke), kan du gå til %sdit galleris start page%s'; // cpg1.5 // Leave the %s untouched when translating - it wraps the link
$lang_update_php['errors_encountered'] = 'Følgende fejl blev opdaget og skal rettes først'; // cpg1.5
$lang_update_php['delete_file'] = 'Slet %s'; // cpg1.5
$lang_update_php['could_not_delete'] = 'Kunne ikke slette pga manglende rettigheder. Slet filen manuelt!'; // cpg1.5
$lang_update_php['rename_file'] = 'Omdøb %s til %s'; // cpg1.5
$lang_update_php['could_not_rename'] = 'Kunne ikke omdøbe pga manglende rettigheder. Omdøb filen manuelt!'; // cpg1.5
}

// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //
if (defined('UTIL_PHP')) {
$lang_util_php['title'] = 'Admin værktøjer'; // cpg1.5
$lang_util_php['file'] = 'Fil';
$lang_util_php['problem'] = 'Problem';
$lang_util_php['status'] = 'Status';
$lang_util_php['title_set_to'] = 'titel sat til';
$lang_util_php['submit_form'] = 'udfør';
$lang_util_php['titles_updated'] = '%s Titler opdateret.'; // cpg1.5
$lang_util_php['updated_successfully'] = 'opdaterede korrekt'; // cpg1.5
$lang_util_php['error_create'] = 'FEJL ved oprettelse';
$lang_util_php['continue'] = 'Behandel flere filer'; // cpg1.5
$lang_util_php['main_success'] = 'Filen %s blev korrekt brugt som primær fil';
$lang_util_php['error_rename'] = 'Fejl ved omdøbning af %s til %s';
$lang_util_php['error_not_found'] = 'Filen %s blev ikke fundet';
$lang_util_php['back'] = 'tilbage til Admin værktøj start'; // cpg1.5
$lang_util_php['thumbs_wait'] = 'Opdaterere thumpnails og /eller ændre størrelsen af billederne, vent venligst...';
$lang_util_php['thumbs_continue_wait'] = 'Fortsætter med at opdatere thumpnails og/eller ændre størrelsen af billederne...';
$lang_util_php['titles_wait'] = 'Opdatere titler, vent venligst...';
$lang_util_php['delete_wait'] = 'Sletter titler, vent venligst...';
$lang_util_php['replace_wait'] = 'Sletter originalerne og erstatter dem med med mellemstørrelsebilleder, vent venligst..';
$lang_util_php['update'] = 'Opdatere thumbs og/eller mellemstørrelsebilleder';
$lang_util_php['update_what'] = 'Hvad skal opdateres';
$lang_util_php['update_thumb'] = 'Kun thumpnails';
$lang_util_php['update_pic'] = 'Kun mellemstørrelsebilleder';
$lang_util_php['update_both'] = 'Både thumpnails og mellemstørrelsebilleder';
$lang_util_php['update_number'] = 'Antal af udført billeder pr klik';
$lang_util_php['update_option'] = '(Prøv og sætte denne mulighed lavere hvis der er timeout problemer)';
$lang_util_php['update_missing'] = 'Opdater kun manglende filer'; // cpg1.5
$lang_util_php['filename_title'] = 'Filnavn &rArr; Filtitel';
$lang_util_php['filename_how'] = 'Hvordan skal filnavn ændres';
$lang_util_php['filename_remove'] = 'Fjern endelsen (.jpg eller andet) og erstat _ (underscores) med mellemrum'; // cpg1.5
$lang_util_php['filename_euro'] = 'Ændre 2003_11_23_13_20_20.jpg til 23/11/2003 13:20';
$lang_util_php['filename_us'] = 'Ændre 2003_11_23_13_20_20.jpg til 11/23/2003 13:20';
$lang_util_php['filename_time'] = 'Ændre 2003_11_23_13_20_20.jpg til 13:20';
$lang_util_php['notitle'] = 'Gælder kun for filer med tomme titler'; // cpg1.5
$lang_util_php['delete_title'] = 'Slet filtitler';
$lang_util_php['delete_title_explanation'] = 'Dette vil slette alle filtitler i angivet album mappe.';
$lang_util_php['delete_original'] = 'Slet fuldstørrelse billeder';
$lang_util_php['delete_original_explanation'] = 'Dette vil fjene fuldstørrelse billeder.';
$lang_util_php['delete_intermediate'] = 'Sletter mellemstørrelse billeder';
$lang_util_php['delete_intermediate_explanation1'] = 'Dette vil slette mellemstore (normal) billeder.'; // cpg1.5
$lang_util_php['delete_intermediate_explanation2'] = 'Brug dette til at frigive diskplads hvis du har deaktiveret \'Opret Mellemstore billeder\' i konfig efter tilføjet billeder.'; // cpg1.5
$lang_util_php['delete_intermediate_check'] = 'Konfig mulighed \'Opret Mellemstore billeder\' er lige nu %s.'; // cpg1.5
$lang_util_php['no_image'] = '%s er droppet da det ikke er et billed.'; // cpg1.5
$lang_util_php['enabled'] = 'aktiveret'; // cpg1.5
$lang_util_php['disabled'] = 'deaktiveret'; // cpg1.5
$lang_util_php['delete_replace'] = 'Sletter det original billed og erstater dem med den ændret version';
$lang_util_php['titles_deleted'] = 'Alle titler i valgte album slettet';
$lang_util_php['deleting_intermediates'] = 'Sletter Mellemstore billeder, vent venligst...';
$lang_util_php['searching_orphans'] = 'Søger efter  forældreløse billeder, vent venligst...';
$lang_util_php['delete_orphans'] = 'Sletter kommentarer på manglende filer';
$lang_util_php['delete_orphans_explanation'] = 'Dette vil finde og lade dig slette alle kommentarer som knytter sig til filer som ikke længere findes i galleriet.<br />Tjekker alle albums.';
$lang_util_php['update_full_normal_thumb'] = 'Alt: fuldstørrelse, mellemstørrelse og thumpnails'; // cpg1.5
$lang_util_php['update_full_normal'] = 'Både mellemstørrelse og fuldstørrelse (hvis en original version er findes)'; // cpg1.5
$lang_util_php['update_full'] = 'Kun fuldstørrelse (hvis en original version findes)'; // cpg1.5
$lang_util_php['delete_back'] = 'Slet fuldstørrelse billede backup af vandmærkebilleder'; // cpg1.5
$lang_util_php['delete_back_explanation'] = 'Dette vil slette backup filen. Du vil spare nogen diskplads men kan ikke længere ændre vandmærket!!! Derefter er vandmærket permanent.'; // cpg1.5
$lang_util_php['finished'] = '<br /> Færdig med opdateringen af thumpnails/billeder!<br />'; // cpg1.5
$lang_util_php['autorefresh'] = 'Autoopdatering (ingen grund til og klikke næste mere)'; // cpg1.5
$lang_util_php['refresh_db'] = 'Genindlæs fil dimensioner og størrelse.';
$lang_util_php['refresh_db_explanation'] = 'Dette vil genindlæse fil størrelse og dimensioner. Brug denne hvis kvotaer er forkert eller filerne er ændret manuelt.';
$lang_util_php['reset_views'] = 'Nulstil vist tællere';
$lang_util_php['reset_views_explanation'] = 'Sætter alle filvisnings tæller til nul i valgte album.';
$lang_util_php['reset_success'] = 'Nulstilling udført'; // cpg1.5
$lang_util_php['orphan_comment'] = 'Forældreløs kommentarer fundet';
$lang_util_php['delete_all'] = 'Slet alle';
$lang_util_php['delete_all_orphans'] = 'Slette alle forældreløse?';
$lang_util_php['comment'] = 'Kommentar: ';
$lang_util_php['nonexist'] = 'tilknyttet til ikke-eksisterende fil # ';
$lang_util_php['delete_old'] = 'Slet filer der er ældre end et bestemt antal dage'; // cpg1.5
$lang_util_php['delete_old_explanation'] = 'Dette vil slette filer der er ældre end det antal dage du har angivet (fuldstørrelse, mellemstørrelse, thumpnails). Brug denne funktion til at frigive diskplads.'; // cpg1.5
$lang_util_php['delete_old_warning'] = 'Advarsel: Filerne du har angivet bliver slettet permanent uden yderligere advarsel!'; // cpg1.5
$lang_util_php['deleting_old'] = 'Sletter gamle billeder, vent venligst...'; // cpg1.5
$lang_util_php['older_than'] = 'Sletter billeder ældre end %s dage'; // cpg1.5
$lang_util_php['del_orig'] = 'Den originale fil %s er hermed slettet'; // cpg1.5
$lang_util_php['del_intermediate'] = 'Mellemstørrelse billeder %s er hermed slettet'; // cpg1.5
$lang_util_php['del_thumb'] = 'thumpnails billederne %s er hermed slettet'; // cpg1.5
$lang_util_php['del_error'] = 'fejl under sletning %s!'; // cpg1.5
$lang_util_php['affected_records'] = '%s påvirkede records.'; // cpg1.5
$lang_util_php['all_albums'] = 'Alle Albums'; // cpg1.5
$lang_util_php['update_result'] = 'Opdaterings resultat'; // cpg1.5
$lang_util_php['incorrect_filesize'] = 'Total filstørrelse er forkert'; // cpg1.5
$lang_util_php['database'] = 'Database: '; // cpg1.5
$lang_util_php['bytes'] = ' bytes'; // cpg1.5
$lang_util_php['actual'] = 'Aktuel: '; // cpg1.5
$lang_util_php['updated'] = 'Opdaterede'; // cpg1.5
$lang_util_php['filesize_error'] = 'Kunne ikke finde filstørrelsen (måske en defekt fil), Droppes....'; // cpg1.5
$lang_util_php['skipped'] = 'Droppet'; // cpg1.5
$lang_util_php['incorrect_dimension'] = 'Dimensionerne er forkerte'; // cpg1.5
$lang_util_php['dimension_error'] = 'Kunne ikke læse dimensions info, droppes...'; // cpg1.5
$lang_util_php['cannot_fix'] = 'Kan ikke repareres'; // cpg1.5
$lang_util_php['fullpic_error'] = 'Fil %s findes ikke!'; // cpg1.5
$lang_util_php['no_prob_detect'] = 'Ingen problemer fundet'; // cpg1.5
$lang_util_php['no_prob_found'] = 'Ingen problemer blev fundet.'; // cpg1.5
$lang_util_php['keyword_convert'] = 'Konvertere nøgleords separator'; // cpg1.5
$lang_util_php['keyword_from_to'] = 'Konvertere nøgleords separator fra %s til %s'; // cpg1.5
$lang_util_php['keyword_set'] = 'Sæt galleri nøgleord separator til ny værdi'; // cpg1.5
$lang_util_php['keyword_replace_before'] = 'Før konvertering, udskift %s med %s'; // cpg1.5
$lang_util_php['keyword_replace_after'] = 'Efter konvertering, udskift %s med %s'; // cpg1.5
$lang_util_php['keyword_replace_values'] = array('_'=>'underscore', '-'=>'hyphen', '~'=>'tilde'); // cpg1.5
$lang_util_php['keyword_explanation'] = 'Dette vil konvertere nøgleords separator for alle dine filer fra en værdi til en anden. Se hjælp dokumentationen for nærmere detaljer.'; // cpg1.5
}

// ------------------------------------------------------------------------- //
// File versioncheck.php
// ------------------------------------------------------------------------- //
if (defined('VERSIONCHECK_PHP')) {
$lang_versioncheck_php['title'] = 'Versioncheck';
$lang_versioncheck_php['versioncheck_output'] = 'Versiontjek output';
$lang_versioncheck_php['file'] = 'fil';
$lang_versioncheck_php['folder'] = 'mappe';
$lang_versioncheck_php['outdated'] = 'ældre end %s';
$lang_versioncheck_php['newer'] = 'nyere end %s';
$lang_versioncheck_php['modified'] = 'ændret';
$lang_versioncheck_php['not_modified'] = 'uændret'; // cpg1.5
$lang_versioncheck_php['needs_change'] = 'kræver ændring';
$lang_versioncheck_php['review_permissions'] = 'Sæt Rettighederne';
$lang_versioncheck_php['inaccessible'] = 'Fil er utilgængelig';
$lang_versioncheck_php['review_version'] = 'Din fil er for gammel';
$lang_versioncheck_php['review_dev_version'] = 'Din fil er nye end forventet';
$lang_versioncheck_php['review_modified'] = 'Fil er måske korrupt (eller du har ændret den med vilje)';
$lang_versioncheck_php['review_missing'] = '%s mangler eller er utilgængelig';
$lang_versioncheck_php['existing'] = 'eksisterende';
$lang_versioncheck_php['review_removed_existing'] = 'Filen skal fjernes af sikkerhedsårsager';
$lang_versioncheck_php['counter'] = 'Tæller';
$lang_versioncheck_php['type'] = 'Type';
$lang_versioncheck_php['path'] = 'Sti';
$lang_versioncheck_php['missing'] = 'Mangler';
$lang_versioncheck_php['permissions'] = 'Tilladelser';
$lang_versioncheck_php['version'] = 'Version';
$lang_versioncheck_php['revision'] = 'Revision';
$lang_versioncheck_php['modified'] = 'Ændret';
$lang_versioncheck_php['comment'] = 'Kommentar';
$lang_versioncheck_php['help'] = 'Hjælp';
$lang_versioncheck_php['repository_link'] = 'Arkiv link';
$lang_versioncheck_php['browse_corresponding_page_subversion'] = 'Vis side svarende til denne fil i projektets subversions arkiv';
$lang_versioncheck_php['mandatory'] = 'krævet';
$lang_versioncheck_php['mandatory_missing'] = 'Krævet fil mangler'; // cpg1.5
$lang_versioncheck_php['optional'] = 'ikke krævet';
$lang_versioncheck_php['removed'] = 'fjernet'; // cpg1.5
$lang_versioncheck_php['options'] = 'Muligheder';
$lang_versioncheck_php['display_output'] = 'Vis output';
$lang_versioncheck_php['on_screen'] = 'Fuld Skærm';
$lang_versioncheck_php['text_only'] = 'Kun Tekst';
$lang_versioncheck_php['errors_only'] = 'Vis kun potentielle fejl';
$lang_versioncheck_php['hide_images'] = 'Skjul billeder'; // cpg1.5
$lang_versioncheck_php['no_modification_check'] = 'Tjek ikke for ændrede filer'; // cpg1.5
$lang_versioncheck_php['do_not_connect_to_online_repository'] = 'Forbind ikke til online arkiv';
$lang_versioncheck_php['online_repository_explain'] = 'kun anbefalet hvis forbindelsen fejler';
$lang_versioncheck_php['submit'] = 'udfør / opdatere';
$lang_versioncheck_php['select_all'] = 'Vælg Alle'; // js-alert
$lang_versioncheck_php['files_folder_processed'] = 'Vis %s indhold af %s mapper/filer med %s potentiel problem';
$lang_versioncheck_php['read'] = 'Læs'; // cpg1.5
$lang_versioncheck_php['write'] = 'Skriv'; // cpg1.5
$lang_versioncheck_php['warning'] = 'Advarsel'; // cpg1.5
$lang_versioncheck_php['not_applicable'] = 'n/a'; // cpg1.5
}

// ------------------------------------------------------------------------- //
// File view_log.php
// ------------------------------------------------------------------------- //
if (defined('VIEWLOG_PHP')) {
$lang_viewlog_php['delete_all'] = 'Slet Alle Logs';
$lang_viewlog_php['delete_this'] = 'Slet denne Log';
$lang_viewlog_php['view_logs'] = 'Se Logs';
$lang_viewlog_php['no_logs'] = 'Ingen logs oprettet.';
$lang_viewlog_php['last_updated'] = 'senest opdatering'; // cpg1.5
}

// ------------------------------------------------------------------------- //
// File xp_publish.php
// ------------------------------------------------------------------------- //
if (defined('XP_PUBLISH_PHP')) {
$lang_xp_publish_php['title'] = 'XP Web Publishing Wizard';
$lang_xp_publish_php['client_header'] = 'XP Web Publishing Wizard Klient'; // cpg1.5
$lang_xp_publish_php['requirements'] = 'Krav'; // cpg1.5
$lang_xp_publish_php['windows_xp'] = 'Windows XP / Vista'; // cpg1.5
$lang_xp_publish_php['no_windows_xp'] = 'Det ser ud til at du bruger et ikke understøttet styresystem'; // cpg1.5
$lang_xp_publish_php['no_os_detect'] = 'Kunne ikke genkende dit styresystem'; // cpg1.5
$lang_xp_publish_php['requirement_http_upload'] = 'En fungerende installation af Coppermine hvor http upload funktion virker korrekt'; // cpg1.5
$lang_xp_publish_php['requirement_ie'] = 'Microsoft Internet Explorer'; // cpg1.5
$lang_xp_publish_php['requirement_permissions'] = 'Kræver at Administratoren af galleriet giver dig upload rettigheder'; // cpg1.5
$lang_xp_publish_php['requirement_login'] = 'Kræver du er logget ind for at uploade filer'; // cpg1.5
$lang_xp_publish_php['no_ie'] = 'Det ser ud til, at du bruger en ikke understøttet browser'; // cpg1.5
$lang_xp_publish_php['no_browser_detect'] = 'Kunne ikke genkende din browser'; // cpg1.5
$lang_xp_publish_php['no_gallery_name'] = 'Du mangler og angive et galleri navn i config'; // cpg1.5
$lang_xp_publish_php['no_gallery_description'] = 'Du mangler og angive en galleri forklaring i config'; // cpg1.5
$lang_xp_publish_php['howto_install'] = 'Sådan installeres'; // cpg1.5
$lang_xp_publish_php['install_right_click'] = 'Højre klik på %sdette link%s og vælg &quot;gem som...&quot;'; // cpg1.5 // translator note: don't replace the %s - that placeholder token needs to go untranslated
$lang_xp_publish_php['install_save'] = 'Gem filen på din maskine. Når du gemmer filen, så huske at det foreslåede fil navn er <tt>cpg_###.reg</tt> (hvor ### angiver et numerisk tidskode). Skift til dette navn om nødvendigt (Behold numrene)'; // cpg1.5
$lang_xp_publish_php['install_execute'] = 'Efter download er afsluttet, kør filen ved at dobbeltklikke på den for og registere din server med web publishing wizard'; // cpg1.5
$lang_xp_publish_php['usage'] = 'Brug'; // cpg1.5
$lang_xp_publish_php['select_files'] = 'I Denne Computer/Stifinder, vælg de filer du vil upload'; // cpg1.5
$lang_xp_publish_php['display_tasks'] = 'Værd sikker på, at mappen ikke vises i venstre side af stifinder'; // cpg1.5
$lang_xp_publish_php['publish_on_the_web'] = 'Klik på &quot;Udgiv xxx på websiden &quot; i venstre panel'; // cpg1.5
$lang_xp_publish_php['confirm_selection'] = 'Bekræft dit fil valg'; // cpg1.5
$lang_xp_publish_php['select_service'] = 'I listen af services, vælg dit foto galleri (det har dit galleri navn)'; // cpg1.5
$lang_xp_publish_php['enter_login'] = 'Indtast dine login oplysninger hvis krævet'; // cpg1.5
$lang_xp_publish_php['select_album'] = 'Vælg album for dine billeder eller lav et nyt'; // cpg1.5
$lang_xp_publish_php['next'] = 'Klik på &quot;næste&quot;'; // cpg1.5
$lang_xp_publish_php['upload_starts'] = 'Upload af dine filer skulle starte nu'; // cpg1.5
$lang_xp_publish_php['upload_completed'] = 'Når det er færdig, tjek dit galleri for og se om alle billeder er korrekt tilføjet'; // cpg1.5
$lang_xp_publish_php['welcome'] = 'Velkommen <strong>%s</strong>,';
$lang_xp_publish_php['need_login'] = 'Du skal logge ind i galleriet med Internet Explorer før du kan bruge denne wizard.<p/><p>Når du logger ind så glem ikke og vælg &quot;husk mig&quot; option hvis muligt.';
$lang_xp_publish_php['no_alb'] = 'Beklager der er ikke nogen album hvor du kan opload dine billeder med denne wizard.';
$lang_xp_publish_php['upload'] = 'Upload dine billeder til et eksisterende album';
$lang_xp_publish_php['create_new'] = 'Opret et nyt album til dine billeder';
$lang_xp_publish_php['category'] = 'Katagori';
$lang_xp_publish_php['new_alb_created'] = 'Dit nye album &quot;<strong>%s</strong>&quot; blev oprettet.';
$lang_xp_publish_php['continue'] = 'Tryk &quot;Næste&quot; for at starte upload af dine billeder';
$lang_xp_publish_php['link'] = '';
}

// ------------------------------------------------------------------------- //
// Core plugins
// ------------------------------------------------------------------------- //
if (defined('CORE_PLUGIN')) {
$lang_plugin_php['usergal_alphatabs_config_name'] = 'Bruger Galleri Alfabetisk Faneblads opdelt'; // cpg1.5
$lang_plugin_php['usergal_alphatabs_config_description'] = 'Hvad det gør: Viser  faner fra A til Z i toppen af Bruger galleriet hvor besøgende kan klikke og hoppe direkt til en side som viser alle bruger gallerier der starter med dette bogstav. Plugin kun anbefalet og bruge hvis du har mange bruger gallerier.'; // cpg1.5
$lang_plugin_php['usergal_alphatabs_jump_by_username'] = 'Hop til brugernavn'; // cpg1.5
$lang_plugin_php['sample_config_name'] = 'Prøve Plugin'; // cpg1.5
$lang_plugin_php['sample_config_description'] = 'Dette er et prøve plugin. Det vil ikke lave noget specielt - er kun ment som en demonstration af hvad plugins kan og hvordan at kode dem. Når enabled, vil det vise nogle prøve teksti rød.'; // cpg1.5
$lang_plugin_php['sample_plugin_documentation'] = 'Plugin Dokumentation'; // cpg1.5
$lang_plugin_php['sample_plugin_support'] = 'Plugin Support'; // cpg1.5
$lang_plugin_php['sample_install_explain'] = 'Indtast brugernavn (\'foo\') og kodeord (\'bar\') for at installere'; // cpg1.5
$lang_plugin_php['sample_install_username'] = 'Brugernavn'; // cpg1.5
$lang_plugin_php['sample_install_password'] = 'Kodeord'; // cpg1.5
$lang_plugin_php['sample_output'] = 'Dette er prøve data vist fra prøve plugin'; // cpg1.5
$lang_plugin_php['opensearch_config_name'] = 'OpenSearch'; // cpg1.5
$lang_plugin_php['opensearch_config_description'] = 'En implementering af <a href="http://www.opensearch.org/" rel="external" class="external">OpenSearch</a> for Coppermine.<br />Når enabled, besøgende kan tilføje dit galleri til deres browser\'s search bar.'; // cpg1.5
$lang_plugin_php['opensearch_search'] = 'Søg %s'; // cpg1.5
$lang_plugin_php['opensearch_extra'] = 'Du ønsker måske og tilføje en tekst til dit site som forklarer hvad dette plugin gør'; // cpg1.5
$lang_plugin_php['opensearch_failed_to_open_file'] = 'Kan ikke åbne filen %s - tjek rettigheder'; // cpg1.5
$lang_plugin_php['opensearch_failed_to_write_file'] = 'Kan ikke skrive til filen %s - tjek rettigheder'; // cpg1.5
$lang_plugin_php['opensearch_form_header'] = 'Indtast detaljer til brug i beskrivelsesfilen'; // cpg1.5
$lang_plugin_php['opensearch_gallery_url'] = 'Galleri URL (Skal være korrekt)'; // cpg1.5
$lang_plugin_php['opensearch_display_name'] = 'Navn som vist i browseren'; // cpg1.5
$lang_plugin_php['opensearch_description'] = 'Beskrivelse'; // cpg1.5
$lang_plugin_php['opensearch_character_limit'] = '%s Bogstavsbegrænsning'; // cpg1.5
$lang_plugin_php['onlinestats_description'] = 'Tilføj en blok på hver galleri side der viser hvilke bruger og gæster der er online.';
$lang_plugin_php['onlinestats_name'] = 'Hvem er online?';
$lang_plugin_php['onlinestats_config_extra'] = 'For at enable dette plugin (Får det til og vise onlinestats blokken), the string "onlinestats" (adskildt a et slash) er tilføjet til "indholdet af hovedsiden" i <a href="admin.php">Coppermine\'s config</a> i sektionen "Vis Albums ". Settings skulle nu ligne "breadcrumb/catlist/alblist/onlinestats" eller lignende. For at ændre position af blokken, flyt strengen "onlinestats" rundt inde i config feltet.';
$lang_plugin_php['onlinestats_config_install'] = 'Dette plugin kører ekstra forespørgsler til databsen hver gang det bliver afviklet, og bruger CPU ressourcer. Hvis dit Coppermine gallery er langsom eller har mange bruger, skulle du ikke bruge det.';
$lang_plugin_php['onlinestats_we_have_reg_member'] = 'Der er %s registreret bruger';
$lang_plugin_php['onlinestats_we_have_reg_members'] = ' Der er %s registrerede brugere';
$lang_plugin_php['onlinestats_most_recent'] = 'Seneste registreret bruger er %s';
$lang_plugin_php['onlinestats_is'] = 'I alt er der %s besøg online';
$lang_plugin_php['onlinestats_are'] = 'I alt er der %s besøgende online';
$lang_plugin_php['onlinestats_and'] = 'og';
$lang_plugin_php['onlinestats_reg_member'] = '%s registreret bruger';
$lang_plugin_php['onlinestats_reg_members'] = '%s registrerede brugere';
$lang_plugin_php['onlinestats_guest'] = '%s gæst';
$lang_plugin_php['onlinestats_guests'] = '%s gæster';
$lang_plugin_php['onlinestats_record'] = 'Højst antal bruger online: %s på %s';
$lang_plugin_php['onlinestats_since'] = 'Registrerede brugere der har været online de seneste %s minuter: %s';
$lang_plugin_php['onlinestats_config_text'] = 'Hvor længe ønsker du at beholde brugere listet online før de skal betragtes som værende væk igen?';
$lang_plugin_php['onlinestats_minute'] = 'minuter';
$lang_plugin_php['onlinestats_remove'] = 'Fjern tabel der var brugt til at gemme online data?';
$lang_plugin_php['link_target_name'] = 'Link target';
$lang_plugin_php['link_target_description'] = 'Ændre måden eksterne links åbnes: Når dette plugin er slået til, vil alle links der indeholder attributen rel="external" åbne i et nyt vindue (istedet for i samme vindue).';
$lang_plugin_php['link_target_extra'] = 'Dette plugin påvirker for det meste "Powered by Coppermine" linket i bunden af galleri siden.';
$lang_plugin_php['link_target_recommendation'] = 'Det anbefales ikke at bruge dette plugin for at genere dine brugere: Åbne links i nye vinduer genere dine brugere.';
}

?>