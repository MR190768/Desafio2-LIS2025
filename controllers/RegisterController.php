<?php
require_once 'Controllers.php';
require_once 'Models/ClientesModels.php';
require_once 'Models/UsuariosModels.php';
require_once 'Utils/validaciones.php';

class RegisterController extends Contbase
{
    private $modelCliente;

    public function __construct()
    {
        $this->modelCliente = new ClienteModel();
    }

    public function Index()
    {
        $this->render("index.php");
    }

    public function guardar()
    {
        if (isset($_POST)) {
            $nombre = $_POST['nombre'];
            $email = $_POST['correo'];
            $pass = $_POST['contrasena'];
            $telefono = $_POST['telefono'];
            $direccion = $_POST['direccion'];
            $estado = 'activo';
            $datos=[
                'nombre' => $nombre,
                'correo' => $email,
                'contrasena' => $pass,
                'telefono' => $telefono,
                'direccion' => $direccion,
            ];
            if ($this->modelCliente->getCliente($email) == []) {
                if (esTelefono($telefono) == 1) {
                    try {
                        $this->modelCliente->insert($nombre, $email, $pass, $telefono, $direccion, $estado);
                        header('Location:' . PATH . 'login');
                    } catch (Exception $e) {
                        $_SESSION["error"] = "Error al guardar el cliente";
                        $_SESSION["data"] = $datos;
                        header('Location:' . PATH . 'register');
                    }
                } else {
                    $_SESSION["error"] = "El telefono no es valido";
                    $_SESSION["data"] = $datos;
                    header('Location:' . PATH . 'register');
                }
            } else {
                $_SESSION["error"] = "El correo ya existe";
                $_SESSION["data"] = $datos;
                header('Location:' . PATH . 'register');
            }
        }
    }
}
