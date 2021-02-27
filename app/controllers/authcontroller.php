<?php


namespace STORE\Controllers;

use STORE\CORE\FilterInput;
use STORE\CORE\functions;
use STORE\CORE\Messenger;
use STORE\CORE\validate;
use STORE\MODELS\EmployeeModel;

class AuthController extends AbstractController
{
    use validate;
    use functions;
    use FilterInput;


    public function defaultAction(){
        $this->redirect("auth/login");    
    }

    public function loginAction(){
        $this->language->load(strtolower($this->_controller) . "|" . strtolower($this->_action));
        $this->_template->swap_templete(['view'=>'']);
        if(isset($_POST['login'])){
            $username = $this->StrFilter($_POST['username']);
            if($this->authentication->login($username,$_POST['password']) === 1){
                $this->redirect("/");
            }
        }
        $this->view();
    }

    public function logoutAction(){
        $this->session->endSession();
        $this->redirect("/auth/login");
    }

}