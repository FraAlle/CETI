<?php
// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include '../includes/db.php';
include '../includes/header.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

// Función para sanitizar datos
function sanitize($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

// Obtener el ID del usuario desde la sesión
$id = $_SESSION['usuario']['id'];

// Validar que el ID sea un número entero
if (!filter_var($id, FILTER_VALIDATE_INT)) {
    header("Location: ../index.php");
    exit();
}

// Obtener los datos actuales del usuario de forma segura
$query = $conexion->prepare("SELECT * FROM usuarios WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();
$resultado = $query->get_result();
$usuario = $resultado->fetch_assoc();

// Verificar que el usuario exista en la base de datos
if (!$usuario) {
    header("Location: ../index.php");
    exit();
}

// Manejar el envío del formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validar y sanitizar los datos enviados
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    if ($nombre && $email) {
        // Actualizar los datos del usuario
        $query = $conexion->prepare("UPDATE usuarios SET nombre = ?, email = ? WHERE id = ?");
        $query->bind_param("ssi", $nombre, $email, $id);
        if ($query->execute()) {
            // Actualizar los datos en la sesión
            $_SESSION['usuario']['nombre'] = $nombre;
            $_SESSION['usuario']['email'] = $email;
            header("Location: perfil.php");
            exit();
        } else {
            $error = "Error al actualizar el perfil.";
        }
    } else {
        $error = "Por favor, completa todos los campos correctamente.";
    }
}
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Editar Perfil</h1>
    <div class="card">
        <div class="card-body">
            <!-- Mostrar mensajes de éxito o error -->
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo sanitize($error); ?></div>
            <?php endif; ?>

            <!-- Formulario de edición -->
            <form method="POST">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo sanitize($usuario['nombre']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico:</label>
                    <input type="email" id="email" name="email" class="form-control" value="<?php echo sanitize($usuario['email']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="valoracion" class="form-label">Valoración:</label>
                    <input type="text" id="valoracion" class="form-control" value="<?php echo sanitize($usuario['valoracion']); ?>" disabled>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    <a href="perfil.php" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
