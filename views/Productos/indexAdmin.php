<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'views/cabecera.php'; ?>
    <link rel="stylesheet" href="<?=BASE_URL?>css/ADMINstyles.css">
    <script src="<?=BASE_URL?>js/filtrarCategoria.js"></script>
    <title>Catálogo de Productos</title>
    
    <style>
        .card img {
            object-fit: cover;
            height: 300px;
        }
    </style>

</head>
<?php
if(empty($_SESSION["user"])){
    header('Location:' . PATH . 'productos');;
    exit();
}

?>
<body>
    <header>
        <div class="overlay">
            <div class="row d-flex">
                <div class="col-lg-12">
                    <img src="<?=BASE_URL?>img/recursos/white.png" alt="Logo de la Tienda">
                </div>
                <div class="col-lg-12">
                <?php
                if($_SESSION["user"]["rol"]=="admin"){
                    ?>
                <a class="btn btn-editar" href="<?=PATH?>Usuarios">Ver Clientes</a>
                <a class="btn btn-editar" href="<?=PATH?>Usuarios/userAdmin">Ver Usuarios</a>
                <a class="btn btn-editar" href="<?=PATH?>categorias">Administrar Categorias</a>
                <?php }?>
                <a class="btn btn-editar" href="<?=PATH?>ventas">Ver Ventas</a>
                    <a class="btn btn-editar" href="<?=PATH?>productos/agregar">Agregar Productos</a>
                    <a class="btn btn-danger" href="<?= PATH ?>login/exit">Cerrar Session</a>
                </div>
            </div>
        </div>
    </header>

    <h1 class="text-center mb-4">Catálogo de Productos</h1>

    <div class="container mt-5 mb-5">

        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-12">
                <h5>Filtrar por Categoría</h5>
                <ul class="list-group">
                    <li class="list-group-item"><a href="ADindex.php" class="text-decoration-none">Todos</a></li>
                    <?php
                    foreach ($categorias as $categoria) {
                        echo "<li class='list-group-item'><a href='ADindex.php?categoria=" . $categoria['nombre'] . "' class='text-decoration-none'>" . $categoria['nombre'] . "</a></li>";
                    }
                    ?>
                </ul>
            </div>


            <div class="col-lg-9 col-md-8 col-sm-12">
                <div class="row g-4">
                    <?php

                        foreach ($productos as $producto) {
                            if($producto["categoria"]==null){
                                $categoria = "Sin Categoria";
                            }
                            else{
                                $categoria = $producto["categoria"];
                            }

                            $ubicacion = BASE_URL."img/productos/". $producto['imagen'];
                            echo "<div class='col-lg-4 col-md-6 col-sm-12'>";
                            echo "<div class='card'>";
                            echo "<img class='card-img-top' src='$ubicacion' alt='Imagen del producto'>";
                            echo "<div class='card-body'>";
                            echo "<h5 class='card-title'>" . $producto['nombre'] . "</h5>";
                            echo "<p class='card-text'><strong>" . $categoria . "</strong></p>";
                            echo "<p class='card-text'>" . $producto['descripcion'] . "</p>";
                            echo "<p class='card-text'><strong>Precio:</strong> $" . $producto['precio'] . "</p>";
                            echo "<p class='card-text'><strong>Existencias:</strong> " . $producto['existencias'] . "</p>";
                            echo "<p class='card-text'><strong>Codigo:</strong> " . $producto['codigo'] . "</p>";

                            //botones editar y eliminar
                            echo "<a href='" . PATH . "productos/editar/" . $producto['codigo'] . "' class='btn btn-editar btn-sm'>Editar</a>";
                            echo "<a href='" . PATH . "productos/eliminar/" . $producto['codigo'] .  "' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Seguro que quieres eliminar este producto?\");'>Eliminar</a>";


                            echo "</div></div></div>";
                        }
                    
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>