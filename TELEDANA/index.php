// 1. /index.php
<?php
session_start();
include 'includes/db.php';
include 'includes/header.php';

$resultado = $conexion->query("SELECT * FROM productos ORDER BY id DESC LIMIT 10");
?>
<h1>Bienvenido a DANA</h1>
<p>Explora los productos disponibles en nuestra tienda de voluntariado.</p>
<table border="1">
    <tr>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Precio (Tonkens)</th>
        <th>Acción</th>
    </tr>
    <?php while ($producto = $resultado->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $producto['nombre']; ?></td>
            <td><?php echo $producto['descripcion']; ?></td>
            <td><?php echo $producto['precio_tonkens']; ?></td>
            <td><a href="carrito/index.php?add=<?php echo $producto['id']; ?>">Añadir al Carrito</a></td>
        </tr>
    <?php } ?>
</table>
<?php include 'includes/footer.php'; ?>
