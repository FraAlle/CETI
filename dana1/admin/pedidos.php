<?php
session_start();
include '../includes/db.php';

// Verificar si el usuario tiene el rol de administrador o voluntario
if (!isset($_SESSION['usuario']) || ($_SESSION['usuario']['rol'] !== 'administrador' && $_SESSION['usuario']['rol'] !== 'voluntario')) {
    header("Location: ../index.php");
    exit();
}

// Eliminar pedido
if (isset($_GET['eliminar'])) {
    $id = filter_input(INPUT_GET, 'eliminar', FILTER_VALIDATE_INT);
    if ($id) {
        $stmt = $conexion->prepare("DELETE FROM pedidos WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        header("Location: pedidos.php?mensaje=Pedido eliminado correctamente");
        exit();
    }
}

// Editar pedido
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar'])) {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $usuario_id = filter_input(INPUT_POST, 'usuario_id', FILTER_VALIDATE_INT);
    $total_tonkens = filter_input(INPUT_POST, 'total_tonkens', FILTER_VALIDATE_FLOAT);
    $fecha = filter_input(INPUT_POST, 'fecha', FILTER_SANITIZE_STRING);
    $estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_STRING);

    if ($id && $usuario_id && $total_tonkens && $fecha && $estado) {
        $stmt = $conexion->prepare("UPDATE pedidos SET usuario_id = ?, total_tonkens = ?, fecha = ?, estado = ? WHERE id = ?");
        $stmt->bind_param("idssi", $usuario_id, $total_tonkens, $fecha, $estado, $id);
        if ($stmt->execute()) {
            header("Location: pedidos.php?mensaje=Pedido actualizado correctamente");
        } else {
            $error = "Error al actualizar el pedido: " . htmlspecialchars($stmt->error, ENT_QUOTES, 'UTF-8');
        }
        exit();
    } else {
        $error = "Por favor, completa todos los campos correctamente.";
    }
}

// Crear nuevo pedido
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear'])) {
    $usuario_id = filter_input(INPUT_POST, 'usuario_id', FILTER_VALIDATE_INT);
    $total_tonkens = filter_input(INPUT_POST, 'total_tonkens', FILTER_VALIDATE_FLOAT);
    $fecha = filter_input(INPUT_POST, 'fecha', FILTER_SANITIZE_STRING);
    $estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_STRING);

    if ($usuario_id && $total_tonkens && $fecha && $estado) {
        $stmt = $conexion->prepare("INSERT INTO pedidos (usuario_id, total_tonkens, fecha, estado) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("idss", $usuario_id, $total_tonkens, $fecha, $estado);
        if ($stmt->execute()) {
            header("Location: pedidos.php?mensaje=Pedido creado correctamente");
        } else {
            $error = "Error al crear el pedido: " . htmlspecialchars($stmt->error, ENT_QUOTES, 'UTF-8');
        }
        exit();
    } else {
        $error = "Por favor, completa todos los campos correctamente.";
    }
}

// Obtener todos los pedidos
$resultado = $conexion->query("SELECT id, usuario_id, total_tonkens, fecha, estado FROM pedidos");
if (!$resultado) {
    die("Error al obtener los pedidos: " . htmlspecialchars($conexion->error, ENT_QUOTES, 'UTF-8'));
}

include '../includes/header.php';
?>

<h1>Gestión de Pedidos</h1>
<?php if (isset($_GET['mensaje'])): ?>
    <p style="color: green;"><?php echo htmlspecialchars($_GET['mensaje'], ENT_QUOTES, 'UTF-8'); ?></p>
<?php endif; ?>
<?php if (isset($error)): ?>
    <p style="color: red;"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
<?php endif; ?>

<!-- Formulario para crear un nuevo pedido -->
<h2>Crear Nuevo Pedido</h2>
<form method="POST">
    <input type="number" name="usuario_id" placeholder="ID Usuario" required>
    <input type="number" step="0.01" name="total_tonkens" placeholder="Total Tonkens" required>
    <input type="date" name="fecha" required>
    <select name="estado" required>
        <option value="pendiente">Pendiente</option>
        <option value="completado">Completado</option>
        <option value="cancelado">Cancelado</option>
    </select>
    <button type="submit" name="crear">Crear Pedido</button>
</form>

<!-- Tabla de pedidos -->
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>ID Usuario</th>
            <th>Total Tonkens</th>
            <th>Fecha</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($pedido = $resultado->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($pedido['id'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td>
                <form method="POST" style="display: inline;">
                    <input type="hidden" name="id" value="<?php echo $pedido['id']; ?>">
                    <input type="number" name="usuario_id" value="<?php echo htmlspecialchars($pedido['usuario_id'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </td>
            <td>
                    <input type="number" step="0.01" name="total_tonkens" value="<?php echo htmlspecialchars($pedido['total_tonkens'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </td>
            <td>
                    <input type="date" name="fecha" value="<?php echo htmlspecialchars($pedido['fecha'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </td>
            <td>
                    <select name="estado" required>
                        <option value="pendiente" <?php echo $pedido['estado'] === 'pendiente' ? 'selected' : ''; ?>>Pendiente</option>
                        <option value="completado" <?php echo $pedido['estado'] === 'completado' ? 'selected' : ''; ?>>Completado</option>
                        <option value="cancelado" <?php echo $pedido['estado'] === 'cancelado' ? 'selected' : ''; ?>>Cancelado</option>
                    </select>
            </td>
            <td>
                    <button type="submit" name="editar">Guardar</button>
                </form>
                <a href="pedidos.php?eliminar=<?php echo $pedido['id']; ?>" onclick="return confirm('¿Estás seguro de eliminar este pedido?');">Eliminar</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include '../includes/footer.php'; ?>

