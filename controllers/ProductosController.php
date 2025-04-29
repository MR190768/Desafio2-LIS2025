<?php
require_once 'Controllers.php';
require_once 'Models/ProductosModels.php';
require_once 'Models/CategoriaModels.php';
require_once 'Utils/validaciones.php';

class ProductosController extends Contbase
{
    private $model;
    private $modelCategoria;
    function __construct()
    {
        $this->model = new ProductosModel();
        $this->modelCategoria = new CategoriaModel();
    }

    public function Index()
    {
        $viewBag = [];
        $viewBag['productos'] = $this->model->get();
        $viewBag['categorias'] = $this->modelCategoria->get();
        $this->render("index.php", $viewBag);
    }

    public function shopcart()
    {
        $this->Render("carro.php");
    }

    public function admin()
    {
        $viewBag = [];
        $viewBag['productos'] = $this->model->get();
        $viewBag['categorias'] = $this->modelCategoria->get();
        $this->render("indexAdmin.php", $viewBag);
    }

    public function agregar()
    {
        $viewBag = [];
        $viewBag['categorias'] = $this->modelCategoria->get();
        $this->render("agregar.php", $viewBag);
    }

    public function addCarrito()
    {
        if ($_POST["cantidad"] > 0) {
            $producto = [
                "nombre" => $_POST["nombre"],
                "precio" => str_replace("$", "", $_POST["precio"]),
                "imagen" => $_POST["imagen"],
                "cantidad" => $_POST["cantidad"],
            ];
            if (isset($_SESSION["carrito"][$_POST["codigo"]])) {
                $_SESSION["carrito"][$_POST["codigo"]]["cantidad"] += $_POST["cantidad"];
                header('Location:' . PATH . 'productos');
            } else {
                $_SESSION["carrito"][$_POST["codigo"]] = $producto;
                header('Location:' . PATH . 'productos');
            }
        } else {
            if (isset($_SESSION["user"])) {
                header('Location:' . PATH . 'productos');
            } else {
                header('Location:' . PATH . 'login');
            }
        }
    }

    public function extractCarrito($producto)
    {
        if (isset($_SESSION["carrito"][$producto[0]])) {
            unset($_SESSION["carrito"][$producto[0]]);
            header('Location:' . PATH . 'productos/shopcart');
        } else {
            header('Location:' . PATH . 'productos/shopcart');
        }
    }

    public function guardar()
    {
        $errores = [];
        if (isset($_POST)) {
            $codigo = $_POST['codigo'];
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $categoria_id = $_POST['categoria_id'];
            $precio = $_POST['precio'];
            $existencias = $_POST['existencias'];
            $imagen = "";
            if (esCodigo($codigo) == 0) {
                // Verificar si el código ya existe
                $producto = $this->model->getById($codigo);
                if ($producto != null) {
                    array_push($errores, "El producto con ese código ya está registrado.");
                }
                // Validar datos
                if (!is_numeric($precio) || $precio <= 0) {
                    array_push($errores, "El precio debe ser un número positivo.");
                }
                if (!is_numeric($existencias) || $existencias < 0) {
                    array_push($errores, "Las existencias deben ser mayores o iguales a 0.");
                }

                //Si hay errores, volver a agregar.php con los datos
                if (!empty($errores)) {
                    $_SESSION['data'] = [
                        'codigo' => $codigo,
                        'nombre' => $nombre,
                        'descripcion' => $descripcion,
                        'categoria' => $categoria_id,
                        'precio' => $precio,
                        'existencias' => $existencias
                    ];
                    $_SESSION['errores'] = $errores;
                    header('Location:' . PATH . 'productos/agregar');
                    return;                
                }
                // Manejo de imagen
                $permitidos = ['image/jpeg', 'image/png'];

                if (!empty($_FILES['imagen']['name'])) {
                    if (!in_array($_FILES['imagen']['type'], $permitidos)) {
                        array_push($errores, "Solo se permiten imágenes JPG o PNG.");
                        $_SESSION['errores'] = $errores;
                        header('Location:' . PATH . 'productos/agregar');
                        return;
                    }
                    try{
                        $imagen_nombre = $codigo . "." . pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
                        $ruta_destino = "views/img/productos/" . $imagen_nombre;
                        move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_destino);
                    }catch(Exception $e){
                        array_push($errores, "Error al mover la imagen: " . $e->getMessage());
                        $_SESSION['errores'] = $errores;
                        header('Location:' . PATH . 'productos/agregar');
                        return;
                    }

                    $imagen = $imagen_nombre;
                    try {
                        $this->model->Insertar($codigo, $nombre, $descripcion, $imagen, $categoria_id, $precio, $existencias);
                        header('Location:' . PATH . 'productos/admin');
                    } catch (Exception $e) {
                        array_push($errores, "Error al insertar el producto: ");
                        $_SESSION['errores'] = $errores;
                        header('Location:' . PATH . 'productos/agregar');
                    }
                }
            }
            else {
                array_push($errores, "El código no es válido.");
                $_SESSION['errores'] = $errores;
                header('Location:' . PATH . 'productos/agregar');
            }
        }
    }

    public function editar($id)
    {
        $viewBag = [];
        $viewBag['producto_encontrado'] = $this->model->getById($id[0]);
        $viewBag['categorias'] = $this->modelCategoria->get();
        $this->render("editar.php", $viewBag);
    }

    public function actualizar(){
        $errores = [];
        if (isset($_POST)) {
            $codigo = $_POST['codigo'];
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $categoria_id = $_POST['categoria_id'];
            $precio = $_POST['precio'];
            $existencias = $_POST['existencias'];
            $imagen = "";

                // Validar datos
                if (!is_numeric($precio) || $precio <= 0) {
                    array_push($errores, "El precio debe ser un número positivo.");
                }
                if (!is_numeric($existencias) || $existencias < 0) {
                    array_push($errores, "Las existencias deben ser mayores o iguales a 0.");
                }

                //Si hay errores, volver a agregar.php con los datos
                if (!empty($errores)) {
                    $_SESSION['data'] = [
                        'codigo' => $codigo,
                        'nombre' => $nombre,
                        'descripcion' => $descripcion,
                        'categoria' => $categoria_id,
                        'precio' => $precio,
                        'existencias' => $existencias
                    ];
                    $_SESSION['errores'] = $errores;
                    header('Location:' . PATH . 'productos/agregar');
                    return;                
                }
                // Manejo de imagen
                $permitidos = ['image/jpeg', 'image/png'];

                if (!empty($_FILES['imagen']['name'])) {
                    if (!in_array($_FILES['imagen']['type'], $permitidos)) {
                        array_push($errores, "Solo se permiten imágenes JPG o PNG.");
                        $_SESSION['errores'] = $errores;
                        header('Location:' . PATH . 'productos/agregar');
                        return;
                    }
                    try{
                        $imagen_nombre = $codigo . "." . pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
                        $ruta_destino = "views/img/productos/" . $imagen_nombre;
                        unlink($ruta_destino); // Eliminar la imagen anterior
                        move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_destino);
                    }catch(Exception $e){
                        array_push($errores, "Error al mover la imagen: " . $e->getMessage());
                        $_SESSION['errores'] = $errores;
                        header('Location:' . PATH . 'productos/agregar');
                        return;
                    }

                    $imagen = $imagen_nombre;

                }else {
                    $imagen = $this->model->getById($codigo)[0]['imagen'];
                }
                try {
                    $this->model->actualizar($codigo, $nombre, $descripcion, $imagen, $categoria_id, $precio, $existencias);
                    header('Location:' . PATH . 'productos/admin');
                } catch (Exception $e) {
                    array_push($errores, "Error al actualizar el producto: ");
                    $_SESSION['errores'] = $errores;
                    header('Location:' . PATH . 'productos/agregar');
                }
        }
    }

    public function eliminar($id)
    {
        $this->model->eliminar($id[0]);
        header('Location:' . PATH . 'productos/admin');
    }
}
