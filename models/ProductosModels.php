<?php
require_once 'model.php';
class ProductosModel extends Models{

    public function getById($id=''){
        if($id==''){
            $query="SELECT * FROM productos";
            return $this->get_query($query);
        }
        else{
            $query="SELECT * FROM productos WHERE codigo=:codigo";
            return $this->get_query($query,[':codigo'=>$id]);
        }
    }

    public function get(){
            $query="SELECT * FROM productosV";
            return $this->get_query($query);
    }

    public function actualizarStock($stock,$codigo){
        $query="UPDATE productos SET existencias=:existencias WHERE codigo=:codigo_producto";
        return $this->set_query($query,[':existencias'=>$stock,':codigo_producto'=>$codigo]);
    }

    public function Insertar($codigo,$nombre,$descripcion,$imagen,$categoria_id,$precio,$existencias){
        $query="INSERT INTO productos (codigo,nombre,descripcion,imagen,categoria_id,precio,existencias) VALUES (:codigo,:nombre,:descripcion,:imagen,:categoria_id,:precio,:existencias)";
        return $this->set_query($query,[':codigo'=>$codigo,':nombre'=>$nombre,':descripcion'=>$descripcion,':imagen'=>$imagen,':categoria_id'=>$categoria_id,':precio'=>$precio,':existencias'=>$existencias]);
    }
    public function eliminar($codigo){
        $query="DELETE FROM productos WHERE codigo=:codigo_producto";
        return $this->set_query($query,[':codigo_producto'=>$codigo]);
    }

    public function actualizar($codigo,$nombre,$descripcion,$imagen,$categoria_id,$precio,$existencias){
        $query="UPDATE productos SET nombre=:nombre,descripcion=:descripcion,imagen=:imagen,categoria_id=:categoria_id,precio=:precio,existencias=:existencias WHERE codigo=:codigo_producto";
        return $this->set_query($query,[':nombre'=>$nombre,':descripcion'=>$descripcion,':imagen'=>$imagen,':categoria_id'=>$categoria_id,':precio'=>$precio,':existencias'=>$existencias,':codigo_producto'=>$codigo]);
    }


}





?>