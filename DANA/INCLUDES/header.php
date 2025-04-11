<style>
    /* Elimina márgenes y paddings globales */
    html, body {
        margin: 0;
        padding: 0;
        height: 100%; /* Asegura que ocupen toda la altura de la pantalla */
        overflow: hidden; /* Evita el scroll innecesario */
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        display: flex; /* Activa Flexbox */
        flex-direction: column; /* Coloca los elementos en columna */
    }

    header {
        background-color: #333;
        color: white;
        text-align: center;
        padding: 20px 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        position: fixed; /* Fija el header en la parte superior */
        top: 0;
        width: 100%; /* Asegura que ocupe todo el ancho de la pantalla */
        z-index: 1000; /* Coloca el header encima de otros elementos */
    }

    header h1 {
        margin: 0;
        font-size: 24px;
    }

    nav {
        margin-top: 10px;
        display: flex;
        gap: 15px;
    }

    nav a {
        color: white;
        text-decoration: none;
        font-size: 16px;
    }

    nav a:hover {
        text-decoration: underline;
    }

    /* Ajusta el contenido principal para que no genere scroll */
    .content {
        flex: 1; /* Hace que el contenido ocupe el espacio restante */
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
<?php
// Verifica si la sesión ya está activa antes de iniciarla
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<head>
    <meta charset="UTF-8">
    <title>DANA - Tienda</title>
    <link rel="stylesheet" href="/DANA/css/style.css">
</head>
<body>
<header>
    <h1>DANA - Tienda de Voluntariado</h1>
    <nav>
        <a href="/DANA/index.php">Inicio</a>
        <a href="/DANA/quienes_somos.php">Quiénes Somos</a>
        <a href="/DANA/contacto.php">Contacto</a>
        <a href="/DANA/login.php">Login</a>
    </nav>
</header>
</body>