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
  
  
  /*   Translation in CZECH by Drahus : http://DC-FOTO.com 
*/

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...'); }
//language variables
$lang_enlargeit = array(
'display_name' => 'EnlargeIt! PlugIn',
'update_success' => 'Hodnoty byli úspěšne aktualizovány',
'main_title' => 'EnlargeIt! PlugIn',
'version' => 'v2.15',
'pluginmanager' => 'Plugin Manager',
'enl_yes' => 'ano',
'enl_no' => 'ne',
'submit_button' => 'Odoslat',
'enl_pictype' => 'Zvětšit na ',
'enl_normalsize' => 'střední náhled',
'enl_fullsize' => 'plná velikost',
'enl_forcenormal' => 'vynoutit střední náhled',
'enl_ani' => 'Animace',
'noani' => 'nejsou',
'fade' => 'zesílit / zeslabit',
'glide' => 'klouzet',
'bumpglide' => 'nárazové klouzání',
'smoothglide' => 'plynulé klouzání',
'expglide' => 'tvrdé klouzání',
'enl_speed' => 'Čas mezi krokmi animace',
'enl_maxstep' => 'Počet kroků animace',
'enl_brd' => 'Používat rámeček',
'enl_brdsize' => 'Hroubka rámečka',
'enl_brdbck' => 'Textura rámečka',
'enl_brdcolor' => 'Farba rámečka',
'enl_brdround' => 'Zaoblený rámeček (iba v Mozilla/Safari)',
'enl_shadow' => 'Používat stín',
'enl_shadowsize' => 'Velikost rámečka vpravo/dolů',
'enl_shadowcolor' => 'Barva rámečka (obvykle černý)',
'enl_shadowintens' => 'Neprůhlednost rámečka',
'enl_titlebar' => 'Používat řádek nadpisu, když tlačítka nejsou aktivní',
'enl_titletxtcol' => 'Barva nadpisu',
'enl_ajaxcolor' => 'Barva pozadí AJAX oblasti',
'enl_center' => 'Vycentrovat zvětšený obrázek',
'enl_dark' => 'Ztmavit pozadí při zvětšení obrázku (jenom jeden obrázek najednou)',
'enl_darkprct' => 'Síla ztmavení',
'enl_buttonpic' => 'Zobrazit tlačítko \'Zobrazit obrázek\'',
'enl_tooltippic' => 'Ukázat obrázek',
'enl_buttoninfo' => 'Zobrazit tlačítko \'Info\'',
'enl_buttoninfoyes1' => 'ano (otevři AJAX snippet)',
'enl_buttoninfoyes2' => 'ano (otevři stránku středního náhledu)',
'enl_tooltipinfo' => 'Info',
'enl_buttonfav' => 'Zobrazit tlačítko \'Oblíbené\'',
'enl_tooltipfav' => 'Oblíbené',
'enl_buttoncomment' => 'Zobrazit tlačítko \'Komentáře\'',
'enl_tooltipcomment' => 'Komentáře',
'enl_buttondownload' => 'Zobrazit tlačítko \'Stáhnout\'',
'enl_tooltipdownload' => 'Stáhnout obrázek',
'enl_clickdownload' => 'Klikněte tady pro stáhnutí souboru',
'enl_buttonhist' => 'Zobrazit tlačítko \'Histogram\'',
'enl_tooltiphist' => 'Histogram',
'enl_buttonbbcode' => 'Zobrazit tlačítko \'BBCode\'',
'enl_tooltipbbcode' => 'BBCode',
'enl_buttonecard' => 'Zobrazit tlačítko \'e-Pohlednice\'',
'enl_tooltipecard' => 'e-Pohlednice',
'enl_buttonvote' => 'Zobrazit tlačítko \'Hodnotit\'',
'enl_tooltipvote' => 'Hodnotit',
'enl_buttonmax' => 'Zobrazit tlačítko \'Plná velikost\'',
'enl_tooltipmax' => 'Plná velikost',
'enl_maxforreg' => 'ano, ale ne pro anonymní uživatele',
'enl_maxpopup' => 'ano, jako pop-up okno',
'enl_maxpopupforreg' => 'ano, jako pop-up okno, ale ne pro anonymy',
'enl_buttonclose' => 'Zobrazit tlačítko \'Zavřít\'',
'enl_tooltipclose' => 'Zavřít [Esc]',
'enl_buttonnav' => 'Zobrazit tlačítko \'Navigace\'',
'enl_tooltipprev' => 'Předchozí [levá šipka kláv.]',
'enl_tooltipnext' => 'Další [pravá šipka kláv.]',
'enl_adminmode' => 'Povol EnlargeIt! v admin módě',
'enl_registeredmode' => 'Povol EnlargeIt! pro registrované uživatele',
'enl_guestmode' => 'Povol EnlargeIt! pro hosty',
'enl_sefmode' => 'Povol SEF podporu',
'enl_addedtofav' => 'Obrázek byl přidán mezi oblíbené',
'enl_removedfromfav' => 'Obrázek byl odebrán z oblíbených',
'enl_showfav' => 'Ukaž mé oblíbené',
'enl_dragdrop' => 'Drag & drop zvětšených obrázků',
'enl_darkensteps' => 'Kroky ztmavení (1 = okamžitě)',
'enl_cantcomment' => 'Nenacházejí se tady žádné komentáře, nemáte oprávnění na přidání komentáře!',
'enl_cantecard' => 'Promiňte, nemáte oprávnění na odeslání e-Pohlednice!',
'enl_wheelnav' => 'Navigace myší',
'enl_canceltext' => 'Klikněte pro zrušení stahování',
'enl_noflashfound' => 'Pro prohlížení tohto souboru je potřebné mít v prohlížeči plugin Adobe Flash Player!',
'enl_flvplayer' => 'Zvol, který FLV přehrávač',
'enl_copytoclipbrd' => 'Kopírovat',
'enl_opaglide' => 'Průhlednost při zvětšování klouzáním',
'enl_mousecursors' => 'Používat přesípací hodiny, když je prohlížeč podporuje',
);
?>