<?php

$host = 'localhost';
$user = 'root';
$password = ''; // Cambia esto si tienes una contraseña configurada
$database = 'dana';
$port = 3306; // Cambia a 3306 si es el puerto predeterminado

$conexion = new mysqli($host, $user, $password, $database, $port);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>
