<?php
// ------------------------------------------------------------------------- //
//  Coppermine Photo Gallery                                                 //
// ------------------------------------------------------------------------- //
//  Copyright (C) 2002,2003  Gr�gory DEMAR <gdemar@wanadoo.fr>               //
//  http://www.chezgreg.net/coppermine/                                      //
// ------------------------------------------------------------------------- //
//  Based on PHPhotoalbum by Henning St�verud <henning@stoverud.com>         //
//  http://www.stoverud.com/PHPhotoalbum/                                    //
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
// ------------------------------------------------------------------------- //

$lang_charset = 'iso-8859-1';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('o', 'Ko', 'Mo');

// Day of weeks and months
$lang_day_of_week = array('Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam');
$lang_month = array('Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Aout', 'Sep', 'Oct', 'Nov', 'Dec');

// Some common strings
$lang_yes = 'OUI';
$lang_no  = 'NON';
$lang_back = 'RETOUR';
$lang_continue = 'CONTINUER';
$lang_info = 'Information';
$lang_error = 'Erreur';

// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt =    '%d %B %Y';
$lastcom_date_fmt =  '%d/%m/%y � %H:%M';
$lastup_date_fmt = '%d %B %Y';
$register_date_fmt = '%d %B %Y';
$lasthit_date_fmt = '%d %B %Y � %H:%M';
$comment_date_fmt =  '%d %B %Y � %H:%M';

// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array(
	'random' => 'Images au hasard',
	'lastup' => 'Derniers ajouts',
	'lastcom' => 'Derniers commentaires',
	'topn' => 'Les plus populaires',
	'toprated' => 'Les mieux not�es',
	'lasthits' => 'Derni�res vues',
	'search' => 'R�sultats de recherche'
);

$lang_errors = array(
	'access_denied' => 'Vous n\'�tes pas autoris� � acc�der � cette page.',
	'perm_denied' => 'Vous n\'�tes pas autoris� � effectuer cette op�ration.',
	'param_missing' => 'Param�tre requis par le script manquant',
	'non_exist_ap' => 'Cet album ou image n\'existe pas !',
	'quota_exceeded' => 'Quota d�pass� !<br /><br />Vous disposez de [quota]K, vous utilisez actuellement [space]K, l\'image que vous voulez ajouter est trop lourde.',
	'gd_file_type_err' => 'Seuls les formats JPG et PNG sont accept�s.',
	'invalid_image' => 'Image corrompue ou format inadapt�',
	'resize_failed' => 'Impossible de modifier l\'image.',
	'no_img_to_display' => 'Pas d\'image � afficher',
	'non_exist_cat' => 'Cette cat�gorie n\'existe pas',
	'orphan_cat' => 'Une cat�gorie n\'est pas rattach�e � un album, corrigez l\'erreur avec le gestionnaire de cat�gories.',
	'directory_ro' => '\'%s\' en lecture seule, les images ne peuvent �tre effac�es',
	'non_exist_comment' => 'Ce commentaire n\'existe pas.',
	'pic_in_invalid_album' => 'L\'image se trouve dans un album (%s) inexistant !?'
);

// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //

$lang_main_menu = array(
	'alb_list_title' => 'Aller � la liste des albums',
	'alb_list_lnk' => 'Liste des albums',
	'my_gal_title' => 'Aller � ma gallerie personnelle',
	'my_gal_lnk' => 'Ma gallerie',
	'my_prof_lnk' => 'Mon profil',
	'adm_mode_title' => 'Passer en mode admin',
	'adm_mode_lnk' => 'Mode admin',
	'usr_mode_title' => 'Passer en mode utilisateur',
	'usr_mode_lnk' => 'Mode utilisateur',
	'upload_pic_title' => 'Ajouter une image dans un album',
	'upload_pic_lnk' => 'Ajouter une image',
	'register_title' => 'Cr��r un compte',
	'register_lnk' => 'Inscription',
	'login_lnk' => 'S\'identifier',
	'logout_lnk' => 'Quitter',
	'lastup_lnk' => 'Derniers ajouts',
	'lastcom_lnk' => 'Derniers commentaires',
	'topn_lnk' => 'Les plus populaires',
	'toprated_lnk' => 'Les mieux not�es',
	'search_lnk' => 'Chercher',
);

$lang_gallery_admin_menu = array(
	'upl_app_lnk' => 'Validation',
	'config_lnk' => 'Configuration',
	'albums_lnk' => 'Albums',
	'categories_lnk' => 'Categories',
	'users_lnk' => 'Utilisateurs',
	'groups_lnk' => 'Groupes',
	'comments_lnk' => 'Commentaires',
	'searchnew_lnk' => 'FTP =>',
);

$lang_user_admin_menu = array(
	'albmgr_lnk' => 'Cr��r / organiser mes albums',
	'modifyalb_lnk' => 'Modifier mes albums',
	'my_prof_lnk' => 'Mon profil',
);

$lang_cat_list = array(
	'category' => 'Cat�gories',
	'albums' => 'Albums',
	'pictures' => 'Images',
);

$lang_album_list = array(
	'album_on_page' => '%d albums sur %d page(s)'
);

$lang_thumb_view = array(
	'date' => 'DATE',
	'name' => 'NOM',
	'sort_da' => 'Classer par Date croissante',
	'sort_dd' => 'Classer par Date d�croissante',
	'sort_na' => 'Classer par Nom croissant',
	'sort_nd' => 'Classer par Nom d�croissant',
	'pic_on_page' => '%d images sur %d page(s)',
	'user_on_page' => '%d utilisateurs sur %d page(s)'
);

$lang_img_nav_bar = array(
	'thumb_title' => 'Retour � la page des vignettes',
	'pic_info_title' => 'Voir/cacher les informations de l\'image',
	'slideshow_title' => 'Diaporama',
	'ecard_title' => 'Envoyer cette image comme carte postale',
	'ecard_disabled' => 'Cartes postales non disponibles',
	'ecard_disabled_msg' => 'Vous ne pouvez pas envoyer de cartes postales',
	'prev_title' => 'Image pr�c�dente',
	'next_title' => 'Image suivante',
	'pic_pos' => 'IMAGE %s/%s',
);

$lang_rate_pic = array(
	'rate_this_pic' => 'Noter cette image ',
	'no_votes' => '(Aucune note)',
	'rating' => '(Note : %s / 5 avec %s votes)',
	'rubbish' => 'Nulle',
	'poor' => 'Bof',
	'fair' => 'Moyenne',
	'good' => 'Bien',
	'excellent' => 'Chouette',
	'great' => 'G�niale',
);

// ------------------------------------------------------------------------- //
// File include/exif.inc.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File include/functions.inc.php
// ------------------------------------------------------------------------- //

$lang_cpg_die = array(
	INFORMATION => $lang_info,
	ERROR => $lang_error,
	CRITICAL_ERROR => 'Erreur Critique',
	'file' => 'Fichier: ',
	'line' => 'Ligne: ',
);

$lang_display_thumbnails = array(
	'filename' => 'Fichier : ',
	'filesize' => 'Poids : ',
	'dimensions' => 'Dimensions : ',
	'date_added' => 'Date : '
);

$lang_get_pic_data = array(
	'n_comments' => '%s commentaires',
	'n_views' => 'vue %s fois',
	'n_votes' => '(%s votes)'
);

// ------------------------------------------------------------------------- //
// File include/init.inc.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File include/picmgmt.inc.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File include/smilies.inc.php
// ------------------------------------------------------------------------- //

if (defined('SMILIES_PHP')) $lang_smilies_inc_php = array(
	'Exclamation' => 'Exclamation',
	'Question' => 'Question',
	'Very Happy' => 'Tr�s content',
	'Smile' => 'Sourire',
	'Sad' => 'Triste',
	'Surprised' => 'Surpris',
	'Shocked' => 'Choqu�',
	'Confused' => 'Confus',
	'Cool' => 'Cool',
	'Laughing' => 'LOL',
	'Mad' => 'Fou',
	'Razz' => 'Razz',
	'Embarassed' => 'Embarass�',
	'Crying or Very sad' => 'Pleurs ou tr�s triste',
	'Evil or Very Mad' => 'D�moniaque ou tr�s fou',
	'Twisted Evil' => 'Super d�mon',
	'Rolling Eyes' => 'N\'importe quoi',
	'Wink' => 'Clin d\'oeil',
	'Idea' => 'Id�e',
	'Arrow' => 'Fl�che',
	'Neutral' => 'Neutre',
	'Mr. Green' => 'Mr. Green',
);

// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //

// void

// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //

if (defined('ADMIN_PHP')) $lang_admin_php = array(
	0 => 'Quitte le mode administrateur...',
	1 => 'Entr�e dans le mode administrateur...',
);

// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //

if (defined('ALBMGR_PHP')) $lang_albmgr_php = array(
	'alb_need_name' => 'Les albums doivent avoir un nom !',
	'confirm_modifs' => 'Effectuer les modifications ?',
	'no_change' => 'Pas de changement !',
	'new_album' => 'Nouvel album',
	'confirm_delete1' => 'Effacer cet album ?',
	'confirm_delete2' => '\nToutes les images et commentaires seront perdus !',
	'select_first' => 'Veuillez choisir un album',
	'alb_mrg' => 'Gestionnaire d\'albums',
	'my_gallery' => '* Ma Gallerie *',
	'no_category' => '* Pas de Categorie *',
	'delete' => 'Effacer',
	'new' => 'Cr��r',
	'apply_modifs' => 'Effectuer les Changements',
	'select_category' => 'Choix Categorie'
);

// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //

if (defined('CATMGR_PHP')) $lang_catmgr_php = array(
	'miss_param' => 'Param�tre manquant pour faire l\'op�ration : \'%s\' !',
	'unknown_cat' => 'Cette cat�gorie n\'existe pas dans la base de donn�es',
	'usergal_cat_ro' => 'Cette cat�gorie ne peut �tre effac�e !',
	'manage_cat' => 'Modifier les cat�gories',
	'confirm_delete' => 'SUPPRIMER cette Cat�gorie ?',
	'category' => 'Cat�gories',
	'operations' => 'Op�rations',
	'move_into' => 'D�placer dans',
	'update_create' => 'Modifier/cr��r une cat�gorie',
	'parent_cat' => 'Affiliation de la cat�gorie',
	'cat_title' => 'Titre de la cat�gorie',
	'cat_desc' => 'Description de la cat�gorie'
);

// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //

if (defined('CONFIG_PHP')) $lang_config_php = array(
	'title' => 'Configuration',
	'restore_cfg' => 'Restaurer les valeurs par d�faut',
	'save_cfg' => 'Enregistrer la nouvelle configuration',
	'notes' => 'Notes',
	'info' => 'Information',
	'upd_success' => 'Configuration mise � jour',
	'restore_success' => 'Configuration restaur�e',
	'name_a' => 'Nom croissant',
	'name_d' => 'Nom d�croissant',
	'date_a' => 'Date croissante',
	'date_d' => 'Date d�croissante'
);

if (defined('CONFIG_PHP')) $lang_config_data = array(
	'Configuration g�n�rale',
	array('Nom de la gallerie', 'gallery_name', 0),
	array('Description de la gallerie', 'gallery_description', 0),
	array('Contact administrateur', 'gallery_admin_email', 0),
	array('Adresse du lien \'Voir d\'autres Images\' des cartes postales', 'ecards_more_pic_target', 0),
	array('Langue', 'lang', 5),
	array('Theme', 'theme', 6),

	'La liste des albums',
	array('Largeur page principale (pixels ou %)', 'main_table_width', 0),
	array('Niveau de sous-cat�gories � afficher', 'subcat_level', 0),
	array('Nombre d\'albums � afficher', 'albums_per_page', 0),
	array('Nombre de colonnes pour les Albums', 'album_list_cols', 0),
	array('Dimensions des vignettes en pixels', 'alb_list_thumb_size', 0),
	array('Contenu de la Page d\'accueil', 'main_page_layout', 0),

	'La vue "vignette"',
	array('Nombre de colonnes pour les vignettes', 'thumbcols', 0),
	array('Nombre de lignes pour les vignettes', 'thumbrows', 0),
	array('Nombre maximum d\'onglets maximum', 'max_tabs', 0),
	array('Afficher la description sous la vignette (en plus du titre)', 'caption_in_thumbview', 1),
	array('Afficher le nombre de commentaire', 'display_comment_count', 1),
	array('Ordre de tri par d�faut des images', 'default_sort_order', 3),
	array('Nombre minimum de votes pour figurer dans les \'Mieux not�es\'', 'min_votes_for_rating', 0),

	'Vue "image" &amp; commentaires',
	array('Largeur de la table des images (pixels ou %)', 'picture_table_width', 0),
	array('Informations sur l\'image visibles par d�faut', 'display_pic_info', 1),
	array('Filtrer les mots interdits', 'filter_bad_words', 1),
	array('Activer les smileys', 'enable_smilies', 1),
	array('Longueur maximum de la description d\'une image\'', 'max_img_desc_length', 0),
	array('Longueur maximum d\'un mot', 'max_com_wlength', 0),
	array('Nombre maximum de ligne', 'max_com_lines', 0),
	array('Longueur maximum d\'un commentaire', 'max_com_size', 0),

	'Les images et les vignettes',
	array('Qualit� des images JPG', 'jpeg_qual', 0),
	array('Largeur/hauteur max pour les vignettes <b>*</b>', 'thumb_width', 0),
	array('Cr�er des images intermediaires','make_intermediate',1),
	array('Largeur/hauteur max pour les images intermediaires <b>*</b>', 'picture_width', 0),
	array('Taille maximum des images t�l�charg�es (Ko)', 'max_upl_size', 0),
	array('Largeur/hauteur maximum pour les images t�l�charg�es (pixels)', 'max_upl_width_height', 0),

	'Les utilisateurs',
	array('Autoriser les inscriptions', 'allow_user_registration', 1),
	array('V�rification de l\'email lors de l\'inscription', 'reg_requires_valid_email', 1),
	array('Autoriser les doublons email', 'allow_duplicate_emails_addr', 1),
	array('Les utilisateurs peuvent avoir des albums priv�s', 'allow_private_albums', 1),

	'Les champs configurables pour la description des images (laisser vide si inutilis�)',
	array('Nom champ 1', 'user_field1_name', 0),
	array('Nom champ 2', 'user_field2_name', 0),
	array('Nom champ 3', 'user_field3_name', 0),
	array('Nom champ 4', 'user_field4_name', 0),

	'Configuration avanc�e pour les images et les vignettes',
	array('Caract�res interdits dans les noms de fichiers', 'forbiden_fname_char',0),
	array('Extensions accept�es', 'allowed_file_extensions',0),
	array('Methode de redimensionnement','thumb_method',2),
	array('Chemin vers ImageMagick \'convert\'(example /usr/bin/X11/)', 'impath', 0),
	array('Autoriser les types (uniquement pour ImageMagick)', 'allowed_img_types',0),
	array('Options de ligne de commande pour ImageMagick', 'im_options', 0),
	array('Lire les infos EXIF dans les fichiers JPEG', 'read_exif_data', 1),
	array('R�pertoire des albums <b>*</b>', 'fullpath', 0),
	array('R�pertoire des albums des utilisateurs <b>*</b>', 'userpics', 0),
	array('Pr�fixe des images intermediaires <b>*</b>', 'normal_pfx', 0),
	array('Pr�fixe des vignettes <b>*</b>', 'thumb_pfx', 0),
	array('Mode par d�faut des r�pertoires', 'default_dir_mode', 0),
	array('Mode par d�faut des images', 'default_file_mode', 0),

	'Cookies &amp; jeux de caract�re',
	array('Nom du cookie', 'cookie_name', 0),
	array('Chemin du cookie', 'cookie_path', 0),
	array('Jeux de caract�re', 'charset', 4),

	'Divers',
	array('Activer le mode debug', 'debug_mode', 1),

	'<br /><div align="center">(*) Les champs marqu�s d\'un * ne doivent pas �tre modifi�s si des images existent d�j� !</div><br />'
);

// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //

if (defined('DB_INPUT_PHP')) $lang_db_input_php = array(
	'empty_name_or_com' => 'Veuillez indiquer votre nom et taper un commentaire',
	'com_added' => 'Commentaire ajout�',
	'alb_need_title' => 'Il faut donner un titre � l\'album !',
	'no_udp_needed' => 'Aucun changement.',
	'alb_updated' => 'Album mis � jour',
	'unknown_album' => 'Cette album n\'existe pas ou vous ne pouvez pas y acc�der',
	'no_pic_uploaded' => 'Aucune image re�ue !',
	'err_mkdir' => 'Impossible de cr��r le r�pertoire %s !',
	'dest_dir_ro' => 'R�pertoire %s en lecture seule !',
	'err_move' => 'Impossible de d�placer %s vers %s !',
	'err_fsize_too_large' => 'Image trop grande (maximum : %s x %s) !',
	'err_imgsize_too_large' => 'Image trop lourde (maximum : %s KB) !',
	'err_invalid_img' => 'Image invalide !',
	'allowed_img_types' => 'Seules les images %s sont accept�es',
	'err_insert_pic' => 'L\'image \'%s\' ne peut �tre ajout�e ',
	'upload_success' => 'Image ajout�e<br /><br />Elle sera visible apr�s approbation',
	'info' => 'Information',
	'com_added' => 'Commentaire ajout�',
	'alb_updated' => 'Album mis � jour',
	'err_comment_empty' => 'Votre commentaire est vide !',
	'err_invalid_fext' => 'Seuls les extensions suivantes sont acc�pt�es : <br /><br />%s.',
	'no_flood' => 'Vous �tes d�j� l\'auteur du dernier commentaires post� pour cette image\'<br /><br />Vous pouvez le modifier en cas d\'oubli ou d\'erreur...',
	'redirect_msg' => 'Vous allez �tre redirig�.<br /><br /><br />Cliquez \'CONTINUER\' si rien ne se passe...',
	'upl_success' => 'Votre image a �t� ajout�e',
);

// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //

if (defined('DELETE_PHP')) $lang_delete_php = array(
	'caption' => 'L�gende',
	'fs_pic' => 'image taille r��lle',
	'del_success' => 'effac�',
	'ns_pic' => 'image taille normale',
	'err_del' => 'ne peut �tre effac�',
	'thumb_pic' => 'vignette',
	'comment' => 'commentaire',
	'im_in_alb' => 'image dans l\'album',
	'alb_del_success' => 'Album \'%s\' effac�',
	'alb_mgr' => 'Gestionnaire d\'albums\'',
	'err_invalid_data' => 'donn�es invalides pour \'%s\'',
	'create_alb' => 'Creation de l\'album \'%s\'',
	'update_alb' => 'Mise � jour de l\'album \'%s\' (titre \'%s\' - index \'%s\')',
	'del_pic' => 'Effacer l\'image',
	'del_alb' => 'Effacer l\'album',
	'del_user' => 'Effacer l\'utilisateur',
	'err_unknown_user' => 'Cet utilisateur n\'existe pas !',
	'comment_deleted' => 'Commentaire effac�',
);

// ------------------------------------------------------------------------- //
// File displayecard.php
// ------------------------------------------------------------------------- //

// Void

// ------------------------------------------------------------------------- //
// File displayimage.php
// ------------------------------------------------------------------------- //

if (defined('DISPLAYIMAGE_PHP')){

$lang_display_image_php = array(
	'confirm_del' => 'Effacer cette image ? \\nTous les commentaires seront perdus.',
	'del_pic' => 'EFFACER L\'IMAGE',
	'size' => '%s x %s pixels',
	'views' => 'vue %s fois',
	'slideshow' => 'Diaporama',
	'stop_slideshow' => 'STOPPER LE DIAPORAMA',
	'view_fs' => 'Cliquez pour agrandir'
);

$lang_picinfo = array(
	'title' =>'Information',
	'Filename' => 'Nom',
	'Album name' => 'Album',
	'Rating' => 'Note (%s votes)',
	'Keywords' => 'Mots Cl�s',
	'File Size' => 'Poids',
	'Dimensions' => 'Dimensions',
	'Displayed' => 'Affichage',
	'Camera' => 'Appareil',
	'Date taken' => 'Date',
	'Aperture' => 'Diaphragme',
	'Exposure time' => 'Exposition',
	'Focal length' => 'Focale',
	'Comment' => 'Commentaire'
);

$lang_display_comments = array(
	'OK' => 'OK',
	'edit_title' => 'Modifier le commetaire',
	'confirm_delete' => 'Effacer le commentaire ?',
	'add_your_comment' => 'Ajouter un commentaire',
	'your_name' => 'Votre Nom',
);

}

// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //

if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php =array(
	'title' => 'Envoyer une carte postale',
	'invalid_email' => '<b>Attention</b> : email erron� !',
	'ecard_title' => '%s vous envoie une carte postale',
	'view_ecard' => 'Si vous ne voyez pas la carte cliquez sur le lien',
	'view_more_pics' => 'Voir d\'autres images !',
	'send_success' => 'Carte postale envoy�e',
	'send_failed' => 'Impossible d\'envoyer la carte...',
	'from' => 'De',
	'your_name' => 'Votre nom',
	'your_email' => 'Votre email',
	'to' => 'A',
	'rcpt_name' => 'Nom destinataire',
	'rcpt_email' => 'Email destinataire',
	'greetings' => 'Salutations',
	'message' => 'Message',
);

// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //

if (defined('EDITPICS_PHP')) $lang_editpics_php = array(
	'pic_info' => 'Info&nbsp;image',
	'album' => 'Album',
	'title' => 'Titre',
	'desc' => 'Description',
	'keywords' => 'Mots Cl�s',
	'pic_info_str' => '%sx%s - %sKB - vues %s fois - %s votes',
	'approve' => 'Approuver l\'image',
	'postpone_app' => 'Diff�rer l\'approbation',
	'del_pic' => 'Effacer l\'image',
	'reset_view_count' => 'Remettre le compteur de vues � z�ro',
	'reset_votes' => 'Remettre les votes � z�ro',
	'del_comm' => 'Effacer les commentaires',
	'upl_approval' => 'Approbation des chargement',
	'edit_pics' => 'Modifier les images',
	'see_next' => 'Images suivantes',
	'see_prev' => 'Images pr�c�dentes',
	'n_pic' => '%s Images',
	'n_of_pic_to_disp' => 'Nombre d\'images � afficher',
	'apply' => 'Effectuer les Modifications'
);

// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //

if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array(
	'group_name' => 'Nom du groupe',
	'disk_quota' => 'Quota disque',
	'can_rate' => 'Noter les images',
	'can_send_ecards' => 'Envoyer des Cartes',
	'can_post_com' => 'Poster des commentaires',
	'can_upload' => 'T�l�charger des images',
	'can_have_gallery' => 'Gallerie personnelle',
	'apply' => 'Effectuer les modifications',
	'create_new_group' => 'Cr��r un groupe',
	'del_groups' => 'Effacer le(s) groupe(s)',
	'confirm_del' => 'En effacant des groupes les utilisateurs de ces groupes passeront dans le groupe \'Inscris\' !\n\nContinuer ?',
	'title' => 'Gestionnaire de groupes',
	'approval_1' => 'Pub. Upl. approbation (1)',
	'approval_2' => 'Priv. Upl. approbation (2)',
	'note1' => '<b>(1)</b> Charger dans un album publique exige l\'approbation de l\'admin',
	'note2' => '<b>(2)</b> Charger dans l\'album utilisateur exige l\'approbation de l\'admin',
	'notes' => 'Notes'
);

// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //

if (defined('INDEX_PHP')){

$lang_index_php = array(
	'welcome' => 'Bienvenue !'
);

$lang_album_admin_menu = array(
	'confirm_delete' => 'EFFACER CET ALBUM ? \\nLes images et commentaires seront perdus.',
	'delete' => 'EFFACER',
	'modify' => 'PROPRIETES',
	'edit_pics' => 'MODIF IMG',
);

$lang_list_categories = array(
	'home' => 'Accueil',
	'stat1' => '<b>[pictures]</b> images dans <b>[albums]</b> albums et <b>[cat]</b> cat�gories avec <b>[comments]</b> commentaires vues <b>[views]</b> fois',
	'stat2' => '<b>[pictures]</b> images dans <b>[albums]</b> albums, vues <b>[views]</b> fois',
	'xx_s_gallery' => 'Gallerie de %s',
	'stat3' => '<b>[pictures]</b> images dans <b>[albums]</b> albums avec <b>[comments]</b> commentaires vues <b>[views]</b> fois'
);

$lang_list_users = array(
	'user_list' => 'Utisateurs',
	'no_user_gal' => 'Aucun utilisateur ne poss�de d\'albums',
	'n_albums' => '%s album(s)',
	'n_pics' => '%s image(s)'
);

$lang_list_albums = array(
	'n_pictures' => '%s images',
	'last_added' => ', dernier ajout %s'
);

}

// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //

if (defined('LOGIN_PHP')) $lang_login_php = array(
	'login' => 'S\'identifier',
	'enter_login_pswd' => 'Indiquez votre nom et mot de passe',
	'username' => 'Nom',
	'password' => 'Mot de Passe',
	'remember_me' => 'Se souvenir de moi',
	'welcome' => 'Bienvenue %s ...',
	'err_login' => '*** LOGIN IMPOSSIBLE... REESSAYEZ ***',
	'err_already_logged_in' => 'Vous �tes d�j� identifi� !',
);

// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //

if (defined('LOGOUT_PHP')) $lang_logout_php = array(
	'logout' => 'Se deconnecter',
	'bye' => 'Au revoir %s ...',
	'err_not_loged_in' => 'Vous n\'�tes pas connect� !',
);

// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //

if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array(
	'upd_alb_n' => 'Modifier album %s',
	'general_settings' => 'R�glages g�n�raux',
	'alb_title' => 'Titre de l\'album',
	'alb_cat' => 'Cat�gorie de l\'album',
	'alb_desc' => 'Description de l\'album',
	'alb_thumb' => 'Vignette de l\'album',
	'alb_perm' => 'Permissions',
	'can_view' => 'Album visible par',
	'can_upload' => 'Uploads autoris�s',
	'can_post_comments' => 'Commentaires autoris�s',
	'can_rate' => 'Votes autoris�s',
	'user_gal' => 'Galleries des utilisateurs',
	'no_cat' => '* Pas de Cat�gorie *',
	'alb_empty' => 'Album vide',
	'last_uploaded' => 'Dernier ajout',
	'public_alb' => 'Tout le monde',
	'me_only' => 'Seulement moi',
	'owner_only' => 'Propri�taire (%s) seulement',
	'groupp_only' => 'Membres du groupe \'%s\'',
	'err_no_alb_to_modify' => 'Pas d\'album modifiable.',
	'update' => 'Mise � jour'
);

// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //

if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array(
	'already_rated' => 'Vous avez d�j� vot� pour cette image',
	'rate_ok' => 'Vote accept�',
);

// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //

if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {

$lang_register_disclamer = <<<EOT
Les administrateurs de {SITE_NAME} s'efforceront de supprimer ou �diter tous les documents � caract�re r�pr�hensible aussi rapidement que possible. Toutefois, il leur est impossible de passer en revue tous les documents. Vous admettez donc que tous les documents post�s sur ce site expriment la vue et opinion de leurs auteurs respectifs, et non pas des administrateurs, ou webmestres (except� les messages post�s par eux-m�me) qui par cons�quent ne peuvent pas �tre tenus pour responsables.<br />
<br />
Vous consentez � ne pas poster de contenus injurieux, obsc�nes, vulgaires, diffamatoires, mena�ants, sexuels ou tout autre contenu qui violerait les lois applicables. Vous �tes d'accord sur le fait que le webmestre et l'administrateur de {SITE_NAME} ont le droit de supprimer, �diter, n'importe quel contenu � tout moment. En tant qu'utilisateur, vous �tes d'accord sur le fait que toutes les informations que vous donnerez ci-apr�s seront stock�es dans une base de donn�es. Cependant, ces informations ne seront divulgu�es � aucune tierce personne ou soci�t� sans votre accord. Le webmestre et l'administrateur ne peuvent pas �tre tenus pour responsables si une tentative de piratage informatique conduit � l'acc�s de ces donn�es.<br />
<br />
Ce site utilise les cookies pour stocker des informations sur votre ordinateur. Ces cookies servent uniquement � am�liorer le confort d'utilisation. L'adresse e-mail est uniquement utilis�e afin de confirmer les d�tails de votre enregistrement ainsi que votre mot de passe.<br />
<br />
En vous enregistrant, vous acceptez le r�glement ci-dessus.
EOT;

$lang_register_php = array(
	'page_title' => 'Inscription',
	'term_cond' => 'Conditions d\'Utilisation',
	'i_agree' => 'Je suis d\'accord',
	'submit' => 'S\'INSCRIRE',
	'err_user_exists' => 'Ce nom est d�j� utilis�... veuillez en choisir un autre',
	'err_password_mismatch' => 'Vos mots de passe sont diff�rents...',
	'err_uname_short' => 'Le nom doit comporter au moins 2 caract�res',
	'err_password_short' => 'Il faut au moins 2 caract�res pour le mot de passe',
	'err_uname_pass_diff' => 'Le nom et le mot de passe doivent �tre diff�rent',
	'err_invalid_email' => 'Email erron� !',
	'err_duplicate_email' => 'Cet Email est d�j� utilis� !!',
	'enter_info' => 'Information d\'inscription',
	'required_info' => 'Informations obligatoires',
	'optional_info' => 'Infos optionnelles',
	'username' => 'Nom',
	'password' => 'Mot de passe',
	'password_again' => 'Retaper le mot de passe',
	'email' => 'Email',
	'location' => 'Localisation',
	'interests' => 'Hobbies',
	'website' => 'URL',
	'occupation' => 'Profession',
	'error' => 'ERREUR',
	'confirm_email_subject' => '%s - Inscription',
	'information' => 'Information',
	'failed_sending_email' => 'Inscription impossible : impossible d\'envoyer l\'email !',
	'thank_you' => 'Merci de vous �tes inscrit.<br /><br />Un Email vous a �t� envoy� pour activer votre compte.',
	'acct_created' => 'Votre compte a �t� cr��, vous pouvez vous connecter avec votre nom et votre mot de passe',
	'acct_active' => 'Votre compte est maintenant activ�, vous pouvez vous connecter avec votre nom et votre mot de passe',
	'acct_already_act' => 'Votre compte a d�j� �t� activ� !',
	'acct_act_failed' => 'Ce compte ne peut �tre activ� !',
	'err_unk_user' => 'Cet utlisateur n\'existe pas !',
	'x_s_profile' => 'Profil de %s',
	'group' => 'Groupe',
	'reg_date' => 'Inscrit le',
	'disk_usage' => 'Espace utilis�',
	'change_pass' => 'Changer le mot de passe',
	'current_pass' => 'Mot de passe actuel',
	'new_pass' => 'Nouveau mot de passe',
	'new_pass_again' => 'Retaper le mot de passe',
	'err_curr_pass' => 'Mot de passe incorrect',
	'apply_modif' => 'Modifier',
	'change_pass' => 'Changer mon mot de passe',
	'update_success' => 'Profil mis � jour',
	'pass_chg_success' => 'Mot de passe chang�',
	'pass_chg_error' => 'Mot de passe inchang�',
);

$lang_register_confirm_email = <<<EOT
Bienvenue sur {SITE_NAME}
Merci de vous �tes inscrits, voici vos codes :

Nom : "{USER_NAME}"
Mot de Passe : "{PASSWORD}"

Pour activer votre compte, cliquez sur le lien ci-dessous ou faites en un copier/coller dans votre navigateur :

{ACT_LINK}

Cordialement,
L'�quipe de {SITE_NAME}

EOT;

}

// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //

if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array(
	'title' => 'COMMENTAIRES',
	'no_comment' => 'Aucun commentaires',
	'n_comm_del' => '%s commentaire(s) effac�(s)',
	'n_comm_disp' => 'Nombre de commentaires � afficher',
	'see_prev' => 'Pr�c�dent',
	'see_next' => 'Suivant',
	'del_comm' => 'Effacer les commentaires s�lectionn�s',
);


// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //

if (defined('SEARCH_PHP')) $lang_search_php = array(
	0 => 'RECHERCHE',
);

// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //

if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array(
	'page_title' => 'Chercher les nouvelles images',
	'select_dir' => 'Choix du r�pertoire',
	'select_dir_msg' => 'Permet d\'ajouter � un album les images plac�es sur votre serveur via FTP.<br /><br />Choisir le r�pertoire ou vous avez plac� vos images',
	'no_pic_to_add' => 'Pas d\'image � ajouter',
	'need_one_album' => 'Il faut disposer d\'au moins 1 album',
	'warning' => 'Attention',
	'change_perm' => 'r�pertoire en lecture seule, v�rifiez les droits (755 ou 777) !',
	'target_album' => '<b>Placer les images de &quot;</b>%s<b>&quot; dans </b>%s',
	'folder' => 'Dossier',
	'image' => 'Image',
	'album' => 'Album',
	'result' => 'Resultat',
	'dir_ro' => 'En lecture seule. ',
	'dir_cant_read' => 'Ne peut �tre lu. ',
	'insert' => 'Ajout d\'images dans la gallerie',
	'list_new_pic' => 'Listes des nouvelles images',
	'insert_selected' => 'Ajouter les images s�lectionn�es',
	'no_pic_found' => 'Aucune image � ajouter',
	'be_patient' => 'Patientez, chargement des images en cours...',
	'notes' =>  '<ul>'.
				'<li><b>OK</b> : image ajout�e'.
				'<li><b>DP</b> : image en double'.
				'<li><b>PB</b> : image non ajout�e'.
				'<li>Si les signes OK, DP, PB ne sont pas visibles cliquez sur l\'image \'cass�e\' pour connaitre l\'erreur PHP'.
				'<li>Si votre navigateur cesse de charger les images, rafraichissez la page'.
				'</ul>',
);


// ------------------------------------------------------------------------- //
// File thumbnails.php
// ------------------------------------------------------------------------- //

// Void


// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //

if (defined('UPLOAD_PHP')) $lang_upload_php = array(
	'title' => 'Chargement d\'Image',
	'max_fsize' => 'Poids maximum : %s KB',
	'album' => 'Album',
	'picture' => 'Image',
	'pic_title' => 'Titre',
	'description' => 'Description',
	'keywords' => 'Mots Cl�s (s�par�s par des espaces)',
	'err_no_alb_uploadables' => 'Vous ne pouvez pas charger d\'images... ',
);

// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //

if (defined('USERMGR_PHP')) $lang_usermgr_php = array(
	'title' => 'GESTION UTILISATEURS',
	'name_a' => 'Nom croissant',
	'name_d' => 'Nom d�croissant',
	'group_a' => 'Groupe croissant',
	'group_d' => 'Groupe d�croissant',
	'reg_a' => 'Date inscript. croissante',
	'reg_d' => 'Date inscript. d�croissante',
	'pic_a' => 'Nbre images croissant',
	'pic_d' => 'Nbre images d�croissant',
	'disku_a' => 'Volume croissant',
	'disku_d' => 'Volume d�croissant',
	'sort_by' => 'Classer les Utilisateurs par',
	'err_no_users' => 'Pas d\'utilisateur !',
	'err_edit_self' => 'Pour �diter votre profil, allez � la section \'Mon Profil\'...',
	'edit' => 'MODIFIER',
	'delete' => 'EFFACER',
	'name' => 'Nom',
	'group' => 'Groupe',
	'inactive' => 'Inactif',
	'operations' => 'Operations',
	'pictures' => 'Images',
	'disk_space' => 'Utilis� / Quota',
	'registered_on' => 'Inscrit le',
	'u_user_on_p_pages' => '%d utilisateurs sur %d page(s)',
	'confirm_del' => 'EFFACER cet utilisateur ? \\nSes photos/albums seront perdus',
	'mail' => 'Email',
	'err_unknown_user' => 'Cet ulisateur n\'existe pas !',
	'modify_user' => 'Modfier',
	'notes' => 'Notes',
	'note_list' => '<li>Pour ne pas modifier le mot de passe, laissez le champ vide...',
	'password' => 'Mot de Passe',
	'user_active' => 'Uilisateur Actif',
	'user_group' => 'Groupe',
	'user_email' => 'Email',
	'user_web_site' => 'URL',
	'create_new_user' => 'CREER UTILISATEUR',
	'user_location' => 'Localisation',
	'user_interests' => 'Hobbies',
	'user_occupation' => 'Profession',
);

// ------------------------------------------------------------------------- //
// File xp_publish.php
// ------------------------------------------------------------------------- //

if (defined('XP_PUBLISH_PHP')) $lang_xp_publish_php = array(
	'title' => 'Coppermine - Assistant de publication web XP',
	'welcome' => 'Bienvenue <b>%s</b>,',
	'need_login' => 'Vous devez vous identifier sur votre gallerie avec votre navigateur web avant de pouvoir utiliser cet assistant.</p><p>Quand vous vous identifiez, pensez � selectionner l\'option <b>se souvenir de moi</b> si elle est pr�sente.',
	'no_alb' => 'D�sol�, mais il n\'y a pas d\'album o� vous puissiez charger d\'image avec cet assistant.',
	'upload' => 'Charger les images dans un album existant',
	'create_new' => 'Cr�er un nouvel album pour y charger vos images',
	'album' => 'Album',
	'category' => 'Categorie',
	'new_alb_created' => 'Votre nouvel album &quot;<b>%s</b>&quot; a �t� cr��.',
	'continue' => 'Cliquez sur &quot;Suivant&quot; pour charger vos images',
);
?>
