<?php
// Datos del admin
$nombre = 'Admin';
$apellido = 'Admin';
$email = 'admin@example.com';
$contraseña = 'contraseña';  // Contraseña en texto claro
$rol = 'admin';

// Hashear la contraseña antes de insertarla
$contraseña_hash = password_hash($contraseña, PASSWORD_BCRYPT);

// Conectar a la base de datos
$host = "localhost";
$usuario = "root";
$password = "";
$base_datos = "ceti_usuarios";

$conn = new mysqli($host, $usuario, $password, $base_datos);

// Verifica la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Preparar y ejecutar la consulta de inserción
$sql = "INSERT INTO usuarios (nombre, apellido, email, password, rol) 
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $nombre, $apellido, $email, $contraseña_hash, $rol);

if ($stmt->execute()) {
    echo "Usuario admin creado correctamente con la contraseña hasheada.";
} else {
    echo "Error al crear el usuario: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
