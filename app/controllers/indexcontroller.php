<?php


namespace STORE\Controllers;

use STORE\MODELS\EmployeeModel;

class IndexController extends AbstractController
{

    public function defaultAction(){   
        $this->view();
    }

    public function addAction(){
        $this->view();
    }

}