<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registro</title>
<style>
/* Importar Google Font */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap');

/* Estilos generales */
body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background: linear-gradient(135deg, #1b4332, #2d6a4f, #40916c);
    color: white;
}

/* Contenedor del formulario */
.container {
    text-align: center;
    width: 90%;
    max-width: 350px;
    padding: 30px;
    background: rgba(255, 255, 255, 0.1);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    border-radius: 12px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    animation: fadeIn 1.2s ease-in-out;
}

/* Animación de entrada */
@keyframes fadeIn {
    from { opacity: 0; transform: scale(0.9); }
    to { opacity: 1; transform: scale(1); }
}

/* Logo */
.logo {
    width: 100px;
    margin-bottom: 15px;
}

/* Título */
h1 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #b7e4c7;
}

/* Estilos del formulario */
form {
    display: flex;
    flex-direction: column;
    gap: 15px; /* Mayor espaciado entre elementos */
}

label {
    font-weight: bold;
    text-align: left;
    display: block;
}

input {
    width: 100%;
    padding: 10px;
    border: 1px solid #b7e4c7;
    border-radius: 5px;
    outline: none;
    transition: all 0.3s ease-in-out;
    box-sizing: border-box; /* Asegura que el padding no afecte al ancho total */
}

input:focus {
    border-color: #52b788;
    box-shadow: 0px 0px 10px rgba(82, 183, 136, 0.5);
}

input[type="submit"] {
    background-color: #52b788;
    color: white;
    font-size: 16px;
    border: none;
    cursor: pointer;
    transition: background 0.3s ease-in-out;
    padding: 12px;
    border-radius: 6px;
    margin-top: 10px;
}

input[type="submit"]:hover {
    background-color: #74c69d;
}

/* Separación entre botones */
.extra-options {
    margin-top: 20px; /* Mayor separación */
}

/* Enlace de login */
a {
    color: #b7e4c7;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s;
}

a:hover {
    text-decoration: underline;
    color: #74c69d;
}

</style>
</head>
<body>
<div class="container">
<!-- Logotipo -->
<img src="logo.png" alt="Logo" class="logo">

<h1>Registro de Usuario</h1>
<form id="registroForm" action="procesar_registro.php" method="POST">
<label for="nombre">Nombre:</label>
<input type="text" id="nombre" name="nombre" required>

<label for="apellido">Apellido:</label>
<input type="text" id="apellido" name="apellido" required>

<label for="email">Correo Electrónico:</label>
<input type="email" id="email" name="email" required>

<label for="password">Contraseña:</label>
<input type="password" id="password" name="password" required minlength="6">

<input type="submit" value="Registrarse">
</form>

<!-- Separación extra para el enlace de login -->
<div class="extra-options">
<p>¿Ya tienes una cuenta?</p>
<a href="login.php">Inicia sesión aquí</a>
</div>
</div>
</body>
</html>
