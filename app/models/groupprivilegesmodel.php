<?php
namespace STORE\MODELS;

class GroupPrivilegesModel extends AbstractModal
{
    private $id;
    public $groupid;
    public $privilegeid;

    protected static $tableName     = "group_privileges";
    protected static $primaryKey    = "id";
    protected static $tableSchema   = array(
                    "groupid"          =>  self::DATA_TYPE_INT,
                    "privilegeid"        => self::DATA_TYPE_INT
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


    public static function getGroupPrivilegesIds($groupid){

        $privilegesGroup = self::getByCondition(array("groupid" => $groupid));
        $privilegesGroupIds = [];
        if($privilegesGroup !== false){
            foreach($privilegesGroup as $privilegegroup){
                $privilegesGroupIds[] = $privilegegroup->privilegeid;
            }   
        }
        return $privilegesGroupIds;
    }

    public static function getPrivilegesByGroup($groupid){
        $sql = "SELECT up.privilege FROM " . static::$tableName . " pg";
        $sql .= " INNER JOIN user_privileges up ON up.privilegeid = pg.privilegeid";
        $sql .= " WHERE pg.groupid = :groupid";
        $privileges = static::get($sql, ['groupid'=> $groupid]);
        $privilegesTitle = [];
        foreach($privileges as $privilege){
            $privilegesTitle[] = $privilege->privilege;
        }
        return $privilegesTitle;
    }




    public function save(){
        if(empty($this->{static::$primaryKey})){
            $this->create();
        }else{
            //$this->update();
        }
    }






}