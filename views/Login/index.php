<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="views/css/login.css">
</head>

<body>
    <div class="login-dark">
    <?php
    if(isset($_SESSION["error"])){
    ?>
<div class="alert alert-danger" role="alert">
  <?= $_SESSION["error"] ?>
</div>
<?php } 
unset($_SESSION["error"]);
?>
        <form method="post" action="<?= PATH ?>login/enter">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><img src="views/img/recursos/White.png" alt="Logo" style="  max-width: 100%;
    height: auto;"></div>
            <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Correo"></div>
            <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Contraseña"></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Log In</button></div>
        </form>
    </div>
</body>

</html>