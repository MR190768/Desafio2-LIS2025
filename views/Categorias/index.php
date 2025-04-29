<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'views/cabecera.php'; ?>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/ADMINstyles.css">
    <title>Catálogo de Productos</title>

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
                    <a class="btn btn-editar" href="<?= PATH ?>categorias/agregar">Agregar Categoria</a>
                    <a class="btn btn-danger" href="<?= PATH ?>login/exit">Cerrar Session</a>
                </div>
            </div>
        </div>
    </header>

    <h1 class="text-center mb-4">Categorias</h1>

    <div class="container mt-5 mb-5">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="row">
                <?php
                    echo '<table border="1" cellpadding="8" cellspacing="0">
                <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nombre</th>
                      <th>Descripción</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                    <tbody>';
                    foreach ($categorias as $categoria) {
                    echo '<tr>';
                    echo '<td>' . $categoria['id'] . '</td>';
                    echo '<td>' . $categoria['nombre'] . '</td>';
                    echo '<td>' . $categoria['descripcion'] . '</td>';
                    echo '<td>';
                    echo '<a href="' . PATH . 'categorias/editar/' . $categoria['id'] . '" class="btn btn-editar">Editar</a>';
                    echo '<a href="' . PATH . 'categorias/eliminar/' . $categoria['id'] . '" class="btn btn-danger">Eliminar</a>';
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