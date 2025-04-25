<?php
session_start();
include '../includes/db.php';
include '../includes/header.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

// Verificar si el carrito tiene productos
if (empty($_SESSION['carrito']) || !is_array($_SESSION['carrito'])) {
    echo "<div class='container mt-5'><p class='text-center'>Tu carrito está vacío.</p></div>";
    include '../includes/footer.php';
    exit();
}

// Registrar el pedido
$usuario_id = $_SESSION['usuario']['id'];
$total_tonkens = 0;

// Obtener los "tonkens" del usuario
$query = $conexion->prepare("SELECT tonkens FROM usuarios WHERE id = ?");
$query->bind_param("i", $usuario_id);
$query->execute();
$resultado_usuario = $query->get_result()->fetch_assoc();

if (!$resultado_usuario) {
    error_log("Usuario no encontrado: ID Usuario={$usuario_id}");
    echo "<div class='container mt-5'><p class='text-center text-danger'>Error: Usuario no encontrado.</p></div>";
    include '../includes/footer.php';
    exit();
}

$tonkens_usuario = $resultado_usuario['tonkens'];

// Validar y calcular el total de los productos en el carrito
foreach ($_SESSION['carrito'] as $id_producto => $cantidad) {
    $id_producto = filter_var($id_producto, FILTER_VALIDATE_INT);
    $cantidad = filter_var($cantidad, FILTER_VALIDATE_INT);

    if (!$id_producto || !$cantidad || $cantidad <= 0) {
        error_log("Datos inválidos en el carrito: ID Producto={$id_producto}, Cantidad={$cantidad}");
        echo "<div class='container mt-5'><p class='text-center text-danger'>Error: Datos del carrito inválidos.</p></div>";
        include '../includes/footer.php';
        exit();
    }

    $query = $conexion->prepare("SELECT precio_tonkens, stock FROM productos WHERE id = ?");
    $query->bind_param("i", $id_producto);
    $query->execute();
    $resultado = $query->get_result()->fetch_assoc();

    if (!$resultado) {
        error_log("Producto no encontrado: ID Producto={$id_producto}");
        echo "<div class='container mt-5'><p class='text-center text-danger'>Error: Producto no encontrado.</p></div>";
        include '../includes/footer.php';
        exit();
    }

    // Verificar si hay suficiente stock
    if ($cantidad > $resultado['stock']) {
        error_log("Stock insuficiente para el producto: ID Producto={$id_producto}, Stock Disponible={$resultado['stock']}, Cantidad Solicitada={$cantidad}");
        echo "<div class='container mt-5'><p class='text-center text-danger'>Error: No hay suficiente stock para el producto con ID $id_producto.</p></div>";
        include '../includes/footer.php';
        exit();
    }

    $total_tonkens += $resultado['precio_tonkens'] * $cantidad;
}

// Verificar si el usuario tiene suficientes "tonkens"
if ($total_tonkens > $tonkens_usuario) {
    error_log("Tonkens insuficientes: ID Usuario={$usuario_id}, Tonkens Disponibles={$tonkens_usuario}, Tonkens Requeridos={$total_tonkens}");
    echo "<div class='container mt-5'><p class='text-center text-danger'>Error: No tienes suficientes tonkens para completar la compra.</p></div>";
    include '../includes/footer.php';
    exit();
}

// Iniciar transacción
$conexion->begin_transaction();

try {
    // Insertar el pedido en la tabla `pedidos`
    $query = $conexion->prepare("INSERT INTO pedidos (usuario_id, fecha, estado, total_tonkens) VALUES (?, NOW(), 'pendiente', ?)");
    $query->bind_param("id", $usuario_id, $total_tonkens);
    $query->execute();
    $pedido_id = $conexion->insert_id;

    // Insertar los productos en la tabla `pedidos_productos`
    $query = $conexion->prepare("INSERT INTO pedidos_productos (pedido_id, producto_id, cantidad) VALUES (?, ?, ?)");
    foreach ($_SESSION['carrito'] as $id_producto => $cantidad) {
        $query->bind_param("iii", $pedido_id, $id_producto, $cantidad);
        $query->execute();

        // Reducir el stock del producto
        $query_stock = $conexion->prepare("UPDATE productos SET stock = stock - ? WHERE id = ?");
        $query_stock->bind_param("ii", $cantidad, $id_producto);
        $query_stock->execute();
    }

    // Reducir los "tonkens" del usuario
    $query_tonkens = $conexion->prepare("UPDATE usuarios SET tonkens = tonkens - ? WHERE id = ?");
    $query_tonkens->bind_param("ii", $total_tonkens, $usuario_id);
    $query_tonkens->execute();

    // Vaciar el carrito
    unset($_SESSION['carrito']);

    // Confirmar transacción
    $conexion->commit();

    echo "<div class='container mt-5'>";
    echo "<h1 class='text-center mb-4'>Compra Finalizada</h1>";
    echo "<p class='text-center'>Tu compra ha sido registrada con éxito. Gracias por tu compra.</p>";
    echo "<div class='text-center'><a href='../productos/index.php' class='btn btn-primary'>Volver a Productos</a></div>";
    echo "</div>";
} catch (Exception $e) {
    // Revertir transacción en caso de error
    $conexion->rollback();
    error_log("Error al procesar la compra: " . $e->getMessage());
    echo "<div class='container mt-5'><p class='text-center text-danger'>Error al procesar la compra. Por favor, inténtalo de nuevo.</p></div>";
    include '../includes/footer.php';
    exit();
}

include '../includes/footer.php';
?>
