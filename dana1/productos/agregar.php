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

// Manejar el envío del formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validar y sanitizar los datos enviados
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_STRING);
    $precio_tonkens = filter_input(INPUT_POST, 'precio_tonkens', FILTER_VALIDATE_FLOAT);
    $categoria = filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_STRING);
    $stock = filter_input(INPUT_POST, 'stock', FILTER_VALIDATE_INT);
    $usuario_id = $_SESSION['usuario']['id'];

    // Validar que todos los campos sean válidos
    if ($nombre && $descripcion && $precio_tonkens && $categoria && $stock !== false) {
        // Insertar el producto en la base de datos
        $query = $conexion->prepare("INSERT INTO productos (usuario_id, nombre, descripcion, precio_tonkens, categoria, stock) VALUES (?, ?, ?, ?, ?, ?)");
        $query->bind_param("issisi", $usuario_id, $nombre, $descripcion, $precio_tonkens, $categoria, $stock);

        if ($query->execute()) {
            $mensaje = "Producto agregado correctamente.";
        } else {
            $error = "Error al agregar el producto.";
        }
    } else {
        $error = "Por favor, completa todos los campos correctamente.";
    }
}
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Agregar Producto</h1>

    <!-- Mostrar mensajes de éxito o error -->
    <?php if (isset($mensaje)): ?>
        <div class="alert alert-success"><?php echo sanitize($mensaje); ?></div>
    <?php elseif (isset($error)): ?>
        <div class="alert alert-danger"><?php echo sanitize($error); ?></div>
    <?php endif; ?>

    <!-- Formulario de agregar producto -->
    <form method="POST">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción:</label>
            <textarea id="descripcion" name="descripcion" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label for="precio_tonkens" class="form-label">Precio (Tonkens):</label>
            <input type="number" id="precio_tonkens" name="precio_tonkens" class="form-control" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="categoria" class="form-label">Categoría:</label>
            <select id="categoria" name="categoria" class="form-control" required>
                <option value="alimentos">Alimentos</option>
                <option value="limpieza">Limpieza</option>
                <option value="bricolaje">Bricolaje</option>
                <option value="transporte">Transporte</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Stock:</label>
            <input type="number" id="stock" name="stock" class="form-control" min="1" required>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Agregar Producto</button>
        </div>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
