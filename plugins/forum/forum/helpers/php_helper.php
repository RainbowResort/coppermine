<?php

class php {
    function is_empty_string($string) {
        $string = trim($string);
        if ($string == '') {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
}

?>