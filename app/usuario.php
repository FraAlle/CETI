<?php
session_start();
if (!isset($_SESSION["usuario"]) || $_SESSION["rol"] != "usuario") {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Área de Usuario</title>
<style>
/* Estilos generales */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background: #f4f4f4;
    transition: background 0.5s ease-in-out, color 0.5s ease-in-out;
    position: relative;
}

/* Barra de navegación usuarios */
.user-nav {
    background: linear-gradient(135deg, #1b4332, #2d6a4f, #40916c);
    padding: 15px;
    text-align: center;
    position: fixed;
    width: 100%;
    top: 0;
    left: 0;
    z-index: 1000;
}

.user-nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
}

.user-nav ul li {
    display: inline-block;
    margin: 0 15px;
}

.user-nav ul li a {
    text-decoration: none;
    color: white;
    font-weight: bold;
    font-size: 18px;
    transition: color 0.3s ease;
}

.user-nav ul li a:hover {
    color: #ffeb3b;
}

/* Contenido principal */
.container {
    text-align: center;
    margin-top: 80px;
    padding: 20px;
}

h1 {
    color: #333;
}

p {
    font-size: 18px;
    color: #555;
}

/* Estilo de botones */
.button {
    background-color: #16a085;
    color: white;
    font-size: 18px;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    text-decoration: none;
    margin-top: 20px;
    display: inline-block;
    transition: background-color 0.3s ease;
}

.button:hover {
    background-color: #1abc9c;
}

/* Ajustes en la barra cuando es mobile */
@media screen and (max-width: 768px) {
    .user-nav ul li {
        display: block;
        margin: 10px 0;
    }
}
</style>
</head>
<body>

<!-- Barra de navegación para usuarios -->
<nav class="user-nav">
<ul>
<li><a href="index.php">Inicio</a></li>
<li><a href="perfil.php">Mi Perfil</a></li>
<li><a href="mensajes.php">Mensajes</a></li>
<li><a href="ajustes.php">Ajustes</a></li>
<li><a href="logout.php">Cerrar Sesión</a></li>
</ul>
</nav>

<!-- Contenido de la página de usuario -->
<div class="container">
<h1>Bienvenido, <?php echo htmlspecialchars($_SESSION["usuario"]); ?>!</h1>
<p>Esta es tu área privada. Desde aquí puedes gestionar tu perfil, ver tus mensajes y mucho más.</p>
<a href="perfil.php" class="button">Ver Perfil</a>
</div>

</body>
</html>
