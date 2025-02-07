<?php
session_start();  // Aseguramos que la sesión esté disponible

// Verificar si el usuario está logueado
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Si no está logueado, redirigir a la página de login
    header('Location: login.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Página Protegida</title>
</head>
<body>
  <h2>Bienvenido, <?php echo $_SESSION['email']; ?></h2>
  <p>Esta es una página protegida solo para usuarios logueados.</p>
  <a href="logout.php">Cerrar sesión</a>
</body>
</html>
