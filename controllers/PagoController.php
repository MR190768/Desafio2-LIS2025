<?php
require_once 'Controllers.php';
require_once 'Models/ProductosModels.php';
require_once 'Models/DetalleVentaModels.php';
require_once 'Models/VentasModels.php';
require_once 'Utils/validaciones.php';
require_once 'Utils/pdfDoc.php';

class PagoController extends Contbase
{
    private $model;
    private $modelVenta;
    private $modelDetalle;
    private $pdfDoc;
    function __construct()
    {
        $this->model = new ProductosModel();
        $this->modelVenta = new VentasModel();
        $this->modelDetalle = new DetalleVentaModel();
        $this->pdfDoc = new PDFDoc();
    }

    public function pagar()
    {
        $errores = [];
        if (isset($_POST)) {
            $total = $_POST['total'];
            $tarjeta = $_POST['tipoTarjeta'];
            $nametarjeta = $_POST['nombreTarjeta'];
            $numtarjeta = $_POST['numTarjeta'];
            $fectarjeta = $_POST['fecTarjeta'];
            $cvv = $_POST['cvv'];
            $filename = time() . '.pdf';
            if (isText($nametarjeta) == 0) {
                array_push($errores, "El nombre de la tarjeta no es valido");
            }
            if (esTarjeta($numtarjeta) == 0) {
                array_push($errores, "El numero de la tarjeta no es valido");
            }
            if (esFecha($fectarjeta) == 0) {
                array_push($errores, "La fecha de la tarjeta no es valida");
            }
            if (esCVV($cvv) == 0) {
                array_push($errores, "El CVV de la tarjeta no es valido");
            }
            if (count($errores) > 0) {
                $_SESSION["errores"] = $errores;
                header('Location:' . PATH . 'productos/shopcart');
                return;
            } else {
                foreach ($_SESSION["carrito"] as $item => $datos) {
                    if ($this->checkStock($item, $datos['cantidad'])) {
                        continue;
                    } else {
                        array_push($errores, "No hay suficiente stock para el producto " . $datos['nombre']);
                        break;
                    }
                }
                if (count($errores) > 0) {
                    $_SESSION["errores"] = $errores;
                    unset($_SESSION["carrito"]);
                    header('Location:' . PATH . 'productos/shopcart');
                    return;
                }
                else{
                    try {
                        $idVenta = $this->modelVenta->Insertarventa($_SESSION["user"]["id"], $total, $tarjeta, $nametarjeta, $numtarjeta, $fectarjeta, $cvv, $filename);
                    } catch (Exception $e) {
                        array_push($errores, "Error al procesar la venta. Por favor, inténtelo de nuevo más tarde.");
                        $_SESSION["errores"] = $errores;
                        header('Location:' . PATH . 'productos/shopcart');
                        return;
                    }
                    try{
                        foreach ($_SESSION["carrito"] as $item => $datos) {
                            $subtotal = floatval($datos["precio"]) * intval($datos["cantidad"]);
                            $this->modelDetalle->InsertarDetalle($idVenta, $item, $datos['cantidad'], $datos["precio"], $subtotal);
                        }
                        $this->pdfDoc->generatePDF($filename);
                    }catch(Exception $e){
                        array_push($errores, "Error al procesar la venta. Por favor, inténtelo de nuevo más tarde.");
                        $_SESSION["errores"] = $errores;
                        header('Location:' . PATH . 'productos/shopcart');
                        return;

                    }
                    unset($_SESSION["carrito"]);
                    header('Location:' . PATH . 'productos/shopcart');

                }

            }
        }
    }

    public function checkStock($item, $order)
    {
        $stockProd = $this->model->getById($item);
        $stock = $stockProd[0]['existencias'] - $order;
        if ($stock < 0) {
            return false;
        } else {
            $this->model->actualizarStock($stock, $item);
            return true;
        }
    }
}
?>