<?php
namespace STORE\Controllers;
use STORE\CORE\FilterInput;
use STORE\CORE\functions;
use STORE\CORE\Messenger;
use STORE\CORE\Validation;
use STORE\MODELS\SupplierModel;


class SuppliersController extends AbstractController
{
    use FilterInput;
    use functions;


    public function defaultAction(){
        $this->language->load("template" . "|" . "common");
        $this->language->load(strtolower($this->_controller) . "|" . strtolower($this->_action));
        $this->_data['suppliers'] = SupplierModel::getAll(); 
        $this->view();
    }


    public function createAction(){
        $this->language->load("template" . "|" . "common");
        $this->language->load("validation" . "|" . "common");
        $this->language->load("validation" . "|" . strtolower($this->_controller));
        $this->language->load(strtolower($this->_controller) . "|" . strtolower($this->_action));
        $this->language->load(strtolower($this->_controller) . "|" . "labels");
        $this->language->load(strtolower($this->_controller) . "|" . "masseges");



        if(isset($_POST['create'])){

            if($this->validation->clients_and_suppliers_Validation($_POST)){
                $supplier = new SupplierModel();
                $supplier->name             = $this->StrFilter($_POST['name']);
                $supplier->email            = $this->StrFilter($_POST['email']);
                $supplier->phonenumber      = $this->StrFilter($_POST['phonenumber']);
                $supplier->address          = $this->StrFilter($_POST['address']);

                if($supplier->save()){

                    $this->masseges->addMassege("suppliersAction", $this->language->get("text_form_masseges_create_success"));
                    $this->redirect("\suppliers");
                }else{
                    $this->masseges->addMassege("suppliersAction", $this->language->get("text_form_masseges_create_error"), Messenger::ERROR_MASSEGE);
                    $this->redirect("\suppliers");
                }
            }
        }
        $this->view();
    }

    public function editAction(){

        $id = @$this->_params[0];
        $id = $this->IntFilter($id);
        $supplier = SupplierModel::get_By_pk($id);
        if($supplier === false){
            $this->redirect("/users");
        }
        $this->_data['supplier'] = $supplier;

        $this->language->load("validation" . "|" . "common");
        $this->language->load("validation" . "|" . strtolower($this->_controller));
        $this->language->load("template" . "|" . "common");
        $this->language->load(strtolower($this->_controller) . "|" . strtolower($this->_action));
        $this->language->load(strtolower($this->_controller) . "|" . "labels");
        $this->language->load(strtolower($this->_controller) . "|" . "masseges");



        if(isset($_POST['edit'])){
           

            if($this->validation->clients_and_suppliers_Validation($_POST)){
                $supplier->name             = $this->StrFilter($_POST['name']);
                $supplier->email            = $this->StrFilter($_POST['email']);
                $supplier->phonenumber      = $this->StrFilter($_POST['phonenumber']);
                $supplier->address          = $this->StrFilter($_POST['address']);

                if($supplier->save()){
                    $this->masseges->addMassege("suppliersAction", $this->language->get("text_form_masseges_update_success"));
                    $this->redirect("\suppliers");
                }else{
                    $this->masseges->addMassege("suppliersAction", $this->language->get("text_form_masseges_update_error"), Messenger::ERROR_MASSEGE);
                    $this->redirect("\suppliers");
                }
            }
        }
        $this->view();
    }


    
    public function deleteAction(){

        $id = @$this->_params[0];
        $id = $this->IntFilter($id);
        $supplier = SupplierModel::get_By_pk($id);
      
        $this->language->load(strtolower($this->_controller) . "|" . "masseges");

        if($supplier->delete()){
            $this->masseges->addMassege("suppliersAction", $this->language->get("text_form_masseges_delete_success"));
        }else{
            $this->masseges->addMassege("suppliersAction", $this->language->get("text_form_masseges_delete_error",Messenger::ERROR_MASSEGE));
        }
        $this->redirect("\suppliers");
    }


}