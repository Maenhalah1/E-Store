<?php
namespace STORE\Controllers;
use STORE\CORE\FilterInput;
use STORE\CORE\functions;
use STORE\MODELS\PrivilegesModel;

class PrivilegesController extends AbstractController
{
    use FilterInput;
    use functions;


    public function defaultAction(){
        $this->_data['privileges'] = PrivilegesModel::getAll(); 
        $this->view();
    }

    public function createAction(){
        $this->_language->load($this->_controller . "|" . "labels");

        if(isset($_POST['create'])){
            $privilege = new PrivilegesModel();
            $privilege->privilegetitle = $this->StrFilter($_POST['privilegetitle']);
            $privilege->privilege = $this->StrFilter($_POST['privilegeurl']);
            $result = $privilege->save();
            if($result === true){
                $this->redirect("/privileges");
            }else{
                var_dump($result);
            }
        }
        $this->view();
    }

    
    public function editAction(){
        $id = $this->IntFilter($this->_params[0]);
        $privilege = PrivilegesModel::get_By_pk($id);
        if($privilege === false) $this->redirect("/privileges");

        $this->_language->load($this->_controller . "|" . "labels");

        if(isset($_POST['edit'])){
            $privilege->privilegetitle = $this->StrFilter($_POST['privilegetitle']);
            $privilege->privilege = $this->StrFilter($_POST['privilegeurl']);
            $result = $privilege->save();
            if($result === true){
                $this->redirect("/privileges");
            }else{
                var_dump($result);
            }
        }

        $this->_data['privilege'] = $privilege;
        $this->view();
    }


    public function deleteAction(){
        $id = $this->IntFilter($this->_params[0]);
        $privilege = PrivilegesModel::get_By_pk($id);
        if($privilege === false) $this->redirect("/privileges");

        $this->_language->load($this->_controller . "|" . "labels");

        if($privilege->delete())
        {
            $this->redirect("/privileges");
        }
    }
}