<?php
require_once 'Controllers.php';
require_once 'Models/ClientesModels.php';
require_once 'Models/UsuariosModels.php';
require_once 'Utils/validaciones.php';

class LoginController extends Contbase
{
    private $model;
    private $modelUser;
    function __construct()
    {
        $this->model = new ClienteModel();
        $this->modelUser = new UsuarioModel();
    }

    public function Index()
    {
        $this->render("index.php");
    }

    public function enter()
    {
        if (isset($_POST)) {
            $user = $_POST['email'];
            $pass = $_POST['password'];
            $ClientData = $this->model->getCliente($user);
            $userData = $this->modelUser->getUser($user);
            if ($ClientData  != null && $pass == $ClientData [0]['contrasena']) {
                if ($ClientData [0]['estado'] == 'activo') {
                    $_SESSION['user'] = $ClientData [0];
                    header('Location:' . PATH . 'productos');
                }
            } else {
                if ($userData != null && $pass == $userData[0]['contrasena']) {
                    if ($userData[0]['rol'] == 'admin' || $userData[0]['rol'] == 'empleado') {
                        $_SESSION['user'] = $userData[0];
                        header('Location:' . PATH . 'productos/admin');
                    }
                }
                else{
                    $_SESSION['error'] = "Correo o contraseña incorrectos";
                    header('Location:' . PATH . 'login');
                }
            }
        }
    }

    public function exit()
    {
        unset($_SESSION['user']);
        unset($_SESSION['carrito']);
        header('Location:' . PATH . 'productos');
    }
}
