<?php
require_once 'model.php';
class UsuarioModel extends Models
{
    public function getUser($user){
        $query = "SELECT * FROM usuarios WHERE correo=:usuario";
        return $this->get_query($query, [':usuario' => $user]);
    }

    public function get(){
        $query = "SELECT * FROM usuarios";
        return $this->get_query($query);
    }

    public function getById($id){
        $query = "SELECT * FROM usuarios WHERE id=:id";
        return $this->get_query($query, [':id' => $id]);
    }

    public function insertar($nombre, $correo, $contrasena, $rol){
        $query = "INSERT INTO usuarios (nombre, correo, contrasena, rol) VALUES (:nombre, :correo, :contrasena, :rol)";
        return $this->set_query($query, [':nombre' => $nombre, ':correo' => $correo, ':contrasena' => $contrasena, ':rol' => $rol]);
    }

    public function actualizar($id, $nombre, $correo, $contrasena, $rol){
        $query = "UPDATE usuarios SET nombre=:nombre, correo=:correo, contrasena=:contrasena, rol=:rol WHERE id=:id";
        return $this->set_query($query, [':id' => $id, ':nombre' => $nombre, ':correo' => $correo, ':contrasena' => $contrasena, ':rol' => $rol]);
    }

    public function eliminar($id){
        $query = "DELETE FROM usuarios WHERE id=:id";
        return $this->set_query($query, [':id' => $id]);
    }

}
