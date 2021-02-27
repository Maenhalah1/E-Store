<?php
namespace STORE\MODELS;

use PDOStatement;

abstract class AbstractModal {

    const  DATA_TYPE_BOOL       = \PDO::PARAM_BOOL;
    const  DATA_TYPE_STR        = \PDO::PARAM_STR;
    const  DATA_TYPE_INT        = \PDO::PARAM_INT;
    const  DATA_TYPE_DECIMAL    = 4;

    protected static $tableName;
    protected static $tableSchema;
    protected static $primaryKey;

    protected abstract static function get_all_properties();
    public abstract  function get_primary_key();
    protected abstract  function set_primary_key($pk);
    public abstract  function save();

    public static function View_Table_Schema(){
        return static::$tableSchema;
    }
    
    public static function getTableName(){
        return static::$tableName;
    }

    private function prepareActionsParams(){
        $Stmtparams = '';
        foreach (static::$tableSchema as $param => $type){
            $class_name = get_called_class();
            if(property_exists($class_name, $param)) {
                $Stmtparams .= $param . " = :" . $param . ", ";
            }
        }
        return  trim($Stmtparams, ", ");
    }

    private function bindActionsParams(\PDOStatement  &$stmt){
        foreach (static::$tableSchema as $param => $type){
            $class_name = get_called_class();
            if(property_exists($class_name, $param)) {
                if($type == 4){
                    $this->$param = filter_var($this->$param, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    $stmt->bindParam(':' . $param, $this->$param);
                }else{
                    //echo $this->{$param};
                    $stmt->bindParam(':' . $param, $this->$param, $type);
                }
            }
        }
    }

    protected function create(){
        global $con, $db;

        $sql = "INSERT INTO " . static::$tableName . " SET " . $this->prepareActionsParams();
        $stmt = $con->prepare($sql);
        $this->bindActionsParams($stmt);
        $res = $stmt->execute();
        if($res)
            $this->set_primary_key($db->last_id());
        return $res;
    }

    protected function update(){
        global $con;
        $sql = "UPDATE " . static::$tableName . " SET " . $this->prepareActionsParams() . " WHERE " . static::$primaryKey . " = " . $this->get_primary_key();
        $stmt = $con->prepare($sql);
        $this->bindActionsParams($stmt);
        return $stmt->execute();
    }

    public function delete(){
        global $con;
        $sql = "DELETE FROM " . static::$tableName . " WHERE " . static::$primaryKey . " = " . $this->get_primary_key();
        $stmt = $con->prepare($sql);
        return $stmt->execute();
    }

    public static function getAll(){
        global $con;
        $sql = "SELECT * FROM " . static::$tableName ;
        $stmt = $con->prepare($sql);
        if($stmt->execute()){
            $res = static::fetchClass($stmt);
            return empty($res[0]) ? false : $res;
        }else{
            return false;
        }
    }


    public static function fetchClass(\PDOStatement $stmt){
        $class_name = get_called_class();
        $res = "";
        if(method_exists($class_name, "__construct")){
            $res = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $class_name , static::get_all_properties());
        }else{
            $res = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $class_name);
        }
        return $res;
    }


    public static function get_By_pk($pk){
        global $con;
        $sql = "SELECT * FROM " . static::$tableName . " WHERE " . static::$primaryKey . " = :pk ";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":pk",$pk);
        if($stmt->execute()){
            $res = static::fetchClass($stmt);
            return empty($res[0]) ? false : array_shift($res);
        }else{
            return false;
        }
    }


    private static function bindGetParams(\PDOStatement  &$stmt, array $schema){
        foreach ($schema as $param => $value){
            $stmt->bindParam(':' . $param, $value);
        }
    }


    private static function bindByConditionParams(\PDOStatement  &$stmt, $colums){
        foreach ($colums as $col => $value){
                
                $stmt->bindParam(':' . $col, $value);
            }
        }
    

    private static function prepareWhereCondition(array $colums){
        $where = "";
        $numberColums = count($colums);
        for( $i=0; $i < $numberColums; $i++){
            $where .= $colums[$i] . " = :" . $colums[$i];
            if($i < ($numberColums-1)){
                $where .= " AND ";
            } 
        }
        return $where;
    }

    public static function getByCondition($colums, $options = []){
        if(!is_array($colums) || empty($colums)){
            trigger_error("The Function getByCondition Must contain Row name as array key and value as array value", E_USER_ERROR);
            die();
        }

        global $con;
        $cols = array_keys($colums);
        $where = " WHERE " . static::prepareWhereCondition($cols);
        $sql = "SELECT * FROM " . static::$tableName . $where;    
        $stmt = $con->prepare($sql);
        $prep = [];
        foreach ($colums as $col => $value){        
            $col = ":" . $col;
            $prep[$col] = $value;
        }
       // static::bindByConditionParams($stmt, $colums);
        if($stmt->execute($prep)){
            $res = static::fetchClass($stmt);
            return empty($res[0]) ? false : $res;
        }else{
            return false;
        }
    }

    public static function getOne($sql , array $colums = []){
       
        global $con;
        $cols = array_keys($colums);
        $stmt = $con->prepare($sql);
        $prep = [];
        if(!empty($colums)){
            foreach ($colums as $col => $value){        
                $col = ":" . $col;
                $prep[$col] = $value;
            }
        }
       // static::bindByConditionParams($stmt, $colums);
        if($stmt->execute($prep)){
            $res = static::fetchClass($stmt);
            return empty($res[0]) ? false : array_shift($res);
        }else{
            return false;
        }
    }




    public static function get($sql, array $schema = []){
        global $con;
        $stmt = $con->prepare($sql);
        if(!empty($schema))
            static::bindGetParams($stmt, $schema);
            
        if($stmt->execute()){
            $res = static::fetchClass($stmt);
            return empty($res[0]) ? false : $res;
        }else{
            return false;
        }
    }

}