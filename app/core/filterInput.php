<?php 
namespace STORE\CORE;
trait FilterInput{

    public function StrFilter($str){
        return filter_var(strip_tags($str), FILTER_SANITIZE_STRING);
    }
    public function IntFilter($int){
        return filter_var($int, FILTER_SANITIZE_NUMBER_INT);
    }
    public function FloatFilter($str){
        return filter_var($str, FILTER_SANITIZE_NUMBER_FLOAT);
    }
}