// 2. /login.php
<?php
session_start();
include 'includes/db.php';
include 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $query = $conexion->prepare("SELECT * FROM usuarios WHERE email = ?");
    $query->bind_param("s", $email);
    $query->execute();
    $resultado = $query->get_result();
    $usuario = $resultado->fetch_assoc();
    
    if ($usuario && password_verify($password, $usuario['password'])) {
        $_SESSION['usuario'] = $usuario;
        header("Location: index.php");
        exit();
    } else {
        echo "<p>Credenciales incorrectas.</p>";
    }
}
?>
<h1>Iniciar Sesión</h1>
<form method="POST">
    <label>Email:</label>
    <input type="email" name="email" required>
    <label>Contraseña:</label>
    <input type="password" name="password" required>
    <button type="submit">Iniciar Sesión</button>
</form>
<?php include 'includes/footer.php'; ?>
