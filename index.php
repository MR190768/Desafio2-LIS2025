<?php
require_once 'controllers/IndexController.php';
require_once 'controllers/ProductosController.php';
require_once 'controllers/LoginController.php';
require_once 'controllers/PagoController.php';
require_once 'controllers/CategoriasController.php';
require_once 'controllers/VentasController.php';
require_once 'controllers/ViewDocController.php';
require_once 'controllers/UsuariosController.php';
require_once 'controllers/RegisterController.php';
require_once 'vendor/autoload.php';

session_start();
const PATH='http://localhost/desafio2/'; //se agrega la ruta de la carpeta del proyecto
define('BASE_URL', '/desafio2/views/');
$url=$_SERVER['REQUEST_URI'];
$slice=explode('/',$url);
$index=0;
for ($i=0;$i<count($slice);$i++) {
    if($slice[$i]=='desafio2') {
        $index=$i;
        break;
    }
}
$controller=empty($slice[$i+1])?"IndexController":$slice[$i+1]."Controller";
$method=empty($slice[$i+2])?"Index":$slice[$i+2];
$params=empty($slice[$i+3])?[]:array_slice($slice,$i+3);

$cont=new $controller();
$cont->$method($params);


?>