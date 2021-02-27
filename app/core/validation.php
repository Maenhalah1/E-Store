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
            }else if(isset($_POST['usernameExists']) && $_POST['usernameExists'] !== false){
                $errors['form_filed_error_username'] = $this->getError("text_error_form_alraedy_exsits", [$this->getLabelForm("username")]);
            }
        }

        if(isset($post['firstname'])){
            if(self::Empty_validate($post['firstname'])){
                $errors['form_filed_error_firstname'] = $this->getError("text_error_form_empty", [$this->getLabelForm("firstname")]);
            }else if(!self::names_validate($post['firstname'])){
                $errors['form_filed_error_firstname'] = $this->getError("text_error_form_names", [$this->getLabelForm("firstname")]);
            }else if(!self::between_validate($post['firstname'], 3, 15)){
                $errors['form_filed_error_firstname'] = $this->getError("text_error_form_chars_between", [$this->getLabelForm("firstname"), 3, 15]);
            }
        }
        if(isset($post['lastname'])){
            if(self::Empty_validate($post['lastname'])){
                $errors['form_filed_error_lastname'] = $this->getError("text_error_form_empty", [$this->getLabelForm("lastname")]);
            }else if(!self::names_validate($post['lastname'])){
                $errors['form_filed_error_lastname'] = $this->getError("text_error_form_names", [$this->getLabelForm("lastname")]);
            }else if(!self::between_validate($post['lastname'], 3, 15)){
                $errors['form_filed_error_lastname'] = $this->getError("text_error_form_chars_between", [$this->getLabelForm("lastname"), 3, 15]);
            }
        }

        if(isset($post['email'])){
            if(self::Empty_validate($post['email'])){
                $errors['form_filed_error_email'] =  $this->getError("text_error_form_empty", [$this->getLabelForm("email")]);
            }else if(!self::Email_validate($post['email'])){
                $errors['form_filed_error_email'] =  $this->getError("text_error_form_email", [$this->getLabelForm("email")]);
            }else if(isset($_POST['emailExists']) && $_POST['emailExists'] !== false){
                $errors['form_filed_error_email'] = $this->getError("text_error_form_alraedy_exsits", [$this->getLabelForm("email")]);
            }
        }

        if(!isset($_POST['dbpassword'])){
            if(isset($post['newpassword'])){
                if(self::Empty_validate($post['newpassword'])){
                    $errors['form_filed_error_newpassword'] = $this->getError("text_error_form_empty", [$this->getLabelForm("newpassword")]);
                }else if(!self::Password_validate($post['newpassword'])){
                    $errors['form_filed_error_newpassword'] = $this->getError("text_error_form_newpassword", [$this->getLabelForm("newpassword")]);
                }else if(self::Empty_validate($post['c_newpassword'])){
                    $errors['form_filed_error_confirm_newpassword'] = $this->getError("text_error_form_empty", [$this->getLabelForm("confirm_newpassword")]);;
                }else if($post['newpassword'] !== $post['c_newpassword']){
                    $errors['form_filed_error_confirm_newpassword'] = $this->getError("text_error_form_c_newpassword", [$this->getLabelForm("confirm_newpassword"),$this->getLabelForm("newpassword")]);;
                }
            }
        }else{
            if(!empty($_POST['dbpassword'])){
                if(self::Empty_validate($_POST['oldpassword'])){
                    $errors['form_filed_error_oldpassword'] = $this->getError("text_error_form_empty", [$this->getLabelForm("oldpassword")]);
                } else if(!password_verify($_POST['oldpassword'], $_POST['dbpassword'])){
                    $errors['form_filed_error_oldpassword'] = $this->getError("text_error_form_oldpassword", [$this->getLabelForm("oldpassword")]);
                }
               
                if(self::Empty_validate($post['newpassword'])){
                    $errors['form_filed_error_newpassword'] = $this->getError("text_error_form_empty", [$this->getLabelForm("newpassword")]);
                }else if(!self::Password_validate($post['newpassword'])){
                    $errors['form_filed_error_newpassword'] = $this->getError("text_error_form_newpassword", [$this->getLabelForm("newpassword")]);
                }else if(self::Empty_validate($post['c_newpassword'])){
                    $errors['form_filed_error_confirm_newpassword'] = $this->getError("text_error_form_empty", [$this->getLabelForm("confirm_newpassword")]);;
                }else if($post['newpassword'] !== $post['c_newpassword']){
                    $errors['form_filed_error_confirm_newpassword'] = $this->getError("text_error_form_c_newpassword", [$this->getLabelForm("confirm_newpassword"),$this->getLabelForm("newpassword")]);;
                }
            }

        }

        if(isset($post['phonenumber'])){
            if(self::Empty_validate($post['phonenumber'])){
                $errors['form_filed_error_phonenumber'] = $this->getError("text_error_form_empty", [$this->getLabelForm("phonenumber")]);
            }else if(!self::PhoneNumber_validate($post['phonenumber'])){
                $errors['form_filed_error_phonenumber'] = $this->getError("text_error_form_phonenumber", [$this->getLabelForm("phonenumber")]);
            }
        }


        if(isset($post['usergroup'])){
            if(self::Empty_validate($post['usergroup'])){
                $errors['form_filed_error_usergroup'] = $this->getError("text_error_form_usergroup",  [$this->getLabelForm("usergroup")]);
            }    
        }

        if(empty($errors)){
            return true;
        }else{
            $this->_masseges->addMultiMassege($errors, Messenger::ERROR_MASSEGE);
            return false;
        }
    }


    public function clients_and_suppliers_Validation($post){

        
        if(isset($post['name'])){
            if(self::Empty_validate($post['name'])){
                $errors['form_filed_error_name'] = $this->getError("text_error_form_empty", [$this->getLabelForm("name")]);
            }else if(!self::names_validate($post['name'])){
                $errors['form_filed_error_name'] = $this->getError("text_error_form_names", [$this->getLabelForm("name")]);
            }else if(!self::between_validate($post['name'], 3, 40)){
                $errors['form_filed_error_name'] = $this->getError("text_error_form_chars_between", [$this->getLabelForm("name"), 3, 40]);
            }
        }
 

        if(isset($post['email'])){
            if(self::Empty_validate($post['email'])){
                $errors['form_filed_error_email'] =  $this->getError("text_error_form_empty", [$this->getLabelForm("email")]);
            }else if(!self::Email_validate($post['email'])){
                $errors['form_filed_error_email'] =  $this->getError("text_error_form_email", [$this->getLabelForm("email")]);
            }
        }


        if(isset($post['phonenumber'])){
            if(self::Empty_validate($post['phonenumber'])){
                $errors['form_filed_error_phonenumber'] = $this->getError("text_error_form_empty", [$this->getLabelForm("phonenumber")]);
            }else if(!self::PhoneNumber_validate($post['phonenumber'])){
                $errors['form_filed_error_phonenumber'] = $this->getError("text_error_form_phonenumber", [$this->getLabelForm("phonenumber")]);
            }
        }

        if(isset($post['address'])){
            if(self::Empty_validate($post['address'])){
                $errors['form_filed_error_address'] = $this->getError("text_error_form_empty", [$this->getLabelForm("address")]);
            }else if(!self::between_validate($post['address'], 3, 50)){
                $errors['form_filed_error_address'] = $this->getError("text_error_form_chars_between", [$this->getLabelForm("address"), 3, 40]);
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