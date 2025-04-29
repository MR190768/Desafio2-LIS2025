<?php
require_once 'model.php';
class CategoriaModel extends Models{
 
    public function get(){
        $query="SELECT * FROM categorias";
        return $this->get_query($query);
    }
    public function getById($id=''){
            $query="SELECT * FROM categorias WHERE id=:codigo";
            return $this->get_query($query,[':codigo'=>$id]);
    }

    public function insert(){
        $query="INSERT INTO categorias (nombre, descripcion) VALUES (:nombre, :descripcion)";
        return $this->set_query($query,[':nombre'=>$_POST['nombre'],':descripcion'=>$_POST['descripcion']]);
    }

    public function update($id){
        $query="UPDATE categorias SET nombre=:nombre, descripcion=:descripcion WHERE id=:id";
        return $this->set_query($query,[':nombre'=>$_POST['nombre'],':descripcion'=>$_POST['descripcion'],':id'=>$id]);
    }

    public function delete($id){
        $query="DELETE FROM categorias WHERE id=:id";
        return $this->set_query($query,[':id'=>$id]);
    }

}