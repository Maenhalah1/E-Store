<?php
namespace STORE\MODELS;

class UserProfileModel extends AbstractModal
{
    public $userid;
    public $firstname;
    public $lastname;
    public $address;
    public $DateofBirth;
    public $image;


    protected static $tableName     = "users_profiles";
    protected static $primaryKey    = "userid";
    protected static $tableSchema   = array(
                    "userid"            => self::DATA_TYPE_INT,
                    "firstname"         =>  self::DATA_TYPE_STR,
                    "lastname"          =>  self::DATA_TYPE_STR,
                    "address"           =>  self::DATA_TYPE_STR,
                    "DateofBirth"       =>  self::DATA_TYPE_STR,
                    "image"             =>  self::DATA_TYPE_STR
                );



  
    protected static function get_all_properties() {
         return array_keys(get_class_vars(__CLASS__));
    }

    function get_primary_key(){
        return $this->{static::$primaryKey};
    }

    function set_primary_key($pk){
         $this->{static::$primaryKey} = $pk;
    }

    
    public function create_profile(){
        if(!empty($this->{static::$primaryKey})){
            if($this->create()){
                return true;
            }else{
                return false;
            }
        }
    }

    public function update_profile(){
        if($this->update()){
            return true;           
        }else{
            return false;
        }
    }

    public function save(){
        // if(!isset($this->{static::$primaryKey}) || empty($this->{static::$primaryKey}))
        //     return $this->create_new_user();
        // else
        //     return $this->update_user();
    }


}