<?php
namespace STORE\Controllers;
use STORE\CORE\FilterInput;
use STORE\CORE\functions;
use STORE\MODELS\UsersModel;

class UsersController extends AbstractController
{
    use FilterInput;
    use functions;


    public function defaultAction(){
        $this->_data['users'] = UsersModel::getAll(); 
        $this->view();
    }
}