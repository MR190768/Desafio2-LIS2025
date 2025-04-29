<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'views/cabecera.php'; ?>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/ADMINstyles.css">
    <title>Usuarios</title>

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
                    <a class="btn btn-editar" href="<?= PATH ?>usuarios/anadirAdmin">Añadir usuarios</a>
                    <a class="btn btn-danger" href="<?= PATH ?>login/exit">Cerrar Session</a>
                </div>
            </div>
        </div>
    </header>

    <h1 class="text-center mb-4">Usuarios</h1>

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
                      <th>Rol</th>
                      <th>Fehca de creacion</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                    <tbody>';
                    foreach ($usuarios as $usuario) {
                    echo '<tr>';
                    echo '<td>' . $usuario['id'] . '</td>';
                    echo '<td>' . $usuario['nombre'] . '</td>';
                    echo '<td>' . $usuario['correo'] . '</td>';
                    echo '<td>' . $usuario['contrasena'] . '</td>';
                    echo '<td>' . $usuario['rol'] . '</td>';
                    echo '<td>' . $usuario['creado_en'] . '</td>';
                    echo '<td>';
                    echo '<a href="' . PATH . 'usuarios/actualizar/' . $usuario['id'] . '" class="btn btn-editar">Editar</a>';
                    echo '<a href="' . PATH . 'usuarios/adEliminar/' . $usuario['id'] . '" class="btn btn-danger">Eliminar</a>';
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