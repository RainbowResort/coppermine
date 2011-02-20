<?php
/**************************************************
  Coppermine 1.5.x Plugin - EnlargeIt!
  *************************************************
  Copyright (c) 2010 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ********************************************
  $HeadURL$
  $Revision$
  $LastChangedBy$
  $Date$
  **************************************************/

if (!defined('IN_COPPERMINE')) { 
	die('Not in Coppermine...'); 
}
$lang_plugin_enlargeit['display_name'] = 'Agrandissement';
$lang_plugin_enlargeit['update_success'] = 'Valeurs sauvegardées correctement';
$lang_plugin_enlargeit['main_title'] = 'Plugin EnlargeIt! (Agrandissement !)';
$lang_plugin_enlargeit['pluginmanager'] = 'Gestionnaire du plugin';
$lang_plugin_enlargeit['submit'] = 'Soumettre';
$lang_plugin_enlargeit['enlarge_to_pic_in'] = 'Zoom de l’image';
$lang_plugin_enlargeit['intermediate_size'] = 'Taille intermédiaire';
$lang_plugin_enlargeit['full_size'] = 'Taille réelle';
$lang_plugin_enlargeit['force_intermediate_size'] = 'Forcer la taille intermediaire';
$lang_plugin_enlargeit['animation'] = 'Animation';
$lang_plugin_enlargeit['none'] = 'Aucune';
$lang_plugin_enlargeit['fade'] = 'Apparition et disparition graduellement du fondu';
$lang_plugin_enlargeit['glide'] = 'Glissement';
$lang_plugin_enlargeit['bumpglide'] = 'Glissement par à coup';
$lang_plugin_enlargeit['smoothglide'] = 'Glissement doux';
$lang_plugin_enlargeit['expglide'] = 'Glissement rapide';
$lang_plugin_enlargeit['topglide'] = 'Glissement par le haut';
$lang_plugin_enlargeit['leftglide'] = 'Glissement par la gauche';
$lang_plugin_enlargeit['topleftglide'] = 'Glissement par le haut gauche';
$lang_plugin_enlargeit['time_between_animation_steps'] = 'Temps entre les étapes d\'animations';
$lang_plugin_enlargeit['animation_steps'] = 'Nombre d\'étapes pour les animations';
$lang_plugin_enlargeit['border_width'] = 'Largeur de la bordure';
$lang_plugin_enlargeit['border_texture'] = 'Texture de la bordure';
$lang_plugin_enlargeit['border_color'] = 'Couleur de la Bordure';
$lang_plugin_enlargeit['round_border'] = 'Bords arrondis (Mozilla et Safari seulement)';
$lang_plugin_enlargeit['shadow_size'] = 'Taille de l\'ombre';
$lang_plugin_enlargeit['shadow_opacity'] = 'Opacité de l\'ombre';
$lang_plugin_enlargeit['show_titlebar'] = 'Voir la barre de titre lorsque les boutons sont inactifs';
$lang_plugin_enlargeit['title_bar_text_color'] = 'Couleur du texte de la barre de titre';
$lang_plugin_enlargeit['background_color_ajax_area'] = 'Couleur de l\'arrière plan de la zone AJAX';
$lang_plugin_enlargeit['center_enlarge_images'] = 'Centrage de l\'image agrandie';
$lang_plugin_enlargeit['darken_screen'] = 'Assombrir l’écran lors des agrandissements';
$lang_plugin_enlargeit['darken_strength'] = 'Forçage de l’assombrissement';
$lang_plugin_enlargeit['button_picture'] = 'Affichage du bouton "Afficher la photo"';
$lang_plugin_enlargeit['show_picture'] = 'Afficher l\'image'; // js-alert
$lang_plugin_enlargeit['button_info'] = 'Voir le bouton "Info"';
$lang_plugin_enlargeit['open_as_ajax'] = 'Ouvrir comme snippet AJAX';
$lang_plugin_enlargeit['open_intermediate_page'] = 'Ouvrir une page intermédiaire "classique"';
$lang_plugin_enlargeit['show_info'] = 'Afficher info'; // js-alert
$lang_plugin_enlargeit['button_download'] = 'Affichage du bouton "Téléchargement"';
$lang_plugin_enlargeit['download_this_file'] = 'Télécharger ce fichier'; // js-alert
$lang_plugin_enlargeit['download_explain'] = 'Cliquez ici pour télécharger ce fichier';
$lang_plugin_enlargeit['button_favorites'] = 'Affichage du bouton "Favoris"';
$lang_plugin_enlargeit['favorites'] = 'Favoris'; // js-alert
$lang_plugin_enlargeit['button_comments'] = 'Affichage du bouton "Commentaires"';
$lang_plugin_enlargeit['comment'] = 'Commentaires';
$lang_plugin_enlargeit['button_histogram'] = 'Affichage du bouton "Histogramme"';
$lang_plugin_enlargeit['histogram'] = 'Histogramme'; // js-alert
$lang_plugin_enlargeit['button_bbcode'] = 'Affichage du bouton "BBCode"';
$lang_plugin_enlargeit['bbcode'] = 'BBCode'; // js-alert
$lang_plugin_enlargeit['button_vote'] = 'Affichage du bouton "Vote"';
$lang_plugin_enlargeit['vote'] = 'Vote';
$lang_plugin_enlargeit['full_size'] = 'Taille réelle'; // js-alert
$lang_plugin_enlargeit['for_registered_users_only'] = 'Pour les utilisateurs enregistrés uniquement';
$lang_plugin_enlargeit['as_popup_window'] = 'Comme fenêtre pop-up';
$lang_plugin_enlargeit['enl_maxpopupforreg'] = 'oui, comme pop-up mais pas pour les utilisateurs anonymes';
$lang_plugin_enlargeit['button_close'] = 'Affichage du bouton "Fermeture"';
$lang_plugin_enlargeit['close_esc'] = 'Fermeture [Esc]'; // js-alert
$lang_plugin_enlargeit['button_navigation'] = 'Affichage des boutons de "Navigation"';
$lang_plugin_enlargeit['previous_left'] = 'Fichier précédent [Flèche de gauche]'; // js-alert
$lang_plugin_enlargeit['next_right'] = 'Fichier suivant [Flèche de droite]'; // js-alert
$lang_plugin_enlargeit['administrators'] = 'Administrateurs';
$lang_plugin_enlargeit['registered_users'] = 'Utilisateurs enregistrés';
$lang_plugin_enlargeit['guests'] = 'Visiteurs';
$lang_plugin_enlargeit['enable_sefurl_support'] = 'Activer le support de SEF_URL';
$lang_plugin_enlargeit['file_added_to_favorites'] = 'Le fichier a été ajoutée à vos favoris.';
$lang_plugin_enlargeit['file_removed_from_favorites'] = 'Le fichier a été supprimé de vos favoris.';
$lang_plugin_enlargeit['button_favorites'] = 'Afficher mes favoris';
$lang_plugin_enlargeit['enable_drag_drop'] = 'Autoriser images agrandies à être déplacés';
$lang_plugin_enlargeit['darkening_speed'] = 'Vitesse d’assombrissement';
$lang_plugin_enlargeit['no_comments'] = 'Il n\'y a pas encore de commentaire, et vous n\'êtes pas autorisé à ajouter un !';
$lang_plugin_enlargeit['mouse_wheel_navigation'] = 'Navigation avec la molette de la souris';
$lang_plugin_enlargeit['cancel_loading'] = 'Cliquez pour annuler le chargement de cette image'; // js-alert
$lang_plugin_enlargeit['no_flash_found'] = 'Pour visionner ce fichier, vous avez besoin du lecteur Flash d\'Adobe en tant que plugin pour votre navigateur'; // js-alert
$lang_plugin_enlargeit['flash_player'] = 'Utilisez un logiciel de lecture FLV';
$lang_plugin_enlargeit['copy_to_clipboard'] = 'Copier dans le presse-papiers';
$lang_plugin_enlargeit['transparency_for_glide'] = 'Effet de transparence pour les animations glissées';
$lang_plugin_enlargeit['marble'] = 'Marbre';
$lang_plugin_enlargeit['metallight'] = 'Métal brossé';
$lang_plugin_enlargeit['metalwhite'] = 'Blanc métal';
$lang_plugin_enlargeit['metalwhite2'] = 'Blanc métal 2';
$lang_plugin_enlargeit['metalblue'] = 'Bleu métal';
$lang_plugin_enlargeit['metalred'] = 'Rouge métal';
$lang_plugin_enlargeit['metalgreen'] = 'Vert métal';
$lang_plugin_enlargeit['metalsilver'] = 'Argent métal';
$lang_plugin_enlargeit['metalblack'] = 'Noir métal';
$lang_plugin_enlargeit['rain'] = 'Pluie';
$lang_plugin_enlargeit['rainlight'] = 'Petite pluie';
$lang_plugin_enlargeit['woodlight'] = 'Bois clair';
$lang_plugin_enlargeit['wooddark'] = 'Bois foncé';
$lang_plugin_enlargeit['paper'] = 'Papier';
$lang_plugin_enlargeit['leather'] = 'Cuir';
$lang_plugin_enlargeit['green'] = 'Vert foncé';
$lang_plugin_enlargeit['greenliquid'] = 'Vert liquide';
$lang_plugin_enlargeit['choc'] = 'Chocolat';
$lang_plugin_enlargeit['plugin_configuration'] = 'Configuration du plugin';
$lang_plugin_enlargeit['enlargement_type'] = 'Type d\'élargissement';
$lang_plugin_enlargeit['animation_type'] = 'Type d\'animation';
$lang_plugin_enlargeit['milliseconds'] = 'Milliseconds';
$lang_plugin_enlargeit['zero_to_disable'] = '0 pour désactiver';
$lang_plugin_enlargeit['border'] = 'Bordure';
$lang_plugin_enlargeit['toggle_color_picker'] = 'Sélecteur de couleur';
$lang_plugin_enlargeit['mozilla_only'] = 'Mozilla/Safari uniquement';
$lang_plugin_enlargeit['shadow'] = 'Ombre';
$lang_plugin_enlargeit['right_bottom'] = 'Vers la droite et en bas';
$lang_plugin_enlargeit['title_bar'] = 'Barre de titre';
$lang_plugin_enlargeit['action'] = 'Action';
$lang_plugin_enlargeit['only_darken_when_image_shows'] = 'N’assombrir que quand une image s’affiche';
$lang_plugin_enlargeit['remain_dark_when_using_navigation'] = 'reste sombre lorsque vous naviguez';
$lang_plugin_enlargeit['darkening_speed_explain'] = '1 = immédiatement sombre, 20 = Assombrissement très lentement';
$lang_plugin_enlargeit['buttons'] = 'Boutons';
$lang_plugin_enlargeit['not_implemented_yet'] = 'Pas encore implémenté';
$lang_plugin_enlargeit['for_all'] = 'pour tous (les invités ainsi que les utilisateurs enregistrés)';
$lang_plugin_enlargeit['enable_for'] = 'Activer pour';
$lang_plugin_enlargeit['multimedia'] = 'Multimédia';
$lang_plugin_enlargeit['os_flv'] = 'OS FLV';
$lang_plugin_enlargeit['rphmedia'] = 'RphMedia';
$lang_plugin_enlargeit['no_changes'] = 'Il n\'ya eu aucun changement ou les changements que vous appliqués étaient invalides.';
$lang_plugin_enlargeit['recommended'] = 'recommandé';
$lang_plugin_enlargeit['not_recommended'] = 'Non recommandé';
$lang_plugin_enlargeit['description'] = 'Interface graphique AJAX pour Coppermine 1.5.x ouvrant de manière transparente les images dans la page des vignettes, avec une fonction de fenêtre grisée optionnelle et une page de configuration détaillées.';
$lang_plugin_enlargeit['install_info'] = 'Vous pouvez configurer le plugin après l\'installation en utilisant les boutons dans le gestionnaire du plugin ou dans le menu configuration (configurable). Si vous voulez utiliser en plus de EnlargeIt!, les plugins ImageFlow ou slider, modifiez les paramètres sur les pages de configuration de ces plugins.';
$lang_plugin_enlargeit['extra_info'] = 'Ce plugin est actuellement en version bêta. Toutes les fonctionnalités peuvent ne pas fonctionner, en particulier les parties AJAX. Merci de votre compréhension.';
$lang_plugin_enlargeit['announcement_thread'] = 'Sujet d\'annonce';
$lang_plugin_enlargeit['enlargeit_configuration'] = 'Configuration de EnlargeIt! (Agrandissement)';
$lang_plugin_enlargeit['plugin_setup'] = 'Configuration du plugin';
$lang_plugin_enlargeit['display_plugin_config_in_admin_menu'] = 'Afficher un lien vers la configuration du plugin dans le menu configuration';
$lang_plugin_enlargeit['not_a_valid_extension'] = '%s n\'est pas une extension valide';
$lang_plugin_enlargeit['gd_version'] = 'GD version: %s';
$lang_plugin_enlargeit['not_available'] = 'Pas valide';
$lang_plugin_enlargeit['file_cache_x_files_using_x_bytes'] = 'Fichier(s) cache: %s fichier(s) utilisant %s de votre espace web';
$lang_plugin_enlargeit['histogram_cache_file_lifetime'] = 'Durée de vie du cache du fichier histogramme';
$lang_plugin_enlargeit['unlimited'] = 'Illimitée';
$lang_plugin_enlargeit['days'] = 'jours';
$lang_plugin_enlargeit['max_file_size_total'] = 'Taille maximum totale du fichier';
$lang_plugin_enlargeit['maximize_method'] = 'Maximiser la méthode pour les photos en taille réelle';
$lang_plugin_enlargeit['preview'] = 'Extrait';
$lang_plugin_enlargeit['image_formats'] = 'Formats d\'image';
$lang_plugin_enlargeit['video_formats'] = 'Formats vidéo';
$lang_plugin_enlargeit['jpg'] = 'Joint Photography Experts Group graphics file format'; 
$lang_plugin_enlargeit['jpeg'] = 'Joint Photography Experts Group graphics file format'; 
$lang_plugin_enlargeit['jpe'] = 'Joint Photography Experts Group graphics file format'; 
$lang_plugin_enlargeit['png'] = 'Portable Network Graphics';
$lang_plugin_enlargeit['gif'] = 'Graphics Interchange Format';
$lang_plugin_enlargeit['bmp'] = 'BitMap Picture';
$lang_plugin_enlargeit['jpc'] = 'Japan PIC';
$lang_plugin_enlargeit['jp2'] = 'JPEG 2000 image'; 
$lang_plugin_enlargeit['jpx'] = 'JPEG 2000 image'; 
$lang_plugin_enlargeit['jb2'] = 'JBIG2 Bitmap Graphic'; 
$lang_plugin_enlargeit['swc'] = 'Flex Components Archive';
$lang_plugin_enlargeit['swf'] = 'Shockwave Flash';
$lang_plugin_enlargeit['ytb'] = 'YouTube Video';
$lang_plugin_enlargeit['dvx'] = 'DivX Video';
$lang_plugin_enlargeit['flv'] = 'Flash video file';
$lang_plugin_enlargeit['download'] = 'Télécharger';
$lang_plugin_enlargeit['enlargeit_documentation'] = 'Documentation de EnlargeIt! (Agrandissement)';
$lang_plugin_enlargeit['shadow_color'] = 'Couleur de l\'ombre';
?>