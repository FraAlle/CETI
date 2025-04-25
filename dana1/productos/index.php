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

// Obtener la lista de productos de forma segura
$query = $conexion->prepare("SELECT id, nombre, descripcion, precio_tonkens, categoria, stock FROM productos");
$query->execute();
$resultado = $query->get_result();
?>
<div class="container mt-5">
    <h1 class="text-center mb-4">Lista de Productos</h1>

    <!-- Botón para agregar un nuevo producto -->
    <div class="mb-3 text-end">
        <a href="agregar.php" class="btn btn-success">Agregar Producto</a>
    </div>

    <table class="table table-bordered">
        <thead class="thead-dark">
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
            <?php while ($producto = $resultado->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo sanitize($producto['id']); ?></td>
                    <td><?php echo sanitize($producto['nombre']); ?></td>
                    <td><?php echo sanitize($producto['descripcion']); ?></td>
                    <td><?php echo sanitize($producto['precio_tonkens']); ?></td>
                    <td><?php echo sanitize($producto['categoria']); ?></td>
                    <td><?php echo sanitize($producto['stock']); ?></td>
                    <td>
                        <a href="detalle.php?id=<?php echo sanitize($producto['id']); ?>" class="btn btn-info btn-sm">Ver Detalle</a>
                        <a href="editar.php?id=<?php echo sanitize($producto['id']); ?>" class="btn btn-primary btn-sm">Editar</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php include '../includes/footer.php'; ?>
