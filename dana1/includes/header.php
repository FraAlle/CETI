<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DANA - Tienda</title>
  <?php
  // Definir la ruta base absoluta del proyecto
  $base_url = '/dana1/dana1/';
  if (session_status() === PHP_SESSION_NONE) {
      session_start();
  }
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
          <?php if (isset($_SESSION['usuario'])): ?>
              <!-- Opciones para clientes -->
              <?php if (isset($_SESSION['usuario']['rol']) && $_SESSION['usuario']['rol'] === 'cliente'): ?>
                  <a href="<?php echo $base_url; ?>productos/index.php" class="nav-link">Productos</a>
                  <a href="<?php echo $base_url; ?>carrito/index.php" class="nav-link">Carrito</a>
              <?php endif; ?>

              <!-- Opciones para voluntarios -->
              <?php if (isset($_SESSION['usuario']['rol']) && $_SESSION['usuario']['rol'] === 'voluntario'): ?>
                  <a href="<?php echo $base_url; ?>productos/index.php" class="nav-link">Gestionar Productos</a>
              <?php endif; ?>

              <!-- Opción de perfil para todos los usuarios logueados -->
              <a href="<?php echo $base_url; ?>usuarios/perfil.php" class="nav-link">Perfil</a>
              <a href="<?php echo $base_url; ?>logout.php" class="nav-link text-danger">Cerrar Sesión</a>
          <?php else: ?>
              <!-- Opciones para usuarios no logueados -->
              <a href="<?php echo $base_url; ?>login.php" class="nav-link">Login</a>
              <a href="<?php echo $base_url; ?>registro.php" class="nav-link">Registro</a>
          <?php endif; ?>
      </nav>
    </div>
</header>
