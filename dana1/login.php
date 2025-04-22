<?php
include 'includes/header.php';
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validar y sanitizar los datos de entrada
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    if ($email && $password) {
        // Consulta preparada para evitar inyección SQL
        $query = $conexion->prepare("SELECT * FROM usuarios WHERE email = ?");
        $query->bind_param("s", $email);
        $query->execute();
        $resultado = $query->get_result();

        if ($resultado->num_rows > 0) {
            $usuario = $resultado->fetch_assoc();
            // Verificar la contraseña hasheada
            if (password_verify($password, $usuario['password'])) {
                session_start();
                $_SESSION['usuario'] = [
                    'id' => $usuario['id'],
                    'email' => htmlspecialchars($usuario['email'], ENT_QUOTES, 'UTF-8'),
                    'nombre' => htmlspecialchars($usuario['nombre'], ENT_QUOTES, 'UTF-8'),
                    'rol' => htmlspecialchars($usuario['rol'], ENT_QUOTES, 'UTF-8')
                ];
                header("Location: index.php");
                exit();
            } else {
                echo "<p>Credenciales incorrectas.</p>";
            }
        } else {
            echo "<p>Credenciales incorrectas.</p>";
        }
    } else {
        echo "<p>Por favor, completa todos los campos correctamente.</p>";
    }
}
?>

<main>
  <article class="info-box login-box">
    <h2>Iniciar Sesión</h2>
    <form method="POST">
      <label for="email">Correo electrónico:</label>
      <input type="email" id="email" name="email" placeholder="Ingrese su correo electrónico" required>

      <label for="password">Contraseña:</label>
      <input type="password" id="password" name="password" placeholder="Ingrese su contraseña" required>

      <button type="submit" class="login-btn">Iniciar Sesión</button>
    </form>
  </article>
</main>

<?php
include 'includes/footer.php';
?>