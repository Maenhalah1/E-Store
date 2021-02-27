<?php
namespace STORE\Controllers;
use STORE\CORE\FilterInput;
use STORE\CORE\functions;
use STORE\CORE\Messenger;
use STORE\CORE\Validation;
use STORE\MODELS\UserProfileModel;
use STORE\MODELS\UsersGroupsModel;
use STORE\MODELS\UsersModel;

class UsersController extends AbstractController
{
    use FilterInput;
    use functions;


    public function defaultAction(){
        $this->language->load("template" . "|" . "common");
        $this->language->load(strtolower($this->_controller) . "|" . strtolower($this->_action));
        $this->_data['users'] = UsersModel::getUsers($this->authentication->user); 
        $this->view();
    }


    public function createAction(){
        $this->language->load("template" . "|" . "common");
        $this->language->load("validation" . "|" . "common");
        $this->language->load("validation" . "|" . strtolower($this->_controller));
        $this->language->load(strtolower($this->_controller) . "|" . strtolower($this->_action));
        $this->language->load(strtolower($this->_controller) . "|" . "labels");
        $this->language->load(strtolower($this->_controller) . "|" . "masseges");


        $this->_data['groups'] = UsersGroupsModel::getAll();

        if(isset($_POST['create'])){
            $_POST['usernameExists']    = (UsersModel::UsernamEexsits($_POST['username']) !== false);
            $_POST['emailExists']       = (UsersModel::EmailExsits($_POST['email']) !== false);
            if($this->validation->User_Validation($_POST)){
                $user = new UsersModel();
                $user->username         = $this->StrFilter($_POST['username']);
                $user->email            = $this->StrFilter($_POST['email']);
                $user->Password         = password_hash($_POST['newpassword'], PASSWORD_DEFAULT);
                $user->phonenumber      = $this->StrFilter($_POST['phonenumber']);
                $user->usergroup          = $this->StrFilter($_POST['usergroup']);
                $user->SubscriptionDate = date('Y-m-d');
                $user->LastLogin        = date('Y-m-d H:i:s');
                $user->profile = new UserProfileModel();
                $user->profile->firstname = $this->StrFilter($_POST['firstname']);
                $user->profile->lastname = $this->StrFilter($_POST['lastname']);
                if($user->save()){

                    $this->masseges->addMassege("userAction", $this->language->get("text_form_masseges_create_success"));
                    $this->redirect("\users");
                }else{
                    $this->masseges->addMassege("userAction", $this->language->get("text_form_masseges_create_error"), Messenger::ERROR_MASSEGE);
                    $this->redirect("\users");
                }
            }
        }
        $this->view();
    }

    public function editAction(){

        $id = @$this->_params[0];
        $id = $this->IntFilter($id);
        $user = UsersModel::get_By_pk($id);
        if($user === false){
            $this->redirect("/users");
        }
        $this->_data['user'] = $user;

        $this->language->load("validation" . "|" . "common");
        $this->language->load("validation" . "|" . strtolower($this->_controller));
        $this->language->load("template" . "|" . "common");
        $this->language->load(strtolower($this->_controller) . "|" . strtolower($this->_action));
        $this->language->load(strtolower($this->_controller) . "|" . "labels");
        $this->language->load(strtolower($this->_controller) . "|" . "masseges");


        $this->_data['groups'] = UsersGroupsModel::getAll();

        if(isset($_POST['edit'])){
            if($_POST['username'] != $user->username){
                $_POST['usernameExists']    = (UsersModel::UsernamEexsits($_POST['username']) !== false);
            }
            if($_POST['email'] != $user->email){
                $_POST['emailExists']       = (UsersModel::EmailExsits($_POST['email']) !== false);
            }
            if(!empty($_POST['newpassword']) || !empty($_POST['oldpassword'])){
                $_POST['dbpassword'] = $user->Password;
            }else{
                $_POST['dbpassword'] = "";
            }

            if($this->validation->User_Validation($_POST)){
                $user->username             = $this->StrFilter($_POST['username']);
                $user->email                = $this->StrFilter($_POST['email']);
                $user->Password             = password_hash($_POST['newpassword'], PASSWORD_DEFAULT);
                $user->phonenumber          = $this->StrFilter($_POST['phonenumber']);
                $user->usergroup            = $this->StrFilter($_POST['usergroup']);

                if($user->save()){
                    $this->masseges->addMassege("userAction", $this->language->get("text_form_masseges_update_success"));
                    $this->redirect("\users");
                }else{
                    $this->masseges->addMassege("userAction", $this->language->get("text_form_masseges_update_error"), Messenger::ERROR_MASSEGE);
                    $this->redirect("\users");
                }
            }
        }
        $this->view();
    }


    
    public function deleteAction(){

        $id = @$this->_params[0];
        $id = $this->IntFilter($id);
        $user = UsersModel::get_By_pk($id);
        if($user === false || $user->get_primary_key() == $this->authentication->user->get_primary_key()){
            $this->redirect("/users");
        }
        $this->language->load(strtolower($this->_controller) . "|" . "masseges");

        if($user->delete()){
            $this->masseges->addMassege("userAction", $this->language->get("text_form_masseges_delete_success"));
        }else{
            $this->masseges->addMassege("userAction", $this->language->get("text_form_masseges_delete_error",Messenger::ERROR_MASSEGE));
        }
        $this->redirect("\users");
    }


    public function checkUserExistsAjaxAction(){
        if($_POST['username']){
            header("Content-type: text/plain");
            if(UsersModel::UsernamEexsits($_POST['username']) !== false){
                echo 1;
            }else{
                echo -1;
            }
        }
    }
}