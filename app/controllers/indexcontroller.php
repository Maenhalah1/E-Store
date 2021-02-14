<?php


namespace STORE\Controllers;

use STORE\CORE\Messenger;
use STORE\CORE\validate;
use STORE\MODELS\EmployeeModel;

class IndexController extends AbstractController
{
    use validate;

    public function defaultAction(){
        $this->_data['valid'] = $this->date_validate("1999/5/5");
        $this->view();
    }

    public function addAction(){
        $this->view();
    }

}