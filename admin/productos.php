// 4. /admin/productos.php
<?php
session_start();
include '../includes/db.php';
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'administrador') {
    header("Location: ../index.php");
    exit();
}
$resultado = $conexion->query("SELECT * FROM productos");
include '../includes/header.php';
?>
<h1>Gestión de Productos</h1>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Precio (Tonkens)</th>
        <th>Stock</th>
    </tr>
    <?php while ($producto = $resultado->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $producto['id']; ?></td>
            <td><?php echo $producto['nombre']; ?></td>
            <td><?php echo $producto['descripcion']; ?></td>
            <td><?php echo $producto['precio_tonkens']; ?></td>
            <td><?php echo $producto['stock']; ?></td>
        </tr>
    <?php } ?>
</table>
<?php include '../includes/footer.php'; ?>
