<?php 
namespace STORE\CORE;
trait functions{

    public static function redirect($path){
        session_write_close();
        header("Location:" . $path);
        die();
    }

    public static function MatchController($req){
        $path = trim($_SERVER['REQUEST_URI'],"/");
        $path = explode("/", $path);
        $controller = array_shift($path);
        return ($controller == $req); 
    }

    public static function InputValue($fieldname, $object = null){
        return isset($_POST[$fieldname]) ? $_POST[$fieldname] : ((!is_null($object) && property_exists($object, $fieldname)) ?  $object->$fieldname : "");
    }

    public static function Selected($fieldname, $value, $object = []){
        return self::InputValue("usergroup",$object) == $value ? "selected" : "";
    }
}