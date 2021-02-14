<?php 

namespace STORE\CORE;

use NumberFormatter;

trait validate{

    public $RegExp_Patterns =  [
        "number"                => "/^(?:\-?[0-9]+)(?:\.[0-9]+)?$/",
        "int"                   => "/^[0-9]+$/",
        "float"                 => "/^((?:[0-9])+\.(?:[0-9])+)$/",
        "English_Chars"         => "/^[A-Za-z\s]+$/",
        "English_Chars_Num"     => "/^[A-Za-z\s0-9]+$/",
        "Arabic_Char"           => "/^[\p{Arabic}\s]+$/u",
        "Arabic_Char_Num"       => "/^[\p{Arabic}\s0-9]+$/u",
        "email"                 => "/^([\w0-9_\-\.]+)@([\w\-]+\.)+[\w]{2,6}$/",
        "date"                  => "/^([1|2][0-9][0-9][0-9])[\-\/](0?[1-9]|1[0-2])[\-\/](0?[1-9]|[1-2][0-9]|3[0-1])$/"
    ];

    public function is_number_validate($value){
        //$value = strval($value);
        return (bool)preg_match($this->RegExp_Patterns['number'], $value);
    }

    public function is_int_validate($value){
        // $value = strval($value);
        return (bool)preg_match($this->RegExp_Patterns['int'], $value);
    }

    public function is_float_validate($value){
        // $value = strval($value);
        return (bool)preg_match($this->RegExp_Patterns['float'], $value);
    }

    public function is_EnglishChars_validate($value){
        $value = trim($value);
        return (bool)preg_match($this->RegExp_Patterns['English_Characters'], $value);
    }

    public function is_EnglishCharsAndNum_validate($value){
        $value = trim($value);
        return (bool)preg_match($this->RegExp_Patterns['English_Chars_Num'], $value);
    }

    public function is_ArabicChars_validate($value){
        $value = trim($value);
        return (bool)preg_match($this->RegExp_Patterns['Arabic_Characters'], $value);
    }

    public function is_ArabicCharsAndNum_validate($value){
        $value = trim($value);
        return (bool)preg_match($this->RegExp_Patterns['Arabic_Char_Num'], $value);
    }

    public function lessthan_validate($value, $less){

        $value = trim($value);
        if(!$this->is_number_validate($less))
            trigger_error("The Less Value Must Be Number Only",E_USER_ERROR);

        if($this->is_number_validate($value)){
            return $value < $less;
        }else{
            if(!$this->is_int_validate($less)){
                trigger_error("The Less Value Must Be integer Number Only",E_USER_ERROR);
            }
            return mb_strlen($value) < $less;
        }
    }

    
    public function greaterthan_validate($value, $greater){

        $value = trim($value);
        if(!$this->is_number_validate($greater))
            trigger_error("The Greater Value Must Be Number Only",E_USER_ERROR);

        if($this->is_number_validate($value)){
            return $value > $greater;
        }else{
            if(!$this->is_int_validate($greater)){
                trigger_error("The Less Value Must Be integer Number Only",E_USER_ERROR);
            }
            return mb_strlen($value) > $greater;
        }
    }

    public function atleast_validate($value, $least){

        $value = trim($value);
        if(!$this->is_number_validate($least))
            trigger_error("The least Value Must Be Number Only",E_USER_ERROR);

        if($this->is_number_validate($value)){
            return $value >= $least;
        }else{
            if(!$this->is_int_validate($least)){
                trigger_error("The least Value Must Be integer Number Only",E_USER_ERROR);
            }
            return mb_strlen($value) >= $least;
        }
    }

    public function atmost_validate($value, $most){

        $value = trim($value);
        if(!$this->is_number_validate($most))
            trigger_error("The most Value Must Be Number Only",E_USER_ERROR);

        if($this->is_number_validate($value)){
            return $value <= $most;
        }else{
            if(!$this->is_int_validate($most)){
                trigger_error("The most Value Must Be integer Number Only",E_USER_ERROR);
            }
            return mb_strlen($value) <= $most;
        }
    }

    public function Email_validate($email){
        return (bool)preg_match($this->RegExp_Patterns['email'], $email);
    }

    public function date_validate($date){
        return (bool) preg_match($this->RegExp_Patterns['date'],$date);
    }
}