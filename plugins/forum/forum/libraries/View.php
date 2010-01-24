<?php
/**************************************************
  Coppermine 1.5.x Plugin - forum
  *************************************************
  Copyright (c) 2010 foulu (Le Hoai Phuong), eenemeenemuu
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

class View {
    var $path;
    var $vars;
    function View($path = null) {
        $this->setPath($path);
    }
    function setPath($path = null) {
        if (!$path) {
            $this->path .= 'plugins'.DS.'forum'.DS.'forum'.DS.'templates'.DS;
        } else {
            $this->path = $path;
        }
    }
    function getPath() {
        return $this->path;
    }
    function setVar($name, $value) {
        $this->vars[$name] = $value;
    }
    function setVars($vars) {
        foreach ($vars as $name => $value) {
            $this->setVar($name, $value);
        }        
    }
    function getViewPath($template) {
        $default = $this->path.'classic'.DS.(implode(DS, explode('/', $template))).'_view.php';
        $current = $this->path.Config::item('theme').DS.(implode(DS, explode('/', $template))).'_view.php';
        if (file_exists($current)) return $current;
        else return $default;
    }
    function getMainPath() {
        if (strpos(Config::item('c'), 'admin') !== FALSE) $mainFile = 'admin.php';
        else $mainFile = 'index.php';
        $default = $this->path.'classic'.DS.$mainFile;
        $current = $this->path.Config::item('theme').DS.$mainFile;
        if (file_exists($current)) return $current;
        else return $default;
    }
    function render($template, $vars = array(), $debug = FALSE) {
        if ($debug) {
            echo '<pre>';
            var_dump($vars);
            echo '</pre>';
        }
        if (is_array($vars) && count($vars) > 0) $this->setVars($vars);        
        $viewPath = $this->getViewPath($template);        
        if (!file_exists($viewPath)) cpg_die(ERROR, sprintf(Lang::item('error.missing_vw_file'), $viewPath), __FILE__, __LINE__);
        extract($this->vars);
        // checking model
        $authorizer = check_model::getInstance();
        ob_start();
        include_once($viewPath);
        $fr_contents = ob_get_contents();
        ob_end_clean();
        if (empty($fr_title) || !$fr_title) $fr_title = $vars[nagavitor][0][1] . " - " . Config::item('fr_title');
        include_once($this->getMainPath());
    }
}