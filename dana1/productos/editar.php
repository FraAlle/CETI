// 6. /productos/editar.php
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

// Verificar si se recibió el ID del producto
if (!isset($_GET['id']) || !filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

// Obtener los datos del producto de forma segura
$query = $conexion->prepare("SELECT * FROM productos WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();
$resultado = $query->get_result();
$producto = $resultado->fetch_assoc();

// Verificar que el producto exista
if (!$producto) {
    header("Location: index.php");
    exit();
}

// Manejar el envío del formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validar y sanitizar los datos enviados
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_STRING);
    $precio_tonkens = filter_input(INPUT_POST, 'precio_tonkens', FILTER_VALIDATE_FLOAT);
    $categoria = filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_STRING);
    $stock = filter_input(INPUT_POST, 'stock', FILTER_VALIDATE_INT);

    // Validar que todos los campos sean válidos
    if ($nombre && $descripcion && $precio_tonkens && $categoria && $stock !== false) {
        // Actualizar el producto en la base de datos
        $query = $conexion->prepare("UPDATE productos SET nombre = ?, descripcion = ?, precio_tonkens = ?, categoria = ?, stock = ? WHERE id = ?");
        $query->bind_param("ssdsii", $nombre, $descripcion, $precio_tonkens, $categoria, $stock, $id);

        if ($query->execute()) {
            header("Location: index.php");
            exit();
        } else {
            $error = "Error al actualizar el producto.";
        }
    } else {
        $error = "Por favor, completa todos los campos correctamente.";
    }
}
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Editar Producto</h1>

    <!-- Mostrar mensajes de error -->
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
    <?php endif; ?>

    <!-- Formulario de edición -->
    <form method="POST">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo htmlspecialchars($producto['nombre'], ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción:</label>
            <textarea id="descripcion" name="descripcion" class="form-control" required><?php echo htmlspecialchars($producto['descripcion'], ENT_QUOTES, 'UTF-8'); ?></textarea>
        </div>
        <div class="mb-3">
            <label for="precio_tonkens" class="form-label">Precio (Tonkens):</label>
            <input type="number" id="precio_tonkens" name="precio_tonkens" class="form-control" step="0.01" value="<?php echo htmlspecialchars($producto['precio_tonkens'], ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div class="mb-3">
            <label for="categoria" class="form-label">Categoría:</label>
            <select id="categoria" name="categoria" class="form-control" required>
                <option value="alimentos" <?php echo $producto['categoria'] === 'alimentos' ? 'selected' : ''; ?>>Alimentos</option>
                <option value="limpieza" <?php echo $producto['categoria'] === 'limpieza' ? 'selected' : ''; ?>>Limpieza</option>
                <option value="bricolaje" <?php echo $producto['categoria'] === 'bricolaje' ? 'selected' : ''; ?>>Bricolaje</option>
                <option value="transporte" <?php echo $producto['categoria'] === 'transporte' ? 'selected' : ''; ?>>Transporte</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Stock:</label>
            <input type="number" id="stock" name="stock" class="form-control" min="1" value="<?php echo htmlspecialchars($producto['stock'], ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
