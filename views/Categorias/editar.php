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
    <title>Editar Categoria</title>
    <?php include 'views/cabecera.php'; ?>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/ADMINstyles.css">
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
    <h1 class="text-center">Editar Categoria</h1>
    <div class="container">

        <form method="POST" action="<?= PATH ?>categorias/actualizar" enctype="multipart/form-data" class="mt-5">

            <input type="hidden" name="id"  class="form-control" value="<?php echo $categoria[0]["id"]; ?>">

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre"  class="form-control" value="<?php echo $categoria[0]["nombre"]; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripcion</label>
                <input type="textarea" name="descripcion"  class="form-control" value="<?php echo $categoria[0]["descripcion"]; ?>" required>
            </div>

            <div><button type="submit" class="btn btn-success w-100 mb-5">Agregar Categoria</button></div>

        </form>
    </div>
</body>

</html>