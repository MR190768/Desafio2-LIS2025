<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'views/cabecera.php'; ?>
    <link rel="stylesheet" href="../views/css/estilo.css">
    <title>TextilExport</title>
</head>

<body>
    <?php include 'navbar.php'; 
    
    if(isset($_SESSION['errores'])){
        foreach ($_SESSION['errores'] as $error) {
            echo '<div class="alert alert-danger" role="alert">';
            echo $error;
            echo '</div>';
        }
        unset($_SESSION['errores']);
    }
    ?>

    <div class="shopCart">
        <div class="container p-3 rounded cart">
            <div class="row g-0">
                <div class="col-md-8">
                    <div class="product-details me-2">
                        <hr>
                        <h6 class="mb-0">Carrito de Compras</h6>
                        <div class="d-flex justify-content-between">
                            <span>Tienes <strong><?php if(isset($_SESSION["carrito"])){
                                echo count($_SESSION["carrito"]);
                            }else{
                                echo 0;
                            } ?></strong> items en tu carrito</span>
                            <div class="d-flex flex-row align-items-center">
                                <div class="price ms-2"><span class="me-1">price</span><i class="fa fa-angle-down"></i></div>
                            </div>
                        </div>
                        <?php 
                        $subtotal = 0;
                        $envio=0;
                        $total=0;
                        if(isset($_SESSION['carrito'])){
                            $envio=8;
                            foreach ($_SESSION['carrito'] as $item => $datos) {
                                echo '<div class="d-flex justify-content-between align-items-center mt-3 p-2 items rounded">';
                                echo '<div class="d-flex flex-row"><img class="rounded" id="cartProdIMG" src="'.$datos["imagen"].'" width="40" height="40">';
                                echo '<div class="ms-2"><span class="fw-bold d-block" id="cartProdName">'.$datos["nombre"].'</span></div>';
                                echo '</div>';
                                echo '<div class="d-flex flex-row align-items-center"><span>'.$datos["cantidad"].'</span><span class="ms-5 fw-bold">$ '.$datos["precio"].'</span><a href="'.PATH.'productos/extractCarrito/'.$item.'"><i class="fa fa-trash-o ms-3 text-black-50"></i></a></div>';
                                echo '</div>';
                                $subtotal += floatval($datos["precio"])*intval($datos["cantidad"]);
                            }
                            $total=floatval($subtotal)+floatval($envio);
                            

                        }else{
                            echo '<h1 style="text-align: center; ">Lo sentimos no hay productos en el carrito</h1>';
                        }

                        ?>
                    </div>
                </div>
                <!-- Info de pago -->
                <div class="col-md-4 float-end">
                    <div class="payment-info">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Detalles del pago</span>
                        </div>
                        <form action="<?=PATH?>Pago/pagar" method="post">
                        <span class="type d-block mt-3 mb-1">Tipo de tarjeta</span>
                        <div class="container">
                            <div class="row">
                                <div class="col-6"><label class="form-check me-2"><input type="radio" class="form-check-input" name="tipoTarjeta" value="mastercard" checked><span><img width="30" src="https://img.icons8.com/color/48/000000/mastercard.png" /></span></label></div>
                                <div class="col-6"><label class="form-check me-2"><input type="radio" class="form-check-input" name="tipoTarjeta" value="visa"><span><img width="30" src="https://img.icons8.com/officel/48/000000/visa.png" /></span></label></div>

                            </div>

                        </div>




                        <div><label class="form-label">Nombre en la tarjeta</label><input type="text" class="form-control" placeholder="Name" name="nombreTarjeta" require></div>
                        <div><label class="form-label">Numero de la tarjeta</label><input type="text" class="form-control" placeholder="0000-0000-0000-0000" name="numTarjeta" pattern="\d{4}-\d{4}-\d{4}-\d{4}" title="Ejemplo: 0000-0000-0000-0000" require></div>
                        <div class="row">
                            <div class="col-md-6"><label class="form-label">Fehca</label><input type="text" class="form-control" placeholder="12/24" name="fecTarjeta" pattern="(0[1-9]|1[0-2])\/\d{2}" title="Ejemplo: 04/25" require></div>
                            <div class="col-md-6"><label class="form-label">CVV</label><input type="text" class="form-control" placeholder="342" name="cvv" require></div>
                        </div>
                        <hr class="line">
                        <div class="d-flex justify-content-between"><span>Subtotal</span><span>$ <?=$subtotal?></span></div>
                        <div class="d-flex justify-content-between"><span>Envio</span><span>$ <?=$envio?></span></div>
                        <div class="d-flex justify-content-between"><span>Total (+IVA)</span> <span><?='$ '.$total?></span></div>
                        
                            <input type="hidden" name="total" value="<?=$total?>">
                            <input type="hidden" name="productos" value="<?php isset($_SESSION['carrito'])? json_encode($_SESSION['carrito']):""; ?>">
                            <button class="btn btn-dark w-100 d-flex justify-content-between " type="submit" style="background-color:rgb(27, 11, 46) !important;">
                            <span class="text-center flex-grow-1">Pagar<i class="fa fa-long-arrow-right ms-1"></i></span>
                        </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>

</body>
<?php include("footer.php"); ?>

</html>