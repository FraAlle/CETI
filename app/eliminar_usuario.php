<?php
session_start();
if (!isset($_SESSION["usuario"]) || $_SESSION["rol"] != "admin") {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    include('db_connect.php');

    $conn = new mysqli($host, $usuario, $password, $base_datos);
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Eliminar el usuario de la base de datos
    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirigir al panel de administración después de eliminar
        header("Location: admin.php");
        exit();
    } else {
        echo "Error al eliminar el usuario.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "ID de usuario no proporcionado.";
}
?>
