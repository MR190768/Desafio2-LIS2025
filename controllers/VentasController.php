<?php
require_once 'models/VentasModels.php';
require_once 'models/DetalleVentaModels.php';
require_once 'Controllers.php';

class VentasController extends ContBase{
    private $model;
    private $detalleModel;

    public function __construct(){
        $this->model = new VentasModel();
        $this->detalleModel = new DetalleVentaModel();
    }

    public function Index(){
        $viewBag = [];
        $viewBag['ventas'] = $this->model->get();
        $i=0;
        foreach($viewBag['ventas'] as $venta){
            $viewBag['ventas'][$i]['detalles']=$this->detalleModel->getById($venta['id']);
            $i++;
        }
        $this->render("index.php", $viewBag);
    }
}


?>