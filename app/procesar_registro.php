<?php
include('db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST["nombre"]);
    $apellido = trim($_POST["apellido"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Verifica si el email ya existe
    $sql_check = "SELECT id FROM usuarios WHERE email = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        echo "<script>alert('El correo ya está registrado.'); window.location.href = 'registro.php';</script>";
        exit();
    }
    $stmt_check->close();

    // Encripta la contraseña
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    // Verifica si la columna 'password' es la correcta
    $sql = "INSERT INTO usuarios (nombre, apellido, email, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nombre, $apellido, $email, $password_hash);

    // Verifica si la inserción fue exitosa
    if ($stmt->execute()) {
        echo "<script>alert('Registro exitoso'); window.location.href = 'login.php';</script>";
    } else {
        echo "Error en el registro: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
