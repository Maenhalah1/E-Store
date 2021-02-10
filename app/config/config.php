<?php

!defined('DS') ? define('DS', DIRECTORY_SEPARATOR) : "";
!defined('APP_PATH') ? define('APP_PATH', realpath(dirname(dirname(__FILE__)))) : "";
!defined('VIEWS_PATH') ? define('VIEWS_PATH', APP_PATH . DS . "views") : "";
!defined('TEMPLATE_PATH') ? define('TEMPLATE_PATH', APP_PATH . DS . "template") : "";
!defined('CSS_PATH') ? define('CSS_PATH', '/css') : "";
!defined('JS_PATH') ? define('JS_PATH',  '/js') : "";

!defined('LANGUAGE_DEFAULT') ? define('LANGUAGE_DEFAULT', "en") : "";
!defined('LANGUAGES_PATH') ? define('LANGUAGES_PATH', APP_PATH . DS . "languages") : "";

?>
