// 5. /admin/pedidos.php
<?php
session_start();
include '../includes/db.php';
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'administrador') {
    header("Location: ../index.php");
    exit();
}
$resultado = $conexion->query("SELECT * FROM pedidos");
include '../includes/header.php';
?>
<h1>Gestión de Pedidos</h1>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Usuario</th>
        <th>Fecha</th>
        <th>Estado</th>
        <th>Total (Tonkens)</th>
    </tr>
    <?php while ($pedido = $resultado->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $pedido['id']; ?></td>
            <td><?php echo $pedido['usuario_id']; ?></td>
            <td><?php echo $pedido['fecha']; ?></td>
            <td><?php echo $pedido['estado']; ?></td>
            <td><?php echo $pedido['total_tonkens']; ?></td>
        </tr>
    <?php } ?>
</table>
<?php include '../includes/footer.php'; ?>

