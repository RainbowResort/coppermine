<?php
/**************************************************
  Coppermine 1.4.x Plugin - EnlargeIt! $VERSION$=2.15
  *************************************************
  Copyright (c) 2008 Timos-Welt (www.timos-welt.de)
  *************************************************
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.
  ***************************************************/
  
  
  /*   Translation in SLOVAK by Drahus : http://DC-FOTO.com 
*/

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...'); }
//language variables
$lang_enlargeit = array(
'display_name' => 'EnlargeIt! PlugIn',
'update_success' => 'Hodnoty boli úspešne aktualizované',
'main_title' => 'EnlargeIt! PlugIn',
'version' => 'v2.15',
'pluginmanager' => 'Plugin Manager',
'enl_yes' => 'áno',
'enl_no' => 'nie',
'submit_button' => 'Odoslať',
'enl_pictype' => 'Zväčšiť na ',
'enl_normalsize' => 'stredný náhľad',
'enl_fullsize' => 'plná veľkosť',
'enl_forcenormal' => 'vynútiť stredný náhľad',
'enl_ani' => 'Animácia',
'noani' => 'žiadne',
'fade' => 'zosíliť / zoslabiť',
'glide' => 'kĺzať',
'bumpglide' => 'nárazové kĺzanie',
'smoothglide' => 'plynulé kĺzanie',
'expglide' => 'tvrdé kĺzanie',
'enl_speed' => 'Čas medzi krokmi animácie',
'enl_maxstep' => 'Počet krokov animácie',
'enl_brd' => 'Používať rámček',
'enl_brdsize' => 'Hrúbka rámčeka',
'enl_brdbck' => 'Textúra rámčeka',
'enl_brdcolor' => 'Farba rámčeka',
'enl_brdround' => 'Zaoblený rámček (iba v Mozilla/Safari)',
'enl_shadow' => 'Používať tieň',
'enl_shadowsize' => 'Veľkosť rámčeka vpravo/dole',
'enl_shadowcolor' => 'Farba rámčeka (zvyčajne čierny)',
'enl_shadowintens' => 'Nepriehľadnosť rámčeka',
'enl_titlebar' => 'Používať riadok nadpisu, keď tlačidlá nie sú aktívne',
'enl_titletxtcol' => 'Farba nadpisu',
'enl_ajaxcolor' => 'Farba pozadia AJAX oblasti',
'enl_center' => 'Vycentrovať zväčšený obrázok',
'enl_dark' => 'Stmaviť pozadie pri zväčšení obrázku (iba jeden obrázok naraz)',
'enl_darkprct' => 'Sila stmavenia',
'enl_buttonpic' => 'Zobraziť tlačidlo \'Zobraziť obrázok\'',
'enl_tooltippic' => 'Ukázať obrázok',
'enl_buttoninfo' => 'Zobraziť tlačidlo \'Info\'',
'enl_buttoninfoyes1' => 'áno (otvor AJAX snippet)',
'enl_buttoninfoyes2' => 'áno (otvor stránku stredného náhľadu)',
'enl_tooltipinfo' => 'Info',
'enl_buttonfav' => 'Zobraziť tlačidlo \'Obľúbené\'',
'enl_tooltipfav' => 'Obľúbené',
'enl_buttoncomment' => 'Zobraziť tlačidlo \'Komentáre\'',
'enl_tooltipcomment' => 'Komentáre',
'enl_buttondownload' => 'Zobraziť tlačidlo \'Stiahnuť\'',
'enl_tooltipdownload' => 'Stiahnuť obrázok',
'enl_clickdownload' => 'Kliknite tu pre stiahnutie súboru',
'enl_buttonhist' => 'Zobraziť tlačidlo \'Histogram\'',
'enl_tooltiphist' => 'Histogram',
'enl_buttonbbcode' => 'Zobraziť tlačidlo \'BBCode\'',
'enl_tooltipbbcode' => 'BBCode',
'enl_buttonecard' => 'Zobraziť tlačidlo \'e-Pohľadnica\'',
'enl_tooltipecard' => 'e-Pohľadnica',
'enl_buttonvote' => 'Zobraziť tlačidlo \'Hodnotiť\'',
'enl_tooltipvote' => 'Hodnotiť',
'enl_buttonmax' => 'Zobraziť tlačidlo \'Plná veľkosť\'',
'enl_tooltipmax' => 'Plná veľkosť',
'enl_maxforreg' => 'áno, ale nie pre anonymných užívateľov',
'enl_maxpopup' => 'áno, ako pop-up okno',
'enl_maxpopupforreg' => 'áno, ako pop-up okno, ale nie pre anonymov',
'enl_buttonclose' => 'Zobraziť tlačidlo \'Zavrieť\'',
'enl_tooltipclose' => 'Zavrieť [Esc]',
'enl_buttonnav' => 'Zobraziť tlačidlo \'Navigácia\'',
'enl_tooltipprev' => 'Späť [ľavá šípka kláv.]',
'enl_tooltipnext' => 'Ďalej [pravá šípka kláv.]',
'enl_adminmode' => 'Povoľ EnlargeIt! v admin móde',
'enl_registeredmode' => 'Povoľ EnlargeIt! pre registrovaných užívateľov',
'enl_guestmode' => 'Povoľ EnlargeIt! pre hostí',
'enl_sefmode' => 'Povoľ SEF podporu',
'enl_addedtofav' => 'Obrázok bol pridaný medzi obľúbené',
'enl_removedfromfav' => 'Obrázok bol odobratý z obľúbených',
'enl_showfav' => 'Ukáž moje obľúbené',
'enl_dragdrop' => 'Drag & drop [chyť a pusť] zväčšených obrázkov',
'enl_darkensteps' => 'Kroky stmavenia (1 = okamžite)',
'enl_cantcomment' => 'Nenachádzajú sa tu žiadne komentáre, nemáte oprávnenie na pridanie komentára!',
'enl_cantecard' => 'Prepáčte, nemáte oprávnenie na poslanie e-Pohľadnice!',
'enl_wheelnav' => 'Navigácia myškou',
'enl_canceltext' => 'Kliknite pre zrušenie sťahovania',
'enl_noflashfound' => 'Pre pozeranie tohto súboru potrebujete v prehliadači plugin Adobe Flash Player!',
'enl_flvplayer' => 'Zvoľ, ktorý FLV prehrávač',
'enl_copytoclipbrd' => 'Kopírovať',
'enl_opaglide' => 'Priehľadnosť pri zväčšovaní kĺzaním',
'enl_mousecursors' => 'Používať presípacie hodiny, ak ich prehliadač podporuje',
);
?>