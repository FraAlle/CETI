// 5. /carrito/checkout.php
<?php
session_start();
include '../includes/db.php';
include '../includes/header.php';
verificarSesion();

$id_usuario = $_SESSION['usuario']['id'];
$total_tonkens = 0;
foreach ($_SESSION['carrito'] as $id_producto => $cantidad) {
    $query = $conexion->prepare("SELECT precio_tonkens FROM productos WHERE id = ?");
    $query->bind_param("i", $id_producto);
    $query->execute();
    $resultado = $query->get_result()->fetch_assoc();
    $total_tonkens += $resultado['precio_tonkens'] * $cantidad;
}

$query = $conexion->prepare("INSERT INTO pedidos (usuario_id, fecha, estado, total_tonkens) VALUES (?, NOW(), 'pendiente', ?)");
$query->bind_param("ii", $id_usuario, $total_tonkens);
if ($query->execute()) {
    $_SESSION['carrito'] = [];
    echo "<p>Pedido realizado con éxito.</p>";
    include '../emails/enviar_pedido.php';
    enviarCorreoPedido($_SESSION['usuario']['email'], "Tu pedido ha sido confirmado.");
} else {
    echo "<p>Error al procesar el pedido.</p>";
}
?>
<a href="../index.php">Volver a la tienda</a>
<?php include '../includes/footer.php'; ?>
