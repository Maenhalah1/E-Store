<?php
namespace STORE\MODELS;

class UsersGroupsModel extends AbstractModal
{
    private $groupid;
    public $groupname;

    protected static $tableName     = "users_groups";
    protected static $primaryKey    = "groupid";
    protected static $tableSchema   = array(
                    "groupname"          =>  self::DATA_TYPE_STR,
                );



    const PATTER_VALIDATION_NAMES = "/^(?:[A-Za-z]){2,}$/";
    const PATTER_SIPLT_Phonenumber = "/^([0-9]{3})([0-9]{7})$/";

    // public function __construct($name,$salary,$tax,$Phonenumber){
    //     $this->name = $name;
    //     $this->salary = $salary;
    //     $this->tax = $tax;
    //     $this->Phonenumber = $Phonenumber;
    // }
     protected static function get_all_properties() {
         return array_keys(get_class_vars(__CLASS__));
    }

    function get_primary_key(){
        return $this->{static::$primaryKey};
    }

    function set_primary_key($pk){
         $this->{static::$primaryKey} = $pk;
    }
    public function save(){
        if(empty($this->{static::$primaryKey})){
            $this->create();
        }else{
            $this->update();
        }
    }






}