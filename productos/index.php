// 5. /productos/index.php
<?php
session_start();
include '../includes/db.php';
include '../includes/header.php';

$resultado = $conexion->query("SELECT * FROM productos");
?>
<h1>Lista de Productos</h1>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Precio (Tonkens)</th>
        <th>Acciones</th>
    </tr>
    <?php while ($producto = $resultado->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $producto['id']; ?></td>
            <td><?php echo $producto['nombre']; ?></td>
            <td><?php echo $producto['descripcion']; ?></td>
            <td><?php echo $producto['precio_tonkens']; ?></td>
            <td>
                <a href="editar.php?id=<?php echo $producto['id']; ?>">Editar</a>
            </td>
        </tr>
    <?php } ?>
</table>
<?php include '../includes/footer.php'; ?>
