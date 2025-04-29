<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'views/cabecera.php'; ?>
    <link rel="stylesheet" href="<?=BASE_URL?>css/ADMINstyles.css">
    <title>Agregar Producto</title>

    <link rel="stylesheet" href="css/ADMINstyles.css">

</head>

<body>
    <header class="mb-5">
        <div class="row d-flex">
            <div class="col-lg-12">
                <img src="<?=BASE_URL?>img/recursos/white.png" alt="Logo de la Tienda">
            </div>
            <div class="col-lg-12">
                <a class="btn btn-editar" href="<?=PATH?>productos/admin">Ver Catálogo</a>
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

        <h1 class="text-center">Agregar Producto</h1>

        <form method="POST" action="<?=PATH?>productos/guardar" enctype="multipart/form-data" class="mt-5">

            <div class="mb-3">
                <label class="form-label">Codigo</label>
                <input type="text" name="codigo" value="<?php echo $data['codigo'] ?? ''; ?>" class="form-control" placeholder="PROD0000" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" value="<?php echo $data['nombre'] ?? ''; ?>" class="form-control" placeholder="Camisa" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripcion</label>
                <textarea name="descripcion" value="<?php echo $data['descripcion'] ?? ''; ?>" class="form-control" required> </textarea>
            </div>


            <div class="mb-3">
                <label class="form-label">Imagen</label>
                <input type="file" name="imagen" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Categoría:</label>
                <select name="categoria_id" id="categoria" class="form-select">
                    <?php foreach ($categorias as $categoria) : ?>
                        <option value="<?= $categoria['id'] ?>" <?php if (isset($data['categoria']) && $data['categoria'] == $categoria['id']) echo 'selected'; ?>><?= $categoria['nombre'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Precio:</label>
                <input type="number" step="0.01" name="precio" class="form-control" placeholder="$10" required value="<?php echo $data['precio'] ?? ''; ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Existencias:</label>
                <input type="number" name="existencias" class="form-control" placeholder="1" min="0" required value="<?php echo $data['existencias'] ?? ''; ?>">
            </div>


            <div><button type="submit" class="btn btn-success w-100 mb-5">Agregar Producto</button></div>

        </form>
    </div>
</body>

</html>