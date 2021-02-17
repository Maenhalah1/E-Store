<?php

namespace STORE\CORE;

class Language{

    private $_content_Dictionry = [];
    private $_head_Dictionry = [];


    public function load($path){

        $language   = $_SESSION['lang'];
        $lang_path  = LANGUAGES_PATH . DS . $language . DS . str_replace("|" , DS, $path) . ".lang.php";

        if(file_exists($lang_path)){
            require_once $lang_path;

            if(isset($lang_data_content) && !empty($lang_data_content))
                $this->_content_Dictionry = array_merge($this->_content_Dictionry, $lang_data_content);
            
            if( isset($lang_data_head) && !empty($lang_data_head))
                    $this->_head_Dictionry = array_merge($this->_head_Dictionry,$lang_data_head);
            
        } 
    }

    public function feedKey($key,array $data){
        $dic = $this->get($key);
        if(!empty($dic)){
            array_unshift($data, $dic);
            return call_user_func_array("sprintf",$data);
        }else
            return "";
        
    }

    public function get($key){
        return array_key_exists($key, $this->_content_Dictionry) ? $this->_content_Dictionry[$key] : "";
    }
    public function getContentDictionary(){
        return $this->_content_Dictionry;
    }
    public function getheadDictionary(){
        return $this->_head_Dictionry;
    }

}