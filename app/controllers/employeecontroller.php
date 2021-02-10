<?php
namespace STORE\Controllers;
use STORE\CORE\FilterInput;
use STORE\CORE\functions;
use STORE\MODELS\EmployeeModel;
class EmployeeController extends AbstractController
{
    use FilterInput;
    use functions;


    public function defaultAction(){
        $this->_data['employess'] = EmployeeModel::getAll(); 
        $this->view();
    }

    public function addAction(){
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            if(isset($_POST['add'])){
                $employee = new EmployeeModel();

                $employee->name         = $this->StrFilter($_POST['name']);
                $employee->salary       = $this->IntFilter($_POST['salary']);
                $employee->tax          = $this->StrFilter($_POST['tax']);
                $employee->number_phone = $this->StrFilter($_POST['phone']);
                $res = $employee->save();
                if($res === true){
                    self::redirect("/employee");
                }else{
                    var_dump($res);
                }
            }
                   
        }
        $this->view();
    }

    public function editAction(){
        if(isset($this->_params[0])){
            $id = $this->IntFilter($this->_params[0]);
            $employee = EmployeeModel::get_By_pk($id);
            if($employee === false)
                $this->redirect("/employee");
        }else
            $this->redirect("/employee");
        
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            if(isset($_POST['edit'])){
                $employee->name         = $this->StrFilter($_POST['name']);
                $employee->salary       = $this->IntFilter($_POST['salary']);
                $employee->tax          = $this->StrFilter($_POST['tax']);
                $employee->number_phone = $this->StrFilter($_POST['phone']);
                $result = $employee->save();
                if($result === true){
                    $this->redirect("/employee");
                }else{
                    var_dump($result);
                }
            }           
        }

        $this->_data['employee'] = $employee;
        $this->view();
    }


    public function deleteAction(){
        if(isset($this->_params[0])){
            $id = $this->IntFilter($this->_params[0]);
            $employee = EmployeeModel::get_By_pk($id);
            if($employee !== false){
                $employee->delete_employee();
                $this->redirect("/employee");
            }    
        }else{
            $this->redirect("/employee");
        }
    }

}