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
    <title>Añadir User</title>
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
                <a class="btn btn-editar" href="<?=PATH?>Usuarios/userAdmin">Regresar</a>
            </div>
        </div>
    </header>
    <h1 class="text-center">Añadir</h1>
    <div class="container">

        <form method="POST" action="<?= PATH ?>usuarios/guardarAdmin" enctype="multipart/form-data" class="mt-5">

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre"  class="form-control" value="<?php echo $data['nombre'] ?? ''; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Correo</label>
                <input type="email" name="correo"  class="form-control" vvalue="<?php echo $data['correo'] ?? ''; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="text" name="contrasena"  class="form-control" value="<?php echo $data['contraseña'] ?? ''; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Rol:</label>
                <select name="rol" id="categoria" class="form-select">
                        <option value="admin" <?php if (isset($data['rol']) && $data['rol'] == 'admin') echo 'selected'; ?>>Admin</option>
                        <option value="empleado" <?php if (isset($data['rol']) && $data['rol'] == 'empleado') echo 'selected'; ?>>Empleado</option>
                </select>
            </div>

            <div><button type="submit" class="btn btn-success w-100 mb-5">Añadir</button></div>

        </form>
    </div>
</body>

</html>