// 6. /pedidos/pedido.php
<?php
session_start();
include '../includes/db.php';
include '../includes/header.php';
verificarSesion();

if (!isset($_GET['id'])) {
    header("Location: historial.php");
    exit();
}

$id_pedido = $_GET['id'];
$query = $conexion->prepare("SELECT * FROM pedidos WHERE id = ? AND usuario_id = ?");
$query->bind_param("ii", $id_pedido, $_SESSION['usuario']['id']);
$query->execute();
$resultado = $query->get_result();
$pedido = $resultado->fetch_assoc();

if (!$pedido) {
    echo "<p>Pedido no encontrado.</p>";
    include '../includes/footer.php';
    exit();
}

$query_productos = $conexion->prepare("SELECT p.nombre, p.precio_tonkens, pp.cantidad FROM pedidos_productos pp INNER JOIN productos p ON pp.producto_id = p.id WHERE pp.pedido_id = ?");
$query_productos->bind_param("i", $id_pedido);
$query_productos->execute();
$resultado_productos = $query_productos->get_result();
?>
<h1>Detalles del Pedido</h1>
<p><strong>ID del Pedido:</strong> <?php echo $pedido['id']; ?></p>
<p><strong>Fecha:</strong> <?php echo $pedido['fecha']; ?></p>
<p><strong>Estado:</strong> <?php echo $pedido['estado']; ?></p>
<p><strong>Total (Tonkens):</strong> <?php echo $pedido['total_tonkens']; ?></p>

<h2>Productos</h2>
<table border="1">
    <tr>
        <th>Nombre</th>
        <th>Precio (Tonkens)</th>
        <th>Cantidad</th>
    </tr>
    <?php while ($producto = $resultado_productos->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $producto['nombre']; ?></td>
            <td><?php echo $producto['precio_tonkens']; ?></td>
            <td><?php echo $producto['cantidad']; ?></td>
        </tr>
    <?php } ?>
</table>
<?php include '../includes/footer.php'; ?>
