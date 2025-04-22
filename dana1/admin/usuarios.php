<?php
session_start();
include '../includes/db.php';

// Verificar si el usuario tiene el rol de administrador o voluntario
if (!isset($_SESSION['usuario']) || ($_SESSION['usuario']['rol'] !== 'administrador' && $_SESSION['usuario']['rol'] !== 'voluntario')) {
    header("Location: ../index.php");
    exit();
}

// Roles válidos
$rolesValidos = ['cliente', 'administrador', 'voluntario'];

// Eliminar usuario
if (isset($_GET['eliminar'])) {
    $id = filter_input(INPUT_GET, 'eliminar', FILTER_VALIDATE_INT);
    if ($id) {
        $stmt = $conexion->prepare("DELETE FROM usuarios WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        header("Location: usuarios.php?mensaje=Usuario eliminado correctamente");
        exit();
    }
}

// Editar usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar'])) {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $rol = filter_input(INPUT_POST, 'rol', FILTER_SANITIZE_STRING);
    $tonkens = filter_input(INPUT_POST, 'tonkens', FILTER_VALIDATE_INT);
    $insignias = filter_input(INPUT_POST, 'insignias', FILTER_VALIDATE_INT);
    $perfil_publico = filter_input(INPUT_POST, 'perfil_publico', FILTER_SANITIZE_STRING);
    $valoracion = filter_input(INPUT_POST, 'valoracion', FILTER_VALIDATE_FLOAT);

    // Validar que el rol sea válido
    if (!in_array($rol, $rolesValidos)) {
        $error = "Rol inválido.";
    } elseif ($id && $nombre && $email && $rol !== false) {
        $stmt = $conexion->prepare("UPDATE usuarios SET nombre = ?, email = ?, rol = ?, tonkens = ?, insignias = ?, perfil_publico = ?, valoracion = ? WHERE id = ?");
        $stmt->bind_param("sssissdi", $nombre, $email, $rol, $tonkens, $insignias, $perfil_publico, $valoracion, $id);
        if ($stmt->execute()) {
            header("Location: usuarios.php?mensaje=Usuario actualizado correctamente");
        } else {
            $error = "Error al actualizar el usuario: " . htmlspecialchars($stmt->error, ENT_QUOTES, 'UTF-8');
        }
        exit();
    } else {
        $error = "Por favor, completa todos los campos correctamente.";
    }
}

// Crear nuevo usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear'])) {
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $rol = filter_input(INPUT_POST, 'rol', FILTER_SANITIZE_STRING);
    $tonkens = filter_input(INPUT_POST, 'tonkens', FILTER_VALIDATE_INT);
    $insignias = filter_input(INPUT_POST, 'insignias', FILTER_VALIDATE_INT);
    $perfil_publico = filter_input(INPUT_POST, 'perfil_publico', FILTER_SANITIZE_STRING);
    $valoracion = filter_input(INPUT_POST, 'valoracion', FILTER_VALIDATE_FLOAT);
    $password = password_hash('default123', PASSWORD_BCRYPT); // Contraseña predeterminada

    if (!in_array($rol, $rolesValidos)) {
        $error = "Rol inválido.";
    } elseif ($nombre && $email && $rol !== false) {
        $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, email, password, rol, tonkens, insignias, perfil_publico, valoracion) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssissd", $nombre, $email, $password, $rol, $tonkens, $insignias, $perfil_publico, $valoracion);
        if ($stmt->execute()) {
            header("Location: usuarios.php?mensaje=Usuario creado correctamente");
        } else {
            $error = "Error al crear el usuario: " . htmlspecialchars($stmt->error, ENT_QUOTES, 'UTF-8');
        }
        exit();
    } else {
        $error = "Por favor, completa todos los campos correctamente.";
    }
}

// Obtener todos los usuarios
$resultado = $conexion->query("SELECT id, nombre, email, rol, tonkens, insignias, perfil_publico, valoracion FROM usuarios");
if (!$resultado) {
    die("Error al obtener los usuarios: " . htmlspecialchars($conexion->error, ENT_QUOTES, 'UTF-8'));
}

include '../includes/header.php';
?>

<h1>Gestión de Usuarios</h1>
<?php if (isset($_GET['mensaje'])): ?>
    <p style="color: green;"><?php echo htmlspecialchars($_GET['mensaje'], ENT_QUOTES, 'UTF-8'); ?></p>
<?php endif; ?>
<?php if (isset($error)): ?>
    <p style="color: red;"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
<?php endif; ?>

<!-- Formulario para crear un nuevo usuario -->
<h2>Crear Nuevo Usuario</h2>
<form method="POST">
    <input type="text" name="nombre" placeholder="Nombre" required>
    <input type="email" name="email" placeholder="Email" required>
    <select name="rol" required>
        <option value="cliente">Cliente</option>
        <option value="administrador">Administrador</option>
        <option value="voluntario">Voluntario</option>
    </select>
    <input type="number" name="tonkens" placeholder="Tonkens" value="0" required>
    <input type="number" name="insignias" placeholder="Insignias" value="0" required>
    <input type="text" name="perfil_publico" placeholder="Perfil Público">
    <input type="number" step="0.01" name="valoracion" placeholder="Valoración" value="0.00" required>
    <button type="submit" name="crear">Crear Usuario</button>
</form>

<!-- Tabla de usuarios -->
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Tonkens</th>
            <th>Insignias</th>
            <th>Perfil Público</th>
            <th>Valoración</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($usuario = $resultado->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($usuario['id'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td>
                <form method="POST" style="display: inline;">
                    <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
                    <input type="text" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </td>
            <td>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($usuario['email'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </td>
            <td>
                    <select name="rol" required>
                        <option value="cliente" <?php echo $usuario['rol'] === 'cliente' ? 'selected' : ''; ?>>Cliente</option>
                        <option value="administrador" <?php echo $usuario['rol'] === 'administrador' ? 'selected' : ''; ?>>Administrador</option>
                        <option value="voluntario" <?php echo $usuario['rol'] === 'voluntario' ? 'selected' : ''; ?>>Voluntario</option>
                    </select>
            </td>
            <td>
                    <input type="number" name="tonkens" value="<?php echo htmlspecialchars($usuario['tonkens'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </td>
            <td>
                    <input type="number" name="insignias" value="<?php echo htmlspecialchars($usuario['insignias'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </td>
            <td>
                    <input type="text" name="perfil_publico" value="<?php echo htmlspecialchars($usuario['perfil_publico'], ENT_QUOTES, 'UTF-8'); ?>">
            </td>
            <td>
                    <input type="number" step="0.01" name="valoracion" value="<?php echo htmlspecialchars($usuario['valoracion'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </td>
            <td>
                    <button type="submit" name="editar">Guardar</button>
                </form>
                <a href="usuarios.php?eliminar=<?php echo $usuario['id']; ?>" onclick="return confirm('¿Estás seguro de eliminar este usuario?');">Eliminar</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include '../includes/footer.php'; ?>
