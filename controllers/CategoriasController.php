<?php
require_once 'Controllers.php';
require_once 'models/CategoriaModels.php';

class CategoriasController extends ContBase
{
    private $model;
    public function __construct()
    {
        $this->model = new CategoriaModel();
    }

    public function Index()
    {
        $viewBag = [];
        $viewBag['categorias'] = $this->model->get();
        $this->render("index.php", $viewBag);
    }

    public function agregar()
    {
        $this->render("agregar.php");
    }

    public function guardar()
    {
        if(isset($_POST)){
            $nombre = $_POST["nombre"];
            $descripcion = $_POST["descripcion"];
            try{
                $this->model->insert($nombre, $descripcion);
                header('Location:' . PATH . 'categorias');
            }catch(Exception $e){
                $_SESSION["error"] = "Error al guardar la categoria";
                header('Location:' . PATH . 'categorias/agregar');
            }
        }

    }
    public function editar($id)
    {
        $viewBag = [];
        $viewBag['categoria'] = $this->model->getById($id[0]);
        $this->render("editar.php", $viewBag);
    }

    public function actualizar()
    {
        if(isset($_POST)){
            $id = $_POST["id"];
            $nombre = $_POST["nombre"];
            $descripcion = $_POST["descripcion"];
            try{
                $this->model->update($id, $nombre, $descripcion);
                header('Location:' . PATH . 'categorias');
            }catch(Exception $e){
                $_SESSION["error"] = "Error al actualizar la categoria";
                header('Location:' . PATH . 'categorias/editar/'.$id);
            }
        }
    }
 

    public function eliminar($id)
    {
        $this->model->delete($id[0]);
        header('Location:' . PATH . 'categorias');
    }
}

?>