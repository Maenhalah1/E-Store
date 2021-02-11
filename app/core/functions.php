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
}