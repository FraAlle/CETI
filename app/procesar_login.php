<?php
session_start();

include('db_connect.php');

$conn = new mysqli($host, $usuario, $password, $base_datos);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Preparar la consulta para verificar al usuario
    $sql = "SELECT id, nombre, password, rol FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $nombre, $password_db, $rol);
    $stmt->fetch();

    // Verificar si se encontró al usuario y si la contraseña coincide
    if ($stmt->num_rows > 0 && password_verify($password, $password_db)) {
        // Almacenar la información del usuario en la sesión
        $_SESSION["usuario"] = htmlspecialchars($nombre);
        $_SESSION["id"] = $id;
        $_SESSION["rol"] = $rol;

        // Redirigir según el rol del usuario
        if ($rol == "admin") {
            header("Location: admin.php");
        } else {
            header("Location: usuario.php");
        }
        exit();
    } else {
        // Si las credenciales son incorrectas, mostrar un mensaje de error
        echo "<script>alert('Correo o contraseña incorrectos'); window.location.href = 'login.php';</script>";
    }

    // Cerrar la conexión
    $stmt->close();
    $conn->close();
}
?>
