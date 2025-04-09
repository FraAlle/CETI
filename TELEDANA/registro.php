// 3. /registro.php
<?php
session_start();
include 'includes/db.php';
include 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $rol = 'cliente';
    
    $query = $conexion->prepare("INSERT INTO usuarios (nombre, email, password, rol) VALUES (?, ?, ?, ?)");
    $query->bind_param("ssss", $nombre, $email, $password, $rol);
    if ($query->execute()) {
        echo "<p>Registro exitoso. Puedes iniciar sesión.</p>";
    } else {
        echo "<p>Error al registrar.</p>";
    }
}
?>
<h1>Registro de Usuario</h1>
<form method="POST">
    <label>Nombre:</label>
    <input type="text" name="nombre" required>
    <label>Email:</label>
    <input type="email" name="email" required>
    <label>Contraseña:</label>
    <input type="password" name="password" required>
    <button type="submit">Registrarse</button>
</form>
<?php include 'includes/footer.php'; ?>
