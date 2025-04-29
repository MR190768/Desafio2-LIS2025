<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'views/cabecera.php'; ?>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/ADMINstyles.css">
    <title>Clientes</title>

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

    <h1 class="text-center mb-4">Clientes</h1>

    <div class="container mt-5 mb-5">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="row">
                <?php
                    echo '<table border="1" cellpadding="8" cellspacing="0">
                <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nombre</th>
                      <th>Correo</th>
                      <th>contraseña</th>
                      <th>Telefono</th>
                      <th>Direccion</th>
                      <th>Estado</th>
                      <th>Fehca de creacion</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                    <tbody>';
                    foreach ($clientes as $cliente) {
                    echo '<tr>';
                    echo '<td>' . $cliente['id'] . '</td>';
                    echo '<td>' . $cliente['nombre'] . '</td>';
                    echo '<td>' . $cliente['correo'] . '</td>';
                    echo '<td>' . $cliente['contrasena'] . '</td>';
                    echo '<td>' . $cliente['telefono'] . '</td>';
                    echo '<td>' . $cliente['direccion'] . '</td>';
                    if ($cliente['estado'] == 'inhabilitado') {
                        echo '<td class="text-danger">' . $cliente['estado'] . '</td>';
                    } else {
                        echo '<td>' . $cliente['estado'] . '</td>';
                    }
                    echo '<td>' . $cliente['creado_en'] . '</td>';
                    echo '<td>';
                    echo '<a href="' . PATH . 'usuarios/editar/' . $cliente['id'] . '" class="btn btn-editar">Editar</a>';
                    echo '<a href="' . PATH . 'usuarios/desactivar/' . $cliente['id'] . '" class="btn btn-danger">Desactivar</a>';
                    echo '<a href="' . PATH . 'usuarios/activar/' . $cliente['id'] . '" class="btn btn-success">Activar</a>';
                    echo '</td>';
                    echo '</tr>';
                }
                echo '</tbody>
                  </table>';


                ?>
            </div>
        </div>
    </div>
    </div>
</body>

</html>