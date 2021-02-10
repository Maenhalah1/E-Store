<?php 
namespace STORE\CORE;
trait functions{

    public static function redirect($path){
        session_write_close();
        header("Location:" . $path);
        die();
    }
}