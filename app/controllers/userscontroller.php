<?php
namespace STORE\Controllers;
use STORE\CORE\FilterInput;
use STORE\CORE\functions;
use STORE\CORE\Validation;
use STORE\MODELS\UsersGroupsModel;
use STORE\MODELS\UsersModel;

class UsersController extends AbstractController
{
    use FilterInput;
    use functions;


    public function defaultAction(){
        $this->_data['users'] = UsersModel::getAll(); 
        $this->view();
    }


    public function createAction(){
        $this->language->load("validation" . "|" . "common");
        $this->language->load("validation" . "|" . strtolower($this->_controller));
        $this->language->load("template" . "|" . "common");
        $this->language->load(strtolower($this->_controller) . "|" . strtolower($this->_action));
        $this->language->load(strtolower($this->_controller) . "|" . "labels");

        $this->_data['groups'] = UsersGroupsModel::getAll();

        if(isset($_POST['create'])){
            var_dump($this->validation->User_Validation($_POST));
        }
        $this->view();
    }
}