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



    const PATTER_VALIDATION_ENGLISH_NAMES = "/^(?:[A-Za-z\s]){2,}$/";
    const PATTER_VALIDATION_ARABIC_NAMES = "/^(?:[\x{0621}-\x{064A}\s]){2,}$/u";
     
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

    private function vaildtionGroupDetails(){
        $errors = [];
        if(empty($this->groupname)){
            $errors['groupname'] = "The Group name is Requiered, Please Write the Group Name";
        }else if(!preg_match(self::PATTER_VALIDATION_ENGLISH_NAMES, $this->groupname) && !preg_match(self::PATTER_VALIDATION_ARABIC_NAMES, $this->groupname)){
            $errors['groupname'] = "Must Be Letters Only and least 2 letters";
        }

        return empty($errors) ? true : $errors;
    }

    private function CreateGroup(){
        $result = $this->vaildtionGroupDetails();
        if($result === true){
            return $this->create();
        }else{
            return $result;
        }
    }

    private function UpdateGroup(){
        $result = $this->vaildtionGroupDetails();
        if($result === true){
            return $this->update();
        }else{
            return $result;
        }
    }

    public function save(){
        if(empty($this->{static::$primaryKey})){
            return $this->CreateGroup();
        }else{
            return $this->UpdateGroup();
        }
    }






}