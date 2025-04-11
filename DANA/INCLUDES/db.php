<?php
$conexion = new mysqli("localhost", "root", "", "DANA");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>
