// 4. /carrito/index.php
<?php
session_start();
include '../includes/db.php';
include '../includes/header.php';
verificarSesion();

if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    echo "<p>Tu carrito está vacío.</p>";
} else {
    echo "<h1>Carrito de Compras</h1>";
    echo "<table border='1'><tr><th>Producto</th><th>Precio (Tonkens)</th><th>Cantidad</th></tr>";
    foreach ($_SESSION['carrito'] as $id_producto => $cantidad) {
        $query = $conexion->prepare("SELECT nombre, precio_tonkens FROM productos WHERE id = ?");
        $query->bind_param("i", $id_producto);
        $query->execute();
        $resultado = $query->get_result()->fetch_assoc();
        echo "<tr><td>" . $resultado['nombre'] . "</td><td>" . $resultado['precio_tonkens'] . "</td><td>" . $cantidad . "</td></tr>";
    }
    echo "</table>";
    echo "<a href='checkout.php'>Finalizar Compra</a>";
}
include '../includes/footer.php';
?>
