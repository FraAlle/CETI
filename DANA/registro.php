<?php
session_start();
include 'includes/db.php';
include 'includes/header.php';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $rol = 'cliente';

    // Validación básica
    if (empty($nombre) || empty($email) || empty($password)) {
        $error = "Todos los campos son obligatorios.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "El email no es válido.";
    } else {
        // Verifica si el email ya está registrado
        $query = $conexion->prepare("SELECT id FROM usuarios WHERE email = ?");
        $query->bind_param("s", $email);
        $query->execute();
        $query->store_result();

        if ($query->num_rows > 0) {
            $error = "El email ya está registrado. Por favor, usa otro.";
        } else {
            // Inserta el nuevo usuario
            $password_hashed = password_hash($password, PASSWORD_DEFAULT);
            $query = $conexion->prepare("INSERT INTO usuarios (nombre, email, password, rol) VALUES (?, ?, ?, ?)");
            $query->bind_param("ssss", $nombre, $email, $password_hashed, $rol);

            if ($query->execute()) {
                // Inicia sesión automáticamente después del registro
                $user_id = $conexion->insert_id; // Obtiene el ID del usuario recién registrado
                $_SESSION['usuario'] = [
                    'id' => $user_id,
                    'nombre' => $nombre,
                    'email' => $email,
                    'rol' => $rol
                ];
                header("Location: index.php"); // Redirige al usuario a la página principal
                exit();
            } else {
                $error = "Error al registrar. Por favor, inténtalo de nuevo.";
            }
        }
    }
}
?>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 20px;
    }

    .register-container {
        max-width: 500px;
        margin: 0 auto;
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    form {
        display: flex;
        flex-direction: column;
    }

    label {
        margin-bottom: 5px;
        font-weight: bold;
        color: #333;
    }

    input {
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }

    button {
        padding: 10px;
        background-color: #007BFF;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
    }

    button:hover {
        background-color: #0056b3;
    }

    .message {
        text-align: center;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .message.success {
        color: green;
    }

    .message.error {
        color: red;
    }
</style>

<div class="register-container">
    <h1>Registro de Usuario</h1>

    <?php if ($success): ?>
        <p class="message success"><?php echo htmlspecialchars($success); ?></p>
    <?php elseif ($error): ?>
        <p class="message error"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" placeholder="Ingresa tu nombre" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Ingresa tu email" required>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required>

        <button type="submit">Registrarse</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>