<?php
session_start();
include '../includes/db.php';
include '../includes/header.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

// Verificar si el usuario tiene el rol de "cliente"
if (!isset($_SESSION['usuario']['rol']) || $_SESSION['usuario']['rol'] !== 'cliente') {
    error_log("Acceso denegado: Usuario sin permisos intentó acceder al carrito.");
    echo "<div class='container mt-5'><p class='text-center'>Acceso denegado. Esta sección es solo para clientes.</p></div>";
    include '../includes/footer.php';
    exit();
}

// Inicializar el carrito si no existe
if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    echo "<div class='container mt-5'><p class='text-center'>Tu carrito está vacío.</p></div>";
    include '../includes/footer.php';
    exit();
}

// Función para sanitizar datos
function sanitize($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

// Obtener los productos del carrito
$productos = [];
$total_tonkens = 0;

foreach ($_SESSION['carrito'] as $id_producto => $cantidad) {
    // Validar que el ID del producto y la cantidad sean válidos
    $id_producto = filter_var($id_producto, FILTER_VALIDATE_INT);
    $cantidad = filter_var($cantidad, FILTER_VALIDATE_INT);

    if (!$id_producto || !$cantidad || $cantidad <= 0) {
        error_log("Datos inválidos en el carrito: ID Producto={$id_producto}, Cantidad={$cantidad}");
        continue;
    }

    // Consultar los datos del producto
    $query = $conexion->prepare("SELECT nombre, precio_tonkens FROM productos WHERE id = ?");
    if (!$query) {
        error_log("Error en la consulta SQL: " . $conexion->error);
        continue;
    }

    $query->bind_param("i", $id_producto);
    $query->execute();
    $resultado = $query->get_result()->fetch_assoc();

    if ($resultado) {
        $subtotal = $resultado['precio_tonkens'] * $cantidad;
        $total_tonkens += $subtotal;

        $productos[] = [
            'id' => $id_producto,
            'nombre' => $resultado['nombre'],
            'precio_tonkens' => $resultado['precio_tonkens'],
            'cantidad' => $cantidad,
            'subtotal' => $subtotal
        ];
    } else {
        error_log("Producto no encontrado en la base de datos: ID Producto={$id_producto}");
    }
}
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Carrito de Compras</h1>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Producto</th>
                <th>Precio (Tonkens)</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><?php echo sanitize($producto['nombre']); ?></td>
                    <td><?php echo sanitize($producto['precio_tonkens']); ?></td>
                    <td><?php echo sanitize($producto['cantidad']); ?></td>
                    <td><?php echo sanitize($producto['subtotal']); ?></td>
                    <td>
                        <a href="eliminar.php?id=<?php echo sanitize($producto['id']); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-end"><strong>Total:</strong></td>
                <td colspan="2"><?php echo sanitize($total_tonkens); ?> Tonkens</td>
            </tr>
        </tfoot>
    </table>
    <div class="text-end">
        <a href="checkout.php" class="btn btn-success">Finalizar Compra</a>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
