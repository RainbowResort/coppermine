<?php

class time {
    function decode($time, $code = null) {
        global $CONFIG;
        if ($CONFIG['lang'] == "german") {
            $last_msg_date_fmt = '%d.%m.%Y %H:%M';
        } else {
            $last_msg_date_fmt = '%b %d, %Y, %H:%M:%S %p';
        }
        $registed_date_fmt = "%b %d, %Y";
        if ($code !== null) {
            return localised_date($time, $code);
        } else {
            return localised_date($time, $last_msg_date_fmt);
        }
    }
}


