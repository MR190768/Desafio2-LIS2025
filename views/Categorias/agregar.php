<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'views/cabecera.php'; ?>
    <link rel="stylesheet" href="<?=BASE_URL?>css/ADMINstyles.css">
    <title>Agregar Categoria</title>

    <link rel="stylesheet" href="css/ADMINstyles.css">

</head>

<body>
    <header class="mb-5">
        <div class="row d-flex">
            <div class="col-lg-12">
                <img src="<?=BASE_URL?>img/recursos/white.png" alt="Logo de la Tienda">
            </div>
            <div class="col-lg-12">
                <a class="btn btn-editar" href="<?=PATH?>categorias">Regresar</a>
            </div>
        </div>
    </header>
    <div class="container mt-5 col-md-5">

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

        <h1 class="text-center">Agregar Categoria</h1>

        <form method="POST" action="<?=PATH?>categorias/guardar" enctype="multipart/form-data" class="mt-5">

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" value="<?php echo $data['nombre'] ?? ''; ?>" class="form-control"  required>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripcion</label>
                <input type="textarea" name="descripcion" value="<?php echo $data['descripcion'] ?? ''; ?>" class="form-control"  required>
            </div>

            <div><button type="submit" class="btn btn-success w-100 mb-5">Agregar Categoria</button></div>

        </form>
    </div>
</body>

</html>