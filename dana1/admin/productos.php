<?php
session_start();
include '../includes/db.php';

// Verificar si el usuario tiene el rol de administrador o voluntario
if (!isset($_SESSION['usuario']) || ($_SESSION['usuario']['rol'] !== 'administrador' && $_SESSION['usuario']['rol'] !== 'voluntario')) {
    header("Location: ../index.php");
    exit();
}

// Eliminar producto
if (isset($_GET['eliminar'])) {
    $id = filter_input(INPUT_GET, 'eliminar', FILTER_VALIDATE_INT);
    if ($id) {
        $stmt = $conexion->prepare("DELETE FROM productos WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        header("Location: productos.php?mensaje=Producto eliminado correctamente");
        exit();
    }
}

// Editar producto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar'])) {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_STRING);
    $precio_tonkens = filter_input(INPUT_POST, 'precio_tonkens', FILTER_VALIDATE_FLOAT);
    $categoria = filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_STRING);
    $stock = filter_input(INPUT_POST, 'stock', FILTER_VALIDATE_INT);

    if ($id && $nombre && $descripcion && $precio_tonkens && $categoria && $stock) {
        $stmt = $conexion->prepare("UPDATE productos SET nombre = ?, descripcion = ?, precio_tonkens = ?, categoria = ?, stock = ? WHERE id = ?");
        $stmt->bind_param("ssdssi", $nombre, $descripcion, $precio_tonkens, $categoria, $stock, $id);
        if ($stmt->execute()) {
            header("Location: productos.php?mensaje=Producto actualizado correctamente");
        } else {
            $error = "Error al actualizar el producto: " . htmlspecialchars($stmt->error, ENT_QUOTES, 'UTF-8');
        }
        exit();
    } else {
        $error = "Por favor, completa todos los campos correctamente.";
    }
}

// Crear nuevo producto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear'])) {
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_STRING);
    $precio_tonkens = filter_input(INPUT_POST, 'precio_tonkens', FILTER_VALIDATE_FLOAT);
    $categoria = filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_STRING);
    $stock = filter_input(INPUT_POST, 'stock', FILTER_VALIDATE_INT);

    if ($nombre && $descripcion && $precio_tonkens && $categoria && $stock) {
        $stmt = $conexion->prepare("INSERT INTO productos (nombre, descripcion, precio_tonkens, categoria, stock) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdsi", $nombre, $descripcion, $precio_tonkens, $categoria, $stock);
        if ($stmt->execute()) {
            header("Location: productos.php?mensaje=Producto creado correctamente");
        } else {
            $error = "Error al crear el producto: " . htmlspecialchars($stmt->error, ENT_QUOTES, 'UTF-8');
        }
        exit();
    } else {
        $error = "Por favor, completa todos los campos correctamente.";
    }
}

// Obtener todos los productos
$resultado = $conexion->query("SELECT id, nombre, descripcion, precio_tonkens, categoria, stock FROM productos");
if (!$resultado) {
    die("Error al obtener los productos: " . htmlspecialchars($conexion->error, ENT_QUOTES, 'UTF-8'));
}

include '../includes/header.php';
?>

<h1>Gestión de Productos</h1>
<?php if (isset($_GET['mensaje'])): ?>
    <p style="color: green;"><?php echo htmlspecialchars($_GET['mensaje'], ENT_QUOTES, 'UTF-8'); ?></p>
<?php endif; ?>
<?php if (isset($error)): ?>
    <p style="color: red;"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
<?php endif; ?>

<!-- Formulario para crear un nuevo producto -->
<h2>Crear Nuevo Producto</h2>
<form method="POST">
    <input type="text" name="nombre" placeholder="Nombre del Producto" required>
    <input type="text" name="descripcion" placeholder="Descripción" required>
    <input type="number" step="0.01" name="precio_tonkens" placeholder="Precio (Tonkens)" required>
    <input type="text" name="categoria" placeholder="Categoría" required>
    <input type="number" name="stock" placeholder="Stock" required>
    <button type="submit" name="crear">Crear Producto</button>
</form>

<!-- Tabla de productos -->
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio (Tonkens)</th>
            <th>Categoría</th>
            <th>Stock</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($producto = $resultado->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($producto['id'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td>
                <form method="POST" style="display: inline;">
                    <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
                    <input type="text" name="nombre" value="<?php echo htmlspecialchars($producto['nombre'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </td>
            <td>
                    <input type="text" name="descripcion" value="<?php echo htmlspecialchars($producto['descripcion'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </td>
            <td>
                    <input type="number" step="0.01" name="precio_tonkens" value="<?php echo htmlspecialchars($producto['precio_tonkens'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </td>
            <td>
                    <input type="text" name="categoria" value="<?php echo htmlspecialchars($producto['categoria'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </td>
            <td>
                    <input type="number" name="stock" value="<?php echo htmlspecialchars($producto['stock'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </td>
            <td>
                    <button type="submit" name="editar">Guardar</button>
                </form>
                <a href="productos.php?eliminar=<?php echo $producto['id']; ?>" onclick="return confirm('¿Estás seguro de eliminar este producto?');">Eliminar</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include '../includes/footer.php'; ?>
