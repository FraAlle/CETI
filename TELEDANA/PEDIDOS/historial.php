// 5. /pedidos/historial.php
<?php
session_start();
include '../includes/db.php';
include '../includes/header.php';
verificarSesion();

$id_usuario = $_SESSION['usuario']['id'];
$query = $conexion->prepare("SELECT * FROM pedidos WHERE usuario_id = ? ORDER BY fecha DESC");
$query->bind_param("i", $id_usuario);
$query->execute();
$resultado = $query->get_result();
?>
<h1>Historial de Pedidos</h1>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Fecha</th>
        <th>Estado</th>
        <th>Total (Tonkens)</th>
        <th>Detalles</th>
    </tr>
    <?php while ($pedido = $resultado->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $pedido['id']; ?></td>
            <td><?php echo $pedido['fecha']; ?></td>
            <td><?php echo $pedido['estado']; ?></td>
            <td><?php echo $pedido['total_tonkens']; ?></td>
            <td><a href="pedido.php?id=<?php echo $pedido['id']; ?>">Ver</a></td>
        </tr>
    <?php } ?>
</table>
<?php include '../includes/footer.php'; ?>
