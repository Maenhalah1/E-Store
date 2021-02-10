<?php

namespace STORE;

class autoloading
{

    public static function autoload($classname)
    {
        $class_file = str_replace("STORE", "", $classname);
        $class_file = str_replace(array("/", "\\"), DS, $class_file);
        $class_file = strtolower($class_file);
        $class_file = APP_PATH . $class_file . ".php";

        if (file_exists($class_file))
            require_once($class_file);

    }
}

spl_autoload_register(__NAMESPACE__ . '\autoloading::autoload');