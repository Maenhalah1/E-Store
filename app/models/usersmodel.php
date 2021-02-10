<?php
namespace STORE\MODELS;

class UsersModel extends AbstractModal
{
    private $userid;
    public $username;
    public $password;
    public $email;
    public $Phonenumber;
    public $SubscriptionDate;
    public $lastLogin;
    public $Groupid;

    protected static $tableName     = "users";
    protected static $primaryKey    = "userid";
    protected static $tableSchema   = array(
                    "username"          =>  self::DATA_TYPE_STR,
                    "password"        =>  self::DATA_TYPE_STR,
                    "email"           =>  self::DATA_TYPE_STR,
                    "Phonenumber"  =>  self::DATA_TYPE_STR,
                    "SubscriptionDate"  =>  self::DATA_TYPE_STR,
                    "LastLogin"  =>  self::DATA_TYPE_STR,
                    "Groupid"  =>  self::DATA_TYPE_INT
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


    public function get_salary(){
        return $this->salary * ($this->tax/100);
    }
    private function Validate_data(){
        $error = -1;
        if(!preg_match(self::PATTER_VALIDATION_NAMES, $this->name)){
            $error = "Please Enter Valid Name";
        }elseif(!is_numeric($this->salary) || empty($this->salary)){
            $error = "Please Enter Valid Salary";
        }elseif(!is_numeric($this->tax)  ||  empty($this->tax)){
            $error = "Please Enter Valid Tax";
        }elseif(strlen($this->Phonenumber) != 10 || !is_numeric($this->Phonenumber)){
            $error="Please Enter Valid Phone Number";
        }
        if($error === -1) {
            $this->Phonenumber = self::convertNumberPhoneFromIntToStandard($this->Phonenumber);
            return true;
        }else{
            return $error;
        }
    }

    public static function convertNumberPhoneFromIntToStandard($num){
        return preg_replace(self::PATTER_SIPLT_Phonenumber,"$1-$2",$num);
    }

    public static function convertNumberPhoneFromStandardToInt($num){
        return str_replace("-","",$num);
    }


    public function create_new_employee(){
        $res = $this->Validate_data();
        if($res === true){
            return $this->create();           
        }else{
            return $res;
        }
    }

    public function update_employee(){
        $res = $this->Validate_data();
        if($res === true){
            return $this->update();           
        }else{
            return $res;
        }
    }

    public function save(){
        if(isset($this->id) && $this->id > 0)
            return $this->update_employee();
        else
            return $this->create_new_employee();
    }

    public function delete_employee(){
        return $this->delete();
    }


    public static function get_By_pk($pk){
        $obj = parent::get_By_pk($pk);
        if($obj !== false && is_object($obj)){
            $obj->Phonenumber = self::convertNumberPhoneFromStandardToInt($obj->Phonenumber);
        }
        return $obj;
    }

}