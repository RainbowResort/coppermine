<?php
/*************************
  Coppermine Photo Gallery
  ************************
  Copyright (c) 2003-2005 Coppermine Dev Team
  v1.1 originaly written by Gregory DEMAR

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  ********************************************
  Coppermine version: 1.4.2
  $Source$
  $Revision$
  $Author$
  $Date$
**********************************************/
/*
        MBFS - MultiByte Functions Simulator
        Functions that simulate the mb_*() extension functionality
        NOTE: only Unicode possible with these

        @author DJ Maze
        @copyright 2005 http://moocms.com
*/

global $mb_uppercase, $mb_lowercase;

# PHP 4 >= 4.0.6, PHP 5
if (!function_exists('mb_strlen')) {

        function mb_strlen($str) {
                global $mb_utf8_regex;
                return preg_match_all("#$mb_utf8_regex".'|[\x00-\x7F]#', $str, $dummy);
        }

        function mb_substr($str, $start, $end=null) {
                global $mb_utf8_regex;
                preg_match_all("#$mb_utf8_regex".'|[\x00-\x7F]#', $str, $str);
                $str = array_slice($str[0], $start, $end);
                return implode('', $str);
        }

}

# PHP 4 >= 4.3.0, PHP 5
function mb_strtolower($str) {
        global $mb_uppercase, $mb_lowercase;
        return str_replace($mb_uppercase, $mb_lowercase, $str);
}

function mb_strtoupper($str) {
        global $mb_uppercase, $mb_lowercase;
        return str_replace($mb_lowercase, $mb_uppercase, $str);
}

$mb_uppercase = array(
        'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
        '&Icirc;�',
        'À','Á','Â','Ã','Ä','Å','Æ','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ð','Ñ','Ò','Ó','Ô','Õ','Ö','Ø','Ù','Ú','Û','Ü','Ý','Þ','Ÿ','&Auml;�','&Auml;�','&Auml;�','&Auml;�','&Auml;�','&Auml;�','&Auml;�','&Auml;�','&Auml;�','&Auml;�','&Auml;�','&Auml;�','&Auml;�','&Auml;�','&Auml;�','&Auml;�','&Auml;�','&Auml;�','&Auml;�','&Auml;�','&Auml;�','&Auml;�','&Auml;�','&Auml;�','I','&Auml;&sup2;','&Auml;�','&Auml;�',
        '&Auml;�','&Auml;�','&Auml;�','&Auml;�','Ł','Ń','Ņ','Ň',
        'Ŋ','Ō','Ŏ','Ő','Œ','Ŕ','Ŗ','Ř','Ś','Ŝ','Ş','Š','Ţ','Ť','Ŧ','Ũ','Ū','Ŭ','Ů','Ű','�&sup2;','Ŵ','Ŷ','Ź','Ż','Ž','S',
        'Ƃ','Ƅ','Ƈ','Ƌ',
        'Ƒ','Ƕ','Ƙ','&Egrave;�',
        '&Egrave;�','Ơ','Ƣ','Ƥ','Ƨ',
        'Ƭ','Ư','�&sup3;','�&micro;','Ƹ',
        'Ƽ',
        'Ƿ','ǅ','ǈ','ǋ','Ǎ','Ǐ','Ǒ','Ǔ','Ǖ','Ǘ','Ǚ','Ǜ','Ǝ','Ǟ','Ǡ','Ǣ','Ǥ','Ǧ','Ǩ','Ǫ','Ǭ','Ǯ',
        '�&sup2;','Ǵ','Ǹ','Ǻ','Ǽ','Ǿ','&Egrave;�','&Egrave;�','&Egrave;�','&Egrave;�','&Egrave;�','&Egrave;�','&Egrave;�','&Egrave;�','&Egrave;�','&Egrave;�','&Egrave;�','&Egrave;�','&Egrave;�','&Egrave;�','&Egrave;�','&Egrave;�',
        '&Egrave;�','&Egrave;�','&Egrave;�','&Egrave;�','&Egrave;�','&Egrave;�','&Egrave;�','&Egrave;�','&Egrave;&sup2;',
        '&Egrave;�',
        'Ɓ','Ɔ',
        'Ɖ','Ɗ',
        'Ə',
        'Ɛ',
        'Ɠ',
        'Ɣ',
        'Ɨ','Ɩ',
        'Ɯ',
        'Ɲ',
        'Ɵ',
        'Ʀ',
        'Ʃ',
        'Ʈ',
        'Ʊ','�&sup2;',
        'Ʒ',
        '&Eacute;�',
        '&Icirc;�','&Icirc;�','&Icirc;�','&Icirc;�',
        '&Icirc;�','&Icirc;�','&Icirc;�','&Icirc;�','&Icirc;�','&Icirc;�','&Icirc;�','&Icirc;�','&Icirc;�','&Icirc;�','&Icirc;�','&Icirc;�','&Icirc;�','&Icirc;�','&Icirc;�','&Icirc;�','&Icirc;�','&Icirc;�','&Icirc;�','&Icirc;�','&Icirc;�','&Icirc;�','&Icirc;�','&Icirc;�','&Icirc;�','&Icirc;�','&Icirc;�','&Icirc;�','&Icirc;�','&Icirc;�','&Icirc;�','&Icirc;�','&Icirc;�','&Icirc;�',
        'Ϙ','Ϛ','Ϝ','Ϟ','Ϡ','Ϣ','Ϥ','Ϧ','Ϩ','Ϫ','Ϭ','Ϯ','&Icirc;�','&Icirc;�','Ϲ',
        '&Icirc;�','Ϸ','Ϻ',
        'А','Б','В','Г','Д','Е','Ж','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я','Ѐ','Ё','Ђ','Ѓ','Є','Ѕ','І','Ї','Ј','Љ','Њ','Ћ','Ќ','Ѝ','Ў','Џ','Ѡ','Ѣ','Ѥ','Ѧ','Ѩ','Ѫ','Ѭ','Ѯ','Ѱ','�&sup2;','Ѵ','Ѷ','Ѹ','Ѻ','Ѽ','Ѿ','&Ograve;�','&Ograve;�','&Ograve;�','&Ograve;�','&Ograve;�','&Ograve;�','&Ograve;�','&Ograve;�','&Ograve;�','&Ograve;�','&Ograve;�','&Ograve;�','&Ograve;�','&Ograve;�','&Ograve;�','&Ograve;�','&Ograve;�','&Ograve;�','&Ograve;�','&Ograve;�','&Ograve;�','&Ograve;&sup2;','&Ograve;�','&Ograve;�','&Ograve;�','&Ograve;�','&Ograve;�','&Ograve;�','&Oacute;�','&Oacute;�','&Oacute;�','&Oacute;�','&Oacute;�','&Oacute;�','&Oacute;�','&Oacute;�','&Oacute;�','&Oacute;�','&Oacute;�','&Oacute;�','&Oacute;�','&Oacute;�','&Oacute;�','&Oacute;�','&Oacute;�','&Oacute;�','&Oacute;�','&Oacute;�','&Oacute;�','&Oacute;�','&Oacute;�','&Oacute;�','&Oacute;&sup2;','&Oacute;�','&Oacute;�','&Oacute;�','&Ocirc;�','&Ocirc;�','&Ocirc;�','&Ocirc;�','&Ocirc;�','&Ocirc;�','&Ocirc;�','&Ocirc;�','&Ocirc;�','&Ocirc;&sup2;','&Ocirc;&sup3;','&Ocirc;�','&Ocirc;&micro;','&Ocirc;�','&Ocirc;�','&Ocirc;�','&Ocirc;�','&Ocirc;�','&Ocirc;�','&Ocirc;�','&Ocirc;�','&Ocirc;�','&Ocirc;�','Հ','Ձ','Ղ','Ճ','Մ','Յ','Ն','Շ','Ո','Չ','Պ','Ջ','Ռ','Ս','Վ','Տ','Ր','Ց','Ւ','Փ','Ք','Օ','Ֆ',
        '&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;�&sup2;','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;�&sup2;','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��',
        '&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;�&sup2;','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;�&sup2;','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��',
        '&aacute;��',
        '&aacute;��',
        '&aacute;��',
        '&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��',
        '&aacute;��',
        '&Icirc;�',
        '&aacute;��',
        '&aacute;��','&aacute;��',
        '&aacute;��','&aacute;��',
        '&aacute;��',
        '&aacute;��',
        '&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;&sup2;','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup3;�','&acirc;&sup3;�','&acirc;&sup3;�','&acirc;&sup3;�','&acirc;&sup3;�','&acirc;&sup3;�','&acirc;&sup3;�','&acirc;&sup3;�','&acirc;&sup3;�','&acirc;&sup3;�','&acirc;&sup3;�','&acirc;&sup3;�','&acirc;&sup3;�','&acirc;&sup3;�','&acirc;&sup3;�','&acirc;&sup3;�','&acirc;&sup3;�','&acirc;&sup3;�',
        '&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;�&sup2;','&aacute;�&sup3;','&aacute;��','&aacute;�&micro;','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��',
        'Ａ','Ｂ','Ｃ','Ｄ','Ｅ','Ｆ','Ｇ','Ｈ','Ｉ','Ｊ','Ｋ','Ｌ','Ｍ','Ｎ','Ｏ','Ｐ','Ｑ','�&sup2;','�&sup3;','Ｔ','�&micro;','Ｖ','Ｗ','Ｘ','Ｙ','Ｚ',
);
$mb_lowercase = array(
        'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z',
        '&Acirc;&micro;',
        'à','á','â','ã','ä','å','æ','ç','è','é','ê','ë','ì','í','î','ï','ð','ñ','�&sup2;','�&sup3;','ô','�&micro;','ö','ø','ù','ú','û','ü','ý','þ','ÿ','&Auml;�','&Auml;�','&Auml;�','&Auml;�','&Auml;�','&Auml;�','&Auml;�','&Auml;�','&Auml;�','&Auml;�','&Auml;�','&Auml;�','&Auml;�','&Auml;�','&Auml;�','&Auml;�','&Auml;�','&Auml;�','&Auml;�','&Auml;�','&Auml;�','&Auml;�','&Auml;�','&Auml;�','&Auml;�','&Auml;&sup3;','&Auml;&micro;','&Auml;�',
        '&Auml;�','&Auml;�','&Auml;�','ŀ','ł','ń','ņ','ň',
        'ŋ','ō','ŏ','ő','œ','ŕ','ŗ','ř','ś','ŝ','ş','š','ţ','ť','ŧ','ũ','ū','ŭ','ů','ű','�&sup3;','�&micro;','ŷ','ź','ż','ž','ſ',
        'ƃ','ƅ','ƈ','ƌ',
        'ƒ','ƕ','ƙ','ƚ',
        'ƞ','ơ','ƣ','ƥ','ƨ',
        'ƭ','ư','ƴ','ƶ','ƹ',
        'ƽ',
        'ƿ','ǆ','ǉ','ǌ','ǎ','ǐ','ǒ','ǔ','ǖ','ǘ','ǚ','ǜ','ǝ','ǟ','ǡ','ǣ','ǥ','ǧ','ǩ','ǫ','ǭ','ǯ',
        '�&sup3;','�&micro;','ǹ','ǻ','ǽ','ǿ','&Egrave;�','&Egrave;�','&Egrave;�','&Egrave;�','&Egrave;�','&Egrave;�','&Egrave;�','&Egrave;�','&Egrave;�','&Egrave;�','&Egrave;�','&Egrave;�','&Egrave;�','&Egrave;�','&Egrave;�','&Egrave;�',
        '&Egrave;�','&Egrave;�','&Egrave;�','&Egrave;�','&Egrave;�','&Egrave;�','&Egrave;�','&Egrave;�','&Egrave;&sup3;',
        '&Egrave;�',
        '&Eacute;�','&Eacute;�',
        '&Eacute;�','&Eacute;�',
        '&Eacute;�',
        '&Eacute;�',
        '&Eacute;�',
        '&Eacute;�',
        '&Eacute;�','&Eacute;�',
        '&Eacute;�',
        '&Eacute;&sup2;',
        '&Eacute;&micro;',
        '&Ecirc;�',
        '&Ecirc;�',
        '&Ecirc;�',
        '&Ecirc;�','&Ecirc;�',
        '&Ecirc;�',
        '&Ecirc;�',
        '&Icirc;�','&Icirc;�','&Icirc;�','&Icirc;�',
        '&Icirc;�','&Icirc;&sup2;','&Icirc;&sup3;','&Icirc;�','&Icirc;&micro;','&Icirc;�','&Icirc;�','&Icirc;�','&Icirc;�','&Icirc;�','&Icirc;�','&Icirc;�','&Icirc;�','&Icirc;�','&Icirc;�','π','ρ','ς','σ','τ','υ','φ','χ','ψ','ω','ϊ','ϋ','ό','ύ','ώ','ϐ','ϑ','ϕ','ϖ',
        'ϙ','ϛ','ϝ','ϟ','ϡ','ϣ','ϥ','ϧ','ϩ','ϫ','ϭ','ϯ','ϰ','ϱ','�&sup2;',
        '�&micro;','ϸ','ϻ',
        'а','б','�&sup2;','�&sup3;','д','�&micro;','ж','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я','ѐ','ё','ђ','ѓ','є','ѕ','і','ї','ј','љ','њ','ћ','ќ','ѝ','ў','џ','ѡ','ѣ','ѥ','ѧ','ѩ','ѫ','ѭ','ѯ','ѱ','�&sup3;','�&micro;','ѷ','ѹ','ѻ','ѽ','ѿ','&Ograve;�','&Ograve;�','&Ograve;�','&Ograve;�','&Ograve;�','&Ograve;�','&Ograve;�','&Ograve;�','&Ograve;�','&Ograve;�','&Ograve;�','&Ograve;�','&Ograve;�','&Ograve;�','&Ograve;�','&Ograve;�','&Ograve;�','&Ograve;�','&Ograve;�','&Ograve;�','&Ograve;�','&Ograve;&sup3;','&Ograve;&micro;','&Ograve;�','&Ograve;�','&Ograve;�','&Ograve;�','&Ograve;�','&Oacute;�','&Oacute;�','&Oacute;�','&Oacute;�','&Oacute;�','&Oacute;�','&Oacute;�','&Oacute;�','&Oacute;�','&Oacute;�','&Oacute;�','&Oacute;�','&Oacute;�','&Oacute;�','&Oacute;�','&Oacute;�','&Oacute;�','&Oacute;�','&Oacute;�','&Oacute;�','&Oacute;�','&Oacute;�','&Oacute;�','&Oacute;�','&Oacute;&sup3;','&Oacute;&micro;','&Oacute;�','&Oacute;�','&Ocirc;�','&Ocirc;�','&Ocirc;�','&Ocirc;�','&Ocirc;�','&Ocirc;�','&Ocirc;�','&Ocirc;�','ա','բ','գ','դ','ե','զ','է','ը','թ','ժ','ի','լ','խ','ծ','կ','հ','ձ','�&sup2;','�&sup3;','մ','�&micro;','ն','շ','ո','չ','պ','ջ','ռ','ս','վ','տ','&Ouml;�','&Ouml;�','&Ouml;�','&Ouml;�','&Ouml;�','&Ouml;�','&Ouml;�',
        '&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;�&sup3;','&aacute;�&micro;','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;�&sup3;','&aacute;�&micro;','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��',
        '&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;�&sup3;','&aacute;�&micro;','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;�&sup3;','&aacute;�&micro;','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;�&sup2;','&aacute;�&sup3;','&aacute;��','&aacute;�&micro;','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��',
        '&aacute;��',
        '&aacute;��',
        '&aacute;��',
        '&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;�&sup2;','&aacute;�&sup3;','&aacute;��','&aacute;�&micro;','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��','&aacute;��',
        '&aacute;�&sup3;',
        '&aacute;��',
        '&aacute;��',
        '&aacute;��','&aacute;��',
        '&aacute;��','&aacute;��',
        '&aacute;��',
        '&aacute;�&sup3;',
        '&acirc;��','&acirc;��','&acirc;�&sup2;','&acirc;�&sup3;','&acirc;��','&acirc;�&micro;','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;&sup3;','&acirc;&sup2;&micro;','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup2;�','&acirc;&sup3;�','&acirc;&sup3;�','&acirc;&sup3;�','&acirc;&sup3;�','&acirc;&sup3;�','&acirc;&sup3;�','&acirc;&sup3;�','&acirc;&sup3;�','&acirc;&sup3;�','&acirc;&sup3;�','&acirc;&sup3;�','&acirc;&sup3;�','&acirc;&sup3;�','&acirc;&sup3;�','&acirc;&sup3;�','&acirc;&sup3;�','&acirc;&sup3;�','&acirc;&sup3;�',
        '&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��','&acirc;��',
        'ａ','ｂ','ｃ','ｄ','ｅ','ｆ','ｇ','ｈ','ｉ','ｊ','ｋ','ｌ','ｍ','ｎ','ｏ','ｐ','ｑ','ｒ','ｓ','ｔ','ｕ','ｖ','ｗ','ｘ','ｙ','ｚ',
);