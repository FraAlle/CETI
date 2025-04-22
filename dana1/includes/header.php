<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DANA - Tienda</title>
  <?php
  // Definir la ruta base absoluta del proyecto
  $base_url = '/dana1/dana1/';
  ?>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap 5 Bundle JS (con Popper incluido) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Ruta absoluta para el archivo CSS -->
  <link rel="stylesheet" href="<?php echo $base_url; ?>css/style.css">
</head>
<body>
<header class="main-header">
    <div class="header-container container d-flex justify-content-between align-items-center py-3">
      <h1 class="site-title m-0">PUEBLO <span class="highlight">UNIDO</span></h1>
      <nav class="main-nav d-flex gap-3">
          <!-- Rutas absolutas para los enlaces -->
          <a href="<?php echo $base_url; ?>index.php" class="nav-link">Inicio</a>
          <a href="<?php echo $base_url; ?>quienes_somos.php" class="nav-link">Quiénes Somos</a>
          <a href="<?php echo $base_url; ?>contacto.php" class="nav-link">Contacto</a>
          <a href="<?php echo $base_url; ?>login.php" class="nav-link">Login</a>
          <a href="<?php echo $base_url; ?>registro.php" class="nav-link">Registro</a>
      </nav>
    </div>
</header>
