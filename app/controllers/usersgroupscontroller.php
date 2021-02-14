<?php
namespace STORE\Controllers;
use STORE\CORE\FilterInput;
use STORE\CORE\functions;
use STORE\MODELS\GroupPrivilegesModel;
use STORE\MODELS\PrivilegesModel;
use STORE\MODELS\UsersGroupsModel;

class UsersGroupsController extends AbstractController
{
    use FilterInput;
    use functions;


    public function defaultAction(){
        $this->_data['groups'] = UsersGroupsModel::getAll(); 
        $this->view();
    }

    public function createAction(){
        $this->language->load($this->_controller . "|" . "labels");
        $this->_data['privileges'] = PrivilegesModel::getAll();

        if(isset($_POST['create'])){
            $group = new UsersGroupsModel();
            $group->groupname = $this->StrFilter($_POST['groupname']);
            $result = $group->save();
            if($result){
                $groupid =  $group->get_primary_key();
                if(isset($_POST['privileges']) && !empty($_POST['privileges'])){
                    $privileges = $_POST['privileges'];
                    foreach($privileges as $privilege){
                        $privilege = $this->IntFilter($privilege);
                        $groupPrivilege = new GroupPrivilegesModel();
                        $groupPrivilege->groupid = $groupid;
                        $groupPrivilege->privilegeid = $privilege;
                        $groupPrivilege->save();
                    }

                }
                $this->redirect("/usersgroups");
            }else{
                var_dump($result);
            }
        }
        $this->view();
    }

    public function editAction(){
        $groupid = $this->IntFilter($this->_params[0]);
        $group = UsersGroupsModel::get_By_pk($groupid);
        if($group === false){
            $this->redirect("/usersgroups");
        }

        $this->language->load($this->_controller . "|" . "labels");

        $this->_data['privileges'] = PrivilegesModel::getAll();
        $this->_data["privilegesGroup"] = $privilegesGroupIds = GroupPrivilegesModel::getGroupPrivilegesIds($groupid);

        if(isset($_POST['edit'])){
            $group->groupname = $this->StrFilter($_POST['groupname']);
            $result = $group->save();
            if($result){
                $privilegesWillBeDeleted = array_diff($privilegesGroupIds,$_POST['privileges']);
                $privilegesWillBeCreated = array_diff($_POST['privileges'],$privilegesGroupIds);

                foreach($privilegesWillBeDeleted as $privilegeid){
                    $privilege = GroupPrivilegesModel::getByCondition(array("privilegeid"=>$privilegeid , "groupid" => $groupid));
                    $privilege = array_shift($privilege);
                    $privilege->delete();
                }

                foreach($privilegesWillBeCreated as $privilegeid){
                    $privilege = new GroupPrivilegesModel();
                    $privilege->groupid = $groupid;
                    $privilege->privilegeid = $privilegeid;
                    $privilege->save();
                }
                $this->redirect("/usersgroups");
            }
        }

        $this->_data["group"] = $group;
        $this->view();
    }
        

        
    public function deleteAction(){
        $groupid = $this->IntFilter($this->_params[0]);
        $group = UsersGroupsModel::get_By_pk($groupid);
        if($group === false){
            $this->redirect("/usersgroups");
        }

        if($group->delete())
            $this->redirect("/usersgroups");
            
        }
}