<?php
namespace STORE\MODELS;

class SupplierModel extends AbstractModal
{
    private $supplierid;
    public $name;
    public $phonenumber;
    public $email;
    public $address;

    protected static $tableName     = "suppliers";
    protected static $primaryKey    = "supplierid";
    protected static $tableSchema   = array(
                "name"              =>  self::DATA_TYPE_STR,
                "phonenumber"       =>  self::DATA_TYPE_STR,
                "email"             =>  self::DATA_TYPE_STR,
                "address"           =>  self::DATA_TYPE_STR,
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



    public function save(){
        if(!isset($this->{static::$primaryKey}) || empty($this->{static::$primaryKey}))
            return $this->create();
        else
            return $this->update();
    }


}