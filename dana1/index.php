<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pueblos Unidos</title>
  <link rel="manifest" href="manifest.json">
  <meta name="theme-color" content="#007bff">
  <script>
    if ('serviceWorker' in navigator) {
      navigator.serviceWorker.register('service-worker.js')
        .then(registration => {
          console.log('Service Worker registrado con éxito:', registration);
        })
        .catch(error => {
          console.error('Error al registrar el Service Worker:', error);
        });
    }
  </script>
</head>
<body>
  <?php include 'includes/header.php'; ?>

  <div id="carruselInicio" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">

          <!-- Slide 1 -->
          <div class="carousel-item active">
              <img src="css/Foto1.jpg" class="d-block w-100" alt="<?php echo htmlspecialchars('Primera imagen', ENT_QUOTES, 'UTF-8'); ?>">
              <div class="carousel-caption d-flex flex-column justify-content-center align-items-center h-100">
                  <h2 class="display-4 fw-bold text-shadow"><?php echo htmlspecialchars('Bienvenido a Pueblos Unidos', ENT_QUOTES, 'UTF-8'); ?></h2>
                  <p class="lead text-shadow"><?php echo htmlspecialchars('El pueblo ayuda al pueblo', ENT_QUOTES, 'UTF-8'); ?></p>
                  <a href="login.php" class="btn btn-light btn-lg mt-3">Iniciar Sesión</a>
              </div>
          </div>

          <!-- Slide 2 -->
          <div class="carousel-item">
              <img src="css/Foto1.jpg" class="d-block w-100" alt="<?php echo htmlspecialchars('Segunda imagen', ENT_QUOTES, 'UTF-8'); ?>">
              <div class="carousel-caption d-flex flex-column justify-content-center align-items-center h-100">
                  <h2 class="display-4 fw-bold text-shadow"><?php echo htmlspecialchars('Accede a Pueblos Unidos', ENT_QUOTES, 'UTF-8'); ?></h2>
                  <p class="lead text-shadow"><?php echo htmlspecialchars('Regístrate y forma parte de la familia', ENT_QUOTES, 'UTF-8'); ?></p>
                  <a href="registro.php" class="btn btn-light btn-lg mt-3">Registrarse</a>
              </div>
          </div>

      </div>

      <!-- Controles -->
      <button class="carousel-control-prev" type="button" data-bs-target="#carruselInicio" data-bs-slide="prev">
          <span class="carousel-control-prev-icon"></span>
          <span class="visually-hidden"><?php echo htmlspecialchars('Anterior', ENT_QUOTES, 'UTF-8'); ?></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carruselInicio" data-bs-slide="next">
          <span class="carousel-control-next-icon"></span>
          <span class="visually-hidden"><?php echo htmlspecialchars('Siguiente', ENT_QUOTES, 'UTF-8'); ?></span>
      </button>
  </div>

  <?php include 'includes/footer.php'; ?>
</body>
</html>