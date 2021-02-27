<?php


namespace STORE\Controllers;

use STORE\CORE\Messenger;
use STORE\CORE\validate;
use STORE\MODELS\EmployeeModel;
use STORE\MODELS\GroupPrivilegesModel;

class IndexController extends AbstractController
{
    use validate;

    public function defaultAction(){
        $this->language->load("validation" . "|" . "common");
        $this->language->load("validation" . "|" . strtolower($this->_controller));
        $this->language->load("template" . "|" . "common");
        $this->language->load(strtolower($this->_controller) . "|" . strtolower($this->_action));
      //  var_dump($this->session->user_login->privileges);die;
        $this->_data['valid'] = $this->between_validate(4,1,4);
        $this->view();


    }

    public function addAction(){
        $this->view();
    }

}