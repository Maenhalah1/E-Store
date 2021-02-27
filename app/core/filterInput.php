<?php 
namespace STORE\CORE;
trait FilterInput{

    public function StrFilter($str){
        return filter_var(strip_tags(trim($str)), FILTER_SANITIZE_STRING);
    }
    public function IntFilter($int){
        return filter_var($int, FILTER_SANITIZE_NUMBER_INT);
    }
    public function FloatFilter($float){
        return filter_var($float, FILTER_SANITIZE_NUMBER_FLOAT);
    }
}