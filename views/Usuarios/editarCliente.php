<?php

if (empty($_SESSION["user"])) {
    header('Location:' . PATH . 'productos');;
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <?php include 'views/cabecera.php'; ?>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/ADMINstyles.css">
</head>

<body>
<?php

if (empty($_SESSION["user"])) {
    header('Location:' . PATH . 'productos');;
    exit();
}

$errores = $_SESSION['errores'] ?? [];
$data = $_SESSION['data'] ?? [];

unset($_SESSION['data']);
unset($_SESSION['errores']);

if (!empty($errores)) {
    echo "<div class='alert alert-danger'>";

    foreach ($errores as $error) {
        echo $error;
    }
    echo "</div>";
}

?>
<header class="mb-5">
        <div class="row d-flex">
            <div class="col-lg-12">
                <img src="<?=BASE_URL?>img/recursos/white.png" alt="Logo de la Tienda">
            </div>
            <div class="col-lg-12">
                <a class="btn btn-editar" href="<?=PATH?>Usuarios">Regresar</a>
            </div>
        </div>
    </header>
    <h1 class="text-center">Editar</h1>
    <div class="container">

        <form method="POST" action="<?= PATH ?>usuarios/clienteActualizar" enctype="multipart/form-data" class="mt-5">

            <input type="hidden" name="id"  class="form-control" value="<?php echo $cliente[0]["id"]; ?>">

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre"  class="form-control" value="<?php echo $cliente[0]["nombre"]; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Correo</label>
                <input type="email" name="correo"  class="form-control" value="<?php echo $cliente[0]["correo"]; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="text" name="contrasena"  class="form-control" value="<?php echo $cliente[0]["contrasena"]; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Telefono</label>
                <input type="text" name="telefono"  class="form-control" value="<?php echo $cliente[0]["telefono"]; ?>" required>
            </div>


            <div class="mb-3">
                <label class="form-label">Direccion</label>
                <input type="textarea" name="direccion"  class="form-control" value="<?php echo $cliente[0]["direccion"]; ?>" required>
            </div>

            <div><button type="submit" class="btn btn-success w-100 mb-5">Editar</button></div>

        </form>
    </div>
</body>

</html>