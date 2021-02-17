<?php


namespace STORE\Controllers;

use STORE\CORE\Messenger;
use STORE\CORE\validate;
use STORE\MODELS\EmployeeModel;

class IndexController extends AbstractController
{
    use validate;

    public function defaultAction(){
        $this->language->load("validation" . "|" . "common");
        $this->language->load("validation" . "|" . strtolower($this->_controller));
        $this->language->load("template" . "|" . "common");
        $this->language->load(strtolower($this->_controller) . "|" . strtolower($this->_action));

        $this->_data['valid'] = $this->between_validate(4,1,4);
        $this->view();


    }

    public function addAction(){
        $this->view();
    }

}