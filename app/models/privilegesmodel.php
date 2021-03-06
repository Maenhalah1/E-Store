<?php
namespace STORE\MODELS;

class PrivilegesModel extends AbstractModal
{
    private $privilegeid;
    public $privilegetitle;
    public $privilege;

    protected static $tableName     = "user_privileges";
    protected static $primaryKey    = "privilegeid";
    protected static $tableSchema   = array(
                    "privilegetitle"    =>  self::DATA_TYPE_STR,
                    "privilege"         =>  self::DATA_TYPE_STR,

                );



    const PATTER_VALIDATION_ENGLISH_NAMES = "/^(?:[A-Za-z\s]){2,}$/";
    const PATTER_VALIDATION_ARABIC_NAMES = "/^(?:[\x{0621}-\x{064A}\s]){2,}$/u";
    const PATTERN_PRIVILEGE = "/^[A-Za-z]+\/[A-Za-z]+$/";

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

    private function vaildtionPrivilegeDetails(){
        $errors = [];

        if(empty($this->privilegetitle)){
            $errors['privilegetitle'] = "Please Write The Privilege Title";
        }else if(!preg_match(self::PATTER_VALIDATION_ENGLISH_NAMES, $this->privilegetitle) && !preg_match(self::PATTER_VALIDATION_ARABIC_NAMES, $this->privilegetitle)){
            $errors['privilegetitle'] = "Must be letters only and least 2 letter";
        }
        
        if(empty($this->privilege)){
            $errors['privilegeurl'] = "Please Write The Privilege URL";
        } elseif(!preg_match(self::PATTERN_PRIVILEGE, $this->privilege)){
            $errors['privilegeurl'] = "Must be like this Pattern ( privilege/actionprivilege )";
        }

        if(empty($errors))
            return true;
        else
            return $errors;

    }

    private function createPrivilege(){
        $result = $this->vaildtionPrivilegeDetails();
        if($result === true)
            return $this->create();
        else
            return $result;
    }

    private function editPrivilege(){
        $result = $this->vaildtionPrivilegeDetails();
        if($result === true)
            return $this->update();
        else
            return $result;
    }

    public function save(){
        if(empty($this->{static::$primaryKey}))
            return $this->createPrivilege();
        else
            return $this->editPrivilege();
    }



}