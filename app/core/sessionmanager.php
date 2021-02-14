<?php 

namespace STORE\CORE;

class SessionManager extends \SessionHandler{
	
	private $sessionName = "APPSESS";
	private $sessionMaxLifeTime = 0;
	private $sessionSSL = false;
	private $sessionHTTPOnly = true;
	private $sessionPath = '/';
	private $sessionDomain = '';
	private $sessionSavepath = SESSIONS_SAVE_PATH;
	private $sessionMaxTimevalid = 10; // 10 Minutes



	public function __construct() {

		ini_set('session.use_cookies', 1);
		ini_set('session.use_only_cookies', 1);
		ini_set('session.use_trans_sid', 0);
		ini_set('session.save_handler', 'files');

		session_name($this->sessionName);
		session_save_path($this->sessionSavepath);
		session_set_cookie_params(
			$this->sessionMaxLifeTime, $this->sessionPath,
			$this->sessionDomain	 , $this->sessionSSL,
			$this->sessionHTTPOnly
		);

		//session_set_save_handler($this,true);

	}


    public function start(){
        if(session_id() === ''){
           if(session_start()){
               $this->set_session_start_time();
               if(!$this->check_session_validty()){
                   $this->generate_new_session();
                   $this->generate_fingerprint();
               }
           }
        }
    }

    private function set_session_start_time(){
        if(!isset($this->session_start_time)){
            $this->session_start_time = time();
        }
    }

    private function check_session_validty(){
	    return ( time() - $this->session_start_time ) < ($this->sessionMaxTimevalid * 60) ? true : false;
    }

    private function generate_new_session(){
	    $this->session_start_time = time();
	    return session_regenerate_id(true);
    }

    private function generate_fingerprint(){
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        $this->cipherKey = openssl_random_pseudo_bytes(32);
        $sessionID = session_id();
        $this->finger_print = hash("sha256",$userAgent . $this->cipherKey . $sessionID);
    }

    public function checkFingerprint(){
	    if(!isset($this->finger_print)){
	       $this->generate_fingerprint();
        }
	    $currentFinger = hash("sha256" , $_SERVER['HTTP_USER_AGENT'] . $this->cipherKey . session_id());

	    return $this->finger_print == $currentFinger;
    }


    public function endSession(){
        session_unset(); // unset all data
        setcookie( // Destroy Cookie
            $this->sessionName , '' , time() - 1000,
            $this->sessionPath , $this->sessionDomain,
            $this->sessionSSL  , $this->sessionHTTPOnly
        );
        session_destroy(); // destroy session
    }


    public function __set($key, $value){
        $_SESSION[$key] = $value;
    } // use to create new  Session Data

    public function __get($key){
        return isset($_SESSION[$key]) ? $_SESSION[$key] : "";
    } // use to get Session Data if it is exists

    public function __isset($key)
    {
        return isset($_SESSION[$key]) ? true : false;
    } // use to check if Session Data is set of not

    public function __unset($key)
    {
        if(isset($_SESSION[$key])) 
            unset($_SESSION[$key]);
    } 


}
