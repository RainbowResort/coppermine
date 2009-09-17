<?php

function load_helper($helper) {
    global $helpers;
    if (!is_array($helper)) {
        $helper = array($helper);
    }
    foreach ($helper as $babe) {
        $babe = strtolower($babe);
        if (!$helpers[$babe]) {
            $helper_file = BASE_DIR.'plugins'.DS.'forum'.DS.'forum'.DS.'helpers'.DS.$babe.'_helper.php';
            if (file_exists($helper_file)) {
                if (!$helpers[$babe]) {
                    include($helper_file);
                    $helpers[$babe] = TRUE;
                }
            } else {
                cpg_die(ERROR, sprintf(Lang::item('error.missing_hp_file'), $helper_file), __FILE__, __LINE__);
            }
        } else {
            return TRUE;
        }
    }
}

function load_model($model, $return = FALSE) {
    global $models;
    $model = ucfirst(strtolower($model));
    $model_file = BASE_DIR.'plugins'.DS.'forum'.DS.'forum'.DS.'models'.DS.$model.'.php';
    if (file_exists($model_file)) {
        if (!$models[$model]) {
            include($model_file);
            $models[$model] = TRUE;
        }
        $class_name = strtolower($model) . '_model';
        if ($return === TRUE) return new $class_name();
    } else {
        cpg_die(ERROR, sprintf(Lang::item('error.missing_md_file'), $model_file), __FILE__, __LINE__);
    }
}

function load_library($library, $return = FALSE) {
    global $libraries;
    $library = ucfirst(strtolower($library));
    $library_file = BASE_DIR.'plugins'.DS.'forum'.DS.'forum'.DS.'libraries'.DS.$library.'.php';
    if (file_exists($library_file)) {
        if (!$libraries[$library]) {
            include($library_file);
            $libaries[$library] = TRUE;
        }
        $class_name = ucfirst(strtolower($library));
        if ($return === TRUE) return new $class_name();
    } else {
        cpg_die(ERROR, sprintf(Lang::item('error.missing_li_file'), $library_file), __FILE__, __LINE__);
    }
}