<?php
session_start();
include 'includes/db.php';
include 'includes/header.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
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
        $error = "Credenciales incorrectas. Por favor, inténtalo de nuevo.";
    }
}
?>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .login-container {
        background: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
        text-align: center;
    }

    .login-container h1 {
        margin-bottom: 20px;
        font-size: 24px;
        color: #333;
    }

    .login-container form {
        display: flex;
        flex-direction: column;
    }

    .login-container label {
        text-align: left;
        margin-bottom: 5px;
        font-weight: bold;
        color: #333;
    }

    .login-container input {
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }

    .login-container button {
        padding: 10px;
        background-color: #007BFF;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
    }

    .login-container button:hover {
        background-color: #0056b3;
    }

    .login-container .register-link {
        margin-top: 15px;
        font-size: 14px;
        color: #007BFF;
        text-decoration: none;
    }

    .login-container .register-link:hover {
        text-decoration: underline;
    }

    .error {
        color: red;
        margin-bottom: 15px;
        font-size: 14px;
    }
</style>

<div class="login-container">
    <h1>Iniciar Sesión</h1>
    <?php if ($error): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Iniciar Sesión</button>
    </form>
    <a href="registro.php" class="register-link">¿No tienes una cuenta? Regístrate aquí</a>
</div>
<?php include 'includes/footer.php'; ?>