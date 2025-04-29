<?php
require_once 'model.php';
class ClienteModel extends Models
{
    public function getCliente($user){
        $query = "SELECT * FROM clientes WHERE correo=:usuario";
        return $this->get_query($query, [':usuario' => $user]);
    }

    public function get(){
        $query = "SELECT * FROM clientes";
        return $this->get_query($query);
    }

    public function getById($id){
        $query = "SELECT * FROM clientes WHERE id=:id";
        return $this->get_query($query, [':id' => $id]);
    }

    public function desactivar($id){
        $query = "UPDATE clientes SET estado='inhabilitado' WHERE id=:id";
        return $this->set_query($query, [':id' => $id]);
    }

    public function activar($id){
        $query = "UPDATE clientes SET estado='activo' WHERE id=:id";
        return $this->set_query($query, [':id' => $id]);
    }

    public function update($id,$nombre, $correo, $telefono, $direccion){
        $query = "UPDATE clientes SET nombre=:nombre, correo=:correo, telefono=:telefono, direccion=:direccion WHERE id=:id";
        return $this->set_query($query, [':nombre' => $nombre, ':correo' => $correo, ':telefono' => $telefono, ':direccion' => $direccion, ':id' => $id]);
    }

    public function insert($nombre, $correo,$contrasena, $telefono, $direccion,$estado){
        $query = "INSERT INTO clientes (nombre, correo,contrasena, telefono, direccion,estado) VALUES (:nombre, :correo,:contrasena, :telefono, :direccion,:estado)";
        return $this->set_query($query, [':nombre' => $nombre, ':correo' => $correo,':contrasena' => $contrasena, ':telefono' => $telefono, ':direccion' => $direccion,':estado'=>$estado]);
    }
}
?>
