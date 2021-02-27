<?php 

namespace STORE\CORE;

use NumberFormatter;

trait validate{

    public static $RegExp_Patterns =  [
        "number"                => "/^(?:\-?[0-9]+)(?:\.[0-9]+)?$/",
        "int"                   => "/^[0-9]+$/",
        "float"                 => "/^((?:[0-9])+\.(?:[0-9])+)$/",
        "English_Chars"         => "/^[A-Za-z ]+$/",
        "English_Chars_Num"     => "/^[A-Za-z\s0-9]+$/",
        "Arabic_Chars"           => "/^[\p{Arabic} ]+$/u",
        "Arabic_Char_Num"       => "/^[\p{Arabic}\s0-9]+$/u",
        "email"                 => "/^([\w0-9_\-\.]+)@([\w\-]+\.)+[\w]{2,6}$/",
        "date"                  => "/^([1|2][0-9][0-9][0-9])[\-\/](0?[1-9]|1[0-2])[\-\/](0?[1-9]|[1-2][0-9]|3[0-1])$/",

        "username"              => "/^(?=[A-Za-z])(?:[\w\-])*$/",
        "password"              => "/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)[A-Za-z\d]{8,25}$/",
        "phonenumber"           => "/^(?:07)(?:7|8|9)[0-9]{7}$/"
        // "Arnames"               => "/^(?=\p{Arabic})(?:[\p{Arabic}\d_\-])*$/"
    ];

    public static function Empty_validate($value){
        $value = trim($value);
        return empty($value) || $value == ""; 
    }

    public static function is_number_validate($value){
        //$value = strval($value);
        return (bool)preg_match(static::$RegExp_Patterns['number'], $value);
    }

    public static function is_int_validate($value){
        // $value = strval($value);
        return (bool)preg_match(static::$RegExp_Patterns['int'], $value);
    }

    public static function is_float_validate($value){
        // $value = strval($value);
        return (bool)preg_match(static::$RegExp_Patterns['float'], $value);
    }

    public static function is_EnglishChars_validate($value){
        $value = trim($value);
        return (bool)preg_match(static::$RegExp_Patterns['English_Chars'], $value);
    }

    public static function is_EnglishCharsAndNum_validate($value){
        $value = trim($value);
        return (bool)preg_match(static::$RegExp_Patterns['English_Chars_Num'], $value);
    }

    public static function is_ArabicChars_validate($value){
        $value = trim($value);
        return (bool)preg_match(static::$RegExp_Patterns['Arabic_Chars'], $value);
    }

    public static function is_ArabicCharsAndNum_validate($value){
        $value = trim($value);
        return (bool)preg_match(static::$RegExp_Patterns['Arabic_Char_Num'], $value);
    }

    public static function lessthan_validate($value, $less){

        $value = trim($value);
        if(!static::is_number_validate($less))
            trigger_error("The Less Value Must Be Number Only",E_USER_ERROR);

        if(static::is_number_validate($value)){
            return $value < $less;
        }else{
            if(!static::is_int_validate($less)){
                trigger_error("The Less Value Must Be integer Number Only",E_USER_ERROR);
            }
            return mb_strlen($value) < $less;
        }
    }

    
    public static function greaterthan_validate($value, $greater){

        $value = trim($value);
        if(!static::is_number_validate($greater))
            trigger_error("The Greater Value Must Be Number Only",E_USER_ERROR);

        if(static::is_number_validate($value)){
            return $value > $greater;
        }else{
            if(!static::is_int_validate($greater)){
                trigger_error("The Less Value Must Be integer Number Only",E_USER_ERROR);
            }
            return mb_strlen($value) > $greater;
        }
    }

    public static function atleast_validate($value, $least){

        $value = trim($value);
        if(!static::is_number_validate($least))
            trigger_error("The least Value Must Be Number Only",E_USER_ERROR);

        if(static::is_number_validate($value)){
            return $value >= $least;
        }else{
            if(!static::is_int_validate($least)){
                trigger_error("The least Value Must Be integer Number Only",E_USER_ERROR);
            }
            return mb_strlen($value) >= $least;
        }
    }

    public static function atmost_validate($value, $most){

        $value = trim($value);
        if(!static::is_number_validate($most))
            trigger_error("The most Value Must Be Number Only",E_USER_ERROR);

        if(static::is_number_validate($value)){
            return $value <= $most;
        }else{
            if(!static::is_int_validate($most)){
                trigger_error("The most Value Must Be integer Number Only",E_USER_ERROR);
            }
            return mb_strlen($value) <= $most;
        }
    }

    public static function between_validate($value, $from ,$to){

        $value = trim($value);
        if(!static::is_number_validate($from) ||!static::is_number_validate($to))
            trigger_error("The most Value Must Be Number Only",E_USER_ERROR);

        if(static::is_number_validate($value)){
            return $value >= $from && $value <= $to;
        }else{
            if(!static::is_int_validate($from) && !static::is_int_validate($to)){
                trigger_error("The most Value Must Be integer Number Only",E_USER_ERROR);
            }
            $len = mb_strlen($value);
            return $len >= $from && $len <= $to;
        }
    }

    public static function Email_validate($email){
        return (bool)preg_match(static::$RegExp_Patterns['email'], $email);
    }

    public static function date_validate($date){
        return (bool) preg_match(static::$RegExp_Patterns['date'], $date);
    }

    public static function Username_validate($value){
        return (bool) preg_match(static::$RegExp_Patterns['username'], $value);
    }

    public static function Password_validate($value){
        return (bool) preg_match(static::$RegExp_Patterns['password'], $value);
    }

    public static function PhoneNumber_validate($value){
        return (bool) preg_match(static::$RegExp_Patterns['phonenumber'], $value);
    }

    public static function names_validate($value){
        return (bool) self::is_EnglishChars_validate($value) ? true : (self::is_ArabicChars_validate($value) ? true : false);
    }
}