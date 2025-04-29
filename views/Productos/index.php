<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'views/cabecera.php'; ?>
    <link rel="stylesheet" href="<?=BASE_URL?>css/estilo.css">
    <link rel="stylesheet"  href="<?=BASE_URL?>css/estiloModal.css">
    <title>TextilExport</title>
</head>

<body>
    <script>
        AOS.init();
    </script>
    <?php
    if (isset($_SESSION["user"])) {
        include("hederlogin.php");
    } else {
        include("headerlogout.php");
    }
    ?>

    <div class="container">
        <h2 data-aos="fade-up">Elige la categoria que mas te atraiga de nuestro catalogo.</h2>

        <div data-aos="fade-right" class="multi-button">
        <button id="allprod">Todos los productos</button>
            <?php
            foreach ($categorias as $categoria) {
                echo '<button class="btnCat" id="' . $categoria["id"] . '">' . $categoria["nombre"] . '</button>';
            }
            
            
            ?>
        </div>
        <div class="row">
            <div class="col-5 offset-4 p-5" style="display:none;" id="loader">
                <div class="spinner-border" style="width: 300px; height: 300px; color:white;" role="status">
                    <span class="sr-only"></span>
                </div>
            </div>

            <?php
            $ubicacion = BASE_URL."img/productos/";
            $end='';
            if (empty($productos)) {
                echo '<h1 style="text-align: center; color: #FFF;">Lo sentimos no hay productos todavia</h1>';
            } else {
                foreach ($productos as $producto) {
                    if($producto["categoria"]==null){
                        $categoria = "Sin Categoria";
                    }
                    else{
                        $categoria = $producto["categoria"];
                    }
                    echo '<div class="col-4 p-3" categoria="' . $producto["categoria"] . '">';
                    echo '<a data-bs-toggle="modal" data-bs-target="#modalP" class="Amodal">';
                    echo '<label hidden>' . $producto["codigo"] . '</label>';
                    echo '<label hidden>' . $producto["descripcion"] . '</label>';
                    echo '<label hidden>' . $ubicacion . $producto["imagen"] . '</label>';
                    echo '<label hidden>' . $categoria . '</label>';
                    echo '<label hidden>' . $producto["existencias"] . '</label>';
                    echo ' <div class="containerC" style="background: url(\'' .  $ubicacion . $producto["imagen"] . '\'); background-size: 100% 100%;">';
                    if ($producto["existencias"]==0){
                        echo '  <div class="containerC" style="background: url(\'' . $ubicacion .'AGOTADO.PNG'. '\'); background-size: 100% 100%; opacity: 0.5;" >';
                        $end='</div>';
                    }
                    echo '    <div class="overlayC">';
                    echo '      <div class="items"></div>';
                    echo '      <div class="items head">';
                    echo '        <p id="name">' . $producto["nombre"] . '</p>';
                    echo '        <hr>';
                    echo '      </div>';
                    echo '      <div class="items price">';
                    echo '        <p class="new" id="price">$' . $producto["precio"] . '</p>';
                    echo '      </div>';
                    echo '      <div class="items cartProd">';
                    echo '        <i class="bi bi-info-circle-fill"></i>';
                    echo '        <span>MAS INFORMACION</span>';
                    echo '      </div>';
                    echo '    </div>';
                    echo '  </div>';
                    echo $end;
                    echo ' </a>';
                    echo '</div>';
                }
            }


            ?>
        </div>
    </div>

    <?php
    include("modalProducto.php");
    ?>
</body>
<?php include("footer.php"); ?>
<script src="views/js/modalLoadData.js"></script>
<script src="views/js/mostrarCategorias.js"></script>

</html>