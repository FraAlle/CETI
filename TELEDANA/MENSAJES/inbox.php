// 4. /mensajes/inbox.php
<?php
session_start();
include '../includes/db.php';
include '../includes/header.php';
verificarSesion();

$id_usuario = $_SESSION['usuario']['id'];
$query = $conexion->prepare("SELECT m.id, u.nombre AS remitente, m.mensaje, m.fecha FROM mensajes m JOIN usuarios u ON m.remitente_id = u.id WHERE m.destinatario_id = ? ORDER BY m.fecha DESC");
$query->bind_param("i", $id_usuario);
$query->execute();
$resultado = $query->get_result();
?>
<h1>Bandeja de Entrada</h1>
<table border="1">
    <tr>
        <th>Remitente</th>
        <th>Mensaje</th>
        <th>Fecha</th>
    </tr>
    <?php while ($mensaje = $resultado->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $mensaje['remitente']; ?></td>
            <td><?php echo $mensaje['mensaje']; ?></td>
            <td><?php echo $mensaje['fecha']; ?></td>
        </tr>
    <?php } ?>
</table>
<?php include '../includes/footer.php'; ?>
