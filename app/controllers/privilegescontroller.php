<?php
namespace STORE\Controllers;
use STORE\CORE\FilterInput;
use STORE\CORE\functions;
use STORE\CORE\Messenger;
use STORE\MODELS\PrivilegesModel;

class PrivilegesController extends AbstractController
{
    use FilterInput;
    use functions;


    public function defaultAction(){
        $this->language->load("template" . "|" . "common");
        $this->language->load(strtolower($this->_controller) . "|" . strtolower($this->_action));
        $this->_data['privileges'] = PrivilegesModel::getAll(); 
        $this->view();
    }

    public function createAction(){
        $this->language->load("template" . "|" . "common");
        $this->language->load($this->_controller . "|" . "labels");
        $this->language->load(strtolower($this->_controller) . "|" . strtolower($this->_action));

        if(isset($_POST['create'])){
            $privilege = new PrivilegesModel();
            $privilege->privilegetitle = $this->StrFilter($_POST['privilegetitle']);
            $privilege->privilege = $this->StrFilter($_POST['privilegeurl']);
            $result = $privilege->save();
            if($result === true){
                $this->masseges->addMassege("privilgeMessage","تم اضافة الصلاحية بنجاح");
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

        $this->language->load($this->_controller . "|" . "labels");
        $this->language->load("template" . "|" . "common");
        $this->language->load(strtolower($this->_controller) . "|" . strtolower($this->_action));

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

        $this->language->load($this->_controller . "|" . "labels");

        if($privilege->delete())
        {
            $this->masseges->addMassege("privilgeMessage","تم حذف الصلاحية بنجاح", Messenger::ERROR_MASSEGE);
            $this->redirect("/privileges");
        }
    }
}