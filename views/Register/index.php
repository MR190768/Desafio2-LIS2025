<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include 'views/cabecera.php'; ?>
  <link rel="stylesheet" href="views/css/register.css">
  <title>Registrar</title>
</head>

<body>
  <?php
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
  <div class="login-dark">
    <div class="container ">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card shadow-lg">
            <div class="card-header text-center">
              <h4>Formulario de Registro</h4>
            </div>
            <div class="card-body">
              <form method="POST" action="<?= PATH ?>register/guardar">
                <div class="mb-3">
                  <label for="nombre" class="form-label">Nombre</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $data['nombre'] ?? ''; ?>" required>
                </div>

                <div class="mb-3">
                  <label for="correo" class="form-label">Correo electrónico</label>
                  <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $data['correo'] ?? ''; ?>" required>
                </div>

                <div class="mb-3">
                  <label for="contraseña" class="form-label">Contraseña</label>
                  <input type="password" class="form-control" id="contrasena" name="contrasena" value="<?php echo $data['contrasena'] ?? ''; ?>"required>
                </div>

                <div class="mb-3">
                  <label for="telefono" class="form-label">Teléfono</label>
                  <input type="tel" class="form-control" id="telefono" name="telefono" value="<?php echo $data['telefono'] ?? ''; ?>" required>
                </div>

                <div class="mb-3">
                  <label for="direccion" class="form-label">Dirección</label>
                  <textarea class="form-control" id="direccion" name="direccion" rows="3" value="<?php echo $data['direccion'] ?? ''; ?>" required></textarea>
                </div>

                <div class="d-grid">
                  <button type="submit" class="btn btn-degradado ">Registrarse</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>