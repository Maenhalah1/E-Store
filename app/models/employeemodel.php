<?php
namespace STORE\MODELS;

class EmployeeModel extends AbstractModal
{
    private $id;
    public $name;
    public $salary;
    public $tax;
    public $number_phone;

    protected static $tableName     = "employee";
    protected static $primaryKey    = "id";
    protected static $tableSchema   = array(
                    "name"          =>  self::DATA_TYPE_STR,
                    "salary"        =>  self::DATA_TYPE_INT,
                    "tax"           =>  4,
                    "number_phone"  =>  self::DATA_TYPE_STR,
                    "number_agent"  =>  self::DATA_TYPE_STR
                );



    const PATTER_VALIDATION_NAMES = "/^(?:[A-Za-z]){2,}$/";
    const PATTER_SIPLT_NUMBER_PHONE = "/^([0-9]{3})([0-9]{7})$/";

    // public function __construct($name,$salary,$tax,$number_phone){
    //     $this->name = $name;
    //     $this->salary = $salary;
    //     $this->tax = $tax;
    //     $this->number_phone = $number_phone;
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
        }elseif(strlen($this->number_phone) != 10 || !is_numeric($this->number_phone)){
            $error="Please Enter Valid Phone Number";
        }
        if($error === -1) {
            $this->number_phone = self::convertNumberPhoneFromIntToStandard($this->number_phone);
            return true;
        }else{
            return $error;
        }
    }

    public static function convertNumberPhoneFromIntToStandard($num){
        return preg_replace(self::PATTER_SIPLT_NUMBER_PHONE,"$1-$2",$num);
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
            $obj->number_phone = self::convertNumberPhoneFromStandardToInt($obj->number_phone);
        }
        return $obj;
    }

}