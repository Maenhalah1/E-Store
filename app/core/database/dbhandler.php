<?php

namespace STORE\CORE\DATABASE;

class DBHandler{

    public $PDOconn;

    public function __construct(){
        $this->connection_DB();
    }

    private function connection_DB(){
        try{
            $this->PDOconn = new \PDO("mysql:host=localhost;dbname=storedb","root","",
                    array(
                        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, // error showing mode
                        \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' // after all query execute this command
                    )
                );
        }catch(\PDOException $e){
            die($e->getMessage() . " You Have Error to connects");
        }
    }

    
	public function last_id() {
	     return $this->PDOconn->lastInsertId();
    }

}


?>