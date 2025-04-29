<?php

if(empty($_SESSION["user"])){
    header('Location:' . PATH . 'productos');;
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <?php include 'views/cabecera.php'; ?>
    <link rel="stylesheet" href="<?=BASE_URL?>css/ADMINstyles.css">
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
    <h1 class="text-center">Editar Producto</h1>
    <div class="container">

        <form method="POST" action="<?=PATH?>productos/actualizar" enctype="multipart/form-data" class="mt-4">
            <input type="hidden" name="codigo" value="<?php echo $producto_encontrado[0]["codigo"]; ?>">

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" required value="<?php echo $producto_encontrado[0]["nombre"]; ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <input type="text" name="descripcion" class="form-control" required value="<?php echo $producto_encontrado[0]["descripcion"]; ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Categoría</label>
                <select name="categoria_id" class="form-select">
                <?php foreach ($categorias as $categoria) : ?>
                        <option value="<?= $categoria['id'] ?>" <?php if (isset($producto_encontrado[0]["categoria_id"]) && $producto_encontrado[0]["categoria_id"] == $categoria['id']) echo 'selected'; ?>><?= $categoria['nombre'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Precio</label>
                <input type="number" step="0.01" name="precio" class="form-control" required value="<?php echo $producto_encontrado[0]["precio"]; ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Existencias</label>
                <input type="number" name="existencias" class="form-control" required value="<?php echo $producto_encontrado[0]["existencias"]; ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Imagen actual</label><br>
                <img src= "<?=BASE_URL?>img/productos/<?= $producto_encontrado[0]["imagen"]; ?>" width="150">
            </div>

            <div class="mb-3">
                <label class="form-label">Subir nueva imagen (opcional)</label>
                <input type="file" name="imagen" class="form-control">
            </div>

            <button type="submit" class="btn btn-success w-100">Guardar Cambios</button>
        </form>
    </div>
</body>

</html>