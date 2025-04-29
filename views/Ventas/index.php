<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'views/cabecera.php'; ?>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/ADMINstyles.css">
    <title>Ventas</title>

</head>
<?php
if (empty($_SESSION["user"])) {
    header('Location:' . PATH . 'productos');;
    exit();
}

?>

<body>
    <header>
        <div class="overlay">
            <div class="row d-flex">
                <div class="col-lg-12">
                    <img src="<?= BASE_URL ?>img/recursos/white.png" alt="Logo de la Tienda">
                </div>
                <div class="col-lg-12">
                    <a class="btn btn-editar" href="<?= PATH ?>productos/admin">Regresar</a>
                    <a class="btn btn-danger" href="<?= PATH ?>login/exit">Cerrar Session</a>
                </div>
            </div>
        </div>
    </header>

    <h1 class="text-center mb-4">Ventas</h1>

    <div class="container mt-5 mb-5">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="row">

<table class="table table-bordered">
<thead>
  <tr>
    <th>ID Venta</th>
    <th>Cliente_id</th>
    <th>Fecha</th>
    <th>Total</th>
    <th>Tarjeta</th>
    <th>Nombre Tarjeta</th>
    <th>No.Tarjeta</th>
    <th>Fecha Vencimiento</th>
    <th>cvv</th>
    <th>Recibo</th>
    <th>Detalles</th>
  </tr>
</thead>
<tbody>
<?php

foreach ($ventas as $venta) {
  echo '<tr>';
  echo '<td>'.$venta['id'].'</td>';
  echo '<td>'.$venta['cliente_id'].'</td>';
  echo '<td>'.$venta['fecha'].'</td>';
  echo '<td>'.$venta['total'].'</td>';
  echo '<td>'.$venta['tarjeta'].'</td>';
  echo '<td>'.$venta['nameTarjeta'].'</td>';
  echo '<td>'.$venta['numTarjeta'].'</td>';
  echo '<td>'.$venta['fecTarjeta'].'</td>';
  echo '<td>'.$venta['cvv'].'</td>';
  echo '<td><a href="'.PATH.'ViewDoc/verRecibo/'.$venta['pdf_comprobante'].'">'.$venta['pdf_comprobante'].'</a></td>';
  echo '<td>';
  echo '<button class="btn btn-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#venta'.$venta['id'].'" aria-expanded="false" aria-controls="venta'.$venta['id'].'">';
  echo 'Ver Detalles';
  echo '</button>';
  echo '</td>';
  echo '</tr>';

  echo '<tr class="collapse" id="venta'.$venta['id'].'">';
  echo '<td colspan="11">';
  
  //mini acordeón
  echo '<div class="accordion" id="accordionVenta'.$venta['id'].'">';
  echo '  <div class="accordion-item">';
  echo '    <h2 class="accordion-header" id="heading'.$venta['id'].'">';
  echo '      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse'.$venta['id'].'" aria-expanded="true" aria-controls="collapse'.$venta['id'].'">';
  echo '        Productos de la venta';
  echo '      </button>';
  echo '    </h2>';
  echo '    <div id="collapse'.$venta['id'].'" class="accordion-collapse collapse show" aria-labelledby="heading'.$venta['id'].'" data-bs-parent="#accordionVenta'.$venta['id'].'">';
  echo '      <div class="accordion-body">';
  echo '        <ul>';
  foreach ($venta['detalles'] as $producto) {
      echo '<li><strong>'.$producto['producto_id'].'</strong> - Cantidad: '.$producto['cantidad'].' -Precio unitario: '.$producto['precio_unitario'].' -Subtotal: '.$producto['subtotal'].'</li>';
  }
  echo '        </ul>';
  echo '      </div>';
  echo '    </div>';
  echo '  </div>';
  echo '</div>';

  echo '</td>';
  echo '</tr>';
}
?>
</tbody>
</table>
                ?>
            </div>
        </div>
    </div>
    </div>
</body>

</html>