<?php 

namespace STORE\CORE;

use STORE\MODELS\GroupPrivilegesModel;
use STORE\MODELS\UserProfileModel;
use STORE\MODELS\UsersModel;

class Authentication{

    public $user = null;
    private static $instance;
    private $_session;
    private $_Public_Privileges_Access = [
        "users/default",
        "auth/login", "auth/logout",
        "language/default",
        "index/default",
        "notfound/default", "notfound/noview",
        "accessdenied/default"
    ];


    private function __construct($seesion){
        $this->_session = $seesion;
    } // cant create direct object from it
    private function __clone(){} // cant clone object

    public static function getInstance(SessionManager $session){
        if(self::$instance == null)
            self::$instance = new self($session);
        return self::$instance;
    }

    public function is_authorized(){
        if(isset($this->_session->user_login)){
            $this->user = $this->_session->user_login;
            return true;
        }else
            return false;
    }

    
    public function has_Access($controller,$action){
        $url = strtolower($controller . "/" . $action);
        if(in_array($url, $this->_Public_Privileges_Access) || in_array($url, $this->_session->user_login->privileges))
            return true;
        else
            return false;
    }

    public function login($username,$password){
        $user = UsersModel::authenticate($username);
        if($user !== false){
            if(password_verify($password, $user->Password)){
                if($user->Status == 0){
                    return 0;
                }else{
                    $user->profile = UserProfileModel::get_By_pk($user->get_primary_key());
                    $user->privileges = GroupPrivilegesModel::getPrivilegesByGroup($user->usergroup);
                    $this->_session->user_login = $user;
                    $user->LastLogin = date('Y-m-d H:i:s');
                    $user->update_user();
                    return 1;
                }   
            }
        }
        return -1;
    }


  

}