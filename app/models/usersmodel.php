<?php
namespace STORE\MODELS;

class UsersModel extends AbstractModal
{
    private $userid;
    public $username;
    public $Password;
    public $Status = 1;
    public $email;
    public $phonenumber;
    public $SubscriptionDate;
    public $LastLogin;
    public $usergroup;

    public $profile;
    public $privileges;

    protected static $tableName     = "users";
    protected static $primaryKey    = "userid";
    protected static $tableSchema   = array(
                    "username"          =>  self::DATA_TYPE_STR,
                    "Password"          =>  self::DATA_TYPE_STR,
                    "email"             =>  self::DATA_TYPE_STR,
                    "phonenumber"       =>  self::DATA_TYPE_STR,
                    "Status"            =>  self::DATA_TYPE_INT,
                    "SubscriptionDate"  =>  self::DATA_TYPE_STR,
                    "LastLogin"         =>  self::DATA_TYPE_STR,
                    "usergroup"         =>  self::DATA_TYPE_INT
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


    public static function UsernameExsits($username){
        return static::getByCondition(["username" => $username]);
    }
    public static function EmailExsits($email){
        return static::getByCondition(["email" => $email]);
    }


    public static function getAll(){
        $sql = "SELECT users.* , users_groups.groupname as 'GroupName' FROM `users` INNER JOIN users_groups ON users.usergroup = users_groups.groupid";
        return static::get($sql);
    }

    public static function getUsers(UsersModel $user){
        $sql = "SELECT users.* , users_groups.groupname as 'GroupName' FROM `users` INNER JOIN users_groups ON users.usergroup = users_groups.groupid WHERE userid != '" . $user->get_primary_key() . "'";
        return static::get($sql);
    }

    public static function authenticate($username){
        $sql = "SELECT * , (SELECT groupname FROM users_groups WHERE groupid = " . static::$tableName . ".usergroup) groupname FROM " . static::$tableName . " WHERE username = :username";
        return static::getOne($sql, ["username" => $username]);
       
    }

    public function create_new_user(){
       if($this->create()){
            if($this->profile !== null && is_object($this->profile)){
                $this->profile->userid = $this->get_primary_key();
                $this->profile->create_profile();
            }
           return true;
       }else{
           return false;
       }
    }

    public function update_user(){
        if($this->update()){
            return true;           
        }else{
            return false;
        }
    }

    public function save(){
        if(!isset($this->{static::$primaryKey}) || empty($this->{static::$primaryKey}))
            return $this->create_new_user();
        else
            return $this->update_user();
    }


}