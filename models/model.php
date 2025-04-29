<?php
 abstract class Models{

    private $host='localhost:3306';
    private $user='root';
    private $password='';
    private $db_name='textilexport';
    protected $conn;

    protected function open_db(){
        try{
            $this->conn=new PDO("mysql:host=$this->host;dbname=$this->db_name;charset=utf8",$this->user,$this->password);
            return $this->conn;
        }catch(PDOException $e){
            echo "Error: ".$e->getMessage();
        }
    }

    protected function close_db(){
        $this->conn=null;
    }

    protected function get_query($query,$params=[]){
        try{
            $rows=[];
            $this->open_db();
            $stmt=$this->conn->prepare($query);
            $stmt->execute($params);
            while($rows[]=$stmt->fetch(PDO::FETCH_ASSOC));
            $this->close_db();
            array_pop($rows);
            return $rows;

        }catch(PDOException $e){
            $this->close_db();
            return [];
        }

    }

    protected function set_query($query,$params=[]){
        try{
            $this->open_db();
            $stmt=$this->conn->prepare($query);
            $stmt->execute($params);
            $id=$this->conn->lastInsertId();
            $this->close_db();
            return $id;

        }catch(PDOException $e){
            $this->close_db();
            return 0;
        }

    }

}

?>