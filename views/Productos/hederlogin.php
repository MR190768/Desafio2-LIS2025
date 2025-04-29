<?php  include 'navbar.php';?>

<div id="masthead">

    <div class="container">
        <br>
        <div class="row">
            <div class="col-md-7">
                <h1>Bienvenido <?= $_SESSION["user"]["nombre"]; ?></h1>
                <p class="lead">Los mejores productos siempre a precios bajos</p>
            </div>
            <div class="col-md-5">
                <div class="well well-lg">
                    <div class="row">
                        <div class="col-sm-6">
                            <img src="views/img/recursos/headerBack.jpg" class="img-fluid">
                        </div>
                        <div class="col-sm-6">
                            <strong>Recuerda</strong>
                            <p>Revisar siempre los promocionales para ver las ofertas</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>