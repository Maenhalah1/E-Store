<?php 

namespace STORE\CORE;

class Validation{
    use validate;

    private static $instance;
    private  $_language;
    private  $_masseges;


    private function __construct($language,$masseges){
        $this->_language = $language;
        $this->_masseges = $masseges;
    } // cant create direct object from it
    private function __clone(){} // cant clone object

    public static function getInstance(Language $language, Messenger $masseges){
        if(self::$instance == null)
            self::$instance = new self($language, $masseges);
        return self::$instance;
    }
    
    private function getError($key,array $data){
        return $this->_language->feedKey($key, $data);
    }

    public function getLabelForm($label){
        return $this->_language->get("text_form_" . $label);
    }
    public function user_Validation($post){
        $errors = [];

        if(isset($post['username'])){
            if(self::Empty_validate($post['username'])){
                $errors['form_filed_error_username'] = $this->getError("text_error_form_empty", [$this->getLabelForm("username")]);
            }else if(!self::Username_validate($post['username'])){
                $errors['form_filed_error_username'] = $this->getError("text_error_form_username", [$this->getLabelForm("username")]);
            }else if(!self::between_validate($post['username'], 3, 15)){
                $errors['form_filed_error_username'] = $this->getError("text_error_form_chars_between", [$this->getLabelForm("username"), 3, 15]);
            }
        }

        if(isset($post['email'])){
            if(self::Empty_validate($post['email'])){
                $errors['form_filed_error_email'] =  $this->getError("text_error_form_empty", [$this->getLabelForm("email")]);
            }else if(!self::Email_validate($post['email'])){
                $errors['form_filed_error_email'] =  $this->getError("text_error_form_email", [$this->getLabelForm("email")]);
            }
        }

        if(isset($post['newpassword'])){
            if(!self::Password_validate($post['newpassword'])){
                $errors['form_filed_error_newpassword'] = $this->getError("text_error_form_newpassword", [$this->getLabelForm("newpassword")]);
            }else if($post['newpassword'] !== $post['c_newpassword']){
                $errors['form_filed_error_confirm_newpassword'] = $this->getError("text_error_form_c_newpassword", [$this->getLabelForm("confirm_newpassword"),$this->getLabelForm("newpassword")]);;
            }
        }

        if(isset($post['phonenumber'])){
            if(self::Empty_validate($post['phonenumber'])){
                $errors['form_filed_error_phonenumber'] = $this->getError("text_error_form_empty", [$this->getLabelForm("phonenumber")]);
            }else if(!self::PhoneNumber_validate($post['phonenumber'])){
                $errors['form_filed_error_phonenumber'] = $this->getError("text_error_form_phonenumber", [$this->getLabelForm("phonenumber")]);
            }
        }


        if(isset($post['usersgroups'])){
            if(self::Empty_validate($post['usersgroups'])){
                $errors['form_filed_error_usersgroups'] = $this->getError("text_error_form_usersgroups",  [$this->getLabelForm("usersgroups")]);
            }    
        }

        if(empty($errors)){
            return true;
        }else{
            $this->_masseges->addMultiMassege($errors, Messenger::ERROR_MASSEGE);
            return false;
        }
    }

}


?>