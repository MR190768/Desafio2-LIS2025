<?php
require_once 'Controllers.php';
require_once 'Utils/validaciones.php';
require_once 'models/UsuariosModels.php';
require_once 'models/ClientesModels.php';

class UsuariosController extends ContBase{

    private $model;
    private $clienteModel;

    public function __construct(){
        $this->model = new UsuarioModel();
        $this->clienteModel = new ClienteModel();
    }

    public function Index(){
        $viewBag = [];
        $viewBag['clientes'] = $this->clienteModel->get();
        $this->render("index.php", $viewBag);
    }

    public function editar($id){
        $viewBag = [];
        $viewBag['cliente'] = $this->clienteModel->getById($id[0]);
        $this->render("editarCliente.php", $viewBag);
    }

    public function desactivar($id){
        $this->clienteModel->desactivar($id[0]);
        header('Location:' . PATH . 'usuarios');
    }

    public function activar($id){
        $this->clienteModel->activar($id[0]);
        header('Location:' . PATH . 'usuarios');
    }

    public function clienteActualizar(){
        $errores=[];
        if (isset($_POST)) {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $correo = $_POST['correo'];
            $telefono = $_POST['telefono'];
            $direccion = $_POST['direccion'];
            if(esTelefono($telefono)==1){
                try{
                    $this->clienteModel->update($id,$nombre, $correo, $telefono, $direccion);
                    header('Location:' . PATH . 'usuarios');
                }catch(Exception $e){
                    $errores[] = "Error al actualizar el cliente";
                    $_SESSION['errores'] = $errores;
                    header('Location:' . PATH . 'usuarios/editar/'.$id);
                }

            }
            else{
                $errores[] = "El telefono no es valido";
                $_SESSION['errores'] = $errores;
                header('Location:' . PATH . 'usuarios/editar/'.$id);
            }
        }
    }

    public function userAdmin(){
        $viewBag = [];
        $viewBag['usuarios'] = $this->model->get();
        $this->render("indexAdmin.php", $viewBag);
    }

    public function anadirAdmin(){
        $this->render("anadirUser.php");
    }

    public function guardarAdmin(){
        if(isset($_POST)){
            $errores=[];
        if (isset($_POST)) {
            $nombre = $_POST['nombre'];
            $contrasena = $_POST['contrasena'];
            $correo = $_POST['correo'];
            $rol = $_POST['rol'];
                try{
                    $this->model->insertar($nombre, $correo, $contrasena, $rol);
                    header('Location:' . PATH . 'usuarios/userAdmin');
                }catch(Exception $e){
                    $errores[] = "Error al insertar el usuario";
                    $_SESSION['errores'] = $errores;
                    header('Location:' . PATH . 'usuarios/userAdmin');
                }
        }
        }
    }

    public function ActualizarAdmin(){
        if(isset($_POST)){
            $errores=[];
        if (isset($_POST)) {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $contrasena = $_POST['contrasena'];
            $correo = $_POST['correo'];
            $rol = $_POST['rol'];
                try{
                    $this->model->actualizar($id,$nombre, $correo, $contrasena, $rol);
                    header('Location:' . PATH . 'usuarios/userAdmin');
                }catch(Exception $e){
                    $errores[] = "Error al actualizar el usuario";
                    $_SESSION['errores'] = $errores;
                    header('Location:' . PATH . 'usuarios/userAdmin');
                }
        }
        }

    }

    public function actualizar($id){
        $viewBag = [];
        $viewBag['User'] = $this->model->getById($id[0]);
        $this->render("editarUser.php", $viewBag);
    }


}


?>