<?php
namespace STORE\Controllers;
use STORE\CORE\FilterInput;
use STORE\CORE\functions;
use STORE\MODELS\UsersGroupsModel;

class UsersGroupsController extends AbstractController
{
    use FilterInput;
    use functions;


    public function defaultAction(){
        $this->_data['groups'] = UsersGroupsModel::getAll(); 
        $this->view();
    }
}